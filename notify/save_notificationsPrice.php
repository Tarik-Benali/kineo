<?php 
	include_once 'config/Database.php';
	include_once 'class/Notification.php';
	include_once 'class/User.php';
	include_once '../includes/functions.php';


	$database 	  = new Database();
	$db 		  = $database->getConnection();
	$notification = new Notification($db);
	$user 		  = new User($db);

	if (isset($_REQUEST['message'])) { 

		if(isset($_REQUEST['message']) and isset($_REQUEST['ntime']) and isset($_REQUEST['loops']) and isset($_REQUEST['loop_every']) and isset($_REQUEST['user'])) {

			
			
			$doc 	= $_REQUEST['doc'];
			$user 	= $_REQUEST['user'];
			$title 	= $_REQUEST['title'];
			$ntime 	= $_REQUEST['ntime'];
			$loops 	= $_REQUEST['loops'];
			$message 	= $_REQUEST['message'];
			$prixCons 	= $_REQUEST['prixCons'];
			$idPatien 	= $_REQUEST['idPatien'];
			$loop_every = $_REQUEST['loop_every'];

			$title = $title . " DA";

			$nomPatient = getPatientNameEtPrenom($idPatien);
			$message	= "Patient: ". $nomPatient . "\r\nDr, ".$doc;


			$notification->title   = $title;
			$notification->message = $message;
			$notification->ntime   = date('Y-m-d H:i:s'); 
			$notification->repeat  = $loops; 
			$notification->nloop   = $loop_every; 
			$notification->iduser  = $user;

				
			if($notification->saveNotification()) {
				echo '* save new notification success';

			} else {
				echo 'error save data';
			}
		} else {
			echo '* completed the parameter above';
		}
	}
?>