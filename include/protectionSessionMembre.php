
<?php

$t = "'";
if ($_SESSION['type'] != 'membre') {

    echo '<script> alert_info_redirect("Accès refusé ","error","/hitechlab/connexion/connexion.php");</script>';
}
?>