<?php
    class Manip_fichier extends CI_Model{
        public function initilExtent($typa,$id,$fichier){
            if ($typa=='Madagascar'){
                $xmin= 34.4684638674;
                $ymin= -26.0175018072;
                $xmax= 59.1938438718;
                $ymax= -11.5373049021;
            }
            else{
                if ($typa=='Region'){
                    $query =$this->db->query("select idreg, st_xmin(box2d(geom)) as xmin,st_ymin(box2d(geom)) as ymin,
                                      st_xmax(box2d(geom))as xmax,st_ymax(box2d(geom))as ymax from c_regions where idreg=".$id); 
                }
                if ($typa=='District'){
                    $query =$this->db->query("select iddis, st_xmin(box2d(geom)) as xmin,st_ymin(box2d(geom)) as ymin,
                                      st_xmax(box2d(geom))as xmax,st_ymax(box2d(geom))as ymax from c_districts where iddis=".$id);
                }
                if ($typa=='Commune')
                    $query =$this->db->query("select idcom, st_xmin(box2d(geom)) as xmin,st_ymin(box2d(geom)) as ymin,
                                      st_xmax(box2d(geom))as xmax,st_ymax(box2d(geom))as ymax from c_communes where idcom=".$id);
                if ($typa=='Fokontany')
                    $query =$this->db->query("select idfok, st_xmin(box2d(geom)) as xmin,st_ymin(box2d(geom)) as ymin,
                                      st_xmax(box2d(geom))as xmax,st_ymax(box2d(geom))as ymax from c_fokontany where idfok=".$id); 
                $row=$query->result();
                foreach ($query->result() as $row){
                    $xmin= $row->xmin;
                    $ymin= $row->ymin;
                    $xmax= $row->xmax;
                    $ymax= $row->ymax;
                }    
            }
            $rep = "../lizmap/lizmap-web-client-2.12.3/lizmap/install/qgis_x2z/";
            $actual=$rep;
            $file = $rep.$fichier;
            $actual=$file;
            $current = file_get_contents($file);  
            $actual=$current;          
            $x=strpos($current, '"initialExtent"');
            $part1=substr($current ,0,$x);
            $part2=substr($current ,$x);
            $x=strpos($part2, '],');
            $part2=substr($part2 ,$x+3);
            $actual=$part1.'"initialExtent": [ '.$xmin.', '.$ymin.', '.$xmax.', '.$ymax.' ], '.$part2 ;
            //echo $xmin.', '.$ymin.', '.$xmax.', '.$ymax ;
            file_put_contents($file,$actual);
            return $actual;
        }
    }  
?>
