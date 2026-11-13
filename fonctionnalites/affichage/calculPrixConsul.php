<?php 

    include("../../includes/functions.php");


     if(isset($_REQUEST['examen']) && isset($_REQUEST['nomCabinet'])){

        $examen     = (String) trim($_REQUEST['examen']);
        $nomCabinet = (String) trim($_REQUEST['nomCabinet']);


        global $host_name;
        global $db_user_name;
        global $db_password;

        $nomCabinet       = crypterNomDeLaBase($nomCabinet);

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomCabinet",$db_user_name,$db_password, $pdo_options);
                                                     
                         $reponse = $bdd->query("SELECT prixExamen FROM `prix`,`examens` WHERE prix.idExamen = examens.idExamen AND examens.typeExamen = '$examen'");

                          $exist = $reponse->rowCount();

                          if ($exist > 0) {
                            while ($donneesE = $reponse->fetch())
                            {
                                echo $donneesE['prixExamen'];
                            }

                          }else{
                             echo "0";
                          }                          

                        $reponse->closeCursor(); 
                    }
        catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
        }
        
 ?>
