<?php
    include("auth/auth.php");
    include("includes/functions.php");

    if (isset($_SESSION["idCabinet"])) {

            if (isset($_REQUEST["idCabinet"])){

                $_SESSION['idDeCeCabinet']      = $_REQUEST["idCabinet"];                                               
                $idCabinet                      = $_SESSION['idDeCeCabinet'];

                $_SESSION['nomDeCeCabinet']     = $_REQUEST["nomCabinet"];
                $nomCabinet                     = $_SESSION['nomDeCeCabinet'];

                $_SESSION['adresseDeCeCabinet'] = $_REQUEST["adresseCabinet"];
                $adresseCabinet                 = $_SESSION['adresseDeCeCabinet'];

                $_SESSION['idDeCeMedCab']       = $_REQUEST["idMedCab"];
                $idMedCab                       = $_SESSION['idDeCeMedCab'];

                $_SESSION['idDeCeMedecin']      = $_REQUEST["idMedecin"];
                $idMedecin                      = $_SESSION['idDeCeMedecin'];


            }
            elseif (isset($_SESSION['idDeCeCabinet'])) {

                $idCabinet                      = $_SESSION['idDeCeCabinet'];
                $nomCabinet                     = $_SESSION['nomDeCeCabinet'];
                $adresseCabinet                 = $_SESSION['adresseDeCeCabinet'];
                $idMedCab                       = $_SESSION['idDeCeMedCab'];
                $idMedecin                      = $_SESSION['idDeCeMedecin'];

                getTheme($idMedecin);

                $theme = $_SESSION['theme'];

            }

            $idPatient  = $_REQUEST['idPatient'];

            $nomMedecin = getMedecinName($idMedecin);  


            $nomEtPrenomPatient   = getPatientNameEtPrenomFromTableLocal($nomCabinet,$idPatient);


            $dateJour = date('d/m/Y');
            $nomPatient = getPatientPrenomLocal($nomCabinet,$idPatient);
            $prePatient = getPatientNomLocal($nomCabinet,$idPatient);
            $agePatient = getPatientAgeLocal($nomCabinet,$idPatient);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Médecin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->



    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="assets/js/progress-bar/number-pb.css">

    <link href="assets/js/textEditor/editor.css" rel="stylesheet">
    <link href="assets/js/textEditor/sceditor/minified/themes/square.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/profile.css">


    <style type="text/css">
        html {
          scroll-behavior: smooth !important;
        }
	    canvas#canvas4 {
	        position: relative;
	        top: 20px;
	    }
	    .aParent div {
            float: left;
            clear: none; 
        }

        .textarea-container {
            position: relative;
        }
        .textarea-container textarea {
            width: 100%;
            height: 100%;
            box-sizing: border-box;
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

        <!-- Inclusion d'entête ;) -->
            <?php include("fragmentsPages/barDeNavigation.php"); ?>         

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
                <li><a href="#" title="Sample page 1">Impression</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Impression Ordonnance / Justificatif</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul>

<!---------------------------------------------------------------------- !!  ------------------------------------------------------------------------> 

        
            <div class="content-wrap">
                <div class="row">
                    <!-- SIDEMENU MAIL -->
                    <div class="body-nest" id="validation">
                        <div class="form_center" id="espace_impression_prgm">
                                <fieldset>

                                    <div class="control-group">
                                        <label class="control-label" for="justi">Titre document 'Ordonnance / Justificatif'</label>
                                        <div class="controls">
                                            <input type="text" class="form-control" value="Justificatif"  name="justi" id="justi">
                                        </div>
                                    </div><br>

                                    <div class="control-group">
                                        <label class="control-label" for="textJusti">Teste à saisir</label>
                                        <div class="controls" id="texting">
                                            <textarea style="width: 100%; height: 150px;" rows="4" cols="50" name="textJusti" id="textJusti" placeholder="Ecrivez votre texte ici ..."></textarea>

                                        </div>
                                    </div><br>


                                    <div class="form-actions" style="margin:20px 0 0 0;">
                                        <input class="btn btn-info" id="suivant" data-toggle="modal" onclick="PrintElem()" value="Imprimer">
                                        <button type="reset" class="btn" id="btnres">Annuler</button>
                                    </div>
                                </fieldset>

                        </div>
                    </div>        
                    <!-- /CONTENT MAIL -->

                </div>
            </div>





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


    <script src="assets/js/jhere-custom.js"></script>




    <script>
        var nomCabin  = "<?php echo $nomCabinet;?>";
    	var programme = <?php echo $programme;?>;
        var ceMomentH = "<?php echo date('H:i:s');?>";

    </script>

    
    <script> 

        function PrintElem(){

                var nomCabinet  = "<?php echo $nomCabinet;?>";
                var nomPatient  = "<?php echo $nomPatient;?>";
                var agePatient  = "<?php echo $agePatient;?>";
                var prePatient  = "<?php echo $prePatient;?>";
                var dateDuJour  = "<?php echo $dateJour;?>";
                //var adresseCab  = "<?php echo $adresseCabinet;?>";
                var adresseCab  = "Bd Millénium, Arcade Ecobat Bloc I 1er étage | (Bir el Djir) - ORAN <br> TEL: 0554 938 566.  Email: nabilbouabdallah.nba@gmail.com";


                var programmeP  = document.getElementById("textJusti").value;

                //var nomMedecinFR  = "<?php echo $nomMedecin;?>";
                var nomMedecinFR  = "BOU-ABDALLAH MOHAMMED NABIL";
                var TitreDoc      = document.getElementById("justi").value;
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
                mywindow.document.write("<div style=\"text-align: center;margin-top: 5px; padding: 2px; flex-grow: 0.1;\"><h5>"+TitreDoc+"</h5></div>");

                //Programme / corps + Footer
                mywindow.document.write("<div style=\"margin: 5px; padding-left: 20px; flex-grow: 6;\">"+programmeP+"<div style=\"width:100%;position:absolute;bottom:0;left:0;text-align:center;\"><hr>"+adresseCab+"</div></div>");
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
header('location: choixCabinet.php');
}

?>
