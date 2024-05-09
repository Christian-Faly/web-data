<?php
    class Get_db extends CI_Model{

        public function get_query($sql){
            $query = $this->db->query($sql);
            return $query->result();
        }

        public function getAll($nomtable){
            $query = $this->db->query("SELECT * FROM ".$nomtable);
            return $query->result();
        }
        
        public function get_default_table_bdd($pere){
            $sql="SELECT nom_table FROM  arbre
            JOIN pa_tables on nom_table =nomtable
            WHERE arbre.pere like '".$pere."%'
            AND defaut='Oui'
            ORDER BY code";
            $query = $this->db->query($sql);  
            $result = $query->result();
            $nom_table="";
            foreach($result as $row){
                $nom_table=$row->nom_table;
            }
            return $nom_table;
        }

        public function get_dictio_bdd($pere){
            $s="SELECT * FROM (
                SELECT pa_tables.defaut, pa_tables.description as description_table, pa_DictioDonnee.*
                FROM   pa_DictioDonnee 
                JOIN   pa_tables ON pa_DictioDonnee.nomtable=pa_tables.nomtable
                WHERE  (kaody like '".$pere."%')
                UNION 
                SELECT '', 'Localisation ',* FROM pa_DictioDonnee  where nomTable = 'tout') AS A
                order by rang";
                //echo $s;                      
            $query = $this->db->query($s);  
            return $query->result();
        }
        
        public function get_dictiodonnee($nom_table){
            $s="SELECT * FROM (
                SELECT pa_tables.description as description_table, pa_DictioDonnee.*
                FROM   pa_DictioDonnee 
                JOIN   pa_tables ON pa_DictioDonnee.nomtable=pa_tables.nomtable
                WHERE  (pa_tables.nomtable = '".$nom_table."')
                UNION 
                SELECT 'Localisation ',* FROM pa_DictioDonnee  where nomTable = 'tout') AS A
                order by rang";
                //echo $s;                      
            $query = $this->db->query($s);  
            return $query->result();
        }
        
        public function get_menu($typemenu = "04"){
			$query = $this->db->query("SELECT * FROM arbre where pere='".$typemenu."' and type='titre' order by code");
			return $query->result();
		}
		
		public function creer_pere($code, $nom, $type, $acc_type, $nom_table){
			echo '<li class="haschildren">';
				echo '<input type="checkbox" name ="g'.$code.'" id="g'.$code.'">';
				echo '<label for="g'.$code.'">'.$nom.'</label>';
			echo '<ul>';
				$res = $this->db->query("SELECT * FROM arbre where pere='".$code."' and type='titre' order by code");
				foreach($res->result() as $row){
					$this->get_db->creer_fils($row->code, $row->description, $type, $acc_type, $row->nom_table);
				}
			
			echo'</ul></li>';
		}

		public function enr_req($sql, $nom, $pere, $type){
            $sql_id='(select max(id)+1 from pa_requete)';
			$code = $this->get_db->gen_code($pere);
			$query = $this->db->query("insert into pa_requete(id, numero, description, pere, sql_xy) values(".$sql_id.",'".$code."', '".$nom."', '".$pere."', '".$sql."')");
			/*if($query){
				$id = $this->db->insert_id();
				return $id;
			}
			else{
				return false;
            }*/
            return true;
		}

		public function enr_par($id, $array_para){
			foreach($array_para as $para){
				if($para['val1_def'] != "") $para['val1_def'] = "'".$para['val1_def']."'";
				else $para['val1_def'] = "null";
				$query = $this->db->query("insert into parametre(id_req, idpa, operateur, val1_def) values('".$id."', '".$para['idpa']."', '".$para['operateur']."', ".$para['val1_def'].")");
			}
		}

		public function gen_code($pere){
			if($pere != '0'){
				$query = $this->db->query("select max(code) as maximum from arbre where code like '".$pere."__'");
				$query2 = $this->db->query("select max(kaody) as maximum from pa_tables where kaody like '".$pere."__'");
			}
			else{
				$query = $this->db->query("select max(code) as maximum from arbre where code like '".$pere."_'");
				$query2 = $this->db->query("select max(kaody) as maximum from pa_tables where kaody like '".$pere."_'");
			}
			if ($query->num_rows() > 0 OR $query2->num_rows() > 0){
				$row = $query->row();
				$row2 = $query2->row();
				if($row->maximum > $row2->maximum){
					return ("0".($row->maximum+1));
				}
				else{
					return ("0".($row2->maximum+1));
				}
			}
			else return ($pere.'01');
		}

		public function creer_fils($code, $nom, $type, $acc_type, $nom_table){
			$res = $this->db->query("SELECT * FROM arbre where pere='".$code."' and type='titre' order by code");
			if($res->num_rows() > 0){
				 $this->get_db->creer_pere($code, $nom, $type, $acc_type, $nom_table);
			}
			else{
				if($type == "ar"){
					if(!$acc_type){
						echo '<li><a name="'.$nom_table.'" href="'.base_url().'index.php/assist_requete/tables?type=ar&nom_table='.$nom_table.'&code='.$code.'">'.$nom.'</a></li>';
					}
					else{
						echo '<li><a name="'.$nom_table.'" class="titreA" id="'.$code.'" href="#">'.$nom.'</a></li>';
					}
				}
				else{
					if($acc_type){
						echo '<li><a class="titre" id="'.$code.'" href="#">'.$nom.'</a></li>';
					}
					else{
						echo '<li><a href="'.base_url().'index.php/req_pre/acceuil?type=rp&code='.$code.'">'.$nom.'</a></li>';
					}
				}
			}
		}

        public function Initialiser(){
          $result = $this->getAll("pa_tables");
          foreach($result as $row){
            $this->db->query("DROP TABLE ".$row->NomTable);
          }    
        }
        
        public function SQL_Critere($post){
            $this->load->model("get_db");
            $data["nom_table"] = $post["nom_table"];
            $data["select"] = "SELECT *"; 
            $data["critere"] = "WHERE TRUE<br>"; 
            $tri = false;
            $prim = null;
            $cmp = 0;
            $array_para = array();
            $i_par = 0;
            $result = $this->get_db->get_dictiodonnee($post["nom_table"]);
            //echo $post["nom_table"]."<br>";
            foreach($result as $row){
                $id_code=substr($row->nomtable,0,6).$row->code;
                if (isset($post["aff_".$id_code])){
                    $test=$post["aff_".$id_code];
                    if($test=="accept"){
                        if ($row->libelle>''){
                            $champ=$row->libelle;
                        }else{
                            $champ=$row->code;
                        }
                        if ($data["select"] == "SELECT *"){
                            $data["select"] = "SELECT ".$champ;
                        }else{
                            $data["select"] = $data["select"].",".$champ;
                        }; 
                    }
                }
                //parametre
                if (isset($post["par_".$row->code])){
                    $test1=$post["par_".$row->code];
                    if($test1=="accept"){
                        $array_para[$i_par] = array(
											'idpa' => $row->gid,
											'operateur' => $post["op_".$row->code],
											'val1_def' => $post["val1_".$row->code]
											);
						$i_par++;
                    }
                }
                // crit�re
    		if (($row->code=='nregion')or($row->code=='ndistrict') or($row->code=='ncommune')){
                    $nom_table='tout';
                }
                else
                    $nom_table=$post["nom_table"];  
                
	        if (isset($post["cr_".substr($nom_table,0,6).$row->code])){
                    $test=$post["cr_".substr($nom_table,0,6).$row->code];
                    if($test=="accept"){
                        if($row->typecritere == "Date"){
                            //MySQL WHERE date_format( DateTournoi, '%d/%m/%Y' ) >= '28/07/2006' 
                            $stdate1 = date("Y M j", strtotime($post["val1_".substr($nom_table,0,6).$row->code]));
                            //$date1 = DateTime::createFromFormat('d/m/Y', $post["val1_".$row->code]);
							//$stdate1 = $date1->format('Y/m/d');  
                            $stdate2 = date("Y M j", strtotime($post["val2_".substr($nom_table,0,6).$row->code]));
                           // $date2 = DateTime::createFromFormat('d/m/Y', $post["val2_".$row->code]);
                            //$stdate2 = $date2->format('Y/m/d'); 
                            $data["critere"] = $data["critere"]."AND (".$row->code." BETWEEN '".$stdate1."' AND '".$stdate2."')<br>";
                            echo $data["critere"];
                        };
                        if($row->typecritere == "Zone de: �:"){
                            $data["critere"] = $data["critere"]."AND (".$row->code." BETWEEN ".$post["val1_".substr($nom_table,0,6).$row->code]." AND ".$post["val2_".substr($nom_table,0,6).$row->code].")<br>";
                        };
                        if($row->typecritere == "Zone de texte"){
                            if($row->typechamps == "Entier"){
                                $data["critere"] = $data["critere"]."AND (".$row->code.$post["op_".substr($nom_table,0,6).$row->code].$post["val1_".substr($nom_table,0,6).$row->code].")<br>";
                            }else{
                                $data["critere"] = $data["critere"]."AND (TRIM(".$row->code.")".$post["op_".substr($nom_table,0,6).$row->code]."TRIM(E'".addslashes($post["val1_".substr($nom_table,0,6).$row->code])."'))<br>";
                            }
                        };
                        if($row->typecritere == "Liste"){
                            if($row->typechamps == "Entier"){
                                $data["critere"] = $data["critere"]."AND (".$row->code.$post["op_".substr($nom_table,0,6).$row->code].$post["val1_".substr($nom_table,0,6).$row->code].")<br>";
                            }else{
                                $data["critere"] = $data["critere"]."AND (TRIM(".$row->code.")".$post["op_".substr($nom_table,0,6).$row->code]."TRIM('".$post["val1_".substr($nom_table,0,6).$row->code]."'))<br>";
                                //$data["critere"] = $data["critere"]."AND (TRIM(".$row->code.")".$post["op_".$row->code]."TRIM(E'".addslashes($post["val1_".$row->code])."'))<br>";
                            }
                        }
                            
                    }
                }
                
                /*if($post["tri_".$row->code] != ""){
					$tri = true;
					$cmp++;
					if($post["tri_".$row->code] == 1){
						$prim = $row->code;
					}
				}*/
            
            };
            
            
            $data["requete"] = $data["select"]."<br>"."FROM ".$data["nom_table"]."<br>".$data["critere"];
            
            //tri
            /*if($tri){
				$data["requete"] = $data["requete"]." ORDER BY ".$prim;
				foreach($result as $row){
					for($i=2; $i<=$cmp; $i++){
						if($i == $post["tri_".$row->code]){
							$data["requete"] = $data["requete"].", ".$row->code;
						}
					}
				}
			}*/
            $data["array_para"] = $array_para;
            return $data;
        }

        public function get_liste($sql){
				$query = $this->db->query($sql);
				return $query->result();
        }
        
        //========================================================
        public function SQL_Croisee($post){
            $result = $this->get_db->get_dictiodonnee($post["nom_table"]);

            $data["nom_table"] = $post["nom_table"];
            $ligneSelect = "";
            $ligneGroupe = "";   
            $colonne = "";
            $opValeur = "vide"; 
            $valeur = "";  

            $firstSelect = TRUE;
            $firstGroupe = TRUE;
            foreach($result as $row){
                if (isset($post["util_".$row->code])){
                    if ($post["util_".$row->code]=="ligne"){
                        if (!$firstSelect){
                            $ligneSelect = $ligneSelect.',';
                        }
                        $firstSelect = FALSE;
                        if(($post["op_".$row->code]=='Groupement')){
                            $ligneSelect = $ligneSelect.$row->code;
                            if (!$firstGroupe){
                                $ligneGroupe = $ligneGroupe.',';
                            }
                            $ligneGroupe = $ligneGroupe.$row->code;
                            $firstGroupe = FALSE;
                        }else{
                            $ligneSelect = $ligneSelect.$post["op_".$row->code].'('.$row->code.')'; 
                        }
                        $firstSelect = FALSE;
                    }
                    //colonne
                    if ($post["util_".$row->code]=="colonne"){
                        if($post["op_".$row->code]=='Groupement'){
                            $colonne = $row->code;
                        }else{
                             $colonne = $post["op_".$row->code].'('.$row->code.')'; 
                             $opColonne = $post["op_".$row->code]; 
                        }
                        
                    }
                    //valeur
                    if ($post["util_".$row->code]=="valeur"){
											if ($colonne == "")
                        $valeur = ','.$post["op_".$row->code].'('.$row->code.')'; 
											else
												$valeur = '('.$row->code.')'; 
                      $opValeur = $post["op_".$row->code];
                    }
                }else{
                    echo "else isset";
                }
                
            };
            
            $sqlColonne = "";
            if (!($colonne == "")){
                $q = $this->db->query("SELECT ".$colonne." as col FROM ".$post["nom_table"]." GROUP BY ".$colonne);
                $re = $q->result();
                foreach($re as $ro){
                    if($ro->col>""){
                        $as = $this->enleveBlancPonctuation($ro->col);
                        if ((substr($as,1,1)>="0")&&(substr($as,1,1)<="9")){
                            $as = "a".$as;
                        }
                        if ($opValeur == "Count"){
                            $sqlColonne = $sqlColonne.",<br>"."SUM(CASE WHEN ".$colonne." = E'".addslashes($ro->col)."' THEN 1 ELSE 0 END) AS ".$as;
                        } 
                        if ($opValeur == "Sum"){
                            $sqlColonne = $sqlColonne.",<br>"."SUM(CASE WHEN ".$colonne." = E'".addslashes($ro->col)."' THEN ".$valeur." ELSE 0 END) AS ".$as;
                        }
                    } 
                }
            }else{
                $sqlColonne = "<br>".$valeur;
            }
            
            $data["ligneSelect"] = "SELECT ".$ligneSelect.$sqlColonne;
            $data["ligneGroupe"] = "GROUP BY ".$ligneGroupe;
            $data["colonne"]= $colonne; 
            $data["valeur"]= $valeur; 
            return $data;
        } 
        
        //========================================================
        public function SQL_CroiseePred($post){
            $result = $this->get_db->get_dictiodonnee($post["NomTable"]);

            $data["nom_table"] = $post["NomTable"];
            $ligneSelect = "";
            $ligneGroupe = "";   
            $colonne = "";
            $opValeur = "vide"; 
            $valeur = "";  
            $sqlColonne = "";

                //Ligne
                if(($post["op_Ligne"]=='Groupement')){
                    $ligneSelect = $post["val_Ligne"];
                }else{
                    $ligneSelect = "year(".$post["val_Ligne"].')'; 
                }
                //colonne
                if ($post["val_Colonne"]<>'Pas'){
                    if($post["op_Colonne"]=='Groupement'){
                        $colonne = $post["val_Colonne"];
                    }else{
                        $colonne = "year(".$post["val_Colonne"].')'; 
                        $opColonne = "year";
                    } 
                }
                        
                //valeur
                $valeur = $post["op_Valeur"].'('.$post["val_Valeur"].')'; 
                $opValeur = $post["op_Valeur"];

                if (!($colonne == "")){
                    $q = $this->db->query("SELECT ".$colonne." as col FROM ".$post["NomTable"]." GROUP BY ".$colonne);
                    $re = $q->result();
                    foreach($re as $ro){
                        if($ro->col>""){
                            $as = $this->enleveBlancPonctuation($ro->col);
                            if ((substr($as,1,1)>="0")&&(substr($as,1,1)<="9")){
                                $as = "a".$as;
                            }
                            if ($opValeur == "Count"){
                                $sqlColonne = $sqlColonne.",<br>"."SUM(IF(".$colonne." = E'".addslashes($ro->col)."',1,0)) AS ".$as;
                            } 
                            if ($opValeur == "Sum"){
                                $sqlColonne = $sqlColonne.",<br>"."SUM(IF(".$colonne." = E'".addslashes($ro->col)."',".$valeur.",0)) AS ".$as;
                            }
                        } 
                    }
                }else{
                    $sqlColonne = ",<br>".$valeur;
                }

            $data["ligneSelect"] = "SELECT ".$ligneSelect.$sqlColonne;
            $data["ligneGroupe"] = "GROUP BY ".$ligneSelect;
            $data["colonne"]= $colonne; 
            $data["valeur"]= $valeur; 
            return $data;
        } 
        
        public function enleveBlancPonctuation($phrase) {
            $blanc[1]  = ' '; $blanc[2]  = "'"; $blanc[3]  = '"'; $blanc[4]  = '<';
            $blanc[5]  = '-'; $blanc[6]  = '.'; $blanc[7]  = ':'; $blanc[8]  = '*';
            $blanc[9]  = '?'; $blanc[10] = '/'; $blanc[11] = '>'; $blanc[12] = '�';
            $blanc[13] = '!'; $blanc[14] = '$'; $blanc[15] = '*'; $blanc[16] = ',';
            $blanc[17] = ':'; $blanc[18] = ')'; $blanc[19] = '('; $blanc[20] = '[';
            $blanc[21] = ']'; $blanc[22] = '+'; $blanc[23] = '�'; $blanc[24] = '=';
            $blanc[25] = '<br>'; $blanc[26] = '\n';
            $sansPonctuation = $phrase;
            for ($i = 1; $i <= 26; $i++) {
                $sansPonctuation = str_replace($blanc[$i], "_", $sansPonctuation);
            }
            return $sansPonctuation;
        }
    
    }  
?>
