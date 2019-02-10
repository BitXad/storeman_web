<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Detalle_salida_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get detalle_salida by detallesal_id
     */
    function get_detalle_salida($detallesal_id)
    {
        $detalle_salida = $this->db->query("
            SELECT
                *

            FROM
                `detalle_salida`

            WHERE
                `detallesal_id` = ?
        ",array($detallesal_id))->row_array();

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

            ORDER BY `detallesal_id` DESC
        ")->result_array();

        return $detalle_salida;
    }
        
    /*
     * function to add new detalle_salida
     */
    function add_detalle_salida($params)
    {
        $this->db->insert('detalle_salida',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update detalle_salida
     */
    function update_detalle_salida($detallesal_id,$params)
    {
        $this->db->where('detallesal_id',$detallesal_id);
        return $this->db->update('detalle_salida',$params);
    }
    
    /*
     * function to delete detalle_salida
     */
    function delete_detalle_salida($detallesal_id)
    {
        return $this->db->delete('detalle_salida',array('detallesal_id'=>$detallesal_id));
    }
}
