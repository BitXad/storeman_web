<?php

Class Login extends CI_Controller
{

    public function __construct()    {
        parent::__construct();
    }

    public function index() {
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
        session_destroy();
        redirect('', 'refresh');
    }
}

