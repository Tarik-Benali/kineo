<?php
    //include("functions.php");

      function ajoutPatient($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur); 
                              //$nomBD         = crypterNomDeLaBase($nomBD); 

                                                      
                              $reqHistAjoutPatient = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'ajout patient', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistAjoutPatient);     
                         } 

      function ajoutMedecinHisto($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur); 
                              //$nomBD         = crypterNomDeLaBase($nomBD); 
                                                      
                              $reqHistAjoutPatient = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'ajout médecin', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistAjoutPatient);     
                         } 

      function hisSuppPatient($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);

                              $reqHistSuppPatient = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'suppression patient', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistSuppPatient);     
                         } 
      function hisModPatient($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);

                              $reqHistModPatient = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'modification patient', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistModPatient);     
                         }
      function hisAjoutExamen($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);

                              $reqHistAjoutExam = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'Ajout Examen', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistAjoutExam);     
                         } 

      function hisSuppExamen($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);

                              $reqHistSuppPatient = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'suppression examen', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistSuppPatient);     
                         }
                                            
      function hisAjoutSpec($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);
                              
                              $reqHistAjoutSpec = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'Ajout Specialite', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistAjoutSpec);     
                         } 

      function hisSuppSalle($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);

                              $reqHistSuppPatient = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'Suppression Salle', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistSuppPatient);     
                         }  

      function hisAjoutSalle($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);
                              
                              $reqHistAjoutSpec = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'Ajout Salle', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistAjoutSpec);     
                         } 


      function hisSuppBloc($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);

                              $reqHistSuppPatient = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'Suppression Bloc', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistSuppPatient);     
                         }  

      function hisAjoutBloc($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);
                              
                              $reqHistAjoutSpec = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'Ajout Bloc', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistAjoutSpec);     
                         }

      function hisSuppLit($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);

                              $reqHistSuppPatient = "INSERT INTO historique (datehistorique, opperation, idCabinet,faiseur,sujet) VALUES ('$datehistorique', 'Suppression Lit', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistSuppPatient);     
                         }  

      function hisAjoutLit($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);
                              
                              $reqHistAjoutSpec = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'Ajout Lit', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistAjoutSpec);     
                         } 

      function hisModSalle($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);

                              $reqHistModPatient = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'modification Salle', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistModPatient);     
                         }

      function hisModLit($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);

                              $reqHistModPatient = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'modification Lit', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistModPatient);     
                         }

      function hisSuppMateriel($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);

                              $reqHistSuppPatient = "INSERT INTO historique (datehistorique, opperation, idCabinet,faiseur,sujet) VALUES ('$datehistorique', 'Suppression Materiel', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistSuppPatient);     
                         }  

      function hisAjoutMateriel($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);
                              
                              $reqHistAjoutSpec = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'Ajout Materiel', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistAjoutSpec);     
                         }
      
      function hisModMateriel($con, $datehistorique, $idCabinet, $faiseur, $sujet){
                         
                              $sujet         = str_replace("'","\'",$sujet);
                              $faiseur       = str_replace("'","\'",$faiseur);

                              $reqHistModPatient = "INSERT INTO historique (datehistorique, opperation, idCabinet, faiseur,sujet) VALUES ('$datehistorique', 'modification Materiel', '$idCabinet', '$faiseur', '$sujet')";

                              $result = mysqli_query($con,$reqHistModPatient);     
                         }                                                                                                                                                                                                                                                  
?>      