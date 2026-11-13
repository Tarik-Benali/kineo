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

            $typeProfil  = "medecin";
            $faiseur     = $idMedecin;

            $nomMedecin  = getMedecinName($idMedecin);


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
        .calendar-disp::-webkit-calendar-picker-indicator {
          display: block;
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
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">

            <!-- CONTENT -->
            <!--TITLE -->

            <!--/ TITLE -->

            <!-- BREADCRUMB -->
            <?php 

                if($typeProfil == "medecin"){ 

                    include("fragmentsPages/entet.php");
                }

                else if($typeProfil == "staff"){ 

                    include("fragmentsPages/fragmentsStaff/entet.php");
                }
            ?>

            <!-- END OF BREADCRUMB -->

            <div class="content-wrap">
                <div class="row">
                    <!-- SIDEMENU MAIL -->
                    <div class="body-nest" id="validation">
                                <div class="form_center">
                                    <form action="fonctionnalites/ajout/ajoutPatient.php" id="contact-form" class="form-horizontal" method="post" enctype="multipart/form-data">
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
                                                    <label class="control-label" for="dateN">Date de naissance</label>
                                                    <br>
                                                    <input type="text" class="form-control calendar-disp" id="dp1" value="01-01-1980" name="dateN" required>
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
                                                    <div style="width: 48%; margin-right: 2%;">
                                                        <label class="control-label" for="phone2">Deuxième Numéro de Téléphone</label>
                                                        <input type="tel" class="form-control" id="phone2" name="phone2" pattern="[0-9]{10}">
                                                    </div>

                                                    <div style="width: 48%; margin-right: 2%;">
                                                        <label class="control-label" for="phone3">Troisième Numéro de Téléphone</label>
                                                        <input type="tel" class="form-control" id="phone3" name="phone3" pattern="[0-9]{10}">
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
                                                    <label class="control-label" for="sex">Sexe Patient:<span style="color:red">&nbsp;*</span></label>
                                                    <br>
                                                    <div class=" form-inline" style="padding-top: 1%">
                                                        <input type="radio" name="sexe" id="sexeHomme" class="radio" value="Homme" checked/>Homme&nbsp;
                                                        <input type="radio" name="sexe" id="sexeFemme" class="radio" value="Femme" />Femme
                                                    </div>
                                                </div>
                                            </div>

                                            <br>

                                            <div class="aParent">
                                                <div style="width: 100%;" id="patho">
                                                    <label class="control-label" for="groupeSanguin">Pathologie:</label>
                                                    <br>
                                                    <select name="pathologie[]" id="pathologie" class="form-control" style="height: 100px !important;" multiple> 
                                                        <option value="0" selected>--</option>
                                                        <?php pathologies($nomCabinet); ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <br>
                                            <hr>

                                            <div class="control-group">
                                                <label class="control-label" for="medecin_prs">Médecin Prescripteur</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="medecin_prs" id="medecin_prs">
                                                </div>
                                            </div><br>

                                            <div class="control-group">
                                                <label class="control-label" for="profession">Profession</label>
                                                <div class="controls">
                                                    <input type="text" class="form-control" name="profession" id="profession">
                                                </div>
                                            </div><br>

                                            <div class="control-group">
                                                <label class="control-label" for="bilan">Bilan</label>
                                                <div class="controls">
                                                    <textarea style="width: 100%; height: 100px;" name="bilan" id="bilan" placeholder="Bilan patient..."></textarea>
                                                </div>
                                            </div><br>

                                            <div class="control-group">
                                                <label class="control-label" for="med_rsposable">Kiné responsable: &nbsp;</label>
                                                <input type="text" class="form-control" value="<?php echo $nomMedecin;?>" disabled>
                                                <input type="hidden" name="med_rsposable" id="med_rsposable" value="<?php echo $idMedecin;?>">
                                            </div>

                                            <a id="afficherAddDocs" type="file" href="#DropZone">Ajouter des documents</a>
                                            <input type="file" name="upload_photo" id="upload_img" onchange="readImgURL(this);" style="visibility: hidden;"
                                            <img src="assets/img/menAvatar.png"  id="imageZone" width="120" height="120" alt="" class="center">

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
                                                            <h4 class="modal-title">Infos patient</h4>
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
    //$('#dp1').datepicker()
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


              $('#name, #prenom, #dp1, #lieuN, #adresse, #email, #phone, #group').on('keyup', function () {
                  
                  var name    = $("#name").val();
                  var prenom  = $("#prenom").val();
                  var phone   = $("#phone").val();
                  /*var dp1     = $("#dp1").val();
                  var lieuN   = $("#lieuN").val();
                  var adresse = $("#adresse").val();
                  var mail    = $("#mail").val();
                  var group   = $("#group").val();*/

                    if (name != '' && prenom != '' && phone != '') 
                        {
                            $('#suivant').attr('disabled', false);
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

                var sexe    = "";

                var name    = $("#name").val();
                var prenom  = $("#prenom").val();
                var dp1     = $("#dp1").val();
                var lieuN   = $("#lieuN").val();
                var adresse = $("#adresse").val();
                var mail    = $("#mail").val();
                var phone   = $("#phone").val();
                var group   = $("#group").val();

                var rates = document.getElementsByName('sexe');
                    for(var i = 0; i < rates.length; i++){
                        if(rates[i].checked){
                            sexe      = rates[i].value;
                        }
                    }

                    if (name != '' && prenom != '' && phone != '') 
                        {
                            $('#suivant').attr('disabled', false);

                            document.getElementById('contenumodal').innerHTML = "<dl class=\"dl-horizontal-profile profile-name\" style=\"padding-left: 2%\"><dt>Nom</dt><dd>" + name + "</dd><dt>Prénom</dt><dd>" + prenom + "</dd><dt>Date de naissance</dt><dd>" + dp1 + "</dd><dt>Lieu de naissance</dt><dd>" + lieuN + "</dd><dt>Adresse</dt><dd>" + adresse + "</dd><dt>Email</dt><dd>" + mail + "</dd><dt>Numéro de téléphone</dt><dd>" + phone + "</dd><dt>Sexe</dt><dd>"+ sexe +"</dd><dt>Groupage Sangin</dt><dd>" + group + "</dd></dl><button type=\"submit\" class=\"btn btn-primary\">Ajouter</button>&nbsp;&nbsp;<button type=\"reset\" data-dismiss=\"modal\" class=\"btn\" id=\"annul\">Annuler</button>";
                        }

                  
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

    <script>

            /*$(document).ready(function(){  

            //name_file

                document.getElementById('btn_upload_img').addEventListener('click', openDialog);
                function openDialog() {
                    document.getElementById('upload_img').click();
                    }
                   document.getElementById('upload_img').addEventListener('change', readImgURL(this));
              
            });*/
            
            
          function readImgURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#imageZone')
                                .attr('src', e.target.result)
                                .width(120)
                                .height(120);
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }

/*

        function readFileURL(input) {
                    
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        var name = input.files[0].name;

                        reader.onload = function (e) {
                            $('#file_to_upload')
                                //.attr('src', e.target.result)
                                .attr('src', 'assets/content/attache.png')
                                .width(120)
                                .height(120);
                        };
                        reader.readAsDataURL(input.files[0]);

                        document.getElementById("name_file").innerHTML = name;
                        $('#name_file').show();
                    }
                }*/
/*
        function sendPhotoForm(formID,loading){

             var frm = $('#'+formID);
             //alert("0");
             var dat =  new FormData(uploadmedim);
                
            $('#closeenvimg'). click();
            $('#loading').modal('show');
            
            frm.encoding = "multipart/form-data";
                
            frm.submit(function (e){

                e.preventDefault();
                    // alert("1");
                
                $.ajax({
                    
                    type: frm.attr('method'),
                    url:  frm.attr('action'),
                    data: dat,           
                    processData: false,
                    contentType: false,
                    
                    success: function (data) {
                         
                       // alert("2");
                        document.getElementById("loadingDiv").innerHTML = "";
                        document.getElementById("loadingDiv").innerHTML = "<p style='text-align: center;'>Fichier envoyé avec succès !</p>";
                        document.getElementById("closeLoadingModal").style.display="block";
                        console.log(data);
                        //frm="";

                        dat = "";
                    },
                    
                    error: function (data) {
                        document.getElementById("loadingDiv").innerHTML = "<p style='text-align: center; color:red;'>Une erreur est survenu lors de l'envoi du fichier !</p>";
                        document.getElementById("closeLoadingModal").style.display="block";
                        console.log(data);
                    },
                });
            });

          }*/

      /*  function sendFileForm(formID,loading){

             var frm = $('#'+formID);
            // alert("0");
             var dat =  new FormData(uploadmedfich);
                
            $('#closemodalfich'). click();
            $('#loading').modal('show');
            
            frm.encoding = "multipart/form-data";
                
            frm.submit(function (e){

                e.preventDefault();
                    // alert("1");
                
                $.ajax({
                    
                    type: frm.attr('method'),
                    url:  frm.attr('action'),
                    data: dat,           
                    processData: false,
                    contentType: false,
                    
                    success: function (data) {
                         
                        //alert("2");
                        document.getElementById("loadingDiv").innerHTML = "";
                        document.getElementById("loadingDiv").innerHTML = "<p style='text-align: center;'>Fichier envoyé avec succès !</p>";
                        document.getElementById("closeLoadingModal").style.display="block";
                        console.log(data);
                        //frm="";

                        dat = "";
                    },
                    
                    error: function (data) {
                        document.getElementById("loadingDiv").innerHTML = "<p style='text-align: center; color:red;'>Une erreur est survenu lors de l'envoi du fichier !</p>";
                        document.getElementById("closeLoadingModal").style.display="block";
                        console.log(data);
                    },
                });
            });

          }*/
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

