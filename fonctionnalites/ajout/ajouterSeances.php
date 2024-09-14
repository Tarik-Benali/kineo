<?php
  include("../../auth/auth.php");
	include("../../includes/functions.php");


if (isset($_SESSION['typeCompte']) && isset($_REQUEST['nomCabinet']) && $_SESSION['typeCompte'] !="" && $_REQUEST['nomCabinet'] !=""){


      $nomCabinet = $_REQUEST['nomCabinet'];
         
         $nomBD  = crypterNomDeLaBase($nomCabinet);

         global $host_name;
         global $baseGlobale;
         global $db_user_name;
         global $db_password;

         $dureeSeance = dureeParSeance($nomCabinet);

         if ($dureeSeance=="") {
             $dureeSeance = 15;
         }

      $link = mysqli_connect($host_name, $db_user_name, $db_password, $nomBD);
       
      // Check connection
      if($link === false){
          die("ERROR: Could not connect. " . mysqli_connect_error());
      }
       
      // Escape user inputs for security

      $idCab        = mysqli_real_escape_string($link, $_REQUEST['idCab']);
      $medecin 	    = mysqli_real_escape_string($link, $_REQUEST['medecin']);
      $dateFinProg  = mysqli_real_escape_string($link, $_REQUEST['dateFinProg']);
      $dateDebProg  = mysqli_real_escape_string($link, $_REQUEST['dateDebProg']);
      $typeSeance   = mysqli_real_escape_string($link, $_REQUEST['typeSeance']);

      $jourOuvrables = getNameOuvrableDays($nomCabinet);


      $dateDebProgD = date_create($dateDebProg);
      $dateFinProgD = date_create($dateFinProg);
      $diff        = date_diff($dateDebProgD,$dateFinProgD);
      $nbrJours    = $diff->format("%a");

      $nbrJours    = $nbrJours + 1;

      $tempsEntreLesSeances   = gerDureeEntreRDV($nomCabinet);

      $donneCabinet       = gerOuvertureFermeture($nomCabinet);

      $donneCabinet       = substr($donneCabinet, 0, -1);
      $donneCabinet       = substr($donneCabinet, 1);

      $str                = explode(",",$donneCabinet);

      list($ouvertureCabinet, $fermetureCabinet, $nombrePatParSean) = explode(',', $donneCabinet);

      $ouvertureCabinet = strtotime($ouvertureCabinet);
      $fermetureCabinet = strtotime($fermetureCabinet);

      $dateSelectinee = $dateDebProg;

      $joursOuvert  = explode(",",$jourOuvrables);
        

      for ($i=0; $i < $nbrJours; $i++) { 

          $heureSeance = $ouvertureCabinet;

          setlocale(LC_TIME, "fr_FR");

          $dateTimeselected = strtotime($dateSelectinee);
          $jourSelectinee   = date('Y-m-d',$dateTimeselected);

          
          $jourSelectinee   = date('Y-m-d',strtotime($jourSelectinee . "+". $i ." days"));

          $timestamp = strtotime($jourSelectinee);

          $day = date('D', $timestamp);

          $nomduJour = "-";


          switch ($day) {
            case 'Wed':
                $nomduJour = "mercredi";
              break;
            case 'Thu':
                $nomduJour = "jeudi";
              break;
            case 'Fri':
                $nomduJour = "vendredi";
              break;
            case 'Sat':
                $nomduJour = "samedi";
              break;
            case 'Sun':
                $nomduJour = "dimanche";
              break;
            case 'Mon':
                $nomduJour = "lundi";
              break;
            case 'Tue':
                $nomduJour = "mardi";
              break;
          }


          if (in_array($nomduJour, $joursOuvert))
            {
              //echo "<b>Jour: " . $nomduJour ." date: ". $jourSelectinee . "</b>";

              while ($heureSeance < $fermetureCabinet) {

                  //echo "<br>  -Heure Début Séance:  " .  date('H:i:s', $heureSeance);

                  $heureDF = date('H:i:s', $heureSeance);
                  insertSeances($nomBD,$typeSeance,$nomduJour,$jourSelectinee,$heureDF);

                  

                  $heureSeance = strtotime("+".$dureeSeance." minutes", $heureSeance);
                  //echo "<br>  -Heure Fin Séance et début pause:  " .  date('H:i:s', $heureSeance);      
                  //$heureSeance = date('H:i:s', $heureSeance);
                  $heureSeance = strtotime("+".$tempsEntreLesSeances." minutes", $heureSeance);
                  //echo "<br>  -Heure Fin Pause:  " .  date('H:i:s', $heureSeance);
                  //echo "<br><hr><br>";
              }
            }   
      }
      header("location:../../programmationSeances.php");

}else{
  echo "Rendez-vous non Ajouté, informations manquantes !";
}

?>