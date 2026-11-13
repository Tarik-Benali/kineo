<?php
    include("auth/auth.php");
    include("includes/historique.php");
    include("includes/functions.php");

    include("fonctionnalites/affichage/infoExamenPourConsultation.php"); 

    if (isset($_SESSION['identifiant']) && $_SESSION['typeCompte']== 1) {

    $idPatient        = $_SESSION['identifiant'];
    $typeCompte       = $_SESSION['typeCompte'];

    if (isset($_REQUEST["idP"])) {

        $idPatient = $_GET["idP"];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VirtuHos v 1.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>

    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">


    <link href="assets/js/footable/css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable.standalone.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable-demos.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="assets/js/dataTable/lib/jquery.dataTables/css/DT_bootstrap.css" />
    <link rel="stylesheet" href="assets/js/dataTable/css/datatables.responsive.css" />


    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/minus.png">

    <style type="text/css">

        ul li#cont:hover  {
            background: #DCDCDC;
        }

        div.scrollTableMessages {
          height: 500px;
          overflow: auto;
        }

        .flex-container {
          display: flex;
          align-items: stretch;
        }
    </style>
    
</head>


<?php include("fragmentsPages/fragmentsPatient/bodyTheme.php"); ?>
    <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- TOP NAVBAR -->
    <!-- TOP NAVBAR -->


    <?php include("fragmentsPages/fragmentsPatient/barDeNavigation.php"); ?> 



    <!-- SIDE MENU -->

    <?php include("fragmentsPages/fragmentsPatient/menuPrincipal.php"); ?>


    <!--  PAPER WRAP -->
    <div class="wrap-fluid">
        <div class="container-fluid paper-wrap bevel tlbr">

 <!------------------------------------------------------ Titre de Page ------------------------------------------------------------------------>



            <!-- CONTENT -->
            <!--TITLE -->
                    <!-- Inclusion d'entête ;) -->

                        <?php include("fragmentsPages/fragmentsPatient/entet.php"); ?>         

                    <!-- fin d'inclusion -->
            <!--/ TITLE -->

            <!-- BREADCRUMB -->
            <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Messagerie</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Messagerie patient</a>
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
                    <div class="col-sm-9">
                        <div id="siteClose" class="nest">
                            <div id="messagerieToHide">
                                <div class="title-alt">
                                    <h6>
                                        <span class="fontawesome-truck"></span>&nbsp;Doctors Chat</h6>

                                </div>

                                <div class="body-nest" style="min-height:396px;">
                                    <div class="table-responsive scrollTableMessages" id="dernierExpedScroll" style="height: 400px;">
        
                                        <div class="table" id="dernierExped">
                                                    
                                              <div id="RealTime" style="min-height:296px;padding-top:10px;" class="body-nest">
                                                <ul class="direction">
                                                    <?php getVirtuhosDocs();?>
                                                </ul>
                                            </div>              
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div id="messagerieToShow" class="body-nest" style="min-height:296px;">
                                <div class="table" id="autreMessages">
                                              
                                </div>  
                            </div>

                        </div>
                    </div>


                    <div class="col-sm-3" id="col3desContacts">
                        <div id="RealTimeClose" class="nest">
                            <div class="title-alt">
                                <h6>
                                    <span class="fontawesome-resize-horizontal"></span>&nbsp;Virtuhos doctors</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#RealTimeClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#RealTime">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>
                            <div id="RealTime" style="min-height:296px;padding-top:10px;" class="body-nest">
                                <ul class="direction">
                                    <?php getVirtuhosDocs();?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /END OF CONTENT -->



            <!-- FOOTER -->
       
            <?php include("fragmentsPages/fragmentsPatient/footer.php"); ?>

            <!-- / END OF FOOTER -->


        </div>
    </div>
    <!--  END OF PAPER WRAP -->

    <!-- RIGHT SLIDER CONTENT -->

    <?php include("fragmentsPages/fragmentsPatient/menuSecondaire.php"); ?>


    <!-- END OF RIGHT SLIDER CONTENT-->


    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="assets/js/preloader.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="assets/js/app.js"></script>
    <script type="text/javascript" src="assets/js/load.js"></script>
    <script type="text/javascript" src="assets/js/main.js"></script>

    <!-- /MAIN EFFECT -->
    <!-- GAGE -->
    <script type="text/javascript" src="assets/js/toggle_close.js"></script>
    <script src="assets/js/footable/js/footable.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.sort.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.filter.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>



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

        $('.filter-api').click(function(e) {
            e.preventDefault();

            //get the footable filter object
            var footableFilter = $('table').data('footable-filter');

            alert('about to filter table by "tech"');
            //filter by 'tech'
            footableFilter.filter('tech');

            //clear the filter
            if (confirm('clear filter now?')) {
                footableFilter.clearFilter();
            }
        });
    });
    </script>

    <script>
        $(document).ready(function(){
          $("#messagerieToShow").hide();
          $("#col3desContacts").hide();

          $("#demandeAmisDiv").hide(); 
        });
    </script>

    <script>

          function onContactClick(IdentifiantContact){            

            $("#messagerieToShow").show();
            $("#messagerieToHide").hide();
            $("#col3desContacts").show();

            
 
                   $('#autreMessages').html('');

                   const id = String(IdentifiantContact);

                   if (IdentifiantContact != ""){

                    var MonId     = <?php echo "'$idPatient'";?>;
                    var TypeC     = <?php echo "'$typeCompte'";?>;
                    //const TypeAutre = "medecin";

                      $.ajax({
                          url:"fonctionnalites/affichage/affichageMessages.php",  
                          type:"GET",  
                          data:{identifiant: id,monId : MonId, typeCompte: TypeC, typeother: "medecin"},  
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#autreMessages').append(data);
                                //Auto Scroll jusqu'au dernier message envoyé
                                element = document.getElementById('messgs');
                                element.scrollTop = element.scrollHeight;

                                $("#demandeAmisDiv").hide();
                               } else{
                                document.getElementById('autreMessages').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Aucun identifiant selectioné</div>"
                               }
                          }  
                      });
                     }          
        }
  
    </script>

    <script>
        function sendNewMessage(typeC, typeAutre){ 

            var MonId    = $("#monId").val();
            var IdLautre = $("#idLautre").val();
            var Message  = $("#message").val(); 

            var TypeC   = typeC;
            var TypaO   = typeAutre;           

            $("#messagerieToShow").show();
            $("#messagerieToHide").hide();
 
                   $('#autreMessages').html('');

                   if (MonId != "" && IdLautre != "" && Message != ""){
                
                      //alert(MonId + ' '+ IdLautre + ' ' + Message);
                      $.ajax({
                          url:"fonctionnalites/ajout/addMessage.php",  
                          type:"GET",  
                          data:{idLautre: IdLautre,message: Message,monId : MonId, typeCompte : TypeC, typeother : TypaO},  
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#autreMessages').append(data);
                                //Auto Scroll jusqu'au dernier message envoyé
                                element = document.getElementById('messgs');
                                element.scrollTop = element.scrollHeight;
                               } else{
                                document.getElementById('autreMessages').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Aucun identifiant selectioné</div>"
                               }
                          }  
                      });
                     }
        }
    </script>

    <script>
        function addFreindsBtn(sender, receiver){ 

            var MonId    = sender;
            var IdLautre = receiver;      

            console.log(MonId + ' ' + IdLautre);

                   if (MonId != "" && IdLautre != ""){
                
                      $.ajax({
                          url:"fonctionnalites/ajout/demandeDeChatPatientMedecin.php",  
                          type:"GET",  
                          data:{idLautre: IdLautre,monId : MonId},  
                          success:function(data)  
                          { 
                            $("#addAmisDiv").hide();
                            $("#demandeAmisDiv").show(); 

                               if (data != "") {
                                console.log('demande envoyée');  
                                console.log(data);  
                               } else{
                                console.log('demande non envoyée');
                               }
                          }  
                      });
                     }   
        }
    </script>

    <script>
        function scrollHight(){
            element = document.getElementById('messgs');
            element.scrollTop = element.scrollHeight;
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