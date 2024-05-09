<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class g_utilisateur extends CI_Controller{
	
	public function __construct()
	{		
		// Obligatoire
		parent::__construct();
		session_start();
	}
	
	public function saisie_utilisateur(){
		$this->load->model("get_db");
		$this->load->model("model_conso");
		$data["bdd"] = $this->get_db->getAll("m_users");
		if (isset($_POST["modif"])){
			//echo "SELECT * FROM m_users WHERE login='".$_POST["modif"]."'"; echo "<bd>";
			$d = $this->get_db->get_liste("SELECT * FROM m_users WHERE login='".$_POST["modif"]."'");
			$data["a_modifier"] =$d[0];
		}else{
			$data["a_modifier"] =$data["bdd"][0];
			//echo $data["a_modifier"]->niveau;					
		}
		
		$this->load->view("view_site/header");
		$this->load->view("view_site/nav");
		if ((isset($_POST["action"])) and ($_POST["action"]=='init_bdd')){
		
		}elseif ((isset($_POST["action"])) and ($_POST["action"]=='init_tables')){
		
		}elseif ((isset($_POST["action"])) and ($_POST["action"]=='consolider')){
		
		}else
			$this->load->view("g_utilisateur/saisie_ut",$data);
		$this->load->view("view_site/footer");
	}	
}
?>
