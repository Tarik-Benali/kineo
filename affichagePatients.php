<?php
    include("auth/auth.php");
    include("includes/historique.php");
    include("includes/functions.php");


    if (isset($_SESSION['idDeCeCabinet']) || (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5")) {

        $typeProfil ="";

        if (isset($_SESSION['idDeCeCabinet']) && $_SESSION['typeCompte'] =="2") {

            $idCabinet        = $_SESSION['idDeCeCabinet'];

            $nomCabinet       = $_SESSION['nomDeCeCabinet'];

            $adresseCabinet   = $_SESSION['adresseDeCeCabinet'];

            $idMedCab         = $_SESSION['idDeCeMedCab'];

            $idMedecin        = $_SESSION['idDeCeMedecin'];


            $typeProfil  ="medecin";

        }elseif (isset($_SESSION['nomCabinet']) && $_SESSION['typeCompte'] =="5") {
           
            $idCabinet        = $_SESSION['idCabinet'];

            $nomCabinet       = $_SESSION['nomCabinet'];

            $idStaff          = $_SESSION['identifiant'];


            $typeProfil  ="staff";
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Virtuhos 1.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <script type="text/javascript" src="jquery/ajax-jquery-2.0.0.js"></script>



    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/loader-style.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/css/pupop.css">

    <link href="assets/js/footable/css/footable.core.css?v=2-0-1" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable.standalone.css" rel="stylesheet" type="text/css" />
    <link href="assets/js/footable/css/footable-demos.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="assets/js/timepicker/bootstrap-timepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/datepicker.css">
    <link rel="stylesheet" href="assets/js/datepicker/clockface.css">
    <link rel="stylesheet" href="assets/js/datepicker/bootstrap-datetimepicker.css">

    <link rel="stylesheet" type="text/css" href="assets/js/tag/jquery.tagsinput.css">
    <link rel="stylesheet" href="assets/css/mail.css">

    



    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/minus.png">
    <style type="text/css">
        .aParent div {
            float: left;
            clear: none; 
            margin-bottom: 15px;
        }
    </style>    
</head>

<?php include("fragmentsPages/bodyTheme.php"); ?>

<!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>


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


   <!------------------------------------------------------ Titre de Page ---------------------------------------------------------------->



            <!-- CONTENT -->
            <!--TITLE -->
            <div class="row">
                <div id="paper-top">
                    <div class="col-sm-3">
                        <h2 class="tittle-content-header">
                            <span class="entypo-menu"></span>
                            <span><?php if(isset($idMedecin)) {echo "Dr, ";} echo $_SESSION['username'] ; ?>&nbsp;!
                            </span>
                        </h2>

                    </div>

                    <div class="col-sm-7">
                        <div class="devider-vertical visible-lg"></div>
                        <div class="tittle-middle-header">

                            <div class="alert">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <span class="tittle-alert entypo-info-circled"></span>
                                 <?php 
                                        //$res= getInformation($_SESSION['idUser'],$_SESSION['typeCompte']); ?>
                                                      
                                Bienvenue <?php if(isset($idMedecin)) {echo "Dr, ";} ?>&nbsp;
                                <strong><?php echo $_SESSION['username'] ; ?>&nbsp;!</strong>&nbsp;&nbsp;On vous souhaite une bonne journée.
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--/ TITLE -->

            <!-- BREADCRUMB -->
            <ul id="breadcrumb">
                <li>
                    <span class="entypo-home"></span>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Nos Patients</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Afficher Les Patients</a>
                </li>
                <li class="pull-right">
                    <div class="input-group input-widget">

                        <input style="border-radius:15px" type="text" placeholder="Search..." class="form-control">
                    </div>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->






   <!------------------------------------------------------ Affichage --------------------------------------------------------------------->


            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="FilteringClose">
                            <div class="title-alt">
                                <h6>
                                    Liste des Patients</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#FilteringClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <!--div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#FilteringPatient">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div-->

                            </div>

                            <div class="body-nest" id="FilteringPatient">

                                <div class="row" style="margin-bottom:10px;">
                                    <div class="col-sm-4">
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

                                        <script type="text/javascript">window.history.pushState("", "Affichage Patients", "affichagePatients.php");</script>


                                        <table id="footable-res2" class="demo" data-filter="#filter" data-filter-text-only="true">
                                            <thead>
                                                <tr>
                                                    <th data-toggle="true">
                                                        Nom
                                                    </th>
                                                    <th>
                                                        Prenom
                                                    </th>

                                                    <th data-hide="phone,tablet">
                                                        Date de Naissance
                                                    </th>
                                                    
                                                    <th data-hide="phone,tablet">
                                                        Adresse
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        E-mail
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        Téléphone
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        Sexe
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        Profession
                                                    </th>
                                                    <th data-hide="phone">
                                                        Options 
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    global $host_name;
                                                    global $baseGlobale;
                                                    global $db_user_name;
                                                    global $db_password;

                                                    //$aujourdhui = date("Y-m-d");
                                                    $aujourdhui = "2023-03-07";

                                                        try
                                                        {
                                                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                            $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                             
                                                             
                                                            // On recupere tout le contenu de la table news
                                                        $reponse = $bdd->query("SELECT * FROM patient WHERE nomPatient LIKE '$NomPhonePatient%' OR numTelPatient LIKE '$NomPhonePatient%' OR prenomPatient LIKE '$NomPhonePatient%' OR profession LIKE '$NomPhonePatient%'");
                                                        // On affiche le resultat
                                                        while ($donnees = $reponse->fetch())
                                                        {
                                                            echo "</tr>";
                                                            $idPatient     = $donnees['idPatient'];
                                                            $nomPatient    = $donnees['nomPatient'];
                                                            $prenomPatient = $donnees['prenomPatient'];
                                                            $patient       = $nomPatient." ".$prenomPatient;

                                                            $phone1  = $donnees['numTelPatient'];
                                                            $phone2  = $donnees['phone_2'];
                                                            $phone3  = $donnees['phone_3'];

                                                            $numTelPatient = "";

                                                            if ($phone2 =="" && $phone3 =="") {
                                                                $numTelPatient = $phone1;
                                                            }else if($phone2 =="" && $phone3 !=""){
                                                                $numTelPatient = $phone1 . " - " . $phone3;
                                                            }else if($phone2 !="" && $phone3 ==""){
                                                                $numTelPatient = $phone1 . " - " . $phone2;
                                                            }else if ($phone2 !="" && $phone3 !="") {
                                                                $numTelPatient = $phone1 . " <br> " . $phone2 . " <br> " . $phone3;
                                                            }

                                                            $lieuNaiss = $donnees['lieuNaissPatient'];
                                                            if ($lieuNaiss =="") {
                                                                $lieuNaiss = "-";
                                                            }
                                                                                                                
                                                            
                                                            echo "<td> ".$nomPatient." </td>";
                                                            echo "<td> ".$prenomPatient." </td>";


                                                            echo "<td data-value> $donnees[dateNaissPatient] <br>à ".$lieuNaiss."</td>";
                                                            echo "<td data-value> $donnees[adressePatient]  </td>";
                                                            echo "<td data-value> $donnees[emailPatient]    </td>";
                                                            echo "<td data-value> ".$numTelPatient."        </td>";      
                                                            echo "<td data-value> $donnees[sexePatient]     </td>";
                                                            echo "<td data-value> $donnees[profession]    </td>";

                                                            echo "<td data-value=\"1\">  
                                                                        <a style=\"color:inherit;\" href=\"rdvpatient.php?idPatient=$idPatient\">
                                                                            <button type=\"button\" class=\"btn btn-info\">

                                                                                    <span class=\"entypo-eye\"></span>&nbsp;Programme
                                                                            </button> 
                                                                        </a>    

                                                                        <button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#ModalModification\" onclick=\"sendIdToUpdate('$idPatient','$nomPatient','$prenomPatient','$donnees[dateNaissPatient]','$lieuNaiss','$donnees[adressePatient]','$donnees[emailPatient]','$phone1','$donnees[sexePatient]','$donnees[groupagePatient]','$donnees[profession]','$donnees[bilan]','$phone2','$phone3')\">

                                                                                <span class=\"entypo-pencil\"></span>
                                                                        </button> 
                                                                        

                                                                        <button type=\"submit\" class=\"btn btn-danger\" onclick=\"sendIdToSupp('$patient','$idPatient')\">
                                                                                <span class=\"entypo-trash\"></span>
                                                                        </button>

                                                                    </td>";                                                                                    
                                                            echo "</tr>";

                                                        }
                                                        $reponse->closeCursor();
                                                        }
                                                        catch(Exception $e)
                                                        {
                                                            die('Erreur : '.$e->getMessage());
                                                        }
                                                ?>
                                            </tbody>

                                             <tfoot>
                                                <tr>
                                                    <td colspan="5">
                                                        <div class="pagination pagination-centered"></div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        
                                    
                                    <?php }else{ ?>

                                        <table id="footable-res2" class="demo" data-filter="#filter" data-filter-text-only="true">
                                            <thead>
                                                <tr>
                                                    <th data-toggle="true">
                                                        Nom
                                                    </th>
                                                    <th>
                                                        Prenom
                                                    </th>

                                                    <th data-hide="phone,tablet">
                                                        Date de Naissance
                                                    </th>
                                                    
                                                    <th data-hide="phone,tablet">
                                                        Adresse
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        E-mail
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        Téléphone
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        Sexe
                                                    </th>
                                                    <th data-hide="phone,tablet">
                                                        Profession
                                                    </th>
                                                    <th data-hide="phone">
                                                        Options 
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                    global $host_name;
                                                    global $baseGlobale;
                                                    global $db_user_name;
                                                    global $db_password;

                                                    $aujourdhui = date("Y-m-d");
                                                    //$aujourdhui = "2023-03-07";

                                                        try
                                                        {
                                                            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                                            $bdd = new PDO("mysql:host=$host_name;dbname=$baseGlobale",$db_user_name,$db_password, $pdo_options);
                                                             
                                                             
                                                            // On recupere tout le contenu de la table news
                                                        $reponse = $bdd->query("SELECT * FROM patient,cabinet,relpatcab,rdv WHERE cabinet.idCabinet = relpatcab.idCabinet AND patient.idPatient = relpatcab.idPatient AND cabinet.idCabinet = '$idCabinet' AND relpatcab.etat ='1' AND patient.medecin_suiv='$idMedecin' AND patient.idPatient = rdv.idPatient AND rdv.dateRDV='$aujourdhui'");
                                                        // On affiche le resultat
                                                        while ($donnees = $reponse->fetch())
                                                        {
                                                            echo "</tr>";
                                                            $idPatient     = $donnees['idPatient'];
                                                            $nomPatient    = $donnees['nomPatient'];
                                                            $prenomPatient = $donnees['prenomPatient'];
                                                            $patient       = $nomPatient." ".$prenomPatient;

                                                            $phone1  = $donnees['numTelPatient'];
                                                            $phone2  = $donnees['phone_2'];
                                                            $phone3  = $donnees['phone_3'];

                                                            $numTelPatient = "";

                                                            if ($phone2 =="" && $phone3 =="") {
                                                                $numTelPatient = $phone1;
                                                            }else if($phone2 =="" && $phone3 !=""){
                                                                $numTelPatient = $phone1 . " - " . $phone3;
                                                            }else if($phone2 !="" && $phone3 ==""){
                                                                $numTelPatient = $phone1 . " - " . $phone2;
                                                            }else if ($phone2 !="" && $phone3 !="") {
                                                                $numTelPatient = $phone1 . " <br> " . $phone2 . " <br> " . $phone3;
                                                            }

                                                            $lieuNaiss = $donnees['lieuNaissPatient'];
                                                            if ($lieuNaiss =="") {
                                                                $lieuNaiss = "-";
                                                            }
                                                                                                                
                                                            
                                                            echo "<td> ".$nomPatient." </td>";
                                                            echo "<td> ".$prenomPatient." </td>";


                                                            echo "<td data-value> $donnees[dateNaissPatient] <br>à ".$lieuNaiss."</td>";
                                                            echo "<td data-value> $donnees[adressePatient]  </td>";
                                                            echo "<td data-value> $donnees[emailPatient]    </td>";
                                                            echo "<td data-value> ".$numTelPatient."        </td>";      
                                                            echo "<td data-value> $donnees[sexePatient]     </td>";
                                                            echo "<td data-value> $donnees[profession]    </td>";

                                                            echo "<td data-value=\"1\">  
                                                                        <a style=\"color:inherit;\" href=\"rdvpatient.php?idPatient=$idPatient\">
                                                                            <button type=\"button\" class=\"btn btn-info\">

                                                                                    <span class=\"entypo-eye\"></span>&nbsp;Programme
                                                                            </button> 
                                                                        </a>    

                                                                        <button type=\"button\" class=\"btn btn-default\" data-toggle=\"modal\" data-target=\"#ModalModification\" onclick=\"sendIdToUpdate('$idPatient','$nomPatient','$prenomPatient','$donnees[dateNaissPatient]','$lieuNaiss','$donnees[adressePatient]','$donnees[emailPatient]','$phone1','$donnees[sexePatient]','$donnees[groupagePatient]','$donnees[profession]','$donnees[bilan]','$phone2','$phone3')\">

                                                                                <span class=\"entypo-pencil\"></span>
                                                                        </button> 
                                                                        

                                                                        <button type=\"submit\" class=\"btn btn-danger\" onclick=\"sendIdToSupp('$patient','$idPatient')\">
                                                                                <span class=\"entypo-trash\"></span>
                                                                        </button>

                                                                    </td>";                                                                                    
                                                            echo "</tr>";

                                                        }
                                                        $reponse->closeCursor();
                                                        }
                                                        catch(Exception $e)
                                                        {
                                                            die('Erreur : '.$e->getMessage());
                                                        }
                                                ?>
                                            </tbody>

                                             <tfoot>
                                                <tr>
                                                    <td colspan="5">
                                                        <div class="pagination pagination-centered"></div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                <?php } ?>

                            </div>

                        </div>

                    </div>

                </div>
            </div>


            <!-- /END OF CONTENT -->

            <!-- Modal -->
            <div class="modal fade" id="ModalModification" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="ModalModificationTitle">Modification Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="modifForm" action="fonctionnalites\mod\modPat.php" method="POST">
                    <input type="hidden" name="idPat" id="idPatientM" value="$sujet">
                    <input type="hidden" name="faiseur" value="<?php echo $idMedecin;?>">
                    <input type="hidden" name="idCabinet" value="<?php echo $idCabinet;?>">

                      <div class="modal-body">
                            <div class="aParent">
                                <div style="width: 48%; margin-right: 2%;">
                                    <label for="nomPatientM">Nom</label>
                                    <input type="name" name="name" id="nomPatientM" class="form-control" required>    
                                </div>
         
                                <div style="width: 48%; margin-right: 2%;" id="email">
                                    <label for="prenomPatientM">Prenom</label>
                                    <input type="name" name="prenom" id="prenomPatientM" class="form-control" required>
                                </div>
                            </div>

                            <div class="aParent">
                                <div style="width: 48%; margin-right: 2%;">
                                    <label for="dateNaissPatientM">Date de naissance</label>
                                    <input type="date" name="dateNaiss" id="dateNaissPatientM" class="form-control">    
                                </div>

                                <div style="width: 48%; margin-right: 2%;" id="email">
                                    <label for="lieuNaissPatientM">Lieu de naissance</label>
                                    <input type="text" name="lieuNaissPatient" id="lieuNaissPatientM" class="form-control">
                                </div>
                            </div>

                            <div class="aParent">
                                <div style="width: 48%; margin-right: 2%;">
                                    <label for="adressePatientM">Adresse</label>
                                    <input type="text" name="adresse" id="adressePatientM" class="form-control">
                                </div>
                                <div style="width: 48%; margin-right: 2%;" id="email">
                                    <label for="emailPatientM">Email</label>
                                    <input type="email" name="mail" id="emailPatientM" class="form-control">
                                </div>
                            </div>

                            <div class="aParent">
                                <div style="width: 48%; margin-right: 2%;">
                                    <label for="numTelPatientM">Téléphone</label>
                                    <input type="phone" name="tel" id="numTelPatientM" class="form-control" required>   
                                </div>

                                <div style="width: 48%; margin-right: 2%;" id="email">
                                    <label for="sexePatientM">Sexe</label>
                                    <input type="text" name="sexe" id="sexePatientM" class="form-control">
                                </div>
                            </div>

                            <div class="aParent">
                                <div style="width: 48%; margin-right: 2%;">
                                    <label for="groupagePatientM">Groupage</label>
                                    <input type="text" name="groupeSanguin" id="groupagePatientM" class="form-control">   
                                </div>

                                <div style="width: 48%; margin-right: 2%;" id="email">
                                    <label for="professionM">Profession</label>
                                    <input type="text" name="professionM" id="professionM" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bilanM">Bilan</label>
                                <input type="text" name="bilanM" id="bilanM" class="form-control">
                            </div>


                            <div class="aParent">
                                <div style="width: 48%; margin-right: 2%;">
                                    <label for="phone_2M">Téléphone N°2</label>
                                    <input type="phone" name="phone_2M" id="phone_2M" class="form-control">   
                                </div>

                                <div style="width: 48%; margin-right: 2%;" id="email">
                                    <label for="phone_3M">Téléphone N°3</label>
                                    <input type="phone" name="phone_3M" id="phone_3M" class="form-control">
                                </div>
                            </div>
                                
                      <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Modifier</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="ModalSuppression" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="ModalSuppressionTitle">Suppression Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h5 id="titreSupp">Êtes-vous sûr de vouloir supprimer ce patient ?</h5>
                    
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" onclick="deletingPatient()">Supprimer</button>
                  </div>
                </div>
              </div>
            </div>

            <input type="hidden" name="id" id="idPatientASupp" value=""/>


   <!------------------------------------------------------ Modification --------------------------------------------------------->

<?php
/*
 if (isset($_GET["identifiantModification"])){


        $iden = $_GET["identifiantModification"];

        if($typeProfil == "medecin"){

            modifierPatient($idMedecin, $iden, $idCabinet);
        }


        else if($typeProfil == "staff"){

            modifierPatient($idStaff, $iden, $idCabinet);
        }

    //echo "<h1>".$_GET["identifiantSupression"]."</h1>";
    //echo"openModificationPatient()";        
    }*/
?>



   <!------------------------------------------------------ Suppression --------------------------------------------------------------------------------->
<?php
 /*if (isset($_GET["identifiantSupression"])){


        $iden = $_GET["identifiantSupression"];
    //echo "<h1>".$_GET["identifiantSupression"]."</h1>";
    //echo"openModificationPatient()";

        if($typeProfil == "medecin"){

            supprimerPatient($idMedecin, $iden, $idCabinet);
        }


        else if($typeProfil == "staff"){

            supprimerPatient($idStaff, $iden, $idCabinet);
        }
    }*/

?>

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


    <!-- /MAIN EFFECT -->
    <!-- GAGE -->
    <script type="text/javascript" src="assets/js/toggle_close.js"></script>
    <script src="assets/js/footable/js/footable.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.sort.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.filter.js?v=2-0-1" type="text/javascript"></script>
    <script src="assets/js/footable/js/footable.paginate.js?v=2-0-1" type="text/javascript"></script>

    <script type="text/javascript" src="assets/js/timepicker/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/clockface.js"></script>
    <script type="text/javascript" src="assets/js/datepicker/bootstrap-datetimepicker.js"></script>

    <script type="text/javascript" src="assets/js/tag/jquery.tagsinput.js"></script>





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
        
        function closeModificationPatient() {
          document.getElementById("modifierPatient").style.display = "none";
        }
    </script>
    <script>
        empty($var);

        function closeSupressionPatient() {
          document.getElementById("supprimerPatient").style.display = "none";
        }
    </script>
    <script>
        //var id;
        function sendIdToSupp(patient,id) {

            document.getElementById("titreSupp").innerHTML  = "Êtes-vous sûr de vouloir supprimer le patient: <b>"+patient+"</b> ?";
            document.getElementById("idPatientASupp").value = id; 

            confirmation(); 
        }

        function deletingPatient() {
            var idMedecin = "<?php echo $idMedecin;?>";
            var idCabinet = "<?php echo $idCabinet;?>";
            var idPatient = document.getElementById("idPatientASupp").value; 
            window.location.href = "fonctionnalites/supp/suppPatient.php?idPat="+idPatient+"&faiseur="+idMedecin+"&idCabinet="+idCabinet+"";
        }
    </script>
    <script>
        //var id;
        function sendIdToUpdate(id,nomP,prenomP,dateNaiss,lieuNaiss,adresseP,emailP,numTelP,sexeP,groupageP,profession,bilan,ph_2M,ph_3M){
            document.getElementById("idPatientM").value = id;
            document.getElementById("nomPatientM").value = nomP;
            document.getElementById("prenomPatientM").value = prenomP;
            document.getElementById("dateNaissPatientM").value = dateNaiss;
            document.getElementById("lieuNaissPatientM").value = lieuNaiss;
            document.getElementById("adressePatientM").value = adresseP;
            document.getElementById("emailPatientM").value = emailP;
            document.getElementById("numTelPatientM").value = numTelP;
            document.getElementById("sexePatientM").value = sexeP;
            document.getElementById("groupagePatientM").value = groupageP;
            document.getElementById("professionM").value = profession; 
            document.getElementById("bilanM").value = bilan;
            document.getElementById("phone_2M").value = ph_2M;
            document.getElementById("phone_3M").value = ph_3M;
         // window.location.href = "affichagePatients.php?identifiantModification=" + id;          
        }


        function confirmation() {
          
          confirm("");
        }

        function confirmation() {
          var r = confirm("Êtes vous sûr de vouloir supprimer ce patient ?");
          if (r == true) {
            deletingPatient();
            //alert("supp");
          } else {
            //txt = "You pressed Cancel!";
            //alert("non supp");
          }
        }


    </script>

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
        function searchForPatient(){

            var rechercheVal = document.getElementById("recherchePatient").value;

            rechercheVal != "" ? location.href = "affichagePatients.php?patient_search="+rechercheVal+"" : location.href = "affichagePatients.php";;
        }    
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


