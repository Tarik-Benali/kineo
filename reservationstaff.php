<?php
    include("auth/auth.php");
    include("includes/historique.php");
    include("includes/functions.php");

    include("fonctionnalites/affichage/infoExamenPourConsultation.php"); 

    if (isset($_SESSION['identifiant']) && $_SESSION['typeCompte']== 5) {

    $idStaff    = $_SESSION['identifiant'];

    if (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5") {
           
            $idCabinet        = $_SESSION['idCabinet'];

            $nomCabinet       = $_SESSION['nomCabinet'];

            $idStaff          = $_SESSION['identifiant'];


            $typeProfil  ="staff";
        }

    if (isset($_REQUEST["idP"])) {

        $idPatient = $_GET["idP"];
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


    <link rel="stylesheet" href="assets/js/timepicker/bootstrap-timepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/datepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/clockface.css">
    <link rel="stylesheet" href="assets/js/datepicker/bootstrap-datetimepicker.css">



    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/minus.png">

    

    
    
</head>

<?php include("fragmentsPages/fragmentsPatient/bodyTheme.php"); ?>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- TOP NAVBAR -->
    <!-- TOP NAVBAR -->


    <?php include("fragmentsPages/fragmentsStaff/barDeNavigation.php"); ?>         

    <!-- /END OF TOP NAVBAR -->

    <!-- SIDE MENU -->

    <?php include("fragmentsPages/fragmentsStaff/menuPrincipal.php"); ?> 

    <!-- END OF SIDE MENU -->

    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">

            <!-- CONTENT -->
            <!--TITLE -->
                    <!-- Inclusion d'entête ;) -->

                        <?php //include("fragmentsPages/fragmentsStaff/entet.php"); ?><br>         

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
                <li><a href="#" title="Sample page 1">Réservation</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <!--input style="border-radius:15px" type="text" placeholder="Search..." class="form-control"-->
                    </div>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->

            <div class="content-wrap">
                <div class="row">                       
                    <div class="col-sm-12">
                        <div class="nest" id="headerChoixCabinet">
                            <div class="title-alt">
                                <h6>
                                    Paramètres Rendez-vous</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#headerChoixCabinet">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#headerChCab">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>


                            <div class="body-nest" id="headerChCab">
                                <div class="container">   
                                        <div class="table-responsive">  
                                                <div class="form_center" id="div_headerChCab">
                                                    <div class="control-group">

                                                        <div class="control-group" id="espace_Recherche_ID">
                                                            <label class="control-label" for="idPatien">Recherche Id Patient</label>
                                                            <input type="text" id="idPatien" name="idPatien" class="form-control" placeholder="Id Patient" required>
                                                        </div>

                                                        <div id="espace_Recherche_Nom">
                                                            <label class="control-label" for="nom">Recherche par Nom / Mail ou Téléphone</label>
                                                            <div class="controls">
                                                                <input type="text" name="mailPhonePatient" class="form-control" id="mailPhonePatient">
                     
                                                            </div>
                                                        </div>

                                                        <div id="espaceChoixPatient">
                                                        </div>
                                                        
                                                        <a id="a_recherche_nom" href="#">Recherche par nom/email/téléphone</a>
                                                        <a id="a_recherche_ide" href="#">Recherche par Identifiant</a>

                                                        <br>
                                                        <br>

                                                        <!--div class="control-group">
                                                                <label class="control-label" for="nomcabin">Cabinet</label>

                                                                <select id="cabinet" name="cabinet" class="form-control" placeholder="Nom cabinet">
  
                                                                    <?php //getVirtuhosCabinet(); ?>

                                                                </select>
                                                        </div>

                                                        <br-->

                                                        <div id="espace_dateRDV">
                                                            <div class="control-group">
                                                                <label class="control-label" for="name">Date que vous souhaitez</label>
                                                                <input type="text" class="form-control" id="dp1" <?php echo "value=\"".date("d/m/Y")."\"";?> name="dateRDV">
                                                            </div>
                                                        </div>

                                                        <div class="checkbox">
                                                            <label>
                                                                <input id="typeRDV" type="checkbox" checked>rendez-vous patient.
                                                            </label>
                                                            <input id="typeRDVInput" type="hidden" name="rdv_staff" value="0">
                                                        </div>

                                                        
                                                        <br><br>
                                                        <button type="button" name="importer" id="showRDV" class="btn btn-info" onclick="getNameIDCabinetAndDate()">Importer</button>

                                                        <div id="espace_patient"></div>
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


                    <div class="col-sm-3">
                        <div class="nest" id="tablePatientClose">
                            <div class="title-alt">
                                <h6>Médecins</h6>
                            </div>
                        </div>  

                        <div id="RealTime" style="min-height:296px;padding-top:10px;" class="body-nest">
                                <ul class="direction" id="docsForRDV">
                                    
                                </ul>
                        </div>      
                    </div>


                    <div class="col-sm-9">
                        <div class="nest" id="StackableClose">
                                <div class="title-alt">
                                    <h6>Rendez-vous disponible</h6>
                                </div>

                                <div class="body-nest" id="StackableStatic">
                                    <table id="responsive-example-table" class="table large-only">
                                        <tbody id="trHoraireDisponible">
                                            

                                            

                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div> 
                </div>
            </div>

            <!-- /END OF CONTENT -->

            <!-- FOOTER -->
       
                   <?php include("fragmentsPages/fragmentsStaff/footer.php"); ?>   

            <!-- / END OF FOOTER -->


        </div>
    </div>

    <!--  END OF PAPER WRAP -->

        <?php include("fragmentsPages/fragmentsStaff/menuSecondaire.php"); ?>

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


    <script type="text/javascript" src="assets/js/timepicker/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/clockface.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/bootstrap-datetimepicker.js"></script>


    <script type="text/javascript" src="datepair.js"></script>

    <script>
      $(document).ready(function(){

        $("#dp").hide();
        $("#espace_patient").hide();
            $("#showRDV").click(function(){
              $("#dp").show();
            });
      });
    </script>

    <script>
      $(document).ready(function(){
        $("#a_recherche_nom").show();
        $("#espace_Recherche_ID").show();
        $("#a_recherche_ide").hide();
        $("#espace_Recherche_Nom").hide();
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
         $(document).ready(function(){

              $('#mailPhonePatient').keyup(function(){  
                   $('#espaceChoixPatient').html('');

                   var NomPatient = $(this).val();

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
                               }
                          }  
                      });
                     }      
                }); 
              });                                 
    </script>

    <script>
      function actualiserAvecID(ID){

            $("#espaceChoixPatient").hide();
            $("#espace_Recherche_ID").show();
            $("#a_recherche_ide").hide();
            $("#espace_Recherche_Nom").hide();

            document.getElementById("idPatien").value = ID;
      }
    </script>



    <script>
