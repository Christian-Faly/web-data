<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

    var $data = array();

    public function __construct()
	{		
		// Obligatoire
        parent::__construct();
        $this->load->helper('url');
        session_start();
        $this->load->model('admin_model');
        $this->load->model('login_model');
        $this->session->set_userdata('action_img', 'acceuil');
	}
	
    public function index(){
        //$this->telecharger();
        $data_ = array();
        $data_['benef_par_annee'] = $this->admin_model->getBeneficiaireParAnnee();
        $data_['benef_formation'] = $this->admin_model->getBeneficiaireTypeFormation();
        $data_['benef_par_genre'] = $this->admin_model->getBeneficiaireParGenre();
        $data_['benef_sf_par_annee'] = $this->admin_model->getBeneficiaireSFParAnnee();
        $data_['benef_foire']=$this->admin_model->getBeneficiaireTypeFoire();
        $data_['benef_foire_pr_genre']=$this->admin_model->getBeneficiaireParGenreFoire();
        if ($this->session->userdata('username')!=''){
            $this->data=$data_;
			if ($this->session->userdata('role_id')==='1'){
				$data_['users'] = $this->admin_model->getAllUser();
                $this->data=$data_;
			}
        }
        $this->load->view('view_site/header');
        $this->load->view("view_site/nav");
		$this->load->view('welcome',$this->data);
        $this->load->view('view_site/footer',$this->data);
        //echo($this->session->userdata('action_img'));
    }


    public function getbeneSF_Region($region)
    {
        //echo json_encode($benefs_);
        echo json_encode($this->admin_model->getBeneficiaireSFParAnneeRegion($region));
    }

    public function getBeneficiaire_Region($region){
        
        echo json_encode($this->admin_model->getBeneficiaireParAnneeRegion($region));
    }
    
    public function getBeneficiaireTypeFormation_Region($region){
        
        echo json_encode($this->admin_model->getBeneficiaireTypeFormationRegion($region));
    }
    
    public function getBenefRepartition_genre_Region($region){
        echo json_encode($this->admin_model->getBeneficiaireParGenreRegion($region));
    }

    public function getBeneficiaireTypeFoireRegion($region){
        echo json_encode($this->admin_model->getBeneficiaireTypeFoireRegion($region));
    }

    public function getBeneficiaireParGenreFoireRegion($region){
        echo json_encode($this->admin_model->getBeneficiaireParGenreFoireREgion($region));
    }

    

    public function login_validation()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules ('login','Username','required');
		$this->form_validation->set_rules ('password','Password','required');

		if ($this->form_validation->run())
		{
			$username=$this->input->post('login');
			$password=$this->input->post('password');
			if ($this->login_model->can_login($username)){
                if ($this->login_model->valide_pass($username,$password)){
                    $role_id=$this->login_model->user_role($username);
                    $session_data = array(
                        'username'=>$username,
                        'role_id'=>$role_id
                    );
                    $this->session->set_userdata($session_data);
                    if ($role_id!="")
                    //redirect('http://localhost/prosperer-2/index.php/site/index');
                    print_r(1);
                }
                else print_r('Mot de passe incorrecte'); 
			}
			else {
				$this->session->set_flashdata('error', 'login passe incorrecte');
				print_r('Login introuvable');
			}
		}
		else {
			$this->session->set_flashdata('error', 'login et mot de passe incorrectes');
			print_r('mot de passe ou login vide!!');
		}
	}
   

    public function logout(){
		$this->session->sess_destroy();
		redirect('/index.php/site/index');
    }
    











 
    


