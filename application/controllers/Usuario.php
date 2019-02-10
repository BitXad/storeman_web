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
    } 

    /*
     * Listing of usuario
     */
    function index()
    {
        $data['usuario'] = $this->Usuario_model->get_all_usuario();
        
        $data['_view'] = 'usuario/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new usuario
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'tipousuario_id' => $this->input->post('tipousuario_id'),
				'estado_id' => $this->input->post('estado_id'),
				'usuario_nombre' => $this->input->post('usuario_nombre'),
				'usuario_email' => $this->input->post('usuario_email'),
				'usuario_login' => $this->input->post('usuario_login'),
				'usuario_clave' => $this->input->post('usuario_clave'),
				'usuario_imagen' => $this->input->post('usuario_imagen'),
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
        // check if the usuario exists before trying to edit it
        $data['usuario'] = $this->Usuario_model->get_usuario($usuario_id);
        
        if(isset($data['usuario']['usuario_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'tipousuario_id' => $this->input->post('tipousuario_id'),
					'estado_id' => $this->input->post('estado_id'),
					'usuario_nombre' => $this->input->post('usuario_nombre'),
					'usuario_email' => $this->input->post('usuario_email'),
					'usuario_login' => $this->input->post('usuario_login'),
					'usuario_clave' => $this->input->post('usuario_clave'),
					'usuario_imagen' => $this->input->post('usuario_imagen'),
                );

                $this->Usuario_model->update_usuario($usuario_id,$params);            
                redirect('usuario/index');
            }
            else
            {
				$this->load->model('Tipo_usuario_model');
				$data['all_tipo_usuario'] = $this->Tipo_usuario_model->get_all_tipo_usuario();

				$this->load->model('Estado_model');
				$data['all_estado'] = $this->Estado_model->get_all_estado();

                $data['_view'] = 'usuario/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The usuario you are trying to edit does not exist.');
    }
}
