<?php

	//include("historique.php");

	$host_name	  = 'localhost';
    $db_user_name = 'root';
    $db_password  = '';
    $baseGlobale  = 'baseglobal';


	$con = mysqli_connect("localhost","root","","baseglobal");

		if (mysqli_connect_errno())
		  {
		  echo "échec de connexion à MySQL: " . mysqli_connect_error();
		  }

function insertTablesInNewDB($databases,$lienDB){

	global $host_name;
	global $db_user_name;
	global $db_password;

	//$host_name = "localhost";
	$database = $databases;
	//$db_user_name = "root";
	//$db_password = ""; //pneumologue_mami: _16mam_17neu; premierCabiner: _14enib15rem; cabinetmedical: _14acid15abi;
	
				$conn =new mysqli($host_name, $db_user_name, $db_password, $database);

				$query = '';
				$sqlScript = file($lienDB);
				foreach ($sqlScript as $line)	{
					
					$startWith = substr(trim($line), 0 ,2);
					$endWith = substr(trim($line), -1 ,1);
					
					if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
						continue;
					}
						
					$query = $query . $line;
					if ($endWith == ';') {
						mysqli_query($conn,$query) or die('<div class="error-response sql-import-response">Problem in executing the SQL query <b>' . $query. '</b></div>');
						$query= '';		
					}
				}
				echo "<h1>Base de donnée: ". $database ." créé avec succès</h1>";
				//echo "<h1>Salut donne: ". crypterNomDeLaBase($database) ."</h1>";
				//echo '<div class="success-response sql-import-response">SQL file imported successfully</div>';
			}

function crypterNomDeLaBase($database){

				$database = str_replace( " ", 'c', $database );
				$database = str_replace( "'", "c", $database );
				$database = str_replace( str_split('éèàêôï\\/:*?\"<>|'), 'c', $database );//remplacer les 'éèàêôï par c.
					
				$inverse = strrev($database); // Affiche bel megloub
				
				$inverse = substr($inverse, 1, 4);

				$longueur = strlen($database); //longueur
				
				$longueurs = $longueur + 1;
				
				$subStract = substr($database, 1, 3);

				$nomCabinet = '_'.$longueur.$inverse.$longueurs.$subStract;
					
			   return $nomCabinet;		
					// Normalement ymedli:       salut:  _5tulas6alu
			}	
/*function crypterNomDeLaBase($database){

				$database = str_replace( " ", '', $database );
				$database = str_replace( "'", "", $database );
				$database = str_replace( "é", '', $database );
				$database = str_replace( "è", "", $database );

				$nomCabinet = 'virtuh64_'.$database;
					
			   return $nomCabinet;		
					// Normalement ymedli:       salut:  _5tulas6alu
			}	*/	



function modifierPatient($faiseur, $sujet, $Cabinet){ //**************************************************************



	//$con = mysqli_connect("localhost", "root", "", "baseglobal");
	global $con;

								// Check connection
								if (mysqli_connect_errno())
								  {
								  echo "Failed to connect to MySQL: " . mysqli_connect_error();
								  }

								$reqModificationPatient="SELECT * FROM historique,patient WHERE historique.opperation='ajout patient' AND historique.faiseur = '$faiseur' AND historique.sujet = '$sujet' AND patient.idPatient ='$sujet' AND historique.sujet = patient.idPatient";

								if ($result=mysqli_query($con,$reqModificationPatient))
								  {
								  // Return the number of rows in result set
								  $rowcount=mysqli_num_rows($result);

								  if ($rowcount==1) {

								  	if ($row = mysqli_fetch_array($result)) {

					                    
					                    $idFaiseur = $row['faiseur'];
					                    $nomPatient = $row['nomPatient'];
					                    $prenomPatient = $row['prenomPatient'];
					                    $dNPatient = $row['dateNaissPatient'];
					                    $lieuNPatient = $row['lieuNaissPatient'];
					                    $adressePatient = $row['adressePatient'];
					                    $emailPatient = $row['emailPatient'];
					                    $numTelPatient = $row['numTelPatient'];
					                    $sexePatient = $row['sexePatient'];
					                    $groupagePatient = $row['groupagePatient'];
					                    //&nomPatient=$idFaiseur&prenomPatient=$cabinet&dateLieuNaiss=$idFaiseur&adresse=$cabinet&tel=$idFaiseur&mail=$cabinet&sexe=$cabinet&groupage=$groupa

					                    echo "<div class=\"form-popupModificationPatient \" id =\"modifierPatient\">
									                        	<form action=\"fonctionnalites\mod\modPat.php\" class=\"form-container\">
									                        		<fieldset>
													                <h2>Modification</h2>

													                <input type=\"hidden\" name=\"idPat\" value=\"$sujet\">

													                <input type=\"hidden\" name=\"faiseur\" value=\"$idFaiseur\">

													                <input type=\"hidden\" name=\"idCabinet\" value=\"$Cabinet\">


													                <div class=\"control-group\">
													                   <div class=\"controls\">
						                                                <input type=\"text\" class=\"form-control\" placeholder=\"Nom: $nomPatient\" name=\"name\" id=\"name\" required>
						                                                </div>
						                                            </div>


						                                            <div class=\"control-group\">
						                                                <div class=\"controls\">
						                                                 <input type=\"text\" class=\"form-control\" id=\"prenom\" placeholder=\"Prénom: $prenomPatient\" name=\"prenom\" required>
						                                                </div>
						                                            </div>



						                                            <div class=\"control-group\">
						                                                <div class=\"controls\">
																		  <input type=\"text\" placeholder=\"Téléphone: $numTelPatient\" class=\"form-control\" id=\"phone\" name=\"tel\" required>	
																		</div>
																	</div>	

						                                            <div class=\"control-group\">
						                                                <div class=\"controls\">
																		<input type=\"text\" class=\"form-control\" id=\"email\" placeholder=\"Adresse Mail: $emailPatient\" name=\"mail\" required>
																		</div>
																	</div>	
															
														            <div class=\"control-group\">
							                                            <input type=\"text\" class=\"form-control\" id=\"dp1\" value=\"Date de naissance: $dNPatient\" name=\"dateNaiss\" required>
							                                        </div>

						                                            <input type=\"text\" placeholder=\"Lieu de naissance: $lieuNPatient\" name=\"lieuNaissPatient\" required>
        
						                                            <input type=\"text\" placeholder=\"Adresse: $adressePatient\" name=\"adresse\" required>

													                <div class=\"control-group\">
													                	<label class=\"control-label\" for=\"sexe\">Sexe Patient: &nbsp;</label>
						                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<SELECT name=\"sexe\" size=\"1\" id=\"sexe\" >
						                                                    <option value=\"\">$sexePatient</option>
						                                                    <option value=\"Homme\">Homme</option>
						                                                    <option value=\"Femme\">Femme</option>
						                                                </SELECT>
						                                            </div><br/>

													                <div class=\"control-group\">
													                	<label class=\"control-label\" for=\"groupeSanguin\">Groupage: &nbsp;</label>
						                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<SELECT name=\"groupeSanguin\" size=\"1\" id=\"groupage\" >
						                                                    <option value=\"\">\"$groupagePatient\"</option>
						                                                    <option value=\"0-\">O-</option>
						                                                    <option value=\"O+\">O+</option>
						                                                    <option value=\"A-\">A-</option>
						                                                    <option value=\"A+\">A+</option>
						                                                    <option value=\"B-\">B-</option>
						                                                    <option value=\"B+\">B+</option>
						                                                    <option value=\"AB-\">AB-</option>
						                                                    <option value=\"AB+\">AB+</option>
						                                                </SELECT>
						                                            </div><br/>

														                <button type=\"submit\" class=\"btn btn-warning\">
														                                    <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier
														                </button>
													                 
													                <button type=\"button\" class=\"btn btn-danger\" onclick=\"closeModificationPatient()\">
													                                    <span class=\"entypo-cancel-squared\"></span>&nbsp;&nbsp;Annuler
													                 </button> 
													                 </fieldset>                    
													            </form>
										        </div>";
			                   
								
									        }        
								  }
								  else{
										  echo"<div class=\"row\">
										                    <div class=\"col-md-4 col-md-offset-4\">
										                        <div class=\"account-box\" id =\"modifierPatient\">
										                        	<form action=\"#\" class=\"form-container\">
														                <h3>Vous n'avez pas le droit de modifier ce patient !</h3>
							                							<b>Les personnes qui ont le droit de modifier un patient:<br>&nbsp;&nbsp; - Médecin qui l'a ajouté. <br>&nbsp;&nbsp; - L'administrateur qui l'a ajouté <br> &nbsp;&nbsp; - Le patient lui même</b><br><br>
														                <button type=\"button\" class=\"btn btn-danger\" onclick=\"closeModificationPatient()\">
														                                    <span class=\"entypo-cancel-squared\"></span>&nbsp;&nbsp;Annuler
														                </button>                     
														            </form>
																</div>
														</div>
										        </div>";
								  }
								  // Free result set
								  mysqli_free_result($result);
								  }

								mysqli_close($con); 			                                          
					        } 



