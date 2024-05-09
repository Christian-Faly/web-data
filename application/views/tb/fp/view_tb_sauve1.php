<table>
	<tr>
		<td><input type="text" id="nom_tb" name="nom_tb" size="12" value=<?php echo $tb; ?> maxlength="12"></td>	
		<td colspan="4"><input type="text" id="url_base" name="url_base" style="width: 150px;" value=<?php echo base_url()."index.php/tb/param_tb?"; ?> maxlength="24"></td>	
		<td><input type="text" id="page_tb" name="page" style="width: 150px;" value=<?php echo $page; ?> maxlength="24"></td>	
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>
		<?php $query = $this->db->query("SELECT description FROM pa_liste_tb WHERE nom_tb='".$tb."'");  
            $result = $query->result();
            $description="";
            foreach($result as $row){
                $description=$row->description;
            }
			echo $description;
		?>
		</td>
		<td>
			<select id ="sel_type_tb" style="width:75px;" class="browser-default custom-select">
				<option selected value="annuel">Annuel</option>
				<option value="trimestriel">Trimestriel</option>
				<option value="par_region">Par région</option>
			</select>
		</td>
		<td>
			<?php
				$y=Date("Y");
				$val_Annee1 = $y;
					if (isset($val_Annee)){
						$val_Annee1 = $val_Annee;
					}
				echo '<select disabled id="sel_annee_tb" class="browser-default custom-select" style="width:75px;">';
				for ($i = 2008; $i <= 2021; $i++) {
					$sel='';
					if ($i==2021)
						echo '<option selected value="'.$i.'">'.$i.'</option>';
					else
						echo '<option value="'.$i.'">'.$i.'</option>';
				}
				echo '</select>';
			?>
		</td>
		<td>
			<select id='sel_region_tb' class="browser-default custom-select">
				<?php
					$this->load->model("get_db");
					$res  = $this->db->query("SELECT * FROM pa_Region");
					if (false === $res) {
						echo $this->db->_error_message()."<br>";
					}else{
						foreach ($res->result() as $ro){
							$sel='';
							if ($ro->code==0)
							  $sel='selected';
							echo '<option '.$sel.' value ="'.$ro->code.'">'.$ro->nom.'</option>';
						}
					}
				?>
			</select>
		</td>
		<td>Nombre de ligne par page</td>
		<td><input type="text" id="nbparpage" name="nbparpage" style="width:75px;" value=<?php echo $nbparpage; ?> maxlength="24"></td>
		<td id="debug" style="color:blue"></td>
		<td id="statut" style="color:red"></td>
	</tr>
</table>
	<div id="div_tb">
	
	</div>
	
						
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/tb.js"></script>
						
						
