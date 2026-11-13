<?php
  include("../../auth/auth.php");
	include("../../includes/functions.php");


if (isset($_REQUEST['depense']) && isset($_REQUEST['nomCabinet']) && $_REQUEST['depense'] !="" && $_REQUEST['nomCabinet'] !=""){

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
    $textDep      = mysqli_real_escape_string($link, $_REQUEST['textDep']);
    $depense      = mysqli_real_escape_string($link, $_REQUEST['depense']);
    $medecin      = mysqli_real_escape_string($link, $_REQUEST['medecin']);

    $day = date('Y-m-d');

        try
            {
                                                    
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO("mysql:host=$host_name;dbname=$nomBD",$db_user_name,$db_password, $pdo_options);                      
                            
                // On recupere tout le contenu de la table news
                $reponse = $bdd->query("INSERT INTO `depenses`(`remarque`, `depense`, `idMedecin`, `dateAjout`) VALUES('$textDep','$depense','$medecin','$day')");
                $reponse->closeCursor();

                header("location:../../depenses.php");
            }
        catch(Exception $e)
            {
               die('Erreur : '.$e->getMessage());
            } 

    // Close connection
    mysqli_close($link);


}else{
  echo "Dépense non Ajouté, informations manquantes !";
}

?>