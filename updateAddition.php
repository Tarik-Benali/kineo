<?php
	//include("includes/historique.php");
	include("includes/functions.php");

	global $con;

	$conGlobal = $con;  

	$nomBD 		= $_REQUEST['nomCabinet'];

	global $host_name;
    global $db_user_name;
    global $db_password;

    $nomB = crypterNomDeLaBase($nomBD);

	$con  = mysqli_connect($host_name,$db_user_name,$db_password,$nomB);

		$addition 	= mysqli_real_escape_string($con, $_REQUEST['addition']);
		$idAddition = mysqli_real_escape_string($con, $_REQUEST['idAddition']);
	       	        
	    $ceMoment   = date("Y-m-d H:i:s");

		// Check connection
		if ($con->connect_error) {
		    die("Connection failed: " . $con->connect_error);
		}

		$sql = "UPDATE `addition` SET `addition`='$addition' WHERE id_addition ='$idAddition'";

		if ($con->query($sql) === TRUE) {

			header('location: majRecette.php');
		    
		} else {
		    echo "Error updating record: " . $con->error;
		}

$con->close();
?> 