     <?php       include("../../includes/functions.php");

     if(isset($_GET['Identifiant'])){
        $identifiant = (String) trim($_GET['Identifiant']);

        $existanceDok = existanceMédecin($identifiant); 

        global $host_name;
        global $baseGlobale;
        global $db_user_name;
        global $db_password;

     ?>
     <div class="content-wrap" id="infoPatient">
                <div class="row">

                    <div class="col-sm-12">

                        <div class="nest" id="tablePatientClose">
                            <div class="title-alt">
                                <h6>
                                    Informations du médecin</h6>
                            </div>

                            <div class="body-nest" id="tablePatient">

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Indices</th>
                                                <th>Informations</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $varPourTest = NULL;
                                                 try
                                                    {
                                                                                        
                                                     $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                     $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);                          
                                                                
                                                                // On recupere tout le contenu de la table news
                                                     $reponse = $bdd->query("SELECT * FROM medecin WHERE medecin.idMedecin = '$identifiant'");
                                                                                      
                                                                // On affiche le resultat

                                                     while ($donnees = $reponse->fetch())
                                                           {
                                                                                    
                                                                     echo "<tr>";

                                                                            echo "<td>";
                                                                            echo "Identifiant";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[idMedecin]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";

                                                                            echo "<td>";
                                                                            echo "Nom";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[nomMedecin]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";      

                                                                            echo "<td>";
                                                                            echo "Prenom";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[prenomMedecin]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";        

                                                                            echo "<td>";
                                                                            echo "Date de naissance";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[dateNaissMedecin]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";       

                                                                            echo "<td>";
                                                                            echo "Lieu de naissance";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[lieuNaissMedecin]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";        

                                                                            echo "<td>";
                                                                            echo "Adresse";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[adresseMedecin]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";        

                                                                            echo "<td>";
                                                                            echo "Email";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[emailMedecin]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";        

                                                                            echo "<td>";
                                                                            echo "Téléphone";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[numTelMedecin]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";        

                                                                            echo "<td>";
                                                                            echo "Sexe";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[sexeMedecin]";
                                                                            echo "</td>";

                                                                    echo "</tr>";

                                                                    $varPourTest = $donnees['idMedecin'];                                          

                                                                    }

                                                               $reponse->closeCursor();
                                                              }
                                                            catch(Exception $e)
                                                                {
                                                                   die('Erreur : '.$e->getMessage());
                                                                } 
                                                        ?>
                                                
                                        </tbody>

                                    </table>
                                    <div>

                                    <?php    
            
                                                                        
                                      

                                        if ($varPourTest != "") {

                                            if ($existanceDok == 0) { 
                                                echo "<h5>
                                                    <B> Ajouter ce médecin à mon cabinet </B>
                                                    
                                                    <a href=\"fonctionnalites/ajout/affecterMedcinAuCabinet.php?idMedecin=$identifiant\">
                                                    <button style=\"margin-left: 5%;\" type=\"button\" name=\"recruMedecin\" id=\"recruMedecin\" class=\"btn btn-success\">
                                                        <span class=\"entypo-check\"></span> &nbsp;&nbsp;&nbsp;Ajouter &nbsp;&nbsp; </button>
                                                    </a>
                                                </h5>";
                                            }elseif ($existanceDok > 0) {

                                                      echo "<div class=\"alert alert-success\">";
                                                          echo "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
                                                          echo "<h5><span class=\"entypo-thumbs-up\"></span>";
                                                          echo "<strong>&nbsp;&nbsp;Ce médecin est déjà enregistré dans mon cabinet.</strong></h5>";
                                                      echo "</div>";
                                                
                                            }
                                         

                                      } 
                                      else{

                                        echo "<div class=\"alert alert-danger\">";
                                            echo "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
                                            echo "<h5><span class=\"entypo-thumbs-up\"></span>";
                                            echo "<strong>&nbsp;&nbsp;Faux Identifiant, Réessayer à nouveau !</strong></h5>";
                                        echo "</div>";
                                      } 

                                      ?>
                                       
                                    </div>
                                </section>

                            </div>

                        </div>


                    </div>

                </div>
            </div>
     <?php 
    }
 ?>
