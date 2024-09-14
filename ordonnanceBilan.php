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

    $identifiantPatient = "0000";

    if (isset($_REQUEST["idConst"])) {
        $idConsultation = $_GET["idConst"];
        $motif = "consultation";
    } else{
        $motif = "demande_bilan";
        $idConsultation = date("YmdHis");
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

    <link rel="stylesheet" href="assets/js/timepicker/bootstrap-timepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/datepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/clockface.css">
    <link rel="stylesheet" href="assets/js/datepicker/bootstrap-datetimepicker.css">

    <link rel="stylesheet" type="text/css" href="assets/js/tag/jquery.tagsinput.css">



    <link rel="shortcut icon" href="assets/ico/minus.png">

    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>
    <script type="text/javascript" src="jquery/jquery-2.2.4.js"></script>




    <style type="text/css">
    canvas#canvas4 {
        position: relative;
        top: 20px;
    }

    @media screen {
        #printSection {
            display: none;
        }
    }
    @media print {
        body * {
            visibility:hidden;
        }
        #printSection, #printSection * {
            visibility:visible;
        }
        #printSection {
            position:absolute;
            left:0;
            top:0;
        }
    }
    </style>



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
                <li><a href="#" title="Sample page 1">Ordonnance</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Nouvelle Ordonnance</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <button style="border-radius:15px" id="addOrdonnance" class="btn btn-info" data-toggle="modal" data-target="#modalDAjoutDOrdon">Ajouter une autre ordonnance</button>
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
                                    Demande Bilan</h6>
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
                                        <div class="form-group">  
                                            <form action="impression/ordonnanceMedicaments.php" name="add_name" id="add_name" method="POST">  
                                                <div class="table-responsive">  
                                                    <div class="form_center">

                                                        <?php if (isset($_REQUEST["idPatient"]) && $_REQUEST["idPatient"] != "0000") {
                                                                    $identifiantPatient = $_GET["idPatient"];

                                                                         infoPatientPourOrdonnance($identifiantPatient);         

                                                                } else {?>

                                                        <div class="control-group">   
                                                            <label class="control-label" for="nom">Nom Patient</label>
                                                            <div class="controls">
                                                                <input type="text" class="form-control" name="nom" id="nom">
                                                            </div>
                                                        </div><br>
                                                        <div class="control-group">
                                                            <label class="control-label" for="prenom">Prenom Patient</label>
                                                            <div class="controls">
                                                                <input type="text" class="form-control" name="prenom" id="prenom">
                                                            </div>
                                                        </div><br>
                                                        <div class="control-group" id="age">
                                                            <label class="control-label" id="age" for="age">Age Patient</label>
                                                            <div class="controls">
                                                                <input type="text" class="form-control" name="age" id="age">
                                                            </div>
                                                        </div>

                                                        <?php }  ?>
                                                    </div>
                                                <br>
                                                <br>    
                                                <table class="table table-bordered" id="dynamic_field">  
                                                    <tr>  
                                                        <td style="width: 80%">
                                                           <input id="medecin" name="medecin" type="hidden" value="<?php echo $Medecin; ?>" />
                                                           <input id="in" type="text" name="bilan[]" placeholder="Nom d'examen" class="form-control name_list"  />


                                                           <div id="liste_des_ledicaments">   </div>


                                                        </td>
                                                        <td style="width: 20%">
                                                           <button type="button" name="add" id="add" class="btn btn-success">Ajouter un examen</button>
                                                        </td>  
                                                    </tr>  
                                                </table>

                                                   <input type="hidden" name="idCons" value="<?php echo $idConsultation;?>">
                                                   <input type="hidden" name="motif" value="<?php echo $motif;?>">

                                                <input class="btn btn-info" id="imprim" onclick="printOrdonnance()" value="Imprimer" data-toggle="modal" data-target="#myModal" />
                                                </div>  
                                            </form>  
                                        </div>  
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    <!-------------------------------------- Modal Impression --------------------------------------------------------->

            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog" style="height: 35%; width: 35%;">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-body" id="modalOrd" style="height: 100%; overflow-y: auto;">
                           
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-info" id="Print">Imprimer</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>

                </div>
            </div>


    <!-------------------------------------- Modal Ajout Ordonnance --------------------------------------------------------->
                
                <div class="modal fade"  id="modalDAjoutDOrdon" role="dialog">
                    <div class="modal-dialog">
                                        
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">X</button>
                                <h4 class="modal-title">Ajout D'autres ordonnances</h4>
                            </div>
                            
                            <div class="modal-body" style="height: 250px; overflow-y: auto;">

                                <fieldset>
                                            
                                    <ul id="breadcrumb" style="height: 200px;">

                                        <div class="btn-group">


                                        <a href="<?php echo "ordonnanceMedicaments.php?idConst=".$idConsultation."&idPatient=".$identifiantPatient."" ?>">
                                            <button class="btn btn-success" style="margin-left: 100%" type="button">Ordonnance Médicament
                                            </button>
                                        </a><br><br>

                                        <a href="<?php echo "ordonnanceOrientation.php?idConst=".$idConsultation."&idPatient=".$identifiantPatient."" ?>">
                                            <button class="btn btn-success" style="margin-left: 110%" type="button">Lettre d'orientation
                                            </button>
                                        </a><br><br>    

                                        <a href="<?php echo "ordonnanceVide.php?idConst=".$idConsultation."&idPatient=".$identifiantPatient."" ?>">
                                            <button class="btn btn-success" style="margin-left: 113%" type="button">Ordonnance vide
                                            </button>
                                        </a><br><br>

                                        <a href="<?php echo "ordonnanceBilan.php?idConst=".$idConsultation."&idPatient=".$identifiantPatient."" ?>">
                                            <button class="btn btn-success" style="margin-left: 113%" type="button">Demande de bilan
                                            </button>
                                        </a><br><br>

                                        </div>
                                        

                                        <!--input type="hidden" name="id" value="medic nom age  prenom motif idCons">
                                        <input type="hidden" name="nomCabinet" value=""-->

                                    </ul>
                                </fieldset>                    
                                              
                            </div>                                                                     
                        </div>
                    </div>
                </div> 

            <?php include("fragmentsPages/footer.php"); ?>   

        </div>
    </div>

    <!--  END OF PAPER WRAP -->
        <?php include("fragmentsPages/menuSecondaire.php"); ?>
    <!-- RIGHT SLIDER CONTENT -->
  


    <!-- END OF RIGHT SLIDER CONTENT-->
    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>
    <script type="text/javascript" src="jquery/jquery-1.12.4.js"></script>
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
          $("#in").keyup(function(){
            $('#liste_des_ledicaments').html('');

                   var Bilan   = $(this).val();
                   var Cabinet = "<?php echo $nomCabinet; ?>"; 


                   if (Bilan != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/infoBilan.php",  
                          type:"GET",  
                          data:{bilans: encodeURIComponent(Bilan), nomCab: Cabinet},  
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#liste_des_ledicaments').append(data);

                               } else{
                                document.getElementById('liste_des_ledicaments').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Erreur de connexion</div>"
                               }
                          }  
                        });
                    }
          });
        });
    </script>


    <script>

        function onDocClick(NomM) {

            var nom_medicament = NomM;
            document.getElementById('in').value = nom_medicament;

            $('#liste_des_ledicaments').html('');
          }

    </script>

    <script>

        function onDocClickI(NomM, i) {

            var nom_medicament = NomM;

            document.getElementById('in'+i).value = nom_medicament;

            $('[id^="liste_des_ledicaments_"]').html('');

            //$('#liste_des_ledicaments_'+i).html('');

          }

    </script>


    <script>

        function printOrdonnance() {

            $('#modalOrd').html('');  
                    document.getElementById("modalOrd").innerHTML = "";           
                   $.ajax({  
                        url:"impression/ordonnanceBilan.php",  
                        method:"POST",  
                        data:$('#add_name').serialize(),  
                        success:function(data)  
                        {  
                             $('#modalOrd').append(data);  
                             //$('#add_name')[0].reset();  
                        }  
                   }); 
          }

    </script>


     

    <script>  

