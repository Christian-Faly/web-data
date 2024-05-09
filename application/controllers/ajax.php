<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ajax extends CI_Controller{
    
    function ch_req(){
        $this->load->model("get_db");
        $data["result"] = $this->get_db->get_liste("SELECT * FROM arbre WHERE type='predefinie' and pere like '".$_GET["code"]."%' order by description");
		$this->load->view("ajax/ch_req", $data);
    }
    
    function tableau(){
        $this->load->model("get_db");
        $data["desc"] = $this->db->query("SELECT description FROM arbre WHERE type='titre' and code='".$_GET["code"]."'")->row()->description;
        $this->load->view("ajax/tableau", $data);
    }
    
    function rech_p(){
        $this->load->model("get_db");
        $data["result"] = $this->get_db->get_liste("SELECT * FROM arbre WHERE description ilike '%".$_GET["rech"]."%' and type='predefinie' and pere like '01%' order by description");
        $this->load->view("ajax/rech_p", $data);
    }
    
    function sql_p(){
        $this->load->model("get_db");
        $data["req"] = $this->db->query("SELECT sql1 FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql1;
        $data["req_r"] = $this->db->query("SELECT sql_r FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_r;
        $data["req_d"] = $this->db->query("SELECT sql_d FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_d;
        $data["req_c"] = $this->db->query("SELECT sql_c FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_c;
				$data["req_f"] = $this->db->query("SELECT sql_f FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_f;
        $this->load->view("ajax/sql_p", $data);
    }
}

?>
