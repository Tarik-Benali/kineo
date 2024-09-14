  <?php 

  include("../../includes/functions.php");

    if(isset($_GET['message'])){

        $lautre   = (String) trim($_GET['idLautre']);
        $message  = (String) trim($_GET['message']);
        $monId  = (String) trim($_GET['monId']);//Sender
        //$nomCabinet = (String) trim($_GET['nomCabinet']);
        //$idCabinet =  (String) trim($_GET['idCabinet']);
        $typeCompte  = (String) trim($_GET['typeCompte']);
        $typeAutre   = (String) trim($_GET['typeother']);

        insertionMessage($monId,$lautre,$message);

        global $host_name;
        global $baseGlobale;
        global $db_user_name;
        global $db_password;

        try
                    {
                      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                      $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                     
                         $reponse = $bdd->query("SELECT * FROM messages WHERE (`idExpediteur` = '$monId' AND `idDestinataire` = '$lautre') OR (`idExpediteur` = '$lautre' AND `idDestinataire` = '$monId') ORDER BY idMessage");

                          $exist = $reponse->rowCount();

                          if ($typeAutre == "patient") {
                            getPatientFromIdForChatHeader($lautre);

                          }else if ($typeAutre == "medecin") {
                            getDocFromIdForChatHeader($lautre);
                          }


                          $dejaAmi = verifierSilEstDejaAmi($monId, $lautre);
                          
                          //getDocFromIdForChatHeader($lautre);
                          echo "<div class=\"scrollTableMessages\" id=\"messgs\"  style=\"height: 400px; padding-top:10px; padding-right:10px;\">";
                                       
                          if ($exist != 0 && $monId != $lautre && $typeCompte == 2 && $typeAutre == "patient") {

                            //echo" <img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\"><br><br><br>";
                            while ($donnees = $reponse->fetch())
                                     {          
                                                $sender = $donnees['idExpediteur'];
                                                if ($sender == $monId) 
                                                {
                                                  echo"<h4 style=\"text-align: right\"><font color=\"#000945\">$donnees[message]</font></h4>";     
                                                }
                                                else
                                                {
                                                //echo" <img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                                echo"<span class=\"label\" style=\"padding-top:7px;\"><font size=\"3\">$donnees[message]</font></span><br><br>";
                                                }                                        
                                      }       

                                    echo  "</div>";

                                    echo " <input name=\"monId\"      type=\"hidden\" id=\"monId\"           value=\"$monId\"/> 
                                           <input name=\"idLautre\"   type=\"hidden\" id=\"idLautrePatient\" value=\"$lautre\"/>
                                           <input name=\"typeother\"  type=\"hidden\" id=\"typeother\"       value=\"$typeAutre\"/>
                                           <input name=\"typeCompte\" type=\"hidden\" id=\"typeCompte\"      value=\"$typeCompte\"/> 

                                        <div class=\"flex-container\" style=\"width: 100%\">
                                            <div class=\"input-group\" style=\"margin-top: 10px;flex-grow: 100;\">
                                              <span class=\"input-group-addon btn-success\"><i class=\"fontawesome-camera\"></i></span>
                                              <input type=\"text\" name=\"message\" class=\"form-control\" id=\"messagePatient\"/>
                                        </div>
                                        
                                        <div style=\"margin-top: 10px;flex-grow: 1\">
                                            <button onclick=\"sendNewMessage('$typeCompte','$typeAutre')\" class=\"btn btn-success\" style=\"width: 100%\"><i>Envoyer</i></button>
                                        </div>";    
                                      
                          }
                          else if ($exist != 0 && $monId != $lautre && $typeCompte == 2 && $typeAutre != "patient") {

                            //echo" <img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\"><br><br><br>";
                            while ($donnees = $reponse->fetch())
                                     {          
                                                $sender = $donnees['idExpediteur'];
                                                if ($sender == $monId) 
                                                {
                                                  echo"<h4 style=\"text-align: right\"><font color=\"#000945\">$donnees[message]</font></h4>";     
                                                }
                                                else
                                                {
                                                //echo" <img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                                echo"<span class=\"label\" style=\"padding-top:7px;\"><font size=\"3\">$donnees[message]</font></span><br><br>";
                                                }                                        
                                      }       

                                    echo  "</div>";

                                    echo " <input name=\"monId\"      type=\"hidden\" id=\"monId\"      value=\"$monId\"/> 
                                           <input name=\"idLautre\"   type=\"hidden\" id=\"idLautre\"   value=\"$lautre\"/>
                                           <input name=\"typeother\"  type=\"hidden\" id=\"typeother\"  value=\"$typeAutre\"/>
                                           <input name=\"typeCompte\" type=\"hidden\" id=\"typeCompte\" value=\"$typeCompte\"/> 

                                        <div class=\"flex-container\" style=\"width: 100%\">
                                            <div class=\"input-group\" style=\"margin-top: 10px;flex-grow: 100;\">
                                              <span class=\"input-group-addon btn-success\"><i class=\"fontawesome-camera\"></i></span>
                                              <input type=\"text\" name=\"message\" class=\"form-control\" id=\"message\"/>
                                        </div>
                                        
                                        <div style=\"margin-top: 10px;flex-grow: 1\">
                                            <button onclick=\"sendNewMessage('$typeCompte','$typeAutre')\" class=\"btn btn-success\" style=\"width: 100%\"><i>Envoyer</i></button>
                                        </div>";    
                                      
                          }
                          else if ($exist == 0 && $monId == $lautre && $typeCompte == 2 && $typeAutre == "medecin"){

                            echo "<form name=\"sendMsg\" id=\"sendMsg\">";

                              echo "<div class=\"table-responsive scrollTableMessages\" style=\"height: 300px;\">";

                                 echo "<div style='font-size:20xp; text-align:center; margin-top:10xp'><h3>Envoyer des messages à vous même</h3><br><h4>C'est l'espace idéal pour garder un text, ou un message brouillon</h4></div>";

                                 echo "<input name=\"idLautre\" type=\"hidden\" value=\"$lautre\" id=\"idLautre\"/>";

                               echo  "</div>

                                           <input type=\"hidden\" name=\"monId\" class=\"form-control\" id=\"monId\" value=\"$monId\"/> 
                                           <input name=\"idLautre\" type=\"hidden\" value=\"$lautre\" id=\"idLautre\"/>
                                           <input name=\"typeother\"  type=\"hidden\" id=\"typeother\"  value=\"$typeAutre\"/>
                                           <input name=\"typeCompte\" type=\"hidden\" id=\"typeCompte\" value=\"$typeCompte\"/>
                                      </div>

                                        <div class=\"flex-container\" style=\"width: 100%\">
                                            <div class=\"input-group\" style=\"margin-top: 10px;flex-grow: 100;\">
                                             <span class=\"input-group-addon btn-success\"><i class=\"fontawesome-camera\"></i>
                                             </span>
                                             <input type=\"text\" name=\"message\" class=\"form-control\" id=\"message\"/>
                                        </div>
                                        
                                        <div style=\"margin-top: 10px;flex-grow: 1\">
                                            <button onclick=\"sendNewMessage('$typeCompte','$typeAutre')\" class=\"btn btn-success\" style=\"width: 100%\">
                                            <i>Envoyer</i>
                                            </button>
                                        </div>
                                   
                                </form>";
                            }

                            else if ($exist != 0 && $monId == $lautre && $typeCompte == 2 && $typeAutre == "medecin"){

                            //echo" <img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\"><br><br><br>";
                            while ($donnees = $reponse->fetch())
                                     {          
                                                $sender = $donnees['idExpediteur'];
                                                if ($sender == $monId) 
                                                {
                                                  echo"<h4 style=\"text-align: right\"><font color=\"#000945\">$donnees[message]</font></h4>";     
                                                }
                                                else
                                                {
                                                //echo" <img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                                echo"<span class=\"label\" style=\"padding-top:7px;\"><font size=\"3\">$donnees[message]</font></span><br><br>";
                                                }                                        
                                      }       

                                    echo  "</div>";

                                    echo " <input name=\"monId\"      type=\"hidden\" id=\"monId\"      value=\"$monId\"/> 
                                           <input name=\"idLautre\"   type=\"hidden\" id=\"idLautre\"   value=\"$lautre\"/>
                                           <input name=\"typeother\"  type=\"hidden\" id=\"typeother\"  value=\"$typeAutre\"/>
                                           <input name=\"typeCompte\" type=\"hidden\" id=\"typeCompte\" value=\"$typeCompte\"/> 

                                        <div class=\"flex-container\" style=\"width: 100%\">
                                            <div class=\"input-group\" style=\"margin-top: 10px;flex-grow: 100;\">
                                              <span class=\"input-group-addon btn-success\"><i class=\"fontawesome-camera\"></i></span>
                                              <input type=\"text\" name=\"message\" class=\"form-control\" id=\"message\"/>
                                        </div>
                                        
                                        <div style=\"margin-top: 10px;flex-grow: 1\">
                                            <button onclick=\"sendNewMessage('$typeCompte','$typeAutre')\" class=\"btn btn-success\" style=\"width: 100%\"><i>Envoyer</i></button>
                                        </div>"; 
                            }

                            else if ($exist == 0 && $monId != $lautre && $typeCompte != 2 && $dejaAmi == 0){  
                            
                              echo "<div class=\"table-responsive scrollTableMessages\" style=\"height: 300px;\">";

                                if ($invEnvoyer == 0) {
                                  
                                  echo "<div id=\"addAmisDiv\" style='font-size:20xp; text-align:center; margin-top:10xp'>
                                            <h3>Envoyer une demande de chat</h3>
                                            <br>
                                            <button class=\"btn btn-success\" style=\"width: 30%\" onclick=\"addFreindsBtn('$monId','$lautre')\">
                                            <i>Envoyer</i>
                                            </button>
                                        </div>";
                                }else if ($invEnvoyer > 0) {
                                      
                                      echo "<div style='font-size:20xp; text-align:center; margin-top:10xp'>
                                            <h3>Demande Envoyé</h3>
                                        </div>";
                                }

                                 echo "<div id=\"demandeAmisDiv\" style='font-size:20xp; text-align:center; margin-top:10xp'>
                                          <h3>Demande Envoyé</h3>
                                      </div>";

                                 /*<input name=\"idLautre\" type=\"hidden\" value=\"$lautre\" id=\"idLautre\"/>";

                                 echo  "</div>
                                             <input type=\"hidden\" name=\"monId\" class=\"form-control\" id=\"monId\" value=\"$monId\"/> 
                                             <input name=\"idLautre\" type=\"hidden\" value=\"$lautre\" id=\"idLautre\"/>;
                                        </div>

                                        <div class=\"flex-container\" style=\"width: 100%\">
                                            <div class=\"input-group\" style=\"margin-top: 10px;flex-grow: 100;\">
                                             <span class=\"input-group-addon btn-success\"><i class=\"fontawesome-camera\"></i>
                                             </span>
                                             <input type=\"text\" name=\"message\" class=\"form-control\" id=\"message\"/>
                                        </div>
                                        
                                        <div style=\"margin-top: 10px;flex-grow: 1\">
                                            <button onclick=\"sendNewMessage('$typeCompte','$typeAutre')\" class=\"btn btn-success\" style=\"width: 100%\">
                                            <i>Envoyer</i>
                                            </button>
                                        </div>*/                                
                            }
                            else if ($exist == 0 && $monId != $lautre && $typeCompte != 2 && $dejaAmi == 1){  
                            
                             echo "<form name=\"sendMsg\" id=\"sendMsg\">";

                              echo "<div class=\"table-responsive scrollTableMessages\" style=\"height: 300px;\">";

                                echo "<div style='font-size:20xp; text-align:center; margin-top:10xp'><h3>Messages Patient / Médecin</h3><br><h4>Envoyer Votre Premier Message</h4></div>";

                                  echo "<input name=\"idLautre\" type=\"hidden\" value=\"$lautre\" id=\"idLautre\"/>";

                                  echo "</div>
                                           <input type=\"hidden\" name=\"monId\" class=\"form-control\" id=\"monId\" value=\"$monId\"/> 
                                           <input name=\"idLautre\" type=\"hidden\" value=\"$lautre\" id=\"idLautre\"/>
                                           <input name=\"typeother\"  type=\"hidden\" id=\"typeother\"  value=\"$typeAutre\"/>
                                           <input name=\"typeCompte\" type=\"hidden\" id=\"typeCompte\" value=\"$typeCompte\"/>
                                        </div>

                                        <div class=\"flex-container\" style=\"width: 100%\">
                                            <div class=\"input-group\" style=\"margin-top: 10px;flex-grow: 100;\">
                                            <span class=\"input-group-addon btn-success\"><i class=\"fontawesome-camera\"></i></span>
                                            <input type=\"text\" name=\"message\" class=\"form-control\" id=\"message\"/>
                                        </div>
                                        
                                        <div style=\"margin-top: 10px;flex-grow: 1\">
                                            <button onclick=\"sendNewMessage('$typeCompte','$typeAutre')\" class=\"btn btn-success\" style=\"width: 100%\"><i>Envoyer</i>
                                            </button>
                                        </div>
                                </form>";                             
                            }

                            else if ($exist != 0 && $monId != $lautre && $typeCompte != 2 && $dejaAmi == 1){  
                            
                              while ($donnees = $reponse->fetch())
                                     {          
                                                $sender = $donnees['idExpediteur'];
                                                if ($sender == $monId) 
                                                {
                                                  echo"<h4 style=\"text-align: right\"><font color=\"#000945\">$donnees[message]</font></h4>";     
                                                }
                                                else
                                                {
                                                //echo" <img class=\"armada-pic img-circle\" alt=\"\" src=\"assets/img/menAvatar.png\">";
                                                echo"<span class=\"label\" style=\"padding-top:7px;\"><font size=\"3\">$donnees[message]</font></span><br><br>";
                                                }                                        
                                      }       

                                    echo  "</div>";

                                    echo " <input name=\"monId\"      type=\"hidden\" id=\"monId\"      value=\"$monId\"/> 
                                           <input name=\"idLautre\"   type=\"hidden\" id=\"idLautre\"   value=\"$lautre\"/>
                                           <input name=\"typeother\"  type=\"hidden\" id=\"typeother\"  value=\"$typeAutre\"/>
                                           <input name=\"typeCompte\" type=\"hidden\" id=\"typeCompte\" value=\"$typeCompte\"/>

                                        <div class=\"flex-container\" style=\"width: 100%\">
                                            <div class=\"input-group\" style=\"margin-top: 10px;flex-grow: 100;\">
                                             <span class=\"input-group-addon btn-success\"><i class=\"fontawesome-camera\"></i></span>
                                             <input type=\"text\" name=\"message\" class=\"form-control\" id=\"message\"/>
                                        </div>
                                        
                                        <div style=\"margin-top: 10px;flex-grow: 1\">
                                            <button onclick=\"sendNewMessage('$typeCompte','$typeAutre')\" class=\"btn btn-success\" style=\"width: 100%\"><i>Envoyer</i></button>
                                        </div>";                              
                            }
                            /*else if ($exist == 0 && $monId != $lautre && $typeCompte == 2) {  
                            echo "<form name=\"sendMsg\" id=\"sendMsg\">";

                              echo "<div class=\"table-responsive scrollTableMessages\" style=\"height: 300px;\">";

                                echo "<div style='font-size:20xp; text-align:center; margin-top:10xp'><h3>Messages entre médecins</h3><br><h4>Envoyer Votre Premier Message</h4></div>";

                                  echo "<input name=\"idLautre\" type=\"hidden\" value=\"$lautre\" id=\"idLautre\"/>";

                                  echo "</div>
                                           <input type=\"hidden\" name=\"monId\" class=\"form-control\" id=\"monId\" value=\"$monId\"/> 
                                           <input name=\"idLautre\" type=\"hidden\" value=\"$lautre\" id=\"idLautre\"/>
                                           <input name=\"typeother\"  type=\"hidden\" id=\"typeother\"  value=\"$typeAutre\"/>
                                           <input name=\"typeCompte\" type=\"hidden\" id=\"typeCompte\" value=\"$typeCompte\"/>
                                        </div>

                                        <div class=\"flex-container\" style=\"width: 100%\">
                                            <div class=\"input-group\" style=\"margin-top: 10px;flex-grow: 100;\">
                                            <span class=\"input-group-addon btn-success\"><i class=\"fontawesome-camera\"></i></span>
                                            <input type=\"text\" name=\"message\" class=\"form-control\" id=\"message\"/>
                                        </div>
                                        
                                        <div style=\"margin-top: 10px;flex-grow: 1\">
                                            <button onclick=\"sendNewMessage('$typeCompte','$typeAutre')\" class=\"btn btn-success\" style=\"width: 100%\"><i>Envoyer</i>
                                            </button>
                                        </div>
                                </form>";
                            }*/

                          $reponse->closeCursor();     
                    }
        catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
        //header('location: messagerie.php?message=recu');
      }
      else{
        echo "Problème de connexion.";
      }
 ?>
