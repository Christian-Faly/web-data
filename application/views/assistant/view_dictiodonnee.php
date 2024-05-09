      
        <?php
            $this->load->helper("form");
            echo form_open("index.php/assist_requete/visualisation");
            $val_Region = 0;
            $data = array(
                    "name" => "nom_table",
                    "id" => "nom_table",
                    "value" => $nom_table,
                    'maxlength'   => '20',
                    'type'   => 'hidden',
                    'size'        => '20'
            );
            echo '<td>'.form_input($data).'</td>';

            $data = array(
                    "name" => "source",
                    "id" => "om_table",
                    "value" => "dictioDonnee",
                    'maxlength'   => '20',
                    'type'   => 'hidden',
                    'size'        => '20'
            );
            echo '<td>'.form_input($data).'</td>';
			echo '<div style="width:79%;float:right;">';
            echo '<table class="flatTable">'."\n";
            $d="P";
            echo '<tbody>';
            echo '<tr class="titleTr">';
			echo '<td style="text-align:left;" colspan="9">CATEGORIE REQUETE</td>';
			echo '</tr>';
            echo '<tr class="headingTr">';
            echo '<td style="width:40px;" >BAS</td>';
            echo '<td style="">TRI</td>';
            echo '<td style="">RANG</td>';
            echo '<td style="">DESCRIPTION</td>';
            echo '<td style="">AFFICHER</td>';
            echo '<td style="">CRITERE</td>';
            echo '<td style="">OPERATEUR</td>';
            echo '<td style="">VALEUR 1</td>';
            echo '<td style="">VALEUR 2</td>';
            echo '</tr>'."\n";
            $i=0;
            foreach($result as $row){
                $i=$i+1;
                echo '<tr>';  
                
                echo '<td><a style="font-size:9pt;color:#6b6b6b;" href="#ancre"> >> </a></td>';  
                
                if (isset($critere["tri_".$row->code])){
                   $valeur = $critere["tri_".$row->code];
                }else{
                   $valeur = "";  
                }
                
                /*$data = array(
                    "name" => "tri_".$row->code,
                    "id" => "tri_".$row->code,
                    "value" => $valeur,
                    'maxlength'   => '2',
                    'size'        => '2',
                    'style'		  => 'height:10px;'
                );*/
                ?>
                <td><input size=4 type="text" style="font-size:8pt;height:25px;" class="form-control" name="tri_<?php echo $row->code?>" id="tri" placeholder="Tri"></td> <?php
                echo '<td style="font-size:9pt;">'.$i.'</td>'; //form_label($row->Rang,"fullname")
                echo '<td style="font-size:9pt;">'.form_label($row->description,"fullname").'</td>';

                $check = FALSE;  
                if (isset($critere["aff_".$row->code])){
                   if ($critere["aff_".$row->code] = "accept"){
                       $check = TRUE;
                   }
                }
                $data = array(
                    'name'        => "aff_".$row->code,
                    'id'          => "aff_".$row->code,
                    'value'       => 'accept',
                    'checked'     => $check,
                    'style'       => 'margin-left:10px;height:10px;'
                );
                echo '<td>'.form_checkbox($data).'</td>';
                                                                            
                $check = FALSE;  
                if (isset($critere["cr_".$row->code])){
                   if ($critere["cr_".$row->code] = "accept"){
                       $check = TRUE;
                   }
                }
                $data = array(
                    'name'        => "cr_".$row->code,
                    'id'          => "cr_".$row->code,
                    'value'       => 'accept',
                    'checked'     => $check,
                    'style'       => 'margin:10px;height:10px;'
                );
                echo '<td>'.form_checkbox($data).'</td>';
                 /*                                                           
                $options = array(
                    '='  => '=',
                    '>'  => '>',
                    '<'  => '<',
                    '<>' => '<>',
                    'Nu' => 'Null'
                );
                echo '<td>'.form_dropdown("op_".$row->code, $options, 'egale').'</td>'; */
                ?>
                <td>
					<select name="op_<?php echo $row->code;?>" style="width:60px;height:25px;" id="operateur" >
						<option value ="=">=</option>
						<option value ="></option>">></option>
						<option value ="<"><</option>
						<option value ="<>"><></option>
						<option value ="Nu">Null</option>
					</select>
                </td>
                <?php
                //print_r($row);
                if ($row->typecritere == "Zone de texte"){
                    /*$data = array(
                        "name" => "val1_".$row->code,
                        "id" => "val1_".$row->code,
                        "value" => "",
                        'maxlength'   => '50',
                        'size'        => '25',
                    'style'		  => 'height:15px;'
                    );
                    echo '<td>'.form_input($data).'</td>';*/ ?>
                    <td><input type="text" style="font-size:8pt;height:25px;" class="form-control" name="val1_<?php echo $row->code?>" id="val1" placeholder="Valeur 1"></td>
                    <?php echo '<td style="">'." --- ".'</td>';
                }

                if ($row->typecritere == 'Date'){
                   $valeur = "";  
                    if (isset($critere["val1_".$row->code])){
                        $valeur = $critere["val1_".$row->code];
                    }
                    /* $data = array(
                        "name" => "val1_".$row->code,
                        "id" => "val1_".$row->code,
                        "value" => $valeur,
                        'maxlength'   => '50',
                        'size'        => '25'
                    );
                    echo '<td>'.form_input($data).'</td>'; */
                    ?> <td><input type="text" value="<?php echo $valeur ?>" style="font-size:8pt;height:25px;" class="form-control" name="val1_<?php echo $row->code?>" id="val1" placeholder="Valeur 1"></td> <?php

                   $valeur = "";  
                    if (isset($critere["val2_".$row->code])){
                        $valeur = $critere["val2_".$row->code];
                    }
                    /*$data = array(
                        "name" => "val2_".$row->code,
                        "id" => "val2_".$row->code,
                        "value" => $valeur,
                        'maxlength'   => '50',
                        'size'        => '25'
                    );
                    echo '<td>'.form_input($data).'</td>';*/
                    ?> <td><input style="font-size:8pt;position:relative;right:15px;height:25px;" type="text" value="<?php echo $valeur ?>" class="form-control" name="val2_<?php echo $row->code?>" id="val2" placeholder="Valeur 2"></td> <?php
                }

                if ($row->typecritere == 'Zone de: à:'){ 
                   $valeur = "";  
                    if (isset($critere["val1_".$row->code])){
                        $valeur = $critere["val1_".$row->code];
                    }
                    $data = array(
                        "name" => "val1_".$row->code,
                        "id" => "val1_".$row->code,
                        "value" => $valeur,
                         'maxlength'   => '50',
                         'size'        => '25'
                    );
                    echo '<td style="">'.form_input($data).'</td>';
                   $valeur = "";  
                    if (isset($critere["val2_".$row->code])){
                        $valeur = $critere["val2_".$row->code];
                    }
                    $data = array(
                        "name" => "val2_".$row->code,
                        "id" => "val2_".$row->code,
                        "value" => $valeur,
                        'maxlength'   => '50',
                        'size'        => '25'
                    );
                    echo '<td style="">'.form_input($data).'</td>';
                }
                //echo $row->Description;
                if ($row->typecritere == 'Liste'){
                    $this->load->model("get_db");
                    $options = array();
                    $res  = $this->db->query("SELECT * FROM ".$row->ndfliste);
                    if (false === $res) {
                        echo mysql_error()."<br>";
                    }else{
                        //while ($ro = mysql_fetch_array($res, MYSQL_ASSOC)){
                        foreach ($res->result_array() as $ro){
                            $options[$ro[$row->keyfield]]= $ro[$row->lstfield];
                        }
                    }
                   $valeur = "";  
                    if (isset($critere["val1_".$row->code])){
                        $valeur = $critere["val1_".$row->code];
                    }
                    echo '<td></td>';//.form_dropdown("val1_".$row->code, $options, $valeur).'</td>';
                    //echo '<td>kklklk</td>';
                    echo '<td style="">'." --- ".'</td>';
                }
                
                if ($row->typecritere == 'Region'){
                    $this->load->model("get_db");
                    $options = array();
                    $res  = mysql_query("SELECT * FROM pa_Region");
                    if (false === $res) {
                        echo mysql_error()."<br>";
                    }else{
                        while ($ro = mysql_fetch_array($res, MYSQL_ASSOC)){
                            $options[$ro["code"]]= $ro["Nom"];
                        }
                    }
                   $val_Region = "0";  
                    if (isset($critere["val1_".$row->code])){
                        $val_Region = $critere["val1_".$row->code];
                    }
                    echo '<td>'.form_dropdown("val1_Region", $options, $val_Region).'</td>';
                    
                    $data = array(
                        'name' => 'action',
                        'id' => 'action',
                        'value' => 'dictio_dictio',
                        'type' => 'submit',
                        'content' => 'rafraichir liste district'
                    );
                    echo '<td>'.form_button($data).'</td>';  
                }
                
                if ($row->typecritere == 'District'){
                    $this->load->model("get_db");
                    $options = array();
                    $res  = mysql_query("SELECT * FROM pa_District WHERE Maitre = ".$val_Region);
                    if (false === $res) {
                        echo mysql_error()."<br>";
                    }else{
                        while ($ro = mysql_fetch_array($res, MYSQL_ASSOC)){
                            $options[$ro["code"]]= $ro["Nom"];
                        }
                    }
                   $val_District = "0";  
                    if (isset($critere["val1_".$row->code])){
                        $val_District = $critere["val1_".$row->code];
                    }
                    echo '<td>'.form_dropdown("val1_District", $options, $val_District).'</td>';
                    
                    $data = array(
                        'name' => 'action',
                        'id' => 'action',
                        'value' => 'dictio_dictio',
                        'type' => 'submit',
                        'content' => 'rafraichir liste commune'
                    );
                    echo '<td>'.form_button($data).'</td>';  
                }

                if ($row->typecritere == 'Commune'){
                    $this->load->model("get_db");
                    $options = array();
                    $res  = mysql_query("SELECT * FROM pa_Commune WHERE Maitre = ".$val_District);
                    if (false === $res) {
                        echo mysql_error()."<br>";
                    }else{
                        while ($ro = mysql_fetch_array($res, MYSQL_ASSOC)){
                            $options[$ro["code"]]= $ro["Nom"];
                        }
                    }
                    echo '<td>'.form_dropdown("val1_Commune", $options, 'egale').'</td>';
                    echo '<td style="font-size:10pt;">'." --- ".'</td>';
                }
                echo '</tr>'."\n";  
            }    
            echo '</tbody></table>';
            
            /*$data = array(
                'name' => 'action',
                'id' => 'action',
                'value' => 'critere_sqlliste',
                'type' => 'submit',
                'content' => 'Visualiser SQL'
            );
            echo form_button($data); */?>
			<div id="ancre" style="text-align:center">
            <button style="font-size:11px;margin-top:10px;width:250px;border-radius:0px;background:#418A95" name="action" value="critere_sqlliste" class="btn btn-primary" type="submit">Visualiser SQL</button><?php 
            /*
            $data = array(
                'name' => 'action',
                'id' => 'action',
                'value' => 'critere_liste',
                'type' => 'submit',
                'content' => 'visualiser tableau'
            );
            echo form_button($data);  */
			?>
			<button style="font-size: 11px;margin-top:10px;width:250px;border-radius:0px;background:#418A95" name="action" value="critere_liste" class="btn btn-primary" type="submit">Visualiser Tableau</button><?php
            /*$data = array(
                'name' => 'action',
                'id' => 'action',
                'value' => 'critere_preparecroise',
                'type' => 'submit',
                'content' => 'Requete croise'
            );
            echo form_button($data); */?>
            <button style="font-size: 11px;margin-top:10px;width:250px;border-radius:0px;background:#418A95" name="action" value="critere_preparecroise" class="btn btn-primary" type="submit">Requ&ecirc;te Crois&eacutee</button><?php
            echo '</div></div>';
            echo form_close();
   ?>

