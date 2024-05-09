<?php
  $this->load->helper("form");
  $attributes = array('TARGET' =>"_blank");

  echo form_open("index.php/assist_requete/visualisation", $attributes);	
  //echo 'izy';  
?>

	<div id="sql">
		<div id="sqlcorps">
			<?php 
			if(isset($req)){
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
				<?php 
			} ?>     	

			<?php 
			if(isset($req_r)){
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
				<?php
			} ?>         

			<?php 
			if(isset($req_d)){
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
				<?php
			} ?>         

			<?php 
			if(isset($req_c)){
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
				<?php 
			} ?>         

			<?php 
			if(isset($req_f)){
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
				<?php
			} ?>         

		</div>
	</div>

	<div  style="width:21%;float:left">
		<table>
			<tbody>
				<tr>
					<td>
						<div id="accordeon">
						<?php 
							$i=1;
							foreach($menu_pre as $row){
								if ((strlen($row->code)>5) and  (strlen($row->code)<9)){
									if  (strlen($row->code)<7){
										if  ($i>1){
											echo "</div>";
										}
										echo "<h6 style='border: 1px #556b2f solid; background-color:rgb(195, 224, 121); box-shadow: 6px 6px 0px #808000;'>".$row->description."</h4>";
										//echo "<h6 style='font-size: 20px;color: #da6219;margin:10;'>".$row->description."</h6>";
										echo "<div>";
									}else{
										echo "<p id = '".$row->code."' style='border: 1px #ff7f50 solid; margin:0px 0px 5px 10px; box-shadow: 3px 3px 0px #ff7f50';>".$row->description."</p>";
										//echo "<p id = '".$row->code."'>".$row->description."</p>";
									}
								}
								$i++;
							}
							echo "</div>";
							
						?>					
						</div>
					</td>
				</tr>
		</table>
	</div>
	
	<input type="hidden" name="id_requete" id="ID_REQ" value="">
	<div id="list_req" style="width:79%;float:right">
		<table width =800 border=1>
			<thead>
				<tr>
					<th id="id_gand_titre"  height="50" style="background-color:#859346;color:white" align="center" colspan=4>REQUETES PREDEFINIES</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td  id="id_sous_titre" style="background-color:rgb(195, 224, 121)" align="center" colspan=4>liste des requetes actuellement vide...</td>
				</tr>
				<tr id="id_ligne_param">
					<td id="td_lst_req" colspan=4>
						<div id="ch_req">
							<select  class="requete" size="5" style="border:1px solid #C7E2F1;width:100%;float:left">
								<?php
									foreach($req_pre as $row){
										echo "<option id='".$row->id."' value='".$row->id."' alt = '".$row->pere."'>".$row->description."</option>";
									}
								?>
							</select>
						<div
					</td>
				</tr>
				<tr id="id_ligne_titre">
					<td>
					
					</td>
				</tr>
				<tr id="id_ligne_param">
					<td colspan=4 style="background-color:#859346;color:white" align="center"><B> PARAMETRE </B></td>
				</tr>
				<tr style="background-color:rgb(195, 224, 121)">
					<td align="center">Critère</td>
					<td align="center">Application</td>
					<td align="center" colspan=2>Valeur critère</td>
				</tr>
				<tr>
					<td>Unité géographique</td>
					<td>---</td>
					<td>	
						<select class="seldef" name="unite_geo" id="operateur" >
							<option id="ug_region" value =1 selected >Region</option>
							<option id="ug_district" value =2>District</option>
							<option id="ug_commune" value =3>Commune</option>
							<option id="ug_point" value =5>Point</option>
						</select></td>
					<td>--</td>
				</tr>
				<tr id="ligne_region">
					<td>Région</td>
					<td>---</td>
					<td>
						<select id="sel_region" class="seldef" name="val_reg" id="pa_region" >
							<option class="v1_reg" value =0 selected >Tout</option>
							<?php
								foreach($pa_region as $row){
									echo '<option id="op'.$row->code.'" class="v1_reg" value ="'.$row->code.'">'.$row->nom.'</option>';
								}
							?>
						</select>
					</td>
					<td>--</td>
				</tr>
				<tr id="ligne_district">
					<td>District</td>
					<td>---</td>
					<td>
						<select id="sel_district" class="seldef" name="val_dis" id="pa_region" >
							<option class="v1_reg" value =0 selected >Tout</option>
							<?php
								foreach($pa_district2 as $row){
									echo '<option id="op'.$row->code.'" alt="op'.$row->maitre.'" class="v1_reg" value ="'.$row->code.'">'.$row->nom.'</option>';
								}
							?>
						</select>
					</td>
					<td>--</td>
				</tr>
				<tr  id="ligne_commune">
					<td>Commune</td>
					<td>---</td>
					<td>
						<select id="sel_commune" class="seldef" name="val_com" id="pa_region" >
							<option class="v1_reg" value =0 selected >Tout</option>
							<?php
								foreach($pa_commune2 as $row){
									echo '<option id="op'.$row->code.'" alt="op'.$row->maitre.'" class="v1_reg" value ="'.$row->code.'">'.$row->nom.'</option>';
								}
							?>
						</select>
					</td>
					<td id="load_commune">
						<?php
							echo "<img id='loading' hidden src='".base_url()."img/ajax-loading.gif' alt='Photo de montagne'/>";
						?>
					</td>
				</tr>
				<tr>
					<td>date</td>
					<td>
						<label style="margin:7px;" class="switch switch-green">
							<input value="=" type="checkbox" name="op_date" class="switch-input">
							<span class="switch-label" data-on="Oui" data-off="Non"></span>
							<span class="switch-handle"></span>
						</label>
					</td>
					<td>
						<label for='datedeb'>
							<span><span></span></span>
							Debut
						</label>						
						<input id="datedeb" type="date" name="datedeb" />
					</td>
					<td><label for='choice-a'>
							<span><span></span></span>
							Fin
						</label>						
						<input id="datefin" type="date" name="datefin" />
					</td>
				</tr>
				<tr height="100px">
					<td colspan=2 align="center">
						<button id="vis_t" style="font-size:12px;margin-top:20px;width:250px;" name="action" value="sql_liste" type="submit">Visualiser Tableau</button>
					</td>
					<td colspan=1 align="center">
						<div onmousemove="myFunction(event)" onmouseout="clearCoor()">
							<button  id="vis_c" style="font-size:12px;margin-top:20px;width:250px;" name="action" value="visu_carte" type="submit"> <a href="http://localhost/QGIS-Web-Client-master/site/qgiswebclient.html?map=E:\Prosperer\Carte\mario\Appuis_par_categorie.qgs">Visualiser Carte</a> </button>
						</div>
					</td>
					<td>
						<?php
							echo "<img id='earth' hidden src='".base_url()."img/earth.gif' alt='Photo de montagne'/>";
						?>
					</td>
					
				</tr>
			</tbody>
		</table>
	</div>
	<p id="demo"></p>
	
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/accordeon.js"></script>
<script src="<?php echo base_url(); ?>assets/js/footer_pre.js"></script>




