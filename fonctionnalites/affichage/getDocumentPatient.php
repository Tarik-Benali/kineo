<?php

    if (isset($_REQUEST['identifiant']) && isset($_REQUEST['nomCabinet'])) {

    include("../../includes/functions.php");

    $idPatient       = $_REQUEST['identifiant'];
    $nomCabint       = $_REQUEST['nomCabinet'];

    global $host_name;
    global $db_user_name;
    global $db_password;

    $database   = crypterNomDeLaBase($nomCabint);

              try
                    {
                                            
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                    
                    $reponse = $bdd->query("SELECT * FROM `dossierpatient` WHERE `idPatient` = '$idPatient'");
                    $nbr = $reponse->rowCount();

                    

                    if ($nbr == 0) {
                      
                    }else{

                      while ($donnees = $reponse->fetch())
                          {
                            $id_document  = $donnees['id_document'];
                            $idPatient    = $donnees['idPatient'];
                            $date_ajout   = $donnees['date_ajout'];
                            $path         = $donnees['path'];
                            $id_ajouteur  = $donnees['id_ajouteur'];

                            $pourHeure = substr($date_ajout, 0, -7);

                            $date  = substr($date_ajout,  0,10);
                            $heur =  substr($pourHeure, 11);

                            $lien =  substr($path, 6);

                            echo "<div class=\"col-sm-3\">
                                    <div class=\"panel panel-default\">
                                        <div class=\"panel-twitter\">
                                            <img src=\"files/dossierPatient/597202109181512/e9693f613f89248876963c42d4f47040.jpg\" width=\"112px;\" height:=\"200px;\"  alt=\"\">
                                        </div>
                                        <div class=\"panel-body\">
                                            <p class=\"lead\">Ajouté par: ".getMedecinName($id_ajouteur)."</p>
                                            <p class=\"social-follower\">Le : ".$date." à ".$heur."</p>

                                            <p>
                                                <a href=\"http://localhost:8888/Virtuhos%20Kin%C3%A9/".$lien."\" class=\"link-social\" download>
                                                    <span class=\"entypo-download\"></span>
                                                </a>

                                                <a href=\"http://localhost:8888/Virtuhos%20Kin%C3%A9/".$lien."\" class=\"link-social\" target=\"_blank\">
                                                    <span class=\"entypo-eye\"></span>
                                                </a>
                                                

                                            </p>
                                        </div>
                                    </div>
                                </div>";

                            
                          }
                    }
            
                   $reponse->closeCursor();
                  }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    }
    }
?>  