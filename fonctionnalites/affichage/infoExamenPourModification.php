<?php
   //include("../../includes/functions.php");

function examensDeCetteConsultation($nomCabinet, $idConsultation){

		$host_name = "";
		$database = crypterNomDeLaBase($nomCabinet);
		$db_user_name = "root";
		$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=localhost;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT typeExamen,resultExam,idRelExamCons FROM relationexamcons,consultations WHERE relationexamcons.idConsultation = consultations.idConsultation AND consultations.idConsultation = '$idConsultation'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                
								echo "<div>";
                  echo "<form action=\"fonctionnalites/mod/updatExamOnSuspendedCons.php\" name=\"updatExamOnSuspendedCons\" id=\"updatExamOnSuspendedCons\" method=\"POST\">";

  									echo "<b>Examen:</b>";
                    echo "<input type=\"text\" style=\"margin-bottom: 5px\" disabled=\"\" value=\"$donnees[typeExamen]\" class=\"form-control\" required>";
  									echo "<b>Résultat:</b>";
                    echo "<input type=\"text\" style=\"margin-bottom: 5px\" value=\"$donnees[resultExam]\" name=\"resultExam\" class=\"form-control\" required>";

                    echo "<input type=\"hidden\" name=\"idConsultation\" value=\"$idConsultation\">

                          <input type=\"hidden\" name=\"typeExamen\" value=\"$donnees[typeExamen]\">

                          <input type=\"hidden\" name=\"idRelExamCons\" value=\"$donnees[idRelExamCons]\">

                          <input type=\"hidden\" name=\"nomCabinet\" value=\"$nomCabinet\">";

                    echo "<a href=\"fonctionnalites/mod/updatExamOnSuspendedCons.php\"><input type=\"submit\" style=\"margin-bottom: 5px\" name=\"prixExamen\" value=\"Enregitrer Modification\"  class=\"btn btn-success\" required></a>";

                  echo "</form>";
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