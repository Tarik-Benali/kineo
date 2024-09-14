<?php 

    include("../../includes/functions.php");

    if (isset($_REQUEST['bilans']) && isset($_REQUEST['nomCab'])) {

        $bilan    = $_REQUEST['bilans'];
        $nomCabin = $_REQUEST['nomCab'];

          
        $nomCabinet             = str_replace("'","\'",$nomCabin);
        //$nomCabinet           = crypterNomDeLaBase($nomCabinet);

        global $host_name;
        global $db_user_name;
        global $db_password;
        global $baseGlobale;

        //$database = crypterNomDeLaBase($nomCabinet);


        if (isset($_REQUEST['indice'])) {

            $indice = $_REQUEST['indice'];

            try
                    {

                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale", $db_user_name, $db_password, $pdo_options);  

                              $reponse = $bdd->query("SELECT typeExamen FROM examens WHERE typeExamen LIKE '$bilan%' LIMIT 10");
                              
                              while ($donneesM = $reponse->fetch())
                                    {
                                        $nomBilans = $donneesM['typeExamen'];
                
                                        echo "<div onclick=\"onDocClickI('$nomBilans', '$indice')\">$nomBilans<br></div><br>";
             
                                    }
                              $reponse->closeCursor();
                    }

                catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
        }



        elseif (!isset($_REQUEST['indice'])) {
              
      
                try
                    {

                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale", $db_user_name, $db_password, $pdo_options);  

                              $reponse = $bdd->query("SELECT typeExamen FROM examens WHERE typeExamen LIKE '$bilan%' LIMIT 10");
                              
                              while ($donneesM = $reponse->fetch())
                                    {
                                        $nomBilans = $donneesM['typeExamen'];
                
                                        echo "<div onclick=\"onDocClick('$nomBilans')\">$nomBilans<br></div><br>";
             
                                    }
                              $reponse->closeCursor();
                    }

                catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
            }                           
    
    }

 ?>
