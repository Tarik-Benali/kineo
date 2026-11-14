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

			// Seules les informations réellement modifiées dans le formulaire sont enregistrées
			$idRDV = isset($_REQUEST['idRDVModif']) ? trim($_REQUEST['idRDVModif']) : "";

			try
                {
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                    $reponse = $bdd->prepare("SELECT * FROM `rdv` WHERE `id` = ?");
                    $reponse->execute(array($idRDV));
                    $rdvActuel = $reponse->fetch();
                    $reponse->closeCursor();

                    if (!$rdvActuel) {
                        header("Location: ../../medecin.php");
                        exit();
                    }

                    $champs      = array();
                    $valeurs     = array();
                    $idSeanceMaj = "";

                    // Date
                    $dateActuelle = date('Y-m-d', strtotime(str_replace("/", "-", $rdvActuel['dateRDV'])));
                    $dateRDV      = isset($_REQUEST['dateRDV']) ? trim($_REQUEST['dateRDV']) : "";

                    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateRDV) && $dateRDV != $dateActuelle) {
                        $champs[]  = "`dateRDV` = ?";
                        $valeurs[] = $dateRDV;
                    }

                    // Heure : uniquement si une séance a été choisie dans la liste
                    $idSeance = isset($_REQUEST['seance']) ? trim($_REQUEST['seance']) : "";

                    if (isset($_REQUEST['timeRDV']) && trim($_REQUEST['timeRDV']) != "") {
                        $heureRDV = trim($_REQUEST['timeRDV']);
                    }else if ($idSeance != "") {
                        $heureRDV = getHeureFromSeance($nomBD, $idSeance);
                    }else{
                        $heureRDV = "";
                    }

                    $heureChangee = ($heureRDV != "" && substr($heureRDV, 0, 5) != substr($rdvActuel['heureRDV'], 0, 5));

                    if ($heureChangee) {
                        $champs[]  = "`heureRDV` = ?";
                        $valeurs[] = $heureRDV;
                    }

                    // Nouvelle séance (créneau) seulement si la date ou l'heure a changé
                    if ($idSeance != "" && ($heureChangee || count($champs) > 0)) {
                        $idSeanceMaj = $idSeance;
                    }

                    // Patient : uniquement si un autre patient a été sélectionné
                    $identifiantP = isset($_REQUEST['idPatien']) ? trim($_REQUEST['idPatien']) : "";
                    $patientMaj   = false;

                    if ($identifiantP != "" && $identifiantP != trim($rdvActuel['idPatient'])) {

                        $reponse = $bdd->prepare("SELECT * FROM `patient` WHERE TRIM(`idPatient`) = ? LIMIT 1");
                        $reponse->execute(array($identifiantP));
                        $patient = $reponse->fetch();
                        $reponse->closeCursor();

                        if ($patient) {
                            array_push($champs, "`nomP` = ?", "`prenoP` = ?", "`mail` = ?", "`tel` = ?", "`idPatient` = ?");
                            array_push($valeurs, $patient['nomPatient'], $patient['prenomPatient'], $patient['emailPatient'], $patient['numTelPatient'], $identifiantP);
                            $patientMaj = true;
                        }
                    }

                    // Motif
                    if (isset($_REQUEST['motifCons'])) {
                        $motifCons   = str_replace("'", "`", trim($_REQUEST['motifCons']));
                        $motifActuel = trim($rdvActuel['motifCons']);

                        // "Aucun motif indiqué pour cette séance !" (avec ou sans points) = pas de motif
                        if ($motifCons == "." || strpos($motifCons, "Aucun motif indiqu") === 0) {
                            $motifCons = "";
                        }
                        if ($motifActuel == "." || strpos($motifActuel, "Aucun motif indiqu") === 0) {
                            $motifActuel = "";
                        }

                        if ($motifCons != $motifActuel && $motifCons != $motifActuel . ".") {
                            $champs[]  = "`motifCons` = ?";
                            $valeurs[] = $motifCons;
                        }
                    }

                    // Type de séance
                    if (isset($_REQUEST['typeSeance'])) {
                        $typeSeance = normaliserTypeSeance($_REQUEST['typeSeance']);

                        if ($typeSeance != normaliserTypeSeance($rdvActuel['type_seance'])) {
                            $champs[]  = "`type_seance` = ?";
                            $valeurs[] = $typeSeance;
                        }
                    }

                    if (count($champs) > 0) {
                        $valeurs[] = $idRDV;
                        $reponse   = $bdd->prepare("UPDATE `rdv` SET " . implode(", ", $champs) . " WHERE `id` = ?");
                        $reponse->execute($valeurs);
                    }

                    if ($idSeanceMaj != "") {
                        $reponse = $bdd->prepare("UPDATE `rel_seance_rdv` SET `id_seance` = ? WHERE `id` = ?");
                        $reponse->execute(array($idSeanceMaj, $idRDV));
                    }

                    if (count($champs) > 0) {
                        if ($patientMaj || trim($rdvActuel['idPatient']) != "") {
                            insertStat($nomBD,"changement_rdv");
                        }else{
                            insertChangement($nomBD);
                        }
                    }

                    header("Location: ../../medecin.php");
                }
            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
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
 