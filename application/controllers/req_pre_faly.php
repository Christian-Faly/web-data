<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class req_pre extends CI_Controller{

	public function __construct()
	{		
		// Obligatoire
		parent::__construct();
		session_start();
	}
	
	function acceuil(){
		$this->load->model("get_db");
		$data["menu_accord"] = $this->get_db->get_liste("SELECT code, description FROM arbre WHERE type = 'titre' and pere like '".$_GET["bdd"]."%' ORDER BY code");
		$data["req_pre"] = $this->get_db->get_liste("SELECT id, code, description, pere FROM arbre WHERE type = 'predefinie' and pere like '".$_GET["bdd"]."%' ORDER BY code");
		
		if(isset($_GET["code"])){
			$data["result"] = $this->get_db->get_liste("SELECT * FROM arbre WHERE type='predefinie' and pere like '".$_GET["code"]."%' order by description");
			$data["desc"] = $this->db->query("SELECT description FROM arbre WHERE type='titre' and code='".$_GET["code"]."'")->row()->description;
		}
		else{
			$data["result"] = $this->get_db->get_liste("SELECT * FROM arbre WHERE type='predefinie' and pere like '03%' order by description");
		}
		if(isset($_GET["id"])){
			$data["req"] = $this->db->query("SELECT sql1 FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql1;
			$data["req_r"] = $this->db->query("SELECT sql_r FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_r;
			$data["req_d"] = $this->db->query("SELECT sql_d FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_d;
			$data["req_c"] = $this->db->query("SELECT sql_c FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_c;
			$data["req_f"] = $this->db->query("SELECT sql_f FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_f;
		}
		if(isset($_GET["rech"])){
			$data["result"] = $this->get_db->get_liste("SELECT * FROM arbre WHERE description ilike '%".$_GET["rech"]."%' and type='predefinie' and pere like '01%' order by description");
		}
		$data["acc_type"] = true;
		$data["model"] = $this->get_db;
		if(isset($_GET["typemenu"])){
			$data["rac_result"] = $this->get_db->get_menu($_GET["typemenu"]);
		}
		else{
			$data["rac_result"] = $this->get_db->get_menu();
		}
		$data["pa_region"] = $this->get_db->get_liste("SELECT distinct nom, code, maitre FROM pa_region order by nom");
		$data["pa_district2"] = $this->get_db->get_liste("SELECT distinct nom, code, maitre FROM pa_district order by nom");
		$data["pa_commune2"] = $this->get_db->get_liste("SELECT distinct nom, code, maitre FROM pa_commune order by nom");
		if(isset($_GET["code_com"])){
			if($_GET["code_com"] != "Nu"){
				$data["pa_fokontany"] = $this->get_db->get_liste("SELECT distinct nom, code, maitre FROM pa_fokontany where maitre='".$_GET["code_com"]."' order by designationfok");
			}
			else{
				$data["pa_fokontany"] = $this->get_db->get_liste("SELECT distinct nom, nom as code, maitre FROM pa_fokontany order by nom");
			}
		}
		else{
			$data["pa_fokontany"] = $this->get_db->get_liste("SELECT distinct nom, nom as code, maitre FROM pa_fokontany order by nom");
		}
		if(isset($_GET["code_dis"])){
			if($_GET["code_dis"] != "Nu"){
				$data["pa_commune"] = $this->get_db->get_liste("SELECT distinct nom, code, maitre FROM pa_commune where maitre='".$_GET["code_dis"]."' order by nom");
				$data["pa_fokontany"] = $this->get_db->get_liste("select distinct nom, code from fokontany inner join pa_commune on pa_commune.code = pa_fokontany.maitre inner join pa_district on pa_district.code = pa_commune.maitre where pa_district.code = '".$_GET["code_dis"]."' order by nom");
			}
			else{
				$data["pa_commune"] = $this->get_db->get_liste("SELECT distinct nom, code, maitre FROM pa_commune order by nom");
				$data["pa_fokontany"] = $this->get_db->get_liste("SELECT distinct nom, code, maitre FROM pa_fokontany order by nom");
			}
		}
		else{
			$data["pa_commune"] = $this->get_db->get_liste("SELECT nom, code, maitre FROM pa_commune order by nom");
		}
		if(isset($_GET["code_reg"])){
			if($_GET["code_reg"] != "Nu"){
				$data["pa_district"] = $this->get_db->get_liste("SELECT distinct nom, code, maitre FROM district where maitre='".$_GET["code_reg"]."' order by nom");
				$data["pa_commune"] = $this->get_db->get_liste("select distinct nom, code from pa_commune inner join pa_district on pa_district.code = pa_commune.maitre inner join pa_region on pa_region.code = pa_district.maitre where region.code = '".$_GET["code_reg"]."' order by nom");
				$data["pa_fokontany"] = $this->get_db->get_liste("select distinct nom, code from pa_fokontany inner join pa_commune on pa_commune.code = pa_fokontany.maitre inner join pa_district on pa_district.code = pa_commune.maitre inner join pa_region on pa_region.code = pa_district.maitre where pa_region.code = '".$_GET["code_reg"]."' order by nom");
			}
			else{
				$data["pa_district"] = $this->get_db->get_liste("SELECT distinct nom, code, maitre FROM pa_district order by nom");
				$data["pa_commune"] = $this->get_db->get_liste("SELECT distinct nom, code, maitre FROM pa_commune order by nom");
				$data["pa_fokontany"] = $this->get_db->get_liste("SELECT distinct nom, nom as code, maitre FROM pa_fokontany order by nom");
			}
		}
		else{
			$data["pa_district"] = $this->get_db->get_liste("SELECT distinct nom, code, maitre FROM pa_district order by nom");
			$data["pa_commune"] = $this->get_db->get_liste("SELECT distinct nom, code, maitre FROM pa_commune order by nom");
			$data["pa_fokontany"] = $this->get_db->get_liste("SELECT distinct nom, nom as code, maitre FROM pa_fokontany order by nom");
		}
		
		$data["type"] = (isset($_GET["type"])?$_GET["type"]:'predefinie');
		$this->load->view("view_site/header");
		$this->load->view("view_site/nav");
		$this->load->view("view_site/accordeon",$data);
		$this->load->view("predefinie/list_requete_pre",$data);
		$this->load->view("view_site/footer_suite");
	}
}
?>