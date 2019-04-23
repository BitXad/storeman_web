<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
    
    public function index()
    {
        $data = array(
            'msg' => $this->session->flashdata('msg')
        );
        $this->load->model('Gestion_model');
        $this->load->model('Institucion_model');

        $data['gestiones'] = $this->Gestion_model->get_gestiones();
        $data['institucion'] = $this->Institucion_model->get_institucion(1);
        $this->load->view('public/login',$data);
    }

}
