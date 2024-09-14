<?php

  include("../../includes/functions.php");

    if (isset($_REQUEST['idUser']) && isset($_REQUEST['ancien']) && isset($_REQUEST['nouv'])) {

    $idUser       = $_REQUEST['idUser'];
    $ancien       = $_REQUEST['ancien'];
    $nouv         = $_REQUEST['nouv'];

    $idUser   = str_replace("'","\'",$idUser);
    $ancien   = hash("sha512", $ancien);
    $nouv     = hash("sha512", $nouv);

      global $host_name;
      global $baseGlobale;
      global $db_user_name;
      global $db_password;

        try
            {
              $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
              $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                             
                  $reponse = $bdd->query("SELECT * FROM `users` WHERE `identifiant` = '$idUser' AND password='$ancien'");
                  $nbrlignes = $reponse->rowCount();

                  if ($nbrlignes > 0) {

                      try
                          {
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                           
                              $reponse = $bdd->query("UPDATE users SET `password`='$nouv' WHERE `identifiant`='$idUser'");
                                
                              echo "<div style='font-size:20xp;text-align:center;margin-top:10xp;color:green;'>Votre mot de passe à été modifié avec succès !</div>";
                              $reponse->closeCursor();
                          }
                      catch(Exception $e)
                          {
                             die('Erreur : '.$e->getMessage());
                                
                            echo "<div style='font-size:20xp;text-align:center;margin-top:10xp;color:red;'>Votre mot de passe n'a pas été modifié !</div>";
                          }

                  }else{
                    echo "<div style='font-size:20xp;text-align:center;margin-top:10xp;color:red;'>Vous n'avez pas saisi correctement votre ancien mot de passe !</div>";
                  }
                
                $reponse->closeCursor();
            }
        catch(Exception $e)
            {
               die('Erreur : '.$e->getMessage());
            }
        
}else {
  echo "<div style='font-size:20xp;text-align:center;margin-top:10xp;color:red;'>Merci se saisir toute les infos et réessayer à nouveau !</div>";
}

?> 