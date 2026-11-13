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

    $homme = 0;
    $femme = 0;
    $nbrTotal = 0;
    $PourHomme = 0;
    $PourFemme = 0;

    $nbrHetF = stats_sexe($nomCabinet);
    $homme = $nbrHetF[0];
    $femme = $nbrHetF[1];
    $nbrTotal = $homme + $femme;

    if ($nbrTotal != 0) {
        $PourHomme = ($homme * 100) / $nbrTotal;
        $PourFemme = ($femme * 100) / $nbrTotal;
    }
    


    $trancheDage = stats_age_tranche($nomCabinet);

    $mineurs                = $trancheDage[0];
    $dixhuitATrante         = $trancheDage[1];
    $TranteQuarante         = $trancheDage[2];
    $QaranteACinuante       = $trancheDage[3];
    $CinqanteASoixante      = $trancheDage[4];
    $SoixanteASoixanteDix   = $trancheDage[5];
    $PlusDeSoicanteDix      = $trancheDage[6];

    $maxTrancheAge = max($trancheDage);
    $trancheFreqen = "";

    switch ($maxTrancheAge) {
        case $mineurs:
                $trancheFreqen = "Sous 18 ans";
            break;
        case $dixhuitATrante:
                $trancheFreqen = "Entre 18 et 30 ans";
            break;
        case $TranteQuarante:
                $trancheFreqen = "Entre 30 et 40 ans";
            break;
        case $QaranteACinuante:
                $trancheFreqen = "Entre 40 et 50 ans";
            break;
        case $CinqanteASoixante:
                $trancheFreqen = "Entre 50 et 60 ans";
            break;
        case $SoixanteASoixanteDix:
                $trancheFreqen = "Entre 60 et 70 ans";
            break;
        case $PlusDeSoicanteDix:
                $trancheFreqen = "Plus de 70 ans";
            break;    
    }

    $toDay    = date('Y-m-d'); 


    $stat_pathologies = stats_pathologie($nomCabinet);

    $nbrPatho = count($stat_pathologies);

    $lablesPath  = "";
    $dataSetPath = "";

    for ($i=0; $i < $nbrPatho; $i=$i+2) { 
        
        $lablesPath  .= $stat_pathologies[$i]   . ",";
        $dataSetPath .= $stat_pathologies[$i+1] . ",";
    }

    $lablesPath  = substr($lablesPath,  0, -1);
    $dataSetPath = substr($dataSetPath, 0, -1);



    $annulation = [];
    $changement = [];

    $annulationMois  = "";
    $annulationVale  = "";

    $changementMois  = "";
    $changementVale  = "";

    $annulation = stats_annulation($nomCabinet);
    $changement = stats_changement($nomCabinet);

    $nbrAnnul = count($annulation);
    $nbrChang = count($changement);


    for ($i=0; $i < $nbrAnnul; $i=$i+2) { 
        
        $annulationMois .= $annulation[$i]   . ",";
        $annulationVale .= $annulation[$i+1] . ",";
    }

    for ($i=0; $i < $nbrChang; $i=$i+2) { 
        
        $changementMois .= $changement[$i]   . ",";
        $changementVale .= $changement[$i+1] . ",";
    }

    $changementMois = substr($changementMois, 0, -1);
    $changementVale = substr($changementVale, 0, -1);

    $annulationMois = substr($annulationMois, 0, -1);
    $annulationVale = substr($annulationVale, 0, -1);

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

    <link href="assets/js/iCheck/flat/all.css" rel="stylesheet">
    <link href="assets/js/iCheck/line/all.css" rel="stylesheet">

    <link href="assets/js/colorPicker/bootstrap-colorpicker.css" rel="stylesheet">
    <link href="assets/js/switch/bootstrap-switch.css" rel="stylesheet">
    <link href="assets/js/validate/validate.css" rel="stylesheet">
    <link href="assets/js/idealform/css/jquery.idealforms.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="assets/js/tag/jquery.tagsinput.css">

    <link href="assets/js/textEditor/editor.css" rel="stylesheet">
    <link href="assets/js/textEditor/sceditor/minified/themes/square.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/js/textEditor/src/bootstrap-wysihtml5.css" />

    <link rel="shortcut icon" href="assets/ico/minus.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src='assets/js/chart/1.0.2 /Chart.js'></script>

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
                <li><a href="#" title="Sample page 1">Stats</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Statistique du cabinet</a>
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
    
            <br><br>
            <div class="content-wrap">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="nest" id="tableTotalRecetteJournaliere">
                            <div class="title-alt">
                                <h6>
                                    Stats patient par Sexe</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableTotalRecetteJournaliere">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#cam">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="cam">
                                <canvas id="countries" width="600" height="400"></canvas>
                            </div>

                            <div class="body-nest" id="inline">
                                <div class="form_center">
                                    <div class="form-group">
                                        <button class="btn" style="background-color: #A9CBD7"></button>
                                        <?php echo $homme." "?> Hommes
                                    </div>
                                    <div class="form-group">
                                        <button class="btn" style="background-color: #FBCCD1"></button> 
                                        <?php echo $femme." ";?> Femmes
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="nest" id="tableTotalRecetteJournalieres">
                            <div class="title-alt">
                                <h6>
                                    Stats Patients Par Tranche d'age

                                </h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableTotalRecetteJournalieres">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#divTotalRecettes">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="divTotalRecettes">
                                <!-- bar chart canvas element -->
                                <canvas id="income" width="600" height="400"></canvas>
                            </div>
                            <div class="body-nest" id="inline">
                                <div class="form_center">
                                    <div class="form-group">
                                        <?php echo "<b>".$nbrTotal."</b> "?> Patients au total.
                                    </div>

                                    <div class="form-group">
                                        <?php echo "'<b>" . $trancheFreqen. "</b>' "?> est la tranche d'age la plus fréquente.
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- line chart canvas element -->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="nest" id="tableStatPathologies">
                            <div class="title-alt">
                                <h6>
                                    Stats Patients Par Pathologies

                                </h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableStatPathologies">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#divPathol">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="divPathol">
                                <!-- bar chart canvas element -->
                                <canvas id="pathologiesStats" width="600" height="400"></canvas>
                            </div>
                            <div class="body-nest" id="inline">
                                <div class="form_center">
                                    <div class="form-group">
                                        <button class="btn" style="background-color: #48A497"></button> 
                                        Nombre patients par pathologies
                                    </div>
                                    <div class="form-group">
                                        <button style="visibility: hidden"></button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="nest" id="tableStatAnnul">
                            <div class="title-alt">
                                <h6>
                                    Stats Changement et Annulation RDV

                                </h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableStatAnnul">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#divAnnul">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="divAnnul">
                                <!-- bar chart canvas element -->
                                <canvas id="buyers" width="600" height="400"></canvas>
                            </div>
                            <div class="body-nest" id="inline">
                                <div class="form_center">
                                    <div class="form-group">
                                        <button class="btn" style="background-color: #31abb5"></button>
                                        Changement de RDV
                                    </div>
                                    <div class="form-group">
                                        <button class="btn" style="background-color: #ff3030"></button> 
                                        Annulation de RDV
                                    </div>
                                </div>
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

    <script>
      $(document).ready(function(){
        $("#detailsRecettejournaliere").hide();
            $("#showDetails").click(function(){
              $("#detailsRecettejournaliere").show();
            });
      });
    </script>

    <script>
            var annulationMois = "<?php echo $annulationMois;?>";
            var annulationVale = "<?php echo $annulationVale;?>";

            var changementMois = "<?php echo $changementMois;?>";
            var changementVale = "<?php echo $changementVale;?>";

            

            const annulationVal = annulationVale.split(",");
            const changementVal = changementVale.split(",");

            const annulationMoi = annulationMois.split(",");
            const changementMoi = changementMois.split(",");

            console.log(annulationVal);
            console.log(" | ");
            console.log(changementVal);
                        
            // line chart data
            var buyerData = {
                labels : annulationMoi,
                datasets : [
                {  
                    fillColor : "rgba(255, 74, 74,0.4)",
                    strokeColor : "#ff6363",
                    pointColor : "#ff3030",
                    pointStrokeColor : "#ff3030",
                    data : annulationVal
                },
                {  
                    fillColor : "rgba(187, 255, 255,0.6)",
                    strokeColor : "#bbffff",
                    pointColor : "#31abb5",
                    pointStrokeColor : "#31abb5",
                    data : changementVal
                }
            ]
            }
            // get line chart canvas
            var buyers = document.getElementById('buyers').getContext('2d');
            // draw line chart
            new Chart(buyers).Line(buyerData);

            var homme = "<?php echo $homme;?>";
            var femme = "<?php echo $femme;?>";
            var nbrTo = "<?php echo $nbrTotal;?>";
            var PourH = "<?php echo $PourHomme;?>";
            var PourF = "<?php echo $PourFemme;?>";

            var mineurs                 = "<?php echo $mineurs;?>";
            var dixhuitATrante          = "<?php echo $dixhuitATrante;?>";
            var TranteQuarante          = "<?php echo $TranteQuarante;?>";
            var QaranteACinuante        = "<?php echo $QaranteACinuante;?>";
            var CinqanteASoixante       = "<?php echo $CinqanteASoixante;?>";
            var SoixanteASoixanteDix    = "<?php echo $SoixanteASoixanteDix;?>";
            var PlusDeSoicanteDix       = "<?php echo $PlusDeSoicanteDix;?>";

            // pie chart data
            var pieData = [
                {
                    value: PourH,
                    color:"#A9CBD7"
                },
                {
                    value : PourF,
                    color : "#FBCCD1"
                }
            ];
            // pie chart options
            var pieOptions = {
                 segmentShowStroke : true,
                 animateScale : true
            }
            // get pie chart canvas
            var countries= document.getElementById("countries").getContext("2d");
            // draw pie chart
            new Chart(countries).Pie(pieData, pieOptions);
            // bar chart data

            var barData = {
                labels : ["Sous 18 ans","Entre 18 et 30","Entre 30 et 40","Entre 40 et 50","Entre 50 et 60","Entre 60 et 70","Plus de 70 ans"],
                datasets : [
                    {
                        fillColor : "#48A497",
                        strokeColor : "#48A4D1",
                        data : [mineurs,dixhuitATrante,TranteQuarante,QaranteACinuante,CinqanteASoixante,SoixanteASoixanteDix,PlusDeSoicanteDix]
                    }                              
                ]
            }
            // get bar chart canvas
            var income = document.getElementById("income").getContext("2d");
            // draw bar chart
          //delete this 
            new Chart(income).Bar(barData);




            var lablesPath  = '<?php echo $lablesPath;?>';
            var dataSetPath = '<?php echo $dataSetPath;?>';

            const myArr = lablesPath.split(",");
            const myArs = dataSetPath.split(",");

            var patho = {
                labels : myArr,
                datasets : [
                    {
                        fillColor : "#48A497",
                        strokeColor : "#48A4D1",
                        data : myArs
                    }                              
                ]
            }
            // get bar chart canvas
            var pathologies = document.getElementById("pathologiesStats").getContext("2d");
            // draw bar chart
          //delete this 
            new Chart(pathologies).Bar(patho);
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