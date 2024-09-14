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

		$IDLit    = mysqli_real_escape_string($con, $_REQUEST['idLit_U']);

		$num 	= mysqli_real_escape_string($con, $_REQUEST['num_lit_U']);
		$type 	= mysqli_real_escape_string($con, $_REQUEST['nature_lit_U']);
		$etat 	= mysqli_real_escape_string($con, $_REQUEST['etat_lit_U']);
		$id_emp = mysqli_real_escape_string($con, $_REQUEST['emplacement_lit_U']);
 
	     	        
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

		$sql = "UPDATE `lit` SET `num_lit`='$num',`nature_lit`='$type',`etat_lit`='$etat',`id_emplacement`='$id_emp' WHERE `id_lit` = '$IDLit'";



		if ($con->query($sql) === TRUE) {

			hisModLit($conGlobal, $ceMoment, $idCabinet, $faiseur, $IDLit);
			header('location: ../../lit.php');
		    
		} else {
		    echo "Error updating record: " . $con->error;
		}

$con->close();
?> 