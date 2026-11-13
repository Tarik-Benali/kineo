<?php
    include("auth/auth.php");
    include("includes/historique.php");
    include("includes/functions.php");
    include("fonctionnalites/affichage/detailsCons.php");

    if (isset($_SESSION['idDeCeCabinet']) && isset($_REQUEST['idConsultation'])) {

    $idCabinet        = $_SESSION['idDeCeCabinet'];

    $nomCabinet       = $_SESSION['nomDeCeCabinet'];

    $adresseCabinet   = $_SESSION['adresseDeCeCabinet'];

    $idMedCab         = $_SESSION['idDeCeMedCab'];

    $idMedecin        = $_SESSION['idDeCeMedecin'];

    $Medecin          = $_SESSION['username'];

    //$date = date('YmdHi');

    //$ansmois  = substr($date, -10);

    $idConsultation   = $_REQUEST['idConsultation']; 
    //-------------------------------------------------------- récupération du motif de consultation ----------------------------------------

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



    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/css/pupop.css">

    <link rel="stylesheet" type="text/css" href="assets/js/progress-bar/number-pb.css">

    <link rel="stylesheet" href="assets/js/timepicker/bootstrap-timepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/datepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/clockface.css">
    <link rel="stylesheet" href="assets/js/datepicker/bootstrap-datetimepicker.css">

    <link rel="stylesheet" type="text/css" href="assets/js/tag/jquery.tagsinput.css">

    <link href="assets/js/textEditor/editor.css" rel="stylesheet">
    <link href="assets/js/textEditor/sceditor/minified/themes/square.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/js/textEditor/src/bootstrap-wysihtml5.css" />

    <link rel="shortcut icon" href="assets/ico/minus.png">

    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>

    <link rel="stylesheet" href="assets/css/profile.css">



    <style type="text/css">
    canvas#canvas4 {
        position: relative;
        top: 20px;
    }
         .hover-link-cons {
            display: inline-block;
            color: #000;
            text-decoration: none;
        }

        .hover-link-cons::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #000;
            transition: width .3s;
        }

        .hover-link-cons:hover::after {
            width: 100%;
            //transition: width .3s;
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

    <?php include("fragmentsPages/barDeNavigation.php"); ?>         


    <!-- /END OF TOP NAVBAR -->

    <!-- SIDE MENU -->
    <!-- SIDE MENU -->

    <?php include("fragmentsPages/menuPrincipal.php"); ?> 
     

    <!-- END OF SIDE MENU -->
    <!-- END OF SIDE MENU -->



    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">

            


            <!-- CONTENT -->
            <!-- BREADCRUMB -->
            <ul id="breadcrumb" style="margin-left: 1%">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Consultation</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Détails Consultation</a>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->
<div class="flex-container" style="display: flex; align-items: stretch;">
  <div style="flex: 1; ">
  
            <!--  DEVICE MANAGER -->

            <div class="content-wrap">
                <div class="row">                       
                    <div class="col-sm-12">
                        <div class="nest" id="headerClose1">
                            <div class="title-alt">
                                <h6>
                                    Infomartion Patient</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#headerClose1">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#header">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>


                            <?php

                            if (isset($_REQUEST['idPatient']) && $_REQUEST['idPatient'] =="") {
                                echo "<h1> Pas d'informations sur ce patient</h1>";
                            }

                            elseif(isset($_REQUEST['idPatient']) && $_REQUEST['idPatient'] !="") {

                                $idPatient = $_REQUEST['idPatient'];
                                getPatientPourHistorCons($idPatient);
                            }

                            elseif (!isset($_REQUEST['idPatient'])) {
                                echo "<h1> Données manquante, Pas de patient selecioné</h1>";
                            }

                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        

            <div class="content-wrap">
                <div class="row">                       
                    <div class="col-sm-12">
                        <div class="nest" id="headerClose2">
                            <div class="title-alt">
                                <h6>
                                    Examens</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#headerClose2">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#header2">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>

                            <div class="body-nest" id="header2">
                                <div class="container">

                                 <?php

                                    if (isset($idConsultation) && $idConsultation !="" && isset($nomCabinet) && $nomCabinet !="") {
                                        
                                        getExamenPourHistorCons($idConsultation, $nomCabinet);
                                    }
                                 ?>  
 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="headerClose3">
                            <div class="title-alt">
                                <h6>
                                    Conclusion et Diagnostic</h6>
                                <Div class="titleClose">
                                    <a class="gone" href="#headerClose3">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#header3">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="header3">                                  

                                    <div id="toolbar" style="display: none;">

                                        <div data-wysihtml5-dialog="insertImage" style="display: none;">
                                            <label>
                                                Image:
                                                <input data-wysihtml5-dialog-field="src" value="http://">
                                            </label>
                                            <label>
                                                Align:
                                                <select data-wysihtml5-dialog-field="className">
                                                    <option value="">default</option>
                                                    <option value="wysiwyg-float-left">left</option>
                                                    <option value="wysiwyg-float-right">right</option>
                                                </select>
                                            </label>
                                            <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
                                        </div>

                                    </div>

                                    <?php

                                        if (isset($idConsultation) && $idConsultation !="" && isset($nomCabinet) && $nomCabinet !="") {
                                            
                                            getConslusionPourHistorCons($idConsultation, $nomCabinet);
                                        }
                                    ?>

                                    <br>

                            </div>
                        </div>
                    </div>

                            <!-- Début de Popup de clôture -->

                            <!-- End of Popup -->
                </div>
            </div>

        </div>  
</div>                            
                        



            <!-- Je me rappele pas 3leh zedt hed la ligne ! c'est grave !!!  -->
            <!-- div id="espacePourInfoPatient"><?php //include("fonctionnalites/affichage/afficherUnPatient.php"); ?></div -->

                   <?php include("fragmentsPages/footer.php"); ?>   

        </div>
    </div>

    <!--  END OF PAPER WRAP -->
        <?php include("fragmentsPages/menuSecondaire.php"); ?>
    <!-- RIGHT SLIDER CONTENT -->
  


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
header('location: choixCabinet.php');
}

?>