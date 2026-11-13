<?php

	include("../../auth/auth.php");
    include("infoPatientPourConsultation.php");
    include("../../includes/functions.php");
    include("infoExamenPourConsultation.php");

	if(isset($_GET['Identifiant'])){

		$identifiant 	= (String) trim($_GET['Identifiant']);
		$idConsultation = (String) trim($_GET['IdConsul']);

		global $host_name;
		global $db_user_name;
		global $db_password;
		global $baseGlobale;
		
		$nomPatient		= getPatientName($identifiant);
		$prenomPatient  = getPatientPrenom($identifiant);
		$agePatient		= getPatientAge($identifiant);

    	$database = $baseGlobale;

            try
               {
                                        
	                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	                $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);   
	       
	                
	                // On recupere tout le contenu de la table news
	                $reponse = $bdd->query("SELECT * FROM `rapport_medical`,`consultations` WHERE rapport_medical.`idConsultation`= consultations.`idConsultation` AND rapport_medical.`idConsultation`='$idConsultation'");

					$nvrDeLignes = $reponse->rowCount();                                          

	                if ($nvrDeLignes == 0) {

	                    		echo "<div class=\"modal-header\">
	                                          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
	                                          <h4 class=\"modal-title\">Rapport Médical</h4>
	                                        </div>
	                                        <div class=\"modal-body\" style=\"height: 750px; overflow-y: auto;\">";

	                                        echo "<div>
		                                               <center>
		                                                    <h1>Aucun rapport médical n'a été rédigé pendant cette consultation !</h1>
		                                                </center>       
		                                            </div>
		                                          </div>";
	                    		
	                }
	                else{

		               	while ($donnees = $reponse->fetch())
		                    {   
								$motifCons 	= $donnees['motifCons'];
		                    	$conclusion = $donnees['conclusion'];
		                    	$nature_geste = $donnees['nature_geste'];
		                    	$compte_rendu = $donnees['compte_rendu'];
		                    	$type_anesthesie = $donnees['type_anesthesie'];
		                    	$heureConsultation = $donnees['heureConsultation'];
		                    	$dateCons 	= substr($heureConsultation,0,10);

		                    	echo   "<div class=\"modal-header\">
		                                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
		                                  <h4 class=\"modal-title\">Rapport Médical du: ".$heureConsultation."</h4>
		                                </div>
		                                <div class=\"modal-body\" style=\"height: 750px; overflow-y: auto;\">
		                                    <div>
		                                        <center>
		                                            <h1>Rapport Médical</h1>
		                                        </center>
		                                    </div>

		                                    <br> 

		                                    <div>
												<p style=\"font-family:  'Times New Roman', Times,serif; font-size: 14px;\">
													<b>Nom:</b>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 		".$nomPatient.". 	<br> 
													<b>Prenom:</b> &nbsp;							".$prenomPatient.". 	<br>
													<b>Age:</b>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ".$agePatient."&nbsp;ans.<br>
													<b>Date de consultation:</b>    &nbsp;&nbsp;".$dateCons.".<br>
												</p>
											</div>

		                                    <br>
		                                    <hr>
											
											<br>

											<div>
												<p style=\"font-family:  'Times New Roman', Times,serif; font-size: 14px;\">
													<b>Motif:</b>&nbsp; 							".$motifCons.".<br><br>
													<b>Nature du geste pratiqué:</b> &nbsp;		".$nature_geste.".<br><br>
													<b>Type d'anesthesie:</b> &nbsp;				".$type_anesthesie.".<br><br><br>
													<b><u>Compte rendu:</u></b><br>
												</p>
												<p style=\"font-family:  'Times New Roman', Times,serif; font-size: 16px;margin-left:60px;\">
													".$compte_rendu."
												</p>	
											</div>";
		                                                    
		                                                    
		                          echo "</div>";

		                          echo "<div class=\"modal-footer\">
								          <a href=\"rapportmedic.php?Identifiant=".$identifiant."&IdConsul=".$idConsultation."\" target=\"_blank\">
								          <button type=\"button\" class=\"btn btn-info\">Imprimer / Télécharger</button>
								          </a>
								          <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Fermer</button>
								        </div>";

		                    }

		            }
	               $reponse->closeCursor();
            	}
            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                } 
     }
            
?>