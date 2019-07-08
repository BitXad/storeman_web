<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Gestion extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Gestion_model');
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
     * Listing of gestion
     */
    function index()
    {
        if($this->acceso(2)){
            $this->load->model('Institucion_model');
            $data['institucion'] = $this->Institucion_model->get_all_institucion();

            $tipo = 2;
            $data['gestion'] = $this->Gestion_model->get_all_gestion($tipo);

            $data['_view'] = 'gestion/index';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Adding a new gestion
     */
    function add()
    {
        if($this->acceso(2)){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('gestion_nombre','Gestion Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run())     
            {
                //al crear gestion se crea activo
                $estado_id = 1;
                $params = array(
                    'estado_id' => $estado_id,
                    'institucion_id' => $this->input->post('institucion_id'),
                    'gestion_nombre' => $this->input->post('gestion_nombre'),
                    'gestion_descripcion' => $this->input->post('gestion_descripcion'),
                    'gestion_inicio' => $this->input->post('gestion_inicio'),
                    'gestion_fin' => $this->input->post('gestion_fin'),
                );

                $gestion_id = $this->Gestion_model->add_gestion($params);
                redirect('gestion/index');
            }
            else
            {
                $this->load->model('Estado_model');
                $data['all_estado'] = $this->Estado_model->get_all_estado();

                $this->load->model('Institucion_model');
                $data['all_institucion'] = $this->Institucion_model->get_all_institucion();

                $data['_view'] = 'gestion/add';
                $this->load->view('layouts/main',$data);
            }
        }
    }  

    /*
     * Editing a gestion
     */
    function edit($gestion_id)
    {
        if($this->acceso(2)){
            // check if the gestion exists before trying to edit it
            $data['gestion'] = $this->Gestion_model->get_gestion($gestion_id);
            $tipo = 2; //tipo de estado

            if(isset($data['gestion']['gestion_id']))
            {
                if(isset($_POST) && count($_POST) > 0)     
                {   
                    $params = array(
                        'estado_id' => $this->input->post('estado_id'),
                        'institucion_id' => $this->input->post('institucion_id'),
                        'gestion_nombre' => $this->input->post('gestion_nombre'),
                        'gestion_descripcion' => $this->input->post('gestion_descripcion'),
                        'gestion_inicio' => $this->input->post('gestion_inicio'),
                        'gestion_fin' => $this->input->post('gestion_fin'),
                );

                    $this->Gestion_model->update_gestion($gestion_id,$params);            
                    redirect('gestion/index');
                }
                else
                {
                    $this->load->model('Estado_model');
                    $data['all_estado'] = $this->Estado_model->get_estado_tipo($tipo);

                    $this->load->model('Institucion_model');
                    $data['all_institucion'] = $this->Institucion_model->get_all_institucion();

                    $data['_view'] = 'gestion/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('The gestion you are trying to edit does not exist.');
        }
    } 

    /*
     * Deleting gestion
     */
    function remove($gestion_id)
    {
        if($this->acceso(2)){
            $gestion = $this->Gestion_model->get_gestion($gestion_id);

            // check if the gestion exists before trying to delete it
            if(isset($gestion['gestion_id']))
            {
                $this->Gestion_model->delete_gestion($gestion_id);
                redirect('gestion/index');
            }
            else
                show_error('The gestion you are trying to delete does not exist.');
        }
    }
    
}
