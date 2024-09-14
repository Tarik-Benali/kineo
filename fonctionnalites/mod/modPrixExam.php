<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

if ($_REQUEST['nomBD']) {

	$nomBD 	= $_REQUEST['nomBD'];
	$nomBD  = crypterNomDeLaBase($nomBD); 


	global $host_name;
    global $baseGlobale;
    global $db_user_name;
    global $db_password;

	$database = "$nomBD";

		$con = mysqli_connect($host_name, $db_user_name, $db_password, $nomBD);

		$idExamen 		= mysqli_real_escape_string($con, $_REQUEST['idExamen']);

		$idMedecin 	  	= mysqli_real_escape_string($con, $_REQUEST['idMedecin']);

		$idCabinet 	 	= mysqli_real_escape_string($con, $_REQUEST['idCabinet']);

	    $prixExamen		= mysqli_real_escape_string($con, $_REQUEST['prixExamen']);
	       	        
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

		$sql = "UPDATE prix SET prixExamen='$prixExamen' WHERE idExamen='$idExamen'";

		if ($con->query($sql) === TRUE) {

			//hisModPatient($con, $ceMoment, $idCabinet, $faiseur, $identifiantP);
			header('location: ../../gestionPrix.php');
		    
		} else {
		    echo "Error updating record: " . $con->error;
		}

$con->close();

}else{

	echo "Error updating record: " . $con->error;

}

?>
