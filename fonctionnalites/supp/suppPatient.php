<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

	global $host_name;
    global $baseGlobale;
    global $db_user_name;
    global $db_password;

		$con = mysqli_connect($host_name, $db_user_name, $db_password, $baseGlobale);

		$identifiantP = mysqli_real_escape_string($con, $_REQUEST['idPat']);
		$faiseur 	  = mysqli_real_escape_string($con, $_REQUEST['faiseur']);
		$idCabinet 	  = mysqli_real_escape_string($con, $_REQUEST['idCabinet']);
		$ceMoment 	  = date("Y-m-d H:i:s");


		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		 }

		//$del="DELETE FROM patient WHERE idPatient='$identifiantP'";
		 $del="UPDATE relpatcab SET etat='0' WHERE idPatient='$identifiantP' AND idCabinet = '$idCabinet'";
			if ($con->query($del) === TRUE) {

					hisSuppPatient($con, $ceMoment, $idCabinet, $faiseur, $identifiantP);
					header('location: ../../affichagePatients.php');
			} else {
					echo "Error deleting record: " . $con->error;
			}

		mysqli_close($con);
?> 