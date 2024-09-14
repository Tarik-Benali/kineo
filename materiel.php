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
            <!-- BREADCRUMB --><br>
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
                <li><a href="#" title="Sample page 1">Materiel</a>
                </li>


                <li class="pull-right">
                    <div class="input-group input-widget">

                        <button style="border-radius:15px" id="addMateriel" class="btn btn-info" data-toggle="modal" data-target="#modalDAjoutMateriel">Ajout materiel</button>
                    </div>
                </li>
            </ul>
            <!-- END OF BREADCRUMB -->
            <!--  DEVICE MANAGER -->

<!---------------------------------------------------------- Materiels ---------------------------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableStaticClose">
                            <div class="title-alt">
                                <h6>
                                    Materiel</h6>
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
                                                <th>Nom</th>
                                                <th>Numéro de Série</th>
                                                <th>Affectation</th>
                                                <th>Supprimer</th>
                                                <th>Modifier</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                                
                                            <?php  getAllMateriel($nomCabinet,$idMedecin, $idCabinet); ?>
                                            
                                            
                                        </tbody>
                                    </table>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 


            <!-------------------------------------- Modal Ajout Materiel --------------------------------------------------------->
                
                <div class="modal fade"  id="modalDAjoutMateriel" role="dialog">
                    <div class="modal-dialog">
                                        
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">X</button>
                                <h4 class="modal-title">Ajout d'un nouveau materiel</h4>
                            </div>
                            
                            <div class="modal-body" style="height: 350px; overflow-y: auto;">

                                        <form action="fonctionnalites\ajout\ajoutMateriel.php" class="form-container">
                                            <fieldset>


                                                <input type="hidden" name="faiseur" <?php echo "value=".$idMedecin."";?> >

                                                <input type="hidden" name="idCabinet" <?php echo "value=".$idCabinet."";?>>

                                                <input type="hidden" name="nomBD" <?php echo "value=".$nomCabinet."";?>>


                                            <div class="control-group">
                                                <label class="control-label" for="nom_materiel">Nom de materiel</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="nom_materiel" id="nom_materiel" required>
                                                </div>
                                            </div><br/>


                                            <div class="control-group">
                                                <label class="control-label" for="num_serie_materiel">Numéro de série</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="num_serie_materiel" id="num_serie_materiel" required>
                                                </div>
                                            </div><br/>


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


                <!-------------------------------------- Modal Modification Materiel --------------------------------------------------------->


                <div class="modal fade"  id="updateMateriel" role="dialog">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" id="titreModalUpdate"></h4>
                            </div>

                            <div class="modal-body" style="overflow-y: auto;">
                                <form action="fonctionnalites\mod\modMateriel.php" class="form-container">
                                            <fieldset>


                                                <input type="hidden" name="faiseurU" <?php echo "value=".$idMedecin."";?> >

                                                <input type="hidden" name="idCabinetU" <?php echo "value=".$idCabinet."";?>>

                                                <input type="hidden" name="nomBDU" <?php echo "value=".$nomCabinet."";?>>

                                            <div id="resultMateriel">
                                                
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

                <button id="showUpdate" style="background-color: Transparent;background-repeat:no-repeat;cursor:none;border: none;overflow: hidden;outline:none;" data-toggle="modal" data-target="#updateMateriel">  
                </button>  

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
  

      function update_materiel(id_mat){

            
        document.getElementById('resultMateriel').innerHTML = "";
    
        $(document).ready(function(){

                            //$('#resultSalle').find('form')[0].reset();

                            var IdMat = id_mat;
                            var Cabi  = "<?php echo $nomCabinet; ?>";
                            

                                if (IdMat != "" && Cabi != ""){

                                    $.ajax({
                                          url:"fonctionnalites/affichage/afficherUnMateriel.php",  
                                          type:"GET",  
                                          data:{IdMateriel: IdMat, nomCabinet: Cabi},
                                          success:function(data)  
                                          {  
                                               if (data != "") {

                                                 $('#resultMateriel').append(data);

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