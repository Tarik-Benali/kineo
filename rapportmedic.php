<?php 


//**

    include("auth/auth.php");
    include("includes/functions.php");

  if(isset($_GET['Identifiant'])){

    $identifiant  = (String) trim($_GET['Identifiant']);
    $idConsultation = (String) trim($_GET['IdConsul']);


    global $host_name;
    global $db_user_name;
    global $db_password;
    global $baseGlobale;
    
    $nomPatient    = getPatientName($identifiant);
    $prenomPatient = getPatientPrenom($identifiant);
    $agePatient    = getPatientAge($identifiant);

      $database = $baseGlobale;

            try
               {
                                        
                  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                  $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);   
         
                  
                  // On recupere tout le contenu de la table news
                  $reponse = $bdd->query("SELECT * FROM `rapport_medical`,`consultations` WHERE rapport_medical.`idConsultation`= consultations.`idConsultation` AND rapport_medical.`idConsultation`='$idConsultation'");

                  $nvrDeLignes = $reponse->rowCount();                                          

                  if ($nvrDeLignes != 0) {

                    while ($donnees = $reponse->fetch())
                        {   
                          $motifCons  = $donnees['motifCons'];
                          $conclusion = $donnees['conclusion'];
                          $nature_geste = $donnees['nature_geste'];
                          $compte_rendu = $donnees['compte_rendu'];
                          $type_anesthesie = $donnees['type_anesthesie'];
                          $heureConsultation = $donnees['heureConsultation'];
                          $dateCons   = substr($heureConsultation,0,10);
                        }

                        if ($motifCons == "Aucun Motif enregistré pour cette consultation") {
                            $motifCons ="";
                        }else{
                            $motifCons = $motifCons . ".";
                        }

                }else{
                      $repons = $bdd->query("SELECT * FROM `rapport_medical` WHERE `idConsultation`='$idConsultation'");

                      while ($donnee = $repons->fetch())
                        {   
                          $motifCons  = "";
                          $conclusion = "";
                          $nature_geste = $donnee['nature_geste'];
                          $compte_rendu = $donnee['compte_rendu'];
                          $type_anesthesie = $donnee['type_anesthesie'];
                          $heureConsultation = $donnee['emplty'];
                          $dateCons   = substr($heureConsultation,0,10);
                        } $repons->closeCursor();       
                }
                
                $reponse->closeCursor();
                
              }
            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                } 
     }
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport Médical</title>
      <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <style>
            .invoice-box {
                max-width: 800px;
                margin: auto;
                padding: 10px;
                padding-left: 30px;
                padding-right: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, .15);
                font-size: 16px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
            }
            

            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }

            @media print {
                #imprim  {
                    display: none;
                }
                #no-printme  {
                    display: none;
                }
                #ordonnance_area  {
                    display: block;
                }
            }
            
            /** RTL **/
            .rtl {
                direction: rtl;
                font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }

            .buttonT {
              background-color: #4CAF50; /* Green */
              border: none;
              color: white;
              padding: 8px 16px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 16px;
              margin: 3px 2px;
              transition-duration: 0.4s;
              cursor: pointer;
              border-radius: 2px;
            }

            .buttonOrd {
              background-color: white;
              color: black;
              border: 1px solid #555555;
            }

            .buttonOrd:hover {
              background-color: #555555;
              color: white;
            } 
    </style>
</head>

<body>

    <div id="no-printme" style="text-align:center; margin-bottom: 10px">
      <button id="cmd" class="buttonT buttonOrd" style='cursor: pointer;'>Télécharger</button>
      <button id="imprim" class="buttonT buttonOrd" style='cursor: pointer;' onclick="window.print()">Imprimer</button>
      <br>
    </div>

    <div id="ordonnance_area" class="invoice-box" style="background: #fff;border-bottom: 1px solid #ffffff;">

        <div style="text-align: center; height: 100%; justify-content: center;">
                <img src="impression/ord/entete/virtuhos_mono_cabinet.PNG" style="margin-top: 1%;">
        </div>
            
        <br>

            <?php

            echo   "<div class=\"modal-body\" style=\"height: 750px; overflow-y: auto;\">
                      <div>
                          <center>
                              <h1>Rapport Médical</h1>
                          </center>
                      </div>

                      <br> 

                      <div>
                        <p style=\"font-family:  'Times New Roman', Times,serif; font-size: 14px;\">
                          <b>Nom:</b>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     ".$nomPatient.".  <br> 
                          <b>Prenom:</b> &nbsp;             ".$prenomPatient.".   <br>
                          <b>Age:</b>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ".$agePatient."&nbsp;ans.<br>
                          <b>Date de consultation:</b>    &nbsp;&nbsp;".$dateCons.".<br>
                        </p>
                      </div>

                      <hr>

                      <div>
                        <p style=\"font-family:  'Times New Roman', Times,serif; font-size: 14px;\">
                          <b>Motif:</b>&nbsp;               ".$motifCons."<br>
                          <b>Nature du geste pratiqué:</b> &nbsp;   ".$nature_geste.".<br>
                          <b>Type d'anesthesie:</b> &nbsp;        ".$type_anesthesie.".<br><br>
                          <b><u>Compte rendu:</u></b><br>
                        </p>
                        <p style=\"font-family:  'Times New Roman', Times,serif; font-size: 16px;margin-left:60px;\">
                          ".$compte_rendu."
                        </p>  
                      </div>";
                                                        
                                                        
              echo "</div>";
            ?>
            <!--div style="margin-left: 70%;margin-top: 5%">
                <img src="assets/content/attache.png" style="margin-left: 20px;" width="50px" height="50px">
            </div-->
            
            
    </div>

</body>



<script>

  //Fonction Download pdf (marche) ---------------------------------------------------------------
      
    $('#cmd').click(function() {
        var nom_patient= "<?php echo 'rapport_medical_'.$nomPatient .'_'. $prenomPatient ?>";
        var options = {
    //  'width': 1200,
         // 'color': white

        };
        var pdf = new jsPDF('p', 'pt', 'a4');
        pdf.addHTML($("#ordonnance_area"), -1, 2, options, function() {
        pdf.save(''+nom_patient+'.pdf');
        });
  });
     
  //END fonction Download pdf (marche) ---------------------------------------------------------------

      
  </script>

</html>
