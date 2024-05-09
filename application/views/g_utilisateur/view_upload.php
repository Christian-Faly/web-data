
<?php

    $this->load->helper("form");
    $attributes = array('enctype' => 'multipart/form-data');
    echo form_open("index.php/uploader/traitement",$attributes);

?>
        <!--<form action="index.php/uploader/traitement" method="post" enctype="multipart/form-data">-->
        <h2>Upload Fichier</h2>
        <label for="fileUpload">Fichier:</label>
        <input type="file" name="photo" id="fileUpload">
        <input type="submit" name="submit" value="Upload">
        <p><strong>Note:</strong> Seuls les formats .jpg, .jpeg, .jpeg, .gif, .png sont autorisés jusqu'à une taille maximale de 5 Mo.</p>
<?php    
  echo form_close();  
?>
