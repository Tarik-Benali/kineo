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
        $motif = "orientation";
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

                          </h1><?php //echo $idConsultation;?></h1>


            <!--  DEVICE MANAGER -->

                        <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="headerClose">
                            <div class="title-alt">
                                <h6>
                                    Lettre d'Orientation</h6>
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

                                <form action="impression/ordonnanceOrient.php" name="lettre_orien_form" id="lettre_orien_form" method="post">

                                            <div class="form_center">

                                                        <?php if (isset($_REQUEST["idPatient"]) && $_REQUEST["idPatient"] != "0000") {
                                                                    $identifiantPatient = $_REQUEST["idPatient"];

                                                                         infoPatientPourOrdonnance($identifiantPatient);         

                                                                } else {?>

                                                        <div class="control-group">   
                                                            <label class="control-label" for="nom">Nom Patient</label>
                                                            <div class="controls">
                                                                <input type="text" class="form-control" name="nom" id="nom">
                                                            </div>
                                                        </div>
                                                        <div class="control-group">
                                                            <label class="control-label" for="prenom">Prenom Patient</label>
                                                            <div class="controls">
                                                                <input type="text" class="form-control" name="prenom" id="prenom">
                                                            </div>
                                                        </div>
                                                        <div class="control-group" id="age">
                                                            <label class="control-label" id="age" for="age">Age Patient</label>
                                                            <div class="controls">
                                                                <input type="text" class="form-control" name="age" id="age">
                                                            </div>
                                                        </div>

                                                        <?php }  ?>
                                            </div>
                                   
                                    <br>

                                    <div class="control-group">
                                           <label class="control-label" for="name">Lettre</label>    
                                    </div>                                    

                                    <div id="toolbar" style="display: none;">

                                        <div data-wysihtml5-dialog="createLink" style="display: none;">
                                            <label>
                                                Link:
                                                <input data-wysihtml5-dialog-field="href" value="http://">
                                            </label>
                                            <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
                                        </div>

                                        <div data-wysihtml5-dialog="insertImage" style="display: none;">
                                            <label>
                                                Image:
                                                <input data-wysihtml5-dialog-field="src" value="http://">
                                            </label>
                                            <label>
                                                Align:
                                                <select data-wysihtml5-dialog-field="className">
                                                    <option value="">default</option>
                                                    <option value="wysiwyg-float-left">left</option>
                                                    <option value="wysiwyg-float-right">right</option>
                                                </select>
                                            </label>
                                            <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
                                        </div>

                                    </div>
                                    <textarea style="width: 100%; height: 300px" id="textarea" name="lettre" placeholder="Tapez votre message ici..."></textarea>
                                    <br>

                                    <input type="hidden" name="idCons" value="<?php echo $idConsultation;?>">
                                    <input type="hidden" name="motif" value="<?php echo $motif;?>">

                                    <input class="btn btn-info" id="imprim" onclick="printOrdonnance()" value="Imprimer" data-toggle="modal" data-target="#myModal" />    

                                    <button type="reset" class="btn btn-info" value="Reset form!">
                                        <span class="entypo-trash"></span>&nbsp;&nbsp;Effacer Tout</button>

                                </form>

                                <div class="form-actions" style="margin:20px 0 0 0;">
                                    
                                    
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

<!-------------------------------------------------------- Modal ---------------------------------------------------------------->
    
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog" style="height: 100%; width: 35%;">

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

        function printOrdonnance() {

            $('#modalOrd').html('');  
                    document.getElementById("modalOrd").innerHTML = "";           
                   $.ajax({  
                        url:"impression/ordonnanceOrient.php",  
                        method:"POST",  
                        data:$("#lettre_orien_form").serialize(),  
                        success:function(data)  
                        {  
                             $('#modalOrd').append(data);  
                             //$('#lettre_orien_form')[0].reset();  
                        }  
                   }); 
          }

    </script>

    <script>  


        $(document).ready(function(){  


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
              
         });  

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