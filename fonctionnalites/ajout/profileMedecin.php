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
                                                                $idMedecin = $donnees['idPatient'];
                                                                $nomMedecin = $donnees['nomPatient'];
                                                                $prenomMedecin = $donnees['prenomPatient'];
                                                                $dateNaissMedecin = $donnees['dateNaissPatient'];
                                                                $lieuNaissMedecin = $donnees['lieuNaissPatient'];
                                                                $adresseMedecin = $donnees['adressePatient'];
                                                                $emailMedecin = $donnees['emailPatient'];
                                                                $numTelMedecin = $donnees['numTelPatient'];
                                                                $sexeMedecin = $donnees['sexePatient'];
                                                                $groupageMedecin = $donnees['groupagePatient'];

                                                                $login = $donnees['login'];
                                                                $password = $donnees['password'];
                                                                $identifiant = $donnees['identifiant'];                                                    
                                                            }
                                                                    
                                                               $reponse->closeCursor();

                                                              InsertNewProfileMedecin($idMedecin, $nomMedecin, $prenomMedecin, $dateNaissMedecin, $lieuNaissMedecin, $adresseMedecin, $emailMedecin, $numTelMedecin, $sexeMedecin, $groupageMedecin);
                                                              InsertNewUser($login, $password, "2", $identifiant);
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
                                                                $idMedecin = $donnees['idInfermier'];
                                                                $nomMedecin = $donnees['nomInfermier'];
                                                                $prenomMedecin = $donnees['prenomInfermier'];
                                                                $dateNaissMedecin = $donnees['dateNaissInfermier'];
                                                                $lieuNaissMedecin = $donnees['lieuNaissInfermier'];
                                                                $adresseMedecin = $donnees['adresseInfermier'];
                                                                $emailMedecin = $donnees['emailInfermier'];
                                                                $numTelMedecin = $donnees['numTelInfermier'];
                                                                $sexeMedecin = $donnees['sexeInfermier'];
                                                                $groupageMedecin = $donnees['groupageInfermier'];

                                                                $login = $donnees['login'];
                                                                $password = $donnees['password'];
                                                                $identifiant = $donnees['identifiant'];                                                    
                                                            }
                                                                    
                                                               $reponse->closeCursor();

                                                              InsertNewProfilePatient($idMedecin, $nomMedecin, $prenomMedecin, $dateNaissMedecin, $lieuNaissMedecin, $adresseMedecin, $emailMedecin, $numTelMedecin, $sexeMedecin, $groupageMedecin);
                                                              InsertNewUser($login, $password, "2", $identifiant);
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