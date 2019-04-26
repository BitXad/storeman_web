<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Pedido extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Pedido_model');
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
     * Listing of pedido
     */
    function index()
    {
        if($this->acceso(10)){
            $tipo = 3;
            //$data['usuario_nombre'] = "Jacquelinne Alacoria F.";
            $data['usuario_nombre'] = $this->session_data['usuario_nombre'];

            $this->load->model('Institucion_model');
            $data['institucion'] = $this->Institucion_model->get_all_institucion();

            $this->load->model('Unidad_model');
            $data['all_unidad'] = $this->Unidad_model->get_all_unidad();

            $this->load->model('Programa_model');
            $data['all_programa'] = $this->Programa_model->get_all_programa(); 

            $this->load->model('Estado_model');
            $data['all_estado'] = $this->Estado_model->get_estado_tipo($tipo);

            $data['pedido'] = $this->Pedido_model->get_all_pedido();

            $data['_view'] = 'pedido/index';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Adding a new pedido
     */
    function add()
    {
        if($this->acceso(10)){
            $tipo = 3;
            $this->load->library('form_validation');
            $this->form_validation->set_rules('pedido_numero','Pedido Numero','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            $this->form_validation->set_rules('unidad_nombre','Pedido Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run())     
            {
                /* *********************INICIO imagen***************************** */
                    $foto="";
                    if (!empty($_FILES['pedido_archivo']['name']))
                    {
                        $this->load->library('image_lib');
                        $config['upload_path'] = './resources/images/pedidos/archivos/';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = 0;
                        /*$config['max_width'] = 2900;
                        $config['max_height'] = 2900;*/

                        $new_name = time(); //str_replace(" ", "_", $this->input->post('proveedor_nombre'));
                        $config['file_name'] = $new_name; //.$extencion;
                        $config['file_ext_tolower'] = TRUE;

                        $this->load->library('upload', $config);
                        $this->upload->do_upload('pedido_archivo');

                        $img_data = $this->upload->data();
                        $extension = $img_data['file_ext'];

                        $foto = $new_name.$extension;
                    }
                /* *********************FIN imagen***************************** */

                /* *********************INICIO imagen 2***************************** */
                    $foto2="";
                    if (!empty($_FILES['pedido_imagen']['name']))
                    {
                        $this->load->library('image_lib');
                        $config1['upload_path'] = './resources/images/pedidos/imagenes/';
                        $config1['allowed_types'] = 'gif|jpeg|jpg|png';
                        $config1['max_size'] = 0;
                        $config1['max_width'] = 5900;
                        $config1['max_height'] = 5900;

                        $new_name1 = time(); //str_replace(" ", "_", $this->input->post('proveedor_nombre'));
                        $config1['file_name'] = $new_name1; //.$extencion;
                        $config1['file_ext_tolower'] = TRUE;

                        $this->load->library('upload', $config1);
                         $this->upload->initialize($config1);
                        $this->upload->do_upload('pedido_imagen');

                        $img_data1 = $this->upload->data();
                        $extension1 = $img_data1['file_ext'];
                        /* ********************INICIO para resize***************************** */
                        if($img_data1['file_ext'] == ".jpg" || $img_data1['file_ext'] == ".png" || $img_data1['file_ext'] == ".jpeg" || $img_data1['file_ext'] == ".gif") {
                            $conf1['image_library'] = 'gd2';
                            $conf1['source_image'] = $img_data1['full_path'];
                            $conf1['new_image'] = './resources/images/pedidos/imagenes/';
                            $conf1['maintain_ratio'] = TRUE;
                            $conf1['create_thumb'] = FALSE;
                            $conf1['width'] = 800;
                            $conf1['height'] = 600;
                            $this->image_lib->clear();
                            $this->image_lib->initialize($conf1);
                            if(!$this->image_lib->resize()){
                                echo $this->image_lib->display_errors('','');
                            }
                        }
                        /* ********************F I N  para resize***************************** */

                        $confi1['image_library'] = 'gd2';
                        $confi1['source_image'] = './resources/images/pedidos/imagenes/'.$new_name1.$extension1;
                        $confi1['new_image'] = './resources/images/pedidos/imagenes/'."thumb_".$new_name1.$extension1;
                        $confi1['create_thumb'] = FALSE;
                        $confi1['maintain_ratio'] = TRUE;
                        $confi1['width'] = 50;
                        $confi1['height'] = 50;

                        $this->image_lib->clear();
                        $this->image_lib->initialize($confi1);
                        $this->image_lib->resize();

                        $foto2 = $new_name1.$extension1;
                    }
                /* *********************FIN imagen 2***************************** */
                date_default_timezone_set('America/La_paz');
                $estado_id = 6;
                $gestion_id = 1;
                $params = array(
                                    'estado_id' => $estado_id,
                                    'gestion_id' => $gestion_id,
                                    'pedido_fecha' => date("Y-m-d"),
                                    'pedido_hora' => date("H:i:s"),
                                    'pedido_archivo' => $foto,
                                    'pedido_imagen' => $foto2,
                                    'unidad_id' => $this->input->post('unidad_id'),
                                    'programa_id' => $this->input->post('programa_id'),                
                                    'pedido_numero' => $this->input->post('pedido_numero'),
                                    'pedido_fechapedido' => $this->input->post('pedido_fechapedido'),
                );

                $pedido_id = $this->Pedido_model->add_pedido($params);
                redirect('pedido/index');
            }
            else
            {
                /*
                $this->load->model('Estado_model');
                $data['all_estado'] = $this->Estado_model->get_estado_tipo($tipo);

                $this->load->model('Gestion_model');
                $data['all_gestion'] = $this->Gestion_model->get_all_gestion();

                $this->load->model('Unidad_model');
                $data['all_unidad'] = $this->Unidad_model->get_all_unidad();
                */
                $this->load->model('Programa_model');
                $data['all_programa'] = $this->Programa_model->get_all_programa();                        

                $data['_view'] = 'pedido/add';
                $this->load->view('layouts/main',$data);
            }
        }
    }  

    /*
     * Editing a pedido
     */
    function edit($pedido_id)
    {
        if($this->acceso(10)){
            $tipo = 3;
            // check if the pedido exists before trying to edit it
            $data['pedido'] = $this->Pedido_model->get_pedidojoin($pedido_id);

            if(isset($data['pedido']['pedido_id']))
            {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('pedido_numero','Pedido Numero','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                if($this->form_validation->run())     
                {
                    /* *********************INICIO imagen***************************** */
                    $foto="";
                    $foto1= $this->input->post('pedido_archivo1');
                    if (!empty($_FILES['pedido_archivo']['name']))
                    {
                        $this->load->library('image_lib');
                        $config['upload_path'] = './resources/images/pedidos/archivos/';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = 0;
                        /*$config['max_width'] = 2900;
                        $config['max_height'] = 2900;*/

                        $new_name = time(); //str_replace(" ", "_", $this->input->post('proveedor_nombre'));
                        $config['file_name'] = $new_name; //.$extencion;
                        $config['file_ext_tolower'] = TRUE;

                        $this->load->library('upload', $config);
                        $this->upload->do_upload('pedido_archivo');

                        $img_data = $this->upload->data();
                        $extension = $img_data['file_ext'];

                        //$directorio = base_url().'resources/imagenes/';
                        $directorio = $_SERVER['DOCUMENT_ROOT'].'/storeman_web/resources/images/pedidos/archivos/';
                        if(isset($foto1) && !empty($foto1)){
                          if(file_exists($directorio.$foto1)){
                              unlink($directorio.$foto1);
                              $mimagenthumb = "thumb_".$foto1;
                              unlink($directorio.$mimagenthumb);
                          }
                      }

                        $foto = $new_name.$extension;
                    }else{
                        $foto = $foto1;
                    }
                /* *********************FIN imagen***************************** */
                /* *********************INICIO imagen 2***************************** */
                    $foto2="";
                    $fotoimg2= $this->input->post('pedido_imagen1');
                    if (!empty($_FILES['pedido_imagen']['name']))
                    {
                        $this->load->library('image_lib');
                        $config1['upload_path'] = './resources/images/pedidos/imagenes/';
                        $config1['allowed_types'] = 'gif|jpeg|jpg|png';
                        $config1['max_size'] = 0;
                        $config1['max_width'] = 5900;
                        $config1['max_height'] = 5900;

                        $new_name1 = time(); //str_replace(" ", "_", $this->input->post('proveedor_nombre'));
                        $config1['file_name'] = $new_name1; //.$extencion;
                        $config1['file_ext_tolower'] = TRUE;

                        $this->load->library('upload', $config1);
                         $this->upload->initialize($config1);
                        $this->upload->do_upload('pedido_imagen');

                        $img_data1 = $this->upload->data();
                        $extension1 = $img_data1['file_ext'];
                        /* ********************INICIO para resize***************************** */
                        if($img_data1['file_ext'] == ".jpg" || $img_data1['file_ext'] == ".png" || $img_data1['file_ext'] == ".jpeg" || $img_data1['file_ext'] == ".gif") {
                            $conf1['image_library'] = 'gd2';
                            $conf1['source_image'] = $img_data1['full_path'];
                            $conf1['new_image'] = './resources/images/pedidos/imagenes/';
                            $conf1['maintain_ratio'] = TRUE;
                            $conf1['create_thumb'] = FALSE;
                            $conf1['width'] = 800;
                            $conf1['height'] = 600;
                            $this->image_lib->clear();
                            $this->image_lib->initialize($conf1);
                            if(!$this->image_lib->resize()){
                                echo $this->image_lib->display_errors('','');
                            }
                        }
                        /* ********************F I N  para resize***************************** */
                        //$directorio = base_url().'resources/imagenes/';
                        $directorio1 = $_SERVER['DOCUMENT_ROOT'].'/storeman_web/resources/images/pedidos/imagenes/';
                        if(isset($fotoapo1) && !empty($fotoapo1)){
                          if(file_exists($directorio1.$fotoapo1)){
                              unlink($directorio1.$fotoapo1);
                              $mimagenthumb1 = "thumb_".$fotoapo1;
                              unlink($directorio1.$mimagenthumb1);
                          }
                      }
                        $confi1['image_library'] = 'gd2';
                        $confi1['source_image'] = './resources/images/pedidos/imagenes/'.$new_name1.$extension1;
                        $confi1['new_image'] = './resources/images/pedidos/imagenes/'."thumb_".$new_name1.$extension1;
                        $confi1['create_thumb'] = FALSE;
                        $confi1['maintain_ratio'] = TRUE;
                        $confi1['width'] = 50;
                        $confi1['height'] = 50;

                        $this->image_lib->clear();
                        $this->image_lib->initialize($confi1);
                        $this->image_lib->resize();

                        $foto2 = $new_name1.$extension1;
                    }else{
                        $foto2 = $fotoimg2;
                    }
                /* *********************FIN imagen 2***************************** */

                    $params = array(
                                            'estado_id' => $this->input->post('estado_id'),
                                            'gestion_id' => $this->input->post('gestion_id'),
                                            'unidad_id' => $this->input->post('unidad_id'),
                                            'programa_id' => $this->input->post('programa_id'),                    
                                            /*'pedido_fecha' => $this->input->post('pedido_fecha'),
                                            'pedido_hora' => $this->input->post('pedido_hora'),*/
                                            'pedido_archivo' => $foto,
                                            'pedido_imagen' => $foto2,
                                            'pedido_numero' => $this->input->post('pedido_numero'),
                                            'pedido_fechapedido' => $this->input->post('pedido_fechapedido'),
                    );

                    $this->Pedido_model->update_pedido($pedido_id,$params);            
                    redirect('pedido/index');
                }
                else
                {
                    $this->load->model('Estado_model');
                    $data['all_estado'] = $this->Estado_model->get_estado_tipo($tipo);

                    $this->load->model('Gestion_model');
                    $data['all_gestion'] = $this->Gestion_model->get_all_gestion();
                    /*
                    $this->load->model('Unidad_model');
                    $data['all_unidad'] = $this->Unidad_model->get_all_unidad();

                    $this->load->model('Programa_model');
                    $data['all_programa'] = $this->Programa_model->get_all_programa();
                    */
                    $data['_view'] = 'pedido/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('The pedido you are trying to edit does not exist.');
        }
    } 

    /*
     * Deleting pedido
     */
    function remove()
    {
        if($this->acceso(11)){
            $pedido_id = $this->input->post('pedido_id');
            $pedido = $this->Pedido_model->get_pedido($pedido_id);

            // check if the programa exists before trying to delete it
            if(isset($pedido['pedido_id']))
            {
                $this->Pedido_model->delete_pedido($pedido_id);
                echo json_encode("ok");
            }
            else
                echo json_encode("no");
        }
    }
    
    /* busca los pedidos */
    function buscarpedidosall()
    {
        if ($this->input->is_ajax_request())
        {
            $parametro = $this->input->post('parametro');
            $categoria = $this->input->post('categoria');
            $datos = $this->Pedido_model->get_all_pedidoparametro($parametro ,$categoria);
            echo json_encode($datos);
        }
        else
        {                 
            show_404();
        }   
    }
    /* busca unidades param */
    function buscar_pedidounidadparam()
    {
        if ($this->input->is_ajax_request())
        {
            $parametro = $this->input->post('parametro');
            $datos = $this->Pedido_model->get_unidadparametro($parametro);
            echo json_encode($datos);
        }
        else
        {                 
            show_404();
        }   
    }
    /* busca programas param */
    function buscar_pedidoprogramaparam()
    {
        if ($this->input->is_ajax_request())
        {
            $parametro = $this->input->post('parametro');
            $datos = $this->Pedido_model->get_programaparametro($parametro);
            echo json_encode($datos);
        }
        else
        {                 
            show_404();
        }   
    }
     /* busca pedidos para excel */
    function buscar_pedidoexcel()
    {
        if($this->acceso(10)){
            if ($this->input->is_ajax_request())
            {
                $parametro = $this->input->post('parametro');
                $categoria = $this->input->post('categoria');
                $datos = $this->Pedido_model->get_all_pedidoexcel($parametro, $categoria);
                echo json_encode($datos);
            }
            else
            {                 
                show_404();
            }
        }
    }
}
