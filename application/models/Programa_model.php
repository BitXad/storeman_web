<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Programa_model extends CI_Model
{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        
        $this->session_data = $this->session->userdata('logged_in');

        
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
    
    function get_articulop($parametro,$programa_id,$fecha_desde,$fecha_hasta,$gestion)
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
                and i.gestion_id=".$gestion."
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
    function mostrar_kardex($programa_id,$articulo_id,$fecha_desde,$fecha_hasta,$gestion_inicio,$gestion){
        
            
        $sql = "select * 
                from
                vista_kardex
                where
                  articulo_id = ".$articulo_id." and 
                  fecha >= '".$gestion_inicio."' and
                  fecha <= '".$fecha_hasta."' and
                  programa_id = ".$programa_id." and
                  (estado_id <> 2 and estado_id <> 5)
                 and gestion_id =".$gestion."

                  order by fecha";
 
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

        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'DELETE');
        //********** fin registro en bitacora ***********//
                
        
        $this->db->insert('programa',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update programa
     */
    function update_programa($programa_id,$params)
    {

        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        $this->db->where('programa_id',$programa_id);
        return $this->db->update('programa',$params);
    }
    
    /*
     * function to delete programa
     */
    function delete_programa($programa_id)
    {

        //********** registro en bitacora ***********//
        $sql = "programa_id : ".$programa_id;
        $this->bitacora($sql,'DELETE');
        //********** fin registro en bitacora ***********//
        
        return $this->db->delete('programa',array('programa_id'=>$programa_id));
    }
    
    /*
     * function to delete programa
     */
    function inactivar_programa($programa_id)
    {
        $sql = "update programa set estado_id = 2 where programa_id = ".$programa_id;

        //********** registro en bitacora ***********//
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        return $this->db->query($sql);
    }

    function activar_programa($programa_id)
    {
        $sql = "update programa set estado_id = 1 where programa_id = ".$programa_id;

        //********** registro en bitacora ***********//
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        
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
    function get_programainventario($gestion_id, $programa_id, $fecha_hasta)
    {
   /*     $programa = $this->db->query("
            select 
                v.`articulo_codigo`,
                v.`articulo_id`,
                v.`articulo_nombre`,
                v.`articulo_unidad`,
                v.`programa_id`,
                v.`programa_nombre`,
                sum(v.`cantidad_ingreso`) as ingresos,
                sum(v.`cantidad_salida`) as salidas,
                sum(v.`cantidad_ingreso`-v.cantidad_salida) as saldos,
                sum(v.`cantidad_ingreso`*v.`precio_ingreso` - v.cantidad_salida*v.`precio_salida`) / sum(v.`cantidad_ingreso`-v.cantidad_salida) as precio_unitario
            from
                vista_kardex v
            where 
                v.gestion_id = $gestion_id and
                v.programa_id = $programa_id and
                v.fecha <= '$fecha_hasta'
                group by v.articulo_id
                order by v.articulo_nombre
        ")->result_array();*/


        $programa = $this->db->query("
            select 
                v.`articulo_codigo`,
                v.`articulo_id`,
                v.`articulo_nombre`,
                v.`articulo_unidad`,
                v.`programa_id`,
                v.`programa_nombre`,
                sum(v.`cantidad_ingreso`) as ingresos,
                sum(v.`cantidad_salida`) as salidas,
                sum(v.`cantidad_ingreso`- v.ingsalida) as saldos,
                avg(v.precio_ingreso) as precio_unitario
            from
                vista_kardex v
            where 
                v.gestion_id = $gestion_id and
                v.programa_id = $programa_id and
                v.fecha <= '$fecha_hasta'
                group by v.articulo_id, v.precio_ingreso
                order by v.articulo_nombre
        ")->result_array();

        return $programa;
    }

    function get_consumidos($gestion_id, $programa_id, $fecha_hasta)
    {
        $programa = $this->db->query("
            select 
                v.`articulo_codigo`,
                v.`articulo_id`,
                v.`articulo_nombre`,
                v.`articulo_unidad`,
                v.`programa_id`,
                v.`programa_nombre`,
                sum(v.`cantidad_ingreso`) as ingresos,
                sum(v.`cantidad_salida`) as salidas,
                sum(v.`cantidad_ingreso`-v.cantidad_salida) as saldos,
                sum(v.`cantidad_salida`*v.`precio_salida`) / sum(v.cantidad_salida) as precio_unitario
            from
                vista_kardex v
            where 
                v.gestion_id = $gestion_id and
                v.programa_id = $programa_id and
                v.fecha <= '$fecha_hasta'
                group by v.articulo_id
        ")->result_array();

        return $programa;
    }
    function get_articulo_porprogramadatos($articulo_id,$programa_id)
    {
        

        $articulo = $this->db->query("
            SELECT
                a.articulo_nombre, a.articulo_codigo, a.`articulo_unidad`,
                 pr.programa_id, pr.programa_nombre
            FROM
                articulo a
            LEFT JOIN detalle_ingreso di on di.articulo_id=a.articulo_id
            LEFT JOIN ingreso i on di.ingreso_id=i.ingreso_id
            LEFT JOIN programa pr on i.programa_id=pr.programa_id
            WHERE
                pr.programa_id=".$programa_id."
                and  a.articulo_id = $articulo_id
        ")->result_array();

        return $articulo;
    }
    
    function ejecutar($sql)
    {     
        //********** registro en bitacora ***********//
        $this->bitacora($sql,'EJECUTAR');
        //********** fin registro en bitacora ***********//
        
        $this->db->query($sql);
        //return $this->db->insert_id();
        return true;
    }
    
    function consultar($sql)
    {     
        
        return $this->db->query($sql)->result_array();
     
    }
    function get_articulos($parametro)
    {
        $articulo = $this->db->query("
            SELECT
                a.articulo_nombre, a.articulo_id
            FROM
                articulo a
            WHERE
                a.articulo_nombre like '%".$parametro."%' 
                or a.articulo_codigo like '%".$parametro."%'
            GROUP BY a.articulo_id 

        ")->result_array();

        return $articulo;
    }
    /* obtiene programa y articulo de la gestion */
    function getprograma_articulo($programa_id, $articulo_id, $gestion_id)
    {
        $articulo = $this->db->query("
            select a.*,i.`programa_id`,i.`gestion_id`, d.*
            from articulo a, ingreso i, detalle_ingreso d
            where 
            i.ingreso_id = d.ingreso_id and
            d.articulo_id = a.articulo_id and
            d.`detalleing_saldo` > 0 and
            a.articulo_id = $articulo_id and
            i.`programa_id` = $programa_id and
            i.gestion_id = $gestion_id

        ")->result_array();

        return $articulo;
    }
                
    function bitacora($sql, $operacion){
        
        $sql =  str_replace("'", "`", $sql);
        $usuario_id = $this->session_data['usuario_id'];
        
        $bitacora_fecha = "'".date("Y-m-d")."'";
        $bitacora_hora = "'".date("H:i:s")."'";
        $bitacora_operacion = "'".$operacion." "."PROGRAMA'";
        $bitacora_consulta = "'".$sql."'";
        $bitacora_anterior ="''";
        
        $sql = "insert into bitacora(bitacora_fecha,bitacora_hora,bitacora_operacion,bitacora_consulta,bitacora_anterior,usuario_id) value(".
                $bitacora_fecha.",".$bitacora_hora.",".$bitacora_operacion.",".$bitacora_consulta.",".$bitacora_anterior.",".$usuario_id.")";
    
        $this->db->query($sql);
        return true;
    }
    
}

