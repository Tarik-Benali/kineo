     <?php include("../../includes/functions.php");


     if(isset($_REQUEST['IdMateriel'])){
        $idMat      = (String) trim($_REQUEST['IdMateriel']);
        $nomCabinet = (String) trim($_REQUEST['nomCabinet']);
        //$idCabinet =  (String) trim($_REQUEST['idCabinet']);

        global $host_name;
        global $db_user_name;
        global $db_password;

        $nomB       = crypterNomDeLaBase($nomCabinet);

        $list_slp    = getRelationMatSLP($nomCabinet,$idMat); 

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);
                                                     
                         $reponse = $bdd->query("SELECT * FROM `materiel` WHERE `idMateriel` = '$idMat'");
                          
                            
                            while ($donnees = $reponse->fetch())
                                {

                                    $nom_materiel   = $donnees['nom'];
                                    $num_serie_Mat  = $donnees['numeroSerie'];
                                    $etatMateriel   = $donnees['etatMateriel'];
                                    $motif_supp_mat = $donnees['motif_supp_materiel'];


                                    if ($etatMateriel == '0') {
                                        $etat = "Desactivé";
                                    }elseif ($etatMateriel =='1') {
                                        $etat = "Libre";
                                    }elseif ($etatMateriel =='2') {
                                        $etat = "Occupé";
                                    }elseif ($etatMateriel =='3') {
                                        $etat = "Non Fonctionnel";
                                    }
                                }

                                //$nomSalle = getSalleNameFromId($nomCabinet,$id_emplacement);
                                ?>

                                <script>
                                    document.getElementById('titreModalUpdate').innerHTML = "Modification " + "<b><?php echo $nom_materiel . '  \''.$num_serie_Mat. '\'  ';?></b>";
                                </script>

                                <input type="hidden" name="idMat_U" <?php echo "value=".$idMat."";?>>

                                

                                            <div class="control-group">
                                                <label class="control-label" for="nom_materiel">Nom materiel</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="nom_materiel_U" id="nom_materielU" value="<?php echo $nom_materiel;?>">
                                                </div>
                                            </div><br/>



                                            <div class="control-group">
                                                <label class="control-label" for="num_serie_Mat">Numéro de série</label>
                                                <div class="controls">
                                                   <input type="text" class="form-control" name="num_serie_Mat_U" id="num_serie_MatU" value="<?php echo $num_serie_Mat;?>">
                                                </div>
                                            </div><br/>


                                            <!--div class="control-group">
                                                <label class="control-label">Emplacement Lit: &nbsp;</label>

                                                <select id="listSalleU" name="emplacement_lit_U" class="form-control">
                                                    <option value="--" selected><?php //echo $nomSalle;?></option>
                                                    <?php //getAvailableSalleForOption($nomCabinet);?>
                                                </select>
                                            </div><br/-->


                                            <div class="control-group">
                                                <label class="control-label" for="etatMaterielU">Etat Materiel</label>
                                                <div class="controls">
                                                    <select type="text" class="form-control" name="etatMateriel_U" id="etatMaterielU" required>
                                                      <option value="<?php echo $etatMateriel;?>" selected><?php echo $etat;?></option>
                                                      <option value="1">Libre</option>
                                                      <option value="2">Occupé</option>
                                                      <option value="0">Desactivé</option>
                                                      <option value="3">Non Fonctionnelle</option>
                                                    </select>
                                                </div>
                                            </div><br/>


                                            <div class="control-group">
                                                <label id="labelSalle" class="control-label">Affectation : &nbsp;(Salle)</label>

                                                <select id="listSalleU" class="form-control">
                                                    <option value="--" selected><?php echo $list_slp;?></option>
                                                    <?php getAvailableSalleForOption($nomCabinet);?>
                                                </select>

                                                <label id="labelLit" class="control-label">Affectation : &nbsp;(Lit)</label>

                                                <select id="listLitU"  class="form-control">
                                                    <option value="--" selected><?php echo $list_slp;?></option>
                                                    <?php getAvailableLitForOption($nomCabinet);?>
                                                </select>

                                                <!--select id="listPatientU" class="form-control">
                                                    <option value="--" selected><?php //echo $nomSalle;?>listPatientU</option>
                                                    <?php //getAvailableSalleForOption($nomCabinet);?>
                                                </select-->

                                                <input id="rslt_slp" type="hidden" name="emplacement_materiel_U" value="<?php echo $list_slp;?>">
                                                <input id="type_slp" type="hidden" name="emplacement_materiel_U_type" value="<?php echo $list_slp;?>">

                                                &nbsp;
                                                <a id="salleList"   href="#" style="margin-right: 5px">salle    </a>
                                                <a id="litList"     href="#" style="margin-right: 5px">lit      </a>
                                                <a id="patientList" href="#" style="margin-right: 5px">patient  </a>
                                            </div><br/>



                    <script>
                        $(document).ready(function(){

                            $('#listSalleU').on('change', function() {
                              var Salle_slps =  $('#listSalleU option:selected').val();
                              $("#rslt_slp").val(Salle_slps);
                              $("#type_slp").val("S");
                            });

                            $('#listLitU').on('change', function() {
                              var Lit_slps =  $('#listLitU option:selected').val();
                              $("#rslt_slp").val(Lit_slps);
                              $("#type_slp").val("L");
                            });

                            $("#listSalleU").show();
                            $("#listLitU").hide();
                            $("#labelSalle").show();
                            $("#labelLit").hide();
                            
                                $("#litList").click(function(){
                                  $("#listSalleU").hide();
                                  $("#listLitU").show();
                                  $("#labelSalle").hide();
                                  $("#labelLit").show();
                                });

                                $("#salleList").click(function(){
                                  $("#listLitU").hide();
                                  $("#listSalleU").show();
                                  $("#labelLit").hide();
                                  $("#labelSalle").show();
                                });
                        });
                    </script>    


        
                                            


                <?php   $reponse->closeCursor();

                    }

        catch(Exception $e)
                    {
                        die('Erreur : '.$e->getMessage());
                    }
     


        }
 ?>
