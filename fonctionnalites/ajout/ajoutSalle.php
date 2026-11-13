<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

    global $host_name;
    global $db_user_name;
    global $db_password;
    global $baseGlobale;

        $nomBD  = $_REQUEST['nomBD'];

        echo $nomBD;

        $nomB       = crypterNomDeLaBase($nomBD);


        $con    = mysqli_connect($host_name, $db_user_name, $db_password, $nomB);
        $conHis = mysqli_connect($host_name, $db_user_name, $db_password, $baseGlobale);
		
		$idCabinet 		= mysqli_real_escape_string($con, $_REQUEST['idCabinet']);
		$idFaiseur 		= mysqli_real_escape_string($con, $_REQUEST['faiseur']);
        $ceMoment       = date("Y-m-d H:i:s");

        $num_nom_salle  = mysqli_real_escape_string($con, $_REQUEST['num_nom_salle']);
        $type_salle     = mysqli_real_escape_string($con, $_REQUEST['type_salle']);
        $etage_salle    = mysqli_real_escape_string($con, $_REQUEST['etage_salle']);


			try
                {
                                                    
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  
 
                                
                    $reponse = $bdd->query("INSERT INTO `salle`(`num_nom_salle`, `etage_salle`, `type_salle`) VALUES ('$num_nom_salle','$etage_salle','$type_salle')");   

                    $id_salle = $bdd->lastInsertId();
                               

                    hisAjoutSalle($conHis, $ceMoment , $idCabinet, $idFaiseur, $id_salle);
                    header('location: ../../salle.php');
                                    

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
                                                  
                            
                                

                            

?> 