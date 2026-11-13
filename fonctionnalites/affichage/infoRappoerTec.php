<?php

function messageRapport($idCabinet,$idMedecin){

            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=localhost;dbname=virtuhos_mono_cabinet","root","", $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT * FROM rapporttechnique WHERE idCabinet='$idCabinet' AND idExpediteur ='$idMedecin' ORDER BY dateReponseRapport DESC ");

                            while ($donnees = $reponse->fetch())
                                                {                              
                                                    $vue            = $donnees['vue'];
                                                    $objet          = $donnees['objet'];
                                                    $rapport        = $donnees['rapport'];
                                                    $idCabinet      = $donnees['idCabinet'];
                                                    $idRapport      = $donnees['idRapport']; 
                                                    $idExpediteur   = $donnees['idExpediteur'];
                                                    $dateRapport    = $donnees['dateRapport'];
                                                    $reponseRapport = $donnees['reponseRapport'];
                                                    $dateReponse    = $donnees['dateReponseRapport'];
                       
                            echo "<tr class='clickable-row' style=\"".couleurLigneVue($vue)."\" data-toggle=\"modal\" data-target=\"#".$idRapport ."\">
                                           <td>".dimoPremiersMots($objet,'50')."</td>
                                           <td>".dimoPremiersMots($rapport,'100')."</td>
                                           <td>$dateRapport</td>
                                      </tr>";
                                echo "<div class=\"container\">
                                

        <div class=\"modal fade\"  id=\"".$idRapport ."\" role=\"dialog\">
           <div class=\"modal-dialog\">

            <div class=\"modal-content\">
                <div class=\"modal-header\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                    <h4 class=\"modal-title\">Rapport Technique</h4>
                </div>
            <div class=\"modal-body\" style=\"height: 550px; overflow-y: auto;\">

                <form action=\"#\" class=\"form-container\">
                  <fieldset>

                    <div class=\"form-group\">"; //affichageDetailsPatient($nomBD, $idConsultation);

                      //examensDeCetteConsultation($nomBD, $idConsultation);
                      affichageDetailsSender($dateRapport, $idCabinet, $idRapport); 

                      echo "  <div class=\"control-group\">
                                <label class=\"control-label\" for=\"text\">Objet</label>
                                  <div class=\"controls\">
                                     <input type=\"text\" disabled=\"\" class=\"form-control\" name=\"objet\" id=\"objet\" placeholder=\"$objet\">
                                  </div>
                              </div>";

                                      echo "<br>
                                              
                                              <label for=\"examen\"><b>Message</b></label>

                                              <textarea type=\"text\" name=\"rapport\"  style=\"height: 100px;\" required>$rapport</textarea>
                                                                                            
                                            </div>";

                                        echo "<br>

                                              <label for=\"examen\"><b>Réponse de l'équipe technique </b></label>

                                              <textarea type=\"text\" name=\"repRapp\"  style=\"height: 100px;\" required>$reponseRapport</textarea>
                                                                   
                          
                                            </div>
                                            
                                              <ul id=\"breadcrumb\">
                                              
                                                <div style=\"display: flex; flex-wrap: nowrap; justify-content: flew-end;\" class=\"pull-right\">
                                                  <div>
                                                    <a href=\"rapportTechnique.php\">
                                                    <button type=\"button\" style=\"margin-right: 10px;\" class=\"btn btn-warning pull-right\"><span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Répondre</button></a>
                                                  </div>

                                                  <div>
                                                    <a href=\"fonctionnalites/mod/marquerRappCommeLu.php?vue=$vue&idRapport=$idRapport\">
                                                    <button type=\"button\" class=\"btn btn-default pull-right\" style=\"margin-right:10px;margin-bottom:10px;\"> Marquer comme lu</button></a>
                                                  </div>
                                                </div>
                                              </ul>
                                      </div>                                       
                      </fieldset>                    
                  </form>                          
              </div>                                                                                     
            </div>
          </div>                                
        </div>";
                                //echo "<tr class='clickable-row' data-href='medecin.php' style=\"background-color: #ccc;\">
                                           //<td>$objet</td>
                                           //<td>$rapport</td>
                                           //<td>$dateRapport</td>
                                      //</tr>";                                          

                                                    //nbrReponseRapport($idCabinet,$idMedecin);
                                                     
                                                }

                                 $reponse->closeCursor();

                                                  
                              }
                          catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
        }

function affichageDetailsSender($dateRapport, $idCabinet, $idRapport){

		$host_name = "localhost";
		$database = "virtuhos_mono_cabinet";
		$db_user_name = "root";
		$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=localhost;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT idExpediteur FROM `rapporttechnique` WHERE `idRapport`='$idRapport'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                  $rep = $bdd->query("SELECT nomCabinet FROM cabinet WHERE `idCabinet`='$idCabinet'");
                                  while ($donn = $rep->fetch())
                                  {
                                    $nomCabinet = $donn['nomCabinet'];
                                  }
                                 $rep->closeCursor();

                                	$idExpediteur = $donnees['idExpediteur'];
                                	infoCabinetSentFrom($idExpediteur,$nomCabinet,$dateRapport);
                                 
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}

function infoCabinetSentFrom($idExpediteur,$nomCabinet,$dateRapport){

		$host_name = "localhost";
		$database = "virtuhos_mono_cabinet";
		$db_user_name = "root";
		$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT login FROM users WHERE identifiant='$idExpediteur' LIMIT 1");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                $expediteur = $donnees['login'];
                                
								echo "<div>";
									echo "<label class=\"control-label\" for=\"text\">Envoyé par: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$expediteur</label><br>"; 
                  echo "<label class=\"control-label\" for=\"text\">Cabinet &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$nomCabinet </label><br>";
                  echo "<label class=\"control-label\" for=\"text\">Le &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>$dateRapport<br><br> ";
								echo "</div><br>";
   
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}

function couleurLigneVue($vues){

            switch ($vues) {
              case 0:
                    $couleur = "background-color:#FFF";

                    return $couleur;
                break;

              case 1:
                    $couleur = "background-color:#F1F2F6";

                    return $couleur;
                break;

              case 2:
                    // En traitement
                    $couleur = "background-color:#FFF0CC";

                    return $couleur;
                break;

              case 3:
                    // résolu
                    $couleur = "background-color:#C3F9D0";

                    return $couleur;
                break;
            }
        }
function dimoPremiersMots($texte,$n) {
        if (strlen($texte) > $n)
        {    
            $texte = substr($texte, 0, $n);       
            $texte .= ' ...';
            return $texte;
        }
        else return $texte;
    }
                
?>