<?php

Class Login extends CI_Controller
{

    public function __construct()    {
        parent::__construct();
        $this->load->model('Login_model');
    }

    public function index() {
        
        $this->Login_model->bitacora("ACCESO A MODULO","INDEX LOGIN");
        $data = array(
            'msg' => $this->session->flashdata('msg')
        );

        $this->load->model('Gestion_model');
        $this->load->model('Institucion_model');

        $data['institucion'] = $this->Institucion_model->get_institucion(1);
        $data['gestiones'] = $this->Gestion_model->get_gestiones();

        $this->load->view('public/login',$data);
    }
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->Login_model->bitacora('Finalizar Sesión','LOGOUT ');
        session_destroy();
        redirect('', 'refresh');
    }
    public function mensajeacceso(){
        redirect('login/mensajeacceso');
    }
}

