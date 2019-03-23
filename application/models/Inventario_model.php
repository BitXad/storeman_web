<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Inventario_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get inventario
     */
    function get_inventario($gestion_id)
    {
        $sql = "SELECT *
                FROM
                  ingreso i,
                  detalle_ingreso d,
                  articulo a
                WHERE
                  i.ingreso_id = d.ingreso_id AND 
                  d.articulo_id = a.articulo_id AND
                  i.gestion_id = ".$gestion_id;
        $producto = $this->db->query($sql)->result_array();

        return $producto;
    }
    
    /*
     * get inventrio por unidad
     */
    function get_inventario_unidad($unidad_id)
    {
        
        $sql = "select * from
                pedido p, ingreso i,detalle_ingreso d, articulo a 

                where 
                p.unidad_id =".$unidad_id." and
                i.ingreso_id = p.ingreso_id and
                i.ingreso_id = d.ingreso_id and
                d.detalleing_saldo>0 and
                a.articulo_id = d.articulo_id and
                a.estado_id = 1";

        $producto = $this->db->query($sql)->result_array();
        
        //$producto = $this->db->query($sql,array('credito_id'))->row_array();
        return $producto;
    }
    
    /*
     * get inventrio por programa
     */
    function get_inventario_programa($programa_id)
    {
        
        $sql = "select * from
                pedido p, ingreso i,detalle_ingreso d, articulo a 

                where 
                p.programa_id =".$programa_id." and
                i.ingreso_id = p.ingreso_id and
                i.ingreso_id = d.ingreso_id and
                d.detalleing_saldo>0 and
                a.articulo_id = d.articulo_id and
                a.estado_id = 1";

        $producto = $this->db->query($sql)->result_array();
        
        //$producto = $this->db->query($sql,array('credito_id'))->row_array();
        return $producto;
    }

    
    /*
     * get inventrio por programa
     */
    function get_inventario_programa_unidad($unidad_id,$programa_id)
    {
        
        $sql = "select * from
                pedido p, ingreso i,detalle_ingreso d, articulo a 

                where 
                p.programa_id =".$programa_id." and
                p.unidad_id =".$unidad_id." and
                i.ingreso_id = p.ingreso_id and
                i.ingreso_id = d.ingreso_id and
                d.detalleing_saldo>0 and
                a.articulo_id = d.articulo_id and
                a.estado_id = 1";

        $producto = $this->db->query($sql)->result_array();
        
//        //$producto = $this->db->query($sql,array('credito_id'))->row_array();
        return $producto;
    }

    function get_inventario_codigo($codigo)
    {
        $sql = "select p.* from
                inventario p where p.estado_id = 1 and p.producto_codigobarra='".$codigo."'
              group by p.producto_id
              order by p.producto_nombre";

//        $sql = "select p.*,
//                (select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) as field_1 from detalle_compra d where d.producto_id = p.producto_id) as compras,
//                (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) as field_1 from detalle_venta d where d.producto_id = p.producto_id) as ventas,
//                (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) as field_1 from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11) as pedidos,
//                ((select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) from detalle_compra d where d.producto_id = p.producto_id) - (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) from detalle_venta d where d.producto_id = p.producto_id) - (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11)) as existencia
//              from
//                producto p
//              where p.estado_id=1 and p.producto_codigobarra='".$codigo."'
//              group by
//                p.producto_id
//              order by p.producto_id";
//
        $producto = $this->db->query($sql)->result_array();
        
        //$producto = $this->db->query($sql,array('credito_id'))->row_array();
        return $producto;
    }

    function get_inventario_parametro($parametro,$gestion_id)
    {
        $sql = "SELECT *
                FROM
                  ingreso i,
                  detalle_ingreso d,
                  articulo a
                WHERE
                  i.ingreso_id = d.ingreso_id AND 
                  d.articulo_id = a.articulo_id AND
                  i.gestion_id = ".$gestion_id." AND
                  a.articulo_nombre  like '%".$parametro."%' or a.articulo_codigo like '%".$parametro."%'
                ORDER BY
                   a.articulo_nombre
                ";
//        echo $sql;
//        return $sql;
        $producto = $this->db->query($sql)->result_array();
        return $producto;

    }

    function get_inventario_categoria($parametro)
    {
        $sql = " select i.* from inventario i where i.estado_id = 1 and i.categoria_id = ".$parametro.
               " group by i.producto_id order by i.producto_nombre";
  
        $producto = $this->db->query($sql)->result_array();
        return $producto;

    }

    /*
     * Get presentacion
     */
    function get_presentacion()
    {
        $sql = "select * from presentacion order by p.producto_nombre";
        $presentacion = $this->db->query($sql)->result_array();
        return $presentacion;
    }
    
