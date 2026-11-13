<?php
    include("auth/auth.php");

    //if (isset($_SESSION["idCabinet"]) && isset($_SESSION["idDeCeCabinet"]) || ($_SESSION['typeCompte']=='0')) {
    if (isset($_SESSION['typeCompte']) && $_SESSION['typeCompte']=="0") {

    $typeCompte       = $_SESSION['typeCompte'];

    //$nomCabinet      = $_SESSION['nomDeCeCabinet'];

    //$adresseCabinet  = $_SESSION['adresseDeCeCabinet'];

    //$idMedCab        = $_SESSION['idDeCeMedCab'];

    //$idMedecin       = $_SESSION['idDeCeMedecin'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Super Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->



    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="assets/js/progress-bar/number-pb.css">



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
    <!-- TOP NAVBAR -->

        <!-- Inclusion d'entête ;) -->

            <?php include("fragmentsPages/fragmentsSuperAdmin/barDeNavigation.php"); ?>         

        <!-- fin d'inclusion -->    

    <!-- /END OF TOP NAVBAR -->

    <!-- SIDE MENU -->

        <!-- Inclusion Du Menu Principal ;) -->

            <?php include("fragmentsPages/menuPrincipal.php"); ?>         

        <!-- fin d'inclusion -->

    <!-- END OF SIDE MENU -->



    <!--  PAPER WRAP -->

        <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">


            <!-- CONTENT -->
            <!--TITLE -->

                    <!-- Inclusion d'entête ;) -->

                        <?php include("fragmentsPages/entet.php"); ?>         

                    <!-- fin d'inclusion --> 

            <!--/ TITLE -->


            <!-- BREADCRUMB -->
            <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Home</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Dashboard  

                    <?php // ***********************   echo uniqid(); echo hash("sha256","Tarik" ); ************************  ?></a> 

                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->



            <!--  DEVICE MANAGER -->

            <!--  / DEVICE MANAGER -->


            <div class="content-wrap">
                                 
                    
                <!-- /END OF CONTENT -->



                <!-- FOOTER -->

                    <!-- Inclusion du Footer ;) -->

                        <?php include("fragmentsPages/footer.php"); ?>         

                    <!-- fin d'inclusion --> 

                <!-- / END OF FOOTER -->


            </div>
        </div>
    </div>


    <!--  END OF PAPER WRAP -->


    <!-- RIGHT SLIDER CONTENT -->

        <!-- Inclusion Du Menu Secondaire ;) -->

            <?php include("fragmentsPages/menuSecondaire.php"); ?>         

        <!-- fin d'inclusion -->

    <!-- END OF RIGHT SLIDER CONTENT-->


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


</body>

</html>

<?php
}
else
{
header('location: login.php');
}

?>
