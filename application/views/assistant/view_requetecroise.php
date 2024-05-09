    <div>    
        <?php
            $this->load->helper("form");
            echo form_open("index.php/assist_requete/visualisation");
            
            $data = array(
                "name" => "nom_table",
                "id" => "om_table",
                "value" => $nom_table,
                'maxlength'   => '20',
                'type'   => 'hidden',
                'size'        => '20'
            );
            echo '<td>'.form_input($data).'</td>';
            
            $data = array(
                "name" => "select",
                "id" => "om_table",
                "value" => $select,
                'maxlength'   => '200',
                'type'   => 'hidden',
                'size'        => '20'
            );
            echo '<td>'.form_input($data).'</td>';
            
            $data = array(
                "name" => "critere",
                "id" => "om_table",
                "value" => $critere,
                'maxlength'   => '200',
                'type'   => 'hidden',
                'size'        => '20'
            );
            echo '<td>'.form_input($data).'</td>';
            //$data["requete"] = $data["select"]."<br>"."FROM ".$data["nom_table"]."<br>".$data["critere"]; 


            echo '<tbody>';
            echo '<table class="flatTable">'."\n";
            echo '<tr class="titleTr">';
			echo '<td style="text-align:left;font-family:Calibri;" colspan="4">CATEGORIE REQUETE</td>';
            echo '</tr>';
            $d="P";
            echo '<tr class="headingTr">';
            echo '<td align=center valign=middle>Utilisation</td>';
            echo '<td align=center valign=middle>Groupement</td>';
            echo '<td align=center valign=middle>Partie date</td>';
            echo '<td align=center valign=middle>Description</td>';
            echo '</tr>'."\n";
            $i=1;
            foreach($result as $row){
                echo '<tr style="height:34px;">'; 
                // utilisation 
               /* $options = array();
                $options["nonutil"]= "Non utilisé";
                $options["ligne"]= "Ligne";
                $options["colonne"]= "Colonne";
                $options["valeur"]= "Valeur";
                echo '<td style="width:20%;">'.form_dropdown("util_".$row->code, $options, 'egale').'</td>';
                */
				?>
				   <td style="width:20%;">
						<select class="seldef" style="font-size:11px;width:100%;height:25px" name="<?php echo 'util_'.$row->code;?>" onchange="couleur(this,'nonutil');" >
							<option value="nonutil" >Non utilisé</option>
							<option value="ligne" >Ligne</option>
							<option value="colonne" >Colonne</option>
							<option value="valeur" >Valeur</option>
						</select>
				   </td>
				<?php
                
                // Groupement       
                /*if (false === $res) {
                    echo mysql_error()."<br>";
                }else{
                    foreach ($res->result_array() as $ro){
                        $options[$ro["code"]]= $ro["description"];
                    }
                    echo '<td style="width:20%;">'.form_dropdown("op_".$row->code, $options, 'egale').'</td>';
                //}*/
                
                ?>
				   <td style="width:20%;">
						<select class="seldef" style="font-size:11px;width:100%;height:25px" name="<?php echo 'op_'.$row->code;?>" onchange="couleur(this,'Groupement');" >
							<?php
									$res  =$this->db->query("SELECT * FROM pa_Calcul");
                					foreach($res->result() as $ro){
										echo '<option value ="'.$ro->code.'">'.$ro->description.'</option>';
									}
							?>
						</select>
				   </td>
                <?php
                
                //partie date
                if ($row->typecritere == 'Date'){
                    $res  = $this->db->query("SELECT * FROM pa_Partie");
                    /*if (false === $res) {
                        echo mysql_error()."<br>";
                    }else{
                       foreach ($res->result_array() as $ro){
                            $options[$ro["code"]]= $ro["description"];
                        }
                        echo '<td style="width:30%;">'.form_dropdown("op_".$row->code, $options, 'egale').'</td>';
                    //}*/
                    
                    ?>
				   <td style="width:25%;">
						<select class="seldef"  style="font-size:11px;width:100%;height:25px" name="<?php echo 'op_'.$row->code;?>">
							<?php
									foreach($res->result() as $ro){
										echo '<option value ="'.$ro->code.'">'.$ro->description.'</option>';
									}
							?>
						</select>
				   </td>
                <?php
                    
                }else{
                    echo '<td>'."-----".'</td>';
                }
                //Champs
                if($row->description != ""){
					echo '<td style="width:35%;text-align:left;font-size:12px">'.form_label($row->description,"fullname").'</td>';
				}else{
					echo '<td style="width:35%;text-align:left;font-size:12px">'.form_label($row->code,"fullname").'</td>';
				}

                echo '</tr>'."\n";  
            }    
            echo '</tbody></table>';
            
            /*
            $fldtextArea_name = str_replace("<br>", "\n", $requete);
            $data = array(
                'name'        => 'textSQL',
                'id'          => 'textSQL',
                'value'       => $fldtextArea_name,
                'maxlength'   => '200',
                'size'        => '200',
                'type'        => 'hidden',
                'style'       => 'width:100%',
            );
            echo form_textarea($data);*/
            
            /* bouton
            $data = array(
                'name' => 'action',
                'id' => 'action',
                'value' => 'prepareCroise_sqlCroise',
                'type' => 'submit',
                'content' => 'Visualiser SQL'
            );

            echo form_button($data);  
            $data = array(
                'name' => 'action',
                'id' => 'action',
                'value' => 'preparCroise_tableau',
                'type' => 'submit',
                'content' => 'Visualiser tableau'
            );
            echo form_button($data);  
			*/
			?><div style="text-align:center">
				<button style="font-size: 12px;margin-top:20px;width:250px;" name="action" value="prepareCroise_sqlCroise" type="submit">Visualiser SQL</button>
				<button style="font-size: 12px;margin-top:20px;width:250px;" name="action" value="preparCroise_tableau" type="submit">Visualiser Tableau</button>
			  </div><?php
            echo form_close();
   ?>
</div>
</div>
