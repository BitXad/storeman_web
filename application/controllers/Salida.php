<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Salida extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Salida_model');
        $this->load->model('Detalle_salida_model');
        $this->load->model('Inventario_model');
        date_default_timezone_set("America/La_Paz");
        $this->load->helper('numeros');
         
    } 

    /*
     * Listing of salida
     */
    
    function index()
    {
        $data['usuario_nombre'] = "Jacquelinne Alacoria F.";
        $data['salida'] = $this->Salida_model->get_all_salida();
        
        $this->load->model('Institucion_model');
        $data['institucion'] = $this->Institucion_model->get_all_institucion();
        
        $data['_view'] = 'salida/index';
        $this->load->view('layouts/main',$data);
    }
    /*
     * Adding a new salida
     */
    function add()
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
        $usuario_id = 1; //$session_data['usuario_id'];
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
        
        
//        if(isset($_POST) && count($_POST) > 0)     
//        {   

            $fecha_actual = date('Y-m-d');
            $hora_actual = date('H:i:s');
            
            $estado_id = 1;
            $programa_id = 0;
            $unidad_id = 0;
            $gestion_id = 1;
            $usuario_id = 1;
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

//        }
//        else
//        {
//			$this->load->model('Estado_model');
//			$data['all_estado'] = $this->Estado_model->get_all_estado();
//
//			$this->load->model('Programa_model');
//			$data['all_programa'] = $this->Programa_model->get_all_programa();
//
//			$this->load->model('Unidad_model');
//			$data['all_unidad'] = $this->Unidad_model->get_all_unidad();
//
//			$this->load->model('Gestion_model');
//			$data['all_gestion'] = $this->Gestion_model->get_all_gestion();
//
//			$this->load->model('Usuario_model');
//			$data['all_usuario'] = $this->Usuario_model->get_all_usuario();
//            
//            $data['_view'] = 'salida/add';
//            $this->load->view('layouts/main',$data);
//        }
    }  
    
    
    /*
     * Adding a new salida
     */
    function nueva_salida($salida_id)
    {   
        date_default_timezone_set("America/La_Paz");
        
        $gestion_id = 1;
        $usuario_id = 1;
        
        $data['salida_id'] = $salida_id;
        $data['gestion_id'] = $gestion_id;
        $data['usuario_id'] = $usuario_id;
        
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
            $data['salida'] = $this->Salida_model->get_salida($salida_id);
            
            $this->load->model('Programa_model');
            $data['all_programa'] = $this->Programa_model->get_all_programa();

            $this->load->model('Unidad_model');
            $data['all_unidad'] = $this->Unidad_model->get_all_unidad();
            
            $data['_view'] = 'salida/nueva_salida';
            $this->load->view('layouts/main',$data);
        
            
        }
    }  

    /*
     * Editing a salida
     */
    function edit($salida_id)
    {   
        // check if the salida exists before trying to edit it
        $data['salida'] = $this->Salida_model->get_salida($salida_id);
        
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

            $gestion_id = 1;
            $usuario_id = 1;

            if ($this->input->is_ajax_request()) {

                $parametro = $this->input->post('parametro');   

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

            $gestion_id = 1;
            $usuario_id = 1;

            if ($this->input->is_ajax_request()) {

                $parametro = $this->input->post('parametro');   
                $unidad_id = $this->input->post('unidad_id');   
                $programa_id = $this->input->post('programa_id');   
                    //echo "unidad:".$unidad_id." programa:".$programa_id;
                
                $datos = $this->Inventario_model->get_inventario_programa_unidad($unidad_id,$programa_id);            
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
   
        $usuario_id = 1;
        $gestion_id = 1;

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
        
        
        $usuario_id = 1; //$session_data['usuario_id'];
        $salida_id = $this->input->post('salida_id'); 
        
        if ($this->input->is_ajax_request()) {

            //$sql = "select * from detalle_venta_aux where usuario_id=".$usuario_id;
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
        
        $usuario_id = 1;// $session_data['usuario_id'];
        
        $articulo_id = $this->input->post('articulo_id');
        
        $sql =  "select existencia from inventario "
                . " where articulo_id =".$articulo_id;
        
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
        
        $usuario_id = 1;//$session_data['usuario_id'];
        
        $articulo_id = $this->input->post('articulo_id');
        
        $sql =  "select if(sum(detallesal_cantidad)>0,sum(detallesal_cantidad),0) as cantidad from detalle_salida_aux "
                . " where articulo_id =".$articulo_id;
        
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
                $usuario_id = 1; //$session_data['usuario_id'];
                $articulo_id = $this->input->post('articulo_idx');
                $cantidad = $this->input->post('cantidadx');
                $existencia = $this->input->post('existenciax');
                $salida_id = $this->input->post('salida_id');
                $detalleing_id = $this->input->post('detalleing_id');

//        $sql = "select if(sum(detallesal_cantidad)+".$cantidad.">".$existencia.",1,0) as resultado from detalle_salida_aux where articulo_id = ".$articulo_id;
//        $resultado = $this->Venta_model->consultar($sql);
//        
        //if ($resultado[0]['resultado']==0){ //si la cantidad aun es menor al inventario
        
//            if ($this->Venta_model->existe($articulo_id,$usuario_id)){
//
//
//                $sql = "update detalle_venta_aux set detallesal_cantidad = detallesal_cantidad + ".$cantidad.
//                        ", detallesal_subtotal = detallesal_precio * (detallesal_cantidad)".
//                        ", detallesal_descuento = ".$descuento.
//                        ", detallesal_total = (detallesal_precio - ".$descuento.")*(detallesal_cantidad)".
//                        "  where articulo_id = ".$articulo_id." and usuario_id = ".$usuario_id;
//
//                
//            }
//            else{

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
                        articulo_id,
                        0,
                        ".$cantidad.",
                        articulo_precio,
                        articulo_precio*".$cantidad.",                        
                        ".$usuario_id.",
                        ".$detalleing_id." 
                        from articulo    
                        where articulo_id = ".$articulo_id."
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
                 
                $usuario_id = 1; //$session_data['usuario_id'];
                $gestion_id = 1;
                
                
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
                $estado_id = 1;
              
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
                    detallesal_total
                    )

                    (
                    select 

                    salida_id,
                    articulo_id,
                    programa_id,
                    detallesal_cantidad,
                    detallesal_precio,
                    detallesal_total
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
         //   echo '[{"cliente_id":"'.$result.'"}]';
            
//                    }
//                else
//                {                 
//                            show_404();
//                }  
            
            
        }
        else { $result = 0;  echo '[{"result    ":"'.$result.'"}]';}
            
        //**************** fin contenido ***************
//        }
//        else{ redirect('alerta'); }
//        } else { redirect('', 'refresh'); }           
               
    }    


    function pdf($salida_id)
    {   
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
