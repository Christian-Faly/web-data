						
						</div>
					</div>
				</div>
			</section>

			<footer>
				<div class="container">
					<div class="row">
					<div class="span4">
						<div class="widget">
						<h5 class="widgetheading">Les Pages de Navigation</h5>
						<ul class="link-list">
							<li><a href="#">Accueil <i class="icon-home"></i></a></li>
							<?php if ($this->session->userdata('role_id')==='1')
							echo '<li><a href="#">Tableaux de bord</a></li>
									<li><a href="#">Requêtes Prédéfinies</a></li>
									<li><a href="#">Cartes</a></li>'
							?>
							<li><a href="#">Forum</a></li>
							<?php if ($this->session->userdata('username')!=''){
								echo'<li><a href="'.site_url().'site/logout">Se déconnecter <i class="icon-signout"></i></a></li>';
							}
							else echo '<li><a href="#" class="btn-login-form">Se connecter <i class="icon-signin"></i></a></li>'
							?>
						</ul>

						</div>
					</div>
					<div class="span4">
						<div class="widget">
							<h5 class="widgetheading">Coordonnées PROSPERER</h5>
							<address>
								<strong>PROSPERER National.</strong><br>
								Chambre de Commerce et de l'Industrie, Anataninarenina<br>
								Antananarivo
							</address>
						<p>
							<i class="icon-phone"></i> (+261)34 - 14 - 210 - 12 <strong>PROSPERER National</strong> <br>
							<i class="icon-envelope-alt"></i> prosperer@prosperer.mg</br>
						</p>
						</div>
					</div>
					<div class="span4">
						<div class="widget">
						<h5 class="widgetheading">Des mots à dire?</h5>
						
						<p>
							Veuillez entrer d'abord votre e-mail, et vous pouvez vous inscrire au Forum.
						</p>
						<form class="subscribe">
							<div class="input-append">
							<input class="span2" id="appendedInputButton" type="text">
							<button class="btn btn-theme" type="submit">S'inscrire</button>
							</div>
						</form>
						</div>
					</div>
					</div>
				</div>
				<div id="sub-footer">
					<div class="container">
					<div class="row">
						<div class="span6">
							<div class="copyright">
								<div class="logo">
									<a href="index.html">
									<img src="<?php echo site_url()?>assets/img/logo.png" alt="" />
									</a>              
								</div>
								<p><span>&copy; PROSPPERER National. All right reserved</span></p>
								
							</div>

						</div>

						<div class="span6">
							<div class="credits">
								
								Conçu par <a href="">LEESOTECH</a>
							</div>
						</div>
					</div>
					</div>
				</div>
			</footer>
			<!-- Uncomment below if you want to use a preloader -->
			

		

					
		</div>
		<a href="#" class="scrollup"><i class="icon-angle-up icon-square icon-bglight icon-2x active"></i></a>
		<a href="#" class="scrolldown"><i class="icon-angle-down icon-square icon-bglight icon-2x active"></i></a>

		<script src="<?php echo site_url()?>assets/js/jquery.js"></script>
		<script>
			var site_url="<?php echo site_url()?>";
			var domain_url= "<?php echo site_url('../../');?>";
			var action_img= "<?php echo $this->session->userdata('action_img');?>";
			var role_id="<?php if ($this->session->userdata('role_id')!='') echo $this->session->userdata('role_id');?>";

			//console.log(site_url);
		</script>


		
		<script type="text/javascript" src="<?php echo base_url("assets/datatables/js/jquery.dataTables.min.js"); ?>"></script>		
		<script type="text/javascript" src="<?php echo base_url("assets/datatables/js/dataTables.bootstrap.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/datatables/js/dataTables.tableTools.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/datatables/js/bouton/dataTables.buttons.min.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/datatables/js/bouton/buttons.flash.min.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/datatables/js/bouton/jszip.min.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/datatables/js/bouton/pdfmake.min.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/datatables/js/bouton/vfs_fonts.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/datatables/js/bouton/buttons.html5.min.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/datatables/js/bouton/buttons.print.min.js"); ?>"></script>
	
		<script type="text/javascript" src="<?php echo base_url("assets/highchart/highcharts.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("assets/highchart/modules/exporting.js"); ?>"></script>
		<!--script type="text/javascript" src="<?php //echo base_url("assets/js/modules/bootstrap-datetimepicker.min.js"); ?>"></script-->
		<script type="text/javascript" src="<?php echo base_url("assets/datepicker/js/bootstrap-datepicker.js"); ?>"></script>
		
		<script src="<?php echo site_url()?>assets/js/jquery.easing.1.3.js"></script>
		<!--  -->
		<script type="text/javascript" src="<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js"); ?>"></script>	
		
		
		
	
		<script src="<?php echo site_url()?>assets/js/modernizr.custom.js"></script>
		<script src="<?php echo site_url()?>assets/js/toucheffects.js"></script>
		<script src="<?php echo site_url()?>assets/js/google-code-prettify/prettify.js"></script>
		<script src="<?php echo site_url()?>assets/js/jquery.bxslider.min.js"></script>
		<script src="<?php echo site_url()?>assets/js/camera/camera.js"></script>
		<script src="<?php echo site_url()?>assets/js/camera/setting.js"></script>

		<script src="<?php echo site_url()?>assets/js/jquery.prettyPhoto.js"></script>
		<script src="<?php echo site_url()?>assets/js/portfolio/jquery.quicksand.js"></script>
		<script src="<?php echo site_url()?>assets/js/portfolio/setting.js"></script>

		<script src="<?php echo site_url()?>assets/js/jquery.flexslider.js"></script>
		<script src="<?php echo site_url()?>assets/js/animate.js"></script>
		<script src="<?php echo site_url()?>assets/js/inview.js"></script>

		<!-- Template Custom JavaScript File -->
		<script src="<?php echo site_url()?>assets/js/custom.js"></script>
		<script src="<?php echo site_url()?>assets/js/sb-admin-2.min.js"></script>
		
		<script src="<?php echo site_url()?>assets/contactform/contactform.js"></script>

		<script src="<?php echo site_url()?>assets/js/pdf/pdf.js"></script>
		<script src="<?php echo site_url()?>assets/js/pdf/pdf.worker.js"></script>
		<script src="<?php echo site_url()?>assets/js/jQuery.print.js"></script>
		<script src="<?php echo base_url()?>assets/scripts2/main.js"></script>

							 

		<!--<script src="<?php //echo site_url()?>assets/js/vendor/Chart.min.js"></script>File -->
		<script src="<?php echo site_url()?>assets/js/ch/Chart.js"></script>

		
		<script>
			var forms=document.getElementsByTagName('form');
			console.log(forms);
			forms[0].reset();
			forms[1].reset();
			forms[2].reset();
			forms[3].reset();
			forms[4].reset();

			var benef_par_annee=[];
			var annee_benef=[];
			var nb_benef_par_annee=[];
			<?php if(is_array($benef_par_annee)): ?>
				<?php 
					foreach($benef_par_annee as $result){
						echo "annee_benef.push(".$result->date_part.");\n";
						echo "nb_benef_par_annee.push(".$result->count_a_ctompony.");\n";
					}
				?>
			<?php endif ?>

			var types_formation=[];
			var nb_benef_formation=[];
			<?php if(is_array($benef_formation)): ?>
				<?php 
					foreach($benef_formation as $result){
						echo "types_formation.push('".$result->type_formation."');\n";
						echo "nb_benef_formation.push(".$result->count_a_ctompony.");\n";
					}
				?>
			<?php endif ?>

			var genre_benef=[];
			var nb_genre_benef=[];
			<?php if(is_array($benef_par_genre)): ?>
				<?php 
					foreach($benef_par_genre as $result){
						echo "genre_benef.push('".$result->genre."');\n";
						echo "nb_genre_benef.push(".$result->count_a_ctompony.");\n";
					}
				?>
			<?php endif ?>

			var annee_benef_sf=[];
			var nb_benef_sf=[];
			var femme_benef_sf=[];
			var homme_benef_sf=[];
			<?php if(is_array($benef_sf_par_annee)): ?>
				<?php 
					foreach($benef_sf_par_annee as $result){
						echo "annee_benef_sf.push('".$result->date_part."');\n";
						echo "nb_benef_sf.push(".$result->nb.");\n";
						echo "femme_benef_sf.push(".$result->femme.");\n";
						echo "homme_benef_sf.push(".$result->homme.");\n";
					}
				?>
			<?php endif ?>


			var types_foire=[];
			var nb_benef_foire=[];
			<?php if(is_array($benef_foire)): ?>
				<?php 
					foreach($benef_foire as $result){
						echo "types_foire.push('".$result->type_foire."');\n";
						echo "nb_benef_foire.push(".$result->count_a_ctompony.");\n";
					}
				?>
			<?php endif ?>

			var genre_benef_foire=[];
			var nb_genre_benef_foire=[];
			<?php if(is_array($benef_foire_pr_genre)): ?>
				<?php 
					foreach($benef_foire_pr_genre as $result){
						echo "genre_benef_foire.push('".$result->genre."');\n";
						echo "nb_genre_benef_foire.push(".$result->count_a_ctompony.");\n";
					}
				?>
			<?php endif ?>
		</script>


		<?php if ($this->session->userdata('action_img')==='acceuil'){
			
			echo'<script src="'.site_url().'assets/js/demo/main_chart.js"></script>
			<script src="'.site_url().'assets/js/ch/analytics.js"></script>
			<script src="'.site_url().'assets/js/ch/utils.js"></script>
			<script src="'.site_url().'assets/js/ch/benefSF_chart.js"></script>';
		} ?> 
	
	

</body>
</html>
