<?php
	//include("../../includes/historique.php");
	include("includes/functions.php");
			
	if (isset($_REQUEST['path']) && !empty($_REQUEST['path']) && isset($_REQUEST['idImg']) && !empty($_REQUEST['idImg']) && isset($_REQUEST['nomCabinet']) && !empty($_REQUEST['nomCabinet'])){

		$path 		= $_REQUEST['path'];
		$idImg 		= $_REQUEST['idImg'];
		$idPatient  = $_REQUEST['idPatient'];
		$nomCabinet = $_REQUEST['nomCabinet'];
	   
	    $nomBD  = crypterNomDeLaBase($nomCabinet);

	    global $host_name;
	    global $db_user_name;
	    global $db_password;


		$idRDV   	= str_replace("'","\'",$_REQUEST['idRDV']);

	                try
	                    {                    
	                        $conn = new PDO("mysql:host=$host_name;dbname=$nomBD", $db_user_name, $db_password);
				  			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				  			$sql = "DELETE FROM dossierpatient WHERE id_document='$idImg'";

				  			if ($conn->exec($sql)) {
				  				unlink($path);
	      						header("Location: rdvpatient.php?idPatient=".$idPatient);
				  			}else{

	      						header("Location: medecin.php");
				  			}
				  			
				  			
	                    }
	                catch(Exception $e)
	                    {
	                        die('Erreur : '.$e->getMessage());
	                    }
	                    $conn = null;
	}
?>
