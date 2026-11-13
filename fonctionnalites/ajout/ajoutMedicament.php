<?php

if ($_REQUEST['nameMedicament'] && $_REQUEST['cabinet'] && $_REQUEST['faiseur']) {

	include("../../includes/historique.php");
	include("../../includes/functions.php");
		
        global $con;

		
		$ceMoment 		= date("Y-m-d H:i:s");
		$nameMedicament = mysqli_real_escape_string($con, $_REQUEST['nameMedicament']);
		$typeMedicament = mysqli_real_escape_string($con, $_REQUEST['typeMedicament']);
		$dosage 		= mysqli_real_escape_string($con, $_REQUEST['dosageMedicament']);
		$code           = mysqli_real_escape_string($con, $_REQUEST['codeMedicament']);
        $nomBD          = mysqli_real_escape_string($con, $_REQUEST['cabinet']);
        $idFaiseur      = mysqli_real_escape_string($con, $_REQUEST['faiseur']);

        //echo $ceMoment."<br>".$nameMedicament."<br>".$typeMedicament."<br>".$dosage."<br>".$code."<br>".$nomBD."<br>".$idFaiseur;

        
		global $host_name;
        global $db_user_name;
        global $db_password;

        $database = crypterNomDeLaBase($nomBD);

						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            $reponse = $bdd->query("INSERT INTO `medicament`(`code`, `nomMedicament`, `typeMedicament`, `dosageMedicament`) VALUES ('$code','$nameMedicament','$typeMedicament','$dosage')");

                            $reponse->closeCursor();
                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 

    header('location: ../../medecin.php');   

} else {
    header('location: ../../auth/logout.php');
}                         

?>