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

    //mail("tarikbenaliamar@gmail.com","test mailing","test message");
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

    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>

    <link href="assets/js/footable/css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable.standalone.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable-demos.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="assets/js/dataTable/lib/jquery.dataTables/css/DT_bootstrap.css" />
    <link rel="stylesheet" href="assets/js/dataTable/css/datatables.responsive.css" />






    <style type="text/css">
    canvas#canvas4 {
        position: relative;
        top: 20px;
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

        <?php include("fragmentsPages/menuPrincipal.php"); ?> 
     
    <!-- END OF SIDE MENU -->



    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">


            <!-- CONTENT -->
            <!-- BREADCRUMB -->
            <br>
            <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Home</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Historique des Consultations</a>
                </li>
                <li class="pull-right">
                    <div class="input-widget" style="padding-top: 2%">
                        <ul>
                                    <li>
                                        Code couleur:
                                    </li>

                                    <li>
                                        <span style="background-color: #86C440; color: #fff; padding-top: 1px; padding-bottom: 1px;">&nbsp;Consultation clôse&nbsp;</span>
                                    </li>

                                    <li>
                                        <span style="background-color: #DF2135; color: #fff; padding-top: 1px; padding-bottom: 1px;">&nbsp;Consultation suspendue&nbsp;</span>
                                    </li>
                        </ul>
                    </div>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->




            <!--  DEVICE MANAGER -->

                    <div class="content-wrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="nest" id="FilteringClose9">
                                    <div class="title-alt">
                                        <h6>
                                            Toutes Les Consultations</h6>
                                        <div class="titleClose">
                                            <a class="gone" href="#FilteringClose9">
                                                <span class="entypo-cancel"></span>
                                            </a>
                                        </div>
                                        

                                    </div>

                                    <div class="body-nest" id="flt">

                                        <div class="row" style="margin-bottom:10px;">
                                            <div class="col-sm-4">
                                                <input class="form-control" id="filter" placeholder="Filtre par nom, prénom Patient ou par nom Médecin" type="text" />
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="filter-status form-control">
                                                    <option>Filtre par état cons</option>
                                                    <option value="suspendue">Suspendue</option>
                                                    <option value="cloturee">Clôturée</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-2">
                                                <input class="form-control" id="dateFiltr" onchange="filtreDate()" placeholder="Filtre par date con" type="date" />
                                                
                                            </div>

                                            <div class="col-sm-4">
                                                <a href="#clear" style="margin-left:10px;" class="pull-right btn btn-info clear-filter" title="clear filter">Effacer le filtre</a>
                                                
                                            </div>

                                        </div>

                                        <table id="footable-res2" class="demo" data-filter="#filter" data-filter-text-only="true">
                                            <thead>
                                                <tr>
                                                    <th data-toggle="true">
                                                        Nom Patient
                                                    </th>
                                                    <th>
                                                        Nom Médecin
                                                    </th>

                                                    <th data-hide="phone,tablet">
                                                        Id consultation
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        Motif
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        état consultation
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        Détails
                                                    </th>
                                                    <th>
                                                        Date consultation
                                                    </th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php 

                                                if (isset($_REQUEST['nbrLigneCons'])) {
                                                	$nbrLigne = $_REQUEST['nbrLigneCons'];
                                                }
                                                else{
                                                	$nbrLigne = "50";
                                                }

                                                afficheToutesLesCons($nomCabinet, $nbrLigne); ?>

                                            </tbody>
                                            <tfoot>
		                                        <tr>
		                                            <td colspan="5">
		                                                <div class="pagination pagination-centered"></div>
		                                            </td>
		                                        </tr>
		                                    </tfoot>
                                        </table>

                                        <br><br>

                                        <p>
                                        	Remarque: le tableau contient les 50 dernières consultations. 
                                        	Sinon, combien de consultations aimeriez-vous afficher: &nbsp;
                                        	<a href="historiqueConsultation.php?nbrLigneCons=100"><u>100</u></a>&nbsp;-&nbsp;
                                        	<a href="historiqueConsultation.php?nbrLigneCons=100"><u>150</u></a>&nbsp;-&nbsp;
                                        	<a href="historiqueConsultation.php?nbrLigneCons=100"><u>200</u></a>&nbsp;-&nbsp; 
                                        	<a href="historiqueConsultation.php?nbrLigneCons=100"><u>300</u></a>&nbsp;-&nbsp; 
                                        	<a href="historiqueConsultation.php?nbrLigneCons=0,18446744073709551615"><u>Toutes</u></a>
                                        </p>

                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>





            <!--  / DEVICE MANAGER -->

                  
                <!-- /END OF CONTENT -->



                <!-- FOOTER -->

                   <?php include("fragmentsPages/footer.php"); ?>   


                <!-- / END OF FOOTER -->


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

    <script type="text/javascript" src="assets/js/toggle_close.js"></script>
    <script src="assets/js/footable/js/footable.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.sort.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.filter.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>



    <script>
    $('.textarea').wysihtml5();
    </script>


    <script type="text/javascript">
    var output, started, duration, desired;

    // Constants
    duration = 5000;
    desired = '50';

    // Initial setup
    output = $('#speed');
    started = new Date().getTime();

    // Animate!
    animationTimer = setInterval(function() {
        // If the value is what we want, stop animating
        // or if the duration has been exceeded, stop animating
        if (output.text().trim() === desired || new Date().getTime() - started > duration) {
            console.log('animating');
            // Generate a random string to use for the next animation step
            output.text('' + Math.floor(Math.random() * 60)

            );

        } else {
            console.log('animating');
            // Generate a random string to use for the next animation step
            output.text('' + Math.floor(Math.random() * 120)

            );
        }
    }, 5000);
    </script>
    <script type="text/javascript">
    $('#getting-started').countdown('2020/01/01', function(event) {
        $(this).html(event.strftime(

            '<span>%M</span>' + '<span class="start-min">:</span>' + '<span class="start-min">%S</span>'));
    });
    </script>


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

        $('.clear-filter').click(function(e) {
            e.preventDefault();
            $('.filter-status').val('');
            $('table.demo').trigger('footable_clear_filter');
        });

        $('.filter-status').change(function(e) {
            e.preventDefault();
            $('table.demo').trigger('footable_filter', {
                filter: $('#filter').val()
            });
        });
    });
    </script>

    <script>  
    	/*
    	function getCons(NbrLignes){

    	 var NbrCons = NbrLignes;

         $(document).ready(function(){


                   var NomCabinet = '<?php //echo $nomCabinet;?>';

                   if (NomCabinet != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/getConsultations.php",  
                          type:"GET",  
                          data:{nbrCons: encodeURIComponent(NbrCons), nomCabinet: NomCabinet},
                          success:function(data)  
                          {  
                               if (data != "") {
                               	$('#consTbody').html('');
                                $('#consTbody').append(data);
                               } else{
                                document.getElementById('consTbody').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Erreur de connexion</div>"
                               }
                          }  
                      });
                     }                        
              });                                 
        }  */                              
    </script>

    <script>
        function filtreDate() {
          var  input, filter, table, tr, td, i, txtValue;
          input  = document.getElementById("dateFiltr");
          filter = input.value.toUpperCase();
          table  = document.getElementById("footable-res2");
          tr     = table.getElementsByTagName("tr");

          for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[6];
            if (td) {
              txtValue = td.textContent || td.innerText;
              if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
              } else {
                tr[i].style.display = "none";
              }
            }       
          }
        }
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
