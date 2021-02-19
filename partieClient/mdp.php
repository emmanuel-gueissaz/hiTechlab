
<?php
include '../BDD/connexionBdd.php';
?>
<!doctype html>


<html lang="fr">
    <head>
        <title>HI-TECH LAB</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">	
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="../lib/css/styleMenu.css" rel="stylesheet" type="text/css"/>


        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <link href="../client/modifierMdp.css" rel="stylesheet" type="text/css"/>
        <script src="../include/alert.js" type="text/javascript"></script>

        <script>

            function barre() {
                var min = 0;
                var maj = 0;
                var chiffre = 0;
                var temp = 0;
                var mdp = document.getElementById('mdp').value;
                if (mdp.match(/[0-9]/g) != null) {
                    chiffre = parseInt(10);
                }
                if (mdp.match(/[A-Z]/g) != null) {
                    maj = parseInt(10);
                }
                if (mdp.match(/[a-z]/g) != null) {
                    min = parseInt(10);
                }
                temp = min + maj + chiffre;
                if (mdp.length > 8) {
                    temp += 70;
                } else {
                    temp += parseInt(mdp.length * 10);
                }
                if (temp < 40) {
                    document.getElementById('labarreProgress').style.backgroundColor = 'red';
                }
                if (temp < 70 && temp > 40) {
                    document.getElementById('labarreProgress').style.backgroundColor = 'orange';
                }
                if (temp > 70) {
                    document.getElementById('labarreProgress').style.backgroundColor = 'green';
                }
                document.getElementById('labarreProgress').style.width = temp + '%';
            }

        </script>

    </head>
    <body >





        <?php include '../include/MenuTopClient.php'; ?>

        <!-- debut de la page -->

        <div style="text-align: center;">
            <form method="POST" class="leMotDePasse" id="leMotDePasse" style="margin-top: 6%;">
                <h4 class="labelMdp" >mot de passe : </h4> <input class="inputMdp form-control" type="password"  name="mdp" id="mdp"required="" oninput="barre();"/><br>


                <div class="progress labarre" style="">
                    <div class="progress-bar" id="labarreProgress"></div>
                </div>

                <h4 class="labelMdp" >confirmer mot de passe : </h4> <input class=" inputMdp form-control" type="password"  name="mdpVerif" required=""/><br>

                <div class="alert alert-danger" role="alert" id="alertmdp" style="display: none;">

                    Le mot de passe doit contenir 1 Majuscule, 1 minuscule, 1 chiffre et doit faire 7 caractères !

                </div>
                <input type="submit" name="creerMdp" class="btn btn-outline-primary btn-lg inputMdp" value="Créer"/>

            </form>

        </div>

        <!-- libscript js -->
        <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../lib/js/main.js" type="text/javascript"></script>
        <script src="../lib/js/popper.js" type="text/javascript"></script>




    </body>
</html>

<!-- fin de la page -->

<?php
//$emailMdp = trim($_GET['id']);
//    $emailMdp = openssl_decrypt($emailMdp, "AES-128-ECB", 'LeMDP25123ab');
//    echo $emailMdp;
if (isset($_POST['creerMdp'])) {
    $emailMdp = trim($_GET['id']);
    $emailMdp = openssl_decrypt($emailMdp, "AES-128-ECB", 'LeMDP25123ab');
    $mdp = $_POST['mdp'];
    $mdpVerif = $_POST['mdpVerif'];
    if ($mdpVerif != $mdp) {
        echo '<script> alert_info("mot de passe différent","error");</script>';
    } else {
        $majuscule = preg_match('@[A-Z]@', $mdp);
        $minuscule = preg_match('@[a-z]@', $mdp);
        $chiffre = preg_match('@[0-9]@', $mdp);
        if (!$majuscule || !$minuscule || !$chiffre || strlen($mdp) < 8) {
            echo "<script> document.getElementById('alertmdp').style.display = 'inline-block';</script>";
            echo "<script> document.getElementById('lalert').style.opacity = '1';</script>";
        } else {
            $mdp = openssl_encrypt($mdp, "AES-128-ECB", '1234');
            try {
                $update = "update only client
                    set mdp = '$mdp'
                    where email = '$emailMdp';";
                $update = $conn->prepare($update);
                $update->execute();
                echo '<script> alert_info_redirect("mot de passe créer","success","/hitechlab/connexion/connexion.php"); </script>';
            } catch (Exception $ex) {
                echo '<script> alert_info("error,"error");</script>';
            }
        }
    }
}
?>



<?php
//include '../../include/protectionSessionMembre.php';
?>









