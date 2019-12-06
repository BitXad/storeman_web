<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Salida extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Salida_model');
        $this->load->model('Unidad_model');
        $this->load->model('Programa_model');
        $this->load->model('Estado_model');
        $this->load->model('Detalle_salida_model');
        $this->load->model('Inventario_model');
        date_default_timezone_set("America/La_Paz");
        $this->load->helper('numeros');
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
     * Listing of salida
     */
    
    function index()
    {
        if($this->acceso(33)){
            $data['usuario_nombre'] = $this->session_data['usuario_nombre'];
            //$data['usuario_nombre'] = "Jacquelinne Alacoria F.";

            $data['salida'] = $this->Salida_model->get_all_salida();
            $data['all_unidad'] = $this->Unidad_model->get_all_unidad();
            $data['all_programa'] = $this->Programa_model->get_all_programa();
            $data['all_estado'] = $this->Estado_model->get_all_estado();

            $this->load->model('Institucion_model');
            $data['institucion'] = $this->Institucion_model->get_all_institucion();

            $data['_view'] = 'salida/index';
            $this->load->view('layouts/main',$data);
        }
    }
    /*
     * Adding a new salida
     */
    function add()
    {
        if($this->acceso(32)){
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
                                    'estado_id' => $this->input->post('estado_id'),
                                    'programa_id' => $this->input->post('programa_id'),
                                    'unidad_id' => $this->input->post('unidad_id'),
                                    'gestion_id' => $this->input->post('gestion_id'),
                                    'usuario_id' => $this->input->post('usuario_id'),
                                    'salida_motivo' => $this->input->post('salida_motivo'),
                                    'salida_fechasal' => $this->input->post('salida_fechasal'),
                                    'salida_acta' => $this->input->post('salida_acta'),
                                    'salida_obs' => $this->input->post('salida_obs'),
                                    'salida_fecha' => $this->input->post('salida_fecha'),
                                    'salida_doc' => $this->input->post('salida_doc'),
                                    'salida_hora' => $this->input->post('salida_hora'),
                );

                $salida_id = $this->Salida_model->add_salida($params);
                redirect('salida/index');
            }
            else
            {
                            $this->load->model('Estado_model');
                            $data['all_estado'] = $this->Estado_model->get_all_estado();

                            $this->load->model('Programa_model');
                            $data['all_programa'] = $this->Programa_model->get_all_programa();

                            $this->load->model('Unidad_model');
                            $data['all_unidad'] = $this->Unidad_model->get_all_unidad();

                            $this->load->model('Gestion_model');
                            $data['all_gestion'] = $this->Gestion_model->get_all_gestion();

                            $this->load->model('Usuario_model');
                            $data['all_usuario'] = $this->Usuario_model->get_all_usuario();

                $data['_view'] = 'salida/add';
                $this->load->view('layouts/main',$data);
            }
        
        }
    }  


    /*
     * Eliminar item de detalle
     */
    function eliminaritem($detallesal_id)
    {
//        if ($this->session->userdata('logged_in')) {
//            $session_data = $this->session->userdata('logged_in');
//            if($session_data['tipousuario_id']>=1 and $session_data['tipousuario_id']<=4) {
//                $data = array(
//                    'page_title' => 'Admin >> Mi Cuenta'
//                );
        //**************** inicio contenido ***************        

        $sql = "delete from detalle_salida_aux where detallesal_id = ".$detallesal_id;
        $this->Salida_model->ejecutar($sql);
        return true;
            		
        //**************** fin contenido ***************
//        			}
//        			else{ redirect('alerta'); }
//        } else { redirect('', 'refresh'); }
//        
    }
    

    /*
     * Eliminar todos los items
     */
    function eliminartodo()
    {
//        if ($this->session->userdata('logged_in')) {
//            $session_data = $this->session->userdata('logged_in');
//            if($session_data['tipousuario_id']>=1 and $session_data['tipousuario_id']<=4) {
//                $data = array(
//                    'page_title' => 'Admin >> Mi Cuenta'
//                );
        //**************** inicio contenido ***************  
        $usuario_id = $this->session_data['usuario_id'];
        //$usuario_id = 1; //$session_data['usuario_id'];
        $sql = "delete from detalle_salida_aux where usuario_id = ".$usuario_id;
        $this->Salida_model->ejecutar($sql);
        return true;
            		
        //**************** fin contenido ***************
//        			}
//        			else{ redirect('alerta'); }
//        } else { redirect('', 'refresh'); }
        
    }    
    /*
     * Registrar salida
     */
    function registrar_salida()
    {
            $fecha_actual = date('Y-m-d');
            $hora_actual = date('H:i:s');
            
            $estado_id = 1;
            $programa_id = 0;
            $unidad_id = 0;
            $usuario_id = $this->session_data['usuario_id'];
            $gestion_id = $this->session_data['gestion_id'];
            $salida_motivo = "-";
            $salida_fechasal = date('Y-m-d');
            $salida_acta = "-";
            $salida_obs = "-";
            $salida_fecha = $fecha_actual;
            $salida_doc = "-";
            $salida_hora = $hora_actual;
                                        
            $params = array(
                'estado_id' => $estado_id,
                'programa_id' => $programa_id,
                'unidad_id' => $unidad_id,
                'gestion_id' => $gestion_id,
                'usuario_id' => $usuario_id,
                'salida_motivo' => $salida_motivo,
                'salida_fechasal' => $salida_fechasal,
                'salida_acta' => $salida_acta,
                'salida_obs' => $salida_obs,
                'salida_fecha' => $salida_fecha,
                'salida_doc' => $salida_doc,
                'salida_hora' => $salida_hora,
            );
            
            $salida_id = $this->Salida_model->add_salida($params);
            redirect('salida/nueva_salida/'.$salida_id);

    }  
    
    
    /*
     * Adding a new salida
     */
    function nueva_salida($salida_id)
    {
        if($this->acceso(32)){
            $gestion_id = $this->session_data['gestion_id'];
            $usuario_id = $this->session_data['usuario_id'];

            $data['salida_id'] = $salida_id;
            $data['gestion_id'] = $gestion_id;
            $data['usuario_id'] = $usuario_id;
            $data['bandera'] = 0; //registrar nueva salida
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
                                    'estado_id' => $this->input->post('estado_id'),
                                    'programa_id' => $this->input->post('programa_id'),
                                    'unidad_id' => $this->input->post('unidad_id'),
                                    'gestion_id' => $this->input->post('gestion_id'),
                                    'usuario_id' => $this->input->post('usuario_id'),
                                    'salida_motivo' => $this->input->post('salida_motivo'),
                                    'salida_fechasal' => $this->input->post('salida_fechasal'),
                                    'salida_acta' => $this->input->post('salida_acta'),
                                    'salida_obs' => $this->input->post('salida_obs'),
                                    'salida_fecha' => $this->input->post('salida_fecha'),
                                    'salida_doc' => $this->input->post('salida_doc'),
                                    'salida_hora' => $this->input->post('salida_hora'),
                );

                $salida_id = $this->Salida_model->add_salida($params);
                redirect('salida/index');
            }
            else
            {

                $this->load->model('Salida_model');
                $data['salida'] = $this->Salida_model->get_salida_by_id($salida_id);

                $this->load->model('Programa_model');
                $data['all_programa'] = $this->Programa_model->get_all_programa();

                $this->load->model('Categoria_model');
                $data['all_categoria'] = $this->Categoria_model->get_all_categoria();

                $this->load->model('Unidad_model');
                $data['all_unidad'] = $this->Unidad_model->get_all_unidad();

                $data['_view'] = 'salida/nueva_salida';
                $this->load->view('layouts/main',$data);


            }
        }
    }  
    
   
    
    /*
     * Adding a new salida
     */
    function modificar_salida($salida_id)
    {
        if($this->acceso(35)){
            
            $gestion_id = $this->session_data['gestion_id'];
            $usuario_id = $this->session_data['usuario_id'];

            $data['salida_id'] = $salida_id;
            $data['gestion_id'] = $gestion_id;
            $data['usuario_id'] = $usuario_id;
            $data['bandera'] = 1; //modificar

            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
                    'estado_id' => $this->input->post('estado_id'),
                    'programa_id' => $this->input->post('programa_id'),
                    'unidad_id' => $this->input->post('unidad_id'),
                    'gestion_id' => $this->input->post('gestion_id'),
                    'usuario_id' => $this->input->post('usuario_id'),
                    'salida_motivo' => $this->input->post('salida_motivo'),
                    'salida_fechasal' => $this->input->post('salida_fechasal'),
                    'salida_acta' => $this->input->post('salida_acta'),
                    'salida_obs' => $this->input->post('salida_obs'),
                    'salida_fecha' => $this->input->post('salida_fecha'),
                    'salida_doc' => $this->input->post('salida_doc'),
                    'salida_hora' => $this->input->post('salida_hora'),
                );

                $salida_id = $this->Salida_model->add_salida($params);
                redirect('salida/index');
            }
            else
            {
                $this->load->model('Salida_model');

                $sql = "delete from detalle_salida_aux where usuario_id=".$usuario_id;
                $this->Salida_model->ejecutar($sql);
                
                $data['salida'] = $this->Salida_model->get_salida_by_id($salida_id);
                $this->Salida_model->cargar_detalle_salida($usuario_id,$salida_id);

                $this->load->model('Programa_model');
                $data['all_programa'] = $this->Programa_model->get_all_programa();

                $this->load->model('Categoria_model');
                $data['all_categoria'] = $this->Categoria_model->get_all_categoria();

                $this->load->model('Unidad_model');
                $data['all_unidad'] = $this->Unidad_model->get_all_unidad();

                $data['_view'] = 'salida/nueva_salida';
                $this->load->view('layouts/main',$data);


            }
        }
    }  
    
   
    /*
     * Editing a salida
     */
    function edit($salida_id)
    {
        if($this->acceso(35)){
            // check if the salida exists before trying to edit it
            $data['salida'] = $this->Salida_model->get_salida_by_id($salida_id);
            if(isset($data['salida']['salida_id']))
            {
                if(isset($_POST) && count($_POST) > 0)     
                {   
                    $params = array(
                        'estado_id' => $this->input->post('estado_id'),
                        'programa_id' => $this->input->post('programa_id'),
                        'unidad_id' => $this->input->post('unidad_id'),
                        'gestion_id' => $this->input->post('gestion_id'),
                        'usuario_id' => $this->input->post('usuario_id'),
                        'salida_motivo' => $this->input->post('salida_motivo'),
                        'salida_fechasal' => $this->input->post('salida_fechasal'),
                        'salida_acta' => $this->input->post('salida_acta'),
                        'salida_obs' => $this->input->post('salida_obs'),
                        'salida_fecha' => $this->input->post('salida_fecha'),
                        'salida_doc' => $this->input->post('salida_doc'),
                        'salida_hora' => $this->input->post('salida_hora'),
                    );

                    $this->Salida_model->update_salida($salida_id,$params);            
                    redirect('salida/index');
                }
                else
                {
                    $this->load->model('Estado_model');
                    $data['all_estado'] = $this->Estado_model->get_all_estado();

                    $this->load->model('Programa_model');
                    $data['all_programa'] = $this->Programa_model->get_all_programa();

                    $this->load->model('Unidad_model');
                    $data['all_unidad'] = $this->Unidad_model->get_all_unidad();

                    $this->load->model('Gestion_model');
                    $data['all_gestion'] = $this->Gestion_model->get_all_gestion();

                    $this->load->model('Usuario_model');
                    $data['all_usuario'] = $this->Usuario_model->get_all_usuario();

                    $data['_view'] = 'salida/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('The salida you are trying to edit does not exist.');
        }
    }

    /*
     * Deleting salida
     */
    function remove($salida_id)
    {
        $salida = $this->Salida_model->get_salida($salida_id);

        // check if the salida exists before trying to delete it
        if(isset($salida['salida_id']))
        {
            $this->Salida_model->delete_salida($salida_id);
            redirect('salida/index');
        }
        else
            show_error('The salida you are trying to delete does not exist.');
    }

    /*
    * buscar productos
    */
    function buscarproductos()
    {
    //        if ($this->session->userdata('logged_in')) {
    //            $session_data = $this->session->userdata('logged_in');
    //            if($session_data['tipousuario_id']>=1 and $session_data['tipousuario_id']<=4) {
    //                $data = array(
    //                    'page_title' => 'Admin >> Mi Cuenta'
    //                );
            //**************** inicio contenido ***************    

            $usuario_id = $this->session_data['usuario_id'];
            $gestion_id = $this->session_data['gestion_id'];

            if ($this->input->is_ajax_request()) {

                $parametro = $this->input->post('parametro');   
                $programa_id = $this->input->post('programa_id');   
                $unidad_id = $this->input->post('unidad_id');   

                if ($parametro!=""){
                    $datos = $this->Inventario_model->get_inventario_parametro($parametro,$gestion_id);            
                    echo json_encode($datos);
                }
                else {echo json_encode(null);}
            }
            else
            {                 
                show_404();
            }   

            //**************** fin contenido ***************
    //        			}
    //        			else{ redirect('alerta'); }
    //        } else { redirect('', 'refresh'); }        

    }
    /*
    * buscar productos por unidad y programa
    */
    function buscar_unidad_programa()
    {
    //        if ($this->session->userdata('logged_in')) {
    //            $session_data = $this->session->userdata('logged_in');
    //            if($session_data['tipousuario_id']>=1 and $session_data['tipousuario_id']<=4) {
    //                $data = array(
    //                    'page_title' => 'Admin >> Mi Cuenta'
    //                );
            //**************** inicio contenido ***************    

            $usuario_id = $this->session_data['usuario_id'];
            $gestion_id = $this->session_data['gestion_id'];

            if ($this->input->is_ajax_request()) {

                $parametro = $this->input->post('parametro');   
                $unidad_id = 0; $this->input->post('unidad_id');   
                $programa_id = $this->input->post('programa_id');   
                $categoria_id = $this->input->post('categoria_id');   
                    //echo "unidad:".$unidad_id." programa:".$programa_id;
                
                $datos = $this->Inventario_model->get_inventario_programa_unidad($unidad_id,$programa_id,$parametro,$gestion_id,$categoria_id);            
                echo json_encode($datos);
                
            }
            else
            {                 
                show_404();
            }   

            //**************** fin contenido ***************
    //        			}
    //        			else{ redirect('alerta'); }
    //        } else { redirect('', 'refresh'); }        

    }
    
    
    function buscar_unidad()
    {
    //        if ($this->session->userdata('logged_in')) {
    //            $session_data = $this->session->userdata('logged_in');
    //            if($session_data['tipousuario_id']>=1 and $session_data['tipousuario_id']<=4) {
    //                $data = array(
    //                    'page_title' => 'Admin >> Mi Cuenta'
    //                );
            //**************** inicio contenido ***************    

            $usuario_id = $this->session_data['usuario_id'];
            $gestion_id = $this->session_data['gestion_id'];

            if ($this->input->is_ajax_request()) {

                $parametro = $this->input->post('parametro');   
                $unidad_id = $this->input->post('unidad_id');   
                $programa_id = $this->input->post('programa_id');   
                    //echo "unidad:".$unidad_id." programa:".$programa_id;
                
                $datos = $this->Inventario_model->get_inventario_unidad($unidad_id,$parametro,$gestion_id);            
                echo json_encode($datos);
                
            }
            else
            {                 
                show_404();
            }   

            //**************** fin contenido ***************
    //        			}
    //        			else{ redirect('alerta'); }
    //        } else { redirect('', 'refresh'); }        

    }
    
    function buscar_programa()
    {
    //        if ($this->session->userdata('logged_in')) {
    //            $session_data = $this->session->userdata('logged_in');
    //            if($session_data['tipousuario_id']>=1 and $session_data['tipousuario_id']<=4) {
    //                $data = array(
    //                    'page_title' => 'Admin >> Mi Cuenta'
    //                );
            //**************** inicio contenido ***************    

            $usuario_id = $this->session_data['usuario_id'];
            $gestion_id = $this->session_data['gestion_id'];

            if ($this->input->is_ajax_request()) {

                $parametro = $this->input->post('parametro');   
                $unidad_id = $this->input->post('unidad_id');   
                $programa_id = $this->input->post('programa_id');   
                    //echo "unidad:".$unidad_id." programa:".$programa_id;
                
                $datos = $this->Inventario_model->get_inventario_programa_unidad($unidad_id,$programa_id,$parametro,$gestion_id);            
                echo json_encode($datos);
                
            }
            else
            {                 
                show_404();
            }   

            //**************** fin contenido ***************
    //        			}
    //        			else{ redirect('alerta'); }
    //        } else { redirect('', 'refresh'); }        

    }

function incrementar()
    {
        
        //**************** inicio contenido ***************        
        
        $detallesal_id = $this->input->post('detallesal_id');
        $cantidad = $this->input->post('cantidad');
        $descuento = 0;
        
            $sql = "update detalle_salida_aux set detallesal_cantidad = detallesal_cantidad + ".$cantidad.
            
                    ", detallesal_total = (detallesal_precio - ".$descuento.")*(detallesal_cantidad)".
                    "  where detallesal_id = ".$detallesal_id;
            
        $this->Salida_model->ejecutar($sql);
        return true;
        
                
        //**************** fin contenido ***************
     
              
        
    }
function reducir()
    {
      
        
        //**************** inicio contenido ***************
        
        
        $detallesal_id = $this->input->post('detallesal_id');
        $cantidad = $this->input->post('cantidad');
        $descuento = 0;
        
            $sql = "update detalle_salida_aux set detallesal_cantidad = detallesal_cantidad - ".$cantidad.
                   
                    ", detallesal_total = (detallesal_precio - ".$descuento.")*(detallesal_cantidad)".
                    "  where detallesal_id = ".$detallesal_id;
            
        $this->Salida_model->ejecutar($sql);
        return true;
                    
        //**************** fin contenido ***************
      
                    
        
    }
/*
* buscar productos por categoria de productos
*/
function buscarcategorias()
{
//        if ($this->session->userdata('logged_in')) {
//            $session_data = $this->session->userdata('logged_in');
//            if($session_data['tipousuario_id']>=1 and $session_data['tipousuario_id']<=4) {
//                $data = array(
//                    'page_title' => 'Admin >> Mi Cuenta'
//                );
        //**************** inicio contenido ***************   
   
        $usuario_id = $this->session_data['usuario_id'];
        $gestion_id = $this->session_data['gestion_id'];;

        if ($this->input->is_ajax_request()) {
            
            $parametro = $this->input->post('parametro');   
            
            if ($parametro!=""){
            $datos = $this->Inventario_model->get_inventario_categoria($parametro,$gestion_id);            
            //$datos = $this->Inventario_model->get_inventario_bloque();
            echo json_encode($datos);
            }
            else echo json_encode(null);
        }
        else
        {                 
            show_404();
        }      
        		
        //**************** fin contenido ***************
//        			}
//        			else{ redirect('alerta'); }
//        } else { redirect('', 'refresh'); }        
}
    

    /*
     * Mostrar detalle de venta
     */
    function detallesalida()
    {
//
//        if ($this->session->userdata('logged_in')) {
//            $session_data = $this->session->userdata('logged_in');
//            if($session_data['tipousuario_id']>=1 and $session_data['tipousuario_id']<=4) {
//                $data = array(
//                    'page_title' => 'Admin >> Mi Cuenta'
//                );
        //**************** inicio contenido ***************
        
        
        $usuario_id = $this->session_data['usuario_id'];
        $salida_id = $this->input->post('salida_id'); 
        
        if ($this->input->is_ajax_request()) {

            //$sql = "select * from detalle_salida_aux where usuario_id=".$usuario_id;
            //$datos = $this->Venta_model->consultar($sql);
            $datos = $this->Salida_model->get_detalle_aux($usuario_id,$salida_id);
            
            echo json_encode($datos);
            
        }
        else
        {                 
                    show_404();
        }  
        		
        //**************** fin contenido ***************
//        			}
//        			else{ redirect('alerta'); }
//        } else { redirect('', 'refresh'); }
//               
    }


    function existencia()
    {       
//         if ($this->session->userdata('logged_in')) {
//            $session_data = $this->session->userdata('logged_in');
//            if($session_data['tipousuario_id']>=1 and $session_data['tipousuario_id']<=4) {
//                $data = array(
//                    'page_title' => 'Admin >> Mi Cuenta'
//                );
//        //**************** inicio contenido ***************       
        
        //$usuario_id = $this->session_data['usuario_id'];        
        //$articulo_id = $this->input->post('articulo_id');
        $detalleing_id = $this->input->post('detalleing_id');
        
        $sql =  "select detalleing_saldo as 'existencia' from detalle_ingreso "
                . " where detalleing_id =".$detalleing_id;
        
        $resultado = $this->Salida_model->consultar($sql);
        echo json_encode($resultado);
    
            		
        //**************** fin contenido ***************
//        			}
//        			else{ redirect('alerta'); }
//        } else { redirect('', 'refresh'); }
    }        
    
   function cantidad_en_detalle()
    {       
//         if ($this->session->userdata('logged_in')) {
//            $session_data = $this->session->userdata('logged_in');
//            if($session_data['tipousuario_id']>=1 and $session_data['tipousuario_id']<=4) {
//                $data = array(
//                    'page_title' => 'Admin >> Mi Cuenta'
//                );
//        //**************** inicio contenido ***************       
        
        //$usuario_id = $this->session_data['usuario_id'];
        
        $articulo_id = $this->input->post('detalleing_id');
        
        $sql =  "select if(sum(detallesal_cantidad)>0,sum(detallesal_cantidad),0) as cantidad from detalle_salida_aux "
                . " where detalleing_id =".$articulo_id;
        
        $resultado = $this->Salida_model->consultar($sql);
        echo json_encode($resultado);
    
//            		
//        //**************** fin contenido ***************
//        			}
//        			else{ redirect('alerta'); }
//        } else { redirect('', 'refresh'); }    
//        
    }    
    
    function insertar_producto()
    {       
//        if ($this->session->userdata('logged_in')) {
//            $session_data = $this->session->userdata('logged_in');
//            if($session_data['tipousuario_id']>=1 and $session_data['tipousuario_id']<=4) {
//                $data = array(
//                    'page_title' => 'Admin >> Mi Cuenta'
//                );
        //**************** inicio contenido ***************        
        
//             if ($this->input->is_ajax_request()) {   
//                 
                $usuario_id = $this->session_data['usuario_id'];
                $articulo_id = $this->input->post('articulo_idx');
                $cantidad = $this->input->post('cantidadx');
                $existencia = $this->input->post('existenciax');
                $salida_id = $this->input->post('salida_id');
                $detalleing_id = $this->input->post('detalleing_id');
                
            $sql = "insert into detalle_salida_aux(
                        salida_id,
                        articulo_id,
                        programa_id,
                        detallesal_cantidad,
                        detallesal_precio,
                        detallesal_total,
                        usuario_id,
                        detalleing_id
                    ) 
                    ( select 
                        ".$salida_id.",
                        a.articulo_id,
                        0,
                        ".$cantidad.",
                        d.detalleing_precio,
                        d.detalleing_precio*".$cantidad.",                        
                        ".$usuario_id.",
                        ".$detalleing_id." 
                        from articulo a, detalle_ingreso d
                        where a.articulo_id = d.articulo_id and a.articulo_id = ".$articulo_id."
                            and d.detalleing_id = ".$detalleing_id."
                    )";
//            }
//            echo $sql;
            $this->Salida_model->ejecutar($sql);
            
            $result = 1;
            echo '[{"cliente_id":"'.$result.'"}]';
            
//                    }
//                else
//                {                 
//                            show_404();
//                }  
            
            
        //}
        //else { $result = 0;  echo '[{"cliente_id":"'.$result.'"}]';}
            
        //**************** fin contenido ***************
//        }
//        else{ redirect('alerta'); }
//        } else { redirect('', 'refresh'); }           
               
    }
    
 function finalizar_salida()
    {       
//        if ($this->session->userdata('logged_in')) {
//            $session_data = $this->session->userdata('logged_in');
//            if($session_data['tipousuario_id']>=1 and $session_data['tipousuario_id']<=4) {
//                $data = array(
//                    'page_title' => 'Admin >> Mi Cuenta'
//                );
        //**************** inicio contenido ***************        
        
             if ($this->input->is_ajax_request()) {   
                 
                $usuario_id = $this->session_data['usuario_id'];
                $gestion_id = $this->session_data['gestion_id'];
                
                
                $salida_id = $this->input->post('salida_id'); 

                
                $programa_id = $this->input->post('programa_id');
                $unidad_id = $this->input->post('unidad_id');
                $salida_motivo = $this->input->post('salida_motivo');
                $salida_fechasal = $this->input->post('salida_fechasal');
                $salida_acta = $this->input->post('salida_acta');
                $salida_obs = $this->input->post('salida_obs');
                $salida_fecha = date('Y-m-d');
                $salida_hora = date('H:i:s');
                $salida_doc = $this->input->post('salida_doc');
                $salida_total = $this->input->post('salida_total');
                $bandera = $this->input->post('bandera');
                $estado_id = 3; //vigente
              
                
                if($bandera==1) //si la bandera en 1 significa que es una operacion de modificación
                {   //entonces se debe elimiar el contenido del detalle

                    $salida = "SELECT detalleing_id, detallesal_cantidad FROM detalle_salida WHERE salida_id = ".$salida_id;
               $detalles = $this->db->query($salida)->result_array();
               foreach ($detalles as $dev) {
                 
               $devolver = "update detalle_ingreso set 
               detalleing_salida = detalleing_salida-".$dev["detallesal_cantidad"]."
               ,detalleing_saldo = detalleing_saldo+".$dev["detallesal_cantidad"]."
               where detalleing_id = ".$dev["detalleing_id"];
               $this->Salida_model->ejecutar($devolver);
               }
                    $sql = "delete from detalle_salida where salida_id = ".$salida_id;
                    $this->Salida_model->ejecutar($sql);
                }
                    
                
                $sql = "update salida set ".
                "programa_id = ".$programa_id.
                ",unidad_id = ".$unidad_id.
                ",salida_motivo = '".$salida_motivo."'".
                ",salida_fechasal = '".$salida_fechasal."'".
                ",salida_acta = '".$salida_acta."'".
                ",salida_obs = '".$salida_obs."'".
                ",salida_fecha = '".$salida_fecha."'".
                ",salida_hora = '".$salida_hora."'".
                ",salida_doc = '".$salida_doc."'".
                ",salida_total = ".$salida_total.
                ",estado_id = ".$estado_id.
                ",salida_modificado = ".$bandera.
                " where salida_id = ".$salida_id;
  
               //echo $sql;
               $this->Salida_model->ejecutar($sql);

            $sql = "
                    insert into detalle_salida(
                    salida_id,
                    articulo_id,
                    programa_id,
                    detallesal_cantidad,
                    detallesal_precio,
                    detallesal_total,
                    detalleing_id
                    )

                    (
                    select 

                    salida_id,
                    articulo_id,
                    programa_id,
                    detallesal_cantidad,
                    detallesal_precio,
                    detallesal_total,
                    detalleing_id
                    from detalle_salida_aux
                    where salida_id = ".$salida_id.")";

           //echo $sql;
           $this->Salida_model->ejecutar($sql);
           
           
           $sql ="update detalle_ingreso i, detalle_salida_aux s set 
                    i.detalleing_salida = i.detalleing_salida + s.detallesal_cantidad,
                    i.detalleing_saldo = i.detalleing_saldo - s.detallesal_cantidad
                    where
                    s.usuario_id = ".$usuario_id." and
                    i.detalleing_id = s.detalleing_id";
           $this->Salida_model->ejecutar($sql);
            
           $sql = "delete from detalle_salida_aux where usuario_id =".$usuario_id;
           $this->Salida_model->ejecutar($sql);
                    
            $result = 1;

        }
        else { $result = 0;  echo '[{"result    ":"'.$result.'"}]';}

    }    


    function anular_salida($salida_id)
    {   
        if($this->acceso(37)){
                $sql = "update salida set ".
                "salida_total = 0".
                ",estado_id = 5".
                ",salida_modificado = 1".
                " where salida_id = ".$salida_id;
               $this->Salida_model->ejecutar($sql);

               $salida = "SELECT detalleing_id, detallesal_cantidad FROM detalle_salida WHERE salida_id = ".$salida_id;
               $detalles = $this->db->query($salida)->result_array();
               foreach ($detalles as $dev) {
                 
               $devolver = "update detalle_ingreso set 
               detalleing_salida = detalleing_salida-".$dev["detallesal_cantidad"]."
               ,detalleing_saldo = detalleing_saldo+".$dev["detallesal_cantidad"]."
               where detalleing_id = ".$dev["detalleing_id"];
               $this->Salida_model->ejecutar($devolver);
               }
               $sql = "update detalle_salida set ".                
                "detallesal_cantidad = 0".
                ",detallesal_precio = 0".
                ",detallesal_total = 0".
                " where salida_id = ".$salida_id;
               $this->Salida_model->ejecutar($sql);
                redirect('salida');
        }
    }    


    function pdf($salida_id)
    {
        if($this->acceso(36)){
        // check if the ingreso exists before trying to edit it
            $data['salida_id'] = $salida_id;
            $data['datos'] = $this->Salida_model->get_salida_completa($salida_id);
            $data['detalle_salida'] = $this->Detalle_salida_model->get_detalle_salida($salida_id);

            $this->load->model('Institucion_model');
            $data['institucion'] = $this->Institucion_model->get_institucion(1);
            
            $data['_view'] = 'salida/pdf';
            $this->load->view('layouts/main',$data);
        }
    }    
    
}
