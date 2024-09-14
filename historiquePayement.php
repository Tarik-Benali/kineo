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

    $patient  = $_GET['idPatient']; 

            $dateJour = date('d/m/Y');
            $nomPatient = getPatientPrenomLocal($nomCabinet,$patient);
            $prePatient = getPatientNomLocal($nomCabinet,$patient);
            $agePatient = getPatientAgeLocal($nomCabinet,$patient);    

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



<!-------------------------------------------------------------- Historique Payements--------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableTotalRecetteJournalier">
                            <div class="title-alt">
                                <h6>
                                    Historique des paiements</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableTotalRecetteJournalier">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#divTotalRecett">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="divRecetteParDat">

                                <div class="form-inline">

                                  <label style="margin-right: 5px;" for="de">De:</label>
                                  <input style="margin-right: 15px;" type="date" id="de" class="form-control" name="dateDe" required>

                                  <label style="margin-right: 5px;" for="a">à:</label>
                                  <input style="margin-right: 15px;" type="date" id="a" class="form-control" name="dateA" required>

                                  <button type="button" class="btn btn-info" id="rechercheParDate">Executer</button>
                                </div>

                                    <div class="pull-right" style="margin-bottom: 10px;">
                                        <button id="printBtn" class="btn btn-primary" onclick="PrintElem()">
                                            <span class="entypo-print"></span>&nbsp;&nbsp;Imprimer&nbsp;&nbsp;</button>
                                    </div>

                                <br><br>
                                <div id="espace_impression_prgm">
                                    <section id="flip-scroll">

                                        <table border="1" class="table table-bordered table-striped cf" style="border-collapse: collapse; width: 100%;" id="programPat">
                                            <thead class="cf">
                                                <tr>
                                                    <th>Date consultation</th>
                                                    <th>Heure</th>
                                                    <th>Patient</th>
                                                    <th>Praticien</th>
                                                    <th>Paiement</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tableBody">
                                                <?php getAllPayement($nomCabinet,$patient); ?>
                                            </tbody>
                                        </table>
                                    </section>
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

              $('#rechercheParDate').click(function(){  
                   $('#tableBody').html('');

                   var MonCab  = "<?php echo $nomCabinet;?>";
                   var dateDe  = document.getElementById("de").value;
                   var dateA   = document.getElementById("a").value;
                   var patient = "<?php echo $patient;?>";

                   if (dateDe =="" || dateA =="") {
                    alert("Vueillez d'abord séléctioner la date début et fin filtre !");
                   }

                   if (MonCab != "" && dateDe != "" && dateA != "" && patient != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/getHistoriquePaiements.php",  
                          type:"GET",  
                          data:{DateDe:dateDe,DateA:dateA,Patient:patient,nomCabinet: encodeURIComponent(MonCab)},
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#tableBody').append(data);
                                console.log(data);
                               } else{
                                document.getElementById('tableBody').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Pas d'historique de paiement enregistré pour ce patient/periode'</div>"
                               }
                          }  
                      });
                     }    
                }); 
              });


        function PrintElem(){

                var nomCabinet  = "<?php echo $nomCabinet;?>";
                var nomPatient  = "<?php echo $nomPatient;?>";
                var agePatient  = "<?php echo $agePatient;?>";
                var prePatient  = "<?php echo $prePatient;?>";
                var dateDuJour  = "<?php echo $dateJour;?>";
                var adresseCab  = "Bd Millénium, Arcade Ecobat Bloc I 1er étage | (Bir el Djir) - ORAN <br> TEL: 0554 938 566.  Email: nabilbouabdallah.nba@gmail.com";
                var programmeP  = document.getElementById("espace_impression_prgm").innerHTML;

                //var nomMedecinFR  = "<?php //echo $nomMedecin;?>";
                var nomMedecinFR  = "BOU-ABDALLAH MOHAMMED NABIL";
                //var specialiteFR  = "Spécialiste de la kinésithérapie thérapeutiques";
                var specialiteFR  = "Kinésithérapeute";

                var nomMedecinAR  = "بوعبدالله محمد نبيل";
                var specialiteAR  = "علاج فيزيائي وظيفي";

                var mywindow = window.open('', 'PRINT', 'height=900,width=1200');

                mywindow.document.write('<html><head><title>' + document.title  + '</title>');
                mywindow.document.write('</head><body>');

                //Titre
                mywindow.document.write("<div style=\"display: flex;flex-direction: column;height: 800px;\"><div style=\"text-align: center;margin: 5px; flex-grow: 0.1;\"><h4>"+nomCabinet+"</h4></div>");

                //Infos cabinet / Doc
                mywindow.document.write("<div style=\"margin:5px; flex-grow:0.6;display:flex;flex-direction: row;\"><div style=\"margin: 1px; padding: 2px; flex-grow: 1;\">"+nomMedecinFR+"<br>"+specialiteFR+"<br></div><div style=\"margin: 1px; padding: 2px; flex-grow: 1;text-align: right;\">"+nomMedecinAR+"<br>"+specialiteAR+"<br></div></div>");

                //Infos Patient / consultation
                mywindow.document.write("<div style=\"margin:5px; flex-grow:0.4;display:flex;flex-direction: row;\"><div style=\"margin: 1px; padding: 2px; flex-grow: 1;\">Nom: "+nomPatient+".<br>Prénom: "+prePatient+".<br>Age: "+agePatient+" ans.</div><div style=\"margin: 1px; padding: 2px; flex-grow: 1;text-align: right;\">Oran, le: " +dateDuJour+"</div></div>");

                //Type document (Ordonnance, Bilan...)
                mywindow.document.write("<div style=\"text-align: center;margin-top: 5px; padding: 2px; flex-grow: 0.1;\"><h5>PROGRAMME THÉRAPEUTIQUE À SUIVRE</h5></div>");

                //Programme / corps + Footer
                mywindow.document.write("<div style=\"margin: 5px; padding: 2px; flex-grow: 6;text-align: center;\">"+programmeP+"<div style=\"width:100%;position:absolute;bottom:0;left:0;padding-right:10px;padding-bottom:5px;padding-left:10px;\"><hr>"+adresseCab+"</div></div>");
                //Footer
                //mywindow.document.write("<div style=\"margin: 5px; flex-grow: 0.3;\"><hr>"+adresseCab+"</div></div>");
                mywindow.document.write('</body></html>');



                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10*/

                mywindow.print();
                mywindow.close();

                return true;
            } 
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