<?php
    
    class  get_arbre extends CI_Model{
        function getCarte($idrequete,$unitegeo){
            $query = $this->db->query("SELECT carte,titre FROM liste_carte where (idrequete=".$idrequete.")and(unite_geo=".$unitegeo.")");
            if ($query->num_rows() > 0){
                foreach ($query->result() as $row){            
                    $tab[$row->titre] = $row->carte;  
                }
            }
            else{
                $tab_lien['Vide...'] = array('#');
            }
            return $tab;
        }
    }
?>