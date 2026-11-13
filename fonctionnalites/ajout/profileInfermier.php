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
                    case '1':
                          try
                                                {
                                                                                        
                                                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                    $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);                      
                                                                
                                                                // On recupere tout le contenu de la table news
                                                    $reponse = $bdd->query("SELECT * FROM patient,users WHERE patient.idPatient = users.identifiant AND patient.idPatient = '$idUser'");
                                                                                      
                                                                // On affiche le resultat
                                                    while ($donnees = $reponse->fetch())
                                                           { 
                                                                $idInfermier = $donnees['idPatient'];
                                                                $nomInfermier = $donnees['nomPatient'];
                                                                $prenomInfermier = $donnees['prenomPatient'];
                                                                $dateNaissInfermier = $donnees['dateNaissPatient'];
                                                                $lieuNaissInfermier = $donnees['lieuNaissPatient'];
                                                                $adresseInfermier = $donnees['adressePatient'];
                                                                $emailInfermier = $donnees['emailPatient'];
                                                                $numTelInfermier = $donnees['numTelPatient'];
                                                                $sexeInfermier = $donnees['sexePatient'];
                                                                $groupageInfermier = $donnees['groupagePatient'];

                                                                $login = $donnees['login'];
                                                                $password = $donnees['password'];
                                                                $identifiant = $donnees['identifiant'];                                                    
                                                            }
                                                                    
                                                               $reponse->closeCursor();

                                                              InsertNewProfileInfermier($idInfermier, $nomInfermier, $prenomInfermier, $dateNaissInfermier, $lieuNaissInfermier, $adresseInfermier, $emailInfermier, $numTelInfermier, $sexeInfermier, $groupageInfermier);
                                                              InsertNewUser($login, $password, "3", $identifiant);
                                          }
                          catch(Exception $e)
                                      {
                                        die('Erreur : '.$e->getMessage());
                                      }
                    break;

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
                                                                $idInfermier = $donnees['idMedecin'];
                                                                $nomInfermier = $donnees['nomMedecin'];
                                                                $prenomInfermier = $donnees['prenomMedecin'];
                                                                $dateNaissInfermier = $donnees['dateNaissMedecin'];
                                                                $lieuNaissInfermier = $donnees['lieuNaissMedecin'];
                                                                $adresseInfermier = $donnees['adresseMedecin'];
                                                                $emailInfermier = $donnees['emailMedecin'];
                                                                $numTelInfermier = $donnees['numTelMedecin'];
                                                                $sexeInfermier = $donnees['sexeMedecin'];
                                                                $groupageInfermier = $donnees['groupageMedecin'];

                                                                $login = $donnees['login'];
                                                                $password = $donnees['password'];
                                                                $identifiant = $donnees['identifiant'];                                                    
                                                            }
                                                                    
                                                               $reponse->closeCursor();

                                                              InsertNewProfileInfermier($idInfermier, $nomInfermier, $prenomInfermier, $dateNaissInfermier, $lieuNaissInfermier, $adresseInfermier, $emailInfermier, $numTelInfermier, $sexeInfermier, $groupageInfermier);
                                                              InsertNewUser($login, $password, "3", $identifiant);
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