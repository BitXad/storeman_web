<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Ingreso extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ingreso_model');
        $this->load->model('Articulo_model');
        $this->load->model('Proveedor_model');
        $this->load->model('Factura_model');
        $this->load->model('Pedido_model');
        $this->load->helper('numeros');
    } 

    /*
     * Listing of ingreso
     */
    function index()
    {
        //$data['ingreso'] = $this->Ingreso_model->get_all_ingreso();
        $this->load->model('Institucion_model');
        $data['institucion'] = $this->Institucion_model->get_all_institucion();
        $this->load->model('Unidad_model');
        $data['all_unidad'] = $this->Unidad_model->get_all_unidad();
        $this->load->model('Programa_model');
        $data['all_programa'] = $this->Programa_model->get_all_programa();
        $tipo = 1;
        $this->load->model('Estado_model');
        $data['all_estado'] = $this->Estado_model->get_estado_tipo($tipo);
        $data['_view'] = 'ingreso/index';
        $this->load->view('layouts/main',$data);
    }

     function buscar50ingreso()
    {
        if ($this->input->is_ajax_request())
        {
          
            $datos = $this->Ingreso_model->get_50_ingreso();
            echo json_encode($datos);
        }
        else
        {                 
            show_404();
        }   
    }
     function buscarallingreso()
    {
        if ($this->input->is_ajax_request())
        {
          
            $datos = $this->Ingreso_model->get_all_ingreso();
            echo json_encode($datos);
        }
        else
        {                 
            show_404();
        }   
    }
     function buscarporingreso()
    {
        if ($this->input->is_ajax_request())
        {
            $parametro = $this->input->post('parametro');
            $categoria = $this->input->post('categoria');
            $datos = $this->Ingreso_model->get_tipo_ingreso($parametro,$categoria);
            echo json_encode($datos);
        }
        else
        {                 
            show_404();
        }   
    }

    function crear()
    {
        
         $usuario_id = 1;
         $gestion_id = 1;
         
         $ingreso_id = $this->Ingreso_model->crear_ingreso($usuario_id,$gestion_id);        
         redirect('ingreso/add/'.$ingreso_id);
     
    }
    /*
     * Adding a new ingreso
     */
    function add($ingreso_id)
    {   
            $data['ingreso_id'] = $ingreso_id;
            $data['ingreso'] = $this->Ingreso_model->get_ing_completo($ingreso_id);
            $this->load->model('Unidad_model');
            $data['all_unidad'] = $this->Unidad_model->get_all_unidad();
            $data['pedidos'] = $this->Ingreso_model->get_pedidos($ingreso_id);
            $data['facturas'] = $this->Ingreso_model->get_facturas($ingreso_id);

            $this->load->model('Proveedor_model');
            $data['proveedor'] = $this->Proveedor_model->get_all_proveedor();

			$this->load->model('Pedido_model');
			$data['all_pedido'] = $this->Ingreso_model->get_pedido_pendiente();

			$this->load->model('Usuario_model');
			$data['all_usuario'] = $this->Usuario_model->get_all_usuario();
            
            $data['_view'] = 'ingreso/add';
            $this->load->view('layouts/main',$data);
        
    }  

    function buscaringreso()
{
   

    if ($this->input->is_ajax_request()) {
        
        $parametro = $this->input->post('parametro');   
        
        if ($parametro!=""){
            $datos = $this->Articulo_model->get_articulox($parametro);            
           
            echo json_encode($datos);
        }
        else echo json_encode(null);
    }
    else
    {                 
        show_404();
    }              
}

function detalleingreso()
{

   if ($this->input->is_ajax_request()) {  
    $ingreso_id = $this->input->post('ingreso_id');
    $datos = $this->Ingreso_model->get_detalle_ingreso_aux($ingreso_id);
    if(isset($datos)){
        echo json_encode($datos);
    }else echo json_encode(null);
}
else
{                 
    show_404();
}          

}

