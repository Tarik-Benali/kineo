<?php 
        
    require('config/db.php');
    //require('config/changerbd.php');

        session_start();

        if (isset($_POST['username']) && isset($_POST['password']))
        {

            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($con,$username);

            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con,$password);

            $passwordH = hash('sha512', $password);

                $query = "SELECT * FROM `users` WHERE login='$username' and password='$passwordH'";

            $result = mysqli_query($con,$query) or die(mysql_error());
            $rows = mysqli_num_rows($result);

                if($rows==1)
                {
                    if ($row = mysqli_fetch_array($result)) {

                        $_SESSION['username'] = $username;

                        $results = array();
                        $results['typeCompte'] = $row['typeCompte'];
                        $typeUser = $results['typeCompte'];

                        $_SESSION['typeCompte']  = $row['typeCompte'];
                        $_SESSION['identifiant'] = $row['identifiant'];


                        //juste pour cabinet Urologie Musta
                        $_SESSION['nomDeCeCabinet'] = "virtuhos_kine";

                        switch ($typeUser) {

                                    case '0':
                                            //header("Location: index.php");
                                            header("Location: superAdmin.php");
                                            break;

                                    case '1':
                                            header("Location: patient.php");
                                            break;

                                    case '2':
                                            header("Location: choixCabinet.php");
                                            break;

                                    case '3':
                                            header("Location: infermier.php");
                                            break;

                                    case '4':
                                            header("Location: admin.php");
                                            break;  

                                    case '5':
                                            header("Location: staff.php");
                                            break;                      
                                   
                                    default:
                                        # code...
                                        break;
                                } 

                    }

                 }else if($rows>1)
                    {?>                    

                        <!DOCTYPE html>
                        <html lang="en">

                        <head>
                            <meta charset="utf-8">
                            <title>Virtuhos V 1.0</title>
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                            <meta name="description" content="">
                            <meta name="author" content="">

                            <!-- Le styles -->
                            <script type="text/javascript" src="assets/js/jquery.min.js"></script>

                            <link rel="stylesheet" href="assets/css/loader-style.css">
                            <link rel="stylesheet" href="assets/css/bootstrap.css">
                            <link rel="stylesheet" href="assets/css/signin.css">

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

                                                <h2>Merci de choisir un profile <br/><br/></h2>
                                                                            
                                                    <ul class="topnav menu-left-nest">


                                                         <?php       while ($donnees = mysqli_fetch_array($result))
                                                                    {       
                                                                        $_SESSION['username']     = $username;

                                                                        $_SESSION['typeCompte']   = $donnees['typeCompte'];
                                                                        $typeCompte               = $_SESSION['typeCompte'];  

                                                                        $_SESSION['identifiant']  = $donnees['identifiant'];
                                                                        $identifiant              = $_SESSION['identifiant'];

                                                                        //juste pour cabinet Urologie Musta
                                                                        $_SESSION['nomDeCeCabinet'] = "virtuhos_mono_cabinet";

                                                                        switch ($typeCompte) {
                                                                            case '1':
                                                                                $profile = "Patient";
                                                                                break;
                                                                            case '2':
                                                                                $profile = "Médecin";
                                                                                break;
                                                                            case '3':
                                                                                $profile = "Infermier";
                                                                                break;
                                                                            case '5':
                                                                                $profile = "Staff";
                                                                                break;        

                                                                        }

                                                                     echo "<br/>";

                                                                        echo "<form method=POST action=choixProfile.php>
                                                                                    <input type=\"hidden\" name=\"username\" value=\"$username;\"></input>
                                                                                    <input type=\"hidden\" name=\"typeCompte\" value=\"$typeCompte\"></input>
                                                                                    <input type=\"hidden\" name=\"identifiant\" value=\"$identifiant\"></input>
                                                                                    <div style=\"text-align:center;margin-right:50px;\">
                                                                                    <input type=\"submit\" style=\"widht:20%\" class=\"btn btn-primary form-control\" value=\"$profile\"/>
                                                                                    </div>
                                                                              </form>";     
                                                                    }
                                                                    echo "<br/>";
                                                                     ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div style="text-align:center;margin:0 auto;">
                                                            <h6 style="color:#fff;">VIRTUHOS 1.0 Powered by © Cedi Systems 2020</h6>
                                                        </div>

                                                    </div>
                                                    <!--  END OF PAPER WRAP -->

                                                    <!-- MAIN EFFECT -->
                                                    <script type="text/javascript" src="assets/js/preloader.js"></script>
                                                    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
                                                    <script type="text/javascript" src="assets/js/app.js"></script>
                                                    <script type="text/javascript" src="assets/js/load.js"></script>
                                                    <script type="text/javascript" src="assets/js/main.js"></script>

                                                </body>

                                                </html><?php 

                 }else {


                            $query = "SELECT * FROM `users` WHERE login='$username' and password=''";

                            $result = mysqli_query($con,$query) or die(mysql_error());
                            $rows = mysqli_num_rows($result);

                            if($rows==1)
                             {


                                if ($row = mysqli_fetch_array($result)) {

                                $_SESSION['username'] = $username;

                                $results = array();
                                $results['typeCompte'] = $row['typeCompte'];
                                $typeUser = $results['typeCompte'];

                                $_SESSION['typeCompte'] = $row['typeCompte'];
                                $_SESSION['identifiant'] = $row['identifiant'];

                                switch ($typeUser) {


                                  

                                        case '3':
                                                try
                                                    {
                                                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                        $bdd = new PDO('mysql:host=localhost;dbname=baseglobal', 'root', '', $pdo_options);

                                                    $reponse = $bdd->query("SELECT * FROM relinfercab,users,cabinet WHERE cabinet.idCabinet = relinfercab.idCabinet AND relinfercab.identifiantInfermier = users.identifiant AND users.login = '$username' AND users.typeCompte = '3'");


                                                    while ($donnees = $reponse->fetch())
                                                    {                                                    
                                                        $_SESSION['nomCabinet']  = $donnees['nomCabinet'];
                                                        $nomCabinet              = $_SESSION['nomCabinet'];

                                                        $_SESSION['username']    = $donnees['login'];
                                                        $_SESSION['typeCompte']  = $typeUser;
                                                        $_SESSION['identifiant'] = $donnees['iduser'];
                                                        $_SESSION['idCabinet']   = $donnees['idCabinet'];

                                                        //juste pour cabinet Urologie Musta
                                                        $_SESSION['nomDeCeCabinet'] = "virtuhos_mono_cabinet";

                                                        connexionInfermier($username, $password, $nomCabinet);

                                                        //header("Location: infermier.php");                                              
                                                         
                                                    }
                                                    $reponse->closeCursor();
                                                    }
                                                    catch(Exception $e)
                                                    {
                                                        die('Erreur : '.$e->getMessage());
                                                    }
                                                break;

                                        case '4':
                                                    try
                                                    {
                                                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                        $bdd = new PDO('mysql:host=localhost;dbname=baseglobal', 'root', '', $pdo_options);

                                                    $reponse = $bdd->query("SELECT * FROM reladmincab,users,cabinet WHERE cabinet.idCabinet = reladmincab.idCabinet AND reladmincab.identifiantAdmin = users.identifiant AND users.login = '$username' AND users.typeCompte = '4';"); //************************  à revoire !!! **************


                                                    while ($donnees = $reponse->fetch())
                                                    {                                                    
                                                        $_SESSION['nomCabinet']  = $donnees['nomCabinet'];
                                                        $nomCabinet              = $_SESSION['nomCabinet'];

                                                        $_SESSION['username']    = $donnees['login'];
                                                        $_SESSION['typeCompte']  = $typeUser;
                                                        $_SESSION['identifiant'] = $donnees['iduser'];
                                                        $_SESSION['idCabinet']   = $donnees['idCabinet'];

                                                        //juste pour cabinet Urologie Musta
                                                        $_SESSION['nomDeCeCabinet'] = "virtuhos_mono_cabinet";

                                                        connexionAdmin($username, $password, $nomCabinet);

                                                        //header("Location: admin.php");

                                                         
                                                    }
                                                    $reponse->closeCursor();
                                                    }
                                                    catch(Exception $e)
                                                    {
                                                        die('Erreur : '.$e->getMessage());
                                                    }

                                                break;

                                        case '5':
                                                try
                                                    {
                                                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                        $bdd = new PDO('mysql:host=localhost;dbname=baseglobal', 'root', '', $pdo_options);

                                                   $reponse = $bdd->query("SELECT * FROM relstaffcab,users,cabinet WHERE cabinet.idCabinet = relstaffcab.idCabinet AND relstaffcab.identifiantStaff = users.identifiant AND users.login = '$username' AND users.typeCompte = '5'");


                                                    while ($donnees = $reponse->fetch())
                                                    {                                                    

                                                        $_SESSION['nomCabinet']   = $donnees['nomCabinet'];
                                                        $nomCabinet               = $_SESSION['nomCabinet'];
                                                        $_SESSION['idCabinet']    = $donnees['idCabinet'];
                                                        $_SESSION['idDeCeCabinet']= $donnees['idCabinet'];
                                                        $_SESSION['adresseCab']   = $donnees['adresseCabinet'];
                                                        
                                                        $_SESSION['username']     = $donnees['login'];
                                                        $_SESSION['typeCompte']   = $donnees['typeCompte'];
                                                        $_SESSION['identifiant']  = $donnees['iduser'];
                                                        $_SESSION['idStaff']      = $donnees['identifiant'];

                                                        //juste pour cabinet Urologie Musta
                                                        $_SESSION['nomDeCeCabinet'] = "virtuhos_mono_cabinet";

                                                        connexionStaff($username, $password, $nomCabinet);

                                                        //header("Location: infermier.php");                                              
                                                         
                                                    }
                                                    $reponse->closeCursor();
                                                    }
                                                    catch(Exception $e)
                                                    {
                                                        die('Erreur : '.$e->getMessage());
                                                    }
                                                break;                               
                                       
                                        default:
                                            # code...
                                            break;
                                    } 
                                
                                } 

                            }else
                                 {
                                    header('location: fauxMDP.php');
                                    
                                    }

                        

                        }



                             

            }else { 
                ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Virtuhos V 1.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>

   <!--  <link rel="stylesheet" href="assets/css/style.css"> -->
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/signin.css">

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

                        <form class="login" action="" method="post" name="login">
                            <div class="form-group">
                                <label for="inputUsernameEmail">Username</label>
                                <input type="text" class="form-control" name="username" id="inputUsernameEmail" autofocus>


                            </div>
                            <div class="form-group">
                                <label for="inputPassword">Password</label>
                                <input type="password" class="form-control"  id="inputPassword" name="password" >

                            </div>

                            <input type="submit" value="Connexion" name="submit" class="btn btn btn-primary pull-right">

                        </form>


                        <a class="forgotLnk" href="index.html"></a>
                        <hr>

                        <!--a class="forgotLnk" href="fonctionnalites/registration.php">Vous n'êtes pas inscrit ?</a-->
                      

                    </div>
                </div>
            </div>
        </div>





        <div style="text-align:center;margin:0 auto;">
            <h6 style="color:#fff;">VIRTUHOS 1.0 Powered by © Cedi Systems 2020</h6>
        </div>

    </div>


    <!--  END OF PAPER WRAP -->

    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="assets/js/preloader.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/load.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

<?php } ?>
</body>

</html>
