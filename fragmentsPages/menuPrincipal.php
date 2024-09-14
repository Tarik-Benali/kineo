    <div id="skin-select">
        <div id="logo">
            <h1>VirtuHos
                <span>v1.0</span>
            </h1>
        </div>

        <a id="toggle">
            <span class="entypo-menu"></span>
        </a>
        <!--div class="dark">
            <form action="#">
                <span>
                    <input type="text" name="search" value="" class="search rounded id_search" placeholder="Recherche..." autofocus />
                </span>
            </form>
        </div-->

        <div class="skin-part">
            <div id="tree-wrap">
                <div class="side-bar">


                    <ul  id="onglet_options_cabinet" class="topnav menu-left-nest">


                        <li>
                            <a href="#" style="border-left:0px solid!important;" class="title-menu-left">

                                <span class="">Menu</span>
                                <i data-toggle="tooltip" class="entypo-cog pull-right config-wrap"></i>

                            </a>
                        </li>

                        <li>
                            <a class="tooltip-tip ajax-load" href="medecin.php" title="Dashboard">
                                <i class="icon-window"></i>
                                <span>Tableau de bord</span>

                            </a>
                        </li>

                        <li>
                            <a class="tooltip-tip " href="#"  title="Rendez-Vous">
                                <i class="icon-document-edit"></i> 
                                <span>Agenda</span>
                            </a>
                            <ul>
                                <li>
                                    <a class="tooltip-tip2 ajax-load" href="programmationSeances.php" title="addRDV"><i class="icon-plus"></i><span>Programmer des séances</span></a>
                                </li>
                                <li>
                                    <a class="tooltip-tip2 ajax-load" href="rdvDuJour.php" title="LesRDV"><i class="icon-message"></i><span>Rendez-vous du jour</span></a>
                                </li>
                                <li>
                                    <a class="tooltip-tip2 ajax-load" href="printProgram.php" title="LesRDV"><i class="icon-document-new"></i><span>Impression programme</span></a>
                                </li>  
                                <li>
                                    <a class="tooltip-tip2 ajax-load" href="rendez-vous.php" title="LesRDV"><i class="icon-document-new"></i><span>Historique Des RDV</span></a>
                                </li>                          
                                
                            </ul>

                        </li> 


                        <!--li>

                            <a class="tooltip-tip " href="#"  title="Rendez-Vous">
                                <i class="fontawesome-stethoscope"></i> 
                                <span>En Salle</span>
                            </a>
                            <ul>
                                <li>
                                    <a class="tooltip-tip2 ajax-load" href="consultation.php" title="addRDV"><i class="icon-plus"></i><span>Nouvelle consultation</span></a>
                                </li>
                                <li>
                                    <a class="tooltip-tip2 ajax-load" href="consultationDuJour.php" title="LesRDV"><i class="icon-message"></i><span>Consultation du jour</span></a>
                                </li>
                                <li>
                                    <a class="tooltip-tip2 ajax-load" href="consultationSus.php" title="LesRDV"><i class="icon-message"></i><span>Consultation suspendue</span></a>
                                </li>
                                <li>
                                    <a class="tooltip-tip2 ajax-load" href="historiqueConsultation.php" title="All Consultations"><i class="icon-document-new"></i><span>Historique consultati</span></a>
                                </li>
                                                                                           
                            </ul>

                        </li-->  
                        
                        <li>
                            <a class="tooltip-tip " href="#" title="Ordonnance">
                                <i class="icon-document"></i>
                                <span>Patient</span>

                            </a>
                            <ul>
                                <li>
                                    <a class="tooltip-tip2 ajax-load" href="affichagePatients.php" title="afficherPatients"><i class="icon-preview"></i><span>Afficher les patients</span></a>
                                </li>
                                <li>
                                    <a class="tooltip-tip2 ajax-load" href="ajoutPatient.php" title="LesRDV"><i class="icon-plus"></i><span>Ajouter un patient</span></a>
                                </li>
                                <li>
                                    <a class="tooltip-tip2 ajax-load" href="dossierPatient.php" title="LesRDV"><i class="icon-folder"></i><span>Dossier patients</span></a>
                                </li>                              
                                
                            </ul>
                        </li>

                        <li>
                            <a class="tooltip-tip " href="seance.php" title="Seance">
                                <i class="fontawesome-stethoscope"></i>
                                <span>Seance</span>
                            </a>
                        </li>

                                               

                        
                    </ul>

                    <ul id="onglet_params_cabinet" class="topnav menu-left-nest">
                        <li>
                            <a href="#" style="border-left:0px solid!important;" class="title-menu-left">

                                <span class="">Options Cabinet</span>
                                <i data-toggle="tooltip" class="entypo-cog pull-right config-wrap"></i>
                            </a>
                        </li>

                        <li>
                            <a class="tooltip-tip ajax-load" href="gestionCabinet.php" title="Paramètres">
                                <i class="entypo-cog"></i>
                                <span>Paramètres Cabinet</span>

                            </a>
                        </li>

                        <li>
                            <a class="tooltip-tip ajax-load" href="stats.php" title="Paramètres">
                                <i class="entypo-info"></i>
                                <span>Statistiques</span>

                            </a>
                        </li>

                        <?php

                            if (isset($_SESSION['idDeCeMedecin']) && $_SESSION['idDeCeMedecin'] =="1") {?>
                                <li>
                                    <a class="tooltip-tip ajax-load" href="ajoutMedecin.php" title="Ajout Praticien">
                                        <i class="fontawesome-user-md"></i>
                                        <span>Ajout Praticien</span>

                                    </a>
                                </li><?php
                            }



                        ?>

                        <!--li>
                            <a class="tooltip-tip ajax-load" href="gestionPrix.php" title="Social">
                                <i class="fontawesome-money"></i>
                                <span>Gestion des Prix</span>

                            </a>
                        </li-->

                        <li>
                            <a class="tooltip-tip " href="auth/logout.php" title="Déconnexion">
                                <i class="entypo-logout" ></i>
                                <span>Déconnexion</span>
                            </a>
                        </li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>