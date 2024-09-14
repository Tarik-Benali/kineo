<?php
function getPatientPourHistorCons($idPatient){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM patient WHERE idPatient = '$idPatient'");

                          while ($donnees = $reponse->fetch())
                                     {

                                       if ($donnees[8] == "Homme") {
                                            $Sexe = "Homme"; $Titre = "Mr"; 
                                            }

                                       elseif ($donnees[8] == "Femme") {
                                            $Sexe = "Femme"; $Titre = "Mr";
                                            }

   echo "<div class=\"body-nest\" id=\"header\">
                                <div class=\"container\">   
                                            <h2>".$Titre." ".$donnees[1]."</h2>

                                            <hr>

                                            <dl class=\"dl-horizontal-profile\">
                                                <dt>Nom</dt>
                                                <dd>".$donnees[1]."</dd>

                                                <dt>Prénom</dt>
                                                <dd>".$donnees[2]."</dd>

                                                <dt>Date de naissance</dt>
                                                <dd>".$donnees[3]."</dd>

                                                <dt>Lieu de naissance</dt>
                                                <dd>".$donnees[4]."</dd>

                                                <dt>Adresse</dt>
                                                <dd>".$donnees[5]."</dd>

                                                <dt>Email</dt>
                                                <dd>".$donnees[6]."</dd>

                                                <dt>Numéro de téléphone</dt>
                                                <dd>".$donnees[7]."</dd>

                                                <dt>Sexe</dt>
                                                <dd>".$Sexe."</dd>

                                                <dt>Groupage Sangin</dt>
                                                <dd>".$donnees[9]."</dd>

                                            </dl>
                                </div>
          </div>";  
          }

                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }


    }


function getExamenPourHistorCons($idConsultation, $nomBD){

  global $host_name;
  //global $baseGlobale;
  global $db_user_name;
  global $db_password;

  $nomB       = crypterNomDeLaBase($nomBD);

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM relationexamcons WHERE idConsultation = '$idConsultation'");

                    echo "<dl class=\"dl-horizontal-profile\">";

                          while ($donnees = $reponse->fetch())
                                     {

                                    $examen = $donnees[2];
                                    $result = $donnees[3];

                                    if ($result =="") {
                                        $result = "Examen sans résultat, cet examens n'est pas encore fait !";
                                    }                                     


                                   echo " <dt>Examen</dt>
                                          <dd>".$examen."</dd>

                                          <dt>Rasultat</dt>
                                          <dd>".$result."</dd>

                                          <hr>";  
                                    }
                    echo "</dl>";

                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
    } 


function getConslusionPourHistorCons($idConsultation, $nomBD){

  global $host_name;
  //global $baseGlobale;
  global $db_user_name;
  global $db_password;

  $nomB       = crypterNomDeLaBase($nomBD);

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM consultations WHERE idConsultation = '$idConsultation'");

                          while ($donnees = $reponse->fetch())
                                     {

                                    $etat = $donnees[6];  

                                    if ($etat =="0") {
                                        $etat = "Consultation clôturée";
                                    } elseif ($etat =="1"){
                                      $etat = "Consultation Suspendue !&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <a href=\"consultationSus.php\">cliquez ici pour voir les consultations suspendue</a>";
                                    }  

                                    $conclusion = $donnees[4];
                                    $DateConsul = $donnees[5];
                                    $MotifConsu = $donnees[7];                                  


                                   echo " <textarea style=\"width:100%;height:300px\" id=\"conclusion\" name=\"conclusion\">".$conclusion."
                                          </textarea>

                                          <hr> 

                                          <dl class=\"dl-horizontal-profile\">
                                                <dt>Date et Heure consultation</dt>
                                                <dd>".$DateConsul."</dd>

                                                <dt>Motif</dt>
                                                <dd>".$MotifConsu."</dd>

                                                <dt>état</dt>
                                                <dd>".$etat."</dd>

                                               

                                            </dl> 

                                          ";  
                                    }

                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }


    }       

?>    