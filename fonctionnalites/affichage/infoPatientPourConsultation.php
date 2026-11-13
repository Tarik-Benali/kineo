<?php
   //include("../../includes/functions.php");

function affichageDetailsPatient($nomCabinet, $idConsultation){

		$host_name = "localhost";
		$database = crypterNomDeLaBase($nomCabinet);
		$db_user_name = "root";
		$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=localhost;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT idPatient FROM `consultations` WHERE `idConsultation`='$idConsultation'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                	$idPatient = $donnees['idPatient'];
                                	infoPatientPourConsultation($idPatient);
                                 
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}

function infoPatientPourConsultation($idPatient){

		$host_name = "localhost";
		$database = "virtuhos_mono_cabinet";
		$db_user_name = "root";
		$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=localhost;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT * FROM `patient` WHERE `idPatient`='$idPatient'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                
								echo "<div>";
									echo "<p><B>Patient:</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$donnees[nomPatient] $donnees[prenomPatient]</p>";
									echo "<p><B>Téléphone:</B>&nbsp;&nbsp;&nbsp;  $donnees[numTelPatient]</p>";
									echo "<p><B>Adresse:</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    $donnees[adressePatient]</p>";
									echo "<p><B>Sexe:</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $donnees[sexePatient]</p>";
								echo "</div><br>";
   
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}
?>