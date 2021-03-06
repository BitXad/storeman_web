<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Articulo_model extends CI_Model
{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        
        $this->session_data = $this->session->userdata('logged_in');

        
    }
    
    /*
     * Get articulo by articulo_id
     */
    function get_articulo($articulo_id)
    {
        
        $articulo = $this->db->query("
            SELECT
                *

            FROM
                `articulo`

            WHERE
                `articulo_id` = ?
        ",array($articulo_id))->row_array();

        return $articulo;
    }

     function get_articulox($parametro)
    {
        

        $articulo = $this->db->query("
            SELECT
                a.*

            FROM
                articulo a

            WHERE
                a.articulo_nombre like '%".$parametro."%' or a.articulo_industria like '%".$parametro."%'
                  or a.articulo_codigo like '%".$parametro."%'

        ")->result_array();

        return $articulo;
    }
        
    /*
     * Get all articulo
     */
    function get_all_articulo()
    {
        $articulo = $this->db->query("
            SELECT
                a.*, e.estado_color, e.estado_descripcion, e.estado_id, c.categoria_nombre

            FROM
                articulo a
                LEFT JOIN estado e on a.estado_id = e.estado_id
                LEFT JOIN categoria c on a.categoria_id = c.categoria_id
            WHERE
                a.estado_id = e.estado_id

            ORDER BY a.articulo_id
        ")->result_array();

        return $articulo;
    }
        
    /*
     * function to add new articulo
     */
    function add_articulo($params)
    {
        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'INSERT');
        //********** fin registro en bitacora ***********//
        
        $this->db->insert('articulo',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update articulo
     */
    function update_articulo($articulo_id,$params)
    {
        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        $this->db->where('articulo_id',$articulo_id);
        return $this->db->update('articulo',$params);
    }
    
    /*
     * function to delete articulo
     */
    function delete_articulo($articulo_id)
    {
        
        //********** registro en bitacora ***********//
        $sql =" articulo_id:".$articulo_id;
        $this->bitacora($sql,'DELETE');
        //********** fin registro en bitacora ***********//
        
        
        
        return $this->db->delete('articulo',array('articulo_id'=>$articulo_id));
    }
    /*
     * function to da de baja una articulo
     */
    function inactivar_articulo($articulo_id)
    {
        $sql = "update articulo set estado_id = 2 where articulo_id = ".$articulo_id;
        
        //********** registro en bitacora ***********//
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        return $this->db->query($sql);
    }
    function activar_articulo($articulo_id)
    {
        $sql = "update articulo set estado_id = 1 where articulo_id = ".$articulo_id;
        
        //********** registro en bitacora ***********//
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        return $this->db->query($sql);
    }
    
    /*
     * Get all articulo parametro
     */
    function get_all_articuloparametro($parametro, $categoria)
    {
        $articulo = $this->db->query("
            SELECT
                a.*, e.estado_color, e.estado_descripcion, e.estado_id, c.categoria_nombre

            FROM
                articulo a
                LEFT JOIN estado e on a.estado_id = e.estado_id
                LEFT JOIN categoria c on a.categoria_id = c.categoria_id
            WHERE
                a.estado_id = e.estado_id
                and (a.articulo_nombre like '%".$parametro."%' or a.articulo_marca like '%".$parametro."%'
                   or a.articulo_industria like '%".$parametro."%' or a.articulo_codigo like '%".$parametro."%')
                ".$categoria."
            GROUP BY
                a.articulo_id

            ORDER BY a.articulo_nombre
        ")->result_array();

        return $articulo;
    }
    /*
     * Verifica si ya hay un Articulo registrado con el mismo nombre
     */
    function es_articulo_registrado($articulo_nombre)
    {
        $sql = "SELECT
                      count(a.articulo_id) as resultado
                  FROM
                      articulo a
                 WHERE
                      a.articulo_nombre = '".$articulo_nombre."'";

        $articulo = $this->db->query($sql)->row_array();
        return $articulo['resultado'];
    }
    
    /*
     * Get all articulo parametro
     */
    function get_all_articulolimit()
    {
        $articulo = $this->db->query("
            SELECT
                a.*, e.estado_color, e.estado_descripcion, e.estado_id, c.categoria_nombre

            FROM
                articulo a
                LEFT JOIN estado e on a.estado_id = e.estado_id
                LEFT JOIN categoria c on a.categoria_id = c.categoria_id

            GROUP BY
                a.articulo_id

            ORDER BY a.articulo_nombre limit 50
        ")->result_array();

        return $articulo;
    }

    /*
     * Cuenta la cantidad de articulos
     */
    function get_articulo_count()
    {
        $articulo = $this->db->query("
            select count(*) as cantidad_articulos from articulo where estado_id = 1
        ")->result_array();

        return $articulo;
    }
    
    /*
     * Funcion que verifica si un producto fue usado en otros modulos
     */
    function articulo_es_usado($articulo_id){
        $articulo = $this->db->query("
            SELECT sum(
            (SELECT if(count(di.articulo_id) > 0, count(di.articulo_id), 0) AS FIELD_1
             FROM detalle_ingreso di
             WHERE di.articulo_id = a.articulo_id and di.articulo_id = '$articulo_id') +
            (SELECT if(count(dia.articulo_id) > 0, count(dia.articulo_id), 0) AS FIELD_1
             FROM detalle_ingreso_aux dia
             WHERE dia.articulo_id = a.articulo_id and a.articulo_id = '$articulo_id') +
            (SELECT if(count(ds.articulo_id) > 0, count(ds.articulo_id), 0) AS FIELD_1
             FROM detalle_salida ds
             WHERE ds.articulo_id = a.articulo_id AND a.articulo_id = '$articulo_id')+
            (SELECT if(count(dsa.articulo_id) > 0, count(dsa.articulo_id), 0) AS FIELD_1
             FROM detalle_salida_aux dsa
             WHERE dsa.articulo_id = a.articulo_id AND a.articulo_id = '$articulo_id')) as res
             FROM
                articulo a
              WHERE a.articulo_id = '$articulo_id'
        ",array($articulo_id))->row_array();

        return $articulo['res'];
    }
    
    /*
     * Get all articulo
     */
    function get_all_articulo_kardex()
    {
        $articulo = $this->db->query("
            SELECT
                *

            FROM
                `articulo`

            WHERE
                1 = 1

            ORDER BY `articulo_id` DESC
        ")->result_array();

        return $articulo;
    }
            
    function bitacora($sql, $operacion){
        
        $sql =  str_replace("'", "`", $sql);
        $usuario_id = $this->session_data['usuario_id'];
        
        $bitacora_fecha = "'".date("Y-m-d")."'";
        $bitacora_hora = "'".date("H:i:s")."'";
        $bitacora_operacion = "'".$operacion." "."ARTICULO'";
        $bitacora_consulta = "'".$sql."'";
        $bitacora_anterior ="''";
        
        $sql = "insert into bitacora(bitacora_fecha,bitacora_hora,bitacora_operacion,bitacora_consulta,bitacora_anterior,usuario_id) value(".
                $bitacora_fecha.",".$bitacora_hora.",".$bitacora_operacion.",".$bitacora_consulta.",".$bitacora_anterior.",".$usuario_id.")";
    
        $this->db->query($sql);
        return true;
    }
}
