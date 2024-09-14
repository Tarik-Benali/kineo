<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

	global $host_name;
    global $baseGlobale;
    global $db_user_name;
    global $db_password;
    
		$con = mysqli_connect($host_name, $db_user_name, $db_password, $baseGlobale);

		$identifiantP 	= mysqli_real_escape_string($con, $_REQUEST['idPat']);

		$faiseur 	  	= mysqli_real_escape_string($con, $_REQUEST['faiseur']);

		$idCabinet 	 	= mysqli_real_escape_string($con, $_REQUEST['idCabinet']);

	    $name 			= mysqli_real_escape_string($con, $_REQUEST['name']);

	    $prenom 		= mysqli_real_escape_string($con, $_REQUEST['prenom']);

	    $dateN 			= mysqli_real_escape_string($con, $_REQUEST['dateNaiss']);

	    $lieuNaiss 		= mysqli_real_escape_string($con, $_REQUEST['lieuNaissPatient']);

	    $adresse 		= mysqli_real_escape_string($con, $_REQUEST['adresse']);

	    $email			= mysqli_real_escape_string($con, $_REQUEST['mail']);

	    $phone			= mysqli_real_escape_string($con, $_REQUEST['tel']);

	    $sexe			= mysqli_real_escape_string($con, $_REQUEST['sexe']);

	    $phone_3M 		= mysqli_real_escape_string($con, $_REQUEST['phone_3M']);

	    $phone_2M		= mysqli_real_escape_string($con, $_REQUEST['phone_2M']);

	    $professionM	= mysqli_real_escape_string($con, $_REQUEST['professionM']);

	    $bilanM			= mysqli_real_escape_string($con, $_REQUEST['bilanM']);

	       

	    $groupeSanguin 	= mysqli_real_escape_string($con, $_REQUEST['groupeSanguin']);

        $dateNaissance = date('Y-m-d', strtotime($dateN));
	       	        
	    $ceMoment = date("Y-m-d H:i:s");

	        /*echo $identifiantP ."<br>";
	        echo $faiseur ."<br>";
	        echo $idCabinet ."<br>";
	        echo $name ."<br>";
	        echo $prenom ."<br>";
	        echo $dateNaissance ."<br> à " . $lieuNaiss;
	        echo $adresse ."<br>";
	        echo $email ."<br>";
	        echo $phone ."<br>";
	        echo $sexe ."<br>";
	        echo $groupeSanguin ."<br>";*/

		// Check connection
		if ($con->connect_error) {
		    die("Connection failed: " . $con->connect_error);
		}

		$sql = "UPDATE patient SET nomPatient='$name', prenomPatient='$prenom', dateNaissPatient='$dateNaissance', lieuNaissPatient='$lieuNaiss', adressePatient='$adresse', emailPatient ='$email', numTelPatient='$phone', sexePatient='$sexe', groupagePatient='$groupeSanguin', profession ='$professionM', bilan='$bilanM', phone_2='$phone_2M', phone_3='$phone_3M' WHERE idPatient='$identifiantP'";

		if ($con->query($sql) === TRUE) {

			$sql2 = "UPDATE `rdv` SET `nomP`='$name',`prenoP`='$prenom',`mail`='$email',`tel`='$phone' WHERE `idPatient` = '$identifiantP';";

			if ($con->query($sql2) === TRUE) {

				hisModPatient($con, $ceMoment, $idCabinet, $faiseur, $identifiantP);
				header('location: ../../affichagePatients.php');
			    
			}else{
				hisModPatient($con, $ceMoment, $idCabinet, $faiseur, $identifiantP);
				header('location: ../../affichagePatients.php');
			}
		    
		} else {
		    echo "Error updating record: " . $con->error;
		}

$con->close();
?> 