function supprimerPatient($faiseur, $sujet, $cabinet){ //************************************************************************


								//$con = mysqli_connect("localhost", "root", "", "baseglobal");
								global $con;

								global $host_name;
								global $baseGlobale;
								global $db_user_name;
								global $db_password;

								// Check connection
								/*if (mysqli_connect_errno())
								  {
								  echo "Failed to connect to MySQL: " . mysqli_connect_error();
								  }

								$sql="SELECT * FROM historique,patient WHERE historique.opperation='ajout patient' AND historique.faiseur = '$faiseur' AND historique.sujet = '$sujet' AND patient.idPatient ='$sujet' AND historique.sujet = patient.idPatient";

								if ($result=mysqli_query($con,$sql))
								  {
								  // Return the number of rows in result set
								  $rowcount=mysqli_num_rows($result);
								  if ($rowcount==1) {


								  	if ($row = mysqli_fetch_array($result)) {

								  		$nomPatient = $row['nomPatient'];
					                    $prenomPatient = $row['prenomPatient'];
					                    $idFaiseur = $row['faiseur'];*/
					                    try
                                                    {
                                                                                        
                                                     $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                     $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password,$pdo_options);                      
                                                                
                                                                // On recupere tout le contenu de la table news
                                                     $reponse = $bdd->query("SELECT nomPatient,prenomPatient FROM patient WHERE idPatient ='$sujet'");
                                                                                      
                                                                // On affiche le resultat
                                                     while ($donnees = $reponse->fetch())
                                                           {
   
                                                                $nomPatient     = $donnees['nomPatient'];
                                                                $prenomPatient  = $donnees['prenomPatient'];

                                                                    }
                                                                    
                                                               $reponse->closeCursor();
                                                              }
                                                            catch(Exception $e)
                                                                {
                                                                   die('Erreur : '.$e->getMessage());
                                                                } 


									  	 echo "<div class=\"row\">
									                    <div class=\"col-md-4 col-md-offset-4\">
									                        <div class=\"account-box\" id =\"supprimerPatient\">
									                          <form action=\"affichagePatients.php\" class=\"form-container\">

										                            <h2>Suprression $nomPatient  $prenomPatient </h2>

										                            <label for=\"email\"><b>Vous êtes sûr de vouloir supprimer ce patient ?</b></label>

										                            <a href=\"fonctionnalites\supp\suppPatient.php?idPat=$sujet&faiseur=$faiseur&idCabinet=$cabinet\">
											                            <button type=\"button\" class=\"btn btn-info\">
											                                                <span class=\"entypo-trash\"></span>&nbsp;&nbsp;Supprimer
											                            </button>
											                        </a>

										                            <button type=\"button\" class=\"btn btn-danger\" onclick=\"closeSupressionPatient()\">
										                                                <span class=\"entypo-cancel-squared\"></span>&nbsp;&nbsp;Annuler 
										                            </button>                    
									                        	</form>
									                        </div>
									                    </div>
									            </div>";/*
									        }        
								  }
								  else{
									  echo"<div class=\"row\">
									                    <div class=\"col-md-4 col-md-offset-4\">
									                        <div class=\"account-box\" id =\"supprimerPatient\">
									                        	<form action=\"#\" class=\"form-container\">
													                <h3>Vous n'avez pas le droit de supprimer ce patient !</h3>

						                							<b>Les personnes qui ont le droit de supprimer un patient sont:<br>&nbsp;&nbsp; - Médecin qui l'a ajouté. <br>&nbsp;&nbsp; - L'administrateur qui l'a ajouté <br> &nbsp;&nbsp; - Le patient lui même</b><br><br>
													                <button type=\"button\" class=\"btn btn-danger\" onclick=\"closeSupressionPatient()\">
													                                    <span class=\"entypo-cancel-squared\"></span>&nbsp;&nbsp;Annuler </button>                     
													              </form>
															</div>
													</div>
									        </div>";
								  }
								  // Free result set
								  mysqli_free_result($result);
								  }

								mysqli_close($con);  */                    
					 }



	function affichageDeToutLesExamens($nomBD){

		//$nomBD 	    = crypterNomDeLaBase($nomBD);
		global $host_name;
		global $db_user_name;
		global $db_password;

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($nomBD);
		//$db_user_name = "root";
		//$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM examens');
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                 echo "<tr>";

                                        echo "<td>";
                                        echo "$donnees[idExamen]";
                                        echo "</td>";

                                        echo "<td>";
                                        echo "$donnees[typeExamen]";
                                        echo "</td>";

                                        echo "<td>";
                                        echo "$donnees[objectif]";
                                        echo "</td>";

                                echo "</tr>";

                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}
	function choisirExamen(){

		//$host_name = "localhost";
		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		$database = $baseGlobale;
		//$db_user_name = "root";
		//$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM examens');
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {

                                 $idExam = $donnees['idExamen'];	

                                 echo "<option>";
									
									 echo "$donnees[typeExamen]";

                               	 echo "</option>";

                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}
	function choisirExamenDuCabinet($nomCabinet){

		//$nomCabinet 	    = crypterNomDeLaBase($nomCabinet);
		global $host_name;
		global $db_user_name;
		global $db_password;

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($nomCabinet);
		//$db_user_name = "root";
		//$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM examens');
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {

                                 //$idExam = $donnees['idExamen'];	

                                 echo "<option>";
									
									 echo "$donnees[typeExamen]";

                               	 echo "</option>";

                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}

function ajoutExamenDansBDDLocal($nomBD,$type,$obj,$principe,$dossier,$precau){

	//$nomBD 	    = crypterNomDeLaBase($nomBD);
	global $host_name;
	global $db_user_name;
	global $db_password;

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($nomBD);
		//$db_user_name = "root";
		//$db_password = "";

		$type         	= str_replace("'","\'",$type);
        $obj       		= str_replace("'","\'",$obj);
		$principe       = str_replace("'","\'",$principe);
        $dossier   	    = str_replace("'","\'",$dossier);
        $precau     	= str_replace("'","\'",$precau);

                        try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("INSERT INTO examens(typeExamen, objectif, principe, dossierApporter, precautions) VALUES ('$type','$obj','$principe','$dossier','$precau')");

                            $reponse->closeCursor();
                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
                        } 
				

function nbrReponseRapport($idCabinet,$idMedecin){

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		$database = $baseGlobale;



						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT COUNT(idRapport) AS reponseRapport FROM rapporttechnique WHERE idCabinet='$idCabinet' AND idExpediteur ='$idMedecin' AND vue ='0' ");
                                 
                            // On affiche le resultat
                                while ($donnees = $reponse->fetch())
                                     {
                                        $nbr = $donnees['0'];

                                      }

                                      return $nbr;
                                 
                           	$reponse->closeCursor();
                   
                          		}
                        	catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}

function nbrDExamens($nomBD){

	//$nomBD 	    = crypterNomDeLaBase($nomBD);

		global $host_name;
		$database = crypterNomDeLaBase($nomBD);
		global $db_user_name;
		global $db_password;
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                       
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT COUNT(idExamen) AS typeExamen FROM examens");
                                 
                            // On affiche le resultat
                                while ($donnees = $reponse->fetch())
                                     {
                                        $nbr = $donnees['0'];

                                      }

                                      $nbr = $nbr + 1;

                                      return $nbr;
                                 
                           	$reponse->closeCursor();
                   
                          		}
                        	catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}					

