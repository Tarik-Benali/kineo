<?php
    include("auth/auth.php");
    include("includes/historique.php");
    include("includes/functions.php");

    if ($_SESSION['typeCompte'] == "1") {
    

    if (isset($_SESSION['identifiant'])){

                $idPatient  = $_SESSION["identifiant"];                                               

                getTheme($idPatient);

                $theme  = $_SESSION['theme'];

            }
    else{
            $_SESSION['theme']  = "bg";

            $theme              = $_SESSION['theme'];
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

<?php include("fragmentsPages/fragmentsPatient/bodyTheme.php"); ?>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- TOP NAVBAR -->

    <?php include("fragmentsPages/fragmentsPatient/barDeNavigation.php");?>

    <!-- /END OF TOP NAVBAR -->

    <!-- SIDE MENU -->
    <?php include("fragmentsPages/fragmentsPatient/menuPrincipal.php");?>
    <!-- END OF SIDE MENU -->



    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">





            <!-- CONTENT -->
            <!--TITLE -->


            <!--/ TITLE -->

            <!-- BREADCRUMB -->
            <ul id="breadcrumb" style="margin-top: 20px; padding-top: 20px">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Rendez-vous</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Liste de mes Rendez-Vous</a>
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
                                <div class="nest" id="FilteringClose9">
                                    <div class="title-alt">
                                        <h6>
                                            Mes Rendez-Vous</h6>
                                        <div class="titleClose">
                                            <a class="gone" href="#FilteringClose9">
                                                <span class="entypo-cancel"></span>
                                            </a>
                                        </div>
                                        

                                    </div>

                                    <div class="body-nest" id="flt">

                                        <div class="row" style="margin-bottom:10px;">
                                            <div class="col-sm-4">
                                                <input class="form-control" id="filter" placeholder="Search..." type="text" />
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="filter-status form-control">
                                                    <option value="active">Active</option>
                                                    <option value="disabled">Disabled</option>
                                                    <option value="suspended">Suspended</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">

                                                <a href="#clear" style="margin-left:10px;" class="pull-right btn btn-info clear-filter" title="clear filter">clear</a>
                                                <a href="#api" class="pull-right btn btn-info filter-api" title="Filter using the Filter API">filter API</a>



                                            </div>

                                        </div>

                                        <table id="footable-res2" class="demo" data-filter="#filter" data-filter-text-only="true">
                                            <thead>
                                                <tr>
                                                    <th data-toggle="true">
                                                        Nom Patient
                                                    </th>
                                                    <th>
                                                        Date Rendez-Vouz
                                                    </th>

                                                    <th data-hide="phone,tablet">
                                                        Identifiant
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        Prenom Patient
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        Téléphone
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        Chez docteur
                                                    </th>

                                                    <th data-hide="phone,tablet">
                                                        Annuler le Rendez-Vouz
                                                    </th>
                                                    <th>
                                                        Heure Rendez-Vous
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php afficherToutMesRDVAVenir($idPatient); ?>

                                            </tbody>
                                        </table>

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
<?php  }else{
              header('location: auth/logout.php');
            }?>
