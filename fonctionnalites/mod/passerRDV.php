<?php
	 include("../../auth/auth.php");
	 include("../../includes/functions.php");


if ($_REQUEST['id']) {

		$id 	     = $_REQUEST['id'];
	    $nomCabinet	 = $_REQUEST['nomCabinet'];
	    $idPatient	 = $_REQUEST['idPat'];

	    $motiCons 	 = getMotifCons($nomCabinet, $id);

	    $nomCabinet  = crypterNomDeLaBase($nomCabinet);
              

		$database = "$nomCabinet";

		global $host_name;
        global $baseGlobale;
        global $db_user_name;
        global $db_password;    
	
					try
					{
						$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
						$bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

						$rep = $bdd->query("UPDATE rdv SET statut='4' WHERE id='$id'");
						//statut 4 pour les patients passé chez le médecin.

						$rep->closeCursor();
					}
					catch(Exception $e)
					{
					        die('Erreur : '.$e->getMessage());
					} 	
				
				} 

//echo "<h1>".$motiCons."</h1>";


	if (isset($_SESSION['idDeCeCabinet']) && $_SESSION['typeCompte'] =="2") {

            header("Location: ../../consultation.php?motiff=$motiCons&idPatRDV=$idPatient");

    }elseif (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5") {
           
            header("Location: ../../rdvDuJour.php");
    }else{
    		header("Location: ../../auth/logout.php");
    }

?>