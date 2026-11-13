<?php

    if (isset($_SESSION['identifiant'])) {

    $identifiant      = $_SESSION['identifiant'];


      global $host_name;
      global $baseGlobale;
      global $db_user_name;
      global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT typeCompte,login FROM `users` WHERE `identifiant` = '$identifiant' Limit 1");

                          while ($donnees = $reponse->fetch())
                                     {

                                $type     = $donnees['typeCompte'];
                                $username = $donnees['login'];

                                switch ($type) {

                                    case 1:

                                    $table = "patient"; 
                                    $champ = "idPatient";
                                    $id    = $identifiant;
                                    $user  = $username;
                                    $nomti = "";

                                    modDonneesProf($table, $champ, $id, $user, $nomti);
                                                
                                        break;

                                    case 2:

                                    $table = "medecin"; 
                                    $champ = "idMedecin";
                                    $id    = $identifiant;
                                    $user  = $username;
                                    $nomti = "Dr, ";

                                    modDonneesProf($table, $champ, $id, $user, $nomti);
                                                
                                        break;

                                    case 3:

                                    $table = "infermier"; 
                                    $champ = "idInfermier";
                                    $id    = $identifiant;
                                    $user  = $username;
                                    $nomti = "";

                                    modDonneesProf($table, $champ, $id, $user, $nomti);
                                                
                                        break;
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


