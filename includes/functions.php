<?php

	$host_name    = 'localhost';
    $db_user_name = 'root';
    $db_password  = '';
    $baseGlobale  = 'virtuhos_kine';


    $con = mysqli_connect("localhost","root","","virtuhos_kine");

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
                foreach ($sqlScript as $line)   {
                    
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
                
                //***************************************************************  return  $nomCabinet; au lieu de return $database; ****************   
               return 'virtuhos_kine';  

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

	//$con = mysqli_connect("localhost", "root", "", "virtuhos_kine");
	global $con;

								// Check connection
								if (mysqli_connect_errno())
								  {
								  echo "Failed to connect to MySQL: " . mysqli_connect_error();
								  }

								$reqModificationPatient="SELECT * FROM patient WHERE idPatient ='$sujet'";

								if ($result=mysqli_query($con,$reqModificationPatient))
								  {
								  // Return the number of rows in result set
								  $rowcount=mysqli_num_rows($result);

								  if ($rowcount==1) {

								  	if ($row = mysqli_fetch_array($result)) {

					                    
					                    $idFaiseur = "1";
					                    $nomPatient = $row['nomPatient'];
					                    $prenomPatient = $row['prenomPatient'];
					                    $dNPatient = $row['dateNaissPatient'];
					                    $lieuNPatient = $row['lieuNaissPatient'];
					                    $adressePatient = $row['adressePatient'];
					                    $emailPatient = $row['emailPatient'];
					                    $numTelPatient = $row['numTelPatient'];
					                    $sexePatient = $row['sexePatient'];
					                    $groupagePatient = $row['groupagePatient'];

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


								//$con = mysqli_connect("localhost", "root", "", "virtuhos_kine");
								global $con;

								global $host_name;
								global $baseGlobale;
								global $db_user_name;
								global $db_password;

					                    try
                                            {
                                                                                
                                             $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                             $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password,$pdo_options);                      
                                                        
                                                        // On recupere tout le contenu de la table news
                                             $reponse = $bdd->query("SELECT nomPatient,prenomPatient FROM patient WHERE idPatient ='$sujet'");
                                                                              
                                                $nomPatient ="";
                                                $prenomPatient ="";

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



	function affichageDeToutLesExamens($nomBD,$idMedecin,$idCabinet){

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

                                        echo "<td>";
                                        echo "<button type=\"button\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#".$donnees['idExamen'] ."\"><span class=\"entypo-trash\"></span>&nbsp;&nbsp;Supp</button>";
                                        echo "</td>";

                                echo "</tr>";

                                

                               echo "<div class=\"container\">
		                                    <div class=\"modal fade\"  id=\"".$donnees['idExamen'] ."\" role=\"dialog\">
		                                        <div class=\"modal-dialog\">                                        

			                                            <div class=\"modal-content\"> 
				                                            <div class=\"modal-header\">
				                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
				                                              <h4 class=\"modal-title\">Suppression Examen:&nbsp;&nbsp;" . $donnees['typeExamen'] . "</h4>
				                                            </div>
				                                            <div class=\"modal-body\" style=\"height: 200px; overflow-y: auto;\">

					                                            <div>
							                                        <center>
							                                            <h1>êtes-vous sûr de vouloir supprimer cet examen ?</h1>

							                                            <br>
							                                         
								                                        <a href=\"fonctionnalites/supp/suppExam.php?idExamen=$donnees[idExamen]&bdd=$database&idCabinet=$idCabinet&faiseur=$idMedecin\">
									                                        <button type=\"button\" class=\"btn btn-info\">
												                                        <span class=\"entypo-trash\"></span>&nbsp;&nbsp;Confirmer 
												                            </button>
											                            </a>
											                            <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">
											                                        <span class=\"entypo-cancel-squared\"></span>&nbsp;&nbsp;Annuler 
											                            </button> 

										                            </center>      
							                                    </div>
							                                </div>                         
			                                            </div> 
		                                        </div>
		                                    </div>    
		                        	</div>";

                                }
                           $reponse->closeCursor();
                          }
                          //
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}
	function choisirExamen($idCabinet){

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
                            
                            // On recupere tout le contenu de la table
                            $reponse = $bdd->query("SELECT  typeExamen
													FROM    all_examens e
													WHERE   NOT EXISTS
													        (
													        SELECT  null 
													        FROM    relcabexamens d
													        WHERE   d.idCabinet='$idCabinet' AND d.idExamen = e.idExamen
													        ) ");     
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

function ajoutRelationCabSpecialite($idCabinet,$idExamen){

	//$nomBD 	    = crypterNomDeLaBase($nomBD);
	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;


		$idCabinet      = str_replace("'","\'",$idCabinet);
        $idExamen       = str_replace("'","\'",$idExamen);

                        try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("INSERT INTO relcabexamens(`idCabinet`, `idExamen`) VALUES ('$idCabinet','$idExamen')");

                            $reponse->closeCursor();
                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
                        } 


function ajoutExamenDansBDDLocal($nomBD,$idExamen,$type,$obj,$principe,$dossier,$precau){

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
                            $reponse = $bdd->query("INSERT INTO examens(idExamen, typeExamen, objectif, principe, dossierApporter, precautions) VALUES ('$idExamen','$type','$obj','$principe','$dossier','$precau')");

                            $reponse->closeCursor();
                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
                        } 
				
function ajoutExamenNewDansBDDLocal($nomBD,$type,$obj,$principe,$dossier,$precau){

	global $host_name;
	global $db_user_name;
	global $db_password;

		$database = crypterNomDeLaBase($nomBD);


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

                            $idExamen = $bdd->lastInsertId();
                            insertionPrixNouveauExamen($nomBD,$idExamen);

                            $reponse->closeCursor();
                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
                        }				

function insertionPrixNouveauExamen($nomBD,$idExamen){

	//$nomBD 	    = crypterNomDeLaBase($nomBD);
	global $host_name;
	global $db_user_name;
	global $db_password;

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($nomBD);
		//$db_user_name = "root";
		//$db_password = "";

		$idExamen        = str_replace("'","\'",$idExamen);


                        try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("INSERT INTO `prix`(`idExamen`, `prixExamen`) VALUES ('$idExamen','1000')");

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
                            $reponse = $bdd->query("SELECT COUNT(idRapport) AS reponseRapport FROM rapporttechnique WHERE idCabinet='$idCabinet' AND idExpediteur ='$idMedecin' AND vue <>'1' ");
                                 
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
                            $reponse = $bdd->query("SELECT COUNT(idExamen) AS typeExamen FROM relcabexamens ");
                                 
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
                                                    
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

                            
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

		                          $reponse = $bdd->query("SELECT dateRDV FROM rdv ");

									$nbrRDVàVenir = 0;

		                      while ($donnees = $reponse->fetch())
		                         {
		                              $dateRDV  	= $donnees['dateRDV'];
		                              $dateRDV 		= strtotime($dateRDV);
								  	  $dateRDV 		= date('d/m/Y',$dateRDV);
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

                                                     
                          $date = "'" .date('Y-m-d')."'";
                          $reponse = $bdd->query("SELECT COUNT(id) FROM `rdv` WHERE dateRDV = $date AND statut <> 4");
                                                  
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

function nbrRDVDuJourEnPresent($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                          $date = "'" .date('Y-m-d')."'";
                          $reponse = $bdd->query("SELECT COUNT(id) FROM `rdv` WHERE dateRDV = $date AND statut = 1");
                                                  
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

function nbrRDVDuJourEnSalle($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                          $date = "'" .date('Y-m-d')."'";
                          $reponse = $bdd->query("SELECT COUNT(id) FROM `rdv` WHERE dateRDV = $date AND statut = 2");
                                                  
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

function nbrRDVDuJourAbsent($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                          $date = "'" .date('Y-m-d')."'";
                          $reponse = $bdd->query("SELECT COUNT(id) FROM `rdv` WHERE dateRDV = $date AND statut = 0");
                                                  
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

function nbrRDVDuJourTermine($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                          $date = "'" .date('Y-m-d')."'";
                          $reponse = $bdd->query("SELECT COUNT(id) FROM `rdv` WHERE dateRDV = $date AND statut = 3");
                                                  
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
                            echo "<tr>";

                              echo "<td> " . $donnees['nomP'] ." ". $donnees['prenoP'] . "</td>";
			                  echo "<td> $donnees[dateRDV] </td>";


			                  echo "<td data-value> $donnees[idPatient] </td>";
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

		                          $reponse = $bdd->query("SELECT * FROM rdv WHERE statut <= 2 order by dateRDV desc");
		                          							//Après, pour optimiser la requete, je met: WHERE statue < 'consultation close'

		                      while ($donnees = $reponse->fetch())
		                         {
		                              $dateRDV  	= $donnees['dateRDV'];
		                              $drdv 		= explode("/", $dateRDV);
		                              $dRDV 		= $drdv[2].$drdv[1].$drdv[0];

		                              if ($dRDV >= $dJour) {
										echo "</tr>";

			                              echo "<td> " . $donnees['nomP'] ." ". $donnees['prenoP'] . "</td>";
			                              echo "<td> $donnees[dateRDV] </td>";


			                              echo "<td data-value> $donnees[idPatient] </td>";
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
                          $reponse = $bdd->query("SELECT * FROM rdv WHERE statut <= 3 AND dateRDV = $date order by dateRDV desc, heureRDV asc");
                                                  
                      while ($donnees = $reponse->fetch())
                         {
	                        echo "<tr>";

	                            echo "<td> " . $donnees['nomP'] ." ". $donnees['prenoP'] . "</td>";
	                            echo "<td> $donnees[dateRDV] </td>";

	                            echo "<td data-value> $donnees[idPatient] </td>";
	                            echo "<td data-value> $donnees[tel] </td>";
	                            echo "<td data-value> $donnees[medecin] </td>";       

	                            echo "<td data-value=\"1\"> <span class=\"status-metro status-active\" title=\"Active\"> $donnees[heureRDV] </span></td>";

	                            echo  "<td data-value>
	                            			<a href=\"fonctionnalites/mod/passerRDV.php?id=".$donnees['id']."&nomCabinet=".$nomBD."&idPat=".$donnees['idPatient']."\"> 
	                            				<button type=\"submit\" class=\"btn btn-info\">
	                            				<span class=\"entypo-forward\">&nbsp;&nbsp;&nbsp;Passer&nbsp;&nbsp;</button> 
	                            			</a>
	                            		</td>";

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

function getMotifCons($nomCabinet, $idRDV){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$database  = crypterNomDeLaBase($nomCabinet);
		
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT motifCons FROM rdv WHERE id='$idRDV'");
                  
                  while ($donnee = $reponse->fetch())
                        {

                        	$motiCons = $donnee['motifCons'];

 
                        }
                    return $motiCons;    
                                      
                  $reponse->closeCursor();
	}


function getDocsName($idCabinet){

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT medecin.idMedecin,medecin.nomMedecin FROM medecin,relationmedcab WHERE medecin.idMedecin = relationmedcab.idMedecin AND relationmedcab.idCabinet = '$idCabinet'");
                  
                  while ($donneesM = $reponse->fetch())
                        {

                            echo "<option value=\"$donneesM[idMedecin]\">

                        			$donneesM[nomMedecin]";

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

function insertionRDV($Cabinet,$name,$prenom,$mail,$phone,$datRDV,$heureRDV,$motif,$idDoc,$idPat,$type,$signal,$motifSignal,$typeSeance = "simple"){


		$database = crypterNomDeLaBase($Cabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;

		$name    	= str_replace("'","\'",$name);
		$prenom    	= str_replace("'","\'",$prenom);
		$mail    	= str_replace("'","\'",$mail);
		$phone    	= str_replace("'","\'",$phone);
		$idDoc    	= str_replace("'","\'",$idDoc);
		$idPat    	= str_replace("'","\'",$idPat);
		$type    	= str_replace("'","\'",$type);
		$motif    	= str_replace("'","\'",$motif);
		$motifSignal= str_replace("'","\'",$motifSignal);
		$typeSeance = normaliserTypeSeance($typeSeance);

		$doc 		= getMedecinName($idDoc);

						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
							$reponse = $bdd->query("INSERT INTO rdv (nomP,prenoP,mail,tel,dateRDV,heureRDV,medecin,motifCons,idMedecin,idPatient,type,type_seance,patient_a_risque,motif_risque) VALUES ('$name','$prenom','$mail','$phone','$datRDV','$heureRDV','$doc','$motif','$idDoc','$idPat','$type','$typeSeance','$signal','$motifSignal')");
							$id_rdv = $bdd->lastInsertId();

							return $id_rdv;
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

                  $reponse = $bdd->query("SELECT nomMedicament,typeMedicament,dosageMedicament FROM medicament");
                  
                  while ($donneesM = $reponse->fetch())
                        {

                        	echo "<option>";
									
									echo "$donneesM[nomMedicament]" . " (" ."$donneesM[typeMedicament]". " / " . "$donneesM[dosageMedicament]" . ")";

									echo "<input type=\"hidden\" name=\"doz[]\" />";

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


    	global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;

    $database = $baseGlobale;

    

    try
        {

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options);  

                  $reponse = $bdd->query("SELECT frequence FROM freqmedicament");
                  
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

function saveRelBilanDemCons($Cabinet, $idCons, $Bilan){

	$Cabinet      	= str_replace("'","\'",$Cabinet);
	//$Cabinet 	    = crypterNomDeLaBase($Cabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;

		//$host_name = "localhost";
		$database = crypterNomDeLaBase($Cabinet);
		//$db_user_name = "root";
		//$db_password = "";


						try
                            {                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
							$reponse = $bdd->query("INSERT INTO `relbilandemcons`(`idConsultation`, `typeExamen`) VALUES ('$idCons','$Bilan')");

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
                            
							$reponse = $bdd->query("INSERT INTO `medecin`(`idMedecin`, `nomMedecin`, `prenomMedecin`, `dateNaissMedecin`, `lieuNaissMedecin`, `adresseMedecin`, `emailMedecin`, `numTelMedecin`, `sexeMedecin`, `groupageMedecin`) VALUES ('$identifiant','$nom','$prenom','$dateNaiss','$lieuNaiss','$adress','$email','$tel','$Sexe','$groupeSanguin')");
                            $reponse->closeCursor();                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
	}

function inscriInf($identifiant, $nom,$prenom,$dateNaiss,$lieuNaiss,$adress,$email,$tel,$Sexe,$groupeSanguin){

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
                                                
                            $nvrDeLignes = $reponse->rowCount();                      
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                if ($nvrDeLignes == 0) {

                                		echo "<div class=\"container\">
		                                      <div class=\"modal fade\"  id=\"pop\" role=\"dialog\">
		                                        <div class=\"modal-dialog\">                                        

		                                          <div class=\"modal-content\">
		                                            <div class=\"modal-header\">
		                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
		                                              <h4 class=\"modal-title\">Ordonnances de consultation</h4>
		                                            </div>
		                                            <div class=\"modal-body\" style=\"height: 750px; overflow-y: auto;\">";

		                                            echo "<div>
				                                               <center>
				                                                    <h1>Pas d'ordonnance attribué à cette consultation</h1>
				                                                </center>       
				                                            </div>";                     
		                                            echo "</div>
		                                          </div>                                                                     

		                                          
		                                        </div>
		                                      </div>
		                                      
		                                    </div>";
                                		
                                	}else{
		                                	$typeOrdonnance = $donnees['typeOrdonnance'];

			                            		switch ($typeOrdonnance) {
			                            			case '1':
			                            echo "<div class=\"container\">

		                                      <div class=\"modal fade\"  id=\"pop\" role=\"dialog\">
		                                        <div class=\"modal-dialog\">                                        

		                                          <div class=\"modal-content\">
		                                            <div class=\"modal-header\">
		                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
		                                              <h4 class=\"modal-title\">Ordonnances de consultation</h4>
		                                            </div>
		                                            <div class=\"modal-body\" style=\"height: 750px; overflow-y: auto;\">";

		                                            echo "<img src='impression/ord/entete/virtuhos_kine.png' style='width:550px; height: 180px;' />

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
		                                              <h4 class=\"modal-title\">Ordonnances de consultation</h4>
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
		                                              <h4 class=\"modal-title\">Ordonnances de consultation</h4>
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

function afficherLExamen($nomCabinet, $idRelExamCons){

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
                            $reponse = $bdd->query("SELECT typeExamen,resultExam FROM relationexamcons WHERE idRelExamCons = '$idRelExamCons'");

                            
                            $nbrExamenNonFais = 0;                      
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                $result = $donnees['resultExam'];

	                                if ($result == "NULL" || $result =="") {
	                                	echo "<li>
	                                  		   <h5>
	                                            Examen : &nbsp;&nbsp;&nbsp; <b> $donnees[typeExamen]</b>
	                                           </h5>
	                                          </li>
	                                          <br>
	                                          <li>
	                                  		   <h5>	                                            
	                                            Résultat : &nbsp;&nbsp; <b> pas de résultat enregistrer pour l'instant</b>
	                                           </h5>
	                                          </li>
	                                        <br>";
	                                }

	                                else{
										echo "<li>
	                                  		   <h5>
	                                            Examen : &nbsp;&nbsp;&nbsp; <b> $donnees[typeExamen]</b>
	                                           </h5>
	                                          </li>
	                                          <br>
	                                          <li>
	                                  		   <h5>	                                            
	                                            Resultat : &nbsp;&nbsp; <b> $result</b>
	                                           </h5>
	                                          </li>
	                                    <br>";
	                                }
                                }                              

                                
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
        }          

function dossierPationDeToutLesCabinets($idPatient, $optionFiltre){

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
                                                <th width=\"11%\">Date et Heure Consultation</th>
                                                <th width=\"66%\">Conclusion consultation</th>
                                                <th width=\"9%\">Détails consultation</th>
                                                <th width=\"7%\">Ordonnance</th>
                                                <th width=\"7%\">Rapport Médical</th> 
                                                
                                            </tr>
                                        </thead>
                                        <tbody>";

                            
                          	
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
                                echo "<td><button type=\"button\" class=\"btn btn-warning\" onclick=\"sendIdConsPourDétails('$identifiant','virtuhos_kine','$idConsultation')\" data-toggle=\"modal\" data-target=\"#po\"><span class=\"entypo-eye\"></span>&nbsp;&nbsp;Visualiser Consultation</button></td>";
                                      
                                echo "<td><button type=\"button\" class=\"btn btn-info\" onclick=\"sendIdConsPourOrdon('$identifiant','virtuhos_kine','$idConsultation')\" data-toggle=\"modal\" data-target=\"#po\"><span class=\"entypo-eye\"></span>&nbsp;&nbsp; Ordonnances</button></td>";
                                echo "<td>
                                		<button type=\"button\" class=\"btn btn-primary\" onclick=\"getRapportMedical('$identifiant','$idConsultation')\" data-toggle=\"modal\" data-target=\"#po\">
                                			<span class=\"entypo-eye\"></span>&nbsp;&nbsp;Rapport
                                		</button>
                                	  </td>";

                            echo "</tr>";    

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


    function monDossierPourOrdonnance($identifiant, $nomCabinet){

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
                    $reponse = $bdd->query("SELECT * FROM consultations WHERE idPatient = '$identifiant' ORDER BY heureConsultation DESC");

                    $nbrLignes = $reponse->rowCount();

                    if ($nbrLignes > 0) {

                    	echo "
                    	<div class=\"body-nest\" id=\"tableStatic\">
                    	<section id=\"flip-scroll\">

                                    <table class=\"table table-bordered table-striped cf\">
                                        <thead class=\"cf\">
                                            <tr>
                                                <th>Date et Heure Consultation</th>
                                                <th>Ordonnance consultation</th> 
                                            </tr>
                                        </thead>
                                        <tbody>";

                            
                          	
	                    while ($donnees = $reponse->fetch())
	                        {


	                        $idMedecin          = $donnees['idMedecin'];
	                        $conclusion         = $donnees['conclusion'];
	                        $idConsultation     = $donnees['idConsultation'];
	                        $heureConsultation  = $donnees['heureConsultation'];
	                        $idConsultationPop  = $idConsultation . "pop";

	                        echo "<tr>";

                                echo "<td>$heureConsultation  </td>";
                                      
                                echo "<td><button type=\"button\" class=\"btn btn-default\" onclick=\"sendIdConsPourOrdon($identifiant,'$nomCabinet',$idConsultation)\" data-toggle=\"modal\" data-target=\"#po\"><span class=\"entypo-eye\"></span>&nbsp;&nbsp; Ordonnances</button></td>";    

                            echo "</tr>";    

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
                                                     
                          $reponse = $bdd->query("SELECT COUNT(idMedecin) FROM `relationmedcab` WHERE `idMedecin` = '$idMedecin'");

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

function getPatientName($idUser){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM `patient` WHERE `idPatient` = '$idUser'");

                          $nomPatient = "";

                          while ($donnees = $reponse->fetch())
                                     {
                                        $nomPatient = $donnees['nomPatient'];

                                      }

                                      return $nomPatient;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }

function getPatientFullName($idUser){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM `patient` WHERE `idPatient` = '$idUser'");

                          $nomPatient = "";

                          while ($donnees = $reponse->fetch())
                                     {
                                        $nomPatient = $donnees['nomPatient'];

                                        $prenomPatient = $donnees['prenomPatient'];

                                        $fullName = $nomPatient . " " . $prenomPatient;

                                      }

                                      return $fullName;
                        
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

function getMedecinName($idUser){

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
                                        $nomMedecin = $donnees['nomMedecin'];
                                    }
                                    return $nomMedecin;  
                        
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
                          	echo "Vous êtes déjà Infirmier";
                          	echo "<br>";
                          	echo $etat;
                          }else{
                          	echo "	<h1>Profile Infirmier</h1>

                                    <br><br>

                                    <p> Vous êtes entraine de créer un nouveau profil \"Infirmier\"</p>

                                    <br>Merci de saisir votre mot de passe pour confirmer<br>

                                    <a href=\"fonctionnalites/ajout/profileInfermier.php?idUser=$idUser&typeCompte=$typeCompte\">Cliquez Ici Pour Devenir Infirmier</a>

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

function infoPatientPremiereConsult($identifiant){

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

                                
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
        }

function getVirtuhosDocs(){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT idMedecin,nomMedecin,prenomMedecin,sexeMedecin FROM `medecin` LIMIT 10");

                          while ($donnees = $reponse->fetch())
                                     {

                                     	$idDoc = $donnees['idMedecin'];

                                    echo"<li id=\"cont\" style=\"padding:5px\" onclick=\"onContactClick('$idDoc')\">";
                                     		if ($donnees['sexeMedecin'] == "Homme") {
                                                		echo "<img style=\"margin-top:1px;\" class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                                	}
                                            elseif ($donnees['sexeMedecin'] == "Femme") {
                                                		echo "<img style=\"margin-top:1px;\" class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
                                                	}
	                                	echo"<h3>
	                                        	<span>Déconnecté</span>
	                                        </h3>
	                                        <h3>". $donnees['nomMedecin'] . " " . $donnees['prenomMedecin'] . "&nbsp;&nbsp;
	                                        </h3>
	                                        <input type=\"hidden\" name=\"idDoc\" value=\"$donnees[idMedecin]\">
	                                        <p><i>Dernière connexion</i> :&nbsp;<i class=\"fa fa-clock-o\"></i>&nbsp;&nbsp;20 Min</p>
	                                    </li>
	                                    <hr>";
                                      }
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        } 

function insertionMessage($idSender,$idReceiver,$message){

	//$nomBD 	    = crypterNomDeLaBase($nomBD);
	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;

	$ceMoment = date("Y-m-d H:i:s");

		$idSender   = str_replace("'","\'",$idSender);
		$idReceiver = str_replace("'","\'",$idReceiver);
		$message    = str_replace("'","\'",$message);

                        try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("INSERT INTO `messages`(`idExpediteur`, `idDestinataire`, `message`, `heureMessage`) VALUES ('$idSender','$idReceiver','$message','$ceMoment');");

                            $reponse->closeCursor();
                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
                        }

function getDocFromIdForChatHeader($identifiant){

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT * FROM medecin WHERE idMedecin = '$identifiant'");
                  
                  while ($donneesM = $reponse->fetch())
                        {
                            if ($donneesM['sexeMedecin'] == "Homme") {
                                echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                    }
                            elseif ($donneesM['sexeMedecin'] == "Femme") {
                                echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
                                    }
	                            echo"<h3>". $donneesM['nomMedecin'] . " " . $donneesM['prenomMedecin'] . "&nbsp;&nbsp;</h3>";
                        }
                  $reponse->closeCursor();
	}

function getPatientFromIdForChatHeader($identifiant){

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT * FROM patient WHERE idPatient = '$identifiant'");
                  
                  while ($donneesM = $reponse->fetch())
                        {
                            if ($donneesM['sexePatient'] == "Homme") {
                                echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                    }
                            elseif ($donneesM['sexePatient'] == "Femme") {
                                echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
                                    }
	                            echo"<h3>". $donneesM['nomPatient'] . " " . $donneesM['prenomPatient'] . "&nbsp;&nbsp;</h3>";
                        }
                  $reponse->closeCursor();
	}	 

function getPatientDemandes($idDoc){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT idPatient,nomPatient,prenomPatient,sexePatient FROM `patient`,`amis` WHERE amis.monID ='$idDoc' AND amis.demande =1 AND amis.amiID = patient.idPatient");

                          while ($donnees = $reponse->fetch())
                                     {

                                     	$idPat = $donnees['idPatient'];

                                    echo"<li id=\"cont\" style=\"padding:5px\" onclick=\"onPatientContactClick('$idPat')\">";
                                     		if ($donnees['sexePatient'] == "Homme") {
                                                		echo "<img style=\"margin-top:1px;\" class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                                	}
                                            elseif ($donnees['sexePatient'] == "Femme") {
                                                		echo "<img style=\"margin-top:1px;\" class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
                                                	}
	                                	echo"<h3>
	                                        	<span>Déconnecté</span>
	                                        </h3>
	                                        <h3>". $donnees['nomPatient'] . " " . $donnees['prenomPatient'] . "&nbsp;&nbsp;
	                                        </h3>
	                                        <input type=\"hidden\" name=\"idPat\" value=\"$donnees[idPatient]\">
	                                        <p><i>Dernière connexion</i> :&nbsp;<i class=\"fa fa-clock-o\"></i>&nbsp;&nbsp;20 Min</p>
	                                    </li>
	                                    <hr>";
                                      }
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        } 

function notifPatientDemandes($idDoc){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT idPatient,nomPatient,prenomPatient,sexePatient FROM `patient`,`amis` WHERE amis.monID ='$idDoc' AND amis.demande =0 AND amis.amiID = patient.idPatient");

                          echo "<li> <a href=\"#\">Demandes de chat </a></li>";

                          while ($donnees = $reponse->fetch())
                                     {

                                echo "<li id=\"$donnees[idPatient]\">";

		                            
		                            if ($donnees['sexePatient'] == "Homme") {
                                                		echo "<img style=\"margin-top:1px;\" class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                                	}
                                    elseif ($donnees['sexePatient'] == "Femme") {
                                                		echo "<img style=\"margin-top:1px; margin-left:1px\" class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
                                                	}
		                            echo"<i>". $donnees['nomPatient'] . " " . $donnees['prenomPatient'] . "</i><br> 
		                            	 <button onclick='gererPatientChatRequest(\"$idDoc\", \"$donnees[idPatient]\", \"ajout\")'>accepter</button>". "   " ."<button  onclick='gererPatientChatRequest(\"$idDoc\", \"$donnees[idPatient]\", \"suppression\")'>supprimer</button>";
		                            

	                            echo "</li>";

                                      }
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }         

function patMedDansCab($idCabinet){

		$nbrPat = verifExistancePatient($idCabinet);
		$nbrDoc = verifExistanceMedecin($idCabinet);

		if ($nbrPat == 1 && $nbrDoc == 1) {
			$existance = 1;
		}else{
			$existance = 0;
		}
		return $existance;
	}

function verifExistancePatient($idCabinet){

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT idPatient FROM relpatcab WHERE idCabinet = $idCabinet");

                  $exist = $reponse->rowCount();

                          if ($exist == 0) {
                          	$nbr = 0;
                          }else{
                          	$nbr = 1;
                          }
                          return $nbr;

                  $reponse->closeCursor();
	}

function verifExistanceMedecin($idCabinet){

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT idMedecin FROM relationmedcab WHERE idCabinet = $idCabinet");
                  
                  $exist = $reponse->rowCount();

                          if ($exist == 0) {
                          	$nbr = 0;
                          }else{
                          	$nbr = 1;
                          }
                          return $nbr;
                  $reponse->closeCursor();
	}	

function getDonneesProf($table, $champ, $id, $username, $nomtitle){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

  $nomB 	    = crypterNomDeLaBase($baseGlobale);

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM $table WHERE $champ = '$id'");

                          while ($donnees = $reponse->fetch())
                                     {

   echo "<div class=\"well profile\" style=\"padding-left: 1%\">
                            <div class=\"col-sm-12\">
                                <div class=\"col-xs-12 col-sm-4 text-center\">

                                    <ul class=\"list-group\">
                                        <li class=\"list-group-item text-left\">
                                            <span class=\"entypo-user\"></span>&nbsp;&nbsp;Profile</li>
                                        <li class=\"list-group-item text-center\">";
                                            if ($donnees[8] == "Homme") {
                                                		echo "<img class=\"img-circle img-responsive img-profile\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                                	}
                                            elseif ($donnees[8] == "Femme") {
                                                		echo "<img class=\"img-circle img-responsive img-profile\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
                                                	}
                                   echo"</li>

                                        <li class=\"list-group-item text-right\">
                                            <span class=\"pull-left\">
                                                <strong>User Name</strong>
                                            </span>".$username."
                                        </li>

                                        <li class=\"list-group-item text-right\">
                                            <span class=\"pull-left\">
                                                <strong>User Id</strong>
                                            </span>".$donnees[0]."
                                        </li>

                                    </ul>

                                </div>
                                <div class=\"col-xs-12 col-sm-8 profile-name\">
                                    <h2>".$nomtitle."".$donnees[1]." ".$donnees[2]."
                                        <span class=\"pull-right social-profile\">
                                            <i class=\"entypo-facebook-circled\"></i>  <i class=\"entypo-twitter-circled\"></i>  <i class=\"entypo-linkedin-circled\"></i>  <i class=\"entypo-github-circled\"></i>  <i class=\"entypo-gplus-circled\"></i>
                                        </span>
                                    </h2>
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
                                        <dd>".$donnees[8]."</dd>

                                        <dt>Groupage Sangin</dt>
                                        <dd>".$donnees[9]."</dd>

                                    </dl>

                                </div>

                            </div>";
		                            if ($table = 'medecin') {
		                            	
					                      echo "<div class=\"col-xs-12 divider text-center\">
					                                <div class=\"col-xs-12 col-sm-4 emphasis\">
					                                    <h2>
					                                        <strong>"; getNbrCabinetForDoc($id); echo "</strong>
					                                    </h2>
					                                    <p>
					                                        <small>Cabinets</small>
					                                    </p>
					                                    <button class=\"btn btn-success btn-block\" data-toggle=\"modal\" data-target=\"#cabinet\">
					                                        <span class=\"fa fa-plus-circle\"></span>&nbsp;&nbsp;Cabinets</button>
					                                </div>
					                                <div class=\"col-xs-12 col-sm-4 emphasis\">
					                                    <h2>
					                                        <strong>01</strong>
					                                    </h2>
					                                    <p>
					                                        <small>Spécialités</small>
					                                    </p>
					                                    <button class=\"btn btn-info btn-block\" data-toggle=\"modal\" data-target=\"#speciali\">
					                                        <span class=\"fa fa-user\"></span>&nbsp;&nbsp;View Spécialités</button>
					                                </div>
					                                <div class=\"col-sm-4 emphasis\">
					                                    <h2>
					                                        <strong>"; nbrPatientCabinet(); echo "</strong>
					                                    </h2>
					                                    <p>
					                                        <small>Patients</small>
					                                    </p>
					                                    <button class=\"btn btn-default btn-block\" data-toggle=\"modal\" data-target=\"#mespatients\">
					                                        <span class=\"fa fa-user\"></span>&nbsp;&nbsp;Patients</button>
					                                </div>
					                            </div>";                                       
					                       } 
					               echo "</div>";  
                                      }

                               echo "<div class=\"container\">

                                      <div class=\"modal fade\"  id=\"cabinet\" role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">x</button>
                                              <h4 class=\"modal-title\">Les Cabinets</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"height: 100%; overflow-y: auto;\">";
                                            getIDCabinetForDoc($id);

                                      echo "</div>
                                      	 </div>													                 
                                        </div>
                                      </div>
                                    </div>";

                               echo "<div class=\"container\">

                                      <div class=\"modal fade\"  id=\"speciali\" role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                        
                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">x</button>
                                              <h4 class=\"modal-title\">Mes Spécialités</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"height: 250px; overflow-y: auto;\">";
                                            echo "<dl class=\"dl-horizontal-profile\">
					                                        <dt>- Kinésithérapie</dt>
					                               </dl><br>
					                               <hr>";

                                     echo "</div>
                                    	 </div>													                 
                                        </div>
                                      </div> 
                                    </div>";


                               echo "<div class=\"container\">
                                      <div class=\"modal fade\"  id=\"mespatients\" role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">x</button>
                                              <h4 class=\"modal-title\">Mes Patients</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"height: 250px; overflow-y: auto;\">
                                            	Fonctionnalité indisponible pour l'instant
                                            </div>
                                          </div>  													                 
                                        </div>
                                      </div>
                                    </div>";
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }


    }

    function getNbrPatientForDoc($idMedecin){

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


function getNbrSpecialitesDoc($idMedecin){

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT idSpecialite FROM relmedspecialite WHERE idMedecin = $idMedecin");
                  
                  $nbr = $reponse->rowCount();

                    echo $nbr;
                  $reponse->closeCursor();
	}


function getNbrCabinetForDoc($idMedecin){

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT idCabinet FROM relationmedcab WHERE idMedecin = $idMedecin");
                  
                  $nbr = $reponse->rowCount();

                    echo $nbr;
                  $reponse->closeCursor();
	}

function getIDCabinetForDoc($idMedecin){

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT idCabinet FROM relationmedcab WHERE idMedecin = $idMedecin");
                  
                  while ($donnees = $reponse->fetch())
                        {
                        	$idCabinet = $donnees['idCabinet'];
                            getCabinetOfDoc($idCabinet);          
                        }  
                  $reponse->closeCursor();
	}

function getCabinetOfDoc($idCabinet){

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT * FROM cabinet WHERE idCabinet = '$idCabinet'");
                  
                  while ($donneesM = $reponse->fetch())
                        {


                            
                        echo "<dl class=\"dl-horizontal-profile\">
                                        <dt>Nom Cabinet</dt>
                                        <dd>".$donneesM['nomCabinet']."</dd>

                                        <dt>Adresse</dt>
                                        <dd>".$donneesM['adresseCabinet']."</dd>

                                        <dt>Numéro de téléphone</dt>
                                        <dd>".str_replace("/","  /  ",$donneesM['telCabinet'])."</dd>
                               </dl><hr>";
                                    
                        }
                  $reponse->closeCursor();


	}

function getIDSpecialiForDoc($idMedecin){

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT idSpecialite FROM relmedspecialite WHERE idMedecin = $idMedecin");
                  
                  while ($donnees = $reponse->fetch())
                        {
                        	$idSpecialite = $donnees['idSpecialite'];
                            getSpecialOfDoc($idSpecialite);          
                        }  
                  $reponse->closeCursor();
	}

function getSpecialOfDoc($idSpecialite){

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT nomSpecialite FROM specialite WHERE idSpecialite = '$idSpecialite'");
                  
                  while ($donneesM = $reponse->fetch())
                        {
                            
                        echo "<dl class=\"dl-horizontal-profile\">
                                        <dt>".$donneesM['nomSpecialite']."</dt>
                               </dl><br>
                               <hr>";
                                    
                        }
                  $reponse->closeCursor();


	}

function modDonneesProf($table, $champ, $id, $username, $nomtitle){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM $table WHERE $champ = '$id'");

                          while ($donnees = $reponse->fetch())
                                     {

echo    "<div style=\"margin:-20px 15px;\" class=\"nest\" id=\"Blank_PageClose\">
                                <div class=\"title-alt\">
                                    <h6>
                                        Modification Profil</h6>
                                    <div class=\"titleClose\">
                                        <a class=\"gone\" href=\"#Blank_PageClose\">
                                            <span class=\"entypo-cancel\"></span>
                                        </a>
                                    </div>
                                    <div class=\"titleToggle\">
                                        <a class=\"nav-toggle-alt\" href=\"#Blank_Page_Content\">
                                            <span class=\"entypo-up-open\"></span>
                                        </a>
                                    </div>
                                </div>

                                <div class=\"body-nest\" id=\"Blank_Page_Content\">

                                    <div class=\"row\">

                                        <!-- left column -->
                                        <div class=\"col-md-3\">
                                            <div class=\"text-center\">";

	                                            if ($donnees[8] == "Homme") {
	                                                		echo "<img class=\"img-circle img-responsive img-profile\" alt=\"\" src=\"assets/img/menAvatar.png\">";
	                                                	}
	                                            elseif ($donnees[8] == "Femme") {
	                                                		echo "<img class=\"img-circle img-responsive img-profile\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
	                                                	}
                                           echo "<!--h6>Importer une photo...</h6>

                                                <div class=\"input-group\">
                                                    <span class=\"input-group-btn\">
                                                        <span class=\"btn btn-primary btn-file\">
                                                            Importer
                                                            <input type=\"file\" multiple=\"\">
                                                        </span>
                                                    </span>
                                                    <input type=\"text\" class=\"form-control\">
                                                </div-->

                                            </div>
                                        </div>

                                        <div class=\"col-md-9 personal-info\">
                                            
                                            <h3>Informations personnelles</h3>
                                            <form action=\"fonctionnalites/mod/updateProfil.php\" class=\"form-horizontal\" role=\"form\">
                                            	<input value=\"".$id."\" type=\"hidden\" name=\"id\">
                                            	<br>
                                                <div class=\"form-group\">
                                                    <label class=\"col-lg-3 control-label\">Nom:</label>
                                                    <div class=\"col-lg-8\">
                                                        <input class=\"form-control\" value=\"".$donnees[1]."\" type=\"text\" name=\"nom\">
                                                    </div>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label class=\"col-lg-3 control-label\">Prénom:</label>
                                                    <div class=\"col-lg-8\">
                                                        <input class=\"form-control\" value=\"".$donnees[2]."\" type=\"text\" name=\"prenom\">
                                                    </div>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label class=\"col-lg-3 control-label\">Date de naissance:</label>
                                                    <div class=\"col-lg-8\">
                                                        <input class=\"form-control\" value=\"".$donnees[3]."\" type=\"text\" name=\"dateNaiss\">
                                                    </div>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label class=\"col-lg-3 control-label\">Lieu de naissance:</label>
                                                    <div class=\"col-lg-8\">
                                                        <input class=\"form-control\" value=\"".$donnees[4]."\" type=\"text\" name=\"lieuNaiss\">
                                                    </div>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label class=\"col-md-3 control-label\">Adresse:</label>
                                                    <div class=\"col-lg-8\">
                                                        <input class=\"form-control\" value=\"".$donnees[5]."\" type=\"text\" name=\"adresse\">
                                                    </div>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label class=\"col-md-3 control-label\">Email:</label>
                                                    <div class=\"col-lg-8\">
                                                        <input class=\"form-control\" value=\"".$donnees[6]."\" type=\"email\" name=\"mail\">
                                                    </div>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label class=\"col-md-3 control-label\">Numéro de téléphone:</label>
                                                    <div class=\"col-lg-8\">
                                                        <input class=\"form-control\" value=\"".$donnees[7]."\" type=\"phone\" name=\"tel\">
                                                    </div>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label class=\"col-md-3 control-label\">Sexe:</label>
                                                    <div class=\"col-lg-8\">
                                                        <input value=\"".$donnees[8]."\" type=\"hidden\" name=\"sexeEnregistre\">
                                                        <input class=\"form-control\" placeholder=\"".$donnees[8]."\" type=\"text\" name=\"sexe\" id=\"sex\" list=\"sexe\">                                  

					                                            <datalist id=\"sexe\"> 
					                                                <option value=\"Homme\">Homme</option>
					                                                  <option value=\"Femme\">Femme</option>
					                                            </datalist>
                                                    </div>

					                                    
                                                </div>
                                                <div class=\"form-group\">
                                                    <label class=\"col-md-3 control-label\">Groupage Sangin:</label>
                                                    <div class=\"col-lg-8\">
                                                    	<input value=\"".$donnees[9]."\" type=\"hidden\" name=\"groupageEnregistre\">
                                                        <input class=\"form-control\" name=\"groupage\" id=\"groupage\" placeholder=\"".$donnees[9]."\" list=\"groupeS\">

	                                                    <datalist id=\"groupeS\"> 
	                                                        <option value=\"".$donnees[9]."\">actuellement enregistré</option>
	                                                        <option value=\"O-\">O-</option>
	                                                        <option value=\"O+\">O+</option>
	                                                        <option value=\"A-\">A-</option>
	                                                        <option value=\"A+\">A+</option>
	                                                        <option value=\"B-\">B-</option>
	                                                        <option value=\"B+\">B+</option>
	                                                        <option value=\"AB-\">AB-</option>
	                                                        <option value=\"AB+\">AB+</option>
	                                                    </datalist>
                                                    </div>
                                                </div>
                                                <div class=\"form-group\">
                                                    <label class=\"col-md-3 control-label\"></label>
                                                    <div class=\"col-md-8\">
                                                        <input class=\"btn btn-primary\" value=\"Modifier\" type=\"submit\">
                                                        <span></span>
                                                        <input class=\"btn btn-default\" value=\"Annuler\" type=\"reset\">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
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



function updateProfil($table, $champ, $id, $nom, $prenom, $dateN, $lieuN, $adress, $mail, $num, $sexe, $group, $nomV, $prenomV, $dateNV, $lieuNV, $adressV, $mailV, $numV, $sexeV, $groupV){

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;

		$database = $baseGlobale; 

		try
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

				$rep = $bdd->query("UPDATE $table SET $nom='$nomV', $prenom='$prenomV', $dateN='$dateNV', $lieuN='$lieuNV', $adress='$adressV', $mail='$mailV', $num='$numV', $sexe='$sexeV', $group='$groupV' WHERE $champ = '$id'");

				$rep->closeCursor();
			}

		catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
	}


function testerUsername($username){

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;

		$database = $baseGlobale; 

		try
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            	$bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options); 

            	$usernam = ""; 

                  $reponse = $bdd->query("SELECT COUNT(*) FROM `users` WHERE `login` = '$username'");

                  while ($donnees = $reponse->fetch())
                            {
                                        $nbr = $donnees['0'];

                                        if ($nbr != 0) {
					                      	$usernam = "invalide";
					                   } elseif ($nbr == 0) {
					                     	$usernam = "valide";   
					                   }
                            }
                            return $usernam;
                        
                        $reponse->closeCursor();
			}

		catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
	}	

function insertionPatient($login,$password,$identifiant){

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;

		$login   	= str_replace("'","\'",$login);
		$passwordH 	= hash('sha512', $password);

          try
            {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);                      
                            
                // On recupere tout le contenu de la table news
                $reponse = $bdd->query("INSERT INTO `users`(`login`, `password`, `typeCompte`, `identifiant`) VALUES ('$login','$passwordH','1','$identifiant');");

                $reponse->closeCursor();
            }
          catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
    }


    function getTheme($idUser){

		//$host_name = "localhost";
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
                            $reponse = $bdd->query("SELECT nomTheme FROM theme WHERE `idUser` = '$idUser'");  

                            $nbr = $reponse->rowCount();

                            if ($nbr > 0) {

	                           while ($donnees = $reponse->fetch())
	                                {
	                                 $_SESSION['theme'] = $donnees['nomTheme'];
	                                }
	                        }

	                        else{
	                        	  $_SESSION['theme']  = "bgtest8";
	                        }        
	                           $reponse->closeCursor();
                          }

                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}

	function insertDefaultTheme($idUser){

		//$host_name = "localhost";
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
                            $reponse = $bdd->query("INSERT INTO `theme`(`idUser`, `nomTheme`) VALUES ('$idUser','bgtest10');");   

                           $reponse->closeCursor();
                          }

                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}			

function afficheToutesLesCons($nomBD, $nbrLigne){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          //$date = "'" .date('d/m/Y')."'";
                          $reponse = $bdd->query("SELECT * FROM consultations order by heureConsultation desc LIMIT $nbrLigne");

                          $couleurSus = "";
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                         	$idPatient  = $donnees['idPatient'];
                         	$nomPatient = getPatientName($idPatient);

                         	$idMedecin  = $donnees['idMedecin'];
                         	$nomMedecin = getMedecinName($idMedecin);

                         	$idConsulta = $donnees['idConsultation']; 

                            echo "<tr>";

	                            echo "<td> $nomPatient </td>";
	                            echo "<td> $nomMedecin </td>";

	                            echo "<td data-value> $idConsulta </td>";

	                            $motif = $donnees['motifCons']; 

	                            if ($motif =="Aucun Motif enregistré pour cette consultation") {
	                            	$motif = "Aucun motif";
	                            }

	                            echo "<td data-value> $motif </td>";
	                            //echo "<td data-value> $donnees[conclusion] </td>";

	                            $etatConsu = $donnees['etatCons'];

	                            switch ($etatConsu) {
	                            			case '0':
	                            					$etat = 'Clôturée';
	                            					$couleurSus = "active";
	                            				break;
	                            			case '1':
	                            					$etat = 'Suspendue';
	                            					$couleurSus = "suspended";
	                            				break;
	                            		}
	                            echo "<td data-value> $etat </td>";

	                            echo "<td data-value><a href=\"datailsConsult.php?idConsultation=$idConsulta&idPatient=$idPatient\"> <button>Voir</button></a> </td>";

	                                

	                            echo "<td data-value=\"1\"> <span class=\"status-metro status-".$couleurSus."\" title=\"Active\"> $donnees[heureConsultation] </span></td>";                                                                                    
                            echo "</tr>";
						}
                           $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
						 
				}


function getLonLatCabinets(){

    global $host_name;
	global $db_user_name;
	global $db_password;
    global $baseGlobale;
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT * FROM `cabinet`");
                         
                            while ($donnees = $reponse->fetch())
                                    {

                                      $latitude       = $donnees['latitudeCabinet'];
                                      $longitude      = $donnees['longitudeCabinet'];

                                      $idCabinet      = $donnees['idCabinet'];
                                      $nomCabinet     = $donnees['nomCabinet'];
                                      $adresseCabinet = $donnees['adresseCabinet'];
                                      $telCabinet     = $donnees['telCabinet'];
                                      $dateDhadesion  = $donnees['dateDhadesion'];

                                                  


                        echo "L.mapbox.featureLayer({
                                    id: 'inactif',
                                    type: 'Feature',
                                    geometry: {
                                        type: 'Point',

                                        coordinates: [
                                          $latitude,
                                          $longitude
                                        ]
                                    },
                                    properties: {
                                        description: '<strong>Cabinet:</strong><p>$nomCabinet</p><strong>Identifiant:</strong><p>$idCabinet</p><strong>Adresse:</strong><p>$adresseCabinet</p><strong>Téléphone: </strong><p>$telCabinet</p>',
                                        'marker-size': 'large',
                                        'marker-color': '#05FF30',
                                        'marker-symbol': 'wetland'
                                    }
                                }).addTo(map);";              
                                      //$donnees['latitude','longitude'];

                                      //print($donnees['latitude'], $donnees['longitude']);
   
                                    }  
                              
                           $reponse->closeCursor();
                          }
            catch(Exception $e)
                        {
                           die('Erreur : '.$e->getMessage());
                        } 
        }
				             

function verifierSilADejaEnvoyerUneDemande($sender, $receiver){

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;

		$database = $baseGlobale; 

		$nbr = 0;

		try
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            	$bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options); 

                  $reponse = $bdd->query("SELECT demande FROM `amis` WHERE `monID` = '$sender' AND `amiID` = '$receiver' AND `demande` = '0'");

                  while ($donnees = $reponse->fetch())
                            {
                                $nbr = $nbr + 1;
                            }
                            return $nbr;
                        
                     $reponse->closeCursor();
			}

		catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
	}

function verifierSilEstDejaAmi($sender, $receiver){

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;

		$database = $baseGlobale; 

		$nbr = "";

		try
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            	$bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options); 

                  $reponse = $bdd->query("SELECT demande FROM `amis` WHERE `monID` = '$sender' AND `amiID` = '$receiver' AND `demande` = '1'");

                  while ($donnees = $reponse->fetch())
                            {
                                $nbr = $donnees['demande'];
                            }
                            return $nbr;
                        
                     $reponse->closeCursor();
			}

		catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
	}	

function nbrDemandeChatMedecin($myDocID){

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
                            $reponse = $bdd->query("SELECT COUNT(monID) FROM amis WHERE monID ='$myDocID' AND demande ='0' ");
                                 
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

function acceptChatPatient($idDoc, $idPatient){

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;

		$database = $baseGlobale; 

		try
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

				$rep = $bdd->query("UPDATE amis SET demande='1', amiID='$prenomV' WHERE (monID = '$idDoc' AND amiID = '$idPatient') OR (monID = '$idPatient' AND amiID = '$idDoc')");

				$rep->closeCursor();
			}

		catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
	}

function deleteChatPatient($idDoc, $idPatient){

	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;

		$database = $baseGlobale; 

		try
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

				$rep = $bdd->query("DELETE FROM amis WHERE monID='$idDoc' AND amiID='$idPatient'");

				$rep->closeCursor();
			}

		catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}

		try
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

				$rep = $bdd->query("DELETE FROM amis WHERE monID='$idPatient' AND amiID='$idDoc'");

				$rep->closeCursor();
			}

		catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}	
	}						


function fetchComptesPatient($idPatient){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                        $reponse = $bdd->query("SELECT * FROM `users` WHERE `identifiant` = '$idPatient' AND (typeCompte = '4' OR typeCompte = '5')");

                        while ($donnees = $reponse->fetch())
                                    {
                                        $typeCpt = $donnees['typeCompte'];

                                        if ($typeCpt == '4') {
                                        	
                                        	echo "
                                        	<li>
			                                    <a href=\"basculerunautreprofile.php?idPatient=$idPatient&profile=$typeCpt\">
			                                        <span class=\"entypo-vcard\"></span>&#160;&#160;Admin
			                                    </a>
			                                </li>";
                                        }

                                        elseif ($typeCpt == '5') {

                                        	echo "
                                        	<li>
                                        		<a href=\"basculerunautreprofile.php?idPatient=$idPatient&profile=$typeCpt\">
			                                        <span class=\"entypo-vcard\"></span>&#160;&#160;Staff
			                                    </a>
			                                </li>";
                                        }
                                    }
                        		$reponse->closeCursor();     
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }


function getNomCabinetFromIdCabinet($idCabinet){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                        $reponse = $bdd->query("SELECT nomCabinet FROM `cabinet` WHERE `idCabinet` = '$idCabinet'");
                        
                        $nbr = $reponse->rowCount();

                        if ($nbr > 0) {

                        	while ($donnees = $reponse->fetch())
                                    {
                                        $nomCab  = $donnees['nomCabinet']; 
                                    }

                        	return $nomCab;
                        }
                        $reponse->closeCursor();     
                    }

        catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
        }

function getVirtuhosCabinet(){

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT idCabinet,nomCabinet FROM cabinet");
                  
                  while ($donneesM = $reponse->fetch())
                        {

                        	echo "<option value=\"$donneesM[idCabinet]\">

                        			$donneesM[nomCabinet]";

                            echo "</option>";
                        }
                  $reponse->closeCursor();

	}

function getDocsForRDV($idCabinet){

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

function afficherToutMesRDVAVenir($idPatient){


	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT * FROM `relpatcab`,`cabinet` WHERE cabinet.idCabinet = relpatcab.idCabinet AND relpatcab.idPatient = '$idPatient'");
                  
                  while ($donneesM = $reponse->fetch())
                        {
                        	$nomCab = $donneesM['nomCabinet'];

                        	getToutMesRDVAVenir($idPatient,$nomCab);
                        }
                  $reponse->closeCursor();					 
	}

function getToutMesRDVAVenir($idPatient,$nomBD){


	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          //$date = date('d/m/Y');
                          //DATE_FORMAT(dateRDV,'%Y/%m/%d')>= '$date'                           
                          $date = date('Y/m/d');
                          						 		
                          $reponse = $bdd->query("SELECT * FROM rdv WHERE idPatient = '$idPatient' AND STR_TO_DATE(dateRDV,'%d/%m/%Y')>= STR_TO_DATE('$date','%Y/%m/%d') order by dateRDV desc");
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                            echo "<tr>";

                              echo "<td> $donnees[nomP] </td>";
                              echo "<td> $donnees[dateRDV] </td>";

                              echo "<td data-value> $donnees[id] </td>";
                              echo "<td data-value> $donnees[prenoP] </td>";
                              echo "<td data-value> $donnees[tel] </td>";
                              echo "<td data-value> $donnees[medecin] </td>";
                              echo "<td data-value> <a href=\"fonctionnalites/supp/suppRDV.php?nomCabinet=".$nomBD."&idRDV=".$donnees['id']."&rdv_patient='pat'\">
                                                        <button class=\"btn btn-danger\">
                                                            <span class=\"entypo-trash\"></span>&nbsp;&nbsp;Supprimer
                                                        </button>
                                                    </a></td>";       

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

function afficherToutMesRDV($idPatient){


	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;
		
		$database = $baseGlobale; 
		
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT * FROM `relpatcab`,`cabinet` WHERE cabinet.idCabinet = relpatcab.idCabinet AND relpatcab.idPatient = '$idPatient'");
                  
                  while ($donneesM = $reponse->fetch())
                        {
                        	$nomCab = $donneesM['nomCabinet'];

                        	getToutMesRDV($idPatient,$nomCab);
                        }
                  $reponse->closeCursor();					 
	}

function getToutMesRDV($idPatient,$nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $date = date('d/m/Y');
                          //DATE_FORMAT(dateRDV,'%Y/%m/%d')>= '$date'                           
                          //$date = date('Y/m/d');
                          $reponse = $bdd->query("SELECT * FROM rdv WHERE idPatient = '$idPatient' AND dateRDV >= '$date' order by dateRDV desc");
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                            echo "<tr>";

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
	
function getStaffCabinetForNotif($Cabinet){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                        $reponse = $bdd->query("SELECT * FROM `relstaffcab` WHERE `idCabinet` = '$Cabinet'");

                        $nbrCabinet = $reponse->rowCount();


                        if ($nbrCabinet == 0) {

                        	echo "Aucun Staff enregistré dans ce cabinet";
                        }

                        else{

                        	while ($donnees = $reponse->fetch())
                                    {
                                    	getStaffById($donnees['identifiantStaff']);
                                    }
                        }
                          
                        $reponse->closeCursor();     
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }	

function getStaffById($idStaff){

  global $host_name;
  global $db_user_name;
  global $db_password;
  global $baseGlobale;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                        $reponse = $bdd->query("SELECT * FROM `patient` WHERE `idPatient` = '$idStaff'");
                        
                        $nbr = $reponse->rowCount();

                        if ($nbr > 0) {

                        	while ($donnees = $reponse->fetch())
                                    {
                                     $docName = getMedecinName($_SESSION['idDeCeMedecin']);
                                       echo "
                                        	<div style=\"margin-top:0;padding-left: 1px;padding-bottom: 10px; height: 20px\">
                        
						                            <h3>
						                                <span><img alt=\"\" class=\"img-chat img-circle\" src=\"assets/img/girlAvatar.png\">&nbsp;&nbsp;<b>$donnees[nomPatient]</b></span>
						                            </h3>
						                            <div class=\"col-sm-12\">
						                            	<form action=\"notify/save_notifications.php\" method=\"POST\" id=\"$idStaff\">
							                                <select name=\"message\" class=\"form-control\" style=\"width: 90%; height: 50%;\">
							                                        
							                                        <option value=\"Passer le patient suivant\">Passer le patient suivant</option>
							                                        <option value=\"Venez au bureau\">Venez au bureau</option>
							                                </select>

							                                <input type=\"hidden\" name=\"title\" 		value=\"Dr, $docName\">
															<input type=\"hidden\" name=\"ntime\" 		value=\"Now\">
															<input type=\"hidden\" name=\"loops\" 		value=\"1\">
															<input type=\"hidden\" name=\"loop_every\" 	value=\"1\">
															<input type=\"hidden\" name=\"user\" 		value=\"$idStaff\"\>
														</form>

						                                <button type=\"submit\" form=\"$idStaff\" value=\"Submit\">Envoyer</button>
						                            </div>
						                            
						                    </div>
						                    <div>
						                        <br><br><hr style=\"border: 1px solid gray; border-radius: 5px; margin-top: 5px\">
						                    </div>
                                        ";
                                    }
                        }
                        $reponse->closeCursor();     
                    }

        catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
        }

function getMotifCurrentConsultation($idPatient,$nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $date = date('d/m/Y');
                          //DATE_FORMAT(dateRDV,'%Y/%m/%d')>= '$date'                           
                          //$date = date('Y/m/d');
                          $reponse = $bdd->query("SELECT motifCons FROM rdv WHERE idPatient = '$idPatient' AND dateRDV = '$date'");
                          $nbr = $reponse->rowCount();

                          $motifCons ="";
                          if ($nbr == 0) {
                          				$motifCons = "Aucun Motif enregistré pour cette consultation";
                            } else{

                            	while ($donnees = $reponse->fetch())
			                        {
			                            $motifCons = $donnees['motifCons'];
									}
                               }  
                            return $motifCons;     
                           $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
						 
				}        

function recetteTotalParJour($nomBD){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

			$date    = date('d/m/Y');  
            $nbrCons = nbrConsDuJour($nomBD); 
            $toDay 	 = date('Y-m-d'); 

            if ($nbrCons == 0) 
            {
                echo "<tr><td>Aujourd'hui ($date)</td><td>Aucune activité enregistré aujourd'hui !</td></tr>";

                echo "<script>$(document).ready(function(){ $(\"#showDetails\").hide(); });</script>";
            }

            else{                      
					try
                        {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);


                            $reponse = $bdd->query('SELECT SUM(prix.prixExamen) FROM `prix`,`relationexamcons`,`consultations`,`examens` WHERE DATE(consultations.heureConsultation) = CURDATE() AND relationexamcons.idConsultation = consultations.idConsultation AND examens.typeExamen = relationexamcons.typeExamen  AND prix.idExamen = examens.idExamen');
                            $nbr = $reponse->rowCount();

	                            while ($donnees = $reponse->fetch())
	                                {
	                                   $prixExm  = $donnees[0];

	                                   $nbrCons = $nbrCons + 1;
	                                }


	                                $prixCons = getConsultationPrice($nomBD);
	                                $prixConsSansExam = $nbrCons * $prixCons;
	                                $total = $prixConsSansExam + $prixExm;

	                                echo "<tr><td>Aujourd'hui ($date)</td><td>$total da</td></tr>";
                                               
                            
                           $reponse->closeCursor();
                        }

                    catch(Exception $e)
                        {
                           die('Erreur : '.$e->getMessage());
                        } 
                }             
		}



function recetteTotalParKine($nomBD,$toDay){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

		$date    = date('d/m/Y');  
        //$toDay 	 = date('Y-m-d'); 

        //$prixSeance = getConsultationPrice($nomBD);

        $total = 0;

            try
                {
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                    $reponse = $bdd->query("SELECT * FROM `medecin`,`gestionrecettepracitien` WHERE medecin.idMedecin=gestionrecettepracitien.idMedecin");
                    $nbr = $reponse->rowCount();

                    if ($nbr > 0) {

                    	while ($donnees = $reponse->fetch())
	                        {
	                            $idMedecin  	= $donnees['idMedecin'];
	                            $nomDoc  		= $donnees['nomMedecin'];
	                            $prenomDoc  	= $donnees['prenomMedecin'];
	                            $pourcentage  	= $donnees['pourcentage'];

	                            recetteTotalUnKine($nomBD,$idMedecin,$toDay,$nomDoc,$prenomDoc,$pourcentage);
	                        }
                    }

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                } 
		}

function recetteTotalUnKine($nomBD,$idMedecin,$toDay,$nomDoc,$prenomDoc,$pourcentage){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

		$date    = date('d/m/Y');  
        //$toDay 	 = date('Y-m-d'); 

        $total = 0;

            try
                {
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                    $reponse = $bdd->query("SELECT * FROM `addition`,`medecin`,`gestionrecettepracitien` WHERE addition.idMedecin=medecin.idMedecin AND addition.idMedecin=gestionrecettepracitien.idMedecin AND addition.date_cons='$toDay' AND addition.idMedecin='$idMedecin'");
                    $nbr = $reponse->rowCount();

                    if ($nbr > 0) {

                    	while ($donnees = $reponse->fetch())
	                        {
	                            $id_addition  	= $donnees['id_addition'];
	                            $addition  		= $donnees['addition'];
	                            $nomMedecin  	= $donnees['nomMedecin'];
	                            $prenomMedecin  = $donnees['prenomMedecin'];
	                            $pourcentage  	= $donnees['pourcentage'];

	                            $total = $total + $addition;
	                        }

	                        $net = ( $total * $pourcentage ) / 100;

                        echo "<tr>
                        			<td>Aujourd'hui ($toDay)</td>
                        			<td>$nomMedecin</td>
                        			<td>$prenomMedecin</td>
                        			<td>$total da</td>
                        			<td>".$pourcentage."%</td>
                        			<td>$net da</td>
                        	  </tr>";
                    }else{
                    	echo "<tr>
                        			<td>Aujourd'hui ($toDay)</td>
                        			<td>$nomDoc</td>
                        			<td>$prenomDoc</td>
                        			<td>Aucune seance faite</td>
                        			<td>".$pourcentage."%</td>
                        			<td>0 da</td>
                        	  </tr>";
                    }

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                } 
		}

/*function recetteTotalUnKine($nomBD,$idMedecin,$toDay,$nomDoc,$prenomDoc,$pourcentage){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

		$date    = date('d/m/Y');  
        //$toDay 	 = date('Y-m-d'); 

        $total = 0;

            try
                {
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                    $reponse = $bdd->query("SELECT * FROM `addition`,`medecin`,`gestionrecettepracitien` WHERE addition.idMedecin=medecin.idMedecin AND addition.idMedecin=gestionrecettepracitien.idMedecin AND addition.date_cons='$toDay' AND addition.idMedecin='$idMedecin'");
                    $nbr = $reponse->rowCount();

                    if ($nbr > 0) {

                    	while ($donnees = $reponse->fetch())
	                        {
	                            $id_addition  	= $donnees['id_addition'];
	                            $addition  		= $donnees['addition'];
	                            $nomMedecin  	= $donnees['nomMedecin'];
	                            $prenomMedecin  = $donnees['prenomMedecin'];
	                            $pourcentage  	= $donnees['pourcentage'];

	                            $total = $total + $addition;
	                        }

	                        $net = ( $total * $pourcentage ) / 100;

                        echo "<tr>
                        			<td>Aujourd'hui ($toDay)</td>
                        			<td>$nomMedecin</td>
                        			<td>$prenomMedecin</td>
                        			<td>$total da</td>
                        			<td>".$pourcentage."%</td>
                        			<td>$net da</td>
                        	  </tr>";
                    }else{
                    	echo "<tr>
                        			<td>Aujourd'hui ($toDay)</td>
                        			<td>$nomDoc</td>
                        			<td>$prenomDoc</td>
                        			<td>Aucune seance faite</td>
                        			<td>".$pourcentage."%</td>
                        			<td>0 da</td>
                        	  </tr>";
                    }

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                } 
		}	*/	

function recetteTotalDuJour($nomBD,$toDay){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

		$date    = date('d/m/Y');  
        //$toDay 	 = date('Y-m-d'); 

        $total = 0;

            try
                {
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                    $reponse = $bdd->query("SELECT * FROM `addition` WHERE addition.date_cons='$toDay'");
                    $nbr = $reponse->rowCount();

                    if ($nbr > 0) {

                    	while ($donnees = $reponse->fetch())
	                        {
	                            $id_addition  	= $donnees['id_addition'];
	                            $addition  		= $donnees['addition'];

	                            $total = $total + $addition;
	                        }

                        echo "<tr>
                        			<td>Total Aujourd'hui ($toDay)</td>
                        			<td>$total da</td>
                        	  </tr>";

                        echo "<tr>
                        			<td>Séance Simple</td>
                        			<td>" . recetteConsSimpleDuJour($nomBD,$toDay) . " da</td>
                        	  </tr>";

                        echo "<tr>
                        			<td>Séance Vestibulaire</td>
                        			<td>" . recetteConsVestibulaireDuJour($nomBD,$toDay) . " da</td>
                        	  </tr>";	

                        echo "<tr>
                        			<td>Bilan Vestibulaire</td>
                        			<td>" . recetteBilanVestibulaireDuJour($nomBD,$toDay) . " da</td>
                        	  </tr>";	

                        echo "<tr>
                        			<td>Séance Esthétique</td>
                        			<td>" . recetteConsEsthetiqueDuJour($nomBD,$toDay) . " da</td>
                        	  </tr>";	  	  
                    }else{
                    	echo "<tr>
                        			<td>Aujourd'hui ($toDay)</td>
                        			<td>Aucune seance faites</td>
                        	  </tr>";
                    }

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                } 
		}	

function recetteConsSimpleDuJour($nomBD,$toDay){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

	$date    = date('d/m/Y');  
    //$toDay 	 = date('Y-m-d'); 

    $total = 0;

    try
        {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

            $reponse = $bdd->query("SELECT * FROM `addition` WHERE addition.date_cons='$toDay' AND addition.type_seance ='simple'");
            $nbr = $reponse->rowCount();

            if ($nbr > 0) {

            	while ($donnees = $reponse->fetch())
                    {
                        $total = $total + $donnees['addition'];
                    }

                return $total;	  	  
            }else{
            	return 0;
            }

            $reponse->closeCursor();
        }

    catch(Exception $e)
        {
           die('Erreur : '.$e->getMessage());
        } 
}	


function recetteConsVestibulaireDuJour($nomBD,$toDay){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

	$date    = date('d/m/Y');  
    //$toDay 	 = date('Y-m-d'); 

    $total = 0;

    try
        {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

            $reponse = $bdd->query("SELECT * FROM `addition` WHERE addition.date_cons='$toDay' AND addition.type_seance ='vestibulaire'");
            $nbr = $reponse->rowCount();

            if ($nbr > 0) {

            	while ($donnees = $reponse->fetch())
                    {
                        $total = $total + $donnees['addition'];
                    }

                return $total;	  	  
            }else{
            	return 0;
            }

            $reponse->closeCursor();
        }

    catch(Exception $e)
        {
           die('Erreur : '.$e->getMessage());
        } 
}

function recetteBilanVestibulaireDuJour($nomBD,$toDay){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

	$date    = date('d/m/Y');  
    //$toDay 	 = date('Y-m-d'); 

    $total = 0;

    try
        {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

            $reponse = $bdd->query("SELECT * FROM `addition` WHERE addition.date_cons='$toDay' AND addition.type_seance ='bilan_vestibulaire'");
            $nbr = $reponse->rowCount();

            if ($nbr > 0) {

            	while ($donnees = $reponse->fetch())
                    {
                        $total = $total + $donnees['addition'];
                    }

                return $total;	  	  
            }else{
            	return 0;
            }

            $reponse->closeCursor();
        }

    catch(Exception $e)
        {
           die('Erreur : '.$e->getMessage());
        } 
}

function recetteConsEsthetiqueDuJour($nomBD,$toDay){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

	$date    = date('d/m/Y');  
    //$toDay 	 = date('Y-m-d'); 

    $total = 0;

    try
        {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

            $reponse = $bdd->query("SELECT * FROM `addition` WHERE addition.date_cons='$toDay' AND addition.type_seance ='esthetique'");
            $nbr = $reponse->rowCount();

            if ($nbr > 0) {

            	while ($donnees = $reponse->fetch())
                    {
                        $total = $total + $donnees['addition'];
                    }

                return $total;	  	  
            }else{
            	return 0;
            }

            $reponse->closeCursor();
        }

    catch(Exception $e)
        {
           die('Erreur : '.$e->getMessage());
        } 
}				


function getConsultationPrice($nomBD){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);
	
	try
        {
                                
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
        
        $reponse = $bdd->query('SELECT prixConsultation FROM prixconsultation WHERE typeConsultation = "simple"');

        $nbr = $reponse->rowCount();   

        if ($nbr != 0) 
        {
            while ($donnees = $reponse->fetch())
                {
                  $prixConsultation   = $donnees['prixConsultation'];
                }
        }    
            return $prixConsultation;
       $reponse->closeCursor();
      }
    catch(Exception $e)
        {
           die('Erreur : '.$e->getMessage());
        }  
}

function getVestibulaireConsultationPrice($nomBD){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);
	
	try
        {
                                
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
        
        $reponse = $bdd->query('SELECT prixConsultation FROM prixconsultation WHERE typeConsultation = "vestibulaire"');

        $nbr = $reponse->rowCount();   

        if ($nbr != 0) 
        {
            while ($donnees = $reponse->fetch())
                {
                  $prixConsultation   = $donnees['prixConsultation'];
                }
        }    
            return $prixConsultation;
       $reponse->closeCursor();
      }
    catch(Exception $e)
        {
           die('Erreur : '.$e->getMessage());
        }  
}

function getBilanVestibulairePrice($nomBD){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);
	
	try
        {
                                
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
        
        $reponse = $bdd->query('SELECT prixConsultation FROM prixconsultation WHERE typeConsultation = "bilan_vestibulaire"');

        $nbr = $reponse->rowCount();   

        if ($nbr != 0) 
        {
            while ($donnees = $reponse->fetch())
                {
                  $prixConsultation   = $donnees['prixConsultation'];
                }
        }    
            return $prixConsultation;
       $reponse->closeCursor();
      }
    catch(Exception $e)
        {
           die('Erreur : '.$e->getMessage());
        }  
}

function getEsthetiqueConsultationPrice($nomBD){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);
	
	try
        {
                                
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
        
        $reponse = $bdd->query('SELECT prixConsultation FROM prixconsultation WHERE typeConsultation = "esthetique"');

        $nbr = $reponse->rowCount();   

        if ($nbr != 0) 
        {
            while ($donnees = $reponse->fetch())
                {
                  $prixConsultation   = $donnees['prixConsultation'];
                }
        }    
            return $prixConsultation;
       $reponse->closeCursor();
      }
    catch(Exception $e)
        {
           die('Erreur : '.$e->getMessage());
        }  
}

/*
function getPatientNameFromIdCons($nomBD,$idCons){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT idPatient FROM `consultations` WHERE 1 `idConsultation` = '$idCons'");

                            $nbr = $reponse->rowCount();   

                            if ($nbr != 0) 
                            {
	                            // On affiche le resultat
	                            while ($donnees = $reponse->fetch())
	                                {
	                                  $idPatient   = $donnees['idPatient'];
	                                  $patientName = getPatientName($idPatient);
	                                }
                            }    
                                return $patientName;
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
		}	*/

function nbrConsDuJour($nomBD){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

	$toDay 		= date('Y-m-d');

						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                            
                            $reponse = $bdd->query("SELECT * FROM `consultations` WHERE DATE(heureConsultation) LIKE '%$toDay'");
                            $nbr = 0;
                            

	                            while ($donnees = $reponse->fetch())
	                                {
	                                   $nbr  = $nbr + 1;
	                                }

	                                return $nbr;
                                               
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
		}

function getEmplacementFichePatient($nomBD,$idPatient){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                            
                            $reponse = $bdd->query("SELECT * FROM `emplacement_fiche_patient` WHERE `idPatient` = '$idPatient'");
                            $nbr = $reponse->rowCount();

                            echo "<br>";
	                                	echo "<tr>";        

                                            echo "<td>";
                                            echo "Emplacement Fiche Patient";
                                            echo "</td>";

                                            echo "<td>";

                            if ($nbr == 0) {
                            	
                            		insertEmplacementFichePatient($idPatient,$nomBD);

                                    echo "Armoire: <b>Non Enregistré</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Boite: <b>Non Enregistré</b>";
                                            
                            }else{

                            	while ($donnees = $reponse->fetch())
	                                {
	                                	if ($donnees['armoire'] != "" && $donnees['boite'] != "") {
	                                		
	                                        echo "Armoire: <b>".$donnees['armoire']."</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Boite: <b>".$donnees['boite']."</b>";

	                                	}elseif ($donnees['armoire']=="" && $donnees['boite']=="") {
	                                		echo "Armoire: <b>Non Enregistré</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Boite: <b>Non Enregistré</b>";

	                                	}elseif ($donnees['armoire']=="" && $donnees['boite']!="") {
	                                		echo "Armoire: <b>Non Enregistré</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Boite: <b>".$donnees['boite']."</b>";

	                                	}elseif ($donnees['boite']=="" && $donnees['armoire']!="") {
	                                		echo "Armoire: <b>".$donnees['armoire']."</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Boite: <b>Non Enregistré</b>";
	                                	}
	                                	
	                                }
                            }

                            	echo "<button class=\"btn btn-info\" data-toggle=\"modal\" data-target=\"#updateemplac\" style=\"margin-left:7%\">Modifier</button>";

                            	echo "</td>";

                            echo "</tr>";


					            
                                               
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
		}

function insertEmplacementFichePatient($idPatient,$nomBD){

		global $host_name;
		global $db_user_name;
		global $db_password;
		
		$database 	= crypterNomDeLaBase($nomBD);

						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("INSERT INTO `emplacement_fiche_patient`(`idPatient`) VALUES ('$idPatient')");   

                           $reponse->closeCursor();
                          }

                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
				}
						

function updateConsPrice($nomBD,$idCons,$prix,$ceMoment){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                            
                            $reponse = $bdd->query("SELECT * FROM `caisse` WHERE `idConsultation` = '$idCons'");
                            $nbr = $reponse->rowCount();


                            if ($nbr == 0) {
                            	
                            		ajoutPrixConsModifie($prix,$idCons,$nomBD,$ceMoment);               
                            }
                  
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
		}		


function ajoutPrixConsModifie($prix,$idCons,$cabinet,$ceMoment){

	global $host_name;
	global $db_user_name;
	global $db_password;

		$database = crypterNomDeLaBase($cabinet);


                        try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("INSERT INTO `caisse`(`idConsultation`, `prix`, `date`) VALUES ('$idCons','$prix','$ceMoment')");

                            $reponse->closeCursor();
                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
        }			

function getStaffCabinetForNotifForPrice($Cabinet,$idMedecin){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                        $reponse = $bdd->query("SELECT * FROM `relstaffcab` WHERE `idCabinet` = '$Cabinet'");

                        $nbrCabinet = $reponse->rowCount();


                        if ($nbrCabinet == 0) {

                        	echo "Aucun Staff enregistré dans ce cabinet";
                        }

                        else{

                        	while ($donnees = $reponse->fetch())
                                    {
                                    	getStaffByIdForPrice($donnees['identifiantStaff'],$idMedecin);
                                    }
                        }
                          
                        $reponse->closeCursor();     
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }	

function getStaffByIdForPrice($idStaff,$idMedecin){

  global $host_name;
  global $db_user_name;
  global $db_password;
  global $baseGlobale;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                        $reponse = $bdd->query("SELECT * FROM `patient` WHERE `idPatient` = '$idStaff'");
                        
                        $nbr = $reponse->rowCount();

                        if ($nbr > 0) {

                        	echo "<select id=\"idStaff\" class=\"form-control\">";

                        	while ($donnees = $reponse->fetch())
                                    {
                                     $docName = getMedecinName($idMedecin);
                                       echo "<option value=\"$donnees[idPatient]\">$donnees[nomPatient]</option>";
                                    }

                                echo "</select>";
                        }
                        $reponse->closeCursor();     
                    }

        catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
        }

function getStaffCabinetForNotifForPrices($Cabinet,$idMedecin){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                        $reponse = $bdd->query("SELECT * FROM `relstaffcab` WHERE `idCabinet` = '$Cabinet'");

                        $nbrCabinet = $reponse->rowCount();


                        if ($nbrCabinet == 0) {

                        	echo "Aucun Staff enregistré dans ce cabinet";
                        }

                        else{

                        	while ($donnees = $reponse->fetch())
                                    {
                                    	getStaffByIdForPrices($donnees['identifiantStaff'],$idMedecin);
                                    }
                        }
                          
                        $reponse->closeCursor();     
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }        

function getStaffByIdForPrices($idStaff,$idMedecin){

  global $host_name;
  global $db_user_name;
  global $db_password;
  global $baseGlobale;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                        $reponse = $bdd->query("SELECT * FROM `patient` WHERE `idPatient` = '$idStaff'");
                        
                        $nbr = $reponse->rowCount();

                        if ($nbr > 0) {

                        	echo "<select id=\"idStaffs\" class=\"form-control\">";

                        	while ($donnees = $reponse->fetch())
                                    {
                                     $docName = getMedecinName($idMedecin);
                                       echo "<option value=\"$donnees[idPatient]\">$donnees[nomPatient]</option>";
                                    }

                                echo "</select>";
                        }
                        $reponse->closeCursor();     
                    }

        catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
        }

function getPatientNameEtPrenom($idUser){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT nomPatient,prenomPatient FROM `patient` WHERE `idPatient` = '$idUser'");

                          $nomPatient 		= "";
                          $prenomPatient 	= "";
                          $nomprenomPatient = "";

                          while ($donnees = $reponse->fetch())
                                     {
                                        $nomPatient 	= $donnees['nomPatient'];
                                        $prenomPatient  = $donnees['prenomPatient'];

                                        $nomprenomPatient = $nomPatient . " " . $prenomPatient;
                                      }

                                      return $nomprenomPatient;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }

function getPatientPrenom($idUser){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT prenomPatient FROM `patient` WHERE `idPatient` = '$idUser'");

                          $prenomPatient 	= "";

                          while ($donnees = $reponse->fetch())
                                     {
                                        $prenomPatient  = $donnees['prenomPatient'];

                                      }

                                      return $prenomPatient;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }

function getPatientAge($idUser){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT dateNaissPatient FROM `patient` WHERE `idPatient` = '$idUser'");



							// Calcule l'âge à partir d'une date de naissance jj/mm/aaaa
							$date_naissance = "";

                          

                          while ($donnees = $reponse->fetch())
                                    {
                                        $date_naissance  = $donnees['dateNaissPatient'];
                                    }

									$an = date('Y');
									$annaiss = substr($date_naissance, 0, 4);
										
									$age = $an - $annaiss;
									
									return $age;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }        

function inserupdatedconsprice($nomBD,$idCons,$prix,$ceMoment){

  	global $host_name;
	global $db_user_name;
	global $db_password;

        $database         = crypterNomDeLaBase($nomBD);


                        try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("INSERT INTO `caisse`(`idConsultation`, `prix`, `date`) VALUES ('$idCons','$prix','$ceMoment')");

                            $reponse->closeCursor();
                                                  
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
             
        }

function updateupdatedconsprice($nomBD,$idCons,$prix,$ceMoment){

  	global $host_name;
	global $db_user_name;
	global $db_password;

        $database         = crypterNomDeLaBase($nomBD);


        try
			{
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

				$rep = $bdd->query("UPDATE `caisse` SET `prix`='$prix',`date`='$ceMoment' WHERE `idConsultation` = '$idCons'");

				$rep->closeCursor();
			}

		catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
             
        }                        
		
function afficheLesRDVDuJourDoc($idCab,$nomBD,$docName){

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
                         	$idNot = $donnees['id'] . $donnees['idPatient'];
	                        echo "<tr>";

	                            echo "<td> " . $donnees['nomP'] ." ". $donnees['prenoP'] . "</td>";
	                            echo "<td> $donnees[dateRDV] </td>";

	                            echo "<td data-value> $donnees[idPatient] </td>";
	                            echo "<td data-value> $donnees[tel] </td>";
	                            echo "<td data-value> $donnees[medecin] </td>";       

	                            echo "<td data-value=\"1\"> <span class=\"status-metro status-active\" title=\"Active\"> $donnees[heureRDV]</span></td>";

	                            echo   "<td data-value><div class=\"form-group form-inline\">
                                       			<form action=\"notify/notificationPassPatient.php\" id=\"$idNot\" method=\"POST\">";
													//getStaffCabinetForNotifPasserPatientRDV($idCab,$donnees['id'],$docName,$donnees['nomP'],$donnees['prenoP'],$donnees['idPatient']);
											echo "
													<input type=\"submit\" form=\"$idNot\" class=\"btn btn-success\" value=\"Envoyer\"/>
												</form>
										</div></td>";

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

function getStaffCabinetForNotifPasserPatientRDV($Cabinet,$idRDV,$docName,$nomPatient,$prenomPatient,$idPatient){

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                        $reponse = $bdd->query("SELECT * FROM `relstaffcab` WHERE `idCabinet` = '$Cabinet'");

                        $nbrCabinet = $reponse->rowCount();


                        if ($nbrCabinet == 0) {

                        	echo "Aucun Staff enregistré dans ce cabinet";
                        }

                        else{

                        	while ($donnees = $reponse->fetch())
                                    {
                                    	getStaffByIdPasserPatientRDV($donnees['identifiantStaff'],$idRDV,$docName,$nomPatient,$prenomPatient,$idPatient);
                                    }
                        }
                          
                        $reponse->closeCursor();     
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }	

function getStaffByIdPasserPatientRDV($idStaff,$idRDV,$docName,$nomPatient,$prenomPatient,$idPatient){

  global $host_name;
  global $db_user_name;
  global $db_password;
  global $baseGlobale;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                        $reponse = $bdd->query("SELECT * FROM `patient` WHERE `idPatient` = '$idStaff'");
                        
                        $nbr = $reponse->rowCount();

                        if ($nbr > 0) {

                        	while ($donnees = $reponse->fetch())
                                    {
                                     $message = $nomPatient . ' ' . $prenomPatient ."\r\n$idPatient\r\n \r\nDr, $docName";
                                        
                                        echo "  <select name=\"user\" class=\"form-control\">
													<option value=\"$donnees[idPatient]\">$donnees[nomPatient]</option>
												</select>

							                    <input type=\"hidden\" name=\"message\" 	value=\"$message\">
							                    <input type=\"hidden\" name=\"title\" 		value=\"Passer ce patient\">
												<input type=\"hidden\" name=\"ntime\" 		value=\"Now\">
												<input type=\"hidden\" name=\"loops\" 		value=\"1\">
												<input type=\"hidden\" name=\"loop_every\" 	value=\"1\">";
                                    }
                        }
                        $reponse->closeCursor();     
                    }

        catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
        }

function afficheLesRDVDuJourDocOnLigne($idCab,$nomBD,$docName){

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
                          $reponse = $bdd->query("SELECT * FROM rdv WHERE type='1' AND statut <= 2 AND dateRDV = $date order by dateRDV desc, heureRDV asc");
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                         	$idNot = $donnees['id'] . $donnees['idPatient'];
	                        echo "<tr>";

	                            echo "<td> " . $donnees['nomP'] ." ". $donnees['prenoP'] . "</td>";
	                            echo "<td> $donnees[dateRDV] </td>";

	                            echo "<td data-value> $donnees[idPatient] </td>";
	                            echo "<td data-value> $donnees[tel] </td>";
	                            echo "<td data-value> $donnees[medecin] </td>";       

	                            echo "<td data-value=\"1\"> <span class=\"status-metro status-active\" title=\"Active\"> $donnees[heureRDV]</span></td>";

	                            echo   "<td data-value><div class=\"form-group form-inline\">
                                       			<form action=\"notify/notificationPassPatient.php\" id=\"$idNot\" method=\"POST\">";
													getStaffCabinetForNotifPasserPatientRDV($idCab,$donnees['id'],$docName,$donnees['nomP'],$donnees['prenoP'],$donnees['idPatient']);
											echo "
													<input type=\"submit\" form=\"$idNot\" class=\"btn btn-success\" value=\"Envoyer\"/>
												</form>
										</div></td>";

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


function afficheLesRDVDuJourDocAutre($idCab,$nomBD,$docName){

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
                          $reponse = $bdd->query("SELECT * FROM rdv WHERE type='2' AND statut <= 2 AND dateRDV = $date order by dateRDV desc, heureRDV asc");
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                         	$idNot = $donnees['id'] . $donnees['idPatient'];
	                        echo "<tr>";

	                            echo "<td> " . $donnees['nomP'] ." ". $donnees['prenoP'] . "</td>";
	                            echo "<td> $donnees[dateRDV] </td>";

	                            echo "<td data-value> $donnees[idPatient] </td>";
	                            echo "<td data-value> $donnees[tel] </td>";
	                            echo "<td data-value> $donnees[medecin] </td>";       

	                            echo "<td data-value=\"1\"> <span class=\"status-metro status-active\" title=\"Active\"> $donnees[heureRDV]</span></td>";

	                            echo   "<td data-value><div class=\"form-group form-inline\">
                                       			<form action=\"notify/notificationPassPatient.php\" id=\"$idNot\" method=\"POST\">";
													getStaffCabinetForNotifPasserPatientRDV($idCab,$donnees['id'],$docName,$donnees['nomP'],$donnees['prenoP'],$donnees['idPatient']);
											echo "
													<input type=\"submit\" form=\"$idNot\" class=\"btn btn-success\" value=\"Envoyer\"/>
												</form>
										</div></td>";

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


function nbrRDVOnLigne($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                          $date = "'" .date('d/m/Y')."'";
                          $reponse = $bdd->query("SELECT COUNT(id) FROM `rdv` WHERE dateRDV = $date AND type ='1' AND statut <= 2");
                                                  
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

function nbrRDVAutre($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                          $date = "'" .date('d/m/Y')."'";
                          $reponse = $bdd->query("SELECT COUNT(id) FROM `rdv` WHERE dateRDV = $date AND type ='2' AND statut <= 2");
                                                  
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

//************************** 19/09/2020 *****************

	function getAllActifSalle($nomBD,$faiseur,$idCabinet){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                            
                            $reponse = $bdd->query("SELECT `id_salle`,`num_nom_salle`,`etage_salle`,`type_salle` FROM `salle` WHERE `etat_salle` <>'0'");
                                                  
                            $nbr = $reponse->rowCount();

                        	if ($nbr > 0) {


                            while ($donnees = $reponse->fetch())
                                {

                                $num_nom_salle     = $donnees['num_nom_salle'];
                                $etage_salle       = $donnees['etage_salle']; 
                                $type_salle        = $donnees['type_salle'];
                                $id_salle     	   = $donnees['id_salle'];
                                

	                            echo "<tr>";

                                    echo "<td>$num_nom_salle</td>";
                                    echo "<td>$etage_salle</td>";
                                    echo "<td>$type_salle</td>";
                                    echo "<td><button type=\"button\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#".$id_salle."\"> <span class=\"entypo-trash\"></span>&nbsp;&nbsp;Supprimer</button></td>";
                                    echo "<td><button id=".$id_salle." type=\"button\" onclick=\"update_salle(this.id)\" class=\"btn btn-info\"> <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier</button></td>";

                                echo "</tr>";

                                echo "<div class=\"container\">

                                      <div class=\"modal fade\"  id=\"".$id_salle ."\" role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Suppression salle $num_nom_salle</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"overflow-y: auto;\">

											<form action=\"fonctionnalites\mod\suppSalle.php\" class=\"form-container\">
										        <fieldset>

										        	<div class=\"form-group\">

										        	<input type=\"hidden\" name=\"faiseur\" value=\"$faiseur \">

													<input type=\"hidden\" name=\"idSalle\" value=\"$id_salle\">

													<input type=\"hidden\" name=\"idCabinet\" value=\"$idCabinet\">

													<input type=\"hidden\" name=\"nomBD\" value=\"$nomBD\">


                                              <label for=\"examen\"><b>êtes-vous sure de vouloir supprimer cette salle ?</b></label>

                                              <br><br>
                                              <input placeholder=\"Motif suppression...\" type=\"text\" name=\"motifSuppression\" class=\"form-control\">
                   
                          
                                            </div>
                                            
                                              <ul id=\"breadcrumb\">
                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                <button type=\"submit\" style=\"margin-right: 10px;\" class=\"btn btn-warning pull-right\"><span class=\"entypo-trash\"></span>&nbsp;&nbsp;Supprimer</button>

                                                </ul>

	                                            	</div>                                       

	                                            </fieldset>                    
											</form>
                                              
                                          </div>													                 

                                          
                                        </div>
                                      </div>
                                      
                                    </div>";

                                
                                }
                            }

                            else{

                            		echo "<tr>";

                                    echo "<td>aucune salle enregistré</td>";
                                    echo "<td>--</td>";
                                    echo "<td>--</td>";
                                    echo "<td>--</td>";

                                echo "</tr>";
                            }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
		}


		function getAllActifBloc($nomBD,$faiseur,$idCabinet){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                            
                            $reponse = $bdd->query("SELECT `id_bloc`, `num_nom_bloc`, `etage_bloc`, `type_bloc`  FROM `bloc`  WHERE `etat_bloc` <>'0'");

                            $nbrb = $reponse->rowCount();

                        	if ($nbrb > 0) {


                            while ($donnees = $reponse->fetch())
                                {

                                $num_nom_bloc     = $donnees['num_nom_bloc'];
                                $etage_bloc       = $donnees['etage_bloc']; 
                                $type_bloc        = $donnees['type_bloc'];
                                $id_bloc     	   = $donnees['id_bloc'];
                                

	                            echo "<tr>";

                                    echo "<td>$num_nom_bloc</td>";
                                    echo "<td>$etage_bloc</td>";
                                    echo "<td>$type_bloc</td>";
                                    echo "<td><button type=\"button\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#".$id_bloc."\"> <span class=\"entypo-trash\"></span>&nbsp;&nbsp;Supprimer</button></td>";

                                echo "</tr>";

                                 echo "<div class=\"container\">

                                      <div class=\"modal fade\"  id=\"".$id_bloc ."\" role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Suppression bloc $num_nom_bloc</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"overflow-y: auto;\">

											<form action=\"fonctionnalites\mod\suppBloc.php\" class=\"form-container\">
										        <fieldset>

										        	<div class=\"form-group\">

										        	<input type=\"hidden\" name=\"faiseur\" value=\"$faiseur \">

													<input type=\"hidden\" name=\"idBloc\" value=\"$id_bloc\">

													<input type=\"hidden\" name=\"idCabinet\" value=\"$idCabinet\">

													<input type=\"hidden\" name=\"nomBD\" value=\"$nomBD\">


                                              <label for=\"examen\"><b>êtes-vous sure de vouloir supprimer ce bloc ?</b></label>

                                              <br><br>
                                              <input placeholder=\"Motif suppression...\" type=\"text\" name=\"motifSuppression\" class=\"form-control\">
                   
                          
                                            </div>
                                            
                                              <ul id=\"breadcrumb\">
                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                <button type=\"submit\" style=\"margin-right: 10px;\" class=\"btn btn-warning pull-right\"><span class=\"entypo-trash\"></span>&nbsp;&nbsp;Supprimer</button>

                                                </ul>

	                                            	</div>                                       

	                                            </fieldset>                    
											</form>
                                              
                                          </div>													                 

                                          
                                        </div>
                                      </div>
                                      
                                    </div>";

                                
                                }
                            }

                            else{

                            		echo "<tr>";

                                    echo "<td>aucune bloc enregistré</td>";
                                    echo "<td>--</td>";
                                    echo "<td>--</td>";
                                    echo "<td>--</td>";

                                echo "</tr>";
                            }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
		}

	function getAllActifLit($nomBD,$faiseur,$idCabinet){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                            
                            $reponse = $bdd->query("SELECT `id_lit`,`num_lit`,`nature_lit`,`id_emplacement` FROM `lit` WHERE etat_lit <> '0' AND etat_lit <> '3'");

                            $nbrb = $reponse->rowCount();

                        	if ($nbrb > 0) {


                            while ($donnees = $reponse->fetch())
                                {

                                $emplacementID   = $donnees['id_emplacement'];
                                $type_lit        = $donnees['nature_lit'];
                                $num_lit     	 = $donnees['num_lit'];
                                $id_lit     	 = $donnees['id_lit'];

                                $nomSalle = getSalleNameFromId($nomBD,$emplacementID);

                                if ($emplacementID =="" || $emplacementID =="NULL") {
                                	$emplacement = "Lit non affecté";
                                }else{
                                	$emplacement = "Salle: " .  $nomSalle;
                                }
                                

	                            echo "<tr>";

                                    echo "<td>".$num_lit."</td>";
                                    echo "<td>".$type_lit."</td>";
                                    echo "<td>Salle ".$nomSalle."</td>";
                                    echo "<td><button type=\"button\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#".$id_lit."\"> <span class=\"entypo-trash\"></span>&nbsp;&nbsp;Supprimer</button></td>";
                                    echo "<td><button id=".$id_lit." type=\"button\" onclick=\"update_lit(this.id)\" class=\"btn btn-info\"> <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier</button></td>";

                                echo "</tr>";

                                 echo "<div class=\"container\">

                                      <div class=\"modal fade\"  id=\"".$id_lit ."\" role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Suppression lit $num_lit</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"overflow-y: auto;\">

											<form action=\"fonctionnalites\mod\suppLit.php\" class=\"form-container\">
										        <fieldset>

										        	<div class=\"form-group\">

										        	<input type=\"hidden\" name=\"faiseur\" value=\"$faiseur \">

													<input type=\"hidden\" name=\"idLit\" value=\"$id_lit\">

													<input type=\"hidden\" name=\"idCabinet\" value=\"$idCabinet\">

													<input type=\"hidden\" name=\"nomBD\" value=\"$nomBD\">


                                              <label for=\"examen\"><b>êtes-vous sure de vouloir supprimer ce lit ?</b></label>


                                              <br><br>
                                              <input placeholder=\"Motif suppression...\" type=\"text\" name=\"motifSuppression\" class=\"form-control\">
                                              
                   
                          
                                            </div>
                                            
                                              <ul id=\"breadcrumb\">
                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                <button type=\"submit\" style=\"margin-right: 10px;\" class=\"btn btn-warning pull-right\"><span class=\"entypo-trash\"></span>&nbsp;&nbsp;Supprimer</button>

                                                </ul>

	                                            	</div>                                       

	                                            </fieldset>                    
											</form>
                                              
                                          </div>													                 

                                          
                                        </div>
                                      </div>
                                      
                                    </div>";

                                
                                }
                            }

                            else{

                            		echo "<tr>";

                                    echo "<td>aucune lit enregistré</td>";
                                    echo "<td>--</td>";
                                    echo "<td>--</td>";
                                    echo "<td>--</td>";

                                echo "</tr>";
                            }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
		}


	function getAvailableSalleForOption($nomBD){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

				try
                    {
                                                    
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                            
                        $reponse = $bdd->query("SELECT id_salle,num_nom_salle FROM `salle` WHERE etat_salle <> '0'");

                        $nbrb = $reponse->rowCount();

                        if ($nbrb > 0) {

                            while ($donnees = $reponse->fetch())
                                {
	                                echo "<option value=\"$donnees[id_salle]\">$donnees[num_nom_salle]</option>";
                                }
                        }

                        $reponse->closeCursor();
                    }

                catch(Exception $e)
                    {
                        die('Erreur : '.$e->getMessage());
                    }  
		}

	function getAvailableBlocForOption($nomBD){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

				try
                    {
                                                    
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                            
                        $reponse = $bdd->query("SELECT id_bloc,num_nom_bloc FROM `bloc` WHERE etat_bloc <> '0'");

                        $nbrb = $reponse->rowCount();

                        if ($nbrb > 0) {

                            while ($donnees = $reponse->fetch())
                                {
	                                echo "<option value=\"$donnees[id_bloc]\">$donnees[num_nom_bloc]</option>";
                                }
                        }

                        $reponse->closeCursor();
                    }

                catch(Exception $e)
                    {
                        die('Erreur : '.$e->getMessage());
                    }  
		}	

	function getSalleNameFromId($nomBD,$idSalle){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

				try
                    {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                            
                        $reponse = $bdd->query("SELECT num_nom_salle FROM `salle` WHERE id_salle = '$idSalle'");

                        $nbrb = $reponse->rowCount();

                            while ($donnees = $reponse->fetch())
                                {
	                                $nomSalle = $donnees['num_nom_salle'];

	                                return $nomSalle; 
                                }

                        $reponse->closeCursor();
                    }

                catch(Exception $e)
                    {
                        die('Erreur : '.$e->getMessage());
                    }  
		}

	function getLitNumFromId($nomBD,$idLit){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

				try
                    {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                            
                        $reponse = $bdd->query("SELECT `num_lit`,`nature_lit` FROM `lit` WHERE id_lit = '$idLit'");

                        $nbrl = $reponse->rowCount();
                        if ($nbrl > 0) {
                        	
                        	while ($donnees = $reponse->fetch())
                                {
	                                $nomSalle = 'Lit ' . $donnees['nature_lit'] . ', numéro:'. $donnees['num_lit'];

	                                return $nomSalle; 
                                }
                        }
                            

                        $reponse->closeCursor();
                    }

                catch(Exception $e)
                    {
                        die('Erreur : '.$e->getMessage());
                    }  
		}	

	function getBlocNameFromId($nomBD,$idBloc){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

				try
                    {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                            
                        $reponse = $bdd->query("SELECT num_nom_bloc FROM `bloc` WHERE id_bloc = '$idBloc'");

                        $nbrb = $reponse->rowCount();

                            while ($donnees = $reponse->fetch())
                                {
	                                $nomBloc = $donnees['num_nom_bloc'];

	                                return $nomBloc;
                                }

                        $reponse->closeCursor();
                    }

                catch(Exception $e)
                    {
                        die('Erreur : '.$e->getMessage());
                    }  
		}


	function getSalleOrBlocName($nomBD,$idSalle){

			$name = getSalleNameFromId($nomBD,$idSalle);
			return $name;
		}


	function getAllMateriel($nomBD,$faiseur,$idCabinet){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                            
                            $reponse = $bdd->query("SELECT * FROM `materiel`  WHERE etatMateriel <> '0' AND etatMateriel <> '3'");

                            $nbrb = $reponse->rowCount();

                        	if ($nbrb > 0) {


                            while ($donnees = $reponse->fetch())
                                {

                                $num_serieMat     = $donnees['numeroSerie'];
                                $etatMateriel     = $donnees['etatMateriel']; 
                                $nomMateriel      = $donnees['nom'];
                                $id_Materiel      = $donnees['idMateriel'];
                                
                                $emplacement    = getRelationMatSLP($nomBD,$id_Materiel); 

	                            echo "<tr>";

                                    echo "<td>$nomMateriel</td>";
                                    echo "<td>$num_serieMat</td>";
                                    echo "<td>$emplacement</td>";
                                    echo "<td><button type=\"button\" class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#".$id_Materiel."\"> <span class=\"entypo-trash\"></span>&nbsp;&nbsp;Supprimer</button></td>";
                                    echo "<td><button id=".$id_Materiel." type=\"button\" onclick=\"update_materiel(this.id)\" class=\"btn btn-info\"> <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier</button></td>";

                                echo "</tr>";

                                 echo "<div class=\"container\">

                                      <div class=\"modal fade\"  id=\"".$id_Materiel ."\" role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Suppression Matériel $nomMateriel '$num_serieMat'</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"overflow-y: auto;\">

											<form action=\"fonctionnalites\mod\suppMateriel.php\" class=\"form-container\">
										        <fieldset>

										        	<div class=\"form-group\">

										        	<input type=\"hidden\" name=\"faiseur\" value=\"$faiseur \">

													<input type=\"hidden\" name=\"idMateriel\" value=\"$id_Materiel\">

													<input type=\"hidden\" name=\"idCabinet\" value=\"$idCabinet\">

													<input type=\"hidden\" name=\"nomBD\" value=\"$nomBD\">


                                              <label for=\"examen\"><b>êtes-vous sure de vouloir supprimer ce matériel ?</b></label>

                                              <br><br>
                                              <input placeholder=\"Motif suppression...\" type=\"text\" name=\"motifSuppression\" class=\"form-control\">
                   
                          
                                            </div>
                                            
                                              <ul id=\"breadcrumb\">
                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                <button type=\"submit\" style=\"margin-right: 10px;\" class=\"btn btn-warning pull-right\"><span class=\"entypo-trash\"></span>&nbsp;&nbsp;Supprimer</button>

                                                </ul>

	                                            	</div>                                       

	                                            </fieldset>                    
											</form>
                                              
                                          </div>													                 

                                          
                                        </div>
                                      </div>
                                      
                                    </div>";

                                
                                }
                            }

                            else{

                            		echo "<tr>";

                                    echo "<td>Aucune Matériel enregistré</td>";
                                    echo "<td>--</td>";
                                    echo "<td>--</td>";
                                    echo "<td>--</td>";
                                    echo "<td>--</td>";

                                echo "</tr>";
                            }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
		}

	
	function getAvailableLitForOption($nomBD){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

				try
                    {
                                                    
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                            
                        $reponse = $bdd->query("SELECT `id_lit`,`num_lit`,`nature_lit` FROM `lit` WHERE etat_lit <> '0' AND etat_lit <> '3'");

                        $nbrb = $reponse->rowCount();

                        if ($nbrb > 0) {

                            while ($donnees = $reponse->fetch())
                                {
	                                echo "<option value=\"$donnees[id_lit]\">- Lit $donnees[nature_lit], numéro : $donnees[num_lit]</option>";
                                }
                        }

                        $reponse->closeCursor();
                    }

                catch(Exception $e)
                    {
                        die('Erreur : '.$e->getMessage());
                    }  
		}

	function getRelationMatSLP($nomBD,$idMateriel){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

				try
                    {
                                                    
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                            
                        $reponse = $bdd->query("SELECT `idMateriel`,`idSLP`,`type` FROM `relation_materiel_slp` WHERE `idMateriel` = '$idMateriel'");

                        $nbrb = $reponse->rowCount();

                        if ($nbrb > 0) {

                            while ($donnees = $reponse->fetch())
                                {
                                	switch ($donnees['type']) {
                                		case 'S':
                                				$salle = getSalleNameFromId($nomBD,$donnees['idSLP']);
                                				$rep   = "salle " . $salle;
                                				return $rep;
                                			break;

                                		case 'L':
                                				$lit = getLitNumFromId($nomBD,$donnees['idSLP']);
                                				return $lit;
                                			break;

                                		case 'P':
                                			# code...
                                			break;	
                                	}
                                	
                                }
                        }else{
                        	return "Non affecté";
                        }

                        $reponse->closeCursor();
                    }

                catch(Exception $e)
                    {
                        die('Erreur : '.$e->getMessage());
                    }  
		}


	function updateRelationSLP($nomBD,$idMateriel,$idSLP,$type){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

			$con = mysqli_connect($host_name,$db_user_name,$db_password,$nomB);

			if ($con->connect_error) {
			    die("Connection failed: " . $con->connect_error);
			}

			$sql = "UPDATE `relation_materiel_slp` SET `idSLP`='$idSLP',`type`='$type' WHERE `idMateriel` ='$idMateriel'";

			if ($con->query($sql) === TRUE) {
			    
			} else {
			    echo "Error updating record: " . $con->error;
			}  
		}


	function addRelationSLP($nomBD,$idMateriel){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);
		
			try
                {
                                                    
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  
 
                    $reponse = $bdd->query("INSERT INTO `relation_materiel_slp`(`idMateriel`) VALUES ('$idMateriel')");   
                    //$id_lit = $bdd->lastInsertId();

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
		}	


function nbrPatientCabinet(){
			
	global $host_name;
	global $db_user_name;
	global $db_password;
	global $baseGlobale;

			try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT `idPatient` FROM `patient`");
                            
                        $nbr = $reponse->rowCount();
                                               
                        echo $nbr;

                        $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                } 
		}				

/*function getRDVForAgenda($nomBD,$idMedecin){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	$oldDate    = date("Y-m-d");
	$oldDate    = strtotime("-1 Months");
	$oldDate    = date('Y-m-d', $oldDate);
			try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT * FROM `rdv` WHERE `statut`<> 4 AND `idMedecin`='$idMedecin' AND dateRDV >= '$oldDate'");
                            
                        $nbr = $reponse->rowCount();

                        $ceMois = date('Y-m');

                        $dureeRDVCab = dureeParSeance($nomBD);

                        $iterat = "";
                        $LesRDV = "[";
                        
                        if ($nbr > 0) {

                        	while ($donnees = $reponse->fetch())
                                {
                                	$idRDV     = $donnees['id'];
                                	$jour      = $donnees['dateRDV'];
		                        	$heure     = $donnees['heureRDV'];
		                        	$motif     = $donnees['motifCons'];
		                        	$medecin   = $donnees['medecin'];
		                        	$patient   = $donnees['nomP'] . "_" . $donnees['prenoP'];
		                        	$idPatient = $donnees['idPatient'];

		                        	$jour    = str_replace("/","-",$jour);
		                        	$jour    = strtotime($jour);
		                        	$jour    = date('Y-m-d', $jour);
		                        	$endTime = strtotime("+".$dureeRDVCab." minutes", strtotime($heure));

		                        	$statut  = $donnees['statut'];

		                        	switch ($statut) {
		                        		case '6':
		                        			$iterat = "{
						                        title: '".$patient."',
						                        start: '".$jour."' + 'T".$heure."',
						                        end: '".$jour."' + 'T".$endTime."',
						                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br>Id Patient: ".$idPatient."',
						                        color: '#A8BDCF',
						                    },";
		                        			break;
		                        		case '0':
		                        			$iterat = "{
						                        title: '".$patient."',
						                        start: '".$jour."' + 'T".$heure."',
						                        end: '".$jour."' + 'T".$endTime."',
						                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br> Id Patient: ".$idPatient."',
						                        color: '#FF6B6B',
						                    },";
		                        			break;
		                        		case '1':
		                        			$iterat = "{
						                        title: '".$patient."',
						                        start: '".$jour."' + 'T".$heure."',
						                        end: '".$jour."' + 'T".$endTime."',
						                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br> Id Patient: ".$idPatient."',
						                        color: '#65C3DF',
						                    },";
		                        			break;
		                        		case '2':
		                        			$iterat = "{
						                        title: '".$patient."',
						                        start: '".$jour."' + 'T".$heure."',
						                        end: '".$jour."' + 'T".$endTime."',
						                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br> Id Patient: ".$idPatient."',
						                        color: '#FFA200',
						                    },";
		                        			break;
		                        		case '3':
		                        			$iterat = "{
						                        title: '".$patient."',
						                        start: '".$jour."' + 'T".$heure."',
						                        end: '".$jour."' + 'T".$endTime."',
						                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br> Id Patient: ".$idPatient."',
						                        color: '#45B6B0',
						                    },";
		                        			break;
		                        		case '5':
		                        			$iterat = "{
						                        title: '".$patient."',
						                        start: '".$jour."' + 'T".$heure."',
						                        end: '".$jour."' + 'T".$endTime."',
						                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br> Id Patient: ".$idPatient."',
						                        color: '#337ab7',
						                    },";
		                        	}
		                        	
		                        	$LesRDV .= $iterat;
                                }

                        }else{
                        	
                        	$iterat = "{
		                        title: 'Aucun Rendez-vous programmé !',
		                        start: '".$ceMois."' + '-01',
		                        color: '#A8BDCF',
		                        className: \"fc-event-danger fc-event-solid-warning\"
		                    },";

		                    $LesRDV .= $iterat;
                        }
                        

                        $reponse->closeCursor();

                        $LesRDV = substr($LesRDV, 0, -1); 

                        $LesRDV .= "]";

                        return $LesRDV;
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                } 
}*/


function getRDVForAgenda($nomBD,$idMedecin){
                        
    global $host_name;
    global $db_user_name;
    global $db_password;

    $nomB       = crypterNomDeLaBase($nomBD);

    $oldDate    = date("Y-m-d");
    $oldDate    = strtotime("-1 Months");
    $oldDate    = date('Y-m-d', $oldDate);
            try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT * FROM `rdv` WHERE `statut`<> 4 AND `idMedecin`='$idMedecin' AND dateRDV >= '$oldDate'");
                            
                        $nbr = $reponse->rowCount();

                        $ceMois = date('Y-m');

                        $dureeRDVCab = dureeParSeance($nomBD);

                        $iterat = "";
                        $LesRDV = "[";

                        $signalisationPatient = "";

                        $nonConfirmedColor = "#A8BDCF";
                        
                        if ($nbr > 0) {

                                while ($donnees = $reponse->fetch())
                                {
                                        $idRDV     = $donnees['id'];
                                        $jour      = $donnees['dateRDV'];
                                                $heure     = $donnees['heureRDV'];
                                                $motif     = $donnees['motifCons'];
                                                $medecin   = $donnees['medecin'];
                                                $patient   = $donnees['nomP'] . "_" . $donnees['prenoP'];
                                                $idPatient = $donnees['idPatient'];

                                                $patient_a_risque = $donnees['patient_a_risque'];
                                                $motif_risque = $donnees['motif_risque'];

                                                if ($patient_a_risque =="1") {
                                                        $nonConfirmedColor = "#000000";
                                                        $signalisationPatient = "risque";
                                                }else{
                                                        $nonConfirmedColor = "#A8BDCF";
                                                        $signalisationPatient = "non_risque";
                                                }

                                                $jour    = str_replace("/","-",$jour);
                                                $jour    = strtotime($jour);
                                                $jour    = date('Y-m-d', $jour);
                                                $endTime = strtotime("+".$dureeRDVCab." minutes", strtotime($heure));

                                                $statut  = $donnees['statut'];



                                                switch ($statut) {
                                                        case '6':
                                                                $iterat = "{
                                                                        title: '".$patient."',
                                                                        start: '".$jour."' + 'T".$heure."',
                                                                        end: '".$jour."' + 'T".$endTime."',
                                                                        filtre: '".$signalisationPatient."',
                                                                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br>Id Patient: ".$idPatient."',
                                                                        color: '".$nonConfirmedColor."',
                                                                        profile:'patient'
                                                                    },";
                                                                break;
                                                        case '0':
                                                                $iterat = "{
                                                                        title: '".$patient."',
                                                                        start: '".$jour."' + 'T".$heure."',
                                                                        end: '".$jour."' + 'T".$endTime."',
                                                                        filtre: '".$signalisationPatient."',
                                                                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br> Id Patient: ".$idPatient."',
                                                                        color: '#FF6B6B',
                                                                    },";
                                                                break;
                                                        case '1':
                                                                $iterat = "{
                                                                        title: '".$patient."',
                                                                        start: '".$jour."' + 'T".$heure."',
                                                                        end: '".$jour."' + 'T".$endTime."',
                                                                        filtre: '".$signalisationPatient."',
                                                                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br> Id Patient: ".$idPatient."',
                                                                        color: '#65C3DF',
                                                                    },";
                                                                break;
                                                        case '2':
                                                                $iterat = "{
                                                                        title: '".$patient."',
                                                                        start: '".$jour."' + 'T".$heure."',
                                                                        end: '".$jour."' + 'T".$endTime."',
                                                                        filtre: '".$signalisationPatient."',
                                                                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br> Id Patient: ".$idPatient."',
                                                                        color: '#FFA200',
                                                                    },";
                                                                break;
                                                        case '3':
                                                                $iterat = "{
                                                                        title: '".$patient."',
                                                                        start: '".$jour."' + 'T".$heure."',
                                                                        end: '".$jour."' + 'T".$endTime."',
                                                                        filtre: '".$signalisationPatient."',
                                                                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br> Id Patient: ".$idPatient."',
                                                                        color: '#45B6B0',
                                                                    },";
                                                                break;
                                                        case '5':
                                                                $iterat = "{
                                                                        title: '".$patient."',
                                                                        start: '".$jour."' + 'T".$heure."',
                                                                        end: '".$jour."' + 'T".$endTime."',
                                                                        filtre: '".$signalisationPatient."',
                                                                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br> Id Patient: ".$idPatient."',
                                                                        color: '#337ab7',
                                                                    },";
                                                }
                                                
                                                $LesRDV .= $iterat;
                                }

                        }else{
                                
                                $iterat = "{
                                        title: 'Aucun Rendez-vous programmé !',
                                        start: '".$ceMois."' + '-01',
                                        color: '#A8BDCF',
                                        className: \"fc-event-danger fc-event-solid-warning\"
                                    },";

                                    $LesRDV .= $iterat;
                        }
                        

                        $reponse->closeCursor();

                        $LesRDV = substr($LesRDV, 0, -1); 

                        $LesRDV .= "]";

                        return $LesRDV;
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                } 
}


function updateRDVStats($nomBD,$idRDV){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

			try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT `statut` FROM `rdv` WHERE id='$idRDV'");
                            
                        $nbr = $reponse->rowCount();
                        
                        if ($nbr > 0) {

                        	while ($donnees = $reponse->fetch())
                                {
                                	$stats    = $donnees['statut'];

                                	switch ($stats) {
                                		case '0':
                                				echo "<select class=\"btn btn-default\" name=\"etatRDV\" id=\"etatRDV\">
													    <option value=\"0\">Absent</option>
													    <option value=\"1\">Présent</option>
													    <option value=\"2\">En salle</option>
													    <option value=\"3\">Terminé</option>
													</select>
					                            	<button type=\"button\" class=\"btn btn-default\" onclick=\"updateRDVForPresence()\">
					                                    <span class=\"entypo-check\"></span>&nbsp;&nbsp;Confirmer</button>";
                                			break;
                                		case '1':
                                				echo "<select class=\"btn btn-info\" name=\"etatRDV\" id=\"etatRDV\">
													    <option value=\"0\">Absent</option>
													    <option value=\"1\">Présent</option>
													    <option value=\"2\">En salle</option>
													    <option value=\"3\">Terminé</option>
													</select>
					                            	<button type=\"button\" class=\"btn btn-info\" onclick=\"updateRDVForPresence()\">
					                                    <span class=\"entypo-check\"></span>&nbsp;&nbsp;Confirmer</button>";
                                			# code...
                                			break;
                                		case '2':
                                				echo "<select class=\"btn btn-warning\" name=\"etatRDV\" id=\"etatRDV\">
													    <option value=\"0\">Absent</option>
													    <option value=\"1\">Présent</option>
													    <option value=\"2\">En salle</option>
													    <option value=\"3\">Terminé</option>
													</select>
					                            	<button type=\"button\" class=\"btn btn-warning\" onclick=\"updateRDVForPresence()\">
					                                    <span class=\"entypo-check\"></span>&nbsp;&nbsp;Confirmer</button>";
                                			# code...
                                			break;
                                		case '3':
                                				echo "<select class=\"btn btn-success\" name=\"etatRDV\" id=\"etatRDV\">
													    <option value=\"0\">Absent</option>
													    <option value=\"1\">Présent</option>
													    <option value=\"2\">En salle</option>
													    <option value=\"3\">Terminé</option>
													</select>
					                            	<button type=\"button\" class=\"btn btn-success\" onclick=\"updateRDVForPresence()\">
					                                    <span class=\"entypo-check\"></span>&nbsp;&nbsp;Confirmer</button>";
                                			# code...
                                			break;			
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

function getRDVForAgendaParPatient($nomBD,$idPatient,$idMedecin){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

			try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT * FROM `rdv` WHERE idPatient='$idPatient' AND `statut`<> 4 AND `idMedecin`='$idMedecin'");
                            
                        $nbr = $reponse->rowCount();

                        $ceMois = date('Y-m');

                        $dureeRDVCab = dureeParSeance($nomBD);

                        $iterat = "";
                        $LesRDV = "[";
                        
                        if ($nbr > 0) {

                        	while ($donnees = $reponse->fetch())
                                {
                                	$idRDV   = $donnees['id'];
                                	$jour    = $donnees['dateRDV'];
		                        	$heure   = $donnees['heureRDV'];
		                        	$motif   = $donnees['motifCons'];
		                        	$medecin = $donnees['medecin'];
		                        	$patient = $donnees['nomP'] . " " . $donnees['prenoP'];

		                        	$jour    = str_replace("/","-",$jour);
		                        	$jour    = strtotime($jour);
		                        	$jour    = date('Y-m-d', $jour);
		                        	$endTime = strtotime("+".$dureeRDVCab." minutes", strtotime($heure));

		                        	$statut  = $donnees['statut'];

		                        	switch ($statut) {
		                        		case '6':
		                        			$iterat = "{
						                        title: '".$patient."',
						                        start: '".$jour."' + 'T".$heure."',
						                        end: '".$jour."' + 'T".$endTime."',
						                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$nomB.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."',
						                        color: '#A8BDCF',
						                    },";
		                        			break;
		                        		case '0':
		                        			$iterat = "{
						                        title: '".$patient."',
						                        start: '".$jour."' + 'T".$heure."',
						                        end: '".$jour."' + 'T".$endTime."',
						                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$nomB.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."',
						                        color: '#FF6B6B',
						                    },";
		                        			break;
		                        		case '1':
		                        			$iterat = "{
						                        title: '".$patient."',
						                        start: '".$jour."' + 'T".$heure."',
						                        end: '".$jour."' + 'T".$endTime."',
						                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$nomB.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."',
						                        color: '#65C3DF',
						                    },";
		                        			break;
		                        		case '2':
		                        			$iterat = "{
						                        title: '".$patient."',
						                        start: '".$jour."' + 'T".$heure."',
						                        end: '".$jour."' + 'T".$endTime."',
						                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$nomB.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."',
						                        color: '#FFA200',
						                    },";
		                        			break;
		                        		case '3':
		                        			$iterat = "{
						                        title: '".$patient."',
						                        start: '".$jour."' + 'T".$heure."',
						                        end: '".$jour."' + 'T".$endTime."',
						                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$nomB.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."',
						                        color: '#45B6B0',
						                    },";
		                        			break;
		                        		case '5':
		                        			$iterat = "{
						                        title: '".$patient."',
						                        start: '".$jour."' + 'T".$heure."',
						                        end: '".$jour."' + 'T".$endTime."',
						                        description: '".$idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$nomB.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."',
						                        color: '#337ab7',
						                    },";
		                        	}
		                        	
		                        	$LesRDV .= $iterat;
                                }

                        }else{
                        	
                        	$iterat = "{
		                        title: 'Aucun Rendez-vous programé !',
		                        start: '".$ceMois."' + '-01',
		                        color: '#A8BDCF'
		                    },";

		                    $LesRDV .= $iterat;
                        }
                        

                        $reponse->closeCursor();

                        $LesRDV = substr($LesRDV, 0, -1); 

                        $LesRDV .= "]";

                        return $LesRDV;
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                } 
		}
