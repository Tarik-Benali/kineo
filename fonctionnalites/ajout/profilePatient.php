<?php
	include("../../includes/functions.php");

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

 if ($_REQUEST['idUser']){

  $idUser     = $_REQUEST['idUser'];
  $typeCompte = $_REQUEST['typeCompte'];

              switch ($typeCompte) {
                    case '2':
                          try
                                                {
                                                                                        
                                                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                    $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);                      
                                                                
                                                                // On recupere tout le contenu de la table news
                                                    $reponse = $bdd->query("SELECT * FROM medecin,users WHERE medecin.idMedecin = users.identifiant AND medecin.idMedecin = '$idUser'");
                                                                                      
                                                                // On affiche le resultat
                                                    while ($donnees = $reponse->fetch())
                                                           { 
                                                                $idPatient = $donnees['idMedecin'];
                                                                $nomPatient = $donnees['nomMedecin'];
                                                                $prenomPatient = $donnees['prenomMedecin'];
                                                                $dateNaissPatient = $donnees['dateNaissMedecin'];
                                                                $lieuNaissPatient = $donnees['lieuNaissMedecin'];
                                                                $adressePatient = $donnees['adresseMedecin'];
                                                                $emailPatient = $donnees['emailMedecin'];
                                                                $numTelPatient = $donnees['numTelMedecin'];
                                                                $sexePatient = $donnees['sexeMedecin'];
                                                                $groupagePatient = $donnees['groupageMedecin'];

                                                                $login = $donnees['login'];
                                                                $password = $donnees['password'];
                                                                $identifiant = $donnees['identifiant'];                                                    
                                                            }
                                                                    
                                                               $reponse->closeCursor();

                                                              InsertNewProfilePatient($idPatient, $nomPatient, $prenomPatient, $dateNaissPatient, $lieuNaissPatient, $adressePatient, $emailPatient, $numTelPatient, $sexePatient, $groupagePatient);
                                                              InsertNewUser($login, $password, "1", $identifiant);
                                          }
                          catch(Exception $e)
                                      {
                                        die('Erreur : '.$e->getMessage());
                                      }
                    break;

                    case '3':
                              try
                                                {
                                                                                        
                                                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                    $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);                      
                                                                
                                                                // On recupere tout le contenu de la table news
                                                    $reponse = $bdd->query("SELECT * FROM infermier,users WHERE infermier.idInfermier = users.identifiant AND infermier.idInfermier = '$idUser'");
                                                                                      
                                                                // On affiche le resultat
                                                    while ($donnees = $reponse->fetch())
                                                           { 
                                                                $idPatient = $donnees['idInfermier'];
                                                                $nomPatient = $donnees['nomInfermier'];
                                                                $prenomPatient = $donnees['prenomInfermier'];
                                                                $dateNaissPatient = $donnees['dateNaissInfermier'];
                                                                $lieuNaissPatient = $donnees['lieuNaissInfermier'];
                                                                $adressePatient = $donnees['adresseInfermier'];
                                                                $emailPatient = $donnees['emailInfermier'];
                                                                $numTelPatient = $donnees['numTelInfermier'];
                                                                $sexePatient = $donnees['sexeInfermier'];
                                                                $groupagePatient = $donnees['groupageInfermier'];

                                                                $login = $donnees['login'];
                                                                $password = $donnees['password'];
                                                                $identifiant = $donnees['identifiant'];                                                    
                                                            }
                                                                    
                                                               $reponse->closeCursor();

                                                              InsertNewProfilePatient($idPatient, $nomPatient, $prenomPatient, $dateNaissPatient, $lieuNaissPatient, $adressePatient, $emailPatient, $numTelPatient, $sexePatient, $groupagePatient);
                                                              InsertNewUser($login, $password, "1", $identifiant);
                                          }
                          catch(Exception $e)
                                      {
                                        die('Erreur : '.$e->getMessage());
                                      }
                    break;
                  }    
}


header("Location: ../../compte.php");
?>