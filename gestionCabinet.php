<?php
    include("auth/auth.php");
    include("includes/historique.php");
    include("includes/functions.php");
    include("fonctionnalites/affichage/examensAvecLeursPrix.php");
    include("fonctionnalites/affichage/consultationAvecLeursPrix.php");

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
                <li><a href="#" title="Sample page 1">Gestion Des Prix</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul>
            <!-- END OF BREADCRUMB -->
            <!--  DEVICE MANAGER -->

<!-------------------------------------------------------------- Prix Séance ----------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tablePrixSeance">
                            <div class="title-alt">
                                <h6>
                                    Gestion Prix Séance</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tablePrixSeance">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#PrixSeance">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="PrixSeance">

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Séance</th>
                                                <th>Prix</th>
                                                <th class="numeric">Option</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php 

                                                    if ($typeProfil == "medecin") {
                                                         consultationsAvecLeursPrix($nomCabinet,$idMedecin, $idCabinet);
                                                     }
                                                     else if ($typeProfil == "staff") {
                                                        consultationsAvecLeursPrix($nomCabinet,$idStaff, $idCabinet);
                                                     } 

                                            ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 


<!-------------------------------------------------------------- Jours Ouvrables--------------------------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableOuvrables">
                            <div class="title-alt">
                                <h6>
                                    Gestion Jours Ouvrables</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableOuvrables">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#Ouvrables">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="Ouvrables">

                                <form id="saveJourOuvrable" method="POST" action="fonctionnalites/mod/modJoursOuvrables.php">

                                <input type="hidden" name="nomCabinet" value="<?php echo $nomCabinet;?>">
                                <input type="hidden" name="idFaiseur" value="<?php echo $faiseur;?>">

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Jour</th>
                                                <th class="numeric">Option</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                                
                                            <?php getOuvrablesJours($nomCabinet);?>
                                    
                                        </tbody>
                                    </table>

                                    <div class="body-nest" style="margin-top: -10px;margin-bottom: 10px;">
                                        <div class="pull-right">
                                           <button id="printBtn" class="btn btn-info" onclick="saveJoursOuvrables()">
                                            <span class="entypo-check"></span>&nbsp;&nbsp;Enregistrer&nbsp;&nbsp;</button>
                                        </div>
                                        
                                    </div>
                                </section>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

<!-------------------------------------------------------------- Durée D une Séances ----------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableDuree">
                            <div class="title-alt">
                                <h6>
                                    Gestion Temps/Durée Des Séances</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableDuree">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#Duree">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="Duree">

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Séance</th>
                                                <th>Durée (mn)</th>
                                                <th class="numeric">Option</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php 

                                                    if ($typeProfil == "medecin") {
                                                        dureeDesSeances($nomCabinet,$idMedecin);
                                                     }
                                                     else if ($typeProfil == "staff") {
                                                        dureeDesSeances($nomCabinet,$idStaff);
                                                     } 

                                            ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

<!-------------------------------------------------------------- Durée Entre Les Séances ----------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableDuree">
                            <div class="title-alt">
                                <h6>
                                    Gestion Temps Entre Les Séances</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableDuree">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#Duree">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="Duree">

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Séance</th>
                                                <th>Temps (mn)</th>
                                                <th class="numeric">Option</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php 

                                                    if ($typeProfil == "medecin") {
                                                         dureeEntreLesSeances($nomCabinet,$idMedecin);
                                                     }
                                                     else if ($typeProfil == "staff") {
                                                        dureeEntreLesSeances($nomCabinet,$idStaff);
                                                     } 

                                            ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>             


<!-------------------------------------------------------------- Nombre Patient par séance ----------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableNbrPatParSean">
                            <div class="title-alt">
                                <h6>
                                    Gestion Du nombre de patients par séance</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableNbrPatParSean">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#nbrPatParSean">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="nbrPatParSean">

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Séance</th>
                                                <th>Nombre patients</th>
                                                <th>Option</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                if ($typeProfil == "medecin") {
                                                    nombrePatientParSeance($nomCabinet,$idMedecin);
                                                }
                                                else if ($typeProfil == "staff") {
                                                    nombrePatientParSeance($nomCabinet,$idStaff);
                                                } 
                                            ?>
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<!-------------------------------------------------------------- Ouveture et fermeture cabinet ----------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableOuveture">
                            <div class="title-alt">
                                <h6>
                                    Gestion Temps D'Ouverture Et Fermeture Cabinet</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableOuveture">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#Ouveture">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="Ouveture">

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Nom Cabinet</th>
                                                <th>Ouverture</th>
                                                <th>Fermeture</th>
                                                <th class="numeric">Option</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php 

                                                    if ($typeProfil == "medecin") {
                                                        ouvertureFermetureCabinet($nomCabinet,$idMedecin);
                                                     }
                                                     else if ($typeProfil == "staff") {
                                                        ouvertureFermetureCabinet($nomCabinet,$idStaff);
                                                     } 

                                            ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

<!-------------------------------------------------------------- Pourcentage gains du praticien ----------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableOuveture">
                            <div class="title-alt">
                                <h6>
                                    Gestion Recette praticien</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableOuveture">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#Ouveture">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="Ouveture">

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Nom Praticien</th>
                                                <th>Prénom</th>
                                                <th>Pourcentage</th>
                                                <th class="numeric">Option</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php 

                                                    if ($typeProfil == "medecin") {
                                                        getionPourcentageRecettePraticien($nomCabinet,$idMedecin);
                                                     }
                                                     else if ($typeProfil == "staff") {
                                                        getionPourcentageRecettePraticien($nomCabinet,$idStaff);
                                                     } 

                                            ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 


<!-------------------------------------------------------------- suppression praticiens ----------------------------------------------------->
            <?php if ($idMedecin == "1") { ?>
            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableOuveture">
                            <div class="title-alt">
                                <h6>
                                    Suppression praticiens</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableOuveture">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#Ouveture">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="Ouveture">

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Nom Praticien</th>
                                                <th>Prénom</th>
                                                <th class="numeric">Option</th> 
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php 
                                                if ($typeProfil == "medecin") {
                                                    suppressionPraticien($nomCabinet,$idMedecin);
                                                }
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!-------------------------------------------------------------- suppression praticiens ----------------------------------------------------->
 
            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableOuvetureb">
                            <div class="title-alt">
                                <h6>
                                    Backup Database</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableOuvetureb">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#Ouvetureb">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="Ouvetureb">

                             <h4>Cette opération vous permet de créer une sauvegarde externe et garder un double de vous données pour faire une récupération en cas d'endomagment du disque ou perte de données inatendue.<h4>

                                <br><br>

                                <div style="display: flex;justify-content: center;align-items: center;">
                                    <a href="backup/database-backup.php" style="color:inherit;">
                                        <button class="btn btn-info">
                                                <span class="entypo-download"></span>&nbsp;&nbsp;Effectuer L'Opération&nbsp;&nbsp;</button>
                                    </a>            
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>            

            <?php } ?>                                                               


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
         function saveJoursOuvrables(){
            /*var idPatient  = "";
            var nomPatient = "";
            idPatient  = document.getElementById("idPatien").value;
            nomPatient = document.getElementById("mailPhonePatient").value;
            if (idPatient == "" || nomPatient == "") {
                alert("Veuillez d'abord sélectionner un patient !");
            }else{*/
                document.getElementById("saveJourOuvrable").submit();
            //}
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