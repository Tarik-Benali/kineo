<?php

/* -------------------------------------------------------------------------
 * Types de séance d'un rendez-vous
 * (simple, vestibulaire, bilan_vestibulaire, esthetique)
 * ------------------------------------------------------------------------- */

function typesSeanceDisponibles(){

	return array(
		"simple"             => "Séance Simple",
		"vestibulaire"       => "Séance Vestibulaire",
		"bilan_vestibulaire" => "Bilan Vestibulaire",
		"esthetique"         => "Séance Esthétique"
	);
}

function normaliserTypeSeance($typeSeance){

	$typeSeance = trim((string) $typeSeance);

	if (array_key_exists($typeSeance, typesSeanceDisponibles())) {
		return $typeSeance;
	}

	return "simple";
}

function libelleTypeSeance($typeSeance){

	$types = typesSeanceDisponibles();

	return $types[normaliserTypeSeance($typeSeance)];
}

function afficherOptionsTypeSeance($typeSelectionne = "simple"){

	$typeSelectionne = normaliserTypeSeance($typeSelectionne);

	foreach (typesSeanceDisponibles() as $valeur => $libelle) {
		$selected = ($valeur == $typeSelectionne) ? " selected" : "";
		echo "<option value=\"$valeur\"$selected>$libelle</option>";
	}
}


/* -------------------------------------------------------------------------
 * Nouveau patient : premier rendez-vous du patient
 * (les absences et les suppressions ne comptent pas)
 * ------------------------------------------------------------------------- */

function premiersRDVDesPatients($bdd, $rendezVous){

	$premierRDV  = array();
	$idsPatients = array();

	foreach ($rendezVous as $donnees) {
		$idPat = trim((string) $donnees['idPatient']);
		if ($idPat != "") {
			$idsPatients[$idPat] = true;
		}
	}

	if (count($idsPatients) > 0) {

		$ids    = array_keys($idsPatients);
		$marque = implode(",", array_fill(0, count($ids), "?"));

		$reponse = $bdd->prepare("SELECT TRIM(`idPatient`) AS idPatient, MIN(CONCAT(`dateRDV`, ' ', `heureRDV`)) AS premier FROM `rdv` WHERE `statut` NOT IN (0, 4) AND TRIM(`idPatient`) IN ($marque) GROUP BY TRIM(`idPatient`)");
		$reponse->execute($ids);

		while ($donnees = $reponse->fetch())
		{
			$premierRDV[$donnees['idPatient']] = $donnees['premier'];
		}
		$reponse->closeCursor();
	}

	return $premierRDV;
}

function estPremierRDVDuPatient($premierRDV, $idPatient, $statut, $jour, $heure){

	$idPatient = trim((string) $idPatient);

	if ($idPatient == "" || $statut == "0" || !isset($premierRDV[$idPatient])) {
		return false;
	}

	return (($jour . " " . $heure) <= $premierRDV[$idPatient]);
}


/* -------------------------------------------------------------------------
 * Etiquettes V / BV / E / N (styles en ligne pour rester visibles à l'impression)
 * ------------------------------------------------------------------------- */

function etiquettesSeanceHTML($typeSeance, $nouveau){

	$etiquettes = array(
		"vestibulaire"       => array("V",  "#8E44AD"),
		"bilan_vestibulaire" => array("BV", "#AD1457"),
		"esthetique"         => array("E",  "#B7950B")
	);

	$style = "display:inline-block; padding:1px 6px; margin-right:3px; border-radius:3px; font-weight:bold; font-size:11px; line-height:16px; -webkit-print-color-adjust:exact; print-color-adjust:exact;";

	$typeSeance = normaliserTypeSeance($typeSeance);
	$html       = "";

	if (isset($etiquettes[$typeSeance])) {
		list($code, $couleur) = $etiquettes[$typeSeance];
		$html .= "<span class=\"etiquette-impression\" data-etiquette=\"$code\" title=\"" . libelleTypeSeance($typeSeance) . "\" style=\"$style color:#fff; background:$couleur; border:1px solid $couleur;\">$code</span>";
	}else{
		$html .= "<span style=\"color:#888; margin-right:3px;\">Simple</span>";
	}

	if ($nouveau) {
		$html .= "<span class=\"etiquette-impression\" data-etiquette=\"N\" title=\"Nouveau patient\" style=\"$style color:#E74C3C; background:#fff; border:1px solid #E74C3C;\">N</span>";
	}

	return $html;
}


