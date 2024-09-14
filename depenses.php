<?php
    include("auth/auth.php");
    //include("includes/historique.php");
    include("includes/functions.php");
    //include("fonctionnalites/affichage/examensAvecLeursPrix.php");
    //include("fonctionnalites/affichage/consultationAvecLeursPrix.php");

    if (isset($_SESSION['idDeCeCabinet']) || (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5")) {

    $typeProfil ="";
    $faiseur    ="";

        if (isset($_SESSION['idDeCeCabinet']) && $_SESSION['typeCompte'] =="2") {
                                              
            $idCabinet        = $_SESSION['idDeCeCabinet'];

            $nomCabinet       = $_SESSION['nomDeCeCabinet'];

            $adresseCabinet   = $_SESSION['adresseDeCeCabinet'];

            $idMedCab         = $_SESSION['idDeCeMedCab'];

            $idMedecin        = $_SESSION['idDeCeMedecin'];

            $Medecin          = $_SESSION['username'];

            $typeProfil  = "medecin";
            $faiseur     = $idMedecin;


        }elseif (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5") {
               
            $idCabinet        = $_SESSION['idCabinet'];

            $nomCabinet       = $_SESSION['nomCabinet'];

            $idStaff          = $_SESSION['identifiant'];


            $typeProfil  ="staff";
            $faiseur     = $idStaff;
        }


    $toDay    = date('Y-m-d'); 
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="assets/css/profile.css">


    <style type="text/css">
        canvas#canvas4 {
            position: relative;
            top: 20px;
        }

        .form-inline {  
          display: flex;
          flex-flow: row wrap;
          align-items: center;
        }


        @media (max-width: 800px) {
          .form-inline input {
            margin: 10px 0;
          }
          
          .form-inline {
            flex-direction: column;
            align-items: stretch;
          }
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

    <?php 
        if ($typeProfil == "medecin") {
                    include("fragmentsPages/barDeNavigation.php");
                }
        else if ($typeProfil == "staff") {
                    include("fragmentsPages/fragmentsStaff/barDeNavigation.php");
                } 
    ?>



    <!-- /END OF TOP NAVBAR -->

    <!-- SIDE MENU -->
    <!-- SIDE MENU -->

    <?php 

        if ($typeProfil == "medecin") {
                    include("fragmentsPages/menuPrincipal.php");
                }
        else if ($typeProfil == "staff") {
                    
                } 
    ?>
     

    <!-- END OF SIDE MENU -->
    <!-- END OF SIDE MENU -->



    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">

            <br>
            <!-- CONTENT -->
            <!-- BREADCRUMB -->
            <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Tarifs</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Recette du jour</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul>
            <!-- END OF BREADCRUMB -->
            <!--  DEVICE MANAGER -->

<!-------------------------------------------------------------- Recette Du jour --------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableTotalRecetteJournaliere">
                            <div class="title-alt">
                                <h6>
                                    Dépenses de la journée</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableTotalRecetteJournaliere">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#divTotalRecette">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" style="margin-bottom: 10px">
                                <div class="pull-right">
                                    <button id="printBtn" class="btn btn-info"  data-toggle="modal" data-target="#addDepense">
                                    <span class="entypo-docs"></span>&nbsp;&nbsp;Ajouter un dépense&nbsp;&nbsp;</button>
                                </div>
                            </div>
                            <div class="body-nest" id="divTotalRecette">

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Le jour</th>
                                                <th>Remarque</th>
                                                <th>Dépense</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php 

                                                    if ($typeProfil == "medecin") {
                                                         //recetteTotalParJour($nomCabinet);
                                                         depensesDuJour($nomCabinet);
                                                     }
                                                     else if ($typeProfil == "staff") {
                                                         //recetteTotalParJour($nomCabinet);
                                                         depensesDuJour($nomCabinet);
                                                     } 
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 


<!-------------------------------------------------------------- Recette Du jour par kiné et plage de temps--------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tabledepenses">
                            <div class="title-alt">
                                <h6>
                                    Dépenses par plage de temps</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tabledepenses">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#divtabledepenses">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="divtabledepenses">

                                <div class="form-inline">

                                  <label style="margin-right: 5px;" for="de">De:</label>
                                  <input style="margin-right: 15px;" type="date" id="de" class="form-control" name="dateDe" required>

                                  <label style="margin-right: 5px;" for="a">à:</label>
                                  <input style="margin-right: 15px;" type="date" id="a" class="form-control" name="dateA" required>

                                  <button type="button" class="btn btn-info" id="rechercheParDate">Executer</button>
                                </div>

                                <br><br>

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Le jour</th>
                                                <th>Dépense</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBody">

                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 


<!-------------------------------------------------------------- Recette Du jour par kiné et plage de temps--------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableTotalRecetteJournalier">
                            <div class="title-alt">
                                <h6>
                                    Détails des Dépenses</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableTotalRecetteJournalier">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#divTotalRecett">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="divRecetteParDat">

                                <div class="form-inline">

                                  <label style="margin-right: 5px;" for="deT">De:</label>
                                  <input style="margin-right: 15px;" type="date" id="deT" class="form-control" name="dateDe" required>

                                  <label style="margin-right: 5px;" for="aT">à:</label>
                                  <input style="margin-right: 15px;" type="date" id="aT" class="form-control" name="dateA" required>

                                  <button type="button" class="btn btn-info" id="rechercheParDateT">Executer</button>
                                </div>

                                <br><br>

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Le jour</th>
                                                <th>Remarques</th>
                                                <th>Dépenses</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableBodyT">

                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 



            <!-- Debut RDV modal -->
                <div class="modal fade" id="addDepense" tabindex="-1" role="dialog" aria-labelledby="modalDAjoutRDV" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalDAjoutRDV">Ajout d'une nouvelle dépense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form id="saveDepForm" action="fonctionnalites/ajout/ajouterDepense.php" method="POST">
                      <div class="modal-body">
                        <input type="hidden" name="medecin" value="<?php echo $idMedecin;?>">
                        <input type="hidden" name="nomCabinet" value="<?php echo $nomCabinet;?>">

                        <div id="depDiv" style="width: 100%;"> 
                            <label class="control-label" for="nom">Dépense</label>
                            <div class="controls">
                                <input type="number" name="depense" id="depenseAdd" value="" class="form-control" placeholder="0" required>
                            </div>
                        </div>
                        
                        <br><br>

                        <div id="textDep" style="width: 100%;"> 
                            <label class="control-label" for="nom">Remarque</label>
                            <div class="controls textarea-container">
                                 <textarea style="width: 100%; height: 80px; padding-right: 60px;" id="textDep" name="textDep" placeholder=" Ecrivez ici une remarque sur la dépense ..."></textarea>
                            </div>
                              

                        </div>

                        <br>
                        <br>

                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-info" id="saveDep">Ajouter</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
            <!-- Fin RDV modal -->                        

            
  


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
        $("#detailsRecettejournaliere").hide();
            $("#showDetails").click(function(){
              $("#detailsRecettejournaliere").show();
            });
      });
    </script>

    <script>  
         $(document).ready(function(){

              $('#showDetails').click(function(){  
                   $('#espaceDetailsRecetteJournaliere').html('');

                   //var NomPatient = $(this).val();
                   var MonCab = "<?php echo $nomCabinet;?>";
                   var ceJour = "lyoum";

                   if (MonCab != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/detailsRecetteDuJour.php",  
                          type:"GET",  
                          data:{dateJ:ceJour,nomCabinet: encodeURIComponent(MonCab)},
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#espaceDetailsRecetteJournaliere').append(data);
                               } else{
                                document.getElementById('espaceDetailsRecetteJournaliere').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Pas de détails pour ce jour</div>"
                               }
                          }  
                      });
                     }      
                }); 
              }); 

         $(document).ready(function(){

              $('#rechercheParDate').click(function(){  
                   $('#tableBody').html('');

                   var MonCab = "<?php echo $nomCabinet;?>";
                   var dateDe = document.getElementById("de").value;
                   var dateA  = document.getElementById("a").value;
                   var pratic = "<?php echo $idMedecin;?>";

                   if (dateDe =="" || dateA =="") {
                    alert("Vueillez d'abord séléctioner la date début et fin filtre !");
                   }


                   if (MonCab != "" && dateDe != "" && dateA != "" && pratic != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/getDetailsDepenses.php",   
                          type:"GET",  
                          data:{DateDe:dateDe,DateA:dateA,Prati:pratic,nomCabinet: encodeURIComponent(MonCab),type:"simple"},
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#tableBody').append(data);
                               } else{
                                document.getElementById('tableBody').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Pas de dépenses enregisrtrée pour cette periode.</div>"
                               }
                          }  
                      });
                     }      
                }); 
              });                                     

         $(document).ready(function(){

              $('#rechercheParDateT').click(function(){  
                   $('#tableBodyT').html('');

                   var MonCab = "<?php echo $nomCabinet;?>";
                   var dateDe = document.getElementById("deT").value;
                   var dateA  = document.getElementById("aT").value;
                   var pratic = "<?php echo $idMedecin;?>";

                   if (dateDe =="" || dateA =="") {
                    alert("Vueillez d'abord séléctioner la date début et fin filtre !");
                   }


                   if (MonCab != "" && dateDe != "" && dateA != "" && pratic != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/getDetailsDepenses.php",   
                          type:"GET",  
                          data:{DateDe:dateDe,DateA:dateA,Prati:pratic,nomCabinet: encodeURIComponent(MonCab),type:"detail"},
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#tableBodyT').append(data);
                               } else{
                                document.getElementById('tableBodyT').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Pas de dépenses enregisrtrée pour cette periode.</div>"
                               }
                          }  
                      });
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
header('location: auth/logout.php');
}

?>