     <?php include("../../includes/functions.php");


     if(isset($_REQUEST['IdSalle'])){
        $idSalle = (String) trim($_REQUEST['IdSalle']);
        $nomCabinet = (String) trim($_REQUEST['nomCabinet']);
        //$idCabinet =  (String) trim($_REQUEST['idCabinet']);

        global $host_name;
        global $db_user_name;
        global $db_password;

        $nomB       = crypterNomDeLaBase($nomCabinet);

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                         $reponse = $bdd->query("SELECT * FROM `salle` WHERE `id_salle` = '$idSalle'");

                            
                            while ($donnees = $reponse->fetch())
                                {

                                    $nom_salle   = $donnees['num_nom_salle'];
                                    $etage_salle = $donnees['etage_salle'];
                                    $type_salle  = $donnees['type_salle'];
                                    $etat_salle  = $donnees['etat_salle'];

                                    if ($etat_salle == '0') {
                                        $etat = "Non Fonctionnelle";
                                    }elseif ($etat_salle =='1') {
                                        $etat = "Libre";
                                    }elseif ($etat_salle =='2') {
                                        $etat = "Occupé";
                                    }
                                }
                                ?>

                                <script>
                                    document.getElementById('titreModalUpdate').innerHTML = "Modification salle " + "<?php echo $nom_salle;?>";
                                </script>

                                <input type="hidden" name="idSalle_U" <?php echo "value=".$idSalle."";?>>

                                

                                <div class="control-group">
                                                <label class="control-label" for="num_nom_salle">Nom de salle (ou numéro)</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="num_nom_salle_U" id="num_nom_salleU" value="<?php echo $nom_salle;?>">
                                                </div>
                                            </div><br/>


                                            <div class="control-group">
                                                <label class="control-label" for="type_salle">Type Salle</label>
                                                <div class="controls">
                                                    <select type="text" class="form-control" name="type_salle_U" id="type_salleU" required>
                                                      <option value="Salle de soins" selected><?php echo $type_salle;?></option>
                                                      <option value="Salle de soins" >Salle de soins</option>
                                                      <option value="Salle d'examen">Salle d'examen</option>
                                                      <option value="Bloc Opératoire">Bloc Opératoire</option>
                                                      <option value="Salle d'attente">Salle d'attente</option>
                                                      <option value="Salle de réunion">Salle de réunion</option>
                                                    </select>
                                                </div>
                                            </div><br/>


                                            <div class="control-group">
                                                <label class="control-label" for="etat_salleU">Etat Salle</label>
                                                <div class="controls">
                                                    <select type="text" class="form-control" name="etat_salle_U" id="etat_salleU" required>
                                                      <option value="<?php echo $etat_salle;?>" selected><?php echo $etat;?></option>
                                                      <option value="1" >Libre</option>
                                                      <option value="2">Occupé</option>
                                                      <option value="0">Non Fonctionnelle</option>
                                                    </select>
                                                </div>
                                            </div><br/>

                                            <div class="control-group">
                                                <label class="control-label" for="etage_salle_U">Etage Salle: &nbsp;</label>

                                                <input name="etage_salle_U" id='etage_salleU' class="form-control" list="etageSalleU" required>

                                                    <datalist id="etageSalleU"> 
                                                        <option value="--">--</option>
                                                        <option value="RDC">Rez-de-chaussée</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="sous-sol:" disabled>sous-sol:</option>
                                                        <option value="-1">-1</option>
                                                        <option value="-2">-2</option>
                                                        <option value="-3">-3</option>
                                                    </datalist> 
                                            </div>

                    <script>
                        var valueselected = document.getElementById('etage_salleU');
                        valueselected.value ='<?php echo "$etage_salle";?>';
                        valueselected.onfocus = function() { valueselected.value =''; };
                        //valueselected.onblur = function() { valueselected.value ='<?php echo "$etage_salle";?>'; };
                    </script>                        

                <?php   $reponse->closeCursor();

                    }

        catch(Exception $e)
                    {
                        die('Erreur : '.$e->getMessage());
                    }
     


        }
 ?>
