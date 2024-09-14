<?php 

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
    
    $idMedecin      = mysqli_real_escape_string($link, $_REQUEST['idMedecin']);

    $idCabinet      = mysqli_real_escape_string($link, $_REQUEST['idCabinet']);

    $name           = mysqli_real_escape_string($link, $_REQUEST['name']);

    $prenom         = mysqli_real_escape_string($link, $_REQUEST['prenom']);

    $lieuN          = mysqli_real_escape_string($link, $_REQUEST['lieuN']);

    $adresse        = mysqli_real_escape_string($link, $_REQUEST['adresse']);

    $email          = mysqli_real_escape_string($link, $_REQUEST['email']);

    $phone          = mysqli_real_escape_string($link, $_REQUEST['phone']);

    $sexe           = mysqli_real_escape_string($link, $_REQUEST['sexe']);

    $groupeSanguin  = mysqli_real_escape_string($link, $_REQUEST['groupeSanguin']);

    $dateRecu       = mysqli_real_escape_string($link, $_REQUEST['dateN']);

    $nomCabinet     = mysqli_real_escape_string($link, $_REQUEST['nomCabinet']);

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

        $nomPrenomPatient = $nom . $prenom;

        $identifiant  = lettersToNumber($nomPrenomPatient).date("YmdHis");

        
     //------------------------------------------------------ Insertion patient -----------------------------------------------------
      

// insértion
    $sql = "INSERT INTO `medecin`(`idMedecin`,`nomMedecin`,`prenomMedecin`,`dateNaissMedecin`,`lieuNaissMedecin`,`adresseMedecin`,`emailMedecin`,`numTelMedecin`, `sexeMedecin`, `groupageMedecin`) VALUES ('$identifiant','$name','$prenom','$dateN','$lieuN','$adresse','$email','$phone','$sexe','$groupeSanguin')"; 
    
    if(mysqli_query($link, $sql))
        {
            //Fonction d'ajout de la relation patient/cabinet
             $sqls = "INSERT INTO relationmedcab (idCabinet,idMedecin) VALUES ('$idCabinet','$identifiant')";

             //Fonction d'ajout à l'historique
             ajoutMedecinHisto($link, $ceMoment, $idCabinet, $idMedecin, $identifiant);
             insertNewMedecinPourcentage($nomCabinet, $identifiant);
             insertDefaultTheme($identifiant);

             if(mysqli_query($link, $sqls)){

             }  else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }
     
     }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
 
// Close connection
mysqli_close($link);


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

          insertionMedecinUser($username,$password,$identifiant);
          
         }else{

          $anneeNaiss = substr($ddn, 8, 9);
                    
          $username = $nom . $anneeNaiss;

          $username = str_replace(""," ",$username);
          $reponse  = testerUsername($username);

          if ($reponse == "valide") {

          	insertionMedecinUser($username,$password,$identifiant);

          }else{

            $anneeNaiss = substr($ddn, 8, 9);
            
            $username = $nom . $prenom . $anneeNaiss;

            $username = str_replace(""," ",$username);
            $reponse = testerUsername($username);

            if ($reponse == "valide") {
    
                 insertionMedecinUser($username,$password,$identifiant);

            }else{

              $anneeNaiss = substr($ddn, 8, 9);

              $moisNaiss = substr($ddn, 0, 2);
            
              $username = $nom . $prenom . $anneeNaiss . $moisNaiss;

              $username = str_replace(""," ",$username);
              $reponse = testerUsername($username);

               if ($reponse == "valide") {

                 insertionMedecinUser($username,$password,$identifiant);

              }else{

                $anneeNaiss = substr($ddn, 8, 9);

                $moisNaiss = substr($ddn, 0, 2);
              
                $username = $prenom . $nom . $anneeNaiss . $moisNaiss;

                $username = str_replace(""," ",$username);
                $reponse = testerUsername($username);

                if ($reponse == "valide") {
  
                	insertionMedecinUser($username,$password,$identifiant);

                }else{

                  $anneeNaiss = substr($ddn, 8, 9);

                  $moisNaiss = substr($ddn, 0, 2);
                
                  $username = $prenom . $nom . $moisNaiss. $anneeNaiss ;

                  $username = str_replace(""," ",$username);
                  $reponse = testerUsername($username);

                  if ($reponse == "valide") {
   
                  	insertionMedecinUser($username,$password,$identifiant);

                  }else{

                    $anneeNaiss = substr($ddn, 8, 9);

                    $moisNaiss = substr($ddn, 0, 2);
                  
                    $username = $nom . $prenom . $moisNaiss. $anneeNaiss ;

                    $username = str_replace(""," ",$username);
                    $reponse = testerUsername($username);

                    if ($reponse == "valide") {
                     
                      insertionMedecinUser($username,$password,$identifiant);

                    }else{
                    
                      $username = $nom . $prenom;

                      $username = str_replace(""," ",$username);
                      $reponse = testerUsername($username);

                      if ($reponse == "valide") {
                     
                      insertionMedecinUser($username,$password,$identifiant);
 
                      }else{

                        while ($reponse != "valide") {

                          $rand = rand(1,1000);

                          $username = $nom . $rand;

                          $username = str_replace(""," ",$username);
                          $reponse = testerUsername($username);

                        }
                        //** result: = valide
                        insertionMedecinUser($username,$password,$identifiant);

                      }
                    }
                  }
                }
              }
            }
          }
        }  
    }
}

header('location: ../../medecin.php');


?>