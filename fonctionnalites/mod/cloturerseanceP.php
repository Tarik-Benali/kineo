<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

	if (isset($_REQUEST['nomCabinet']) && $_REQUEST['nomCabinet'] !="" && isset($_REQUEST['idSeance']) && $_REQUEST['idSeance'] !="") {

		global $con; 

		$conGlobal = $con;  

		$idCab 		= $_REQUEST['idCab'];
		$idPat 		= $_REQUEST['idPat'];
		$idRDV 		= $_REQUEST['idRDV'];
		$medecin 	= $_REQUEST['medecin'];
		$nomBD 		= $_REQUEST['nomCabinet'];
		$idSeance 	= $_REQUEST['idSeance'];
		$addition 	= $_REQUEST['addition'];
		$remrq		= $_REQUEST['remarqueseance'];


		$patientInfo = $_REQUEST['patientInfo'];

		$pat = explode("_",$patientInfo);

		$nomPatient = $pat[0];
		$prenomPatient = $pat[1];
		      

		global $host_name;
	    global $db_user_name;
	    global $db_password;

	    $nomB       = crypterNomDeLaBase($nomBD);

	    $ceMoment = date("Y-m-d H:i:s");

	    $date  = date("Y-m-d");
	    if (isset($_REQUEST["dateSeanceCloture"]) && $_REQUEST['dateSeanceCloture'] != "" && $_REQUEST['dateSeanceCloture'] != Null) {
	    	$date = $_REQUEST["dateSeanceCloture"];
	    }
	    $heure = date("H:i:s");

		$con = mysqli_connect($host_name,$db_user_name,$db_password,$nomB);

			if (isset($_REQUEST['medecin'])) {
				$medecin 	= mysqli_real_escape_string($con, $medecin);
			}
			
			//$idSeance 	= mysqli_real_escape_string($con, $idSeance);
			//$idPat		= mysqli_real_escape_string($con, $idPat);
			//$addition 	= mysqli_real_escape_string($con, $addition);
			//$idCab		= mysqli_real_escape_string($con, $idCab);
			//$idRDV		= mysqli_real_escape_string($con, $idRDV);
			$remrq		= mysqli_real_escape_string($con, $remrq);
			
			echo $remrq;
			
			if ($con->connect_error) {
			    die("Connection failed: " . $con->connect_error);
			}

			$sql = "UPDATE `rdv` SET `statut`='3',`remarque_fin_seance`='$remrq' WHERE `id`='$idRDV'";
			if ($con->query($sql) === TRUE) {
				insertAdditionCons($nomBD,$idPat,$idRDV,$medecin,$date,$heure,$addition,$nomPatient,$prenomPatient);
				//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
			} else {
			    echo "Error updating record: " . $con->error;
			}

			$con->close();

			//header("location: ../../seance.php");
			header("location: ../../medecin.php");
			
	}else{
		header('location: ../../auth/logout.php');
	}
?> 