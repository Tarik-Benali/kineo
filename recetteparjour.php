<?php
    include("auth/auth.php");
    //include("includes/historique.php");
    include("includes/functions.php");
    //include("fonctionnalites/affichage/examensAvecLeursPrix.php");
    //include("fonctionnalites/affichage/consultationAvecLeursPrix.php");

    if (isset($_SESSION['idDeCeCabinet']) || (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5")) {

    $typeProfil ="";
    $faiseur    ="";

        if (isset($_SESSION['idDeCeCabinet']) && $_SESSION['typeCompte'] =="2") {
                                              
            $idCabinet        = $_SESSION['idDeCeCabinet'];

            $nomCabinet       = $_SESSION['nomDeCeCabinet'];

            $adresseCabinet   = $_SESSION['adresseDeCeCabinet'];

            $idMedCab         = $_SESSION['idDeCeMedCab'];

            $idMedecin        = $_SESSION['idDeCeMedecin'];

            $Medecin          = $_SESSION['username'];

            $typeProfil  = "medecin";
            $faiseur     = $idMedecin;


        }elseif (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5") {
               
            $idCabinet        = $_SESSION['idCabinet'];

            $nomCabinet       = $_SESSION['nomCabinet'];

            $idStaff          = $_SESSION['identifiant'];


            $typeProfil  ="staff";
            $faiseur     = $idStaff;
        }


    $toDay    = date('Y-m-d'); 
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="assets/css/profile.css">


    <style type="text/css">
        canvas#canvas4 {
            position: relative;
            top: 20px;
        }

        .form-inline {  
          display: flex;
          flex-flow: row wrap;
          align-items: center;
        }


        @media (max-width: 800px) {
          .form-inline input {
            margin: 10px 0;
          }
          
          .form-inline {
            flex-direction: column;
            align-items: stretch;
          }
        }
    </style>


    <link rel="shortcut icon" href="assets/ico/minus.png">
</head>

<?php include("fragmentsPages/bodyTheme.php"); ?>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- TOP NAVBAR -->

    <?php 
        if ($typeProfil == "medecin") {
                    include("fragmentsPages/barDeNavigation.php");
                }
        else if ($typeProfil == "staff") {
                    include("fragmentsPages/fragmentsStaff/barDeNavigation.php");
                } 
    ?>



    <!-- /END OF TOP NAVBAR -->

    <!-- SIDE MENU -->
    <!-- SIDE MENU -->

    <?php 

        if ($typeProfil == "medecin") {
                    include("fragmentsPages/menuPrincipal.php");
                }
        else if ($typeProfil == "staff") {
                    
                } 
    ?>
     

    <!-- END OF SIDE MENU -->
    <!-- END OF SIDE MENU -->



    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">

            <br>
            <!-- CONTENT -->
            <!-- BREADCRUMB -->
            <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Tarifs</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Recette du jour</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul>
            <!-- END OF BREADCRUMB -->
            <!--  DEVICE MANAGER -->

<!-------------------------------------------------------------- Recette Du jour --------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableTotalRecetteJournaliere">
                            <div class="title-alt">
                                <h6>
                                    Recette total de la journée</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableTotalRecetteJournaliere">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#divTotalRecette">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="divTotalRecette">

                                <div class="row" style="margin-bottom:10px;">
                                    
                                    <div class="col-sm-4">
                                       <input class="form-control" id="dateRecette" placeholder="Filtre par date" type="date"/> 
                                    </div>

                                    <div class="col-sm-2">
                                    </div>

                                    <div class="col-sm-4">
                                        <a href="#" id="searchDayRecette" style="margin-left:10px;" class="pull-right btn btn-info">Recherche</a>
                                    </div>

                                </div>

                                <section id="flip-scroll">                                    
                                    <?php  
                                        if (isset($_GET['selectedDate']) && $_GET['selectedDate'] != "" && $nomCabinet != "") {
                                            if ($typeProfil == "medecin") {
                                                echo '<div id="detailsArea">';
                                                    detailRecetteParJour($nomCabinet, $_GET['selectedDate']);
                                                echo '</div>';
                                            }
                                        }
                                    ?>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
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


    <script type="text/javascript">
        $(document).ready(function(){

            $('#searchDayRecette').click(function(){  
                $('#detailsArea').html('');

                var selectedDay = $("#dateRecette").val();

                if (selectedDay != ""){
                    const params = new URLSearchParams(window.location.search);
                    params.set("selectedDate", selectedDay);
                    window.location.href = `${window.location.pathname}?${params}`;
                }      
            }); 
        }); 
    </script>


</body>

</html>
<?php
}
else
{
header('location: auth/logout.php');
}

?>