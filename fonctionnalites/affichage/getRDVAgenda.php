<?php
	include("../../auth/auth.php");
	include("../../includes/functions.php");

	header('Content-Type: application/json; charset=utf-8');

	if (isset($_SESSION['idDeCeMedecin']) && isset($_SESSION['nomDeCeCabinet']) && isset($_REQUEST['start']) && isset($_REQUEST['end'])) {

		$idMedecin  = $_SESSION['idDeCeMedecin'];
		$nomCabinet = $_SESSION['nomDeCeCabinet'];

		// Le calendrier envoie la période affichée (ex: 2026-10-26T00:00:00+01:00)
		$dateDebut = substr($_REQUEST['start'], 0, 10);
		$dateFin   = substr($_REQUEST['end'], 0, 10);

		if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateDebut) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateFin)) {
			echo "[]";
			exit();
		}

		$lesRDV = getRDVForAgendaPeriode($nomCabinet, $idMedecin, $dateDebut, $dateFin);

		echo json_encode($lesRDV, JSON_INVALID_UTF8_SUBSTITUTE);

	}else{
		echo "[]";
	}
?>
