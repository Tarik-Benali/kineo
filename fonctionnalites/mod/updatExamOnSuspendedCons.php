<?php
	 include("../../includes/functions.php");


if ($_REQUEST['typeExamen']) {

		$typeExamen 	= $_POST['typeExamen'];
		$typeExamen 	= str_replace("'","\'",$typeExamen);

		$idRelExamCons 	= $_POST['idRelExamCons'];
		$idRelExamCons 	= str_replace("'","\'",$idRelExamCons);

	    $resultExam		= $_POST['resultExam'];
		$resultExam 	= str_replace("'","\'",$resultExam);

	    $idConsultation = $_POST['idConsultation'];
		$idConsultation = str_replace("'","\'",$idConsultation);

	    $nomCabinet		= $_POST['nomCabinet'];
		$nomCabinet 	= str_replace("'","\'",$nomCabinet);
		$nomCabinet  	= crypterNomDeLaBase($nomCabinet);
	       	            

		$database = "$nomCabinet";

		global $host_name;
        global $baseGlobale;
        global $db_user_name;
        global $db_password;    
	

					try
					{
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

						$rep = $bdd->query("UPDATE relationexamcons SET resultExam='$resultExam' WHERE `idRelExamCons` = '$idRelExamCons' AND `idConsultation` = '$idConsultation' AND `typeExamen` = '$typeExamen' ");
						$rep->closeCursor();
					}
					catch(Exception $e)
					{
					        die('Erreur : '.$e->getMessage());
					} 	

				
				} 

header('Location: ../../consultationSus.php');

?>