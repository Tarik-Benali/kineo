<?php
  include("../../auth/auth.php");
  include("../../includes/functions.php");


if (isset($_SESSION['typeCompte']) && isset($_REQUEST['nomCabinet']) && $_SESSION['typeCompte'] !="" && $_REQUEST['nomCabinet'] !="" && isset($_REQUEST['idRDV'])!="" && $_REQUEST['idRDV'] !=""){

	global $host_name;
	global $db_user_name;
	global $db_password;

		

	global $host_name;
	global $db_user_name;
	global $db_password;

	$idRDV = $_REQUEST['idRDV'];
	$nomBD = $_REQUEST['nomCabinet'];

	$nomB 	    = crypterNomDeLaBase($nomBD);

			try
                {
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);

                        $reponse = $bdd->query("SELECT `statut` FROM `rdv` WHERE id='$idRDV'");
                            
                        $nbr = $reponse->rowCount();
                        
                        if ($nbr > 0) {

                        	while ($donnees = $reponse->fetch())
                                {
                                	$stats    = $donnees['statut'];

                                	switch ($stats) {
                                		case '0':
                                				echo "<select class=\"btn btn-default\" name=\"etatRDV\" id=\"etatRDV\">
													    <option value=\"0\">Absent</option>
													    <option value=\"1\">Présent</option>
													    <option value=\"2\">En salle</option>
													    <option value=\"3\">Terminé</option>
													</select>
					                            	<button type=\"button\" class=\"btn btn-default\" onclick=\"updateRDVForPresence()\">
					                                    <span class=\"entypo-check\"></span>&nbsp;&nbsp;Confirmer</button>";
                                			break;
                                		case '1':
                                				echo "<select class=\"btn btn-info\" name=\"etatRDV\" id=\"etatRDV\">
													    <option value=\"0\">Absent</option>
													    <option value=\"1\">Présent</option>
													    <option value=\"2\">En salle</option>
													    <option value=\"3\">Terminé</option>
													</select>
					                            	<button type=\"button\" class=\"btn btn-info\" onclick=\"updateRDVForPresence()\">
					                                    <span class=\"entypo-check\"></span>&nbsp;&nbsp;Confirmer</button>";
                                			# code...
                                			break;
                                		case '2':
                                				echo "<select class=\"btn btn-warning\" name=\"etatRDV\" id=\"etatRDV\">
													    <option value=\"0\">Absent</option>
													    <option value=\"1\">Présent</option>
													    <option value=\"2\">En salle</option>
													    <option value=\"3\">Terminé</option>
													</select>
					                            	<button type=\"button\" class=\"btn btn-warning\" onclick=\"updateRDVForPresence()\">
					                                    <span class=\"entypo-check\"></span>&nbsp;&nbsp;Confirmer</button>";
                                			# code...
                                			break;
                                		case '3':
                                				echo "<select class=\"btn btn-success\" name=\"etatRDV\" id=\"etatRDV\">
													    <option value=\"0\">Absent</option>
													    <option value=\"1\">Présent</option>
													    <option value=\"2\">En salle</option>
													    <option value=\"3\">Terminé</option>
													</select>
					                            	<button type=\"button\" class=\"btn btn-success\" onclick=\"updateRDVForPresence()\">
					                                    <span class=\"entypo-check\"></span>&nbsp;&nbsp;Confirmer</button>";
                                			# code...
                                			break;			
                                	}
                                }
                        }
                        
                        $reponse->closeCursor();
                }

            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                } 

}else{
  
}

?>
