<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Articulo extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Articulo_model');
    } 

    /*
     * Listing of articulo
     */
    function index()
    {
        $data['articulo'] = $this->Articulo_model->get_all_articulo();
        
        $data['_view'] = 'articulo/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new articulo
     */
    function add()
    {   
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'estado_id' => $this->input->post('estado_id'),
				'categoria_id' => $this->input->post('categoria_id'),
				'articulo_nombre' => $this->input->post('articulo_nombre'),
				'articulo_marca' => $this->input->post('articulo_marca'),
				'articulo_industria' => $this->input->post('articulo_industria'),
				'articulo_codigo' => $this->input->post('articulo_codigo'),
				'articulo_saldo' => $this->input->post('articulo_saldo'),
            );
            
            $articulo_id = $this->Articulo_model->add_articulo($params);
            redirect('articulo/index');
        }
        else
        {
			$this->load->model('Estado_model');
			$data['all_estado'] = $this->Estado_model->get_all_estado();

			$this->load->model('Categoria_model');
			$data['all_categoria'] = $this->Categoria_model->get_all_categoria();
            
            $data['_view'] = 'articulo/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a articulo
     */
    function edit($articulo_id)
    {   
        // check if the articulo exists before trying to edit it
        $data['articulo'] = $this->Articulo_model->get_articulo($articulo_id);
        
        if(isset($data['articulo']['articulo_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'estado_id' => $this->input->post('estado_id'),
					'categoria_id' => $this->input->post('categoria_id'),
					'articulo_nombre' => $this->input->post('articulo_nombre'),
					'articulo_marca' => $this->input->post('articulo_marca'),
					'articulo_industria' => $this->input->post('articulo_industria'),
					'articulo_codigo' => $this->input->post('articulo_codigo'),
					'articulo_saldo' => $this->input->post('articulo_saldo'),
                );

                $this->Articulo_model->update_articulo($articulo_id,$params);            
                redirect('articulo/index');
            }
            else
            {
				$this->load->model('Estado_model');
				$data['all_estado'] = $this->Estado_model->get_all_estado();

				$this->load->model('Categoria_model');
				$data['all_categoria'] = $this->Categoria_model->get_all_categoria();

                $data['_view'] = 'articulo/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The articulo you are trying to edit does not exist.');
    }
}
