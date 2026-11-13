<?php   

        

     if(isset($_GET['username'])){
        $username = (String) trim($_GET['username']);
        $username = str_replace("'","\'",$username);
     
     echo"<script> alert('$username'); </script>";

            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host=localhost;dbname=virtuhos_mono_cabinet', 'root', '', $pdo_options);  

                  $reponse = $bdd->query("SELECT login FROM `users` WHERE `login` = '$username'");
                  
                  if ($reponse->rowCount() > 0) {
                     echo "<font size=\"2\" color=\"red\">username existant !</font>";
                     echo "<script> var usernameValide = \"false\";
                                      $('#password').attr('disabled', true);
                                      $('#ConfirmPassword').attr('disabled', true);
                                      $('#typeCompte').attr('disabled', true);
                                      $('#etape23').attr('disabled', true);
                     </script>"; 
                     
                   } else {
                     echo "<font size=\"2\" color=\"#00f300\">username valide.</font>"; 
                     echo "<script> var usernameValide = \"true\";
                                     $('#password').attr('disabled', false);
                                     $('#ConfirmPassword').attr('disabled', false);
                                     $('#typeCompte').attr('disabled', false);
                     </script>";      
                   }
                        
                  $reponse->closeCursor();



    }
 ?>            