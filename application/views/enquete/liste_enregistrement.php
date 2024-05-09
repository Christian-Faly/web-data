<div id="list_req" style="width:21%;float:left">
	<div class="tableaux">
		<table>
			<thead>
				<tr>
					<th class='accordth'><h2>ASSISTANT REQUETE</h2></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td>
						<div id="accordeon">
						<?php 
							$i=1;
							foreach($menu_enr as $row){
								if ((strlen($row->code)>5) and  (strlen($row->code)<9)){
									if  (strlen($row->code)<7){
										if  ($i>1){
											echo "</div>";
										}
										echo "<h4>".$row->description."</h4>";
										echo "<div>";
									}else{
										echo "<p id = '".$row->code."' alt='".$row->nom_table."'>".$row->code."-".$row->description."</p>";
									}
								}
								//echo "<p id = '".$row->code."'>".$row->code." ".$row->description."</p>";
								$i++;
							}
							echo "</div>";
							
						?>					
						</div>
					</td>
				</tr>
				
			</table>
	
	</div>
	
</div>

<?php
	$this->load->helper("form");
     $attributes = array('TARGET' =>"_blank");
	echo form_open("index.php/assist_requete/visualisation",$attributes);
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
				echo '<option id="'.$row->id.'" alt="'.$row->pere.'" value="'.$row->id.'" class="requeteA" style="font-size:13px;font-family:Calibri;padding:5px 5px 5px 15px">-> '.$row->description.'</option>';
			}
		}else{
			echo '<option value="rien" class="rienA" id="rien" style="font-size:13px;font-family:Calibri;padding:5px 5px 5px 15px">Vide...</option>';
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

<div id="assist_req" style="width:79%;float:right;text-align:center">
	<div id="assist_req_corps">
		<?php
		
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
			if (isset($code_r)){
				$racine=$code_r;
			}else{
				$racine='';
			};
			$data = array(
                    "name" => "code_r",
                    "id" => "code_r",
                    "value" => $racine,
                    'maxlength'   => '20',
                    'type'   => 'hidden',
                    'size'        => '20'
            );
            echo '<td>'.form_input($data).'</td>';
			
			echo '<div style="width:100%;float:right;margin-top:20px">';
            echo '<table class="flatTable">'."\n";
            $d="P";
            echo '<tbody>';
            echo '<tr id="tr1" class="titleTr">';
			echo '<td style="text-align:left;" colspan="8">ASSISTANT REQUETE '.$nom_table.'</td>';
			echo '</tr>';
			
            echo '<tr class="headingTr">';
            echo '<td style="width:5%;" >BAS</td>';
            echo '<td style="width:5%;">RANG</td>';
            echo '<td style="width:30%">DESCRIPTION</td>';
            echo '<td style="width:5%">AFFICHER</td>';
            echo '<td style="width:5%">CRITERE</td>';
            echo '<td style="width:10%">OPERATEUR</td>';
            echo '<td style="width:20%">VALEUR 1</td>';
            echo '<td style="width:20%">VALEUR 2</td>';
            echo '</tr>'."\n";
            $i=0;
            foreach($resultA as $row){
				$i=$i+1;
                if ($row->rang <>0){
					$id_code=substr($row->nomtable,0,6).$row->code;
				echo '<tr hidden alt="'.$row->nomtable.'">';
					//colonne 1 BAS
					echo '<td><a style="font-size:9pt;color:#6b6b6b;" href="#ancre"> >> </a></td>';  
					if (isset($critere["tri_".$row->code])){
					   $valeur = $critere["tri_".$row->code];
					}else{
						$valeur = "";  
					}
				
					//colonne 2 RANG
					echo '<td style="font-size:9pt;">'.$row->rang.'</td>'; //form_label($row->Rang,"fullname")
					
					//colonne 3 DESCRIPTION
					if($row->description != ""){		
						echo '<td style="text-align:left;font-size:9pt;">'.form_label($row->description,"fullname").'</td>';
					}else{
						echo '<td style="text-align:left;font-size:9pt;">'.form_label($row->code,"fullname").'</td>';
					}
				
					//colonne 4 EST-CE à AFFICHER -->
					echo "<td>";
						echo "<label style='margin:7px;' class='switch switch-green'>";
						echo "<input value='accept' type='checkbox' name='aff_".$id_code."' class='switch-input'>";
						echo "<span class='switch-label' data-on='Oui' data-off='Non'></span>";
						echo "<span class='switch-handle'></span>";
					  echo "</label>";
					echo "</td>";
					
					//colonne 5 EST-CE CRITERE -->
					echo "<td>";
					  echo "<label style='margin:7px;' class='switch'>";
						  echo "<input value='accept' type='checkbox' name='cr_".$id_code."' class='switch-input'>";
						  echo "<span class='switch-label' data-on='Oui' data-off='Non'></span>";
						  echo "<span class='switch-handle'></span>";
					  echo "</label>";
					echo "</td>";
				
					// colonne 6 OPERATEUR -->
					echo "<td>";
						echo "<select class='seldef' name='op_".$id_code."' style='width:100%;height:25px;font-size:12px' id='operateur'>";
							echo "<option value ='='>=</option>";
							echo "<option value ='>'>></option>";
							echo "<option value ='<'><</option>";
							echo "<option value ='<>'><></option>";
							echo "<option value ='Nu'>Null</option>";
						echo "</select>";
					echo "</td>";
					
					/*
					echo "<td></td>";
					echo "<td></td>";
					*/
					
					if ($row->typecritere == "Zone de texte"){
						echo "<td><input type='text' style='font-size:8pt;height:25px;' class='form-control' name='val1_".$id_code."' id='val1' placeholder='Valeur 1'></td>";
						echo "<td style=''>----</td>";
					}
					elseif($row->typecritere == "Date"){
					   $valeur = "";  
						if (isset($critere["val1_".$id_code])){
							$valeur = $critere["val1_".$id_code];
						}
						echo "<td><input type='text' value='".$valeur."' style='font-size:8pt;height:25px;' class='form-control' name='".$id_code."' id='val1' placeholder='Valeur 1'></td>";

					   $valeur = "";  
						if (isset($critere["val2_".$id_code])){
							$valeur = $critere["val2_".$id_code];
						}
						echo "<td><input style='font-size:8pt;position:relative;right:10px;height:25px;' type='text' value='".$valeur."' class='form-control' name='".$id_code."' id='val2' placeholder='Valeur 2'></td>";
					}elseif($row->typecritere == "Date"){
					   $valeur = "";  
						if (isset($critere["val1_".$id_code])){
							$valeur = $critere["val1_".$id_code];
						}
						$data = array(
							"name" => "val1_".$id_code,
							"id" => "val1_".$id_code,
							"class" => "form-control",
							"style" => "font-size:8pt;height:25px;",
							"placeholder" => "Valeur 1",
							"value" => $valeur,
							 "maxlength"   => '50',
							 "size"        => '25'
						);
						echo '<td style="">'.form_input($data).'</td>';
						$valeur = "";  
						if (isset($critere["val2_".$id_code])){
							$valeur = $critere["val2_".$id_code];
						}
						echo "<td><input style='font-size:8pt;position:relative;right:10px;height:25px;' type='text' value='".$valeur." class='form-control' name='val2_".$id_code."' id='val2' placeholder='Valeur 2'></td>";
					}elseif(($row->typecritere == "Liste")and 
					        ($row->code<>"nregion")and ($row->code<>"ndistrict")and ($row->code<>"ncommune")and 
							($row->code<>"region")and ($row->code<>"district")and ($row->code<>"commune")){
						$this->load->model("get_db");
						$options = array();
						$res  = $this->db->query("SELECT * FROM ".$row->ndfliste);
						if (false === $res) {
							echo mysql_error()."<br>";
						}else{
							echo "<td>";
								echo "<select style='font-size:11px;width:95%;height:25px' name='val1_".$id_code."'>";
									foreach($res->result_array() as $ro){
										echo "<option value ='".$ro[$row->keyfield]."'>".$ro[$row->lstfield]."</option>";
									}
								echo "</select>";
							echo "</td>";
						}
						$valeur = "";  
						if (isset($critere["val1_".$id_code])){
							$valeur = $critere["val1_".$id_code];
						}
						echo "<td style=''> --- </td>";
					}elseif(($row->code=="nregion")or ($row->code=="ndistrict")or ($row->code=="ncommune")){
						$this->load->model("get_db");
						$options = array();
						$res  = $this->db->query("SELECT * FROM ".$row->ndfliste);
						if (false === $res) {
							echo mysql_error()."<br>";
						}else{
							echo "<td>";
								echo "<select id=sel_".substr($row->code,1)." style='font-size:11px;width:95%;height:25px' name='val1_".$id_code."'>";
									foreach($res->result() as $ro){
										echo '<option id="op'.$ro->code.'" alt="op'.$ro->maitre.'" class="v1_reg" value ="'.$ro->code.'">'.$ro->nom.'</option>';
							}
						}
						echo '<td style="width:20%">'.$row->ndfliste.'</td>';
					}else{
						echo '<td style="width:20%">Type critère </td>';
						echo '<td style="width:20%">non défini</td>';
					}
              	echo "</tr>"."\n";
				}  
			}    
			 
			echo '</tbody></table>';
			echo '<div id="ancre" style="text-align:center">';
            
            $data = array(
                'name' => 'action',
                'id' => 'action',
                'value' => 'critere_sqlliste',
                'type' => 'submit',
                'content' => 'Visualiser SQL'
            );
            echo form_button($data);

            $data = array(
                'name' => 'action',
                'id' => 'action',
                'value' => 'critere_liste',
                'type' => 'submit',
                'content' => 'visualiser tableau',
				'target' => "_blank"
            );
            echo form_button($data); 

            $data = array(
                'name' => 'action',
                'id' => 'action',
                'value' => 'critere_preparecroise',
                'type' => 'submit',
                'content' => 'Requete croise'
            );
            echo form_button($data);
			//echo '<button style="font-size: 12px;margin-top:10px;width:250px;" name="action" value="critere_liste" type="submit">Visualiser Tableau</button>';
			//echo '<button style="font-size: 12px;margin-top:10px;width:250px;" name="action" value="critere_preparecroise" type="submit">Requ&ecirc;te Crois&eacutee</button>';
			echo '</div></div>';
		}?>
     </div>
   </div>
</div>
<?php
            echo form_close();
?>
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/footer_assist.js"></script>
