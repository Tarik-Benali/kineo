<?php

	 include("../../auth/auth.php");
     include("infoPatientPourConsultation.php");
     include("../../includes/functions.php");
     include("infoExamenPourConsultation.php");

		if(isset($_GET['Identifiant'])){
		        $identifiant = (String) trim($_GET['Identifiant']);
		        $nomCabinet = (String) trim($_GET['nomCabinet']);
		        $IdConsul = (String) trim($_GET['IdConsul']);

		        
		    


		$database = crypterNomDeLaBase($nomCabinet);
		//$db_user_name = "root";
		//$db_password = "";
		global $host_name;
		global $db_user_name;
		global $db_password;

     
            try   
                {
                                                                                        
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options); 

 					//echo "<script>alert('id Con: $IdConsul,  id Patient: $identifiant');</script>";                                                              
                    
                    // On recupere tout le contenu de la table news
                    $reponse = $bdd->query("SELECT * FROM consultations WHERE consultations.idPatient = '$identifiant' AND consultations.idConsultation ='$IdConsul' ORDER BY consultations.heureConsultation DESC");

                    $nbrExamns = $reponse->rowCount();

                    if ($nbrExamns > 0) {               
 
	                    while ($donnees = $reponse->fetch())
	                        {


	                        $idMedecin          = $donnees['idMedecin'];
	                        $conclusion         = $donnees['conclusion'];
	                        $idConsultation     = $donnees['idConsultation'];
	                        $heureConsultation  = $donnees['heureConsultation'];
	                        $idConsultationPop  = $idConsultation . "pop";


	                                      /*<div class=\"modal fade\"  id=\"popupConsul\" role=\"dialog\">
	                                        <div class=\"modal-dialog\">
	                                        

	                                          <div class=\"modal-content\">*/
	                                      echo "<div class=\"modal-header\">
	                                             <div class=\"container\"> <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
	                                              <h4 class=\"modal-title\">Consultation du &nbsp;&nbsp; $heureConsultation</h4>
	                                            </div>
	                                            <div class=\"modal-body\" style=\"height: 550px; overflow-y: auto;\">

	                                                    <div class=\"form-group\">

	                                                    <input type=\"hidden\" name=\"idExamen\" value=\"$idConsultation \">

	                                                    <input type=\"hidden\" name=\"idMedecin\" value=\"$idMedecin\">

	                                                    <input type=\"hidden\" name=\"nomBD\" value=\"$nomCabinet\">

	                                              "; affichageDetailsPatient($nomCabinet, $idConsultation);

	                                                 examensDeCetteConsultation($nomCabinet, $idConsultation);

	                                               echo "

	                                              <label for=\"examen\"><b>Conclusion</b></label>

	                                              <textarea type=\"text\" name=\"conclusion\"  style=\"height: 100px;\" required>$conclusion</textarea>
	                                                                   
	                          
	                                            </div>
	                                            
	                                              <ul id=\"breadcrumb\">
	                                                  
	                                                  ";
	                                                  echo "<li class=\"pull-right\">
	                                                    <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Fermer</button>
	                                                  </li>

	                                              </ul>

	                                            </div>";                                       

	                                         /*</div>                                                                     


	                                        </div>
	                                      </div>
	                                      
	                                    </div>*/

	                        }

                        	$reponse->closeCursor();

                   }

	                    
                   }
                   catch(Exception $e)
                       {
                       	//echo "<script>alert('die('Erreur : '.$e->getMessage())');</script>";
                           die('Erreur : '.$e->getMessage());
                       }


	}else {
		//echo "<script>alert('zzzz');</script>";
	}



?>