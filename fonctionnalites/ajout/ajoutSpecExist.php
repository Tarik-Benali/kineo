<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

  global $host_name;
  global $baseGlobale;
  global $db_user_name;
  global $db_password;

		$con = mysqli_connect($host_name, $db_user_name, $db_password, $baseGlobale);

		
		$ceMoment 		= date("Y-m-d H:i:s");
		$specialite		= mysqli_real_escape_string($con, $_REQUEST['specialite']);
		$idCabinet 		= mysqli_real_escape_string($con, $_REQUEST['idCabinet']);
		$idFaiseur 		= mysqli_real_escape_string($con, $_REQUEST['idFaiseur']);
		$nomBD 			  = mysqli_real_escape_string($con, $_REQUEST['nomCabinet']);
		

						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);  
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT * FROM specialite WHERE nomspecialite='$specialite'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {

                                 $specialite 	= $donnees['nomSpecialite'];	
                                 $specialite    = str_replace("'","`",$specialite);

                                }
                                ajoutSpecDansBDDLocal($con,$ceMoment,$idCabinet,$idFaiseur,$nomBD,$specialite);
                                header('location: ../../specialitesCabinet.php');

                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 

?> 