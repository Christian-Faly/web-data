<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tb extends CI_Controller{
    public function __construct()
	{		
		// Obligatoire
        parent::__construct();
        $this->load->helper('url');
        session_start();
        $this->session->set_userdata('action_img', 'tb');
	}

    function annexe1D(){
        $this->load->view("view_site/header");
        $this->load->view("view_site/nav");
        if(isset($_GET["tb"])){
            $data["tb"] = $_GET["tb"];
            $data["page"] = 1;
            $data["nbparpage"] = 100;
            $this->load->view("tb/fp/view_tb",$data);//view_annexe1D -- view_annexe1D_annu -- view_tb
            $this->load->view("view_site/footer_suite");
            $this->load->view('view_site/footer',$data);
        }
    }

    // http://localhost/carto_web/index.php/tb/param_tb?tb=tb_annexe1d&classe=annuel&val_Annee=2021&val_Region=0&page=0&nbparpage=100
    public function param_tb(){
        $data["tb"] = $_GET["tb"];
        $data["classe"] = $_GET["classe"];
        $data["page"] = $_GET["page"];
        $data["nbparpage"] = $_GET["nbparpage"];
        $data["val_Annee"] = $_GET["val_Annee"];
        $data["val_Region"] = $_GET["val_Region"];
        $data["sql"] = "SELECT * FROM ".$_GET["tb"]." WHERE activer='Oui'";
        $data["sql"] = $data["sql"].' ORDER BY arbre'; 
        $sql= "SELECT count(*) as nb_enr FROM ".$_GET["tb"]." WHERE activer='Oui'";

        $query = $this->db->query($sql);  
        $result = $query->result();
        $nb_enr=0;
        foreach($result as $row){
            $nb_enr=$row->nb_enr;
        }
        echo $nb_enr;
        $data["nb_enr"] = $nb_enr; 
	$this->load->view("view_site/header");
        $this->load->view("tb/fp/view_tb_".$_GET["classe"],$data);//view_annexe1D -- view_annexe1D_annu -- view_tb
	$this->load->view("view_site/footer");
    }


    public function essai(){
        $this->load->view("view_site/header");
        echo '<table id="example" class="display" style="width:100%">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Position</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        echo '<tr>';
        echo '<td>Tiger Nixon</td>';
        echo '<td>System Architect</td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
        $this->load->view("view_site/footer");
	}


    public function pagetb(){
        $nbparpage=100;
        $data["nbparpage"] = $nbparpage;
        $this->load->view("view_site/header");
        $this->load->view("view_site/nav");

        $data["tb"]=$_POST["tb"];
        $data["classe"]=$_POST["classe"];
        $data["val_Annee"]=$_POST["val_Annee"];
        $data["val_Region"]=$_POST["val_Region"];
 
        if ($_POST["action"]=='critere'){
            $data['tb']=$_POST["tb"];// mandrapiandry
           
            $data["sql"] = $_POST["sql"];
            $data["limit"] = 0;  
            $data["val_Region"] = $_POST["val_Region"] ;  
            $data["val_Annee"] = $_POST["val_Annee"];   
            $this->load->view("tb/fp/view_annexe1D",$data);
        }
        
        if ($_POST["action"]=='list_page1'){
            $data{"sql"} = $_POST["sql"];
            $data["limit"] = 1;  
            $this->load->view("tb/fp/view_annexe1D",$data);
        }
        
        if ($_POST["action"]=='list_pageprec'){
            $data{"sql"} = $_POST["sql"];
            if (($_POST["limit"]-$nbparpage) < 1 ){
                $data["limit"] = 1;    
            }else{
                $data["limit"] = $_POST["limit"]-$nbparpage;  
            }
            $this->load->view("tb/fp/view_annexe1D",$data);
        }

        if ($_POST["action"]=='list_pagesuiv'){
            $data{"sql"} = $_POST["sql"];
            $data["limit"] = $_POST["limit"]+$nbparpage;  
            $this->load->view("tb/fp/view_annexe1D",$data);
        }
        
        if ($_POST["action"]=='list_pagedern'){
            $data{"sql"} = $_POST["sql"];
            $result =  $this->db->query($data{"sql"});
            $num_rows = $result->num_rows();
            $data["limit"] = round($num_rows/$nbparpage)*$nbparpage;  
            $this->load->view("tb/fp/view_annexe1D",$data);
        }
        $this->load->view("view_site/footer_suite");    
    } 
}