//********************************//    
    /*
     * Get producto by producto_id
     */
    function get_producto($producto_id)
    {
        $producto = $this->db->query("
            SELECT
                *

            FROM
                `producto`

            WHERE
                `producto_id` = ?
        ",array($producto_id))->row_array();

        return $producto;
    }
    /*
     * actualizar inventario
     */
    function actualizar_inventario()
    {
        //Truncar la tabla inventario
        $sql = "truncate inventario";
        $this->db->query($sql);
        
        
        //cargar el inventario actualizado
        $sql = "insert into inventario
                (select p.*,
                (select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) as field_1 from detalle_compra d where d.producto_id = p.producto_id) as compras,
                (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) as field_1 from detalle_venta d where d.producto_id = p.producto_id) as ventas,
                (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) as field_1 from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11) as pedidos,
                ((select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) from detalle_compra d where d.producto_id = p.producto_id) - (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) from detalle_venta d where d.producto_id = p.producto_id) - (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11)) as existencia
                from
                producto p
                where p.estado_id = 1
                group by
                p.producto_id
                order by p.producto_nombre)";
        
        $this->db->query($sql);
        return true;
    }
    
    /*
     * actualizar inventario
     */
    function actualizar_producto_inventario($producto_id)
    {
        //Truncar la tabla inventario
        $sql = "delete from inventario where producto_id = ".$producto_id;
        $this->db->query($sql);
        
        
        //cargar el inventario actualizado
        $sql = "insert into inventario
                (select p.*,
                (select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) as field_1 from detalle_compra d where d.producto_id = p.producto_id) as compras,
                (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) as field_1 from detalle_venta d where d.producto_id = p.producto_id) as ventas,
                (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) as field_1 from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11) as pedidos,
                ((select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) from detalle_compra d where d.producto_id = p.producto_id) - (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) from detalle_venta d where d.producto_id = p.producto_id) - (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11)) as existencia
                from
                producto p  
                where p.producto_id = ".$producto_id."
                group by
                p.producto_id
                order by p.producto_nombre)";
        
        $this->db->query($sql);
        return true;
    }
    
    /*
     * 
     * actualizar el valor de un producto en la tabla inventario
     */
    function actualizar_cantidad_producto($producto_id)
    {

        
        //cargar el inventario actualizado
        $sql = "update inventario set existencia = 
                (select 
                (select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) as field_1 from detalle_compra d where d.producto_id = p.producto_id) as compras,
                (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) as field_1 from detalle_venta d where d.producto_id = p.producto_id) as ventas,
                (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) as field_1 from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11) as pedidos,
                ((select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) from detalle_compra d where d.producto_id = p.producto_id) - (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) from detalle_venta d where d.producto_id = p.producto_id) - (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11)) as existencia
                from
                producto p  
                where p.producto_id = ".$producto_id."
                group by
                p.producto_id
                order by p.producto_nombre)
                
                where producto_id =".$producto_id;
        
        $this->db->query($sql);
        return true;
    }
    
    /*
     * ingresa los datos de un producto al inventario
     */
    function ingresar_producto_inventario($producto_id)
    {
        //Truncar la tabla inventario
        $sql = "delete from inventario where producto_id = ".$producto_id;
        $this->db->query($sql);
        
        
        //cargar el inventario actualizado
        $sql = "insert into inventario
                (select p.*,0 as compras, 0 as ventas, 0 as pedidos, 0 as existencia
                from producto p  
                where p.producto_id = ".$producto_id."
                group by
                p.producto_id
                order by p.producto_nombre)";

        $this->db->query($sql);
        return true;
    }

    function ingresar_producto_a_inventario($producto_id,$existencia)
    {
        //Truncar la tabla inventario
        $sql = "delete from inventario where producto_id = ".$producto_id;
        $this->db->query($sql);
        
        
        //cargar el inventario actualizado
        $sql = "insert into inventario
                (select p.*,".$existencia." as compras, 0 as ventas, 0 as pedidos, ".$existencia." as existencia
                from producto p  
                where p.producto_id = ".$producto_id."
                group by
                p.producto_id
                order by p.producto_nombre)";

        $this->db->query($sql);
        return true;
    }


    /*
     * actualizar las cantidades del inventario
     */
    function actualizar_cantidad_inventario()
    {        
        
        //cargar el inventario actualizado
        $sql = "
                update inventario i,              
                (select p.*,
                (select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) as field_1 from detalle_compra d where d.producto_id = p.producto_id) as compras,
                (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) as field_1 from detalle_venta d where d.producto_id = p.producto_id) as ventas,
                (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) as field_1 from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11) as pedidos,
                ((select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) from detalle_compra d where d.producto_id = p.producto_id) - (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) from detalle_venta d where d.producto_id = p.producto_id) - (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11)) as existencia
                from
                producto p
                group by
                p.producto_id
                order by p.producto_id) as t1
                
                set
                i.compras = t1.compras,
                i.ventas = t1.ventas,
                i.pedidos = t1.pedidos
                
                where i.producto_id = t1.producto_id
                ";
        
        $this->db->query($sql);
        return true;
    }
 function rebajar_cantidad_producto($producto_id,$existencia)
    {

         //Truncar la tabla inventario
       
        //cargar el inventario actualizado
        $sql = "update inventario set inventario.existencia=inventario.existencia-".$existencia." where producto_id=".$producto_id."";

        $this->db->query($sql);
    }
 function aumentar_cantidad_producto($producto_id,$existencia,$ultimocosto,$producto_precio)
    {
        /////////////////////////recibir $ultimo costo y poner en la consulta set inventario.producto_ultimocosto=".$ultimocosto.", 
         //Truncar la tabla inventario
       
        //cargar el inventario actualizado
        $sql = "update inventario set inventario.producto_precio=".$producto_precio.", inventario.producto_ultimocosto=".$ultimocosto.", inventario.existencia=inventario.existencia+".$existencia." where producto_id=".$producto_id."";

        $this->db->query($sql);
    }
    
    /*
     * Get all inventario count
     */
    function get_all_inventario_count()
    {
        $inventario = $this->db->query("
            SELECT
                count(*) as count

            FROM
                `inventario`
        ")->row_array();

        return $inventario['count'];
    }
        
    /*
     * Get all inventario
     */
    function get_all_inventario($params = array())
    {
        $limit_condition = "";
        if(isset($params) && !empty($params))
            $limit_condition = " LIMIT " . $params['offset'] . "," . $params['limit'];
        
        $inventario = $this->db->query("
            SELECT
                *

            FROM
                `inventario`

            WHERE
                1 = 1

            ORDER BY `producto_nombre`

            " . $limit_condition . "
        ")->result_array();

        return $inventario;
    }
        
    /*
     * function to add new inventario
     */
    function add_inventario($params)
    {
        $this->db->insert('inventario',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update inventario
     */
    function update_inventario($producto_id,$params)
    {
        $this->db->where('producto_id',$producto_id);
        return $this->db->update('inventario',$params);
    }
    
    /*
     * function to delete inventario
     */
    function delete_inventario($producto_id)
    {
        return $this->db->delete('inventario',array('producto_id'=>$producto_id));
    }
    
    function get_inventario_coti($parametro)
    {
        $sql = "SELECT i.* FROM inventario i
              WHERE i.estado_id=1 and (i.producto_nombre like '%".$parametro."%' or i.producto_codigobarra like '%".$parametro."%'
                  or producto_codigo like '%".$parametro."%')
                  
              GROUP BY
                i.producto_id
              ORDER By i.producto_nombre asc";
  
//        $sql = "SELECT p.*,
//                (SELECT if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) AS FIELD_1 FROM detalle_compra d WHERE d.producto_id = p.producto_id) AS compras,
//                (SELECT if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) AS FIELD_1 FROM detalle_venta d WHERE d.producto_id = p.producto_id) AS ventas,
//                (SELECT if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) AS FIELD_1 FROM detalle_pedido e, pedido t WHERE t.pedido_id = e.pedido_id AND e.producto_id = p.producto_id AND t.estado_id = 11) AS pedidos,
//                ((select if(sum(d.detallecomp_cantidad) > 0, sum(d.detallecomp_cantidad), 0) from detalle_compra d where d.producto_id = p.producto_id) - (select if(sum(d.detalleven_cantidad) > 0, sum(d.detalleven_cantidad), 0) from detalle_venta d where d.producto_id = p.producto_id) - (select if(sum(e.detalleped_cantidad) > 0, sum(e.detalleped_cantidad), 0) from detalle_pedido e, pedido t where t.pedido_id = e.pedido_id and e.producto_id = p.producto_id and t.estado_id = 11)) AS existencia
//              FROM
//                producto p
//              WHERE p.estado_id=1 and p.producto_nombre like '%".$parametro."%' 
//              GROUP BY
//                p.producto_id
//              ORDER By p.producto_id";
//  
        $producto = $this->db->query($sql)->result_array();
        return $producto;

    }   
    
    function reducir_inventario($cant,$producto_id){
        $sql = "update inventario set existencia = existencia - ".$cant.
               " where producto_id = ".$producto_id;
        $this->db->query($sql);
        return true;
    }

    function incrementar_inventario($cant){
        $sql = "update inventario set existencia = existencia + ".$cant;
               " where producto_id = ".$producto_id;
        $this->db->query($sql);
        return true;
    }
    
    function reducir_inventario_aux($usuario_id){
        $sql = "update inventario i, detalle_venta_aux d set".
               " i.existencia = i.existencia - d.detalleven_cantidad ".
               " where i.producto_id = d.producto_id and d.usuario_id = ".$usuario_id;
        $this->db->query($sql);
        return true;
    }    
    
    
    function mostrar_kardex($desde, $hasta, $producto_id){
        
        $desde ='1900-01-01';
        $sql = "select * from
                (
                select 
                  c.compra_fecha as fecha,
                  c.compra_id as num_ingreso,
                  d.detallecomp_cantidad as unidad_comp,
                  d.detallecomp_costo as costoc_unit,
                  d.detallecomp_subtotal as importe_ingreso,
                  0 as num_salida,
                  0 as unidad_vend,
                  0 as costov_unit,
                  0 as importe_salida,
                  c.compra_hora as hora
                from
                  compra c,
                  detalle_compra d
                where
                  d.producto_id = ".$producto_id." and 
                  c.compra_id = d.compra_id and 
                  c.compra_fecha >= '".$desde."' and 
                  c.compra_fecha <= '".$hasta."'


                union

                select 
                  v.venta_fecha as fecha,
                  0 as num_ingreso,
                  0 as unidad_comp,
                  0 as costoc_unit,
                  0 as importe_ingreso,
                  v.venta_id as num_salida,
                  t.detalleven_cantidad as unidad_vend,
                  t.detalleven_costo as costov_unit,
                  t.detalleven_subtotal as importe_salida,
                  v.venta_hora as hora
                from
                  venta v,
                  detalle_venta t
                where
                  t.producto_id = ".$producto_id." and 
                  v.venta_id = t.venta_id and 
                  v.venta_fecha >= '".$desde."' and 
                  v.venta_fecha <= '".$hasta."'
                  ) as tx

                  order by fecha, hora";
 
        $kardex = $this->db->query($sql)->result_array();
        return $kardex;
    }    
    
    function mostrar_duplicados_inventario(){
        
        $sql = "select x.* 
                from inventario x

                where                 
                x.estado_id = 1 and
                x.producto_codigobarra <> '-' and
                x.producto_codigobarra <> '' and
                (select count(*) from producto y where y.producto_codigobarra = x.producto_codigobarra and y.estado_id = 1)>=2

                order by x.producto_codigobarra";
        
        $duplicados = $this->db->query($sql)->result_array();
        return $duplicados;
    }    
    
    function finalizar_salida(){
        
                $usuario_id = 1; //$session_data['usuario_id'];
                $gestion_id = 1;
        if ($this->input->is_ajax_request()) {
                 
                
                $salida_id = $this->input->post('salida_id'); 
                echo "Salida: ".$salida_id;
                
                
//                $programa_id = $this->input->post('programa_id');
//                $unidad_id = $this->input->post('unidad_id');
//                $salida_motivo = $this->input->post('salida_motivo');
//                $salida_fechasal = $this->input->post('salida_fechasal');
//                $salida_acta = $this->input->post('salida_acta');
//                $salida_obs = $this->input->post('salida_obs');
//                $salida_fecha = date('Y-m-d');
//                $salida_hora = date('H:i:s');
//                $salida_doc = $this->input->post('salida_doc');
//                $estado_id = 1;
//                
//                $sql = "update salida set ".
//                "programa_id = ".$programa_id.
//                ",unidad_id = ".$unidad_id.
//                ",salida_motivo = ".$salida_motivo.
//                ",salida_fechasal = ".$salida_fechasal.
//                ",salida_acta = ".$salida_acta.
//                ",salida_obs = '".$salida_obs."'".
//                ",salida_fecha = ".$salida_fecha.
//                ",salida_hora = '".$salida_hora."'".
//                ",salida_doc = ".$salida_doc.
//                ",estado_id = ".$estado_id.
//                " where salida_id = ".$salida_id;
//            
               
//                $this->Salida_model->ejecutar($sql);
//            
//                        
//                
//
//                
//
//            $sql = "select 
//                    detallesal_id,
//                    salida_id,
//                    articulo_id,
//                    programa_id,
//                    detallesal_cantidad,
//                    detallesal_precio,
//                    detallesal_total,
//                    usuario_id
//                    from detalle_salida_aux
//                    where salida_id = 39
//
//
//                    insert into detalle_salida(
//
//                    salida_id,
//                    articulo_id,
//                    programa_id,
//                    detallesal_cantidad,
//                    detallesal_precio,
//                    detallesal_total
//                    )
//
//                    (
//                    select 
//
//                    salida_id,
//                    articulo_id,
//                    programa_id,
//                    detallesal_cantidad,
//                    detallesal_precio,
//                    detallesal_total
//                    from detalle_salida_aux
//                    where salida_id = ".$salida_id."
//                    )";
//
//            $this->Salida_model->ejecutar($sql);
//            
//            $result = 1;
//            echo '[{"cliente_id":"'.$result.'"}]';
            
//                    }
//                else
//                {                 
//                            show_404();
//                }  
            
            
        }
        else { $result = 0;  echo '[{"cliente_id":"'.$result.'"}]';}
            
        //**************** fin contenido *************
    }    
    
    
}
