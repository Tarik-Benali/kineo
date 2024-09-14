<?php 
	include("../../includes/functions.php");

	$nomCabinet        	= str_replace("'","\'",$nomCabinet);

	global $host_name;
    global $baseGlobale;
    global $db_user_name;
    global $db_password;
    
    $database = crypterNomDeLaBase($nomCabinet);

            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT `typeOrdonnance` FROM `ordonnance` WHERE `idConsultation` = '$idConsultation'");
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {
                                	$typeOrdonnance = $donnees['typeOrdonnance'];

	                            		switch ($typeOrdonnance) {
	                            			case '1': ?>
	                            <div class="container">

                                      <div class="modal fade"  id="Conclusion" role="dialog">
                                        <div class="modal-dialog">                                        

                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Ordonnances Consultation</h4>
                                            </div>
                                            <div class="modal-body" style="height: 750px; overflow-y: auto;">

                                            <img src='impression/ord/entete/<?php $nomCabinet ?>.png' style='width:550px; height: 180px;' />

		                                                <div>
		                                                    <center>
		                                                        <h1>Ordonnance</h1>
		                                                    </center>
		                                                    
		                                                </div> 

		                                                <br><br><br><br>
		                                                        
		                                                        <div style="display: flex; flex-wrap: nowrap; justify-content: space-between;">

		                                                            <div style="margin-left: 50px">

		                                                                   <?php medicamentDernièreConsultation($nomCabinet, $idConsultation); ?>
		                                                            </div>


		                                                            <div>

		                                                            <p>doz </p>                         
		                                                                    <br>
		                                                                    <br>        
		                                                            </div>


		                                                            <div style="margin-right: 30px;">

		                                                                <p>freq</p>                             
		                                                                <br>
		                                                                <br>
		                                                            </div>                                                   

		                                                                 
		                                                        </div>

                                            </div>
                                          </div>                                                                     

                                          
                                        </div>
                                      </div>
                                      
                                    </div>

	                            				<?php break;


	                            			case '2': ?>
	                            					<img src='impression/ord/entete/<?php $nomCabinet ?>.png' style='width:550px; height: 180px;' />

		                                                <div>
		                                                    <center>
		                                                        <h1>Ordonnance</h1>
		                                                    </center>
		                                                    
		                                                </div> 

		                                                <br><br><br><br>
		                                                        
		                                                        <div style="display: flex; flex-wrap: nowrap; justify-content: space-between;">

		                                                            <div style="margin-left: 50px">

		                                                                  <?php  medicamentDernièreConsultation($nomCabinet, $idConsultation);  ?>
		                                                            </div>


		                                                            <div>

		                                                            <p>doz </p>                         
		                                                                    <br>
		                                                                    <br>        
		                                                            </div>


		                                                            <div style="margin-right: 30px;">

		                                                                <p>freq</p>                             
		                                                                <br>
		                                                                <br>
		                                                            </div>                                                   

		                                                                 
		                                                        </div>";
	                            				<?php break;


	                            			case '3': ?>
	                            					<img src='impression/ord/entete/<?php $nomCabinet ?>.png' style='width:550px; height: 180px;' />

		                                                <div>
		                                                    <center>
		                                                        <h1>Ordonnance</h1>
		                                                    </center>
		                                                    
		                                                </div> 

		                                                <br><br><br><br>
		                                                        
		                                                        <div style="display: flex; flex-wrap: nowrap; justify-content: space-between;">

		                                                            <div style="margin-left: 50px">

		                                                                  <?php   medicamentDernièreConsultation($nomCabinet, $idConsultation);  ?>
		                                                            </div>


		                                                            <div>

		                                                            <p>doz </p>                         
		                                                                    <br>
		                                                                    <br>        
		                                                            </div>


		                                                            <div style="margin-right: 30px;">

		                                                                <p>freq</p>                             
		                                                                <br>
		                                                                <br>
		                                                            </div>                                                   

		                                                                 
		                                                        </div>
	                            				<?php break;			
	                            		}

		                    echo "<hr>";        
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }
?>