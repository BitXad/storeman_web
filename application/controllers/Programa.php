<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Programa extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Programa_model');
        $this->load->model('Unidad_model');
        $this->load->model('Estado_model');
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
     * Listing of programa
     */
    function index()
    {
        $this->acceso(12);
        $data['programa'] = $this->Programa_model->get_all_programas();
        /*$data['estado'] = $this->Estado_model->get_all_estado();
        $data['unidad'] = $this->Unidad_model->get_all_unidad();*/
        
        $data['_view'] = 'programa/index';
        $this->load->view('layouts/main',$data);
    }
    function kardex()
    {
        $this->acceso(12);
        $data['all_programa'] = $this->Programa_model->get_all_programa();
        $data['programa'] = $this->Programa_model->get_all_programa();
        $data['estado'] = $this->Estado_model->get_all_estado();
        $data['unidad'] = $this->Unidad_model->get_all_unidad();
        
        $data['_view'] = 'programa/kardex';
        $this->load->view('layouts/main',$data);
    }

     function buscar()
    {
         $this->acceso(12);
        if ($this->input->is_ajax_request()) {
        
        $parametro = $this->input->post('parametro');   
        $programa_id = $this->input->post('programa_id');   
        $fecha_desde = $this->input->post('fecha_desde');   
        $fecha_hasta = $this->input->post('fecha_hasta');   
        
        if ($parametro!=""){
            $datos = $this->Programa_model->get_articulop($parametro,$programa_id,$fecha_desde,$fecha_hasta);            
           
            echo json_encode($datos);
        }
        else echo json_encode(null);
    }
    else
    {                 
        show_404();
    }              
}

    /*
     * Adding a new programa
     */
    function add()
    {
        $this->acceso(12);
        if(isset($_POST) && count($_POST) > 0)     
        {   
            $params = array(
				'unidad_id' => $this->input->post('unidad_id'),
				'estado_id' => $this->input->post('estado_id'),
				'programa_nombre' => $this->input->post('programa_nombre'),
				'programa_codigo' => $this->input->post('programa_codigo'),
				'programa_descripcion' => $this->input->post('programa_descripcion'),
            );
            
            $programa_id = $this->Programa_model->add_programa($params);
            redirect('programa/index');
        }
        else
        {
			$this->load->model('Unidad_model');
			$data['all_unidad'] = $this->Unidad_model->get_all_unidad();

			$this->load->model('Estado_model');
			$data['all_estado'] = $this->Estado_model->get_all_estado();
            
            $data['_view'] = 'programa/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a programa
     */
    function edit($programa_id)
    {
        $this->acceso(12);
        // check if the programa exists before trying to edit it
        $data['programa'] = $this->Programa_model->get_programa($programa_id);
        
        if(isset($data['programa']['programa_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'unidad_id' => $this->input->post('unidad_id'),
					'estado_id' => $this->input->post('estado_id'),
					'programa_nombre' => $this->input->post('programa_nombre'),
					'programa_codigo' => $this->input->post('programa_codigo'),
					'programa_descripcion' => $this->input->post('programa_descripcion'),
                );

                $this->Programa_model->update_programa($programa_id,$params);            
                redirect('programa/index');
            }
            else
            {
				$this->load->model('Unidad_model');
				$data['all_unidad'] = $this->Unidad_model->get_all_unidad();

				$this->load->model('Estado_model');
				$data['all_estado'] = $this->Estado_model->get_all_estado();

                $data['_view'] = 'programa/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The programa you are trying to edit does not exist.');
    } 
    /*
     * Inactivar programa
     */
    function inactivar($programa_id)
    {
        $this->acceso(12);
        $programa = $this->Programa_model->get_programa($programa_id);

        // check if the programa exists before trying to delete it
        if(isset($programa['programa_id']))
        {
            $this->Programa_model->inactivar_programa($programa_id);
            redirect('programa/index');
        }
        else
            show_error('The programa you are trying to delete does not exist.');
    }

    /*
     * Deleting programa
     */
    function remove($programa_id)
    {
        $this->acceso(12);
        $programa = $this->Programa_model->get_programa($programa_id);

        // check if the programa exists before trying to delete it
        if(isset($programa['programa_id']))
        {
            $this->Programa_model->delete_programa($programa_id);
            redirect('programa/index');
        }
        else
            show_error('The programa you are trying to delete does not exist.');
    }
    
}
