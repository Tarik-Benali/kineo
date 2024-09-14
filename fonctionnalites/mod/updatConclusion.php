<?php

	 include("../../includes/functions.php");


if ($_REQUEST['conclusion']) {

		$conclusion 	= $_POST['conclusion'];
		$conclusion 	= str_replace("'","\'",$conclusion);

	    $idConsultation = $_POST['idConsultation'];
	    $idConsultation = str_replace("'","\'",$idConsultation);

	    $nomCabinet		= $_POST['nomCabinet'];
		$nomCabinet		= str_replace("'","\'",$nomCabinet);
		$nomCabinet 	= crypterNomDeLaBase($nomCabinet);
	       	            

		$database = "$nomCabinet";

		global $host_name;
        global $baseGlobale;
        global $db_user_name;
        global $db_password;    
	

					try
					{
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

						$rep = $bdd->query("UPDATE consultations SET conclusion='$conclusion' WHERE idConsultation = '$idConsultation'");

						$rep->closeCursor();
					}
					catch(Exception $e)
					{
					        die('Erreur : '.$e->getMessage());
					} 	

				
				} 

header('Location: ../../consultationSus.php');

?>