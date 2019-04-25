<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Categoria extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Categoria_model');
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
     * Listing of categoria
     */
    function index()
    {
        $this->acceso(6);
        $data['categoria'] = $this->Categoria_model->get_all_categoria();
        
        $data['_view'] = 'categoria/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new categoria
     */
    function add()
    {
        $this->acceso(6);
        if(isset($_POST) && count($_POST) > 0)     
        {
            $categoria_nombre = $this->input->post('categoria_nombre');
            $resultado = $this->Categoria_model->es_categoria_registrado($categoria_nombre);
            if($resultado > 0){
                $data['resultado'] = 1;
                $data['_view'] = 'categoria/add';
                $this->load->view('layouts/main',$data);
            }else{
                //al crearse  se crea por defecto en activo
                $estado_id = 1;
                $params = array(
                        'estado_id' => $estado_id,
                        'categoria_nombre' => $categoria_nombre,
                        'categoria_descripcion' => $this->input->post('categoria_descripcion'),
                );

                $categoria_id = $this->Categoria_model->add_categoria($params);
                redirect('categoria');
            }
        }
        else
        {
            $data['resultado'] = 0;
            $data['_view'] = 'categoria/add';
            $this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a categoria
     */
    function edit($categoria_id)
    {
        $this->acceso(6);
        // check if the categoria exists before trying to edit it
        $data['categoria'] = $this->Categoria_model->get_categoria($categoria_id);
        
        if(isset($data['categoria']['categoria_id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
                            'estado_id' => $this->input->post('estado_id'),
                            'categoria_nombre' => $this->input->post('categoria_nombre'),
                            'categoria_descripcion' => $this->input->post('categoria_descripcion'),
                );

                $this->Categoria_model->update_categoria($categoria_id,$params);            
                redirect('categoria/index');
            }
            else
            {
				$this->load->model('Estado_model');
				$data['all_estado'] = $this->Estado_model->get_all_estado_tipo1();

                $data['_view'] = 'categoria/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The categoria you are trying to edit does not exist.');
    } 

    /*
     * Deleting categoria
     */
    function remove($categoria_id)
    {
        $this->acceso(6);
        $categoria = $this->Categoria_model->get_categoria($categoria_id);

        // check if the categoria exists before trying to delete it
        if(isset($categoria['categoria_id']))
        {
            $this->Categoria_model->delete_categoria($categoria_id);
            redirect('categoria/index');
        }
        else
            show_error('The categoria you are trying to delete does not exist.');
    }
    /*
     * Inactivar categoria
     */
    function inactivar($categoria_id)
    {
        $this->acceso(6);
        $categoria = $this->Categoria_model->get_categoria($categoria_id);

        // check if the programa exists before trying to delete it
        if(isset($categoria['categoria_id']))
        {
            $this->Categoria_model->inactivar_categoria($categoria_id);
            redirect('categoria');
        }
        else
            show_error('La Categoria que intentas dar de baja, no existe.');
    }
    
}