function pedidosunidad()
{

   if ($this->input->is_ajax_request()) {  
    $unidad_id = $this->input->post('unidad_id');
    $datos = $this->Ingreso_model->get_pedidounidad($unidad_id);
    if(isset($datos)){
        echo json_encode($datos);
    }else echo json_encode(null);
}
else
{                 
    show_404();
}          

}

function ingresararticulo()
{
 
    
    
    if ($this->input->is_ajax_request()) {
     
        $ingreso_id = $this->input->post('ingreso_id');
        $articulo_id = $this->input->post('articulo_id');
        $cantidad = $this->input->post('cantidad'); 
        $articulo_precio = $this->input->post('articulo_precio');
        $factura_numero = $this->input->post('facturation');
          $sql = "INSERT into detalle_ingreso_aux(
        ingreso_id,
        articulo_id,
        detalleing_cantidad,
        detalleing_precio,
        detalleing_total,
        detalleing_salida,
        detalleing_saldo,
        factura_numero             
        )
        (
        SELECT
        ".$ingreso_id.",
        articulo_id,
        ".$cantidad.",
        ".$articulo_precio.",
        ".$articulo_precio."  * ".$cantidad.",
        0,
        ".$cantidad.",
        ".$factura_numero."
        
        
        from articulo where articulo_id = ".$articulo_id."
    )";

    $this->db->query($sql);
    $detalles = $this->db->insert_id();
  
    $datos = $this->Ingreso_model->get_detalle_ingreso_aux($ingreso_id);
    if(isset($datos)){
        echo json_encode($datos);
    }else echo json_encode(null);
}
else
{                 
    show_404();
}          
}

function updateDetalle()
{
    
    
    $detalleing_id = $this->input->post('detalleing_id');
    $cantidad = $this->input->post('cantidad'); 
    $precio = $this->input->post('precio');   
    $articulo_id = $this->input->post('articulo_id');    
    $ingreso_id = $this->input->post('ingreso_id');

    
    $sql = "UPDATE detalle_ingreso_aux
    SET
    
    detalleing_cantidad = ".$cantidad.",
    detalleing_precio = ".$precio.",
    detalleing_total = (".$cantidad." * ".$precio."),
    detalleing_saldo =  ".$cantidad."     
    WHERE ingreso_id = ".$ingreso_id." and articulo_id = ".$articulo_id." and detalleing_id = ".$detalleing_id."
    ";
    $this->db->query($sql);
  
    return true;

}
function quitar($detalleing_id)
{
     
 $sql = "delete from detalle_ingreso_aux where detalleing_id = ".$detalleing_id;
 $this->db->query($sql);
 
 return true;
 
}

function ingresoapedido()
    {   

         if ($this->input->is_ajax_request()) {
   
        $pedido_id = $this->input->post('pedido_id');
        $ingreso_id = $this->input->post('ingreso_id');
       

  
        $this->Ingreso_model->ingreso_apedido($ingreso_id,$pedido_id);
       
        $datos =  $this->Ingreso_model->get_pedidos($ingreso_id);
        
        if(isset($datos)){
                        echo json_encode($datos);
                    }else echo json_encode(null);
    }
        else
        {                 
                    show_404();
        }          
    }