/*
        function docsNamesForRDV(){

            $(document).ready(function(){

                var sel = document.getElementById('cabinet');
                var opt = sel.options[sel.selectedIndex];
                
                var NameCab = opt.text;
                var IdenCab = opt.value;
                var DateRDV = document.getElementById("dp1").value;

                       if (DateRDV != "" && NameCab != "" &&  IdenCab != ""){

                          $.ajax({
                              url:"fonctionnalites/affichage/getCabinetRDVForPatient.php",  
                              type:"GET",  
                              data:{dateRDV: DateRDV, cabinetName: NameCab, idCabinet: IdenCab},
                              success:function(data)  
                              {  
                                   if (data != "") {
                                    console.log(data);
                                    return data;

                                   }else{
                                     console.log("Erreur ! liste des RDV introuvable");
                                   }
                              }  
                          });
                        }
                        else{
                            alert("Veuillez d'abord sélectionner le nom du cabinet !")
                        }      
                  });
            }*/
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

        var NameCab;
        var IdenCab;
        var DateRDV;
        var Patient; 
        
        function getNameIDCabinetAndDate(){



            //var sel = document.getElementById('cabinet');
            //var opt = sel.options[sel.selectedIndex];
                
            //NameCab = opt.text;
            //IdenCab = opt.value;

            NameCab = "<?php echo $nomCabinet;?>";
            IdenCab = "<?php echo $idCabinet;?>";


            
            DateRDV = document.getElementById("dp1").value;
            Patient = document.getElementById("idPatien").value;

            if (Patient =="") {
                  $("#espace_patient").show();
                  $('#espace_patient').append("<h3 style=\"color:red;\">Veuillez d'abord saisir l'identifiant du patient </h3>");
            }else{
                $("#espace_patient").hide();

                var Docs;

                //console.log(NameCab + " " + DateRDV + " "+ IdenCab + " " + Patient);

                getDocs(IdenCab);

            }

            



/*
            $(document).ready(function(){

                       if (DateRDV != "" && NameCab != "" &&  IdenCab != ""){

                          $.ajax({
                              url:"fonctionnalites/affichage/getCabinetRDVForPatient.php",  
                              type:"GET",  
                              data:{dateRDV: DateRDV, cabinetName: NameCab, idCabinet: IdenCab},
                              success:function(data)  
                              {  
                                   if (data != "") {
                                    
                                    //Docs = data;
                                    console.log(data);
                                    //rdvParams(data);

                                   }else{
                                     console.log("Erreur ! liste des RDV introuvable");
                                   }
                              }  
                          });
                        }
                        else{
                            alert("Veuillez d'abord sélectionner le nom du cabinet !")
                        }      
                  });
            


            var sel = document.getElementById('cabinet');
            var opt = sel.options[sel.selectedIndex];
            
            var NameCab = opt.text;
            var IdenCab = opt.value;
            var DateRDV = document.getElementById("dp1").value;*/

            //***************rdvParams();

            /*
            $(document).ready(function(){

                   $('#espace_liste_des_RDV').html('');


                   if (DateRDV != "" && NameCab != "" &&  IdenCab != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/getCabinetRDVForPatient.php",  
                          type:"GET",  
                          data:{dateRDV: DateRDV, cabinetName: NameCab, idCabinet: IdenCab},
                          success:function(data)  
                          {  
                               if (data != "") {
                                 $('#espace_liste_des_RDV').append(data);
                               }else{
                                 console.log("Erreur ! liste des RDV introuvable");
                               }
                          }  
                      });
                    }
                    else{
                        alert("Veuillez d'abord sélectionner le nom du cabinet !")
                    }      
              });*/

            //console.log(NameCab + " " + DateRDV + " "+ IdenCab);
            //alert(str);

            //console.log("ghghgh " + Docs);
        }

        function aah(str){
            console.log(str);
            alert(str);
        }

        function getDocs(idCab){

            var Cab = idCab;


            $(document).ready(function(){

                    $('#docsForRDV').html('');

                       if (Cab != ""){

                          $.ajax({
                              url:"fonctionnalites/affichage/getDocsOfCabForRDV.php",  
                              type:"GET",  
                              data:{idCab: Cab},
                              success:function(data)  
                              {  
                                   if (data != "") {
                                    
                                    //Docs = data;
                                    //console.log(data);
                                    $('#docsForRDV').append(data);
                                    console.log('hhh ' + idCab);

                                   }else{
                                     console.log("Erreur ! liste des RDV introuvable");
                                   }
                              }  
                          });
                        }
                        else{
                            alert("Veuillez d'abord sélectionner le nom du cabinet !")
                        }      
                  });
        }


        function getHoraireLibre(idCab,idDoc){

            var Cab     = idCab;
            var Doc     = idDoc;
            var NomCab  = NameCab;
            var IDPa    = Patient = document.getElementById("idPatien").value;
            var Type    = document.getElementById("typeRDVInput").value;


            

            var DateRdv = document.getElementById("dp1").value;

            //console.log("hhh: "+ Cab+" | "+Doc+" | "+NomCab+" | "+DateRdv);


            $(document).ready(function(){

                    $('#trHoraireDisponible').html('');

                       if (Cab != "" && Doc != "" && NomCab != "" && DateRdv && IDPa != "" && Type != ""){

                          $.ajax({
                              url:"fonctionnalites/affichage/getCabinetRDVForPatient.php",  
                              type:"GET",  
                              data:{idCab: Cab, idDoc: Doc, nomCabi: NomCab, date:DateRdv, idPat:IDPa, type:Type},
                              success:function(data)  
                              {  
                                   if (data != "") {
                                    
                                    //Docs = data;
                                    //console.log(data);
                                    $('#trHoraireDisponible').append(data);

                                   }else{
                                     console.log("Erreur ! liste des RDV introuvable");
                                   }
                              }  
                          });
                        }
                        else{
                            alert("Veuillez d'abord sélectionner un cabinet, une date puis choisir un médecin !")
                        }      
                  });
        }


        function getPatient(idCab, idPat){

            var Cab = idCab;
            var Cab = idPat;


            $(document).ready(function(){

                    $('#docsForRDV').html('');

                       if (Cab != ""){

                          $.ajax({
                              url:"fonctionnalites/affichage/getDocsOfCabForRDV.php",  
                              type:"GET",  
                              data:{idCab: Cab},
                              success:function(data)  
                              {  
                                   if (data != "") {
                                    
                                    //Docs = data;
                                    console.log(data);
                                    $('#docsForRDV').append(data);

                                   }else{
                                     console.log("Erreur ! liste des RDV introuvable");
                                   }
                              }  
                          });
                        }
                        else{
                            alert("Veuillez d'abord sélectionner le nom du cabinet !")
                        }      
                  });
        }

    </script>

    <script>

        $(document).ready(function() {

            $('#typeRDV').change(function() {
                if(this.checked) {
                    console.log("checked");
                    $("#typeRDVInput").val("0");
                }
                else{
                    console.log("pas checked");
                    $("#typeRDVInput").val("2");
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
header('location: staff.php');
}

?>
