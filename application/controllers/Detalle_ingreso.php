<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Detalle_ingreso extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Detalle_ingreso_model');
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
            return;
        }else{
            $data['_view'] = 'login/mensajeacceso';
        $this->load->view('layouts/main',$data);
        }
    }
    /*
     * Listing of detalle_ingreso
     */
    function index()
    {
        $this->acceso(16);
        $data['detalle_ingreso'] = $this->Detalle_ingreso_model->get_all_detalle_ingreso();
        
        $data['_view'] = 'detalle_ingreso/index';
        $this->load->view('layouts/main',$data);
    }
    
    function kardex($programa_id,$articulo_id,$fecha_desde,$fecha_hasta,$gestion_inicio)
    {
        $this->acceso(16);
        $this->load->model('Institucion_model');
        $data['institucion'] = $this->Institucion_model->get_all_institucion();
        $this->load->model('Programa_model');
        $data['articulo'] = $this->Programa_model->get_articulodatos($articulo_id,$programa_id);
        $data['fecha_ini'] = $fecha_desde;
        $data['kardex'] = $this->Programa_model->mostrar_kardex($programa_id,$articulo_id,$fecha_desde,$fecha_hasta,$gestion_inicio);
        $data['fecha_fin'] = $fecha_hasta;
        $data['_view'] = 'articulo/kardex';
        $this->load->view('layouts/main',$data);
    }

     

    /*
     * Adding a new detalle_ingreso
     */
    function add()
    {
        $this->acceso(16);
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'proveedor_id' => $this->input->post('proveedor_id'),
				'factura_id' => $this->input->post('factura_id'),
				'articulo_id' => $this->input->post('articulo_id'),
				'ingreso_id' => $this->input->post('ingreso_id'),
				'programa_id' => $this->input->post('programa_id'),
				'detalleing_cantidad' => $this->input->post('detalleing_cantidad'),
				'detalleing_precio' => $this->input->post('detalleing_precio'),
				'detalleing_total' => $this->input->post('detalleing_total'),
            );
            
            $detalle_ingreso_id = $this->Detalle_ingreso_model->add_detalle_ingreso($params);
            redirect('detalle_ingreso/index');
        }
        else
        {
			$this->load->model('Proveedor_model');
			$data['all_proveedor'] = $this->Proveedor_model->get_all_proveedor();

			$this->load->model('Factura_model');
			$data['all_factura'] = $this->Factura_model->get_all_factura();

			$this->load->model('Articulo_model');
			$data['all_articulo'] = $this->Articulo_model->get_all_articulo();

			$this->load->model('Ingreso_model');
			$data['all_ingreso'] = $this->Ingreso_model->get_all_ingreso();

			$this->load->model('Programa_model');
			$data['all_programa'] = $this->Programa_model->get_all_programa();
            
            $data['_view'] = 'detalle_ingreso/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a detalle_ingreso
     */
    function edit($detalleing_id)
    {
        $this->acceso(16);
        // check if the detalle_ingreso exists before trying to edit it
        $data['detalle_ingreso'] = $this->Detalle_ingreso_model->get_detalle_ingreso($detalleing_id);
        
        if(isset($data['detalle_ingreso']['detalleing_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'proveedor_id' => $this->input->post('proveedor_id'),
					'factura_id' => $this->input->post('factura_id'),
					'articulo_id' => $this->input->post('articulo_id'),
					'ingreso_id' => $this->input->post('ingreso_id'),
					'programa_id' => $this->input->post('programa_id'),
					'detalleing_cantidad' => $this->input->post('detalleing_cantidad'),
					'detalleing_precio' => $this->input->post('detalleing_precio'),
					'detalleing_total' => $this->input->post('detalleing_total'),
                );

                $this->Detalle_ingreso_model->update_detalle_ingreso($detalleing_id,$params);            
                redirect('detalle_ingreso/index');
            }
            else
            {
				$this->load->model('Proveedor_model');
				$data['all_proveedor'] = $this->Proveedor_model->get_all_proveedor();

				$this->load->model('Factura_model');
				$data['all_factura'] = $this->Factura_model->get_all_factura();

				$this->load->model('Articulo_model');
				$data['all_articulo'] = $this->Articulo_model->get_all_articulo();

				$this->load->model('Ingreso_model');
				$data['all_ingreso'] = $this->Ingreso_model->get_all_ingreso();

				$this->load->model('Programa_model');
				$data['all_programa'] = $this->Programa_model->get_all_programa();

                $data['_view'] = 'detalle_ingreso/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The detalle_ingreso you are trying to edit does not exist.');
    } 

    /*
     * Deleting detalle_ingreso
     */
    function remove($detalleing_id)
    {
        $this->acceso(16);
        $detalle_ingreso = $this->Detalle_ingreso_model->get_detalle_ingreso($detalleing_id);

        // check if the detalle_ingreso exists before trying to delete it
        if(isset($detalle_ingreso['detalleing_id']))
        {
            $this->Detalle_ingreso_model->delete_detalle_ingreso($detalleing_id);
            redirect('detalle_ingreso/index');
        }
        else
            show_error('The detalle_ingreso you are trying to delete does not exist.');
    }
    
}