function crearfactura()
    {   
        $usuario_id = 1;
        $gestion_id = 1;
        $estado_id = 1;
         if ($this->input->is_ajax_request()) {
   
        $ingreso_id = $this->input->post('ingreso_id');
        $nuevo_pro = $this->input->post('nuevopro');
        $proveedor_id = $this->input->post('proveedor_id');
        $this->load->model('Factura_model');
        $factu = array(
                'estado_id' => $estado_id,
                'usuario_id' => $usuario_id,
                'factura_numero' => $this->input->post('factura_numero'),
                'factura_fecha' => $this->input->post('factura_fecha'),
                'factura_nit' => $this->input->post('proveedor_nit'),
                'factura_razon' => $this->input->post('proveedor_razon'),
                'factura_importe' => $this->input->post('factura_importe'),
                'factura_autorizacion' => $this->input->post('proveedor_autorizacion'),
                'factura_poliza' => $this->input->post('factura_poliza'),
                'factura_ice' => $this->input->post('factura_ice'),
                'factura_exento' => $this->input->post('factura_exento'),
                'factura_neto' => $this->input->post('factura_neto'),
                'factura_creditofiscal' => $this->input->post('factura_creditofiscal'),
                'factura_codigocontrol' => $this->input->post('factura_codigocontrol'),
                'ingreso_id' => $ingreso_id,
            );
            
        $this->Factura_model->add_factura($factu);
        if ($nuevo_pro==true){
                $params = array(
                'estado_id' => $estado_id,               
                'proveedor_nombre' => $this->input->post('proveedor_razon'),
                'proveedor_nit' => $this->input->post('proveedor_nit'),
                'proveedor_razon' => $this->input->post('proveedor_razon'),
                'proveedor_autorizacion' => $this->input->post('proveedor_autorizacion'),
            );
            
            $proveedor = $this->Proveedor_model->add_proveedor($params);
        }
        
        else{
            $prove = array(
                                 
                    'proveedor_nit' => $this->input->post('proveedor_nit'),
                    'proveedor_razon' => $this->input->post('proveedor_razon'),
                    'proveedor_autorizacion' => $this->input->post('proveedor_autorizacion'),
                );

                $this->Proveedor_model->update_proveedor($proveedor_id,$prove);
        }
        $datos =  $this->Ingreso_model->get_facturas($ingreso_id);
        
        if(isset($datos)){
                        echo json_encode($datos);
                    }else echo json_encode(null);
    }
        else
        {                 
                    show_404();
        }          
    }

function cambiarproveedor()
    {   

         if ($this->input->is_ajax_request()) {
   
        $proveedor_id = $this->input->post('proveedor_id');
        $ingreso_id = $this->input->post('ingreso_id');
       
        
        $this->load->model('ingreso_model');
  
        $this->Ingreso_model->cambiar_proveedor($ingreso_id,$proveedor_id);
       
        $datos =  $this->Ingreso_model->get_ingreso_proveedor($ingreso_id,$proveedor_id);
        

        if(isset($datos)){
                        echo json_encode($datos);
                    }else echo json_encode(null);
    }
        else
        {                 
                    show_404();
        }          
    }
function cambiarpedido()
    {   

         if ($this->input->is_ajax_request()) {
   
        $pedido_id = $this->input->post('pedido_id');
        $ingreso_id = $this->input->post('ingreso_id');
       
        
        $this->load->model('ingreso_model');
  
        $this->Ingreso_model->cambiar_pedido($ingreso_id,$pedido_id);
       
        $datos =  $this->Ingreso_model->get_ing_pedido($ingreso_id,$pedido_id);
        
        if(isset($datos)){
                        echo json_encode($datos);
                    }else echo json_encode(null);
    }
        else
        {                 
                    show_404();
        }          
    }