function getOuvrablesJours($nomBD){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

			try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT * FROM `jours_ouvrables`");
                            
                        $nbr = $reponse->rowCount();
                        
                        if ($nbr > 0) {

                        	while ($donnees = $reponse->fetch())
                                {
                                	$jour     = $donnees['jour'];
                                	$decis    = $donnees['decision'];

                                	switch ($jour) {
                                		case 'samedi':
                                			echo "<tr>
	                                                <td>Samedi</td>
	                                                <input type=\"hidden\" name=\"samedi\" value=\"samedi\">
	                                                <td>&nbsp;Ouvrable&nbsp;&nbsp;";
	                                			if ($decis == "0") {
			                                			echo "<input type=\"checkbox\" name=\"d_samedi\" value=\"ouvrable\" checked>";
			                                	}else{
			                                			echo "<input type=\"checkbox\" name=\"d_samedi\" value=\"ouvrable\">";
			                                	}
			                                	echo "</td>
	                                            </tr>";
                                			break;
                                		case 'dimanche':
                                			echo "<tr>
	                                                <td>Dimanche</td>
	                                                <input type=\"hidden\" name=\"dimanche\" value=\"dimanche\">
	                                                <td>&nbsp;Ouvrable&nbsp;&nbsp;";
	                                			if ($decis == "0") {
			                                			echo "<input type=\"checkbox\" name=\"d_dimanche\" value=\"ouvrable\" checked>";
			                                	}else{
			                                			echo "<input type=\"checkbox\" name=\"d_dimanche\" value=\"ouvrable\">";
			                                	}
			                                	echo "</td>
	                                            </tr>";
                                			break;
                                		case 'lundi':
                                			echo "<tr>
	                                                <td>Lundi</td>
	                                                <input type=\"hidden\" name=\"lundi\" value=\"lundi\">
	                                                <td>&nbsp;Ouvrable&nbsp;&nbsp;";
	                                			if ($decis == "0") {
			                                			echo "<input type=\"checkbox\" name=\"d_lundi\" value=\"ouvrable\" checked>";
			                                	}else{
			                                			echo "<input type=\"checkbox\" name=\"d_lundi\" value=\"ouvrable\">";
			                                	}
			                                	echo "</td>
	                                            </tr>";
                                			break;
                                		case 'mardi':
                                			echo "<tr>
	                                                <td>Mardi</td>
	                                                <input type=\"hidden\" name=\"mardi\" value=\"mardi\">
	                                                <td>&nbsp;Ouvrable&nbsp;&nbsp;";
	                                			if ($decis == "0") {
			                                			echo "<input type=\"checkbox\" name=\"d_mardi\" value=\"ouvrable\" checked>";
			                                	}else{
			                                			echo "<input type=\"checkbox\" name=\"d_mardi\" value=\"ouvrable\">";
			                                	}
			                                	echo "</td>
	                                            </tr>";
                                			break;
                                		case 'mercredi':
                                			echo "<tr>
	                                                <td>Mercredi</td>
	                                                <input type=\"hidden\" name=\"mercredi\" value=\"mercredi\">
	                                                <td>&nbsp;Ouvrable&nbsp;&nbsp;";
	                                			if ($decis == "0") {
			                                			echo "<input type=\"checkbox\" name=\"d_mercredi\" value=\"ouvrable\" checked>";
			                                	}else{
			                                			echo "<input type=\"checkbox\" name=\"d_mercredi\" value=\"ouvrable\">";
			                                	}
			                                	echo "</td>
	                                            </tr>";
                                			break;
                                		case 'jeudi':
                                			echo "<tr>
	                                                <td>Jeudi</td>
	                                                <input type=\"hidden\" name=\"jeudi\" value=\"jeudi\">
	                                                <td>&nbsp;Ouvrable&nbsp;&nbsp;";
	                                			if ($decis == "0") {
			                                			echo "<input type=\"checkbox\" name=\"d_jeudi\" value=\"ouvrable\" checked>";
			                                	}else{
			                                			echo "<input type=\"checkbox\" name=\"d_jeudi\" value=\"ouvrable\">";
			                                	}
			                                	echo "</td>
	                                            </tr>";
                                			break;
                                		case 'vendredi':
                                			echo "<tr>
	                                                <td>Vendredi</td>
	                                                <input type=\"hidden\" name=\"vendredi\" value=\"vendredi\">
	                                                <td>&nbsp;Ouvrable&nbsp;&nbsp;";
	                                			if ($decis == "0") {
			                                			echo "<input type=\"checkbox\" name=\"d_vendredi\" value=\"ouvrable\" checked>";
			                                	}else{
			                                			echo "<input type=\"checkbox\" name=\"d_vendredi\" value=\"ouvrable\">";
			                                	}
			                                	echo "</td>
	                                            </tr>";
                                			break;
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

function getPatientComptePourPrgrm($nomBD,$idUser){

  global $host_name;
  global $db_user_name;
  global $db_password;

  $nomB 	    = crypterNomDeLaBase($nomBD);

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT * FROM `patient` WHERE `idPatient` = '$idUser'");

                          while ($donnees = $reponse->fetch())
                                     {
                                        
                                        	if ($donnees['sexePatient'] == "Homme") {
                                        		echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                        	}
                                        	elseif ($donnees['sexePatient'] == "Femme") {
                                        		echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
                                        	}

                                        	echo "<h3 style=\"margin-top: 3px;\">". $donnees['nomPatient'] . " " . $donnees['prenomPatient'] ."</h3>

                                                    <dl class=\"dl-horizontal-profile\">

							                            <dt>Téléphone</dt>
							                            <dd>
							                            	$donnees[numTelPatient]
							                            </dd>

							                            <dt>Adresse</dt>
							                            <dd>
							                            	$donnees[adressePatient]
							                            </dd>

							                            <dt>Autres</dt>
							                            <dd>$donnees[sexePatient] / $donnees[groupagePatient]</dd>

							                        </dl>";

                                      }
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }

    function insertPrigramPatient($nomBD,$idPatient,$typeSeance){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);
		
			try
                {
                                                    
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  
 
                    $reponse = $bdd->query("INSERT INTO `programme_patient`(`idPatient`, `type_seance`) VALUES ('$idPatient','$typeSeance')");   
                    //$id_lit = $bdd->lastInsertId();

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
		} 

function getTableauDesProgrammes($nomBD,$idPatient,$doctor){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

			try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT * FROM `programme_patient` WHERE idPatient='$idPatient'");
                            
                        $nbr = $reponse->rowCount();
                        
                        if ($nbr > 0) {

                        	$i = 1;

                        	while ($donnees = $reponse->fetch())
                                {
                                	$idPatient  = $donnees['idPatient'];
                                	$typeSeance = $donnees['type_seance'];
                                	$statut     = $donnees['statut'];

                                	switch ($statut) {
                                		case '0':
                                			echo "<tr>
	                                                <td>$i</td>
	                                                <td>Séance $typeSeance</td>
	                                                <td>&nbsp;Non programmé&nbsp;&nbsp;</td>
	                                                <td>&nbsp;-&nbsp;&nbsp;</td>
	                                            </tr>";
                                			break;
                                		case '1':
                                			echo "<tr>
	                                                <td>$i</td>
	                                                <td>Séance $typeSeance</td>
	                                                <td>&nbsp;Programmé&nbsp;&nbsp;</td>
	                                                <td>&nbsp;-&nbsp;&nbsp;</td>
	                                            </tr>";
                                			break;
                                		case '2':
                                			echo "<tr>	                                                
                                					<td>$i</td>
	                                                <td>Séance $typeSeance</td>
	                                                <td>&nbsp;Terminé&nbsp;&nbsp;</td>
	                                                <td>&nbsp;-&nbsp;&nbsp;</td>	                                                
	                                            </tr>";
                                			break;		
                                	}

                                	$i = $i + 1;
                                }

                        }
                        

                        $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                } 
		}

function getTableauDesRDVs($nomBD,$idPatient,$doctor){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

			try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT * FROM `rdv`,`rel_seance_rdv`,`seance` WHERE rdv.idPatient='$idPatient' AND rdv.id = rel_seance_rdv.id AND rel_seance_rdv.id_seance = seance.id_seance ORDER BY rdv.dateRDV");
                        $nbr = $reponse->rowCount();
                        
                        if ($nbr > 0) {

                        	$i = 1;

                        	while ($donnees = $reponse->fetch())
                                {
                                	$idPatient  = $donnees['idPatient'];
                                	$typeSeance = $donnees['type_seance'];
                                	$motifs     = $donnees['motifCons'];
                                	$statut     = $donnees['statut'];
                                	$date       = $donnees['dateRDV'];
                                	$heure      = $donnees['heureRDV'];

                                	switch ($statut) {
                                		case '0':
                                			echo "<tr>
	                                                <td>$i</td>
	                                                <td>Séance $typeSeance</td>
	                                                <td>&nbsp; $motifs</td>
	                                                <td>&nbsp;Absent&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$date&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$heure&nbsp;&nbsp;</td>
	                                            </tr>";
                                			break;
                                		case '1':
                                			echo "<tr>
	                                                <td>$i</td>
	                                                <td>Séance $typeSeance</td>
	                                                <td>&nbsp; $motifs</td>
	                                                <td>&nbsp;Présent&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$date&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$heure&nbsp;&nbsp;</td>
	                                            </tr>";
                                			break;
                                		case '2':
                                			echo "<tr>	                                                
                                					<td>$i</td>
	                                                <td>Séance $typeSeance</td>
	                                                <td>&nbsp; $motifs</td>
	                                                <td>&nbsp;En Salle&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$date&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$heure&nbsp;&nbsp;</td>	                                                
	                                            </tr>";
                                			break;		

                                		case '3':
                                			echo "<tr>
	                                                <td>$i</td>
	                                                <td>Séance $typeSeance</td>
	                                                <td>&nbsp; $motifs</td>
	                                                <td>&nbsp;Terminée&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$date&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$heure&nbsp;&nbsp;</td>
	                                            </tr>";
                                			break;
                                		case '4':
                                			echo "<tr>
	                                                <td>$i</td>
	                                                <td>Séance $typeSeance</td>
	                                                <td>&nbsp; $motifs</td>
	                                                <td>&nbsp;Annulée&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$date&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$heure&nbsp;&nbsp;</td>
	                                            </tr>";
                                			break;
                                		case '5':
                                			echo "<tr>	                                                
                                					<td>$i</td>
	                                                <td>Séance $typeSeance</td>
	                                                <td>&nbsp; $motifs</td>
	                                                <td>&nbsp;Confirmé&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$date&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$heure&nbsp;&nbsp;</td>	                                                
	                                            </tr>";
                                			break;
                                		case '6':
                                			echo "<tr>	                                                
                                					<td>$i</td>
	                                                <td>Séance $typeSeance</td>
	                                                <td>&nbsp; $motifs</td>
	                                                <td>&nbsp;Non confirmé&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$date&nbsp;&nbsp;</td>
	                                                <td>&nbsp;$heure&nbsp;&nbsp;</td>                                                
	                                            </tr>";
                                			break;	
                                	}

                                	$i = $i + 1;
                                }

                        }
                        

                        $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                } 
		}


function nbrSeancePrograme($nomBD,$idPatient){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                          $date = "'" .date('Y-m-d')."'";
                          $reponse = $bdd->query("SELECT COUNT(id_relation) FROM `rdv`,`rel_seance_rdv` WHERE rdv.id=rel_seance_rdv.id AND rdv.idPatient='$idPatient'");

                          $nbr = "0";
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                            $nbr =  $donnees[0];
						}
						
                        $reponse->closeCursor();

                        return $nbr;
                    }
 
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
						 
				}

