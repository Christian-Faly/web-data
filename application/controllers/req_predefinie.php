<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class req_predefinie extends CI_Controller{
    
    function categorie(){
        $this->load->model("get_db");
        $data["result"] = $this->get_db->getAll("pa_tables");
        $this->load->view("view_site/header");
        $this->load->view("view_site/nav");
        $this->load->view("predefinie/view_categorie",$data);
        $this->load->view("view_site/footer");
    }

    function requete(){
        $this->load->view("view_site/header");
        $this->load->view("view_site/nav");
        
        if (($_POST["action"]=='categorie_listeRequete') or ($_POST["action"]=='listeRequete_listeRequete')){
            $query = $this->db->query("SELECT * FROM pa_Requete WHERE Table1='".$_POST["NomTable"]."'");
            $data["result"]  = $query->result();
            $data["NomTable"]  = $_POST["NomTable"];
            
            $query = $this->db->query("SELECT * FROM pa_DictioDonnee WHERE NomTable='".$_POST["NomTable"]."' ORDER BY Rang");
            $data["resu"]  = $query->result();
            
            if ($_POST["action"]=='listeRequete_listeRequete'){
                $data["critere"]  = $_POST;
            }           
            $this->load->view("predefinie/view_listeRequete",$data);
        }
        
        if ($_POST["action"]=='listerequete_visualiser'){
            $query=$this->db->query("SELECT * FROM pa_Requete WHERE Numero='".$_POST["numero"]."'");
            
            $result  = $query->result();
            foreach($result as $row){
                $selectSection = $row->selectSection ;
                $whereSection = $row->whereSection ;
                $table = $row->Table1 ;
                $critereAnd = "";
                $champs_date = $row->champsdate;
            }
            // ================== Region ==================== 
            if (isset($_POST["cr_Region"])){
                if ($_POST["cr_Region"] == "accept"){
                     $critereAnd =  $data["sql"]." AND (NRegion = ". $_POST["val_Region"].")";
                }
            }
            // ================== District ==================== 
            if (isset($_POST["cr_District"])){
                if ($_POST["cr_District"] == "accept"){
                     $critereAnd =  $critereAnd." AND (NDistrict = ". $_POST["val_District"].")";
                }
            }
            // ================== Commune ==================== 
            if (isset($_POST["cr_Commune"])){
                if ($_POST["cr_Commune"] == "accept"){
                     $critereAnd =  $critereAnd." AND (NCommune = ". $_POST["val_Commune"].")";
                }
            }
            // ================== Date ==================== 
            if (isset($_POST["cr_Date"])){
                if ($_POST["cr_Date"] == "accept"){
                    $date1 = DateTime::createFromFormat('d/m/Y', $_POST["val_Date1"]);
                    $stdate1 = $date1->format('Y/m/d'); 
                    $critereAnd =  $critereAnd." AND (".$champs_date." >= '".$stdate1."')";
                    $date2 = DateTime::createFromFormat('d/m/Y', $_POST["val_Date2"]);
                    $stdate2 = $date2->format('Y/m/d'); 
                    $critereAnd =  $critereAnd." AND (".$champs_date." <= '".$stdate2."')";
                }
            }
            
            // ================== Statistique ==================== 
            if (isset($_POST["cr_Statistique"])){
                if ($_POST["cr_Statistique"]=="accept"){
                    $this->load->model("get_db");
                    $d = $this->get_db->SQL_CroiseePred($_POST);
                    $d{"sql"} = $d["ligneSelect"]."<br>"."FROM ".$table."<br>".$whereSection.$critereAnd."<br>".$d["ligneGroupe"];
                    $data{"sql"} = str_replace("<br>", "\n", $d{"sql"});  
                    $data["limit"] = 1;  
                    if (isset($_POST["limit"])){
                        $data["limit"] = $_POST["limit"];
                    }
                }
            }else{
                $data{"sql"} = "SELECT ".$selectSection."\n"."FROM ".$table."\n".$whereSection."\n".$critereAnd;
            }
            
            $data["limit"] = 1;  
            if (isset($_POST["limit"])){
                $data["limit"] = $_POST["limit"];
            }
            $nbparpage=10;
            $data["nbparpage"] = $nbparpage;
            echo $data{"sql"}."<br>"."<br>"; 
            
            $this->load->view("view_site/view_list",$data);
        }
        $this->load->view("view_site/footer");
    }
}

?>