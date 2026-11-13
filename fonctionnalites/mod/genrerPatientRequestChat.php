<?php

 	include("../../includes/functions.php");

   if(isset($_GET['iddoc'])){

        $iddoc  = (String) trim($_GET['iddoc']);
        $idpat  = (String) trim($_GET['idpat']);
        $opera  = (String) trim($_GET['opera']);


		if ($opera == "ajout") {
            acceptChatPatient($iddoc, $idpat);
        }

        elseif ($opera =="suppression") {
            deleteChatPatient($iddoc, $idpat);
        }
				
	}
?>				