function nbrSeanceProgrameTerminee($nomBD,$idPatient){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                          $date = "'" .date('Y-m-d')."'";
                          $reponse = $bdd->query("SELECT COUNT(id_relation) FROM `seance`,`rdv`,`rel_seance_rdv` WHERE seance.id_seance=rel_seance_rdv.id_seance AND rdv.id=rel_seance_rdv.id AND rdv.idPatient='$idPatient' AND rdv.statut=3");

                          $nbr = "0";
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                            $nbr =  $donnees[0];
						}
						
                        $reponse->closeCursor();

                        return $nbr;
                    }
 
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
						 
				}

function nbrSeanceProgrameNonFaites($nomBD,$idPatient){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                          $date = "'" .date('Y-m-d')."'";
                          $reponse = $bdd->query("SELECT COUNT(id_relation) FROM `seance`,`rdv`,`rel_seance_rdv` WHERE seance.id_seance=rel_seance_rdv.id_seance AND rdv.id=rel_seance_rdv.id AND rdv.idPatient='$idPatient' AND seance.etat<>2 AND rdv.statut<>3");

                          $nbr = "0";
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                            $nbr =  $donnees[0];
						}
						
                        $reponse->closeCursor();

                        return $nbr;
                    }
 
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
						 
				}

function getNonOuvrableDays($nomBD){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

			try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT * FROM `jours_ouvrables`");
                            
                        $nbr = $reponse->rowCount();
                        
                        if ($nbr > 0) {

                        	$i = 0;

                        	$jours = "[";

                        	while ($donnees = $reponse->fetch())
                                {
                                	$jour     = $donnees['jour'];
                                	$decision = $donnees['decision'];

                                	switch ($jour) {
                                		case 'dimanche':
                                			if ($decision =="1") {
                                				$jours .="0,";
                                				$i = $i + 1;
                                			}
                                			break;
                                		case 'lundi':
                                			if ($decision =="1") {
                                				$jours .="1,";
                                				$i = $i + 1;
                                			}
                                			break;
                                		case 'mardi':
                                			if ($decision =="1") {
                                				$jours .="2,";
                                				$i = $i + 1;
                                			}
                                			break;
                                		case 'mercredi':
                                			if ($decision =="1") {
                                				$jours .="3,";
                                				$i = $i + 1;
                                			}
                                			break;
                                		case 'jeudi':
                                			if ($decision =="1") {
                                				$jours .="4,";
                                				$i = $i + 1;
                                			}
                                			break;
                                		case 'vendredi':
                                			if ($decision =="1") {
                                				$jours .="5,";
                                				$i = $i + 1;
                                			}
                                			break;
                                		case 'samedi':
                                			if ($decision =="1") {
                                				$jours .="6,";
                                				$i = $i + 1;
                                			}
                                			break;			
                                	}
                                }
                                if ($i == 0) {
                                	$jours .="]";
                                }else{
                                	$jours = substr($jours, 0, -1); 
                                	$jours .="]";
                                }
                        }

                        return $jours;

                        $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                } 
		}

