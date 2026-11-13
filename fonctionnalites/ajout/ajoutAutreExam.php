<?php
	include("../../includes/historique.php");
	include("../../includes/functions.php");

        global $con;
		
		$ceMoment 		= date("Y-m-d H:i:s");
		$examen 		= mysqli_real_escape_string($con, $_REQUEST['nameExam']);
		$idCabinet      = mysqli_real_escape_string($con, $_REQUEST['idCabinetE']);
        $idFaiseur      = mysqli_real_escape_string($con, $_REQUEST['idFaiseurE']);
        $nomBD          = mysqli_real_escape_string($con, $_REQUEST['nomCabinetE']);
        $objectifE      = mysqli_real_escape_string($con, $_REQUEST['objectifExam']);
        $principeE      = mysqli_real_escape_string($con, $_REQUEST['principeExam']);
        $dossierEx      = mysqli_real_escape_string($con, $_REQUEST['dossierExam']);
        $precaution     = mysqli_real_escape_string($con, $_REQUEST['precautionsExam']);
		
		ajoutExamenNewDansBDDLocal($nomBD,$examen,$objectifE,$principeE,$dossierEx,$precaution);
        hisAjoutExamen($con, $ceMoment , $idCabinet, $idFaiseur, $nomBD);
        header('location: ../../allExams.php');
						

?> 