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

    $NomMedecin       = getMedecinName($idMedecin);

    $date = date('YmdHi');

    $ansmois  = substr($date, -10);

    $idConsultation   = $idMedecin.$idCabinet.$ansmois; 

    $prixConsultation = getConsultationPrice($nomCabinet);

    $idPatSent = "";
    //-------------------------------------------------------- récupération du motif de consultation ----------------------------------------

    if (isset($_REQUEST['motiff'])) {
        
        $motifCons  = $_REQUEST['motiff'];
         
    }else{

        $motifCons  = "Aucun Motif enregistré pour cette consultation";    

    }

    if (isset($_REQUEST['idPatRDV'])) {
        
        $idPatSent  = $_REQUEST['idPatRDV'];

        $nomPatientSent = getPatientFullName($idPatSent);
         
    }else{

        $idPatSent  = "";    

    }

    //$motifCons = getMotifCurrentConsultation($idPatient,$nomCabinet);    
    

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

    <link rel="stylesheet" href="assets/css/pupop.css">

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

    <link rel="stylesheet" href="assets/css/profile.css">

    <link href="assets/js/iCheck/flat/all.css" rel="stylesheet">

    <link href="assets/js/switch/bootstrap-switch.css" rel="stylesheet">



    <style type="text/css">
        canvas#canvas4 {
        position: relative;
        top: 20px;
        }
         .hover-link-cons {
            display: inline-block;
            color: #000;
            text-decoration: none;
        }

        .hover-link-cons::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #000;
            transition: width .3s;
        }

        .hover-link-cons:hover::after {
            width: 100%;
            //transition: width .3s;
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
                <li><a href="#" title="Sample page 1">Consultation</a>
                </li>
                <li><i class="fa fa-lg fa-angle-right"></i>
                </li>
                <li><a href="#" title="Sample page 1">Nouvelle Consultation</a>
                </li>

                <li class="pull-right">
                    <div class="input-group input-widget" style="margin-right: 10px;padding-right: 30px;">
                        
                        <!-- add rapport_medical button (opening modal)-->
                        <input id="rapport_medical" class="btn btn-success pull-right" style="border-radius:15px;display: inline-block;" value="Ajouter rapport médical" data-toggle="modal" data-target="#rapport_medical_modal"/>
                    </div>
                </li>
            </ul>

            <!-- END OF BREADCRUMB -->
<div class="flex-container" style="display: flex; align-items: stretch;">
  <div style="flex: 1; ">
  
             
<form action="impression/ordonnance.php" name="add_name" id="add_name" method="POST"> 
            <!--  DEVICE MANAGER -->

            <div class="content-wrap">
                <div class="row">                       
                    <div class="col-sm-12">
                        <div class="nest" id="headerClose1">
                            <div class="title-alt">
                                <h6>
                                    Infomartion Patient</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#headerClose1">
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
                                <div class="container">   
                                        <div class="table-responsive">  
                                                <div class="form_center" id="div_identifiant">
                                                    <div class="control-group">

                                                        <div id="espace_Recherche_ID">
                                                            <label class="control-label" for="nom">Identifiant du Patient</label>
                                                            <div class="controls">
                                                                <input type="text" name="identifiantPatient" class="form-control" id="afficherPatient"
                                                                        <?php if($idPatSent !=""){ echo "value=\"".$idPatSent."\"";}?>>
                                                            </div>
                                                        </div>

                                                        <div id="espace_Recherche_Nom">
                                                            <label class="control-label" for="nom">Recherche par nom / mail / téléphone</label>
                                                            <div class="controls">
                                                                <input type="text" name="mailPhonePatient" class="form-control" id="mailPhonePatient"
                                                                <?php if($idPatSent !=""){ echo "value=\"".$nomPatientSent."\"";}?>>
                     
                                                            </div>
                                                        </div>

                                                        <div id="espaceChoixPatient">
                                                        </div>
                                                        
                                                        <a id="a_recherche_nom" href="#">Recherche par nom/email/téléphone</a>
                                                        <a id="a_recherche_ide" href="#">Recherche par Identifiant</a>
                                                        <br><br>
                                                        <button type="button" name="importer" id="showPatient" class="btn btn-info" onclick="getInfoPatient()">Informatient Patient</button>
                                                        <button style="margin-right: 5px" type="button" name="importer" id="showCons" class="btn btn-info" onclick="getLastCons()">Dernière Consultation</button>
                                                    </div>
                                                </div>
                                        </div>           
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="content-wrap" id="infoPatient">
                <div class="row">

                    <div class="col-sm-12">

                        <div class="nest" id="tablePatientClose">
                            <div class="title-alt">
                                <h6>
                                    Information du patient</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#tablePatientClose">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#tablePatient">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="tablePatient">
                                    <div id="espacePourInfoPatient">
                                    </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
                
            

        

            <div class="content-wrap">
                <div class="row">                       
                    <div class="col-sm-12">
                        <div class="nest" id="headerClose2">
                            <div class="title-alt">
                                <h6>
                                    Examens</h6>
                                <div class="titleClose">
                                    <a class="gone" href="#headerClose2">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#header2">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>
                            </div>

                            <div class="body-nest" id="header2">
                                <div class="container">   
                                        <div class="form-group">  
                                             
                                                <div class="table-responsive">    
                                                <table class="table table-bordered" id="dynamic_field"> 
                                                    
                                                    <tr>   
                                                        <td>
                                                          <input id="medecin" name="medecin" type="hidden" value="<?php echo $Medecin; ?>" />
                                                          <input id="idConsultation" name="idConsultation" type="hidden" value="<?php echo $idConsultation;?>" />
                                                          <input id="idMedecin" name="idMedecin" type="hidden" value="<?php echo $idMedecin; ?>" />
                                                          <input type="text" name="exam[]" id="firstExam" placeholder="Nom d'examen" class="form-control" list="examChooser"/>
                                                             <datalist id="examChooser"> 
                                                                   <?php getExamsName($nomCabinet); ?>
                                                             </datalist><p id="par"></p>
                                                        </td>
                                                        <td>
                                                           <button type="button" name="add" id="add" class="btn btn-success">Ajouter des Examens</button>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><textarea style="width: 950px; height: 900px;" id="examRep" placeholder="Résultat" type="text" name="rez[]" class="form-control dose_list"></textarea></td>
                                                    </tr>
                                                    
                                                          
                                                      
                                                </table>  
                                                </div>  

                                        </div>  
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<input type="hidden" id="hjk" href="#" onclick="calculatrice()">
            <div class="content-wrap">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nest" id="headerClose3">
                            <div class="title-alt">
                                <h6>
                                    Conclusion et Diagnostic</h6>
                                <Div class="titleClose">
                                    <a class="gone" href="#headerClose3">
                                        <span class="entypo-cancel"></span>
                                    </a>
                                </div>
                                <div class="titleToggle">
                                    <a class="nav-toggle-alt" href="#header3">
                                        <span class="entypo-up-open"></span>
                                    </a>
                                </div>

                            </div>

                            <div class="body-nest" id="header3">

                                    <input type="hidden" name="idCabinet" value="<?php echo $idCabinet;?>">

                                    <input type="hidden" name="idMedecin" value="<?php echo $idMedecin;?>">

                                    <input type="hidden" name="motifCons" value="<?php echo $motifCons;?>">                                   

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
                                    <textarea style="width:100%;height:300px" id="conclusion" name="conclusion" placeholder="Conclusion / Diagnostic..."></textarea>
                                    <br>

                                    <button type="reset" class="btn btn-info" value="Reset form!">
                                        <span class="entypo-trash"></span>&nbsp;&nbsp;Effacer la conclusion !</button>

                                      <div class="pull-right">
                                      <input id="cloButton" class="btn btn-success" style="margin-right: 10px;" value="Clôturer la consultation" onclick="fin();" />
                                      <br>
                                      <input type="checkbox" id="myCheck" onclick="cloturerSansExamens()"> Clôturer sans examens
                                      </div>             

                                      <input class="btn btn-success pull-right" style="margin-right: 10px;" value="Suspendre la consultation"  onclick="fins()" />

                                <div class="form-actions" style="margin:20px 0 0 0;">                                  
                                    
                                </div>

                            </div>
                        </div>
                    </div>

                            <!-- Début de Popup de clôture -->


                                <div class="container">
                                    <div class="modal fade"  id="modalDeClôture" role="dialog">
                                        <div class="modal-dialog">
                                          	<div class="modal-content">
	                                            <div class="modal-header">
	                                              <button type="button" class="close" data-dismiss="modal"><?php echo date('H:i');?></button>
	                                              <h4 class="modal-title">Options De Clôture</h4>
	                                            </div>
		                                        <div class="modal-body" style="height: 250px; overflow-y: auto;">

		                                            <fieldset>

		                                            	<div class="form-group form-inline pull-right">
                                                                
							                                    <input type="number" step="100" id="prix" name="prixTotal" class="form-control">
							                                    <p id="showPrice" style="color: gray;cursor: pointer;"><u><i>Afficher Prix Consultation</i></u></p>

<!--------------------------------------------  get Staff Cabinet For Notif For Price -------------------------------------------------------->                                                                                                                        
							                            </div>

		                                              	<ul id="breadcrumb" style="height: 200px; margin-top: 10%">
			                                                <div class="btn-group">
			                                                    <button data-toggle="dropdown"  class="btn btn-success dropdown-toggle pull-right" type="button" style="margin-right:10px;margin-bottom:10px;">Clôture avec Ordonnance
			                                                        <span class="caret"></span>
			                                                    </button>
			                                                    <ul role="menu" class="dropdown-menu">
			                                                        <li class="hover-link-cons"><input class="hover-link-cons" style="background: transparent; border: none;margin-top: 10px" type="submit" name="cloMedic" onclick="submitForm('impression/ordonnance.php')" value="Ordonnance Médicament">
			                                                        </li>
			                                                        <li class="hover-link-cons"><input class="hover-link-cons" style="background: transparent; border: none;margin-top: 10px" type="submit" name="cloOrien" onclick="submitForm('impression/ordonnance.php')" value="Lettre d'orientation">
			                                                        </li>
			                                                        <li class="hover-link-cons"><input  style="background: transparent; border: none;margin-top: 10px" type="submit" name="cloVide" onclick="submitForm('impression/ordonnance.php')" value="Ordonnance vide">
			                                                        </li>
			                                                    </ul>
			                                                </div>

		                                                
		                                                    <input type="hidden" name="id" value="">
		                                                    <input type="hidden" name="nomCabinet" value="">

		                                                   
		                                                   <button type="submit" name="cloture" style="margin-right: 10px;" onclick="submitForm('impression/ordonnance.php')" class="btn btn-warning pull-right">
		                                                   <span class="entypo-check"></span>&nbsp;&nbsp;Clôture sans Ordonnance</button>
		                                                    
		                                            	</ul>

	                                            	</fieldset> 
	                                            </div>                                       
                                          	</div>                                                                      
                                        </div>
                                    </div>
                                </div> 
                                
                            <!-- End of Popup -->

                            <!-- Début de Popup de suspension -->


                                <div class="container">
                                    <div class="modal fade"  id="modalDeSuspension" role="dialog">
                                        <div class="modal-dialog">
                                          	<div class="modal-content">
                                            	<div class="modal-header">
                                              		<button type="button" class="close" data-dismiss="modal"><?php echo date('H:i');?></button>
                                              		<h4 class="modal-title">Options De Suspension</h4>
                                            	</div>

                                            	<div class="modal-body" style="height: 250px; overflow-y: auto;">

                                                	<fieldset>

                                                    	<div class="form-group form-inline pull-right">
                                                                
							                                    <input type="number" step="100" id="prixs" name="prixTotal" class="form-control">
							                                    <p id="showPrices" style="color: gray;cursor: pointer;"><u><i>Afficher Prix Consultation</i></u></p>

<!--------------------------------------------  get Staff Cabinet For Notif For Price -------------------------------------------------------->

							                            </div>
                                            
		                                                <ul id="breadcrumb" style="height: 200px;">
			                                                <div class="btn-group">
			                                                    <button data-toggle="dropdown"  class="btn btn-success dropdown-toggle pull-right" type="button" style="margin-right:10px;margin-bottom:10px;">Suspendre avec Ordonnance
			                                                        <span class="caret"></span>
			                                                    </button>
			                                                    <ul role="menu" class="dropdown-menu">
			                                                        <li class="hover-link-cons"><input class="hover-link-cons" style="background: transparent; border: none;margin-top: 10px" type="submit" name="suspMedic" onclick="submitForm('impression/ordonnance.php')" value="Ordonnance Médicament">
			                                                        </li>
			                                                        <li class="hover-link-cons"><input class="hover-link-cons" style="background: transparent; border: none;margin-top: 10px" type="submit" name="suspOrien" onclick="submitForm('impression/ordonnance.php')" value="Lettre d'orientation">
			                                                        </li>
			                                                        <li class="hover-link-cons"><input  style="background: transparent; border: none;margin-top: 10px" type="submit" name="suspVide" onclick="submitForm('impression/ordonnance.php')" value="Ordonnance vide">
			                                                        </li>
                                                    			</ul>
                                                			</div>

                                                
		                                                    <input type="hidden" name="id" value="">
		                                                    <input type="hidden" name="nomCabinet" value="">

                                                   
		                                                   <button type="submit" name="suspendre" style="margin-right: 10px;" onclick="submitForm('impression/ordonnance.php')" class="btn btn-warning pull-right">
		                                                   <span class="entypo-check"></span>&nbsp;&nbsp;Suspendre sans Ordonnance</button>
                                                    
                                                		</ul>

                                                	</fieldset>                    
                                            	</div> 
                                          	</div>                                                                     
                                        </div>
                                    </div>
                                </div> 
                            <!-- End of Popup -->


                </div>
            </div>

            <!-- Begin Modal rapport_medical -->
              <div class="modal fade" id="rapport_medical_modal" role="dialog">
                <div class="modal-dialog">
                
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Rapport Médical</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nature_geste_ID">Nature du geste pratiqué:</label>
                            <input type="text" placeholder="Nature du geste..." id="nature_geste_ID" name="nature_geste" class="form-control">
                        </div>
                        <hr>

                        <label>Type d'anesthésie:</label>
                        <div class="nest" id="labelClose">
                            <div class="body-nest" id="label">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="skin skin-flat">
                                            <ul class="list" id="radio_button_nature">
                                                <li style="margin-bottom : -5px;">
                                                    <input type="radio" id="square-radio-3" name="anesthesie" value="aucune" checked>
                                                    <label for="square-radio-3">Aucune</label>
                                                </li>
                                                <li style="margin-bottom: -5px;">
                                                    <input type="radio" id="square-radio-1" name="anesthesie" value="generale">
                                                    <label for="square-radio-1">Générale</label>
                                                </li>
                                                <li style="margin-bottom: -5px;">
                                                    <input type="radio" id="square-radio-1" name="anesthesie" value="locale">
                                                    <label for="square-radio-1">Locale</label>
                                                </li>
                                                <li style="margin-bottom: -5px;">
                                                    <input type="radio" id="square-radio-2" name="anesthesie" value="rachis">
                                                    <label for="square-radio-2">Rachianesthésie</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea id="compte_rendy_rapport_m" name="compte_rendy_rapport_m" cols="40" rows="4" placeholder="Compte rendu... "></textarea>
                        </div>

                        <div style="text-align: center;justify-content: center;" id="loading_rapp"></div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" id="saveRapp" onclick="save_rapport_medical()">Enregistrer</button>
                      <button type="button" class="btn btn-info" id="imprimerRappMedic" onclick="displayRapportMedical()">Imprimer / Télécharger</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                  </div>
                  
                </div>
              </div>
            <!-- End Modal rapport_medical -->

            <?php 
                   //echo "<h1 id=\"motiEnvoye\">".$motifCons."</h1>";
            ?>
            <input type="hidden" name="somme" id="somme">

            </form> 
        </div>  

        <div id="espacePourDernCons" style="flex: 1;">
    
        </div>

        
</div>   


            <?php include("fragmentsPages/footer.php"); ?>   

        </div>
    </div>

    <!--  END OF PAPER WRAP -->
        <?php include("fragmentsPages/menuSecondaire.php"); ?>
    <!-- RIGHT SLIDER CONTENT -->


    <button style="background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer;  overflow: hidden; outline:none;display: none;" id="succ" type="hidden" data-toggle="modal" data-target="#modalDeClôture"></button>
    <button style="background-color: Transparent; background-repeat:no-repeat; border: none; cursor:pointer;  overflow: hidden; outline:none;display: none;" id="fail" type="hidden" data-toggle="modal" data-target="#modalDeSuspension"></button>



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

    <!-- /MAIN EFFECT -->
    <script type="text/javascript" src="assets/js/iCheck/jquery.icheck.js"></script>
    <script type="text/javascript" src="assets/js/switch/bootstrap-switch.js"></script>

    <!--  PLUGIN -->
    <script>
    $(document).ready(function() {
        //CHECKBOX PRETTYFY
        $('.skin-flat input').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });
        $('.skin-line input').each(function() {
            var self = $(this),
                label = self.next(),
                label_text = label.text();

            label.remove();
            self.iCheck({
                checkboxClass: 'icheckbox_line-blue',
                radioClass: 'iradio_line-blue',
                insert: '<div class="icheck_line-icon"></div>' + label_text
            });
        });
        //Switch Button

        $('.make-switch').bootstrapSwitch('setSizeClass', 'switch-small');
    });
    </script>


    <script>  
         $(document).ready(function(){  
              var i=1;  
              $('#add').click(function(){  
                   i++;  
                   $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="exam[]" placeholder="Nom d\'examen" class="form-control" list="examChooser"/><datalist id="examChooser"><?php getExamsName($nomCabinet); ?></datalist></td><td><button type="button" name="removeeee" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr><tr><td id="row2'+i+'"><textarea type="text" name="rez[]" placeholder="Résultat" class="form-control dose_list"></textarea></td></tr>');    
              });  
              $(document).on('click', '.btn_remove', function(){  
                   var button_id = $(this).attr("id");   
                   $('#row'+button_id+'').remove(); 
                   $('#row2'+button_id+'').remove();  
              });    
         });  
    </script>

    <script>  

        function getInfoPatient(){


            $(document).ready(function(){
 
                   $('#espacePourInfoPatient').html('');

                   var Patient    = $("#afficherPatient").val();
                   var NomCabinet = "<?php echo $nomCabinet;?>";
                   var IdCabinet  = "<?php echo $idCabinet;?>";

                   if (Patient != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/afficherUnPatient.php",  
                          type:"GET",  
                          data:{Identifiant: encodeURIComponent(Patient), nomCabinet: NomCabinet, idCabinet: IdCabinet},
                          success:function(data)  
                          {  
                               if (data != "") {
                                    $('#espacePourInfoPatient').append(data);
                                }

                                else{
                                document.getElementById('espacePourInfoPatient').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Faut Identifiant</div>"
                               }
                          }  
                      });
                    }                        
            });                                 
        }
    </script>

    <script>  

        function getLastCons(){

         $(document).ready(function(){
 
                   $('#espacePourDernCons').html('');

                   var Cons = $("#afficherPatient").val();

                   if (Cons != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/affichageDerniereCons.php",  
                          type:"GET",  
                          data:{Identifiant: encodeURIComponent(Cons)},  
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#espacePourDernCons').append(data);
                               } else{
                                document.getElementById('espacePourDernCons').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Faut Identifiant</div>"
                               }
                          }  
                      });
                     }                         
              });                                 
        }
    </script>


    <script>  
         $(document).ready(function(){

              $('#mailPhonePatient').keyup(function(){  
                   $('#espaceChoixPatient').html('');

                   var NomPatient = $(this).val();

                   if (NomPatient != ""){

                      $.ajax({
                          url:"fonctionnalites/affichage/getPatientFromName.php",  
                          type:"GET",  
                          data:{NomPhonePatient: encodeURIComponent(NomPatient)},
                          success:function(data)  
                          {  
                               if (data != "") {
                                $('#espaceChoixPatient').append(data);
                               } else{
                                document.getElementById('espaceChoixPatient').innerHTML = "<div style='font-size:20xp; text-align:center; margin-top:10xp'>Pas de Patient de ces infos</div>"
                               }
                          }  
                      });
                     }      
                }); 
              });                                 
    </script>


    <script>

    	function savePrixConsul(){

    		$(document).ready(function(){

                   var Prix     = document.getElementById("somme").value;
                   var IdCons   = "<?php echo $idConsultation; ?>";
                   var Cabinet  = "<?php echo $nomCabinet; ?>";

                   //console.log(Prix+' ' +IdCons+ ' '+Cabinet);


                   if (Prix != "" && IdCons != "" && Cabinet != ""){

                      $.ajax({
                          url:"fonctionnalites/ajout/saveUpdatedPrixConsul.php",  
                          type:"GET",  
                          data:{prix: encodeURIComponent(Prix),idCons: encodeURIComponent(IdCons),cabinet: encodeURIComponent(Cabinet)},
                          success:function(data)  
                          {  
                               if (data != "") {
                                console.log("Prix enregistré.");

                                sendPriceNotif();
                               } else{
                                console.log("Prix non enregistré !");
                               }
                          }  
                      });
                     }       
              });
    	}  
                                          
    </script>
    
    <!-- Afficher et masquer Infos Patient -->
    <script>
      $(document).ready(function(){
        // hide add rapport_medical button
            $("#rapport_medical").hide();
            $("#imprimerRappMedic").hide();
            
            var valNature_geste = $("#nature_geste_ID").val();
            if (valNature_geste =="") {
                $("#saveRapp").attr("disabled",true);
            }

            $('#nature_geste_ID').on('keyup', function () {
                var valNatureGeste = $("#nature_geste_ID").val();
                if (valNatureGeste =="") {
                    $("#saveRapp").attr("disabled",true);
                }else{
                    $("#saveRapp").attr("disabled",false);
                }                 
            });
        //fin init rapport médical
        

        $("#infoPatient").hide();
        $("#espacePourInfoPatient").hide();
            $("#showPatient").click(function(){
              $("#infoPatient").show();
              $("#espacePourInfoPatient").show();
            });
      });
    </script>
    <script>
      $(document).ready(function(){
          $('#afficherPatient').keydown(function(){  
                $("#espacePourInfoPatient").hide();
                $("#infoPatient").hide();
            }); 
      });
    </script> 
            <!-- Afficher et masquer dernière consultation -->
    <script>
      $(document).ready(function(){
        $("#espacePourDernCons").hide();
            $("#showCons").click(function(){
                if ($("#espacePourDernCons").is(":hidden")) {
                    $("#espacePourDernCons").show();
                }else{
                    $("#espacePourDernCons").hide();
                }
            });
      });

      $(document).ready(function(){
          $('#afficherPatient').keydown(function(){  
                $("#espacePourDernCons").hide();
            }); 
      });

      $(document).keydown(function (e) {

            if (e.keyCode == 13) {
                $("#espacePourDernCons").hide();
            }    
        });
    </script>   

    <script>
        function submitForm(action)
        {
            document.getElementById('add_name').action = action;
            document.getElementById('add_name').submit();
        }
    </script>  

    <script>
        function openForm() {
          document.getElementById("myForm").style.display = "block";
        }

        function closeForm() {
          document.getElementById("myForm").style.display = "none";
        }


        function calculatrice() {
           var element = document.getElementsByName("exam[]");

           console.log(element.length);
        }

       
    </script> 

    <script>  
         $(document).ready(function () {
              $('#cloButton').attr('disabled', true);
              $('#identifiantPatient,#examRep').on('keyup', function () {
                  var idP = $("#identifiantPatient").val();
                  var exam = $("#examRep").val();
                  if (idP != '' && exam != '' ) {
                      $('#cloButton').attr('disabled', false);
                  } else {
                      $('#cloButton').attr('disabled', true);
                  }
              });
          });                                
    </script>

    <script>

    		var prixTotal;
    		var prixExam ;

    		var prixCons = "<?php echo $prixConsultation; ?>";
    		var prixCons = parseInt(prixCons);


			function fin(){

				$("#prix").val("");
				$("#showPrice").show();
			    $("#prix").hide();
			    $("#confirmPrice").hide();
                $("#idStaff").hide();
                $("#successimgClo").hide();

			    var prixTotal = 0;
    			var prixExam  = 0;

				var element = document.getElementsByName("exam[]");
 
			    if(typeof(element) != 'undefined' && element != null && element.length <2){

			    	var exa = document.getElementById("firstExam").value;

			        $(document).ready(function(){

		                   var Exam = exa;
		                   var Cabi = "<?php echo $nomCabinet; ?>";

		                   if (Exam != "" && Cabi != ""){

		                      $.ajax({
		                          url:"fonctionnalites/affichage/calculPrixConsul.php",  
		                          type:"GET",  
		                          data:{examen: encodeURIComponent(Exam), nomCabinet: encodeURIComponent(Cabi)},
		                          success:function(data)  
		                          {  
		                               if (data != "") {

		                               	prixExam = parseInt(data);

		                               	prixTotal = prixExam + prixCons;

		                               	//document.getElementById("prixTotal").value = prixTotal;
		                               	document.getElementById("somme").value = prixTotal;

		                               	document.getElementById("succ").click();

		                               } else{
		                               }
		                          }  
		                      });
		                     }      
		            });

		            
		            

			    } else{
			        
			        var myControls = document.forms.add_name.elements['exam[]'];

					for (var i = 0; i <= myControls.length; i++) {
					    var exa = myControls[i].value;

						$(document).ready(function(){

			                var Exam = exa;
			                var Cabi = "<?php echo $nomCabinet; ?>";

			                    if (Exam != "" && Cabi != ""){

				                    $.ajax({
				                          url:"fonctionnalites/affichage/calculPrixConsul.php",  
				                          type:"GET",  
				                          data:{examen: encodeURIComponent(Exam), nomCabinet: encodeURIComponent(Cabi)},
				                          success:function(data)  
				                          {  
				                               if (data != "") {

				                               	var ex = parseInt(data);

				                               	prixExam = prixExam + ex;

				                               	prixTotal = prixExam + prixCons;

				                               	document.getElementById("somme").value = prixTotal;

				                               } else{
				                               }
				                          }

				                    });

				                    document.getElementById("succ").click();
			                    }      
			            });
					}					
			    }
			}

			$(document).ready(function(){

			        $("#showPrice").show();
			        $("#prix").hide();
			        $("#confirmPrice").hide();
                    $("#idStaff").hide();
                    $("#successimgClo").hide();
			        
			            $("#showPrice").click(function(){
			              
			              var kkk = document.getElementById("somme").value;
			              var summ = parseInt(kkk);
			              console.log(summ);
			              $("#prix").val(summ);

			              $("#showPrice").hide();
			              $("#prix").show();
			              $("#confirmPrice").show();
                          $("#idStaff").show();

			            });
			      });
    </script>

    <script>

    		var prixTotals;
    		var prixExams ;

    		var prixCons = "<?php echo $prixConsultation; ?>";
    		var prixCons = parseInt(prixCons);

    		


			function fins(){

				$("#prixs").val("");
				$("#showPrices").show();
			    $("#prixs").hide();
			    $("#confirmPrices").hide();
                $("#idStaffs").hide();
                $("#successimgSus").hide();


			    var prixTotals = 0;
    			var prixExams  = 0;

				var element = document.getElementsByName("exam[]");
 
			    if(typeof(element) != 'undefined' && element != null && element.length <2){

			    	var exa = document.getElementById("firstExam").value;

			        $(document).ready(function(){

		                   var Exam = exa;
		                   var Cabi = "<?php echo $nomCabinet; ?>";

		                   if (Exam != "" && Cabi != ""){

		                      $.ajax({
		                          url:"fonctionnalites/affichage/calculPrixConsul.php",  
		                          type:"GET",  
		                          data:{examen: encodeURIComponent(Exam), nomCabinet: encodeURIComponent(Cabi)},
		                          success:function(data)  
		                          {  
		                               if (data != "") {

		                               	prixExams = parseInt(data);

		                               	prixTotals = prixExams + prixCons;

		                               	//document.getElementById("prixTotal").value = prixTotal;
		                               	document.getElementById("somme").value = prixTotals;

		                               	document.getElementById("fail").click();

		                               } else{
		                               }
		                          }  
		                      });
		                     }      
		            });

		            
		            

			    } else{
			        
			        var myControls = document.forms.add_name.elements['exam[]'];

					for (var i = 0; i <= myControls.length; i++) {
					    var exa = myControls[i].value;

						$(document).ready(function(){

			                var Exam = exa;
			                var Cabi = "<?php echo $nomCabinet; ?>";

			                    if (Exam != "" && Cabi != ""){

				                    $.ajax({
				                          url:"fonctionnalites/affichage/calculPrixConsul.php",  
				                          type:"GET",  
				                          data:{examen: encodeURIComponent(Exam), nomCabinet: encodeURIComponent(Cabi)},
				                          success:function(data)  
				                          {  
				                               if (data != "") {

				                               	var ex = parseInt(data);

				                               	prixExams = prixExams + ex;

				                               	prixTotals = prixExams + prixCons;

				                               	document.getElementById("somme").value = prixTotals;

				                               } else{
				                               }
				                          }

				                    });

				                    document.getElementById("fail").click();
			                    }      
			            });
					}					
			    }
			}


			$(document).ready(function(){

			        $("#showPrices").show();
			        $("#prixs").hide();
			        $("#confirmPrices").hide();
                    $("#idStaffs").hide();
                    $("#successimgSus").hide();
			        
			            $("#showPrices").click(function(){
			              
			              var kkk = document.getElementById("somme").value;
			              var summ = parseInt(kkk);
			              console.log(summ);
			              $("#prixs").val(summ);

			              $("#showPrices").hide();
			              $("#prixs").show();
                          $("#idStaffs").show();
			              $("#confirmPrices").show();

			            });
			      }); 
    </script>



    <script>
        function cloturerSansExamens() {
            var checkBox = document.getElementById("myCheck");
            var text = document.getElementById("text");
                if (checkBox.checked == true){
                        $('#cloButton').attr('disabled', false);
                    } else {
                        $('#cloButton').attr('disabled', true);
                        }
                    } 
    </script>

    

    <script>
      $(document).ready(function(){
        $("#a_recherche_nom").hide();
        $("#espace_Recherche_ID").hide();
        $("#a_recherche_ide").show();
        $("#espace_Recherche_Nom").show();

            $("#a_recherche_nom").click(function(){
              $("#a_recherche_ide").show();
              $("#espace_Recherche_Nom").show();
              $("#a_recherche_nom").hide();
              $("#espace_Recherche_ID").hide();
            });

            $("#a_recherche_ide").click(function(){
              $("#a_recherche_nom").show();
              $("#espace_Recherche_ID").show();
              $("#a_recherche_ide").hide();
              $("#espace_Recherche_Nom").hide();
            });
      });
    </script>

    <script>
      function actualiserAvecID(ID){

            $("#espaceChoixPatient").hide();
            $("#espace_Recherche_ID").show();
            $("#a_recherche_ide").hide();
            $("#espace_Recherche_Nom").hide();

            document.getElementById("afficherPatient").value = ID;

            // show add rapport_medical button
            $("#rapport_medical").show();
      }

      // save rapport_medical

      function save_rapport_medical(){

            
            document.getElementById('loading_rapp').innerHTML = "<img src=\"assets/img/831.gif\">";

            var nature_geste = $('#nature_geste_ID').val();
            var checkBoxRadi = $('input:radio:checked').val();
            var compte_rendy = $('#compte_rendy_rapport_m').val();

            var IdConsu      = "<?php echo $idConsultation; ?>";
            var Patiens      = $("#afficherPatient").val();

            if (checkBoxRadi != "" && IdConsu != "" && Patiens != ""){

                $.ajax({
                      url:"fonctionnalites/ajout/ajoutRapportMedical.php",  
                      type:"GET",  
                      data:{idCons: IdConsu, idPat: Patiens, natGeste: nature_geste, comptRend: compte_rendy, typeAn: checkBoxRadi},
                      success:function(data)  
                      {  
                           if (data != "") {
                                
                                $("#saveRapp").hide();
                                $("#imprimerRappMedic").show();
                                document.getElementById('loading_rapp').innerHTML = "Rapport Médical enregistré <img src=\"assets/img/valid.png\" height=\"40px\" width=\"40px\">";

                           }
                           else{
                                alert('Not save !');
                                document.getElementById('loading_rapp').innerHTML = "";
                           }
                      }

                });
            }
            //alert(nature_geste+' | '+checkBoxRadi+' | '+compte_rendy);
      }

      function displayRapportMedical(){

        var idPatie = $("#afficherPatient").val();
        var idConsu = "<?php echo $idConsultation; ?>";

        window.open('rapportmedic.php?Identifiant='+idPatie+'&IdConsul='+idConsu+'', '_blank');
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