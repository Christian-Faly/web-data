<div class="container">
		<input type="text" id="nom_tb" name="nom_tb" size="12" value=<?php echo $tb; ?> maxlength="12">	
		<input type="text" id="url_base" name="url_base" size="12" value=<?php echo base_url()."index.php/tb/param_tb?"; ?> maxlength="24">	
		<input type="text" id="page_tb" name="page" size="12" value=<?php echo $page; ?> maxlength="24">	
		<input type="text" id="nbparpage" name="nbparpage" size="12" value=<?php echo $nbparpage; ?> maxlength="24">	
	<div class="row">
		<div class="col-md-2">Type tableau</div>
		<div class="col-md-4">
			<select id ="sel_type_tb" class="browser-default custom-select">
				<option selected value="annuel">Annuel</option>
				<option value="trimestriel">Trimestriel</option>
				<option value="par_region">Par région</option>
			</select>
		</div>
		<div  class="col-md-2">Année</div>
		<div  class="col-md-4">
			<?php
				$y=Date("Y");
				$val_Annee1 = $y;  
					if (isset($val_Annee)){
						$val_Annee1 = $val_Annee;
					}
				echo '<select disabled id="sel_annee_tb" class="browser-default custom-select">';
				for ($i = 2008; $i <= 2021; $i++) {
					$sel='';
					if ($i==2021)
						echo '<option selected value="'.$i.'">'.$i.'</option>';
					else
						echo '<option value="'.$i.'">'.$i.'</option>';
				}	
				echo '</select>';
			?>
		</div>
	</div>

	<div class="row">
		<div id="debug" style="color:blue" class="col-md-2"></div>
		<div id="statut" style="color:red"  class="col-md-4"></div>
		
		
		<div class="col-md-2">Région</div>
		<div class="col-md-4">
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
		</div>
	</div>
	
	<h1>
	<?php $query = $this->db->query("SELECT description FROM pa_liste_tb WHERE nom_tb='".$tb."'");  
            $result = $query->result();
            $description="";
            foreach($result as $row){
                $description=$row->description;
            }
			echo $description; 
	?>
	</h1>
	<div id="div_tb">
	
	</div>
	
</div>
						
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/tb.js"></script>
						
						