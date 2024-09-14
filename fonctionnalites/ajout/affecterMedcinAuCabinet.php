<?php
    include("../../auth/auth.php");
	include("../../includes/functions.php");

    global $host_name;
    global $baseGlobale;
    global $db_user_name;
    global $db_password;

    if (isset($_SESSION['nomDeCeCabinet'])) {

        $baseglobal   = $baseGlobale;
        $nomCabinet   = $_SESSION['nomDeCeCabinet'];
        $nomCabinet   = str_replace("'","\'",$nomCabinet);
        $nomCabinet   = crypterNomDeLaBase($nomCabinet);

        $idCabinet    = $_SESSION['idDeCeCabinet'];
    
		$con = mysqli_connect($host_name, $db_user_name, $db_password, $baseglobal);

		
		$ceMoment 		= date("Y-m-d H:i:s");
		$idMedecin 		= mysqli_real_escape_string($con, $_REQUEST['idMedecin']);


						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);  
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("INSERT INTO `relationmedcab`(`idCabinet`, `idMedecin`) VALUES ('$idCabinet','$idMedecin')");   
                           
                                //ajoutExamenDansBDDLocal($nomBD,$examen,$obj,$principe,$dossier,$precau);
                                //hisAjoutExamen($con, $ceMoment , $idCabinet, $idFaiseur, $nomBD);
                                

                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
        header('location: ../../medecin.php'); 
        
    }
    else{

        header('location: ../../404.php');

    }

?> 