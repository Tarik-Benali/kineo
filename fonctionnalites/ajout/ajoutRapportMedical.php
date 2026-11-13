<?php
	include("../../includes/functions.php");

    global $host_name;
    global $db_user_name;
    global $db_password;
    global $baseGlobale;

        $con    = mysqli_connect($host_name, $db_user_name, $db_password, $baseGlobale);
		
		$idCons 		= mysqli_real_escape_string($con, $_REQUEST['idCons']);
		$idPat 		    = mysqli_real_escape_string($con, $_REQUEST['idPat']);
        $ceMoment       = date("Y-m-d H:i:s");

        $natGeste       = mysqli_real_escape_string($con, $_REQUEST['natGeste']);
        $comptRend      = mysqli_real_escape_string($con, $_REQUEST['comptRend']);
        $typeAn         = mysqli_real_escape_string($con, $_REQUEST['typeAn']);


			try
                {
                                                 
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);  
 
                                
                    $reponse = $bdd->query("INSERT INTO `rapport_medical`(`idConsultation`,`idPatient`,`nature_geste`,`type_anesthesie`,`compte_rendu`,`emplty`) VALUES ('$idCons','$idPat','$natGeste','$typeAn','$comptRend','$ceMoment')");   
                    
                    $id_rapp = $bdd->lastInsertId();
                    
                    
                    $reponse->closeCursor();
                    echo "saved";
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
                                                  
                            
                                

                            

?> 