function choisirSpecialite(){

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;

		$database = $baseGlobale;
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM specialite');
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {

                                 $idSpecialite = $donnees['idSpecialite'];	

                                 echo "<option>";
									
									 echo "$donnees[nomSpecialite]";

                               	 echo "</option>";

                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}
function ajoutSpecDansBDDLocal($con,$ceMoment,$idCabinet,$idFaiseur,$nomBD,$specialite){

	//$nomBD 	    = crypterNomDeLaBase($nomBD);

	global $host_name;
	global $db_user_name;
	global $db_password;

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($nomBD);
		//$db_user_name = "root";
		//$db_password = "";


		$idFaiseur    	= str_replace("'","\'",$idFaiseur);
		$specialite     = str_replace("'","\'",$specialite);

						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("INSERT INTO specialite(`nomSpecialite`) VALUES ('$specialite')");

                            $reponse->closeCursor();

                            hisAjoutSpec($con, $ceMoment , $idCabinet, $idFaiseur, $nomBD);
                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}	

function affichageDeToutLesSpecDuCabinet($nomBD){

	//$nomBD 	    = crypterNomDeLaBase($nomBD);

	global $host_name;
	global $db_user_name;
	global $db_password;

		//$host_name = "";
		$database = crypterNomDeLaBase($nomBD);
		//$db_user_name = "root";
		//$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM specialite');
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                 echo "<tr>";

                                        echo "<td>";
                                        echo "$donnees[idSpecialite]";
                                        echo "</td>";

                                        echo "<td>";
                                        echo "$donnees[nomSpecialite]";
                                        echo "</td>";

                                echo "</tr>";

                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}

function nbrRDVAVenir($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

						try
		                    {
		                       $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);              

		                                                     
		                          $date 		= date('d/m/Y');
		                          $dateDuJour 	= explode("/", $date);
		                          $dJour 		= $dateDuJour[2].$dateDuJour[1].$dateDuJour[0]; 

		                          $reponse = $bdd->query("SELECT dateRDV FROM rdv");

									$nbrRDVàVenir = 0;

		                      while ($donnees = $reponse->fetch())
		                         {
		                              $dateRDV  	= $donnees['dateRDV'];
		                              $drdv 		= explode("/", $dateRDV);
		                              $dRDV 		= $drdv[2].$drdv[1].$drdv[0];

		                              if ($dRDV >= $dJour) {
		                              		$nbrRDVàVenir = $nbrRDVàVenir + 1;
		                              }

		                              
								}
									echo $nbrRDVàVenir;

		                           $reponse->closeCursor();
		                    }
		                catch(Exception $e)
		                    {
		                       die('Erreur : '.$e->getMessage());
		                    }
				}

function nbrRDVDuJour($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                          $date = "'" .date('d/m/Y')."'";
                          $reponse = $bdd->query("SELECT COUNT(id) FROM `rdv` WHERE dateRDV = $date");
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                              echo "<td> $donnees[0] </td>";
						}
                           $reponse->closeCursor();
                    }
 
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
						 
				}

function afficheToutLesRDV($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $date = "'" .date('d/m/Y')."'";
                          $reponse = $bdd->query("SELECT * FROM rdv order by dateRDV desc");
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                              echo "</tr>";

                              echo "<td> $donnees[nomP] </td>";
                              echo "<td> $donnees[dateRDV] </td>";

                              echo "<td data-value> $donnees[id] </td>";
                              echo "<td data-value> $donnees[prenoP] </td>";
                              echo "<td data-value> $donnees[tel] </td>";
                              echo "<td data-value> $donnees[medecin] </td>";       

                              echo "<td data-value=\"1\"> <span class=\"status-metro status-active\" title=\"Active\"> $donnees[heureRDV] </span></td>";                                                                                    
                              echo "</tr>";
						}
                           $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
						 
				}
function afficheRDVàVenir($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

				try
		                    {
		                       $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		                       $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
		                                                     
		                          $date 		= date('d/m/Y');
		                          $dateDuJour 	= explode("/", $date);
		                          $dJour 		= $dateDuJour[2].$dateDuJour[1].$dateDuJour[0]; 

		                          $reponse = $bdd->query("SELECT * FROM rdv order by dateRDV desc");
		                          							//Après, pour optimiser la requete, je met: WHERE statue < 'consultation close'

		                      while ($donnees = $reponse->fetch())
		                         {
		                              $dateRDV  	= $donnees['dateRDV'];
		                              $drdv 		= explode("/", $dateRDV);
		                              $dRDV 		= $drdv[2].$drdv[1].$drdv[0];

		                              if ($dRDV >= $dJour) {
										echo "</tr>";

			                              echo "<td> $donnees[nomP] </td>";
			                              echo "<td> $donnees[dateRDV] </td>";

			                              echo "<td data-value> $donnees[id] </td>";
			                              echo "<td data-value> $donnees[prenoP] </td>";
			                              echo "<td data-value> $donnees[tel] </td>";
			                              echo "<td data-value> $donnees[medecin] </td>";       

			                              echo "<td data-value=\"1\"> <span class=\"status-metro status-active\" title=\"Active\"> $donnees[heureRDV] </span></td>";                                                                                    
		                              	echo "</tr>";		                              
		                              }

		                              
								}
		                           $reponse->closeCursor();
		                    }
		                catch(Exception $e)
		                    {
		                       die('Erreur : '.$e->getMessage());
		                    }
				

						 
			}				

function afficheLesRDVDuJour($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);
	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $date = "'" .date('d/m/Y')."'";
                          $ceMoment = date("H:i");
                          $reponse = $bdd->query("SELECT * FROM rdv WHERE statut <= 2 AND dateRDV = $date order by dateRDV desc, heureRDV asc");
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                              echo "</tr>";

                              echo "<td> $donnees[nomP] </td>";
                              echo "<td> $donnees[dateRDV] </td>";

                              echo "<td data-value> $donnees[id] </td>";
                              echo "<td data-value> $donnees[prenoP] </td>";
                              echo "<td data-value> $donnees[tel] </td>";
                              echo "<td data-value> $donnees[medecin] </td>";       

                              echo "<td data-value=\"1\"> <span class=\"status-metro status-active\" title=\"Active\"> $donnees[heureRDV] </span></td>";

                              echo "<form action=\"fonctionnalites/mod/passerRDV.php\"  id=\"passerRDV\" method=\"POST\"> 
								                    <input type=\"hidden\" name=\"id\" value=\"$donnees[id]\">
								                    <input type=\"hidden\" name=\"nomCabinet\" value=\"$nomBD\">
								           <a href=\"fonctionnalites/mod/passerRDV.php\"><td data-value> <button type=\"submit\" class=\"btn btn-info\"><span class=\"entypo-forward\">&nbsp;&nbsp;&nbsp;Passer&nbsp;&nbsp;</button> </td></a>
								    </form>";

                              switch ($donnees['statut']) {
                              	case '0':
                              		echo "<td data-value> <button class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#".$donnees['id'] ."\"><span class=\"entypo-alert\">&nbsp;&nbsp;Absent&nbsp;&nbsp;</button> </td>";


                                echo "<div class=\"container\">

                                      <div class=\"modal fade\"  id=\"".$donnees['id'] ."\" role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">".$ceMoment."</button>
                                              <h4 class=\"modal-title\">Le Patient ".$donnees['nomP'] ." est en salle</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"height: 250px; overflow-y: auto;\">

											<form action=\"fonctionnalites/mod/statutRDV.php\"  id=\"passerRDVs\" method=\"POST\"> 
										        <fieldset>

										        	<div class=\"form-group\"> 

                                             
                                              <label for=\"examen\"><b>Motif de Consultation</b></label>

                                              <br>

                                              <textarea type=\"text\" name=\"motifCons\" placeholder=\"tapez ici le motif de consultation ...\" style=\"height: 100px; width: 570px \"  required></textarea>                                                               
                          
                                            </div>
                                            
                                              <ul id=\"breadcrumb\">
                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>

                                                
								                    <input type=\"hidden\" name=\"id\" value=\"$donnees[id]\">
								                    <input type=\"hidden\" name=\"nomCabinet\" value=\"$nomBD\">

								                   
                                                   <button type=\"submit\" style=\"margin-right: 10px;\" class=\"btn btn-warning pull-right\">
                                                   <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Enregistrer</button>
                                                   	
                                                </ul>

	                                            	</div>                                       

	                                            </fieldset>                    
											</form>
                                              
                                          </div>													                 

                                          
                                        </div>
                                      </div>
                                      
                                    </div>";
								            
                              		break;
                              	case '1':
                              		echo "<td data-value> <button class=\"btn btn-warning\"><span class=\"entypo-flag\">&nbsp;&nbsp;En salle&nbsp;&nbsp;</button> </td>";
                              		break;
                              	case '4':
                              		echo "<td data-value> <button>En pause</button> </td>";
                              		break;		
                              	
                              	default:
                              		# code...
                              		break;
                              }

                              

                              echo "</tr>";
						}
                           $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }				 
				}

function getDocsName($idCabinet){

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT nomMedecin FROM medecin,relationmedcab WHERE medecin.idMedecin = relationmedcab.idMedecin AND relationmedcab.idCabinet = $idCabinet");
                  
                  while ($donneesM = $reponse->fetch())
                        {

                        	echo "<option>";
									
									echo "$donneesM[nomMedecin]";

                            echo "</option>";

 
                        }
                  $reponse->closeCursor();


	}

function getExamsName($nomCabinet){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomCabinet 	    = crypterNomDeLaBase($nomCabinet);

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$nomCabinet",$db_user_name,$db_password, $pdo_options); 

                  $reponse = $bdd->query("SELECT typeExamen FROM examens");
                  
                  while ($donneesE = $reponse->fetch())
                        {

                        	echo "<option>";
									
									echo "$donneesE[typeExamen]";

                            echo "</option>";

 
                        }
                  $reponse->closeCursor();


	}


