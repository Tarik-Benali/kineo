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
                            $reponse = $bdd->query("SELECT typeExamen,resultExam FROM relationexamcons,consultations WHERE relationexamcons.idConsultation = consultations.idConsultation AND consultations.idConsultation = '$idConsultation'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                
                            echo "<div>";
                              echo "<b>Examen:</b>";
                              echo "<input type=\"text\" value=\"$donnees[typeExamen]\" name=\"typeExamen\" class=\"form-control\" required>";
                              echo "<b>Résultat:</b>";
                              echo "<input type=\"text\" value=\"$donnees[resultExam]\" name=\"resultExam\" class=\"form-control\" required>";
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
<?php

function examensFaisDeCetteConsultation($nomCabinet, $idConsultation){

    $host_name = "";
    $database = crypterNomDeLaBase($nomCabinet);
    $db_user_name = "root";
    $db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=localhost;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT typeExamen,resultExam FROM relationexamcons,consultations WHERE relationexamcons.idConsultation = consultations.idConsultation AND consultations.idConsultation = '$idConsultation'");

                            $nbrExamenNonFais = $reponse->rowCount();
                                                  
                            
                                if ($nbrExamenNonFais == "0") {

                                  echo "<td><a href=\"consultationReprise.php?idConsultation=$idConsultation\"><button type=\"button\" class=\"btn btn-success\" data-toggle=\"modal\" data-target=\"#".$idConsultation ."\"><span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Reprendre</button></a></td>"; 
                                  
                                }else{
                                  echo "<td><a href=\"consultationReprise.php?idConsultation=$idConsultation\"><button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#".$idConsultation ."\"><span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Reprendre</button></a></td>"; 

                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
        }
?>