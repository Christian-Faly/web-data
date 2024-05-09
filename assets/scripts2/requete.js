$(function(){
				$('#b_a_r').hide();
				$('#assist_req').hide();
				$('#nr').hide();
				$('#categorie').hide();
				$('#vis_t').hide();
				$('#vista').hide();
				$('#pa_req').hide();
				$('#sql').css('height', $('#sel_req').css('height'));
				
				$('#ch_req').on('click', '.requete', function(){
					var id = this.id;
					var param = 'id=' + id;
					$('#sql').load('<?php echo base_url(); ?>index.php/req_pre/acceuil #sqlcorps', param);
					$('#vis_t').show();
					$('#pa_req').show();
				});
				
				$('#ch_reqA').on('click', '.requeteA', function(){
					$('#vista').show();
					var id7 = this.id;
					var param7 = 'id=' + id7;
					$('#sql').load('<?php echo base_url(); ?>index.php/assist_requete/tables #sqlcorps', param7);
				});
				
				$('#sav_b').click(function(){
					$('#nr').show();
					$('#categorie').show();
				});
				
				$('#annu_b').click(function(){
					$('#nr').hide();
					$('#categorie').hide();
				});
				
				$('#cat').on('click', '.mere', function(){
					var id2 = this.id;
					var param2 = 'id_req=' + id2;
					var param3 = 'code_req=rien';
					$('#cla').load('<?php echo base_url(); ?>index.php/ajax/classe #cla_corps', param2);
					$('#souscla').load('<?php echo base_url(); ?>index.php/ajax/sousclasse #souscla_corps', param3);
				});
				
				$('#cla').on('click', '.classe', function(){
					var id3 = this.id;
					var param3 = 'code_req=' + id3;
					$('#souscla').load('<?php echo base_url(); ?>index.php/ajax/sousclasse #souscla_corps', param3);
				});
				
				$('#pa_region').on('click', '.v1_reg', function(){
					var code_reg = this.value;
					var param3 = 'code_reg=' + code_reg;
					$('#pa_district').load('<?php echo base_url(); ?>index.php/req_pre/acceuil #sel_pa_district', param3);
					$('#pa_commune').load('<?php echo base_url(); ?>index.php/req_pre/acceuil #sel_pa_commune', param3);
				});
				
				$('#pa_district').on('click', '.v1_dis', function(){
					var code_dis = this.value;
					var param3 = 'code_dis=' + code_dis;
					$('#pa_commune').load('<?php echo base_url(); ?>index.php/req_pre/acceuil #sel_pa_commune', param3);
				});
				
				$('.titre').click(function(){
					var id4 = this.id;
					var param4 = 'type=rp&code=' + id4;
					$('#tableau').load('<?php echo base_url(); ?>index.php/req_pre/acceuil #tb', param4);
					$('#ch_req').load('<?php echo base_url(); ?>index.php/req_pre/acceuil #sel_req', param4);
					$('#sql').load('<?php echo base_url(); ?>index.php/req_pre/acceuil #sqlcorps', param4);
					$('#vis_t').hide();
					$('#pa_req').hide();
				});
				
				$('.titreA').click(function(){
					$('#b_a_r').show();
					$('#vista').hide();
					var name = this.name;
					var id6 = this.id;
					var param6 = 'type=ar&code=' + id6 +'&nom_table=' + name;
					$('#ch_reqA').load('<?php echo base_url(); ?>index.php/assist_requete/tables #sel_req', param6);
					$('#sql').load('<?php echo base_url(); ?>index.php/assist_requete/tables #sqlcorps', param6);
					$('#assist_req').load('<?php echo base_url(); ?>index.php/assist_requete/tables #assist_req_corps', param6);
					$('#assist_req').hide();
				});
				
				$('#tableau').on('click', '#b_rech', function(){
					var rech = $('#c_rech').val();
					var param5 = 'type=rp&rech=' + rech;
					$('#ch_req').load('<?php echo base_url(); ?>index.php/req_pre/acceuil #sel_req', param5);
					$('#sql').load('<?php echo base_url(); ?>index.php/req_pre/acceuil #sqlcorps', param5);
					$('#t_ta').text('Resultat de la recherche sur: "' + rech + '"');
				});
				
				$('#tableauA').on('click', '#b_rechA', function(){
					var rech = $('#c_rechA').val();
					var param5 = 'rech=' + rech;
					$('#ch_reqA').load('<?php echo base_url(); ?>index.php/assist_requete/tables #sel_req', param5);
					$('#sql').load('<?php echo base_url(); ?>index.php/req_pre/acceuil #sqlcorps', param5);
					$('#t_ta').text('Resultat de la recherche sur: "' + rech + '"');
				});
				
				$('#b_a_r').click(function(){
					$('#assist_req').show()
				});
			});
