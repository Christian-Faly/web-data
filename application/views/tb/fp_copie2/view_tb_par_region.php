<div id="div_tb_ainserer">
	<?php
		echo '<table bgcolor="#FFFFFF">'."\n";
		
		// ============================ tableau ==================================
		$haut="SELECT SUM(r_a) as epra,SUM(r_b) as eprb, SUM(r_g) as eprg,SUM(r_h) as eprh,SUM(r_i) as epri,SUM(r_l) as eprl,
			SUM(r_s) as eprs,SUM(r_t) as eprt,SUM(r_v) as eprv
			FROM 
			(SELECT DISTINCT id,
			CASE WHEN nregion=4 THEN valeur ELSE 0 END as r_a,CASE WHEN nregion=8 THEN valeur ELSE 0 END as r_b, 
			CASE WHEN nregion=6 THEN valeur ELSE 0 END as r_g,CASE WHEN nregion=15 THEN valeur ELSE 0 END as r_h, 
			CASE WHEN nregion=3 THEN valeur ELSE 0 END as r_i,CASE WHEN nregion=13 THEN valeur ELSE 0 END as r_l, 
			CASE WHEN nregion=7 THEN valeur ELSE 0 END as r_s,CASE WHEN nregion=12 THEN valeur ELSE 0 END as r_t, 
			CASE WHEN nregion=16 THEN valeur ELSE 0 END as r_v";
			
		$haut_tot="SELECT SUM(t) as total 
				FROM ( 
				SELECT DISTINCT id, 
				valeur t";
		
		$y=Date("Y");
		$val_Annee1 = $y;  
		if (isset($val_Annee)){
			$val_Annee1 = $val_Annee;
		}
		
		if ($val_Annee1==0){
			$haut=$haut." FROM (";
			$haut_tot=$haut_tot." FROM (";
			$bas =" ) as a) as b";    
		}else{
			$haut=$haut.",nregion FROM (" ;
			$haut_tot=$haut_tot.",nregion FROM (" ;
			$bas =") as a WHERE date_part('Y',daty)=".$val_Annee1.") as b" ;
		}
		
		
		//echo $haut;
		//echo '<br>';
		//echo $bas;

		$offset=($page-1)*$nbparpage;
		$resultat = $this->db->query($sql." limit ".($nbparpage +1 )." OFFSET ".$offset);
		
		if (!$resultat) {
			die('Échec de la requête : ' . $this->db->_error_message());
		}
		echo "<div id='pagination'>";
			$nb_page=$nb_enr/$nbparpage;
				for ($i = 1; $i <= $nb_page ; $i++) {
					echo "<span id='num_page'><a href='#'>".$i."</a></span>";
					echo "<span>  </span>";
				}
				if (round($nb_page)*$nbparpage<$nb_enr) 
					echo "<span style='border:5px;border-color:red' id='nb_enr'><a href='#'>".$i."</a></span>";
		echo "</div>";
		
		//$resultat = $this->db->query($sql." limit ".($nbparpage +1 )." OFFSET ".$limit);
		
		//echo $sql;
		
		if (!$resultat) {
			die('Échec de la requête : ' . $this->db->_error_message());
		}
		
		$col_span=7;
		
		echo '<table class="table table-hover" border="1" width="100%">'."\n";//style="table-layout:fixed;" bgcolor="#FFFFFF"
		//echo '<table style="table-layout:fixed;" bgcolor="#FFFFFF" border="1">'."\n";// 
				$col_span=20;
				echo '<tr bgcolor="#FFCC00">';
					echo '<th width="54" scope="col" >ID</th>';
					echo '<th width="1000" scope="col">Indicateur</th>';
					echo '<th width="36" scope="col">Unit&eacute;</th>';
			
					echo '<th width="87" scope="col">Valeur cible </th>';
					echo '<th width="87" scope="col">R&eacute;alisation global </th>';
					echo '<th width="87" scope="col">Taux global </th>';
					echo '<th width="40" scope="col">EPRA</th>';
					echo '<th width="40" scope="col">EPRB</th>';
					echo '<th width="40" scope="col">EPRG</th>';
					echo '<th width="40" scope="col">EPRH</th>';
					echo '<th width="40" scope="col">EPRI</th>';
					echo '<th width="86" scope="col">EPRL</th>';
					echo '<th width="40" scope="col">EPRS</th>';
					echo '<th width="40" scope="col">EPRT</th>';
					echo '<th width="40" scope="col">EPRV</th>';
				echo '</tr>';
			foreach($resultat->result_array() as $row){
				if($row['niveau']==1){
					echo '<tr bgcolor="#99FF00">';
					echo '<td>'.$row['niveau'].'</td>'; 
					echo '<td colspan="'.$col_span.'">'.$row['indicateur'].'</td>';
					echo '</tr>';
				}
				elseif ($row['niveau']==2){
					echo '<tr bgcolor="#CD9BFF">';
					echo '<td>'.$row['niveau'].'</td>'; 
					echo '<td colspan="'.$col_span.'">'.$row['indicateur'].'</td>';
					echo '</tr>';
				}
				elseif ($row['niveau']==3){
					echo '<tr bgcolor="#33FFFF">';
					echo '<td>'.$row['niveau'].'</td>'; 
					echo '<td colspan="'.$col_span.'">'.$row['indicateur'].'</td>';
					echo '</tr>';
				}
				elseif ($row['niveau']==4){
					echo '<tr bgcolor="#B8D3FE">';
					echo '<td>'.$row['niveau'].'</td>'; 
					echo '<td colspan="'.$col_span.'">'.$row['indicateur'].'</td>';
					echo '</tr>';
				}
				elseif ($row['niveau']==5){
					echo '<tr bgcolor="#44D3FE">';
					echo '<td>'.$row['niveau'].'</td>'; 
					echo '<td colspan="'.$col_span.'">'.$row['indicateur'].'</td>';
					echo '</tr>';
				}
				else{
					$t1=NULL;     
					$t2=NULL;     
					$t3=NULL;     
					$t4=NULL;
					$tot=NULL;
					
					if ($row["sql_web"]>""){
						$sql1= $haut." ".$row["sql_web"].$bas;
						$re = $this->db->query($sql1);
						foreach($re->result_array() as $ligne){
							$t_a=$ligne["epra"];  
							$t_b=$ligne["eprb"];     
							$t_g=$ligne["eprg"];     
							$t_h=$ligne["eprh"];
							$t_i=$ligne["epri"];  
							$t_l=$ligne["eprl"];     
							$t_s=$ligne["eprs"];     
							$t_t=$ligne["eprt"];  
							$t_v=$ligne["eprv"];     
						} 
						
						$sql1_tot= $haut_tot." ".$row["sql_web"].$bas;
						$re_tot = $this->db->query($sql1_tot);
						foreach($re_tot->result_array() as $ligne_tot){
							$tot=$ligne_tot["total"];   
						} 
					}
					//else{
					//	$sql2="Tsy misy";  
					//}
					
					$sql2="select SUM(trim1) as pt1,SUM(trim2) as pt2,SUM(trim3) as pt3, SUM(trim4) as pt4 ,SUM(trim1+trim2+trim3+trim4) as pa 
						from tb_prevision_a1d
						where gid_indicateur=".$row['id'];
					$pt1=NULL;     
					$pt2=NULL;     
					$pt3=NULL;     
					$pt4=NULL;
					$pa=NULL;      
					$re2 = $this->db->query($sql2);
					foreach($re2->result_array() as $ligne){
						$pt1=$ligne["pt1"];  
						$pt2=$ligne["pt2"];     
						$pt3=$ligne["pt3"];     
						$pt4=$ligne["pt4"];
						$pa=$ligne["pa"];   
					}
					echo '<td>';
					echo $row['id'];
					/*<button id="vis_c" style="font-size:12px;margin-top:20px;width:50px;" name="action" value="visu_carte" type="submit"> <a href="http://localhost/QGIS-Web-Client-master/site/qgiswebclient.html?map=E:\Prosperer\Carte\mario\formation_par_type.qgs">Carte</a> </button>';*/
					echo '</td>';
				
					echo '<td>'.$row["indicateur"].'</td>';
					echo '<td>'.$row["unite"].'</td>';
						echo '<td>'.$row["rpe"].'</td>';
						echo '<td> </td>';
						echo '<td>'.$tot.'</td>';
						if (!isset($t_a)){
							$t_a='';$t_b='';$t_g='';$t_h='';$t_i='';$t_l='';$t_s='';$t_t='';$t_v='';
						}
						echo '<td>'.$t_a.'</td>';
						echo '<td>'.$t_b.'</td>';
						echo '<td>'.$t_g.'</td>';
						echo '<td>'.$t_h.'</td>';
						echo '<td>'.$t_i.'</td>';
						echo '<td>'.$t_l.'</td>';  
						echo '<td>'.$t_s.'</td>';  
						echo '<td>'.$t_t.'</td>';   
						echo '<td>'.$t_v.'</td>';  
					echo '</tr>';
				}	
			}
		
		echo '</table>';
	?>


</div>
