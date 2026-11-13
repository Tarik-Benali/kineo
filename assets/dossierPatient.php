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
    <link rel="stylesheet" href="assets/js/datepicker/bootstrap-datetimepicker.css">

    <link rel="stylesheet" type="text/css" href="assets/js/tag/jquery.tagsinput.css">

    <link href="assets/js/textEditor/editor.css" rel="stylesheet">
    <link href="assets/js/textEditor/sceditor/minified/themes/square.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/js/textEditor/src/bootstrap-wysihtml5.css" />

    <link rel="shortcut icon" href="assets/ico/minus.png">

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

<body>
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
                                                            <label class="control-label" for="nom">Identifiant du Patient</label>
                                                            <div class="controls">
                                                                <input type="text" name="identifiantPatient" class="form-control" id="afficherPatient">
                 
                                                            </div>
                                                            <br>

                                                            <label class="control-label" for="nom">Type de filtre</label>
                                                            <div class="controls">

                                                               <select type="text" name="filtre" class="form-control cabi" id="filtre">
                                                                  <option value="monCabinet" selected>Ce Cabinet '<?php echo $nomCabinet; ?>'</option>
                                                                  <option value="allCabinet">Tout Les Cabinets</option>
                                                               </select>             
            
                                                            </div>
  
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


             

            <div id="espacePourDossierPatient"><!--?php include("fonctionnalites/affichage/afficherDossierPatient.php"); ?--></div>

                   <?php include("fragmentsPages/footer.php"); ?>   

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

    <script>
      

          $(document).ready(function(){
            
              //alert("You have selected the country - " + strUser);
          });
      

    </script>

    <script>  
      function sendTypeFiltreAndGetPatientData(){
         $(document).ready(function(){

              var e = document.getElementById("filtre");
              var strUser = e.options[e.selectedIndex].value;
            
              $("select.cabi").change(function(){
                  var strUser = $(this).children("option:selected").val();
                  
              });

              //$('#afficherPatient').keyup(function(){  
                   $('#espacePourInfoPatient').html('');

                   var Patient = $("#afficherPatient"). val();
                   var NomCabinet = '<?php echo $nomCabinet;?>'; 

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
      $(document).ready(function(){
        $("#espacePourInfoPatient").hide();
            $("#showPatient").click(function(){
              $("#espacePourInfoPatient").show();
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

