<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Factura extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Factura_model');
        $this->load->model('Proveedor_model');
        
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }        
        
    } 

    
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
     * Listing of factura
     */
    function index()
    {
        $this->Factura_model->bitacora("ACCESO A MODULO","INDEX FACTURA");
        $data['gestion_id'] = $this->session_data['gestion_id'];

        $data['factura'] = $this->Factura_model->get_all_factura();
        $data['proveedor'] = $this->Proveedor_model->get_all_proveedor();
        
        $data['_view'] = 'factura/index';
        $this->load->view('layouts/main',$data);
    }

    function mostrar_facturas()
    {
       

        if ($this->input->is_ajax_request()) {
                  
            $opcion = $this->input->post('opcion');   
         
                $datos = $this->Factura_model->get_factura($opcion);
            
            
            echo json_encode($datos);
            
        }
        else
        {                 
            show_404();
        }
    } 
    /*
     * Adding a new factura
     */
    function add()
    {   
        $this->Factura_model->bitacora("ACCESO A MODULO","ADD FACTURA");
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'estado_id' => $this->input->post('estado_id'),
				'usuario_id' => $this->input->post('usuario_id'),
				'factura_numero' => $this->input->post('factura_numero'),
				'factura_fecha' => $this->input->post('factura_fecha'),
				'factura_nit' => $this->input->post('factura_nit'),
				'factura_razon' => $this->input->post('factura_razon'),
				'factura_importe' => $this->input->post('factura_importe'),
				'factura_autorizacion' => $this->input->post('factura_autorizacion'),
				'factura_poliza' => $this->input->post('factura_poliza'),
				'factura_ice' => $this->input->post('factura_ice'),
				'factura_exento' => $this->input->post('factura_exento'),
				'factura_neto' => $this->input->post('factura_neto'),
				'factura_creditofiscal' => $this->input->post('factura_creditofiscal'),
				'factura_codigocontrol' => $this->input->post('factura_codigocontrol'),
            );
            
            $factura_id = $this->Factura_model->add_factura($params);
            redirect('factura/index');
        }
        else
        {
			$this->load->model('Estado_model');
			$data['all_estado'] = $this->Estado_model->get_all_estado();

			$this->load->model('Usuario_model');
			$data['all_usuario'] = $this->Usuario_model->get_all_usuario();
            
            $data['_view'] = 'factura/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a factura
     */
    function edit($factura_id)
    {   
        $this->Factura_model->bitacora("ACCESO A MODULO","EDIT FACTURA");
        // check if the factura exists before trying to edit it
        $gestion_id = $this->session_data['gestion_id'];
        $data['factura'] = $this->Factura_model->get_factura_id($factura_id);
        
        if(isset($data['factura']['factura_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'estado_id' => $this->input->post('estado_id'),
					'usuario_id' => $this->input->post('usuario_id'),
					'factura_numero' => $this->input->post('factura_numero'),
					'factura_fecha' => $this->input->post('factura_fecha'),
					'factura_nit' => $this->input->post('factura_nit'),
					'factura_razon' => $this->input->post('factura_razon'),
					'factura_importe' => $this->input->post('factura_importe'),
					'factura_autorizacion' => $this->input->post('factura_autorizacion'),
					'factura_poliza' => $this->input->post('factura_poliza'),
					'factura_ice' => $this->input->post('factura_ice'),
					'factura_exento' => $this->input->post('factura_exento'),
					'factura_neto' => $this->input->post('factura_neto'),
					'factura_creditofiscal' => $this->input->post('factura_creditofiscal'),
					'factura_codigocontrol' => $this->input->post('factura_codigocontrol'),
                );

                $this->Factura_model->update_factura($factura_id,$params);            
                redirect('factura/index');
            }
            else
            {
                $this->load->model('Estado_model');
                $data['all_estado'] = $this->Estado_model->get_all_estado();

                $this->load->model('Usuario_model');
                $data['all_usuario'] = $this->Usuario_model->get_all_usuario();

                $this->load->model('Ingreso_model');
                $data['all_ingreso'] = $this->Ingreso_model->get_ingreso_gestion($gestion_id);

                $data['_view'] = 'factura/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The factura you are trying to edit does not exist.');
    } 

    /*
     * Deleting factura
     */
    function remove($factura_id)
    {
        $this->Factura_model->bitacora("ACCESO A MODULO","REMOVE FACTURA");
        $factura = $this->Factura_model->get_factura($factura_id);

        // check if the factura exists before trying to delete it
        if(isset($factura['factura_id']))
        {
            $this->Factura_model->delete_factura($factura_id);
            redirect('factura/index');
        }
        else
            show_error('The factura you are trying to delete does not exist.');
    }
    
}
