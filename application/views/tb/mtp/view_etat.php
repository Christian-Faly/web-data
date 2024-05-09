<div id="content">

<?php
    $this->load->helper("form");

    echo form_open("index.php/tb/pagetb");
    
    echo '<table bgcolor="#FFFFFF">'."\n";
    // ================ Année =====================
            
    echo form_hidden('tb', $tb);

    $y=Date("Y");
    
    echo '<tr>';  

    echo '<td bgcolor="#CCCCCC">'.form_label('Annee',"fullname").'</td>';
    
    $val_Annee1 = $y;  
    if (isset($val_Annee)){
        $val_Annee1 = $val_Annee;
    }
    $data = array(
        "name" => "val_Annee",
        "id" => "val_Annee",
        "value" => $val_Annee1,
        'maxlength'   => '50',
        'size'        => '25'
    );
    echo '<td bgcolor="#CCCCCC">'.form_input($data).'</td>';
            
    echo '</tr>'."\n";  
    
    echo '<tr>';  

    echo '<td bgcolor="#CCCCCC">'.form_label('Region',"fullname").'</td>';

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
    echo '<td bgcolor="#CCCCCC">'.form_dropdown("val_Region", $options, $val_Region1).'</td>';

    echo '</tr>'."\n";  
                    
    echo '<tr>';  

    echo '<td bgcolor="#CCCCCC">'.form_label('==>',"fullname").'</td>';

    $data = array(
        'name' => 'action',
        'id' => 'action',
        'value' => 'list_page1',
        'type' => 'submit',
        'content' => 'Appliquer critere'
    );
    echo '<td bgcolor="#CCCCCC">'.form_button($data).'</td>';  

    echo '</tr>'."\n";  

    echo '</table>';
    
    
    // ============================ tableau ==================================
    $critereRegion=" ";
    if ($val_Region1>0){
        $critereRegion="AND(nregion=".$val_Region1.") ";
    }
    
    if(($tb=='Budget')OR($tb=='Recap')){
        $sql = 'SELECT Annexe1d.Code,Analytique, Titre, Niveau, sum(Dcaissemen)as Dcais,sum(Engagement) as eng, sum(budget) as bud,
            round(sum(dcaissemen)*100/sum(budget)) as pourc_dec, round(sum(engagement)*100/sum(budget)) as pourc_eng
            FROM budget RIGHT JOIN Annexe1d ON budget.code = Annexe1d.analytique
            WHERE (Annee='.$val_Annee1.')'.$critereRegion."or(budget.code is null)
            GROUP BY Annexe1d.Code, Analytique, titre, Niveau
            ORDER BY LTRIM(Analytique)";
    }
    //echo $sql;
    echo form_hidden('sql', $sql);
    echo form_hidden('limit', $limit);
    //echo "page ".(round($limit/$nbparpage)+1);
    $result = $this->db->query($sql." limit ".($nbparpage +1 )." OFFSET ".$limit);
    //echo $sql." limit ".$limit." OFFSET ".($nbparpage +1 );
    if (!$result) {
        die('Échec de la requête : ' . $this->db->_error_message());
    }

    echo '<table bgcolor="#FFFFFF" border="1">'."\n";
    echo '<tr bgcolor="#FFCC00">';
    if(($tb=='Produit')OR($tb=='Activity')){
        echo '<th width="54" scope="col" >ID</th>';
        echo '<th width="1000" scope="col">Indicateur</th>';
        echo '<th width="36" scope="col">Unit&eacute;</th>';
        echo '<th width="87" scope="col">Normalis&eacute;</th>';
        echo '<th width="40" scope="col">Non Normalis&eacute;</th>';
        echo '<th width="40" scope="col">Bon</th>';
        echo '<th width="40" scope="col">Moyen</th>';
        echo '<th width="40" scope="col">Mauvais</th>';
        echo '<th width="40" scope="col">Non fonctionel</th>';
		echo '<th width="86" scope="col">R&eacute;ali-sation</th>';
        echo '<th width="89" scope="col">Cumul </th>';
    }
    if($tb=='Budget'){
        echo '<th width="54" scope="col" >Code</th>';
        echo '<th width="1000" scope="col">Indicateur</th>';
        echo '<th width="36" scope="col">D&eacute;caissement</th>';
        echo '<th width="87" scope="col">Engagement </th>';
        echo '<th width="40" scope="col">Budget</th>';
        echo '<th width="36" scope="col">%D&eacute;ai-ssementc</th>';
        echo '<th width="87" scope="col">%Enga-gement </th>';
    }
    if($tb=='Recap'){
        echo '<th width="54" scope="col" >Code</th>';
        echo '<th width="1000" scope="col">Indicateur</th>';
        echo '<th width="36" scope="col">% Produit</th>';
        echo '<th width="36" scope="col">% Activit&eacute;</th>';
        echo '<th width="36" scope="col">%D&eacute;ai-ssementc</th>';
        echo '<th width="87" scope="col">%Enga-gement </th>';
    }
    echo '</tr>';

    foreach($result->result_array() as $row){
        if($tb=='Recap'){
            $len=strlen($row['code']);
            
            $realisationProduit= "Sum(CASE WHEN Left(indicateur_a1d.Code,2)= 'PR' THEN Realisatio ELSE 0 END)"; 
            $previsionProduit=   "Sum(CASE WHEN Left(indicateur_a1d.Code,2)= 'PR' THEN Prevision  ELSE 0 END)"; 
            $realisationActivite="Sum(CASE WHEN Left(indicateur_a1d.Code,2)<>'PR' THEN 0 ELSE Realisatio END)"; 
            $previsionActivite=  "Sum(CASE WHEN Left(indicateur_a1d.Code,2)<>'PR' THEN 0 ELSE Prevision  END)"; 
            
            $sql="SELECT realisation.code, 
                CASE WHEN (".$previsionProduit.")= 0 THEN NULL ELSE Round(100*".$realisationProduit."/".$previsionProduit.") END AS Avancement_Produit,
                CASE WHEN (".$previsionProduit.")= 0 THEN NULL ELSE Round(100*".$realisationActivite."/".$previsionActivite.") END AS Avancement_Activite
                FROM indicateur_a1d INNER JOIN realisation ON indicateur_a1d.Code=realisation.code
                WHERE (LEFT(Pere,".$len.") ='".$row['code']."')AND(annee<=".$val_Annee1.")".$critereRegion."
                GROUP BY realisation.code"; 

            //echo $sql."<br>"."<br>"."<br>"."<br>";

            $resultat = $this->db->query($sql);
            $nProduit=0;
            $totalProduit=0;
            $nActivite=0;
            $totalActivite=0;
            foreach($resultat->result_array() as $r){
                if ($r["avancement_produit"]>-1){
                    $nProduit=$nProduit+1;
                    $totalProduit=$totalProduit+$r["avancement_produit"];                 
                }
                if ($r["avancement_activite"]>-1){
                    $nActivite=$nActivite+1;
                    $totalActivite=$totalActivite+$r["avancement_activite"];                 
                }
            }
            if ($nProduit==0){
                $moyenneProduit='';
            }else{
                $moyenneProduit=round($totalProduit/$nProduit);
            }
            if ($nActivite==0){
                $moyenneActivite='';
            }else{
                $moyenneActivite=round($totalActivite/$nActivite);
            }
        }


      if ($row['niveau']==1){  
        echo '<tr bgcolor="#99FF00">';
        echo '<td>'.$row["analytique"].'</td>';
        if(($tb=='Produit')OR($tb=='Activity'))
            echo '<td colspan="11">'.$row['titre'].'</td>'; 
        if($tb=='Budget'){
            echo '<td>'.$row['titre'].'</td>'; 
            echo '<td>'.$row["dcais"].'</td>';
            echo '<td>'.$row["eng"].'</td>';
            echo '<td>'.$row["bud"].'</td>';
            echo '<td>'.$row["pourc_dec"].'</td>';
            echo '<td>'.$row["pourc_eng"].'</td>';
        }
        if($tb=='Recap'){
            echo '<td>'.$row['titre'].'</td>'; 
            echo '<td>'.$moyenneProduit.'</td>';
            echo '<td>'.$moyenneActivite.'</td>';
            echo '<td>'.$row["pourc_dec"].'</td>';
            echo '<td>'.$row["pourc_eng"].'</td>';
        }
        echo '</tr>';
      }
      if ($row['niveau']==2){
        echo '<tr bgcolor="#CD9BFF">';
        echo '<td>'.$row["analytique"].'</td>';
        if(($tb=='Produit')OR($tb=='Activity'))
            echo '<td colspan="11">'.$row['titre'].'</td>'; 
        if($tb=='Budget'){
            echo '<td>'.$row['titre'].'</td>'; 
            echo '<td>'.$row["dcais"].'</td>';
            echo '<td>'.$row["eng"].'</td>';
            echo '<td>'.$row["bud"].'</td>';
            echo '<td>'.$row["pourc_dec"].'</td>';
            echo '<td>'.$row["pourc_eng"].'</td>';
        }
        if($tb=='Recap'){
            echo '<td>'.$row['titre'].'</td>'; 
            echo '<td>'.$moyenneProduit.'</td>';
            echo '<td>'.$moyenneActivite.'</td>';
            echo '<td>'.$row["pourc_dec"].'</td>';
            echo '<td>'.$row["pourc_eng"].'</td>';
        }
        echo '</tr>';
      }
      if ($row['niveau']==3){
        if(($tb=='Produit')OR($tb=='Activity')){
            echo '<tr bgcolor="#33FFFF">';
            echo '<td>'.$row["analytique"].'</td>';
            echo '<td colspan="11">'.$row['titre'].'</td>';
        } 
        if($tb=='Budget'){
            echo '<tr>';//bgcolor="#33FFFF">
            echo '<td>'.$row["analytique"].'</td>';
            echo '<td>'.$row['titre'].'</td>'; 
            echo '<td>'.$row["dcais"].'</td>';
            echo '<td>'.$row["eng"].'</td>';
            echo '<td>'.$row["bud"].'</td>';
            echo '<td>'.$row["pourc_dec"].'</td>';
            echo '<td>'.$row["pourc_eng"].'</td>';
        }
        if($tb=='Recap'){
            echo '<td>'.$row["analytique"].'</td>';
            echo '<td>'.$row['titre'].'</td>'; 
            echo '<td>'.$moyenneProduit.'</td>';
            echo '<td>'.$moyenneActivite.'</td>';
            echo '<td>'.$row["pourc_dec"].'</td>';
            echo '<td>'.$row["pourc_eng"].'</td>';
        }
        echo '</tr>';
      }
      if ($row['niveau']==4){
        echo '<tr bgcolor="#B8D3FE">';
        echo '<td>'.$row["analytique"].'</td>';
        if(($tb=='Produit')OR($tb=='Activity'))
            echo '<td colspan="11">'.$row['titre'].'</td>'; 
        if($tb=='Budget'){
            echo '<td>'.$row['titre'].'</td>'; 
            echo '<td>'.$row["dcais"].'</td>';
            echo '<td>'.$row["eng"].'</td>';
            echo '<td>'.$row["bud"].'</td>';
            echo '<td>'.$row["pourc_dec"].'</td>';
            echo '<td>'.$row["pourc_eng"].'</td>';
        }
        if($tb=='Recap'){
            echo '<td>'.$row['titre'].'</td>'; 
            echo '<td>'.$moyenneProduit.'</td>';
            echo '<td>'.$moyenneActivite.'</td>';
            echo '<td>'.$row["pourc_dec"].'</td>';
            echo '<td>'.$row["pourc_eng"].'</td>';
        }
        echo '</tr>';
      }
      
      if(($tb=='Produit')OR($tb=='Activity')){
        $sql="SELECT indicateur_a1d.Code,indicateur_a1d.Indicateur,indicateur_a1d.Unite,indicateur_a1d.RPE,
            SUM(CASE WHEN (Trimestre='Trim1')AND(Annee=".$val_Annee1.") THEN realisatio ELSE 0.0 END) as trim1,
            SUM(CASE WHEN (Trimestre='Trim2')AND(Annee=".$val_Annee1.") THEN realisatio ELSE 1 END) as trim2,
            SUM(CASE WHEN (Trimestre='Trim3')AND(Annee=".$val_Annee1.") THEN realisatio ELSE 0 END) as trim3,
            SUM(CASE WHEN (Trimestre='Trim4')AND(Annee=".$val_Annee1.") THEN realisatio ELSE 0 END) as trim4,
            SUM(CASE WHEN Annee=".$val_Annee1." THEN prevision ELSE 0 END) as Prevision_Annee,
            SUM(CASE WHEN Annee=".$val_Annee1." THEN realisatio ELSE 0 END) as Realisation_Annee,
            SUM(realisatio) as Cumul
            FROM indicateur_a1d INNER JOIN realisation ON indicateur_a1d.Code=realisation.code
            WHERE (Pere ='".$row['code']."')AND(annee<=".$val_Annee1.")".$critereRegion." 
            GROUP BY indicateur_a1d.ID,indicateur_a1d.Indicateur,indicateur_a1d.Unite,indicateur_a1d.RPE,indicateur_a1d.Code";

        $resultat = $this->db->query($sql);
        //echo $sql;
        foreach($resultat->result_array() as $r){
            echo '<tr>';
            echo '<td>'.$r["code"].'</td>';
            echo '<td>'.$r["indicateur"].'</td>';
            echo '<td>'.$r["unite"].'</td>';
            echo '<td>'.$r["rpe"].'</td>';
            echo '<td>'.$r["prevision_annee"].'</td>';    // '.$r["Prevu"].'
            echo '<td>'.$r["trim1"].'</td>';    //'.$r["Realise"].'
            echo '<td>'.$r["trim2"].'</td>';     //'.$r["TauxRealisation"].'
            echo '<td>'.$r["trim3"].'</td>';     //'.$r["Observations"].'
            echo '<td>'.$r["trim4"].'</td>';     //'.$r["CumulRealisation"].'
            echo '<td>'.$r["realisation_annee"].'</td>';     //'.$r["PourcRPE"].'
            echo '<td>'.$r["cumul"].'</td>';     //'.$r["ObservationGlobale"].'
            echo '</tr>'; 
        }
      }
    } 
    echo '</table>';
    
    $data = array(
        'name' => 'action',
        'id' => 'action',
        'value' => 'list_page1',
        'type' => 'submit',
        'content' => '<<'
    );
    echo form_button($data);  

    $data = array(
        'name' => 'action',
        'id' => 'action',
        'value' => 'list_pageprec',
        'type' => 'submit',
        'content' => '<'
    );
    echo form_button($data);  

    $data = array(
        'name' => 'action',
        'id' => 'action',
        'value' => 'list_pagesuiv',
        'type' => 'submit',
        'content' => '>'
    );
    echo form_button($data);  

    $data = array(
        'name' => 'action',
        'id' => 'action',
        'value' => 'list_pagedern',
        'type' => 'submit',
        'content' => '>>'
    );
    echo form_button($data);
    
    echo form_close();  
 
?>
</div>