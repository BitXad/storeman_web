<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Institucion extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Institucion_model');
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
     * Listing of institucion
     */
    function index()
    {
        $this->Institucion_model->bitacora("ACCESO A MODULO","INDEX INSTITUCION");
        
        if($this->acceso(1)){
            $rescount = $this->Institucion_model->get_all_institucion_count();
            if($rescount >0){
                $data['newinst'] = 1;
            }else{ $data['newinst'] = 0; }

            $data['institucion'] = $this->Institucion_model->get_all_institucion();

            $data['_view'] = 'institucion/index';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Adding a new institucion
     */
    function add()
    {
        $this->Institucion_model->bitacora("ACCESO A MODULO","ADD INSTITUCION");
        if($this->acceso(1)){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('institucion_nombre','Iinstitucion Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
            if($this->form_validation->run())     
            {  

                 $foto="";
                if (!empty($_FILES['institucion_logo']['name'])){
                            $this->load->library('image_lib');
                            $config['upload_path'] = './resources/images/empresas/';
                            $img_full_path = $config['upload_path'];

                            $config['allowed_types'] = 'gif|jpeg|jpg|png';
                            $config['max_size'] = 200000;
                            $config['max_width'] = 2900;
                            $config['max_height'] = 2900;

                            $new_name = time();
                        $config['file_name'] = $new_name;
                            $config['file_ext_tolower'] = TRUE;

                            $this->load->library('upload', $config);
                            $this->upload->do_upload('institucion_logo');

                            $img_data = $this->upload->data();
                            $extension = $img_data['file_ext'];
                            /* ********************INICIO para resize***************************** */
                            if ($img_data['file_ext'] == ".jpg" || $img_data['file_ext'] == ".png" || $img_data['file_ext'] == ".jpeg" || $img_data['file_ext'] == ".gif") {
                                $conf['image_library'] = 'gd2';
                                $conf['source_image'] = $img_data['full_path'];
                                $conf['new_image'] = './resources/images/empresas/';
                                $conf['maintain_ratio'] = TRUE;
                                $conf['create_thumb'] = FALSE;
                                $conf['width'] = 800;
                                $conf['height'] = 600;
                                $this->image_lib->clear();
                                $this->image_lib->initialize($conf);
                                if(!$this->image_lib->resize()){
                                    echo $this->image_lib->display_errors('','');
                                }
                            }
                            /* ********************F I N  para resize***************************** */
                            $confi['image_library'] = 'gd2';
                            $confi['source_image'] = './resources/images/empresas/'.$new_name.$extension;
                            $confi['new_image'] = './resources/images/empresas/'."thumb_".$new_name.$extension;
                            $confi['create_thumb'] = FALSE;
                            $confi['maintain_ratio'] = TRUE;
                            $confi['width'] = 50;
                            $confi['height'] = 50;

                            $this->image_lib->clear();
                            $this->image_lib->initialize($confi);
                            $this->image_lib->resize();

                            $foto = $new_name.$extension;
                        }
                /* *********************FIN imagen***************************** */
                $params = array(
                    'institucion_nombre' => $this->input->post('institucion_nombre'),
                    'institucion_sucursal' => $this->input->post('institucion_sucursal'),
                    'institucion_direccion' => $this->input->post('institucion_direccion'),
                    'institucion_ubicacion' => $this->input->post('institucion_ubicacion'),
                    'institucion_telef' => $this->input->post('institucion_telef'),
                    'institucion_nit' => $this->input->post('institucion_nit'),
                    'institucion_autorizacion' => $this->input->post('institucion_autorizacion'),
                    'institucion_eslogan' => $this->input->post('institucion_eslogan'),
                    'institucion_logo' => $foto,
                );

                $institucion_id = $this->Institucion_model->add_institucion($params);
                redirect('institucion');
            }
            else
            {            
                $data['_view'] = 'institucion/add';
                $this->load->view('layouts/main',$data);
            }
        }
    }  

    /*
     * Editing a institucion
     */
    function edit($institucion_id)
    {
        $this->Institucion_model->bitacora("ACCESO A MODULO","EDIT INSTITUCION");
        if($this->acceso(1)){
            // check if the institucion exists before trying to edit it
            $data['institucion'] = $this->Institucion_model->get_institucion($institucion_id);

            if(isset($data['institucion']['institucion_id']))
            {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('institucion_nombre','Institución Nombre','trim|required', array('required' => 'Este Campo no debe ser vacio'));
                if($this->form_validation->run())     
                {   
                    $foto="";
                        $foto1= $this->input->post('proveedor_foto1');
                    if (!empty($_FILES['institucion_logo']['name']))
                    {
                        $this->load->library('image_lib');
                        $config['upload_path'] = './resources/images/empresas/';
                        $config['allowed_types'] = 'gif|jpeg|jpg|png';
                        $config['max_size'] = 200000;
                        $config['max_width'] = 2900;
                        $config['max_height'] = 2900;

                        $new_name = time();
                        $config['file_name'] = $new_name;
                        $config['file_ext_tolower'] = TRUE;

                        $this->load->library('upload', $config);
                        $this->upload->do_upload('institucion_logo');

                        $img_data = $this->upload->data();
                        $extension = $img_data['file_ext'];
                        /* ********************INICIO para resize***************************** */
                        if($img_data['file_ext'] == ".jpg" || $img_data['file_ext'] == ".png" || $img_data['file_ext'] == ".jpeg" || $img_data['file_ext'] == ".gif") {
                            $conf['image_library'] = 'gd2';
                            $conf['source_image'] = $img_data['full_path'];
                            $conf['new_image'] = './resources/images/empresas/';
                            $conf['maintain_ratio'] = TRUE;
                            $conf['create_thumb'] = FALSE;
                            $conf['width'] = 800;
                            $conf['height'] = 600;
                            $this->image_lib->clear();
                            $this->image_lib->initialize($conf);
                            if(!$this->image_lib->resize()){
                                echo $this->image_lib->display_errors('','');
                            }
                        }
                        /* ********************F I N  para resize***************************** */
                        //$directorio = base_url().'resources/imagenes/';
                        $directorio = $_SERVER['DOCUMENT_ROOT'].'/ximpleman_web/resources/images/empresas/';
                        if(isset($foto1) && !empty($foto1)){
                          if(file_exists($directorio.$foto1)){
                              unlink($directorio.$foto1);
                              $mimagenthumb = str_replace(".", "_thumb.", $foto1);
                              unlink($directorio.$mimagenthumb);
                          }
                      }
                        $confi['image_library'] = 'gd2';
                        $confi['source_image'] = './resources/images/empresas/'.$new_name.$extension;
                        $confi['new_image'] = './resources/images/empresas/'."thumb_".$new_name.$extension;
                        $confi['create_thumb'] = FALSE;
                        $confi['maintain_ratio'] = TRUE;
                        $confi['width'] = 50;
                        $confi['height'] = 50;

                        $this->image_lib->clear();
                        $this->image_lib->initialize($confi);
                        $this->image_lib->resize();

                        $foto = $new_name.$extension;
                    }else{
                        $foto = $foto1;
                    }
                /* *********************FIN imagen***************************** */
                    $params = array(
                        'institucion_nombre' => $this->input->post('institucion_nombre'),
                        'institucion_sucursal' => $this->input->post('institucion_sucursal'),
                        'institucion_direccion' => $this->input->post('institucion_direccion'),
                        'institucion_ubicacion' => $this->input->post('institucion_ubicacion'),
                        'institucion_telef' => $this->input->post('institucion_telef'),
                        'institucion_nit' => $this->input->post('institucion_nit'),
                        'institucion_autorizacion' => $this->input->post('institucion_autorizacion'),
                        'institucion_eslogan' => $this->input->post('institucion_eslogan'),
                        'institucion_logo' => $foto,
                    );

                    $this->Institucion_model->update_institucion($institucion_id,$params);            
                    redirect('institucion/index');
                }
                else
                {
                    $data['_view'] = 'institucion/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('The institucion you are trying to edit does not exist.');
        }
    }
}