function insertSeances($nomBD,$type_seance,$jour,$date,$heure){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);
		
			try
                {
                                                    
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  
 
                    $reponse = $bdd->query("INSERT INTO `seance`(`type_seance`, `jour`, `date`, `heure`) VALUES ('$type_seance','$jour','$date','$heure')");   
                    //$id_lit = $bdd->lastInsertId();

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
		} 
function gerDureeEntreRDV($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                            $reponse = $bdd->query("SELECT espace_entre_seances FROM `dureetemporelleentrelesseances`");

                          $nbr = "30";
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                            $nbr =  $donnees[0];
						}
						
                        $reponse->closeCursor();

                        return $nbr;
                    }
 
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
	}

function gerOuvertureFermeture($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                        $reponse = $bdd->query("SELECT  `ouverture`,`fermeture`,`nbrPatientParSeance` FROM `cabinet`");

                        $ouvFermNbr = "{";
                                                  
                      while ($donnees = $reponse->fetch())
                        {
                            $ouvFermNbr .= substr($donnees[0], 0, 8).",";
                            $ouvFermNbr .= substr($donnees[1], 0, 8).",";
                            $ouvFermNbr .= $donnees[2];
						}

						$ouvFermNbr .= "}";
						
                        $reponse->closeCursor();

                        return $ouvFermNbr;
                    }
 
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
	}

