<?php 

  define('SECURE_PAGE', true);

	include("../../includes/functions.php");
	include("../../includes/historique.php");

if (isset($_REQUEST['phone'])){
    
    global $con;

    $link = $con;

    // Check connection
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    //------------------------------------------------------ Réception de données -----------------------------------------------------

// Escape user inputs for security
//$first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
//$last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);

    $sexe = "Homme";
    
    $idMedecin      = mysqli_real_escape_string($link, $_REQUEST['idMedecin']);

    $idCabinet      = mysqli_real_escape_string($link, $_REQUEST['idCabinet']);

    $name           = mysqli_real_escape_string($link, $_REQUEST['name']);

    $prenom         = mysqli_real_escape_string($link, $_REQUEST['prenom']);

    $lieuN          = mysqli_real_escape_string($link, $_REQUEST['lieuN']);

    $adresse        = mysqli_real_escape_string($link, $_REQUEST['adresse']);

    $email          = mysqli_real_escape_string($link, $_REQUEST['email']);

    $phone          = mysqli_real_escape_string($link, $_REQUEST['phone']);

    if(isset($_REQUEST['sexe'])){
      $sexe           = mysqli_real_escape_string($link, $_REQUEST['sexe']);
    }

    $groupeSanguin  = mysqli_real_escape_string($link, $_REQUEST['groupeSanguin']);

    $dateRecu       = mysqli_real_escape_string($link, $_REQUEST['dateN']);

    $nomCabinet     = mysqli_real_escape_string($link, $_REQUEST['nomCabinet']);

    $bilan          = mysqli_real_escape_string($link, $_REQUEST['bilan']);

    $profession     = mysqli_real_escape_string($link, $_REQUEST['profession']);

    $phone2         = mysqli_real_escape_string($link, $_REQUEST['phone2']);

    $phone3         = mysqli_real_escape_string($link, $_REQUEST['phone3']);
 

    $pathologies    = $_REQUEST['pathologie'];

    $nbr_pathologies = count($pathologies); 


    if (isset($_REQUEST['medecin_prs'])) {
      $medecin_prs = mysqli_real_escape_string($link, $_REQUEST['medecin_prs']);
    }else{
      $medecin_prs = "Aucun médecin prescripteur indiqué";
    }
    if (isset($_REQUEST['med_rsposable'])) {
      $medecin_resp = mysqli_real_escape_string($link, $_REQUEST['med_rsposable']);
    }else{
      $medecin_resp = "Aucun médecin prescripteur indiqué";
    }

        //Date reçu sous format: mm/dd/YYYY je la transforme en: YYYY-mm-dd :)
        //$dateTransforme = str_replace('/', '-', $dateRecu);
        $dateN = date('Y-m-d', strtotime($dateRecu));
        
        $ceMoment = date("Y-m-d H:i:s");

        $anneeNaiss = substr($dateN, 0, 4);
        

        function lettersToNumber($letters){
            $alphabet = range('A', 'Z');
            $number = 0;
            $letters = strtoupper($letters);

            foreach(str_split(strrev($letters)) as $key=>$char){
                $number = $number + (array_search($char,$alphabet)+1);
            }

            return $number;
        }

        $nomPrenomPatient = $name . $prenom;

        $identifiant  = lettersToNumber($nomPrenomPatient).date("YmdHi");




//------------------------------------------------------ Insertion Photo patient -----------------------------------------------------

    if (isset($_FILES["upload_photo"])) {
      $photo       = $_FILES["upload_photo"];
      
      if($photo != NULL){
          if($identifiant != NULL){
              //upload the photo
              $path = "../../files/dossierPatient/" . $identifiant;
              if( file_exists($path)){
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
      
        
//------------------------------------------------------ Insertion patient -----------------------------------------------------

// insértion
    $sql = "INSERT INTO patient (idPatient, nomPatient, prenomPatient, datenaissPatient, lieunaissPatient, adressePatient, emailPatient, numtelPatient, sexePatient, groupagePatient, medecin_prescripteur, medecin_suiv, profession, bilan, phone_2, phone_3) VALUES ('$identifiant','$name','$prenom','$dateN','$lieuN','$adresse','$email','$phone','$sexe','$groupeSanguin','$medecin_prs', '$medecin_resp','$profession', '$bilan','$phone2', '$phone3')"; 
    
    if(mysqli_query($link, $sql))
        {
            //Fonction d'ajout de la relation patient/cabinet
             $sqls = "INSERT INTO relpatcab (idPatient,idCabinet) VALUES ('$identifiant','$idCabinet')";

             //Fonction d'ajout à l'historique
             ajoutPatient($link, $ceMoment, $idCabinet, $idMedecin, $identifiant);


              for ($i=0; $i < $nbr_pathologies; $i++) { 
                echo $pathologies[$i];

                insertRelPatientPathologie($nomCabinet,$identifiant,$pathologies[$i]);
              }


             if(mysqli_query($link, $sqls)){

             }else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
              }
     
     }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
 
// Close connection
mysqli_close($link);


/*
if(isset($name) && isset($prenom) && isset($dateRecu) && isset($identifiant)){

        $nom = (String) trim($name);
        $nom = str_replace("'","\'",$nom);

        $ddn = (String) trim($dateRecu);
        $ddn = str_replace("'","\'",$ddn);

        $prenom = (String) trim($prenom);
        $prenom = str_replace("'","\'",$prenom);

        $password = strtolower($nom);


        $username = $nom;

         $username = str_replace(""," ",$username);
     
         $reponse = testerUsername($username);



         if ($reponse == "valide") {

          insertionPatient($username,$password,$identifiant);
          
         }else{

          $anneeNaiss = substr($ddn, 8, 9);
                    
          $username = $nom . $anneeNaiss;

          $username = str_replace(""," ",$username);
          $reponse  = testerUsername($username);

          if ($reponse == "valide") {

          	insertionPatient($username,$password,$identifiant);

          }else{

            $anneeNaiss = substr($ddn, 8, 9);
            
            $username = $nom . $prenom . $anneeNaiss;

            $username = str_replace(""," ",$username);
            $reponse = testerUsername($username);

            if ($reponse == "valide") {
    
                 insertionPatient($username,$password,$identifiant);

            }else{

              $anneeNaiss = substr($ddn, 8, 9);

              $moisNaiss = substr($ddn, 0, 2);
            
              $username = $nom . $prenom . $anneeNaiss . $moisNaiss;

              $username = str_replace(""," ",$username);
              $reponse = testerUsername($username);

               if ($reponse == "valide") {

                 insertionPatient($username,$password,$identifiant);

              }else{

                $anneeNaiss = substr($ddn, 8, 9);

                $moisNaiss = substr($ddn, 0, 2);
              
                $username = $prenom . $nom . $anneeNaiss . $moisNaiss;

                $username = str_replace(""," ",$username);
                $reponse = testerUsername($username);

                if ($reponse == "valide") {
  
                	insertionPatient($username,$password,$identifiant);

                }else{

                  $anneeNaiss = substr($ddn, 8, 9);

                  $moisNaiss = substr($ddn, 0, 2);
                
                  $username = $prenom . $nom . $moisNaiss. $anneeNaiss ;

                  $username = str_replace(""," ",$username);
                  $reponse = testerUsername($username);

                  if ($reponse == "valide") {
   
                  	insertionPatient($username,$password,$identifiant);

                  }else{

                    $anneeNaiss = substr($ddn, 8, 9);

                    $moisNaiss = substr($ddn, 0, 2);
                  
                    $username = $nom . $prenom . $moisNaiss. $anneeNaiss ;

                    $username = str_replace(""," ",$username);
                    $reponse = testerUsername($username);

                    if ($reponse == "valide") {
                     
                      insertionPatient($username,$password,$identifiant);

                    }else{
                    
                      $username = $nom . $prenom;

                      $username = str_replace(""," ",$username);
                      $reponse = testerUsername($username);

                      if ($reponse == "valide") {
                     
                      insertionPatient($username,$password,$identifiant);
 
                      }else{

                        while ($reponse != "valide") {

                          $rand = rand(1,1000);

                          $username = $nom . $rand;

                          $username = str_replace(""," ",$username);
                          $reponse = testerUsername($username);

                        }
                        //** result: = valide
                        insertionPatient($username,$password,$identifiant);

                      }
                    }
                  }
                }
              }
            }
          }
        }  
    }*/
}

//echo $identifiant .' / '.$name.'  / '.$prenom.' / '.$dateN.' / '.$lieuN.' / '.$adresse.' / '.$email.' / '.$phone.' / '.$sexe.' / '.$groupeSanguin;
header('location: ../../affichagePatients.php');


?>