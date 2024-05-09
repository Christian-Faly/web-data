<div id="" style="width:100%;float:right">
	<table id="" class="flatTable">
		<tbody id="">
			<tr class="titleTr">
				<td style="text-align:left;font-family:Calibri;">> LISTE DES CARTES</td>
			</tr>
			<tr class="headingTr">
				<td colspan="3" id="" style="text-align:left;width:50%;"></td>
			</tr>
		</tbody>
	</table>
	<div style="">
		<div id="" name="nom_req" size="5" style="margin-bottom:10px;border:1px solid #C7E2F1;width:100%;float:left">
	<?php

    // R�cup�ration des variables POST
    foreach($_POST as $key => $val) echo '$_POST["'.$key.'"]='.$val.'<br>'; 
	    if ($_POST["id_requete"]=9){
        
		if($_POST["unite_geo"]=5){
			echo '1';
			$sql_maj='drop table if exists w_recensement';
			$this->db->query($sql_maj);
			echo '2';
			$sql_maj='create table w_recensement as select * FROM w_recensement1';
			$this->db->query($sql_maj); 
            echo '3';
			$sql_maj='SELECT ADDGeometryColumn(\'w_recensement\',\'the_geom\',4326,\'POINT\',2)';
			$this->db->query($sql_maj);
			echo '4';
			$sql_maj='UPDATE w_recensement
                      SET the_geom = st_setSRID(st_MakePoint(longit,latit),4326)
                      WHERE (longit > 0 and longit > 0)';
			$this->db->query($sql_maj);
		    echo '5';
		}
		if($_POST["unite_geo"]=2){
			$sql_maj='drop table if exists w_recensementdis';
			$this->db->query($sql_maj);
			$sql_maj='create table w_recensementdis as 
			        SELECT district.designationdis, region.designationreg,recensement.idreg, recensement.iddis, count(numfiiche_rec) nombre_etab
                    FROM recensement
					JOIN region ON recensement.idreg = region.idreg
					JOIN district ON recensement.iddis = district.iddis
					GROUP BY recensement.idreg,recensement.iddis,district.designationdis,region.designationreg';
			$this->db->query($sql_maj); 
		}	
		if($_POST["unite_geo"]=1){
			$sql_maj='drop table if exists w_recensementreg';
			$this->db->query($sql_maj);
			$sql_maj='create table w_recensementreg as 
					SELECT region.designationreg,recensement.idreg,count(numfiiche_rec) nombre_etab
                    FROM recensement
                    JOIN region ON recensement.idreg = region.idreg
                    GROUP BY recensement.idreg, region.designationreg';
			$this->db->query($sql_maj); 
		}	
	}
    //http://41.74.23.74:8081/
    $prelien='http://localhost/index.php/view/map/?repository=formaprod&project=';
    //$prelien='http://localhost:8080/index.php/view/map/?repository=montpellier&project=';
    if (isset($vpost)){
        $valeur= 0;
        $localiser='Madagascar';
        if ($vpost["val_reg"]!=0){
           $valeur= $vpost["val_reg"];
           $localiser='Region';
        }else
        if ($vpost["val_dis"]!=0){
           $valeur= $vpost["val_dis"];
           $localiser='District'; 
        }else
        if ($vpost["val_com"]!=0){
           $valeur= $vpost["val_com"];
           $localiser='Commune';
        }else
        if ($vpost["val_fok"]!=0){
           $valeur= $vpost["val_fok"];
           $localiser='Fokontany';
        }

        //=========================== Filtrer ==============================
        $query = $this->db->query('select sql1,sql_r,sql_d,sql_c,sql_f from arbre where id='.$_POST["id_requete"]);
        foreach ($query->result() as $row){
            $sql1= $row->sql1;
            $sql_r= $row->sql_r;
            $sql_d= $row->sql_d;
            $sql_c= $row->sql_c;
            $sql_f= $row->sql_f;
        }
        
        //echo $sql1.'<br>';
        //echo $sql_r.'<br>';
        //echo $sql_d.'<br>';
        //echo $sql_c.'<br>';
        //echo $sql_f.'<br>';
        
        $sql='';
        if (($_POST["id_requete"]==130)or($_POST["id_requete"]==131)){
           $localiser='Madagascar'; 
        } 
        if ($localiser=='Madagascar'){
            // echo 1;
            $drop_c_reg = 'drop table if exists c_regions';
            $sql_c_reg = 'create table c_regions  as select * from c_regions1';//$this->db->query( 

            $drop_c_dis = 'drop table if exists c_districts';
            $sql_c_dis = 'create table c_districts  as select * from c_districts1';//$this->db->query( 

            $drop_c_com = 'drop table if exists c_communes';
            $sql_c_com = 'create table c_communes  as select * from c_communes1';//$this->db->query( 

            $drop_c_fok = 'drop table if exists c_fokontany';
            $sql_c_fok = 'create table c_fokontany  as select * from c_fokontany1';//$this->db->query( 

            switch ($_POST["unite_geo"]){
                case 1: $drop = 'drop table if exists '.substr($sql_r,0,strlen($sql_r)-1);
                       $sql='create table '.substr($sql_r,0,strlen($sql_r)-1).' as select * from '.$sql_r;//$this->db->query( 
                break;
                case 2: $drop = 'drop table if exists '.substr($sql_d,0,strlen($sql_d)-1);
                       $sql  = 'create table '.substr($sql_d,0,strlen($sql_d)-1).' as select * from '.$sql_d;//$this->db->query( 
                break; 
                case 3: $drop = 'drop table if exists '.substr($sql_c,0,strlen($sql_c)-1);
                        $sql='create table '.substr($sql_c,0,strlen($sql_c)-1).' as select * from '.$sql_c;////$this->db->query( 
                break;
                case 4: $drop = 'drop table if exists '.substr($sql_f,0,strlen($sql_f)-1);  
                        $sql='create table '.substr($sql_f,0,strlen($sql_f)-1).' as select * from '.$sql_f;//$this->db->query( 
                break;
                case 5: $drop = 'drop table if exists '.substr($sql1,0,strlen($sql1)-1);  
                        $sql='create table '.substr($sql1,0,strlen($sql1)-1).' as select * from '.$sql1;//$this->db->query( 
                break;
           } 
        }  
        if ($localiser=='Region'){
            $drop_c_reg = 'drop table if exists c_regions';
            $sql_c_reg = 'create table c_regions  as select * from c_regions1 '.' where idreg='.$_POST["val_reg"];//$this->db->query( 

            $drop_c_dis = 'drop table if exists c_districts';
            $sql_c_dis = 'create table c_districts  as select * from c_districts1 '.' where idreg='.$_POST["val_reg"];//$this->db->query( 

            $drop_c_com = 'drop table if exists c_communes';
            $sql_c_com = 'create table c_communes  as select * from c_communes1'.' where idreg='.$_POST["val_reg"];//$this->db->query( 

            $drop_c_fok = 'drop table if exists c_fokontany';
            $sql_c_fok = 'create table c_fokontany  as select * from c_fokontany1'.' where idreg='.$_POST["val_reg"];//$this->db->query( 

           switch ($_POST["unite_geo"]){
               case 1: $drop = 'drop table if exists '.substr($sql_r,0,strlen($sql_r)-1);  
                        $sql='create table '.substr($sql_r,0,strlen($sql_r)-1).' as select * from '.$sql_r.' where idreg='.$_POST["val_reg"];//$this->db->query( 
                        break;
               case 2:  $drop = 'drop table if exists '.substr($sql_d,0,strlen($sql_d)-1);  
                        $sql='create table '.substr($sql_d,0,strlen($sql_d)-1).' as select * from '.$sql_d.' where idreg='.$_POST["val_reg"];//$this->db->query( 
                        break;
               case 3:  $drop = 'drop table if exists '.substr($sql_c,0,strlen($sql_c)-1);  
                        $sql='create table '.substr($sql_c,0,strlen($sql_c)-1).' as select * from '.$sql_c.' where idreg='.$_POST["val_reg"];////$this->db->query( 
                        break;
               case 4:  $drop = 'drop table if exists '.substr($sql_f,0,strlen($sql_f)-1);  
                        $sql='create table '.substr($sql_f,0,strlen($sql_f)-1).' as select * from '.$sql_f.' where idreg='.$_POST["val_reg"];//$this->db->query( 
                        break;
               case 5:  $drop = 'drop table if exists '.substr($sql1,0,strlen($sql1)-1);  
                        $sql='create table '.substr($sql1,0,strlen($sql1)-1).' as select * from '.$sql1.' where idreg='.$_POST["val_reg"];//$this->db->query( 
                        break;
           } 
           
        };
        if ($localiser=='District'){

            $drop_c_reg = 'drop table if exists c_regions';
            $sql_c_reg = 'create table c_regions  as select * from c_regions1 '.' where idreg='.$_POST["val_reg"];//$this->db->query( 

            $drop_c_dis = 'drop table if exists c_districts';
            $sql_c_dis = 'create table c_districts  as select * from c_districts1'.' where iddis='.$_POST["val_dis"];//$this->db->query( 

            $drop_c_com = 'drop table if exists c_communes';
            $sql_c_com = 'create table c_Communes  as select * from c_communes1'.' where iddis='.$_POST["val_dis"];//$this->db->query( 

            $drop_c_fok = 'drop table if exists c_fokontany';
            $sql_c_fok = 'create table c_fokontany  as select * from c_fokontany1'.' where iddis='.$_POST["val_dis"];//$this->db->query( 

           switch ($_POST["unite_geo"]){
               case 1:  $drop = 'drop table if exists '.substr($sql_r,0,strlen($sql_r)-1);
                        $sql='create table '.substr($sql_r,0,strlen($sql_r)-1).' as select * from '.$sql_r.' where iddis='.$_POST["val_dis"];//$this->db->query( 
                break;
               case 2:  $drop = 'drop table if exists '.substr($sql_d,0,strlen($sql_d)-1);  
                        $sql='create table '.substr($sql_d,0,strlen($sql_d)-1).' as select * from '.$sql_d.' where iddis='.$_POST["val_dis"];//$this->db->query( 
                break;
               case 3:  $drop = 'drop table if exists '.substr($sql_c,0,strlen($sql_c)-1);  
                        $sql='create table '.substr($sql_c,0,strlen($sql_c)-1).' as select * from '.$sql_c.' where iddis='.$_POST["val_dis"];////$this->db->query( 
                break;
               case 4:  $drop = 'drop table if exists '.substr($sql_f,0,strlen($sql_f)-1);  
                        $sql='create table '.substr($sql_f,0,strlen($sql_f)-1).' as select * from '.$sql_f.' where iddis='.$_POST["val_dis"];//$this->db->query( 
                break;
               case 5:  $drop = 'drop table if exists '.substr($sql1,0,strlen($sql1)-1);  
                        $sql='create table '.substr($sql1,0,strlen($sql1)-1).' as select * from '.$sql1.' where iddis='.$_POST["val_dis"];//$this->db->query( 
                break;
           } 
            
        }; 
        if ($localiser=='Commune'){

            $drop_c_reg = 'drop table if exists c_regions';
            $sql_c_reg = 'create table c_regions  as select * from c_regions1 '.' where idreg='.$_POST["val_reg"];//$this->db->query( 

            $drop_c_dis = 'drop table if exists c_districts';
            $sql_c_dis = 'create table c_districts  as select * from c_districts1'.' where iddis='.$_POST["val_dis"];//$this->db->query( 

            $drop_c_com = 'drop table if exists c_communes';
            $sql_c_com = 'create table c_communes  as select * from c_communes1'.' where idcom='.$_POST["val_com"];//$this->db->query( 

            $drop_c_fok = 'drop table if exists c_fokontany';
            $sql_c_fok = 'create table c_fokontany  as select * from c_fokontany1'.' where idcom='.$_POST["val_com"];//$this->db->query( 

           switch ($_POST["unite_geo"]){
               case 1:  $drop = 'drop table if exists '.substr($sql_r,0,strlen($sql_)-1);  
                        $sql='create table '.substr($sql_r,0,strlen($sql_r)-1).' as select * from '.$sql_r.' where idcom='.$_POST["val_com"];//$this->db->query( 
                break;
               case 2:  $drop = 'drop table if exists '.substr($sql_d,0,strlen($sql_d)-1);  
                        $sql='create table '.substr($sql_d,0,strlen($sql_d)-1).' as select * from '.$sql_d.' where idcom='.$_POST["val_com"];//$this->db->query( 
                break;
               case 3:  $drop = 'drop table if exists '.substr($sql_c,0,strlen($sql_c)-1);  
                        $sql='create table '.substr($sql_c,0,strlen($sql_c)-1).' as select * from '.$sql_c.' where idcom='.$_POST["val_com"];////$this->db->query( 
                break;
               case 4:  $drop = 'drop table if exists '.substr($sql_f,0,strlen($sql_f)-1);  
                        $sql='create table '.substr($sql_f,0,strlen($sql_f)-1).' as select * from '.$sql_f.' where idcom='.$_POST["val_com"];//$this->db->query( 
                break;
               case 5:  $drop = 'drop table if exists '.substr($sql1,0,strlen($sql1)-1);  
                        $sql='create table '.substr($sql1,0,strlen($sql1)-1).' as select * from '.$sql1.' where idcom='.$_POST["val_com"];//$this->db->query( 
                break;
           } 
        };
        if ($localiser=='Fokontany'){

            $drop_c_reg = 'drop table if exists c_regions';
            $sql_c_reg = 'create table c_regions  as select * from c_regions1 '.' where idreg='.$_POST["val_reg"];//$this->db->query( 

            $drop_c_dis = 'drop table if exists c_districts';
            $sql_c_dis = 'create table c_districts  as select * from c_districts1'.' where iddis='.$_POST["val_dis"];//$this->db->query( 

            $drop_c_com = 'drop table if exists c_communes';
            $sql_c_com = 'create table c_communes  as select * from c_communes1'.' where idcom='.$_POST["val_com"];//$this->db->query( 

            $drop_c_fok = 'drop table if exists c_fonkontany';
            $sql_c_fok = 'create table c_fokontany  as select * from c_fokontany1'.' where idfok='.$_POST["val_fok"];//$this->db->query( 

           switch ($_POST["unite_geo"]){
               case 1:  $drop = 'drop table if exists '.substr($sql_r,0,strlen($sql_r)-1);  
                        $sql='create table '.substr($sql_r,0,strlen($sql_r)-1).' as select * from '.$sql_r.' where idfok='.$_POST["val_fok"];//$this->db->query( 
                break;
               case 2:  $drop = 'drop table if exists '.substr($sql_d,0,strlen($sql_d)-1);  
                        $sql='create or replace '.substr($sql_d,0,strlen($sql_d)-1).' as select * from '.$sql_d.' where idfok='.$_POST["val_fok"];//$this->db->query( 
                break;
               case 3:  $drop = 'drop table if exists '.substr($sql_c,0,strlen($sql_c)-1);  
                        $sql='create table '.substr($sql_c,0,strlen($sql_c)-1).' as select * from '.$sql_c.' where idfok='.$_POST["val_fok"];////$this->db->query( 
                break;
               case 4:  $drop = 'drop table if exists '.substr($sql_f,0,strlen($sql_f)-1);  
                        $sql='create table '.substr($sql_f,0,strlen($sql_f)-1).' as select * from '.$sql_f.' where idfok='.$_POST["val_fok"];//$this->db->query( 
                break;
               case 5:  $drop = 'drop table if exists '.substr($sql1,0,strlen($sql1)-1);  
                        $sql='create table '.substr($sql1,0,strlen($sql1)-1).' as select * from '.$sql1.' where idfok='.$_POST["val_fok"];//$this->db->query( 
                break;
           } 
        };
        
            
        //echo '$drop_c_reg : '.$drop_c_reg.'<br>';
        //$this->db->query($drop_c_reg);  
        //echo '$sql_c_reg : '.$sql_c_reg.'<br>'; 
        //$this->db->query($sql_c_reg);  

        //echo '$drop_c_dis : '.$drop_c_dis.'<br>';
        //$this->db->query($drop_c_dis);  
        //echo '$sql_c_dis : '.$sql_c_dis.'<br>' ;
        //$this->db->query($sql_c_dis);  

        //echo '$drop_c_com : '.$drop_c_com.'<br>';
        //$this->db->query($drop_c_com);  
        //echo '$sql_c_com : '.$sql_c_com.'<br>' ;
        //$this->db->query($sql_c_com);  

        //echo '$drop_c_fok :'.$drop_c_fok.'<br>';
        //$this->db->query($drop_c_fok);  
        //echo '$sql_c_fok : '.$sql_c_fok.'<br>';
        //$this->db->query($sql_c_fok);
            
        if (($_POST["id_requete"]!=130)and($_POST["id_requete"]!=131)){ 
            //echo 'drop : '.$drop.'<br>';
            //$this->db->query($drop);  
            //echo 'SQL : '.$sql.'<br><br>';
            //$this->db->query($sql); 
        } 
        //=========================== lien ==============================
        foreach($lien_carte as $nom => $fichier){  
            echo '<a  href="'.$prelien.$fichier.'">-->'.$nom.'</a><br>';                                                                                  
        }            
        //=========================== deplacer ==============================
        $fichier=$fichier.".qgs.cfg";
        //echo  $fichier;
        //echo 'localiser:'.$localiser.'<br>valeur:'.$valeur.'<br>fichier:'.$fichier;
        //$actuel=$model_manip_fichier->initilExtent($localiser,$valeur,$fichier);
    }
    
    if (isset($loc)){
        //echo $loc;
        $fichier="limites_fokontany.qgs.cfg";
        //echo 
        //$actuel=$model_manip_fichier->initilExtent('Fokontany',$loc,$fichier);
        //echo  $actuel;
        echo '<a href="http://localhost/index.php/view/map/?repository=formaprod&project=limites_fokontany"> Limite fokontany</a>';
    }
   
	?>	
		</div>
	</div>
	</div>
</div>

