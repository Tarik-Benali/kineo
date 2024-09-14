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

            $programme = getRDVForAgenda($nomCabinet,$idMedecin); 

            $jourFerme = getNonOuvrableDays($nomCabinet); 

            $prixConsultation = getConsultationPrice($nomCabinet); 

            //  
            $nbrDesRDV   = nbrRDVTB($nomCabinet);
            
            $nbrAbsences = nbrAbsenceTB($nomCabinet);

            if ($nbrDesRDV == 0) {
                $pourcentageAbsences = 0;
            }else{
                $pourcentageAbsences = ($nbrAbsences * 100) / $nbrDesRDV;
            }

            

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




    <!--script src="https//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script-->

    <link rel="stylesheet" href="assets/js/cdnjs/bootstrap.min.css">


    <!--link rel="stylesheet" href="assets/js/datepicker/bootstrap-datetimepicker.css"-->

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="assets/calendar/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--begin::Global Theme Styles(used by all pages)-->



    <script src="assets/js/cdnjs/jquery.min.js"></script>
    <script src="assets/js/cdnjs/moment.min.js"></script>

    <link rel="stylesheet" href="assets/js/cdnjs/flatpickr.min.css">
    <!--script src="https://cdn.jsdelivr.net/npm/flatpickr"></script-->
    <script src="assets/js/cdnjs/flatpickr.js"></script>

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

            <div class="content-wrap">
                <div class="row">

                	<div class="col-sm-3">
                        <div class=" member" id="memberClose">
                            <div class="headline ">
                                <h3>
                                    <span>
                                        <i class=""></i> &#160;&#160;Rendez-Vous du jour&#160;&#160;&#160;   
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
                                <?php nbrRDVDuJour($nomCabinet); ?>
                            </div>
                            
                            <div class="progress-tinny">
                                <div style="width: 50%" class="bar"></div>
                            </div>

                            <div class="profit-line">
                                <a id="afficheAutresRDV">
                                        <span class="entypo-down-bold"> </span>
                                </a>
                            </div>
                                
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="order" id="orderClose">
                            <div class="headline ">
                                <h3>
                                    <span>
                                        <i class=""></i>&#160;&#160;Patient présent</span>
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
                                <?php nbrRDVDuJourEnPresent($nomCabinet); ?>
                            </div>
                            <div class="progress-tinny">
                                <div style="width: 10%" class="bar"></div>
                            </div>
                            <div class="profit-line">
                                <a id="afficheRDVEnLigne">
                                        <span class="entypo-down-bold"> </span>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="revenue" id="rendezVousPris">
                            <div class="headline ">
                                <h3>
                                    <span>
                                        <i class=""></i>&#160;&#160;Absences %&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;</span>
                                </h3>
                                <div class="titleClose">
                                    <a href="#rendezVousPris" class="gone">
                                        <span class="entypo-cancel">                                            
                                        </span>
                                    </a> 
                                </div>
                            </div>
                            <div class="value">
                                
                                <?php //nbrRDVDuJourEnSalle($nomCabinet);
                                      echo number_format((float)$pourcentageAbsences,1,'.','')  . "%";   ?>
                                        
                                
                            </div> 
                            <div class="profit-line">
                                <a id="afficheRDVPris">
                                        <span class="entypo-down-bold"> </span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">

                        <div class="profit" id="profitClose">
                            <div class="headline">
                                <h3>
                                    <span>
                                        <i class=""></i>&#160;&#160;Patients Absents</span>
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
                                      <?php nbrRDVDuJourAbsent($nomCabinet); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="profit-line">
                                <a id="afficheToutLesRDV">
                                        <span class="entypo-down-bold"> </span>
                                </a>
                            </div>
                        </div>
                    </div>

                    
                </div>
            </div>



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
                                    <div class="pull-left">
                                       <button id="addRDVBtn" class="btn btn-info" data-toggle="modal" data-target="#rdvModal">&nbsp;&nbsp;Ajout de Rendez-vous&nbsp;&nbsp;</button>
                                    </div>

                                    <div class="pull-right">
                                        <select class="form-control" name="signalisation_patient" id="signalisation_patient">
                                            <option value="all">Tous</option>
                                            <option value="risque">Patient à risque</option>
                                            <option value="non_risque">Patient à aucun prisque</option>
                                        </select>
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

                </div>



                <button id="passerRDVBtn" style="visibility: hidden;" data-toggle="modal" data-target="#passerModal"></button>


                <!-- Debut RDV modal -->
				<div class="modal fade" id="rdvModal" tabindex="-1" role="dialog" aria-labelledby="modalDAjoutRDV" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="modalDAjoutRDV">Ajout de rendez-vous</h5>
				      </div>
				      <form id="saveRDVForm" action="fonctionnalites/ajout/ajouterRDV.php" method="POST">
				      <div class="modal-body" style="display: grid; place-items: center;">
                        <input type="hidden" id="type"     name="type" value="0">
                        <input type="hidden" id="idCab"    name="idCab" value="<?php echo $idCabinet; ?>">
                        <input type="hidden" id="medecin"  name="medecin" value="<?php echo $idMedecin; ?>">
                        <input type="hidden" id="cabinet"  name="nomCabinet" value="<?php echo $nomCabinet;?>">
                        <input type="hidden" id="idPatien" name="idPatien" placeholder="Id Patient" required>

                        <div id="espace_Recherche_Nom" style="width: 100%;"> 
                            <label class="control-label" for="nom">Recherche par Nom / Mail ou Téléphone</label>
                            <div class="controls">
                                <input type="text" name="mailPhonePatient" class="form-control" id="mailPhonePatient">
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
                        		<label class="control-label" for="dateRDV">Heure Rendez-vous</label>
                        		<br>
                                <div id="selectSeance" style="width: 100%;"></div>
                                <!--input type="date" class="form-control" id="dateRDV" name="dateRDV" value="<?php //echo date('Y-m-d'); ?>" required-->
                            </div>
                        </div>

                        <br><br><br>

                        <div id="espace_Recherche_Nom" style="width: 100%;"> 
                            <label class="control-label" for="nom">Mofit du rendez-vous</label>
                            <div class="controls">
                                 <textarea style="width: 100%; height: 200px" id="motifCons" name="motifCons" placeholder="  Ecrivez ici ..."></textarea>
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


				<!-- Debut Update RDV modal -->
				<div class="modal fade" id="modifModal" tabindex="-1" role="dialog" aria-labelledby="modalModifRDV" aria-hidden="true">
				  <div class="modal-dialog modal-lg" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="modalModifRDV">Modification rendez-vous</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <form id="modifRDVForm" action="fonctionnalites/mod/modRDV.php" method="POST">
				      <div class="modal-body">
                        <input type="hidden" id="typeModif"     name="type" value="0">
                        <input type="hidden" id="typeModifR"    name="typeModif" value="1">
                        <input type="hidden" id="idRDVModif"    name="idRDVModif" value="">
                        <input type="hidden" id="idCabModif"    name="idCab" value="<?php echo $idCabinet; ?>">
                        <input type="hidden" id="medecinModif"  name="medecin" value="<?php echo $idMedecin; ?>">
                        <input type="hidden" id="cabinetModif"  name="nomCabinet" value="<?php echo $nomCabinet;?>">
                        <input type="hidden" id="idPatienModif" name="idPatien" placeholder="Id Patient" required>

                        <div id="espace_Recherche_Nom" style="width: 62%; margin-right: 15px;"> 
                            <label class="control-label" for="nom">Recherche par Nom / Mail ou Téléphone</label>
                            <div class="controls">
                                <input type="text" name="mailPhonePatient" class="form-control" id="mailPhonePatientModif">
                            </div>
                        </div>

                        <div id="espaceChoixPatientModif">
                        </div>
                        
                        <br>
                        <br>

                        <div class="aParent">
                            <div style="width: 30%; margin-right: 2%;">
                                <label class="control-label" for="dateRDV">Date Rendez-vous</label>
                                <br>
                                <input type="date" class="form-control" id="dateRDVModif" name="dateRDV" value="<?php echo date('Y-m-d'); ?>" onchange="getAvailibalSeancesForUpdate()" required>
                            </div>

                        	<div style="width: 30%; margin-right: 2%;">
                        		<label class="control-label" for="dateRDV">Seances disponibles</label>
                                <br>
                                <div id="seancesDispo"></div>
                            </div>

                            
                        </div>

                        <br><br><br>
                        <br><br>

                        <div id="espace_Recherche_NomModif" style="width: 62%; margin-right: 15px;"> 
                            <label class="control-label" for="nom">Mofit du rendez-vous</label>
                            <div class="controls">
                                 <textarea style="width: 100%; height: 200px" id="motifConsModif" name="motifCons" placeholder=" Ecrivez ici ..."></textarea>
                            </div>
                        </div>

                        <br>
                        <br>

                        <div id="espace_patientModif"></div>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
				        <button type="button" class="btn btn-info" id="updateRDVBtn" onclick="updateRDV()">Modifier</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>
				<!-- Fin Update RDV modal -->


				<!-- Debut Passer Patient modal -->
				<div class="modal fade" id="passerModal" tabindex="-1" role="dialog" aria-labelledby="modalPasserRDV" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="modalPasserRDV">Rendez-vous patient</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <form id="statRDVForm" action="fonctionnalites/mod/modRDV.php" method="POST">
				      <div class="modal-body">
                        <input type="hidden" id="typeStat"     name="typeModif" value="0">
                        <input type="hidden" id="idRDVStat"    name="idRDVStats" value="">
                        <input type="hidden" id="cabinetStat"  name="nomCabinet" value="<?php echo $nomCabinet;?>">


                        <br>
                        <dl class="dl-horizontal-profile">
                            <dt>Patient</dt>
                            <dd id="patientPasser"></dd>

                            <dt>Heure</dt>
                            <dd>
                            	<span class="tags" id="heurePasser"></span>
                            </dd>

                            <dt>Date</dt>
                            <dd id="datePasser"></dd>

                            <dt>Motif</dt>
                            <dd id="motifPasser"></dd>

                            <dt>Présence</dt>

                            <?php //updateRDVStats();?> 
                            <dd id="presencePasser">
	                            	<select class="btn btn-default" name="etatRDV" id="etatRDV">
                                        <option value="6">Non Confirmé</option>
									    <option value="5">Confirmé</option>
                                        <option value="0">Absent</option>
									    <option value="1">Présent</option>
									    <option value="2">En salle</option>
									    <option value="3">Terminé</option>
									</select>
	                            	<button id="confirmeBtn" type="button" class="btn btn-default" onclick="updateRDVForPresence()">
	                                    <span class="entypo-check"></span>&nbsp;&nbsp;Valider</button>
                            </dd>

                            <dt>Options</dt>
                            <dd id="optionPasser">
                                <button type="button" class="btn btn-info" data-dismiss="modal" data-toggle="modal" data-target="#modifModal" onclick="getAvailibalSeancesForUpdate()">
                                    <span class="entypo-feather"></span>&nbsp;&nbsp;Modifier</button>
                                <button type="button" class="btn btn-danger" onclick="updateRDVForDelete()">
                                    <span class="entypo-trash"></span>&nbsp;&nbsp;Supprimer</button>
                            </dd>
                            <div id="divClo">
                                <dt id="textClo">Clôturer la séance</dt>
                                <dd id="cloBtn">
                                    <button type="button" class="btn btn-success" data-dismiss="modal" onclick="showFinModal()">
                                        <span class="entypo-feather"></span>&nbsp;&nbsp;Clôturer</button>
                                </dd>
                            </div>    
                        </dl>
                        <br>

                        
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
				      </div>
				      </form>
				    </div>
				  </div>
				</div>
				<!-- Fin Passer Patient modal -->

