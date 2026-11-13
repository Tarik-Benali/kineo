<?php

	include("../../includes/functions.php");


	if (isset($_REQUEST['nomCabinet']) && isset($_REQUEST["idPatient"])) {

		$idPatient 	= $_REQUEST['idPatient'];

		$signal 	= $_REQUEST['signal'];

		$motifSignal = $_REQUEST['motifSignal'];
		$motifSignal = str_replace("'","\'",$motifSignal);
		       	            

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;	    

			try
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);

				$sql = "UPDATE patient SET patient_a_risque=?, motif_risque=? WHERE idPatient=?";
				$req = $bdd->prepare($sql);
				$req->execute([$signal,$motifSignal,$idPatient]);

	            
	            $req->closeCursor();
			}
			catch(Exception $e)
			{
			    die('Erreur : '.$e->getMessage());
			} 				
	} 

	header('Location: ../../rdvpatient.php?idPatient='.$idPatient);

?>