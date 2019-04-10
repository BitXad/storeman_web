<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Programa_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get programa by programa_id
     */
    function get_programa($programa_id)
    {
        $programa = $this->db->query("
            SELECT
                *

            FROM
                `programa`

            WHERE
                `programa_id` = ?
        ",array($programa_id))->row_array();

        return $programa;
    }
    
    function get_articulop($parametro,$programa_id,$fecha_desde,$fecha_hasta)
    {
        

        $articulo = $this->db->query("
            SELECT
                a.*, pr.programa_id, i.*, di.articulo_id, di.ingreso_id, SUM(di.detalleing_saldo) as sumas
            FROM
                articulo a

            LEFT JOIN detalle_ingreso di on di.articulo_id=a.articulo_id
            LEFT JOIN ingreso i on di.ingreso_id=i.ingreso_id
            LEFT JOIN programa pr on i.programa_id=pr.programa_id

            WHERE
                pr.programa_id=".$programa_id."
                and i.ingreso_fecha_ing >= '".$fecha_desde."'
                and i.ingreso_fecha_ing <= '".$fecha_hasta."'
                and  (a.articulo_nombre like '%".$parametro."%' or a.articulo_industria like '%".$parametro."%'
                  or a.articulo_codigo like '%".$parametro."%')
            GROUP BY a.articulo_id 

        ")->result_array();

        return $articulo;
    }
    function get_articulodatos($parametro,$programa_id)
    {
        

        $articulo = $this->db->query("
            SELECT
                a.*, pr.programa_id, pr.programa_nombre, i.ingreso_id, di.articulo_id, di.ingreso_id
            FROM
                articulo a

            LEFT JOIN detalle_ingreso di on di.articulo_id=a.articulo_id
            LEFT JOIN ingreso i on di.ingreso_id=i.ingreso_id
            LEFT JOIN programa pr on i.programa_id=pr.programa_id

            WHERE
                pr.programa_id=".$programa_id."
                and  (a.articulo_nombre like '%".$parametro."%' or a.articulo_industria like '%".$parametro."%'
                  or a.articulo_codigo like '%".$parametro."%')

        ")->result_array();

        return $articulo;
    }

    function get_kardex($parametro,$programa_id)
    {
        

        $articulo = $this->db->query("
            SELECT
                a.*, pr.programa_id, p.pedido_id, i.*, di.articulo_id, di.*, s.*, ds.*
            FROM
                articulo a

            LEFT JOIN detalle_ingreso di on di.articulo_id=a.articulo_id
            LEFT JOIN ingreso i on di.ingreso_id=i.ingreso_id
            LEFT JOIN pedido p on p.pedido_id=i.pedido_id
            LEFT JOIN programa pr on p.programa_id=pr.programa_id
            LEFT JOIN detalle_salida ds on p.programa_id=ds.programa_id
            LEFT JOIN salida s on ds.salida_id=s.salida_id

            WHERE
                pr.programa_id=".$programa_id."
                and  (a.articulo_nombre like '%".$parametro."%' or a.articulo_industria like '%".$parametro."%'
                  or a.articulo_codigo like '%".$parametro."%')
            ORDER BY i.ingreso_fecha_ing
        ")->result_array();

        return $articulo;
    }
    function mostrar_kardex($programa_id,$articulo_id,$fecha_desde,$fecha_hasta,$gestion_inicio){
        
            
        $sql = "select * from
                (
                select 
                  c.ingreso_fecha_ing as fecha,
                  c.ingreso_numdoc as num_ingreso,
                  d.detalleing_cantidad as unidad_comp,
                  d.detalleing_precio as precioc_unit,
                  d.detalleing_total as importe_ingreso,
                  0 as num_salida,
                  0 as unidad_vend,
                  0 as preciov_unit,
                  0 as importe_salida,
                  c.ingreso_hora as hora,
                  c.programa_id
                from
                  ingreso c,
                  detalle_ingreso d
                  
                where
                  d.articulo_id = ".$articulo_id." and 
                  c.ingreso_id = d.ingreso_id and
                  c.ingreso_fecha_ing >= '".$gestion_inicio."' and
                  c.ingreso_fecha_ing <= '".$fecha_hasta."' and
                  c.programa_id = ".$programa_id."
                  

                union

                select 
                  v.salida_fecha as fecha,
                  0 as num_ingreso,
                  0 as unidad_comp,
                  0 as precioc_unit,
                  0 as importe_ingreso,
                  v.salida_doc as num_salida,
                  t.detallesal_cantidad as unidad_vend,
                  t.detallesal_precio as preciov_unit,
                  t.detallesal_total as importe_salida,
                  v.salida_hora as hora,
                  v.programa_id                  
                
                from
                  salida v,
                  detalle_salida t
                 
                where
                  t.articulo_id = ".$articulo_id." and 
                  v.salida_id = t.salida_id and 
                  v.salida_fecha >= '".$gestion_inicio."' and
                  v.salida_fecha <= '".$fecha_hasta."' and
                  v.programa_id = ".$programa_id."
                  ) as tx

                  order by fecha, hora";
 
        $kardex = $this->db->query($sql)->result_array();
        return $kardex;
    }    
    /*
     * Get all programa
     */
    function get_all_programa()
    {
        $programa = $this->db->query("
            SELECT
                *

            FROM
                `programa`

            WHERE
                1 = 1

            ORDER BY `programa_nombre` 
        ")->result_array();

        return $programa;
    }
        
    /*
     * function to add new programa
     */
    function add_programa($params)
    {
        $this->db->insert('programa',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update programa
     */
    function update_programa($programa_id,$params)
    {
        $this->db->where('programa_id',$programa_id);
        return $this->db->update('programa',$params);
    }
    
    /*
     * function to delete programa
     */
    function delete_programa($programa_id)
    {
        return $this->db->delete('programa',array('programa_id'=>$programa_id));
    }
    
    /*
     * function to delete programa
     */
    function inactivar_programa($programa_id)
    {
        $sql = "update programa set estado_id = 2 where programa_id = ".$programa_id;
        
        return $this->db->query($sql);
    }
    
    /*
     * retorna la cantidad total de programas activos
     */
    function get_programa_count()
    {
        $sql = "select if(count(*)>0,count(*),0) as cantidad_programa from programa where estado_id = 1";
        
        $resultado = $this->db->query($sql)->result_array();
        return $resultado;
    }
    /*
     * Get all programa
     */
    function get_all_programas()
    {
        $programa = $this->db->query("
            SELECT
                p.*, e.estado_color, e.estado_descripcion,
                u.unidad_nombre

            FROM
                programa p
            LEFT JOIN estado e on p.estado_id = e.estado_id
            LEFT JOIN unidad u on p.unidad_id = u.unidad_id

            ORDER BY p.programa_nombre
        ")->result_array();

        return $programa;
    }
}
