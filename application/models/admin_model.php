<?php 

class Admin_model extends CI_Model
{

    function __construct()
    {
        
    }

    function getAllUser(){
        /*return $this->db->query("SELECT * FROM users")->result();        */
        return $this->db->select('id, first_name, name,login, role_id, active, id_user_adding, adding_date',false)
            ->from('m_users')
            ->order_by('adding_date', 'desc')
            ->get()
            ->result();
        /*return $this->db->query("select * from users");*/
    }

    function getUserByID($id){
        return $this->db->select('first_name, name,login, role_id, active',false)
            ->from('m_users')
            ->where('id', $id)
            ->get()
            ->result();
    }

    function getBeneficiaireParAnnee(){
        return $this->db->select('date_part,count_a_ctompony',false)
            ->from('nb_beneficiaire_par_annee')
            ->order_by('date_part', 'asc')
            ->get()
            ->result();;
    }

    function getBeneficiaireTypeFormation(){
        return $this->db->select('type_formation,count_a_ctompony',false)
            ->from('type_formation')
            ->limit('6')
            ->get()
            ->result();
    }

    function getBeneficiaireParGenre(){
        return $this->db->select('genre,count_a_ctompony',false)
            ->from('repartition_par_sexe_benef')
            ->order_by('count_a_ctompony', 'desc')
            ->get()
            ->result();
    }

    function getBeneficiaireParGenreRegion($region){
        return $this->db->select('genre,count_a_ctompony',false)
            ->from('repartition_par_sexe_benef_epr')
            ->where('nregion', $region)
            ->order_by('count_a_ctompony', 'desc')
            ->get()
            ->result();
    }

    function getBeneficiaireSFParAnnee(){
        return $this->db->select('date_part,nb,homme,femme',false)
            ->from('beneficiaire_sf_par_annee')
            ->get()
            ->result();
    }

    function getBeneficiaireSFParAnneeRegion($region){
        return $this->db->select('date_part, nb,homme, femme',false)
            ->from('beneficiaire_sf_par_annee_epr')
            ->where('nregion', $region)
            ->order_by('date_part')
            ->get()
            ->result();
    }
    
    function getBeneficiaireParAnneeRegion($region){
        return $this->db->select('date_part, count_a_ctompony',false)
            ->from('nb_beneficiaire_par_annee_epr')
            ->where('nregion', $region)
            ->order_by('date_part')
            ->get()
            ->result();
    }

    function getBeneficiaireTypeFormationRegion($region){
        return $this->db->select('type_formation, count_a_ctompony',false)
            ->from('type_formation_epr')
            ->where('nregion', $region)
            ->limit('6')
            ->get()
            ->result();
    }

    function getBeneficiaireTypeFoire(){
        return $this->db->select('type_foire, count_a_ctompony',false)
            ->from('type_foire')
            ->limit('6')
            ->get()
            ->result();
    }

    function getBeneficiaireTypeFoireRegion($region){
        return $this->db->select('type_foire, count_a_ctompony',false)
            ->from('type_foire_epr')
            ->where('nregion', $region)
            ->limit('6')
            ->get()
            ->result();
    }

    function getBeneficiaireParGenreFoire(){
        return $this->db->select('genre,count_a_ctompony',false)
            ->from('repartition_par_sexe_benef_foire')
            ->order_by('count_a_ctompony', 'desc')
            ->get()
            ->result();
    }

    function getBeneficiaireParGenreFoireREgion($region){
        return $this->db->select('genre,count_a_ctompony',false)
            ->from('repartition_par_sexe_benef_foire_epr')
            ->where('nregion', $region)
            ->order_by('count_a_ctompony', 'desc')
            ->get()
            ->result();
    }

}


?>