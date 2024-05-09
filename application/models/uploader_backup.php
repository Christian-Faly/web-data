<?php
    class Uploader_backup extends CI_Model{
        function traitement(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
    
                foreach($_FILES["photo"] as $key => $val) echo '$_FILES["'.$key.'"]='.$val.'<br>'; 
    
                // Vérifie si le fichier a été uploadé sans erreur.
                if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
                    $allowed = array("backup" => "fichier backup");
                    $filename = $_FILES["photo"]["name"];
                    $filetype = $_FILES["photo"]["type"];
                    $filesize = $_FILES["photo"]["size"];
        
                    // Vérifie l'extension du fichier
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    echo $ext.'<br>';
                    foreach($allowed as $key => $val) echo '$allowed["'.$key.'"]='.$val.'<br>'; 
    
                    if(!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");
        
                    // Vérifie si le fichier existe avant de le télécharger.
                    if(file_exists("upload/" . $_FILES["photo"]["name"])){
                            echo $_FILES["photo"]["name"] . " existe déjà.";
                    }else{
                            move_uploaded_file($_FILES["photo"]["tmp_name"], "upload/" . $_FILES["photo"]["name"]);
                            echo "Votre fichier a été téléchargé avec succès.";
                    } 
                } else{
                    echo "Error: " . $_FILES["photo"]["error"];                                                                                          
                }
            }
        }
    }
?>
