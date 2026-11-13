<?php
    include("auth/auth.php");
    include("includes/functions.php");
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Mon Cabinet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->



    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="assets/js/progress-bar/number-pb.css">



    <style type="text/css">
}

    </style>




    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/minus.png">
</head>

<?php include("fragmentsPages/bodyTheme.php"); ?>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- TOP NAVBAR -->

    <?php include("fragmentsPages/barDeNavigation.php");?>


    <!-- /END OF TOP NAVBAR -->
    
    
    <!-- SIDE MENU -->

    <?php include("fragmentsPages/menuPrincipal.php");?>

    <!-- END OF SIDE MENU -->

    




    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">





            <!-- CONTENT -->
            <!--TITLE -->

            <?php include("fragmentsPages/entet.php");?>


            <!-- END OF BREADCRUMB -->



            <div class="content-wrap">
                <div class="row">                       
                    <div class="col-sm-12">
                        <div class="nest" id="headerClose">
                            <div class="title-alt">
                                <h6>
                                    Changer Enête d'Ordonnance</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#headerClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#header">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>

                            <div class="body-nest" id="header">
                                <div class="container">   
                                        <div class="form-group">  
                                            <img src="test.png">
                                            <br>
                                            <form action="insertionEntete.php" method="post" enctype="multipart/form-data">
                                                    Selectioner une image d'entête:
                                                  <input type="file" name="file">
                                                  <input type="submit" name="submit" value="Upload">
                                            </form>

                                        </div>  
                                    </div>
                            </div>
                            <?php
                                  // Include the database configuration file
                                  if (isset($_SESSION['idDeCeCabinet'])) {

                                        $nomCabinet       = $_SESSION['nomDeCeCabinet'];

                                        
                                    $dbHost     = "localhost";
                                    $dbUsername = "root";
                                    $dbPassword = "";
                                    $dbName     = crypterNomDeLaBase($nomCabinet);
                                    // Create database connection
                                    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
                                    // Check connection
                                    if ($db->connect_error) {
                                        die("Connection failed: " . $db->connect_error);
                                    }
                                }

                                  // Get images from the database
                                  $query = $db->query("SELECT nom FROM enteteOrd ORDER BY dateDajout DESC");
                                  if($query->num_rows > 0){
                                      while($row = $query->fetch_assoc()){
                                          $imageURL = 'uploads/'.$row["file_name"];
                                  ?>
                                      <img src="<?= $imageURL; ?>" />
                                  <?php }} ?>
                        </div>
                    </div>
                </div>
            </div>



        


                <!-- /END OF CONTENT -->



                <!-- FOOTER -->

        <?php include("fragmentsPages/footer.php");?>

                <!-- / END OF FOOTER -->


            </div>
        </div>
    </div>
    <!--  END OF PAPER WRAP -->

    <!-- RIGHT SLIDER CONTENT -->

    <?php include("fragmentsPages/menuSecondaire.php");?>

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




    <!-- GAGE -->





</body>


</html>