    <div>
        <?php
           echo 'eto 4 <br>';
           echo $requete.'<br>';
			
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

            if(isset($code_r)){
				$data = array(
						"name" => "code_r",
						"id" => "code_r",
						"value" => $code_r,
						'maxlength'   => '20',
						'type'   => 'hidden',
						'size'        => '20'
				);
				echo '<td bgcolor="#CCCCCC">'.form_input($data).'</td>';
			}

            $data = array(
                    "name" => "source",
                    "id" => "om_table",
                    "value" => "sqlliste",
                    'maxlength'   => '20',
                    'type'   => 'hidden',
                    'size'        => '20'
            );
            echo '<td bgcolor="#CCCCCC">'.form_input($data).'</td>';
			if(isset($array_para)){
				$data = array(
						"name" => "array_para",
						"value" => serialize($array_para),
						'type'   => 'hidden'
				);
            echo '<td bgcolor="#CCCCCC">'.form_input($data).'</td>';
			}
            
            echo '<table class="flatTable"><tbody>'."\n"; 
			echo '<tr class="titleTr">';
			echo '<td style="text-align:left;font-family: Calibri;" colspan="1">SQL</td>';
			echo '</tr>';  
			$i=1;
			echo '<tr class="headingTr">';
			echo '<td style="text-align:left;font-family:Calibri;font-size:12px">Visualisation SQL</td>';
			echo '</tr>';
			echo '</tbody></table>';
            $fldtextArea_name = str_replace("<br>", "\n", $requete);
            $data = array(
                'name'        => 'textSQL',
                'id'          => 'textSQL',
                'value'       => $fldtextArea_name,
                'maxlength'   => '200',
                'size'        => '200',
                'style'       => 'width:100%;padding:20px;font-family:Calibri;font-size:15px;',
            );
            echo form_textarea($data);

            /*$data = array(
                'name' => 'action',
                'id' => 'action',
                'value' => "sql_liste",
                'type' => 'submit',
                'content' => 'Visualiser'
            );
            echo form_button($data);  */
			
			?>
            <button style="font-size: 11px;margin-top:10px;width:150px;border-radius:0px;background:#418A95" name="action" value="sql_liste" class="btn btn-primary" type="submit">Visualiser <span style="position:relative;left:5px">Tableau</span></button>
			<?php
				/*$data = array(
					'name' => 'action',
					'id' => 'action',
					'value' => "sql_preparecroise",
					'type' => 'submit',
					'content' => 'Requete croisee'
				); 
				echo form_button($data); */ 
			?>
    </div>
</div>
