<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

	global $con;

	$conGlobal = $con;  

	$nomBD 		= $_REQUEST['nomBDU'];

	global $host_name;
    global $db_user_name;
    global $db_password;

    $nomB       = crypterNomDeLaBase($nomBD);

	$con = mysqli_connect($host_name,$db_user_name,$db_password,$nomB);

		$nomBD 		= mysqli_real_escape_string($con, $_REQUEST['nomBDU']);
		$idCabinet 	= mysqli_real_escape_string($con, $_REQUEST['idCabinetU']);
		$faiseur 	= mysqli_real_escape_string($con, $_REQUEST['faiseurU']);

		$IDMat    	= mysqli_real_escape_string($con, $_REQUEST['idMat_U']);

		$nomMat		= mysqli_real_escape_string($con, $_REQUEST['nom_materiel_U']);
		$numSerie 	= mysqli_real_escape_string($con, $_REQUEST['num_serie_Mat_U']);
		$etat 		= mysqli_real_escape_string($con, $_REQUEST['etatMateriel_U']);

		$id_emp   = mysqli_real_escape_string($con, $_REQUEST['emplacement_materiel_U']);
		$type_emp = mysqli_real_escape_string($con, $_REQUEST['emplacement_materiel_U_type']);
 
	     	        
	    $ceMoment = date("Y-m-d H:i:s");


	        /*echo $nomBD ."<br>";
	        echo $faiseur ."<br>";
	        echo $idCabinet ."<br>";
	        echo $IDSalle ."<br>";
	        echo $nom ."<br>";
	        echo $type ."<br>";
	        echo $etage ."<br>";
	        echo $etat ."<br>";*/


		// Check connection
		if ($con->connect_error) {
		    die("Connection failed: " . $con->connect_error);
		}

		$sql = "UPDATE `materiel` SET `nom`='$nomMat',`numeroSerie`='$numSerie',`etatMateriel`='$etat' WHERE `idMateriel` = '$IDMat'";



		if ($con->query($sql) === TRUE) {

			updateRelationSLP($nomBD,$IDMat,$id_emp,$type_emp);
			hisModMateriel($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
			header('location: ../../materiel.php');


		    
		} else {
		    echo "Error updating record: " . $con->error;
		}

$con->close();
?> 