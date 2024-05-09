<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Carte extends CI_Controller {

    var $data = array();

    public function __construct()
	{		
		// Obligatoire
        parent::__construct();
        $this->load->helper('url');
        session_start();
        $this->load->model('admin_model');
        if ($this->session->userdata('username')!=''){   
        }
        else redirect('index.php/site/index');
        $this->session->set_userdata('action_img', 'carte');
    }
    
    public function index(){
        //$this->telecharger();
        if ($this->session->userdata('username')!=''){
			$data_ = array();
			if ($this->session->userdata('role_id')==='1'){
				$data_['users'] = $this->admin_model->getAllUser();
				$this->data=$data_;
			}
        }
        $this->load->view('view_site/header');
        $this->load->view("view_site/nav");
		$this->load->view('carte_',$this->data);
        $this->load->view('view_site/footer',$this->data);
        
    }
}