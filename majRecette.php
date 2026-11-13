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

    <link href="assets/js/footable/css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable.standalone.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable-demos.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="assets/js/tag/jquery.tagsinput.css">

    <link href="assets/js/textEditor/editor.css" rel="stylesheet">
    <link href="assets/js/textEditor/sceditor/minified/themes/square.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/js/textEditor/src/bootstrap-wysihtml5.css" />

    <link rel="shortcut icon" href="assets/ico/minus.png">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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
                <li><a href="#" title="Sample page 1">Payement</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Historique</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Recherche..." class="form-control">
                    </div>
                </li>
            </ul>
            <!-- END OF BREADCRUMB -->
            <!--  DEVICE MANAGER -->

<!-------------------------------------------------------------- Recettes --------------------------------------------------->

            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="tableTotalRecetteJournaliereZ">
                            <div class="title-alt">
                                <h6>
                                    Historique des payements</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tableTotalRecetteJournaliereZ">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#divTotalRecetteZ">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="body-nest" id="divTotalRecetteZ">

                                <section id="flip-scroll">

                                    <div class="row" style="margin-bottom:10px;">
                                        <div class="col-sm-3">
                                            <input class="form-control" id="recherchePatient" placeholder="Recherche patient..." type="text"/>
                                        </div>
                                        <div class="col-sm-2">
                                            <a href="#" style="margin-left:10px;" class="btn btn-info clear-filter" onclick="searchForPatient()">Recherche</a>
                                        </div>

                                    </div>

                                    <?php 

                                        if (isset($_GET['patient_search']) && $_GET['patient_search'] != "") { 

                                            $NomPhonePatient = (String) trim($_GET['patient_search']);

                                            ?>

                                            <script type="text/javascript">window.history.pushState("", "Modification Paiements", "majRecette.php");</script>


                                            <table class="table table-bordered table-striped cf">
                                                <thead class="cf">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Heure</th>
                                                        <th>Patient</th>
                                                        <th>Praticien</th>
                                                        <th>Prix</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                    
                                                    <?php 

                                                        global $host_name;
                                                        global $db_user_name;
                                                        global $db_password;

                                                        $database   = crypterNomDeLaBase($nomCabinet);

                                                            $date    = date('d/m/Y');  
                                                            $toDay   = date('Y-m-d'); 

                                                            try
                                                                {
                                                                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                                                                    $reponse = $bdd->query("SELECT * FROM `addition`,`patient`,`medecin` WHERE addition.idPatient = patient.idPatient AND addition.idMedecin = medecin.idMedecin AND (nomPatient LIKE '$NomPhonePatient%' OR prenomPatient LIKE '$NomPhonePatient%' OR numTelPatient LIKE '$NomPhonePatient%')");

                                                                    $nbr = $reponse->rowCount();

                                                                    if ($nbr > 0) {
                                                                        while ($donnees = $reponse->fetch())
                                                                            {
                                                                               $heure       = $donnees['heure'];
                                                                               $idAddit     = $donnees['id_addition'];
                                                                               $medecin     = $donnees['nomMedecin'];
                                                                               $addition    = $donnees['addition'];
                                                                               $date_cons   = $donnees['date_cons'];
                                                                               $prenomPat   = $donnees['prenomPatient'];
                                                                               $nomPatient  = $donnees['nomPatient'];

                                                                               $patient     = $nomPatient . " " . $prenomPat;
                                                                               $heures      = substr($heure,0,8);

                                                                               echo "<tr>
                                                                                        <td>".$date_cons."  </td>
                                                                                        <td>".$heures."     </td>
                                                                                        <td>".$patient."    </td>
                                                                                        <td>".$medecin."    </td>
                                                                                        <td>".$addition." da</td>
                                                                                        <td>
                                                                                            <input type=\"button\" id=\"modAddition\" class=\"btn btn-success\" style=\"margin-right: 10px;\" value=\"Modifier\" onclick=\"updateAddition('$idAddit','$addition');\" data-toggle=\"modal\" data-target=\"#modalModifAddition\"/>
                                                                                        </td>
                                                                                    </tr>";
                                                                            }
                                                                    }else{
                                                                        echo "<tr><td>Aucun enregistrement de paiement avec les données du patient entrées ($NomPhonePatient)</td></tr>";
                                                                    }                 
                                                                    
                                                                   $reponse->closeCursor();
                                                                }

                                                            catch(Exception $e)
                                                                {
                                                                   die('Erreur : '.$e->getMessage());
                                                                }
                                                    ?>
                                                    
                                                </tbody>
                                            </table>

                                        <?php }else{ ?>

                                            <table class="table table-bordered table-striped cf">
                                                <thead class="cf">
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Heure</th>
                                                        <th>Patient</th>
                                                        <th>Praticien</th>
                                                        <th>Prix</th>
                                                        <th>Option</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                    
                                                    <?php 

                                                        global $host_name;
                                                        global $db_user_name;
                                                        global $db_password;

                                                        $database   = crypterNomDeLaBase($nomCabinet);

                                                            $date    = date('d/m/Y');  
                                                            $toDay   = date('Y-m-d'); 

                                                            try
                                                                {
                                                                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                                    $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);


                                                                    $reponse = $bdd->query("SELECT * FROM `addition`,`patient`,`medecin` WHERE addition.idPatient = patient.idPatient AND addition.idMedecin = medecin.idMedecin AND date_cons = '$toDay'");
                                                                    $nbr = $reponse->rowCount();

                                                                    if ($nbr > 0) {
                                                                        while ($donnees = $reponse->fetch())
                                                                            {
                                                                               $heure       = $donnees['heure'];
                                                                               $idAddit     = $donnees['id_addition'];
                                                                               $medecin     = $donnees['nomMedecin'];
                                                                               $addition    = $donnees['addition'];
                                                                               $date_cons   = $donnees['date_cons'];
                                                                               $prenomPat   = $donnees['prenomPatient'];
                                                                               $nomPatient  = $donnees['nomPatient'];

                                                                               $patient     = $nomPatient . " " . $prenomPat;
                                                                               $heures      = substr($heure,0,8);

                                                                               echo "<tr>
                                                                                        <td>".$date_cons."  </td>
                                                                                        <td>".$heures."     </td>
                                                                                        <td>".$patient."    </td>
                                                                                        <td>".$medecin."    </td>
                                                                                        <td>".$addition." da</td>
                                                                                        <td>
                                                                                            <input type=\"button\" id=\"modAddition\" class=\"btn btn-success\" style=\"margin-right: 10px;\" value=\"Modifier\" onclick=\"updateAddition('$idAddit','$addition');\" data-toggle=\"modal\" data-target=\"#modalModifAddition\"/>
                                                                                        </td>
                                                                                    </tr>";
                                                                            }
                                                                    }else{
                                                                        echo "<tr><td>Aujourd'hui ($date)</td><td>Aucune activité enregistré !</td></tr>";
                                                                    }                 
                                                                    
                                                                   $reponse->closeCursor();
                                                                }

                                                            catch(Exception $e)
                                                                {
                                                                   die('Erreur : '.$e->getMessage());
                                                                }
                                                    ?>
                                                    
                                                </tbody>
                                            </table>  

                                    <?php } ?> 
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal -->
				<div class="modal fade" id="modalModifAddition" tabindex="-1" role="dialog" aria-labelledby="modalModifAddition" aria-hidden="true">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				    	<form id="formUpdateAddition" action="updateAddition.php" method="POST">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Modification payement</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        <h6>Payement:</h6>
					        <input id="idAddition"  type="hidden" name="idAddition" value="" required>
					        <input id="nomCabinet"  type="hidden" name="nomCabinet" value="<?php echo $nomCabinet;?>" required>
					        <input id="valAddition" type="number" name="addition" value="" required>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					        <button type="submit" class="btn btn-primary">Modifier</button>
					      </div>
				  		</form>
				    </div>
				  </div>
				</div>
			<!-- Fin Modal -->	


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

    <script src="assets/js/footable/js/footable.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.sort.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.filter.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>


    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="assets/js/preloader.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/load.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

    <script type="text/javascript">
    $(function() {
        $('.footable-res').footable();
    });
    </script>
    <script type="text/javascript">
    $(function() {
        $('#footable-res2').footable().bind('footable_filtering', function(e) {
            var selected = $('.filter-status').find(':selected').text();
            if (selected && selected.length > 0) {
                e.filter += (e.filter && e.filter.length > 0) ? ' ' + selected : selected;
                e.clear = !e.filter;
            }
        });
    });
    </script>

    <script>
		$(document).ready(function(){
		  $("#myInput").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		    $("#myTable tr").filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
		  });
		});

		function updateAddition(idAddit,addition){
			document.getElementById("idAddition").value = idAddit;
			document.getElementById("valAddition").value = addition;
		}
	</script>

    <script>  
        function searchForPatient(){

            var rechercheVal = document.getElementById("recherchePatient").value;

            rechercheVal != "" ? location.href = "majRecette.php?patient_search="+rechercheVal+"" : location.href = "majRecette.php";;
        }    
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