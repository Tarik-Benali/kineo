<?php

function phenomeneCouleurExamenAttendu($nomCabinet, $idPatient){

    $host_name = "";
    $database = crypterNomDeLaBase($nomCabinet);
    $db_user_name = "root";
    $db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=localhost;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT typeExamen,resultExam FROM relationexamcons,consultations WHERE relationexamcons.idConsultation = consultations.idConsultation AND consultations.idPatient = '$idPatient'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                  $nbrExamenNonFais = 0;

                                  if ($donnees['resultExam'] == "") {

                                    $nbrExamenNonFais = $nbrExamenNonFais + 1;

                                  }      
                                }                              

                                if ($nbrExamenNonFais == "0") {

                                  echo "<div class=\"alert alert-success\">";
                                      echo "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
                                      echo "<span class=\"entypo-thumbs-up\"></span>";
                                      echo "<strong>Examens fais!</strong>&nbsp;&nbsp;Ce patient à fait tout ses examens.".$nbrExamenNonFais."";
                                  echo "</div>";
                                  
                                }else{

                                  echo "<div class=\"alert alert-danger\">";
                                      echo "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
                                      echo "<span class=\"entypo-attention\"></span>";
                                      echo "<strong>Examens non fais!</strong>&nbsp;&nbsp;Nombre d'examens non fais: ".$nbrExamenNonFais."";
                                  echo "</div>";

                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
        }
?>