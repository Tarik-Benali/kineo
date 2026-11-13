<?php
include("auth/auth.php");

if (isset($_SESSION['identifiant']) && ($_SESSION['typeCompte'] == "1"  || $_SESSION['typeCompte'] == "2" || $_SESSION['typeCompte'] == "5")) {
    

    if (isset($_SESSION['identifiant'])){

                $identifiant  = $_SESSION["identifiant"];                                               

                //getTheme($identifiant);

                $theme  = $_SESSION['theme'];

            }
    else{
            $_SESSION['theme']  = "bg";

            $theme              = $_SESSION['theme'];
        }


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
    <script type="text/javascript" src="assets/qrcode/instascan.min.js"></script>

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

                        <div>
                                <label>QRCode Scanner</label>
                        </div>

                        <hr>
                        
                        <video id="preview" class="p-1 border" style="width:100%;"></video>
                
                        <hr>

                        <p>Identifiant: <p id="identifiant"></p> </p>

                        <script type="text/javascript">
                            var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
                            scanner.addListener('scan',function(content){
                                //alert('******: ' + content);
                                document.getElementById("identifiant").innerHTML = content;
                                //window.location.href=content;
                            });
                            Instascan.Camera.getCameras().then(function (cameras){
                                if(cameras.length>0){
                                    scanner.start(cameras[0]);
                                    $('[name="options"]').on('change',function(){
                                        if($(this).val()==1){
                                            if(cameras[0]!=""){
                                                scanner.start(cameras[0]);
                                            }else{
                                                alert('Pas de caméra frontale détécté !');
                                            }
                                        }else if($(this).val()==2){
                                            if(cameras[1]!=""){
                                                scanner.start(cameras[1]);
                                            }else{
                                                alert("Pas de caméra detecté!");
                                            }
                                        }
                                    });
                                }else{
                                    console.error("Aucune caméra detecté.");
                                    alert("Aucune caméra detecté.");
                                }
                            }).catch(function(e){
                                console.error('Erreur: ' + e);
                                alert('Erreur: ' + e);
                            });
                        </script>
                      

                    </div>

                    <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons" style="margin-left: 20%">
                      <label class="btn btn-primary active">
                        <input type="radio" name="options" value="1" autocomplete="off" checked> Caméra frontale
                      </label>
                      <label class="btn btn-secondary">
                        <input type="radio" name="options" value="2" autocomplete="off"> Caméra Arrière
                      </label>
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

</html>

<?php
}else{
        header('location: auth/logout.php');
    }
?>
 

