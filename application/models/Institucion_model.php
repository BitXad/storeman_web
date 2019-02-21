<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Institucion_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
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
        $this->db->insert('institucion',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update institucion
     */
    function update_institucion($institucion_id,$params)
    {
        $this->db->where('institucion_id',$institucion_id);
        return $this->db->update('institucion',$params);
    }
    
    /*
     * function to delete institucion
     */
    function delete_institucion($institucion_id)
    {
        return $this->db->delete('institucion',array('institucion_id'=>$institucion_id));
    }
}
