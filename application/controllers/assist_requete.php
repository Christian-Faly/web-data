<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class assist_requete extends CI_Controller{

	public function __construct()
	{		
		// Obligatoire
		parent::__construct();
		session_start();
        //$this->load->model('admin_model');
        if ($this->session->userdata('username')!=''){   
        }
		else redirect('index.php/site/index');
		$this->session->set_userdata('action_img', 'Req_souple');
	}
	
	function tables(){
		//foreach($_GET as $key => $val) echo '$_GET["'.$key.'"]='.$val.', '; 
		//echo 'assistant/liste_enregistrement - view_site/footer_suite';
		$data["acc_type"] = true;
		$this->load->library("form_validation");
		$this->form_validation->set_rules("nom_table","nom table","required");
		$this->load->model("get_db");

		if(isset($_GET["bdd"]) AND $_GET["bdd"]!=""){
			$data["resultA"] = $this->get_db->get_dictio_bdd($_GET["bdd"]);
			$data["nom_table"] =$this->get_db->get_default_table_bdd($_GET["bdd"]);
			$data["menu_enr"] = $this->get_db->get_liste("SELECT code, description, nom_table FROM arbre WHERE type = 'titre' and pere like '".$_GET["bdd"]."%' ORDER BY code");
			//echo "SELECT code, description, nom_table FROM arbre WHERE type = 'titre' and pere like '".$_GET["bdd"]."%' ORDER BY code";
		}
		if(isset($_GET["nom_table"]) AND $_GET["nom_table"]!=""){
			$data["resultA"] = $this->get_db->get_dictiodonnee($_GET["nom_table"]);
			$data["nom_table"] = $_GET["nom_table"];
		}
		$data["model"] = $this->get_db;
		$data["rac_result"] = $this->get_db->get_menu();
		$data["type"] = $_GET["type"];
		if(isset($_GET["code"])){
			$data["result"] = $this->get_db->get_liste("SELECT * FROM arbre WHERE type='enregistree' and pere = '".$_GET["code"]."' order by description");
			$data["code_r"] = $_GET["code"];
			$data["boolcon"] = $this->db->query("SELECT geo FROM arbre WHERE code = '".$_GET["code"]."'")->row()->geo;
		}
		else if (isset($_GET["bdd"]) AND $_GET["bdd"]!=""){
			$data["result"] = $this->get_db->get_liste("SELECT * FROM arbre WHERE type='enregistree' AND pere like '0201%' order by description");
		}
		else{
			$data["result"] = $this->get_db->get_liste("SELECT * FROM arbre WHERE type='enregistree' order by description");
		}
		if(isset($_GET["rech"])){
			$data["result"] = $this->get_db->get_liste("SELECT * FROM arbre WHERE type='enregistree' and description ilike '%".$_GET["rech"]."%' and pere like '01%' order by description");
		}
		if(isset($_GET["id"])){
			$data["req"] = $this->db->query("SELECT sql1 FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql1;
			$data["req_r"] = $this->db->query("SELECT sql_r FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_r;
			$data["req_d"] = $this->db->query("SELECT sql_d FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_d;
			$data["req_c"] = $this->db->query("SELECT sql_c FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_c;
			$data["req_f"] = $this->db->query("SELECT sql_c FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_f;
			
		}
		$this->load->view("view_site/header");
		$this->load->view("view_site/nav");
		//$this->load->view("view_site/accor",$data);
		//echo "eto";
		$this->load->view("assistant/liste_enregistrement",$data);
		//$this->load->view("view_site/footer_suite");
		$this->load->view("view_site/footer");
	}
	
	public function gire(){
	
		$this->load->view("view_site/header");
		$this->load->view("view_site/nav");
		$this->load->view("view_site/accor",$data);
		$this->load->view("view_site/view_carte_gire");
		$this->load->view("view_site/footer");
	}		

	public function dictioDonnee(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("nom_table","nom table","required");
		$this->load->model("get_db");
		$data["model"] = $this->get_db;
		$data["result"] = $this->get_db->get_dictiodonnee($_GET["nom_table"]);
		$data["rac_result"] = $this->get_db->get_menu();
		$data["nom_table"] = $_GET["nom_table"];
		$data["type"] = $_GET["type"];
		$this->load->view("view_site/header");
		$this->load->view("view_site/nav");
		$this->load->view("view_site/accor",$data);
		$this->load->view("assistant/view_dictiodonnee",$data);
		$this->load->view("view_site/footer");
	}
	
	public function tableau_sql_ajax(){
		$data["limit"] = 0;
		$data["sql"] = $_POST["textSQL"];
		$data["by_ajax"]='Oui';
		//$this->load->view("view_site/header0");
		$this->load->view("view_site/view_list",$data);
		$this->load->view("view_site/footer",$data);
	}	

	public function visualisation(){
		$nbparpage=100;
		$data["nbparpage"] = $nbparpage;
		$this->load->model("get_db");
		 
		//echo "OK";
		
		//foreach($_POST as $key => $val) echo '$_POST["'.$key.'"]='.$val.'<br>'; 
		
		if(($_POST["action"] != "visu_carte") AND ($_POST["action"] != "config_carte")){
			$this->load->view("view_site/header");
			$data['pas_nav']='si';
			$this->load->view("view_site/nav",$data);
			if($_POST["action"] == "sql_liste"){
				$this->load->view("view_site/header");
				//echo '<h1 style="font-size:38px"><a href="#">PROSPERER</a></h1>';
				//echo "<p>Systeme d'Information Geographique</p>";
				// R�cup�ration des variables POST
				if (isset($_POST["id_requete"]) AND ($_POST["id_requete"]!="")){
					$query = $this->db->query('select sql_xy,sql_r,sql_d,sql_c,sql_f,champ_critere_date from arbre where id='.$_POST["id_requete"]);
					foreach ($query->result() as $row){
						$sql_xy= 'select * from ('.$row->sql_xy.') as d';
						$sql_r= 'select * from ('.$row->sql_r.') as d';
						$sql_d= 'select * from ('.$row->sql_d.') as d';
						$sql_c= 'select * from ('.$row->sql_c.') as d';
						$sql_f= 'select * from ('.$row->sql_f.') as d';
						$champ_date= $row->champ_critere_date;
					}
				}
				if (isset($_POST["unite_geo"])) {
				 
					if ($_POST["unite_geo"]==1){
							$data["sql"] =$sql_r; //$_POST["textSQL_r"]; 
					}
					if ($_POST["unite_geo"]==2){
							$data["sql"] = $sql_d;//$_POST["textSQL_d"]; 
					}
					if ($_POST["unite_geo"]==3){
							$data["sql"] = $sql_c;//$_POST["textSQL_c"];
					}
					if ($_POST["unite_geo"]==4){
							$data["sql"] = $sql_f;//$_POST["textSQL_f"];
					} 
					if ($_POST["unite_geo"]==5){
							$data["sql"] = $sql_xy;//$_POST["textSQL"]; 
					} 
				}
				else if (isset($_POST["id_requete"])AND ($_POST["id_requete"]!="")){
					$data["sql"] = $sql_xy;
					$data["sql"]=$data["sql"].') as z where true';	
				}
				else if (isset($_POST["textSQL"])){
					$data["sql"] = $_POST["textSQL"];
				}
				else if (isset($_POST["nom_req"])){
					$q = $this->db->query('select sql_xy from arbre where id='.$_POST["nom_req"]);
					foreach ($q->result() as $r){
						$data["sql"] = $r->sql_xy;
					}
				}
					
				
				if(isset($_POST["array_para"])){
					$data["array_para"] = unserialize($_POST["array_para"]);
				}

				$data["limit"] = 0;  
				$data["model"] = $this->get_db;
				$data["rac_result"] = $this->get_db->get_menu();

				if(isset($_POST["code_r"])){
					$data["code_r"] = $_POST["code_r"];
				}
				if(isset($_POST["nom_req"])){
					$data["nom_req"] = $_POST["nom_req"];
				}
				else{
					$data["nom_req"] = "";
				}
				if(isset($_POST["type"])){
					$data["type"] = $_POST["type"];
				}
				else{
					$data["type"] = 'ar';
				}
				
				if (isset($_POST["limit"])){
						$data["limit"] = $_POST["limit"];
				}
				
				if (strtolower(substr($data["sql"], -strlen("WHERE TRUE")))<>"where true"){ 
					$data["sql"] = $data["sql"]." WHERE TRUE";
				}
				
				if(isset($_POST["val_fok"])and($_POST["val_fok"]>0)){
						$data["sql"] = $data["sql"]." and (idfok = ".$_POST["val_fok"].')';
				}
				elseif (isset($_POST["val_com"])and($_POST["val_com"]>0)){
						$data["sql"] = $data["sql"]." and (idcom = ".$_POST["val_com"].')';
				}
				elseif (isset($_POST["val_dis"])and($_POST["val_dis"]>0)){
						$data["sql"] = $data["sql"]." and (iddis = ".$_POST["val_dis"].')';
				}
				elseif (isset($_POST["val_reg"])and($_POST["val_reg"]>0)){
						$data["sql"] = $data["sql"]." and (idreg = ".$_POST["val_reg"].')';
				}
				if(isset($_POST["milieu"]) AND isset($_POST["op_mil"])){
					$data["sql"] = $data["sql"]." and (trim(milieu) ilike '".$_POST["milieu"]."')";
				}
				if (isset($_POST['val_reg'])) {
					$data['val_reg']=$_POST['val_reg'];
				}	
				
		        //echo $data["sql"];
				//echo '/n';
				//$champ_date;
				
				if(isset($_POST["datedeb"])) {//and ($_POST["datedeb"]!=NULL) and ($champ_date>"")
					if($_POST["datedeb"]!=NULL) {
						//$data["sql"] = $data["sql"]." and (".$champ_date." >= '".$_POST["datedeb"]."')";
						//$data["sql"] = $data["sql"]." and (".$champ_date." <= '".$_POST["datefin"]."')";
						$data["sql"] =str_replace ("True" , "(".$champ_date." >= '".$_POST["datedeb"]."')"." and (".$champ_date." <= '".$_POST["datefin"]."')",$data["sql"],$n);
					}
				}
				//echo $data["sql"];
				
				if ($data["sql"]!='non disponible'){
					$this->load->view("view_site/view_list",$data);
				}
				else {
					echo "non disponible";
				}
			}
			//echo 'eto 1 <br>';
			
			/*if($_POST["action"] != "sql_liste"){
				$this->load->view("view_site/header");
				$this->load->view("view_site/nav");
			}*/
				
			if (isset($_POST["source"])){
				if ($_POST["source"]=="dictioDonnee"){
					$data = $this->get_db->SQL_Critere($_POST);
				}
			}

			$data["nbparpage"] = $nbparpage;
			$data["mere"] = $this->db->query("select * from arbre where pere='0' and sql1='titre'")->result();
				
				//rafraichissement donn�es
			if($_POST["action"] == "actualiser"){
			
				/*//actualiser;
				$this->load->model("Actualisation");
				$this->actualisation->actualiser; */
				$data["acc_type"] = true;
				$this->load->library("form_validation");
				$this->form_validation->set_rules("nom_table","nom table","required");
				$this->load->model("get_db");
				if(isset($_GET["nom_table"]) AND $_GET["nom_table"]!=""){
					$data["resultA"] = $this->get_db->get_dictiodonnee($_GET["nom_table"]);
					$data["nom_table"] = $_GET["nom_table"];
				}
				$data["model"] = $this->get_db;
				$data["rac_result"] = $this->get_db->get_menu();
				$data["type"] = $_GET["type"];
				if(isset($_GET["code"])){
					$data["result"] = $this->get_db->get_liste("SELECT * FROM arbre WHERE type='enregistree' and pere = '".$_GET["code"]."' order by description");
					$data["code_r"] = $_GET["code"];
					$data["boolcon"] = $this->db->query("SELECT geo FROM arbre WHERE code = '".$_GET["code"]."'")->row()->geo;
				}
				else{
					$data["result"] = $this->get_db->get_liste("SELECT * FROM arbre WHERE type='enregistree' order by description");
				}
				if(isset($_GET["rech"])){
					$data["result"] = $this->get_db->get_liste("SELECT * FROM arbre WHERE type='enregistree' and description ilike '%".$_GET["rech"]."%' and pere like '01%' order by description");
				}
				if(isset($_GET["id"])){
					$data["req"] = $this->db->query("SELECT sql1 FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql1;
					$data["req_r"] = $this->db->query("SELECT sql_r FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_r;
					$data["req_d"] = $this->db->query("SELECT sql_d FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_d;
					$data["req_c"] = $this->db->query("SELECT sql_c FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_c;
					$data["req_f"] = $this->db->query("SELECT sql_c FROM arbre WHERE id='".$_GET["id"]."'")->row()->sql_f;
				}
				$this->load->view("view_site/header");
				$this->load->view("view_site/nav");
				$this->load->view("view_site/accor",$data);
				$this->load->view("assistant/liste_enr",$data);
				$this->load->view("view_site/footer");
			}
			
			//controle coordonee        
			if ($_POST["action"] == "control_d"){
				$data["limit"] = 0;  
				$data["model"] = $this->get_db;
				$data["rac_result"] = $this->get_db->get_menu();
				if(isset($_POST["code_r"])){
					$data["code_r"] = $_POST["code_r"];
				}
				if(isset($_POST["type"])){
					$data["type"] = $_POST["type"];
				}
				else{
					$data["type"] = 'ar';
				}
				if(isset($_POST["nom_table"])){
					$w= $_POST["nom_table"];
					$query =$this->db->query("select champlong,champlat,verifier from arbre where nom_table='".$w."'");
					$row=$query->result();
	
					foreach ($query->result() as $row){
						$champlong= $row->champlong;
						$champlat= $row->champlat;
						$verifier= $row->verifier;
					}
				}

				//$this->db->query("drop table if exists  coo_faux");
				//$this->db->query("create table coo_faux as select nipo,the_geom from '".$w."', c_fokontany 
					//                  where (not st_within(the_geom, c_fokontany.geom)) and ('".$w."'.idfok=c_fokontany.idfok)");
				$this->db->query("select champlong,champlat,verifier from arbre where nom_table='".$w."'");
				$data["sql"] = "select idfok as loc, ".$verifier.",designationloc as localite,designationfok as fokontany, designationcom as commune,designationdis as district from ".$w.", c_communes where (not st_within(st_setSRID(st_MakePoint(".$champlong.",".$champlat."),4326), c_communes.geom)) and (".$w.".idcom=c_communes.idcom)";

				$data["nom_req"] = "Liste des coordonnees non conformes";
				$this->load->view("view_site/accor",$data);
				$this->load->view("view_site/view_list",$data);
			}  
			// voir SQL � partir de crit�re
				
			if ($_POST["action"]=="critere_sqlliste"){
				//echo $data["requete"];	
				//echo $data["requete"];$this->load->model("get_db");
				$data["model"] = $this->get_db;
				$data["rac_result"] = $this->get_db->get_menu();
				$data["requete"] =$data["requete"];
				echo $data["requete"];
				$data["type"] = 'ar';
				if(isset($_POST["code_r"])){
					$data["code_r"] = $_POST["code_r"];
				}
				//$this->load->view("view_site/accor",$data);
				$this->load->view("assistant/view_SQL",$data); 
			}
			
			// voir directement liste � partir de crit�re
			if($_POST["action"] == "critere_liste"){
				$sql = $data["requete"];
				$this->load->model("get_db");
				$data["model"] = $this->get_db;
				$data["rac_result"] = $this->get_db->get_menu();
							$data["sql"] = str_replace("<br>", "\n", $sql);
							$data["limit"] = 0;  
				$data["type"] = 'ar';
				
				if(isset($_POST["code_r"])){
					$data["code_r"] = $_POST["code_r"];
				}
				if (isset($_POST["limit"])){
					$data["limit"] = $_POST["limit"];
				}
				//$this->load->view("view_site/accor",$data);
				$this->load->view("view_site/view_list",$data);
			}

			// voir pr�pare liste crois� � partir de critere
			if($_POST["action"] == "critere_preparecroise"){
				$data["model"] = $this->get_db;
				$data["result"] = $this->get_db->get_dictiodonnee($_POST["nom_table"]);
				$data["type"] = 'ar';
				$data["rac_result"] = $this->get_db->get_menu();
				//$this->load->view("view_site/accor",$data);
				$this->load->view("assistant/view_requetecroise",$data);
			}
			// voir critere � partir de critere
			if($_POST["action"] == "dictio_dictio"){
				$this->load->library("form_validation");
				$this->form_validation->set_rules("nom_table","nom table","required");
				$this->load->model("get_db");
				$data["result"] = $this->get_db->get_dictiodonnee($_POST["nom_table"]);
				$data["nom_table"] = $_POST["nom_table"];
				$data["type"] = 'ar';
				if (isset($_POST["val1_Region"])){
						$data["critere"]=$_POST;
				}
				$this->load->view("assistant/view_dictiodonnee",$data);
			}        
			
			// voir pr�pare liste crois� � partir de critere
			if($_POST["action"] == "sql_preparecroise"){
				$data["result"] = $this->get_db->get_dictiodonnee($_POST["nom_table"]);
				$data["nom_table"] =  $_POST["nom_table"] ;
				$sql = $_POST["textSQL"];
				$data["requete"] = str_replace("<br>", "\n", $sql);
				$data["type"] = 'ar';
				$this->load->view("content_requetecroise",$data);
			}
			
			// voir sql crois� � partir de prepare sql croise
			if($_POST["action"] == "prepareCroise_sqlCroise"){
				$this->load->model("get_db");
				$d = $this->get_db->SQL_Croisee($_POST);
				$d["model"] = $this->get_db;
				$d["critere"] = $_POST["critere"];
				$d["nom_table"] = $_POST["nom_table"];
				$d["requete"] = $d["ligneSelect"]."<br>"."FROM ".$d["nom_table"]."<br>".$d["critere"]."<br>".$d["ligneGroupe"];
				$d["type"] = 'ar';
				$d["rac_result"] = $this->get_db->get_menu();
				$this->load->view("view_site/accor",$d); 
				$this->load->view("assistant/view_SQL",$d); 
			}

			if($_POST["action"] == "preparCroise_tableau"){
				$d = $this->get_db->SQL_Croisee($_POST);
				$d["critere"] = $_POST["critere"];
				$d["nom_table"] = $_POST["nom_table"];
				$d{"sql"} = $d["ligneSelect"]."<br>"."FROM ".$d["nom_table"]."<br>".$d["critere"]."<br>".$d["ligneGroupe"];
				$data["type"] = 'ar';
				$data["model"] = $this->get_db;
				$data["rac_result"] = $this->get_db->get_menu();
				$data{"sql"} = str_replace("<br>", "\n", $d{"sql"});  
				$data["limit"] = 0;  
				if (isset($_POST["limit"])){
						$data["limit"] = $_POST["limit"];
				}

				//$this->load->view("view_site/accor",$data);
				$this->load->view("view_site/view_list",$data);
			}
			
		}
		else{  
			//======= chercher carte =================
			$this->load->model("get_arbre");
			$tab_lien = $this->get_arbre->getCarte($_POST["id_requete"],$_POST["unite_geo"]);       
			$this->load->model("manip_fichier");
			$data["model_manip_fichier"] = $this->manip_fichier;
			$data["vpost"]= $_POST;
			$data["lien_carte"] = $tab_lien;
			$this->load->view("view_site/view_carte", $data);
		}
		$this->load->view("view_site/footer");
	}
	
	public function visu_correction(){
			$this->load->model("manip_fichier");
			$data["model_manip_fichier"] = $this->manip_fichier;
			$data["x"] ='x';
			if (isset($_GET["loc"])){
					$data["loc"]=$_GET["loc"];    
			}
			$this->load->view("view_site/header");
			$this->load->view("view_site/nav");
			$this->load->view("view_site/view_carte", $data);
			$this->load->view("view_site/footer");
	}
}
?>
