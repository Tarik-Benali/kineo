<?php
	include("includes/historique.php");
	include("includes/functions.php");

	if (isset($_REQUEST['nomCabinet']) && $_REQUEST['nomCabinet'] !="" && isset($_REQUEST['date']) && $_REQUEST['date'] !="") {

	    global $host_name;
		global $db_user_name;
		global $db_password;

		$nomBD = $_REQUEST['nomCabinet'];
		$date  = $_REQUEST['date'];

		$nomB 	    = crypterNomDeLaBase($nomBD);
		$nbrPatSal  = nbrPatientParSeance($nomBD);
	            try
		            {
		                                    
			            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			            $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
			            
			            // On recupere tout le contenu de la table news
			            $reponse = $bdd->query("SELECT * FROM seance WHERE `date`='$date' AND etat=0");
			            
			            $nbr = $reponse->rowCount();
			            $nbrPatientParScenace = 0;

			            if ($nbr > 0) {
			            	echo "<select name=\"seance\" class=\"form-control\">";
			            	while ($donnees = $reponse->fetch())
	                            {
	                            	$heure       = $donnees['heure'];
	                            	$id_seance   = $donnees['id_seance'];
	                            	$type_seance = $donnees['type_seance'];

	                            	$nbrPlaceVide = getNombrePlacePourSeance($nomBD,$id_seance);

	                            	$heure = substr($heure, 0, 8);

	                            	if ($nbrPlaceVide < $nbrPatSal){
										echo "<option value=\"$id_seance\" style=\"color:#45B6B0\">Séance ".$type_seance." à ".$heure."</option>";
	                            	}else{
	                            		echo "<option value=\"$id_seance\" style=\"color:#FF6B6B\" disabled>Séance ".$type_seance." à ".$heure."</option>";
	                            	}
	                            }
	                        echo "</select>";    
			            }else{
			            	echo "Pas de séances programmées pour ce jour";
			            }

			           $reponse->closeCursor();
		          }

		        catch(Exception $e)
		            {
		               die('Erreur : '.$e->getMessage());
		            }  
    }
    else{
		header('location: ../../auth/logout.php');
	}
?> 