<select id="sel_req" name="nom_req" size="5" style="border:1px solid #C7E2F1;width:100%;float:left;">
	<?php
	if($result){
		foreach($result as $row){
			?><option value="<?php echo ' : '.$row->description;?>" class="requete" id="<?php echo $row->id.'/'.(isset($row->sql_r)?1:0).'/'.(isset($row->sql_d)?1:0).'/'.(isset($row->sql_c)?1:0).'/'.(isset($row->sql_f)?1:0).'/'.(isset($row->sql1)?1:0)
		; ?>" style="color: #494e49;font-size:20px;font-family:Calibri;padding:5px 5px 5px 15px">-><?php echo ' '.$row->description;?></option><?php
		}
	}
	else{
		?><option value="rien" class="rien" id="rien" style="font-size:13px;font-family:Calibri;padding:5px 5px 5px 15px">Vide.....</option><?php
	}
	?>	
</select>
