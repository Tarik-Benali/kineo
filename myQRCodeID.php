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
    <script src="assets/qrcode/qrcode.min.js"></script>

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
                              <label>QRCode Générateur</label>
                              <p>Identifiant:  <?php echo " ".$identifiant?></p>
                        </div>

                        <hr>
                        
                        <div id="qrcode" class="col-md-offset-4" style="margin-left: 8%"></div>
                
                        <hr>

                        
                        <button class="btn btn-primary" style="margin-left: 20%" onclick="generateQR()" checked>Généré mon QR Code.</button>

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

    <script>

		var qrcode = new QRCode(document.getElementById('qrcode'));

		function generateQR(){
			var data = "<?php echo $identifiant;?>";

			qrcode.makeCode(data);
		}
		
	</script>

</body>

</html>

<?php
}else{
		header('location: auth/logout.php');
}
?>





