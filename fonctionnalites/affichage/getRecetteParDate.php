   <?php 

     include("../../auth/auth.php");
     include("../../includes/functions.php");      


     if(isset($_REQUEST['nomCabinet'])){

        $nomCabinet   = (String) trim($_GET['nomCabinet']);
        $DateDe       = (String) trim($_GET['DateDe']);
        $DateA        = (String) trim($_GET['DateA']);
        $Prati        = (String) trim($_GET['Prati']);

        global $host_name;
        global $db_user_name;
        global $db_password;

        $database   = crypterNomDeLaBase($nomCabinet);  

        $total = 0;   

                  try
                    {
                                                                                        
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      

                      $reponse = $bdd->query("SELECT * FROM `addition`,`medecin`,`gestionrecettepracitien` WHERE addition.idMedecin=medecin.idMedecin AND addition.idMedecin=gestionrecettepracitien.idMedecin AND addition.date_cons >= '$DateDe' AND addition.date_cons <= '$DateA' AND addition.idMedecin='$Prati'");

                      $nbr = $reponse->rowCount();

                        if ($nbr > 0) {

                          while ($donnees = $reponse->fetch())
                              {
                                  $id_addition    = $donnees['id_addition'];
                                  $date_cons      = $donnees['date_cons'];
                                  $addition       = $donnees['addition'];
                                  $nomMedecin     = $donnees['nomMedecin'];
                                  $prenomMedecin  = $donnees['prenomMedecin'];
                                  $pourcentage    = $donnees['pourcentage'];

                                  $total = $total + $addition;
                              }

                              $net = ( $total * $pourcentage ) / 100;

                            echo "<tr>
                                  <td>$date_cons</td>
                                  <td>$nomMedecin</td>
                                  <td>$prenomMedecin</td>
                                  <td>$total da</td>
                                  <td>".$pourcentage."%</td>
                                  <td>$net da</td>
                                </tr>";
                        }else{
                          echo "<tr>
                                  <td>De $DateDe à $DateA</td>
                                  <td>-</td>
                                  <td>-</td>
                                  <td>Aucune seance faite</td>
                                  <td>-</td>
                                  <td>0 da</td>
                                </tr>";
                        }                                      
                    $reponse->closeCursor();
                }

                catch(Exception $e)
                      {
                        die('Erreur : '.$e->getMessage());
                      }
     


    }
 ?>