<!------------------------------------------------------------- Debut modal Fin seance-------------------------------------------------------->
                <div class="modal fade" id="finSeance" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalProgSeance">Seance terminer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form id="cloSeance" action="fonctionnalites/mod/cloturerseanceP.php" method="POST">
                      <div class="modal-body" style="display: grid; place-items: center;">
                        <input type="hidden" id="idCab"    name="idCab" value="<?php echo $idCabinet; ?>">
                        <input type="hidden" id="medecin"  name="medecin" value="<?php echo $idMedecin; ?>">
                        <input type="hidden" id="cabinet"  name="nomCabinet" value="<?php echo $nomCabinet;?>">

                        <input type="hidden" id="idRDV"     name="idRDV">
                        <input type="hidden" id="idPat"     name="idPat">
                        <input type="hidden" id="idSeance"  name="idSeance">
                        <input type="hidden" id="patInfos"  name="patientInfo">
                        <input type="hidden" id="remqSean"  name="remarqueseance">
                        <input type="hidden" id="dateSean"  name="dateSeanceCloture" required>

                        <h5 id="textModal"></h5>

                        <br>
                        <br>

                        <div style="width: 100%;"> 
                            <label class="control-label" for="nom">Prix consultation</label>
                            <div class="controls">
                                 <input class="form-control" type="number" id="addition" name="addition" value="<?php echo $prixConsultation;?>" required>
                            </div>
                        </div>

                        <br>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-info">Clôturer</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>

                <button id="showClotuerSeanceModal" type="hidden" style="visibility: hidden;" data-toggle="modal" data-target="#finSeance"></button>
                

