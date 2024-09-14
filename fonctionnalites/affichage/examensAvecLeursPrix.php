<?php
	 //include("../../includes/functions.php");

	function examensAvecLeursPrix($nomBD, $idMedecin, $idCabinet){
			
		$host_name = "localhost";
		$database = crypterNomDeLaBase($nomBD);
		$db_user_name = "root";
		$db_password = "";
						try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM examens,prix WHERE examens.idExamen=prix.idExamen');
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {

                                $idExamen = $donnees['idExamen'];
                                $examens  = $donnees['typeExamen'];	
                                $prixExam = $donnees['prixExamen'];
	                            echo "<tr>";

                                    echo "<td>$examens</td>";
                                    echo "<td>$prixExam da</td>";
                                    echo "<td><button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#".$idExamen."\"><span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier</button></td>";  

                                echo "</tr>";

                                echo "<div class=\"container\">

                                      <div class=\"modal fade\" id=\"".$idExamen."\" role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Prix d'Examen $examens</h4>
                                            </div>
                                            <div class=\"modal-body\">

											<form action=\"fonctionnalites\mod\modPrixExam.php\" class=\"form-container\">
										        <fieldset>

										        	<div class=\"form-group\">

										        	<input type=\"hidden\" name=\"idExamen\" value=\"$idExamen\">

													<input type=\"hidden\" name=\"idMedecin\" value=\"$idMedecin\">

													<input type=\"hidden\" name=\"idCabinet\" value=\"$idCabinet\">

													<input type=\"hidden\" name=\"nomBD\" value=\"$nomBD\">

	                                            	<label for=\"examen\"><b>Prix de $examens</b></label>

	                                            	<input type=\"text\" placeholder=\"$prixExam\" name=\"prixExamen\" class=\"form-control\" required>
                          
                                            </div>
                                            
                                              <ul id=\"breadcrumb\">
                                                <li><a href=\"#\" title=\"Sample page 1\">Voulez vous vraiment modifier le prix ?</a></li>
                                               
                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                <button type=\"submit\"  class=\"btn btn-warning pull-right\" style=\"margin-right:10px;margin-bottom:10px;\"> <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier </button>

	                                            	</div>                                        

	                                            </fieldset>                    
											</form>
                                              </ul>
                                          </div>													                 

                                          
                                        </div>
                                      </div>
                                      
                                    </div>";
                                }
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
		}
?>