function ajoutConsultation($Cabinet,$idPatient,$idMedecin,$conclusion){

	//$Cabinet 	    = crypterNomDeLaBase($Cabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($Cabinet);
		//$db_user_name = "root";
		//$db_password = "";

		$conclusion    	= str_replace("'","\'",$conclusion);

						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $ceMoment = date("Y-m-d H:i:s");
							$reponse = $bdd->query("INSERT INTO consultation(`idPatient`, `idMedecin`, `conclusion`, `heureConsultation`) VALUES ('idPatient','$idMedecin','$conclusion','$ceMoment')");

                            $reponse->closeCursor();
                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}

function insertionRDV($Cabinet,$name,$prenom,$mail,$phone,$datRDV,$heureRDV,$doc){

		//$Cabinet 	    = crypterNomDeLaBase($Cabinet);

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($Cabinet);
		//$db_user_name = "root";
		//$db_password = "";
		global $host_name;
		global $db_user_name;
		global $db_password;

		$name    	= str_replace("'","\'",$name);
		$prenom    	= str_replace("'","\'",$prenom);
		$mail    	= str_replace("'","\'",$mail);
		$phone    	= str_replace("'","\'",$phone);
		$doc    	= str_replace("'","\'",$doc);

						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
							$reponse = $bdd->query("INSERT INTO rdv (nomP,prenoP,mail,tel,dateRDV,heureRDV,medecin) VALUES ('$name','$prenom','$mail','$phone','$datRDV','$heureRDV','$doc')");

                            $reponse->closeCursor();                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}				

function insertExam($nomCabinet, $idConsultation, $typeExam, $resultExam){

	//$nomCabinet 	    = crypterNomDeLaBase($nomCabinet);

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($nomCabinet);
		//$db_user_name = "root";
		//$db_password = "";

		global $host_name;
		global $db_user_name;
		global $db_password;

		$typeExam 	= str_replace("'","\'",$typeExam);
		$resultExam = str_replace("'","\'",$resultExam);


		if ($resultExam == "") {
			
						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
						$reponse = $bdd->query("INSERT INTO `relationexamcons`(`idConsultation`, `typeExamen`) VALUES ('$idConsultation','$typeExam')");

                            $reponse->closeCursor();                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
            }else{
            		try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
						$reponse = $bdd->query("INSERT INTO `relationexamcons`(`idConsultation`, `typeExamen`,`resultExam`) VALUES ('$idConsultation','$typeExam','$resultExam')");

                            $reponse->closeCursor();                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }	
            } 
		}                                               
            
function infoPatientPourOrdonnance($identifiant){

	//$Cabinet 	    = crypterNomDeLaBase($Cabinet);

		//$host_name = "localhost";
		//$database = crypterNomDeLaBase($Cabinet);
		//$db_user_name = "root";
		//$db_password = "";
		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;

		
						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);                      
                                                                
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT * FROM patient WHERE idPatient = '$identifiant'");

                            while ($donnees = $reponse->fetch())
                                                           {
                                                    $cetteannee = date('Y'); 
                                                          	
                                                    $age = $cetteannee - substr($donnees['dateNaissPatient'], 0, 4);
                                                    $age = $age . " ans";       	

                                                    echo "<div class=\"control-group\">   
                                                            <label class=\"control-label\" for=\"nom\">Nom Patient</label>
                                                            <div class=\"controls\">
                                                                <input type=\"text\" class=\"form-control\" name=\"nom\" id=\"nom\" value=\"$donnees[nomPatient]\">
                                                            </div>
                                                        </div>";
                                                    echo "<br>";    

                                                    echo "<div class=\"control-group\">
                                                            <label class=\"control-label\" for=\"prenom\">Prenom Patient</label>
                                                            <div class=\"controls\">
                                                                <input type=\"text\" class=\"form-control\" name=\"prenom\" id=\"prenom\" value=\"$donnees[prenomPatient]\">
                                                            </div>
                                                        </div>";
                                                    echo "<br>";

                                                    echo "<div class=\"control-group\" id=\"age\">
                                                            <label class=\"control-label\" id=\"age\" for=\"age\">Age Patient</label>
                                                            <div class=\"controls\">
                                                                <input type=\"text\" class=\"form-control\" name=\"age\" id=\"age\" value=\"$age\">
                                                            </div>
                                                        </div>"; 
                                                    echo "<br>";                               

                                                                    }
                                                            $reponse->closeCursor();                                                         
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}       			

                                                                                                  								 

function infosDernièreConsultation($nomCabinet, $idPatient){

	$nomCabinet         	= str_replace("'","\'",$nomCabinet);
	//$nomCabinet 	        = crypterNomDeLaBase($nomCabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;

    //$host_name = "";
    $database = crypterNomDeLaBase($nomCabinet);
    //$db_user_name = "root";
    //$db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                     
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT * FROM `consultations` WHERE `idPatient` = '$idPatient' ORDER BY `heureConsultation` DESC LIMIT 1");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                $idConsultation  = $donnees['idConsultation'];

                                echo "<B>Motif de la dernière consultation:</B>";

                                echo "<br><br>";

                                motifDernièreConsultation($nomCabinet,$idConsultation);

   								echo "<hr>";

                                examensDernièreConsultation($nomCabinet, $idConsultation);

                                echo "<B>Conclusion:</B>";
                                	echo "<textarea style=\"width: 90%; height: 100px;\" type=\"text\"> $donnees[conclusion] </textarea>";
                                echo "<br>";

                                echo "<hr>";
                       
                                typeOrdonnanceDernièreConsultation($nomCabinet, $idConsultation);


                                echo "<B>Médicament préscrit:</B>";

                                echo "<br><br>";

                                medicamentDernièreConsultation($nomCabinet, $idConsultation);

                                echo "<hr>";

                                echo "<B>Consultation du: $donnees[heureConsultation]</B> ";

                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
        }

function examensDernièreConsultation($nomCabinet, $idConsultation){

	$nomCabinet      	= str_replace("'","\'",$nomCabinet);
	//$nomCabinet 	    = crypterNomDeLaBase($nomCabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;

    //$host_name = "";
    $database = crypterNomDeLaBase($nomCabinet);
    //$db_user_name = "root";
    //$db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                             
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT typeExamen,resultExam FROM relationexamcons,consultations WHERE relationexamcons.idConsultation = consultations.idConsultation AND consultations.idConsultation = '$idConsultation'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {

	                            echo "<B>Examen:</B>";
		                                echo "<label style=\"width: 90%;\" type=\"text\" class=\"form-control\">";
		                                	echo $donnees['typeExamen'];
				                        echo "</label>";
			                        echo "<br>";
			                    echo "<B>Résultat:</B>";
		                                echo "<label style=\"width: 90%;\" type=\"text\" class=\"form-control\">";
		                                	echo $donnees['resultExam'];
				                        echo "</label>";
		                    
		                    echo "<hr>";        
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
        }


function typeOrdonnanceDernièreConsultation($nomCabinet, $idConsultation){

		$nomCabinet        	= str_replace("'","\'",$nomCabinet);
		//$nomCabinet 	    = crypterNomDeLaBase($nomCabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;

    //$host_name = "";
    $database = crypterNomDeLaBase($nomCabinet);
    //$db_user_name = "root";
    //$db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT `typeOrdonnance` FROM `ordonnance` WHERE `idConsultation` = '$idConsultation'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                	$typeOrdonnance = $donnees['typeOrdonnance'];

	                            echo "<B>Type Ordonnance:</B>";
	                            		switch ($typeOrdonnance) {
	                            			case '1':
	                            					echo "    ";
	                            					echo "Ordonnance Classique";
	                            				break;
	                            			case '2':
	                            					echo "    ";
	                            					echo "Lettre d'Orientation";
	                            				break;
	                            			case '3':
	                            					echo "    ";
	                            					echo "Ordonnance Vide";
	                            				break;			
	                            		}

		                    echo "<hr>";        
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
        }

function motifDernièreConsultation($nomCabinet,$idConsultation){ 

	$nomCabinet     = str_replace("'","\'",$nomCabinet);
	//$nomCabinet 	= crypterNomDeLaBase($nomCabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;
	
	//$host_name = "localhost";
    $database = crypterNomDeLaBase($nomCabinet);
    //$db_user_name = "root";
    //$db_password = "";

        
    try
        {

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options);  

                  $reponse = $bdd->query("SELECT motifCons FROM consultations  WHERE idConsultation = '$idConsultation';");
                  
                  while ($donneesM = $reponse->fetch())
                        {

                        	echo "$donneesM[motifCons]";
                        	echo "<br>";

                        }
                  $reponse->closeCursor();
         }
  catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                }          
		}

