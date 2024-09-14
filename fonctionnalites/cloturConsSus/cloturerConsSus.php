<?php

   include("../../includes/functions.php");


	$nomCabinet 	  = $_GET["nomCabinet"]; 
  $nomCabinet     = crypterNomDeLaBase($nomCabinet);
	$idConsultation = $_GET["idConsultation"];

		$database = "$nomCabinet";
    global $host_name;
    global $baseGlobale;
    global $db_user_name;
    global $db_password;
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("UPDATE consultations SET etatCons='0' WHERE idConsultation = '$idConsultation'");

                           
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 

header('Location: ../../consultationSus.php');
?>