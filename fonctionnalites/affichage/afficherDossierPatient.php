     <?php       
     include("../../auth/auth.php");
     include("infoPatientPourConsultation.php");
     include("../../includes/functions.php");
     include("infoExamenPourConsultation.php");

     if(isset($_GET['Identifiant'])){
        $identifiant    = (String) trim($_GET['Identifiant']);
        $nomCabinet     = (String) trim($_GET['nomCabinet']);
        $optionFiltre   = (String) trim($_GET['optionFiltre']);


    if ($optionFiltre == "monCabinet") {
    
            dossierPationDeMonCabinet($identifiant, $nomCabinet, $optionFiltre);
         
        }elseif ($optionFiltre =="allCabinet") {
             dossierPationDeToutLesCabinets($identifiant, $optionFiltre); 
        }

    }
 ?>

