<?php
	$graph = true;
    $this->load->helper("form");
    echo 'eto 2 <br>';;
    echo form_open("index.php/site/afficher_page");
    if(isset($nom_req) AND $nom_req != ""){
		echo form_hidden('nom_req', $nom_req);
	}
    if(isset($type)){
		echo form_hidden('type', $type);
	}
    echo form_hidden('sql', $sql);
    echo form_hidden('limit', $limit);
    if(isset($array_para)){
		echo form_hidden('array_para', serialize($array_para));   
    }
    $query = $this->db->query($sql);
    //if (!$result) {
    //   die('�chec de la requ�te : ' . mysql_error());
    //}
    
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
    $fields= $query->field_data(); 
    echo '<div>';  //    style="width:79%;float:right;"
    echo '<table style="margin-bottom:20px" class="flatTable"><tbody>'."\n"; 
    echo '<tr class="titleTr">';
    if(isset($nom_req)){
			if (isset($val_reg) && $val_reg!=0){
				$nom_reg = $this->db->query("SELECT nom as designationreg FROM pa_region WHERE code='".$val_reg."'")->row()->designationreg;
				echo '<td style="text-align:left;font-family: Calibri;" colspan="'.count($fields).'">'.$nom_req. ' : '. $nom_reg .'</td>';
			}
			else {
				echo '<td style="text-align:left;font-family: Calibri;" colspan="'.count($fields).'">'.$nom_req.'</td>';
			}
		}
	else{
		echo '<td style="text-align:left;font-family: Calibri;" colspan="'.count($fields).'">Resultat de la requete</td>';
	}
	echo '</tr></tbody></table>';  
    $i=1;
    ?>
    <table style="float:left" id="table_idR" class="display">
		<thead>
    <?php
    echo '<tr class="headingTr">';
    foreach ($fields as $column_data[$i]){   
        $col[$i]=$column_data[$i]->name;
        if (($column_data[$i]->name<>'idreg')and($column_data[$i]->name<>'iddis')and($column_data[$i]->name<>'idcom')){
			echo '<td style="font-family:Calibri;font-size:12px;">'.$col[$i].'</td>';
		}
        $i++; 
    }
    $n=$i-1;
    echo '</tr></thead><tbody>';
    foreach ($query->result_array() as $row){                        
    //while($row =$query->result())
        echo '<tr>';  
        $i=1;
        while ($i<=$n){
			if (($column_data[$i]->name<>'idreg')and($column_data[$i]->name<>'iddis')and($column_data[$i]->name<>'idcom')){
					$d = $row[$col[$i]];
					if ($column_data[$i]->type=="datetime"){
						if($d<>"" ){
							$d = date("d/m/Y",strtotime($d)); 
						}
					}
					if (($col[1]=='loc')and($i==1))
						echo '<td style="height:30px;font-size:9pt;font-family:Calibri;color:#6b6b6b;"><a href="'.base_url().'index.php/assist_requete/visu_correction?loc='.$d.'">'.$d.'</a></td>';
					else             
						echo '<td style="height:30px;font-size:9pt;font-family:Calibri;color:#6b6b6b;">'.$d.'</td>';
			}
			$i++;
        }
        echo '</tr>'."\n";  
    } 
    echo '</tbody></table>';
    
	/*$data = array(
        'name' => 'action',
        'id' => 'action',
        'value' => 'list_page1',
        'type' => 'submit',
        'content' => '<<'
    );
    echo form_button($data); */ 
	
    if(!(isset($nom_req) AND $nom_req !="")){?>
			<div style="float:left">
			<button type="button" id="sav_b" style="font-size:11px;margin-top:10px;width:150px;height:25px;">Enregistrer Requete</span>
			</div>
			<?php
		}
    else {
			if(isset($enr_result)){
				if($enr_result){
					?><div style="float:left">
					<span style="color:green;font-family:Calibri;font-size:13px;margin-top:20px;">Enregistrement reussi...</span>
					</div><?php
				}
				else{
					?><div style="float:left">
					<span style="color:red;font-family:Calibri;font-size:13px;margin-top:20px;">Echec de l'enregistrement!</span>
					</div><?php
				}
			}
		}
     ?>
    <div style="float:right">
	
    <!--button style="border-radius:0px;font-size:11px;margin-top:10px;width:50px;height:25px;background:#418A95" name="action" value="list_page1" class="btn btn-primary" type="submit"><<</button><?php
  
    /*$data = array(
        'name' => 'action',
        'id' => 'action',
        'value' => 'list_pageprec',
        'type' => 'submit',
        'content' => '<'
    );
    echo form_button($data);*/?>
    <button style="font-size:11px;margin-top:10px;width:75px;height:25px;border-radius:0px;background:#418A95" name="action" value="list_pageprec" class="btn btn-primary" type="submit">-100</button><?php
  
    /*$data = array(
        'name' => 'action',
        'id' => 'action',
        'value' => 'list_pagesuiv',
        'type' => 'submit',
        'content' => '>'
    );
    echo form_button($data); */ ?>
    <button style="font-size:11px;margin-top:10px;width:75px;height:25px;border-radius:0px;background:#418A95" name="action" value="list_pagesuiv" class="btn btn-primary" type="submit">+100</button><?php
	
    /*$data = array(
        'name' => 'action',
        'id' => 'action',
        'value' => 'list_pagedern',
        'type' => 'submit',
        'content' => '>>'
    );
    echo form_button($data); */?>
    <button style="border-radius:0px;font-size:11px;margin-top:10px;width:50px;height:25px;background:#418A95" name="action" value="list_pagedern" class="btn btn-primary" type="submit">>></button--><?php
    
	
	echo '</div>';?>
		<div id="nr">
			<div id="nr_corps">
				<span style="margin:10px;margin-top:20px;font-family:Calibri;font-size:12px;float:left;">-> Description de la requete:</span>
				<input type="text" style="margin:10px;margin-top:10px;margin-left:0px;float:left;width:20%;font-size:8pt;height:25px;" class="form-control" name="desc_req" id="desc_req" placeholder="Nom de la requete" ></td>										
				<button style="float:left;font-size:11px;margin-top:10px;width:100px;height:25px;" id="valider" name="action" value="enregistrer" type="submit">Valider</button>
				<button type="button" id="annu_b" style="font-size:11px;margin-top:10px;margin-left:2px;float:left;width:100px;height:25px;">Annuler</button>
			</div>
		</div>
    </div>
    
  <?php
    echo form_close();  
		?>
<?php /*<div>
	<div id="graph" style="float:right;margin-right:0px;margin-top:30px;width:79%;height:400px;">
		
	</div>
</div> */ ?>
</div>
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/footer_list.js"></script>

