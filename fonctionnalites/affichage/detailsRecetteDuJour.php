   <?php 

     include("../../auth/auth.php");
     include("../../includes/functions.php");      



     if(isset($_REQUEST['nomCabinet'])){

        $nomCabinet = (String) trim($_GET['nomCabinet']);
        $dateJ      = (String) trim($_GET['dateJ']);
        $dateDuJour = "";

        global $host_name;
        global $db_user_name;
        global $db_password;

        $database   = crypterNomDeLaBase($nomCabinet);

              if ($dateJ == "lyoum") {
                $dateDuJour = date('Y-m-d');
              }else{
                $dateDuJour = $dateJ;
              }

              

                    try
                    {
                                                                                        
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                                                                
                      $reponse = $bdd->query("SELECT * FROM `rdv`,`patient`,`addition`,`medecin` WHERE rdv.id = addition.idRDV AND patient.idPatient = addition.idPatient AND medecin.idMedecin = addition.idMedecin AND addition.date_cons='$dateDuJour'");

                      $nbr = $reponse->rowCount();

                      if ($nbr != 0) {
                                        
                              while ($donnees = $reponse->fetch())
                                  {
                                    $idRDV        = $donnees['id'];
                                    $prenoP       = $donnees['prenoP'];
                                    $nomP         = $donnees['nomP'];
                                    $tel          = $donnees['tel'];
                                    $mail         = $donnees['mail'];
                                    $dateRDV      = $donnees['dateRDV'];
                                    $heureRDV     = $donnees['heureRDV'];
                                    $tel          = $donnees['tel'];
                                    $motifCons    = $donnees['motifCons'];
                                    $medecin_suiv = $donnees['medecin_suiv'];
                                    $nomMedecin   = $donnees['nomMedecin'];
                                    $typeCons     = $donnees['type_seance'];
                                    
                                    $prixConsultation     = $donnees['addition'];
                                    $remarque_fin_seance  = $donnees['remarque_fin_seance'];
                                    $prenomMedecin        = $donnees['prenomMedecin'];

                                    $medecin = $nomMedecin . " " . $prenomMedecin;


                                    $heure = substr($heureRDV, 0, 8);

                                    echo "<h3>Séance du <b>".$dateRDV."</b> à <b>".$heure."</b></h3><br><br>";

                                    echo "<h4>Informations Patient:</h4><br><br>";

                                    echo "<dl class=\"dl-horizontal-profile\">
                                                <dt>Nom Patient</dt>
                                                <dd>$nomP</dd>

                                                <dt>Prenom Patient</dt>
                                                <dd>$prenoP</dd>

                                                <dt>Téléphone</dt>
                                                <dd>$tel</dd>

                                                <dt>E-mail</dt>
                                                <dd>$mail</dd>
                                          </dl><hr>";

                                    echo "<h4>Informations Seance:</h4><br><br>";      

                                    echo " <section id=\"flip-scroll\">
                                            <table class=\"table table-bordered table-striped cf\">
                                            <thead class=\"cf\">
                                              <tr>
                                                <th>Motif</th>
                                                <th>Praticien</th>
                                                <th>Séance</th>
                                                <th>Tarif</th>
                                                <th>Note / remarque</th>
                                              </tr>
                                            </thead>
                                            <tbody>";
                                              echo "<tr><td>$motifCons</td>
                                                        <td>$medecin</td>
                                                        <td>$typeCons</td>
                                                        <td>$prixConsultation</td>
                                                        <td>$remarque_fin_seance</td></tr>";
                                    echo "</tbody></table></section><br><hr style=\"border: 1px solid gray;\"><br>"; 
                                  }

                                
                      }         
                                                                    
                          $reponse->closeCursor();
                        }

                catch(Exception $e)
                      {
                        die('Erreur : '.$e->getMessage());
                      }
     

                  /*try
                    {
                                                                                        
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                                                                
                      $reponse = $bdd->query("SELECT * FROM `prix`,`relationexamcons`,`consultations`,`examens` WHERE DATE(consultations.heureConsultation) = CURDATE() AND relationexamcons.idConsultation = consultations.idConsultation AND examens.typeExamen = relationexamcons.typeExamen AND prix.idExamen = examens.idExamen");

                      $nbr = $reponse->rowCount();

                      if ($nbr != 0) {

                                                                                    
                        $i = 0;

                                        
                              while ($donnees = $reponse->fetch())
                                  {
                                    $idCons  = $donnees['idConsultation'];

                                    if ($i ==0) {
                                      $predecesseur = $donnees['idConsultation'];

                                      //premier 
                                      echo "<dl class=\"dl-horizontal-profile\">
                                                <dt>Consultation</dt>
                                                <dd>".$donnees['heureConsultation']."</dd>

                                                <dt>Patient</dt>
                                                <dd>".getPatientName($donnees['idPatient'])."</dd>

                                                <dt>Prix Consultation</dt>
                                                <dd>".getConsultationPrice($nomCabinet)."</dd>
                                            </dl><br>

                                            <section id=\"flip-scroll\">
                                            <table class=\"table table-bordered table-striped cf\">
                                            <thead class=\"cf\">
                                              <tr>
                                                <th>Examens</th>
                                                <th>Prix</th>
                                              </tr>
                                            </thead>
                                            <tbody>";
                                              echo "<tr><td>$donnees[typeExamen]</td><td>$donnees[prixExamen]</td></tr>";

                                    }

                                    if ($idCons != $predecesseur && $i != 0) {
                                        //Créer nouveau tableau
                                        echo "</tbody></table></section><br><hr><br>

                                              <dl class=\"dl-horizontal-profile\">
                                                <dt>Consultation</dt>
                                                <dd>".$donnees['heureConsultation']."</dd>

                                                <dt>Patient</dt>
                                                <dd>".getPatientName($donnees['idPatient'])."</dd>

                                                <dt>Prix Consultation</dt>
                                                <dd>".getConsultationPrice($nomCabinet)."</dd>
                                              </dl><br>


                                              <section id=\"flip-scroll\">
                                              <table class=\"table table-bordered table-striped cf\">
                                              <thead class=\"cf\">
                                                  <tr>
                                                    <th>Examens</th>
                                                    <th>Prix</th>
                                                  </tr>
                                                </thead>
                                                  <tbody>";
                                                  echo "<td>$donnees[typeExamen]</td><td>$donnees[prixExamen]</td>";

                                      $predecesseur = $idCons;
                                    }
                                    else if ($idCons == $predecesseur && $i != 0) {
                                      echo "<tr><td>$donnees[typeExamen]</td><td>$donnees[prixExamen]</td></tr>";
                                    }

                                    $i = $i + 1;
                                  }
                      //dernier tr 
                      echo "</tbody></table></section>";           
                      }         
                                                                    
                          $reponse->closeCursor();
                        }

                catch(Exception $e)
                      {
                        die('Erreur : '.$e->getMessage());
                      } */
    }
 ?>