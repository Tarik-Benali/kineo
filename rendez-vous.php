<?php
    include("auth/auth.php");
    include("includes/historique.php");
    include("includes/functions.php");

    if (isset($_SESSION['idDeCeCabinet']) || (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5")) {

        $typeProfil ="";

        if (isset($_SESSION['idDeCeCabinet']) && $_SESSION['typeCompte'] =="2") {

            $idCabinet        = $_SESSION['idDeCeCabinet'];

            $nomCabinet       = $_SESSION['nomDeCeCabinet'];

            $adresseCabinet   = $_SESSION['adresseDeCeCabinet'];

            $idMedCab         = $_SESSION['idDeCeMedCab'];

            $idMedecin        = $_SESSION['idDeCeMedecin'];


            $typeProfil  ="medecin";

        }elseif (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5") {
           
            $idCabinet        = $_SESSION['idCabinet'];

            $nomCabinet       = $_SESSION['nomCabinet'];

            $idStaff          = $_SESSION['identifiant'];


            $typeProfil  ="staff";
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

    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>

    <link href="assets/js/footable/css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable.standalone.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable-demos.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="assets/js/dataTable/lib/jquery.dataTables/css/DT_bootstrap.css" />
    <link rel="stylesheet" href="assets/js/dataTable/css/datatables.responsive.css" />






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
    
                    include("fragmentsPages/menuPrincipal.php");
            }
        else if ($typeProfil == "staff") {
                                            
                    include("fragmentsPages/fragmentsStaff/barDeNavigation.php");        
    
                    include("fragmentsPages/fragmentsStaff/menuPrincipal.php");
            } 
    ?>



    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">





            <!-- CONTENT -->
            <!--TITLE -->


            <!--/ TITLE -->

            <!-- BREADCRUMB -->
            <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Home</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Historique des Rendez-Vous</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        
                    </div>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->




            <!--  DEVICE MANAGER -->

                    <div class="content-wrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="nest" id="FilteringClose9">
                                    <div class="title-alt">
                                        <h6>
                                            Tout Les Rendez-Vous</h6>
                                        <div class="titleClose">
                                            <a class="gone" href="#FilteringClose9">
                                                <span class="entypo-cancel"></span>
                                            </a>
                                        </div>
                                        

                                    </div>

                                    <div class="body-nest" id="flt">

                                        <?php
                                            // ---------------- Critères de recherche (GET) ----------------
                                            $criteres = array(
                                                "recherche"  => isset($_GET['recherche'])  ? trim($_GET['recherche'])  : "",
                                                "idPatient"  => isset($_GET['idPatient'])  ? trim($_GET['idPatient'])  : "",
                                                "dateDebut"  => isset($_GET['dateDebut'])  ? trim($_GET['dateDebut'])  : "",
                                                "dateFin"    => isset($_GET['dateFin'])    ? trim($_GET['dateFin'])    : "",
                                                "statut"     => isset($_GET['statut'])     ? trim($_GET['statut'])     : "",
                                                "typeSeance" => isset($_GET['typeSeance']) ? trim($_GET['typeSeance']) : "",
                                                "idMedecin"  => isset($_GET['idMedecin'])  ? trim($_GET['idMedecin'])  : ""
                                            );

                                            if ($criteres['dateDebut'] != "" && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $criteres['dateDebut'])) { $criteres['dateDebut'] = ""; }
                                            if ($criteres['dateFin']   != "" && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $criteres['dateFin']))   { $criteres['dateFin']   = ""; }
                                            if ($criteres['statut']    != "" && !preg_match('/^[0-6]$/', $criteres['statut']))                { $criteres['statut']    = ""; }

                                            $parPage = isset($_GET['parPage']) ? (int) $_GET['parPage'] : 50;
                                            if (!in_array($parPage, array(25, 50, 100))) { $parPage = 50; }

                                            $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;

                                            $resultat   = rechercheHistoriqueRDV($nomCabinet, $criteres, $page, $parPage);
                                            $total      = $resultat['total'];
                                            $nbrPages   = max(1, (int) ceil($total / $parPage));

                                            if ($page > $nbrPages) {
                                                $page     = $nbrPages;
                                                $resultat = rechercheHistoriqueRDV($nomCabinet, $criteres, $page, $parPage);
                                            }

                                            $kines = getKinesPourHistoriqueRDV($nomCabinet);

                                            function echapperHistoRDV($texte){
                                                return htmlspecialchars((string) $texte, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                                            }

                                            function lienPageHistoRDV($criteres, $parPage, $numPage){
                                                $parametres = array_filter($criteres, function($v){ return $v !== ""; });
                                                $parametres['parPage'] = $parPage;
                                                $parametres['page']    = $numPage;
                                                return "rendez-vous.php?" . http_build_query($parametres);
                                            }
                                        ?>

                                        <style type="text/css">
                                            .histo-rdv-form .form-group { margin-bottom: 10px; }
                                            .histo-rdv-form label { font-size: 12px; margin-bottom: 2px; }
                                            .etiquette-statut, .etiquette-seance {
                                                display: inline-block;
                                                padding: 1px 7px;
                                                border-radius: 3px;
                                                font-size: 11px;
                                                font-weight: bold;
                                                color: #fff;
                                                white-space: nowrap;
                                            }
                                            .statut-danger  { background: #FF6B6B; }
                                            .statut-info    { background: #65C3DF; }
                                            .statut-warning { background: #FFA200; }
                                            .statut-success { background: #45B6B0; }
                                            .statut-primary { background: #337ab7; }
                                            .statut-default { background: #A8BDCF; }
                                            .statut-inverse { background: #555555; }
                                            .etiquette-simple             { background: #A8BDCF; }
                                            .etiquette-vestibulaire       { background: #8E44AD; }
                                            .etiquette-bilan_vestibulaire { background: #AD1457; }
                                            .etiquette-esthetique         { background: #B7950B; }
                                            .histo-rdv-table td, .histo-rdv-table th { vertical-align: middle !important; }
                                            .histo-rdv-pagination { margin: 10px 0; }
                                        </style>

                                        <form class="histo-rdv-form" method="GET" action="rendez-vous.php">
                                            <div class="row">
                                                <div class="col-sm-4 form-group">
                                                    <label for="recherche">Patient (nom, prénom ou téléphone)</label>
                                                    <input class="form-control" type="text" id="recherche" name="recherche" value="<?php echo echapperHistoRDV($criteres['recherche']); ?>" placeholder="Ex : benali, 0550..." autofocus>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <label for="idPatient">Identifiant patient</label>
                                                    <input class="form-control" type="text" id="idPatient" name="idPatient" value="<?php echo echapperHistoRDV($criteres['idPatient']); ?>">
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <label for="dateDebut">Du</label>
                                                    <input class="form-control" type="date" id="dateDebut" name="dateDebut" value="<?php echo echapperHistoRDV($criteres['dateDebut']); ?>">
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <label for="dateFin">Au</label>
                                                    <input class="form-control" type="date" id="dateFin" name="dateFin" value="<?php echo echapperHistoRDV($criteres['dateFin']); ?>">
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <label for="statut">Statut</label>
                                                    <select class="form-control" id="statut" name="statut">
                                                        <option value="">Tous</option>
                                                        <?php
                                                            foreach (array("6", "5", "1", "2", "3", "0", "4") as $s) {
                                                                $infoStatut = libelleStatutRDV($s);
                                                                $selected   = ($criteres['statut'] === $s) ? " selected" : "";
                                                                echo "<option value=\"$s\"$selected>" . $infoStatut[0] . "</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3 form-group">
                                                    <label for="typeSeance">Type de séance</label>
                                                    <select class="form-control" id="typeSeance" name="typeSeance">
                                                        <option value="">Tous</option>
                                                        <?php
                                                            foreach (typesSeanceDisponibles() as $valeur => $libelle) {
                                                                $selected = ($criteres['typeSeance'] === $valeur) ? " selected" : "";
                                                                echo "<option value=\"$valeur\"$selected>$libelle</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 form-group">
                                                    <label for="idMedecin">Kinésithérapeute</label>
                                                    <select class="form-control" id="idMedecin" name="idMedecin">
                                                        <option value="">Tous</option>
                                                        <?php
                                                            foreach ($kines as $idKine => $nomKine) {
                                                                $selected = ($criteres['idMedecin'] === (string) $idKine) ? " selected" : "";
                                                                echo "<option value=\"" . echapperHistoRDV($idKine) . "\"$selected>" . echapperHistoRDV($nomKine) . "</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <label for="parPage">Lignes par page</label>
                                                    <select class="form-control" id="parPage" name="parPage">
                                                        <?php
                                                            foreach (array(25, 50, 100) as $n) {
                                                                $selected = ($parPage == $n) ? " selected" : "";
                                                                echo "<option value=\"$n\"$selected>$n</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4 form-group" style="padding-top: 19px;">
                                                    <button type="submit" class="btn btn-info"><span class="entypo-search"></span>&nbsp;Rechercher</button>
                                                    <a href="rendez-vous.php" class="btn btn-default">Effacer la recherche</a>
                                                </div>
                                            </div>
                                        </form>

                                        <p>
                                            <strong><?php echo $total; ?></strong> rendez-vous trouvé(s)
                                            <?php if ($total > 0) { echo " &mdash; page $page / $nbrPages"; } ?>
                                        </p>

                                        <table class="table table-striped table-hover histo-rdv-table">
                                            <thead>
                                                <tr>
                                                    <th>Patient</th>
                                                    <th>Date Rendez-Vous</th>
                                                    <th>Heure</th>
                                                    <th>Type de séance</th>
                                                    <th>Statut</th>
                                                    <th>Identifiant</th>
                                                    <th>Téléphone</th>
                                                    <th>Chez docteur</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if (count($resultat['lignes']) == 0) {
                                                        echo "<tr><td colspan=\"8\" style=\"text-align:center;\">Aucun rendez-vous ne correspond à la recherche.</td></tr>";
                                                    }

                                                    foreach ($resultat['lignes'] as $donnees) {

                                                        $infoStatut = libelleStatutRDV($donnees['statut']);
                                                        $typeRDV    = normaliserTypeSeance(isset($donnees['type_seance']) ? $donnees['type_seance'] : "simple");
                                                        $idPatRDV   = trim((string) $donnees['idPatient']);

                                                        echo "<tr>";
                                                        echo "<td>" . echapperHistoRDV($donnees['nomP'] . " " . $donnees['prenoP']) . "</td>";
                                                        echo "<td>" . echapperHistoRDV($donnees['dateRDV']) . "</td>";
                                                        echo "<td>" . echapperHistoRDV(substr($donnees['heureRDV'], 0, 5)) . "</td>";
                                                        echo "<td><span class=\"etiquette-seance etiquette-$typeRDV\">" . libelleTypeSeance($typeRDV) . "</span></td>";
                                                        echo "<td><span class=\"etiquette-statut statut-" . $infoStatut[1] . "\">" . $infoStatut[0] . "</span></td>";

                                                        if ($idPatRDV != "") {
                                                            echo "<td><a href=\"rdvpatient.php?idPatient=" . urlencode($idPatRDV) . "\" title=\"Ouvrir la fiche du patient\">" . echapperHistoRDV($idPatRDV) . "</a></td>";
                                                        }else{
                                                            echo "<td>-</td>";
                                                        }

                                                        echo "<td>" . echapperHistoRDV($donnees['tel']) . "</td>";
                                                        echo "<td>" . echapperHistoRDV($donnees['medecin']) . "</td>";
                                                        echo "</tr>";
                                                    }
                                                ?>
                                            </tbody>
                                        </table>

                                        <?php if ($nbrPages > 1) { ?>
                                            <ul class="pagination histo-rdv-pagination">
                                                <?php
                                                    $premiere = max(1, $page - 3);
                                                    $derniere = min($nbrPages, $page + 3);

                                                    if ($page > 1) {
                                                        echo "<li><a href=\"" . echapperHistoRDV(lienPageHistoRDV($criteres, $parPage, 1)) . "\">&laquo;</a></li>";
                                                        echo "<li><a href=\"" . echapperHistoRDV(lienPageHistoRDV($criteres, $parPage, $page - 1)) . "\">&lsaquo;</a></li>";
                                                    }

                                                    for ($p = $premiere; $p <= $derniere; $p++) {
                                                        $actif = ($p == $page) ? " class=\"active\"" : "";
                                                        echo "<li$actif><a href=\"" . echapperHistoRDV(lienPageHistoRDV($criteres, $parPage, $p)) . "\">$p</a></li>";
                                                    }

                                                    if ($page < $nbrPages) {
                                                        echo "<li><a href=\"" . echapperHistoRDV(lienPageHistoRDV($criteres, $parPage, $page + 1)) . "\">&rsaquo;</a></li>";
                                                        echo "<li><a href=\"" . echapperHistoRDV(lienPageHistoRDV($criteres, $parPage, $nbrPages)) . "\">&raquo;</a></li>";
                                                    }
                                                ?>
                                            </ul>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





            <!--  / DEVICE MANAGER -->

                  
                <!-- /END OF CONTENT -->



                <!-- FOOTER -->

                   <?php include("fragmentsPages/footer.php"); ?>   


                <!-- / END OF FOOTER -->


        </div>
    </div>

    <!--  END OF PAPER WRAP -->

        <?php 
        if($typeProfil == "medecin"){ 

            include("fragmentsPages/menuSecondaire.php");
        }

        elseif($typeProfil == "staff"){

            //include("fragmentsPages/menuSecondaire.php");
        }
    ?>


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

    <script type="text/javascript" src="assets/js/toggle_close.js"></script>
    <script src="assets/js/footable/js/footable.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.sort.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.filter.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>



    <script>
    $('.textarea').wysihtml5();
    </script>


    <script type="text/javascript">
    var output, started, duration, desired;

    // Constants
    duration = 5000;
    desired = '50';

    // Initial setup
    output = $('#speed');
    started = new Date().getTime();

    // Animate!
    animationTimer = setInterval(function() {
        // If the value is what we want, stop animating
        // or if the duration has been exceeded, stop animating
        if (output.text().trim() === desired || new Date().getTime() - started > duration) {
            console.log('animating');
            // Generate a random string to use for the next animation step
            output.text('' + Math.floor(Math.random() * 60)

            );

        } else {
            console.log('animating');
            // Generate a random string to use for the next animation step
            output.text('' + Math.floor(Math.random() * 120)

            );
        }
    }, 5000);
    </script>
    <script type="text/javascript">
    $('#getting-started').countdown('2020/01/01', function(event) {
        $(this).html(event.strftime(

            '<span>%M</span>' + '<span class="start-min">:</span>' + '<span class="start-min">%S</span>'));
    });
    </script>


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
header('location: ../../choixCabinet.php');
}

?>
