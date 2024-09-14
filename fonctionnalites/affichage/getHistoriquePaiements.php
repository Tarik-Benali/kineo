   <?php 

     include("../../auth/auth.php");
     include("../../includes/functions.php");      


     if(isset($_REQUEST['nomCabinet'])){

        $nomCabinet   = (String) trim($_GET['nomCabinet']);
        $DateDe       = (String) trim($_GET['DateDe']);
        $DateA        = (String) trim($_GET['DateA']);
        $Patient      = (String) trim($_GET['Patient']);

        global $host_name;
        global $db_user_name;
        global $db_password;

        $database   = crypterNomDeLaBase($nomCabinet);  

        $total = 0;   

                  try
                    {
                                                                       
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      

                      $reponse = $bdd->query("SELECT * FROM `addition`,`patient`,`medecin` WHERE addition.idPatient ='$Patient' AND addition.idPatient = patient.idPatient AND addition.idMedecin = medecin.idMedecin AND addition.date_cons >= '$DateDe' AND addition.date_cons <= '$DateA'");

                      $nbr = $reponse->rowCount();

                        if ($nbr > 0) {

                          while ($donnees = $reponse->fetch())
                              {
                                  $id_addition    = $donnees['id_addition'];
                                  $date_cons      = $donnees['date_cons'];
                                  $heureCons      = $donnees['heure'];
                                  $addition       = $donnees['addition'];
                                  $nomPatient     = $donnees['nomPatient'];
                                  $prenomPatient  = $donnees['prenomPatient'];
                                  $nomMedecin     = $donnees['nomMedecin'];

                                  $total = $total + $addition;

                                  echo "<tr>
                                          <td>$date_cons</td>
                                          <td>$heureCons</td>
                                          <td>" . $nomPatient . " " . $prenomPatient ."</td>
                                          <td>$nomMedecin</td>
                                          <td>$addition da</td>
                                        </tr>";
                              }

                              echo "<tr>
                                      <td colspan=\"3\"></td>
                                      <td><b>Total:</b></td>
                                      <td><b>$total da</b></td>
                                    </tr>";
                            
                        }else{
                          echo "<tr>
                                  <td>De $DateDe à $DateA</td>
                                  <td>-</td>
                                  <td>Aucune paiement effectué</td>
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