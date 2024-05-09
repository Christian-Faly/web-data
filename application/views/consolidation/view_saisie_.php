
<?php
    $this->load->helper("form");
	$attributes = array('enctype' => 'multipart/form-data');
    echo form_open("index.php/consolidation/saisie_conso",$attributes);
	if (!(isset($user_region))){
		$user_region='Itasy';
	}
	$data = array(
		"name" => "user_region",
		"id" => "user_region",
		"value" => $user_region,
		"type"   => "hidden",
	);
	echo '<span>'.form_input($data).'</span>';
?>

	<div class="container">
			<div class="row">
				<div class="col-md-2">Nom de la base</div>
				<div class="col-md-4">
					<input type="text" name="date_de" size="12" value=<?php echo $a_modifier->nombdd ?> maxlength="12">		
				</div>
				<div class="col-md-2">Niveau</div>
				<div class="col-md-4">
					<select class="browser-default custom-select">
						<option selected> <?php echo $a_modifier->niveau ?></option>
						<option value="1">EPR</option>
						<option value="2">GUMS</option>
						<option value="3">AC</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">Description</div>
				<div class="col-md-4">
					<input type="text" name="date_de" size="12" value=<?php echo $a_modifier->description_bdd ?> maxlength="12">		
				</div>
				<div class="col-md-2">Objet Saisie</div>
				<div class="col-md-4">
					<input type="text" name="date_de" size="12" value=<?php echo $a_modifier->objets_saisie ?> maxlength="12">		
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">Type</div>
				<div class="col-md-4">
					<select class="browser-default custom-select">
						<option selected><?php echo $a_modifier->typa ?></option>
						<option value="1">Fusion</option>
						<option value="2">Saisie</option>
					</select>
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-4">
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-3">
					<button type="button" class="btn btn-success">OK</button>
				</div>
				<div class="col-md-3">
					<button type="button" class="btn btn-danger">Annuler</button>
				</div>
				<div class="col-md-3">
				</div>
			</div>
	</div>
	<br>
	<?php    
		if (isset($message)){
			echo $message;
		}else{
			echo '<label for="fileUpload">Upload du fichier de la base de données :"'.$a_modifier->nombdd.'" dans le dossier "'.$user_region.'/"</label>';
			echo '<input type="file" name="photo" id="fileUpload">';
			echo '<input type="submit" name="action" value="Upload">';
			echo '<strong>Note:</strong> Seul le format .backup est autorisés.';
		}			
	?>
	<table class="table table-hover">
		<thead>
			<tr  style="background-color:DarkSlateGray ">
				<th scope="col">#</th>
				<th scope="col">nom de la base</th>
				<th scope="col">Niveau</th>
				<th scope="col">description</th>
				<th scope="col">Objet saise</th>
				<th scope="col">Type bdd</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i=1;
				foreach($bdd as $row){
					if($row->nombdd==$a_modifier->nombdd){
						echo '<tr style="background-color:CadetBlue">';
					}
					else{
						echo "<tr  style='background-color:DarkGray'>";	
					}
					$i++;
						echo '<td><button style="font-size: 2px;margin-top:1px;width:25px;" name="modif" value='.$row->nombdd.' type="submit">...</button></td>';
						echo "<td>".$row->nombdd."</td>";
						echo "<td>".$row->niveau."</td>";
						echo "<td>".$row->description_bdd."</td>";
						echo "<td>".$row->objets_saisie."</td>";
						echo "<td>".$row->typa."</td>";
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
	<button name="action" value="init_bdd" type="submit">Initialisation BDD</button>
    <button name="action" value="restore_bdd" type="submit">Restaurer BDD</button>
    <button name="action" value="init_tables" type="submit">Initialisation Tables</button>
    <button name="action" value="consolider" type="submit">Consolider</button>
    
<?php

echo form_close();
?>