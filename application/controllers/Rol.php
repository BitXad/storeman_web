<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Rol extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rol_model');
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
     * Listing of rol
     */
    function index()
    {
        $this->acceso(20);
        $data['all_rolpadre'] = $this->Rol_model->get_allrol_padre();
        $data['all_rolhijo'] = $this->Rol_model->get_allrol_hijo();
        
        $data['_view'] = 'rol/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new rol
     */
    function add()
    {
        $this->acceso(20);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('rol_nombre','Rol Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
        if($this->form_validation->run())     
        {
            $estado_id = 1;
            $params = array(
                'estado_id' => $estado_id,
                'rol_nombre' => $this->input->post('rol_nombre'),
                'rol_descripcion' => $this->input->post('rol_descripcion'),
            );
            
            $rol_id = $this->Rol_model->add_rol($params);
            redirect('rol');
        }
        else
        {
            $data['all_rolpadre'] = $this->Rol_model->get_allrol_padre();
            
            $data['_view'] = 'rol/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a rol
     */
    function edit($rol_id)
    {
        $this->acceso(20);
        // check if the rol exists before trying to edit it
        $data['rol'] = $this->Rol_model->get_rol($rol_id);
        
        if(isset($data['rol']['rol_id']))
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('rol_nombre','Rol Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run())     
            {
                $params = array(
                    'estado_id' => $this->input->post('estado_id'),
                    'rol_nombre' => $this->input->post('rol_nombre'),
                    'rol_descripcion' => $this->input->post('rol_descripcion'),
                    'rol_idfk' => $this->input->post('rol_idfk'),
                );

                $this->Rol_model->update_rol($rol_id,$params);            
                redirect('rol/index');
            }
            else
            {
                $data['all_rolpadre'] = $this->Rol_model->get_allrol_padre();
                $estado_tipo = 1;
                $this->load->model('Estado_model');
                $data['all_estado'] = $this->Estado_model->get_estado_tipo($estado_tipo);

                $data['_view'] = 'rol/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The rol you are trying to edit does not exist.');
    } 

    /*
     * Deleting rol
     */
    function remove($rol_id)
    {
        $this->acceso(20);
        $rol = $this->Rol_model->get_rol($rol_id);

        // check if the rol exists before trying to delete it
        if(isset($rol['rol_id']))
        {
            $this->Rol_model->delete_rol($rol_id);
            redirect('rol/index');
        }
        else
            show_error('The rol you are trying to delete does not exist.');
    }
    
}
