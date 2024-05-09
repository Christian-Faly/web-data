<div id="wrapper" class="<?php if ($this->session->userdata('username')==='') echo'hidden'?>">

  <!-- start header -->
  <header>
    <div class="top">
      <div class="container">
        <div class="row">
          <div class="span6">
            <p class="topcontact"><i class="icon-phone"></i> +261 34 14 210 12</p>
          </div>
          <div class="span6">

            <ul class="social-network">
              <li><a href="https://www.facebook.com/prosperer.mg/" target="_blank" data-placement="bottom" title="Facebook"><i class="icon-facebook icon-white"></i></a></li>
              <li><a href="#" target="_blank" data-placement="bottom" title="Twitter"><i class="icon-twitter icon-white"></i></a></li>
              <li><a href="https://www.youtube.com/channel/UCytPvEW0ROzm9jwg26_Aqlg" target="_blank" data-placement="bottom" title="Youtube"><i class="icon-youtube icon-white"></i></a></li>
            </ul>

          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <?php if ($this->session->userdata('role_id')==='1' 
                or $this->session->userdata('role_id')==='2'
                or $this->session->userdata('role_id')==='3' 
                or $this->session->userdata('role_id')==='4')
        {?>
                <img src="<?php echo site_url()?>assets/img/banersite.jpg" alt="">
      <?php } ?> 
    </div>
    <div class="container">
        <div class="row nomargin">
          <div class="span2">
            <div class="logo">
              <a href="#">
                <img src="<?php echo site_url()?>assets/img/logo.png" alt="" />
              </a>              
            </div>
          </div>
          <div class="span10">
            <div class="navbar navbar-static-top">
              <div class="navigation">
                <nav>
                  <ul class="nav topnav">
                  
                    <li class="dropdown 
                        <?php if ($this->session->userdata('action_img')==='acceuil'){
                            echo 'active';}?>
                        ">
                      <a href="<?php echo site_url()?>"><i class="icon-home"></i></a>
                    </li>
                    
                    <?php if ($this->session->userdata('role_id')==='1' 
                                or $this->session->userdata('role_id')==='2'
                                or $this->session->userdata('role_id')==='3' 
                                or $this->session->userdata('role_id')==='4'
                            ){
                                echo'   
                                <li class="dropdown ';
                                    if ($this->session->userdata('action_img')==='carte'){
                                        echo 'active';}
                                echo'">
                                    <a href="'.site_url('index.php/carte').'">Cartes <!-- <i class="icon-angle-down"></i> --> </a>
                                    <!-- <ul class="dropdown-menu">
                                        <li class="dropdown"><a href="#">National<i class="icon-angle-right"></i></a>
                                            <ul class="dropdown-menu sub-menu-level1">
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Zone_intervention_2Server_test.qgs">Zone d intervention</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/menage_touche_test.qgs">Ménages touchés</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/MER_beneficiaires_2Server-Copie.qgs">MER bénéficiaires</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/MER_beneficiaires_2Server-Copie.qgs">MER bénéficiaires SNF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SF_test.qgs">MER bénéficiaires SF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Carte_des_OM_test-Copie.qgs">OM</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Beneficiaires_formations1-Copie.qgs">MER bénéficiaires des formations</a></li>
                                    
                                            </ul>
                                        </li>

                                        <li class="dropdown"><a href="#">Analamanga<i class="icon-angle-right"></i></a>
                                            <ul class="dropdown-menu sub-menu-level1">
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Zone_intervention_epra_test.qgs">Zone d intervention</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Menages_touches_epra_test.qgs">Ménages touchés</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/MER_beneficiaires_epra_test.qgs">MER bénéficiaires</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SNF_epra_test.qgs">MER bénéficiaires SNF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SF_epra_test.qgs">MER bénéficiaires SF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/OM_epra_test.qgs">OM</a></li>
                                            </ul>
                                        </li>	
                                        
                                        <li class="dropdown"><a href="#">Analanjirofo<i class="icon-angle-right"></i></a>
                                            <ul class="dropdown-menu sub-menu-level1">
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Zone_intervention_epra_test.qgs">Zone d intervention</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Menages_touches_epra_test.qgs">Ménages touchés</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/MER_beneficiaires_epra_test.qgs">MER bénéficiaires</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SNF_epra_test.qgs">MER bénéficiaires SNF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SF_epra_test.qgs">MER bénéficiaires SF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/OM_epra_test.qgs">OM</a></li>
                                            </ul>
                                        </li>
                                        
                                        <li class="dropdown"><a href="#">Atsinanana<i class="icon-angle-right"></i></a>
                                            <ul class="dropdown-menu sub-menu-level1">
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Zone_intervention_epra_test.qgs">Zone d intervention</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Menages_touches_epra_test.qgs">Ménages touchés</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/MER_beneficiaires_epra_test.qgs">MER bénéficiaires</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SNF_epra_test.qgs">MER bénéficiaires SNF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SF_epra_test.qgs">MER bénéficiaires SF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/OM_epra_test.qgs">OM</a></li>
                                            </ul>
                                        </li>
                                        
                                        <li class="dropdown"><a href="#">Boeny<i class="icon-angle-right"></i></a>
                                            <ul class="dropdown-menu sub-menu-level1">
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Zone_intervention_eprg_test.qgs">Zone d intervention</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Menages_touches_eprg_test.qgs">Ménages touchés</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/MER_beneficiaires_eprg_test.qgs">MER bénéficiaires</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SNF_eprg_test.qgs">MER bénéficiaires SNF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SF_eprg_test.qgs">MER bénéficiaires SF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/OM_eprg_test.qgs">OM</a></li>
                                            </ul>
                                        </li>

                                        <li class="dropdown"><a href="#">Bongolava<i class="icon-angle-right"></i></a>
                                            <ul class="dropdown-menu sub-menu-level1">
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Zone_intervention_eprg_test.qgs">Zone d intervention</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Menages_touches_eprg_test.qgs">Ménages touchés</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/MER_beneficiaires_eprg_test.qgs">MER bénéficiaires</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SNF_eprg_test.qgs">MER bénéficiaires SNF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SF_eprg_test.qgs">MER bénéficiaires SF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/OM_eprg_test.qgs">OM</a></li>
                                            </ul>
                                        </li>
                                        
                                        <li class="dropdown"><a href="#">Haute Matsiatra<i class="icon-angle-right"></i></a>
                                            <ul class="dropdown-menu sub-menu-level1">
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Zone_intervention_eprg_test.qgs">Zone d intervention</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Menages_touches_eprg_test.qgs">Ménages touchés</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/MER_beneficiaires_eprg_test.qgs">MER bénéficiaires</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SNF_eprg_test.qgs">MER bénéficiaires SNF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SF_eprg_test.qgs">MER bénéficiaires SF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/OM_eprg_test.qgs">OM</a></li>
                                            </ul>
                                        </li>
                                        
                                        <li class="dropdown"><a href="#">Itasy<i class="icon-angle-right"></i></a>
                                            <ul class="dropdown-menu sub-menu-level1">
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Zone_intervention_epri_test.qgs">Zone d intervention</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Menages_touches_epri_test.qgs">Ménages touchés</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/MER_beneficiaire_epri_test.qgs">MER bénéficiaires</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SNF_epri_test.qgs">MER bénéficiaires SNF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SF_epri_test.qgs">MER bénéficiaires SF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/OM_epri_test.qgs">OM</a></li>
                                            </ul>
                                        </li>								  
                                        
                                        <li class="dropdown"><a href="#">Sofia<i class="icon-angle-right"></i></a>
                                            <ul class="dropdown-menu sub-menu-level1">
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/zone_intervention_eprs_test.qgs">Zone d intervention</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Menages_touches_eprs_test.qgs">Ménages touchés</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/MER_beneficiaire_eprs_test.qgs">MER bénéficiaires</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/appuis_par_categorie_eprs_test.qgs">Appuis par catégorie</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/OM_eprs_test.qgs">OM</a></li>
                                            </ul>
                                        </li>
                                        
                                        <li class="dropdown"><a href="#">V7V<i class="icon-angle-right"></i></a>
                                            <ul class="dropdown-menu sub-menu-level1">
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Zone_intervention_eprg_test.qgs">Zone d intervention</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/Menages_touches_eprg_test.qgs">Ménages touchés</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/MER_beneficiaires_eprg_test.qgs">MER bénéficiaires</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SNF_eprg_test.qgs">MER bénéficiaires SNF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/beneficiaire_SF_eprg_test.qgs">MER bénéficiaires SF</a></li>
                                            <li><a target="blank_" href="http://31.207.35.114/qgis-web-client-master/site/qgiswebclient.html?map=/var/www/html/qgis-web-client-master/projects/OM_eprg_test.qgs">OM</a></li>
                                            </ul>
                                        </li>
                                    
                                    </ul> -->
                                </li>
                                <li class="dropdown ';
                                    if ($this->session->userdata('action_img')==='tb'){
                                        echo 'active';}
                                    echo'">
                                    <a href="#">Tabl de bord <i class="icon-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                    <li><a href="'.site_url('index.php/tb/annexe1D?tb=tb_annexe1d&classe=annuel').'">Annexe 1D</a></li>
                                    <li><a href="'.site_url('index.php/tb/annexe1D?tb=tb_orms&classe=tb').'">Tableau de bord</a></li>
                                    <li><a href="'.site_url('index.php/tb/annexe1D?tb=tb_top_up1&classe=es').'">Etat de sortie Top UP1</a></li>
                                    <li><a href="index.php/tb/annexe1D?tb=tb_indic_clees_perf&classe=es">Indicateur clé de performance</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown ';
                                    if ($this->session->userdata('action_img')==='Req_predef'){
                                        echo 'active';}
                                    echo'
                                    ">
                                    <a href="#">Requête prédéf <i class="icon-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                    <li><a href="'.site_url('index.php/req_pre/acceuil?type=rp&bdd=0101').'">Micro-Entreprises Rurales (MER)</a></li>
                                    <li><a href="#">Jeune</a></li>
                                    <li><a href="#">Suivi Evaluation (composante 5)</a></li>
                                    <li><a href="#">Opérateur de Marchés</a></li>
                                    </ul>
                                </li>

                                <li class="dropdown ';
                                    if ($this->session->userdata('action_img')==='Req_souple'){
                                        echo 'active';}
                                    echo'
                                    ">
                                    <a href="#">Créer requête<i class="icon-angle-down"></i></a>
                                    <ul class="dropdown-menu">
                                    <li><a href="'.site_url('index.php/assist_requete/tables?type=ar&bdd=0201').'">Micro-Entreprises Rurales (MER)</a></li>
                                    <li><a href="#">Jeune</a></li>
                                    <li><a href="#">Suivi Evaluation (composante 5)</a></li>
                                    <li><a href="#">Opérateur de Marchés</a></li>
                                    </ul>
                                </li>';
                                if ($this->session->userdata('role_id')==='1'){
                                    echo 
                                    '<li class="dropdown';
                                    if ($this->session->userdata('action_img')==='gest_donnees'){
                                        echo 'active';}
                                            echo'">
                                                <a href="#">Gestion des données<i class="icon-angle-down"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#">Consolidation</a></li>
                                                    <li><a href="#">Mise à jour dictionnaires des données</a></li>
                                                    <!--<li><a href="#">Blog fullwidth</a></li>
                                                    <li><a href="#">Post left sidebar</a></li>
                                                    <li><a href="#">Post right sidebar</a></li>-->
                                                </ul>
                                    </li>';
                                }
                                
                                
                    }
                    ?>
                    <li>
                      <a href="#">Forum </a>
                    </li>
                    <li class='dropdown'>
                      <a href='#'><i class="icon-user"></i><i class="icon-angle-down"></i></a>
                      <ul class='dropdown-menu'>
                        <?php if ($this->session->userdata('username')!=''){
                            echo $this->session->userdata('username').' '.
                                '<li><a href="'.base_url().'/index.php/site/logout">Se déconnecter <i class="icon-signout"></i></a></li>';
                            if ($this->session->userdata('username')==='1')
                                echo'<li><a href="#">Gérer les utilsateurs <i class="icon-user-md"></i></a></li>';
                          }
                          else echo '<li><a href="#" class="btn-login-form">Se connecter <i class="icon-signin"></i></a></li>'
                        ?>
                      </ul>
                    </li>  
                  </ul>
                </nav>
              </div>
              <!-- end navigation -->
            </div>
          </div>
        </div>
    </div>
  </header>
  <!-- end header -->
    
    <?php 
      function login_Form(){    
            echo'<div class="login-form">      
                    <div class="span6">
                        <h4 class="animated fadeInDown"><strong>Veuillez vous <span class="colored">connecter</span></strong></h4>
                        <p class="animated fadeInUp">'.
                            //.$this->session->flashdata('error').'
                            '<div class="sendmessage">Connexion réussie!!</div>
                            <div class="errormessage"></div>
                        </p>
                        <form action="'.site_url('index.php/site/login_validation').'" method="post" role="form" class="contactForm">
                            <div class="row">
                                <div class="span4 form-group field">
                                    <input type="text" name="login" class="login" placeholder="Votre Login" data-rule="minlen:4 required" data-msg="Veuillez entrer votre login, avec 4 caractères minimum" />
                                    <div class="validation"></div>
                                </div>

                                <div class="span4 form-group">
                                    <input type="password" name="password" class="password" placeholder="Mots de passe" data-rule="minlen:6 required" data-msg="Veuillez entrer votre mot de passe, avec 6 caractères minimum" />
                                    <div class="validation"></div>
                                </div>
                                <div class="span4 form-group">
                                    <div class="validation"></div>
                                    <div class="text-center">
                                    <button class="btn btn-theme btn-medium margintop10" type="submit">Se connecter</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>';
              }
    ?>
    

  <!-- section featured -->
  <section id="featured">

    <!-- slideshow start here -->
    <?php if ($this->session->userdata('action_img')==='acceuil'){
          ?>

      <div class="camera_wrap" id="camera-slide">

          
             <!-- slide 2 here -->
          <div data-src="<?php echo site_url()?>assets/img/slides/camera/slide2/img1.jpg">
              <div class="camera_caption fadeFromLeft">
                  <div class="container">
                      <div class="row">
                          <?php
                          if ($this->session->userdata('username')!='') echo'';
                          else echo login_Form();
                          ?>
                      </div>
                  </div>
              </div>
          </div>

          <!-- slide 1 here -->
          <div data-src="<?php echo site_url()?>assets/img/slides/camera/slide1/img1.jpg">
              <div class="camera_caption fadeFromLeft">
                  <div class="container">
                      <div class="row"> 
                          <?php
                          if ($this->session->userdata('username')!='') echo'';
                          else echo login_Form();
                          ?>    
                      </div>
                  </div>
              </div>
          </div>

          <?php if ($this->session->userdata('role_id')==='1'  
                    or $this->session->userdata('role_id')==='2'
                    or $this->session->userdata('role_id')==='3' 
                    or $this->session->userdata('role_id')==='4')
            echo '<div data-src="'.site_url().'assets/img/slides/camera/slide3/img1.jpg">
                  <div class="camera_caption fadeFromLeft">
                      <div class="container">
                          <div class="row">
                          </div>
                      </div>
                  </div>
              </div>
              
              <div data-src="'.site_url().'assets/img/slides/camera/slide3/img2.jpg">
                  <div class="camera_caption fadeFromLeft">
                      <div class="container">
                          <div class="row">
                              
                          </div>
                      </div>
                  </div>
              </div>
              
              <div data-src="'.site_url().'assets/img/slides/camera/slide3/img3.jpg">
                <div class="camera_caption fadeFromLeft">
                    <div class="container">
                        <div class="row">
                            
                        </div>
                    </div>
                </div>
              </div>

              <div data-src="'.site_url().'assets/img/slides/camera/slide3/img4.jpg">
                  <div class="camera_caption fadeFromLeft">
                      <div class="container">
                          <div class="row">
                            
                          </div>
                      </div>
                  </div>
              </div>

              <div data-src="'.site_url().'assets/img/slides/camera/slide3/img5.jpg">
                  <div class="camera_caption fadeFromLeft">
                      <div class="container">
                          <div class="row">
                              
                          </div>
                      </div>
                  </div>
              </div>

              <div data-src="'.site_url().'assets/img/slides/camera/slide3/img11.jpg">
                  <div class="camera_caption fadeFromLeft">
                      <div class="container">
                          <div class="row">
                              
                          </div>
                      </div>
                  </div>
              </div>

              <div data-src="'.site_url().'assets/img/slides/camera/slide3/img6.jpg">
                  <div class="camera_caption fadeFromLeft">
                      <div class="container">
                          <div class="row">
                              
                          </div>
                      </div>
                  </div>
              </div>
              
              ';
          ?> 


            <div data-src="<?php echo site_url()?>assets/img/slides/camera/slide3/img7.jpg">
                <div class="camera_caption fadeFromLeft">
                    <div class="container">
                        <div class="row">
                            <?php
                            if ($this->session->userdata('username')!='') echo'';
                            else echo login_Form();
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div data-src="<?php echo site_url()?>assets/img/slides/camera/slide3/img8.jpg">
                <div class="camera_caption fadeFromLeft">
                    <div class="container">
                        <div class="row">
                            <?php
                            if ($this->session->userdata('username')!='') echo'';
                            else echo login_Form();
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div data-src="<?php echo site_url()?>assets/img/slides/camera/slide3/img9.jpg">
                <div class="camera_caption fadeFromLeft">
                    <div class="container">
                        <div class="row">
                            <?php
                            if ($this->session->userdata('username')!='') echo'';
                            else echo login_Form();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div data-src="<?php echo site_url()?>assets/img/slides/camera/slide3/img10.jpg">
                <div class="camera_caption fadeFromLeft">
                    <div class="container">
                        <div class="row">
                            <?php
                            if ($this->session->userdata('username')!='') echo'';
                            else echo login_Form();
                            ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

    <?php } ?> 

    <!-- slideshow end here -->

  </section>



  <section id="content">
    <div class="container">
	  	<div class="row demobtn"> 
