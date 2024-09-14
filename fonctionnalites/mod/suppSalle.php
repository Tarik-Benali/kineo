<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;

		$nomBD 	= $_REQUEST['nomBD'];

		$nomB 	    = crypterNomDeLaBase($nomBD);

		//$motifSupp  = str_replace("'","\'",$_REQUEST['motifSuppression']);
		$motifSupp    = $_REQUEST['motifSuppression'];


		$con    = mysqli_connect($host_name, $db_user_name, $db_password, $nomB);
		$conHis = mysqli_connect($host_name, $db_user_name, $db_password, $baseGlobale);

		$id_salle 	= mysqli_real_escape_string($con, $_REQUEST['idSalle']);
		$faiseur 	= mysqli_real_escape_string($con, $_REQUEST['faiseur']);
		$idCabinet 	= mysqli_real_escape_string($con, $_REQUEST['idCabinet']);
		$motifSupp 	= mysqli_real_escape_string($con, $motifSupp);
		$ceMoment 	= date("Y-m-d H:i:s");


		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		 }

		//$del="DELETE FROM patient WHERE idPatient='$identifiantP'";
		 $del="UPDATE `salle` SET `etat_salle`='0',`motif_supp_salle`='$motifSupp' WHERE `id_salle`= '$id_salle'";
			if ($con->query($del) === TRUE) {

					hisSuppSalle($conHis, $ceMoment, $idCabinet, $faiseur, $id_salle);
					header('location: ../../salle.php');
			} else {
					echo "Error deleting record: " . $con->error;
			}

		mysqli_close($con);
?> 