function medicamentDernièreConsultation($nomCabinet,$idConsultation){

	$nomCabinet     = str_replace("'","\'",$nomCabinet);
	//$nomCabinet 	= crypterNomDeLaBase($nomCabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;
	
	//$host_name = "localhost";
    $database = crypterNomDeLaBase($nomCabinet);
    //$db_user_name = "root";
    //$db_password = "";

        
    try
        {

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options);  

                  $reponse = $bdd->query("SELECT nomMedicament,dosage,frequence FROM medicament,relationmediccons,consultations  WHERE medicament.idMedicament = relationmediccons.idMedicament AND relationmediccons.idConsultation = consultations.idConsultation AND consultations.idConsultation = '$idConsultation';");
                  
                  while ($donneesM = $reponse->fetch())
                        {

                    echo $donneesM['nomMedicament']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$donneesM['dosage']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$donneesM['frequence'];
                    echo "<br>";

                        }
                  $reponse->closeCursor();
         }

  catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                }          
		}


 

function nomMedicament($nomCabinet){

	$nomCabinet         	= str_replace("'","\'",$nomCabinet);
	//$nomCabinet 	        = crypterNomDeLaBase($nomCabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;
	
	//$host_name = "localhost";
    $database = crypterNomDeLaBase($nomCabinet);
    //$db_user_name = "root";
    //$db_password = "";

    	
    try
        {

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options);  

                  $reponse = $bdd->query("SELECT nomMedicament FROM medicament");
                  
                  while ($donneesM = $reponse->fetch())
                        {

                        	echo "<option>";
									
									echo "$donneesM[nomMedicament]";

                            echo "</option>";

 
                        }
                  $reponse->closeCursor();
         }
  catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                }          
		}

function dozMedicament($nomCabinet){

	$nomCabinet      	= str_replace("'","\'",$nomCabinet);
	//$nomCabinet 	    = crypterNomDeLaBase($nomCabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;
	
	//$host_name = "localhost";
    $database = crypterNomDeLaBase($nomCabinet);
    //$db_user_name = "root";
    //$db_password = "";

    

    try
        {

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options);  

                  $reponse = $bdd->query("SELECT dosageMedicament FROM medicament");
                  
                  while ($donneesM = $reponse->fetch())
                        {

                        	echo "<option>";
									
									echo "$donneesM[dosageMedicament]";

                            echo "</option>";

 
                        }
                  $reponse->closeCursor();
         }
  catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                }          
		}

function fréquenceMedicament(){

	
	//$host_name = "localhost";
    //$database = "baseglobal";
    //$db_user_name = "root";
    //$db_password = "";
    	global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;

    $database = $baseGlobale;

    

    try
        {

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options);  

                  $reponse = $bdd->query("SELECT frequence FROM freqMedicament");
                  
                  while ($donneesM = $reponse->fetch())
                        {

                        	echo "<option>";
									
									echo "$donneesM[frequence]";

                            echo "</option>";

 
                        }
                  $reponse->closeCursor();
         }
  catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                }          
		}


function insertionOrdonnance($Cabinet, $idMed, $dateOrd, $qntMed, $idCons, $typeOrd){

	$Cabinet      	= str_replace("'","\'",$Cabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($Cabinet);
		//$db_user_name = "root";
		//$db_password = "";

		$typeOrd         	= str_replace("'","\'",$typeOrd);
		
						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
							$reponse = $bdd->query("INSERT INTO `ordonnance`(`idMedecin`, `dateOrdonnance`, `quantiteMedicament` , `idConsultation`, `typeOrdonnance`) VALUES ('$idMed','$dateOrd','$qntMed','$idCons','$typeOrd');");
                            $reponse->closeCursor();                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}

function relationMedicConsul($Cabinet, $idCons, $nomMedicament, $dosage, $frequence){

	$Cabinet      	= str_replace("'","\'",$Cabinet);
	//$Cabinet 	    = crypterNomDeLaBase($Cabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;
	
		//$host_name = "localhost";
		$database = crypterNomDeLaBase($Cabinet);
		//$db_user_name = "root";
		//$db_password = "";

		$nomMedicament      = str_replace("'","\'",$nomMedicament);
		$dosage         	= str_replace("'","\'",$dosage);
		$frequence         	= str_replace("'","\'",$frequence);
        

		try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT idMedicament FROM medicament WHERE nomMedicament ='$nomMedicament' ");
                                 
                            // On affiche le resultat
                                while ($donnees = $reponse->fetch())
                                     {
                                        $idMedicament = $donnees['idMedicament'];

                                      }

                                      saveRelMediCons($Cabinet, $idCons, $idMedicament, $dosage, $frequence);
                                 
                           	$reponse->closeCursor();
                   
                          		}
                        	catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
				}  

function saveRelMediCons($Cabinet, $idCons, $idMedicament, $dosage, $frequence){

	$Cabinet      	= str_replace("'","\'",$Cabinet);
	//$Cabinet 	    = crypterNomDeLaBase($Cabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($Cabinet);
		//$db_user_name = "root";
		//$db_password = "";

		$dosage         	= str_replace("'","\'",$dosage);
		$frequence         	= str_replace("'","\'",$frequence);

						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
							$reponse = $bdd->query("INSERT INTO `relationmediccons`(`idConsultation`, `idMedicament`, `dosage`, `frequence`) VALUES ('$idCons','$idMedicament', '$dosage', '$frequence')");
                            $reponse->closeCursor();                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}

function insertConsRenouvOrd($Cabinet, $idConsultation, $idPatient, $idRendezvous, $idMedecin, $conclusion, $ceMoment, $motifCons){

	$Cabinet      	= str_replace("'","\'",$Cabinet);
	$idConsultation = str_replace("'","\'",$idConsultation);
	$idPatient		= str_replace("'","\'",$idPatient);
	$idRendezvous	= str_replace("'","\'",$idRendezvous);
	$idMedecin		= str_replace("'","\'",$idMedecin);
	$conclusion 	= str_replace("'","\'",$conclusion);
	$ceMoment 		= str_replace("'","\'",$ceMoment);
	$motifCons 		= str_replace("'","\'",$motifCons);

	//$Cabinet 	    = crypterNomDeLaBase($Cabinet);

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($Cabinet);
		//$db_user_name = "root";
		//$db_password = "";
		global $host_name;
		global $db_user_name;
		global $db_password;


						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
							$reponse = $bdd->query("INSERT INTO consultations(idConsultation,idPatient,idRendezvous,idMedecin,conclusion,heureConsultation,motifCons) VALUES ('$idConsultation','$idPatient','$idRendezvous','$idMedecin','$conclusion','$ceMoment','$motifCons')");
                            $reponse->closeCursor();                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}

function inscriAjoutUser($username, $passwordH, $typeCompte, $identifiant){

		//$host_name = "localhost";
		//$database = "baseglobal";
		//$db_user_name = "root";
		//$db_password = "";
		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;


		$database = $baseGlobale;

		$username    = str_replace("'","\'",$username);


						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
							$reponse = $bdd->query("INSERT into `users` (login, password, typeCompte, identifiant) VALUES ('$username', '$passwordH', '$typeCompte' , '$identifiant')");
                            $reponse->closeCursor();                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
	}				
			  
function inscriPatient($identifiant, $nom,$prenom,$dateNaiss,$lieuNaiss,$adress,$email,$tel,$Sexe,$groupeSanguin){

		//$host_name = "localhost";
		//$database = "baseglobal";
		//$db_user_name = "root";
		//$db_password = "";
		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;

		$database = $baseGlobale;

		$nom      			= str_replace("'","\'",$nom);
		$prenom 			= str_replace("'","\'",$prenom);
		$dateNaiss			= str_replace("'","\'",$dateNaiss);
		$lieuNaiss			= str_replace("'","\'",$lieuNaiss);
		$adress				= str_replace("'","\'",$adress);
		$email 				= str_replace("'","\'",$email);
		$tel 				= str_replace("'","\'",$tel);
		$Sexe 				= str_replace("'","\'",$Sexe);
		$groupeSanguin 		= str_replace("'","\'",$groupeSanguin);

						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
							$reponse = $bdd->query("INSERT INTO `patient`(`idPatient`, `nomPatient`, `prenomPatient`, `dateNaissPatient`, `lieuNaissPatient`, `adressePatient`, `emailPatient`, `numTelPatient`, `sexePatient`, `groupagePatient`) VALUES ('$identifiant', '$nom','$prenom','$dateNaiss','$lieuNaiss','$adress','$email','$tel','$Sexe','$groupeSanguin')");
                            $reponse->closeCursor();                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
	}

