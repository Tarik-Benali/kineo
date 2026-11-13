<?php include("auth/auth.php"); 
      include("includes/functions.php");

      global $host_name;
      global $baseGlobale;
      global $db_user_name;
      global $db_password;

      //echo "fffffffffff " . $host_name . " " . $baseGlobale . " " . $db_user_name . " " . $db_password;?>

<?php 
        $typeCompte         = $_SESSION['typeCompte']; 
        $usernameMedecin    = $_SESSION['username']; 
        $identifiantMedecin = $_SESSION['identifiant']; 


        try
            {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale", $db_user_name, $db_password, $pdo_options);                                                    
                                                     
                // On recupere tout le contenu de la table news
                $reponse = $bdd->query("SELECT * FROM `cabinet`,`relationmedcab` WHERE cabinet.idCabinet = relationmedcab.idCabinet and relationmedcab.idMedecin = '$identifiantMedecin'");

                $count = $reponse->rowCount();

                switch ($count) {
                          case 0:

?>
<!DOCTYPE html>

  <head>

    <meta charset="utf-8">
    <title>Mon Cabinet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>

   <!--  <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/signin.css">

        <link rel="stylesheet" type="text/css" href="assets/js/progress-bar/number-pb.css">

    <link href="assets/js/footable/css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable.standalone.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable-demos.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="assets/js/dataTable/lib/jquery.dataTables/css/DT_bootstrap.css" />
    <link rel="stylesheet" href="assets/js/dataTable/css/datatables.responsive.css" />

    <link rel="stylesheet" href="assets/js/calendar/css/calendar.css">



    <style type="text/css">

    canvas#canvas4 {
        position: relative;
        top: 20px;

    }
    </style>






    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/minus.png">
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <div class="container">



        <div class="" id="login-wrapper">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div id="logo-login">
                        <h1>Virtuhos
                            <span>v1.0</span>
                        </h1>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="account-box">


                          <div class="side-bar"">
                                <h2>
                                    Bienvenu Docteur, 
                                </h2>
                                </h3>    
                                    Vous vous n'appartenez à aucun cabinet !
                                    <br/>
                                    Pour continue, il faut qu'un administrateur vous ajoute dans un cabinet 
                                    <br/><br/><br/>
                                </h3>

                                <ul>
                                <div style="text-align:center;margin-right:50px;">
                                    <a href="auth/logout.php"/><input type="submit" class="btn btn-primary form-control" value="Déconnexion"/></a>
                                </div>
                                </ul>
                          </div>          
                    </div>
                </div>
            </div>
        </div>





        <div style="text-align:center;margin:0 auto;">
            <h6 style="color:#fff;">Release Candidate 1.0 Powered by © Cedisystems 2020</h6>
        </div>

    </div>
    <div id="test1" class="gmap3"></div>



    <!--  END OF PAPER WRAP -->

    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>
    <script src="assets/js/progress-bar/src/jquery.velocity.min.js"></script>
    <script src="assets/js/progress-bar/number-pb.js"></script>
    <script src="assets/js/progress-bar/progress-app.js"></script>



    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="assets/js/preloader.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/load.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

    <script type="text/javascript" src="assets/js/chart/jquery.flot.js"></script>
    <script type="text/javascript" src="assets/js/chart/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="assets/js/chart/realTime.js"></script>
    <script type="text/javascript" src="assets/js/speed/canvasgauge-coustom.js"></script>

    <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/map/gmap3.js"></script>

</body>

</html>

<?php                          
                                
                              break;
                          
                          case 1:

                          while ($donnees = $reponse->fetch())
                                                {                              
                                                    $_SESSION['idCabinet'] = $donnees['idCabinet'];                     
                                                    $idCabinet             = $_SESSION['idCabinet'];    

                                                    $_SESSION['nomCabinet'] = $donnees['nomCabinet'];
                                                    $nomCabinet             = $_SESSION['nomCabinet'];

                                                    $_SESSION['adresseCabinet'] = $donnees['adresseCabinet'];
                                                    $adresseCabinet             = $_SESSION['adresseCabinet'];

                                                    $_SESSION['idMedCab']       = $donnees['idMedCab'];
                                                    $idMedCab                   = $_SESSION['idMedCab'];

                                                    $_SESSION['idMedecin']      = $donnees['idMedecin'];
                                                    $idMedecin                  = $_SESSION['idMedecin'];                                                        
                                                }
                                header("Location: medecin.php?idCabinet=".$idCabinet."&nomCabinet=".$nomCabinet."&adresseCabinet=".$adresseCabinet."&idMedCab=".$idMedCab."&idMedecin=".$idMedecin."");
                              break;      
                          
                          default:
?>

<!DOCTYPE html>

  <head>

    <meta charset="utf-8">
    <title>Mon Cabinet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>

   <!--  <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/signin.css">

        <link rel="stylesheet" type="text/css" href="assets/js/progress-bar/number-pb.css">

    <link href="assets/js/footable/css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable.standalone.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable-demos.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="assets/js/dataTable/lib/jquery.dataTables/css/DT_bootstrap.css" />
    <link rel="stylesheet" href="assets/js/dataTable/css/datatables.responsive.css" />

    <link rel="stylesheet" href="assets/js/calendar/css/calendar.css">



    <style type="text/css">

    canvas#canvas4 {
        position: relative;
        top: 20px;

    }
    </style>






    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
