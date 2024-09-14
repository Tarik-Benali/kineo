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
        <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
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
                <li><a href="#" title="Sample page 1">Paramètres cabinet</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Salle</a>
                </li>


                <li class="pull-right">
                    <div class="input-group input-widget">

                        <button style="border-radius:15px" id="addSalle" class="btn btn-info" data-toggle="modal" data-target="#modalDAjoutSalle">Ajouter une salle</button>
                    </div>
                </li>
            </ul>
            <!-- END OF BREADCRUMB -->
            <!--  DEVICE MANAGER -->

<!---------------------------------------------------------- Salles ---------------------------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableStaticClose">
                            <div class="title-alt">
                                <h6>
                                    Salles</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableStaticClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#tableStatic">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="tableStatic">

                                <section id="flip-scroll">

                                    <table class="table table-bordered table-striped cf">
                                        <thead class="cf">
                                            <tr>
                                                <th>Nom / Num</th>
                                                <th>Etage</th>
                                                <th>Type</th>
                                                <th>Supprimer</th>
                                                <th>Modifier</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                
                                            <?php  getAllActifSalle($nomCabinet,$idMedecin, $idCabinet); ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 


            <!-------------------------------------- Modal Ajout Salle --------------------------------------------------------->
                
                <div class="modal fade"  id="modalDAjoutSalle" role="dialog">
                    <div class="modal-dialog">
                                        
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">X</button>
                                <h4 class="modal-title">Ajout d'une nouvelle salle</h4>
                            </div>
                            
                            <div class="modal-body" style="height: 350px; overflow-y: auto;">

                                        <form action="fonctionnalites\ajout\ajoutSalle.php" class="form-container">
                                            <fieldset>


                                                <input type="hidden" name="faiseur" <?php echo "value=".$idMedecin."";?> >

                                                <input type="hidden" name="idCabinet" <?php echo "value=".$idCabinet."";?>>

                                                <input type="hidden" name="nomBD" <?php echo "value=".$nomCabinet."";?>>


                                            <div class="control-group">
                                                <label class="control-label" for="num_nom_salle">Nom de salle (ou numéro)</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="num_nom_salle" id="num_nom_salle" required>
                                                </div>
                                            </div><br/>


                                            <div class="control-group">
                                                <label class="control-label" for="type_salle">Type Salle</label>
                                                <div class="controls">
                                                    <select type="text" class="form-control" name="type_salle" id="type_salle" required>
                                                      <option value="Salle de soins" selected>Salle de soins</option>
                                                      <option value="Salle d'examen">Salle d'examen</option>
                                                      <option value="Bloc Opératoire">Bloc Opératoire</option>
                                                      <option value="Salle d'attente">Salle d'attente</option>
                                                      <option value="Salle de réunion">Salle de réunion</option>
                                                    </select>
                                                </div>
                                            </div><br/>



                                            <div class="control-group">
                                                <label class="control-label" for="etage_salle">Etage Salle: &nbsp;</label>

                                                <input name="etage_salle" id='etage_salle' class="form-control" list="etageSalle" required>

                                                    <datalist id="etageSalle"> 
                                                        <option value="--">--</option>
                                                        <option value="RDC">Rez-de-chaussée</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="sous-sol:" disabled>sous-sol:</option>
                                                        <option value="-1">-1</option>
                                                        <option value="-2">-2</option>
                                                        <option value="-3">-3</option>
                                                    </datalist> 
                                            </div>

                                            <br/><br/>
                   
                          
                                            
                                            <ul id="breadcrumb">
                                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal" style="margin-right:10px;margin-bottom:10px;"> Annuler</button>
                                                <button type="submit" style="margin-right: 10px;" class="btn btn-warning pull-right"><span class="entypo-trash"></span>&nbsp;&nbsp;Ajouter</button>

                                            </ul>


                                            </fieldset>                    
                                        </form>
                            </div>                                                                     
                        </div>
                    </div>
                </div> 



    <button id="showUpdate" style="background-color: Transparent;background-repeat:no-repeat;cursor:none;border: none;overflow: hidden;outline:none;" data-toggle="modal" data-target="#updatesalle">  
    </button>


                <div class="modal fade"  id="updatesalle" role="dialog">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="titreModalUpdate"></h4>
                            </div>

                            <div class="modal-body" style="overflow-y: auto;">
                                <form action="fonctionnalites\mod\modSalle.php" class="form-container">
                                            <fieldset>


                                                <input type="hidden" name="faiseurU" <?php echo "value=".$idMedecin."";?> >

                                                <input type="hidden" name="idCabinetU" <?php echo "value=".$idCabinet."";?>>

                                                <input type="hidden" name="nomBDU" <?php echo "value=".$nomCabinet."";?>>

                                            <div id="resultSalle">
                                                
                                            </div>

                                            <br><br>
                   
                          
                                            
                                            <ul id="breadcrumbU">
                                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal" style="margin-right:10px;margin-bottom:10px;"> Annuler</button>
                                                <button type="submit" style="margin-right: 10px;" class="btn btn-warning pull-right"><span class="entypo-trash"></span>&nbsp;&nbsp;Modifier</button>

                                            </ul>


                                            </fieldset>                    
                                        </form>
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
    <script src="assets/js/progress-bar/src/jquery.velocity.min.js"></script>
    <script src="assets/js/progress-bar/number-pb.js"></script>
    <script src="assets/js/progress-bar/progress-app.js"></script>


    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="assets/js/preloader.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/load.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>



    
    <script type="text/javascript">

      function update_salle(id_sale){

            
        document.getElementById('resultSalle').innerHTML = "";
    
        $(document).ready(function(){

                            //$('#resultSalle').find('form')[0].reset();

                            var IdSal = id_sale;
                            var Cabi  = "<?php echo $nomCabinet; ?>";
                            

                                if (IdSal != "" && Cabi != ""){

                                    $.ajax({
                                          url:"fonctionnalites/affichage/afficherUneSalle.php",  
                                          type:"GET",  
                                          data:{IdSalle: IdSal, nomCabinet: Cabi},
                                          success:function(data)  
                                          {  
                                               if (data != "") {

                                                 $('#resultSalle').append(data);

                                                 document.getElementById('showUpdate').click();

                                               } 
                                               else{
                                               }
                                          }

                                    });

                                }      
                        });
        }
    </script>


</body>

</html>
<?php
}
else
{
header('location: ../../choixCabinet.php');
}

?>