<?php
    class Model_conso extends CI_Model{
        function connection_dblink(){
            $pwd='vony';
            $port='5432';
            $user='postgres';    
            return ' user='.$user.' password='.$pwd.' port='.$port;
        }

        public function Initialiser_BDD (){
            $prg='"C:/Program Files (x86)/PostgreSQL/9.4/bin/pg_restore"'; 
            $param=' --host localhost --port 5432 --username "postgres" --no-password ';// --verbose 
            $_dbname=' --dbname ';  
            $_backup=' "C:/webserver/Apache24/htdocs/carto_web/upload/Itasy/';
            $this->load->model("get_db");
            $result = $this->get_db->getAll("pa_liste_bdd");
            foreach($result as $row){
                if ($row->en_cours=='Non'){
                    //$this->db->query('DROP DATABASE IF EXISTS '.$row->nombdd);
                    //$this->db->query('CREATE DATABASE '.$row->nombdd);
                    $dbname=$_dbname.' "'.$row->nombdd.'"';  
                    $backup= $_backup.$row->nombdd.'.backup"';
                    $commande = $prg.$param.$dbname.$backup;
                    //proc_open($commande,'r');//
                    //shell_exec($commande);
                    $output=shell_exec($commande);
                    //$output=shell_exec('dir '.$prg);
                    echo "<pre>$output</pre>";

                    break;
                }
            }
            return $commande;
            //shell_exec('execute');
        }
        
        public function AS_t($bdd_origine,$table){
            $i=0;
            $l=0;
            $NomChamp='';
            $ligne='';
            $c=$this->connection_dblink();
            $s="SELECT * FROM dblink('dbname=".$bdd_origine.$c."','SELECT column_name, data_type, character_maximum_length
                FROM information_schema.columns WHERE table_name=''".$table."''')
                AS t(column_name varchar(50),data_type varchar(50),caracter_maximum_length integer)";
            $query = $this->db->query($s);  
            $result = $query->result();
            $t='';
            $first=1;
            foreach($result as $row){
                if ($first<>1)
                    $t=$t.","." ";
                if ($first=1)
                    $first=$first+1;
                $ligne='';
                $nomChamp = $row->column_name;
                $data_type = $row->data_type;
                if ($data_type == 'character varying'){
                    $caracter_maximum_length = $row->caracter_maximum_length;
                    if ($caracter_maximum_length  > 0){
                        $l=$caracter_maximum_length;
                    }else{
                        $l=255;
                    }
                    $data_type= 'varchar('.$l.')';    
                }
                $ligne = $nomChamp.' '.$data_type;   
                $t=$t.$ligne;
            }
            return 'AS t( '.$t.')';
        }

        public function Link_Colunne_Origine($bdd_origine,$table){
            $c=$this->connection_dblink();
            $as_nom_bdd=",CAST('".$bdd_origine."' AS character varying(50)) as nom_bdd";
            $select_link = "SELECT * ".$as_nom_bdd." FROM dblink('dbname=".$bdd_origine." ".$c."','select * FROM ".$table."')";
            $as_t=$this->AS_t($bdd_origine,$table);
            $select_link = $select_link ." ".$as_t;
            return $select_link;
        }
        
        public function consolider_table($table,$type_bdd){
            $this->load->model("get_db");
            $result = $this->get_db->getAll("pa_liste_bdd");
            $first= true;
            $boucle='';
            foreach($result as $row){
                if (strpos($row->objets_saisie, $type_bdd) !== false){
                    if ($first){
                        $creer_ajout='CREATE TABLE '.$table.' AS';
                        $first=False;
                    }else
                        $creer_ajout='INSERT INTO '.$table.' ';
                    $select_link=$this->Link_Colunne_Origine($row->nombdd,$table);
                    $this->db->query($creer_ajout.' '.$select_link);
                    $boucle = $boucle.$row->nombdd.', ';   
                }
            } 
            return $boucle; 
        }
        
        public function consolidation_Init(){
            $this->load->model("get_db");
            $result = $this->get_db->get_query("SELECT * FROM pa_aconsolider ORDER BY nomtable");
            $st='';
            foreach($result as $row){
                $s="DROP TABLE IF EXISTS ".$row->nomtable;
                $this->db->query($s);
            }
            $this->db->query("UPDATE pa_aconsolider SET statut='DROPPED'");
            return $st.'<br>';
        }

        public function consolider_Tout(){
            $this->load->model("get_db");
            $result = $this->get_db->get_query("SELECT * FROM pa_aconsolider WHERE statut='DROPPED' ORDER BY nomtable");
            $st='';
            foreach($result as $row){
                $st=$row->nomtable.'('.$row->typebdd.')==>>';
                $st=$st.$this->consolider_table($row->nomtable,$row->typebdd);
                $this->db->query("UPDATE pa_aconsolider SET statut='OK' WHERE nomtable='".$row->nomtable."'");
                //break;
            }
                        //$st='Message';
            return $st.'<br>';
        }
                 
    }
?>