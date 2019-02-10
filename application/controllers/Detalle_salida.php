<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Detalle_salida extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detalle_salida_model');
    } 

    /*
     * Listing of detalle_salida
     */
    function index()
    {
        $data['detalle_salida'] = $this->Detalle_salida_model->get_all_detalle_salida();
        
        $data['_view'] = 'detalle_salida/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new detalle_salida
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'salida_id' => $this->input->post('salida_id'),
				'articulo_id' => $this->input->post('articulo_id'),
				'programa_id' => $this->input->post('programa_id'),
				'detallesal_cantidad' => $this->input->post('detallesal_cantidad'),
				'detallesal_precio' => $this->input->post('detallesal_precio'),
				'detallesal_total' => $this->input->post('detallesal_total'),
            );
            
            $detalle_salida_id = $this->Detalle_salida_model->add_detalle_salida($params);
            redirect('detalle_salida/index');
        }
        else
        {
			$this->load->model('Salida_model');
			$data['all_salida'] = $this->Salida_model->get_all_salida();

			$this->load->model('Articulo_model');
			$data['all_articulo'] = $this->Articulo_model->get_all_articulo();

			$this->load->model('Programa_model');
			$data['all_programa'] = $this->Programa_model->get_all_programa();
            
            $data['_view'] = 'detalle_salida/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a detalle_salida
     */
    function edit($detallesal_id)
    {   
        // check if the detalle_salida exists before trying to edit it
        $data['detalle_salida'] = $this->Detalle_salida_model->get_detalle_salida($detallesal_id);
        
        if(isset($data['detalle_salida']['detallesal_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'salida_id' => $this->input->post('salida_id'),
					'articulo_id' => $this->input->post('articulo_id'),
					'programa_id' => $this->input->post('programa_id'),
					'detallesal_cantidad' => $this->input->post('detallesal_cantidad'),
					'detallesal_precio' => $this->input->post('detallesal_precio'),
					'detallesal_total' => $this->input->post('detallesal_total'),
                );

                $this->Detalle_salida_model->update_detalle_salida($detallesal_id,$params);            
                redirect('detalle_salida/index');
            }
            else
            {
				$this->load->model('Salida_model');
				$data['all_salida'] = $this->Salida_model->get_all_salida();

				$this->load->model('Articulo_model');
				$data['all_articulo'] = $this->Articulo_model->get_all_articulo();

				$this->load->model('Programa_model');
				$data['all_programa'] = $this->Programa_model->get_all_programa();

                $data['_view'] = 'detalle_salida/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The detalle_salida you are trying to edit does not exist.');
    } 

    /*
     * Deleting detalle_salida
     */
    function remove($detallesal_id)
    {
        $detalle_salida = $this->Detalle_salida_model->get_detalle_salida($detallesal_id);

        // check if the detalle_salida exists before trying to delete it
        if(isset($detalle_salida['detallesal_id']))
        {
            $this->Detalle_salida_model->delete_detalle_salida($detallesal_id);
            redirect('detalle_salida/index');
        }
        else
            show_error('The detalle_salida you are trying to delete does not exist.');
    }
    
}
