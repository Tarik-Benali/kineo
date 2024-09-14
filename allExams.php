<?php
    include("auth/auth.php");
    include("includes/functions.php");

    if (isset($_SESSION['idDeCeCabinet'])) {

                                              
    $idCabinet        = $_SESSION['idDeCeCabinet'];

    $nomCabinet       = $_SESSION['nomDeCeCabinet'];

    $adresseCabinet   = $_SESSION['adresseDeCeCabinet'];

    $idMedCab         = $_SESSION['idDeCeMedCab'];

    $idMedecin        = $_SESSION['idDeCeMedecin'];
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
    <!-- TOP NAVBAR -->


    <?php include("fragmentsPages/barDeNavigation.php"); ?> 



    <!-- SIDE MENU -->

    <?php include("fragmentsPages/menuPrincipal.php"); ?>


    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">

 <!------------------------------------------------------ Titre de Page --------------------------------------------------------------------------------->



            <!-- CONTENT -->
            <!--TITLE -->
            <div class="row">
                <div id="paper-top">
                    <div class="col-sm-3">
                        <h2 class="tittle-content-header">
                            <span class="entypo-menu"></span>
                            <span><?php if(isset($idMedecin)) {echo "Dr, ";} echo $_SESSION['username'] ; ?>&nbsp;!
                            </span>
                        </h2>

                    </div>

                    <div class="col-sm-7">
                        <div class="devider-vertical visible-lg"></div>
                        <div class="tittle-middle-header">

                            <div class="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <span class="tittle-alert entypo-info-circled"></span>
                                 <?php 
                                        //$res= getInformation($_SESSION['idUser'],$_SESSION['typeCompte']); ?>
                                                      
                                Bienvenue Dr,&nbsp;
                                <strong><?php echo $_SESSION['username'] ;  ?>&nbsp;!</strong>&nbsp;&nbsp;On vous souhaite une bonne journée.
                            </div>


                        </div>

                    </div>

                </div>
            </div>
            <!--/ TITLE -->

            <!-- BREADCRUMB -->
            <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Mes Patients</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Afficher Les Patients</a>
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

                        <div class="nest" id="FootableClose">


                            <div class="title-alt">
                                                <div class="col-md-4 col-md-offset-4">

                                                          <div class="side-bar"">
                                                                <h2>EXAMEN
                                                                </h2>
                                                                                          
                                                          </div>          
                                                </div>
                                <div class="titleClose">
                                    <a class="gone" href="#FootableClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="Footable">

                                <table class="table-striped footable-res footable metro-blue" data-page-size="6">
                                    <thead>
                                        <tr>
                                            <th>
                                                Code
                                            </th>
                                            <th>
                                                Examen
                                            </th>
                                            <th data-hide="phone">
                                                Objectif
                                            </th>
                                            <th>
                                                Suppression
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                                affichageDeToutLesExamens($nomCabinet,$idMedecin,$idCabinet);
                                                ?>

                                        
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
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

    <!-- RIGHT SLIDER CONTENT -->

    <?php include("fragmentsPages/menuSecondaire.php"); ?>


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
header('location: ../../choixCabinet.php');
}

?>