
<?php
	$this->load->helper("form");
	echo form_open("index.php/assist_requete/visualisation");
	?>
<input type="hidden" name="id_requete" id="ID_REQ" value=""> 
<!--  -->
<div id="list_req" style="width:79%;float:right">
	<table id="tableauA" class="flatTable">
		<tbody id="tb">
			<tr class="titleTr">
				<td style="text-align:left;font-family:Calibri;"><a href="<?php echo base_url(); ?>index.php/req_pre/acceuil?type=rp"><span style="color:rgb(220,220,220)"> </span></a></td>
				<td style="text-align:left;font-family:Calibri;"> </td>
        		<td style="text-align:left;font-family:Calibri;"> </td>
        		<td style="text-align:left;font-family:Calibri;"> </td>
        		<td style="text-align:right;font-family:Calibri;">
					<span style="position:relative;top:5px;">Rechercher:</span>
					<span id="b_rechA" style="font-size:13px;font-family:Calibri;line-height:12px;float:right;margin-right:20px;margin-left:5px;height:25px" class="btn btn-primary btnxs">OK</span>
					<input id="c_rechA" type="text" style="font-weight:normal;font-size:13px;font-family:Calibri;float:right;width:25%;height:25px;margin-left:10px;" class="input-sm form-control" placeholder="Recherche">
				</td>
			</tr>
			<tr class="headingTr">
				<?php if(isset($desc)){
				?><td colspan="3" id="t_ta" style="text-align:left;width:50%;">Liste de toutes les requetes dans "<?php echo $desc;?>"</td><?php
				} else{
				?><td colspan="3" id="t_ta" style="text-align:left;width:50%;">Liste de toutes les requetes enregistrees</td><?php
				}?>
			</tr>
		</tbody>
	</table>
	<div id="ch_reqA">
		<select id="sel_req" name="nom_req" size="5" style="border:1px solid #C7E2F1;width:100%;float:left">
		<?php
		if($result){
			foreach($result as $row){
				?><option value="<?php echo ' : '.$row->description;?>" class="requeteA" id="<?php echo $row->id;?>" style="font-size:13px;font-family:Calibri;padding:5px 5px 5px 15px">-><?php echo ' '.$row->description;?></option><?php
			}
			}else{
				?><option value="rien" class="rienA" id="rien" style="font-size:13px;font-family:Calibri;padding:5px 5px 5px 15px">Vide...</option>
			<?php
				}
		?>	
		</select>
	</div>
	<div id="sql">
		<div id="sqlcorps">
		    <?php if(isset($req)){?>
				
				<?php $data = array(
                    "name" => "textSQL",
                    "id" => "sqltext",
                    "value" => $req,
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';
            $data = array(
                    "name" => "type",
                    "id" => "typeacc",
                    "value" => "ar",
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';?>
			<?php } ?>
				
            <?php if(isset($req_r)){?>
                
                <?php $data = array(
                    "name" => "textSQL",
                    "id" => "sqltext",
                    "value" => $req_r,
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';
            $data = array(
                    "name" => "type",
                    "id" => "typeacc",
                    "value" => "ar",
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';?>
            <?php } ?>
                
                <?php if(isset($req_d)){?>
                
                <?php $data = array(
                    "name" => "textSQL",
                    "id" => "sqltext",
                    "value" => $req_d,
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';
            $data = array(
                    "name" => "type",
                    "id" => "typeacc",
                    "value" => "ar",
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';?>
            <?php } ?>
                
                <?php if(isset($req_c)){?>
                
                <?php $data = array(
                    "name" => "textSQL",
                    "id" => "sqltext",
                    "value" => $req_c,
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';
            $data = array(
                    "name" => "type",
                    "id" => "typeacc",
                    "value" => "ar",
                    "type"   => "hidden",
            );
            echo '<span>'.form_input($data).'</span>';?>
            <?php } ?>
                
		</div>
	</div>
</div>
<div id="ancre" style="width:79%;float:right;text-align:center">
			<button id="vista" style="font-size:12px;margin-top:20px;width:250px;" name="action" value="sql_liste" type="submit">Visualiser Tableau</button>
            <button id="b_a_r" style="font-size:12px;margin-top:20px;width:250px;"type="button">Assistant requete</button>
            <span id="s_cont">
            <?php if(isset($boolcon) AND $boolcon){?>
				<button id="b_cont" style="font-size:12px;margin-top:20px;width:250px;" name="action" value="control_d" type="submit">Controle coordonnées</button>
	        <?php } ?>
	        </span>
</div>
<div id="assist_req">
	<div id="assist_req_corps">
		<?php
		if(!isset($nom_table)){
			$nom_table='e0101_recensement';
			$code_r='0';
		}
		if(isset($nom_table)){
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
			
			$data = array(
                    "name" => "code_r",
                    "id" => "code_r",
                    "value" => $code_r,
                    'maxlength'   => '20',
                    'type'   => 'hidden',
                    'size'        => '20'
            );
            echo '<td>'.form_input($data).'</td>';
			
			echo '<div style="width:79%;float:right;margin-top:20px">';
            echo '<table class="flatTable">'."\n";
            $d="P";
            echo '<tbody>';
            echo '<tr class="titleTr">';
			echo '<td style="text-align:left;" colspan="8">ASSISTANT REQUETE '.$nom_table.'</td>';
			echo '</tr>';
            echo '<tr class="headingTr">';
            echo '<td style="width:5%;" >BAS</td>';
            //echo '<td style="">TRI</td>';
            echo '<td style="width:5%;">RANG</td>';
            echo '<td style="width:30%">DESCRIPTION</td>';
            echo '<td style="width:5%">AFFICHER</td>';
            echo '<td style="width:5%">CRITERE</td>';
            //echo '<td style="">PARAMETRE</td>';
            echo '<td style="width:10%">OPERATEUR</td>';
            echo '<td style="width:20%">VALEUR 1</td>';
            echo '<td style="width:20%">VALEUR 2</td>';
            echo '</tr>'."\n";
            $i=0;
            foreach($resultA as $row){
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
                /*<td><input size=4 type="text" style="font-size:8pt;height:25px;" class="form-control" name="tri_<?php echo $row->code?>" id="tri" placeholder="Tri"></td> */ ?><?php
                echo '<td style="font-size:9pt;">'.$i.'</td>'; //form_label($row->Rang,"fullname")
                if($row->description != ""){
					echo '<td style="text-align:left;font-size:9pt;">'.form_label($row->description,"fullname").'</td>';
				}else{
					echo '<td style="text-align:left;font-size:9pt;">'.form_label($row->code,"fullname").'</td>';
				}

				/* $check = FALSE;  
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
                echo '<td>'.form_checkbox($data).'</td>';*/
		?>
				<td>
				  <label style="margin:7px;" class="switch switch-green">
					  <input value="accept" type="checkbox" name="<?php echo 'aff_'.$row->code;?>" class="switch-input">
					  <span class="switch-label" data-on="Oui" data-off="Non"></span>
					  <span class="switch-handle"></span>
				  </label>
				</td>
                 <?php                                                           
               /* $check = FALSE;  
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
                echo '<td>'.form_checkbox($data).'</td>';*/
                ?>
                <td>
				  <label style="margin:7px;" class="switch">
					  <input value="accept" type="checkbox" name="<?php echo 'cr_'.$row->code;?>" class="switch-input">
					  <span class="switch-label" data-on="Oui" data-off="Non"></span>
					  <span class="switch-handle"></span>
				  </label>
				</td>
                <?php
               /* $data = array(
                    'name'        => "par_".$row->code,
                    'id'          => "par_".$row->code,
                    'value'       => 'accept',
                    'checked'     => $check,
                    'style'       => 'margin:10px;height:10px;'
                );*/
               // echo '<td>'.form_checkbox($data).'</td>';
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
					<select class="seldef" name="op_<?php echo $row->code;?>" style="width:100%;height:25px;font-size:12px" id="operateur" >
						<option value ="=">=</option>
						<option value =">">></option>
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
                    ?> <td><input style="font-size:8pt;position:relative;right:10px;height:25px;" type="text" value="<?php echo $valeur ?>" class="form-control" name="val2_<?php echo $row->code?>" id="val2" placeholder="Valeur 2"></td> <?php
                }

                if ($row->typecritere == 'Zone de: à:'){ 
                   $valeur = "";  
                    if (isset($critere["val1_".$row->code])){
                        $valeur = $critere["val1_".$row->code];
                    }
                    $data = array(
                        "name" => "val1_".$row->code,
                        "id" => "val1_".$row->code,
                        "class" => "form-control",
                        "style" => "font-size:8pt;height:25px;",
                        "placeholder" => "Valeur 1",
                        "value" => $valeur,
                         "maxlength"   => '50',
                         "size"        => '25'
                    );
                    echo '<td style="">'.form_input($data).'</td>';
                   $valeur = "";  
                    if (isset($critere["val2_".$row->code])){
                        $valeur = $critere["val2_".$row->code];
                    }
                    ?><td><input style="font-size:8pt;position:relative;right:10px;height:25px;" type="text" value="<?php echo $valeur ?>" class="form-control" name="val2_<?php echo $row->code?>" id="val2" placeholder="Valeur 2"></td><?php
                }
                //echo $row->Description;
                if ($row->typecritere == 'Liste'){
                    $this->load->model("get_db");
                    $options = array();
                    $res  = $this->db->query("SELECT * FROM ".$row->ndfliste);
                    if (false === $res) {
                        echo mysql_error()."<br>";
                    }else{
						 ?>
						   <td>
								<select style="font-size:11px;width:95%;height:25px" name="<?php echo 'val1_'.$row->code;?>">
									<?php
											foreach($res->result_array() as $ro){
												echo '<option value ="'.$ro[$row->keyfield].'">'.$ro[$row->lstfield].'</option>';
											}
									?>
								</select>
						   </td>
                   <?php
                        //while ($ro = mysql_fetch_array($res, MYSQL_ASSOC)){
                        /*foreach ($res->result_array() as $ro){
                            $options[$ro[$row->keyfield]]= $ro[$row->lstfield];
                        }*/
                    }
                   $valeur = "";  
                    if (isset($critere["val1_".$row->code])){
                        $valeur = $critere["val1_".$row->code];
                    }
                   // echo '<td style="font-size:11px">'.form_dropdown("val1_".$row->code, $options, $valeur).'</td>';
                   /*?>
                   <td>
						<select name="<?php echo 'val1_'.$row->code;?>">
							<?php
									foreach($options as $cle => $element){
										echo '<option value ="'.$element.'">'.$cle.'</option>';
									}
							?>
						</select>
                   </td>
                   <?php*/
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
            <?php 
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
			<button style="font-size: 12px;margin-top:10px;width:250px;" name="action" value="critere_liste" type="submit">Visualiser Tableau</button><?php
            /*$data = array(
                'name' => 'action',
                'id' => 'action',
                'value' => 'critere_preparecroise',
                'type' => 'submit',
                'content' => 'Requete croise'
            );
            echo form_button($data); */?>
            <button style="font-size: 12px;margin-top:10px;width:250px;" name="action" value="critere_preparecroise" type="submit">Requ&ecirc;te Crois&eacutee</button>
			<?php
            echo '</div></div>';
		}
   ?></div>
   </div>
</div>
<?php
            echo form_close();
?>
