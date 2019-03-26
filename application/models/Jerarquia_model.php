<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Jerarquia_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get jerarquia by jerarquia_id
     */
    function get_jerarquia($jerarquia_id)
    {
        return $this->db->get_where('jerarquia',array('jerarquia_id'=>$jerarquia_id))->row_array();
    }
        
    /*
     * Get all jerarquia
     */
    function get_all_jerarquia()
    {
        $sql = "SELECT
                j.*, e.estado_color, e.estado_descripcion

            FROM
                jerarquia j

            LEFT JOIN estado e on j.estado_id = e.estado_id
                
            ORDER By j.jerarquia_id DESC";

        $jerarquia = $this->db->query($sql)->result_array();
        return $jerarquia;
    }
        
    /*
     * function to add new jerarquia
     */
    function add_jerarquia($params)
    {
        $this->db->insert('jerarquia',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update jerarquia
     */
    function update_jerarquia($jerarquia_id,$params)
    {
        $this->db->where('jerarquia_id',$jerarquia_id);
        return $this->db->update('jerarquia',$params);
    }
    
    /*
     * function to delete jerarquia
     */
    function delete_jerarquia($jerarquia_id)
    {
        return $this->db->delete('jerarquia',array('jerarquia_id'=>$jerarquia_id));
    }
    /*
     * Get all jerarquia tipo 1
     */
    function get_all_jerarquia_activo()
    {
        $sql = "SELECT
                j.*, e.estado_color, e.estado_descripcion

            FROM
                jerarquia j

            LEFT JOIN estado e on j.estado_id = e.estado_id
            WHERE j.estado_id = 1
            ORDER By j.jerarquia_id DESC";

        $jerarquia = $this->db->query($sql)->result_array();
        return $jerarquia;
    }
}
