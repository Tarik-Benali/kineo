<?php

  //include("../../includes/functions.php");


function conclusionPourConsulSusp($nomCabinet, $idConsultation){

		$host_name = "";
		$database = crypterNomDeLaBase($nomCabinet);
		$db_user_name = "root";
		$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=localhost;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT `conclusion` FROM `consultations` WHERE `idConsultation` = '$idConsultation'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {                                
								                    echo "$donnees[conclusion]"; 
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}
?>