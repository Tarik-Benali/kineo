<?php
  include("../../auth/auth.php");
  include("../../includes/functions.php");

  $signallisation = "";
  $motifsignallis = "";

  if (isset($_REQUEST['nomCabinet']) && isset($_REQUEST['idPatien'])) {

    $signagl    = explode("||", getPatientSignalisation($_REQUEST['nomCabinet'],$_REQUEST['idPatien']));
    $signallisation = $signagl[0];
    $motifsignallis = $signagl[1];
  }




if (isset($_SESSION['typeCompte']) && isset($_REQUEST['nomCabinet']) && $_SESSION['typeCompte'] !="" && $_REQUEST['nomCabinet'] !="" && !isset($_REQUEST['seance']) && !isset($_REQUEST['prgRDV'])){


    $nomCabinet = $_REQUEST['nomCabinet'];
       
       $nomBD  = crypterNomDeLaBase($nomCabinet);

       global $host_name;
       global $baseGlobale;
       global $db_user_name;
       global $db_password;

    $link = mysqli_connect($host_name, $db_user_name, $db_password, $nomBD);
     
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
     
    // Escape user inputs for security

    $type         = mysqli_real_escape_string($link, $_REQUEST['type']);
    $idCab        = mysqli_real_escape_string($link, $_REQUEST['idCab']);
    $dateRDV      = mysqli_real_escape_string($link, $_REQUEST['dateRDV']);
    $medecin      = mysqli_real_escape_string($link, $_REQUEST['medecin']);
    $heureRDV     = mysqli_real_escape_string($link, $_REQUEST['timeRDV']);
    $motifCons    = mysqli_real_escape_string($link, $_REQUEST['motifCons']);
    $identifiantP = mysqli_real_escape_string($link, $_REQUEST['idPatien']);


    //verifSiPatDejaDsCabinet($identifiantP, $idCab);
    $name   = "";
    $mail   = "";
    $phone  = "";
    $prenom = ""; 

                try
                    {
                                                            
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomBD",$db_user_name,$db_password, $pdo_options);                      
                                    
                        // On recupere tout le contenu de la table news
                        $reponse = $bdd->query("SELECT * FROM patient WHERE idPatient = '$identifiantP'");
                                                          
                        // On affiche le resultat
                        while ($donnees = $reponse->fetch())
                           {
                                $name   = $donnees['nomPatient'];
                                $mail   = $donnees['emailPatient'];
                                $phone  = $donnees['numTelPatient'];
                                $prenom = $donnees['prenomPatient'];                                                      
                            }
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    } 

    // Close connection
    mysqli_close($link);


    switch ($_SESSION['typeCompte']) {

      case '1':

            if (isset($_REQUEST['type']) && $type=="1") {

                insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"1",$signallisation,$motifsignallis);
                header("Location: ../../mesRDV.php");
            }
            /*else if ($_REQUEST['type'] == "0") {
                insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$medecin,$identifiantP,"0");
                header("Location: ../../mesRDV.php");
            }*/
        break;

      case '2':

            if (isset($_REQUEST['type'])) {

                if ($_REQUEST['type'] == "0") {
                    insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"0",$signallisation,$motifsignallis);
                    header("Location: ../../medecin.php");
                  }

                else if ($_REQUEST['type'] == "2") {
                    insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"2",$signallisation,$motifsignallis);
                    header("Location: ../../medecin.php");
                }
            }

        break;

      case '5':

            if (isset($_REQUEST['type'])) {

                if ($_REQUEST['type'] == "0") {echo " 0";
                    insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"0",$signallisation,$motifsignallis);
                    header("Location: ../../staff.php");
                  }

                else if ($_REQUEST['type'] == "2") {echo " 1";

                    insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"2",$signallisation,$motifsignallis);
                    header("Location: ../../staff.php");
                }
            }
        break;    
    }


    }else if (isset($_SESSION['typeCompte']) && isset($_REQUEST['nomCabinet']) && $_REQUEST['nomCabinet'] !="" && isset($_REQUEST['seance']) && !isset($_REQUEST['prgRDV'])){


    $nomCabinet = $_REQUEST['nomCabinet'];
       
       $nomBD  = crypterNomDeLaBase($nomCabinet);

       global $host_name;
       global $baseGlobale;
       global $db_user_name;
       global $db_password;

    $link = mysqli_connect($host_name, $db_user_name, $db_password, $nomBD);
     
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
     
    // Escape user inputs for security

    $type         = mysqli_real_escape_string($link, $_REQUEST['type']);
    $idCab        = mysqli_real_escape_string($link, $_REQUEST['idCab']);
    $dateRDV      = mysqli_real_escape_string($link, $_REQUEST['dateRDV']);
    $medecin      = mysqli_real_escape_string($link, $_REQUEST['medecin']);
    $motifCons    = mysqli_real_escape_string($link, $_REQUEST['motifCons']);
    $identifiantP = mysqli_real_escape_string($link, $_REQUEST['idPatien']);
    $id_seance    = mysqli_real_escape_string($link, $_REQUEST['seance']);
    $heureRDV     = getSeanceBeginTime($nomCabinet,$id_seance);


    //verifSiPatDejaDsCabinet($identifiantP, $idCab);
    $name   = "";
    $mail   = "";
    $phone  = "";
    $prenom = ""; 

                try
                    {
                                                            
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomBD",$db_user_name,$db_password, $pdo_options);                      
                                    
                        // On recupere tout le contenu de la table news
                        $reponse = $bdd->query("SELECT * FROM patient WHERE idPatient = '$identifiantP'");
                                                          
                        // On affiche le resultat
                        while ($donnees = $reponse->fetch())
                           {
                                $name   = $donnees['nomPatient'];
                                $mail   = $donnees['emailPatient'];
                                $phone  = $donnees['numTelPatient'];
                                $prenom = $donnees['prenomPatient'];                                                      
                            }
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    } 

    // Close connection
    mysqli_close($link);

    $lastIdInseted = "";


    switch ($_SESSION['typeCompte']) {

      case '1':

            if (isset($_REQUEST['type']) && $type=="1") {

                $lastIdInseted = insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"1",$signallisation,$motifsignallis);
                    insertionRelationRDVSeance($nomCabinet,$id_seance,$lastIdInseted);
                header("Location: ../../mesRDV.php");
            }
            /*else if ($_REQUEST['type'] == "0") {
                insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$medecin,$identifiantP,"0");
                header("Location: ../../mesRDV.php");
            }*/
        break;

      case '2':

            if (isset($_REQUEST['type'])) {

                if ($_REQUEST['type'] == "0") {
                    $lastIdInseted = insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"0",$signallisation,$motifsignallis);
                    insertionRelationRDVSeance($nomCabinet,$id_seance,$lastIdInseted);
                    header("Location: ../../medecin.php");
                  }

                else if ($_REQUEST['type'] == "2") {
                    $lastIdInseted = insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"2",$signallisation,$motifsignallis);
                    insertionRelationRDVSeance($nomCabinet,$id_seance,$lastIdInseted);
                    header("Location: ../../medecin.php");
                }
            }

        break;

      case '5':

            if (isset($_REQUEST['type'])) {

                if ($_REQUEST['type'] == "0") {echo " 0";
                    $lastIdInseted = insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"0",$signallisation,$motifsignallis);
                    insertionRelationRDVSeance($nomCabinet,$id_seance,$lastIdInseted);
                    header("Location: ../../staff.php");
                  }

                else if ($_REQUEST['type'] == "2") {echo " 1";

                    $lastIdInseted = insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"2",$signallisation,$motifsignallis);
                    insertionRelationRDVSeance($nomCabinet,$id_seance,$lastIdInseted);
                    header("Location: ../../staff.php");
                }
            }
        break;    
    }


}else if (isset($_SESSION['typeCompte']) && isset($_REQUEST['nomCabinet']) && $_REQUEST['nomCabinet'] !="" && isset($_REQUEST['seance']) && isset($_REQUEST['prgRDV'])){


    $nomCabinet = $_REQUEST['nomCabinet'];
       
       $nomBD  = crypterNomDeLaBase($nomCabinet);

       global $host_name;
       global $baseGlobale;
       global $db_user_name;
       global $db_password;

    $link = mysqli_connect($host_name, $db_user_name, $db_password, $nomBD);
     
    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
     
    // Escape user inputs for security

    $type         = mysqli_real_escape_string($link, $_REQUEST['type']);
    $idCab        = mysqli_real_escape_string($link, $_REQUEST['idCab']);
    $dateRDV      = mysqli_real_escape_string($link, $_REQUEST['dateRDV']);
    $medecin      = mysqli_real_escape_string($link, $_REQUEST['medecin']);
    $motifCons    = mysqli_real_escape_string($link, $_REQUEST['motifCons']);
    $identifiantP = mysqli_real_escape_string($link, $_REQUEST['idPatien']);
    $id_seance    = mysqli_real_escape_string($link, $_REQUEST['seance']);
    $heureRDV     = getSeanceBeginTime($nomCabinet,$id_seance);


    //verifSiPatDejaDsCabinet($identifiantP, $idCab);
    $name   = "";
    $mail   = "";
    $phone  = "";
    $prenom = ""; 

                try
                    {
                                                            
                        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                        $bdd = new PDO("mysql:host=$host_name;dbname=$nomBD",$db_user_name,$db_password, $pdo_options);                      
                                    
                        // On recupere tout le contenu de la table news
                        $reponse = $bdd->query("SELECT * FROM patient WHERE idPatient = '$identifiantP'");
                                                          
                        // On affiche le resultat
                        while ($donnees = $reponse->fetch())
                           {
                                $name   = $donnees['nomPatient'];
                                $mail   = $donnees['emailPatient'];
                                $phone  = $donnees['numTelPatient'];
                                $prenom = $donnees['prenomPatient'];                                                      
                            }
                        $reponse->closeCursor();
                    }
                catch(Exception $e)
                    {
                       die('Erreur : '.$e->getMessage());
                    } 

    // Close connection
    mysqli_close($link);

    $lastIdInseted = "";


    switch ($_SESSION['typeCompte']) {

      case '1':

            if (isset($_REQUEST['type']) && $type=="1") {

                $lastIdInseted = insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"1",$signallisation,$motifsignallis);
                    insertionRelationRDVSeance($nomCabinet,$id_seance,$lastIdInseted);
                header("Location: ../../rdvpatient.php?idPatient=".$identifiantP);
            }
            /*else if ($_REQUEST['type'] == "0") {
                insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$medecin,$identifiantP,"0");
                header("Location: ../../mesRDV.php");
            }*/
        break;

      case '2':

            if (isset($_REQUEST['type'])) {

                if ($_REQUEST['type'] == "0") {
                    $lastIdInseted = insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"0",$signallisation,$motifsignallis);
                    insertionRelationRDVSeance($nomCabinet,$id_seance,$lastIdInseted);
                    header("Location: ../../rdvpatient.php?idPatient=".$identifiantP);
                  }

                else if ($_REQUEST['type'] == "2") {
                    $lastIdInseted = insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"2",$signallisation,$motifsignallis);
                    insertionRelationRDVSeance($nomCabinet,$id_seance,$lastIdInseted);
                    header("Location: ../../rdvpatient.php?idPatient=".$identifiantP);
                }
            }

        break;

      case '5':

            if (isset($_REQUEST['type'])) {

                if ($_REQUEST['type'] == "0") {echo " 0";
                    $lastIdInseted = insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"0",$signallisation,$motifsignallis);
                    insertionRelationRDVSeance($nomCabinet,$id_seance,$lastIdInseted);
                    header("Location: ../../rdvpatient.php?idPatient=".$identifiantP);
                  }

                else if ($_REQUEST['type'] == "2") {echo " 1";

                    $lastIdInseted = insertionRDV($nomCabinet,$name,$prenom,$mail,$phone,$dateRDV,$heureRDV,$motifCons,$medecin,$identifiantP,"2",$signallisation,$motifsignallis);
                    insertionRelationRDVSeance($nomCabinet,$id_seance,$lastIdInseted);
                    header("Location: ../../rdvpatient.php?idPatient=".$identifiantP);
                }
            }
        break;    
    }


}else{
  echo "Rendez-vous non Ajouté, informations manquantes !";
}

?>