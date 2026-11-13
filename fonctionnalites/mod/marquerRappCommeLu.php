 <?php 

    include("includes/functions.php");


    $idRapport  = $_GET['idRapport'];
    $vue        = $_GET['vue'];
    
    global $host_name;
    global $baseGlobale;
    global $db_user_name;
    global $db_password;

    $database = $baseGlobale;

      if ($vue != '1') {   
                  try
                              {
                                                      
                              $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                              $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                              
                              // On recupere tout le contenu de la table news
                              $reponse = $bdd->query("UPDATE rapporttechnique SET vue='1' WHERE idRapport = '$idRapport'");
                                                    
                             $reponse->closeCursor();
                            }
                          catch(Exception $e)
                              {
                                 die('Erreur : '.$e->getMessage());
                              } 

                }
   header('location: ../../rapport.php');
       

?>