/* -------------------------------------------------------------------------
 * Agenda : rendez-vous d'une période (chargés à la demande par le calendrier)
 * ------------------------------------------------------------------------- */

function getRDVForAgendaPeriode($nomBD, $idMedecin, $dateDebut, $dateFin){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB = crypterNomDeLaBase($nomBD);

	$lesRDV = array();

	try
		{
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

			$reponse = $bdd->prepare("SELECT * FROM `rdv` WHERE `statut` <> 4 AND `idMedecin` = ? AND `dateRDV` >= ? AND `dateRDV` < ? ORDER BY `dateRDV`, `heureRDV`");
			$reponse->execute(array($idMedecin, $dateDebut, $dateFin));
			$rendezVous = $reponse->fetchAll();
			$reponse->closeCursor();

			$premierRDV = premiersRDVDesPatients($bdd, $rendezVous);

			foreach ($rendezVous as $donnees) {

				$idRDV     = $donnees['id'];
				$jour      = $donnees['dateRDV'];
				$heure     = $donnees['heureRDV'];
				$motif     = $donnees['motifCons'];
				$medecin   = $donnees['medecin'];
				$patient   = $donnees['nomP'] . "_" . $donnees['prenoP'];
				$idPatient = $donnees['idPatient'];
				$statut    = $donnees['statut'];

				$typeSeance = normaliserTypeSeance(isset($donnees['type_seance']) ? $donnees['type_seance'] : "simple");

				$jour = str_replace("/","-",$jour);
				$jour = date('Y-m-d', strtotime($jour));

				// Patient à risque
				if ($donnees['patient_a_risque'] == "1") {
					$nonConfirmedColor    = "#000000";
					$signalisationPatient = "risque";
				}else{
					$nonConfirmedColor    = "#A8BDCF";
					$signalisationPatient = "non_risque";
				}

				$nouveau = estPremierRDVDuPatient($premierRDV, $idPatient, $statut, $jour, $heure);

				// Même format de description que l'ancien agenda (utilisé par eventClick)
				$espace = ($statut == "6") ? "" : " ";
				$description = $idRDV."<br>Motif de consultation: ".$motif.".<br>  Kinésithérapeute: ".$medecin.".<br>  Heure: ".$heure."<br>  Statut: ".$statut."<br>".$espace."Id Patient: ".$idPatient;

				switch ($statut) {
					case '6':
						$couleur = $nonConfirmedColor;
						break;
					case '0':
						$couleur = "#FF6B6B";
						break;
					case '1':
						$couleur = "#65C3DF";
						break;
					case '2':
						$couleur = "#FFA200";
						break;
					case '3':
						$couleur = "#45B6B0";
						break;
					case '5':
						$couleur = "#337ab7";
						break;
					default:
						$couleur = "#A8BDCF";
						break;
				}

				$evenement = array(
					"title"       => $patient,
					"start"       => $jour . "T" . $heure,
					"filtre"      => $signalisationPatient,
					"description" => $description,
					"color"       => $couleur,
					"type_seance" => $typeSeance,
					"nouveau"     => $nouveau
				);

				if ($statut == "6") {
					$evenement["profile"] = "patient";
				}

				$lesRDV[] = $evenement;
			}

			return $lesRDV;
		}
	catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
}


/* -------------------------------------------------------------------------
 * Historique des rendez-vous : recherche côté serveur + pagination
 * ------------------------------------------------------------------------- */

