<?php 
	include_once 'config/Database.php';
	include_once 'class/Notification.php';
	include_once 'class/User.php';
	//include_once '../includes/functions.php';


	$database 	  = new Database();
	$db 		  = $database->getConnection();
	$notification = new Notification($db);
	$user 		  = new User($db);

	if (isset($_POST['message'])) { 
		if(isset($_POST['message']) and isset($_POST['ntime']) and isset($_POST['loops']) and isset($_POST['loop_every']) and isset($_POST['user'])) {
			$notification->title   = $_POST['title'];
			$notification->message = $_POST['message'];
			$notification->ntime   = date('Y-m-d H:i:s'); 
			$notification->repeat  = $_POST['loops']; 
			$notification->nloop   = $_POST['loop_every']; 
			$notification->iduser  = $_POST['user'];

			//echo $_POST['title'] . " " .$_POST['message']. " " .$_POST['loops']. " " .$_POST['loop_every']. " " .$_POST['user'];

				
			if($notification->saveNotification()) {
				echo '* save new notification success';

				header("Location: ../consultation.php?");
			} else {
				echo 'error save data';
				header("Location: ../consultation.php?");
			}
		} else {
			echo '* completed the parameter above';
			header("Location: ../consultation.php?");
		}
	}
?>