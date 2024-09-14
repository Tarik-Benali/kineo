<?php       

     if(isset($_GET['nom'])){
        $nom = (String) trim($_GET['nom']);
        $prenom = (String) trim($_GET['prenom']);
        $tel = (String) trim($_GET['tel']);
        $email = (String) trim($_GET['email']);
        $dateNaiss = $_GET['dateNaiss'];
        $lieuNaiss = $_GET['city'];
        $password = $_GET['password'];
        $ConfirmPassword = $_GET['ConfirmPassword'];
        $groupeSanguin = (String) trim($_GET['groupeSanguin']);
        $adress = $_GET['adress'];
        $TypeCompte = $_GET['typeCompte'];
        $Sexe = $_GET['Sexe'];
        $username = $_GET['username'];
        

        switch ($TypeCompte) {
          case 'Médecin':
               $TypeCompte = '2';
               $username = $username . "@medecin";
            break;

          case 'Patient':
                $TypeCompte = '1';
                $username = $username . "@patient";
            break;

          case 'Infermier':
                $TypeCompte = '3';
                $username = $username . "@infermer";
            break;    
          
        }

        if ($TypeCompte == "") {
          # code...
        }

     ?>
            <div class="modal fade"  id="modalCofirmationInfos" role="dialog">
              <div class="modal-dialog">
                                        
                <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><?php echo date('H:i');?></button>
                          <h4 class="modal-title">Vos Informations</h4>
                    </div>
                    <div class="modal-body" style="height: 400px; overflow-y: auto;">
                    <form class="login" id="inscriptionConfirme" action="" method="post">    
                      <fieldset>

                          <div class="form-group">                                           
                           <br>
                           <label>Nom:                <?php echo $nom;?>                      </label><br>
                           <label>Prenom:             <?php echo $prenom ;?>                  </label><br>
                           <label>Sexe                <?php echo $Sexe;?>                     </label><br>
                           <label>Date De Naissance   <?php echo $dateNaiss;?>                </label><br>
                           <label>Lieu De Naissance   <?php echo $lieuNaiss;?>                </label><br>
                           <label>Adresse             <?php echo $adress;?>                   </label><br>
                           <label>Numéro De Téléphone <?php echo $tel;?>                      </label><br>
                           <label>email               <?php echo $email;?>                    </label><br>
                           <label>Groupage Sangin     <?php echo $groupeSanguin;?>            </label><br>
                           <label>Mot De Pass         <?php echo $password;?>                   </label><br>
                           <label>Re Mot De Pass      <?php echo $ConfirmPassword;?>            </label><br>
                           <label>TypeCompte          <?php echo "<h1>".$TypeCompte."</h1>";?>  </label><br>
                           <label>UserName            <?php echo $username;?>                   </label><br>
                           <label>Identifiant         <?php echo "id";?>                        </label><br>

                         
                          </div>
                                                                                                                                 
                      </fieldset> 

                      <input type="submit" name="submit" class="btn btn-success pull-right" style="margin-right: 10px;" value="Confirmer"/>

                      <input name="annuler" id="annulerConf" class="btn btn-success pull-right" style="margin-right: 10px;" value="Annuler"/>                                                              
                     </form>                         
                    </div>                                                                     
                                          
                </div>
            </div>
<?php 
    }
 ?>            