<?php
	include("../../auth/auth.php");
	include("../../includes/functions.php");

if ($_REQUEST['id']) {

		$id 	     = $_POST['id'];
		$nomCabinet  = str_replace("'","\'",$_POST['nomCabinet']);
		$nomCabinet  = crypterNomDeLaBase($nomCabinet); 
 

	    if (isset($_REQUEST['motifCons']) && $_REQUEST['motifCons'] !="") {
	           	$motifCons   = str_replace("'","\'",$_POST['motifCons']);
	           }else{
	           			$motifCons = "aucun motif enregistré";
	           } 

		$database = "$nomCabinet";

		global $host_name;
        global $baseGlobale;
        global $db_user_name;
        global $db_password;	    
	
					try
					{
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

						$rep = $bdd->query("UPDATE rdv SET statut='1', motifCons='$motifCons' WHERE id='$id'");
						//statut 4 pour les patients passé chez le médecin.

						$rep->closeCursor();
					}
					catch(Exception $e)
					{
					        die('Erreur : '.$e->getMessage());
					}  	
				
				}

//echo "<h1>".$motifCons."</h1>";

	if (isset($_SESSION['idDeCeCabinet']) && $_SESSION['typeCompte'] =="2") {

            header("Location: ../../medecin.php");

    }elseif (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5") {
           
            header("Location: ../../rdvDuJour.php");
    }else{
    		header("Location: ../../auth/logout.php");
    }

?>