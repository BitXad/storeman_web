<?php

class Verificar extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('login_model');
        $this->load->model('rol_model');
        $this->load->model('Gestion_model');
    }
    function alerta()
    {
        $data['_view'] = 'public/alerta';
        $this->load->view('layouts/main',$data);
    }

    function index()
    {
        $username = $this->input->post('username');
        $clave = $this->input->post('password');
        $gestion_id = $this->input->post('gestion');

        $result = $this->login_model->login2($username, $clave);
        print "<pre>"; print_r( $result); print "</pre>";
        //var_dump($result);

        if ($result) {
            if ($result->tipousuario_id == 1 or $result->tipousuario_id == 2 or $result->tipousuario_id == 5) {
                $thumb = "";
                if ($result->usuario_imagen <> null) {
                    $thumb = $this->foto_thumb($result->usuario_imagen);
                }

                $gestion = $this->Gestion_model->get_gestion2($gestion_id);

                $sess_array = array(
                    'usuario_login' => $result->usuario_login,
                    'usuario_id' => $result->usuario_id,
                    'usuario_nombre' => $result->usuario_nombre,
                    'estado_id' => $result->estado_id,
                    'tipousuario_id' => $result->tipousuario_id,
                    'usuario_imagen' => $result->usuario_imagen,
                    'usuario_email' => $result->usuario_email,
                    'usuario_clave' => $result->usuario_clave,
                    'thumb' => $thumb,
                    'rol' => $this->getTipo_usuario($result->tipousuario_id),
                    'gestion_nombre' => $gestion->gestion_nombre,
                    'gestion_descripcion' => $gestion->gestion_descripcion,
                    'gestion_id' => $gestion->gestion_id
                );

                $this->session->set_userdata('logged_in', $sess_array);
                $session_data = $this->session->userdata('logged_in');

                if ($session_data['tipousuario_id'] == 1) {// admin page
//                    redirect('admin/dashb');
                    redirect('');
                }

            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">USUARIO invalido' . $result . '</div>');
                redirect('login');
            }

        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">USER o PASSWORD invalidos' . $result . '</div>');
            redirect('login');
        }

    }

    public function foto_thumb($foto)
    {
        $path_parts = pathinfo('./uploads/profile/' . $foto);
        return  $path_parts['filename'].'_thumb.' . $path_parts['extension'];
    }

    public function logout()
    {
        $sess_array = array(
            'username' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);

        $this->session->set_flashdata('msg', 'Successfully Logout');
        redirect('');
    }

    public function getTipo_usuario($tipousuario_id)
    {
        $tipo_usuarios = $this->rol_model->get_tipousuarios();

        foreach ($tipo_usuarios as $row) {
            if ($tipousuario_id == $row->tipousuario_id) {
                return $row->tipousuario_descripcion;
            }
        }

        if (count($tipo_usuarios) == 0) {
            return '----';
        }
    }


}

?>