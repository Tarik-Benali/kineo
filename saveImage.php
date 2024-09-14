<?php
	if (isset($_REQUEST["path"]) && $_REQUEST["path"]!="") {
		$content = file_get_contents($_REQUEST["path"]);
		$date = date("Ymd His")."jpg";

		if (file_put_contents("Téléchargements/", $content);) {
			echo "Image Enregistré dans le fichier Téléchargements";
		}else{
			echo "Téléchargement échoué !";
		}
		

		
	}
?>