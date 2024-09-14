     <?php include("../../includes/functions.php");


     if(isset($_REQUEST['IdLit'])){
        $idLit      = (String) trim($_REQUEST['IdLit']);
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
                                                     
                         $reponse = $bdd->query("SELECT * FROM `lit` WHERE `id_lit` = '$idLit'");
                          
                            
                            while ($donnees = $reponse->fetch())
                                {

                                    $num_lit        = $donnees['num_lit'];
                                    $nature_lit     = $donnees['nature_lit'];
                                    $etat_lit       = $donnees['etat_lit'];
                                    $id_emplacement = $donnees['id_emplacement'];

                                    if ($etat_lit == '0') {
                                        $etat = "Desactivé";
                                    }elseif ($etat_lit =='1') {
                                        $etat = "Libre";
                                    }elseif ($etat_lit =='2') {
                                        $etat = "Occupé";
                                    }elseif ($etat_lit =='3') {
                                        $etat = "Non Fonctionnel";
                                    }
                                }

                                $nomSalle = getSalleNameFromId($nomCabinet,$id_emplacement);
                                ?>

                                <script>
                                    document.getElementById('titreModalUpdate').innerHTML = "Modification lit " + "<?php echo $num_lit;?>";
                                </script>

                                <input type="hidden" name="idLit_U" <?php echo "value=".$idLit."";?>>

                                

                                            <div class="control-group">
                                                <label class="control-label" for="num_nom_lit">Num de lit</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="num_lit_U" id="num_litU" value="<?php echo $num_lit;?>">
                                                </div>
                                            </div><br/>



                                            <div class="control-group">
                                                <label class="control-label" for="nature_lit">Type Lit</label>
                                                <div class="controls">
                                                   <input type="text" class="form-control" name="nature_lit_U" id="nature_litU" value="<?php echo $nature_lit;?>">
                                                </div>
                                            </div><br/>


                                            <div class="control-group">
                                                <label class="control-label">Emplacement Lit: &nbsp;</label>

                                                <select id="listSalleU" name="emplacement_lit_U" class="form-control">
                                                    <option value="--" selected><?php echo $nomSalle;?></option>
                                                    <?php getAvailableSalleForOption($nomCabinet);?>
                                                </select>
                                            </div><br/>


                                            <div class="control-group">
                                                <label class="control-label" for="etat_LitU">Etat Lit</label>
                                                <div class="controls">
                                                    <select type="text" class="form-control" name="etat_lit_U" id="etat_litU" required>
                                                      <option value="<?php echo $etat_lit;?>" selected><?php echo $etat;?></option>
                                                      <option value="1" >Libre</option>
                                                      <option value="2">Occupé</option>
                                                      <option value="3">Desactivé</option>
                                                      <option value="0">Non Fonctionnelle</option>
                                                    </select>
                                                </div>
                                            </div><br/>


                <?php   $reponse->closeCursor();

                    }

        catch(Exception $e)
                    {
                        die('Erreur : '.$e->getMessage());
                    }
     


        }
 ?>
