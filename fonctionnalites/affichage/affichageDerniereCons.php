   <?php 

     include("../../auth/auth.php");
     include("../../includes/functions.php");      

     if (isset($_SESSION['idDeCeCabinet'])) {
         $nomCabinet       = $_SESSION['nomDeCeCabinet'];
     }

     

     if(isset($_GET['Identifiant'])){
        $identifiant = (String) trim($_GET['Identifiant']);

        $motifCons   = getMotifCurrentConsultation($identifiant,$nomCabinet);

        global $host_name;
        global $baseGlobale;
        global $db_user_name;
        global $db_password;
     ?>
     <div>
                      <!-- Pour le rendre Popup: class="form-popupCons" id="myForm" dans Div + form action="/action_page.php" class="form-containerCons"-->


                        <?php
                                                 try
                                                    {
                                                                                        
                                                     $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                     $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);                      
                                                                
                                                      // On recupere tout le contenu de la table news
                                                      $reponse = $bdd->query("SELECT * FROM patient,relpatcab,cabinet WHERE patient.idPatient = relpatcab.idPatient AND cabinet.idCabinet = relpatcab.idCabinet AND patient.idPatient = '$identifiant'");
                                                                                      
                                                      // On affiche le resultat
                                                      while ($donnees = $reponse->fetch())
                                                           {
                                                            
                                                              $id = $donnees['idPatient']; 

                                                              $nom = $donnees['nomPatient'];
                                                              
                                                              $prenom = $donnees['prenomPatient'];
                                                                           
                                                              $ddn = $donnees['dateNaissPatient'];
                                                            
                                                            }
                                                                    
                                                               $reponse->closeCursor();
                                                              }
                                                            catch(Exception $e)
                                                                {
                                                                   die('Erreur : '.$e->getMessage());
                                                                } 
                                                        ?>

                        <h1><?php echo $nom ." ". $prenom; ?> </h1>

                        <h4><?php $rest = substr($ddn, 0, 4); $age = date('Y')-$rest;  echo $age . " ans"; ?> </h4>
                     

                        <hr>

                        <B>Motif de consultation:</B>

                        <textarea style="width: 90%; height: 100px;" type="text" ><?php echo $motifCons;?> 
                           
                        </textarea>
                            <br>

                        <hr>
                        
                        <h2>Infos dernière Consultation</h2>

                        <hr>    
                        
                        <?php infosDernièreConsultation($nomCabinet, $id); ?> 
                        
                      <!--/form-->
    </div>
     <?php 
    }
 ?>