//////////code Faly 

    public function acceuil(){
        $this->load->view("view_site/header");
        $this->load->view("view_site/nav");
        $this->load->view("view_site/view_acceuil");
        $this->load->view("view_site/footer");}

    public function home(){
            //session_start();
        if(!isset($_SESSION['login'])) {
            echo 'Vous n\'�tes pas autoris� � acceder � cette zone';
            $this->load->view("view_login");
            exit;
        }
        //echo $_POST["initialiser"];
        if (isset($_POST["action"])){
            $data["init"] = TRUE;
            $this->load->model("get_db");
            echo "debut initialisation";
            $this->get_db->initialiser();
            echo "fin initialisation";
        }else{
            echo "AFFICHAGE TEMINER";
            $data["init"] = FALSE;    
        }
        $this->load->view("view_site/header");
        $this->load->view("view_site/nav");
        $this->load->view("view_site/content_home",$data);
        $this->load->view("view_site/footer");
    }

    public function telecharger(){
        
        $upload_dir="csv/";
        $data["file_types_array"]=array('csv','xls');
        $data["num_of_uploads"]=1;
        $data["max_file_size"]=1048576;
        
        if(!isset($_POST['submitted'])){
            $this->load->view("view_site/header");
            $this->load->view("view_site/nav");
            $this->load->view("view_site/content_home",$data);
            $this->load->view("view_site/footer");
        }else{
            if (strlen($_POST['val_Region'])==1){
                $val_Region='0'.$_POST['val_Region'];
            }else{
                $val_Region=$_POST['val_Region']; 
            }
            $ndf = $_POST['val_Type'].$val_Region.$_POST['val_Annee'].$_POST['val_Trim'].'.csv';
            $this->load->model("utilitaire");
            $err=$this->utilitaire->FILE_UPLOADER($data["num_of_uploads"], $data["file_types_array"],$data["max_file_size"], $upload_dir,$ndf);
            if($err=='succ�s'){
                $this->utilitaire->Import_CSV_To_Temp($_POST['val_Type'],$upload_dir.$ndf);    
                $this->utilitaire->InsererRealisation($_POST['val_Import'],$_POST['val_Type'],$_POST['val_Trim'],$_POST['val_Annee'],$val_Region,$_POST['val_Champs']);
            $this->load->view("view_site/header");
            $this->load->view("view_site/nav");
            $data["msg"]= 'Import "'.$_FILES['file']['name'][0].'" '.$err;
            $this->load->view("view_site/content_home",$data);
            $this->load->view("view_site/footer");
            }
        }
    }

    public function about(){
        session_start();
        if(!isset($_SESSION['login'])) {
            echo 'Vous n\'�tes pas autoris� � acceder � cette zone';
            $this->load->view("view_login");
            exit;
        }                     
        $this->load->model("model_get");
        $data["results"] = $this->model_get->getData("about");
        $this->load->view("view_site/header");
        $this->load->view("view_site/nav");
        $this->load->view("view_site/content_about",$data);
        $this->load->view("view_site/footer");
    }                                        

    public function contact(){
        session_start();
        if(!isset($_SESSION['login'])) {
            echo 'Vous n\'�tes pas autoris� � acceder � cette zone';
            $this->load->view("view_login");
            exit;
        }
        $data["message"] = "";
        
        $this->load->view("site_header");
        $this->load->view("site_nav");
        $this->load->view("site_content_contact",$data);
        $this->load->view("site_footer");
    }                   
    
    public function afficher_page(){
        $nbparpage=100;
		$this->load->model("get_db");
        $data["nbparpage"] = $nbparpage;
		$data["model"] = $this->get_db;
		$data["rac_result"] = $this->get_db->get_menu();
        $data["mere"] = $this->db->query("select * from arbre where pere='0' and sql1='titre'")->result();
		if(isset($_POST["type"])){
			$data["type"] = $_POST["type"];
		}
		else{
			$data["type"] = "ar";
		}
		if(isset($_POST["nom_req"])){
			$data["nom_req"] = $_POST["nom_req"];
		}
		else{
			$data["nom_req"] = "";
		}
        $this->load->view("view_site/header");
        $this->load->view("view_site/nav");
        //$this->load->view("view_site/accor", $data);
        
		if ($_POST["action"]=='enregistrer'){
			$sql = str_replace("'", "''", $_POST["sql"]);
			$array_para = unserialize($_POST["array_para"]);
			$data["enr_result"] = $this->get_db->enr_req($sql, $_POST["desc_req"], $_POST["code_r"], "enregistree");
			if($data["enr_result"]){
				$this->get_db->enr_par($data["enr_result"], $array_para);
			}
			$data["nom_req"] = " : ".$_POST["desc_req"];
            $data["sql"] = $_POST["sql"];
            $data["limit"] = 1;  
            $this->load->view("view_site/view_list",$data);
        }
        
        if ($_POST["action"]=='list_page1'){
            $data{"sql"} = $_POST["sql"];
            $data["limit"] = 1;  
            $this->load->view("view_site/view_list",$data);
        }
        
        if ($_POST["action"]=='list_pageprec'){
            $data{"sql"} = $_POST["sql"];
            if (($_POST["limit"]-$nbparpage) < 1 ){
                $data["limit"] = 1;    
            }else{
                $data["limit"] = $_POST["limit"]-$nbparpage;  
            }
            $this->load->view("view_site/view_list",$data);
        }

        if ($_POST["action"]=='list_pagesuiv'){
            $data{"sql"} = $_POST["sql"];
            $data["limit"] = $_POST["limit"]+$nbparpage;  
            $this->load->view("view_site/view_list",$data);
        }
        
        if ($_POST["action"]=='list_pagedern'){
            $data["sql"] = $_POST["sql"];
			$query = $this->db->query($_POST["sql"]);
			$num_rows = $query->num_rows();
            $data["limit"] = round($num_rows/$nbparpage)*$nbparpage;  
            $this->load->view("view_site/view_list",$data);
        }
        
        $this->load->view("view_site/footer");
    } 
                                      
    public function send_email(){
        session_start();
        if(!isset($_SESSION['login'])) {
            echo 'Vous n\'�tes pas autoris� � acceder � cette zone';
            $this->load->view("view_login");
            exit;
        }
        $this->load->library("form_validation");
        
        $this->form_validation->set_rules("fullname","Full name","required|alpha");
        $this->form_validation->set_rules("email","E-mail Adresse","required|valid_email");
        $this->form_validation->set_rules("message","Message","required");
        
        if ($this->form_validation->run() == FALSE){
            $data["message"] = "";
            $this->load->view("view_site/header");
            $this->load->view("view_site/nav");
            $this->load->view("view_site/content_contact",$data);
            $this->load->view("view_site/footer");
        }else {
            $data["message"] = "The email has successfully been sent!";
            
            $this->load->view("view_site/header");
            $this->load->view("view_site/nav");
            $this->load->view("view_site/content_contact",$data);
            $this->load->view("view_site/footer");
        }
    }

    public function infoServer(){
        session_start();
        if(!isset($_SESSION['login'])) {
            echo 'Vous n\'�tes pas autoris� � acceder � cette zone';
            $this->load->view("view_login");
            exit;
        }
        $this->load->view("view_site/header");
        $this->load->view("view_site/nav");
        $this->load->view("content_info_server");
        $this->load->view("view_site/footer");
    }

}

?>
