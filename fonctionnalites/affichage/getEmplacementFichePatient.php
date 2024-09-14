<?php

    if (isset($_REQUEST['identifiant']) && isset($_REQUEST['nomCabinet'])) {

    include("../../includes/functions.php");

    $idPatient       = $_REQUEST['identifiant'];
    $nomCabint       = $_REQUEST['nomCabinet'];

    global $host_name;
    global $db_user_name;
    global $db_password;

    $database   = crypterNomDeLaBase($nomCabint);

              try
                              {
                                                      
                              $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                              $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                              
                              $reponse = $bdd->query("SELECT * FROM `emplacement_fiche_patient` WHERE `idPatient` = '$idPatient'");
                              $nbr = $reponse->rowCount();

                              

                              if ($nbr == 0) {
                                
                                
                                  echo " <input type=\"hidden\" name=\"idPatients\" value=\"$idPatient\">
                                      <input type=\"hidden\" name=\"nomCabinets\" value=\"$nomCabint\">

                                      <label for=\"examen\"><b>Armoire</b></label>
                                      <input type=\"text\" style=\"color: #000000;\" name=\"armoires\" placeholder=\"BEN\">

                                      <label for=\"examen\"><b>Boite</b></label>
                                      <input type=\"text\" style=\"color: #000000;\" name=\"boites\"   placeholder=\"12\">";
                                              
                              }else{

                                while ($donnees = $reponse->fetch())
                                    {
                                      $arm = $donnees['armoire'];
                                      $boi = $donnees['boite'];

                                      if ($arm != "" && $boi != "") {
                                        
                                            echo "  <input type=\"hidden\" name=\"idPatients\" value=\"$idPatient\">
                                              <input type=\"hidden\" name=\"nomCabinets\" value=\"$nomCabint\">

                                              <label for=\"examen\"><b>Armoire</b></label>
                                              <input type=\"text\" style=\"color: #000000;\" name=\"armoires\" value=\"$arm\">

                                              <label for=\"examen\"><b>Boite</b></label>
                                              <input type=\"text\" style=\"color: #000000;\" name=\"boites\"   value=\"$boi\">";


                                      }
                                      elseif ($arm=="" && $boi=="") {

                                        echo "  <input type=\"hidden\" name=\"idPatients\" value=\"$idPatient\">
                                              <input type=\"hidden\" name=\"nomCabinets\" value=\"$nomCabint\">

                                              <label for=\"examen\"><b>Armoire</b></label>
                                              <input type=\"text\" style=\"color: #000000;\" name=\"armoires\" placeholder=\"BEN\">

                                              <label for=\"examen\"><b>Boite</b></label>
                                              <input type=\"text\" style=\"color: #000000;\" name=\"boites\"   placeholder=\"12\">";

                                      }
                                      elseif ($arm=="" && $boi!="") {

                                        echo "  <input type=\"hidden\" name=\"idPatients\" value=\"$idPatient\">
                                              <input type=\"hidden\" name=\"nomCabinets\" value=\"$nomCabint\">

                                              <label for=\"examen\"><b>Armoire</b></label>
                                              <input type=\"text\" style=\"color: #000000;\" name=\"armoires\" placeholder=\"Non Enregistré\">

                                              <label for=\"examen\"><b>Boite</b></label>
                                              <input type=\"text\" style=\"color: #000000;\" name=\"boites\"   value=\"$boi\">";

                                      }
                                      elseif ($boi=="" && $arm!="") {

                                        echo "  <input type=\"hidden\" name=\"idPatients\" value=\"$idPatient\">
                                              <input type=\"hidden\" name=\"nomCabinets\" value=\"$nomCabint\">

                                              <label for=\"examen\"><b>Armoire</b></label>
                                              <input type=\"text\" style=\"color: #000000;\" name=\"armoires\" value=\"$arm\">

                                              <label for=\"examen\"><b>Boite</b></label>
                                              <input type=\"text\" style=\"color: #000000;\" name=\"boites\"   placeholder=\"Non Enregistré\">";
                                      }
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