<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");
        
    if (isset($_REQUEST['prix']) && isset($_REQUEST['idCons']) && isset($_REQUEST['cabinet'])) {
        
        global $con;
		
		$ceMoment 	= date("Y-m-d H:i:s");
		$prix 		= mysqli_real_escape_string($con, $_REQUEST['prix']);
		$idCons 	= mysqli_real_escape_string($con, $_REQUEST['idCons']);
		$nomBD 		= mysqli_real_escape_string($con, $_REQUEST['cabinet']);
		
		global $host_name;
		global $db_user_name;
		global $db_password;

        $database         = crypterNomDeLaBase($nomBD);

            try
                    { 
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);
                                                     
                        $reponse = $bdd->query("SELECT * FROM `caisse` WHERE `idConsultation` = '$idCons'");
                        
                        $nbr = $reponse->rowCount();

                        if ($nbr == 0) {

                                inserupdatedconsprice($nomBD,$idCons,$prix,$ceMoment);        
                        }else{
                                updateupdatedconsprice($nomBD,$idCons,$prix,$ceMoment);
                        }

                        $reponse->closeCursor();
                    }

            catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
    }
?> 