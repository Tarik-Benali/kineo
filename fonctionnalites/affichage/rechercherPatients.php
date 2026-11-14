<?php
	include("../../auth/auth.php");
	include("../../includes/functions.php");

	/* -------------------------------------------------------------------------
	 * Recherche de patients (autocomplete)
	 * Paramètres : q (nom, prénom, "nom prénom", téléphone ou mail), offset
	 * Réponse    : { total, offset, parPage, patients: [...] }
	 * ------------------------------------------------------------------------- */

	header('Content-Type: application/json; charset=utf-8');

	global $host_name;
	global $db_user_name;
	global $db_password;

	$parPage = 20;
	$offset  = isset($_GET['offset']) ? max(0, (int) $_GET['offset']) : 0;

	$recherche = isset($_GET['q']) ? trim(preg_replace('/\s+/', ' ', (string) $_GET['q'])) : "";
	$recherche = substr($recherche, 0, 60);

	if ($recherche == "") {
		echo json_encode(array("total" => 0, "offset" => 0, "parPage" => $parPage, "patients" => array()));
		exit();
	}

	// Chaque mot saisi doit correspondre (ex : "chikh sara" = nom chikh + prénom sara)
	$mots       = array_slice(explode(" ", $recherche), 0, 4);
	$conditions = array();
	$valeurs    = array();

	foreach ($mots as $mot) {

		$chiffres = preg_replace('/[^0-9]/', '', $mot);

		if ($chiffres != "" && strlen($chiffres) == strlen($mot)) {
			// Téléphone (n'importe quelle partie du numéro)
			$conditions[] = "(`numTelPatient` LIKE ? OR `phone_2` LIKE ? OR `phone_3` LIKE ?)";
			array_push($valeurs, "%$chiffres%", "%$chiffres%", "%$chiffres%");
		}else{
			// Début du nom, du prénom (y compris noms composés) ou du mail
			$conditions[] = "(`nomPatient` LIKE ? OR `prenomPatient` LIKE ? OR `nomPatient` LIKE ? OR `prenomPatient` LIKE ? OR `emailPatient` LIKE ?)";
			array_push($valeurs, "$mot%", "$mot%", "% $mot%", "% $mot%", "$mot%");
		}
	}

	$where = implode(" AND ", $conditions);

	// Les noms qui correspondent exactement au premier mot passent en premier
	$premierMot = $mots[0];
	$tri        = "CASE WHEN `nomPatient` = ? THEN 0 WHEN `nomPatient` LIKE ? THEN 1 WHEN `prenomPatient` LIKE ? THEN 2 ELSE 3 END, `nomPatient`, `prenomPatient`";
	$valeursTri = array($premierMot, "$premierMot%", "$premierMot%");

	try
		{
			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			$nomB = crypterNomDeLaBase("");
			$bdd  = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

			$reponse = $bdd->prepare("SELECT COUNT(*) FROM `patient` WHERE $where");
			$reponse->execute($valeurs);
			$total = (int) $reponse->fetchColumn();
			$reponse->closeCursor();

			$reponse = $bdd->prepare("SELECT `idPatient`, `nomPatient`, `prenomPatient`, `dateNaissPatient`, `numTelPatient`, `phone_2`, `phone_3`, `patient_a_risque` FROM `patient` WHERE $where ORDER BY $tri LIMIT $offset, $parPage");
			$reponse->execute(array_merge($valeurs, $valeursTri));
			$lignes = $reponse->fetchAll();
			$reponse->closeCursor();

			// Historique des RDV : dernière séance, nombre de séances, prochain RDV
			$historique = array();
			$ids        = array();

			foreach ($lignes as $ligne) {
				$ids[] = $ligne['idPatient'];
			}

			if (count($ids) > 0) {

				$marque  = implode(",", array_fill(0, count($ids), "?"));
				$reponse = $bdd->prepare("SELECT `idPatient`,
						MAX(CASE WHEN `statut` IN (1, 2, 3) THEN `dateRDV` END) AS derniere,
						SUM(CASE WHEN `statut` IN (1, 2, 3) THEN 1 ELSE 0 END) AS nbSeances,
						MIN(CASE WHEN `statut` IN (5, 6) AND `dateRDV` >= ? THEN `dateRDV` END) AS prochain
					FROM `rdv` WHERE `idPatient` IN ($marque) GROUP BY `idPatient`");
				$reponse->execute(array_merge(array(date('Y-m-d')), $ids));

				while ($donnees = $reponse->fetch())
				{
					$historique[$donnees['idPatient']] = $donnees;
				}
				$reponse->closeCursor();
			}

			$formatDate = function($date){
				$date = trim((string) $date);
				if (preg_match('/^(\d{4})-(\d{2})-(\d{2})/', $date, $p) && $p[1] > 1900) {
					return $p[3] . "/" . $p[2] . "/" . $p[1];
				}
				return "";
			};

			$patients = array();

			foreach ($lignes as $ligne) {

				$age = "";
				if (preg_match('/^(\d{4})-(\d{2})-(\d{2})/', trim($ligne['dateNaissPatient']), $p) && $p[1] > 1900) {
					$age = (int) date_diff(date_create($p[1] . "-" . $p[2] . "-" . $p[3]), date_create('today'))->y;
				}

				$telephones = array();
				foreach (array($ligne['numTelPatient'], $ligne['phone_2'], $ligne['phone_3']) as $tel) {
					$tel = trim((string) $tel);
					if ($tel != "" && !in_array($tel, $telephones)) {
						$telephones[] = $tel;
					}
				}

				$h = isset($historique[$ligne['idPatient']]) ? $historique[$ligne['idPatient']] : null;

				$patients[] = array(
					"id"             => $ligne['idPatient'],
					"nom"            => trim($ligne['nomPatient']),
					"prenom"         => trim($ligne['prenomPatient']),
					"telephones"     => $telephones,
					"naissance"      => $formatDate($ligne['dateNaissPatient']),
					"age"            => $age,
					"risque"         => ($ligne['patient_a_risque'] == "1"),
					"derniereSeance" => $h ? $formatDate($h['derniere']) : "",
					"nbSeances"      => $h ? (int) $h['nbSeances'] : 0,
					"prochainRDV"    => $h ? $formatDate($h['prochain']) : ""
				);
			}

			echo json_encode(array("total" => $total, "offset" => $offset, "parPage" => $parPage, "patients" => $patients), JSON_INVALID_UTF8_SUBSTITUTE);
		}
	catch(Exception $e)
		{
			http_response_code(500);
			echo json_encode(array("erreur" => "Erreur lors de la recherche"));
		}
?>
