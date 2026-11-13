<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");
        
    if (isset($_REQUEST['nomCabinet']) && isset($_REQUEST['idPatien']) && isset($_REQUEST['nbrSeance'])) {
        
        global $con;
		
		$ceMoment 	= date("Y-m-d H:i:s");
		$medecin    = mysqli_real_escape_string($con, $_REQUEST['medecin']);
        $idPatien   = mysqli_real_escape_string($con, $_REQUEST['idPatien']);
		$nbrSeance 	= mysqli_real_escape_string($con, $_REQUEST['nbrSeance']);
		$nomCabinet = mysqli_real_escape_string($con, $_REQUEST['nomCabinet']);
        $typeSeance = mysqli_real_escape_string($con, $_REQUEST['typeSeance']);
		
		global $host_name;
		global $db_user_name;
		global $db_password;

        if ($nbrSeance > 0 && $idPatien !="" && $nomCabinet !="") {

            for ($i=0; $i < $nbrSeance; $i++) { 
                 insertPrigramPatient($nomCabinet,$idPatien,$typeSeance);

                 echo $nomCabinet . " " . $idPatien . " " . $typeSeance;
            }
        }else{
            echo $nbrSeance . " " . $idPatien . " " . $nomCabinet;
        }

        header("location:../../rdvpatient.php?idPatient=".$idPatien."");  
    }
?> 