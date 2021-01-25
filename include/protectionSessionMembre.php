
<?php

if ($_SESSION['type'] == 'admin' or $_SESSION['type'] == 'membre' ) {
    
}
else{
    echo '<script> alert_info_redirect("vous n avais pas les autorisation ici ","error","/hitechlab/connexion/connexion.php");</script>';
}
?>