function finalizaringreso($ingreso_id)
{

 $usuario_id = 1;
 $gestion_id = 1;
 $estado_id = 1;
 //$pedido_id = $this->input->post('pedido_id');
 $proveedor_id = $this->input->post('proveedor_id');
 $ingreso_numdoc = $this->input->post('ingreso_numdoc');
 $ingreso_total = $this->input->post('factura_importe');
 $fecha_almacen= $this->input->post('ingreso_fecha_ing');
          
             
/*$prove = array(
                    
                    'proveedor_codigo' => $this->input->post('proveedor_codigo'),
                    'proveedor_nombre' => $this->input->post('proveedor_nombre'),
                    'proveedor_contacto' => $this->input->post('proveedor_contacto'),
                    'proveedor_direccion' => $this->input->post('proveedor_direccion'),
                    'proveedor_telefono' => $this->input->post('proveedor_telefono'),
                    'proveedor_telefono2' => $this->input->post('proveedor_telefono2'),
                    'proveedor_email' => $this->input->post('proveedor_email'),
                    'proveedor_nit' => $this->input->post('proveedor_nit'),
                    'proveedor_razon' => $this->input->post('proveedor_razon'),
                    'proveedor_autorizacion' => $this->input->post('proveedor_autorizacion'),
                );

                $this->Proveedor_model->update_proveedor($proveedor_id,$prove); */


 $params = array(
                    'estado_id' => $estado_id,
                    'gestion_id' => $gestion_id,
                    //'factura_id' => $factura_id,
                    'usuario_id' => $usuario_id,
                    //'proveedor_id' => $proveedor_id,
                    'ingreso_numdoc' => $ingreso_numdoc,
                    'ingreso_fecha_ing' => $fecha_almacen,
                    'ingreso_total' => $ingreso_total,
                );

                $this->Ingreso_model->update_ingreso($ingreso_id,$params);  
                ///////////4. ELIMINAR DETALLE ingreso////////////
   $borrar_detalle = "DELETE from detalle_ingreso WHERE  detalle_ingreso.ingreso_id = ".$ingreso_id." "; 
   $this->db->query($borrar_detalle); 
            ///////////////5. COPIAR DE AUX A DETALLE/////////////////
   $vaciar_detalle = "INSERT INTO detalle_ingreso 
   (ingreso_id,
   articulo_id,
   detalleing_cantidad,
   detalleing_precio,
   detalleing_total,
   detalleing_salida,
   detalleing_saldo,
   factura_numero
   
   )
   (SELECT 
   ".$ingreso_id.",
   articulo_id,
   detalleing_cantidad,
   detalleing_precio,
   detalleing_total,
   detalleing_salida,
   detalleing_saldo,
   factura_numero
   
   FROM 
   detalle_ingreso_aux
   WHERE
   ingreso_id=".$ingreso_id.")";
   $this->db->query($vaciar_detalle);

 $eliminar_aux = "DELETE FROM detalle_ingreso_aux WHERE ingreso_id=".$ingreso_id." ";
   $this->db->query($eliminar_aux);

}

