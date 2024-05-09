<?php
    class Utilitaire extends CI_Model{
        function FILE_UPLOADER($num_of_uploads, $file_types_array,$max_file_size, $upload_dir,$ndf){
            if(!is_numeric($max_file_size)){
                $max_file_size = 1048576;
            }
            $max_file_size_Mo = $max_file_size/1048576;
                foreach($_FILES['file']['error'] as $key => $value){
                    if($_FILES['file']['name'][$key]!=""){
                        if($value==UPLOAD_ERR_OK){
                            $origfilename = $_FILES['file']['name'][$key];
                            $filename = explode('.', $_FILES['file']['name'][$key]);
                            $filenameext = $filename[count($filename)-1];
                            unset($filename[count($filename)-1]);
                            $filename = implode('.', $filename);
                            $filename = substr($filename, 0, 15).'.'.$filenameext;
                            $file_ext_allow = FALSE;//par mesure de securité on suppose l'extenion du fichier fausse
                            //verifions si notre fichier fait partie des types autorisés
                            if(false !== ($iClef = array_search($filenameext, $file_types_array))) {
                                $file_ext_allow = TRUE;
                            }
                            if($file_ext_allow){
                                if($_FILES['file']['size'][$key]<$max_file_size){
                                    if(move_uploaded_file($_FILES['file']['tmp_name'][$key], $upload_dir.$ndf)){
                                        $error ='succès';
                                        /*echo('Transfert de fichier effectué avec succès. -
                                        <a href="'.$upload_dir.$filename.'" target="_blank">'.$filename.'</a><br />');
                                        /*evidemment plutot que d'afficher ici le lien vers le fichier uploader
                                        sur le serveur vous pouvez proceder à une redirection vers une autre page*/
                                    }else{
                                        //echo('Une erreur est survenue lors du transfert de '.'<strong>'.$origfilename.'</strong><br />');
                                        $error ='Une erreur est survenue lors du transfert de '.'<strong>'.$origfilename.'</strong><br />';
                                    }
                                }else{
                                    //echo('La taille du fichier '.''.$origfilename.''.' excède les '.$max_file_size_Mo.' Mo autorisé(s)');
                                    $error = 'La taille du fichier '.''.$origfilename.''.' excède les '.$max_file_size_Mo.' Mo autorisé(s)';
                                }
                            }else{
                                echo('Le fichier '.''.$origfilename.''.'  a une extension invalide, ERREUR DE TRANSFERT !<br />');
                                $error ='Le fichier '.''.$origfilename.''.'  a une extension invalide, ERREUR DE TRANSFERT !<br />'; 
                            }
                        }else{
                            //echo('Une erreur est survenue lors du transfert de '.'<strong>'.$origfilename.'</strong>');
                            $error = 'Une erreur est survenue lors du transfert de '.'<strong>'.$origfilename.'</strong>';
                        }
                    }
            
            }
        return $error;
        }
        
        function Import_CSV_To_Temp($typa,$chemin){
            if ($typa=='B'){
                $desc_type='budget';
            }
            if ($typa=='P'){
                $desc_type='realisation';
            }
            if ($typa=='A'){
                $desc_type='realisation';
            }
           $this->db->query("DELETE FROM temp_".$desc_type);
            $sql="LOAD DATA LOCAL INFILE '".$chemin."' 
                INTO TABLE temp_".$desc_type." 
                FIELDS TERMINATED BY ';' 
                ENCLOSED BY '' 
                LINES TERMINATED BY '\r\n'";    
           $this->db->query($sql);
        }
        
        function InsererRealisation($Import,$typa,$trim,$annee,$nregion,$valeur_a_importer){
            if ($typa=='B'){
                $op='<>';
                $desc_type='budget';
            }
            if ($typa=='P'){
                $op='=';
                $desc_type='realisation';
            }
            if ($typa=='A'){
                $op='<>';
                $desc_type='realisation';
            }
            if ($Import=='V'){
                $champs='Prevision';
                $champs_0='Realisation';
            }else{
               $champs='Realisation';   
               $champs_0='Prevision';   
            }
            $sql="DELETE FROM ".$desc_type." WHERE (LEFT(Code,2)".$op."'PR')
                  AND (Trimestre='".$trim."') AND (Annee=".$annee.")AND (NRegion=".$nregion.")
                  AND(".$champs.">0)"; 
            $this->db->query($sql);
            
            if ($desc_type=='realisation'){
                $sql="INSERT INTO realisation (Code, trimestre, annee,NRegion, ".$champs." )
                    SELECT analytique,'".$trim."',". $annee.",".$nregion.",".$valeur_a_importer." FROM temp_realisation 
                    INNER JOIN indicateur_a1d ON temp_".$desc_type.".analytique=indicateur_a1d.Code"; 
                $this->db->query($sql);
                
            }
            if ($desc_type=='budget'){
                $sql="INSERT INTO budget (Code, trimestre, annee,NRegion,Dcaissement,Engagement,budget )
                    SELECT code,'".$trim."',". $annee.",".$nregion.",LTRIM(Dcaissement),LTRIM(Engagement),LTRIM(budget) FROM temp_budget"; 
                $this->db->query($sql);
                
            }
            $sql="DELETE FROM ".$desc_type." WHERE ((Realisation=0)OR(Realisation is NULL))
                                               AND ((Prevision=0)OR(Prevision is NULL))"; 
            $this->db->query($sql);
        }
        
    }
?>