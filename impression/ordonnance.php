 <?php
  
  include("../auth/auth.php");
  include("../includes/functions.php");

  global $con;

  global $host_name;
  global $db_user_name;
  global $db_password;
  global $baseGlobale;


  if (isset($_POST['cloture'])) {

              if(isset($_SESSION['idDeCeMedecin'])){
                    
                    $medecin    = $_SESSION['username'];
                    $medecin = str_replace("'","\'",$medecin);

                    $idMedecin  = $_SESSION['idDeCeMedecin'];

                    $nomCabinet = $_SESSION['nomDeCeCabinet'];
                    $nomCabinet = str_replace("'","\'",$nomCabinet);

                    $idCabinet = $_SESSION['idDeCeCabinet'];
                  }
                    

                    $conclusion         = $_REQUEST['conclusion'];
                    $conclusion = str_replace("'","\'",$conclusion);

                    $motifCons  = str_replace("'","\'",$_REQUEST['motifCons']);

                    if ($_REQUEST['identifiantPatient']) {
                      $identifiantPatient = $_REQUEST['identifiantPatient']; 
                    }else{
                      $identifiantPatient ="0000";
                    }
                    

                    $ceMoment = date("Y-m-d H:i:s");
                    
                    //$idConsultation = date("YmdHis");
                    $idConsultation = $_REQUEST['idConsultation'];

                    
                    $database = crypterNomDeLaBase($nomCabinet);

             if (isset($_REQUEST['idRDV'])) {

                        $idRendezvous = $_REQUEST['idRDV'];
                      }else{
                        $idRendezvous = "";
                      }
                            

             if (isset($_REQUEST["exam"])){

              $link = $con;
             
//------------------------------------------------------ insertion exam et conss ----------------------------------------------------------------------

            if($link === false){
                  die("ERROR: Could not connect. " . mysqli_connect_error());
              }
              $number = count($_POST["exam"]);  //je compte combien d'examens je reçois
               if($number > 0)  
               {  
                    for($i=0; $i<$number; $i++)  //Traitement d'examens je reçois
                    {  
                         if(trim($_POST["exam"][$i] != ''))  //Traitement pour chaque itération
                         { 

                          $typeExam = $_POST["exam"][$i];
                          $typeExam = str_replace("'","`'",$typeExam); 

                          if (isset($_POST["rez"][$i])) {      //nzid netriti le résultat s'il est envoyé
                            $resultExam = str_replace("'","`",$_POST["rez"][$i]);
                          }else{
                            $resultExam = "";
                          }

                          insertExam($nomCabinet, $idConsultation, $typeExam, $resultExam);     
                                                
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
                                            
                                            $reponse = $bdd->query("INSERT INTO consultations(idConsultation,idPatient,idRendezvous,idMedecin,conclusion,heureConsultation,motifCons) VALUES ('$idConsultation','$identifiantPatient','$idRendezvous','$idMedecin','$conclusion','$ceMoment','$motifCons')");

                                            $reponse->closeCursor();

                                            historiqueCons($idConsultation,$idCabinet,$ceMoment);
                                                                  
                                          }
                                        catch(Exception $e)
                                            {
                                               die('Erreur : '.$e->getMessage());
                                            }   

             //Enregistrement prix consultation dans table caisse
             if (isset($_REQUEST['somme'])) {

                $prix = $_REQUEST['somme'];
                updateConsPrice($nomCabinet,$idConsultation,$prix,$ceMoment);
             }

             header('location: ../medecin.php');
    }

  elseif (isset($_POST['suspendre'])) {
     
                    if(isset($_SESSION['idDeCeMedecin'])){
                              
                              $medecin    = $_SESSION['username'];
                              $medecin    = str_replace("'","\'",$medecin);

                              $idCabinet = $_SESSION['idDeCeCabinet'];
                              $idMedecin  = $_SESSION['idDeCeMedecin'];                              
                              $nomCabinet = $_SESSION['nomDeCeCabinet'];
                              $nomCabinet = str_replace("'","\'",$nomCabinet);}


                              $conclusion         = $_REQUEST['conclusion'];
                              $conclusion         = str_replace("'","\'",$conclusion); 

                              $motifCons  = str_replace("'","\'",$_REQUEST['motifCons']);

                              if ($_REQUEST['identifiantPatient']) {
                                $identifiantPatient = $_REQUEST['identifiantPatient']; 
                              }else{
                                $identifiantPatient ="0000";
                              } 

                              $ceMoment = date("Y-m-d H:i:s");
                              //$idConsultation = date("YmdHis");
                              $idConsultation = $_REQUEST['idConsultation'];  

                              
                              $database = crypterNomDeLaBase($nomCabinet);
                              

                       if (isset($_REQUEST['idRDV'])) {

                                  $idRendezvous = $_REQUEST['idRDV'];
                                }else{
                                  $idRendezvous = "";
                                }       

                       if (isset($_REQUEST["exam"])){

                        $link = $con;
                       
                           //------------------------------------------------------ insertion exam et conss ---------------------------------------------------------------

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
                                    $typeExam = str_replace("'","`",$typeExam);

                                    if (isset($_POST["rez"][$i])) {      //nzid netriyi le résultat s'il est envoyé
                                      $resultExam = $_POST["rez"][$i];
                                      $resultExam = str_replace("'","`",$resultExam);
                                    }else{
                                      $resultExam = "";
                                    }

                                    insertExam($nomCabinet, $idConsultation, $typeExam, $resultExam);     
                                                          
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
                                                      $reponse = $bdd->query("INSERT INTO consultations(idConsultation,idPatient,idRendezvous,idMedecin,conclusion,heureConsultation,etatCons,motifCons) VALUES ('$idConsultation','$identifiantPatient','$idRendezvous','$idMedecin','$conclusion','$ceMoment','1','$motifCons')"); 

                                                      $reponse->closeCursor();

                                                      historiqueCons($idConsultation,$idCabinet,$ceMoment);
                                                                            
                                                    }
                                                  catch(Exception $e)
                                                      {
                                                         die('Erreur : '.$e->getMessage());
                                                      } 

                      //Enregistrement prix consultation dans table caisse
                      if (isset($_REQUEST['somme'])) {

                          $prix = $_REQUEST['somme'];
                          updateConsPrice($nomCabinet,$idConsultation,$prix,$ceMoment);
                        }                                

                        header('location: ../medecin.php');
  }

  elseif (isset($_POST['cloMedic'])) {
                 
            if(isset($_SESSION['idDeCeMedecin'])){
                    
                    $medecin    = $_SESSION['username'];
                    $medecin    = str_replace("'","\'",$medecin);
                    $idMedecin  = $_SESSION['idDeCeMedecin'];
                    $nomCabinet = $_SESSION['nomDeCeCabinet'];
                    $nomCabinet = str_replace("'","\'",$nomCabinet);
                    $idCabinet = $_SESSION['idDeCeCabinet'];
                  }

                    $conclusion         = $_REQUEST['conclusion'];
                    $conclusion         = str_replace("'","\'",$conclusion);

                    $motifCons  = str_replace("'","\'",$_REQUEST['motifCons']);

                    if ($_REQUEST['identifiantPatient']) {
                        $identifiantPatient = $_REQUEST['identifiantPatient']; 
                    }else{
                      $identifiantPatient ="0000";
                     }  

                    $ceMoment = date("Y-m-d H:i:s");

                    $idConsultation = $_REQUEST['idConsultation'];
                    //$idConsultation = date("YmdHis");
                    $database = crypterNomDeLaBase($nomCabinet);
                    

             if (isset($_REQUEST['idRDV'])) {

                        $idRendezvous = $_REQUEST['idRDV'];
                      }else{
                        $idRendezvous = "";
                      }
                            

             if (isset($_REQUEST["exam"])){

              $link = $con;
             
                 //------------------------------------------------------ insertion exam et conss ----------------------------------------------------------------------

            if($link === false){
                  die("ERROR: Could not connect. " . mysqli_connect_error());
              }
              $number = count($_POST["exam"]);  //je compte combien d'examens je reçois
               if($number > 0)  
               {  
                    for($i=0; $i<$number; $i++)  //Traitement d'examens je reçois
                    {  
                         if(trim($_POST["exam"][$i] != ''))  //Traitement pour chaque itération
                         { 

                          $typeExam = $_POST["exam"][$i]; 
                          $typeExam = str_replace("'","`",$typeExam);

                          if (isset($_POST["rez"][$i])) {      //nzid netriti le résultat s'il est envoyé
                            $resultExam = $_POST["rez"][$i];
                            $resultExam = str_replace("'","`",$resultExam);
                          }else{
                            $resultExam = "";
                          }

                          insertExam($nomCabinet, $idConsultation, $typeExam, $resultExam);     
                                                
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
                                            
                                            $reponse = $bdd->query("INSERT INTO consultations(idConsultation,idPatient,idRendezvous,idMedecin,conclusion,heureConsultation,motifCons) VALUES ('$idConsultation','$identifiantPatient','$idRendezvous','$idMedecin','$conclusion','$ceMoment','$motifCons')");

                                            $reponse->closeCursor();

                                            historiqueCons($idConsultation,$idCabinet,$ceMoment);
                                                                  
                                          }
                                        catch(Exception $e)
                                            {
                                               die('Erreur : '.$e->getMessage());
                                            }   

             //Enregistrement prix consultation dans table caisse
             if (isset($_REQUEST['somme'])) {

                $prix = $_REQUEST['somme'];
                updateConsPrice($nomCabinet,$idConsultation,$prix,$ceMoment);
             }
                                            
             header("location: ../ordonnanceMedicaments.php?idConst=".$idConsultation."&idPatient=".$identifiantPatient."");
  }

  elseif (isset($_POST['cloOrien'])) {
            
            if(isset($_SESSION['idDeCeMedecin'])){
                    
                    $medecin    = $_SESSION['username'];
                    $medecin = str_replace("'","\'",$medecin);

                    $idMedecin  = $_SESSION['idDeCeMedecin'];
                    $nomCabinet = $_SESSION['nomDeCeCabinet'];
                    $nomCabinet = str_replace("'","\'",$nomCabinet);
                    $idCabinet = $_SESSION['idDeCeCabinet'];}

                    $conclusion         = $_REQUEST['conclusion'];
                    $conclusion         = str_replace("'","\'",$conclusion);

                    $motifCons  = str_replace("'","\'",$_REQUEST['motifCons']);

                    if ($_REQUEST['identifiantPatient']) {
                         $identifiantPatient = $_REQUEST['identifiantPatient']; 
                     }else{
                        $identifiantPatient ="0000";
                    }  

                    $ceMoment = date("Y-m-d H:i:s");
                    $idConsultation = $_REQUEST['idConsultation'];
                    //$idConsultation = date("YmdHis");
                    $database = crypterNomDeLaBase($nomCabinet);


             if (isset($_REQUEST['idRDV'])) {

                        $idRendezvous = $_REQUEST['idRDV'];
                      }else{
                        $idRendezvous = "";
                      }
                            

             if (isset($_REQUEST["exam"])){

              $link = $con;
             
                 //------------------------------------------------------ insertion exam et conss ----------------------------------------------------------------------

            if($link === false){
                  die("ERROR: Could not connect. " . mysqli_connect_error());
              }
              $number = count($_POST["exam"]);  //je compte combien d'examens je reçois
               if($number > 0)  
               {  
                    for($i=0; $i<$number; $i++)  //Traitement d'examens je reçois
                    {  
                         if(trim($_POST["exam"][$i] != ''))  //Traitement pour chaque itération
                         { 

                          $typeExam = $_POST["exam"][$i];
                          $typeExam = str_replace("'","`",$typeExam); 

                          if (isset($_POST["rez"][$i])) {      //nzid netriti le résultat s'il est envoyé
                            $resultExam = $_POST["rez"][$i];
                            $resultExam = str_replace("'","`",$resultExam);
                          }else{
                            $resultExam = "";
                          }

                          insertExam($nomCabinet, $idConsultation, $typeExam, $resultExam);     
                                                
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
                                            
                                            $reponse = $bdd->query("INSERT INTO consultations(idConsultation,idPatient,idRendezvous,idMedecin,conclusion,heureConsultation,motifCons) VALUES ('$idConsultation','$identifiantPatient','$idRendezvous','$idMedecin','$conclusion','$ceMoment','$motifCons')");

                                            $reponse->closeCursor();

                                            historiqueCons($idConsultation,$idCabinet,$ceMoment);
                                                                  
                                          }
                                        catch(Exception $e)
                                            {
                                               die('Erreur : '.$e->getMessage());
                                            }   

              //Enregistrement prix consultation dans table caisse
             if (isset($_REQUEST['somme'])) {

                $prix = $_REQUEST['somme'];
                updateConsPrice($nomCabinet,$idConsultation,$prix,$ceMoment);
             }

             header("location: ../ordonnanceOrientation.php?idConst=".$idConsultation."&idPatient=".$identifiantPatient."");
  
  }
  elseif (isset($_POST['cloVide'])) {
  
            if(isset($_SESSION['idDeCeMedecin'])){
                    
                    $medecin    = $_SESSION['username'];
                    $medecin = str_replace("'","\'",$medecin);
                    $idMedecin  = $_SESSION['idDeCeMedecin'];
                    $nomCabinet = $_SESSION['nomDeCeCabinet'];
                    $nomCabinet = str_replace("'","\'",$nomCabinet);
                    $idCabinet = $_SESSION['idDeCeCabinet'];
                  }

                    $conclusion         = $_REQUEST['conclusion'];
                    $conclusion         = str_replace("'","\'",$conclusion);

                    $motifCons  = str_replace("'","\'",$_REQUEST['motifCons']);
                    
                    if ($_REQUEST['identifiantPatient']) {
                       $identifiantPatient = $_REQUEST['identifiantPatient']; 
                     }else{
                       $identifiantPatient ="0000";
                     }  

                    $ceMoment = date("Y-m-d H:i:s");
                    $idConsultation = $_REQUEST['idConsultation'];
                    //$idConsultation = date("YmdHis");
                    $database = crypterNomDeLaBase($nomCabinet);


             if (isset($_REQUEST['idRDV'])) {

                        $idRendezvous = $_REQUEST['idRDV'];
                      }else{
                        $idRendezvous = "";
                      }
                            

             if (isset($_REQUEST["exam"])){

              $link = $con;
             
                 //------------------------------------------------------ insertion exam et conss ----------------------------------------------------------------------

            if($link === false){
                  die("ERROR: Could not connect. " . mysqli_connect_error());
              }
              $number = count($_POST["exam"]);  //je compte combien d'examens je reçois
               if($number > 0)  
               {  
                    for($i=0; $i<$number; $i++)  //Traitement d'examens je reçois
                    {  
                         if(trim($_POST["exam"][$i] != ''))  //Traitement pour chaque itération
                         { 

                          $typeExam = $_POST["exam"][$i];
                          $typeExam = str_replace("'","`",$typeExam); 

                          if (isset($_POST["rez"][$i])) {      //nzid netriti le résultat s'il est envoyé
                            $resultExam = $_POST["rez"][$i];
                            $resultExam = str_replace("'","`",$resultExam);
                          }else{
                            $resultExam = "";
                          }

                          insertExam($nomCabinet, $idConsultation, $typeExam, $resultExam);     
                                                
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
                                            
                                            $reponse = $bdd->query("INSERT INTO consultations(idConsultation,idPatient,idRendezvous,idMedecin,conclusion,heureConsultation,motifCons) VALUES ('$idConsultation','$identifiantPatient','$idRendezvous','$idMedecin','$conclusion','$ceMoment','$motifCons')");

                                            $reponse->closeCursor();

                                            historiqueCons($idConsultation,$idCabinet,$ceMoment);
                                                                  
                                          }
                                        catch(Exception $e)
                                            {
                                               die('Erreur : '.$e->getMessage());
                                            }   

             //Enregistrement prix consultation dans table caisse
             if (isset($_REQUEST['somme'])) {

                $prix = $_REQUEST['somme'];
                updateConsPrice($nomCabinet,$idConsultation,$prix,$ceMoment);
             }
                                            
             header("location: ../ordonnanceVide.php?idConst=".$idConsultation."&idPatient=".$identifiantPatient."");
  }

  elseif (isset($_POST['suspMedic'])) {
                 
            if(isset($_SESSION['idDeCeMedecin'])){
                    
                    $medecin    = $_SESSION['username'];
                    $medecin    = str_replace("'","\'",$medecin);
                    $idMedecin  = $_SESSION['idDeCeMedecin'];
                    $nomCabinet = $_SESSION['nomDeCeCabinet'];
                    $nomCabinet = str_replace("'","\'",$nomCabinet);
                    $idCabinet = $_SESSION['idDeCeCabinet'];
                  }

                    $conclusion         = $_REQUEST['conclusion'];
                    $conclusion         = str_replace("'","\'",$conclusion);

                    $motifCons  = str_replace("'","\'",$_REQUEST['motifCons']);

                    if ($_REQUEST['identifiantPatient']) {
                        $identifiantPatient = $_REQUEST['identifiantPatient']; 
                    }else{
                      $identifiantPatient ="0000";
                     }  

                    $ceMoment = date("Y-m-d H:i:s");

                    $idConsultation = $_REQUEST['idConsultation'];
                    //$idConsultation = date("YmdHis");
                    $database = crypterNomDeLaBase($nomCabinet);


             if (isset($_REQUEST['idRDV'])) {

                        $idRendezvous = $_REQUEST['idRDV'];
                      }else{
                        $idRendezvous = "";
                      }
                            

             if (isset($_REQUEST["exam"])){

              $link = $con;
             
                 //------------------------------------------------------ insertion exam et conss ----------------------------------------------------------------------

            if($link === false){
                  die("ERROR: Could not connect. " . mysqli_connect_error());
              }
              $number = count($_POST["exam"]);  //je compte combien d'examens je reçois
               if($number > 0)  
               {  
                    for($i=0; $i<$number; $i++)  //Traitement d'examens je reçois
                    {  
                         if(trim($_POST["exam"][$i] != ''))  //Traitement pour chaque itération
                         { 

                          $typeExam = $_POST["exam"][$i]; 
                          $typeExam = str_replace("'","`",$typeExam);

                          if (isset($_POST["rez"][$i])) {      //nzid netriti le résultat s'il est envoyé
                            $resultExam = $_POST["rez"][$i];
                            $resultExam = str_replace("'","`",$resultExam);
                          }else{
                            $resultExam = "";
                          }

                          insertExam($nomCabinet, $idConsultation, $typeExam, $resultExam);     
                                                
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
                                            
                                            $reponse = $bdd->query("INSERT INTO consultations(idConsultation,idPatient,idRendezvous,idMedecin,conclusion,heureConsultation,etatCons,motifCons) VALUES ('$idConsultation','$identifiantPatient','$idRendezvous','$idMedecin','$conclusion','$ceMoment','1','$motifCons')");

                                            $reponse->closeCursor();

                                            historiqueCons($idConsultation,$idCabinet,$ceMoment);
                                                                  
                                          }
                                        catch(Exception $e)
                                            {
                                               die('Erreur : '.$e->getMessage());
                                            }   

             //Enregistrement prix consultation dans table caisse
             if (isset($_REQUEST['somme'])) {

                $prix = $_REQUEST['somme'];
                updateConsPrice($nomCabinet,$idConsultation,$prix,$ceMoment);
             }

             header("location: ../ordonnanceMedicaments.php?idConst=".$idConsultation."&idPatient=".$identifiantPatient."");
  }

  elseif (isset($_POST['suspOrien'])) {
            
            if(isset($_SESSION['idDeCeMedecin'])){
                    
                    $medecin    = $_SESSION['username'];
                    $medecin = str_replace("'","\'",$medecin);

                    $idMedecin  = $_SESSION['idDeCeMedecin'];
                    $nomCabinet = $_SESSION['nomDeCeCabinet'];
                    $nomCabinet = str_replace("'","\'",$nomCabinet);
                    $idCabinet = $_SESSION['idDeCeCabinet'];}

                    $conclusion         = $_REQUEST['conclusion'];
                    $conclusion         = str_replace("'","\'",$conclusion);

                    $motifCons  = str_replace("'","\'",$_REQUEST['motifCons']);

                    if ($_REQUEST['identifiantPatient']) {
                         $identifiantPatient = $_REQUEST['identifiantPatient']; 
                     }else{
                        $identifiantPatient ="0000";
                    }  

                    $ceMoment = date("Y-m-d H:i:s");
                    $idConsultation = $_REQUEST['idConsultation'];
                    //$idConsultation = date("YmdHis");                  
                    $database = crypterNomDeLaBase($nomCabinet);


             if (isset($_REQUEST['idRDV'])) {

                        $idRendezvous = $_REQUEST['idRDV'];
                      }else{
                        $idRendezvous = "";
                      }
                            

             if (isset($_REQUEST["exam"])){

              $link = $con;
             
                 //------------------------------------------------------ insertion exam et conss ----------------------------------------------------------------------

            if($link === false){
                  die("ERROR: Could not connect. " . mysqli_connect_error());
              }
              $number = count($_POST["exam"]);  //je compte combien d'examens je reçois
               if($number > 0)  
               {  
                    for($i=0; $i<$number; $i++)  //Traitement d'examens je reçois
                    {  
                         if(trim($_POST["exam"][$i] != ''))  //Traitement pour chaque itération
                         { 

                          $typeExam = $_POST["exam"][$i];
                          $typeExam = str_replace("'","`",$typeExam); 

                          if (isset($_POST["rez"][$i])) {      //nzid netriti le résultat s'il est envoyé
                            $resultExam = $_POST["rez"][$i];
                            $resultExam = str_replace("'","`",$resultExam);
                          }else{
                            $resultExam = "";
                          }

                          insertExam($nomCabinet, $idConsultation, $typeExam, $resultExam);     
                                                
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
                                            
                                            $reponse = $bdd->query("INSERT INTO consultations(idConsultation,idPatient,idRendezvous,idMedecin,conclusion,heureConsultation,etatCons,motifCons) VALUES ('$idConsultation','$identifiantPatient','$idRendezvous','$idMedecin','$conclusion','$ceMoment','1','$motifCons')");

                                            $reponse->closeCursor();

                                            historiqueCons($idConsultation,$idCabinet,$ceMoment);
                                                                  
                                          }
                                        catch(Exception $e)
                                            {
                                               die('Erreur : '.$e->getMessage());
                                            }   

             //Enregistrement prix consultation dans table caisse
             if (isset($_REQUEST['somme'])) {

                $prix = $_REQUEST['somme'];
                updateConsPrice($nomCabinet,$idConsultation,$prix,$ceMoment);
             }

             header("location: ../ordonnanceOrientation.php?idConst=".$idConsultation."&idPatient=".$identifiantPatient."");
  
  }
  elseif (isset($_POST['suspVide'])) {
  
            if(isset($_SESSION['idDeCeMedecin'])){
                    
                    $medecin    = $_SESSION['username'];
                    $medecin = str_replace("'","\'",$medecin);
                    $idMedecin  = $_SESSION['idDeCeMedecin'];
                    $nomCabinet = $_SESSION['nomDeCeCabinet'];
                    $nomCabinet = str_replace("'","\'",$nomCabinet);
                    $idCabinet = $_SESSION['idDeCeCabinet'];
                  }

                    $conclusion         = $_REQUEST['conclusion'];
                    $conclusion         = str_replace("'","\'",$conclusion);

                    $motifCons  = str_replace("'","\'",$_REQUEST['motifCons']);
                    
                    if ($_REQUEST['identifiantPatient']) {
                       $identifiantPatient = $_REQUEST['identifiantPatient']; 
                     }else{
                       $identifiantPatient ="0000";
                     }  

                    $ceMoment = date("Y-m-d H:i:s");
                    $idConsultation = $_REQUEST['idConsultation'];
                    //$idConsultation = date("YmdHis");            
                    $database = crypterNomDeLaBase($nomCabinet);


             if (isset($_REQUEST['idRDV'])) {

                        $idRendezvous = $_REQUEST['idRDV'];
                      }else{
                        $idRendezvous = "";
                      }
                            

             if (isset($_REQUEST["exam"])){

              $link = $con;
             
                 //------------------------------------------------------ insertion exam et conss ----------------------------------------------------------------------

            if($link === false){
                  die("ERROR: Could not connect. " . mysqli_connect_error());
              }
              $number = count($_POST["exam"]);  //je compte combien d'examens je reçois
               if($number > 0)  
               {  
                    for($i=0; $i<$number; $i++)  //Traitement d'examens je reçois
                    {  
                         if(trim($_POST["exam"][$i] != ''))  //Traitement pour chaque itération
                         { 

                          $typeExam = $_POST["exam"][$i];
                          $typeExam = str_replace("'","`",$typeExam); 

                          if (isset($_POST["rez"][$i])) {      //nzid netriti le résultat s'il est envoyé
                            $resultExam = $_POST["rez"][$i];
                            $resultExam = str_replace("'","`",$resultExam);
                          }else{
                            $resultExam = "";
                          }

                          insertExam($nomCabinet, $idConsultation, $typeExam, $resultExam);     
                                                
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
                                            
                                            $reponse = $bdd->query("INSERT INTO consultations(idConsultation,idPatient,idRendezvous,idMedecin,conclusion,heureConsultation,etatCons,motifCons) VALUES ('$idConsultation','$identifiantPatient','$idRendezvous','$idMedecin','$conclusion','$ceMoment','1','$motifCons')");

                                            $reponse->closeCursor();

                                            historiqueCons($idConsultation,$idCabinet,$ceMoment);
                                                                  
                                          }
                                        catch(Exception $e)
                                            {
                                               die('Erreur : '.$e->getMessage());
                                            }   

             //Enregistrement prix consultation dans table caisse
             if (isset($_REQUEST['somme'])) {

                $prix = $_REQUEST['somme'];
                updateConsPrice($nomCabinet,$idConsultation,$prix,$ceMoment);
             }
             
             header("location: ../ordonnanceVide.php?idConst=".$idConsultation."&idPatient=".$identifiantPatient."");
  }
  else
  {
      echo "Erreur, <a href=\"../rapportTechnique.php\"> contacter l'équipe technique</a>";
  }
  
    



?>  