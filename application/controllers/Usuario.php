<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Usuario extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Usuario_model');
        $this->load->library('form_validation');
        
    } 

    /*
     * Listing of usuario
     */
    function index()
    {
        $data['usuario'] = $this->Usuario_model->get_todos_usuario();
        
        $data['_view'] = 'usuario/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new usuario
     */
    function add()
    {   
         $this->form_validation->set_rules('usuario_login', 'usuario_login', 'required|is_unique[usuario.usuario_login]',
                    array('is_unique' => 'Este login de usuario ya existe.'));

                if ($this->form_validation->run()) {
            $foto="";
                if (!empty($_FILES['usuario_imagen']['name'])){
                        $this->load->library('image_lib');
                        $config['upload_path'] = './resources/images/usuarios/';
                        $img_full_path = $config['upload_path'];

                        $config['allowed_types'] = 'gif|jpeg|jpg|png';
                        $config['max_size'] = 0;
                        $config['max_width'] = 5900;
                        $config['max_height'] = 5900;
                        
                        $new_name = time(); //str_replace(" ", "_", $this->input->post('proveedor_nombre'));
                        $config['file_name'] = $new_name; //.$extencion;
                        $config['file_ext_tolower'] = TRUE;

                        $this->load->library('upload', $config);
                        $this->upload->do_upload('usuario_imagen');

                        $img_data = $this->upload->data();
                        $extension = $img_data['file_ext'];
                        /* ********************INICIO para resize***************************** */
                        if ($img_data['file_ext'] == ".jpg" || $img_data['file_ext'] == ".png" || $img_data['file_ext'] == ".jpeg" || $img_data['file_ext'] == ".gif") {
                            $conf['image_library'] = 'gd2';
                            $conf['source_image'] = $img_data['full_path'];
                            $conf['new_image'] = './resources/images/usuarios/';
                            $conf['maintain_ratio'] = TRUE;
                            $conf['create_thumb'] = FALSE;
                            $conf['width'] = 800;
                            $conf['height'] = 600;
                            $this->image_lib->clear();
                            $this->image_lib->initialize($conf);
                            if(!$this->image_lib->resize()){
                                echo $this->image_lib->display_errors('','');
                            }
                        }
                        /* ********************F I N  para resize***************************** */
                        $confi['image_library'] = 'gd2';
                        $confi['source_image'] = './resources/images/usuarios/'.$new_name.$extension;
                        $confi['new_image'] = './resources/images/usuarios/'."thumb_".$new_name.$extension;
                        $confi['create_thumb'] = FALSE;
                        $confi['maintain_ratio'] = TRUE;
                        $confi['width'] = 50;
                        $confi['height'] = 50;

                        $this->image_lib->clear();
                        $this->image_lib->initialize($confi);
                        $this->image_lib->resize();

                        $foto = $new_name.$extension;
                         }
            /* *********************FIN imagen***************************** */
            $params = array(
				'tipousuario_id' => $this->input->post('tipousuario_id'),
				'estado_id' => 1,
				'usuario_nombre' => $this->input->post('usuario_nombre'),
				'usuario_email' => $this->input->post('usuario_email'),
				'usuario_login' => $this->input->post('usuario_login'),
				'usuario_clave' => md5($this->input->post('usuario_clave')),
				'usuario_imagen' => $foto,
            );
            
            $usuario_id = $this->Usuario_model->add_usuario($params);
            redirect('usuario/index');
        }
        else
        {
			$this->load->model('Tipo_usuario_model');
			$data['all_tipo_usuario'] = $this->Tipo_usuario_model->get_all_tipo_usuario();

			$this->load->model('Estado_model');
			$data['all_estado'] = $this->Estado_model->get_all_estado();
            
            $data['_view'] = 'usuario/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a usuario
     */
    function edit($usuario_id)
    {   
        $original_value = $this->db->query("SELECT usuario_login FROM usuario WHERE usuario_id = " . $usuario_id)->row()->usuario_login;

        if ($this->input->post('usuario_login') != $original_value) {
            $is_unique = '|is_unique[usuario.usuario_login]';
        } else {
            $is_unique = '';
        }
        // check if the usuario exists before trying to edit it
        $data['usuario'] = $this->Usuario_model->get_usuario($usuario_id);
        
        if(isset($data['usuario']['usuario_id']))
        {
             $this->form_validation->set_rules('usuario_login', 'usuario_login', 'required|trim|xss_clean' . $is_unique, array('is_unique' => 'Este login de usuario ya existe.'));

                if ($this->form_validation->run()) {
              
                 /* *********************INICIO imagen***************************** */
                $foto="";
                $foto1= $this->input->post('usuario_imagen1');
                if (!empty($_FILES['usuario_imagen']['name']))
                {
                    $this->load->library('image_lib');
                    $config['upload_path'] = './resources/images/usuarios/';
                    $config['allowed_types'] = 'gif|jpeg|jpg|png';
                    $config['max_size'] = 0;
                    $config['max_width'] = 5900;
                    $config['max_height'] = 5900;

                    $new_name = time(); //str_replace(" ", "_", $this->input->post('proveedor_nombre'));
                    $config['file_name'] = $new_name; //.$extencion;
                    $config['file_ext_tolower'] = TRUE;

                    $this->load->library('upload', $config);
                    $this->upload->do_upload('usuario_imagen');

                    $img_data = $this->upload->data();
                    $extension = $img_data['file_ext'];
                    /* ********************INICIO para resize***************************** */
                    if($img_data['file_ext'] == ".jpg" || $img_data['file_ext'] == ".png" || $img_data['file_ext'] == ".jpeg" || $img_data['file_ext'] == ".gif") {
                        $conf['image_library'] = 'gd2';
                        $conf['source_image'] = $img_data['full_path'];
                        $conf['new_image'] = './resources/images/usuarios/';
                        $conf['maintain_ratio'] = TRUE;
                        $conf['create_thumb'] = FALSE;
                        $conf['width'] = 800;
                        $conf['height'] = 600;
                        $this->image_lib->clear();
                        $this->image_lib->initialize($conf);
                        if(!$this->image_lib->resize()){
                            echo $this->image_lib->display_errors('','');
                        }
                    }
                    /* ********************F I N  para resize***************************** */
                    //$directorio = base_url().'resources/imagenes/';
                    $directorio = $_SERVER['DOCUMENT_ROOT'].'/siaac_web/resources/images/usuarios/';
                    if(isset($foto1) && !empty($foto1)){
                      if(file_exists($directorio.$foto1)){
                          unlink($directorio.$foto1);
                          $mimagenthumb = str_replace(".", "_thumb.", $foto1);
                          unlink($directorio.$mimagenthumb);
                      }
                  }
                    $confi['image_library'] = 'gd2';
                    $confi['source_image'] = './resources/images/usuarios/'.$new_name.$extension;
                    $confi['new_image'] = './resources/images/usuarios/'."thumb_".$new_name.$extension;
                    $confi['create_thumb'] = FALSE;
                    $confi['maintain_ratio'] = TRUE;
                    $confi['width'] = 50;
                    $confi['height'] = 50;

                    $this->image_lib->clear();
                    $this->image_lib->initialize($confi);
                    $this->image_lib->resize();

                    $foto = $new_name.$extension;
                }else{
                    $foto = $foto1;
                }
            /* *********************FIN imagen***************************** */
                $params = array(
					'tipousuario_id' => $this->input->post('tipousuario_id'),
					'estado_id' => $this->input->post('estado_id'),
					'usuario_nombre' => $this->input->post('usuario_nombre'),
					'usuario_email' => $this->input->post('usuario_email'),
					'usuario_login' => $this->input->post('usuario_login'),
					'usuario_imagen' => $foto,
                );

                $this->Usuario_model->update_usuario($usuario_id,$params);            
                redirect('usuario/index');
            }
            else
            {
				$this->load->model('Tipo_usuario_model');
				$data['all_tipo_usuario'] = $this->Tipo_usuario_model->get_all_tipo_usuario();

				$this->load->model('Estado_model');
				$data['all_estado'] = $this->Estado_model->get_all_estado_tipo1();

                $data['_view'] = 'usuario/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The usuario you are trying to edit does not exist.');
    }
        function password($usuario_id)
    {
        // check if the usuario exists before trying to edit it
        $data['usuario'] = $this->Usuario_model->get_usuario($usuario_id);

        if (isset($data['usuario']['usuario_id'])) {
            $this->load->library('form_validation');


            $this->form_validation->set_rules('usuario_clave', 'Usuario clave', 'required');
            $this->form_validation->set_rules('newpass', 'clave nueva', 'required');
            $this->form_validation->set_rules('confpass', 'confirma clave', 'required');

            if ($this->form_validation->run()) {

                $curr_password = md5($this->input->post('usuario_clave'));
                $new_password = md5($this->input->post('newpass'));
                $conf_password = md5($this->input->post('confpass'));
                $this->load->model('Usuario_model');

                $passwd = $this->Usuario_model->getCurrentPassword($usuario_id);

                if ($passwd->usuario_clave == $curr_password) {
                    if ($new_password == $conf_password) {
                        if ($this->Usuario_model->password($usuario_id, $new_password)) {
                            redirect('usuario/index');
                        } else {
                            $data['_view'] = 'usuario/password';
                            $this->load->view('layouts/main', $data);
                            echo 'fallaste';
                        }
                    } else {
                        $data['mensaje'] = 'Las claves nuevas ingresadas no coinciden.';
                        $data['_view'] = 'usuario/password';
                        $this->load->view('layouts/main', $data);

                    }
                } else {
                    $data['mensaje'] = 'La clave ingresada no coincide con la clave antigua.';
                    $data['_view'] = 'usuario/password';
                    $this->load->view('layouts/main', $data);

                }
            } else {


                echo validation_errors();
                $data['mensaje'] = '';
                $data['_view'] = 'usuario/password';
                $this->load->view('layouts/main', $data);
            }
        } else
            show_error('The usuario you are trying to edit does not exist.');
    }

    function inactivar($usuario_id)
    {
        $usuario = $this->Usuario_model->get_usuario($usuario_id);

        // check if the programa exists before trying to delete it
        if(isset($usuario['usuario_id']))
        {
            $this->Usuario_model->inactivar_usuario($usuario_id);
            redirect('usuario');
        }
        else
            show_error('La Categoria que intentas dar de baja, no existe.');
    }
    function activar($usuario_id)
    {
        $usuario = $this->Usuario_model->get_usuario($usuario_id);

        // check if the programa exists before trying to delete it
        if(isset($usuario['usuario_id']))
        {
            $this->Usuario_model->activar_usuario($usuario_id);
            redirect('usuario');
        }
        else
            show_error('La Categoria que intentas dar de baja, no existe.');
    }
}
