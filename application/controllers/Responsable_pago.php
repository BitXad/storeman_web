<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Responsable_pago extends CI_Controller{

    private $parametros = "";
    private $session_data = "";
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Responsable_model');
        if ($this->session->userdata('logged_in')) {
            $this->session_data = $this->session->userdata('logged_in');
        }else {
            redirect('', 'refresh');
        }
	        
	$this->load->model('Parametros_model');
	$this->parametros = $this->Parametros_model->get_parametros();
	
	$data["parametros"] = $this->parametros;
	    
    } 
    /* *****Funcion que verifica el acceso al sistema**** */
    private function acceso($id_rol){
        $rolusuario = $this->session_data['rol'];
        if($rolusuario[$id_rol-1]['rolusuario_asignado'] == 1){
            return true;
        }else{
            $data['_view'] = 'login/mensajeacceso';
        $this->load->view('layouts/main',$data);
        }
    }
    /*
     * Listing of responsable
     */
    function index()
    {
        $this->Responsable_model->bitacora("ACCESO A MODULO","INDEX RESPONSABLE");
        if($this->acceso(9)){
            $data['responsable'] = $this->Responsable_model->get_all_responsable();

            $data['_view'] = 'responsable_pago/index';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Adding a new responsable
     */
    function add()
    {
        $this->Responsable_model->bitacora("ACCESO A MODULO","ADD RESPONSABLE");
        if($this->acceso(9)){
            $this->load->library('form_validation');
            $this->form_validation->set_rules('responsable_nombre', 'responsable_nombre', 'required|is_unique[responsable_pago.responsable_nombre]',
                    array('is_unique' => 'Este responsable ya existe.'));
            if($this->form_validation->run())     
            {
                $estado_id = 1;
                $params = array(
                                    'responsable_nombre' => $this->input->post('responsable_nombre'),
                                    'estado_id' => $estado_id,
                );

                $responsable_id = $this->Responsable_model->add_responsable($params);
                redirect('responsable_pago');
            }
            else
            {            
                $data['_view'] = 'responsable_pago/add';
                $this->load->view('layouts/main',$data);
            }
        }
    }  

    /*
     * Editing a responsable
     */
    function edit($responsable_id)
    {
        $this->Responsable_model->bitacora("ACCESO A MODULO","EDIT RESPONSABLE");

         $original_value = $this->db->query("SELECT responsable_nombre FROM responsable_pago WHERE responsable_id = " . $responsable_id)->row()->responsable_nombre;

        if ($this->input->post('responsable_nombre') != $original_value) {
            $is_unique = '|is_unique[responsable_pago.responsable_nombre]';
        } else {
            $is_unique = '';
        }
        if($this->acceso(9)){
            // check if the responsable exists before trying to edit it
            $data['responsable'] = $this->Responsable_model->get_responsable($responsable_id);

            if(isset($data['responsable']['responsable_id']))
            {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('responsable_nombre','responsable','trim|required|xss_clean' . $is_unique, array('is_unique' => 'Este responsable ya existe.'));
                if($this->form_validation->run())     
                {   
                    $params = array(
                        'responsable_nombre' => $this->input->post('responsable_nombre'),
                        'estado_id' => $this->input->post('estado_id'),
                    );

                    $this->Responsable_model->update_responsable($responsable_id,$params);            
                    redirect('responsable_pago');
                }
                else
                {
                    $this->load->model('Estado_model');
                    $data['all_estado'] = $this->Estado_model->get_all_estado_tipo1();  

                    $data['_view'] = 'responsable_pago/edit';
                    $this->load->view('layouts/main',$data);
                }
            }
            else
                show_error('The responsable you are trying to edit does not exist.');
        }
    } 

    /*
     * Deleting responsable
     */
   /* function remove($responsable_id)
    {
        if($this->acceso(9)){
            $responsable = $this->Responsable_model->get_responsable($responsable_id);

            // check if the responsable exists before trying to delete it
            if(isset($responsable['responsable_id']))
            {
                $this->Responsable_model->delete_responsable($responsable_id);
                redirect('responsable_pago/index');
            }
            else
                show_error('The responsable you are trying to delete does not exist.');
        }
    }*/

    function inactivar($responsable_id)
    {
        $this->Responsable_model->bitacora("ACCESO A MODULO","INACTIVAR RESPONSABLE");
        
        if($this->acceso(9)){
            $responsable = $this->Responsable_model->get_responsable($responsable_id);

            // check if the programa exists before trying to delete it
            if(isset($responsable['responsable_id']))
            {
                $this->Responsable_model->inactivar_responsable($responsable_id);
                redirect('responsable_pago');
            }
            else
                show_error('El Responsable que intentas dar de baja, no existe.');
        }
    }

    function activar($responsable_id)
    {
        $this->Responsable_model->bitacora("ACCESO A MODULO","ACTIVAR RESPONSABLE");
        
        if($this->acceso(9)){
            $responsable = $this->Responsable_model->get_responsable($responsable_id);

            // check if the programa exists before trying to delete it
            if(isset($responsable['responsable_id']))
            {
                $this->Responsable_model->activar_responsable($responsable_id);
                redirect('responsable_pago');
            }
            else
                show_error('El Responsable que intentas dar de alta, no existe.');
        }
    }
    
}
