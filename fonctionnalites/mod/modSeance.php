<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

	if (isset($_REQUEST['nomCabinet']) && $_REQUEST['nomCabinet'] !="" && isset($_REQUEST['idSeance']) && $_REQUEST['idSeance'] !="") {

		global $con; 

		$conGlobal = $con;  

		$nomBD 		= $_REQUEST['nomCabinet'];

		global $host_name;
	    global $db_user_name;
	    global $db_password;

	    $nomB       = crypterNomDeLaBase($nomBD);

	    $ceMoment = date("Y-m-d H:i:s");

		$con = mysqli_connect($host_name,$db_user_name,$db_password,$nomB);

			if (isset($_REQUEST['medecin'])) {
				$medecin 	= mysqli_real_escape_string($con, $_REQUEST['medecin']);
			}
			
			$idSeance 	= mysqli_real_escape_string($con, $_REQUEST['idSeance']);
			$etatSeance	= mysqli_real_escape_string($con, $_REQUEST['etatSeance']);
			
			
			if ($con->connect_error) {
			    die("Connection failed: " . $con->connect_error);
			}

			//Modification Samedi ***********************************************************************************************************************
				$sql = "UPDATE `seance` SET `etat`='$etatSeance' WHERE `id_seance`='$idSeance'";
				if ($con->query($sql) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}

			$con->close();

			if ($etatSeance =="1") {
				header("location: ../../seance.php?idSeance=".$idSeance."");
			}else if($etatSeance =="2"){
				updateRDVStatsWheneSeanceIsClosed($nomBD,$idSeance);
				header("location: ../../medecin.php");
			}	
			
	}else{
		header('location: ../../auth/logout.php');
	}
?> 