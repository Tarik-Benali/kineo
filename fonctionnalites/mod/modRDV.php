<?php
  include("../../auth/auth.php");
	include("../../includes/functions.php");


if (isset($_SESSION['typeCompte']) && isset($_REQUEST['nomCabinet']) && $_SESSION['typeCompte'] !="" && $_REQUEST['nomCabinet'] !=""){

	global $host_name;
	global $db_user_name;
	global $db_password;

		$nomBD = $_REQUEST['nomCabinet'];

		$nomB 	    = crypterNomDeLaBase($nomBD);

		$con = mysqli_connect($host_name,$db_user_name,$db_password,$nomB);

		if ($con->connect_error) {
		    die("Connection failed: " . $con->connect_error);
		}

		//verifSiPatDejaDsCabinet($identifiantP, $idCab);
		$name   = "";
		$mail   = "";
		$phone  = "";
		$prenom = ""; 

		
		$typeModif = $_REQUEST['typeModif'];


		//Type Modif : 1 - modifider toutes les données du RDV, 2 - modifier l'etat ou validité, 3 - supprimer le RDV. 
		if ($typeModif == 1) {

			$idRDV = $_REQUEST['idRDVModif'];

			// Escape user inputs for security
			$type         = mysqli_real_escape_string($con, $_REQUEST['type']);
			$idCab        = mysqli_real_escape_string($con, $_REQUEST['idCab']);
			$dateRDV      = mysqli_real_escape_string($con, $_REQUEST['dateRDV']);
			$medecin 	    = mysqli_real_escape_string($con, $_REQUEST['medecin']);
			$idSeance     = mysqli_real_escape_string($con, $_REQUEST['seance']);
			$motifCons    = mysqli_real_escape_string($con, $_REQUEST['motifCons']);
			$identifiantP = mysqli_real_escape_string($con, $_REQUEST['idPatien']);

			$motifCons    = str_replace("'", "`", $motifCons);
			$typeSeance   = normaliserTypeSeance(isset($_REQUEST['typeSeance']) ? $_REQUEST['typeSeance'] : "simple");
			$majTypeSeance = isset($_REQUEST['typeSeance']) ? ",`type_seance`='$typeSeance'" : "";

			if (isset($_REQUEST['timeRDV']) && $_REQUEST['timeRDV'] !="") {
				$heureRDV     = mysqli_real_escape_string($con, $_REQUEST['timeRDV']);
			}else{
				$heureRDV = getHeureFromSeance($nomBD,$idSeance);
			}

			if ($identifiantP != "") {
				try
	                {
	                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
	                                
	                    // On recupere tout le contenu de la table news
	                    $reponse = $bdd->query("SELECT * FROM patient WHERE idPatient = '$identifiantP'");
	                                                      
	                    // On affiche le resultat
	                    while ($donnees = $reponse->fetch())
	                       {
	                            $name   = $donnees['nomPatient'];
	                            $mail   = $donnees['emailPatient'];
	                            $phone  = $donnees['numTelPatient'];
	                            $prenom = $donnees['prenomPatient'];                                                      
	                        }
	                    $reponse->closeCursor();
	                }
	            catch(Exception $e)
	                {
	                   die('Erreur : '.$e->getMessage());
	                }

	                $docName	= getMedecinName($medecin);


	                $sql = "UPDATE `rdv` SET `nomP`='$name',`prenoP`='$prenom',`mail`='$mail',`tel`='$phone',`dateRDV`='$dateRDV',`heureRDV`='$heureRDV',`medecin`='$docName',`motifCons`='$motifCons',`idMedecin`='$medecin',`idPatient`='$identifiantP'$majTypeSeance WHERE`id`='$idRDV'";

					if ($con->query($sql) === TRUE) {

						$sqls = "UPDATE `rel_seance_rdv` SET `id_seance`='$idSeance' WHERE `id`='$idRDV'";

						if ($con->query($sqls) === TRUE) {

							insertStat($nomBD,"changement_rdv");
							header("Location: ../../medecin.php");
						    
						} else {
						    echo "Error updating record: " . $con->error;
						}

						//header("Location: ../../medecin.php");
					    
					} else {
					    echo "Error updating record: " . $con->error;
					}
			}else{
	                $docName	= getMedecinName($medecin);

	                $sql = "UPDATE `rdv` SET`dateRDV`='$dateRDV',`heureRDV`='$heureRDV',`medecin`='$docName',`motifCons`='$motifCons',`idMedecin`='$medecin',`idPatient`='$identifiantP'$majTypeSeance WHERE`id`='$idRDV'";

					if ($con->query($sql) === TRUE) {

						$sqls = "UPDATE `rel_seance_rdv` SET `id_seance`='$idSeance' WHERE `id`='$idRDV'";

						if ($con->query($sqls) === TRUE) {

							//echo "hhhh";
							//insertStat($nomBD,"changement_rdv");
							insertChangement($nomBD);
							header("Location: ../../medecin.php");
						    
						} else {
						    echo "Error updating record: " . $con->error;
						}

						//header("Location: ../../medecin.php");
					    
					} else {
					    echo "Error updating record: " . $con->error;
					}
			}

				
		}

		else if ($typeModif == 2) {

			$idRDV = $_REQUEST['idRDVStats'];

			$stat = mysqli_real_escape_string($con, $_REQUEST['etatRDV']);

			
            $sql = "UPDATE `rdv` SET `statut`='$stat' WHERE`id`='$idRDV'";

			if ($con->query($sql) === TRUE) {
				header("Location: ../../medecin.php");
			} else {
			    echo "Error updating record: " . $con->error;
			}

				
		}

		else if ($typeModif == 3) {

			//Suppression rendez-vous / indice 4 de suppression	

			$idRDV = $_REQUEST['idRDVStats'];	

            $sql = "UPDATE `rdv` SET `statut`='4' WHERE`id`='$idRDV'";

			if ($con->query($sql) === TRUE) {
				
				insertAnnulation($nomBD);
				header("Location: ../../medecin.php");
			} else {
			    echo "Error updating record: " . $con->error;
			}
					
		}else{
			echo $typeModif;
		}

}else{
  echo "Rendez-vous non Ajouté, informations manquantes !";
}

?>
 