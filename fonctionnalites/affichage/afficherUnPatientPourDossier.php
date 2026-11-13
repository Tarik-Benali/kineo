     <?php include("../../includes/functions.php");      

     if(isset($_GET['Identifiant'])){
        $identifiant = (String) trim($_GET['Identifiant']);
        $nomCabinet = (String) trim($_GET['nomCabinet']);
        $optionFiltre = (String) trim($_GET['optionFiltre']);

        global $host_name;
        global $baseGlobale;
        global $db_user_name;
        global $db_password;

        if ($optionFiltre == "monCabinet") {
     ?>
     

      <section id="flip-scroll">
                                    <?php phenomeneCouleurExamenAttendu($nomCabinet, $identifiant); ?>

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Indices</th>
                                                <th>Informations</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
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
                                                                                    
                                                                     echo "<tr>";

                                                                            echo "<td>";
                                                                            echo "Identifiant";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[idPatient]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";

                                                                            echo "<td>";
                                                                            echo "Nom";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[nomPatient]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";      

                                                                            echo "<td>";
                                                                            echo "Prenom";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[prenomPatient]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";        

                                                                            echo "<td>";
                                                                            echo "Date de naissance";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[dateNaissPatient]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";       

                                                                            echo "<td>";
                                                                            echo "Lieu de naissance";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[lieuNaissPatient]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";        

                                                                            echo "<td>";
                                                                            echo "Adresse";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[adressePatient]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";        

                                                                            echo "<td>";
                                                                            echo "Email";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[emailPatient]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";        

                                                                            echo "<td>";
                                                                            echo "Téléphone";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[numTelPatient]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";        

                                                                            echo "<td>";
                                                                            echo "Sexe";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[sexePatient]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";        

                                                                            echo "<td>";
                                                                            echo "Groupage";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[groupagePatient]";
                                                                            echo "</td>";

                                                                    echo "</tr>";        
                                                                    echo "<tr>";        

                                                                            echo "<td>";
                                                                            echo "Date D'adhésion";
                                                                            echo "</td>";

                                                                            echo "<td>";
                                                                            echo "$donnees[dateDhadesion]";
                                                                            echo "</td>";

                                                                    echo "</tr>";

                                                                    }
                                                                    
                                                               $reponse->closeCursor();
                                                              }
                                                            catch(Exception $e)
                                                                {
                                                                   die('Erreur : '.$e->getMessage());
                                                                } 


                                                            getEmplacementFichePatient($nomCabinet, $identifiant);    
                                                        ?>
                                                
                                        </tbody>
                                    </table>
             </section>
     <?php 
        }elseif ($optionFiltre =="allCabinet") {
             
        }

    }
 ?>
