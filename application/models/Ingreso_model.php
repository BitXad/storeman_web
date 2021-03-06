<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Ingreso_model extends CI_Model
{
    private $session_data = "";
    function __construct()
    {
        parent::__construct();
        
        $this->session_data = $this->session->userdata('logged_in');

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
                i.*, p.*, u.unidad_nombre,t.programa_nombre, pr.proveedor_id as prove, pr.*, f.*, i.programa_id as esteprogra, r.responsable_nombre, i.estado_id as 'estado'

            FROM
                 ingreso i

            LEFT JOIN responsable_pago r on i.responsable_id=r.responsable_id
            LEFT JOIN pedido p on i.pedido_id=p.pedido_id
            LEFT JOIN unidad u on p.unidad_id=u.unidad_id
            LEFT JOIN programa t on i.programa_id=t.programa_id
            LEFT JOIN proveedor pr on  i.proveedor_id=pr.proveedor_id
            LEFT JOIN factura f on i.factura_id=f.factura_id
            WHERE
            
            i.ingreso_id=".$ingreso_id;
        
        $result = $this->db->query($pedido)->result_array();

        return $result;
    }

    function facturitas($ingreso_id)
    {
        $factu = "
            SELECT
                f.*

            FROM
                 factura f

            WHERE
            
            f.ingreso_id=".$ingreso_id."
            
        ";
        $result = $this->db->query($factu)->result_array();

        return $result;
    }

    function programitas($ingreso_id)
    {
        $progra = "
           SELECT
                p.*, u.unidad_nombre,t.programa_nombre

            FROM
                 pedido p

           
            LEFT JOIN unidad u on p.unidad_id=u.unidad_id
            LEFT JOIN programa t on p.programa_id=t.programa_id
            
            WHERE
            
            p.ingreso_id=".$ingreso_id."
            
        ";
        $result = $this->db->query($progra)->result_array();

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
    function get_50_ingreso($gestion_id)
    {
        $ingreso = $this->db->query("
            SELECT
                i.*, e.estado_color, e.estado_descripcion,
                p.pedido_numero, us.usuario_nombre, pr.proveedor_nombre, prog.programa_nombre, u.unidad_nombre, re.responsable_nombre

            FROM
                ingreso i
            LEFT JOIN estado e on i.estado_id = e.estado_id
            LEFT JOIN proveedor pr on i.proveedor_id = pr.proveedor_id
            LEFT JOIN pedido p on i.pedido_id = p.pedido_id
            LEFT JOIN programa prog on i.programa_id = prog.programa_id
            LEFT JOIN unidad u on p.unidad_id = u.unidad_id
            LEFT JOIN usuario us on i.usuario_id = us.usuario_id
            LEFT JOIN responsable_pago re on i.responsable_id = re.responsable_id
            WHERE i.gestion_id = $gestion_id
            ORDER BY i.ingreso_numdoc DESC limit 50
        ")->result_array();

        return $ingreso;
    }
    function get_all_ingreso()
    {
        $ingreso = $this->db->query("
            SELECT
                i.*, e.estado_color, e.estado_descripcion,
                p.pedido_numero, us.usuario_nombre, pr.proveedor_nombre, prog.programa_nombre, u.unidad_nombre, re.responsable_nombre

            FROM
                ingreso i
            LEFT JOIN estado e on i.estado_id = e.estado_id
            /*LEFT JOIN proveedor pr on i.proveedor_id = pr.proveedor_id*/
            LEFT JOIN pedido p on i.pedido_id = p.pedido_id
            LEFT JOIN programa prog on i.programa_id = prog.programa_id
            LEFT JOIN unidad u on p.unidad_id = u.unidad_id
            LEFT JOIN usuario us on i.usuario_id = us.usuario_id
            LEFT JOIN responsable_pago re on i.responsable_id = re.responsable_id
            
            ORDER BY i.ingreso_fecha DESC, i.ingreso_hora DESC
        ")->result_array();

        return $ingreso;
    }

     function get_tipo_ingreso($parametro, $categoria, $gestion_id)
    {
        $ingreso = $this->db->query("
            SELECT
                i.*, e.estado_color, e.estado_descripcion,
                p.pedido_numero, us.usuario_nombre, pr.proveedor_nombre, prog.programa_nombre, u.unidad_nombre, re.responsable_nombre

            FROM
                ingreso i
            LEFT JOIN estado e on i.estado_id = e.estado_id
            LEFT JOIN proveedor pr on i.proveedor_id = pr.proveedor_id
            LEFT JOIN pedido p on i.pedido_id = p.pedido_id
            LEFT JOIN programa prog on i.programa_id = prog.programa_id
            LEFT JOIN unidad u on p.unidad_id = u.unidad_id
            LEFT JOIN usuario us on i.usuario_id = us.usuario_id
            LEFT JOIN responsable_pago re on i.responsable_id = re.responsable_id

            WHERE
                (p.pedido_numero like '%".$parametro."%' or i.ingreso_numdoc like '%".$parametro."%')
                 and i.gestion_id = $gestion_id 
                ".$categoria."
                 
            ORDER BY i.ingreso_numdoc DESC
        ")->result_array();

        return $ingreso;
    }
    
    function crear_ingreso($usuario_id,$gestion_id,$ingreso_numdoc)
    {
        
        $estado_id = 1;
        
        $proveedor_id = 0;
        $ingreso_fecha = "now()";
        $ingreso_hora = "'".date('H:i:s')."'";
        $pedido = 0;
        $factura = 0;
        $ingreso_total = 0;
        //$ingreso_numdoc = 0;
        
        $sql = "insert into ingreso(usuario_id,estado_id,gestion_id,proveedor_id,ingreso_fecha,ingreso_hora,ingreso_numdoc,ingreso_total,factura_id,pedido_id) ".
                "value(".$usuario_id.",".$estado_id.",".$gestion_id.",".$proveedor_id.",".$ingreso_fecha.",".$ingreso_hora.",".$ingreso_numdoc.",".$ingreso_total.",".$factura.",".$pedido.")";
        
        //********** registro en bitacora ***********//
        $this->bitacora($sql,'INSERT');
        //********** fin registro en bitacora ***********//
        
        $ingreso = $this->db->query($sql);
        $ingreso_id = $this->db->insert_id();
        return $ingreso_id;        
        
    }
     function crear_ingreso_extra($usuario_id,$gestion_id)
    {
        
        $estado_id = 1;
        
        $proveedor_id = 0;
        $ingreso_fecha = "now()";
        $ingreso_hora = "'".date('H:i:s')."'";
        $pedido = 0;
        $factura = 0;
        $ingreso_total = 0;
        //$ingreso_numdoc = 0;
        
        $sql = "insert into ingreso(usuario_id,estado_id,gestion_id,proveedor_id,ingreso_fecha,ingreso_hora,ingreso_total,factura_id,pedido_id) ".
                "value(".$usuario_id.",".$estado_id.",".$gestion_id.",".$proveedor_id.",".$ingreso_fecha.",".$ingreso_hora.",".$ingreso_total.",".$factura.",".$pedido.")";
        
        //********** registro en bitacora ***********//
        $this->bitacora($sql,'INSERT');
        //********** fin registro en bitacora ***********//
        
        
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
        $sql = "SELECT d.*, p.*, ig.ingreso_numdoc from detalle_ingreso d, articulo p, ingreso ig
               where d.articulo_id=p.articulo_id  and d.ingreso_id = ".$ingreso_id." and ig.ingreso_id = ".$ingreso_id."
               order by p.articulo_nombre asc";
               //order by d.detalleing_id desc";
        $result = $this->db->query($sql)->result_array();
        return $result;        
    }
    function cambiar_proveedor($ingreso_id,$proveedor_id)
    {
        $sql = "UPDATE ingreso set proveedor_id = ".$proveedor_id.
                " WHERE ingreso_id = ".$ingreso_id;
        //********** registro en bitacora ***********//
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        
        $ingreso = $this->db->query($sql);                
        return $ingreso;
        
    }


    function ingreso_apedido($ingreso_id,$pedido_id)
    {
        $sql = "UPDATE pedido set ingreso_id = ".$ingreso_id.
                " WHERE pedido_id = ".$pedido_id;
        //********** registro en bitacora ***********//
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//
        $pedido = $this->db->query($sql);                
        return $pedido;
        
    }
    function ingreso_afactura($ingreso_id,$factura_numero,$factura_fecha,$factura_nit,$factura_razon,$factura_importe)
    {
        $sql = "INSERT INTO factura (estado_id, usuario_id, factura_numero, factura_fecha, factura_nit, factura_razon, factura_importe, factura_autorizacion, factura_poliza, factura_ice, factura_exento, factura_neto, factura_creditofiscal, factura_codigocontrol, ingreso_id) VALUES (1, 1, ".$factura_numero.", ".$factura_fecha.", ".$factura_nit.", ".$factura_razon.", ".$factura_importe.", 0, 0, 0, 0, 0, 0, 0, ".$ingreso_id.")";  
        //********** registro en bitacora ***********//
        $this->bitacora($sql,'INSERT');
        //********** fin registro en bitacora ***********//
        
        $factura = $this->db->query($sql);                
        return $factura;
        
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

    function get_pedidos($ingreso_id)
    {
        $pedido = $this->db->query("
            SELECT
                p.*, t.programa_nombre , u.unidad_nombre

            FROM
                pedido p

            LEFT JOIN programa t on p.programa_id = t.programa_id
            LEFT JOIN unidad u on p.unidad_id = u.unidad_id

            WHERE
                p.ingreso_id=".$ingreso_id."

            ORDER BY p.pedido_id DESC 
            
        ")->result_array();

        return $pedido;
    }

    function get_facturas($ingreso_id)
    {
        $factura = $this->db->query("
            SELECT
                f.*, i.ingreso_id 

            FROM
                factura f

            LEFT JOIN ingreso i on f.ingreso_id = i.ingreso_id

            WHERE
                f.ingreso_id=".$ingreso_id."

            ORDER BY f.factura_id DESC 
            
        ")->result_array();

        return $factura;
    }

    function get_numero($gestion_id)
    {
        $numero = " SELECT g.gestion_numing as numero FROM gestion g WHERE gestion_id = $gestion_id";
        $result = $this->db->query($numero)->row_array();

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

    function get_pedidounidad($unidad_id)
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
            and p.unidad_id = ".$unidad_id."
            ORDER BY p.pedido_id DESC 
            
        ")->result_array();

        return $pedido;
    }

    function get_pedidofiltro($filtro, $gestion_id)
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
            and p.gestion_id = $gestion_id
            and (t.programa_nombre like '%".$filtro."%' or u.unidad_nombre like '%".$filtro."%' or p.pedido_numero = '".$filtro."')
            ORDER BY p.pedido_id DESC 
            
        ")->result_array();

        return $pedido;
    }
    /*
     * function to add new ingreso
     */
    function add_ingreso($params)
    {
        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'INSERT');
        //********** fin registro en bitacora ***********//
        
        $this->db->insert('ingreso',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update ingreso
     */
    function update_ingreso($ingreso_id,$params)
    {
        //********** registro en bitacora ***********//
        $sql = json_encode($params);
        $this->bitacora($sql,'UPDATE');
        //********** fin registro en bitacora ***********//

        $this->db->where('ingreso_id',$ingreso_id);
        return $this->db->update('ingreso',$params);
    }
    
    /*
     * function to delete ingreso
     */
    function delete_ingreso($ingreso_id)
    {
        //********** registro en bitacora ***********//
        $sql = "ingreso_id: ".$ingreso_id;
        $this->bitacora($sql,'DELETE');
        //********** fin registro en bitacora ***********//
        return $this->db->delete('ingreso',array('ingreso_id'=>$ingreso_id));
    }        
    
    /*
     * ingreso por gestion
     */
    function get_ingreso_gestion($gestion_id)
    {
        $sql = "select * from ingreso where gestion_id = ".$gestion_id;
        //********** registro en bitacora ***********//
        $this->bitacora($sql,'DELETE');
        //********** fin registro en bitacora ***********//
        //$sql = "select i.*,g.* from ingreso i, gestion g where i.gestion_id = g.gestion_id";
        return $this->db->query($sql)->result_array();
    }
    
    /*
     * Get all ingreso
     */
    function get_all_ingreso_kardex()
    {
        $ingreso = $this->db->query("
            SELECT
                *

            FROM
                `ingreso`

            WHERE
                1 = 1

            ORDER BY `ingreso_id` DESC
        ")->result_array();

        return $ingreso;
    }    
                    
    function bitacora($sql, $operacion){
        
        $sql =  str_replace("'", "`", $sql);
        $usuario_id = $this->session_data['usuario_id'];
        
        $bitacora_fecha = "'".date("Y-m-d")."'";
        $bitacora_hora = "'".date("H:i:s")."'";
        $bitacora_operacion = "'".$operacion." "."INGRESO'";
        $bitacora_consulta = "'".$sql."'";
        $bitacora_anterior ="''";
        
        $sql = "insert into bitacora(bitacora_fecha,bitacora_hora,bitacora_operacion,bitacora_consulta,bitacora_anterior,usuario_id) value(".
                $bitacora_fecha.",".$bitacora_hora.",".$bitacora_operacion.",".$bitacora_consulta.",".$bitacora_anterior.",".$usuario_id.")";
    
        $this->db->query($sql);
        return true;
    }
    
    
}
