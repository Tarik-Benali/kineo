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

        $num_nom_bloc  = mysqli_real_escape_string($con, $_REQUEST['num_nom_bloc']);
        $type_bloc     = mysqli_real_escape_string($con, $_REQUEST['type_bloc']);
        $etage_bloc    = mysqli_real_escape_string($con, $_REQUEST['etage_bloc']);


			try
                {
                                                    
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  
 
                                
                    $reponse = $bdd->query("INSERT INTO `bloc`(`num_nom_bloc`, `etage_bloc`, `type_bloc`) VALUES ('$num_nom_bloc','$etage_bloc','$type_bloc')");   

                    $id_bloc = $bdd->lastInsertId();
                               

                    hisAjoutBloc($conHis, $ceMoment , $idCabinet, $idFaiseur, $id_bloc);
                    header('location: ../../bloc.php');
                                    

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
                                                  
                            
                                

                            

?> 