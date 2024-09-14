<?php

    if (isset($_REQUEST['idCab'])) {

    include("../../includes/functions.php");

    $idCab          = $_REQUEST['idCab'];



  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT medecin.idMedecin,medecin.nomMedecin,medecin.prenomMedecin,medecin.sexeMedecin FROM `medecin`,`relationmedcab` WHERE relationmedcab.idMedecin = medecin.idMedecin AND relationmedcab.idCabinet ='$idCab'");

                          while ($donnees = $reponse->fetch())
                                     {

                                      $idDoc = $donnees['idMedecin'];

                                    echo"<li id=\"cont\" style=\"padding:5px\">";
                                        if ($donnees['sexeMedecin'] == "Homme") {
                                                    echo "<img style=\"margin-top:1px;\" class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                                  }
                                            elseif ($donnees['sexeMedecin'] == "Femme") {
                                                    echo "<img style=\"margin-top:1px;\" class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
                                                  }
                                    echo"<!--h3>
                                            <span>Déconnecté</span>
                                          </h3-->
                                          <h3>". $donnees['nomMedecin'] . " " . $donnees['prenomMedecin'] . "&nbsp;&nbsp;
                                          </h3>
                                          <input type=\"hidden\" name=\"idDoc\" value=\"$donnees[idMedecin]\">
                                          <!--p><i>Dernière connexion</i> :&nbsp;<i class=\"fa fa-clock-o\"></i>&nbsp;&nbsp;20 Min</p-->
                                      </li>
                                      <hr>";
                                      }
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        

    
    }

?>  