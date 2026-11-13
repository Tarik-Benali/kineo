<?php
	//include("../../includes/historique.php");
	include("../../includes/functions.php");

			
	if ($_REQUEST){

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

				  			$sql = "DELETE FROM rdv WHERE id='$idRDV'";
				  			$conn->exec($sql);
				  			
	                    }
	                catch(Exception $e)
	                    {
	                        die('Erreur : '.$e->getMessage());
	                    }
	                    $conn = null;
	}


	if (isset($_REQUEST['rdv_patient'])) {

	      header("Location: ../../mesRDV.php");
		}else{

	      header("Location: ../../auth/logout.php");
		}
?>
