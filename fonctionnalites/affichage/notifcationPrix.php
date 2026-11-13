<?php
	//include("../../includes/functions.php");

	function prixConsultationPourNotification($nomBD){
			
		$host_name = "localhost";
		$database = crypterNomDeLaBase($nomBD);
		$db_user_name = "root";
		$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM prixconsultation');
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
	                            echo "<li>";

		                            echo "<a href=\"#\">";
		                            echo"<span style=\"background:#DF2135\" class=\"noft-icon maki-credit-card\"></span>
		                            	<i>consultation $donnees[typeConsultation]</i>  
		                            	<b>$donnees[prixConsultation] da</b>";
		                            echo "</a>";

	                            echo "</li>";
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
		}
	
	function prixExamensPourNotification($nomBD){
			
		$host_name = "localhost";
		$database = crypterNomDeLaBase($nomBD);
		$db_user_name = "root";
		$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM examens,prix WHERE examens.idExamen=prix.idExamen GROUP BY examens.idExamen');
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
	                            echo "<li>";

		                            echo "<a href=\"#\">";
		                            echo"<span style=\"background:#DF2135\" class=\"noft-icon maki-credit-card\"></span>
		                            	<i>$donnees[typeExamen]</i>  
		                            	<b>$donnees[prixExamen] da</b>";
		                            echo "</a>";

	                            echo "</li>";
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
		}
?>















