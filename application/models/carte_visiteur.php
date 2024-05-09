<?php
	class Carte_Visiteur extends CI_Model{
		public function rang_visiteur(){
			session_start();
			$fp = fopen("compteur.txt","r+");
			$nbvisites = fgets($fp,11);
			// Incrémentation du compteur si la 
			// variable (de session) 'ouverture' n'existe pas
			if (empty($_SESSION['ouverture'])) 
				$nbvisites++;
			// Sinon création de cette variable
			else 
				$_SESSION['ouverture']='oui';
			fseek($fp,0);
			fputs($fp,$nbvisites);
			fclose($fp);
			// Écriture du nombre de visites
			print("$nbvisites visiteurs");
			return $nbvisites;
		}
		public function sql_infra_etat($infra){
			$chaine_rang = trim(rang_visiteur());
			$nom_vue_tal = "w_".$infra."_etat";
			$nom_vue_vao = "w_".$infra."_etat_".$chaine_rang;
			//$query = $this->db->query(" CREATE OR REPLACE VIEW ".$nom_vue_vao." AS "
			//		."SELECT ".$infra.".gid, '' AS nom,".$infra."_etat.estce_fonctionnel,".$infra."_etat.etat,".$infra.".geom "
			//		."FROM ".$infra."._etat,regions"
			//		."WHERE ".$infra.".gid = ".$infra."_etat.gid AND _st_within(."$infra.".geom, regions.geom) AND regions.region = 'SOFIA';";
			return $nom_vue_vao;
		}
		public function copie_fichier_visiteur($file){
			$chaine_rang = trim(rang_visiteur());
			$newfile = $file."_".$chaine_rang;
			if (!copy($file, $newfile)) {
				echo "La copie $file du fichier a échoué...\n";
			}
			return $newfile;
		}
		public static function remplacer_dans_fichier($file, $find, $replace) {
			if ($find != $replace) {
				//recupere la totalité du fichier
				$str = file_get_contents($file);
				if ($str === false) {
					return false;
				} else {
					//effectue le remplacement dans le texte
					$str = str_replace($find, $replace, $str);
					//remplace dans le fichier
					if (file_put_contents($file, $str) === false) {
						return false;
					}
				}
			}
			return true;
		}
		
		public function carte_infra_etat_visiteur($file,$infra){
			//creation vue etat infra pour le visiteur
			$nom_vue_vao = sql_infra_etat($infra);// vue créée
			$nom_vue_tal = "w_".$infra."_etat";
			//copie carte pour le visiteur
			$nom_fichier_vao = copie_fichier_visiteur($file);
			//remplacer vue dans la carte
			remplacer_dans_fichier($nom_fichier_vao, $nom_vue_vao, $nom_fichier_vao);
			return $nom_vue_vao;
		}
	}
?> 