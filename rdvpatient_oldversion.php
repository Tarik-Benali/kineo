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

            $programme  = getRDVForAgendaParPatient($nomCabinet, $idPatient, $idMedecin); 


            $nbrSeancePrograme          = nbrSeancePrograme($nomCabinet,$idPatient);
            $nbrSeanceProgrameTerminee  = nbrSeanceProgrameTerminee($nomCabinet,$idPatient);
            $nbrSeanceProgrameNonFaites = nbrSeanceProgrameNonFaites($nomCabinet,$idPatient);

            $nomEtPrenomPatient   = getPatientNameEtPrenomFromTableLocal($nomCabinet,$idPatient);

            if ($nbrSeancePrograme == 0 ) {
                $avancement = 0; 
            }else{
                $avancement = ($nbrSeanceProgrameTerminee * 100) / $nbrSeancePrograme; 
            }

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
                <li><a href="#" title="Sample page 1">Rendez-vous </a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Programme patient</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul>

<!---------------------------------------------------------------------- !!  ------------------------------------------------------------------------> 

                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="FilteringClose4">
                            <div class="title-alt">
                                <h6>
                                    Calendrier des scéances patient</h6>
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
                                    <a href="printJustificatif.php?idPatient=<?php echo $idPatient?>" style="color: inherit;">
                                        <button id="printBtn" class="btn btn-info"  data-toggle="modal" data-target="#JustiPrinter">
                                        <span class="entypo-docs"></span>&nbsp;&nbsp;Imprimer Ordonnance / Justificatif&nbsp;&nbsp;</button>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="calendrierDesTaches">
                                    <div id="kt_calendar"></div> 

                                    <br>

                                    <button class="btn btn-default"></button>&nbsp;Non Confirmé&nbsp;&nbsp;
                                    <button class="btn btn-primary"></button>&nbsp;Confirmé&nbsp;&nbsp;
                                    <button class="btn btn-info"></button>&nbsp;Présent&nbsp;&nbsp;
                                    <button class="btn btn-warning"></button>&nbsp;En salle&nbsp;&nbsp;
                                    <button class="btn btn-success"></button>&nbsp;Terminé&nbsp;&nbsp;
                                    <button class="btn btn-danger"></button>&nbsp;Absent&nbsp;&nbsp;
                            </div>

                        </div>


                    </div>


                    <div class="col-sm-12" id="programming">
                        <div class="nest" id="FilteringClose4">
                            <div class="title-alt">
                                <h6>
                                    Programme patient</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#personelClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#prog">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            
                            <div class="body-nest" id="prog"><!--printData()-->
                                    
                                    <div class="pull-right" style="margin-bottom: 10px;">
                                        <button id="printBtn" class="btn btn-primary" onclick="PrintElem()">
                                            <span class="entypo-print"></span>&nbsp;&nbsp;Imprimer&nbsp;&nbsp;</button>
                                       <!--button id="printBtn" class="btn btn-primary" data-toggle="modal" data-target="#programation">
                                            <span class="entypo-plus"></span>&nbsp;&nbsp;Faire Le Programme&nbsp;&nbsp;</button-->
                                    </div>

                                    <div id="espace_impression_prgm">
                                        <section id="flip-scroll">

                                            <table border="1" class="table table-bordered table-striped cf" style="border-collapse: collapse; width: 100%;" id="programPat">
                                                <thead class="cf">
                                                    <tr>
                                                        <th style="width: 8%;">Num</th>
                                                        <th style="width: 23%;">Séance</th>
                                                        <th style="width: 23%;">Etat</th>
                                                        <th style="width: 23%;">Date</th>
                                                        <th style="width: 23%;">Heure</th>
                                                    </tr>
                                                </thead>
                                                <tbody style="text-align: left;">
                                                    <?php
                                                        getTableauDesRDVs($nomCabinet,$idPatient, $idMedecin);
                                                        //getTableauDesProgrammes($nomCabinet,$idPatient, $idMedecin);
                                                    ?>
                                                </tbody>
                                            </table>
                                        </section>
                                    </div>
                            </div>

                            <div class="body-nest" style="margin-bottom: 10px">
                                <div class="pull-right">
                                   
                                </div>
                            </div>

                        </div>


                    </div>

                </div>


                <div class="content-wrap" style="margin-top: 10px;">
                    <div class="row">

                        <div class="col-sm-3">
                            <div class=" member" id="memberClose">
                                <div class="headline ">
                                    <h3>
                                        <span>
                                            <i class=""></i> &#160;&#160;Séances Programée&#160;&#160;&#160;   
                                        </span>
                                    </h3>
                                    <div class="titleClose">
                                        <a href="#memberClose" class="gone">

                                            <span class="entypo-cancel"> </span>
                                        </a>
                                    </div>
                                </div>

                                <div class="value">
                                    <i class="pull-right"></i>
                                    <?php echo $nbrSeancePrograme;?>
                                </div>
                                
                                <div class="progress-tinny">
                                    <div style="width: 50%" class="bar"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="order" id="orderClose">
                                <div class="headline ">
                                    <h3>
                                        <span>
                                            <i class=""></i>&#160;&#160;Séances Faites</span>
                                    </h3>
                                    <div class="titleClose">
                                        <a href="#orderClose" class="gone">
                                            <span class="entypo-cancel">
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="value">
                                    <i class="pull-right"></i>
                                    <?php echo $nbrSeanceProgrameTerminee;?>
                                </div>
                                <div class="progress-tinny">
                                    <div style="width: 10%" class="bar"></div>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-3">
                            <div class="revenue" id="rendezVousPris">
                                <div class="headline ">
                                    <h3>
                                        <span>
                                            <i class=""></i>&#160;&#160;Séances Restante&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;</span>
                                    </h3>
                                    <div class="titleClose">
                                        <a href="#rendezVousPris" class="gone">
                                            <span class="entypo-cancel">                                         
                                            </span>
                                        </a> 
                                    </div>
                                </div>
                                <div class="value">
                                    
                                    <?php echo $nbrSeanceProgrameNonFaites;?>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">

                            <div class="profit" id="profitClose">
                                <div class="headline">
                                    <h3>
                                        <span>
                                            <i class=""></i>&#160;&#160;Taux d'avancement</span>
                                    </h3>
                                    <div class="titleClose">
                                        <a href="#profitClose" class="gone">
                                            <span class="entypo-cancel">  
                                           </span>

                                        </a>
                                    </div>
                                </div>
                                <div class="value">
                                    <div id="">
                                        <span>
                                          <?php echo number_format((float)$avancement, 2, '.', '') . " %"; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>


                <!-- Debut RDV modal -->
                <div class="modal fade" id="rdvModal" tabindex="-1" role="dialog" aria-labelledby="modalDAjoutRDV" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalDAjoutRDV">Ajout de rendez-vous</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form id="saveRDVForm" action="fonctionnalites/ajout/ajouterRDV.php" method="POST">
                      <div class="modal-body" style="display: grid; place-items: center;">
                        <input type="hidden" id="typeRDV"     name="type" value="0">
                        <input type="hidden" id="indiceRDV"   name="prgRDV" value="1">
                        <input type="hidden" id="idCabRDV"    name="idCab" value="<?php echo $idCabinet;?>">
                        <input type="hidden" id="medecinRDV"  name="medecin" value="<?php echo $idMedecin;?>">
                        <input type="hidden" id="idPatienRDV" name="idPatien" value="<?php echo $idPatient;?>" required>
                        <input type="hidden" id="cabinetRDV"  name="nomCabinet" value="<?php echo $nomCabinet;?>">

                        <div id="espace_Recherche_Nom" style="width: 100%;"> 
                            <label class="control-label" for="nom">Nom et prénom Patient</label>
                            <div class="controls">
                                <input type="text" class="form-control" value="<?php echo $nomEtPrenomPatient;?>" disabled>
                            </div>
                        </div>

                        <div id="espaceChoixPatient">
                        </div>
                        
                        <br>
                        <br>

                        <div class="aParent" style="width: 100%">
                            <!--div style="width: 49%; margin-right: 2%;">
                                <label class="control-label" for="timeRDV">Heure Rendez-vous</label>
                                <br>
                                <input type="time" class="form-control" <?php //echo "value=\"".date("H:i")."\"";?> name="timeRDV" required>
                            </div-->

                            <div style="width: 48%; margin-right: 2%;">
                                <label class="control-label" for="dateRDV">Date Rendez-vous</label>
                                <br>
                                <input type="date" class="form-control" id="dateRDV" name="dateRDV" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>

                            <div style="width: 50%;">
                                <label class="control-label" for="heureRDV">Heure Rendez-vous</label>
                                <br>
                                <div id="selectSeance"></div>
                                <!--input type="date" class="form-control" id="heureRDV" name="heureRDV" value="<?php //echo date('Y-m-d'); ?>" required-->
                            </div>
                        </div>

                        <br><br><br>

                        <div id="espace_Recherche_Nom" style="width: 100%;"> 
                            <label class="control-label" for="nom">Mofit du rendez-vous</label>
                            <div class="controls textarea-container">
                                 <textarea style="width: 100%; height: 200px; padding-right: 60px;" id="motifCons" name="motifCons" placeholder=" Ecrivez ici ..."></textarea>
                                <button type="button" class="btn btn-warning" style="position: absolute;top: 0px;right: 0px;margin-top: 2px;margin-right: 2px;" onclick="copierMotif()">
                                        <span class="fontawesome-copy" title="Copier le texte"></span></button>
                                <br>
                                <!--button type="button" class="btn btn-success" style="position: absolute;bottom: 7px;right: 0px;margin-right: 2px;" onclick="collerMotif()">
                                        <span class="fontawesome-paste" title="Copier le texte"></span></button-->  
                            </div>
                              

                        </div>

                        <br>
                        <br>

                        <div id="espace_patient"></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-info" id="saveRDVBtn" onclick="saveRDV()">Enregistrer</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Fin RDV modal -->

                <!-- Debut Programmation modal -->
                <div class="modal fade" id="programation" tabindex="-1" role="dialog" aria-labelledby="modalProgrammation" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalProgrammation">Faire le programme patient <?php echo $idPatient;?></h5>
                      </div>
                      <form id="saveProgramForm" action="fonctionnalites/ajout/ajourProgramPatient.php" method="POST">
                      <div class="modal-body" style="display: grid; place-items: center;">
                        <input type="hidden" name="medecin" value="<?php echo $idMedecin; ?>">
                        <input type="hidden"  name="nomCabinet" value="<?php echo $nomCabinet;?>">
                        <input type="hidden" name="idPatien" value="<?php echo $idPatient;?>" required>

                        <div id="espace_Recherche_Nom" style="width: 100%;"> 
                            <?php getPatientComptePourPrgrm($nomCabinet,$idPatient);?>
                        </div>

                        
                        <br>
                        <br>


                        <div id="nbr_seance" style="width: 100%;"> 
                            <label class="control-label" for="nom">Nombre séances : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <select class="btn btn-success" name="nbrSeance" id="nbrSeance">
                                <option value="1">&nbsp;&nbsp;une séance&nbsp;&nbsp;&nbsp;</option>
                                <option value="2">2 séances</option>
                                <option value="3">3 séances</option>
                                <option value="4">4 séances</option>
                                <option value="5">5 séances</option>
                                <option value="6">6 séances</option>
                                <option value="7">7 séances</option>
                                <option value="8">8 séances</option>
                                <option value="9">9 séances</option>
                                <option value="10">10 séances</option>
                                <option value="11">11 séances</option>
                                <option value="12">12 séances</option>
                                <option value="13">13 séances</option>
                                <option value="14">14 séances</option>
                                <option value="15">15 séances</option>
                                <option value="16">16 séances</option>
                                <option value="17">17 séances</option>
                                <option value="18">18 séances</option>
                                <option value="19">19 séances</option>
                                <option value="20">20 séances</option>
                                <option value="21">21 séances</option>
                                <option value="22">22 séances</option>
                                <option value="23">23 séances</option>
                                <option value="24">24 séances</option>
                                <option value="25">25 séances</option>
                                <option value="26">26 séances</option>
                                <option value="27">27 séances</option>
                                <option value="28">28 séances</option>
                                <option value="29">29 séances</option>
                                <option value="30">30 séances</option>
                            </select>
                        </div>

                        <br>
                        <br>

                        <div id="nbr_seance" style="width: 100%;"> 
                            <label class="control-label" for="nom">Type des séances : &nbsp;&nbsp;&nbsp;&nbsp;</label>
                            <select class="btn btn-success" name="typeSeance" id="typeSeance">
                                <option value="simple">Séance simple</option>
                            </select>
                        </div>

                        <br>
                        <br>

                        <div id="espace_patient"></div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-info" id="saveRDVBtn" onclick="savePrgrm()">Enregistrer</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- Fin Programmation modal -->



                <button id="addRDVBtn" style="visibility: hidden;" data-toggle="modal" data-target="#rdvModal"></button>





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

            <?php //include("fragmentsPages/fragmentsDoc/menuSecondaire.php"); ?> 
                     
            
        
         

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
        var nomCabin  = "<?php echo $nomCabinet;?>";
    	var programme = <?php echo $programme;?>;
        var ceMomentH = "<?php echo date('H:i:s');?>";

        console.log("Program : " + programme);

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
                            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                        },

                        height: 800,
                        contentHeight: 780,
                        aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

                        nowIndicator: true,
                        now: TODAY + 'T' + ceMomentH, // just for demo

                        views: {
                            dayGridMonth: { buttonText: 'mois' },
                            timeGridWeek: { buttonText: 'semaine' },
                            timeGridDay: { buttonText: 'jour' },
                            listDay: { buttonText: 'liste' },
                            listWeek: { buttonText: 'liste' }
                        },

                        defaultView: 'listWeek',
                        defaultDate: TODAY,

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
                            var descrip   = info.event.extendedProps.description;
                            var splitDesc = descrip.split("<br>");
                            var idRDV     = splitDesc[0];
                            var motifUpd  = splitDesc[1];
                            var statutRDV = splitDesc[4];
                            var dateHeure = info.event.start;
                            var patient   = info.event.title;

                            motifUpd  = motifUpd.substr(23);
                            statutRDV = statutRDV.substr(8);

                            if (motifUpd =="" || motifUpd ==".") {
                            	motifUpd = "Aucun motif indiqué pour cette séance !"
                            }

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

							var dateRDV   = year + "-" + month + "-" + day;
							var heureDebu = h + ":" + m + ":" + s;

                            console.log("Id Rendez-vous: " + dateRDV);

                            document.getElementById("idRDVModif").value = idRDV;
                            document.getElementById("dateRDVModif").value = dateRDV;
                            document.getElementById("modifHeureRDV").value = heureDebu;
                            document.getElementById("motifConsModif").value = motifUpd;
                            document.getElementById("mailPhonePatientModif").value = patient;

                           
                            //document.getElementById('modifRDVBtn').click();

                            //update RDV stats
                            document.getElementById("idRDVStat").value = idRDV;
  
                            document.getElementById("patientPasser").innerHTML = patient;
                            document.getElementById("heurePasser").innerHTML = heureDebu;
                            document.getElementById("datePasser").innerHTML = dateRDV;
                            document.getElementById("motifPasser").innerHTML = motifUpd;


                            document.getElementById('passerRDVBtn').click();


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
                        },

                        dateClick: function(info) {

                            var dateSelected = info.dateStr;

                            if (dateSelected >=TODAY) {
                                document.getElementById("dateRDV").value = dateSelected;
                                getAvailibalSeances(nomCabin,dateSelected);

                            }else {
                                alert("Impossible de programmer des rendez-vous sur des dates passées !");
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


    <script type="text/javascript">
	    $('#datetimepicker1').datetimepicker({
	        language: 'pt-BR'
	    });
	    $('#dp1').datepicker()
	    $('#dpYears').datepicker();

	    $('#toggle-btn').click(function(e) {
	        e.stopPropagation();
	        $('#t2').clockface('toggle');
	    });
    </script>

    <script>  
         $(document).ready(function(){

              $('#mailPhonePatient').keyup(function(){  
              	   document.getElementById("saveRDVBtn").disabled = false;
                   $('#espaceChoixPatient').html('');

                   var NomPatient = $(this).val();

                   if (NomPatient =="") {
                   	$('#espaceChoixPatient').html('');
                   	document.getElementById("saveRDVBtn").disabled = false;
                   }

                   if (NomPatient != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/getPatientFromName.php",  
                          type:"GET",  
                          data:{NomPhonePatient: encodeURIComponent(NomPatient)},
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#espaceChoixPatient').append(data);

                               } else{
                                document.getElementById('espaceChoixPatient').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Pas de Patient de ces infos</div>";
                                document.getElementById("saveRDVBtn").disabled = false;
                               }
                          }  
                      });
                     }      
                }); 
              });                                      
    </script>

    <script>  
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
    </script>

    <script>
      function actualiserAvecID(ID,PatientName){

            $("#espaceChoixPatient").hide();

            document.getElementById("idPatien").value = ID;
            document.getElementById("mailPhonePatient").value = PatientName;

            document.getElementById("saveRDVBtn").disabled = false;
      }

      function actualiserAvecIDUpdate(ID,PatientName){

            $("#espaceChoixPatientModif").hide();

            document.getElementById("idPatienModif").value = ID;
            document.getElementById("mailPhonePatientModif").value = PatientName;

            document.getElementById("updateRDVBtn").disabled = false;
      }
    </script>

    <script>

    $(document).ready(function(){

        $("#dp").hide();
        $("#espace_patient").hide();
            $("#showRDV").click(function(){
              $("#dp").show();
            });
      });
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


    <script>
        
        function saveRDV(){
        	var idPatient  = "";
        	var nomPatient = "";
        	idPatient  = document.getElementById("idPatienRDV").value;
        	if (idPatient == "") {
        		alert("Veuillez d'abord sélectionner un patient !");
        	}else{
        		document.getElementById("saveRDVForm").submit();
        	}
        }


        function updateRDV(){
        	//var idPatient  = "";
        	//var nomPatient = "";
        	//idPatient  = document.getElementById("idPatienModif").value;
            //nomPatient = document.getElementById("mailPhonePatientModif").value;
        	//if (idPatient == "" || nomPatient == "") {
        	//	alert("Veuillez d'abord sélectionner un patient !");
        	//}else{
        		document.getElementById("modifRDVForm").submit();
        	//}
        }

        function savePrgrm(){
            //var idPatient  = "";
            //var nomPatient = "";
            //idPatient  = document.getElementById("idPatienModif").value;
            //nomPatient = document.getElementById("mailPhonePatientModif").value;
            //if (idPatient == "" || nomPatient == "") {
            //  alert("Veuillez d'abord sélectionner un patient !");
            //}else{
                
                document.getElementById("saveProgramForm").submit();
            //}
        }

        function updateRDVForPresence(){
        	//var idPatient  = "";
        	//var nomPatient = "";
        	//idPatient  = document.getElementById("idPatienModif").value;
            //nomPatient = document.getElementById("mailPhonePatientModif").value;
        	//if (idPatient == "" || nomPatient == "") {
        	//	alert("Veuillez d'abord sélectionner un patient !");
        	//}else{
        		document.getElementById("typeStat").value = 2;
        		document.getElementById("statRDVForm").submit();
        	//}
        }

        function updateRDVForDelete(){
        	//var idPatient  = "";
        	//var nomPatient = "";
        	//idPatient  = document.getElementById("idPatienModif").value;
            //nomPatient = document.getElementById("mailPhonePatientModif").value;
        	//if (idPatient == "" || nomPatient == "") {
        	//	alert("Veuillez d'abord sélectionner un patient !");
        	//}else{
        		
        		document.getElementById("typeStat").value = 3;
        		document.getElementById("statRDVForm").submit();
        	//}
        }

        function getAvailibalSeances(cabinet,dateSelected){

                $('#selectSeance').html('');

                if (cabinet != "" && dateSelected != ""){

                    $.ajax({
                      url:"getSeanceForRDV.php",  
                      type:"GET",
                      data:{nomCabinet: encodeURIComponent(cabinet),date: encodeURIComponent(dateSelected)},
                      success:function(data)  
                      {  
                           if (data != "") {
                                $('#selectSeance').append(data);

                                document.getElementById('addRDVBtn').click();

                           } else{
                                document.getElementById('espaceChoixPatient').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Pas de Séances programmées pour ce jour</div>";

                                document.getElementById('addRDVBtn').click();
                           }
                      }  
                  });
                } 
        }
    </script>
    
    <script> 

        function copierMotif() {

          var copyText = document.getElementById("motifCons");

          copyText.select();
          copyText.setSelectionRange(0, 99999); /* For mobile devices */

          navigator.clipboard.writeText(copyText.value);
        }

        function collerMotif() {

          //var copyText = document.getElementById("motifCons");

          //navigator.clipboard.readText().then(clipText => document.getElementById("motifCons").innerText = clipText);
        
          //alert("Copied the text: " + clipText);
        }

        function printData() {
               var divToPrint=document.getElementById("programPat");
               newWin= window.open("");
               newWin.document.write(divToPrint.outerHTML);
               newWin.print();
               newWin.close();
            }

        function PrintElem(){

                var nomCabinet  = "<?php echo $nomCabinet;?>";
                var nomPatient  = "<?php echo $nomPatient;?>";
                var agePatient  = "<?php echo $agePatient;?>";
                var prePatient  = "<?php echo $prePatient;?>";
                var dateDuJour  = "<?php echo $dateJour;?>";
                //var adresseCab  = "<?php echo $adresseCabinet;?>";
                var adresseCab  = "Bd Millénium, Arcade Ecobat Bloc I 1er étage | (Bir el Djir) - ORAN <br> TEL: 0554 938 566.  Email: nabilbouabdallah.nba@gmail.com";
                var programmeP  = document.getElementById("espace_impression_prgm").innerHTML;

                //var nomMedecinFR  = "<?php echo $nomMedecin;?>";
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



            function ImpressionDevis(){

                var programmeP  = document.getElementById("espace_impression_prgm").innerHTML;

                var mywindow = window.open('', 'PRINT', 'height=900,width=1200');

                mywindow.document.write('<html><head><title>' + document.title  + '</title>');
                mywindow.document.write('</head><body>');


                mywindow.document.write("<div style=\"margin: 5px; padding: 2px; flex-grow: 6;text-align: center;\">"+programmeP+"<div style=\"width:100%;position:absolute;bottom:0;left:0;padding-right:10px;padding-bottom:5px;padding-left:10px;\"><hr>"+adresseCab+"</div></div>");

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