function getNameOuvrableDays($nomBD){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

			try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT jour FROM `jours_ouvrables` WHERE decision=0");
                            
                        $nbr = $reponse->rowCount();

                        $jours   = "";
                        
                        if ($nbr > 0) {

                        	$i = 0;

                        	while ($donnees = $reponse->fetch())
                                {
                                	$jour     = $donnees['jour'];                                	
                                	$jours   .= $jour . ",";
                                }
                            $jours = substr($jours, 0, -1);                                    
                        }else{
                        	$jours = "";
                        }

                        return $jours;

                        $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                } 
		}

function getNombrePlacePourSeance($nomBD,$idSeance){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

			try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT * FROM `rel_seance_rdv` WHERE id_seance ='$idSeance'");
                            
                        $nbr = $reponse->rowCount();

                        return $nbr;
                        $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                } 
		}


function getSeancesForAgenda($nomBD){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);
	$lyoum 	    = date("Y-m-d");

			try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT * FROM `seance` WHERE `date`>='$lyoum'");
                            
                        $nbr = $reponse->rowCount();

                        $ceMois = date('Y-m');

                        $iterat = "";
                        $LesRDV = "[";

                        $nbrPatientParSalle = nbrPatientParSeance($nomBD);

                        $dureeSeance = dureeParSeance($nomBD);
                        
                        if ($nbr > 0) {

                        	while ($donnees = $reponse->fetch())
                                {
		                        	$jour   	 = $donnees['jour'];
		                        	$date   	 = $donnees['date'];
		                        	$heure 		 = $donnees['heure'];
		                        	$etat 		 = $donnees['etat'];
		                        	$id_seance   = $donnees['id_seance'];
                                	$type_seance = $donnees['type_seance'];

		                        	$heure = substr($heure, 0, 8);

		                        	$nbrPlaceVide = getNombrePlacePourSeance($nomBD,$id_seance);

		                        	$endTime = strtotime("+".$dureeSeance." minutes", strtotime($heure));
									$endTime = date('H:i:s', $endTime);

		                        	switch ($etat) {
		                        		case '0':
		                        			if ($nbrPlaceVide < $nbrPatientParSalle) {
		                        				$placeDispo = $nbrPatientParSalle - $nbrPlaceVide;
		                        				$iterat = "{
							                        title: 'Séance ".$type_seance."',
							                        start: '".$date."' + 'T".$heure."',
							                        end: '".$date."' + 'T".$endTime."',
							                        description: 'Séance ".$id_seance."<br> Du ".$jour." le: ".$date."<br> Nombre de place disponible: ".$placeDispo."',
							                        color: '#45B6B0',
							                    },";
		                        			}else{
		                        				$iterat = "{
							                        title: 'Séance ".$type_seance."',
							                        start: '".$date."' + 'T".$heure."',
							                        end: '".$date."' + 'T".$endTime."',
							                        description: 'Séance ".$id_seance."<br> Du ".$jour." le: ".$date."<br> Séance complète ! pas de places vide',
							                        color: '#E86161',
							                    },";
		                        			}
		                        			
		                        			
		                        			break;
		                        		case '1':
		                        			$iterat = "{
						                        title: 'Séance ".$type_seance."',
						                        start: '".$date."' + 'T".$heure."',
						                        end: '".$date."' + 'T".$endTime."',
						                        description: 'Séance ".$id_seance."<br> Du ".$jour." le: ".$date."<br> Séance complète ! pas de places vide',
						                        color: '#EDA849',
						                    },";
		                        			
		                        			break;
		                        		case '2':
	                        				$iterat = "{
						                        title: 'Séance ".$type_seance."',
						                        start: '".$date."' + 'T".$heure."',
						                        end: '".$date."' + 'T".$endTime."',
						                        description: 'Séance ".$id_seance."<br> Du ".$jour." le: ".$date."<br> Séance clôturee',
						                        color: '#60B8D1',
						                    },";
		                        			
		                        			break;
		                        	}
		                        	
		                        	$LesRDV .= $iterat;
                                }

                        }else{
                        	
                        	$iterat = "{
		                        title: 'Aucune séance n\'est encore programmée !',
		                        start: '".$ceMois."' + '-01',
		                        color: '#A8BDCF'
		                    },";

		                    $LesRDV .= $iterat;
                        }
                        

                        $reponse->closeCursor();

                        $LesRDV = substr($LesRDV, 0, -1); 

                        $LesRDV .= "]";

                        return $LesRDV;
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                } 
		}	

