    <div id="content">
        <h1>Categorie requete</h1>        
        <?php
            $this->load->helper("form");
            echo form_open("index.php/assist_requete/dictioDonnee");
            echo '<table bgcolor="#FFFFFF">'."\n";
            $d="P";
            echo '<tr>';
            echo '<td align=center valign=middle width="500px" bgcolor="#669999"><b><u>Description</u></b></td>';
            echo '<td align=center valign=middle width="500px" bgcolor="#669999"><b><u>Description</u></b></td>';
            echo '</tr>'."\n";
            $i=1;
            foreach($result as $row){
                //print_r($row);
                if (fmod($i,2) == 1){
                  echo '<tr>';  
                } 
                $data = array(
                'name'        => "nom_table",
                "id" => "nom_table",
                'value'       => $row->nomtable,
                'checked'     => FALSE
                );
                echo '<td bgcolor="#CCCCCC">'.form_radio($data).$row->descriptio.'</td>';
                //echo form_radio($data).$row->Description; 
                if (fmod($i,2) == 0){
                  echo '</tr>'."\n";  
                } 
                $i++;
            };
            
            echo '</table>';
            echo form_submit("tableSubmit","Critere");
            echo form_close(); 
             
             /*
            if (isset($localite)){
                echo $localite['val_Region'];
            }
            echo form_open("assist_requete/tables");

            echo '<table bgcolor="#FFFFFF">'."\n";
            $d="P";
            echo '<tr>';
            echo '<td align=center valign=middle width="5px" bgcolor="#669999"><b><u>Tri</u></b></td>';
            echo '<td align=center valign=middle width="750px" bgcolor="#669999"><b><u>Localite</u></b></td>';
            echo '<td align=center valign=middle width="5px" bgcolor="#669999"><b><u>Aff</u></b></td>';
            echo '<td align=center valign=middle width="5px" bgcolor="#669999"><b><u>Cr</u></b></td>';
            echo '<td align=center valign=middle width="5px" bgcolor="#669999"><b><u>Op</u></b></td>';
            echo '<td align=center valign=middle width="5px" bgcolor="#669999"><b><u>Lieu</u></b></td>';
            echo '<td align=center valign=middle width="5px" bgcolor="#669999"><b><u>b</u></b></td>';
            echo '</tr>'."\n";
            
            //=============  Region ==================
            echo '<tr>';  
            $data = array(
                "name" => "tri_Region",
                "id" => "tri_Region",
                "value" => "",
                'maxlength'   => '2',
                'size'        => '2'
            );
            echo '<td bgcolor="#CCCCCC">'.form_input($data).'</td>';
            echo '<td bgcolor="#CCCCCC">'.form_label('Region',"fullname").'</td>';

            $data = array(
                'name'        => "aff_Region",
                'id'          => "aff_Region",
                'value'       => 'accept',
                'checked'     => FALSE,
                'style'       => 'margin:10px',
            );
            echo '<td bgcolor="#CCCCCC">'.form_checkbox($data).'</td>';
                                                                            
            $data = array(
                'name'        => "cr_Region",
                'id'          => "cr_Region",
                'value'       => 'accept',
                'checked'     => FALSE,
                'style'       => 'margin:10px',
            );
            echo '<td bgcolor="#CCCCCC">'.form_checkbox($data).'</td>';
                                                                            
            $options = array(
                '='  => '=',
                '>'  => '>',
                '<'  => '<',
                '<>' => '<>',
                'Nu' => 'Null'
            );
            echo '<td bgcolor="#CCCCCC">'.form_dropdown("op_Region", $options, 'egale').'</td>';

            $this->load->model("get_db");
            $options = array();
            $res  = mysql_query("SELECT * FROM pa_Region");
            if (false === $res) {
                echo mysql_error()."<br>";
            }else{
                while ($ro = mysql_fetch_array($res, MYSQL_ASSOC)){
                    $options[$ro["Code"]]= $ro["Nom"];
                }
            }
            echo '<td bgcolor="#CCCCCC">'.form_dropdown("val_Region", $options, 'egale').'</td>';
            
            echo '<td>';
            echo form_submit("OKRegion","OK");
            echo '</td>';
           
            echo '</tr>'."\n";  
              
            //=============  District ==================
            
            echo '<tr>';  
            $data = array(
                "name" => "tri_District",
                "id" => "tri_District",
                "value" => "",
                'maxlength'   => '2',
                'size'        => '2'
            );
            echo '<td bgcolor="#CCCCCC">'.form_input($data).'</td>';
            echo '<td bgcolor="#CCCCCC">'.form_label('District',"fullname").'</td>';

            $data = array(
                'name'        => "aff_District",
                'id'          => "aff_District",
                'value'       => 'accept',
                'checked'     => FALSE,
                'style'       => 'margin:10px',
            );
            echo '<td bgcolor="#CCCCCC">'.form_checkbox($data).'</td>';
                                                                            
            $data = array(
                'name'        => "cr_District",
                'id'          => "cr_District",
                'value'       => 'accept',
                'checked'     => FALSE,
                'style'       => 'margin:10px',
            );
            echo '<td bgcolor="#CCCCCC">'.form_checkbox($data).'</td>';
                                                                            
            $options = array(
                '='  => '=',
                '>'  => '>',
                '<'  => '<',
                '<>' => '<>',
                'Nu' => 'Null'
            );
            echo '<td bgcolor="#CCCCCC">'.form_dropdown("op_District", $options, 'egale').'</td>';

            $this->load->model("get_db");
            $options = array();
            $res  = mysql_query("SELECT * FROM pa_District");
            if (false === $res) {
                echo mysql_error()."<br>";
            }else{
                while ($ro = mysql_fetch_array($res, MYSQL_ASSOC)){
                    $options[$ro["Code"]]= $ro["Nom"];
                }
            }
            echo '<td bgcolor="#CCCCCC">'.form_dropdown("val_District", $options, 'egale').'</td>';
            
            echo '<td>';
            echo form_submit("OKDistrict","OK");
            echo '</td>';
           
            echo '</tr>'."\n";  


            //=============  Commune ==================
                echo '<tr>';  
                $data = array(
                    "name" => "tri_Commune",
                    "id" => "tri_Commune",
                    "value" => "",
                    'maxlength'   => '2',
                    'size'        => '2'
                );
                echo '<td bgcolor="#CCCCCC">'.form_input($data).'</td>';
                echo '<td bgcolor="#CCCCCC">'.form_label('Commune',"fullname").'</td>';

                $data = array(
                    'name'        => "aff_Commune",
                    'id'          => "aff_Commune",
                    'value'       => 'accept',
                    'checked'     => FALSE,
                    'style'       => 'margin:10px',
                );
                echo '<td bgcolor="#CCCCCC">'.form_checkbox($data).'</td>';
                                                                            
                $data = array(
                    'name'        => "cr_Commune",
                    'id'          => "cr_Commune",
                    'value'       => 'accept',
                    'checked'     => FALSE,
                    'style'       => 'margin:10px',
                );
                echo '<td bgcolor="#CCCCCC">'.form_checkbox($data).'</td>';
                                                                            
                $options = array(
                    '='  => '=',
                    '>'  => '>',
                    '<'  => '<',
                    '<>' => '<>',
                    'Nu' => 'Null'
                );
                echo '<td bgcolor="#CCCCCC">'.form_dropdown("op_Commune", $options, 'egale').'</td>';


                    $this->load->model("get_db");
                    $options = array();
                    $res  = mysql_query("SELECT * FROM pa_Commune");
                    if (false === $res) {
                        echo mysql_error()."<br>";
                    }else{
                        while ($ro = mysql_fetch_array($res, MYSQL_ASSOC)){
                            $options[$ro["Code"]]= $ro["Nom"];
                        }
                    }
                    echo '<td bgcolor="#CCCCCC">'.form_dropdown("val_Commune", $options, 'egale').'</td>';

            echo '<td>';
            echo '</td>';
            echo '</tr>'."\n";  
            echo '</table>';
                                 
            echo form_close();  */ 
   ?>
</div>
