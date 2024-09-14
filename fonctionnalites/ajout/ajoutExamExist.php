<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

        global $host_name;
        global $baseGlobale;
        global $db_user_name;
        global $db_password;
        
		$con = mysqli_connect($host_name, $db_user_name, $db_password, $baseGlobale);

		
		$ceMoment 		= date("Y-m-d H:i:s");
		$examen 		= mysqli_real_escape_string($con, $_REQUEST['examen']);
		$idCabinet 		= mysqli_real_escape_string($con, $_REQUEST['idCabinet']);
		$idFaiseur 		= mysqli_real_escape_string($con, $_REQUEST['idFaiseur']);
		$nomBD 			= mysqli_real_escape_string($con, $_REQUEST['nomCabinet']);
		
        
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);  
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT * FROM all_examens WHERE typeExamen='$examen'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                 $idExamen  = $donnees['idExamen'];

                                 $obj 		= $donnees['objectif'];
                                 $obj       = str_replace("'","`",$obj);

                                 $principe 	= $donnees['principe'];	
                                 $principe  = str_replace("'","`",$principe);

                                 $dossier 	= $donnees['dossierApporter'];
                                 $dossier   = str_replace("'","`",$dossier);	
                                 
                                 $precau 	= $donnees['precautions'];
                                 $precau    = str_replace("'","`",$precau);	

                                }
                                ajoutExamenDansBDDLocal($nomBD,$idExamen,$examen,$obj,$principe,$dossier,$precau);
                                ajoutRelationCabSpecialite($idCabinet,$idExamen);
                                hisAjoutExamen($con, $ceMoment , $idCabinet, $idFaiseur, $idExamen);
                                insertionPrixNouveauExamen($nomBD,$idExamen);
                                header('location: ../../allExams.php');

                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 

?> 