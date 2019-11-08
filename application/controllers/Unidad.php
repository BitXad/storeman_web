<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Unidad extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Unidad_model');
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
    } 
    /* *****Funcion que verifica el acceso al sistema**** */
    private function acceso($id_rol){
        $rolusuario = $this->session_data['rol'];
        if($rolusuario[$id_rol-1]['rolusuario_asignado'] == 1){
            return true;
        }else{
            $data['_view'] = 'login/mensajeacceso';
            $this->load->view('layouts/main',$data);
        }
    }
    /*
     * Listing of unidad
     */
    function index()
    {
        if($this->acceso(14)){
            $data['unidad'] = $this->Unidad_model->get_todo_unidad();

            $data['_view'] = 'unidad/index';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Adding a new unidad
     */
    function add()
    {
        if($this->acceso(14)){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('unidad_nombre','Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('unidad_codigo','Código','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run())     
            {
                $params = array(
                    'estado_id' => 1,
                    'unidad_nombre' => $this->input->post('unidad_nombre'),
                    'unidad_codigo' => $this->input->post('unidad_codigo'),
                    'unidad_descripcion' => $this->input->post('unidad_descripcion'),
                    'jerarquia_id' => $this->input->post('jerarquia_id'),
                );

                $unidad_id = $this->Unidad_model->add_unidad($params);
                redirect('unidad/index');
            }
            else
            {
                $this->load->model('Jerarquia_model');
                $data['all_jerarquia'] = $this->Jerarquia_model->get_all_jerarquia_activo();

                $data['_view'] = 'unidad/add';
                $this->load->view('layouts/main',$data);
            }
        }
    }  

    /*
     * Editing a unidad
     */
    function edit($unidad_id)
    {
        if($this->acceso(14)){
            // check if the unidad exists before trying to edit it
            $data['unidad'] = $this->Unidad_model->get_unidad($unidad_id);

            if(isset($data['unidad']['unidad_id']))
            {
                if(isset($_POST) && count($_POST) > 0)     
                {   
                    $params = array(
                        'estado_id' => $this->input->post('estado_id'),
                        'unidad_nombre' => $this->input->post('unidad_nombre'),
                        'unidad_codigo' => $this->input->post('unidad_codigo'),
                        'unidad_descripcion' => $this->input->post('unidad_descripcion'),
                        'jerarquia_id' => $this->input->post('jerarquia_id'),
                    );

                    $this->Unidad_model->update_unidad($unidad_id,$params);            
                    redirect('unidad/index');
                }
                else
                {
                    $this->load->model('Jerarquia_model');
                    $data['all_jerarquia'] = $this->Jerarquia_model->get_all_jerarquia_activo();

                    $this->load->model('Estado_model');
                    $data['all_estado'] = $this->Estado_model->get_all_estado_tipo1();

                    $data['_view'] = 'unidad/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('The unidad you are trying to edit does not exist.');
        }
    } 

    /*
     * Deleting unidad
     */
    function remove($unidad_id)
    {
        if($this->acceso(14)){
            $unidad = $this->Unidad_model->get_unidad($unidad_id);

            // check if the unidad exists before trying to delete it
            if(isset($unidad['unidad_id']))
            {
                $this->Unidad_model->delete_unidad($unidad_id);
                redirect('unidad/index');
            }
            else
                show_error('The unidad you are trying to delete does not exist.');
        }
    }

    function inactivar($unidad_id)
    {
        if($this->acceso(14)){
            $unidad = $this->Unidad_model->get_unidad($unidad_id);

            // check if the programa exists before trying to delete it
            if(isset($unidad['unidad_id']))
            {
                $this->Unidad_model->inactivar_unidad($unidad_id);
                redirect('unidad');
            }
            else
                show_error('La Categoria que intentas dar de baja, no existe.');
        }
    }

    function activar($unidad_id)
    {
        if($this->acceso(14)){
            $unidad = $this->Unidad_model->get_unidad($unidad_id);

            // check if the programa exists before trying to delete it
            if(isset($unidad['unidad_id']))
            {
                $this->Unidad_model->activar_unidad($unidad_id);
                redirect('unidad');
            }
            else
                show_error('La Categoria que intentas dar de alta, no existe.');
        }
    }
    
}
