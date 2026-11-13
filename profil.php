<?php
    include("auth/auth.php");
    include("includes/historique.php");
    include("includes/functions.php");

    if (isset($_SESSION['identifiant'])) {

    $identifiant      = $_SESSION['identifiant'];

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

    <link rel="stylesheet" href="assets/css/profile.css">



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
            <ul id="breadcrumb" style="margin-left: 1%">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Virtuhos</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Profil</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <button id="modifier" style="border-radius:15px" class=" btn btn-success">Modifier mon profil</button>
                        <button id="afficher" style="border-radius:15px" class=" btn btn-info">Afficher mon profil</button>
                    </div>
                </li>
            </ul>


            <div class="content-wrap" id="infoProfil">
                <!-- PROFILE -->
                <div class="row" >
                    <div class="col-sm-12">
                        <?php include("fonctionnalites/affichage/affichageProfil.php"); ?>
                    </div>

                </div>  
            </div>      

                
                <!-- END OF PROFILE -->


                <!-- /END OF CONTENT -->  
            <div class="content-wrap" id="modProfil">
                <div class="row">
                        <div class="col-sm-12">
                            <?php include("fonctionnalites/mod/modProfil.php"); ?>
                        </div>
                        <div class="pull-right">
                            <div class="input-group input-widget">
                                <button id="modifierPass" style="border-radius:15px; margin-right: 5px; margin-top: 10px;" class="btn btn-success" data-toggle="modal" data-target="#updatePass">Modifier Mot de passe</button>
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


    <!-- Modal -->
    <div class="modal fade" id="updatePass" tabindex="-1" role="dialog" aria-labelledby="modifierPassLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modifierPassLabel">Modification Mot de passe</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form_center">
                <form role="form">
                    <div class="form-group">
                        <label for="ancienMP">Ancien mot de passe</label>
                        <input type="password" placeholder="Ecrivez votre ancien Mot de passe" id="ancienMP" name="ancienMP" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nouvMP1">Nouveau mot de passe</label>
                        <input type="password" placeholder="Ecrivez votre nouveau mot de passe" id="nouvMP1" name="nouvMP1" class="form-control" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="nouvMP2">Confirmation mot de passe</label>
                        <input type="password" placeholder="Merci de resaisir le nouveau mot de passe" id="nouvMP2" name="nouvMP2" class="form-control" autocomplete="off">
                        <div class="row">
                            <div class="col-sm-12">
                                <span id="pwmatch" class="glyphicon glyphicon-remove" style="color:#FF0004;"></span> Mots de passe identiques
                            </div>
                        </div>
                    </div>

                    <div id="divResponse"></div>
                </form>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" onclick="updatePassword()">Modifier</button>
          </div>
        </div>
      </div>
    </div>
  


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


</body>

    <script>
      
      var doubleTiwawati = "false"; 

      $(document).ready(function(){
        $("#modProfil").hide();
        $("#afficher").hide();
            $("#modifier").click(function(){
              $("#modProfil").show();
              $("#afficher").show();
              $("#infoProfil").hide();
              $("#modifier").hide();
            });
            $("#afficher").click(function(){
              $("#infoProfil").show();
              $("#modifier").show();
              $("#modProfil").hide();
              $("#afficher").hide();
            });
      });


        $("input[type=password]").keyup(function(){

            if($("#nouvMP1").val() == $("#nouvMP2").val()){
                $("#pwmatch").removeClass("glyphicon-remove");
                $("#pwmatch").addClass("glyphicon-ok");
                $("#pwmatch").css("color","#00A41E");

                doubleTiwawati = "true";
            }else{
                $("#pwmatch").removeClass("glyphicon-ok");
                $("#pwmatch").addClass("glyphicon-remove");
                $("#pwmatch").css("color","#FF0004");

                doubleTiwawati = "false";
            }
        });

        function updatePassword(){
            var ancien = document.getElementById("ancienMP").value;
            var nouv1  = document.getElementById("nouvMP1").value;
            var nouv2  = document.getElementById("nouvMP2").value;

            var Iduser = "<?php echo $identifiant;?>";

            document.getElementById('divResponse').innerHTML = "";

            if (doubleTiwawati =="true") {

                $.ajax({
                  url:"fonctionnalites/mod/modPassword.php",  
                  type:"GET",  
                  data:{ancien: ancien,nouv: nouv1,idUser:Iduser},
                  success:function(data)  
                    {  
                        if (data != ""){
                            $('#divResponse').append(data);
                            console.log(" | : " + data);
                        } else{
                            document.getElementById('divResponse').innerHTML = "<div style='font-size:20xp;text-align:center;margin-top:10xp;color: red;'>Modification échouée !</div>";
                        }
                    }  
                });

            }else{
                alert(doubleTiwawati + " : " + nouv2);
            }
        }

    </script>

</html>
<?php
}
else
{
header('location: logout.php');
}

?>



