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
        $ceMoment       = date("Y-m-d H:i:s");

        $nom_mat        = mysqli_real_escape_string($con, $_REQUEST['nom_materiel']);
        $num_ser        = mysqli_real_escape_string($con, $_REQUEST['num_serie_materiel']);
        //$idEmpLit       = mysqli_real_escape_string($con, $_REQUEST['emplacement_salle']);
        

			try
                 {
                                                    
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  
 
                                
                    $reponse = $bdd->query("INSERT INTO `materiel`(`nom`,`numeroSerie`,`etatMateriel`) VALUES ('$nom_mat','$num_ser','1')");   

                    $id_lit = $bdd->lastInsertId();
                               
                    addRelationSLP($nomBD,$id_lit);
                    hisAjoutMateriel($conHis, $ceMoment , $idCabinet, $idFaiseur, $id_lit);
                    header('location: ../../materiel.php');
                                    

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
                                                  
                            

?> 