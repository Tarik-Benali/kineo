     <?php include("../../includes/functions.php");

     if (isset($_GET['NomPhonePatient']) && isset($_GET['Type']) && $_GET['Type'] == "update") {
        
        $NomPhonePatient = (String) trim($_GET['NomPhonePatient']);

        global $host_name;
        global $baseGlobale;
        global $db_user_name;
        global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                         $reponse = $bdd->query("SELECT * FROM `patient` WHERE nomPatient LIKE '$NomPhonePatient%' OR numTelPatient LIKE '$NomPhonePatient%' OR emailPatient LIKE '$NomPhonePatient%' LIMIT 10");

                          $exist = $reponse->rowCount();

                          if ($exist == 0) {
                            
                            echo "<div class=\"alert alert-danger\">";
                                      echo "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
                                      echo "<span class=\"entypo-attention\"></span>";
                                      echo "<strong>Faux Données!</strong>&nbsp;&nbsp; Aucun patient enregistré avec ces infos, Merci de vérifié et de réessayer à nouveau.&nbsp;&nbsp;&nbsp;&nbsp;</a>";
                            echo "</div>";
                          }else{ 
                                echo "<br>";

                                $phone = "";
                                        
                                while ($donnees = $reponse->fetch())
                                   {
                                        $id = $donnees['idPatient'];
                                        $phone = $donnees['numTelPatient'];
                                        $patient = $donnees['nomPatient'] . " ". $donnees['prenomPatient'];

                                        if ($phone =="") {
                                          $phone = "-";
                                        }
                                        
                                        echo "Patient: <b>". $patient . "</b><br>Téléphone: <b>". $phone. "</b><br>

                                              <input class=\"btn btn-success\" value=\"Selectioner\" onclick=\"actualiserAvecIDUpdate('".$id."','".$patient."')\"/>

                                              <hr>";
                                    }
                            }
                        $reponse->closeCursor(); 
                    }
        catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
     }


     else if(isset($_GET['NomPhonePatient'])){
        $NomPhonePatient = (String) trim($_GET['NomPhonePatient']);


        global $host_name;
        global $baseGlobale;
        global $db_user_name;
        global $db_password;

        try
              {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                               
                   $reponse = $bdd->query("SELECT * FROM `patient` WHERE nomPatient LIKE '$NomPhonePatient%' OR numTelPatient LIKE '$NomPhonePatient%' OR emailPatient LIKE '$NomPhonePatient%' LIMIT 9");

                    $exist = $reponse->rowCount();

                    if ($exist == 0) {
                      
                      echo "<div class=\"alert alert-danger\">";
                        echo "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
                        echo "<span class=\"entypo-attention\"></span>";
                        echo "<strong>Faux Données!</strong>&nbsp;&nbsp; Aucun patient enregistré avec ces infos, Merci de vérifié et de réessayer à nouveau.&nbsp;&nbsp;&nbsp;&nbsp;</a>";
                      echo "</div>";
                    }else{ 
                          echo "<br>";

                          $phone = "";
                                  
                          while ($donnees = $reponse->fetch())
                             {
                                  $id = $donnees['idPatient'];
                                  $phone = $donnees['numTelPatient'];
                                  $patient = $donnees['nomPatient'] . " ". $donnees['prenomPatient'];

                                  if ($phone =="") {
                                    $phone = "-";
                                  }
                                  
                                  echo "<div class=\"col-sm-4\" style=\"padding-left:10px;margin-bottom:10px;\"> Patient: <b>". $patient . "</b><br>Téléphone: <b>". $phone. "</b><br>

                                        <input class=\"btn btn-success\" value=\"Selectioner\" onclick=\"actualiserAvecID('".$id."','".$patient."')\"/>

                                        </div>";
                              }
                      }
                  $reponse->closeCursor(); 
              }
        catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
        }
        
 ?>