<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class seam extends CI_Controller{
	public function __construct()
	{		
		// Obligatoire
		parent::__construct();
		session_start();
	}
    
  function index() {
		$_SESSION["nbvisites"]=$_GET["nv"];
		$_SESSION["utilisateur"]=$_GET["ut"];		
		$_SESSION["gpe"]=$_GET["gp"];
		$_SESSION["gire"]=$_GET["gire"];
		//id_session
		if ($_GET["gire"]==1) { //gire
			//redirect(base_url().'index.php/assist_requete/tables?type=ar', 'refresh'); 
			redirect(base_url().'index.php/assist_requete/gire', 'refresh');
		}
		elseif ($_GET["gire"]==2) { //requete assiste
			redirect(base_url().'index.php/assist_requete/tables?type=ar', 'refresh'); 
		}
		else {//cartographie/requete predefinie
			redirect(base_url().'index.php/req_pre/acceuil?type=rp', 'refresh'); 
		}
	}
}