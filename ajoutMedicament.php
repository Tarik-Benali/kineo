<?php
    include("auth/auth.php");
    include("includes/functions.php");

    if (isset($_SESSION['idDeCeCabinet'])) {

                                              
    $idCabinet        = $_SESSION['idDeCeCabinet'];

    $nomCabinet       = $_SESSION['nomDeCeCabinet'];

    $adresseCabinet   = $_SESSION['adresseDeCeCabinet'];

    $idMedCab         = $_SESSION['idDeCeMedCab'];

    $idMedecin        = $_SESSION['idDeCeMedecin'];

    $faiseur = $idMedecin;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Virtuhos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/js/timepicker/bootstrap-timepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/datepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/clockface.css">
    <link rel="stylesheet" href="assets/js/datepicker/bootstrap-datetimepicker.css">

    <link rel="stylesheet" type="text/css" href="assets/js/tag/jquery.tagsinput.css">



    <link rel="stylesheet" href="assets/css/mail.css">




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

    <?php include("fragmentsPages/barDeNavigation.php"); ?> 



    <!-- SIDE MENU -->
    <!-- SIDE MENU -->

    <?php include("fragmentsPages/menuPrincipal.php"); ?>

    <!-- END OF SIDE MENU -->
    <!-- END OF SIDE MENU -->



    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">

 <!------------------------------------------------------ Titre de Page --------------------------------------------------------------------------------->



            <!-- CONTENT -->
            <!--TITLE -->
            <div class="row">
                <div id="paper-top">
                    <div class="col-sm-3">
                        <h2 class="tittle-content-header">
                            <span class="entypo-menu"></span>
                            <span><?php if(isset($idMedecin)) {echo "Dr, ";} echo $_SESSION['username'] ; ?>&nbsp;!
                            </span>
                        </h2>

                    </div>

                    <div class="col-sm-7">
                        <div class="devider-vertical visible-lg"></div>
                        <div class="tittle-middle-header">

                            <div class="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <span class="tittle-alert entypo-info-circled"></span>
                                 <?php 
                                        //$res= getInformation($_SESSION['idUser'],$_SESSION['typeCompte']); ?>
                                                      
                                Bienvenue Dr,&nbsp;
                                <strong><?php echo $_SESSION['username'] ;  ?>&nbsp;!</strong>&nbsp;&nbsp;On vous souhaite une bonne journée.
                            </div>


                        </div>

                    </div>

                </div>
            </div>
            <!--/ TITLE -->

            <!-- BREADCRUMB -->
            <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Médicament</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Ajout de médicaments</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->

            <!-- END OF BREADCRUMB -->
                        

            <!-- SIDEMENU MAIL -->
            <div class="col-sm-12">
                <div class="nest" id="ajoutmidoc">
                            <div class="title-alt">
                                <h6>
                                    Ajouter un nouveau médicament.</h6>
                                    <div class="titleClose">
                                    <a class="gone" href="#ajoutmidoc">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#addmidicament">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div> 
                            <div class="body-nest" id="addmidicament">
                                <div class="form_center">
                                    <form action="fonctionnalites/ajout/ajoutMedicament.php" class="form-horizontal" method="post">
                                        <fieldset>

                                            <div class="alert alert-warning">
                                                <button data-dismiss="alert" class="close" type="button">×</button>
                                                <span class="entypo-cancel-circled"></span>
                                                <strong>Avertissement!</strong>&nbsp;&nbsp;Assurez-vous d'abord que le médicament que vous voulez ajouter n'existe pas dans notre base de données.
                                            </div>


                                            <div class="control-group">
                                                <label class="control-label" for="nameMedicament">Nom Médicament</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="nameMedicament" id="nameMedicament" required>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="typeMedicament">Type Médicament</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="typeMedicament" id="typeMedicament" required>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="dosageMedicament">Dosage Médicament</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="dosageMedicament" id="dosageMedicament" required>
                                                </div>
                                            </div>

                                            <div class="control-group">
                                                <label class="control-label" for="codeMedicament">Code Médicament</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="codeMedicament" id="codeMedicament" required>
                                                </div>
                                            </div>

                                            <input type="hidden" class="form-control" name="faiseur" id="faiseur" value="<?php echo $faiseur;?>">
                                            <input type="hidden" class="form-control" name="cabinet" id="faiseur" value="<?php echo $nomCabinet;?>">


                                            <div class="form-actions" style="margin:20px 0 0 0;">
                                                <button type="submit" class="btn btn-primary">Ajouter</button>
                                                <button type="reset" class="btn">Annuler</button>
                                            </div>
                                        </fieldset>
                                    </form>

                             </div>
                    </div>        

                    <!-- /CONTENT MAIL -->
                </div>
            </div>


            <!-- /END OF CONTENT -->



            <!-- FOOTER -->
       
            <?php include("fragmentsPages/footer.php"); ?>

            <!-- / END OF FOOTER -->


        </div>
    </div>
    <!--  END OF PAPER WRAP -->

    <!-- RIGHT SLIDER CONTENT -->

    <?php include("fragmentsPages/menuSecondaire.php"); ?>



    <!-- END OF RIGHT SLIDER CONTENT-->

    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="assets/js/preloader.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/load.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

    <script type="text/javascript" src="assets/js/colorPicker/bootstrap-colorpicker.min.js"></script>
    <script type="text/javascript" src="assets/js/inputMask/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="assets/js/switch/bootstrap-switch.js"></script>
    <script type="text/javascript" src="assets/js/validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="assets/js/idealform/jquery.idealforms.js"></script>

    <script type="text/javascript" src="assets/js/timepicker/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/clockface.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/bootstrap-datetimepicker.js"></script>


    <script type="text/javascript" src="assets/js/tag/jquery.tagsinput.js"></script>

<script type="text/javascript">
    $('#datetimepicker1').datetimepicker({
        language: 'pt-BR'
    });
    $('#dp1').datepicker()
    $('#dpYears').datepicker();
    $('#timepicker1').timepicker();
    $('#t1').clockface();
    $('#t2').clockface({
        format: 'HH:mm',
        trigger: 'manual'
    });

    $('#toggle-btn').click(function(e) {
        e.stopPropagation();
        $('#t2').clockface('toggle');
    });
    </script>




</body>

</html>
<?php
}
else
{
header('location: ../../auth/logout.php');
}

?>
