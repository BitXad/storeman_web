<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Articulo extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Articulo_model');
        
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
     * Listing of articulo
     */
    function index()
    {
        $this->Articulo_model->bitacora("ACCESO A MODULO","INDEX ARTICULO");
        
        if($this->acceso(4)){
            //$data['rolusuario'] = $rolusuario; // <--- es para que se lo use en el index.....
            $tipo = 1;
            $data['usuario_nombre'] = $this->session_data['usuario_nombre'];
            //$data['usuario_nombre'] = "Jacquelinne Alacoria F.";
            $data['articulo'] = $this->Articulo_model->get_all_articulo();

            $this->load->model('Categoria_model');
            $data['all_categoria'] = $this->Categoria_model->get_all_categoria();

            $this->load->model('Estado_model');
            $data['all_estado'] = $this->Estado_model->get_estado_tipo($tipo);

            $this->load->model('Institucion_model');
            $data['institucion'] = $this->Institucion_model->get_all_institucion();

            $data['_view'] = 'articulo/index';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Adding a new articulo
     */
    function add()
    {
        $this->Articulo_model->bitacora("ACCESO A MODULO","ADD ARTICULO");
        
        if($this->acceso(4)){
            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('articulo_nombre','Articulo Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run())     
            {
                $articulo_nombre = $this->input->post('articulo_nombre');
                $resultado = $this->Articulo_model->es_articulo_registrado($articulo_nombre);
                if($resultado > 0){
                    $data['resultado'] = 1;
                    $this->load->model('Unidad_manejo_model');
                    $data['all_unidadmanejo'] = $this->Unidad_manejo_model->get_all_unidad_manejo_activo();

                    $this->load->model('Categoria_model');
                    $data['all_categoria'] = $this->Categoria_model->get_all_categoria_activo();

                    $data['_view'] = 'articulo/add';
                    $this->load->view('layouts/main',$data);
                }else{
                    //al crear se incia activo
                    $estado_id = 1;
                    $params = array(
                            'estado_id' => $estado_id,
                            'categoria_id' => $this->input->post('categoria_id'),
                            'articulo_nombre' => $this->input->post('articulo_nombre'),
                            'articulo_marca' => $this->input->post('articulo_marca'),
                            'articulo_industria' => $this->input->post('articulo_industria'),
                            'articulo_codigo' => $this->input->post('articulo_codigo'),
                            'articulo_saldo' => $this->input->post('articulo_saldo'),
                            'articulo_precio' => $this->input->post('articulo_precio'),
                            'articulo_unidad' => $this->input->post('articulo_unidad'),
                    );
                    $articulo_id = $this->Articulo_model->add_articulo($params);
                    $paramscod = array(
                            'articulo_codigo' => $this->input->post('categoria_id')."/".$articulo_id,
                    );

                    $articulo_id = $this->Articulo_model->update_articulo($articulo_id,$paramscod);

                    redirect('articulo');
                }
            }
            else
            {
                $data['resultado'] = 0;
                $this->load->model('Unidad_manejo_model');
                $data['all_unidadmanejo'] = $this->Unidad_manejo_model->get_all_unidad_manejo_activo();

                $this->load->model('Categoria_model');
                $data['all_categoria'] = $this->Categoria_model->get_all_categoria_activo();

                $data['_view'] = 'articulo/add';
                $this->load->view('layouts/main',$data);
            }
        }
    } 

     
    

    /*
     * Editing a articulo
     */
    function edit($articulo_id)
    {
        $this->Articulo_model->bitacora("ACCESO A MODULO","EDIT ARTICULO");
        if($this->acceso(4)){
            // check if the articulo exists before trying to edit it
            $data['articulo'] = $this->Articulo_model->get_articulo($articulo_id);

            if(isset($data['articulo']['articulo_id']))
            {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('articulo_nombre','Articulo Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                if($this->form_validation->run())     
                {
                    $params = array(
                            'estado_id' => $this->input->post('estado_id'),
                            'categoria_id' => $this->input->post('categoria_id'),
                            'articulo_nombre' => $this->input->post('articulo_nombre'),
                            'articulo_marca' => $this->input->post('articulo_marca'),
                            'articulo_industria' => $this->input->post('articulo_industria'),
                            'articulo_codigo' => $this->input->post('articulo_codigo'),
                            'articulo_saldo' => $this->input->post('articulo_saldo'),
                            'articulo_precio' => $this->input->post('articulo_precio'),
                            'articulo_unidad' => $this->input->post('articulo_unidad'),
                    );

                    $this->Articulo_model->update_articulo($articulo_id,$params);            
                    redirect('articulo');
                }
                else
                {
                    $this->load->model('Unidad_manejo_model');
                    $data['all_unidadmanejo'] = $this->Unidad_manejo_model->get_all_unidad_manejo_activo();

                    $this->load->model('Estado_model');
                    $data['all_estado'] = $this->Estado_model->get_all_estado_tipo1();

                    $this->load->model('Categoria_model');
                    $data['all_categoria'] = $this->Categoria_model->get_all_categoria_activo();

                    $data['_view'] = 'articulo/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('The articulo you are trying to edit does not exist.');
        }
    }
    
    /* buscar los articulos */
    function buscararticuloall()
    {
               
        if ($this->input->is_ajax_request())
        {
            $parametro = $this->input->post('parametro');
            $categoria = $this->input->post('categoria');
            $datos = $this->Articulo_model->get_all_articuloparametro($parametro ,$categoria);
            echo json_encode($datos);
        }
        else
        {                 
            show_404();
        }   
    }
    /*
     * Deleting Artículo
     */
    function remove()
    {
        $this->Articulo_model->bitacora("ACCESO A MODULO","DELETE ARTICULO");
        
        if($this->acceso(5)){
            $articulo_id = $this->input->post('articulo_id');
            $articulo = $this->Articulo_model->get_articulo($articulo_id);

            // check if the programa exists before trying to delete it
            if(isset($articulo['articulo_id']))
            {
                $res = $this->Articulo_model->articulo_es_usado($articulo_id);
                if($res == 0){
                    $this->Articulo_model->delete_articulo($articulo_id);
                    echo json_encode("ok");
                }else{
                    echo json_encode("noeliminar");
                }
            }
            else
                echo json_encode("no");
        }
    }
    /*
     * Inactivar Articulo
     */
    function inactivar()
    {
         $this->Articulo_model->bitacora("ACCESO A MODULO","INACTIVAR ARTICULO");
        if($this->acceso(5)){
        
            $articulo_id = $this->input->post('articulo_id');
            $articulo = $this->Articulo_model->get_articulo($articulo_id);

            // check if the programa exists before trying to delete it
            if(isset($articulo['articulo_id']))
            {
                $this->Articulo_model->inactivar_articulo($articulo_id);
                echo json_encode("ok");
            }
            else
                echo json_encode("no");
        }
    }
    /* muestra los 50 primeros en orden alfabetico */
    function buscararticulolimit()
    {
        if ($this->input->is_ajax_request())
        {
            $datos = $this->Articulo_model->get_all_articulolimit();
            echo json_encode($datos);
        }
        else
        {                 
            show_404();
        }
    }
    
    /* buscar los articulos */
    function buscartodoslosarticulos()
    {
        if ($this->input->is_ajax_request())
        {
            $parametro = $this->input->post('parametro');
            $categoria = $this->input->post('categoria');
            $datos = $this->Articulo_model->get_all_articulo();
            echo json_encode($datos);
        }
        else
        {                 
            show_404();
        }   
    }
    
    function nuevo()
    {
        $this->Articulo_model->bitacora("ACCESO A MODULO","NUEVO ARTICULO");
        if ($this->input->is_ajax_request())
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('articulo_nombre','Articulo Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('categoria_id','Categoria','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('articulo_unidad','Unidad','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run())     
            {
            $articulo_nombre = $this->input->post('articulo_nombre');
                $resultado = $this->Articulo_model->es_articulo_registrado($articulo_nombre);
                if($resultado > 0){
                    echo json_encode("existe");
                }else{
                    $estado_id = 1;
                    $params = array(
                            'estado_id' => $estado_id,
                            'categoria_id' => $this->input->post('categoria_id'),
                            'articulo_nombre' => $this->input->post('articulo_nombre'),
                            'articulo_marca' => $this->input->post('articulo_marca'),
                            'articulo_industria' => $this->input->post('articulo_industria'),
                            'articulo_codigo' => $this->input->post('articulo_codigo'),
                            'articulo_saldo' => $this->input->post('articulo_saldo'),
                            'articulo_precio' => $this->input->post('articulo_precio'),
                            'articulo_unidad' => $this->input->post('articulo_unidad'),
                    );
                    $articulo_id = $this->Articulo_model->add_articulo($params);
                    $paramscod = array(
                            'articulo_codigo' => $this->input->post('categoria_id')."/".$articulo_id,
                    );

                    $articulo_id = $this->Articulo_model->update_articulo($articulo_id,$paramscod);
                    echo json_encode("ok");
                }
            }else{
                echo json_encode("falta");
            }
        }
    }
    
    function activar()
    {
        $this->Articulo_model->bitacora("ACCESO A MODULO","ACTIVAR ARTICULO");
        if($this->acceso(5)){
        
            $articulo_id = $this->input->post('articulo_id');
            $articulo = $this->Articulo_model->get_articulo($articulo_id);

            // check if the programa exists before trying to delete it
            if(isset($articulo['articulo_id']))
            {
                $this->Articulo_model->activar_articulo($articulo_id);
                echo json_encode("ok");
            }
            else
                echo json_encode("no");
        }
    }
}
