<?php
include '../BDD/connexionBdd.php';
?>
<head>
    <link href="../lib/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="../include/alert.js" type="text/javascript"></script>
    <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
    <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>

     <link href="modifierMdp.css" rel="stylesheet" type="text/css"/>
</head>


<div style="text-align: center;">
    <form method="POST" class="leMotDePasse" id="leMotDePasse">
        <h4 class="labelMdp" >mot de passe : </h4> <input class="inputMdp form-control" type="password"  name="mdp" required=""/><br>
        <h4 class="labelMdp" >répéter mot de passe : </h4> <input class=" inputMdp form-control" type="password"  name="mdpVerif" required=""/><br>
       
                <input type="button" name="modifMdp" class="btn btn-outline-danger btn-lg inputMdp" value="annuler" onclick="history.back()"/>
        <input type="submit" name="modifMdp" class="btn btn-outline-primary btn-lg inputMdp" value="modifier"/>

    </form>
</div>


<?php
if (isset($_POST['modifMdp'])) {
    $mdp = $_POST['mdp'];
    $mdpVerif = $_POST['mdpVerif'];
    if ($mdpVerif != $mdp) {
        echo '<script> alert_info("mot de passe différent","error");</script>';
    } else {
        $mdp = openssl_encrypt($mdp, "AES-128-ECB", '1234');
        try {
            $update = "update only client
                    set mdp = '$mdp'
                    where email = '" . trim($_GET['id']) . "';";
            $update = $conn->prepare($update);
            $update->execute();
            echo '<script> alert_info_redirect("mdp modifié","success","/hitechlab/client/leclient.php?id='. trim($_GET['id']) .'");</script>';
        } catch (Exception $ex) {
            echo '<script> alert_info("error,"error");</script>';
        }
    }
}
?>

     <!--protection de session -->
            <?php 
            include '../include/ProtectSession.php';
?>