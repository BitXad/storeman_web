<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Articulo_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
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
        $this->db->insert('articulo',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update articulo
     */
    function update_articulo($articulo_id,$params)
    {
        $this->db->where('articulo_id',$articulo_id);
        return $this->db->update('articulo',$params);
    }
    
    /*
     * function to delete articulo
     */
    function delete_articulo($articulo_id)
    {
        return $this->db->delete('articulo',array('articulo_id'=>$articulo_id));
    }
    /*
     * function to da de baja una articulo
     */
    function inactivar_articulo($articulo_id)
    {
        $sql = "update articulo set estado_id = 2 where articulo_id = ".$articulo_id;
        
        return $this->db->query($sql);
    }
}
