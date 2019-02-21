<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Salida extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Salida_model');
    } 

    /*
     * Listing of salida
     */
    function index()
    {
        $data['salida'] = $this->Salida_model->get_all_salida();
        
        $data['_view'] = 'salida/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new salida
     */
    function add()
    {   
        $this->load->library('form_validation');
        $this->form_validation->set_rules('salida_motivo','Salida Motivo','trim|required', array('required' => 'Este Campo no debe ser vacio'));
        if($this->form_validation->run())     
        {
            //Se crea con estado_id activo
            $estado_id = 1;
            $params = array(
				'estado_id' => $estado_id,
				'unidad_id' => $this->input->post('unidad_id'),
				'gestion_id' => $this->input->post('gestion_id'),
				'usuario_id' => $this->input->post('usuario_id'),
				'salida_motivo' => $this->input->post('salida_motivo'),
				'salida_fecha' => $this->input->post('salida_fecha'),
				'salida_acta' => $this->input->post('salida_acta'),
				'salida_obs' => $this->input->post('salida_obs'),
				'salida_fechahora' => $this->input->post('salida_fechahora'),
				'salida_doc' => $this->input->post('salida_doc'),
            );
            
            $salida_id = $this->Salida_model->add_salida($params);
            redirect('salida');
        }
        else
        {
            $this->load->model('Unidad_model');
            $data['all_unidad'] = $this->Unidad_model->get_all_unidad();

            $this->load->model('Gestion_model');
            $data['all_gestion'] = $this->Gestion_model->get_all_gestion();

            $this->load->model('Usuario_model');
            $data['all_usuario'] = $this->Usuario_model->get_all_usuario();
            
            $data['_view'] = 'salida/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a salida
     */
    function edit($salida_id)
    {   
        // check if the salida exists before trying to edit it
        $data['salida'] = $this->Salida_model->get_salida($salida_id);
        
        if(isset($data['salida']['salida_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'estado_id' => $this->input->post('estado_id'),
					'unidad_id' => $this->input->post('unidad_id'),
					'gestion_id' => $this->input->post('gestion_id'),
					'usuario_id' => $this->input->post('usuario_id'),
					'salida_motivo' => $this->input->post('salida_motivo'),
					'salida_fecha' => $this->input->post('salida_fecha'),
					'salida_acta' => $this->input->post('salida_acta'),
					'salida_obs' => $this->input->post('salida_obs'),
					'salida_fechahora' => $this->input->post('salida_fechahora'),
					'salida_doc' => $this->input->post('salida_doc'),
                );

                $this->Salida_model->update_salida($salida_id,$params);            
                redirect('salida/index');
            }
            else
            {
				$this->load->model('Estado_model');
				$data['all_estado'] = $this->Estado_model->get_all_estado();

				$this->load->model('Unidad_model');
				$data['all_unidad'] = $this->Unidad_model->get_all_unidad();

				$this->load->model('Gestion_model');
				$data['all_gestion'] = $this->Gestion_model->get_all_gestion();

				$this->load->model('Usuario_model');
				$data['all_usuario'] = $this->Usuario_model->get_all_usuario();

                $data['_view'] = 'salida/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The salida you are trying to edit does not exist.');
    } 

    /*
     * Deleting salida
     */
    function remove($salida_id)
    {
        $salida = $this->Salida_model->get_salida($salida_id);

        // check if the salida exists before trying to delete it
        if(isset($salida['salida_id']))
        {
            $this->Salida_model->delete_salida($salida_id);
            redirect('salida/index');
        }
        else
            show_error('The salida you are trying to delete does not exist.');
    }
    
}
