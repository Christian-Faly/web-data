<div id="div_tb_ainserer">
	<?php
		echo '<table bgcolor="#FFFFFF">'."\n";
		
		// ============================ tableau ==================================
		$haut="SELECT SUM(a08) as a2008,SUM(a09) as a2009, SUM(a10) as a2010,SUM(a11) as a2011,SUM(a12) as a2012,SUM(a13) as a2013,SUM(a14) as a2014,SUM(a15) as a2015,
			SUM(a16) as a2016,SUM(a17) as a2017,SUM(a18) as a2018,SUM(a19) as a2019, SUM(a20) as a2020,SUM(a21) as a2021
			FROM 
			(SELECT DISTINCT id,
			CASE WHEN (date_part('year', daty )=2008) THEN valeur ELSE 0 END as a08,CASE WHEN (date_part('year', daty )=2009) THEN valeur ELSE 0 END as a09, 
			CASE WHEN (date_part('year', daty )=2010) THEN valeur ELSE 0 END as a10,CASE WHEN (date_part('year', daty )=2011) THEN valeur ELSE 0 END as a11, 
			CASE WHEN (date_part('year', daty )=2012) THEN valeur ELSE 0 END as a12,CASE WHEN (date_part('year', daty )=2013) THEN valeur ELSE 0 END as a13, 
			CASE WHEN (date_part('year', daty )=2014) THEN valeur ELSE 0 END as a14,CASE WHEN (date_part('year', daty )=2015) THEN valeur ELSE 0 END as a15, 
			CASE WHEN (date_part('year', daty )=2016) THEN valeur ELSE 0 END as a16,CASE WHEN (date_part('year', daty )=2017) THEN valeur ELSE 0 END as a17, 
			CASE WHEN (date_part('year', daty )=2018) THEN valeur ELSE 0 END as a18,CASE WHEN (date_part('year', daty )=2019) THEN valeur ELSE 0 END as a19, 
			CASE WHEN (date_part('year', daty )=2020) THEN valeur ELSE 0 END as a20,CASE WHEN (date_part('year', daty )=2021) THEN valeur ELSE 0 END as a21"; 
		
		$haut_tot="SELECT SUM(t) as total 
				FROM ( 
				SELECT DISTINCT id, 
				valeur t";
		$val_Region1 = "0";  
		if (isset($val_Region)){
			$val_Region1 = $val_Region;
		}
		
		if ($val_Region1==0){
			$haut=$haut." FROM (";
			$haut_tot=$haut_tot." FROM (";
			$bas =" ) as a) as b";    
		}else{
			$haut=$haut.",nregion FROM (" ;
			$haut_tot=$haut_tot.",nregion FROM (" ;
			$bas =") as a) as b WHERE (nregion=".$val_Region1.")";
		}
		
		$offset=($page-1)*$nbparpage;
		$resultat = $this->db->query($sql." limit ".($nbparpage +1 )." OFFSET ".$offset);
		
		if (!$resultat) {
			die('Échec de la requête : ' . $this->db->_error_message());
		}
		echo "<div id='pagination'>";
			$nb_page=$nb_enr/$nbparpage;
				for ($i = 1; $i <= $nb_page ; $i++) {
					echo "<span id='num_page'><a href='#'>".$i."</a></span>";
				}
				if (round($nb_page)*$nbparpage<$nb_enr) 
					echo "<span style='border:5px;border-color:red' id='nb_enr'><a href='#'>".$i."</a></span>";
		echo "</div>";
		$col_span=7;
		echo '<div style="overflow-x:auto;">';
								//
		echo '<table border="1" class="table table-hover" width="100%">'."\n";//style="table-layout:fixed;" bgcolor="#FFFFFF"
		//echo '<table class="table table-hover"style="table-layout:fixed;" bgcolor="#FFFFFF" border="1">'."\n";// 
				$col_span=20;
				echo '<tr bgcolor="#FFCC00">';
					echo '<th width="54" scope="col" >ID</th>';
					echo '<th width="1000" scope="col">Indicateur</th>';
					echo '<th width="36" scope="col">Unit&eacute;</th>';
			
					echo '<th width="87" scope="col">Valeur cible </th>';
					echo '<th width="87" scope="col">R&eacute;alisation global </th>';
					echo '<th width="87" scope="col">Taux global </th>';
					echo '<th width="40" scope="col">2008</th>';
					echo '<th width="40" scope="col">2009</th>';
					echo '<th width="40" scope="col">2010</th>';
					echo '<th width="40" scope="col">2011</th>';
					echo '<th width="40" scope="col">2012</th>';
					echo '<th width="86" scope="col">2013</th>';
					echo '<th width="40" scope="col">2014</th>';
					echo '<th width="40" scope="col">2015</th>';
					echo '<th width="40" scope="col">2016</th>';
					echo '<th width="40" scope="col">2017</th>';
					echo '<th width="89" scope="col">2018</th>';
					echo '<th width="40" scope="col">2019</th>';
					echo '<th width="40" scope="col">2020</th>';
					echo '<th width="40" scope="col">2021</th>';
					echo '<th width="40" scope="col"></th>';
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
							$t08=$ligne["a2008"];  
							$t09=$ligne["a2009"];     
							$t10=$ligne["a2010"];     
							$t11=$ligne["a2011"];
							$t12=$ligne["a2012"];  
							$t13=$ligne["a2013"];     
							$t14=$ligne["a2014"];     
							$t15=$ligne["a2015"];
							$t16=$ligne["a2016"];  
							$t17=$ligne["a2017"];     
							$t18=$ligne["a2018"];     
							$t19=$ligne["a2019"];
							$t20=$ligne["a2020"];  
							$t21=$ligne["a2021"];     
							$t22=$ligne["a2021"];     
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
						if (!isset($t08)){
							$t08='';$t09='';$t10='';$t11='';$t12='';$t13='';$t14='';$t15='';$t16='';$t17='';$t18=''; $t19='';$t20='';$t21='';$t22='';
						}
						echo '<td>'.$t08.'</td>';
						echo '<td>'.$t09.'</td>';
						echo '<td>'.$t10.'</td>';
						echo '<td>'.$t11.'</td>';
						echo '<td>'.$t12.'</td>';
						echo '<td>'.$t13.'</td>';  
						echo '<td>'.$t14.'</td>';  
						echo '<td>'.$t15.'</td>';   
						echo '<td>'.$t16.'</td>';  
						echo '<td>'.$t17.'</td>'; 
						echo '<td>'.$t18.'</td>';  
						echo '<td>'.$t19.'</td>';
						echo '<td>'.$t20.'</td>';
						echo '<td>'.$t21.'</td>';
						echo '<td>'.$t22.'</td>';
					echo '</tr>';
				}	
			}
		
		echo '</table>';
		echo '</div>'; 
		
		//echo $sql1;
		
		$data = array(
			"name" => "tb",
			"id" => "tb",
			"value" => $tb,
			"type"   => "hidden",
		);
		
	?>


</div>