function nbrPatientParSeance($nomBD){

    global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);
            try
	            {
	                                    
		            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		            $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
		            
		            // On recupere tout le contenu de la table news
		            $reponse = $bdd->query('SELECT nbrPatientParSeance FROM cabinet');
		            
		            $nbr = $reponse->rowCount();
		            $nbrPatientParScenace = 0;

		            if ($nbr > 0) {
		            	while ($donnees = $reponse->fetch())
                            {
                            	$nbrPatientParScenace = $donnees['nbrPatientParSeance'];
                            }
		            }

		            return $nbrPatientParScenace;

		           $reponse->closeCursor();
	          }

	        catch(Exception $e)
	            {
	               die('Erreur : '.$e->getMessage());
	            }  
    }


function dureeParSeance($nomBD){

    global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);
            try
	            {
	                                    
		            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		            $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
		            
		            // On recupere tout le contenu de la table news
		            $reponse = $bdd->query('SELECT duree FROM duree_rdv');
		            
		            $nbr = $reponse->rowCount();
		            //$dureeSeance = 45;
		            $dureeSeance = 15;

		            if ($nbr > 0) {
		            	while ($donnees = $reponse->fetch())
                            {
                            	$dureeSeance = $donnees['duree'];
                            }
		            }

		            return $dureeSeance;

		           $reponse->closeCursor();
	          }

	        catch(Exception $e)
	            {
	               die('Erreur : '.$e->getMessage());
	            }  
    }

 function getSeanceBeginTime($nomBD,$idSeance){

    global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);
            try
	            {
	                                    
		            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		            $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
		            
		            // On recupere tout le contenu de la table news
		            $reponse = $bdd->query("SELECT heure FROM seance WHERE id_seance='$idSeance'");
		            
		            $nbr = $reponse->rowCount();
		            $heure = 0;

		            if ($nbr > 0) {
		            	while ($donnees = $reponse->fetch())
                            {
                            	$heure = $donnees['heure'];
                            	$heure = substr($heure, 0, 8);
                            }
		            }

		            return $heure;

		           $reponse->closeCursor();
	          }

	        catch(Exception $e)
	            {
	               die('Erreur : '.$e->getMessage());
	            }  
    }   


