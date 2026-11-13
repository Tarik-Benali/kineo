     <?php       
     //include("../../auth/auth.php");
     //include("infoPatientPourConsultation.php");
     //include("../../includes/functions.php");
     //include("infoExamenPourConsultation.php");

        $nomCabinet  = $_SESSION['nomDeCeCabinet'];
        $nomBD  = crypterNomDeLaBase($nomCabinet);

        $dateDuJour = date('Y-m-d'); 


     
            try
                {
                                                                                        
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=localhost;dbname=$nomBD","root","", $pdo_options);                          
                                                                
                                                                // On recupere tout le contenu de la table news
                    $reponse = $bdd->query("SELECT * FROM consultations WHERE  heureConsultation LIKE '$dateDuJour%' ");

                    $i = 1;

                    while ($donnees = $reponse->fetch())
                        {


                        $idMedecin          = $donnees['idMedecin'];
                        $conclusion         = $donnees['conclusion'];
                        $idConsultation     = $donnees['idConsultation'];
                        $heureConsultation  = $donnees['heureConsultation'];                     


                        echo "<div class=\"content-wrap\" id=\"infoPatient\">
                                <div class=\"row\">

                                    <div class=\"col-sm-12\">

                                        <div class=\"nest\" id=\"tablePatientClose\">
                                            <div class=\"title-alt\">
                                                <h6>
                                                    Consultation du $donnees[heureConsultation]</h6>
                                                <div class=\"titleClose\">
                                                    <a class=\"gone\" href=\"#tablePatientClose\">
                                                        <span class=\"entypo-cancel\"></span>
                                                    </a>
                                                </div>
                                                <div class=\"titleToggle\">
                                                    <a class=\"nav-toggle-alt\" href=\"#tablePatient\">
                                                        <span class=\"entypo-up-open\"></span>
                                                    </a>
                                                </div>

                                            </div>

                                            <div class=\"body-nest\" id=\"tablePatient\">

                                                <section id=\"flip-scroll\">

                                                    <table class=\"table table-bordered table-striped cf\">
                                                        <thead class=\"cf\">
                                                            <tr>
                                                                <th>Indices</th>
                                                                <th>Informations</th> 
                                                            </tr>
                                                        </thead>
                                                        <tbody>";
                                                                                                   
                                                                echo "<tr>";        

                                                                    echo "<td>";
                                                                    echo "Conclusion";
                                                                    echo "</td>";

                                                                    echo "<td>";
                                                                    echo "$donnees[conclusion]";
                                                                    echo "</td>";

                                                                echo "</tr>";       
                                                                echo "<tr>";        

                                                                    echo "<td>";
                                                                    echo "Date et heure consultation";
                                                                    echo "</td>";

                                                                    echo "<td>";
                                                                    echo "$donnees[heureConsultation]";
                                                                    echo "</td>";

                                                                echo "</tr>";        
                                                                echo "<tr>";        

                                                                    echo "<td>";
                                                                    echo "Identifiant Médecin";
                                                                    echo "</td>";

                                                                    echo "<td>";
                                                                    echo "$donnees[idMedecin]";
                                                                    echo "</td>";

                                                                echo "</tr>";

                                                        echo "</tbody>

                                                        <input name=\"afficherDossierP\" style=\"width:15%;\" class=\"btn btn-success pull-right\" style=\"margin-right: 10px;\" value=\"Afficher détails consultation\" data-toggle=\"modal\" data-target=\"#".$idConsultation ."\"/>
                                                        ";

                                                        

                                                        echo "</table>

                                                        </section>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>";
                              echo "<div class=\"container\">

                                      <div class=\"modal fade\"  id=\"".$idConsultation ."\" role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Consultation du &nbsp;&nbsp; $heureConsultation</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"height: 550px; overflow-y: auto;\">

                                            <form action=\"fonctionnalites\mod\modPrixExam.php\" class=\"form-container\">
                                                <fieldset>

                                                    <div class=\"form-group\">

                                                    <input type=\"hidden\" name=\"idExamen\" value=\"$idConsultation \">

                                                    <input type=\"hidden\" name=\"idMedecin\" value=\"$idMedecin\">

                                                    <input type=\"hidden\" name=\"nomBD\" value=\"$nomCabinet\">

                                              "; affichageDetailsPatient($nomCabinet, $idConsultation);

                                                 examensDeCetteConsultation($nomCabinet, $idConsultation);

                                               echo "

                                              <label for=\"examen\"><b>Conclusion</b></label>

                                              <textarea type=\"text\" name=\"conclusion\"  style=\"height: 100px; width: 100%;\" required>$conclusion</textarea>
                                                                   
                          
                                            </div>
                                            
                                              <ul id=\"breadcrumb\">
                                                  
                                                  "; if ($i == 1) {
                                                   echo "<li class=\"pull-left\">
                                                            <button type=\"button\" class=\"btn btn-success\" style=\"margin-left:10px;margin-bottom:10px;\" data-toggle=\"modal\" data-target=\"#pop\"> Ordonnance derinère consultation</button></li>";
                                                          
                                                        }
                                                  echo "<li class=\"pull-right\">
                                                    <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Fermer</button>
                                                  </li>

                                              </ul>

                                                    </div>                                       

                                                </fieldset>                    
                                            </form>
                                              
                                          </div>                                                                     


                                        </div>
                                      </div>
                                      
                                    </div>";
                                    ordPopup($nomCabinet, $idConsultation); 

                                    $i++;
                        }

                        $reponse->closeCursor();
                    }
                    catch(Exception $e)
                        {
                            die('Erreur : '.$e->getMessage());
                        } 
    
 ?>