function libelleStatutRDV($statut){

	switch ((string) $statut) {
		case '0': return array("Absent", "danger");
		case '1': return array("Présent", "info");
		case '2': return array("En salle", "warning");
		case '3': return array("Terminé", "success");
		case '4': return array("Supprimé", "inverse");
		case '5': return array("Confirmé", "primary");
		case '6': return array("Non confirmé", "default");
	}

	return array("-", "default");
}

function getKinesPourHistoriqueRDV($nomBD){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB  = crypterNomDeLaBase($nomBD);
	$kines = array();

	try
		{
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

			$reponse = $bdd->query("SELECT `idMedecin`, MAX(`medecin`) AS medecin FROM `rdv` GROUP BY `idMedecin` ORDER BY medecin");

			while ($donnees = $reponse->fetch())
			{
				$kines[$donnees['idMedecin']] = $donnees['medecin'];
			}
			$reponse->closeCursor();

			return $kines;
		}
	catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
}

function rechercheHistoriqueRDV($nomBD, $criteres, $page, $parPage){

	global $host_name;
	global $db_user_name;
	global $db_password;

	$nomB = crypterNomDeLaBase($nomBD);

	$conditions = array();
	$valeurs    = array();

	if (isset($criteres['recherche']) && $criteres['recherche'] != "") {
		$mot = "%" . $criteres['recherche'] . "%";
		$conditions[] = "(`nomP` LIKE ? OR `prenoP` LIKE ? OR `tel` LIKE ? OR CONCAT(`nomP`, ' ', `prenoP`) LIKE ? OR CONCAT(`prenoP`, ' ', `nomP`) LIKE ?)";
		array_push($valeurs, $mot, $mot, $mot, $mot, $mot);
	}

	if (isset($criteres['idPatient']) && $criteres['idPatient'] != "") {
		$conditions[] = "TRIM(`idPatient`) = ?";
		$valeurs[]    = trim($criteres['idPatient']);
	}

	if (isset($criteres['dateDebut']) && $criteres['dateDebut'] != "") {
		$conditions[] = "`dateRDV` >= ?";
		$valeurs[]    = $criteres['dateDebut'];
	}

	if (isset($criteres['dateFin']) && $criteres['dateFin'] != "") {
		$conditions[] = "`dateRDV` <= ?";
		$valeurs[]    = $criteres['dateFin'];
	}

	if (isset($criteres['statut']) && $criteres['statut'] !== "") {
		$conditions[] = "`statut` = ?";
		$valeurs[]    = $criteres['statut'];
	}

	if (isset($criteres['typeSeance']) && $criteres['typeSeance'] != "") {
		$conditions[] = "`type_seance` = ?";
		$valeurs[]    = normaliserTypeSeance($criteres['typeSeance']);
	}

	if (isset($criteres['idMedecin']) && $criteres['idMedecin'] != "") {
		$conditions[] = "`idMedecin` = ?";
		$valeurs[]    = $criteres['idMedecin'];
	}

	$where = (count($conditions) > 0) ? "WHERE " . implode(" AND ", $conditions) : "";

	$page    = max(1, (int) $page);
	$parPage = max(1, (int) $parPage);
	$debut   = ($page - 1) * $parPage;

	try
		{
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

			$reponse = $bdd->prepare("SELECT COUNT(*) FROM `rdv` $where");
			$reponse->execute($valeurs);
			$total = (int) $reponse->fetchColumn();
			$reponse->closeCursor();

			$reponse = $bdd->prepare("SELECT * FROM `rdv` $where ORDER BY `dateRDV` DESC, `heureRDV` DESC, `id` DESC LIMIT $debut, $parPage");
			$reponse->execute($valeurs);
			$lignes = $reponse->fetchAll();
			$reponse->closeCursor();

			return array("total" => $total, "lignes" => $lignes);
		}
	catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
}

?>
