<?php
	//include("../../includes/historique.php");
	include("../../includes/functions.php");

			
	if ($_REQUEST){

		$nomCabinet  = $_REQUEST['nomCabinets'];
		$idPraticien = $_REQUEST['idMedecin'];

	    $nomBD  = crypterNomDeLaBase($nomCabinet);

	    global $host_name;
	    global $db_user_name;
	    global $db_password;

            try
                {                    
                    $conn = new PDO("mysql:host=$host_name;dbname=$nomBD", $db_user_name, $db_password);
		  			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		  			$sql1 = "DELETE FROM users WHERE identifiant='$idPraticien'";
		  			$sql2 = "DELETE FROM medecin WHERE idMedecin='$idPraticien'";
		  			$sql3 = "DELETE FROM relationmedcab WHERE idMedecin='$idPraticien'";
		  			
		  			$conn->exec($sql1);
		  			$conn->exec($sql2);
		  			$conn->exec($sql3);
		  			
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
                $conn = null;

                header("Location: ../../gestionCabinet.php");
	                    
	} else if (isset($_REQUEST['rdv_patient'])) {

	      header("Location: ../../gestionCabinet.php");
	}else{

	      header("Location: ../../auth/logout.php");
		}
?>
