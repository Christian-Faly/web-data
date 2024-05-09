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
					echo "<span id='num_page_".$i."'><a href='#'>".$i."</a></span>";
				}
				if (round($nb_page)*$nbparpage<$nb_enr)
					echo "<span style='border:5px;border-color:red' id='nb_enr'><a href='#'>".$i."</a></span>";
		echo "</div>";
		$col_span=7;
		echo "<br/>";
		echo "<br/>";
		echo '<div id="tableau_bord" style="width:100%;overflow-x:auto;">';
		echo '</div>';

		echo '<div style="width:100%;overflow-x:auto;">';


		//echo '<table id="example" class="display" style="width:100%">';
        	//echo '<thead>';
        	//echo '<tr>';
        	//echo '<th>Name</th>';
       		//echo '<th>Position</th>';
        	//echo '</tr>';
        	//echo '</thead>';
        	//echo '<tbody>';
        	//echo '<tr>';
        	//echo '<td>Tiger Nixon</td>';
        	//echo '<td>System Architect</td>';
       		//echo '</tr>';
        	//echo '</tbody>';
        	//echo '</table>';
		
		echo '<table id="visu_tb_annuel" border="1" class="table table-hover" width="100%">'."\n";//style="table-layout:fixed;" bgcolor="#FFFFFF"
		//echo '<table class="table table-hover"style="table-layout:fixed;" bgcolor="#FFFFFF" border="1">'."\n";//
				$col_span=20;
				echo '<tr bgcolor="#FFCC00">';
					echo '<th width="54" scope="col" >ID</th>';
					echo '<th width="1000" scope="col">Indicateur</th>';
					echo '<th width="36" scope="col">Unit&eacute;</th>';

					echo '<th width="87" scope="col">Valeur cible </th>';
					echo '<th width="87" scope="col">R&eacute;alisation global </th>';
					echo '<th width="87" scope="col">Taux global </th>';
					echo '<th  hidden width="40" scope="col">sql_liste</th>';
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

					for ($i=1; $i<20; $i++) {
    					echo '<td style="display:none"></td>';
					}

					echo '</tr>';
				}
				elseif ($row['niveau']==2){
					echo '<tr bgcolor="#CD9BFF">';
					echo '<td>'.$row['niveau'].'</td>';
					echo '<td colspan="'.$col_span.'">'.$row['indicateur'].'</td>';

					 for ($i=1; $i<20; $i++) {
                                        echo '<td style="display:none"></td>';
                                        }

					echo '</tr>';
				}
				elseif ($row['niveau']==3){
					echo '<tr bgcolor="#33FFFF">';
					echo '<td>'.$row['niveau'].'</td>';
					echo '<td colspan="'.$col_span.'">'.$row['indicateur'].'</td>';

					 for ($i=1; $i<20; $i++) {
                                        echo '<td style="display:none"></td>';
                                        }

					echo '</tr>';
				}
				elseif ($row['niveau']==4){
					echo '<tr bgcolor="#B8D3FE">';
					echo '<td>'.$row['niveau'].'</td>';
					echo '<td colspan="'.$col_span.'">'.$row['indicateur'].'</td>';

					 for ($i=1; $i<20; $i++) {
                                        echo '<td style="display:none"></td>';
                                        }

					echo '</tr>';
				}
				elseif ($row['niveau']==5){
					echo '<tr bgcolor="#44D3FE">';
					echo '<td>'.$row['niveau'].'</td>';
					echo '<td colspan="'.$col_span.'">'.$row['indicateur'].'</td>';

					 for ($i=1; $i<20; $i++) {
                                        echo '<td style="display:none"></td>';
                                        }

					echo '</tr>';
				}
				else{
					$t1=NULL; $t2=NULL; $t3=NULL; $t4=NULL; $tot=NULL;
					
					if ($row["sql_web"]>""){
						$sql1= $haut." ".$row["sql_web"].$bas;
						$re = $this->db->query($sql1);
						foreach($re->result_array() as $ligne){
							$t08=$ligne["a2008"]; $t09=$ligne["a2009"]; $t10=$ligne["a2010"]; $t11=$ligne["a2011"];	$t12=$ligne["a2012"]; $t13=$ligne["a2013"];     
							$t14=$ligne["a2014"]; $t15=$ligne["a2015"];	$t16=$ligne["a2016"]; $t17=$ligne["a2017"];	$t18=$ligne["a2018"]; $t19=$ligne["a2019"];
							$t20=$ligne["a2020"]; $t21=$ligne["a2021"]; $t22=$ligne["a2021"];     
						} 
						
						$sql1_tot= $haut_tot." ".$row["sql_web"].$bas;
						$re_tot = $this->db->query($sql1_tot);
						foreach($re_tot->result_array() as $ligne_tot){
							$tot=$ligne_tot["total"];   
						} 
					}
					else{
						$t08=NULL; $t09=NULL; $t10=NULL; $t11=NULL;	$t12=NULL;	$t13=NULL;	$t14=NULL; $t15=NULL; $t16=NULL;$t17=NULL; $t18=NULL; $t19=NULL;
						$t20=NULL; $t21=NULL; $t22=NULL;     
					}
					
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

					echo '</td>';

					echo '<td>'.$row["indicateur"].'</td>';
					echo '<td>'.$row["unite"].'</td>';
						echo '<td>'.$row["rpe"].'</td>';
						echo '<td> </td>';
						echo '<td>'.$tot.'</td>';
						if (!isset($t08)){
							$t08='';$t09='';$t10='';$t11='';$t12='';$t13='';$t14='';$t15='';$t16='';$t17='';$t18=''; $t19='';$t20='';$t21='';$t22='';
						}
						echo '<td hidden>'.$row['sql_liste'].'</td>';
					
						echo '<td id="td_'.$row['id'].'_2008" alt="2008"><a href="#td_'.$row['id'].'_2008">'.$t08.'</a></td>';
						echo '<td id="td_'.$row['id'].'_2009" alt="2009"><a href="#td_'.$row['id'].'_2009">'.$t09.'</td>';
						echo '<td id="td_'.$row['id'].'_2010" alt="2010"><a href="#td_'.$row['id'].'_2010">'.$t10.'</td>';
						echo '<td id="td_'.$row['id'].'_2011" alt="2011"><a href="#td_'.$row['id'].'_2011">'.$t11.'</td>';
						echo '<td id="td_'.$row['id'].'_2012" alt="2012"><a href="#td_'.$row['id'].'_2012">'.$t12.'</td>';
						echo '<td id="td_'.$row['id'].'_2013" alt="2013"><a href="#td_'.$row['id'].'_2013">'.$t13.'</td>';  
						echo '<td id="td_'.$row['id'].'_2014" alt="2014"><a href="#td_'.$row['id'].'_2014">'.$t14.'</td>';  
						echo '<td id="td_'.$row['id'].'_2015" alt="2015"><a href="#td_'.$row['id'].'_2015">'.$t15.'</td>';   
						echo '<td id="td_'.$row['id'].'_2016" alt="2016"><a href="#td_'.$row['id'].'_2016">'.$t16.'</td>';  
						echo '<td id="td_'.$row['id'].'_2017" alt="2017"><a href="#td_'.$row['id'].'_2017">'.$t17.'</td>'; 
						echo '<td id="td_'.$row['id'].'_2018" alt="2018"><a href="#td_'.$row['id'].'_2018">'.$t18.'</td>';  
						echo '<td id="td_'.$row['id'].'_2018" alt="2019"><a href="#td_'.$row['id'].'_2019">'.$t19.'</td>';
						echo '<td id="td_'.$row['id'].'_2019" alt="2020"><a href="#td_'.$row['id'].'_2020">'.$t20.'</td>';
						echo '<td id="td_'.$row['id'].'_2020" alt="2021"><a href="#td_'.$row['id'].'_2021">'.$t21.'</td>';
						echo '<td id="td_'.$row['id'].'_2021" alt="2022"><a href="#td_'.$row['id'].'_2022">'.$t22.'</td>';
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
<!--
var sql = $("#td_8_2018").parent().children(":hidden").text();

$_POST["code_r"]="02010101"
$_POST["source"]=sqlliste
$_POST["array_para"]=a:0:{}
$_POST["textSQL"]=SELECT * FROM tb_top_up1 WHERE TRUE
$_POST["action"]=sql_liste

-->

</div>