function getPatientsDansSéance($nomBD,$idSeance){

    global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	= crypterNomDeLaBase($nomBD);

	$date   = date('Y-m-d');
            try
	            {
	                                    
		            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		            $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
		            
		            // On recupere tout le contenu de la table news
		            $reponse = $bdd->query("SELECT * FROM `seance`,`rel_seance_rdv`,`rdv` WHERE seance.date ='$date' AND (rdv.statut= 1 OR rdv.statut= 2) AND seance.id_seance = rel_seance_rdv.id_seance AND rel_seance_rdv.id = rdv.id");
		            
		            $nbr = $reponse->rowCount();
		            $nbrPatientParScenace = 0;

		            if ($nbr > 0) {
		            	while ($donnees = $reponse->fetch())
                            {
                            	$motif  = $donnees['motifCons'];
                            	$nomP   = $donnees['nomP'];
                            	$prenoP = $donnees['prenoP'];
                            	$tel    = $donnees['tel'];

                            	$idRdv       = $donnees[8];
                            	$idSeance    = $donnees[7];
                            	
                            	$idPatient   = $donnees['idPatient'];
                            	$idMedecin   = $donnees['idMedecin'];
                            	$id_relation = $donnees['id_relation'];

                            	$remqID = "remq_".$idRdv;

                            		echo "  <div class=\"content-wrap\">
								                <div class=\"row\">
								                    <div class=\"col-sm-12\">
								                        <div class=\"nest\" id=\"headerClose3\">
								                            <div class=\"title-alt\">
								                                <h6>
								                                    Conclusion et Diagnostic</h6>
								                                <Div class=\"titleClose\">
								                                    <a class=\"gone\" href=\"#headerClose3\">
								                                        <span class=\"entypo-cancel\"></span>
								                                    </a>
								                                </div>
								                                <div class=\"titleToggle\">
								                                    <a class=\"nav-toggle-alt\" href=\"#header3\">
								                                        <span class=\"entypo-up-open\"></span>
								                                    </a>
								                                </div>

								                            </div>

								                            <div class=\"body-nest\" id=\"header3\">

								                                    <input type=\"hidden\" name=\"idMedecin\" value=\"<?php echo $idMedecin;?>\">
																	<input type=\"hidden\" name=\"idPatient\" value=\"<?php echo $idPatient;?>\">
								                                    <input type=\"hidden\" name=\"idRelation\" value=\"<?php echo $id_relation;?>\">

								                                    <dl class=\"dl-horizontal-profile\">
											                            <dt>Nom Patient</dt>
											                            <dd>
											                            	$nomP
											                            </dd>
											                            <dt>Prénom Patient</dt>
											                            <dd>
											                            	$prenoP
											                            </dd>
											                            <dt>Motif séance</dt>";

											                            if($motif == ""){
											                            		echo "<dd>Aucun motif enregistré pour cette seance !</dd>";
											                            }else{
											                            		echo "<dd>$motif</dd>";
											                            }	

											                      echo "<dt>Téléphone</dt>
											                            <dd>
											                            	$tel
											                            </dd>
											                        </dl>

								                                    <textarea style=\"width:100%;height:80px\" id=\"$remqID\" name=\"remarqueseance\" placeholder=\"Espace de remarques ...\"></textarea>
								                                    <br>

								                                    <button type=\"reset\" class=\"btn btn-info\" value=\"Reset form!\">
								                                        <span class=\"entypo-trash\"></span>&nbsp;&nbsp;Effacer la remarque !</button>

								                                      <div class=\"pull-right\">
									                                      <input id=\"saveRmrqButton\" class=\"btn btn-success\" style=\"margin-right: 10px;\" value=\"Seance Terminer\" onclick=\"fin('$nomP','$prenoP','$idPatient','$idSeance','$idRdv','$remqID');\" />
									                                      <br>
								                                      </div>             
								                            </div>
								                        </div>
								                    </div>
                    							</div>
								            </div>";
                            }
		            }

		            return $nbrPatientParScenace;

		           $reponse->closeCursor();
	          }

	        catch(Exception $e)
	            {
	               die('Erreur : '.$e->getMessage());
	            }  
    } 

function nbrPatientPresentEnSalle($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB = crypterNomDeLaBase($nomBD);
	$date = date('Y-m-d');

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                        $reponse = $bdd->query("SELECT COUNT(id_relation) FROM `seance`,`rel_seance_rdv`,`rdv` WHERE seance.date ='$date' AND (rdv.statut= 1 OR rdv.statut= 2) AND seance.id_seance = rel_seance_rdv.id_seance AND rel_seance_rdv.id = rdv.id");
                                                  
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

function nbrPatientAbsent($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB = crypterNomDeLaBase($nomBD);
	$date = date('Y-m-d');

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                        $reponse = $bdd->query("SELECT COUNT(id_relation) FROM `seance`,`rel_seance_rdv`,`rdv` WHERE seance.date ='$date' AND rdv.statut= 0 AND seance.id_seance = rel_seance_rdv.id_seance AND rel_seance_rdv.id = rdv.id");
                                                  
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


function insertionRelationRDVSeance($Cabinet,$seance,$idRDV){


		$database = crypterNomDeLaBase($Cabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;

		$idRDV    	= str_replace("'","\'",$idRDV);
		$seance    	= str_replace("'","\'",$seance);

		try
            {                                                    
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
            
			$reponse = $bdd->query("INSERT INTO `rel_seance_rdv`(`id_seance`, `id`) VALUES ('$seance','$idRDV');");

            $reponse->closeCursor();                                                  
          }
        catch(Exception $e)
            {
               die('Erreur : '.$e->getMessage());
            } 
	}  

	
 function getIdPatientFromSeance($nomCabinet,$idPatient){

 	global $host_name;
    global $db_user_name;
    global $db_password;
    
    $database  = crypterNomDeLaBase($nomCabinet);
    
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT * FROM patient WHERE idPatient = '$idPatient'");
                  while ($donneesM = $reponse->fetch())
                        {
                        	echo"<div>";
	                            if ($donneesM['sexePatient'] == "Homme") {
	                                echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
	                                    }
	                            elseif ($donneesM['sexePatient'] == "Femme") {
	                                echo "<img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/girlAvatar.png\">";
	                                    }
	                              echo"<h3>". $donneesM['nomPatient'] . " " . $donneesM['prenomPatient'] . "&nbsp;&nbsp;</h3>";
	                        echo"</div>";
	                        echo"<hr>";
                        }
                  $reponse->closeCursor();
 }

 function getPatientNameEtPrenomFromTableLocal($nomCabinet,$idPatient){

  global $host_name;
  global $db_user_name;
  global $db_password;
    
  	$database  = crypterNomDeLaBase($nomCabinet);

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT nomPatient,prenomPatient FROM `patient` WHERE `idPatient` = '$idPatient'");

                          $nomPatient 		= "";
                          $prenomPatient 	= "";
                          $nomprenomPatient = "";

                          while ($donnees = $reponse->fetch())
                                     {
                                        $nomPatient 	= $donnees['nomPatient'];
                                        $prenomPatient  = $donnees['prenomPatient'];

                                        $nomprenomPatient = $nomPatient . " " . $prenomPatient;
                                      }

                                      return $nomprenomPatient;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }


function updateRDVStatsWheneSeanceIsClosed($nomCabinet,$idSeance){

  global $host_name;
  global $db_user_name;
  global $db_password;
    
  	$database  = crypterNomDeLaBase($nomCabinet);

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT rdv.id FROM `rdv`,`rel_seance_rdv`,`seance` WHERE rdv.id = rel_seance_rdv.id AND rel_seance_rdv.id_seance = seance.id_seance AND seance.id_seance='$idSeance'");

                          $idRDV = "";
                          $nbr = $reponse->rowCount();

		            	    if ($nbr > 0) {

		                          while ($donnees = $reponse->fetch())
		                                {
		                                    $idRDV = $donnees[0];

		                                    cloturerRDV($nomCabinet,$idRDV);
		                                }
		                        }              

                            return $nomprenomPatient;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
    }        

    function cloturerRDV($nomBD,$idRDV){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

			$con = mysqli_connect($host_name,$db_user_name,$db_password,$nomB);

			if ($con->connect_error) {
			    die("Connection failed: " . $con->connect_error);
			}

			$sql = "UPDATE `rdv` SET `statut`='3' WHERE `id` ='$idRDV'";

			if ($con->query($sql) === TRUE) {
			    
			} else {
			    echo "Error updating record: " . $con->error;
			}  
		}

 function getKineFormPatientSignin($nomBD,$idCabinet){

		global $host_name;
		global $db_user_name;
		global $db_password;

			$nomB 	    = crypterNomDeLaBase($nomBD);

			echo "<option value=\"-\">Kinésithérapeute responsable</option>";

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);       

                  $reponse = $bdd->query("SELECT medecin.idMedecin,medecin.nomMedecin,medecin.prenomMedecin FROM medecin,relationmedcab WHERE medecin.idMedecin = relationmedcab.idMedecin AND relationmedcab.idCabinet = '$idCabinet'");
                  
                  while ($donneesM = $reponse->fetch())
                        {

                            echo "<option value=\"$donneesM[idMedecin]\">

                        			" . $donneesM['nomMedecin']. " " . $donneesM['prenomMedecin'];

                            echo "</option>";

 
                        }
                  $reponse->closeCursor();


	} 

function getPatientAgeLocal($nomBD,$idUser){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT dateNaissPatient FROM `patient` WHERE `idPatient` = '$idUser'");



							// Calcule l'âge à partir d'une date de naissance jj/mm/aaaa
							$date_naissance = "";

                          

                          while ($donnees = $reponse->fetch())
                                    {
                                        $date_naissance  = $donnees['dateNaissPatient'];
                                    }

									$an = date('Y');
									$annaiss = substr($date_naissance, 0, 4);
										
									$age = $an - $annaiss;
									
									return $age;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }

 function getPatientPrenomLocal($nomBD,$idUser){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT prenomPatient FROM `patient` WHERE `idPatient` = '$idUser'");

                          $prenomPatient 	= "";

                          while ($donnees = $reponse->fetch())
                                     {
                                        $prenomPatient  = $donnees['prenomPatient'];

                                      }

                                      return $prenomPatient;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        } 

function getPatientNomLocal($nomBD,$idUser){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT nomPatient FROM `patient` WHERE `idPatient` = '$idUser'");

                          $nomPatient 	= "";

                          while ($donnees = $reponse->fetch())
                                     {
                                        $nomPatient  = $donnees['nomPatient'];

                                      }

                                      return $nomPatient;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }      

function insertAdditionCons($nomBD,$idPat,$idRDV,$idDoc,$date,$heure,$addition,$nomP,$prenomP,$typeCons){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

		$trimedIdPatient = trim($idPat);

		$nomB 	    = crypterNomDeLaBase($nomBD);

		if ($trimedIdPatient == "" || $trimedIdPatient == null || $trimedIdPatient == "undefined") {
			$trimedIdPatient = getIdPatientFromNometPrenom($nomP,$prenomP);
		}

		$trimedIdPatient = trim($trimedIdPatient);
		
		try
            {
                                                
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  

                $reponse = $bdd->query("INSERT INTO `addition`(`idPatient`, `idRDV`, `idMedecin`, `date_cons`, `heure`, `addition`, `type_seance`) VALUES ('$trimedIdPatient','$idRDV','$idDoc','$date','$heure','$addition','$typeCons')");

                $reponse->closeCursor();
            }

        catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
	}


function getHeureFromSeance($nomBD,$idSeance){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT heure FROM `seance` WHERE `id_seance` = '$idSeance' LIMIT 1");

                          $heureSeance 	= "";

                          while ($donnees = $reponse->fetch())
                            {
                                $heureSeance  = $donnees['heure'];
                            }

                            return $heureSeance;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }	

function insertStat($nomBD,$type){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);
		
			try
                {
                                                    
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  
 
                    $reponse = $bdd->query("INSERT INTO `stats`(`type`) VALUES ('Changement')");   
                    //$id_lit = $bdd->lastInsertId();

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
		}

function stats_sexe($nomBD){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

		$homme  = 0;
		$femme  = 0;
		$nombHF = [];

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT sexePatient FROM `patient`");

                          $sexePatient 	= "";

                          while ($donnees = $reponse->fetch())
                            {
                                $sexePatient  = $donnees['sexePatient'];

                                if ($sexePatient == "Homme") {
                                	$homme  = $homme + 1;
                                }else{
                                	$femme  = $femme + 1;
                                }
                            }

                            array_push($nombHF,$homme,$femme);

                            return $nombHF;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }

function stats_age_tranche($nomBD){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

		$mineurs  				= 0;
		$dixhuitATrante   		= 0;
		$TranteQuarante  		= 0;
		$QaranteACinuante  		= 0;
		$CinqanteASoixante  	= 0;
		$SoixanteASoixanteDix  	= 0;
		$PlusDeSoicanteDix  	= 0;

		$trancheDage = [];

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT dateNaissPatient FROM `patient`");

                          $dateNAiss 	= "";
                          $agePAtient 	= "";

                          while ($donnees = $reponse->fetch())
                            {
                                $dateNAiss  = $donnees['dateNaissPatient'];

                                $date 		= new DateTime($dateNAiss);
								$now 		= new DateTime();
								$interval 	= $now->diff($date);
								$agePAtient =  $interval->y;

								switch (true) {
									case ($agePAtient < 18):
											$mineurs 				= $mineurs + 1;
										break;
									case ($agePAtient < 30):
											$dixhuitATrante 		= $dixhuitATrante + 1;
										break;	
									
									case ($agePAtient < 40):
											$TranteQuarante 		= $TranteQuarante + 1;
										break;	
									
									case ($agePAtient < 50):
											$QaranteACinuante 		= $QaranteACinuante + 1;
										break;	
									
									case ($agePAtient < 60):
											$CinqanteASoixante 		= $CinqanteASoixante + 1;
										break;	
									
									case ($agePAtient < 60):
											$SoixanteASoixanteDix 	= $SoixanteASoixanteDix + 1;
										break;	
									
									case ($agePAtient > 70):
											$PlusDeSoicanteDix 		= $PlusDeSoicanteDix + 1;
										break;	         
								}

                                //echo "Age: " . $agePAtient ."<br>"; 
                            }

                            array_push($trancheDage,$mineurs,$dixhuitATrante,$TranteQuarante,$QaranteACinuante,$CinqanteASoixante,$SoixanteASoixanteDix,$PlusDeSoicanteDix);

                            return $trancheDage;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }  

function insertRelPatientPathologie($nomBD,$idPatient,$pathologie){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);
		
			try
                {
                                                    
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  
 
                    $reponse = $bdd->query("INSERT INTO `rel_patient_pathologie`(`idPatient`,`id_pathologie`) VALUES ('$idPatient','$pathologie')");   
                    //$id_lit = $bdd->lastInsertId();

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
		}

function pathologies($nomBD){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);
		
			 try
                {
                  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                  $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                 
                      $reponse = $bdd->query("SELECT * FROM `pathologie`");

                      $dateNAiss 	= "";
                      $agePAtient 	= "";

                      while ($donnees = $reponse->fetch())
                        {
                            $pathologie    = $donnees['pathologie'];
                            $id_pathologie = $donnees['id_pathologie'];


                            echo "<option value=\"$id_pathologie\">$pathologie</option>"; 
                        }
                    
                    $reponse->closeCursor();
                }
            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                }
		}		

function stats_pathologie($nomBD){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

		$homme  = 0;
		$femme  = 0;
		$nombHF = [];

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT pathologie.pathologie, COUNT(patient.idPatient) FROM rel_patient_pathologie,patient,pathologie WHERE rel_patient_pathologie.idPatient = patient.idPatient AND rel_patient_pathologie.id_pathologie = pathologie.id_pathologie GROUP BY pathologie.pathologie;");

                          $stats_pathologie 	= [];

                          while ($donnees = $reponse->fetch())
                            {
                                $pathologie  = $donnees[0];
                                $nombrePparP = $donnees[1];

                                array_push($stats_pathologie,$pathologie,$nombrePparP);
                            }

                            

                            return $stats_pathologie;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
             
        }

function stats_annulation($nomBD){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

		$moisAnnul  = 0;
		$annulation = 0;
		$statsAnnul = [];
		$statsAnnls = [];

	        try
	            {
	              $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	              $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
	                                             
	                $reponse = $bdd->query("SELECT MONTH(date_insertion) AS mois, COUNT(id_stats) AS nbrAnnulation
											FROM stats 
											WHERE type ='Annulation' AND init <>0
											GROUP BY MONTH(date_insertion)
											ORDER BY MONTH(date_insertion)");

	                while ($donnees = $reponse->fetch())
	                    {
	                    	switch ($donnees['mois']) {
	                    		case 1:
	                    				$moisAnnul  = $donnees['mois'];
	                        			$annulation = $donnees['nbrAnnulation'];

	                        			array_push($statsAnnul,"janvier",$annulation);
	                    			break;
	                    		case 2:
	                    				$moisAnnul  = $donnees['mois'];
	                        			$annulation = $donnees['nbrAnnulation'];

	                        			array_push($statsAnnul,"fevrier",$annulation);
	                    			break;
	                    		case 3:
	                    				$moisAnnul  = $donnees['mois'];
	                        			$annulation = $donnees['nbrAnnulation'];

	                        			array_push($statsAnnul,"mars",$annulation);
	                    			break;
	                    		case 4:
	                    				$moisAnnul  = $donnees['mois'];
	                        			$annulation = $donnees['nbrAnnulation'];

	                        			array_push($statsAnnul,"avril",$annulation);
	                    			break;
	                    		case 5:
	                    				$moisAnnul  = $donnees['mois'];
	                        			$annulation = $donnees['nbrAnnulation'];

	                        			array_push($statsAnnul,"mai",$annulation);
	                    			break;
	                    		case 6:
	                    				$moisAnnul  = $donnees['mois'];
	                        			$annulation = $donnees['nbrAnnulation'];

	                        			array_push($statsAnnul,"juin",$annulation);
	                    			break;
	                    		case 7:
	                    				$moisAnnul  = $donnees['mois'];
	                        			$annulation = $donnees['nbrAnnulation'];

	                        			array_push($statsAnnul,"juillet",$annulation);
	                    			break;
	                    		case 8:
	                    				$moisAnnul  = $donnees['mois'];
	                        			$annulation = $donnees['nbrAnnulation'];

	                        			array_push($statsAnnul,"aout",$annulation);
	                    			break;
	                    		case 9:
	                    				$moisAnnul  = $donnees['mois'];
	                        			$annulation = $donnees['nbrAnnulation'];

	                        			array_push($statsAnnul,"septembre",$annulation);
	                    			break;
	                    		case 10:
	                    				$moisAnnul  = $donnees['mois'];
	                        			$annulation = $donnees['nbrAnnulation'];

	                        			array_push($statsAnnul,"octobre",$annulation);
	                    			break;
	                    		case 11:
	                    				$moisAnnul  = $donnees['mois'];
	                        			$annulation = $donnees['nbrAnnulation'];

	                        			array_push($statsAnnul,"novembre",$annulation);
	                    			break;
	                    		case 12:
	                    				$moisAnnul  = $donnees['mois'];
	                        			$annulation = $donnees['nbrAnnulation'];

	                        			array_push($statsAnnul,"decembre",$annulation);
	                    			break;					
	                    	}
	                    }

	                    $nbrLignes = count($statsAnnul);
	                    $null = '0';

	                    for ($mm=0; $mm < $nbrLignes; $mm=$mm+2) { 
	                    	array_push($statsAnnls,$statsAnnul[$mm]);
	                    }

	                    for ($ll=1; $ll < 13; $ll++) { 
	                    	if (!in_array($ll, $statsAnnls)) {
	                    		$mois = retournDayNameFrFromNumber($ll);
	                    		array_push($statsAnnul,$mois,$null);
	                    	}
	                    }

	                    //sort($statsAnnls);

	                    $statsAnnuul = storMonthForGraph($statsAnnul);

	                return $statsAnnuul;
	                
	                $reponse->closeCursor();
	            }
	        catch(Exception $e)
	            {
	               die('Erreur : '.$e->getMessage());
	            }
             
    }

function stats_changement($nomBD){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

		$moisChang  = 0;
		$changement = 0;
		$statsChang = [];
		$statsChans = [];

	        try
	            {
	              $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	              $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
	                                             
	                $reponse = $bdd->query("SELECT MONTH(date_insertion) AS mois, COUNT(id_stats) AS nbrChangement
											FROM stats 
											WHERE type ='Changement' AND init <>0
											GROUP BY MONTH(date_insertion)
											ORDER BY MONTH(date_insertion)");


	                while ($donnees = $reponse->fetch())
	                    {
	                    	switch ($donnees['mois']) {
	                    		case 1:
	                    				$moisChang  = $donnees['mois'];
	                        			$changement = $donnees['nbrChangement'];

	                        			array_push($statsChang,"janvier",$changement);
	                    			break;
	                    		case 2:
	                    				$moisChang  = $donnees['mois'];
	                        			$changement = $donnees['nbrChangement'];

	                        			array_push($statsChang,"fevrier",$changement);
	                    			break;
	                    		case 3:
	                    				$moisChang  = $donnees['mois'];
	                        			$changement = $donnees['nbrChangement'];

	                        			array_push($statsChang,"mars",$changement);
	                    			break;
	                    		case 4:
	                    				$moisChang  = $donnees['mois'];
	                        			$changement = $donnees['nbrChangement'];

	                        			array_push($statsChang,"avril",$changement);
	                    			break;
	                    		case 5:
	                    				$moisChang  = $donnees['mois'];
	                        			$changement = $donnees['nbrChangement'];

	                        			array_push($statsChang,"mai",$changement);
	                    			break;
	                    		case 6:
	                    				$moisChang  = $donnees['mois'];
	                        			$changement = $donnees['nbrChangement'];

	                        			array_push($statsChang,"juin",$changement);
	                    			break;
	                    		case 7:
	                    				$moisChang  = $donnees['mois'];
	                        			$changement = $donnees['nbrChangement'];

	                        			array_push($statsChang,"juillet",$changement);
	                    			break;
	                    		case 8:
	                    				$moisChang  = $donnees['mois'];
	                        			$changement = $donnees['nbrChangement'];

	                        			array_push($statsChang,"aout",$changement);
	                    			break;
	                    		case 9:
	                    				$moisChang  = $donnees['mois'];
	                        			$changement = $donnees['nbrChangement'];

	                        			array_push($statsChang,"septembre",$changement);
	                    			break;
	                    		case 10:
	                    				$moisChang  = $donnees['mois'];
	                        			$changement = $donnees['nbrChangement'];

	                        			array_push($statsChang,"octobre",$changement);
	                    			break;
	                    		case 11:
	                    				$moisChang  = $donnees['mois'];
	                        			$changement = $donnees['nbrChangement'];

	                        			array_push($statsChang,"novembre",$changement);
	                    			break;
	                    		case 12:
	                    				$moisChang  = $donnees['mois'];
	                        			$changement = $donnees['nbrChangement'];

	                        			array_push($statsChang,"decembre",$changement);
	                    			break;					
	                    	}
	                    }

	                    $nbrLignnes = count($statsChang);
	                    $null = '0';

	                    for ($jj=0; $jj < $nbrLignnes; $jj=$jj+2) { 
	                    	array_push($statsChans,$statsChang[$jj]);
	                    }

	                    for ($uu=1; $uu < 13; $uu++) { 
	                    	if (!in_array($uu, $statsChans)) {
	                    		$mois = retournDayNameFrFromNumber($uu);
	                    		array_push($statsChang,$mois,$null);
	                    	}
	                    }

	                    //sort($statsAnnls);
	                    $statsChanng = storMonthForGraph($statsChang);

	                return $statsChanng;
	                
	                $reponse->closeCursor();
	            }
	        catch(Exception $e)
	            {
	               die('Erreur : '.$e->getMessage());
	            }
	}                            

function insertAnnulation($nomBD){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);
		
			try
                {
                                                    
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  
 
                    $reponse = $bdd->query("INSERT INTO `stats`(`type`) VALUES ('Annulation')");   
                    //$id_lit = $bdd->lastInsertId();

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
		}				

function insertChangement($nomBD){
    
		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);
		
			try
                {
                                                    
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  
 
                    $reponse = $bdd->query("INSERT INTO `stats`(`type`) VALUES ('Changement')");   
                    //$id_lit = $bdd->lastInsertId();

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
	}	

function retournDayNameFrFromNumber($num){

	$mois = "";

		switch ($num) {
    		case 1:
    				$mois = "janvier";
    			break;
    		case 2:
    				$mois = "février";
    			break;
    		case 3:
    				$mois = "mars";
    			break;
    		case 4:
    				$mois = "avril";
    			break;
    		case 5:
    				$mois = "mai";
    			break;
    		case 6:
    				$mois = "juin";
    			break;
    		case 7:
    				$mois = "juillet";
    			break;
    		case 8:
    				$mois = "août";
    			break;
    		case 9:
    				$mois = "septembre";
    			break;
    		case 10:
    				$mois = "octobre";
    			break;
    		case 11:
    				$mois = "novembre";
    			break;
    		case 12:
    				$mois = "décembre";
    			break;					
    	}

    	return $mois;
}

function storMonthForGraph($array){

	$tableau = [];

		$janvier   = array_search("janvier",$array);
		$fevrier   = array_search("fevrier",$array);
		$mars      = array_search("mars",$array);
		$avril     = array_search("avril",$array);
		$mai       = array_search("mai",$array);
		$juin      = array_search("juin",$array);
		$juillet   = array_search("juillet",$array);
		$aout      = array_search("aout",$array);
		$septembre = array_search("septembre",$array);
		$octobre   = array_search("octobre",$array);
		$novembre  = array_search("novembre",$array);
		$decembre  = array_search("décembre",$array);

		array_push($tableau,"Janvier",$array[$janvier+1]);
		array_push($tableau,"Février",$array[$fevrier+1]);
		array_push($tableau,"Mars",$array[$mars+1]);
		array_push($tableau,"Avril",$array[$avril+1]);
		array_push($tableau,"Mai",$array[$mai+1]);
		array_push($tableau,"Juin",$array[$juin+1]);
		array_push($tableau,"Juillet",$array[$juillet+1]);
		array_push($tableau,"Août",$array[$aout+1]);
		array_push($tableau,"Septembre",$array[$septembre+1]);
		array_push($tableau,"Octobre",$array[$octobre+1]);
		array_push($tableau,"Novembre",$array[$novembre+1]);
		array_push($tableau,"Décembre",$array[$decembre+1]);

    return $tableau;
}	


function uploadPhotoMedical($nomBD, $id_patient, $path, $idAjouteur, $img_medic, $file){
    
    global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);



    if ($img_medic !="") {
        
   
            $target_dir = "../../files/dossierPatient/$id_patient/";
            $target_file = $target_dir . basename($img_medic["name"]);
            
            $date = date("YHis");  
		
            $logoName = $date.".png";//str_replace("'","`",$img_medic["name"]);
            $accents = '/&([A-Za-z]{1,2})(grave|acute|circ|cedil|uml|lig);/';
            $string_encoded = htmlentities($logoName,ENT_NOQUOTES,'UTF-8');

            $img = secure_upload_profiles_med($file,'upload_photo',"../../files/dossierPatient/$id_patient/");

            if($img === 0){

            }else{

            	$lien = substr($img, 6);

				try
	                {
	                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);  
	 
	                    $reponse = $bdd->query("INSERT INTO `dossierPatient`(`idPatient`,`path`,`id_ajouteur`) VALUES('$id_patient','$lien','$idAjouteur')");   
	                    $reponse->closeCursor();
	                }

	            catch(Exception $e)
	                {
	                    die('Erreur : '.$e->getMessage());
	                }
                }
             
        }    
    }
    


