<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Programa extends CI_Controller{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        $this->load->model('Programa_model');
        $this->load->model('Unidad_model');
        $this->load->model('Estado_model');
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
     * Listing of programa
     */
    function index()
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","INDEX PROGRAMA");
        
        if($this->acceso(12)){
            $data['programa'] = $this->Programa_model->get_all_programas();
            /*$data['estado'] = $this->Estado_model->get_all_estado();
            $data['unidad'] = $this->Unidad_model->get_all_unidad();*/

            $data['_view'] = 'programa/index';
            $this->load->view('layouts/main',$data);
        }
    }
    function kardex()
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","KARDEX PROGRAMA");
        if($this->acceso(12)){
            
            $data['all_programa'] = $this->Programa_model->get_all_programa();
            //$data['programa'] = $this->Programa_model->get_all_programa();
            $data['estado'] = $this->Estado_model->get_all_estado();
            $data['unidad'] = $this->Unidad_model->get_all_unidad();

            $data['_view'] = 'programa/kardex';
            $this->load->view('layouts/main',$data);
        
            
        }
    }

     function buscar()
    {
         
        if ($this->input->is_ajax_request()) {
        $gestion = $this->session_data['gestion_id'];
        $parametro = $this->input->post('parametro');   
        $programa_id = $this->input->post('programa_id');   
        $fecha_desde = $this->input->post('fecha_desde');   
        $fecha_hasta = $this->input->post('fecha_hasta');   
        
        
            $datos = $this->Programa_model->get_articulop($parametro,$programa_id,$fecha_desde,$fecha_hasta,$gestion);            
        if ($datos!=null){   
            echo json_encode($datos);
        }
        else show_404();
    }
    else
    {                 
        show_404();
    }              
}

    /*
     * Adding a new programa
     */
    function add()
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","ADD PROGRAMA");
        if($this->acceso(12)){
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
                    'unidad_id' => $this->input->post('unidad_id'),
                    'estado_id' => $this->input->post('estado_id'),
                    'programa_nombre' => $this->input->post('programa_nombre'),
                    'programa_codigo' => $this->input->post('programa_codigo'),
                    'programa_descripcion' => $this->input->post('programa_descripcion'),
                );

                $programa_id = $this->Programa_model->add_programa($params);
                redirect('programa/index');
            }
            else
            {
                $this->load->model('Unidad_model');
                $data['all_unidad'] = $this->Unidad_model->get_all_unidad();

                $this->load->model('Estado_model');
                $data['all_estado'] = $this->Estado_model->get_all_estado();

                $data['_view'] = 'programa/add';
                $this->load->view('layouts/main',$data);
            }
        }
    }  

    /*
     * Editing a programa
     */
    function edit($programa_id)
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","EDIT PROGRAMA");
        if($this->acceso(12)){
            // check if the programa exists before trying to edit it
            $data['programa'] = $this->Programa_model->get_programa($programa_id);

            if(isset($data['programa']['programa_id']))
            {
                if(isset($_POST) && count($_POST) > 0)     
                {   
                    $params = array(
                                            'unidad_id' => $this->input->post('unidad_id'),
                                            'estado_id' => $this->input->post('estado_id'),
                                            'programa_nombre' => $this->input->post('programa_nombre'),
                                            'programa_codigo' => $this->input->post('programa_codigo'),
                                            'programa_descripcion' => $this->input->post('programa_descripcion'),
                    );

                    $this->Programa_model->update_programa($programa_id,$params);            
                    redirect('programa/index');
                }
                else
                {
                                    $this->load->model('Unidad_model');
                                    $data['all_unidad'] = $this->Unidad_model->get_all_unidad();

                                    $this->load->model('Estado_model');
                                    $data['all_estado'] = $this->Estado_model->get_all_estado_tipo1();

                    $data['_view'] = 'programa/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('The programa you are trying to edit does not exist.');
        }
    } 
    /*
     * Inactivar programa
     */
    function inactivar($programa_id)
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","INACTIVAR PROGRAMA");
        $programa = $this->Programa_model->get_programa($programa_id);

        // check if the programa exists before trying to delete it
        if(isset($programa['programa_id']))
        {
            $this->Programa_model->inactivar_programa($programa_id);
            redirect('programa/index');
        }
        else
            show_error('The programa you are trying to delete does not exist.');
    }

    function activar($programa_id)
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","ACTIVAR PROGRAMA");
        $programa = $this->Programa_model->get_programa($programa_id);

        // check if the programa exists before trying to delete it
        if(isset($programa['programa_id']))
        {
            $this->Programa_model->activar_programa($programa_id);
            redirect('programa/index');
        }
        else
            show_error('The programa you are trying to delete does not exist.');
    }

    /*
     * Deleting programa
     */
    function remove($programa_id)
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","REMOVE PROGRAMA");
        $programa = $this->Programa_model->get_programa($programa_id);

        // check if the programa exists before trying to delete it
        if(isset($programa['programa_id']))
        {
            $this->Programa_model->delete_programa($programa_id);
            redirect('programa/index');
        }
        else
            show_error('The programa you are trying to delete does not exist.');
    }
    
    function programainv()
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","INVENTARIO X PROGRAMA");
        if($this->acceso(12)){
            $this->load->model('Institucion_model');
            $data['institucion'] = $this->Institucion_model->get_all_institucion();
            
            $data['gestion_nombre'] = $this->session_data['gestion_nombre'];
            $gestion_id = $this->session_data['gestion_id'];
            $this->load->model('Gestion_model');
            $gestion = $this->Gestion_model->get_gestion($gestion_id);
            $data['gestion_inicio']  = $gestion['gestion_inicio'];
            $data['gestion_id']  = $gestion['gestion_id'];
            
            $data['all_programa'] = $this->Programa_model->get_all_programa();
            $data['gestion'] = $this->Gestion_model->get_all_gestion();
            
            $data['_view'] = 'programa/programainv';
            $this->load->view('layouts/main',$data);
        }
    }
    
    function inventariobuscar()
    {
        if($this->input->is_ajax_request()){
            $fecha_hasta = $this->input->post('fecha_hasta');
            $programa_id = $this->input->post('programa_id');
            $gestion_inicio = $this->input->post('gestion_inicio');
            $gestion_id = $this->input->post('gestion_id');
            
            $datos = $this->Programa_model->get_programainventario($gestion_id, $programa_id, $fecha_hasta);
            if($datos!=null){
                echo json_encode($datos);
            }
            else echo json_encode("no");
        }
        else
        {                 
            show_404();
        }
    }
    
    //Generar el inventario inicial
    function inventarioinicial()
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","INV. INICIAL PROGRAMA");
        if($this->input->is_ajax_request()){
            
            $fecha_hasta = $this->input->post('fecha_hasta');
            $programa_id = $this->input->post('programa_id');
            $gestion_inicio = $this->input->post('gestion_inicio');
            $gestion_id = $this->input->post('gestion_id'); //Gestion destino
            $total_inventario = $this->input->post('total_inventario');
            
            $gestion_id2 = $this->input->post('gestion_descripcion');
            $gestion_fecha = $this->input->post('gestion_fecha');
            
            $datos = $this->Programa_model->get_programainventario($gestion_id, $programa_id, $fecha_hasta);
            
            
            $proveedor_id = 0;
            $usuario_id = $this->session_data['usuario_id'];
            $ingreso_numdoc = 0;
            $ingreso_fecha_ing = "'".$gestion_fecha."'";
            $ingreso_fecha = "date(now())";
            $ingreso_hora = "time(now())";
            $estado_id = 1;
            $gestion_id = $gestion_id2;
            $ingreso_total = $total_inventario;
            $factura_id = 0;
            $pedido_id = 0;
            $responsable_id = $usuario_id;
            //$programa_id
            
            //Registrar ingreso
            $sql = "insert into ingreso(proveedor_id,usuario_id,ingreso_numdoc,ingreso_fecha,
                    ingreso_hora,estado_id,gestion_id,ingreso_total,ingreso_fecha_ing,
                    factura_id,pedido_id,responsable_id,programa_id) value(".
                    $proveedor_id.",".$usuario_id.",".$ingreso_numdoc.",".$ingreso_fecha.",".
                    $ingreso_hora.",".$estado_id.",".$gestion_id.",".$ingreso_total.",".$ingreso_fecha_ing.",".
                    $factura_id.",".$pedido_id.",".$responsable_id.",".$programa_id.")";
            

            $this->Programa_model->ejecutar($sql);
            
            $sql = "select max(ingreso_id) as ingresoid from ingreso where programa_id = ".$programa_id;
            $resultado= $this->Programa_model->consultar($sql);
            $ingreso_id = $resultado[0]["ingresoid"];
                
            //Registrar detalle de ingreso
            foreach($datos as $d){
                
                $articulo_id = $d["articulo_id"];
                //$ingreso_id 
                $detalleing_cantidad = $d["saldos"];
                $detalleing_precio = $d["precio_unitario"];
                $detalleing_total =  $d["precio_unitario"]." * ". $d["saldos"];;
                $detalleing_salida = 0;
                $detalleing_saldo = $detalleing_cantidad;
                $factura_numero = 0;
                
                if ($detalleing_cantidad >0){
                    $sql = "insert into detalle_ingreso(articulo_id,ingreso_id,detalleing_cantidad,
                            detalleing_precio,detalleing_total,detalleing_salida,
                            detalleing_saldo,factura_numero) value(".
                            $articulo_id.",".$ingreso_id.",".$detalleing_cantidad.",".$detalleing_precio.",".
                            $detalleing_total.",".$detalleing_salida.",".$detalleing_saldo.",".$factura_numero.")";


                    $this->Programa_model->ejecutar($sql);
                }
            }
            
            //Actualizar ingreso
            
            
        }
        else
        {                 
            show_404();
        }
    }
    
    
    function convertiraliteral()
    {
        if($this->input->is_ajax_request()){
            $numero = $this->input->post('numero');
            $datos = num_to_letras($numero);
            if($datos!=null){
                echo json_encode($datos);
            }
            else echo json_encode("no");
        }
        else
        {                 
            show_404();
        }
    }
    function obtenercodigo()
    {
        if($this->input->is_ajax_request()){
            $programa_id = $this->input->post('programa_id');
            $este_codigo = $this->Programa_model->get_programa($programa_id);
            $datos = $este_codigo['programa_codigo'];
            if($datos!=null){
                echo json_encode($datos);
            }
            else echo json_encode("no");
        }
        else
        {                 
            show_404();
        }
    }
    function consumidos()
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","CONSUMIDOS PROGRAMA");
        if($this->acceso(12)){
            $this->load->model('Institucion_model');
            $data['institucion'] = $this->Institucion_model->get_all_institucion();
            
            $data['gestion_nombre'] = $this->session_data['gestion_nombre'];
            $gestion_id = $this->session_data['gestion_id'];
            $this->load->model('Gestion_model');
            $gestion = $this->Gestion_model->get_gestion($gestion_id);
            $data['gestion_inicio']  = '1999-01-01';//$gestion['gestion_inicio'];
            $data['gestion_id']  = $gestion['gestion_id'];
            
            $data['all_programa'] = $this->Programa_model->get_all_programa();

            $data['_view'] = 'programa/consumidos';
            $this->load->view('layouts/main',$data);
        }
    }

    function consumidobuscar()
    {
        if($this->input->is_ajax_request()){
            $fecha_hasta = $this->input->post('fecha_hasta');
            $programa_id = $this->input->post('programa_id');
            $gestion_inicio = $this->input->post('gestion_inicio');
            $gestion_id = $this->input->post('gestion_id');
            $datos = $this->Programa_model->get_consumidos($gestion_id, $programa_id, $fecha_hasta);
            if($datos!=null){
                echo json_encode($datos);
            }
            else echo json_encode("no");
        }
        else
        {                 
            show_404();
        }
    }

    function buscar_ingresos()
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","BUSCAR PROGRAMA");
        if($this->input->is_ajax_request()){
            
            $programa_id = $this->input->post('programa_id');
            $articulo_id = $this->input->post('articulo_id');
            $gestion_id = $this->input->post('gestion_id');
            
            $sql = "SELECT  a.articulo_nombre, i.*
                    FROM
                     ingreso i, detalle_ingreso d, articulo a
                    where 
                    i.`ingreso_id` = d.`ingreso_id` and
                    d.articulo_id = a.articulo_id and
                    d.`articulo_id` = ".$articulo_id." and
                    i.`programa_id` = ".$programa_id." and
                    i.`gestion_id` = ".$gestion_id.
                    " order by i.ingreso_fecha_ing asc";
            
            $datos = $this->Programa_model->consultar($sql);
            
            if($datos!=null){
                echo json_encode($datos);
            }
            else echo json_encode("no");
            
        }
        else
        {                 
            show_404();
        }
    }
    /* Saldos por Articulo */
    function saldoarticulo()
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","SALDO ARTICULO PROGRAMA");
        if($this->acceso(12)){
            $this->load->model('Institucion_model');
            $data['institucion'] = $this->Institucion_model->get_all_institucion();
            
            $data['gestion_nombre'] = $this->session_data['gestion_nombre'];
            $gestion_id = $this->session_data['gestion_id'];
            $this->load->model('Gestion_model');
            $gestion = $this->Gestion_model->get_gestion($gestion_id);
            $data['gestion_inicio']  = '1999-01-01';//$gestion['gestion_inicio'];
            $data['gestion_id']  = $gestion['gestion_id'];
            
            $data['all_programa'] = $this->Programa_model->get_all_programa();
            $data['gestion'] = $this->Gestion_model->get_all_gestion();
            
            $data['_view'] = 'programa/saldoarticulo';
            $this->load->view('layouts/main',$data);
        }
    }
    /* busca articulos*/
    function buscar_articulo()
    {
        if($this->input->is_ajax_request()){
            
            $parametro = $this->input->post('el_articulo');
            $datos = $this->Programa_model->get_articulos($parametro);
            if($datos!=null){
                echo json_encode($datos);
            }
            else echo json_encode("no");
        }
        else
        {                 
            show_404();
        }
    }
    /* busca Programas, Artículos*/
    function buscarprog_articulo()
    {
        if($this->input->is_ajax_request()){
            
            $programa_id = $this->input->post('programa_id');
            $articulo_id = $this->input->post('articulo_id');
            $gestion_id  = $this->input->post('gestion_id');
            $datos = $this->Programa_model->getprograma_articulo($programa_id, $articulo_id, $gestion_id);
            if($datos!=null){
                echo json_encode($datos);
            }
            else echo json_encode("no");
        }
        else
        {                 
            show_404();
        }
    }

    function articulos()
    {
        $this->Programa_model->bitacora("ACCESO A MODULO","ARTICULOS X PROGRAMA");
        
        if($this->acceso(12)){
            
            $this->load->model('Institucion_model');
            $data['institucion'] = $this->Institucion_model->get_all_institucion();
            
            $data['gestion_nombre'] = $this->session_data['gestion_nombre'];
            $gestion_id = $this->session_data['gestion_id'];
            $this->load->model('Gestion_model');
            $gestion = $this->Gestion_model->get_gestion($gestion_id);
            $data['gestion_inicio']  = '1999-01-01';//$gestion['gestion_inicio'];
            $data['gestion_id']  = $gestion['gestion_id'];
            
            $data['all_programa'] = $this->Programa_model->get_all_programa();
            $data['gestion'] = $this->Gestion_model->get_all_gestion();
            
            $data['_view'] = 'programa/articulos';
            $this->load->view('layouts/main',$data);
            
        }
    }

    function mostrar_articulos()
    {

            $programa_id = $this->input->post('programa_id');
//            $articulo_id = $this->input->post('articulo_id');
            $gestion_id = $this->input->post('gestion_id');
//            
            $sql = "select a.*, count(*) as compras
                    from programa p, ingreso i, detalle_ingreso d, articulo a
                    where
                    i.`programa_id` = p.`programa_id` and
                    i.ingreso_id = d.ingreso_id and
                    d.`articulo_id` = a.articulo_id and
                    i.`gestion_id` = ".$gestion_id." and 
                    p.programa_id = ".$programa_id."
                    group by a.articulo_id
                    order by a.articulo_nombre asc";
            
            $datos = $this->Programa_model->consultar($sql);
            
            if($datos!=null){
                echo json_encode($datos);
            }
            else{
                echo json_encode("no");
            }
            
    }

    function reajustar_inventario()
    {

            $programa_id = $this->input->post('programa_id');
            $gestion_id = $this->input->post('gestion_id');
            
            $this->Programa_model->bitacora("EJECUTAR MODULO","REAJUSTAR INVENTARIO");
 
            //primero.- Listar todos los articulos
            $sql = "select a.*, count(*) as compras
                    from programa p, ingreso i, detalle_ingreso d, articulo a
                    where
                    i.programa_id = p.programa_id and
                    i.ingreso_id = d.ingreso_id and
                    d.articulo_id = a.articulo_id and
                    i.gestion_id = ".$gestion_id." and 
                    p.programa_id = ".$programa_id."
                    group by a.articulo_id
                    order by a.articulo_nombre asc";
            //echo $sql;
            $articulos = $this->Programa_model->consultar($sql);
            
            //Segundo.- Recorrer todos los articulos

            foreach($articulos as $a){
                
                
                //Tercero.- Llevar a 0 las salidas y Saldo = cantidad
                $articulo_id = $a["articulo_id"];
                /*$sql = "update detalle_ingreso set
                        detalleing_salida = 0,
                        detalleing_saldo = detalleing_cantidad
                        where detalleing_id in

                        (select d.detalleing_id
                        from programa p, ingreso i, detalle_ingreso d, articulo a
                        where
                        i.programa_id = p.programa_id and
                        i.ingreso_id = d.ingreso_id and
                        d.articulo_id = a.articulo_id and
                        i.gestion_id = ".$gestion_id." and 
                        p.programa_id = ".$programa_id." and
                        a.articulo_id = ".$articulo_id."

                        order by i.ingreso_fecha_ing asc)";
                */
                
                $sql = "UPDATE
                        detalle_ingreso d, programa p, ingreso i, articulo a 
                      SET
                        d.detalleing_salida = 0,
                        d.detalleing_saldo = d.detalleing_cantidad

                        WHERE 
                        i.programa_id = p.programa_id AND 
                        i.ingreso_id = d.ingreso_id AND 
                        d.articulo_id = a.articulo_id AND 
                        i.gestion_id = ".$gestion_id." AND
                        p.programa_id = ".$programa_id." AND
                        a.articulo_id = ".$articulo_id;
                
                $this->Programa_model->ejecutar($sql);
                
                //Cuarto.- Obtener el total de salidas segun kardex
                
                $sql = "select sum(k.cantidad_salida) as total_salida from vista_kardex k
                        where 
                        k.gestion_id = ".$gestion_id." and 
                        k.programa_id = ".$programa_id." and
                        k.articulo_id = ".$articulo_id.
                        " group by k.articulo_id";
                $cantidad_salida = $this->Programa_model->consultar($sql); 
                
                $total_salida = $cantidad_salida[0]["total_salida"];
                
                //Quinto.- Obtener los ingresos
                $sql = "select i.ingreso_fecha_ing, d.*
                        from programa p, ingreso i, detalle_ingreso d, articulo a
                        where
                        i.`programa_id` = p.`programa_id` and
                        i.ingreso_id = d.ingreso_id and
                        d.`articulo_id` = a.articulo_id and
                        i.gestion_id = ".$gestion_id." and 
                        p.programa_id = ".$programa_id." and
                        a.articulo_id = ".$articulo_id."
                        order by i.ingreso_fecha_ing asc";
                $detalle_ingreso = $this->Programa_model->consultar($sql);                
                
                //Sexto.- Recorrer las salidas y actualizar los saldos
                
                //if ($articulo_id == 76)
                //    echo "*** total_salida 76: ".$total_salida;
                
                foreach($detalle_ingreso as $d){
                    
                    $saldo_actual = $d["detalleing_cantidad"];
                    $detalleing_id = $d["detalleing_id"];
                    
                    if ($articulo_id == 76){
                        //echo " ****".$total_salida." >= ".$saldo_actual;
//                        echo "saldo actual: ".$saldo_actual;
//                        echo "detalleing_id: ".$detalleing_id;
                    }
                    
                    if($total_salida>=$saldo_actual){
                        
                        $sql = "update detalle_ingreso set detalleing_salida = detalleing_salida + ".$saldo_actual.
                               " where detalleing_id = ".$detalleing_id;
                        
                        if ($articulo_id == 76){
                            echo $sql;
                        }
                        
                        $this->Programa_model->ejecutar($sql);
                        
                        $total_salida = $total_salida - $saldo_actual;
                        
                    }else{
                        
                        if ($total_salida>0){
                            $sql = "update detalle_ingreso set detalleing_salida = detalleing_salida + ".$total_salida.
                                   " where detalleing_id = ".$detalleing_id;
                        $this->Programa_model->ejecutar($sql);
                            $total_salida = $total_salida - $saldo_actual;
                        }
                    }
                    
                    
                }
                
                //Septimo.- Actualizar los saldos
                
                /*$sql = "update detalle_ingreso set
                detalleing_saldo = detalleing_cantidad - detalleing_salida
                where detalleing_id in
                (select d.detalleing_id
                from programa p, ingreso i, detalle_ingreso d, articulo a
                where
                i.programa_id = p.programa_id and
                i.ingreso_id = d.ingreso_id and
                d.articulo_id = a.articulo_id and
                i.gestion_id = ".$gestion_id." and 
                p.programa_id = ".$programa_id." and
                a.articulo_id = ".$articulo_id."
                order by i.ingreso_fecha_ing asc)"; */
                
                $sql = "update programa p, ingreso i, detalle_ingreso d, articulo a set 
                        detalleing_saldo = detalleing_cantidad - detalleing_salida
                        where
                        i.programa_id = p.programa_id and
                        i.ingreso_id = d.ingreso_id and
                        d.articulo_id = a.articulo_id and
                        i.gestion_id = ".$gestion_id." and 
                        p.programa_id = ".$programa_id." and
                        a.articulo_id = ".$articulo_id;
                
                $this->Programa_model->ejecutar($sql);
                
                
            }
            
                echo json_encode("echo");
            
            
    }

    function reajustar_kardex()
    {
            $programa_id = $this->input->post('programa_id');
            $gestion_id = $this->input->post('gestion_id');
            $articulo_id = $this->input->post('articulo_id');
            
            $mssg = " programa_id = ".$programa_id." AND 
                      gestion_id = ".$gestion_id." AND 
                      articulo_id = ".$articulo_id;
            
            $this->Programa_model->bitacora("EJECUTAR MODULO","REAJUSTAR KARDEX ".$mssg);
 
            //primero.- Listar todos los ingresos del articulo
            $sql = "SELECT 
                        d.detalleing_id,d.ingreso_id, i.ingreso_fecha_ing, sum(d.detalleing_cantidad) as cantidad, d.detalleing_precio
                        FROM
                          ingreso i, detalle_ingreso d, programa p, articulo a
                        WHERE
                          i.programa_id = p.programa_id AND 
                          i.ingreso_id = d.ingreso_id AND 
                          d.articulo_id = a.articulo_id AND 
                          i.programa_id = ".$programa_id." AND 
                          i.gestion_id = ".$gestion_id." AND 
                          d.articulo_id = ".$articulo_id."
                        GROUP BY 
                         i.ingreso_id
                        ORDER BY
                          i.ingreso_fecha_ing, d.detalleing_id ASC";
            
            $entradas = $this->Programa_model->consultar($sql);
            
 
            //segundo.- Listar todos las salidas del articulo
            
            $sql = "SELECT 
                        s.salida_fechasal, d.*
                      FROM
                        salida s, detalle_salida d, programa p, articulo a
                      WHERE
                        s.programa_id = p.programa_id AND 
                        s.salida_id = d.salida_id AND 
                        d.articulo_id = a.articulo_id AND 
                        s.programa_id = ".$programa_id." AND 
                        s.gestion_id = ".$gestion_id." AND 
                        d.articulo_id = ".$articulo_id."
                      ORDER BY
                        s.salida_fechasal, d.detallesal_id";
            
            $salidas = $this->Programa_model->consultar($sql);
            
            //Definir la cantidad de salidas para el ciclo while
            if (isset($salidas)){
                $cantidad_salidas = sizeof($salidas);
            }else{
                $cantidad_salidas = 0;
            }
            
            //Tercero.- Recorrer todas las entradas

            $cantidad_ingreso = 0;
            $j = 0;
            $error = 0;
            
            foreach($entradas as $e){
                
                if ($cantidad_ingreso<0){
                    
                    $cantidad_ingreso = $e["cantidad"] + $cantidad_ingreso;
                    $error = 1;
                    
                }else{
                    
                    $cantidad_ingreso = $e["cantidad"];
                    
                }
                    
                
                $detalleing_id = $e["detalleing_id"];
                $detalleing_precio = $e["detalleing_precio"];
                $ingreso_id = $e["ingreso_id"];
                
                while($cantidad_ingreso > 0 && $j<$cantidad_salidas){
                    
                    $cantidad_salida = $salidas[$j]["detallesal_cantidad"];
                    $detallesal_id = $salidas[$j]["detallesal_id"];
                        
                        $sql = "update detalle_salida set ".
                                "detallesal_precio = ".$detalleing_precio.",".
                                "detallesal_total = ".$detalleing_precio."*".$cantidad_salida.",".
                                "detalleing_id = ".$detalleing_id.",".
                                "ingreso_id = ".$ingreso_id." ".
                                "where detallesal_id = ".$detallesal_id;
                        $this->Programa_model->ejecutar($sql);
                    
                    $cantidad_ingreso = $cantidad_ingreso - $cantidad_salida;
                    $j++;
                }
            }
            
            if ($error==1)
                echo json_encode("error");
            else
                echo json_encode("echo");            
            
    }
    

}