function inscriMed($identifiant, $nom,$prenom,$dateNaiss,$lieuNaiss,$adress,$email,$tel,$Sexe,$groupeSanguin){

		//$host_name = "localhost";
		//$database = "baseglobal";
		//$db_user_name = "root";
		//$db_password = "";
		global $host_name;
		global $db_user_name;
		global $db_password;

	    $database = $baseGlobale;

		$nom      			= str_replace("'","\'",$nom);
		$prenom 			= str_replace("'","\'",$prenom);
		$dateNaiss			= str_replace("'","\'",$dateNaiss);
		$lieuNaiss			= str_replace("'","\'",$lieuNaiss);
		$adress				= str_replace("'","\'",$adress);
		$email 				= str_replace("'","\'",$email);
		$tel 				= str_replace("'","\'",$tel);
		$Sexe 				= str_replace("'","\'",$Sexe);
		$groupeSanguin 		= str_replace("'","\'",$groupeSanguin);

						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
							$reponse = $bdd->query("INSERT INTO `medecin`(`idMedecin`, `nomMedecin`, `prenomMedecin`, `dateNaissMedecin`, `lieuNaissMedecin`, `adresseMedecin`, `emailMedecin`, `numTelMedecin`, `sexeMedecin`, `groupageMedecin`) VALUES ('$identifiant','$nom','$prenom','$dateNaiss','$lieuNaiss','$adress','$email','$tel','$Sexe','$groupeSanguin')");
                            $reponse->closeCursor();                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
	}

function inscriInf($identifiant, $nom,$prenom,$dateNaiss,$lieuNaiss,$adress,$email,$tel,$Sexe,$groupeSanguin){

		/*$host_name = "localhost";
		$database = "baseglobal";
		$db_user_name = "root";
		$db_password = "";*/

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;

		$database = $baseGlobale;

		$nom      			= str_replace("'","\'",$nom);
		$prenom 			= str_replace("'","\'",$prenom);
		$dateNaiss			= str_replace("'","\'",$dateNaiss);
		$lieuNaiss			= str_replace("'","\'",$lieuNaiss);
		$adress				= str_replace("'","\'",$adress);
		$email 				= str_replace("'","\'",$email);
		$tel 				= str_replace("'","\'",$tel);
		$Sexe 				= str_replace("'","\'",$Sexe);
		$groupeSanguin 		= str_replace("'","\'",$groupeSanguin);


						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
							$reponse = $bdd->query("INSERT INTO `infermier`(`idInfermier`, `nomInfermier`, `prenomInfermier`, `dateNaissInfermier`, `lieuNaissInfermier`, `adresseInfermier`, `emailInfermier`, `numTelInfermier`, `sexeInfermier`, `groupageInfermier`) VALUES ('$identifiant','$nom','$prenom','$dateNaiss','$lieuNaiss','$adress','$email','$tel','$Sexe','$groupeSanguin')");
                            $reponse->closeCursor();                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
	}

function ordPopup($nomCabinet, $idConsultation){

	$nomCabinet        	= str_replace("'","\'",$nomCabinet);
	//$nomCabinet 		= crypterNomDeLaBase($nomCabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;

		$idConsultationPop = $idConsultation . "pop";

    //$host_name = "";
    $database = crypterNomDeLaBase($nomCabinet);
    //$db_user_name = "root";
    //$db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);   
                   
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT `typeOrdonnance` FROM `ordonnance` WHERE `idConsultation` = '$idConsultation'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                	$typeOrdonnance = $donnees['typeOrdonnance'];

	                            		switch ($typeOrdonnance) {
	                            			case '1':
	                            echo "<div class=\"container\">

                                      <div class=\"modal fade\"  id=\"pop\" role=\"dialog\">
                                        <div class=\"modal-dialog\">                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Ordonnances de la dernière consultation</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"height: 750px; overflow-y: auto;\">";

                                            echo "<img src='impression/ord/entete/".$nomCabinet.".png' style='width:550px; height: 180px;' />

		                                                <div>
		                                                    <center>
		                                                        <h1>Ordonnance</h1>
		                                                    </center>
		                                                    
		                                                </div> 

		                                                <br><br><br><br>";
		                                                        
		                                                        medicamentDernièreConsultationPopupOrd($nomCabinet, $idConsultation);

                                            echo "</div>
                                          </div>                                                                     

                                          
                                        </div>
                                      </div>
                                      
                                    </div>";

	                            				break;


	                            			case '2':
	                            	echo "<div class=\"container\">

                                      <div class=\"modal fade\"  id=\"pop\" role=\"dialog\">
                                        <div class=\"modal-dialog\">                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Ordonnances de la dernière consultation</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"height: 750px; overflow-y: auto;\">";		
	                            					echo "<img src='impression/ord/entete/".$nomCabinet.".png' style='width:550px; height: 180px;' />

		                                                <div>
		                                                    <center>
		                                                        <h1>Ordonnance</h1>
		                                                    </center>
		                                                    
		                                                </div> 

		                                                <br><br><br><br>";
		                                                        
		                                                        medicamentDernièreConsultationPopupOrd($nomCabinet, $idConsultation);
		                                                echo "</div>
                                          </div>                                                                     

                                          
                                        </div>
                                      </div>
                                      
                                    </div>";        
	                            				break;


	                            			case '3':
	                            	echo "<div class=\"container\">

                                      <div class=\"modal fade\" id=\"pop\" role=\"dialog\">
                                        <div class=\"modal-dialog\">                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Ordonnances de la dernière consultation</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"height: 750px; overflow-y: auto;\">";		
	                            					echo "<img src='impression/ord/entete/".$nomCabinet.".png' style='width:550px; height: 180px;' />

		                                                <div>
		                                                    <center>
		                                                        <h1>Ordonnance</h1>
		                                                    </center>
		                                                    
		                                                </div> 

		                                                <br><br><br><br>";
		                                                        
		                                                        medicamentDernièreConsultationPopupOrd($nomCabinet, $idConsultation);
		                                            echo "</div>
                                          </div>                                                                     

                                          
                                        </div>
                                      </div>
                                      
                                    </div>";            
		                                                        
	                            				break;			
	                            		}

		                    echo "<hr>";        
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
        }

