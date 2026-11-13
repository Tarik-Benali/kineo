 <?php
  
  include("../auth/auth.php");
  include("../../includes/functions.php");

  global $con;

  $link = $con;

  global $host_name;
  global $db_user_name;
  global $db_password;
  global $baseGlobale;


if (isset($_POST['suspendre'])) {

  if(isset($_SESSION['idDeCeMedecin'])){
        
        $medecin    = $_SESSION['username'];
        $idMedecin  = $_SESSION['idDeCeMedecin'];
        $nomCabinet = $_SESSION['nomDeCeCabinet'];}

        $conclusion         = $_REQUEST['conclusion'];
        $conclusion         = str_replace("'","\'",$conclusion);
        $identifiantPatient = $_REQUEST['identifiantPatient']; 
        $identifiantPatient = str_replace("'","\'",$identifiantPatient);

        $ceMoment = date("Y-m-d H:i:s");
        $idConsultation = date("YmdHis");

        $database = crypterNomDeLaBase($nomCabinet);


 if (isset($_REQUEST['idRDV'])) {

            $idRendezvous = $_REQUEST['idRDV'];
          }else{
            $idRendezvous = "";
          }       

 if (isset($_REQUEST["exam"])){
 
     //---------------------------------------------- insertion exam et conss -------------------------------------------------

if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  $number = count($_POST["exam"]);  
   if($number > 0)  
   {  
        for($i=0; $i<$number; $i++)  
        {  
             if(trim($_POST["exam"][$i] != ''))  
             { 

              $typeExam = $_POST["exam"][$i];
              insertExam($nomCabinet, $idConsultation, $typeExam);     
                                    
             }  
        }    
   }  
   else  
   {  
        echo "Aucun examen";  
   }

// Close connection
mysqli_close($link);
}       
                try  {
                                                        
                                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);                      
                                
                                // On recupere tout le contenu de la table news
                                $reponse = $bdd->query("INSERT INTO consultations(idConsultation,idPatient,idRendezvous,idMedecin,conclusion,heureConsultation) VALUES ('$idConsultation','$identifiantPatient','$idRendezvous','$idMedecin','$conclusion','$ceMoment')");

                                $reponse->closeCursor();
                                                      
                              }
                            catch(Exception $e)
                                {
                                   die('Erreur : '.$e->getMessage());
                                }   


    function insertExam($nomCabinet, $idConsultation, $typeExamen){

      global $host_name;
      global $db_user_name;
      global $db_password;
      global $baseGlobale;
      $database =  crypterNomDeLaBase($nomCabinet);

                try {
                                                        
                                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                                $bdd = new PDO("mysql:host=$host_name;dbname=$database",$db_user_name,$db_password, $pdo_options);

                                $typeExamen  = str_replace("'","\'",$typeExamen);                      
                                
                                // On recupere tout le contenu de la table news
                                $reponse = $bdd->query("INSERT INTO relationexamcons(idConsultation, typeExamen) VALUES ('$idConsultation','$typeExamen')");

                                $reponse->closeCursor();
                                                      
                              }
                            catch(Exception $e)
                                {
                                   die('Erreur : '.$e->getMessage());
                                }  
               } 

  header('location: ../medecin.php');
    
} else {
    echo "Erreur";
}


?>        
                           


