<?php 

class Login_model extends CI_Model
{

    var $user=array();

    function __construct()
    {
       
    }

    function can_login($username){
        $this->db->where('login', $username);
        //$this->db->where('password', $password);
        $query=$this->db->get('m_users');
        if ($query->num_rows()>0){
            return true;
        }
        else{ 
            return false; 
        }
    }

    function valide_pass($username,$password){
        $pass=$password;
        $results=$this->db->select('password',false)
        ->from('m_users')
        ->where('login', $username)
        ->get()
        ->result();
        if(is_array($results)){
            foreach($results as $result){
                if ($result->password===$pass) return true;
                else return false;
            }
        }
        
    }

    function user_role($username){
        $results=$this->db->select('role_id',false)
            ->from('m_users')
            ->where('login', $username)
            ->get()
            ->result();
        if(is_array($results)){
            foreach($results as $result){
                return $result->role_id;
            }
        }
    }

    function getUser(){
        return $this->user;
    }

    function getAllUser(){
        return $this->db->query("SELECT * FROM user")->result();        
    }
}

?>