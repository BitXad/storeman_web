<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
   
class Rol_usuario_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get rol_usuario by id_rol_usuario
     */
    function get_rol_usuario($id_rol_usuario)
    {
        return $this->db->get_where('rol_usuario',array('id_rol_usuario'=>$id_rol_usuario))->row_array();
        /*return $this->db->get_where('rol_usuario',array('rol_id'=>$rol_id))->row_array();
        return $this->db->get_where('rol_usuario',array('tipousuario_id'=>$tipousuario_id))->row_array();*/
    }
    
    /*
     * Get all rol_usuario count
     */
    function get_all_rol_usuario_count()
    {


        $this->db->from('rol_usuario');
        return $this->db->count_all_results();
    }
      
    /*
     * function to add new rol_usuario
     */
    function add_rol_usuario($params)
    {
       // $rol_id = array('rol_id' =>$rol_id );
       $rol_id=1;
        $this->db->insert('rol_usuario',$params);
        return $this->db->insert_id('tipousuario_id', $rol_id = array('rol_id' =>$rol_id ));
    }
    
    /*
     * function to update rol_usuario
     */
    function update_rol_usuario($id_rol_usuario,$params)
    {
        $this->db->where('id_rol_usuario',$id_rol_usuario);
        return $this->db->update('id_rol_usuario',$params);
    }
    
    /*
     * function to delete rol_usuario
     */
    function delete_rol_usuario($id_rol_usuario)
    {
        return $this->db->delete('rol_usuario',array('id_rol_usuario'=>$id_rol_usuario));
    }
    
    /*
     * Get all rol_usuario from tipo_usuario
     */
    function getall_rolusuario($tipousuario_id)
    {
        $rol_usuario = $this->db->query("
            SELECT
                ru.*
            FROM
                rol_usuario ru
            WHERE
                ru.tipousuario_id= $tipousuario_id
        ")->result_array();
        return $rol_usuario;
      }
}
