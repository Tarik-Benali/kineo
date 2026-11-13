<?php
  include("auth/auth.php");
	include("includes/functions.php");


if (isset($_SESSION['typeCompte']) && isset($_REQUEST['nomCabinet']) && $_SESSION['typeCompte'] !="" && $_REQUEST['nomCabinet'] !=""){

    $nomCabinet = $_REQUEST['nomCabinet'];
       
    $idSeance    = $_REQUEST['idSeance'];


    global $host_name;
    global $db_user_name;
    global $db_password;

    $nomB       = crypterNomDeLaBase($nomCabinet);
              try
                {
                                        
                  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                  $bdd = new PDO("mysql:host=$host_name;dbname=$nomB",$db_user_name,$db_password, $pdo_options);                      
                  
                  // On recupere tout le contenu de la table news
                  $reponse = $bdd->query("SELECT idPatient FROM seance,rdv,rel_seance_rdv WHERE seance.id_seance ='$idSeance' AND seance.id_seance=rel_seance_rdv.id_seance AND rel_seance_rdv.id=rdv.id");
                  
                  $nbr = $reponse->rowCount();
                  $idPatient = "";

                  if ($nbr > 0) {
                    while ($donnees = $reponse->fetch())
                              {
                                $idPatient = $donnees['idPatient'];
                                getIdPatientFromSeance($nomCabinet,$idPatient);
                              }
                  }


                 $reponse->closeCursor();
              }

            catch(Exception $e)
                {
                   die('Erreur : '.$e->getMessage());
                }
}else{
  echo "Rendez-vous non Ajouté, informations manquantes !";
}

?>