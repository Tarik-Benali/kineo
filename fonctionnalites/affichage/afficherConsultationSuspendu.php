<?php
  
  include('infoPatientPourConsultation.php');
  include('infoExamenPourConsultation.php');
  //include("../../includes/functions.php");

	function afficherConsultationSuspendu($nomBD, $idMedecin, $idCabinet){
    
			
		$host_name = "localhost";
		$database = crypterNomDeLaBase($nomBD);
		$db_user_name = "root";
		$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT * FROM `consultations` WHERE `etatCons` = '1' AND `idMedecin` = '$idMedecin'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {

                                $idConsultation     = $donnees['idConsultation'];
                                $idRendezvous       = $donnees['idRendezvous']; 
                                $idMedecin          = $donnees['idMedecin'];
                                $conclusion         = $donnees['conclusion'];
                                $heureConsultation  = $donnees['heureConsultation']; 
                                $etatCons           = $donnees['etatCons'];

	                            echo "<tr>";

                                    echo "<td>$heureConsultation</td>";
                                    echo "<td><button type=\"button\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#".$idConsultation ."\"><span class=\"entypo-eye\"></span>&nbsp;&nbsp;Visualiser</button></td>";
                                      examensFaisDeCetteConsultation($nomBD, $idConsultation); 

                                echo "</tr>";

                                echo "<div class=\"container\">

                                      <div class=\"modal fade\"  id=\"".$idConsultation ."\" role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Consultation du &nbsp;&nbsp; $heureConsultation</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"height: 550px; overflow-y: auto;\">

											<form action=\"fonctionnalites\mod\modPrixExam.php\" class=\"form-container\">
										        <fieldset>

										        	<div class=\"form-group\">

										        	<input type=\"hidden\" name=\"idExamen\" value=\"$idConsultation \">

													<input type=\"hidden\" name=\"idMedecin\" value=\"$idMedecin\">

													<input type=\"hidden\" name=\"idCabinet\" value=\"$idCabinet\">

													<input type=\"hidden\" name=\"nomBD\" value=\"$nomBD\">

                                              "; affichageDetailsPatient($nomBD, $idConsultation);

                                                 examensDeCetteConsultation($nomBD, $idConsultation);

                                               echo "

                                              <label for=\"examen\"><b>Conclusion</b></label>

                                              <textarea type=\"text\" name=\"conclusion\"  style=\"height: 100px;\" required>$conclusion</textarea>
                                                                   
                          
                                            </div>
                                            
                                              <ul id=\"breadcrumb\">
                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                <a href=\"consultationReprise.php?idConsultation=$idConsultation\"><button type=\"button\" style=\"margin-right: 10px;\" class=\"btn btn-warning pull-right\"><span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Reprendre</button></a>

                                                </ul>

	                                            	</div>                                       

	                                            </fieldset>                    
											</form>
                                              
                                          </div>													                 

                                          
                                        </div>
                                      </div>
                                      
                                    </div>";
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
		}
?>