<?php

 	include("../../includes/functions.php");

   if(isset($_GET['monId'])){

        $receiver = (String) trim($_GET['idLautre']);
        $sender  = (String) trim($_GET['monId']);

		//$host_name = "localhost";
		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		$database = $baseGlobale;

			try
                {                                 
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                    // On recupere tout le contenu de la table news
                    $reponse = $bdd->query("INSERT INTO `amis`(`monID`, `amiID`, `demande`) VALUES ('$sender','$receiver','0');");   
                    $reponse->closeCursor();
                    echo " success ";
                }

             catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                    echo " " . $e->getMessage();
                } 
				

			try
                {                             
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                    // On recupere tout le contenu de la table news
                    $reponse = $bdd->query("INSERT INTO `amis`(`monID`, `amiID`, `demande`) VALUES ('$receiver','$sender','0');");   

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                } 
				
	}
?>				