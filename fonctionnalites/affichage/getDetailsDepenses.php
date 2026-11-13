   <?php 

     include("../../auth/auth.php");
     include("../../includes/functions.php");      


     if(isset($_REQUEST['nomCabinet']) && isset($_REQUEST['type']) && $_REQUEST['type'] == "detail"){

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

                      $reponse = $bdd->query("SELECT * FROM `depenses` WHERE dateAjout >= '$DateDe' AND dateAjout <= '$DateA'");

                      $nbr = $reponse->rowCount();

                        if ($nbr > 0) {

                          while ($donnees = $reponse->fetch())
                              {
                                  $date          = $donnees['dateAjout'];
                                  $remarque      = $donnees['remarque'];
                                  $depenses      = $donnees['depense'];

                                  $total = $total + $depenses;

                                  echo "<tr>
                                          <td>$date</td>
                                          <td>$remarque</td>
                                          <td>$depenses da</td>
                                        </tr>";
                              }

                            echo "<tr>
                                    <td colspan=\"1\"></td>
                                    <td><b>Total</b></td>
                                    <td><b>$total da</b></td>
                                  </tr>";
                        }else{
                          echo "<tr>
                                  <td>Du $DateDe au  $DateA</td>
                                  <td>Aucune dépense enregitrée</td>
                                </tr>";
                        }
                                     
                    $reponse->closeCursor();
                }

                catch(Exception $e)
                      {
                        die('Erreur : '.$e->getMessage());
                      }
    }


    else if(isset($_REQUEST['nomCabinet']) && isset($_REQUEST['type']) && $_REQUEST['type'] == "simple"){

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

                      $reponse = $bdd->query("SELECT dateAjout FROM `depenses` WHERE dateAjout >= '$DateDe' AND dateAjout <= '$DateA' GROUP BY dateAjout");

                      $nbr = $reponse->rowCount();

                        if ($nbr > 0) {

                          while ($donnees = $reponse->fetch())
                              {
                                  $date     = $donnees['dateAjout'];

                                  $depenses = getTotalDepensesParDay($nomCabinet,$date);
                                  $total    = $total + $depenses;

                                  echo "<tr>
                                          <td>$date</td>
                                          <td>$depenses da</td>
                                        </tr>";
                              }

                            echo "<tr>
                                    <td><b>Total</b></td>
                                    <td><b>$total da</b></td>
                                  </tr>";
                        }else{
                          echo "<tr>
                                  <td>Du $DateDe au  $DateA</td>
                                  <td>Aucune dépense enregitrée</td>
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