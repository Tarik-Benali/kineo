<?php 

  define('SECURE_PAGE', true);

	include("../../includes/functions.php");
	include("../../includes/historique.php");

if (isset($_REQUEST['idPatient'])){
    
    global $con;

    $link = $con;

    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }

    //------------------------------------------------------ Réception de données -----------------------------------------------------
    
    $idMedecin      = mysqli_real_escape_string($link, $_REQUEST['idMedecin']);
    $nomCabinet     = mysqli_real_escape_string($link, $_REQUEST['nomCabinet']);
    $identifiant    = mysqli_real_escape_string($link, $_REQUEST['idPatient']);


    //------------------------------------------------------ Insertion Document -----------------------------------------------------

        if (isset($_FILES["upload_photo"])) {
            $photo       = $_FILES["upload_photo"];
            
            

            if($photo != NULL){
                if($identifiant != NULL){
                    //upload the photo
                    $path = "../../files/dossierPatient/" . $identifiant;

                    if(file_exists($path)){
                        //upload directelty
                        uploadPhotoMedical($nomCabinet, $identifiant, $path."/", $idMedecin, $photo, $_FILES);
                    }else{
                        //create the file
                        
                        mkdir("../../files/dossierPatient/" . $identifiant );
                        //upload the file
                        uploadPhotoMedical($nomCabinet, $identifiant, $path."/", $idMedecin, $photo, $_FILES);
                    }        
                }
            }
          }

    // Close connection
    mysqli_close($link);

    header('location: ../../rdvpatient.php?idPatient='.$identifiant.'');
  }else{
    header('location: ../../medecin.php');
  }

  
?>