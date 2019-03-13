<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Ingreso_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get ingreso by ingreso_id
     */
    function get_ingreso($ingreso_id)
    {
        $ingreso = $this->db->query("
            SELECT
                *

            FROM
                `ingreso`

            WHERE
                `ingreso_id` = ?
        ",array($ingreso_id))->row_array();

        return $ingreso;
    }
    function get_ing_completo($ingreso_id)
    {
        $pedido = "
            SELECT
                i.*, p.*, u.unidad_nombre,t.programa_nombre, pr.*

            FROM
                 ingreso i

            LEFT JOIN pedido p on i.pedido_id=p.pedido_id
            LEFT JOIN unidad u on p.unidad_id=u.unidad_id
            LEFT JOIN programa t on p.programa_id=t.programa_id
            LEFT JOIN proveedor pr on  i.proveedor_id=pr.proveedor_id
            
            WHERE
             i.ingreso_id=".$ingreso_id."
            
        ";
        $result = $this->db->query($pedido)->result_array();

        return $result;
    }

    function get_ing_mascompleto($ingreso_id)
    {
        $pedido = "
            SELECT
                i.*, p.*, u.unidad_nombre,t.programa_nombre, pr.proveedor_id as prove, pr.*, f.*

            FROM
                 ingreso i

            LEFT JOIN pedido p on i.pedido_id=p.pedido_id
            LEFT JOIN unidad u on p.unidad_id=u.unidad_id
            LEFT JOIN programa t on p.programa_id=t.programa_id
            LEFT JOIN proveedor pr on  i.proveedor_id=pr.proveedor_id
            LEFT JOIN factura f on i.factura_id=f.factura_id
            WHERE
            
            i.ingreso_id=".$ingreso_id."
            
        ";
        $result = $this->db->query($pedido)->result_array();

        return $result;
    }

     function get_todos()
    {
        $pedido = "
            SELECT
                i.*, p.*, u.unidad_nombre,t.programa_nombre, pr.*, f.*

            FROM
                pedido p, ingreso i, unidad u, programa t, proveedor pr, factura f

            WHERE
            p.unidad_id=u.unidad_id
            and p.programa_id=t.programa_id
            and p.pedido_id=i.pedido_id
            and i.proveedor_id=pr.proveedor_id
            and i.factura_id=f.factura_id
            
            
        ";
        $result = $this->db->query($pedido)->result_array();

        return $result;
    }
    /*
     * Get all ingreso
     */
    function get_50_ingreso()
    {
        $ingreso = $this->db->query("
            SELECT
                i.*, e.estado_color, e.estado_descripcion,
                p.pedido_numero, us.usuario_nombre, pr.proveedor_nombre, prog.programa_nombre, u.unidad_nombre

            FROM
                ingreso i
            LEFT JOIN estado e on i.estado_id = e.estado_id
            LEFT JOIN proveedor pr on i.proveedor_id = pr.proveedor_id
            LEFT JOIN pedido p on i.pedido_id = p.pedido_id
            LEFT JOIN programa prog on p.programa_id = prog.programa_id
            LEFT JOIN unidad u on p.unidad_id = u.unidad_id
            LEFT JOIN usuario us on i.usuario_id = us.usuario_id
            
            ORDER BY i.ingreso_fecha DESC, i.ingreso_hora DESC limit 50
        ")->result_array();

        return $ingreso;
    }
    function get_all_ingreso()
    {
        $ingreso = $this->db->query("
            SELECT
                i.*, e.estado_color, e.estado_descripcion,
                p.pedido_numero, us.usuario_nombre, pr.proveedor_nombre, prog.programa_nombre, u.unidad_nombre

            FROM
                ingreso i
            LEFT JOIN estado e on i.estado_id = e.estado_id
            LEFT JOIN proveedor pr on i.proveedor_id = pr.proveedor_id
            LEFT JOIN pedido p on i.pedido_id = p.pedido_id
            LEFT JOIN programa prog on p.programa_id = prog.programa_id
            LEFT JOIN unidad u on p.unidad_id = u.unidad_id
            LEFT JOIN usuario us on i.usuario_id = us.usuario_id
            
            ORDER BY i.ingreso_fecha DESC, i.ingreso_hora DESC
        ")->result_array();

        return $ingreso;
    }

     function get_tipo_ingreso($parametro, $categoria)
    {
        $ingreso = $this->db->query("
            SELECT
                i.*, e.estado_color, e.estado_descripcion,
                p.pedido_numero, us.usuario_nombre, pr.proveedor_nombre, prog.programa_nombre, u.unidad_nombre

            FROM
                ingreso i
            LEFT JOIN estado e on i.estado_id = e.estado_id
            LEFT JOIN proveedor pr on i.proveedor_id = pr.proveedor_id
            LEFT JOIN pedido p on i.pedido_id = p.pedido_id
            LEFT JOIN programa prog on p.programa_id = prog.programa_id
            LEFT JOIN unidad u on p.unidad_id = u.unidad_id
            LEFT JOIN usuario us on i.usuario_id = us.usuario_id

            WHERE
                (p.pedido_numero like '%".$parametro."%' or i.ingreso_numdoc like '%".$parametro."%')
                ".$categoria."
                 
            ORDER BY i.ingreso_fecha DESC, i.ingreso_hora DESC
        ")->result_array();

        return $ingreso;
    }
    
    function crear_ingreso($usuario_id,$gestion_id)
    {
        
        $estado_id = 1;
        
        $proveedor_id = 0;
        $ingreso_fecha = "now()";
        $ingreso_hora = "'".date('H:i:s')."'";
        $pedido = 0;
        $factura = 0;
        $ingreso_total = 0;
        $ingreso_numdoc = 0;
        
        $sql = "insert into ingreso(usuario_id,estado_id,gestion_id,proveedor_id,ingreso_fecha,ingreso_hora,ingreso_numdoc,ingreso_total,factura_id,pedido_id) ".
                "value(".$usuario_id.",".$estado_id.",".$gestion_id.",".$proveedor_id.",".$ingreso_fecha.",".$ingreso_hora.",".$ingreso_numdoc.",".$ingreso_total.",".$factura.",".$pedido.")";
        $ingreso = $this->db->query($sql);
        $ingreso_id = $this->db->insert_id();
        return $ingreso_id;        
        
    }

     function get_detalle_ingreso_aux($ingreso_id)
    {
        $sql = "SELECT d.*, p.*, ig.ingreso_numdoc from detalle_ingreso_aux d, articulo p, ingreso ig
               where d.articulo_id=p.articulo_id and d.ingreso_id = ".$ingreso_id." and ig.ingreso_id = ".$ingreso_id."
               order by d.detalleing_id desc";
        $result = $this->db->query($sql)->result_array();
        return $result;        
    }
    function get_detalle_ingreso($ingreso_id)
    {
        $sql = "SELECT d.*, p.*, ig.ingreso_numdoc, f.factura_numero from detalle_ingreso d, articulo p, ingreso ig, factura f
               where d.articulo_id=p.articulo_id and f.factura_id = ig.factura_id and d.ingreso_id = ".$ingreso_id." and ig.ingreso_id = ".$ingreso_id."
               order by d.detalleing_id desc";
        $result = $this->db->query($sql)->result_array();
        return $result;        
    }
    function cambiar_proveedor($ingreso_id,$proveedor_id)
    {
        $sql = "UPDATE ingreso set proveedor_id = ".$proveedor_id.
                " WHERE ingreso_id = ".$ingreso_id;
        $ingreso = $this->db->query($sql);                
        return $ingreso;
        
    }

    function cambiar_pedido($ingreso_id,$pedido_id)
    {
        $sql = "UPDATE ingreso set pedido_id = ".$pedido_id.
                " WHERE ingreso_id = ".$ingreso_id;
        $ingreso = $this->db->query($sql);                
        return $ingreso_id;
        
    }

    function get_ingreso_proveedor($ingreso_id,$proveedor_id)
    {
        $sql = "SELECT p.*,c.* FROM ingreso p,  proveedor c WHERE p.ingreso_id = ".$ingreso_id." and c.proveedor_id=".$proveedor_id." ";
        $result = $this->db->query($sql)->result_array();
        return $result;        
    }

    function get_ing_pedido($ingreso_id,$pedido_id)
    {
        $pedido = "
            SELECT
                i.*, p.*, u.unidad_nombre,t.programa_nombre 

            FROM
                pedido p, ingreso i, unidad u, programa t

            WHERE
            p.unidad_id=u.unidad_id
            and p.programa_id=t.programa_id
            and p.pedido_id=".$pedido_id."
            and i.ingreso_id=".$ingreso_id."
            
        ";
        $result = $this->db->query($pedido)->result_array();

        return $result;
    }

     function get_pedido_pendiente()
    {
        $pedido = $this->db->query("
            SELECT
                p.*, e.estado_color, e.estado_descripcion, g.gestion_nombre, u.unidad_nombre,t.programa_nombre 

            FROM
                pedido p

            LEFT JOIN estado e on p.estado_id = e.estado_id
            LEFT JOIN gestion g on p.gestion_id = g.gestion_id
            LEFT JOIN unidad u on p.unidad_id = u.unidad_id
            LEFT JOIN programa t on p.programa_id = t.programa_id

            WHERE p.estado_id=6
            ORDER BY p.pedido_id DESC 
            
        ")->result_array();

        return $pedido;
    }
    /*
     * function to add new ingreso
     */
    function add_ingreso($params)
    {
        $this->db->insert('ingreso',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update ingreso
     */
    function update_ingreso($ingreso_id,$params)
    {
        $this->db->where('ingreso_id',$ingreso_id);
        return $this->db->update('ingreso',$params);
    }
    
    /*
     * function to delete ingreso
     */
    function delete_ingreso($ingreso_id)
    {
        return $this->db->delete('ingreso',array('ingreso_id'=>$ingreso_id));
    }
}
