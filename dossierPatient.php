<?php
    include("auth/auth.php");
    include("includes/historique.php");
    include("includes/functions.php");

    if (isset($_SESSION['idDeCeCabinet'])) {

    $idCabinet        = $_SESSION['idDeCeCabinet'];

    $nomCabinet       = $_SESSION['nomDeCeCabinet'];

    $adresseCabinet   = $_SESSION['adresseDeCeCabinet'];

    $idMedCab         = $_SESSION['idDeCeMedCab'];

    $idMedecin        = $_SESSION['idDeCeMedecin'];

    $Medecin          = $_SESSION['username'];
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

    <link rel="stylesheet" href="assets/js/timepicker/bootstrap-timepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/datepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/clockface.css">

    <link rel="stylesheet" type="text/css" href="assets/js/tag/jquery.tagsinput.css">

    <link href="assets/js/textEditor/editor.css" rel="stylesheet">
    <link href="assets/js/textEditor/sceditor/minified/themes/square.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/js/textEditor/src/bootstrap-wysihtml5.css" />

    <link rel="shortcut icon" href="assets/ico/minus.png">

    <link rel="stylesheet" href="assets/css/social.css">

    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>








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

    <?php include("fragmentsPages/barDeNavigation.php"); ?>         


    <!-- /END OF TOP NAVBAR -->

    <!-- SIDE MENU -->
    <!-- SIDE MENU -->

    <?php include("fragmentsPages/menuPrincipal.php"); ?> 
     

    <!-- END OF SIDE MENU -->
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
                <li><a href="#" title="Sample page 1">Patient</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Dossier Patient</a>
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
                        <div class="nest" id="headerClose">
                            <div class="title-alt">
                                <h6>
                                    Recherche dossier patient</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#headerClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#header">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>




                            <div class="body-nest" id="header">
                                <div class="container">   
                                           <div class="table-responsive">  
                                                    <div class="form_center">
                                                        <div class="control-group">
                                                              <div id="espace_Recherche_ID">
                                                                  <label class="control-label" for="nom">Identifiant du Patient</label>
                                                                  <div class="controls">
                                                                      <input type="text" name="identifiantPatient" class="form-control" id="afficherPatient">
                           
                                                                  </div>
                                                              </div>

                                                              <div id="espace_Recherche_Nom">
                                                                  <label class="control-label" for="nom">Recherche par nom / mail / téléphone</label>
                                                                  <div class="controls">
                                                                      <input type="text" name="mailPhonePatient" class="form-control" id="mailPhonePatient">
                           
                                                                  </div>
                                                              </div>

                                                              <div id="espaceChoixPatient">
                                                              </div>
                                                              
                                                              <a id="a_recherche_nom" href="#">Recherche par nom/email/téléphone</a>
                                                              <a id="a_recherche_ide" href="#">Recherche par Identifiant</a>
                                                            <br>

                                                            <input type="hidden" name="filtre" class="form-control" value="monCabinet">
  
                                                            <br>
                                                            <button type="button" onclick="sendTypeFiltreAndGetPatientData()" name="importer" id="showPatient" class="btn btn-info">Importer</button>
                                                        </div>

                                                    </div>
                                          </div>           
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-wrap" id="infoPatient">
                <div class="row">

                    <div class="col-sm-12">

                        <div class="nest" id="tablePatientClose">
                            <div class="title-alt">
                                <h6>
                                    Informations du patient</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tablePatientClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#tablePatient">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="tablePatient">
                                    <div id="espacePourInfoPatient">
                                    </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>

            <div class="container">
                <div class="modal fade"  id="po" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content" id="espacePopCons">
                              
                                                    
                        </div>                                           
                      </div>
                 </div>
            </div>                                         
                                                

            <div class="content-wrap" id="hisPatDoss">
                <div class="row">

                    <div class="col-sm-12">

                        <div class="nest" id="tablePatientClosess">
                            <div class="title-alt">
                                <h6>
                                    Historique du patient au sein du cabinet</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tablePatientClosess">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#tablePatientss">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="tablePatientss">
                                    <div id="espacePourDossierPatient">
                                    </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>

            <div class="content-wrap" id="documentsPatDoss">
                <div class="row">

                    <div class="col-sm-12">

                        <div class="nest" id="tablePatientClosess">
                            <div class="title-alt">
                                <h6>
                                    Documents du patient</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tablePatientClosess">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#tablePatientss">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="tablePatientss">
                                <div id="espacePourDocumentPatient">
                                </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>

            <div class="container">

                                      <div class="modal fade\" id="updateemplac" role="dialog">
                                        <div class="modal-dialog">
                                        

                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                              <h4 class="modal-title">Modification d'emplacement de fiche patient</h4>
                                            </div>

                                            <div class="modal-body">

                      <form action="fonctionnalites/mod/updateemplacementfichepatient.php" id="empFP" class="form-container">
                            <fieldset>

                              <div class="form-group">

                                      <div id="getEmplacementFichePatientBoiteArmoire">
                                        
                                      </div>

                                      
                          
                                              </div>
                                            
                                              <ul id="breadcrumb">
                                                <li>
                                                  <a href="#">Voulez-vous modifier l'emplacement de la fiche patient ?</a>
                                                </li>
                                               
                                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal" style="margin-right:10px;margin-bottom:10px;"> Annuler</button>
                                                <button type="submit" form="empFP" class="btn btn-warning pull-right" style="margin-right:10px;margin-bottom:10px;" > <span class="entypo-pencil"></span>&nbsp;&nbsp;Modifier </button>

                                                </div>                                   

                                              </fieldset>                    
                      </form>
                                              </ul>
                                          </div>                                           

                                          
                                        </div>
                                      </div>
                                      
                  </div>


                   <?php include("fragmentsPages/footer.php"); ?>   

        </div>
    </div>

    <!--  END OF PAPER WRAP -->
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


    <script>  
      function sendTypeFiltreAndGetPatientData(){
         $(document).ready(function(){

          
                  var strUser = "monCabinet";


                  //$('#afficherPatient').keyup(function(){  
                   $('#espacePourInfoPatient').html('');

                   var Patient = $("#afficherPatient"). val();
                   var NomCabinet = "<?php echo $nomCabinet;?>"; 

                    //document.getElementById('test').innerHTML = "<h1>"+Patient+"</h1>"

                    //Form pour récupérer les infos du pation
                    if (Patient != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/afficherUnPatientPourDossier.php",  
                          type:"GET",  
                          data:{Identifiant: encodeURIComponent(Patient), nomCabinet: NomCabinet, optionFiltre: strUser}, 
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#espacePourInfoPatient').append(data);

                                getEmplacementFichePatientBoiArm(Patient, NomCabinet);
                                getDocumentsPatient(Patient, NomCabinet);

                               } else{
                                document.getElementById('espacePourInfoPatient').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Faut Identifiant</div>"
                               }
                          }  
                      });
                    }

                    //Form pour dossier patient 'toute ses consultations'

                    $('#espacePourDossierPatient').html('');

                     if (Patient != ""){

                        $.ajax({
                            url:"fonctionnalites/affichage/afficherDossierPatient.php",  
                            type:"GET",  
                            data:{Identifiant: encodeURIComponent(Patient), nomCabinet: NomCabinet, optionFiltre: strUser},  
                            success:function(data)  
                            {  
                                 if (data != "") {
                                  $('#espacePourDossierPatient').append(data);
                                 } else{
                                  document.getElementById('espacePourDossierPatient').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Faut Identifiant</div>"
                                 }
                            }  
                        });
                       }      
                //}); 
              });
        }                                       
    </script>

    <script>  
      function sendIdConsPourDétails(Patient, NomCabinet, idConsul){
         $(document).ready(function(){

                   $('#espacePopCons').html('');

                   console.log(Patient);

                   if (Patient != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/afficherPopCons.php",  
                          type:"GET",  
                          data:{Identifiant: Patient, nomCabinet: NomCabinet, IdConsul: idConsul}, 
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#espacePopCons').append(data);
                               } else{
                                document.getElementById('espacePopCons').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Faut Identifiant</div>"
                               }
                          }  
                      });
                     }
                 
              });
        }                                       
    </script>

    <script>  
      function sendIdConsPourOrdon(Patient, NomCabinet, idConsul){
         $(document).ready(function(){

                   $('#espacePopCons').html('');

                   if (Patient != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/afficherPopOrd.php",  
                          type:"GET",  
                          data:{Identifiant: Patient, nomCabinet: NomCabinet, IdConsul: idConsul}, 
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#espacePopCons').append(data);
                               } else{
                                document.getElementById('espacePopCons').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Faut Identifiant</div>"
                               }
                          }  
                      });
                     }
                 
              });
        }                                       
    </script>

    <script>  
      function getEmplacementFichePatientBoiArm(Patient, NomCabinet){
         $(document).ready(function(){

                   $('#getEmplacementFichePatientBoiteArmoire').html('');

                   if (Patient != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/getEmplacementFichePatient.php",  
                          type:"GET",  
                          data:{identifiant: Patient, nomCabinet: NomCabinet}, 
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#getEmplacementFichePatientBoiteArmoire').append(data);
                               } else{
                                document.getElementById('getEmplacementFichePatientBoiteArmoire').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Faut Identifiant</div>"
                               }
                          }  
                      });
                     }
                 
              });
        }


      function getRapportMedical(Patient, idCons){

           $(document).ready(function(){

                   $('#espacePopCons').html('');

                   if (Patient != "" && idCons != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/afficherRappMedic.php",  
                          type:"GET",  
                          data:{Identifiant: Patient, IdConsul: idCons}, 
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#espacePopCons').append(data);
                               } else{
                                document.getElementById('espacePopCons').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Faut Identifiant</div>"
                               }
                          }  
                      });
                     }
                 
              });
        } 


        function getDocumentsPatient(Patient, NomCabinet){
         $(document).ready(function(){

                   $('#espacePourDocumentPatient').html('');

                   if (Patient != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/getDocumentPatient.php",  
                          type:"GET",  
                          data:{identifiant: Patient, nomCabinet: NomCabinet}, 
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#espacePourDocumentPatient').append(data);
                               } else{
                                document.getElementById('espacePourDocumentPatient').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Aucun document sauvgardé dans le dossier de ce patient.</div>"
                               }
                          }  
                      });
                     }
                 
              });
        } 

                                             
    </script>

    <script src="assets/js/recherchePatient.js"></script>
    <script>
         $(document).ready(function(){

              // Recherche de patient : le dossier s'ouvre dès que le patient est choisi
              RecherchePatient.attacher({
                  champ   : '#mailPhonePatient',
                  champId : '#afficherPatient',
                  url     : 'fonctionnalites/affichage/rechercherPatients.php',
                  surSelection : function () {
                      $('#showPatient').click();
                  }
              });

         });

         // Curseur directement dans la recherche une fois la page chargée
         $(window).on('load', function(){
              setTimeout(function(){ $('#mailPhonePatient').focus(); }, 300);
         });
    </script>

    <script>
      $(document).ready(function(){
        $("#a_recherche_nom").hide();
        $("#espace_Recherche_ID").hide();
        $("#a_recherche_ide").show();
        $("#espace_Recherche_Nom").show();

            $("#a_recherche_nom").click(function(){
              $("#a_recherche_ide").show();
              $("#espace_Recherche_Nom").show();
              $("#a_recherche_nom").hide();
              $("#espace_Recherche_ID").hide();
            });

            $("#a_recherche_ide").click(function(){
              $("#a_recherche_nom").show();
              $("#espace_Recherche_ID").show();
              $("#a_recherche_ide").hide();
              $("#espace_Recherche_Nom").hide();
            });
      });
    </script>

    <script>
      function actualiserAvecID(ID){

            $("#espaceChoixPatient").hide();
            $("#espace_Recherche_ID").show();
            $("#a_recherche_ide").hide();
            $("#espace_Recherche_Nom").hide();

            document.getElementById("afficherPatient").value = ID;

      }
    </script>


 

    <script>
      $(document).ready(function(){
        $("#infoPatient").hide();
        $("#hisPatDoss").hide();
        $("#documentsPatDoss").hide();
        $("#espacePourDocumentPatient").hide();

            $("#showPatient").click(function(){

              $("#infoPatient").show();
              $("#espacePourInfoPatient").show();
              $("#hisPatDoss").show();
              $("#documentsPatDoss").show();
              $("#espacePourDocumentPatient").show();

            });
      });
    </script>
    <script>
      $(document).ready(function(){
          $('#afficherPatient').keydown(function(){  
                $("#espacePourInfoPatient").hide();
            }); 
      });
    </script>

    <script>
      $(document).ready(function(){
        $("#espacePourDossierPatient").hide();
            $("#showPatient").click(function(){
              $("#espacePourDossierPatient").show();
            });
      });
    </script>
    <script>
      $(document).ready(function(){
          $('#afficherPatient').keydown(function(){  
                $("#espacePourDossierPatient").hide();
            }); 
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