<!--------------------------------------------------------------- Fin modal Fin seance ------------------------------------------------------------->

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
        var jourFerme = <?php echo $jourFerme;?>;
        var ceMomentH = "<?php echo date('H:i:s');?>";

        $(document).ready(function(){
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

                                
                                var descrip   = info.event.extendedProps.description;
                                var splitDesc = descrip.split("<br>");
                                var idRDV     = splitDesc[0];
                                var motifUpd  = splitDesc[1];
                                var statutRDV = splitDesc[4];
                                var idPatienz = splitDesc[5];
                                var dateHeure = info.event.start;
                                var patient   = info.event.title;

                                motifUpd  = motifUpd.substr(23);
                                statutRDV = statutRDV.substr(8);
                                idPatienz = idPatienz.substr(12);

                                //console.log("rrrrrrrrrr" + splitDesc + " || " + descrip);

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
                                var dateComp  = month + "/" + day + "/" + year;
                                var heureDebu = h + ":" + m + ":" + s;

                                //console.log("Rendez-vous: ********* " + dateRDV);

                                //if (dateRDV >=TODAY) {

                                document.getElementById("idRDVModif").value = idRDV;
                                document.getElementById("dateRDVModif").value = dateRDV;
                                //document.getElementById("modifHeureRDV").value = heureDebu;
                                document.getElementById("motifConsModif").value = motifUpd;
                                document.getElementById("mailPhonePatientModif").value = patient;

                                document.getElementById("patInfos").value = patient;

                               
                                //document.getElementById('modifRDVBtn').click();

                                //update RDV stats
                                document.getElementById("idRDVStat").value = idRDV;
      
                                document.getElementById("patientPasser").innerHTML = patient;
                                document.getElementById("heurePasser").innerHTML = heureDebu;
                                document.getElementById("datePasser").innerHTML = dateRDV;
                                document.getElementById("motifPasser").innerHTML = motifUpd.replace("`","'");


                                // Create date from input value
                                var inputDate = new Date(dateComp);

                                // Get today's date
                                var todaysDate = new Date();

                                //console.log(inputDate.setHours(0,0,0,0) +"||"+ todaysDate.setHours(0,0,0,0));

                                // call setHours to take the time out of the comparison
                                if(inputDate.setHours(0,0,0,0) == todaysDate.setHours(0,0,0,0)) {
                                    //console.log(todaysDate);
                                    document.getElementById('cloBtn').style.visibility = 'visible';
                                    document.getElementById('textClo').style.visibility = 'visible';
                                }else{
                                    //document.getElementById('cloBtn').style.visibility = 'hidden';
                                    //document.getElementById('textClo').style.visibility = 'hidden';
                                    //console.log(todaysDate + " | " + inputDate);
                                }

                                

                                switch(statutRDV) {
                                      case 0:
                                            document.getElementById("etatRDV").value="0";
                                            document.getElementById("etatRDV").className = "btn btn-danger";
                                            document.getElementById("confirmeBtn").className = "btn btn-danger";
                                        break;
                                      case 1:
                                            document.getElementById("etatRDV").value="1";
                                            document.getElementById("etatRDV").className = "btn btn-info";
                                            document.getElementById("confirmeBtn").className = "btn btn-info";
                                        break;
                                      case 2:
                                            document.getElementById("etatRDV").value="2";
                                            document.getElementById("etatRDV").className = "btn btn-warning";
                                            document.getElementById("confirmeBtn").className = "btn btn-warning";
                                        break;
                                      case 3:
                                            document.getElementById("etatRDV").value="3";
                                            document.getElementById("etatRDV").className = "btn btn-success";
                                            document.getElementById("confirmeBtn").className = "btn btn-success";

                                            document.getElementById("cloBtn").style.visibility = 'hidden';
                                            document.getElementById("textClo").style.visibility = 'hidden';
                                            document.getElementById("divClo").style.visibility = 'hidden';
                                        break;
                                      case 4:
                                            document.getElementById("etatRDV").value="4";
                                            document.getElementById("etatRDV").style.visibility = 'hidden';
                                            document.getElementById("confirmeBtn").style.visibility = 'hidden';

                                            document.getElementById("cloBtn").style.visibility = 'hidden';
                                            document.getElementById("textClo").style.visibility = 'hidden';
                                            document.getElementById("divClo").style.visibility = 'hidden';
                                        break;
                                      case 5:
                                            document.getElementById("etatRDV").value="5";
                                            document.getElementById("etatRDV").className = "btn btn-primary";
                                            document.getElementById("confirmeBtn").className = "btn btn-primary";
                                        break; 
                                      case 6:
                                            document.getElementById("etatRDV").value="6";
                                            document.getElementById("etatRDV").className = "btn btn-default";
                                            document.getElementById("confirmeBtn").className = "btn btn-default";
                                        break;  
                                      case ': 0':
                                            document.getElementById("etatRDV").value="0";
                                            document.getElementById("etatRDV").className = "btn btn-danger";
                                            document.getElementById("confirmeBtn").className = "btn btn-danger";
                                        break;
                                      case ': 1':
                                            document.getElementById("etatRDV").value="1";
                                            document.getElementById("etatRDV").className = "btn btn-info";
                                            document.getElementById("confirmeBtn").className = "btn btn-info";
                                        break;
                                      case ': 2':
                                            document.getElementById("etatRDV").value="2";
                                            document.getElementById("etatRDV").className = "btn btn-warning";
                                            document.getElementById("confirmeBtn").className = "btn btn-warning";
                                        break;
                                      case ': 3':
                                            document.getElementById("etatRDV").value="3";
                                            document.getElementById("etatRDV").className = "btn btn-success";
                                            document.getElementById("confirmeBtn").className = "btn btn-success";

                                            document.getElementById("cloBtn").style.visibility = 'hidden';
                                            document.getElementById("textClo").style.visibility = 'hidden';
                                            document.getElementById("divClo").style.visibility = 'hidden';
                                        break;
                                      case ': 4':
                                            document.getElementById("etatRDV").value="4";
                                            document.getElementById("etatRDV").style.visibility = 'hidden';
                                            document.getElementById("confirmeBtn").style.visibility = 'hidden';

                                            document.getElementById("cloBtn").style.visibility = 'hidden';
                                            document.getElementById("textClo").style.visibility = 'hidden';                                       
                                            document.getElementById("divClo").style.visibility = 'hidden';
                                        break;  
                                      case ': 5':
                                            document.getElementById("etatRDV").value="5";
                                            document.getElementById("etatRDV").className = "btn btn-primary";
                                            document.getElementById("confirmeBtn").className = "btn btn-primary";
                                        break;   
                                      case ': 6':
                                            document.getElementById("etatRDV").value="6";
                                            document.getElementById("etatRDV").className = "btn btn-default";
                                            document.getElementById("confirmeBtn").className = "btn btn-default";
                                        break;  
                                    }

                                document.getElementById("idPatienModif").value = idPatienz;

                                document.getElementById("dateSean").value = dateRDV; 
                                //alert("Date : " + dateRDV);

                                document.getElementById('passerRDVBtn').click();

                                fin(patient,'-',idPatienz,'0',idRDV,'Aucune_remarque');
                                
                                
                                //}

                                                            


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

                                return ['all', info.event.extendedProps.filtre].indexOf($('#signalisation_patient').val()) >= 0
                            },

                            dateClick: function(info) {
                            	var dateSelected = info.dateStr;

                                if (dateSelected >=TODAY) {
                                    document.getElementById("dateRDV").value = dateSelected;
                                    getAvailibalSeances(nomCabin,dateSelected);
                                }else {
                                    alert("Impossible d'ajouter un rendez-vous dans une date passée !");
                                }
    						}

                            
                        });
                        calendar.render();

                        $('#signalisation_patient').on('change',function(){
                            //console.log("$$$$" + this.value);
                            calendar.rerenderEvents();
                        });
                    }
                };
            }();

            jQuery(document).ready(function() {
                KTCalendarBasic.init();
            });           
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
                          data:{NomPhonePatient: NomPatient},
                          success:function(data)  
                          {
                            //console.log(NomPatient);  
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
                          data:{NomPhonePatient: NomPatient,Type: "update"},
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

            if (ID != "" && ID != null) {
                $("#espaceChoixPatientModif").hide();

                document.getElementById("idPatienModif").value = ID;
                document.getElementById("mailPhonePatientModif").value = PatientName;

                document.getElementById("updateRDVBtn").disabled = false;
            }    
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
        	idPatient  = document.getElementById("idPatien").value;
            nomPatient = document.getElementById("mailPhonePatient").value;
        	if (idPatient == "" || nomPatient == "" || idPatient == null || nomPatient == null) {
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
            //  alert("Veuillez d'abord sélectionner un patient !");
            //}else{
                
                document.getElementById("typeStat").value = 3;
                document.getElementById("statRDVForm").submit();
            //}
        }


        function updateRDVForDelete(){
            //var idPatient  = "";
            //var nomPatient = "";
            //idPatient  = document.getElementById("idPatienModif").value;
            //nomPatient = document.getElementById("mailPhonePatientModif").value;
            //if (idPatient == "" || nomPatient == "") {
            //  alert("Veuillez d'abord sélectionner un patient !");
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
                                document.getElementById('espaceChoixPatient').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Aller à agendat pour programmer des séances</div>";

                                document.getElementById('addRDVBtn').click();
                           }
                      }  
                  });
                } 
        }    

        function getAvailibalSeancesForUpdate(){

                $('#seancesDispo').html('');

                var cabinet      = "<?php echo $nomCabinet;?>";
                var dateSelected = document.getElementById("dateRDVModif").value;

                if (cabinet != "" && dateSelected != ""){

                    $.ajax({
                      url:"getSeanceForRDV.php",  
                      type:"GET",
                      data:{nomCabinet: encodeURIComponent(cabinet),date: encodeURIComponent(dateSelected)},
                      success:function(data)  
                      {  
                           if (data != "") {
                                $('#seancesDispo').append(data);

                                //document.getElementById('modbtn').click();

                           } else{
                                document.getElementById('seancesDispo').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Aller à agendat pour programmer des séances</div>";

                                //document.getElementById('modbtn').click();
                           }
                      }  
                  });
                } 
        }

        function fin(nom,prenom,idPatient,idSean,idRdv,remqID){

            //var nomPrenom = nom + " " + prenom;
            var nomPrenom = nom;
            
            var Remrq     = remqID;
            var textMod   = "Êtes vous sûr de vouloir cloturer la seance pour <b>" + nomPrenom + " ?</b>";
            
            document.getElementById('idRDV').value = idRdv;
            document.getElementById('idPat').value = idPatient;
            document.getElementById('idSeance').value = idSean;  
            document.getElementById('remqSean').value = Remrq;
            document.getElementById('textModal').innerHTML = textMod;
            
        }

        function showFinModal(){
            document.getElementById('showClotuerSeanceModal').click();
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
