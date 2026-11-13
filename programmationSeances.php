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

            $nomMedecin = getMedecinName($idMedecin);  

            $programme = getSeancesForAgenda($nomCabinet); 

            $jourFerme = getNonOuvrableDays($nomCabinet); 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kiné</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->



    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" type="text/css" href="assets/js/progress-bar/number-pb.css">


    <link rel="stylesheet" href="assets/js/dataTable/lib/jquery.dataTables/css/DT_bootstrap.css" />
    <link rel="stylesheet" href="assets/js/dataTable/css/datatables.responsive.css" />




    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">


    <!--link rel="stylesheet" href="assets/js/datepicker/bootstrap-datetimepicker.css"-->

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="assets/calendar/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--begin::Global Theme Styles(used by all pages)-->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link rel="stylesheet" href="assets/js/datepicker/datepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/clockface.css">
    <link rel="stylesheet" href="assets/js/datepicker/bootstrap-datetimepicker.css">

    <link rel="stylesheet" href="assets/css/profile.css">

    


    <style type="text/css">
        canvas#canvas4 {
            position: relative;
            top: 20px;
        }
        .aParent div {
            float: left;
            clear: none; 
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
                <li><a href="#" title="Sample page 1">Acceuil </a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Tableau de bord</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->



<!---------------------------------------------------------------------- !!  ------------------------------------------------------------------------> 

                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="FilteringClose4">
                            <div class="title-alt">
                                <h6>
                                    Calendrier des rendez-vous</h6>
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

                            <div class="body-nest" style="margin-bottom: 10px">
                                <div class="pull-right">
                                   <button id="addRDVBtn" class="btn btn-info" data-toggle="modal" data-target="#rdvModal">&nbsp;&nbsp;Ajout de Rendez-vous&nbsp;&nbsp;</button>
                                </div>
                                
                            </div>
                            <div class="body-nest" id="calendrierDesTaches">
                                    <div id="kt_calendar"></div> 

                                    <br>

                                    <button class="btn btn-default"></button>&nbsp;Pas de séances&nbsp;&nbsp;
                                    <button class="btn btn-info"></button>&nbsp;Séance terminé&nbsp;&nbsp;
                                    <button class="btn btn-warning"></button>&nbsp;Séance en cours&nbsp;&nbsp;
                                    <button class="btn btn-success"></button>&nbsp;Place disponible&nbsp;&nbsp;
                                    <button class="btn btn-danger"></button>&nbsp;Scéances complète&nbsp;&nbsp;
                            </div>

                        </div>


                    </div>

                </div>

<!------------------------------------------------------------- Debut Programation Séances modal -------------------------------------------------------->
                <div class="modal fade" id="ProgSeance" tabindex="-1" role="dialog" aria-labelledby="modalProgSeance" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalProgSeance">Programmations des séances</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form id="saveSeanceForm" action="fonctionnalites/ajout/ajouterSeances.php" method="POST">
                      <div class="modal-body" style="display: grid; place-items: center;">
                        <input type="hidden" id="type"     name="type" value="0">
                        <input type="hidden" id="idCab"    name="idCab" value="<?php echo $idCabinet; ?>">
                        <input type="hidden" id="medecin"  name="medecin" value="<?php echo $idMedecin; ?>">
                        <input type="hidden" id="cabinet"  name="nomCabinet" value="<?php echo $nomCabinet;?>">

                        <br>

                        <div class="aParent" style="width: 100%">
                            <div style="width: 49%; margin-right: 2%;">
                                <label class="control-label" for="timeRDV">Date début programmation</label>
                                <br>
                                <input type="date" class="form-control" id="dateDebProg" name="dateDebProg">
                            </div>

                            <div style="width: 49%;">
                                <label class="control-label" for="dateRDV">Date fin programmation</label>
                                <br>
                                <input type="date" class="form-control" id="dateFinProg" name="dateFinProg">
                            </div>
                        </div>

                        <br><br><br>

                        <div style="width: 100%;"> 
                            <label class="control-label" for="nom">Type de séances</label>
                            <div class="controls">
                                 <select name="typeSeance" id="typeSeance" class="form-control btn-success">
                                    <option value="simple">Séance Simple</option> 
                                 </select>
                            </div>
                        </div>

                        <br>
                        <br>

                        <div id="espace_patient"></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-info" onclick="saveSeancePrgr()">Enregistrer</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>

                <button id="showSeancePrgBtn" type="hidden" style="visibility: hidden;" data-toggle="modal" data-target="#ProgSeance"></button>
                

<!--------------------------------------------------------------- Fin Programation Séances modal ------------------------------------------------------------->



<!------------------------------------------------------------- Debut Begin Séances modal -------------------------------------------------------------------->

                <div class="modal fade" id="AccessSeance" tabindex="-1" role="dialog" aria-labelledby="modalProgSeance" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalProgSeance">Commencer la séance</h5>
                      </div>
                      <form id="beginSeanceForm" action="fonctionnalites/mod/modSeance.php" method="POST">
                      <div class="modal-body" style="display: grid; place-items: center;">
                        <input type="hidden" id="type"     name="type" value="0">
                        <input type="hidden" id="idCab"    name="idCab" value="<?php echo $idCabinet; ?>">
                        <input type="hidden" id="idSeance" name="idSeance" value="">
                        <input type="hidden" id="medecin"  name="medecin" value="<?php echo $idMedecin; ?>">
                        <input type="hidden" id="cabinet"  name="nomCabinet" value="<?php echo $nomCabinet;?>">
                        <input type="hidden" id="etatSean" name="etatSeance" value="1">

                        <br>

                        <div class="aParent" style="width: 100%">
                            <div style="width: 49%; margin-right: 2%;">
                                <label class="control-label" for="timeRDV">Heure début de séance</label>
                                <br>
                                <input type="heure" class="form-control" id="heureDebutSeance" disabled>
                            </div>

                            <div style="width: 49%;">
                                <label class="control-label" for="dateRDV">Heure fin de séance</label>
                                <br>
                                <input type="heure" class="form-control" id="heureFinSeance" disabled>
                            </div>
                        </div>

                        <br><br><br>

                        <div style="width: 100%;"> 
                            <label class="control-label" for="nom">Patient</label>
                            <div class="controls" id="getPatient">
                            </div>
                        </div>

                        <br>
                        <br>

                        <div id="espace_patient"></div>
                      </div>
                      <div class="modal-footer">
                        Êtes vous sûr de vouloir commancer cette séance ?
                        <button type="button" class="btn btn-info" onclick="beginSeanceBtn()">Commencer la séance</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>

                <button id="beginSeance" type="hidden" style="visibility: hidden;" data-toggle="modal" data-target="#AccessSeance"></button>
                

<!--------------------------------------------------------------- Fin Begin Séances modal --------------------------------------------------------------->


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

    <!--begin::Page Vendors(used by this page)-->
    <script src="assets/fullcalendar/fullcalendar.bundle.js"></script>
    <script src="assets/fullcalendar/locale-all.js"></script>
    <!--end::Page Vendors-->


    <script>
        var programme = <?php echo $programme;?>;
        var jourFerme = <?php echo $jourFerme;?>;
        var ceMomentH = "<?php echo date('H:i:s');?>";

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
                        locale: 'fr',
                        selectable: true,

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
                        now: TODAY + 'T' + ceMomentH, // just for demo

                        views: {
                            dayGridMonth: { buttonText: 'mois' },
                            timeGridWeek: { buttonText: 'semaine' },
                            timeGridDay: { buttonText: 'jour' }
                        },

                        defaultView: 'dayGridMonth',
                        defaultDate: TODAY,

                        hiddenDays: jourFerme,

                        editable: true,
                        eventLimit: true, // allow "more" link when too many events
                        navLinks: true,
                        events: programme,

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

                            var descrip   = info.event.extendedProps.description;
                            var splitDesc = descrip.split("<br>");
                            var idseance  = splitDesc[0];
                            idseance  = idseance.substr(7);

                            var dateHeure = info.event.start;

                            var month = dateHeure.getUTCMonth() + 1;
                            var day   = dateHeure.getUTCDate();
                            var year  = dateHeure.getUTCFullYear();

                            var h = dateHeure.getHours();
                            var m = dateHeure.getMinutes();
                            var s = dateHeure.getSeconds();

                            if (day < 10) {day = "0"+ day}
                            if (month < 10) {month = "0"+ month}

                            if (h < 10) {h = "0"+ h}
                            if (m < 10) {m = "0"+ m}
                            if (s < 10) {s = "0"+ s} 

                            

                            var v = new Date(dateHeure);
                            v.setMinutes(m+90);
                            var hEnd = v.getHours();
                            var mEnd = v.getMinutes();
                            var sEnd = v.getSeconds();
                            if (hEnd < 10) {hEnd = "0"+ hEnd}
                            if (mEnd < 10) {mEnd = "0"+ mEnd}
                            if (sEnd < 10) {sEnd = "0"+ sEnd}

                            var selectedDate = year + "-" + month + "-" + day;
                            var selectedTime = h + ":" + m + ":" + s;
                            var endEventTime = hEnd + ":" + mEnd + ":" + sEnd;


                            if (selectedDate == TODAY) {

                                //alert('hhhhhh ' + selectedDate + "  ||  " + TODAY);
                                document.getElementById("heureDebutSeance").value = selectedTime;
                                document.getElementById("heureFinSeance").value = endEventTime;

                                document.getElementById("idSeance").value = idseance;

                                getPatient(cabinet,idseance);
                            } 
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
                        },

                        select: function(info) {
                          var dateDeb = info.startStr;
                          var dateFin = info.endStr;

                          var begDate  = new Date(dateDeb);
                          var endDate  = new Date(dateFin);

                          endDate.setDate(endDate.getDate() - 1);
                          

                          var monthD   = begDate.getUTCMonth() + 1;
                          var dayD     = begDate.getUTCDate();
                          var yearD    = begDate.getUTCFullYear();

                          var monthF   = endDate.getUTCMonth() + 1; //months from 1-12
                          var dayF     = endDate.getUTCDate();
                          var yearF    = endDate.getUTCFullYear();

                          if (dayD < 10) {dayD = "0"+ dayD}
                          if (dayF < 10) {dayF = "0"+ dayF}
                          if (monthD < 10) {monthD = "0"+ monthD}
                          if (monthF < 10) {monthF = "0"+ monthF}


                          dateDeDebPrg = yearD + "-" + monthD + "-" + dayD;
                          deteDeFinPrg = yearF + "-" + monthF + "-" + dayF;

                          if (dateDeb >=TODAY) {
                              document.getElementById('dateDebProg').value = dateDeDebPrg;
                              document.getElementById('dateFinProg').value = deteDeFinPrg;

                              document.getElementById('showSeancePrgBtn').click();
                          }else {
                              alert("Impossible de programmer des scéances dans des dates passées !");
                          }



                          
                        },

                        dateClick: function(info) {
                            //var dateSelected = info.dateStr;
                            /*document.getElementById("dateRDV").value = dateSelected;
                            document.getElementById('addRDVBtn').click();*/

                            //document.getElementById('showSeancePrgBtn').click(); 
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


    <!--script>  
         $(document).ready(function(){

              $('#mailPhonePatientModif').keyup(function(){  
                   document.getElementById("updateRDVBtn").disabled = false;
                   $('#espaceChoixPatientModif').html('');

                   var NomPatient = $(this).val();

                   if (NomPatient =="") {
                    $('#espaceChoixPatientModif').html('');
                    document.getElementById("updateRDVBtn").disabled = false;
                   }

                   if (NomPatient != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/getPatientFromName.php",  
                          type:"GET",  
                          data:{NomPhonePatient: encodeURIComponent(NomPatient),Type: "update"},
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#espaceChoixPatientModif').append(data);

                               } else{
                                document.getElementById('espaceChoixPatientModif').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Pas de Patient de ces infos</div>";
                                document.getElementById("updateRDVBtn").disabled = false;
                               }
                          }  
                      });
                     }      
                }); 
              });                                      
    </script-->
    <script>
        function saveSeancePrgr(){
            //var idPatient  = "";
            //var nomPatient = "";
            //idPatient  = document.getElementById("idPatienModif").value;
            //nomPatient = document.getElementById("mailPhonePatientModif").value;
            //if (idPatient == "" || nomPatient == "") {
            //  alert("Veuillez d'abord sélectionner un patient !");
            //}else{
                
                document.getElementById("saveSeanceForm").submit();
            //}
        }

        function beginSeanceBtn(){
            //var idPatient  = "";
            //var nomPatient = "";
            //idPatient  = document.getElementById("idPatienModif").value;
            //nomPatient = document.getElementById("mailPhonePatientModif").value;
            //if (idPatient == "" || nomPatient == "") {
            //  alert("Veuillez d'abord sélectionner un patient !");
            //}else{
                
                document.getElementById("beginSeanceForm").submit();
            //}
        }

        function getPatient(cabinet,seance){

            document.getElementById('beginSeance').click();

                $('#getPatient').html('');

                if (cabinet != "" && seance != ""){

                    $.ajax({
                      url:"getPatientTemp.php",  
                      type:"GET",
                      data:{nomCabinet: encodeURIComponent(cabinet),idSeance: encodeURIComponent(seance)},
                      success:function(data)  
                      {  
                           if (data != "") {
                                $('#getPatient').append(data);

                                

                           } else{
                                document.getElementById('getPatient').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Aucun patient n'est programmé pour cette seance !</div>";

                                document.getElementById('beginSeance').click();
                           }
                      }  
                  });
                } 
        }

        
    </script>



    <script type="text/javascript">
        $('#datetimepicker1').datetimepicker({
            language: 'pt-BR'
        });
        $('#dp1').datepicker({format:"dd/mm/yyyy"})
        $('#dpYears').datepicker();
        $('#timepicker1').timepicker();
        $('#t1').clockface();
        $('#t2').clockface({
            format: 'HH:mm',
            trigger: 'manual'
        });

        $('#toggle-btn').click(function(e) {
            e.stopPropagation();
            $('#t2').clockface('toggle');
        });
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
