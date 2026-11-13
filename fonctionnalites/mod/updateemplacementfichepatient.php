<?php

	 include("../../includes/functions.php");


if (isset($_REQUEST['idPatients'])) {

		$idPatient 	= $_REQUEST['idPatients'];
		$idPatient 	= str_replace("'","\'",$idPatient);

		$armoire 	= $_REQUEST['armoires'];
		$armoire 	= str_replace("'","\'",$armoire);

	    $boite 		= $_REQUEST['boites'];
	    $boite 		= str_replace("'","\'",$boite);

	    $nomCabinet		= $_REQUEST['nomCabinets'];
		$nomCabinet		= str_replace("'","\'",$nomCabinet);

	       	            
		global $host_name;
		global $db_user_name;
		global $db_password;	

		$database = crypterNomDeLaBase($nomCabinet);    
	

					try
					{
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

						$rep = $bdd->query("UPDATE `emplacement_fiche_patient` SET `armoire`='$armoire',`boite`='$boite' WHERE `idPatient`='$idPatient'");

						$rep->closeCursor();
					}
					catch(Exception $e)
					{
					        die('Erreur : '.$e->getMessage());
					} 	

					echo "armoir: ".$armoire." boite: ".$boite." idPatient: ".$idPatient." nom cabinet: ".$nomCabinet;

				
				}else{
					echo "string";
				} 

header('Location: ../../dossierPatient.php');

?>