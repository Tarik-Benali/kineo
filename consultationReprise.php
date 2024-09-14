<?php
    include("auth/auth.php");
    include("includes/functions.php");
    include("includes/historique.php");
    include("fonctionnalites/affichage/infoConclusionPourConsSus.php");
    include("fonctionnalites/affichage/infoExamenPourModification.php");
    include("fonctionnalites/affichage/infoPatientPourConsultation.php");

    if (isset($_SESSION['idDeCeCabinet'])) {

    $idCabinet        = $_SESSION['idDeCeCabinet'];

    $nomCabinet       = $_SESSION['nomDeCeCabinet'];

    $adresseCabinet   = $_SESSION['adresseDeCeCabinet'];

    $idMedCab         = $_SESSION['idDeCeMedCab'];

    $idMedecin        = $_SESSION['idDeCeMedecin'];

    $Medecin          = $_SESSION['username'];

    if (isset($_GET['idConsultation'])) {
        $idConsultation = $_GET['idConsultation'];
    }


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
            <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Consultation</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Nouvelle Consultation</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->

              
            <!--  DEVICE MANAGER -->

            <div class="content-wrap">
                <div class="row">                       
                    <div class="col-sm-12">
                        <div class="nest" id="headerClose">
                            <div class="title-alt">
                                <h6>
                                    Infomartion Patient</h6>
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
                                           <div class="table-responsive">  
                                                    <div class="form_center">
                                                        <div class="control-group">
                                                            <label class="control-label" for="nom">Information du Patient:</label>
                                                            <br>
                                                            <div class="controls">

                                                                <?php  affichageDetailsPatient($nomCabinet, $idConsultation); ?>     
                                                                
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                          </div>           
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       

            <div class="content-wrap">
                <div class="row">                       
                    <div class="col-sm-12">
                        <div class="nest" id="headerClose">
                            <div class="title-alt">
                                <h6>
                                    Examens</h6>
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
                                             
                                                <div class="table-responsive">    
                                                    <input id="medecin" name="medecin" type="hidden" value="<?php echo $Medecin; ?>" />
                                                    <input id="idMedecin" name="idMedecin" type="hidden" value="<?php echo $idMedecin; ?>" />
                                                    
                                                    <?php examensDeCetteConsultation($nomCabinet, $idConsultation); ?>
                                                    
                                                </div>  

                                        </div>  
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-wrap">
                <div class="row">
                <form action="fonctionnalites/mod/updatConclusion.php" name="updatExamOnSuspendedCons" id="updatExamOnSuspendedCons" method="POST">
                    <div class="col-sm-12">
                        <div class="nest" id="headerClose">
                            <div class="title-alt">
                                <h6>
                                    Conclusion Diagnistique</h6>
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

                                    <input type="hidden" name="idConsultation" value="<?php echo $idConsultation; ?>">

                                    <input type="hidden" name="nomCabinet" value="<?php echo $nomCabinet; ?>">                                  

                                    <div id="toolbar" style="display: none;">

                                        <div data-wysihtml5-dialog="createLink" style="display: none;">
                                            <label>
                                                Link:
                                                <input data-wysihtml5-dialog-field="href" value="http://">
                                            </label>
                                            <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
                                        </div>

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
                                    <textarea style="width:100%;height:300px" id="conclusion" name="conclusion"><?php conclusionPourConsulSusp($nomCabinet, $idConsultation); ?></textarea>
                                    <br>

                                    <a><button type="submit" class="btn btn-success" value="Reset form!">
                                        <span class="entypo-upload"></span>&nbsp;&nbsp;Enregitrer Modification</button></a>


                                      <a href="<?php echo "fonctionnalites/cloturConsSus/cloturerConsSus.php?nomCabinet=".$nomCabinet."&idConsultation=".$idConsultation."" ?>"><input type="button" name="cloture" class="btn btn-primary pull-right" style="margin-right: 10px;" value="Cloturer la consultation"/><a>

                                <div class="form-actions" style="margin:20px 0 0 0;">                                  
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </From>
                </div>
            </div>


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
header('location: login.php');
}

?>

