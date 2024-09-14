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

            $idSeance = "";

            if (isset($_REQUEST['idSeance'])) {
                $idSeance = $_REQUEST['idSeance'];
            }else{
                $idSeance = "0";
            }

            $nomMedecin = getMedecinName($idMedecin); 

            $heureDebut = getSeanceBeginTime($nomCabinet,$idSeance); 

            $prixConsultation = getConsultationPrice($nomCabinet); 

            // 

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


    <link href="assets/js/textEditor/editor.css" rel="stylesheet">
    <link href="assets/js/textEditor/sceditor/minified/themes/square.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/js/textEditor/src/bootstrap-wysihtml5.css" />

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
                <li><a href="#" title="Sample page 1">Séance </a>
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
            <div class="content-wrap">
                <div class="row">
                    <br><br>
                    <div class="col-sm-6">
                        <div class=" member" id="memberClose">
                            <div class="headline ">
                                <h3>
                                    <span>
                                        <i class=""></i> &#160;&#160;Patients présents&#160;&#160;&#160;   
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
                                <?php nbrPatientPresentEnSalle($nomCabinet); ?>
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

                    <div class="col-sm-6">
                        <div class="order" id="orderClose">
                            <div class="headline ">
                                <h3>
                                    <span>
                                        <i class=""></i>&#160;&#160;Patients Abesnts</span>
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
                                <?php nbrPatientAbsent($nomCabinet); ?>
                            </div>
                            <div class="profit-line">
                                <a id="afficheRDVEnLigne">
                                        <span class="entypo-down-bold"> </span>
                                </a>
                            </div>
                        </div>
                    </div>

                    

                </div>
            </div>

            <?php getPatientsDansSéance($nomCabinet,$idSeance)?>  


            <br><br>
            <!--a href="<?php// echo "fonctionnalites/mod/modSeance.php?etatSeance=2&idSeance=".$idSeance."&nomCabinet=".$nomCabinet;?>" style="color: inherit;">
                <input class="btn btn-warning pull-right" style="margin-right: 30px;" value="Clôturer la séance"/--> 
            </a>     


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
                        <input type="hidden" id="remqSean"  name="remarqueseance">

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

        function updateRDV(){
        	//var idPatient  = "";
        	//var nomPatient = "";
        	//idPatient  = document.getElementById("idPatienModif").value;
            //nomPatient = document.getElementById("mailPhonePatientModif").value;
        	//if (idPatient == "" || nomPatient == "") {
        	//	alert("Veuillez d'abord sélectionner un patient !");
        	//}else{
        		//document.getElementById("modifRDVForm").submit();
        	//}
        }

        $(document).ready(function(){

            /*var debutSeance = "<?php //echo $heureDebut;?>";
            var spli = debutSeance.split(":");

            var hD = spli[0];
            var mD = spli[1];
            var sD = spli[2];

            setInterval(function(){ 
                var dateHeure = new Date();



                var h = dateHeure.getHours();
                var m = dateHeure.getMinutes();
                var s = dateHeure.getSeconds();

                var ss = s - sD;
                var mm = m - mD;
                var hh = h - hD;

                if (hh < 10) {hh = "0"+ hh}
                if (mm < 10) {mm = "0"+ mm}
                if (ss < 10) {ss = "0"+ ss}

                if (hh == 0) {
                    document.getElementById("timer").innerHTML = mm + " : " + ss;
                    //console.log(mm + ":" + ss);
                }else{
                    document.getElementById("timer").innerHTML = hh + " : " + mm + " : " + ss;
                    //console.log(hh + ":" + mm + ":" + ss);
                }    
                



            }, 1000);*/

     
        });

        function fin(nom,prenom,idPatient,idSean,idRdv,remqID){

            var nomPrenom = nom + " " + prenom;
            
            var Remrq     = document.getElementById(remqID).value;
            var textMod   = "Êtes vous sûr de vouloir cloturer la seance pour <b>" + nomPrenom + " ?</b>";
            
            document.getElementById('idRDV').value = idRdv;
            document.getElementById('idPat').value = idPatient;
            document.getElementById('idSeance').value = idSean;  
            document.getElementById('remqSean').value = Remrq;
            document.getElementById('textModal').innerHTML = textMod;
            

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