<!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/minus.png">
</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <div class="container">



        <div class="" id="login-wrapper">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div id="logo-login">
                        <h1>Virtuhos
                            <span>v1.0</span>
                        </h1>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="account-box">


                          <div class="side-bar"">
                                <h2>Merci de choisir un cabinet <br/><br/>
                                </h2>
                        
                                        <ul class="topnav menu-left-nest">

                                            
                                             <?php
                                                try
                                                {
                                                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                    $bdd = new PDO('mysql:host=localhost;dbname=baseglobal', 'root', '', $pdo_options);
                                                     
                                                     
                                                    
                                                    $reponse = $bdd->query("SELECT * FROM `cabinet`,`relationmedcab` WHERE cabinet.idCabinet = relationmedcab.idCabinet and relationmedcab.idMedecin = '$identifiantMedecin';");
                                                  
                                                
                                                while ($donnees = $reponse->fetch())
                                                {                              
                                                    $_SESSION['idCabinet'] = $donnees['idCabinet'];                     
                                                    $idCabinet             = $_SESSION['idCabinet'];    

                                                    $_SESSION['nomCabinet'] = $donnees['nomCabinet'];
                                                    $nomCabinet             = $_SESSION['nomCabinet'];

                                                    $_SESSION['adresseCabinet'] = $donnees['adresseCabinet'];
                                                    $adresseCabinet             = $_SESSION['adresseCabinet'];

                                                    $_SESSION['idMedCab']       = $donnees['idMedCab'];
                                                    $idMedCab                   = $_SESSION['idMedCab'];

                                                    $_SESSION['idMedecin']      = $donnees['idMedecin'];
                                                    $idMedecin                  = $_SESSION['idMedecin'];

                                                    echo "<br/>";


                                                        echo "
                                                        <form method=POST action=medecin.php>
                                                           <input type=\"hidden\" name=\"idCabinet\" value=\"$idCabinet\"></input>
                                                           <input type=\"hidden\" name=\"nomCabinet\" value=\"$nomCabinet\"></input>
                                                           <input type=\"hidden\" name=\"adresseCabinet\" value=\"$adresseCabinet\"></input>
                                                           <input type=\"hidden\" name=\"idMedCab\" value=\"$idMedCab\"></input>
                                                           <input type=\"hidden\" name=\"idMedecin\" value=\"$idMedecin\"></input>
                                                           <div style=\"text-align:center;margin-right:50px;\">
                                                           <input type=\"submit\" class=\"btn btn-primary form-control\" value=\"$nomCabinet\"/>
                                                           </div>
                                                        </form>"; 
                                            
                                                     //style=\"width:180px;\"
                                                }
                                                echo "<br/>";
                                                $reponse->closeCursor();
                                                }
                                                catch(Exception $e)
                                                {
                                                    die('Erreur : '.$e->getMessage());
                                                }
                                                ?>
                                                                                                                                   
                                              
                                        </ul>
                          </div>          






                    </div>
                </div>
            </div>
        </div>





        <div style="text-align:center;margin:0 auto;">
            <h6 style="color:#fff;">Release Candidate 1.0 Powered by © Cedisystems 2020</h6>
        </div>

    </div>
    <div id="test1" class="gmap3"></div>



    <!--  END OF PAPER WRAP -->

    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>
    <script src="assets/js/progress-bar/src/jquery.velocity.min.js"></script>
    <script src="assets/js/progress-bar/number-pb.js"></script>
    <script src="assets/js/progress-bar/progress-app.js"></script>



    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="assets/js/preloader.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/load.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

    <script type="text/javascript" src="assets/js/chart/jquery.flot.js"></script>
    <script type="text/javascript" src="assets/js/chart/jquery.flot.resize.js"></script>
    <script type="text/javascript" src="assets/js/chart/realTime.js"></script>
    <script type="text/javascript" src="assets/js/speed/canvasgauge-coustom.js"></script>

    <script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script type="text/javascript" src="assets/js/map/gmap3.js"></script>

</body>

</html>


<?php                               
                              break;
                      }      

                    $reponse->closeCursor();
            }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
     
    ?>


