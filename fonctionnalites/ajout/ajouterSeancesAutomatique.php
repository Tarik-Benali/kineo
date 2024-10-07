<?php
    include("../../auth/auth.php");
	include("../../includes/functions.php");


    if (isset($_SESSION['typeCompte']) && isset($_REQUEST['nomCabinet']) && $_SESSION['typeCompte'] !="" && $_REQUEST['nomCabinet'] !=""){


        $nomCabinet = trim($nomCabinet);

        global $host_name;
        global $db_user_name;
        global $db_password;

        $database = crypterNomDeLaBase($nomCabinet);

        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO("mysql:host=$host_name;dbname=$database", $db_user_name, $db_password, $pdo_options);

        try { 
            $currentMonth = date('m');
            $currentYear = date('Y');

            $nextYear = $currentYear + 1;
            $nextMonthDate = "$nextYear-$currentMonth-01";

            $date = new DateTime($nextMonthDate);
            $date->modify('last day of this month');
            $endNextMonthDate = $date->format('Y-m-d');

            $sql = "SELECT COUNT(*) FROM programme_seances_dates WHERE MONTH(date_column) = ? AND YEAR(date_column) = ?";
            $stmt = $bdd->prepare($sql);
            $stmt->execute([$currentMonth, $nextYear]);
            $exists = $stmt->fetchColumn();

            if ($exists == 0) {
                $insertSql = "INSERT INTO programme_seances_dates (date_column) VALUES (?)";
                $insertStmt = $bdd->prepare($insertSql);

                if ($insertStmt->execute([$nextMonthDate])) {
                    saveSeances($nomCabinet, 1, 1, $endNextMonthDate, $nextMonthDate, "simple");
                } else {
                    echo "L'insertion automatique du programme a échoué.";
                }
            }
        } 
        catch (PDOException $e) {
            die('Erreur : '.$e->getMessage());
        }

    }else{
      echo "Rendez-vous non Ajouté, informations manquantes !";
    }

?>