<?php

  include("../../includes/functions.php");

    if (isset($_REQUEST['id']) && isset($_REQUEST['theme'])) {

    $ident      = $_REQUEST['id'];
    $theme      = $_REQUEST['theme'];


      global $host_name;
      global $baseGlobale;
      global $db_user_name;
      global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("UPDATE theme SET `nomTheme`='$theme' WHERE `idUser`='$ident'");
                          
                        
                        $reponse->closeCursor();

                        header('location: ../../themes.php');
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                       header('location: ../../themes.php');
                    }
}else {
  header('location: ../../theme.php?erreur=id_ou_theme_manquant');
}

?> 