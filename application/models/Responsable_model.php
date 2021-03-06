<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Responsable_model extends CI_Model
{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        
        $this->session_data = $this->session->userdata('logged_in');

    }
    
    /*
     * Get responsable by responsable_id
     */
    function get_responsable($responsable_id)
    {
        $responsable = $this->db->query("
            SELECT
                *

            FROM
                `responsable_pago`

            WHERE
                `responsable_id` = ?
        ",array($responsable_id))->row_array();

        return $responsable;
    }
        
    /*
     * Get all responsable
     */
    function get_all_responsable()
    {
       $sql = "SELECT
                j.*, e.estado_color, e.estado_descripcion

            FROM
                responsable_pago j

            LEFT JOIN estado e on j.estado_id = e.estado_id
                
            ORDER By j.responsable_id DESC";

        $responsable = $this->db->query($sql)->result_array();
        return $responsable;
    }
        
    /*
     * function to add new responsable
     */
    function add_responsable($params)
    {

        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'INSERT');
        //********** fin registro en bitacora ***********//
        
        
        $this->db->insert('responsable_pago',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update responsable
     */
    function update_responsable($responsable_id,$params)
    {

        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        $this->db->where('responsable_id',$responsable_id);
        return $this->db->update('responsable_pago',$params);
    }
    
    /*
     * function to delete responsable
     */
    function delete_responsable($responsable_id)
    {
        
        
        //********** registro en bitacora ***********//
        $sql = "responsable_id ".$responsable_id;
        $this->bitacora($sql,'DELETE');
        //********** fin registro en bitacora ***********//
        
        
        return $this->db->delete('responsable_pago',array('responsable_id'=>$responsable_id));
    }

    function inactivar_responsable($responsable_id)
    {
        $sql = "update responsable_pago set estado_id = 2 where responsable_id = ".$responsable_id;

        //********** registro en bitacora ***********//
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        
        return $this->db->query($sql);
    }

    function activar_responsable($responsable_id)
    {
        $sql = "update responsable_pago set estado_id = 1 where responsable_id = ".$responsable_id;
        //********** registro en bitacora ***********//
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        return $this->db->query($sql);
    }
            
    function bitacora($sql, $operacion){
        
        $sql =  str_replace("'", "`", $sql);
        $usuario_id = $this->session_data['usuario_id'];
        
        $bitacora_fecha = "'".date("Y-m-d")."'";
        $bitacora_hora = "'".date("H:i:s")."'";
        $bitacora_operacion = "'".$operacion." "."SALIDA'";
        $bitacora_consulta = "'".$sql."'";
        $bitacora_anterior ="''";
        
        $sql = "insert into bitacora(bitacora_fecha,bitacora_hora,bitacora_operacion,bitacora_consulta,bitacora_anterior,usuario_id) value(".
                $bitacora_fecha.",".$bitacora_hora.",".$bitacora_operacion.",".$bitacora_consulta.",".$bitacora_anterior.",".$usuario_id.")";
    
        $this->db->query($sql);
        return true;
    } 
    
}
