<?php

    if (isset($_SESSION['identifiant'])){

                $identifiant  = $_SESSION["identifiant"];                                               

                getTheme($identifiant);

                $theme  = $_SESSION['theme'];

            }
    else{
            $_SESSION['theme']  = "bgtest8";

            $theme              = $_SESSION['theme'];
        }
?>

<body style="overflow: visible; background-image: url('assets/img/themes/<?php echo $theme; ?>.jpg');">