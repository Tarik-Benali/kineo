<?php



	 include("../../auth/auth.php");
     include("infoPatientPourConsultation.php");
     include("../../includes/functions.php");
     include("infoExamenPourConsultation.php");

		if(isset($_GET['Identifiant'])){
		        $identifiant 	= (String) trim($_GET['Identifiant']);
		        $nomCabinet 	= (String) trim($_GET['nomCabinet']);
		        $idConsultation = (String) trim($_GET['IdConsul']);


		$nomCabinet        	= str_replace("'","\'",$nomCabinet);

		global $host_name;
		global $db_user_name;
		global $db_password;
		
		$nomPatient		= getPatientName($identifiant);
		$prenomPatient  = getPatientPrenom($identifiant);
		$agePatient		= getPatientAge($identifiant);

    $database = crypterNomDeLaBase($nomCabinet);

            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);   
                   
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT `typeOrdonnance` FROM `ordonnance` WHERE `idConsultation` = '$idConsultation'");
       
							$nvrDeLignes = $reponse->rowCount();                                          

                            if ($nvrDeLignes == 0) {

                                		echo "<div class=\"modal-header\">
		                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
		                                              <h4 class=\"modal-title\">Ordonnances de consultation</h4>
		                                            </div>
		                                            <div class=\"modal-body\" style=\"height: 750px; overflow-y: auto;\">";

		                                            echo "<div>
				                                               <center>
				                                                    <h1>Pas d'ordonnance attribué à cette consultation</h1>
				                                                </center>       
				                                            </div>
				                                          </div>";
                                		
                                	}else{
                           while ($donnees = $reponse->fetch())
                                {   
                                	$typeOrdonnance = $donnees['typeOrdonnance'];

	                            		switch ($typeOrdonnance) {
	                            			case '1':
	                            	echo "<div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Ordonnances de la dernière consultation</h4>
                                           </div>

                                          <div class=\"modal-body\" style=\"height: 750px; overflow-y: auto;\">

                                    		<div style=\"display: flex; flex-wrap: nowrap;margin-top:-8px;margin-bottom:-18px;margin-left: 90px;\">
 	
												<div  style=\"margin-top: -8px;\">
													<img src='impression/ord/entete/".$nomCabinet.".PNG'/>
												</div>

												<div style=\"margin-top: 50px\">
													<p style=\"font-family:  'Times New Roman', Times,serif; font-size: 14px;\">
														<b>Nom:</b>    &nbsp;&nbsp;&nbsp; 		".$nomPatient." 	<br> 
														<b>Prenom:</b> 							".$prenomPatient." 	<br>
														<b>Age:</b>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ".$agePatient."	<br>
												</div>
											</div>

		                                  <div>
		                                        <center>
		                                            	<h1>Ordonnance</h1>
		                                        </center>
		                                                    
		                                  </div> 
		                            <br><br><br><br>";
		                                                        
		                            medicamentDernièreConsultationPopupOrd($nomCabinet, $idConsultation);

                             echo "</div>";

	                            				break;


	                            			case '2':
	                            	echo "<div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Ordonnances de la dernière consultation</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"height: 750px; overflow-y: auto;\">

                                            <div style=\"display: flex; flex-wrap: nowrap; margin-top:-8px;margin-bottom:-18px; margin-left: 90px;\">
 	
												<div  style=\"margin-top: -8px;\">
													<img src='impression/ord/entete/".$nomCabinet.".PNG'/>
												</div>

												<div style=\"margin-top: 50px\">
													<p style=\"font-family:  'Times New Roman', Times,serif; font-size: 14px;\">
														<b>Nom:</b>    &nbsp;&nbsp;&nbsp; 		".$nomPatient." 	<br> 
														<b>Prenom:</b> 							".$prenomPatient." 	<br>
														<b>Age:</b>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ".$agePatient."	<br>
												</div>
											</div>

		                                                <div>
		                                                    <center>
		                                                        <h1>Ordonnance</h1>
		                                                    </center>
		                                                    
		                                                </div> 

		                                                <br><br><br><br>";
		                                                        
		                                                        medicamentDernièreConsultationPopupOrd($nomCabinet, $idConsultation);
		                                                echo "</div>";        
	                            				break;


	                            			case '3':
	                            	echo "<div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Ordonnances de la dernière consultation</h4>
                                            </div>
                                            <div class=\"modal-body\" style=\"height: 750px; overflow-y: auto;\">

                                            <div style=\"display: flex; flex-wrap: nowrap; margin-top:-8px;margin-bottom:-18px; margin-left: 90px;\">
 	
												<div  style=\"margin-top: -8px;\">
													<img src='impression/ord/entete/".$nomCabinet.".PNG'/>
												</div>

												<div style=\"margin-top: 50px\">
													<p style=\"font-family:  'Times New Roman', Times,serif; font-size: 14px;\">
														<b>Nom:</b>    &nbsp;&nbsp;&nbsp; 		".$nomPatient." 	<br> 
														<b>Prenom:</b> 							".$prenomPatient." 	<br>
														<b>Age:</b>    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  ".$agePatient."	<br>
												</div>
											</div>		
		                                                <div>
		                                                    <center>
		                                                        <h1>Ordonnance</h1>
		                                                    </center>
		                                                    
		                                                </div> 

		                                                <br><br><br><br>";
		                                                        
		                                                        medicamentDernièreConsultationPopupOrd($nomCabinet, $idConsultation);
		                                            echo "</div>";            
		                                                        
	                            				break;			
	                            		}

		                    echo "<hr>";        
                                }
                           $reponse->closeCursor();
	                          }
	                      }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            } 
     }
            
?>