function medicamentDernièreConsultationPopupOrd($nomCabinet,$idConsultation){

	$nomCabinet     = str_replace("'","\'",$nomCabinet);
	//$nomCabinet 	= crypterNomDeLaBase($nomCabinet);
		global $host_name;
		global $db_user_name;
		global $db_password;

	//$host_name = "localhost";
    $database = crypterNomDeLaBase($nomCabinet);
    //$db_user_name = "root";
    //$db_password = "";

        
    try
        {

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options);  

                  $reponse = $bdd->query("SELECT nomMedicament,dosage,frequence FROM medicament,relationmediccons,consultations  WHERE medicament.idMedicament = relationmediccons.idMedicament AND relationmediccons.idConsultation = consultations.idConsultation AND consultations.idConsultation = '$idConsultation';");
                  
                  while ($donneesM = $reponse->fetch())
                        {
                    echo "<div style=\"display: flex; flex-wrap: nowrap; justify-content: space-between;\">

		                            <div style=\"margin-left: 50px\">";

											echo $donneesM['nomMedicament'];
									            echo "<br>
									            	  <br>
                    		        </div>
									
									<div>";

		                                    echo $donneesM['dosage'];                       
		                                        echo "<br>
		                                              <br>        
		                            </div>

		                            <div style=\"margin-right: 30px;\">";

		                                    echo $donneesM['frequence']; 

		                                        echo "<br>
		                                              <br>
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

function historiqueCons($idConsultation,$idCabinet,$dateHeureHistoCons){

	//$host_name = "localhost";
	//$database = "baseglobal";
	//$db_user_name = "root";
	//$db_password = "";
	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;

	$database = $baseGlobale;


			try
                {                                                    
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
					$reponse = $bdd->query("INSERT INTO `historiquecons`(`idConsultation`, `idCabinet`, `dateHeureHistoCons`) VALUES ('$idConsultation','$idCabinet','$dateHeureHistoCons')");
                    $reponse->closeCursor();                                                  
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
           
		}

function phenomeneCouleurExamenAttendu($nomCabinet, $idPatient){

    //$host_name = "";
    $database = crypterNomDeLaBase($nomCabinet);
    //$db_user_name = "root";
    //$db_password = "";
    	global $host_name;
		global $db_user_name;
		global $db_password;

            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT typeExamen,resultExam FROM relationexamcons,consultations WHERE relationexamcons.idConsultation = consultations.idConsultation AND consultations.idPatient = '$idPatient'");
                            
                            $nbrExamenNonFais = 0;                      
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                  //$nbrExamenNonFais = 0;

                                  if ($donnees['resultExam'] == "") {

                                    $nbrExamenNonFais = $nbrExamenNonFais + 1;

                                  }      
                                }                              

                                if ($nbrExamenNonFais == "0") {

                                  echo "<div class=\"alert alert-success\">";
                                      echo "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
                                      echo "<span class=\"entypo-thumbs-up\"></span>";
                                      echo "<strong>Examens fais!</strong>&nbsp;&nbsp;Ce patient à fait tout ses examens.";
                                  echo "</div>";
                                  
                                }else{

                                  echo "<div class=\"alert alert-danger\">";
                                      echo "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
                                      echo "<span class=\"entypo-attention\"></span>";
                                      echo "<strong>Examens non fais!</strong>&nbsp;&nbsp;Nombre d'examens non faits: ".$nbrExamenNonFais."<a href=\"examenNonFait.php?idP=$idPatient\">&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"entypo-eye\"></span></a>";
                                  echo "</div>";

                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
        }

function afficherLesExmensVide($nomCabinet, $idCons){

    //$host_name = "";
    $database = crypterNomDeLaBase($nomCabinet);
    //$db_user_name = "root";
    //$db_password = "";
    	global $host_name;
		global $db_user_name;
		global $db_password;

            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT typeExamen FROM relationexamcons,consultations WHERE relationexamcons.idConsultation = consultations.idConsultation AND consultations.idConsultation = '$idCons' AND `resultExam` IS NULL");

                            
                            $nbrExamenNonFais = 0;                      
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                  echo "<li>
                                  		   <h5>
                                            Examen : &nbsp;&nbsp; <b> $donnees[typeExamen]</b>
                                           </h5>
                                        </li><br>"; 

                                }                              

                                
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
        }  

function dossierPationDeToutLesCabinets($idPatient, $optionFiltre){

		/*$host_name = "localhost";
		$database = "baseglobal";
		$db_user_name = "root";
		$db_password = "";*/
		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;

		$database = $baseGlobale;
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                       
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT nomcabinet FROM cabinet,relpatcab WHERE cabinet.idCabinet = relpatcab.idCabinet AND relpatcab.idPatient = '$idPatient'");
                                 
                            // On affiche le resultat
                                while ($donnees = $reponse->fetch())
                                     {

                                        $nomCabinet = $donnees['nomcabinet'];

                                        echo "<br><br>";	
                                        echo "<div class=\"alert alert-info\">";
				                             echo "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
				                             echo "<span class=\"entypo-info-circled\"></span>";
				                             echo "<strong>&nbsp;Consultations et examens du patient au cabinet: ".$nomCabinet."</strong>.";
				                        echo "</div>";

                                        dossierPationDeMonCabinet($idPatient, $nomCabinet, $optionFiltre);

                                      }
                                 
                           	$reponse->closeCursor();
                   
                          		}
                        	catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
			}    		  

function dossierPationDeMonCabinet($identifiant, $nomCabinet, $optionFiltre){

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($nomCabinet);
		//$db_user_name = "root";
		//$db_password = "";
		global $host_name;
		global $db_user_name;
		global $db_password;

     
            try
                {
                                                                                        
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                          
                                                                
                                                                // On recupere tout le contenu de la table news
                    $reponse = $bdd->query("SELECT * FROM consultations WHERE consultations.idPatient = '$identifiant' ORDER BY consultations.heureConsultation DESC");

                    $nbrExamns = $reponse->rowCount();

                    if ($nbrExamns > 0) {

                    	echo "
                    	<div class=\"body-nest\" id=\"tableStatic\">
                    	<section id=\"flip-scroll\">

                                    <table class=\"table table-bordered table-striped cf\">
                                        <thead class=\"cf\">
                                            <tr>
                                                <th>Date et Heure Consultation</th>
                                                <th>Conclusion consultation</th>
                                                <th>Détails consultation</th>
                                                <th>Ordonnance consultation</th> 
                                            </tr>
                                        </thead>
                                        <tbody>";

                            
                          	
                        $i = 1;

	                    while ($donnees = $reponse->fetch())
	                        {


	                        $idMedecin          = $donnees['idMedecin'];
	                        $conclusion         = $donnees['conclusion'];
	                        $idConsultation     = $donnees['idConsultation'];
	                        $heureConsultation  = $donnees['heureConsultation'];
	                        $idConsultationPop  = $idConsultation . "pop";

	                        echo "<tr>";

                                echo "<td>$heureConsultation  </td>";
                                echo "<td>$conclusion</td>";
                                echo "<td><button name=\"afficherDossierP\" type=\"button\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#".$idConsultation ."\"><span class=\"entypo-eye\"></span>&nbsp;&nbsp;Visualiser Consultation</button></td>";
                                      
                                echo "<td><button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#pop\"><span class=\"entypo-eye\"></span>&nbsp;&nbsp;Ordonnance</button></td>";

                                            

                            echo "</tr>";                     



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

	                                              <textarea type=\"text\" name=\"conclusion\"  style=\"height: 100px;\" required>$conclusion</textarea>
	                                                                   
	                          
	                                            </div>
	                                            
	                                              <ul id=\"breadcrumb\">
	                                                  
	                                                  ";
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

                        	echo   		"</tbody>
                                    </table>
                                </section>
                              </div>";

                   }

	                    
                   }
                   catch(Exception $e)
                       {
                           die('Erreur : '.$e->getMessage());
                       }
    } 

function existanceMédecin($idMedecin){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT COUNT(idMedecin) FROM `relationmedcab` WHERE `idMedCab` = '$idMedecin'");

                          while ($donnees = $reponse->fetch())
                                     {
                                        $nbr = $donnees['0'];

                                      }

                                      return $nbr;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        } 

function getAllComptes($idMedecin){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT COUNT(idMedecin) FROM `relationmedcab` WHERE `idMedCab` = '$idMedecin'");

                          while ($donnees = $reponse->fetch())
                                     {
                                        $nbr = $donnees['0'];

                                      }

                                      return $nbr;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        } 

function getPatientCompte($idUser){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM `patient` WHERE `idPatient` = '$idUser'");

                          while ($donnees = $reponse->fetch())
                                     {
                                        echo"<tr>
                                                <td class=\"armada-devider\">
                                                    <div class=\"armada\">
                                                        <span style=\"background:#FF6B6B\">
                                                            <span class=\"maki-aboveground-rail\"></span>&nbsp;&nbsp;Compte Patient</span>
                                                        <p>
                                                            <span class=\"entypo-gauge\"></span>&nbsp;$donnees[idPatient]
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class=\"driver-devider\">
                                                    ";
                                                	if ($donnees['sexePatient'] == "Homme") {
                                                		echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                                	}
                                                	elseif ($donnees['sexePatient'] == "Femme") {
                                                		echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
                                                	}

                                              echo "
                                                    <h3>". $donnees['nomPatient'] . " " . $donnees['prenomPatient'] ."</h3>
                                                    <br>
                                                    <p>$donnees[numTelPatient]</p>
                                                </td>
                                                <td class=\"progress-devider\">

                                                    <p>$donnees[emailPatient] </p>
                                                    <p>$donnees[adressePatient] </p>

                                                    <span class=\"label pull-left\">$donnees[sexePatient] / $donnees[groupagePatient]</span>
                                                    <span class=\"label pull-right\">$donnees[numTelPatient]</span>
                    
                                                </td>
                                            </tr>";

                                      }
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }

function getMedecinCompte($idUser){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM `medecin` WHERE `idMedecin` = '$idUser'");

                          while ($donnees = $reponse->fetch())
                                     {
                                        echo"<tr>
                                                <td class=\"armada-devider\">
                                                    <div class=\"armada\">
                                                        <span style=\"background:#65C3DF\">
                                                            <span class=\"maki-aboveground-rail\"></span>&nbsp;&nbsp;Compte Médecin</span>
                                                        <p>
                                                            <span class=\"entypo-gauge\"></span>&nbsp;$donnees[idMedecin]
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class=\"driver-devider\">

                                                ";
                                                	if ($donnees['sexeMedecin'] == "Homme") {
                                                		echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                                	}
                                                	elseif ($donnees['sexeMedecin'] == "Femme") {
                                                		echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
                                                	}

                                              echo "<h3>". $donnees['nomMedecin'] . " " . $donnees['prenomMedecin'] ."</h3>
                                                    <br>
                                                    <p>$donnees[numTelMedecin]</p>
                                                </td>
                                                <td class=\"progress-devider\">

                                                    <p>$donnees[emailMedecin] </p>
                                                    <p>$donnees[adresseMedecin] </p>

                                                    <span class=\"label pull-left\">$donnees[sexeMedecin] / $donnees[groupageMedecin]</span>
                                                    <span class=\"label pull-right\">$donnees[numTelMedecin]</span>
                    
                                                </td>
                                            </tr>";

                                      }
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }

function getInfermierCompte($idUser){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM `infermier` WHERE `idInfermier` = '$idUser'");

                          while ($donnees = $reponse->fetch())
                                     {
                                        echo"<tr>
                                                <td class=\"armada-devider\">
                                                    <div class=\"armada\">
                                                        <span style=\"background:#45B6B0\">
                                                            <span class=\"maki-aboveground-rail\"></span>&nbsp;&nbsp;Compte Infermier</span>
                                                        <p>
                                                            <span class=\"entypo-gauge\"></span>&nbsp;$donnees[idInfermier]
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class=\"driver-devider\">
                                                    ";
                                                	if ($donnees['sexeInfermier'] == "Homme") {
                                                		echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                                	}
                                                	elseif ($donnees['sexeInfermier'] == "Femme") {
                                                		echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
                                                	}

                                              echo "
                                                    <h3>". $donnees['nomInfermier'] . " " . $donnees['prenomInfermier'] ."</h3>
                                                    <br>
                                                    <p>$donnees[numTelInfermier]</p>
                                                </td>
                                                <td class=\"progress-devider\">

                                                    <p>$donnees[emailInfermier] </p>
                                                    <p>$donnees[adresseInfermier] </p>

                                                    <span class=\"label pull-left\">$donnees[sexeInfermier] / $donnees[groupageInfermier]</span>
                                                    <span class=\"label pull-right\">$donnees[numTelInfermier]</span>
                    
                                                </td>
                                            </tr>";

                                      }
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }                                            

function verifierSilEstDejaInfermier($idUser,$typeCompte){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM `users` WHERE `identifiant` = '$idUser' AND typeCompte = '3'");

                          $etat = $reponse->rowCount();

                          if ($etat > 0) {
                          	echo "Vous êtes déjà Infermier";
                          	echo "<br>";
                          	echo $etat;
                          }else{
                          	echo "	<h1>Profile Infermier</h1>

                                    <br><br>

                                    <p> Vous êtes entraine de créer un nouveau profil \"Infermier\"</p>

                                    <br>Merci de saisir votre mot de passe pour confirmer<br>

                                    <a href=\"fonctionnalites/ajout/profileInfermier.php?idUser=$idUser&typeCompte=$typeCompte\">Cliquez Ici Pour Devenir Infermier</a>

                                    ";


                          }
                          $reponse->closeCursor(); 
                        
                        
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }

function verifierSilEstDejaPatient($idUser,$typeCompte){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM `users` WHERE `identifiant` = '$idUser' AND typeCompte = '1'");

                          $etat = $reponse->rowCount();

                          if ($etat > 0) {
                          	echo "Vous êtes déjà Patient";
                          	echo "<br>";
                          	echo $etat;
                          }else{
                          	echo "	<h1>Profile Patient</h1>

                                    <br><br>

                                    <p> Vous êtes entraine de créer un nouveau profil \"Patient\"</p>

                                    <br>Merci de saisir votre mot de passe pour confirmer<br>

                                    <a href=\"fonctionnalites/ajout/profilePatient.php?idUser=$idUser&typeCompte=$typeCompte\">Cliquez Ici Pour Devenir Patient</a>

                                    ";


                          }
                          $reponse->closeCursor(); 
                        
                        
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }

function verifierSilEstDejaMedecin($idUser,$typeCompte){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM `users` WHERE `identifiant` = '$idUser' AND typeCompte = '2'");

                          $etat = $reponse->rowCount();

                          if ($etat > 0) {
                          	echo "Vous êtes déjà Medecin";
                          	echo "<br>";
                          	echo $etat;
                          }else{
                          	echo "	<h1>Profile Medecin</h1>

                                    <br><br>

                                    <p> Vous êtes entraine de créer un nouveau profil \"Medecin\"</p>

                                    <br>Merci de saisir votre mot de passe pour confirmer<br>

                                    <a href=\"fonctionnalites/ajout/profileMedecin.php?idUser=$idUser&typeCompte=$typeCompte\">Cliquez Ici Pour Devenir Médecin</a>

                                    ";


                          }
                          $reponse->closeCursor(); 
                        
                        
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }                 

function InsertNewUser($login, $password, $typeCompte, $identifiant){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("INSERT INTO `users`(`login`, `password`, `typeCompte`, `identifiant`) VALUES ('$login', '$password', '$typeCompte', '$identifiant')");
                          $reponse->closeCursor(); 
                        
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        } 

function InsertNewProfilePatient($idPatient, $nomPatient, $prenomPatient, $dateNaissPatient, $lieuNaissPatient, $adressePatient, $emailPatient, $numTelPatient, $sexePatient, $groupagePatient){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("INSERT INTO `patient`(`idPatient`, `nomPatient`, `prenomPatient`, `dateNaissPatient`, `lieuNaissPatient`, `adressePatient`, `emailPatient`, `numTelPatient`, `sexePatient`, `groupagePatient`) VALUES ('$idPatient', '$nomPatient', '$prenomPatient', '$dateNaissPatient', '$lieuNaissPatient', '$adressePatient', '$emailPatient', '$numTelPatient', '$sexePatient', '$groupagePatient')");
                          
                          $reponse->closeCursor();                  
                        
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }

function InsertNewProfileMedecin($idMedecin, $nomMedecin, $prenomMedecin, $dateNaissMedecin, $lieuNaissMedecin, $adresseMedecin, $emailMedecin, $numTelMedecin, $sexeMedecin, $groupageMedecin){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("INSERT INTO `medecin`(`idMedecin`, `nomMedecin`, `prenomMedecin`, `dateNaissMedecin`, `lieuNaissMedecin`, `adresseMedecin`, `emailMedecin`, `numTelMedecin`, `sexeMedecin`, `groupageMedecin`) VALUES ('$idMedecin', '$nomMedecin', '$prenomMedecin', '$dateNaissMedecin', '$lieuNaissMedecin', '$adresseMedecin', '$emailMedecin', '$numTelMedecin', '$sexeMedecin', '$groupageMedecin')");
                          
                          $reponse->closeCursor();                  
                        
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        } 

function InsertNewProfileInfermier($idInfermier, $nomInfermier, $prenomInfermier, $dateNaissInfermier, $lieuNaissInfermier, $adresseInfermier, $emailInfermier, $numTelInfermier, $sexeInfermier, $groupageInfermier){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("INSERT INTO `infermier`(`idInfermier`, `nomInfermier`, `prenomInfermier`, `dateNaissInfermier`, `lieuNaissInfermier`, `adresseInfermier`, `emailInfermier`, `numTelInfermier`, `sexeInfermier`, `groupageInfermier`) VALUES ('$idInfermier', '$nomInfermier', '$prenomInfermier', '$dateNaissInfermier', '$lieuNaissInfermier', '$adresseInfermier', '$emailInfermier', '$numTelInfermier', '$sexeInfermier', '$groupageInfermier')");
                          
                          $reponse->closeCursor();                  
                        
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        } 

function verifSiPatDejaDsCabinet($idPatient,$idCabinet){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                         $reponse = $bdd->query("SELECT `idrelpatcab` FROM `relpatcab`,`patient` WHERE relpatcab.idCabinet = '$idCabinet' AND patient.idPatient = relpatcab.idPatient AND relpatcab.idPatient = '$idPatient'");

                          $exist = $reponse->rowCount();

                          if ($exist == 0) {

                          	inscriNewRelationPatientCabinet($idPatient, $idCabinet);
                          }

                          $reponse->closeCursor(); 
                        
                        
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        } 

function inscriNewRelationPatientCabinet($idPatient, $idCabinet){

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;

						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);                      
                            
							$reponse = $bdd->query("INSERT into `relpatcab` ( `idPatient`, `idCabinet`) VALUES ('$idPatient', '$idCabinet')");
                            $reponse->closeCursor();                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
	}                

function verifSiIdPatientCorrect($idPatient){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                         $reponse = $bdd->query("SELECT `idPatient` FROM `patient` WHERE idPatient = '$idPatient'");

                          $exist = $reponse->rowCount();

                          if ($exist == 0) {
                          	
                          	echo "<div class=\"alert alert-danger\">";
                                      echo "<button data-dismiss=\"alert\" class=\"close\" type=\"button\">×</button>";
                                      echo "<span class=\"entypo-attention\"></span>";
                                      echo "<strong>Faux Identifiant!</strong>&nbsp;&nbsp;Merci d'essayer de saisir l'identifiant du patient à nouveau.\">&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"entypo-eye\"></span></a>";
                            echo "</div>";
                          }else{
                          	
                          }

                          $reponse->closeCursor(); 
                        
                        
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }
?> 



