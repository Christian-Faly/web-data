<div id="div_tb_ainserer">
	<?php
		// ================ Année =====================
		$y=Date("Y");
		//echo $sql;
		$val_Annee1 = $y;  
		if (isset($val_Annee)){
			$val_Annee1 = $val_Annee;
		}
		echo '</tr>'."\n";

		$this->load->model("get_db");
		$options = array();
		$res  = $this->db->query("SELECT * FROM pa_Region");
		if (false === $res) {
			echo $this->db->_error_message()."<br>";
		}else{
			foreach ($res->result_array() as $ro){
				$options[$ro["code"]]= $ro["nom"];
			}
		}
		$val_Region1 = "0";  
		if (isset($val_Region)){
			$val_Region1 = $val_Region;
		}
		
		echo '<br>'; echo '<br>';
		
		// ============================ tableau ==================================
		$critereRegion=" ";
		if ($val_Region1>0){
			$critereRegion="AND(nregion=".$val_Region1.")";
		}
		
		echo '<br>';

		$haut="SELECT SUM(t1) as trim1,SUM(t2) as trim2,SUM(t3) as trim3,SUM(t4) as trim4 
				FROM ( 
				SELECT DISTINCT id, 
				CASE WHEN (date_part('month', daty )<4) AND (date_part('year',daty )=".$val_Annee1.") THEN valeur ELSE 0 END as t1, 
				CASE WHEN date_part('month',daty )>3 and date_part('month',daty )<7 AND (date_part('year',daty )=".$val_Annee1.") THEN valeur ELSE 0 END as t2, 
				CASE WHEN date_part('month',daty )>6 and date_part('month',daty )<10 AND (date_part('year',daty )=".$val_Annee1.") THEN valeur ELSE 0 END as t3, 
				CASE WHEN date_part('month',daty )>9 AND (date_part('year',daty )=".$val_Annee1.") THEN valeur ELSE 0 END as t4";
		
		$haut_tot="SELECT SUM(t) as total 
				FROM ( 
				SELECT DISTINCT id, 
				CASE WHEN date_part('year',daty )=".$val_Annee1." then valeur else 0 end AS t";
		
		if ($val_Region1==0)
			$critere_region="";
		else
			$critere_region=" WHERE (nregion=".$val_Region1.")";
	   
	   if ($val_Annee1==0)
			$critere_annee="";
		else
			$critere_annee=" WHERE date_part('Y',daty)=".$val_Annee1;
	   
	   	$haut=$haut.",nregion FROM (" ;
		$haut_tot=$haut_tot.",nregion FROM (" ;
		$bas =") as a ".$critere_annee.") as b ".$critere_region;
		
	   
	   /*if ($val_Region1==0){
			$haut=$haut." FROM (";
			$haut_tot=$haut_tot." FROM (";
			$bas =" ) as a) as b";    
		}else{
			$haut=$haut.",nregion FROM (" ;
			$haut_tot=$haut_tot.",nregion FROM (" ;
			$bas =") as a) as b WHERE (nregion=".$val_Region1.")";
		}*/
	   
	   
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
			//if ($classe=='tb'){
				$col_span=20;
				echo '<tr bgcolor="#FFCC00">';
					echo '<th colspan="3" align="center" width="54" scope="col" >Indicateur</th>';
					echo '<th colspan="3" align="center" width="87" scope="col">Valeur global</th>';
					echo '<th colspan="5" align="center" width="40" scope="col">Pr&eacute;vision</th>';
					echo '<th colspan="5" align="center" width="86" scope="col">R&eacute;ali-sation</th>';
					echo '<th colspan="5" align="center" width="89" scope="col">Taux </th>';
				echo '</tr>';
			//}	
				echo '<tr bgcolor="#FFCC00">';
					echo '<th width="54" scope="col" >ID</th>';
					echo '<th width="1000" scope="col">Description</th>';
					echo '<th width="36" scope="col">Unit&eacute;</th>';
			
			//if ($classe=='tb'){
					echo '<th width="87" scope="col">Valeur cible </th>';
					echo '<th width="87" scope="col">R&eacute;alisation global </th>';
					echo '<th width="87" scope="col">Taux global </th>';
					echo '<th width="40" scope="col">Pr&eacute;vu</th>';
					echo '<th width="40" scope="col">1er Trim</th>';
					echo '<th width="40" scope="col">2eme Trim </th>';
					echo '<th width="40" scope="col">3eme Trim</th>';
					echo '<th width="40" scope="col">4eme Trim </th>';
			//}
					echo '<th width="86" scope="col">R&eacute;ali-sation</th>';
					echo '<th width="40" scope="col">1er Trim</th>';
					echo '<th width="40" scope="col">2eme Trim </th>';
					echo '<th width="40" scope="col">3eme Trim</th>';
					echo '<th width="40" scope="col">4eme Trim </th>';

			//if ($classe=='tb'){
					echo '<th width="89" scope="col">Taux </th>';
					echo '<th width="40" scope="col">1er Trim</th>';
					echo '<th width="40" scope="col">2eme Trim </th>';
					echo '<th width="40" scope="col">3eme Trim</th>';
					echo '<th width="40" scope="col">4eme Trim </th>';
			//}
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
							$t1=$ligne["trim1"];  
							$t2=$ligne["trim2"];     
							$t3=$ligne["trim3"];     
							$t4=$ligne["trim4"];
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
					
					if ($val_Region1==0){
						$sql2="select SUM(trim1) as pt1,SUM(trim2) as pt2,SUM(trim3) as pt3, SUM(trim4) as pt4 ,SUM(trim1+trim2+trim3+trim4) as pa 
						from tb_prevision_a1d
						where gid_indicateur=".$row['id'];
					}else{
						$sql2="select trim1 as pt1,trim2 as pt2,trim3 as pt3, trim4 as pt4 ,trim1+trim2+trim3+trim4 as pa 
						from tb_prevision_a1d
						where gid_indicateur=".$row['id']." and nregion=".$val_Annee1;
					}
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
					echo '</td>';
				
					echo '<td>'.$row["indicateur"].'</td>';
					echo '<td>'.$row["unite"].'</td>';
					//if ($classe=='tb'){
						echo '<td>'.$row["rpe"].'</td>';
						echo '<td> </td>';
						echo '<td></td>';
						echo '<td>'.$pa.'</td>';    // '$r["prevision_annee"].'
						echo '<td>'.$pt1.'</td>';
						echo '<td>'.$pt2.'</td>';
						echo '<td>'.$pt3.'</td>';
						echo '<td>'.$pt4.'</td>';
					//}
					echo '<td>'.$tot.'</td>';     //'.$r["realisation_annee"].'
					echo '<td>'.$t1.'</td>';    //'.$r["trim1"].'
					echo '<td>'.$t2.'</td>';    //'.$r["trim2"].'
					echo '<td>'.$t3.'</td>';    //'.$r["trim3"].'
					echo '<td>'.$t4.'</td>';    //'.$r["trim4"].'
					
					//if ($classe=='tb'){
						echo '<td>????</td>';     //'.$r["PourcRPE"].'
						echo '<td> </td>';
						echo '<td></td>';
						echo '<td></td>';
						echo '<td></td>';
					//}	
					echo '</tr>';
				}	
			}
		
		echo '</table>';
	?>
</div>
