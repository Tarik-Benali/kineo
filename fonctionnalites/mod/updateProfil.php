<?php

	 include("../../includes/functions.php");


if ($_REQUEST['id']) {

		$id 	= $_REQUEST['id'];
		$id 	= str_replace("'","\'",$id);

		$nom 	= $_REQUEST['nom'];
		$nom 	= str_replace("'","\'",$nom);

	    $prenom = $_REQUEST['prenom'];
	    $prenom = str_replace("'","\'",$prenom);
	    
	    $tel 	= $_REQUEST['tel'];
		$tel 	= str_replace("'","\'",$tel);

	    $mail = $_REQUEST['mail'];
	    $mail = str_replace("'","\'",$mail);
	    
	    $adresse 	= $_REQUEST['adresse'];
		$adresse 	= str_replace("'","\'",$adresse);

	    $dateNaiss = $_REQUEST['dateNaiss'];
	    $dateNaiss = str_replace("'","\'",$dateNaiss);
	    
	    $lieuNaiss 	= $_REQUEST['lieuNaiss'];
		$lieuNaiss 	= str_replace("'","\'",$lieuNaiss);

	    $sexe = $_REQUEST['sexe'];
	    $sexe = str_replace("'","\'",$sexe);

	    $groupage		= $_REQUEST['groupage'];
		$groupage		= str_replace("'","\'",$groupage);

		if ($groupage == "") {
			$groupage = $_REQUEST['groupageEnregistre'];
		}

		if ($sexe == "") {
			$sexe = $_REQUEST['sexeEnregistre'];
		}
	       	            

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;	    
	

					try
					{
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);

						$reponse = $bdd->query("SELECT typeCompte FROM `users` WHERE `identifiant` = '$id'");

						while ($donnees = $reponse->fetch())
                                     {

                                $type     = $donnees['typeCompte'];

                                switch ($type) {

                                    case 1:

                                    $table  = "patient"; 
                                    $champ  = "idPatient";
                                    $id     = $id;

									$nomC	 = "nomPatient";
									$prenomC = "prenomPatient";
									$dateNC	 = "dateNaissPatient";
									$lieuNC	 = "lieuNaissPatient";
									$adressC = "adressePatient";
									$mailC   = "emailPatient";
									$numC	 = "numTelPatient";
									$sexeC	 = "sexePatient";
									$groupC	 = "groupagePatient";

									$nomV	 = $nom;
									$prenomV = $prenom;
									$dateNV	 = $dateNaiss;
									$lieuNV	 = $lieuNaiss;
									$adressV = $adresse;
									$mailV   = $mail;
									$numV	 = $tel;
									$sexeV	 = $sexe;
									$groupV	 = $groupage;

                                    updateProfil($table, $champ, $id, $nomC, $prenomC, $dateNC, $lieuNC, $adressC, $mailC, $numC, $sexeC, $groupC, $nomV, $prenomV, $dateNV, $lieuNV, $adressV, $mailV, $numV, $sexeV, $groupV);
                                                
                                        break;

                                    case 2:

                                    $table = "medecin"; 
                                    $champ = "idMedecin";
                                    $id    = $id;
                                    
									$nomC	 = "nomMedecin";
									$prenomC = "prenomMedecin";
									$dateNC	 = "dateNaissMedecin";
									$lieuNC	 = "lieuNaissMedecin";
									$adressC = "adresseMedecin";
									$mailC   = "emailMedecin";
									$numC	 = "numTelMedecin";
									$sexeC	 = "sexeMedecin";
									$groupC	 = "groupageMedecin";

									$nomV	 = $nom;
									$prenomV = $prenom;
									$dateNV	 = $dateNaiss;
									$lieuNV	 = $lieuNaiss;
									$adressV = $adresse;
									$mailV   = $mail;
									$numV	 = $tel;
									$sexeV	 = $sexe;
									$groupV	 = $groupage;

                                    updateProfil($table, $champ, $id, $nomC, $prenomC, $dateNC, $lieuNC, $adressC, $mailC, $numC, $sexeC, $groupC, $nomV, $prenomV, $dateNV, $lieuNV, $adressV, $mailV, $numV, $sexeV, $groupV);
                                                
                                        break;

                                    case 3:

                                    $table = "infermier"; 
                                    $champ = "idInfermier";
                                    $id    = $id;
                                    
									$nomC	 = "nomInfermier";
									$prenomC = "prenomInfermier";
									$dateNC	 = "dateNaissInfermier";
									$lieuNC	 = "lieuNaissInfermier";
									$adressC = "adresseInfermier";
									$mailC   = "emailInfermier";
									$numC	 = "numTelInfermier";
									$sexeC	 = "sexeInfermier";
									$groupC	 = "groupageInfermier";

									$nomV	 = $nom;
									$prenomV = $prenom;
									$dateNV	 = $dateNaiss;
									$lieuNV	 = $lieuNaiss;
									$adressV = $adresse;
									$mailV   = $mail;
									$numV	 = $tel;
									$sexeV	 = $sexe;
									$groupV	 = $groupage;

                                    updateProfil($table, $champ, $id, $nomC, $prenomC, $dateNC, $lieuNC, $adressC, $mailC, $numC, $sexeC, $groupC, $nomV, $prenomV, $dateNV, $lieuNV, $adressV, $mailV, $numV, $sexeV, $groupV);
                                                
                                        break;
                                }        
                            }
                        
                        $reponse->closeCursor();
					}
					catch(Exception $e)
					{
					        die('Erreur : '.$e->getMessage());
					} 				
	} 

header('Location: ../../profil.php');

?>