<?php
include("auth/auth.php");
include("includes/functions.php");

    if (isset($_SESSION['identifiant'])){

                $idAdmin  = $_SESSION["identifiant"];                                               

                getTheme($idAdmin);

                $theme  = $_SESSION['theme'];

            }
    else{
            $_SESSION['theme']  = "bg";

            $theme              = $_SESSION['theme'];
        }

        $today  = date("d-m-Y");
        $ceJour = date("Y-m-d");

        $cabinet = $_SESSION['nomCabinet'];

        //$toutesTaches = getAllTaches($cabinet,$idAdmin);
        //$toutesTaches = getAllTaches($cabinet,"2");

        $thoura = date('H:m:s');

        //$sallesOptions = getAllSalleForProgram($cabinet);
        //$etagesOptions = getAllEtagesForProgram($cabinet);
        //$serviceOptions = getAllServicesForProgram($cabinet);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Adminastreur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link rel="canonical" href="https://keenthemes.com/metronic" />



    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="assets/js/progress-bar/number-pb.css">

    <link rel="stylesheet" href="assets/js/wizard/css/jquery.steps.css">
    <link type="text/css" rel="stylesheet" href="assets/js/wizard/jquery.stepy.css" />
    <link href="assets/js/tabs/acc-wizard.min.css" rel="stylesheet">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/js/timepicker/bootstrap-timepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/datepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/clockface.css">
    <!--link rel="stylesheet" href="assets/js/datepicker/bootstrap-datetimepicker.css"-->

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="assets/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--begin::Global Theme Styles(used by all pages)-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
    
    <?php include("fragmentsPages/barDeNavigation.php");?>

    <!-- /END OF TOP NAVBAR -->

    <!-- SIDE MENU -->

    <?php include("fragmentsPages/menuPrincipal.php");?>            
    
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
                <li><a href="#" title="Sample page 1">Admin</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Programme</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->

     <!--begin::Calendar-->
            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="personelClose">
                            <div class="title-alt">
                                <h6>
                                    Calendrier des taches</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#personelClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#calendrierDesTaches">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="calendrierDesTaches">
                                <div id="kt_calendar"></div>
                            </div>
        
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card-->

            <!--  DEVICE MANAGER -->
            <!--  / DEVICE MANAGER -->

            <div class="content-wrap">
                <!-- /END OF CONTENT -->
                <!-- FOOTER -->
                <?php include("fragmentsPages/footer.php");?>
                <!-- / END OF FOOTER -->
            </div>
        </div>
    </div>
    <!--  END OF PAPER WRAP -->

    <!-- RIGHT SLIDER CONTENT -->
    
        <?php include("fragmentsPages/menuSecondaire.php");?>



    <!--begin::plugin moment-->
    <!--script src="assets/fullcalendar/moment.js"></script-->
    <!--end::plugin moment-->

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.js"></script>
    <script src="assets/js/progress-bar/number-pb.js"></script>
    <script src="assets/js/progress-bar/progress-app.js"></script>


    <!-- FlatPickr importation langue francaise -->
    <script src="assets/flatpickr-master/fr.js"></script>


    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="assets/js/preloader.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/load.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

    <script type="text/javascript" src="assets/js/timepicker/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/clockface.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/bootstrap-datetimepicker.js"></script>



    <script type="text/javascript" src="assets/js/timepicker/bootstrap-timepicker.js"></script>
    <!--begin::Page Vendors(Calendrier des taches)-->
    <script src="assets/fullcalendar/fullcalendar.bundle.js"></script>
    <!--end::Page Vendors-->

    <script type="text/javascript">

        $('#datetimepicker1').datetimepicker({
            language: 'pt-BR'
        });


        var KTCalendarBasic = function() {

            return {
                //main function to initiate the module
                init: function() {
                    var todayDate = moment().startOf('day');
                    var YM = todayDate.format('YYYY-MM');
                    var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                    var TODAY = todayDate.format('YYYY-MM-DD');
                    var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

                    var calendarEl = document.getElementById('kt_calendar');
                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                        themeSystem: 'bootstrap',

                        //isRTL: KTUtil.isRTL(),

                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay'
                        },

                        height: 800,
                        contentHeight: 780,
                        aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                        nowIndicator: true,
                        now: TODAY + 'T09:25:00', // just for demo

                        views: {
                            dayGridMonth: { buttonText: 'month' },
                            timeGridWeek: { buttonText: 'week' },
                            timeGridDay: { buttonText: 'day' }
                        },

                        defaultView: 'dayGridMonth',
                        defaultDate: TODAY,

                        editable: true,
                        eventLimit: true, // allow "more" link when too many events
                        navLinks: true,
                        events: [
                            {
                                title: 'All Day Event',
                                start: YM + '-01',
                                description: 'Toto lorem ipsum dolor sit incid idunt ut',
                                className: "fc-event-danger fc-event-solid-warning"
                            }
                        ],

                        eventClick: function(info) {
                            //alert('Event: ' + info.event.title);
                            //alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                            //alert('View: ' + info.view.type);

                            info.jsEvent.preventDefault(); // don't let the browser navigate

                            if (info.event.url) {
                              window.open(info.event.url);
                            }

                            // change the border color just for fun
                            info.el.style.borderColor = 'yellow';
                          },

                        eventRender: function(info) {
                            var element = $(info.el);

                            if (info.event.extendedProps && info.event.extendedProps.description) {
                                if (element.hasClass('fc-day-grid-event')) {
                                    element.data('content', info.event.extendedProps.description);
                                    element.data('placement', 'top');
                                    //KTApp.initPopover(element);
                                } else if (element.hasClass('fc-time-grid-event')) {
                                    element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                                } else if (element.find('.fc-list-item-title').lenght !== 0) {
                                    element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
                                }
                            }
                        }
                    });

                    calendar.render();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTCalendarBasic.init();
        });


    </script>


</body>

</html>
