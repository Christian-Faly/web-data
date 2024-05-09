<?php
	$this->load->helper("form");
	?>

<div id="sqlcorps">
    <?php if(isset($req)){
            $data = array(
                    "name" => "textSQL",
                    "id" => "sqltext",
                    "value" => $req,
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';
            $data = array(
                    "name" => "type",
                    "id" => "typeacc",
                    "value" => "rp",
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';?>
            <?php } ?>        

    <?php if(isset($req_r)){
            $data = array(
                    "name" => "textSQL",
                    "id" => "sqltext",
                    "value" => $req_r,
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';
            $data = array(
                    "name" => "type",
                    "id" => "typeacc",
                    "value" => "rp",
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';?>
            <?php } ?>        
    <?php if(isset($req_d)){
            $data = array(
                    "name" => "textSQL",
                    "id" => "sqltext",
                    "value" => $req_d,
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';
            $data = array(
                    "name" => "type",
                    "id" => "typeacc",
                    "value" => "rp",
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';?>
            <?php } ?>        
    <?php if(isset($req_c)){
            $data = array(
                    "name" => "textSQL",
                    "id" => "sqltext",
                    "value" => $req_c,
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';
            $data = array(
                    "name" => "type",
                    "id" => "typeacc",
                    "value" => "rp",
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';?>
            <?php } ?>        
    <?php if(isset($req_f)){
            $data = array(
                    "name" => "textSQL",
                    "id" => "sqltext",
                    "value" => $req_f,
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';
            $data = array(
                    "name" => "type",
                    "id" => "typeacc",
                    "value" => "rp",
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';?>
            <?php } ?>        
		</div>
