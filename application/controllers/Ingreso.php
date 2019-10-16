<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Ingreso extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Ingreso_model');
        $this->load->model('Articulo_model');
        $this->load->model('Proveedor_model');
        $this->load->model('Factura_model');
        $this->load->model('Pedido_model');
        $this->load->model('Responsable_model');
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
     * Listing of ingreso
     */
    function index()
    {
        if($this->acceso(26)){
            $data['rolusuario'] = $this->session_data['rol'];
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
    }
    function buscar_ingresoexcel()
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
        $usuario_id = $this->session_data['usuario_id'];
        $gestion_id = $this->session_data['gestion_id'];
        $numrec = $this->Ingreso_model->get_numero();
        $numero = $numrec['numero'];
        $ingreso_id = $this->Ingreso_model->crear_ingreso($usuario_id,$gestion_id,$numero);
        $numero_gestion = "UPDATE gestion SET gestion_numing=gestion_numing+1 WHERE gestion_id = ".$gestion_id.""; 
        $this->db->query($numero_gestion);        
        redirect('ingreso/add/'.$ingreso_id);
    }
    function nuevo()
    {
        $usuario_id = $this->session_data['usuario_id'];
        $gestion_id = $this->session_data['gestion_id']; 
        $ingreso_id = $this->Ingreso_model->crear_ingreso_extra($usuario_id,$gestion_id);
         
        redirect('ingreso/edit2/'.$ingreso_id);
    }
    /*
     * Adding a new ingreso
     */
    function add($ingreso_id)
    {
        if($this->acceso(25)){
            $data['ingreso_id'] = $ingreso_id;
            $data['ingreso'] = $this->Ingreso_model->get_ing_completo($ingreso_id);
            $this->load->model('Programa_model');
            $data['all_programa'] = $this->Programa_model->get_all_programa();
            $this->load->model('Responsable_model');
            $data['responsable'] = $this->Responsable_model->get_all_responsable();
            $data['pedidos'] = $this->Ingreso_model->get_pedidos($ingreso_id);
            $data['facturas'] = $this->Ingreso_model->get_facturas($ingreso_id);
            $data['numero'] = $this->Ingreso_model->get_numero();
            $this->load->model('Unidad_manejo_model');
            $data['all_unidadmanejo'] = $this->Unidad_manejo_model->get_all_unidad_manejo_activo();
            $this->load->model('Categoria_model');
            $data['all_categoria'] = $this->Categoria_model->get_all_categoria_activo();
            $this->load->model('Proveedor_model');
            $data['proveedor'] = $this->Proveedor_model->get_all_proveedor();

            $this->load->model('Pedido_model');
            $data['all_pedido'] = $this->Ingreso_model->get_pedido_pendiente();

            $this->load->model('Usuario_model');
            $data['all_usuario'] = $this->Usuario_model->get_all_usuario();

            $data['_view'] = 'ingreso/add';
            $this->load->view('layouts/main',$data);
        }
    }

    function responsables()
    {

            
        if ($this->input->is_ajax_request()) {
            $responsable_nombre=$this->input->post('responsable_nombre');
            $responsable_repetido = "SELECT count(responsable_id) as 'existe' FROM responsable_pago WHERE responsable_nombre='".$responsable_nombre."' ";
 $existe = $this->db->query($responsable_repetido)->row_array();
 if($existe['existe']>0){
    echo json_encode("existe");
 } else{
            $para = array(
                'responsable_nombre' => $responsable_nombre,
                'estado_id' => 1,
            );
            
            $responsable_id = $this->Responsable_model->add_responsable($para);
            $datos = $this->Responsable_model->get_all_responsable();
            echo json_encode($datos);
             }
      

    }
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
function pedidosfiltro()
{
   if ($this->input->is_ajax_request()) {  
    $filtro = $this->input->post('filtro');
    $datos = $this->Ingreso_model->get_pedidofiltro($filtro);
    //if(isset($datos)){
        echo json_encode($datos);
    //}else echo json_encode(null);
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
        )VALUES
        (
        ".$ingreso_id.",
        ".$articulo_id.",
        ".$cantidad.",
        ".$articulo_precio."/".$cantidad." ,
        ".$articulo_precio.",
        0,
        ".$cantidad.",
        ".$factura_numero."
        
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
function quitarpedido()
{
    if($this->input->is_ajax_request()) {
        $pedido_id = $this->input->post('pedido_id');  
        $ingreso_id = $this->input->post('ingreso_id');     
        $sql = "update pedido set ingreso_id=0, estado_id=6 where pedido_id = ".$pedido_id;
        $this->db->query($sql);
        $datos =  $this->Ingreso_model->get_pedidos($ingreso_id);
        if(isset($datos)){
            echo json_encode($datos);
        }else echo json_encode(null);
    }else
    {
                show_404();
    }          
    }

function quitarfactura()
{
   if ($this->input->is_ajax_request()) { 
   $factura_id = $this->input->post('factura_id');  
   $ingreso_id = $this->input->post('ingreso_id');  
 $sql = "delete from factura where factura_id = ".$factura_id;
 $this->db->query($sql);
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
        }else{                 
            show_404();
        }
    }

    function crearfactura()
    {
        $usuario_id = $this->session_data['usuario_id'];
        $gestion_id = $this->session_data['gestion_id'];
        $estado_id = 1;
         if ($this->input->is_ajax_request()) {
   
        $ingreso_id = $this->input->post('ingreso_id');
        $nuevo_pro = $this->input->post('nuevop');
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
        if ($nuevo_pro==1){
                $params = array(
                'estado_id' => $estado_id,               
                'proveedor_nombre' => $this->input->post('proveedor_razon'),
                'proveedor_nit' => $this->input->post('proveedor_nit'),
                'proveedor_razon' => $this->input->post('proveedor_razon'),
                'proveedor_autorizacion' => $this->input->post('proveedor_autorizacion'),
                'proveedor_contacto' => $this->input->post('proveedor_contacto'),
            );
            
            $proveedor = $this->Proveedor_model->add_proveedor($params);

        }
        
        else{
            $prove = array(
                                 
                    'proveedor_nit' => $this->input->post('proveedor_nit'),
                    'proveedor_razon' => $this->input->post('proveedor_razon'),
                    'proveedor_autorizacion' => $this->input->post('proveedor_autorizacion'),
                    'proveedor_contacto' => $this->input->post('proveedor_contacto'),
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
        }else{
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
    }else{                 
        show_404();
    }          
    }

function finalizaringreso($ingreso_id)
{
    $usuario_id = $this->session_data['usuario_id'];
    $gestion_id = $this->session_data['gestion_id'];
    $estado_id = 1;
    $programa_id = $this->input->post('programa_id');
    $proveedor_id = $this->input->post('proveedor_id');
    $ingreso_numdoc = $this->input->post('ingreso_numdoc');
    $ingreso_total = $this->input->post('ingreso_total');
    $fecha_almacen= $this->input->post('ingreso_fecha_ing');
    $responsable_id= $this->input->post('responsable_id');
   //anual esto 
    $numero_repetido = "SELECT count(ingreso_id) as 'existe' FROM ingreso WHERE ingreso_numdoc=".$ingreso_numdoc." and ingreso_id!=".$ingreso_id." ";
 $existe = $this->db->query($numero_repetido)->result_array();
$numero_actual = "SELECT gestion_numing FROM gestion";
$num_actual = $this->db->query($numero_actual)->result_array();
 if($existe[0]['existe']>0 || $ingreso_numdoc==$num_actual[0]['gestion_numing']){
    echo json_encode("existe");
 } else { // y la llave de abajo mas con surespuesta json
 $pedidos = "UPDATE pedido set pedido.estado_id = 7 where pedido.ingreso_id =".$ingreso_id ;
$this->db->query($pedidos);

 $params = array(
                    'estado_id' => $estado_id,
                    'gestion_id' => $gestion_id,
                    'programa_id' => $programa_id,
                    'usuario_id' => $usuario_id,
                    //'proveedor_id' => $proveedor_id,
                    'ingreso_numdoc' => $ingreso_numdoc,
                    'ingreso_fecha_ing' => $fecha_almacen,
                    'ingreso_total' => $ingreso_total,
                    'responsable_id' => $responsable_id,
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
   echo json_encode("nuevo");
}
}

function actualizarzaringreso($ingreso_id)
{
    $usuario_id = $this->session_data['usuario_id'];
    $gestion_id = $this->session_data['gestion_id'];
 $estado_id = 1;
 $programa_id = $this->input->post('programa_id');
 //$proveedor_id = $this->input->post('proveedor_id');
 $ingreso_numdoc = $this->input->post('ingreso_numdoc');
 $ingreso_total = $this->input->post('ingreso_total');
 $fecha_almacen= $this->input->post('ingreso_fecha_ing');
 $factura_id= $this->input->post('factura_id');
 $fecha_factura = $this->input->post('factura_fecha');        
 $responsable_id= $this->input->post('responsable_id');  
 

 $numero_repetido = "SELECT count(ingreso_id) as 'existe' FROM ingreso WHERE ingreso_numdoc=".$ingreso_numdoc." and ingreso_id!=".$ingreso_id." ";
 $existe = $this->db->query($numero_repetido)->result_array();
$numero_actual = "SELECT gestion_numing FROM gestion";
$num_actual = $this->db->query($numero_actual)->result_array();
 if($existe[0]['existe']>0 || $ingreso_numdoc==$num_actual[0]['gestion_numing']){
    echo json_encode("existe");
 } else{



 $pedidos = "UPDATE pedido set pedido.estado_id = 7 where pedido.ingreso_id =".$ingreso_id ;
 $this->db->query($pedidos);


 $params = array(
                    'estado_id' => $estado_id,
                    'gestion_id' => $gestion_id,
                    'programa_id' => $programa_id,
                    'usuario_id' => $usuario_id,
                    //'proveedor_id' => $proveedor_id,
                    'ingreso_numdoc' => $ingreso_numdoc,
                    'ingreso_fecha_ing' => $fecha_almacen,
                    'ingreso_total' => $ingreso_total,
                    'responsable_id' => $responsable_id,
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
   echo json_encode("nuevo");
}
}
    /*
     * Editing a ingreso
     */
    function editar($ingreso_id)
    {
        $this->acceso(30);

            ///////////1.  BORRAR AUX DE LA COMPRA//////////
    $eliminar_aux = "DELETE FROM detalle_ingreso_aux WHERE ingreso_id=".$ingreso_id." ";
    $this->db->query($eliminar_aux);        
    
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
 redirect('ingreso/edit/'.$ingreso_id);

    }
    function edit($ingreso_id)
    {
        if($this->acceso(30)){
            $data['ingreso_id'] = $ingreso_id;
            $data['ingreso'] = $this->Ingreso_model->get_ing_mascompleto($ingreso_id);
            $data['pedidos'] = $this->Ingreso_model->get_pedidos($ingreso_id);
            $data['facturas'] = $this->Ingreso_model->get_facturas($ingreso_id);
            $this->load->model('Programa_model');
            $data['all_programa'] = $this->Programa_model->get_all_programa();
            $this->load->model('Responsable_model');
            $data['responsable'] = $this->Responsable_model->get_all_responsable();
            $this->load->model('Proveedor_model');
            $data['proveedor'] = $this->Proveedor_model->get_all_proveedor();
            $this->load->model('Unidad_manejo_model');
            $data['all_unidadmanejo'] = $this->Unidad_manejo_model->get_all_unidad_manejo_activo();

            $this->load->model('Categoria_model');
            $data['all_categoria'] = $this->Categoria_model->get_all_categoria_activo();
            $this->load->model('Pedido_model');
            $data['all_pedido'] = $this->Ingreso_model->get_pedido_pendiente();

            $this->load->model('Usuario_model');
            $data['all_usuario'] = $this->Usuario_model->get_all_usuario();
            
            $data['_view'] = 'ingreso/edit';
            $this->load->view('layouts/main',$data);
        }
				
    }

    function pdf($ingreso_id)
    {
        if($this->acceso(31)){
        // check if the ingreso exists before trying to edit it
            $gestion_id = $this->session_data['gestion_id'];
            $data['ingreso_id'] = $ingreso_id;
            $data['datos'] = $this->Ingreso_model->get_ing_mascompleto($ingreso_id);
            $data['detalle_ingreso'] = $this->Ingreso_model->get_detalle_ingreso($ingreso_id);
            $data['facturas'] = $this->Ingreso_model->facturitas($ingreso_id);
            $data['pedidos'] = $this->Ingreso_model->programitas($ingreso_id);

            $this->load->model('Institucion_model');
            $data['institucion'] = $this->Institucion_model->get_institucion(1);
            $this->load->model('Gestion_model');
            $data['gestion'] = $this->Gestion_model->get_gestion($gestion_id);

            $data['_view'] = 'ingreso/pdf';
            $this->load->view('layouts/main',$data);
        }
    }
    
    /*
     * Deleting ingreso
     */
    function remove($ingreso_id)
    {
        if($this->acceso(17)){
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
    function eliminar()
    {
        if($this->acceso(17)){
            $ingreso_id = $this->input->post('ingreso_id'); 
            $ingreso = $this->Ingreso_model->get_ingreso($ingreso_id);
            // check if the programa exists before trying to delete it
            $pedi = "update pedido  SET estado_id=6 where ingreso_id = ".$ingreso_id." ";
            $this->db->query($pedi);
            $pqs = "delete from detalle_ingreso where ingreso_id = ".$ingreso_id." ";
            $this->db->query($pqs);
            $ptq = "delete from factura where ingreso_id = ".$ingreso_id." ";
            $this->db->query($ptq);
            $sql = "delete from ingreso where ingreso_id = ".$ingreso_id." ";
            $this->db->query($sql);
         return true;
        }
    }
    function edit2($ingreso_id)
    {
        if($this->acceso(29)){
            $data['ingreso_id'] = $ingreso_id;
            $data['ingreso'] = $this->Ingreso_model->get_ing_mascompleto($ingreso_id);
            $data['pedidos'] = $this->Ingreso_model->get_pedidos($ingreso_id);
            $data['facturas'] = $this->Ingreso_model->get_facturas($ingreso_id);
            $this->load->model('Programa_model');
            $data['all_programa'] = $this->Programa_model->get_all_programa();
            $this->load->model('Responsable_model');
            $data['responsable'] = $this->Responsable_model->get_all_responsable();
            $this->load->model('Proveedor_model');
            $data['proveedor'] = $this->Proveedor_model->get_all_proveedor();
            $this->load->model('Unidad_manejo_model');
            $data['all_unidadmanejo'] = $this->Unidad_manejo_model->get_all_unidad_manejo_activo();

            $this->load->model('Categoria_model');
            $data['all_categoria'] = $this->Categoria_model->get_all_categoria_activo();
            $this->load->model('Pedido_model');
            $data['all_pedido'] = $this->Ingreso_model->get_pedido_pendiente();

            $this->load->model('Usuario_model');
            $data['all_usuario'] = $this->Usuario_model->get_all_usuario();
            
            $data['_view'] = 'ingreso/edit';
            $this->load->view('layouts/main',$data);
        }
				
    }

}



   
  
