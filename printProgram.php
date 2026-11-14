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
                <li><a href="#" title="Sample page 1">Rendez-vous</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Rendez Vous Du Jour</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="FilteringClose">
                            <div class="title-alt">
                                <h6>
                                    Rendez-Vous du jour</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#FilteringClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="Filtering">

                                <div class="row" style="margin-bottom:10px;">
                                    <div class="col-sm-4">
                                        <input class="form-control" id="filter" placeholder="Filtre par nom, prénom ou téléphone Patient" type="text" />
                                    </div>

                                    <div class="col-sm-2">
                                       <input class="form-control" id="dateProgramme" placeholder="Filtre par date" type="date"/> 
                                    </div>


                                    <div class="col-sm-2">
                                        <a href="#" id="printDay" style="margin-left:10px;" class="pull-right btn btn-success">Imprimer</a>
                                    </div>
                                    <div class="col-sm-4">

                                        <a href="#" id="searchProgram" style="margin-left:10px;" class="pull-right btn btn-info">Recherche</a>

                                    </div>

                                </div>

                                <table id="footable-res2" cellpadding="10" class="demo" data-filter="#filter" data-filter-text-only="true">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">
                                                Patient
                                            </th>
                                            <th>
                                                Type séance
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                            <th>
                                                Heure
                                            </th>
                                            <th data-hide="phone,tablet">
                                                Chez docteur
                                            </th>
                                            <th>
                                                Téléphone
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="programmeBody">

                                        <?php
                                            if (isset($_GET['selectedDay']) && isset($_GET['cabName']) && $_GET['selectedDay']!="" && $_GET['cabName']!="") {
                                                afficheLesRDVParJour("", $_GET['selectedDay']);
                                            }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                            <tr>
                                                <td colspan="6">
                                                    <div class="pagination pagination-centered"></div>
                                                </td>
                                            </tr>
                                    </tfoot>
                                </table>

                            </div>

                        </div>


                    </div>

                </div>
            </div>
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

    <script>
        function dateFltr() {
          var  input, filter, table, tr, td, i, txtValue;
          input  = document.getElementById("dateFiltr");
          filter = input.value.toUpperCase();
          table  = document.getElementById("footable-res2");
          tr     = table.getElementsByTagName("tr");

          //ici, je remplace les "-" par les "/"
          for (j = 0; j < filter.length; j++){
            filter = filter.replace("-", "/");
          }

          //ici, j'inverse la date 
          filter = reverse(filter);
          
          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
        }

        function reverse(s){
            return s.split("/").reverse().join("/");
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function(){

            $('#searchProgram').click(function(){  
                $('#programmeBody').html('');

                var MonCab      = "<?php echo $nomCabinet;?>";
                var selectedDay = $("#dateProgramme").val();

                if (MonCab != "" && selectedDay != ""){
                    const params = new URLSearchParams(window.location.search);
                    params.set( "selectedDay", selectedDay);
                    params.set( "cabName", MonCab);
                    window.location.href = `${window.location.pathname}?${params}`;
                }      
            }); 
        }); 
    </script>

    <script type="text/javascript">
        function printData() {
            var divToPrint = document.getElementById("footable-res2");

            var clonedTable = divToPrint.cloneNode(true);

            var tfoot = clonedTable.getElementsByTagName("tfoot");
            if (tfoot.length > 0) {
                clonedTable.removeChild(tfoot[0]);
            }

            // Toutes les lignes de la journée (pas seulement la page affichée), hors lignes exclues par le filtre
            $(clonedTable).find('tbody > tr').each(function () {
                if ($(this).hasClass('footable-filtered') || $(this).hasClass('footable-row-detail')) {
                    $(this).remove();
                } else {
                    $(this).show();
                }
            });
            $(clonedTable).find('th, td').show();

            // Résumé de la journée
            var compteurs = { V: 0, BV: 0, E: 0, N: 0 };
            $(clonedTable).find('.etiquette-impression').each(function () {
                var code = $(this).attr('data-etiquette');
                if (compteurs.hasOwnProperty(code)) { compteurs[code]++; }
            });
            var nbRDV  = $(clonedTable).find('tbody > tr').length;
            var resume = nbRDV + " rendez-vous";
            if (compteurs.V)  { resume += " - " + compteurs.V  + " Séance(s) Vestibulaire(s)"; }
            if (compteurs.BV) { resume += " - " + compteurs.BV + " Bilan(s) Vestibulaire(s)"; }
            if (compteurs.E)  { resume += " - " + compteurs.E  + " Séance(s) Esthétique(s)"; }
            if (compteurs.N)  { resume += " - " + compteurs.N  + " Nouveau(x) patient(s)"; }

            var titre = "Rendez-vous du <?php echo (isset($_GET['selectedDay']) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $_GET['selectedDay'])) ? date('d/m/Y', strtotime($_GET['selectedDay'])) : ''; ?>";

            var etiquette = function (code, couleur, fond) {
                return '<span style="display:inline-block; padding:1px 6px; border-radius:3px; font-weight:bold; font-size:11px; color:' + couleur + '; background:' + fond + '; border:1px solid ' + (fond == '#fff' ? couleur : fond) + '; -webkit-print-color-adjust:exact; print-color-adjust:exact;">' + code + '</span>';
            };
            var legende = etiquette('V', '#fff', '#8E44AD') + ' Séance Vestibulaire &nbsp;&nbsp; '
                        + etiquette('BV', '#fff', '#AD1457') + ' Bilan Vestibulaire &nbsp;&nbsp; '
                        + etiquette('E', '#fff', '#B7950B') + ' Séance Esthétique &nbsp;&nbsp; '
                        + etiquette('N', '#E74C3C', '#fff') + ' Nouveau patient';

            var style = '<style>'
                      + 'body{font-family:Arial,Helvetica,sans-serif; font-size:12px; margin:15px;}'
                      + 'h2{font-size:16px; margin:0 0 4px 0;}'
                      + '.resume{margin-bottom:10px; color:#444;}'
                      + '.legende{margin-top:10px; font-size:11px;}'
                      + 'table{border-collapse:collapse; width:100%;}'
                      + 'th,td{border:1px solid #999; padding:4px 6px; text-align:left;}'
                      + 'td:not(:first-child){white-space:nowrap;}'
                      + 'th{background:#eee; -webkit-print-color-adjust:exact; print-color-adjust:exact;}'
                      + '</style>';

            var newWin = window.open("");
            newWin.document.write('<html><head><meta charset="utf-8"><title>' + titre + '</title>' + style + '</head><body>'
                                + '<h2>' + titre + '</h2>'
                                + '<div class="resume">' + resume + '</div>'
                                + clonedTable.outerHTML
                                + '<div class="legende">' + legende + '</div>'
                                + '</body></html>');
            newWin.document.close();
            newWin.focus();
            newWin.print();
            newWin.close();
        }

        document.getElementById('printDay').addEventListener('click', function () {
            printData();
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
