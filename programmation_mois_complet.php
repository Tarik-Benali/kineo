<?php
    include("auth/auth.php");
	include("includes/functions.php");



        $nomCabinet = "KINÉSITHÉRAPEUTE";
        $nomCabinet = trim($nomCabinet);

        global $host_name;
        global $db_user_name;
        global $db_password;

        $database = crypterNomDeLaBase($nomCabinet);

        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options);

        try { 

                $insertSql = "INSERT INTO programme_seances_dates (date_column) VALUES (?)";
                $insertStmt = $bdd->prepare($insertSql);

                if ($insertStmt->execute(["2025-09-01"])) {
                    saveSeances($nomCabinet, 1, 1, "2025-09-30", "2025-09-01", "simple");
                } else {
                    echo "L'insertion automatique du programme a échoué.";
                }
 
        } 
        catch (PDOException $e) {
            die('Erreur : '.$e->getMessage());
        }

?>