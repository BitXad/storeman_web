<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Detalle_salida_model extends CI_Model
{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        
        $this->session_data = $this->session->userdata('logged_in');

    }
    
    /*
     * Get detalle_salida by detallesal_id
     */
    function get_detalle_salida($salida_id)
    {
        $sql = "SELECT * FROM detalle_salida d, articulo a            
            WHERE d.articulo_id = a.articulo_id and
            d.salida_id = ".$salida_id;    
                
        $detalle_salida = $this->db->query($sql)->result_array();
        return $detalle_salida;
    }
        
    /*
     * Get all detalle_salida
     */
    function get_all_detalle_salida()
    {
        $detalle_salida = $this->db->query("
            SELECT
                *

            FROM
                `detalle_salida`

            WHERE
                1 = 1

            ORDER BY `detallesal_id` 
        ")->result_array();

        return $detalle_salida;
    }
        
    /*
     * function to add new detalle_salida
     */
    function add_detalle_salida($params)
    {
        
        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'INSERT');
        //********** fin registro en bitacora ***********//
        
        
        $this->db->insert('detalle_salida',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update detalle_salida
     */
    function update_detalle_salida($detallesal_id,$params)
    {
        
        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        
        $this->db->where('detallesal_id',$detallesal_id);
        return $this->db->update('detalle_salida',$params);
    }
    
    /*
     * function to delete detalle_salida
     */
    function delete_detalle_salida($detallesal_id)
    {
        
        
        //********** registro en bitacora ***********//
        $sql = "detallesal_id : ".$detallesal_id;
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        return $this->db->delete('detalle_salida',array('detallesal_id'=>$detallesal_id));
    }
    
    function bitacora($sql, $operacion){
        
        $sql =  str_replace("'", "`", $sql);
        $usuario_id = $this->session_data['usuario_id'];
        
        $bitacora_fecha = "'".date("Y-m-d")."'";
        $bitacora_hora = "'".date("H:i:s")."'";
        $bitacora_operacion = "'".$operacion." "."DETALLE_SALIDA'";
        $bitacora_consulta = "'".$sql."'";
        $bitacora_anterior ="''";
        
        $sql = "insert into bitacora(bitacora_fecha,bitacora_hora,bitacora_operacion,bitacora_consulta,bitacora_anterior,usuario_id) value(".
                $bitacora_fecha.",".$bitacora_hora.",".$bitacora_operacion.",".$bitacora_consulta.",".$bitacora_anterior.",".$usuario_id.")";
    
        $this->db->query($sql);
        return true;
    }
}
