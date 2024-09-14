
<?php include("fonctionnalites/affichage/notifcationPrix.php"); 

    if (isset($_SESSION['nomDeCeCabinet'])) {
            
            $nomCabinet  = $_SESSION['nomDeCeCabinet'];
        }
 
        $typeCompteUser = $_SESSION['typeCompte'];
    switch ($typeCompteUser) {

           case '1':
                $profil  = "Super Admin";

               break;
           case '2':
                $profil  = "Medecin";

               break;
       } 

       $heureP      =date('H') + 1;
       $minuteP     =date('i');
       $SeccondP    =date('s');
?>
<!-- TOP NAVBAR -->
    <nav role="navigation" class="navbar navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="entypo-menu"></span>
                </button>
                <button class="navbar-toggle toggle-menu-mobile toggle-left" type="button">
                    <span class="entypo-list-add"></span>
                </button>




                <div id="logo-mobile" class="visible-xs">
                    <h1>
                        <span>v1.0</span>
                    </h1>
                </div>

            </div>


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    <?php if (isset($nomCabinet)) { ?>

                    <li>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#"><i style="font-size:19px;" class="icon-warning tooltitle"
                            data-toggle="tooltip" data-placement="bottom" title="Tarifs d'examens"></i><div class="noft-green"><?php if (isset($nomCabinet)) {
                                   $nbrExam = nbrDExamens($nomCabinet); //echo $nbrExam;
                                }?></div></a>
                        <ul style="margin: 12px 0 0 0;" role="menu" class="dropdown-menu dropdown-wrap">

                            <?php 
                                //prixConsultationPourNotification($nomCabinet);
                       
                                //prixExamensPourNotification($nomCabinet);
                            ?>

                            <li class="divider"></li>
                            <li>
                                <!--a href="gestionPrix.php"><div>Gérer les prix</div></a-->
                            </li>


                        </ul>
                        
                    </li>
                    <?php } ?>


                </ul>
                <div id="nt-title-container" class="navbar-left running-text visible-lg">
                    <ul class="date-top">
                        <li class="entypo-calendar" style="margin-right:5px"></li>
                        <li id="Date"></li>


                    </ul>

                    <ul class="digital" id="heureDZ">
                        <li class="entypo-clock" style="margin-right:5px"></li>
                        <li> <?php echo $heureP;?></li>
                        <li> : </li>
                        <li><?php echo $minuteP;?></li>
                        <li> : </li>
                        <li> <?php echo $SeccondP;?></li>
                    </ul>
                    
                    <ul id="nt-title">
                        <li><i class="wi-day-lightning"></i>&#160;&#160;Oran&#160;
                            <b>85</b><i class="wi-fahrenheit"></i>&#160;; 35km/h
                        </li>
                        <li><i class="wi-day-lightning"></i>&#160;&#160;Alger&#160;
                            <b>85</b><i class="wi-fahrenheit"></i>&#160;; 20km/h
                        </li>

                        <li><i class="wi-day-lightning"></i>&#160;&#160;Constantine&#160;
                            <b>85</b><i class="wi-fahrenheit"></i>&#160;; 10km/h
                        </li>

                        <li><i class="wi-day-lightning"></i>&#160;&#160;Tiaret&#160;
                            <b>85</b><i class="wi-fahrenheit"></i>&#160;; 25km/h
                        </li>

                        <li><i class="wi-day-lightning"></i>&#160;&#160;Tizi Ouzou&#160;
                            <b>85</b><i class="wi-fahrenheit"></i>&#160;; 40km/h
                        </li>

                    </ul>
                </div>

                <ul style="margin-right:0;" class="nav navbar-nav navbar-right">
                    <li>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                            <?php if (isset($nomCabinet)){echo $nomCabinet;} else {
                                echo "Paramètres";
                            } ?>       
                            
                            <b class="caret"></b>
                        </a>

                        <ul style="margin-top:14px;" role="menu" class="dropdown-setting dropdown-menu">

                            <?php if (isset($nomCabinet)){ ?>

                                <li>
                                    <a href="profil.php">
                                        <span class="entypo-vcard"></span>&#160;&#160;Profil</a>
                                </li>

                                <li>
                                    <a href="myQRCodeID.php">
                                        <span class="entypo-info"></span>&#160;&#160;Identifiant</a>
                                </li>

                            <?php }?>

                            
                            <li>
                                <a href="themes.php">
                                    <span class="entypo-lifebuoy"></span>&#160;&#160;Thèmes</a>
                            </li>
                            <li class="divider"></li>

                            <li>    
                                <a href="depenses.php">
                                    <span class="entypo-basket"></span>&#160;&#160;Dépenses</a>
                            </li>
                            
                            <?php if (isset($idMedecin) && $idMedecin=="1") {?>
                                <li>    
                                    <a href="recettedujour.php">
                                        <span class="entypo-credit-card"></span>&#160;&#160;Recette du jour</a>
                                </li><?php
                            }
                            ?>

                            <?php if (isset($idMedecin) && $idMedecin=="1") {?>
                                <li>    
                                    <a href="majRecette.php">
                                        <span class="entypo-feather"></span>&#160;&#160;Modif Payements</a>
                                </li><?php
                            }
                            ?>
                            
                            <?php if (isset($idMedecin) && $idMedecin=="1") {?>
                                <li>    
                                    <a href="recetteparjour.php">
                                        <span class="entypo-credit-card"></span>&#160;&#160;Recette précédent</a>
                                </li><?php
                            }
                            ?>
                            
                        </ul>
                    </li>
                    <li>
                        <a href="themes.php">
                            <span class="icon-gear"></span>&#160;&#160;Thème</a> 
                    </li>
                    <li>
                        <a href="auth/logout.php">
                            <span class="entypo-logout"></span>&#160;&#160;Déconnexion</a> 
                    </li>
                    <li class="hidden-xs">
                        <a class="toggle-left" href="#">
                            <span style="font-size:20px;" class="entypo-list-add"></span>
                        </a>
                    </li>
                </ul>



            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- /END OF TOP NAVBAR -->

    <script>
       function horloge() 
       {
          var heure = new Date();

          console.log("hhhh " + heure);
          
          var temps = "<li class=\"entypo-clock\" style=\"margin-right:5px\"></li><li> " + heure.getHours()+"</li><li> : </li><li>"+ heure.getMinutes()+"</li><li> : </li><li>"+ heure.getSeconds()+"</li>";
          
          document.getElementById('heureDZ').innerHTML = temps;
        }

        
            setInterval(horloge(), 1000);


          //var nbr = <?php //echo $nbrDemandeChatDoc;?>;    
    </script>

    <script>
        function gererPatientChatRequest(idDoc, idPatient, typeClick){ 


            var IdDoc     = idDoc;
            var IdPatient = idPatient;
            var Operation = typeClick;          


                   if (IdDoc != "" && IdPatient != "" && Operation != ""){
                
                      $.ajax({
                          url:"fonctionnalites/mod/genrerPatientRequestChat.php",  
                          type:"GET",  
                          data:{iddoc: IdDoc,idpat: IdPatient,opera : Operation},  
                          success:function(data)  
                          {  
                               if (data != "") {
                                $("#"+IdPatient+"").hide();
                                nbr = nbr - 1;
                                document.getElementById('nbrdmemandenotif').innerHTML=nbr; 
                                //$("#nbrdmemandenotif").innerHTML(nbr);
                                
                                console.log('success');
                               } else{
                                console.log('erreur');
                               }
                          }  
                      });
                     }
        }

        $(document).keydown(function (e) {

            if(e.keyCode == 13 && e.target.type !== 'submit') {
               var inputs = $(e.target).parents("html").eq(0).find(":input:visible"),
                idx = inputs.index(e.target);
                   if (idx == inputs.length - 1) {
                      inputs[0].select()
                   } else {
                      inputs[idx + 1].focus();
                      inputs[idx + 1].select();
                   }
                }
            if (e.keyCode == 13) {
                return false;
            }    
        });
    </script>










            