<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Gestion_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get gestion by gestion_id
     */
    function get_gestion($gestion_id)
    {
        $gestion = $this->db->query("
            SELECT
                *

            FROM
                `gestion`

            WHERE
                `gestion_id` = ?
        ",array($gestion_id))->row_array();

        return $gestion;
    }
        
    /*
     * Get all gestion
     */
    function get_all_gestion()
    {
        $gestion = $this->db->query("
            SELECT
                *

            FROM
                `gestion`

            WHERE
                1 = 1

            ORDER BY `gestion_id` DESC
        ")->result_array();

        return $gestion;
    }
        
    /*
     * function to add new gestion
     */
    function add_gestion($params)
    {
        $this->db->insert('gestion',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update gestion
     */
    function update_gestion($gestion_id,$params)
    {
        $this->db->where('gestion_id',$gestion_id);
        return $this->db->update('gestion',$params);
    }
    
    /*
     * function to delete gestion
     */
    function delete_gestion($gestion_id)
    {
        return $this->db->delete('gestion',array('gestion_id'=>$gestion_id));
    }
}
