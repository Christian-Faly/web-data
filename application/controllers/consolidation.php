<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class consolidation extends CI_Controller{

	public function __construct()
	{
		// Obligatoire
		parent::__construct();
		session_start();
	}

	public function saisie_conso(){
		$this->load->model("get_db");
		$this->load->model("model_conso");
		$data["bdd"] = $this->get_db->getAll("pa_liste_bdd");
		if (isset($_POST["modif"])){
			echo "SELECT * FROM pa_liste_bdd WHERE nombdd='".$_POST["modif"]."'"; echo "<bd>";
			$d = $this->get_db->get_liste("SELECT * FROM pa_liste_bdd WHERE nombdd='".$_POST["modif"]."'");
			$data["a_modifier"] =$d[0];
		}else{
			$data["a_modifier"] =$data["bdd"][0];
			echo $data["a_modifier"]->niveau;
		}


		if (isset($_POST["action"])){
			if ($_POST["action"]=='Upload'){
				//echo "eto 3";
				//if($_SERVER["REQUEST_METHOD"] == "POST"){
	            //foreach($_FILES["photo"] as $key => $val) echo '$_FILES["'.$key.'"]='.$val.'<br>';
		        // Vérifie si le fichier a été uploadé sans erreur.
            	//echo "eto 3";
				if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
					//echo "eto 4";
					$allowed = array("backup" => "fichier backup");
                	$filename = $_FILES["photo"]["name"];
                	$filetype = $_FILES["photo"]["type"];
                	$filesize = $_FILES["photo"]["size"];
                  	// Vérifie l'extension du fichier
                	$ext = pathinfo($filename, PATHINFO_EXTENSION);
               		//echo $ext.'<br>';
                	//foreach($allowed as $key => $val) echo '$allowed["'.$key.'"]='.$val.'<br>'; 
                	if(!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");
					// Vérifie si le fichier existe avant de le télécharger.
					$dossier='upload/'.$_POST["user_region"].'/';
                	if(file_exists($dossier . $_FILES["photo"]["name"])){
                        $data["message"]=$_FILES["photo"]["name"]." existe déjà.";
                	}else{
                        move_uploaded_file($_FILES["photo"]["tmp_name"], $dossier . $_FILES["photo"]["name"]);
                        $data["message"]="Votre fichier a été téléchargé avec succès.";
                	}
            	} else{
                	$data["message"]="Error: ". $_FILES["photo"]["error"];
				}
			}
		}
		$this->load->view("view_site/header");
		$this->load->view("view_site/nav");
		if ((isset($_POST["action"])) and ($_POST["action"]=='init_bdd')){
			$data["message"] = $this->model_conso->Initialiser_BDD();
			//$data["message"] = 'Initialisation BOO OK';
			$this->load->view("view_site/view_message",$data);
		}elseif ((isset($_POST["action"])) and ($_POST["action"]=='init_tables')){
			$this->model_conso->consolidation_Init();// Restauration  Action= trust pg_hba postgres
			$data["message"] = 'Initialisation Tables OK';
			$this->load->view("view_site/view_message",$data);
		}elseif ((isset($_POST["action"])) and ($_POST["action"]=='consolider')){
			$data["message"] = $this->model_conso->consolider_Tout(); //
			$this->load->view("view_site/view_message",$data);
		}else
			$this->load->view("consolidation/view_saisie",$data);
		$this->load->view("view_site/footer");
	}
}
?>
