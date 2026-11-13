<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

if (isset($_REQUEST['nomBD'])) {

	$nomBD 	= $_REQUEST['nomBD'];
	$nomBD  = crypterNomDeLaBase($nomBD); 

	

	global $host_name;
    global $baseGlobale;
    global $db_user_name;
    global $db_password;

	$database = "$nomBD";

		$con = mysqli_connect($host_name, $db_user_name, $db_password, $nomBD);

		$idPrixConsultation = mysqli_real_escape_string($con, $_REQUEST['idPrixConsultation']);

		$idMedecin 	  		= mysqli_real_escape_string($con, $_REQUEST['idMedecin']);

		$idCabinet 	 		= mysqli_real_escape_string($con, $_REQUEST['idCabinet']);

	    $prixConsultation	= mysqli_real_escape_string($con, $_REQUEST['prixConsultation']);
	       	              													   	        
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

		$sql = "UPDATE prixconsultation SET prixConsultation='$prixConsultation' WHERE idPrixConsultation='$idPrixConsultation'";

		if ($con->query($sql) === TRUE) {

			//hisModPatient($con, $ceMoment, $idCabinet, $faiseur, $identifiantP);
			header('location: ../../gestionPrix.php');
		    
		} else {
		    echo "Error updating record: " . $con->error;
		}

$con->close();

}else if(isset($_REQUEST['nomCabinet']) && isset($_REQUEST['duree'])){

	$nomBD 	= $_REQUEST['nomCabinet'];
	$nomBD  = crypterNomDeLaBase($nomBD); 

	global $host_name;
    //global $baseGlobale;
    global $db_user_name;
    global $db_password;

	//$database = "$nomBD";

		$con = mysqli_connect($host_name, $db_user_name, $db_password, $nomBD);

		$idDureeEntreSeances = mysqli_real_escape_string($con, $_REQUEST['idDureeEntreSeances']);
		$idMedecin 	  		 = mysqli_real_escape_string($con, $_REQUEST['idMedecin']);
	    $duree	             = mysqli_real_escape_string($con, $_REQUEST['duree']);
           													   	        
	    $ceMoment = date("Y-m-d H:i:s");

		// Check connection
		if ($con->connect_error) {
		    die("Connection failed: " . $con->connect_error);
		}

		$sql = "UPDATE dureeTemporelleEntreLesSeances SET espace_entre_seances='$duree' WHERE id ='$idDureeEntreSeances'";

		if ($con->query($sql) === TRUE) {

			//hisModPatient($con, $ceMoment, $idCabinet, $faiseur, $identifiantP);
			header('location: ../../gestionCabinet.php');
		    
		} else {
		    echo "Error updating record: " . $con->error;
		}

$con->close();

}else if(isset($_REQUEST['nomCab']) && isset($_REQUEST['ouverture'])){

	$nomBD 	= $_REQUEST['nomCabinet'];
	$nomBD  = crypterNomDeLaBase($nomBD); 

	global $host_name;
    //global $baseGlobale;
    global $db_user_name;
    global $db_password;

	//$database = "$nomBD";    

		$con = mysqli_connect($host_name, $db_user_name, $db_password, $nomBD);

		$idCabinet 			 = mysqli_real_escape_string($con, $_REQUEST['idCabinet']);
		$idMedecin 	  		 = mysqli_real_escape_string($con, $_REQUEST['idMedecin']);
	    $nomCabinet	         = mysqli_real_escape_string($con, $_REQUEST['nomCab']);
	    $ouverture	         = mysqli_real_escape_string($con, $_REQUEST['ouverture']);
	    $fermiture	         = mysqli_real_escape_string($con, $_REQUEST['fermiture']);
           													   	        
	    $ceMoment = date("Y-m-d H:i:s");

		// Check connection
		if ($con->connect_error) {
		    die("Connection failed: " . $con->connect_error);
		}

		$sql = "UPDATE cabinet SET nomCabinet='$nomCabinet',`ouverture`='$ouverture',`fermeture`='$fermiture' WHERE idCabinet ='$idCabinet'";

		if ($con->query($sql) === TRUE) {

			//hisModPatient($con, $ceMoment, $idCabinet, $faiseur, $identifiantP);
			header('location: ../../gestionCabinet.php');
		    
		} else {
		    echo "Error updating record: " . $con->error;
		}

$con->close();

}else if(isset($_REQUEST['nomCabine']) && isset($_REQUEST['nbrPatSea'])){

	$nomBD 	= $_REQUEST['nomCabine'];
	$nomBD  = crypterNomDeLaBase($nomBD); 

	global $host_name;
    //global $baseGlobale;
    global $db_user_name;
    global $db_password;

	//$database = "$nomBD";    

		$con = mysqli_connect($host_name, $db_user_name, $db_password, $nomBD);

		$idMedecin 	  = mysqli_real_escape_string($con, $_REQUEST['idMedecin']);
		$idCabinet 	  = mysqli_real_escape_string($con, $_REQUEST['idCabinet']);
	    $nbrPatParSea = mysqli_real_escape_string($con, $_REQUEST['nbrPatSea']);
           													   	        
	    $ceMoment = date("Y-m-d H:i:s");

		// Check connection
		if ($con->connect_error) {
		    die("Connection failed: " . $con->connect_error);
		}

		$sql = "UPDATE cabinet SET `nbrPatientParSeance`='$nbrPatParSea' WHERE idCabinet ='$idCabinet'";

		if ($con->query($sql) === TRUE) {

			//hisModPatient($con, $ceMoment, $idCabinet, $faiseur, $identifiantP);
			header('location: ../../gestionCabinet.php');
		    
		} else {
		    echo "Error updating record: " . $con->error;
		}

$con->close();

}else if(isset($_REQUEST['nomCabinets']) && isset($_REQUEST['pourcentage'])){

	$nomBD 	= $_REQUEST['nomCabinets'];
	$nomBD  = crypterNomDeLaBase($nomBD); 

	global $host_name;
    global $db_user_name;
    global $db_password;

	//$database = "$nomBD";    

		$con = mysqli_connect($host_name, $db_user_name, $db_password, $nomBD);

		$idMedecin 	  = mysqli_real_escape_string($con, $_REQUEST['idMedecin']);
		$idRelation   = mysqli_real_escape_string($con, $_REQUEST['idRelation']);
	    $pourcentage  = mysqli_real_escape_string($con, $_REQUEST['pourcentage']);

	    if ($pourcentage < 101 || $pourcentage > 0) {
           													   	        
		    $ceMoment = date("Y-m-d H:i:s");

			// Check connection
			if ($con->connect_error) {
			    die("Connection failed: " . $con->connect_error);
			}

			$sql = "UPDATE gestionrecettepracitien SET `pourcentage`='$pourcentage' WHERE id ='$idRelation'";

			if ($con->query($sql) === TRUE) {

				//hisModPatient($con, $ceMoment, $idCabinet, $faiseur, $identifiantP);
				header('location: ../../gestionCabinet.php');
			    
			} else {
			    echo "Error updating record: " . $con->error;
			}
		}else{
			header('location: ../../gestionCabinet.php');
		}	

$con->close();

}else if(isset($_REQUEST['nomCabinet']) && isset($_REQUEST['idDureeSeances'])){

	$nomBD 	= $_REQUEST['nomCabinet'];
	$nomBD  = crypterNomDeLaBase($nomBD); 

	global $host_name;
    global $db_user_name;
    global $db_password;

	//$database = "$nomBD";    

		$con = mysqli_connect($host_name, $db_user_name, $db_password, $nomBD);

		$idMedecin 	  = mysqli_real_escape_string($con, $_REQUEST['idMedecin']);
		$idDureSean   = mysqli_real_escape_string($con, $_REQUEST['idDureeSeances']);
	    $duree_seance = mysqli_real_escape_string($con, $_REQUEST['duree_seance']);

           													   	        
	    $ceMoment = date("Y-m-d H:i:s");

		// Check connection
		if ($con->connect_error) {
		    die("Connection failed: " . $con->connect_error);
		}

		$sql = "UPDATE duree_rdv SET `duree`='$duree_seance' WHERE id_duree_rdv ='$idDureSean'";

		if ($con->query($sql) === TRUE) {

			//hisModPatient($con, $ceMoment, $idCabinet, $faiseur, $identifiantP);
			header('location: ../../gestionCabinet.php');
		    
		} else {
		    echo "Error updating record: " . $con->error;
		}

$con->close();

}else{

	echo "Error updating record: " . $con->error;

}

?>
