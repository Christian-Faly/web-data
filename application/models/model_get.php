<?php
    
    class  Model_get extends CI_Model{
        function getData($page){
            $query = $this->db->get_where("pageData",array("page"=>$page));
            return $query->result();
        }

        function testLogin(){
            if(isset($_POST) && !empty($_POST['login']) && !empty($_POST['pass'])) {
                extract($_POST);
                // on recupère le password de la table qui correspond au login du visiteur
                $sql = "select pwd from tbl_user where login='".$login."'";
                $req = $this->db->query($sql);// or die('Erreur SQL !<br>'.$sql.'<br>');//mysql_error())

                foreach ($req->result_array() as $data){  //$query->result_array()
                if($data['pwd'] != $pass) {
                    echo '<p>Mauvais login / password. Merci de recommencer</p>';
                    $resultat = FALSE;
                }else {
                    session_start();
                    $_SESSION['login'] = $login;
                    echo 'Vous etes bien logué';
                    $resultat = TRUE;
                } }  
            }else {
                echo '<p>Vous avez oublié de remplir un champ.</p>';
                $resultat = FALSE;
            }
            Return $resultat;
        }
    }
?>