function actualizarzaringreso($ingreso_id)
{

 $usuario_id = 1;
 $gestion_id = 1;
 $estado_id = 1;
 //$pedido_id = $this->input->post('pedido_id');
 $proveedor_id = $this->input->post('proveedor_id');
 $ingreso_numdoc = $this->input->post('ingreso_numdoc');
 $ingreso_total = $this->input->post('factura_importe');
 $fecha_almacen= $this->input->post('ingreso_fecha_ing');
 $factura_id= $this->input->post('factura_id');
 $fecha_factura = $this->input->post('factura_fecha');        
             




 $params = array(
                    'estado_id' => $estado_id,
                    'gestion_id' => $gestion_id,
                    //'factura_id' => $factura_id,
                    'usuario_id' => $usuario_id,
                    //'proveedor_id' => $proveedor_id,
                    'ingreso_numdoc' => $ingreso_numdoc,
                    'ingreso_fecha_ing' => $fecha_almacen,
                    'ingreso_total' => $ingreso_total,
                );

                $this->Ingreso_model->update_ingreso($ingreso_id,$params);  


 ///////////4. ELIMINAR DETALLE ingreso////////////
   $borrar_detalle = "DELETE from detalle_ingreso WHERE  detalle_ingreso.ingreso_id = ".$ingreso_id." "; 
   $this->db->query($borrar_detalle); 
            ///////////////5. COPIAR DE AUX A DETALLE/////////////////
   $vaciar_detalle = "INSERT INTO detalle_ingreso 
   (ingreso_id,
   articulo_id,
   detalleing_cantidad,
   detalleing_precio,
   detalleing_total,
   detalleing_salida,
   detalleing_saldo,
   factura_numero
   
   )
   (SELECT 
   ".$ingreso_id.",
   articulo_id,
   detalleing_cantidad,
   detalleing_precio,
   detalleing_total,
   detalleing_salida,
   detalleing_saldo,
   factura_numero
   
   FROM 
   detalle_ingreso_aux
   WHERE
   ingreso_id=".$ingreso_id.")";
   $this->db->query($vaciar_detalle);

 $eliminar_aux = "DELETE FROM detalle_ingreso_aux WHERE ingreso_id=".$ingreso_id." ";
   $this->db->query($eliminar_aux);
}
    /*
     * Editing a ingreso
     */
    function edit($ingreso_id)
    {   
        // check if the ingreso exists before trying to edit it
         ///////////1.  BORRAR AUX DE LA ingreso//////////
    $eliminar_aux = "DELETE FROM detalle_ingreso_aux WHERE ingreso_id=".$ingreso_id." ";
    $this->db->query($eliminar_aux);
             ////////////////  2. COPIAR DE DETALLE A AUX//////////////////////
    $cargar_aux = "INSERT INTO detalle_ingreso_aux
    (ingreso_id,
   articulo_id,
   detalleing_cantidad,
   detalleing_precio,
   detalleing_total,
   detalleing_salida,
   detalleing_saldo,
   factura_numero
   
   )
    (SELECT 
   ".$ingreso_id.",
   articulo_id,
   detalleing_cantidad,
   detalleing_precio,
   detalleing_total,
   detalleing_salida,
   detalleing_saldo,
   factura_numero
   
    FROM 
    detalle_ingreso
    WHERE 
    detalle_ingreso.ingreso_id = ".$ingreso_id.")"; 
    $this->db->query($cargar_aux);

            $data['ingreso_id'] = $ingreso_id;
            $data['ingreso'] = $this->Ingreso_model->get_ing_mascompleto($ingreso_id);
            $data['pedidos'] = $this->Ingreso_model->get_pedidos($ingreso_id);
            $data['facturas'] = $this->Ingreso_model->get_facturas($ingreso_id);
            $this->load->model('Unidad_model');
            $data['all_unidad'] = $this->Unidad_model->get_all_unidad();

            $this->load->model('Proveedor_model');
            $data['proveedor'] = $this->Proveedor_model->get_all_proveedor();

            $this->load->model('Pedido_model');
            $data['all_pedido'] = $this->Ingreso_model->get_pedido_pendiente();

            $this->load->model('Usuario_model');
            $data['all_usuario'] = $this->Usuario_model->get_all_usuario();
            
            $data['_view'] = 'ingreso/edit';
            $this->load->view('layouts/main',$data);
				
    }

    function pdf($ingreso_id)
    {   
        // check if the ingreso exists before trying to edit it
            $data['ingreso_id'] = $ingreso_id;
            $data['datos'] = $this->Ingreso_model->get_ing_mascompleto($ingreso_id);
            $data['detalle_ingreso'] = $this->Ingreso_model->get_detalle_ingreso($ingreso_id);
            $data['facturas'] = $this->Ingreso_model->facturitas($ingreso_id);
            $data['pedidos'] = $this->Ingreso_model->programitas($ingreso_id);

            $this->load->model('Institucion_model');
            $data['institucion'] = $this->Institucion_model->get_institucion(1);
            
            $data['_view'] = 'ingreso/pdf';
            $this->load->view('layouts/main',$data);
                
    }
    
    /*
     * Deleting ingreso
     */
    function remove($ingreso_id)
    {
        $ingreso = $this->Ingreso_model->get_ingreso($ingreso_id);

        // check if the ingreso exists before trying to delete it
        if(isset($ingreso['ingreso_id']))
        {
            $this->Ingreso_model->delete_ingreso($ingreso_id);
            redirect('ingreso/index');
        }
        else
            show_error('The ingreso you are trying to delete does not exist.');
    }
    
}
