<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Proveedor extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Proveedor_model');
        $this->load->model('Responsable_model');
    } 

    /*
     * Listing of proveedor
     */
     
    function index()
    {
        
        $data['a'] = "0";
        $data['proveedor'] = $this->Proveedor_model->get_all_proveedor();
        
        $data['_view'] = 'proveedor/index';
        $this->load->view('layouts/main',$data);
            
    }

    /*
     * Adding a new proveedor
     */
    function add()
    {   
         
        $this->load->library('form_validation');

        $this->form_validation->set_rules('proveedor_codigo','Proveedor Codigo','required');
        $this->form_validation->set_rules('proveedor_nombre','Proveedor Nombre','required');
        
        if($this->form_validation->run())     
        {   

            /* *********************INICIO imagen***************************** */
            $foto="";
            if (!empty($_FILES['chivo']['name'])){
                        $this->load->library('image_lib');
                        $config['upload_path'] = './resources/images/proveedores/';
                        $img_full_path = $config['upload_path'];

                        $config['allowed_types'] = 'gif|jpeg|jpg|png';
                        $config['max_size'] = 200000;
                        $config['max_width'] = 2900;
                        $config['max_height'] = 2900;
                        
                        $new_name = time();
                    $config['file_name'] = $new_name;
                        $config['file_ext_tolower'] = TRUE;

                        $this->load->library('upload', $config);
                        $this->upload->do_upload('chivo');

                        $img_data = $this->upload->data();
                        $extension = $img_data['file_ext'];
                        /* ********************INICIO para resize***************************** */
                        if ($img_data['file_ext'] == ".jpg" || $img_data['file_ext'] == ".png" || $img_data['file_ext'] == ".jpeg" || $img_data['file_ext'] == ".gif") {
                            $conf['image_library'] = 'gd2';
                            $conf['source_image'] = $img_data['full_path'];
                            $conf['new_image'] = './resources/images/proveedores/';
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
                        $confi['source_image'] = './resources/images/proveedores/'.$new_name.$extension;
                        $confi['new_image'] = './resources/images/proveedores/'."thumb_".$new_name.$extension;
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
            $estado = 1;
            $params = array(
                'estado_id' => $estado,
                'proveedor_codigo' => $this->input->post('proveedor_codigo'),
                'proveedor_nombre' => $this->input->post('proveedor_nombre'),
                'proveedor_foto' => $foto,
                'proveedor_contacto' => $this->input->post('proveedor_contacto'),
                'proveedor_direccion' => $this->input->post('proveedor_direccion'),
                'proveedor_telefono' => $this->input->post('proveedor_telefono'),
                'proveedor_telefono2' => $this->input->post('proveedor_telefono2'),
                'proveedor_email' => $this->input->post('proveedor_email'),
                'proveedor_nit' => $this->input->post('proveedor_nit'),
                'proveedor_razon' => $this->input->post('proveedor_razon'),
                'proveedor_autorizacion' => $this->input->post('proveedor_autorizacion'),
            );
            
            $proveedor_id = $this->Proveedor_model->add_proveedor($params);
            $params = array(
                'responsable_nombre' => $this->input->post('proveedor_nombre'),
                'estado_id' => $estado_id,
            );
            
            $responsable_id = $this->Responsable_model->add_responsable($params);
            redirect('proveedor/index');
        }
        else
        {
            $this->load->model('Estado_model');
            $data['all_estado'] = $this->Estado_model->get_all_estado();
            
            $data['_view'] = 'proveedor/add';
            $this->load->view('layouts/main',$data);
        }
           
    }

    function rapido()
    {   
         $this->load->library('form_validation');
        $this->form_validation->set_rules('proveedor_nombre','Proveedor Nombre','required');
        
        if($this->form_validation->run())     
        {   

          if ($this->input->is_ajax_request()) { 
        $compra_id = $this->input->post('compra_id');
        
        $this->load->model('Compra_model');
        $estado= 1;
  
           
            $params = array(
                'estado_id' => $estado,
                'proveedor_codigo' => $this->input->post('proveedor_codigo'),
                'proveedor_nombre' => $this->input->post('proveedor_nombre'),
                'proveedor_foto' => $this->input->post('proveedor_foto'),
                'proveedor_contacto' => $this->input->post('proveedor_contacto'),
                'proveedor_direccion' => $this->input->post('proveedor_direccion'),
                'proveedor_telefono2' => $this->input->post('proveedor_telefono2'),
                'proveedor_telefono' => $this->input->post('proveedor_telefono'),
                'proveedor_email' => $this->input->post('proveedor_email'),
                'proveedor_nit' => $this->input->post('proveedor_nit'),
                'proveedor_razon' => $this->input->post('proveedor_razon'),
                'proveedor_autorizacion' => $this->input->post('proveedor_autorizacion'),
            );

             
           $proveedor_id = $this->Proveedor_model->add_proveedor($params);
          
   $this->Compra_model->cambiar_proveedor($compra_id,$proveedor_id);
        $datos =  $this->Compra_model->get_compra_proveedor($compra_id);
        if(isset($datos)){
                        echo json_encode($datos);
                    }else echo json_encode(null);
    }
        else
        {                 
                    show_404();
        }
        }else{
            echo json_encode(null);
        }

    }


    function cambiarproveedor()
    {   

         if ($this->input->is_ajax_request()) {
       
   
        $proveedor_id = $this->input->post('proveedor_id');
        $compra_id = $this->input->post('compra_id');
        $proveedor_nit = $this->input->post('nit');
       // $proveedor_codigo = $this->input->post('codigo_control');     
        $proveedor_razon = $this->input->post('razon_social');
        
        
        $this->load->model('Compra_model');
            
  
        $this->Compra_model->cambiar_proveedor($compra_id,$proveedor_id);
       
        $datos =  $this->Compra_model->get_compra_proveedor($compra_id);
    
            $sql= "UPDATE proveedor SET proveedor.proveedor_nit='".$proveedor_nit."', proveedor.proveedor_razon='".$proveedor_razon."' WHERE proveedor.proveedor_id=".$proveedor_id." ";
            $this->db->query($sql); 
        

        if(isset($datos)){
                        echo json_encode($datos);
                    }else echo json_encode(null);
    }
        else
        {                 
                    show_404();
        }          
    }

    /*
     * Editing a proveedor
     */
    function edit($proveedor_id)
    {   
        
        // check if the proveedor exists before trying to edit it
        $data['proveedor'] = $this->Proveedor_model->get_proveedor($proveedor_id);
        
        if(isset($data['proveedor']['proveedor_id']))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('proveedor_codigo','Proveedor Codigo','required');
            $this->form_validation->set_rules('proveedor_nombre','Proveedor Nombre','required');
        
            if($this->form_validation->run())     
            {   

             /* *********************INICIO imagen***************************** */
                $foto="";
                    $foto1= $this->input->post('proveedor_foto1');
                if (!empty($_FILES['chivo']['name']))
                {
                    $this->load->library('image_lib');
                    $config['upload_path'] = './resources/images/proveedores/';
                    $config['allowed_types'] = 'gif|jpeg|jpg|png';
                    $config['max_size'] = 200000;
                    $config['max_width'] = 2900;
                    $config['max_height'] = 2900;

                    $new_name = time();
                    $config['file_name'] = $new_name;
                    $config['file_ext_tolower'] = TRUE;

                    $this->load->library('upload', $config);
                    $this->upload->do_upload('chivo');

                    $img_data = $this->upload->data();
                    $extension = $img_data['file_ext'];
                    /* ********************INICIO para resize***************************** */
                    if($img_data['file_ext'] == ".jpg" || $img_data['file_ext'] == ".png" || $img_data['file_ext'] == ".jpeg" || $img_data['file_ext'] == ".gif") {
                        $conf['image_library'] = 'gd2';
                        $conf['source_image'] = $img_data['full_path'];
                        $conf['new_image'] = './resources/images/proveedores/';
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
                    $directorio = $_SERVER['DOCUMENT_ROOT'].'/ximpleman_web/resources/images/proveedores/';
                    if(isset($foto1) && !empty($foto1)){
                      if(file_exists($directorio.$foto1)){
                          unlink($directorio.$foto1);
                          $mimagenthumb = str_replace(".", "_thumb.", $foto1);
                          unlink($directorio.$mimagenthumb);
                      }
                  }
                    $confi['image_library'] = 'gd2';
                    $confi['source_image'] = './resources/images/proveedores/'.$new_name.$extension;
                    $confi['new_image'] = './resources/images/proveedores/'."thumb_".$new_name.$extension;
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
                    'estado_id' => $this->input->post('estado_id'),
                    'proveedor_codigo' => $this->input->post('proveedor_codigo'),
                    'proveedor_nombre' => $this->input->post('proveedor_nombre'),
                    'proveedor_foto' => $foto,
                    'proveedor_contacto' => $this->input->post('proveedor_contacto'),
                    'proveedor_direccion' => $this->input->post('proveedor_direccion'),
                    'proveedor_telefono' => $this->input->post('proveedor_telefono'),
                    'proveedor_telefono2' => $this->input->post('proveedor_telefono2'),
                    'proveedor_email' => $this->input->post('proveedor_email'),
                    'proveedor_nit' => $this->input->post('proveedor_nit'),
                    'proveedor_razon' => $this->input->post('proveedor_razon'),
                    'proveedor_autorizacion' => $this->input->post('proveedor_autorizacion'),
                );

                $this->Proveedor_model->update_proveedor($proveedor_id,$params);
                 $params = array(
                    'responsable_nombre' => $this->input->post('proveedor_nombre'),
                    'estado_id' => $this->input->post('estado_id'),
                );

                $this->Responsable_model->update_responsable($proveedor_id,$params);            
                redirect('proveedor/index');

            }
            else
            {
                $this->load->model('Estado_model');
                $data['all_estado'] = $this->Estado_model->get_all_estado();

                $data['_view'] = 'proveedor/edit';
                $this->load->view('layouts/main',$data);
            }
       
        }
    }


    /*
     * Deleting proveedor
     */
    function remove($proveedor_id)
    {
        $proveedor = $this->Proveedor_model->get_proveedor($proveedor_id);

        // check if the proveedor exists before trying to delete it
        if(isset($proveedor['proveedor_id']))
        {
            $this->Proveedor_model->delete_proveedor($proveedor_id);
            redirect('proveedor/index');
        }
        else
            show_error('The proveedor you are trying to delete does not exist.');
    }
    /* *********Busca proveedores*********** */
    function buscarproveedor($filtro)
    {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            if($session_data['tipousuario_id']==1) {
                $data = array(
                    'page_title' => 'Admin >> Mi Cuenta'
                );
                
                $data['proveedor'] = $this->Proveedor_model->get_busqueda_proveedor($filtro);
                $data['a'] = "1";
                $data['_view'] = 'proveedor/index';
                $this->load->view('layouts/main',$data);
            }
            else{
                redirect('alerta');
            }
        } else {
            redirect('', 'refresh');
        }
    }
}
