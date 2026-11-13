<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

    global $host_name;
    global $db_user_name;
    global $db_password;
    global $baseGlobale;

        $nomBD  = $_REQUEST['nomBD'];

        $nomB       = crypterNomDeLaBase($nomBD);


        $con    = mysqli_connect($host_name, $db_user_name, $db_password, $nomB);
        $conHis = mysqli_connect($host_name, $db_user_name, $db_password, $baseGlobale);
		
		$idCabinet 		= mysqli_real_escape_string($con, $_REQUEST['idCabinet']);
		$idFaiseur      = mysqli_real_escape_string($con, $_REQUEST['faiseur']);
        $typeEmpla      = mysqli_real_escape_string($con, $_REQUEST['typeEmp']);
        $ceMoment       = date("Y-m-d H:i:s");

        $num_lit        = mysqli_real_escape_string($con, $_REQUEST['num_lit']);
        $nature_lit     = mysqli_real_escape_string($con, $_REQUEST['nature_lit']);
        $idEmpLit       = mysqli_real_escape_string($con, $_REQUEST['emplacement_salle']);
        

			try
                {
                                                    
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  
 
                                
                    $reponse = $bdd->query("INSERT INTO `lit`(`num_lit`, `nature_lit`, `id_emplacement`) VALUES ('$num_lit','$nature_lit','$idEmpLit')");   

                    $id_lit = $bdd->lastInsertId();
                               

                    hisAjoutLit($conHis, $ceMoment , $idCabinet, $idFaiseur, $id_lit);
                    header('location: ../../lit.php');
                                    

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
                                                  
                            

?> 