function secure_upload_profiles_med($file,$upload_name,$url){
		 
    $message = ''; 
    // get details of the uploaded file
    
    $fileTmpPath 	= $file[$upload_name]['tmp_name'];
    $fileName 		= $file[$upload_name]['name'];
    $fileSize 		= $file[$upload_name]['size'];
    $fileType 		= $file[$upload_name]['type'];
    $fileNameCmps 	= explode(".", $fileName);
    $fileExtension 	= strtolower(end($fileNameCmps));
 
    //echo date();
    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
    
   
    $allowedfileExtensions = array('jpg','png','jpeg','php','php7');
 
    if (in_array($fileExtension, $allowedfileExtensions))
    {
      
      $uploadFileDir = $url;
        
      $dest_path = $uploadFileDir . $newFileName;
        
      if(move_uploaded_file($fileTmpPath, $dest_path)) 
      {
        $message ='File is successfully uploaded.';
        return $dest_path;
      }
      else
      {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
        
        return 0;
      }
    }else{
        return 0;
    }
 }

 function insertNewMedecinPourcentage($nomBD, $idMedecin){
    
    global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

				try
                    {
                                            
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                    
                    // On recupere tout le contenu de la table news
                    $reponse = $bdd->query("INSERT INTO `gestionrecettepracitien`(`idMedecin`, `pourcentage`) VALUES ('$idMedecin','100');");   
                    $reponse->closeCursor();
                  }

                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    } 
			}	

function insertionMedecinUser($login,$password,$identifiant){

  global $host_name;
  global $db_user_name;
  global $db_password;
  global $baseGlobale;

    $login    = str_replace("'","\'",$login);
    $passwordH  = hash('sha512', $password);

          try
            {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);                      
                            
                // On recupere tout le contenu de la table news
                $reponse = $bdd->query("INSERT INTO `users`(`login`, `password`, `typeCompte`, `identifiant`) VALUES ('$login','$passwordH','2','$identifiant');");

                $reponse->closeCursor();
            }
          catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
    }

    /*function getDureeRDVCabinet($nomBD){

    	global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

		$duree  = '30';

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                          $reponse = $bdd->query("SELECT dureeRDV FROM dureerdv");

                          while ($donnees = $reponse->fetch())
                            {
                                $duree  = $donnees['dureeRDV'];
                            }

                        return $duree;
                        
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
    }*/


    function getAllPayement($nomBD,$idPatient){

    	$nomCabinet   = $nomBD;
        $Patient      = (String) trim($idPatient);

        global $host_name;
        global $db_user_name;
        global $db_password;

        $database   = crypterNomDeLaBase($nomCabinet);  

        $total = 0;   

                  try
                    {
                                                                       
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      

                      $reponse = $bdd->query("SELECT * FROM `addition`,`patient`,`medecin` WHERE addition.idPatient ='$Patient' AND addition.idPatient = patient.idPatient AND addition.idMedecin = medecin.idMedecin");

                      $nbr = $reponse->rowCount();

                        if ($nbr > 0) {

                          while ($donnees = $reponse->fetch())
                              {
                                  $id_addition    = $donnees['id_addition'];
                                  $date_cons      = $donnees['date_cons'];
                                  $heureCons      = $donnees['heure'];
                                  $addition       = $donnees['addition'];
                                  $nomPatient     = $donnees['nomPatient'];
                                  $prenomPatient  = $donnees['prenomPatient'];
                                  $nomMedecin     = $donnees['nomMedecin'];

                                  $total = $total + $addition;

                                  echo "<tr>
                                          <td>$date_cons</td>
                                          <td>$heureCons</td>
                                          <td>" . $nomPatient . " " . $prenomPatient ."</td>
                                          <td>$nomMedecin</td>
                                          <td>$addition da</td>
                                        </tr>";
                              }

                              echo "<tr>
                                      <td colspan=\"3\"></td>
                                      <td><b>Total:</b></td>
                                      <td><b>$total da</b></td>
                                    </tr>";
                            
                        }else{
                          echo "<tr>
                                  <td>De $DateDe à $DateA</td>
                                  <td>-</td>
                                  <td>Aucune paiement effectué</td>
                                  <td>-</td>
                                  <td>0 da</td>
                                </tr>";
                        }                                      
                    $reponse->closeCursor();
                }

                catch(Exception $e)
                      {
                        die('Erreur : '.$e->getMessage());
                      }
    }

function depensesDuJour($nomBD){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

		$toDay    = date('Y-m-d'); 
        //$toDay 	 = date('Y-m-d'); 

        $total = 0;

            try
                {
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                    $reponse = $bdd->query("SELECT * FROM `depenses` WHERE dateAjout='$toDay'");
                    $nbr = $reponse->rowCount();

                    if ($nbr > 0) {

                    	while ($donnees = $reponse->fetch())
	                        {
	                            $remarque  	= $donnees['remarque'];
	                            $depense  	= $donnees['depense'];

	                            echo "<tr>
		                        			<td>Aujourd'hui ($toDay)</td>
		                        			<td>$remarque</td>
		                        			<td>$depense da</td>
		                        	  </tr>";

	                            $total = $total + $depense;
	                        }

                        echo "<tr>
                        			<td colspan=\"1\"></td>
                        			<td><b>Total</b></td>
                        			<td><b>$total da</b></td>
                        	  </tr>";
                    }else{
                    	echo "<tr>
                        			<td>Aujourd'hui ($toDay)</td>
                        			<td>Aucune dépense enregitrée</td>
                        	  </tr>";
                    }

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                } 
		}

function getTotalDepensesParDay($nomBD,$day){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

        //$toDay 	 = date('Y-m-d'); 

        $total = 0;

            try
                {
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                    $reponse = $bdd->query("SELECT depense FROM `depenses` WHERE dateAjout='$day'");
                    $nbr = $reponse->rowCount();

                    if ($nbr > 0) {

                    	while ($donnees = $reponse->fetch())
	                        {
	                            $depense  	= $donnees['depense'];

	                            $total = $total + $depense;
	                        }

                        return $total;
                    }else{
                    	return $total;
                    }

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                } 
		}

function displayAllPatientImg($nomBD,$idPatient){
			
	global $host_name;
	global $db_user_name;
	global $db_password;

	$database 	= crypterNomDeLaBase($nomBD);

            try
                {
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                    $reponse = $bdd->query("SELECT * FROM `dossierpatient` WHERE idPatient='$idPatient'");
                    $nbr = $reponse->rowCount();

                    if ($nbr > 0) {

                    	while ($donnees = $reponse->fetch())
	                        {
	                            $dateHeure 	= $donnees['date_ajout'];
	                            $imagePat  	= $donnees['path'];
	                            $idDocument = $donnees['id_document'];

	                            $dateChkil  = substr($dateHeure,0,19);

	                            $date  = substr($dateChkil,0,10);
	                            $heure = substr($dateChkil,11,18);

								echo '<div class="col-sm-3">
			                            <div class="member" id="'.$idDocument.'">
			                                <div class="headline ">
			                                    <div class="titleClose">
			                                        <a href="#'.$idDocument.'" class="gone">
			                                        </a>
			                                    </div>
			                                </div>

			                                <div class="value zoom">
			                                	<a href="'.$imagePat.'" download>
												  <img src="'.$imagePat.'" alt="image" width="250" height="250" loading="lazy">
												</a>
			                                </div>
			                                <br>
			                                <p style="color:black;text-align: center;">Ajoutée le: '.$date.' à '.$heure.'</p>
											<button style="margin-left: 30%;" type="button" class="btn btn-danger" onclick="suppressionIMG(\''.$imagePat.'\',\''.$idDocument.'\',\''.$nomBD.'\',\''.$idPatient.'\')">
								                <span class="entypo-trash"></span>&nbsp;&nbsp;Supprimer</button>
			                            </div>
			                        </div>';
	                        }
                    }else{
                    	echo "Aucune image à Afficher";;
                    }

                    $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                } 
		}

function getPayementsPatient($nomBD,$idPatient){
			
		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

		$total = 0;

			try
            {
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                    $reponse = $bdd->query("SELECT * FROM `patient`,`addition` WHERE patient.idPatient=addition.idPatient AND patient.idPatient='$idPatient'");
                    $nbr = $reponse->rowCount();
                    
                    if ($nbr > 0) {

                    	$i = 1;

                    	while ($donnees = $reponse->fetch())
                            {
                            	$payement   = $donnees['addition'];
                            	$date       = $donnees['date_cons'];
                            	$heure      = substr($donnees['heure'],0,8);
                            	$idDoc      = $donnees['idMedecin'];
                            	$medecin  	= getMedecinName($idDoc);

                    			echo "<tr>
                                        <td>$i</td>
                                        <td>$date</td>
                                        <td>&nbsp;".$heure."&nbsp;&nbsp;</td>
                                        <td>&nbsp;$medecin&nbsp;&nbsp;</td>
                                        <td>&nbsp;$payement&nbsp;DA&nbsp;</td>
                                    </tr>";

                                $i = $i + 1;
                                $total = $total + $payement;
                            }

                            echo "	<tr>
	                                   <td colspan=\"4\" style=\"text-align: right;\"><b>Total</b></td> 
	                                   <td><b>&nbsp;$total &nbsp;DA</b></td> 
	                                </tr>";
                    }

                    $reponse->closeCursor();
            }

        catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            } 
	}

	function recettePourModif($nomBD){
			
		global $host_name;
		global $db_user_name;
		global $db_password;

		$database 	= crypterNomDeLaBase($nomBD);

			$date    = date('d/m/Y');  
            $toDay 	 = date('Y-m-d'); 

			try
                {
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);


                    $reponse = $bdd->query('SELECT * FROM `addition`,`patient`,`medecin` WHERE addition.idPatient = patient.idPatient AND addition.idMedecin = medecin.idMedecin ORDER BY `id_addition` DESC');
                    $nbr = $reponse->rowCount();

                    if ($nbr > 0) {
                    	while ($donnees = $reponse->fetch())
                            {
							   $heure  		= $donnees['heure'];
							   $idAddit  	= $donnees['id_addition'];
							   $medecin  	= $donnees['nomMedecin'];
							   $addition  	= $donnees['addition'];
							   $date_cons  	= $donnees['date_cons'];
							   $prenomPat   = $donnees['prenomPatient'];
							   $nomPatient  = $donnees['nomPatient'];

							   $patient 	= $nomPatient . " " . $prenomPat;
							   $heures 		= substr($heure,0,8);

							   echo "<tr>
							   			<td>".$date_cons."	</td>
							   			<td>".$heures." 	</td>
							   			<td>".$patient." 	</td>
							   			<td>".$medecin." 	</td>
							   			<td>".$addition." da</td>
							   			<td>
							   				<input type=\"button\" id=\"modAddition\" class=\"btn btn-success\" style=\"margin-right: 10px;\" value=\"Modifier\" onclick=\"updateAddition('$idAddit','$addition');\" data-toggle=\"modal\" data-target=\"#modalModifAddition\"/>
							   			</td>
							   		</tr>";
                            }
                    }else{
                    	echo "<tr><td>Aujourd'hui ($date)</td><td>Aucune activité enregistré !</td></tr>";
                    }                 
                    
                   $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                } 
	}


	function nbrRDVTB($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	$nbr = 0;

	 			try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                          $date = "'" .date('Y-m-d')."'";
                          $reponse = $bdd->query("SELECT COUNT(id) FROM `rdv` WHERE dateRDV = $date AND statut <> 4");
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                            $nbr = $donnees[0];
						}
						return $nbr;
                        $reponse->closeCursor();
                    }
 
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
						 
				}

function nbrAbsenceTB($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB 	    = crypterNomDeLaBase($nomBD);

	$nbr = 0;

                try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);               

                                                     
                          $date = "'" .date('Y-m-d')."'";
                          $reponse = $bdd->query("SELECT COUNT(id) FROM `rdv` WHERE dateRDV = $date AND statut = 0");
                                                  
                      while ($donnees = $reponse->fetch())
                         {
                            $nbr = $donnees[0];
						}
						return $nbr;
                        $reponse->closeCursor();
                    }
 
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }   
						 
	}
	
    function getIdPatientFromNometPrenom($nomPatient,$prenomPatient){
    
      	global $host_name;
      	global $baseGlobale;
      	global $db_user_name;
      	global $db_password;
    
            try
                {
                  	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                  	$bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                 
                      	$reponse = $bdd->query("SELECT idPatient FROM `patient` WHERE `nomPatient`='$nomPatient' AND `prenomPatient`='$prenomPatient'");
    
                      	$idPatient = "";
    
                      	while ($donnees = $reponse->fetch())
                        {
                            $idPatient  = $donnees['idPatient'];
                        }
    
                        return $idPatient;
                    
                    $reponse->closeCursor();
                }
            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                }           
    }

	function getPatientSignalisation($nomBD,$idUser){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

        try
            {
              	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
              	$bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                             
                  	$reponse = $bdd->query("SELECT `patient_a_risque`,`motif_risque` FROM `patient` WHERE `idPatient` = '$idUser'");

                  	$signallisation	= "";
					$motifsignal 	= "";

                  	while ($donnees = $reponse->fetch())
                    {
                        $signallisation  = $donnees['patient_a_risque'];
                        $motifsignal 	 = $donnees['motif_risque'];

                    }

                    return $signallisation . "||" . $motifsignal;
                
                $reponse->closeCursor();
            }
        catch(Exception $e)
            {
               die('Erreur : '.$e->getMessage());
            }
    }

    function afficheLesRDVParJour($nomBD, $jour){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB = crypterNomDeLaBase($nomBD);
		try
        {
          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
          $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                         
              $date = $jour;
              $ceMoment = date("H:i");
              $reponse = $bdd->prepare("SELECT * FROM rdv WHERE statut <> 4 AND dateRDV = ? order by dateRDV desc, heureRDV asc");
              $reponse->execute(array($jour));
              $rendezVous = $reponse->fetchAll();
              $reponse->closeCursor();

              $premierRDV = premiersRDVDesPatients($bdd, $rendezVous);

          foreach ($rendezVous as $donnees)
             {
                $nouveau = estPremierRDVDuPatient($premierRDV, $donnees['idPatient'], $donnees['statut'], $donnees['dateRDV'], $donnees['heureRDV']);

                echo "<tr>";

                    echo "<td> " . $donnees['nomP'] ." ". $donnees['prenoP'] . "</td>";
                    echo "<td style=\"white-space:nowrap;\"> " . etiquettesSeanceHTML($donnees['type_seance'], $nouveau) . " </td>";
                    echo "<td> $donnees[dateRDV] </td>";
                    echo "<td data-value=\"1\"> $donnees[heureRDV] </td>";
                    echo "<td data-value> $donnees[medecin] </td>";
                    echo "<td data-value> $donnees[tel] </td>";

                echo "</tr>";
			}
        }
    catch(Exception $e)
        {
           die('Erreur : '.$e->getMessage());
        }
	}


	function detailRecetteParJour($nomCabinet, $jourSelectionne){


        $nomCabinet = (String) trim($nomCabinet);
        $dateDuJour = (String) trim($jourSelectionne);

        global $host_name;
		global $db_user_name;
		global $db_password;

        $database   = crypterNomDeLaBase($nomCabinet);                  

	    try{
	                                                                            
	        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	        $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
	                                                    
	        $reponse = $bdd->query("SELECT * FROM `rdv`,`patient`,`addition`,`medecin` WHERE rdv.id = addition.idRDV AND patient.idPatient = addition.idPatient AND medecin.idMedecin = addition.idMedecin AND addition.date_cons='$dateDuJour'");

	        $nbr = $reponse->rowCount();

	        if ($nbr != 0) {
	          	while ($donnees = $reponse->fetch()){
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
	                            <th>Tarif</th>
	                            <th>Note / remarque</th>
	                          </tr>
	                        </thead>
	                        <tbody>";
	                          echo "<tr><td>$motifCons</td>
	                                    <td>$medecin</td>
	                                    <td>$prixConsultation</td>
	                                    <td>$remarque_fin_seance</td></tr>";
	                echo "</tbody></table></section><br><hr style=\"border: 1px solid gray;\"><br>"; 
	              }	                    
	        }else{
	        	echo "Pas de détails à afficher pour ce jour, merci de vérifier la date et de réessayer à nouveau !";
	        }         
	                                                        
	        $reponse->closeCursor();
	    }
	    catch(Exception $e){
        	die('Erreur : '.$e->getMessage());
      	}
	}

	function saveSeances($nomCabinet, $idCab, $medecin, $dateFinProg, $dateDebProg, $typeSeance){


        $nomBD  = crypterNomDeLaBase($nomCabinet);

        global $host_name;
        global $baseGlobale;
        global $db_user_name;
        global $db_password;

        $dureeSeance = dureeParSeance($nomCabinet);

        if ($dureeSeance=="") {
            $dureeSeance = 15;
        }

      	$link = mysqli_connect($host_name, $db_user_name, $db_password, $nomBD);
       
      	if($link === false){
          	die("ERROR: Could not connect. " . mysqli_connect_error());
      	}
       

	    $idCab        = mysqli_real_escape_string($link, $idCab);
	    $medecin 	  = mysqli_real_escape_string($link, $medecin);
	    $dateFinProg  = mysqli_real_escape_string($link, $dateFinProg);
	    $dateDebProg  = mysqli_real_escape_string($link, $dateDebProg);
	    $typeSeance   = mysqli_real_escape_string($link, $typeSeance);

        $jourOuvrables = getNameOuvrableDays($nomCabinet);


        $dateDebProgD = date_create($dateDebProg);
        $dateFinProgD = date_create($dateFinProg);
        $diff        = date_diff($dateDebProgD,$dateFinProgD);
        $nbrJours    = $diff->format("%a");

        $nbrJours    = $nbrJours + 1;

        $tempsEntreLesSeances   = gerDureeEntreRDV($nomCabinet);

        $donneCabinet       = gerOuvertureFermeture($nomCabinet);

        $donneCabinet       = substr($donneCabinet, 0, -1);
        $donneCabinet       = substr($donneCabinet, 1);

        $str                = explode(",",$donneCabinet);

        list($ouvertureCabinet, $fermetureCabinet, $nombrePatParSean) = explode(',', $donneCabinet);

        $ouvertureCabinet = strtotime($ouvertureCabinet);
        $fermetureCabinet = strtotime($fermetureCabinet);

        $dateSelectinee = $dateDebProg;

        $joursOuvert  = explode(",",$jourOuvrables);
        

        for ($i=0; $i < $nbrJours; $i++) { 

            $heureSeance = $ouvertureCabinet;

            setlocale(LC_TIME, "fr_FR");

            $dateTimeselected = strtotime($dateSelectinee);
            $jourSelectinee   = date('Y-m-d',$dateTimeselected);

          
            $jourSelectinee   = date('Y-m-d',strtotime($jourSelectinee . "+". $i ." days"));

            $timestamp = strtotime($jourSelectinee);

            $day = date('D', $timestamp);

            $nomduJour = "-";


            switch ($day) {
                case 'Wed':
                  	$nomduJour = "mercredi";
                break;
              	case 'Thu':
                  	$nomduJour = "jeudi";
                break;
              	case 'Fri':
                  	$nomduJour = "vendredi";
                break;
              	case 'Sat':
                  	$nomduJour = "samedi";
                break;
              	case 'Sun':
                  	$nomduJour = "dimanche";
                break;
              	case 'Mon':
                  	$nomduJour = "lundi";
                break;
              	case 'Tue':
                  	$nomduJour = "mardi";
                break;
            }


          	if (in_array($nomduJour, $joursOuvert)){
              	while ($heureSeance < $fermetureCabinet) {

                  	$heureDF = date('H:i:s', $heureSeance);
                  	insertSeances($nomBD,$typeSeance,$nomduJour,$jourSelectinee,$heureDF);

                  	$heureSeance = strtotime("+".$dureeSeance." minutes", $heureSeance);
                  	$heureSeance = strtotime("+".$tempsEntreLesSeances." minutes", $heureSeance);
              	}
            }   
      	}
	}

	function getDateRdvByRdvID($nomBD,$idRDV){

		global $host_name;
		global $db_user_name;
		global $db_password;

		$nomB 	    = crypterNomDeLaBase($nomBD);

        try {
              $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
              $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                             
                  $reponse = $bdd->query("SELECT dateRDV FROM `rdv` WHERE `id` = '$idRDV' LIMIT 1");

                  $dateSeance 	= "";

                  while ($donnees = $reponse->fetch())
                    {
                        $dateSeance  = $donnees['dateRDV'];
                    }

                    return $dateSeance;
                
                $reponse->closeCursor();
        }
        catch(Exception $e){
               die('Erreur : '.$e->getMessage());
        }
             
    }

	include_once(__DIR__ . "/fonctionsTypeSeance.php");

?>