<?php

class Login_model extends CI_Model {

    private $session_data = "";
    public function __construct() {
        parent::__construct();
        
        $this->session_data = $this->session->userdata('logged_in');

    }

    public function login($username,$password)  {
        
        //********** registro en bitacora ***********//
        $sql = "usuario: ".$username." contraseña:".$password;
        $this->bitacora($sql,'LOGIN');
        //********** fin registro en bitacora ***********//
        
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('usuario_login', $username);
        $this->db->where('estado_id', 1);
        $this->db->where('usuario_clave', md5($password));
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function login2($usuario_login,$usuario_clave){
   
        $sql = "SELECT * from usuario WHERE usuario_login='".$usuario_login."' AND usuario_clave = '".md5($usuario_clave)."' and estado_id=1 ";
        $query = $this->db->query($sql);
        
        //********** registro en bitacora ***********//
//        
//        if(isset($query)){
//            $usuario_id = $query["usuario_id"]; 
//        }
//        else{
//            $usuario_id = 0;
//        }
        
        $sql2 = "usuario: ".$usuario_login.", clave: ".$usuario_clave;
        $this->bitacora($sql2,'LOGIN');
        //********** fin registro en bitacora ***********//

        return $query->row();
    }

    public function read_user_information($username) {
        
        
        //********** registro en bitacora ***********//
        $sql = "usuario : ".$username;
        $this->bitacora($sql,'LOGIN');
        //********** fin registro en bitacora ***********//
        
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('usuario_login', $username);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
            
    function bitacora($sql, $operacion){
        
        if (isset($this->session_data['usuario_id']))
            $usuario_id = $this->session_data['usuario_id'];
        else
            $usuario_id = "0";
        
        $bitacora_fecha = "'".date("Y-m-d")."'";
        $bitacora_hora = "'".date("H:i:s")."'";
        $bitacora_operacion = "'".$operacion." "."LOGIN'";
        $bitacora_consulta = "'".$sql."'";
        $bitacora_anterior ="''";
        
        $sql = "insert into bitacora(bitacora_fecha,bitacora_hora,bitacora_operacion,bitacora_consulta,bitacora_anterior,usuario_id) value(".
                $bitacora_fecha.",".$bitacora_hora.",".$bitacora_operacion.",".$bitacora_consulta.",".$bitacora_anterior.",".$usuario_id.")";
    
        $this->db->query($sql);
        return true;
    }
    
}