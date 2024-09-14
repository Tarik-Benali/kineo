<?php
    include("auth/auth.php");
    include("includes/functions.php");

    if (isset($_SESSION['idDeCeCabinet']) || (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5")) {

    $typeProfil ="";
    $faiseur    ="";

        if (isset($_SESSION['idDeCeCabinet']) && $_SESSION['typeCompte'] =="2") {
                                              
            $idCabinet        = $_SESSION['idDeCeCabinet'];

            $nomCabinet       = $_SESSION['nomDeCeCabinet'];

            $adresseCabinet   = $_SESSION['adresseDeCeCabinet'];

            $idMedCab         = $_SESSION['idDeCeMedCab'];

            $idMedecin        = $_SESSION['idDeCeMedecin'];

            $typeProfil       = "medecin";
            $faiseur          = $idMedecin;


        }elseif (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5") {
               
            $idCabinet        = $_SESSION['idCabinet'];

            $nomCabinet       = $_SESSION['nomCabinet'];

            $idStaff          = $_SESSION['identifiant'];


            $typeProfil  ="staff";
            $faiseur     = $idStaff;
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Virtuhos v 0.1</title>
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

    <link rel="stylesheet" type="text/css" href="assets/js/tag/jquery.tagsinput.css">

    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/mail.css">

    <link rel="stylesheet" href="assets/js/dropZone/downloads/css/dropzone.css" />




    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/minus.png">

    <style type="text/css">
        html {
          scroll-behavior: smooth;
        }
        .aParent div {
            float: left;
            clear: none; 
            margin-bottom: 20px;
        }
    </style>
</head>

<?php include("fragmentsPages/bodyTheme.php"); ?>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- TOP NAVBAR -->


<?php if($typeProfil == "medecin"){ 

    //<!-- TOP NAVBAR -->
    include("fragmentsPages/barDeNavigation.php");         
    //<!-- /END OF TOP NAVBAR -->

    //<!-- SIDE MENU -->
    include("fragmentsPages/menuPrincipal.php"); 
    //<!-- END OF SIDE MENU -->
    }


    else if($typeProfil == "staff"){ 

        

    //<!-- TOP NAVBAR -->
    include("fragmentsPages/fragmentsStaff/barDeNavigation.php");       
    //<!-- /END OF TOP NAVBAR -->
    }
?>    


 
    <!--  PAPER WRAP -->
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
                    <div class="col-sm-12">
                        <!-- SIDEMENU MAIL -->
                        <div class="nest" id="FilteringClose4">
                            <div class="title-alt">
                                <h6>
                                    Ajout d'un nouveau praticien au cabinet</h6>
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
                            <div class="form_center">
                                <form action="fonctionnalites/ajout/ajoutMedecin.php" id="contact-form" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    <fieldset>

                                        <input type="hidden" name="nomCabinet" value="<?php echo $nomCabinet;?>">
                                        <input type="hidden" name="idCabinet" value="<?php echo $idCabinet;?>">
                                        <input type="hidden" name="idMedecin" value="<?php echo $faiseur;?>">

                                        <div class="aParent">
                                            <div style="width: 48%; margin-right: 2%;">
                                                <label class="control-label" for="name">Nom<span style="color:red">&nbsp;*</span></label>
                                                <br>
                                                <input type="text" class="form-control" name="name" id="name" required>
                                            </div>

                                            <div style="width: 48%; margin-right: 2%;" id="email">
                                                <label class="control-label" for="prenom">Prenom<span style="color:red">&nbsp;*</span></label>
                                                <br>
                                                <input type="text" class="form-control" name="prenom" id="prenom" required>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="aParent">
                                            <div style="width: 48%; margin-right: 2%;">
                                                <label class="control-label" for="dateN">Date de naissance<span style="color:red">&nbsp;*</span></label>
                                                <br>
                                                <input type="text" class="form-control" id="dp1" value="01-01-1980" name="dateN" required>
                                            </div>

                                            <div style="width: 48%; margin-right: 2%;">
                                                <label class="control-label" for="lieuN">Lieu de Naissance</label>
                                                <br>
                                                <input type="text" class="form-control" name="lieuN" id="lieuN">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="control-group">
                                            <label class="control-label" for="adresse">Adresse</label>
                                            <div class="controls">
                                                <input type="text" class="form-control" name="adresse" id="adresse">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="aParent">
                                                <div style="width: 48%; margin-right: 2%;">
                                                    <label class="control-label" for="phone">Téléphone<span style="color:red">&nbsp;*</span></label>
                                                    <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" required>
                                                </div>

                                                <div style="width: 48%; margin-right: 2%;" id="email">
                                                    <label class="control-label" for="mail">Adresse Mail</label>
                                                    <input type="email" class="form-control" name="email" id="mail">
                                                </div>
                                        </div>
                                        
                                        <div class="aParent">
                                            <div style="width: 48%; margin-right: 2%;" id="email">
                                                <label class="control-label" for="groupeSanguin">Groupage:</label>
                                                <br>
                                                <input name="groupeSanguin" id='group'class="form-control" placeholder="Groupe sanguin" list="groupeSanguin">
                                                <datalist id="groupeSanguin"> 
                                                    <option value="--">--</option>
                                                    <option value="O-">O-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="A+">A+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="AB+">AB+</option>
                                                </datalist>
                                            </div>
                                            <div style="width: 48%;">
                                                <label class="control-label" for="sexe">Sexe Médecin:<span style="color:red">&nbsp;*</span></label>
                                                <br>
                                                <div class=" form-inline" style="padding-top: 1%">
                                                    <input tabindex="11" type="radio" id="homme" name="sexe" value="Homme">
                                                    <label for="homme" style="color: #373838; font-size: 115%;">Homme</label>

                                                    <input tabindex="12" type="radio" id="femme" name="sexe" value="Femme">
                                                    <label for="femme" style="color: #373838; font-size: 115%;">Femme</label>
                                                </div>
                                            </div>
                                        </div>

                                        <br>
                                        <hr>

                                        <div class="form-actions" style="margin:20px 0 0 0;">
                                            <input class="btn btn-info" id="suivant" data-toggle="modal" data-target="#ajoutPatientModal" value="Suivant">
                                            <button type="reset" class="btn" id="btnres">Annuler</button>
                                        </div>
                                    </fieldset>

                                    <div class="container">
                                        <div class="modal fade"  id="ajoutPatientModal" role="dialog">
                                            <div class="modal-dialog">              
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">x</button>
                                                        <h4 class="modal-title">Infos Médecin</h4>
                                                    </div>

                                                    <div class="modal-body" style="height: 100%; overflow-y: auto;">

                                                        <div id="username">

                                                        </div>

                                                        <div id="contenumodal">
                                                        </div>
                                                        
                                                    </div>
                                                </div>                                                                  
                                            </div>
                                        </div> 
                                    </div>
                                </form>
                            </div>
                        </div>        
                        <!-- /CONTENT MAIL -->
                    </div>
                </div>
            </div>



            <!-- /END OF CONTENT -->


            <!-- FOOTER -->
            <?php include("fragmentsPages/footer.php"); ?>   
            <!-- / END OF FOOTER -->

        </div>
    </div>
    <!--  END OF PAPER WRAP -->

    <!-- RIGHT SLIDER CONTENT -->

    <?php 
        if($typeProfil == "medecin"){ 

            include("fragmentsPages/menuSecondaire.php");
        }

        elseif($typeProfil == "staff"){

            //include("fragmentsPages/menuSecondaire.php");
        }
    ?>


    <!-- END OF RIGHT SLIDER CONTENT-->

    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="assets/js/preloader.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/load.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

    <script type="text/javascript" src="assets/js/colorPicker/bootstrap-colorpicker.min.js"></script>
    <script type="text/javascript" src="assets/js/inputMask/jquery.maskedinput.js"></script>
    <script type="text/javascript" src="assets/js/switch/bootstrap-switch.js"></script>
    <script type="text/javascript" src="assets/js/validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="assets/js/idealform/jquery.idealforms.js"></script>

    <script type="text/javascript" src="assets/js/timepicker/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/clockface.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/bootstrap-datetimepicker.js"></script>


    <script type="text/javascript" src="assets/js/tag/jquery.tagsinput.js"></script>


<script type="text/javascript">
    $('#datetimepicker1').datetimepicker({
        language: 'pt-BR'
    });
    $('#dp1').datepicker()
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

    $(document).ready(function(){

        $("#DropZone").hide();
        $("#imageZone").hide();
            $("#afficherAddDocs").click(function(){
              $("#DropZone").show();
              $("#imageZone").show();
              document.getElementById("upload_img").click();
            });
      });
    </script>

    <script>  
//Les trois Scripts suivant c'est pour la gestion des cases vide !      
         $(document).ready(function () {

              $('#suivant').attr('disabled', true);

              var sexe = 'vide';

                    $("#homme").click(function(){
                        if($('input[type=checkbox]:checked').length == 0){

                           sexe = "Homme";
                        }
                    })

                    $("#femme").click(function(){
                        if($('input[type=checkbox]:checked').length == 0){

                           sexe = "Femme";
                        }
                    })


              $('#name, #prenom, #dp1, #lieuN, #adresse, #email, #phone, #group').on('keyup', function () {
                  
                  
                  var name    = $("#name").val();
                  var prenom  = $("#prenom").val();
                  var dp1     = $("#dp1").val();
                  var lieuN   = $("#lieuN").val();
                  var adresse = $("#adresse").val();
                  var mail    = $("#mail").val();
                  var phone   = $("#phone").val();
                  var group   = $("#group").val();


                    if (name != '' && prenom != '') 
                        {
                            $('#suivant').attr('disabled', false);

                            document.getElementById('contenumodal').innerHTML = "<dl class=\"dl-horizontal-profile profile-name\" style=\"padding-left: 2%\"><dt>Nom</dt><dd>" + name + "</dd><dt>Prénom</dt><dd>" + prenom + "</dd><dt>Date de naissance</dt><dd>" + dp1 + "</dd><dt>Lieu de naissance</dt><dd>" + lieuN + "</dd><dt>Adresse</dt><dd>" + adresse + "</dd><dt>Email</dt><dd>" + mail + "</dd><dt>Numéro de téléphone</dt><dd>" + phone + "</dd><dt>Sexe</dt><dd>" + sexe + "</dd><dt>Groupage Sangin</dt><dd>" + group + "</dd></dl><button type=\"submit\" class=\"btn btn-primary\">Ajouter</button><button type=\"reset\" class=\"btn\" id=\"annul\">Annuler</button>";
                        }
                    else
                    {
                        $('#suivant').attr('disabled', true);
                    } 
              });
          });                                
    </script>

    <script>  
        
        //Les trois Scripts suivant c'est pour la gestion des cases vide !      
         $(document).ready(function () {

            $("#suivant").click(function(){

                  
                  $('#username').html('');

                  var Name    = $("#name").val();
                  var Prenom  = $("#prenom").val();
                  var Ddn     = $("#dp1").val();
                  

                    if (Name != '' && Prenom != '' && Ddn != ''){

                        $('#username').html('');

                      $.ajax({
                          url:"fonctionnalites/affichage/generateUsername.php",  
                          type:"GET",  
                          data:{nom: Name, prenom: Prenom, ddn: Ddn},  
                          success:function(data)  
                          {    
                                $('#username').append(data);                               
                          }  
                      });
                    }              
            });
          });                                
    </script>

    <script>  
//Les trois Scripts suivant c'est pour la gestion des cases vide !      
         $(document).ready(function () {

            $("#btnres").click(function(){

                $('#suivant').attr('disabled', true);
            });

            $("#annul").click(function(){

               $('#suivant').attr('disabled', true);             
            });
          });                                
    </script>
    

</body>

</html>

<?php
}
else
{
    if($typeProfil == "medecin"){ 

            header('location: ../../choixCabinet.php');
    }

    else if($typeProfil == "staff"){ 

            header('location: auth/logout.php'); 
    }

    else{
        header('location: auth/logout.php');
    }
}
?>

