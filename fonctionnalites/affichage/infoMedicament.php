<?php 

    include("../../includes/functions.php");

    if (isset($_REQUEST['medicam']) && isset($_REQUEST['nomCab'])) {

        $nomMedic = $_REQUEST['medicam'];
        $nomCabin = $_REQUEST['nomCab'];

          
        $nomCabinet             = str_replace("'","\'",$nomCabin);
        //$nomCabinet           = crypterNomDeLaBase($nomCabinet);

        global $host_name;
        global $db_user_name;
        global $db_password;

        $database = crypterNomDeLaBase($nomCabinet);


        if (isset($_REQUEST['indice'])) {

            $indice = $_REQUEST['indice'];

            try
                    {

                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options);  

                              $reponse = $bdd->query("SELECT nomMedicament,typeMedicament,dosageMedicament FROM medicament WHERE nomMedicament LIKE '$nomMedic%' LIMIT 10");
                              
                              while ($donneesM = $reponse->fetch())
                                    {
                                        $nomMedica = $donneesM['nomMedicament'];
                                        $dozMedica = $donneesM['dosageMedicament'];
                
                                        echo "<div onclick=\"onDocClickI('$nomMedica','$dozMedica', '$indice')\">$nomMedica " . " (" ."$donneesM[typeMedicament]". " / " . "$dozMedica".")"."<br></div><br>";
             
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
                        $bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options);  

                              $reponse = $bdd->query("SELECT nomMedicament,typeMedicament,dosageMedicament FROM medicament WHERE nomMedicament LIKE '$nomMedic%' LIMIT 10");
                              
                              while ($donneesM = $reponse->fetch())
                                    {
                                        $nomMedica = $donneesM['nomMedicament'];
                                        $dozMedica = $donneesM['dosageMedicament'];
                
                                        echo "<div onclick=\"onDocClick('$nomMedica','$dozMedica')\">$nomMedica " . " (" ."$donneesM[typeMedicament]". " / " . "$dozMedica".")"."<br></div><br>";
             
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
