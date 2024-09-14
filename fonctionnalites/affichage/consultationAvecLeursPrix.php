<?php
	  //include("../../includes/functions.php");
    
	function consultationsAvecLeursPrix($nomBD, $idMedecin, $idCabinet){
      
    $host_name = "localhost";
    $database = crypterNomDeLaBase($nomBD);
    $db_user_name = "root";
    $db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM prixconsultation');
                                                  
                            // On affiche le resultat
                           while ($donnees = $reponse->fetch())
                                {

                                $idPrixConsultation = $donnees['idPrixConsultation'];
                                $typeConsultation   = $donnees['typeConsultation']; 
                                $prixConsultation   = $donnees['prixConsultation'];
                              echo "<tr>";

                                    echo "<td>Séance $typeConsultation</td>";
                                    echo "<td>$prixConsultation da</td>";
                                    echo "<td><button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#".$idPrixConsultation."\"><span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier</button></td>";  

                                echo "</tr>";

                                echo "<div class=\"container\">

                                      <div class=\"modal fade\" id=\"".$idPrixConsultation."\" role=\"dialog\">
                                        <div class=\"modal-dialog\">
                                        

                                          <div class=\"modal-content\">
                                            <div class=\"modal-header\">
                                              <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                              <h4 class=\"modal-title\">Prix de séance $typeConsultation</h4>
                                            </div>
                                            <div class=\"modal-body\">

                      <form action=\"fonctionnalites\mod\modPrixConsultation.php\" class=\"form-container\">
                            <fieldset>

                              <div class=\"form-group\">

                                <input type=\"hidden\" name=\"idPrixConsultation\" value=\"$idPrixConsultation\">

                                <input type=\"hidden\" name=\"idMedecin\" value=\"$idMedecin\">

                                <input type=\"hidden\" name=\"idCabinet\" value=\"$idCabinet\">

                                <input type=\"hidden\" name=\"nomBD\" value=\"$nomBD\">

                                                <label for=\"examen\"><b>Prix de séance $typeConsultation</b></label>

                                                <input type=\"text\" placeholder=\"$prixConsultation\" name=\"prixConsultation\" class=\"form-control\" required>
                          
                                            </div>
                                            
                                              <ul id=\"breadcrumb\">
                                                <li><a href=\"#\" title=\"Sample page 1\">Voulez vous vraiment modifier le prix ?</a></li>
                                               
                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                <button type=\"submit\" class=\"btn btn-warning pull-right\" style=\"margin-right:10px;margin-bottom:10px;\"> <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier </button>

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



    function dureeEntreLesSeances($nomBD, $idMedecin){
      
    $host_name = "localhost";
    $database = crypterNomDeLaBase($nomBD);
    $db_user_name = "root";
    $db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM dureeTemporelleEntreLesSeances');
                            
                            $nbr = $reponse->rowCount();
                              if ($nbr > 0) {            
                                      // On affiche le resultat
                                      while ($donnees = $reponse->fetch())
                                          {

                                          $id      = $donnees['id'];
                                          $duree   = $donnees['espace_entre_seances']; 

                                        echo "<tr>";

                                              echo "<td>Séance simple</td>";
                                              echo "<td>$duree mn</td>";
                                              echo "<td><button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#duree".$id."\"><span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier</button></td>";  

                                          echo "</tr>";

                                          echo "<div class=\"container\">

                                                <div class=\"modal fade\" id=\"duree".$id."\" role=\"dialog\">
                                                  <div class=\"modal-dialog\">
                                                  

                                                    <div class=\"modal-content\">
                                                      <div class=\"modal-header\">
                                                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                                        <h4 class=\"modal-title\">Durée Entre Les Séances</h4>
                                                      </div>
                                                      <div class=\"modal-body\">

                                            <form action=\"fonctionnalites\mod\modPrixConsultation.php\" class=\"form-container\">
                                            <fieldset>

                                              <div class=\"form-group\">

                                                <input type=\"hidden\" name=\"idDureeEntreSeances\" value=\"$id\">

                                                <input type=\"hidden\" name=\"idMedecin\" value=\"$idMedecin\">

                                                <input type=\"hidden\" name=\"nomCabinet\" value=\"$nomBD\">

                                                                <label for=\"examen\"><b>Durée de séance simple</b></label>

                                                                <input type=\"text\" placeholder=\"$duree\" name=\"duree\" class=\"form-control\" required>
                                          
                                                            </div>
                                                            
                                                              <ul id=\"breadcrumb\">
                                                                <li><a href=\"#\" title=\"Sample page 1\">Voulez vous modifier la durée entre les séances ?</a></li>
                                                               
                                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                                <button type=\"submit\" class=\"btn btn-warning pull-right\" style=\"margin-right:10px;margin-bottom:10px;\"> <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier </button>

                                                                </div>                                        

                                                              </fieldset>                    
                                              </form>
                                                              </ul>
                                                          </div>                                           

                                                          
                                                        </div>
                                                      </div>
                                                      
                                                    </div>";
                                }
                            }else{
                              echo "<tr>";
                              echo "<td>Durée Entre Les Séance non programée !</td>";
                              echo "</tr>";
                            }    
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
    }


    function dureeDesSeances($nomBD, $idMedecin){
      
    $host_name = "localhost";
    $database = crypterNomDeLaBase($nomBD);
    $db_user_name = "root";
    $db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM duree_rdv');
                            
                            $nbr = $reponse->rowCount();
                              if ($nbr > 0) {            
                                      // On affiche le resultat
                                      while ($donnees = $reponse->fetch())
                                          {

                                          $id      = $donnees['id_duree_rdv'];
                                          $duree   = $donnees['duree']; 

                                        echo "<tr>";

                                              echo "<td>Séance simple</td>";
                                              echo "<td>$duree mn</td>";
                                              echo "<td><button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#duree".$id."\"><span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier</button></td>";  

                                          echo "</tr>";

                                          echo "<div class=\"container\">

                                                <div class=\"modal fade\" id=\"duree".$id."\" role=\"dialog\">
                                                  <div class=\"modal-dialog\">
                                                  

                                                    <div class=\"modal-content\">
                                                      <div class=\"modal-header\">
                                                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                                        <h4 class=\"modal-title\">Durée Des Séances</h4>
                                                      </div>
                                                      <div class=\"modal-body\">

                                            <form action=\"fonctionnalites\mod\modPrixConsultation.php\" class=\"form-container\">
                                            <fieldset>

                                              <div class=\"form-group\">

                                                <input type=\"hidden\" name=\"idDureeSeances\" value=\"$id\">

                                                <input type=\"hidden\" name=\"idMedecin\" value=\"$idMedecin\">

                                                <input type=\"hidden\" name=\"nomCabinet\" value=\"$nomBD\">

                                                                <label for=\"examen\"><b>Durée des séances simples</b></label>

                                                                <input type=\"text\" value=\"$duree\" name=\"duree_seance\" class=\"form-control\" required>
                                          
                                                            </div>
                                                            
                                                              <ul id=\"breadcrumb\">
                                                                <li><a href=\"#\" title=\"Sample page 1\">Voulez vous modifier la durée des séances ?</a></li>
                                                               
                                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                                <button type=\"submit\" class=\"btn btn-warning pull-right\" style=\"margin-right:10px;margin-bottom:10px;\"> <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier </button>

                                                                </div>                                        

                                                              </fieldset>                    
                                              </form>
                                                              </ul>
                                                          </div>                                           

                                                          
                                                        </div>
                                                      </div>
                                                      
                                                    </div>";
                                }
                            }else{
                              echo "<tr>";
                              echo "<td>Durée Des Séance non programée !</td>";
                              echo "</tr>";
                            }    
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
    }

    function ouvertureFermetureCabinet($nomBD, $idMedecin){
      
    $host_name = "localhost";
    $database = crypterNomDeLaBase($nomBD);
    $db_user_name = "root";
    $db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM cabinet');
                            
                            $nbr = $reponse->rowCount();
                              if ($nbr > 0) {            
                                      // On affiche le resultat
                                      while ($donnees = $reponse->fetch())
                                          {

                                          $idCabinet = $donnees['idCabinet'];
                                          $nomCab    = $donnees['nomCabinet'];
                                          $ouverture = $donnees['ouverture'];
                                          $fermeture = $donnees['fermeture']; 

                                          $ouverture = substr($ouverture, 0, 8);
                                          $fermeture = substr($fermeture, 0, 8);

                                        echo "<tr>";

                                              echo "<td>$nomCab</td>";
                                              echo "<td>$ouverture</td>";
                                              echo "<td>$fermeture</td>";
                                              echo "<td><button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#cab".$idCabinet."\"><span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier</button></td>";  

                                          echo "</tr>";

                                          echo "<div class=\"container\">

                                                <div class=\"modal fade\" id=\"cab".$idCabinet."\" role=\"dialog\">
                                                  <div class=\"modal-dialog\">
                                                  

                                                    <div class=\"modal-content\">
                                                      <div class=\"modal-header\">
                                                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                                        <h4 class=\"modal-title\">Paramètres Nom et Heure Ouverture/Fermeture Cabinet</h4>
                                                      </div>
                                                      <div class=\"modal-body\">

                                            <form action=\"fonctionnalites\mod\modPrixConsultation.php\" class=\"form-container\">
                                            <fieldset>

                                              <div class=\"form-group\">

                                                <input type=\"hidden\" name=\"idCabinet\" value=\"$idCabinet\">

                                                <input type=\"hidden\" name=\"idMedecin\" value=\"$idMedecin\">

                                                <input type=\"hidden\" name=\"nomCabinet\" value=\"$nomBD\">

                                                                <label for=\"examen\"><b>Nom Cabinet</b></label>
                                                                <input type=\"text\" value=\"$nomCab\" name=\"nomCab\" class=\"form-control\" required>

                                                                <br>

                                                                <label for=\"examen\"><b>Heure Ouverture</b></label>
                                                                <input type=\"text\" value=\"$ouverture\" name=\"ouverture\" class=\"form-control\" required>

                                                                <br>

                                                                <label for=\"examen\"><b>Heure Fermeture</b></label>
                                                                <input type=\"text\" value=\"$fermeture\" name=\"fermiture\" class=\"form-control\" required>
                                          
                                                            </div>
                                                            
                                                              <ul id=\"breadcrumb\">
                                                                <li><a href=\"#\" title=\"Sample page 1\">Voulez vous modifier les données du cabinet ?</a></li>
                                                               
                                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                                <button type=\"submit\" class=\"btn btn-warning pull-right\" style=\"margin-right:10px;margin-bottom:10px;\"> <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier </button>

                                                                </div>                                        

                                                              </fieldset>                    
                                              </form>
                                                              </ul>
                                                          </div>                                           

                                                          
                                                        </div>
                                                      </div>
                                                      
                                                    </div>";
                                }
                            }else{
                              echo "<tr>";
                              echo "<td>Durée Entre Les Séance non programée !</td>";
                              echo "</tr>";
                            }    
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
    }


    function nombrePatientParSeance($nomBD, $idMedecin){
      
    $host_name = "localhost";
    $database = crypterNomDeLaBase($nomBD);
    $db_user_name = "root";
    $db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT idCabinet,nbrPatientParSeance FROM cabinet');
                            
                            $nbr = $reponse->rowCount();
                              if ($nbr > 0) {            
                                      // On affiche le resultat
                                      while ($donnees = $reponse->fetch())
                                          {
                                            $idCabinet = $donnees['idCabinet'];  
                                            $nbrPatParSea = $donnees['nbrPatientParSeance'];

                                        echo "<tr>";

                                              echo "<td>Séance simple</td>";
                                              echo "<td>$nbrPatParSea</td>";
                                              echo "<td><button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#nbrp".$nbrPatParSea."\"><span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier</button></td>";  

                                          echo "</tr>";

                                          echo "<div class=\"container\">

                                                <div class=\"modal fade\" id=\"nbrp".$nbrPatParSea."\" role=\"dialog\">
                                                  <div class=\"modal-dialog\">
                                                  

                                                    <div class=\"modal-content\">
                                                      <div class=\"modal-header\">
                                                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                                        <h4 class=\"modal-title\">Paramètres nombre patients par séance</h4>
                                                      </div>
                                                      <div class=\"modal-body\">

                                            <form action=\"fonctionnalites\mod\modPrixConsultation.php\" class=\"form-container\">
                                            <fieldset>

                                              <div class=\"form-group\">

                                                <input type=\"hidden\" name=\"idCabinet\" value=\"$idCabinet\">

                                                <input type=\"hidden\" name=\"idMedecin\" value=\"$idMedecin\">

                                                <input type=\"hidden\" name=\"nomCabine\" value=\"$nomBD\">

                                                                <label for=\"examen\"><b>Nombre patients par séance</b></label>
                                                                <input type=\"text\" value=\"$nbrPatParSea\" name=\"nbrPatSea\" class=\"form-control\" required>

                                                                <br>
                                                            </div>
                                                            
                                                              <ul id=\"breadcrumb\">
                                                                <li><a href=\"#\" title=\"Sample page 1\">Voulez vous modifier le nombre des patients par séance ?</a></li>
                                                               
                                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                                <button type=\"submit\" class=\"btn btn-warning pull-right\" style=\"margin-right:10px;margin-bottom:10px;\"> <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier </button>

                                                                </div>                                        

                                                              </fieldset>                    
                                              </form>
                                                              </ul>
                                                          </div>                                           

                                                          
                                                        </div>
                                                      </div>
                                                      
                                                    </div>";
                                }
                            }else{
                              echo "<tr>";
                              echo "<td>Durée Entre Les Séance non programée !</td>";
                              echo "</tr>";
                            }    
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
    }


    function getionPourcentageRecettePraticien($nomBD, $idMedecin){
      
    $host_name = "localhost";
    $database = crypterNomDeLaBase($nomBD);
    $db_user_name = "root";
    $db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query('SELECT * FROM gestionrecettepracitien,medecin WHERE gestionrecettepracitien.idMedecin = medecin.idMedecin');
                            
                            $nbr = $reponse->rowCount();
                              if ($nbr > 0) {            
                                      // On affiche le resultat
                                      while ($donnees = $reponse->fetch())
                                          {

                                          $idRelation     = $donnees['id'];
                                          $idMedecin      = $donnees[1];
                                          $nomMedecin     = $donnees['nomMedecin'];
                                          $prenomMedecin  = $donnees['prenomMedecin'];
                                          $pourcentage    = $donnees['pourcentage']; 

                                        echo "<tr>";

                                              echo "<td>$nomMedecin </td>";
                                              echo "<td>$prenomMedecin</td>";
                                              echo "<td>".$pourcentage."%</td>";
                                              echo "<td><button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#pour".$idRelation."\"><span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier</button></td>";  

                                          echo "</tr>";

                                          echo "<div class=\"container\">

                                                <div class=\"modal fade\" id=\"pour".$idRelation."\" role=\"dialog\">
                                                  <div class=\"modal-dialog\">
                                                  

                                                    <div class=\"modal-content\">
                                                      <div class=\"modal-header\">
                                                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                                        <h4 class=\"modal-title\">Paramètres pourcentage gains praticiens</h4>
                                                      </div>
                                                      <div class=\"modal-body\">

                                            <form action=\"fonctionnalites\mod\modPrixConsultation.php\" class=\"form-container\">
                                            <fieldset>

                                              <div class=\"form-group\">

                                                <input type=\"hidden\" name=\"idRelation\" value=\"$idRelation\">

                                                <input type=\"hidden\" name=\"idMedecin\" value=\"$idMedecin\">

                                                <input type=\"hidden\" name=\"nomCabinets\" value=\"$nomBD\">

                                                                <br>

                                                                <label for=\"examen\"><b>Pourcentage</b></label>
                                                                <input type=\"number\" value=\"$pourcentage\" name=\"pourcentage\" class=\"form-control\"  min=\"1\" max=\"100\" required>
                                          
                                                            </div>
                                                            
                                                              <ul id=\"breadcrumb\">
                                                                <li><a href=\"#\" title=\"Sample page 1\">Voulez vous effectuer cette opération ?</a></li>
                                                               
                                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                                <button type=\"submit\" class=\"btn btn-warning pull-right\" style=\"margin-right:10px;margin-bottom:10px;\"> <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Modifier </button>

                                                                </div>                                        

                                                              </fieldset>                    
                                              </form>
                                                              </ul>
                                                          </div>                                           

                                                          
                                                        </div>
                                                      </div>
                                                      
                                                    </div>";
                                }
                            }else{
                              echo "<tr>";
                              echo "<td>Aucun praticien n'est encore programmé !</td>";
                              echo "</tr>";
                            }    
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
    }


function suppressionPraticien($nomBD, $idMedecin){
      
    $host_name = "localhost";
    $database = crypterNomDeLaBase($nomBD);
    $db_user_name = "root";
    $db_password = "";
            try
                            {
                                                    
                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                            
                            // On recupere tout le contenu de la table news
                            $reponse = $bdd->query("SELECT * FROM medecin WHERE idMedecin <> '$idMedecin'");
                            
                            $nbr = $reponse->rowCount();
                              if ($nbr > 0) {            
                                      // On affiche le resultat
                                      while ($donnees = $reponse->fetch())
                                          {

                                          $idPraticien    = $donnees['idMedecin'];
                                          $nomMedecin     = $donnees['nomMedecin'];
                                          $prenomMedecin  = $donnees['prenomMedecin'];

                                        echo "<tr>";

                                              echo "<td>$nomMedecin </td>";
                                              echo "<td>$prenomMedecin</td>";
                                              echo "<td><button type=\"button\" class=\"btn btn-danger\" data-toggle=\"modal\" data-target=\"#pour".$idPraticien."\"><span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Supprimer</button></td>";  

                                          echo "</tr>";

                                          echo "<div class=\"container\">

                                                <div class=\"modal fade\" id=\"pour".$idPraticien."\" role=\"dialog\">
                                                  <div class=\"modal-dialog\">
                                                  

                                                    <div class=\"modal-content\">
                                                      <div class=\"modal-header\">
                                                        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                                        <h4 class=\"modal-title\">Suppression praticien</h4>
                                                      </div>
                                                      <div class=\"modal-body\">

                                            <form action=\"fonctionnalites\supp\suppPraticien.php\" class=\"form-container\">
                                            <fieldset>

                                              <div class=\"form-group\">

                                                <input type=\"hidden\" name=\"idMedecin\" value=\"$idPraticien\">
                                                <input type=\"hidden\" name=\"nomCabinets\" value=\"$nomBD\">

                                                                <h4 for=\"examen\">Êtes vous sûr de vouloir supprimer <b>".$nomMedecin . " ". $prenomMedecin."</b> de votre cabinet ?</h4>
                                                                
                                          
                                                            </div>
                                                            
                                                              <ul id=\"breadcrumb\">
                                                                <li><a href=\"#\" title=\"Sample page 1\">Voulez vous effectuer cette opération ?</a></li>
                                                               
                                                                <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Annuler</button>
                                                                <button type=\"submit\" class=\"btn btn-danger pull-right\" style=\"margin-right:10px;margin-bottom:10px;\"> <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Supprimer </button>

                                                                </div>                                        
                                                              </fieldset>                    
                                              </form>
                                                              </ul>
                                              </div>                                           

                                                          
                                            </div>
                                          </div>
                                          
                                        </div>";
                                }
                            }else{
                              echo "<tr>";
                              echo "<td>Aucun autre praticien n'est encore ajouté au cabinet !</td>";
                              echo "</tr>";
                            }    
                           $reponse->closeCursor();
                          }
                        catch(Exception $e)
                            {
                               die('Erreur : '.$e->getMessage());
                            }  
    }    
?>