/*
        $(document).ready(function(){

              $('#inputT').keyup(function(){

                alert('hii');


                
                   $('#liste_des_ledicaments').html('');

                   var Medik   = $(this).val();
                   var Cabinet = "<?php echo $nomCabinet; ?>"; 


                   if (Medik != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/infoMedicament.php",  
                          type:"GET",  
                          data:{medicam: encodeURIComponent(Medik), nomCab: Cabinet},  
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#liste_des_ledicaments').append(data);
                               } else{
                                document.getElementById('liste_des_ledicaments').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Faut Identifiant</div>"
                               }
                          }  
                        });
                    }   
                }); 
            });
*/   

        $(document).ready(function(){  
              var i=1;  
              $('#add').click(function(){  
                   i++;  
                   $('#dynamic_field').append('<tr id="row'+i+'"><td style="width: 80%"><input id="in'+i+'" type="text" name="bilan[]" placeholder="Nom d examen" class="form-control name_list"/><div id="liste_des_ledicaments_'+i+'"></div></td><td style="width: 20%"><button type="button" name="removeeee" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');


                    $("#in"+i+"").keyup(function(){
                    $('#liste_des_ledicaments_'+i).html('');

                           var idCompl = $(this).attr('id');
                           console.log(idCompl);

                           var Bilan   = $(this).val();
                           var Indice  = idCompl.substr(2);
                           var Cabinet = "<?php echo $nomCabinet; ?>"; 

                           if (Bilan != ""){

                              $.ajax({
                                  url:"fonctionnalites/affichage/infoBilan.php",  
                                  type:"GET",  
                                  data:{bilans: encodeURIComponent(Bilan), nomCab: Cabinet, indice: Indice},  
                                  success:function(data)  
                                  {  
                                       if (data != "") {
                                        $('#liste_des_ledicaments_'+i).append(data);

                                       } else{
                                        document.getElementById('liste_des_ledicaments_'+i).innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Erreur de connexion</div>"
                                       }
                                  }  
                                });
                            }
                  });                                                                                                                 
                                                        
              });  
              $(document).on('click', '.btn_remove', function(){  
                   var button_id = $(this).attr("id");   
                   $('#row'+button_id+'').remove();  
              }); 



              document.getElementById("Print").onclick = function () {
                    printElement(document.getElementById("modalOrd"));
                };

                function printElement(elem) {
                    var domClone = elem.cloneNode(true);

                    var $printSection = document.getElementById("printSection");

                    if (!$printSection) {
                        var $printSection = document.createElement("div");
                        $printSection.id = "printSection";
                        document.body.appendChild($printSection);
                    }

                    $printSection.innerHTML = "";
                    $printSection.appendChild(domClone);
                    window.print();
                }


              //$(document).on('click', '.impriming', function(){  
               //    location.replace("impression/ordonnanceMedicaments.php") 
              //}); 
               
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