<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class suivi_evaluation_fp extends CI_Controller{

	public function __construct()
	{		
		// Obligatoire
		parent::__construct();
		session_start();
	}
	
		
	function enquete(){
		$this->load->model("get_db");
	

		$data["liste_region"] =  $this->get_db->get_liste("SELECT * FROM pa_region WHERE zoneaction='1'");
        $data["liste_district"] = $this->get_db->getAll("pa_district");
        $data["cible"] = $this->get_db->getAll("se_cible");
        $data["cible_enquete"] = $this->get_db->getAll("se_cible_enquete");
        $data["initiateur"] = $this->get_db->getAll("se_initiateur");
        $data["intervenant"] = $this->get_db->getAll("se_intervenant");
		$data["type_enquete"] = $this->get_db->getAll("se_type_enquete");
		$data["theme"] = $this->get_db->getAll("se_theme");
		
		$data["enquete"] =  $this->get_db->get_liste("SELECT se_enquete.*, pa_region.nom as region, pa_district.nom as district 
						from se_enquete LEFT JOIN pa_region ON se_enquete.nregion=pa_region.code 
						LEFT JOIN pa_district ON se_enquete.ndistrict=pa_district.code");
       	if (isset($_POST["modif"])){
			echo "Modif";
			$d =	$this->get_db->get_liste("SELECT se_enquete.*, pa_region.nom as region, pa_district.nom as district 
					from se_enquete LEFT JOIN pa_region ON se_enquete.nregion=pa_region.code 
					LEFT JOIN pa_district ON se_enquete.ndistrict=pa_district.code WHERE id=".$_POST["modif"]);
			$data["a_modifier"] =$d[0];
			echo "ffff";
		}else{
			echo "premier";
			$data["a_modifier"] =$data["enquete"][0];
		}

		$this->load->view("view_site/header");
		$this->load->view("view_site/nav");
		$this->load->view("view_maj/fp/view_enquete",$data);
		$this->load->view("view_site/footer");
	}
	
	function Communication(){
		$this->load->model("get_db");
		
		$data["liste_region"] =  $this->get_db->get_liste("SELECT * FROM pa_region WHERE zoneaction='1'");
        $data["liste_district"] = $this->get_db->getAll("pa_district");
        $data["categorie_com"] = $this->get_db->getAll("se_categorie_com");
        $data["cible"] = $this->get_db->getAll("se_cible");
        $data["initiateur"] = $this->get_db->getAll("se_initiateur");
        $data["intervenant"] = $this->get_db->getAll("se_intervenant");
        $data["se_typeactivite_com"] = $this->get_db->getAll("se_type_enquete");
		
		$data["comm"] = $this->get_db->getAll("se_communication");
        if (isset($_POST["modif"])){
			$d = $this->get_db->get_liste("SELECT * FROM se_communication WHERE id=".$_POST["modif"]);
			$data["a_modifier"] =$d[0];
		}else{
			$data["a_modifier"] =$data["comm"][0];
		}
		$this->load->view("view_site/header");
		$this->load->view("view_site/nav");
		$this->load->view("view_maj/fp/view_communication",$data);
		$this->load->view("view_site/footer");
	}

	function gestion_savoir(){
		$this->load->model("get_db");
		
		$data["liste_region"] =  $this->get_db->get_liste("SELECT * FROM pa_region WHERE zoneaction='1'");
        $data["liste_district"] = $this->get_db->getAll("pa_district");
        $data["cible"] = $this->get_db->getAll("se_cible");
        $data["initiateur"] = $this->get_db->getAll("se_initiateur");
        $data["intervenant"] = $this->get_db->getAll("se_intervenant");
        $data["nature_gs"] = $this->get_db->getAll("nature_gs");
        $data["niveau_gs"] = $this->get_db->getAll("se_niveau_gs");
		$data["se_typeactivite_gs"] = $this->get_db->getAll("se_type_enquete");
		
		$data["savoir"] = $this->get_db->getAll("se_gestionsavoir");
        if (isset($_POST["modif"])){
			$d = $this->get_db->get_liste("SELECT * FROM se_gestionsavoir WHERE id=".$_POST["modif"]);
			$data["a_modifier"] =$d[0];
		}else{
			$data["a_modifier"] = $data["savoir"][0];
		}
		$this->load->view("view_site/header");
		$this->load->view("view_site/nav");
		$this->load->view("view_maj/fp/view_gestion_savoir",$data);
		$this->load->view("view_site/footer");
	}
}
?>