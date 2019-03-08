<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Unidad_manejo_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get unidad_manejo by umanejo_id
     */
    function get_unidad_manejo($umanejo_id)
    {
        return $this->db->get_where('unidad_manejo',array('umanejo_id'=>$umanejo_id))->row_array();
    }
        
    /*
     * Get all unidad_manejo
     */
    function get_all_unidad_manejo()
    {
        $sql = "SELECT
                um.*, e.estado_color, e.estado_descripcion

            FROM
                unidad_manejo um

            LEFT JOIN estado e on um.estado_id = e.estado_id
                
            ORDER By um.umanejo_id DESC";

        $umanejo = $this->db->query($sql)->result_array();
        return $umanejo;
    }
        
    /*
     * function to add new unidad_manejo
     */
    function add_unidad_manejo($params)
    {
        $this->db->insert('unidad_manejo',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update unidad_manejo
     */
    function update_unidad_manejo($umanejo_id,$params)
    {
        $this->db->where('umanejo_id',$umanejo_id);
        return $this->db->update('unidad_manejo',$params);
    }
    
    /*
     * function to delete unidad_manejo
     */
    function delete_unidad_manejo($umanejo_id)
    {
        return $this->db->delete('unidad_manejo',array('umanejo_id'=>$umanejo_id));
    }
    /*
     * Get all unidad_manejo tipo 1
     */
    function get_all_unidad_manejo_activo()
    {
        $sql = "SELECT
                um.*, e.estado_color, e.estado_descripcion

            FROM
                unidad_manejo um

            LEFT JOIN estado e on um.estado_id = e.estado_id
            WHERE um.estado_id = 1
            ORDER By um.umanejo_id DESC";

        $umanejo = $this->db->query($sql)->result_array();
        return $umanejo;
    }
}
