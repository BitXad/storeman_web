<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Institucion_model extends CI_Model
{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        
        $this->session_data = $this->session->userdata('logged_in');

    }
    
    /*
     * Get institucion by institucion_id
     */
    function get_institucion($institucion_id)
    {
        $institucion = $this->db->query("
            SELECT
                *

            FROM
                `institucion`

            WHERE
                `institucion_id` = ?
        ",array($institucion_id))->row_array();

        return $institucion;
    }
    
    /*
     * Devuelve numero de instituciones
     */
    function get_all_institucion_count()
    {
        $institucion = $this->db->query("
            SELECT
                count(*) as res

            FROM
                `institucion`

            WHERE
                1 = 1

            ORDER BY `institucion_id` DESC
        ")->row_array();

        return $institucion['res'];
    }
    /*
     * Get all institucion
     */
    function get_all_institucion()
    {
        $institucion = $this->db->query("
            SELECT
                *

            FROM
                `institucion`

            WHERE
                1 = 1

            ORDER BY `institucion_id` 
        ")->result_array();

        return $institucion;
    }
        
    /*
     * function to add new institucion
     */
    function add_institucion($params)
    {
        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'INSERT');
        //********** fin registro en bitacora ***********//
        
        $this->db->insert('institucion',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update institucion
     */
    function update_institucion($institucion_id,$params)
    {
        
        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//

        $this->db->where('institucion_id',$institucion_id);
        return $this->db->update('institucion',$params);
    }
    
    /*
     * function to delete institucion
     */
    function delete_institucion($institucion_id)
    {
        
        //********** registro en bitacora ***********//
        $sql = "institucion_id : ".$institucion_id;
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        return $this->db->delete('institucion',array('institucion_id'=>$institucion_id));
    }
                    
    function bitacora($sql, $operacion){
        
        $sql =  str_replace("'", "`", $sql);
        $usuario_id = $this->session_data['usuario_id'];
        
        $bitacora_fecha = "'".date("Y-m-d")."'";
        $bitacora_hora = "'".date("H:i:s")."'";
        $bitacora_operacion = "'".$operacion." "."INSTITUCION'";
        $bitacora_consulta = "'".$sql."'";
        $bitacora_anterior ="''";
        
        $sql = "insert into bitacora(bitacora_fecha,bitacora_hora,bitacora_operacion,bitacora_consulta,bitacora_anterior,usuario_id) value(".
                $bitacora_fecha.",".$bitacora_hora.",".$bitacora_operacion.",".$bitacora_consulta.",".$bitacora_anterior.",".$usuario_id.")";
    
        $this->db->query($sql);
        return true;
    }
}
