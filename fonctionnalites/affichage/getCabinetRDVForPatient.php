<?php

    if (isset($_REQUEST['idCab']) && isset($_REQUEST['idDoc']) && isset($_REQUEST['date']) && isset($_REQUEST['nomCabi']) ) {

    include("../../includes/functions.php");

    $idCab         = $_REQUEST['idCab'];
    $idDoc         = $_REQUEST['idDoc'];
    $dateS         = $_REQUEST['date'];
    $idPat         = $_REQUEST['idPat'];
    $NomCa         = $_REQUEST['nomCabi'];
    $type          = $_REQUEST['type'];
    


   //header('Content-Type: application/json');
   //getDocsOfOneCabForRDV($identifiantCab);

      global $host_name;
      global $db_user_name;
      global $db_password;

        $nomB       = crypterNomDeLaBase($NomCa);

        try
            {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                         
                      /*$date       = date('d/m/Y');
                      $dateDuJour = explode("/", $date);
                      $dJour      = $dateDuJour[2].$dateDuJour[1].$dateDuJour[0]; */

                      /*$lyoum = date('d/m/Y');
                      AND dateRDV='$lyoum'*/

                      $reponse = $bdd->query("SELECT heureRDV,dateRDV FROM rdv WHERE dateRDV = '$dateS' AND idMedecin='$idDoc' order by heureRDV");

                      $nbrDeLignes = $reponse->rowCount(); 

                      //Début et fin de service                      
                        $plageRDV = array();
                        $listeRDV = array();

                        $date = date('H:i:s', strtotime("9:00:00"));
                        $heureDebut = $date;
                        $heureFinS = date('H:i:s', strtotime("18:00:00"));


                        while($heureDebut < $heureFinS){

                          $plageRDV[] = $heureDebut; 
                          $heureDebut = date('H:i:s', strtotime($heureDebut)+1800);
                        }

                        echo "
                              <tr class=\"text-right\">
                                  <th style=\"width=30%;\">Horaire disponible</th>
                                  <th style=\"width=12%;\">Réservation</th>
                              </tr>";

                      if ($nbrDeLignes != 0) {                      

                        while ($donnees = $reponse->fetch())
                            {
                                  $dateRDV  = $donnees['dateRDV'];
                                  $drdv     = explode("/", $dateRDV);
                                  $dRDV     = $drdv[2]."/".$drdv[1]."/".$drdv[0];

                                  $dRDV = date('H:i:s', strtotime($donnees['heureRDV']));
                                  $listeRDV[] = $dRDV;
                            }

                        $reponse->closeCursor();

                        foreach($plageRDV as $val1){
                            foreach($listeRDV as $val2){
                                            
                                    $dubut = $val1;
                                    $fin  = date('H:i:s', strtotime($val1)+1800);

                                    $last_iteration = end($listeRDV);
                                    $pris_indice    = "false";
                                            
                                    if($val2 >= $dubut && $val2 < $fin){

                                                $pris_indice    = "true";

                                                echo "<tr>
                                                        <td>".date('H:i', strtotime($val1))."</td>
                                                        <td>Pris
                                                    </tr>";

                                                break;       

                                      }else{
                                            if ($val2 == $last_iteration && $pris_indice == "false") {
                                                  
                                                  echo "<tr>
                                                          <td>".date('H:i', strtotime($dubut))."</td>
                                                          <td><a href=\"fonctionnalites/ajout/ajouterRDV.php?nomCabinet=".$NomCa."&dateRDV=".$dateS."&medecin=".$idDoc."&heureRDV=".$val1."&identifiantP=".$idPat."&idCab=".$idCab."&type=".$type."\">
                                                            <button class=\"btn btn-info\">
                                                                 <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Réserver
                                                            </button>
                                                          </a></td>         
                                                      </tr>";
                                                }      
                                    }
                            }
                        }
                      }

                else if ($nbrDeLignes == 0) {


                  foreach($plageRDV as $val1){
                                        
                                $dubut = $val1;
                                $fin  = date('H:i:s', strtotime($val1)+1800);

                                 echo "<tr>
                                          <td>".date('H:i', strtotime($dubut))."</td>
                                          <td><a href=\"fonctionnalites/ajout/ajouterRDV.php?nomCabinet=".$NomCa."&dateRDV=".$dateS."&medecin=".$idDoc."&heureRDV=".$val1."&identifiantP=".$idPat."&idCab=".$idCab."&type=".$type."\">
                                            <button class=\"btn btn-info\">
                                                <span class=\"entypo-pencil\"></span>&nbsp;&nbsp;Réserver
                                            </button>
                                          </a></td>         
                                      </tr>";
                                                 
                                }
                    }
        }
        
        catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }
    }

?>  