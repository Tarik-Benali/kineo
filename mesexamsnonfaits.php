<?php
    include("auth/auth.php");
    include("includes/historique.php");
    include("includes/functions.php");

    include("fonctionnalites/affichage/infoExamenPourConsultation.php"); 

    if (isset($_SESSION['identifiant']) && $_SESSION['typeCompte']== 1) {

    $idPatient        = $_SESSION['identifiant'];

    if ($_REQUEST["idP"]) {

        $idPatient = $_GET["idP"];
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
    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">


    <link href="assets/js/footable/css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable.standalone.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable-demos.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="assets/js/dataTable/lib/jquery.dataTables/css/DT_bootstrap.css" />
    <link rel="stylesheet" href="assets/js/dataTable/css/datatables.responsive.css" />


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/minus.png">
</head>

<?php include("fragmentsPages/fragmentsPatient/bodyTheme.php"); ?>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- TOP NAVBAR -->
    <!-- TOP NAVBAR -->


    <?php include("fragmentsPages/fragmentsPatient/barDeNavigation.php"); ?>         

    <!-- /END OF TOP NAVBAR -->

    <!-- SIDE MENU -->

    <?php include("fragmentsPages/fragmentsPatient/menuPrincipal.php"); ?> 

    <!-- END OF SIDE MENU -->

    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">

            <!-- CONTENT -->
            <!--TITLE -->
                    <!-- Inclusion d'entête ;) -->

                        <?php include("fragmentsPages/fragmentsPatient/entet.php"); ?>         

                    <!-- fin d'inclusion -->
            <!--/ TITLE -->

            <!-- BREADCRUMB -->
            <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Mon dossier</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Examens non faits 'par consultation'</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <!--input style="border-radius:15px" type="text" placeholder="Search..." class="form-control"-->
                    </div>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->

             <?php 

               function getMesExamensNonFaits($nomBD, $idPatient, $nomCabinet){
                        try
                            {
                                                                                                    
                                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                $bdd = new PDO("mysql:host=localhost;dbname=$nomBD","root","", $pdo_options);                          
                                                                            
                                                                            // On recupere tout le contenu de la table news
                                $reponse = $bdd->query("SELECT * FROM relationexamcons,consultations WHERE relationexamcons.idConsultation = consultations.idConsultation AND consultations.idPatient = '$idPatient' AND `resultExam` IS NULL GROUP BY consultations.idConsultation ORDER BY heureConsultation DESC");


                                while ($donnees = $reponse->fetch())
                                    {


                                    $idMedecin          = $donnees['idMedecin'];
                                    $conclusion         = $donnees['conclusion'];
                                    $idConsultation     = $donnees['idConsultation'];
                                    $heureConsultation  = $donnees['heureConsultation'];                     
                                    $idConsultationPopu = $idConsultation . "popu"; 

                                    

                                                                echo "<tr>";

                                                                    echo "<td>$heureConsultation  </td>";
                                                                    echo "<td align=\"center\"><input name=\"afficherDossierP\" style=\"width:35%;\" class=\"btn btn-success \"  value=\"Afficher les examens\" data-toggle=\"modal\" data-target=\"#".$idConsultation ."\"/></td>
        
                                                                </tr>";

                                                                
                                          echo "<div class=\"container\">

                                                  <div class=\"modal fade\"  id=\"".$idConsultation ."\" role=\"dialog\">
                                                    <div class=\"modal-dialog\">
                                                    
                                                      <div class=\"modal-content\">
                                                        <div class=\"modal-header\">
                                                          <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                                                          <h4 class=\"modal-title\">Consultation du &nbsp;&nbsp; $heureConsultation</h4>
                                                        </div>
                                                        <div class=\"modal-body\" style=\"height: 250px; overflow-y: auto;\">

                                                        <form action=\"fonctionnalites\mod\modPrixExam.php\" class=\"form-container\">
                                                            <fieldset>

                                                          <div class=\"form-group\">

                                                          <h4>Liste des examens non faits</h4><br>";

                                                              echo "<ul>";                                    

                                                                afficherLesExmensVide($nomCabinet, $donnees['idConsultation']);

                                                              echo "</ul>";

                                                              echo "</div>
                                                        
                                                          
                                                           <button type=\"button\" class=\"btn btn-default pull-right\" data-dismiss=\"modal\" style=\"margin-right:10px;margin-bottom:10px;\"> Fermer</button>
                                                        
                                                                </div>                                       

                                                            </fieldset>                    
                                                        </form>
                                                      </div>                                                                     
                                                    </div>
                                                  </div>
                                                </div>";                                               
                                    }                    

                                    $reponse->closeCursor();
                                }
                                catch(Exception $e)
                                    {
                                        die('Erreur : '.$e->getMessage());
                                    }
                        } 
            


                     try{   

                                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                $bdd = new PDO("mysql:host=localhost;dbname=baseglobal","root","", $pdo_options);                                                    
                                // On recupere tout le contenu de la table news
                                $reponse = $bdd->query("SELECT `nomCabinet` FROM `cabinet`,`relpatcab` WHERE relpatcab.idPatient='$idPatient' AND relpatcab.idCabinet = cabinet.idCabinet");

                                echo "<div class=\"content-wrap\" id=\"infoPatient\">
                                            <div class=\"row\">

                                                <div class=\"col-sm-12\">

                                                    <div class=\"body-nest\" id=\"tableStatic\">
                                                        <section id=\"flip-scroll\">

                                                            <table class=\"table table-bordered table-striped cf\">
                                                                <thead class=\"cf\">
                                                                    <tr>
                                                                        <th>Date et Heure Consultation</th>
                                                                        <th>Liste des exaemns non faits</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>";

                                while ($donnees = $reponse->fetch())
                                    {

                                      $nomCabinet = $donnees['nomCabinet'];

                                      $nomBD      = crypterNomDeLaBase($nomCabinet);


                                      //$dateDuJour = date('Y-m-d'); 
                                      getMesExamensNonFaits($nomBD, $idPatient, $nomCabinet);        
                                    }

                                    $reponse->closeCursor();

                                                                echo "</tbody>
                                                            </table>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>";
                        }

                    catch(Exception $e)
                        {
                            die('Erreur : '.$e->getMessage());
                        }

                    


       ?>

            <!-- /END OF CONTENT -->



            <!-- FOOTER -->
       
                   <?php include("fragmentsPages/fragmentsPatient/footer.php"); ?>   


                <!-- / END OF FOOTER -->


        </div>
    </div>

    <!--  END OF PAPER WRAP -->

        <?php include("fragmentsPages/fragmentsPatient/menuSecondaire.php"); ?>

    <!-- END OF RIGHT SLIDER CONTENT-->


    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="assets/js/preloader.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/load.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

    <!-- /MAIN EFFECT -->
    <!-- GAGE -->
    <script type="text/javascript" src="assets/js/toggle_close.js"></script>
    <script src="assets/js/footable/js/footable.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.sort.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.filter.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>





    <script type="text/javascript">
    $(function() {
        $('.footable-res').footable();
    });
    </script>
    <script type="text/javascript">
    $(function() {
        $('#footable-res2').footable().bind('footable_filtering', function(e) {
            var selected = $('.filter-status').find(':selected').text();
            if (selected && selected.length > 0) {
                e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                e.clear = !e.filter;
            }
        });

        $('.clear-filter').click(function(e) {
            e.preventDefault();
            $('.filter-status').val('');
            $('table.demo').trigger('footable_clear_filter');
        });

        $('.filter-status').change(function(e) {
            e.preventDefault();
            $('table.demo').trigger('footable_filter', {
                filter: $('#filter').val()
            });
        });

        $('.filter-api').click(function(e) {
            e.preventDefault();

            //get the footable filter object
            var footableFilter = $('table').data('footable-filter');

            alert('about to filter table by "tech"');
            //filter by 'tech'
            footableFilter.filter('tech');

            //clear the filter
            if (confirm('clear filter now?')) {
                footableFilter.clearFilter();
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
header('location: patient.php');
}

?>
