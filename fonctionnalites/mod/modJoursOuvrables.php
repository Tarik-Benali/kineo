<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

	if (isset($_REQUEST['nomCabinet']) && $_REQUEST['nomCabinet'] !="") {

		global $con;

		$conGlobal = $con;  

		$nomBD 		= $_REQUEST['nomCabinet'];

		global $host_name;
	    global $db_user_name;
	    global $db_password;

	    $nomB       = crypterNomDeLaBase($nomBD);

	    $ceMoment = date("Y-m-d H:i:s");

		$con = mysqli_connect($host_name,$db_user_name,$db_password,$nomB);

			$nomBD 		= mysqli_real_escape_string($con, $_REQUEST['nomCabinet']);
			$samedi 	= mysqli_real_escape_string($con, $_REQUEST['samedi']);
			$dimanche 	= mysqli_real_escape_string($con, $_REQUEST['dimanche']);
			$lundi 		= mysqli_real_escape_string($con, $_REQUEST['lundi']);
			$mardi 		= mysqli_real_escape_string($con, $_REQUEST['mardi']);
			$mercredi 	= mysqli_real_escape_string($con, $_REQUEST['mercredi']);
			$jeudi 		= mysqli_real_escape_string($con, $_REQUEST['jeudi']);
			$vendredi 	= mysqli_real_escape_string($con, $_REQUEST['vendredi']);

			$d_samedi 	= "";
			$d_dimanche = "";
			$d_lundi 	= "";
			$d_mardi 	= "";
			$d_mercredi = "";
			$d_jeudi 	= "";
			$d_vendredi = "";

			if (isset($_REQUEST['d_samedi'])) {
				$d_samedi 	= mysqli_real_escape_string($con, $_REQUEST['d_samedi']);
			}

			if (isset($_REQUEST['d_dimanche'])) {
				$d_dimanche = mysqli_real_escape_string($con, $_REQUEST['d_dimanche']);
			}

			if (isset($_REQUEST['d_lundi'])) {
				$d_lundi 	= mysqli_real_escape_string($con, $_REQUEST['d_lundi']);
			}

			if (isset($_REQUEST['d_mardi'])) {
				$d_mardi 	= mysqli_real_escape_string($con, $_REQUEST['d_mardi']);
			}

			if (isset($_REQUEST['d_mercredi'])) {
				$d_mercredi = mysqli_real_escape_string($con, $_REQUEST['d_mercredi']);
			}

			if (isset($_REQUEST['d_jeudi'])) {
				$d_jeudi 	= mysqli_real_escape_string($con, $_REQUEST['d_jeudi']);
			}

			if (isset($_REQUEST['d_vendredi'])) {
				$d_vendredi = mysqli_real_escape_string($con, $_REQUEST['d_vendredi']);
			}
			
			

			$faiseur 	= mysqli_real_escape_string($con, $_REQUEST['idFaiseur']);

			$sql1 = ""; 
			$sql2 = ""; 
			$sql3 = ""; 
			$sql4 = ""; 
			$sql5 = ""; 
			$sql6 = ""; 
			$sql7 = "";


			// Check connection
			if ($con->connect_error) {
			    die("Connection failed: " . $con->connect_error);
			}

			//Modification Samedi ***********************************************************************************************************************
			if ($d_samedi =="ouvrable") {
				$sql1 = "UPDATE `jours_ouvrables` SET `decision`='0'   WHERE `jour`='$samedi'";
				if ($con->query($sql1) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}else{
				$sql1 = "UPDATE `jours_ouvrables` SET `decision`='1'   WHERE `jour`='$samedi'";
				if ($con->query($sql1) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}

			//Modification Dimanche ***********************************************************************************************************************
			if ($d_dimanche =="ouvrable") {			
				$sql2 = "UPDATE `jours_ouvrables` SET `decision`='0' WHERE `jour`='$dimanche'";
				if ($con->query($sql2) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}else{
				$sql2 = "UPDATE `jours_ouvrables` SET `decision`='1'   WHERE `jour`='$dimanche'";
				if ($con->query($sql2) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}

			//Modification Lundi ***********************************************************************************************************************
			if ($d_lundi =="ouvrable") {
				$sql3 = "UPDATE `jours_ouvrables` SET `decision`='0'    WHERE `jour`='$lundi'";
				if ($con->query($sql3) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}else{
				$sql3 = "UPDATE `jours_ouvrables` SET `decision`='1'   WHERE `jour`='$lundi'";
				if ($con->query($sql3) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}

			//Modification Mardi ***********************************************************************************************************************
			if ($d_mardi =="ouvrable") {
				$sql4 = "UPDATE `jours_ouvrables` SET `decision`='0' WHERE `jour`='$mardi'";
				if ($con->query($sql4) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}else{
				$sql4 = "UPDATE `jours_ouvrables` SET `decision`='1'   WHERE `jour`='$mardi'";
				if ($con->query($sql4) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}

			//Modification Mercredi ***********************************************************************************************************************
			if ($d_mercredi =="ouvrable") {
				$sql5 = "UPDATE `jours_ouvrables` SET `decision`='0' WHERE `jour`='$mercredi'";
				if ($con->query($sql5) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}else{
				$sql5 = "UPDATE `jours_ouvrables` SET `decision`='1'   WHERE `jour`='$mercredi'";
				if ($con->query($sql5) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}

			//Modification Jeudi ***********************************************************************************************************************
			if ($d_jeudi =="ouvrable") {
				$sql6 = "UPDATE `jours_ouvrables` SET `decision`='0' WHERE `jour`='$jeudi'";
				if ($con->query($sql6) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}else{
				$sql6 = "UPDATE `jours_ouvrables` SET `decision`='1'   WHERE `jour`='$jeudi'";
				if ($con->query($sql6) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}

			//Modification Vendredi ***********************************************************************************************************************
			if ($d_vendredi =="ouvrable") {
				$sql7 = "UPDATE `jours_ouvrables` SET `decision`='0' WHERE `jour`='$vendredi'";
				if ($con->query($sql7) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}else{
				$sql7 = "UPDATE `jours_ouvrables` SET `decision`='1'   WHERE `jour`='$vendredi'";
				if ($con->query($sql7) === TRUE) {
					//hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
				} else {
				    echo "Error updating record: " . $con->error;
				}
			}

			$con->close();

			header('location: ../../gestionCabinet.php');
			
	}else{
		header('location: ../../auth/logout.php');
	}
?> 