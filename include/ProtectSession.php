



<?php

if ($_SESSION['type'] != 'admin') {
    echo '<script> alert_info_redirect("vous n avais pas les autorisation ici ","error","/hitechlab/connexion/connexion.php");</script>';
}
?>