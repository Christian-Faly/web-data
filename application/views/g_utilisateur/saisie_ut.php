
<?php
    $this->load->helper("form");
	$attributes = array('enctype' => 'multipart/form-data');
    echo form_open("index.php/g_utilisateur/saisie_utilisateur",$attributes);
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

	<div class="container-fluid" style="background-color:#AED6F1">

			<div class="row" style="margin: 5px ">
				<div class="span2" style="margin: 0px 10px 0px 0px">Nom</div>
				<div class="span4" style="margin: 0px 10px 0px 0px">
					<input type="text" name="name" size="40" value=<?php echo $a_modifier->name ?> maxlength="40">
				</div>
				<div class="span2" style="margin: 0px 10px 0px 0px"> prenom</div>
				<div class="span4" style="margin: 0px 10px 0px 0px">
					<input type="text" name="first_name" size="40" value=<?php echo $a_modifier->first_name ?> maxlength="40">
				</div>
			</div>

			<div class="row" style="margin: 5px;">
				<div class="span2" style="margin: 0px 10px 0px 0px">Login</div>
				<div class="span4" style="margin: 0px 10px 0px 0px">
					<input type="text" name="login" size="12" value=<?php echo $a_modifier->login ?> maxlength="12">
				</div>
				<div class="span2" style="margin: 0px 10px 0px 0px">Mot de passe</div>
				<div class="span4" style="margin: 0px 10px 0px 0px">
					<input type="password" name="password" size="12" value=<?php echo $a_modifier->password ?> maxlength="12">
				</div>
			</div>

			<div class="row"style="margin: 5px;">
				<div class="span2" style="margin: 0px 10px 0px 0px">Role</div>
				<div class="span4" style="margin: 0px 10px 0px 0px">
					<select class="browser-default custom-select">
						<?php 
							$sel1='';
							$sel2='';
							$sel3='';
							if ( $a_modifier->role_id==1)
						  	  $sel1='selected';
							if ( $a_modifier->role_id==2)
                                                          $sel2='selected'; 
							if ( $a_modifier->role_id==3)
                                                          $sel3='selected';
							echo '<option '.$sel1.' value="1">Administrateur</option>';
							echo '<option '.$sel2.' value="2">Acteur/Actrice</option>';
							echo '<option '.$sel3.' value="3">Visiteur</option>';
						?>
					</select>
				</div>
				<div class="span2" style="margin: 0px 10px 0px 0px">Active</div>
				<div class="span4" style="margin: 0px 10px 0px 0px">
					<select class="browser-default custom-select">
						<option selected><?php echo $a_modifier->active ?></option>
						<option value="True">Active</option>
						<option value="False">Non Active</option>
					</select>
				</div>
			</div>


			<div class="row"style="margin: 5px;">
                                <div class="span2" style="margin: 0px 10px 0px 0px">Entité</div>
                                <div class="span4" style="margin: 0px 10px 0px 0px">
                                	<input type="text" name="entite" size="12" value=<?php echo $a_modifier->entite ?> maxlength="12">
                                </div>
                                <div class="span2" style="margin: 0px 10px 0px 0px">E-Mail</div>
                                <div class="span4" style="margin: 0px 10px 0px 0px">
                                        <input type="text" name="entite" size="12" value=<?php echo $a_modifier->e_mail ?> >
                                </div>
                        </div>

 			<div class="row"style="margin: 5px;">
                                <div class="span2" style="margin: 0px 10px 0px 0px">Fonction</div>
                                <div class="span4" style="margin: 0px 10px 0px 0px">
                                        <input type="text" name="entite" size="12" value=<?php echo $a_modifier->fonction ?> maxlength="12">
                                </div>
                                <div class="span2" style="margin: 0px 10px 0px 0px">Région</div>
                                <div class="span4" style="margin: 0px 10px 0px 0px">
                                        <input type="text" name="entite" size="12" value=<?php echo $a_modifier->nregion ?> maxlength="12">
                                </div>
                        </div>


			<div class="row"style="margin: 0px;">
				<div class="span3" style="margin: 0px 10px 0px 0px" style="text-align:center">
					 <button type="button" class="btn btn-primary"  style ="width:150px;">AJOUTER</button>
				</div>

				<div class="span3" style="margin: 0px 10px 0px 0px" style="text-align:center">
					<button type="button" class="btn btn-success" style ="width:150px;">OK</button>
				</div>

				<div class="span3" style="margin: 0px 10px 0px 0px" style="text-align:center">
					<button type="button" class="btn btn-warning" style ="width:150px;" >Annuler</button>
				</div>

				<div class="span2" style="margin: 0px 10px 0px 0px" style="text-align:center">
					 <button type="button" class="btn btn-danger"  style ="width:150px;" >SUPPRIMER</button>
				</div>
			</div>
	</div>
	<br>
	<table class="table table-hover">
		<thead>
			<tr  style="background-color:DarkSlateGray ">
				<th scope="col">#</th>
				<th scope="col">Nom</th>
				<th scope="col">Prenom</th>
				<th scope="col">login</th>
				<th scope="col">Entité</th>
				<th scope="col">E-Mail</th>
				<th scope="col">Fonction</th>
				<th scope="col">Région</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i=1;
				foreach($bdd as $row){
					if($row->login==$a_modifier->login){
						echo '<tr style="background-color:CadetBlue">';
					}
					else{
						echo "<tr  style='background-color:DarkGray'>";	
					}
					$i++;
						echo '<td><button style="font-size: 2px;margin-top:1px;width:25px;" name="modif" value='.$row->login.' type="submit">...</button></td>';
						echo "<td>".$row->name."</td>";
						echo "<td>".$row->first_name."</td>";
						echo "<td>".$row->login."</td>";
						echo "<td>".$row->entite."</td>";
						echo "<td>".$row->e_mail."</td>";
						echo "<td>".$row->fonction."</td>";
						echo "<td>".$row->nregion."</td>";

					echo "</tr>";
				}
			?>
		</tbody>
	</table>
    
<?php

echo form_close();
?>
