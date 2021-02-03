<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Factura_model extends CI_Model
{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        
        $this->session_data = $this->session->userdata('logged_in');

    }
    
    /*
     * Get factura by factura_id
     */
    /*function get_factura($factura_id)
    {
        $factura = $this->db->query("
            SELECT
                *

            FROM
                `factura`

            WHERE
                `factura_id` = ?
        ",array($factura_id))->row_array();

        return $factura;
    }*/
        
    function get_factura($opcion)
    {
        
        
        $factura = $this->db->query("
            SELECT
                f.*, e.*, p.proveedor_nombre, i.ingreso_numdoc, g.*

            FROM
                factura f, estado e, proveedor p, ingreso i, gestion g

            WHERE
                f.estado_id = e.estado_id
                and f.factura_nit = p.proveedor_nit
                and f.ingreso_id = i.ingreso_id
                and i.gestion_id = g.gestion_id
                and ".$opcion."

            ORDER BY `factura_id` DESC

        ")->result_array();

        return $factura;
    }
        
    function get_factura_id($factura_id)
    {
        
        
           $factura = $this->db->query("
            SELECT
                *

            FROM
                `factura`

            WHERE
                `factura_id` = ?
        ",array($factura_id))->row_array();

        return $factura;
    }
    /*
     * Get all factura
     */
    function get_all_factura()
    {
        $factura = $this->db->query("
            SELECT
                *

            FROM
                `factura`

            WHERE
                1 = 1

            ORDER BY `factura_id` 
        ")->result_array();

        return $factura;
    }
        
    /*
     * function to add new factura
     */
    function add_factura($params)
    {
        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'INSERT');
        //********** fin registro en bitacora ***********//
        
        $this->db->insert('factura',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update factura
     */
    function update_factura($factura_id,$params)
    {
        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        $this->db->where('factura_id',$factura_id);
        return $this->db->update('factura',$params);
    }
    function update_factura_deingreso($ingreso_id,$params)
    {
        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//        
        
        $this->db->where('ingreso_id',$ingreso_id);
        return $this->db->update('factura',$params);
    }
    
    /*
     * function to delete factura
     */
    function delete_factura($factura_id)
    {
        //********** registro en bitacora ***********//
        $sql = "factura_id : ".$factura_id;
        $this->bitacora($sql,'DELETE');
        //********** fin registro en bitacora ***********//
        
        return $this->db->delete('factura',array('factura_id'=>$factura_id));
    }
               
    function bitacora($sql, $operacion){
        
        $sql =  str_replace("'", "`", $sql);
        $usuario_id = $this->session_data['usuario_id'];
        
        $bitacora_fecha = "'".date("Y-m-d")."'";
        $bitacora_hora = "'".date("H:i:s")."'";
        $bitacora_operacion = "'".$operacion." "."FACTURA'";
        $bitacora_consulta = "'".$sql."'";
        $bitacora_anterior ="''";
        
        $sql = "insert into bitacora(bitacora_fecha,bitacora_hora,bitacora_operacion,bitacora_consulta,bitacora_anterior,usuario_id) value(".
                $bitacora_fecha.",".$bitacora_hora.",".$bitacora_operacion.",".$bitacora_consulta.",".$bitacora_anterior.",".$usuario_id.")";
    
        $this->db->query($sql);
        return true;
    }
    
}
