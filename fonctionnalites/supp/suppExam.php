<?php

	include("../../includes/historique.php");
	include("../../includes/functions.php");

		global $host_name;
		global $db_user_name;
		global $db_password;

		global $con;

		$idExamen  = $_REQUEST['idExamen'];

		$nomBD     = $_REQUEST['bdd']; 

		$faiseur   = $_REQUEST['faiseur'];

		$idCabinet = $_REQUEST['idCabinet'];

		$ceMoment  = date("Y-m-d H:i:s");


		echo "<h1>" . $ceMoment. "<br>" . $idCabinet. "<br>". $nomBD . "<br>" . $faiseur. "<br>" . $idExamen . "</h1>";


		try {
		  $conn = new PDO("mysql:host=$host_name;dbname=$nomBD", $db_user_name, $db_password);
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		  $sql = "DELETE FROM examens WHERE idExamen='$idExamen'";

		  $conn->exec($sql);

		  deleteRelationExamCab($idCabinet,$idExamen);
		  hisSuppExamen($con, $ceMoment, $idCabinet, $faiseur, $idExamen);
		  
		} 
		catch(PDOException $e) {
		  echo $sql . "<br>" . $e->getMessage();
		}

        $conn = null;
        header('location: ../../allExams.php');


	function deleteRelationExamCab($idCabinet,$idExamen){

			global $host_name;
			global $baseGlobale;
			global $db_user_name;
			global $db_password;

			try {
			  $conn = new PDO("mysql:host=$host_name;dbname=$baseGlobale", $db_user_name, $db_password);
			  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			  $sql = "DELETE FROM relcabexamens WHERE idCabinet='$idCabinet' AND idExamen='$idExamen'";
			  $conn->exec($sql);
			} 
			catch(PDOException $e) {
			  echo $sql . "<br>" . $e->getMessage();
			}
	        $conn = null;
	}
	
?>
