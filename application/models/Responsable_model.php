<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Responsable_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
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
        $responsable = $this->db->query("
            SELECT
                *

            FROM
                `responsable_pago`

            WHERE
                1 = 1

            ORDER BY `responsable_id` 
        ")->result_array();

        return $responsable;
    }
        
    /*
     * function to add new responsable
     */
    function add_responsable($params)
    {
        $this->db->insert('responsable_pago',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update responsable
     */
    function update_responsable($responsable_id,$params)
    {
        $this->db->where('responsable_id',$responsable_id);
        return $this->db->update('responsable_pago',$params);
    }
    
    /*
     * function to delete responsable
     */
    function delete_responsable($responsable_id)
    {
        return $this->db->delete('responsable_pago',array('responsable_id'=>$responsable_id));
    }
}
