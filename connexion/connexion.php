<?php
include '../BDD/connexionBdd.php';
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
    <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>
    <link href="connexion.css" rel="stylesheet" type="text/css"/>
    <script src="../include/alert.js" type="text/javascript"></script>




</head>
<body>
    <div class="contentConnexion">

        <div class="imageCnx">

            <img src="../image/logo.png" width="90%;">
        </div>

        <div class="connexion" >
            <nav>
                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active menuConnexion" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" >Client</a>

                    <a class="nav-item nav-link menuConnexion" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Technicien</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <h3 style="margin-top: 10%;"> Login </h3>
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <form method="POST" class="formulaires">


                        <input type="text" class="inputConnexion form-control" name="utiPart" required="" /><br>
                        <input type="password" class="inputConnexion form-control" name="mdpPart" required=""  /><br>
                        <input type="submit" class="btn btn-outline-primary btn-lg" name="validePart" value="connexion"/>

                    </form>

                </div>

                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">

                    <form method="POST" class="formulaires">

                        <input type="text" class="inputConnexion form-control" name="utiTech" required="" /><br>
                        <input type="password" class="inputConnexion form-control" name="mdpTech" required="" /><br>
                        <input type="submit" class="btn btn-outline-primary btn-lg" name="valideTech" value="connexion"/>

                    </form>

                </div>
            </div>
        </div>
    </div>
</body>
<?php
//connexion de particulier
if (isset($_POST['validePart'])) {
    $uti = $_POST['utiPart'];
    $mdp = $_POST['mdpPart'];
    if ($uti != '') {

        try {
            $requete = "select email,mdp,nom from only client where email = '$uti' ";
            $requete = $conn->prepare($requete);
            $requete->execute();
            $ligne = $requete->fetch();
            if ($uti == $ligne['email']) {
                $decrypted_string = openssl_decrypt($ligne['mdp'], "AES-128-ECB", '1234');
                if ($mdp == $decrypted_string) {
                    echo '<script> alert_info_redirect("Bienvenue M. ' . $ligne['nom'] . '","success", "/hitechlab/accueil/accueil.php");</script>';

                    $_SESSION['nom'] = $ligne['nom'];
                    $_SESSION['type'] = 'membre';
                    $_SESSION['email'] = $ligne['email'];
                } else {
                    echo '<script> alert_info("Mauvais login","error");</script>';
                }
            } else {
                echo '<script> alert_info("Mauvais login","error");</script>';
            }
        } catch (Exception $ex) {
            echo '<script> alert_info("bug","error");</script>';
        }
    }
}



//connexion technicien


if (isset($_POST['valideTech'])) {
    $uti = $_POST['utiTech'];
    $mdp = $_POST['mdpTech'];

    if ($uti != '') {
        try {
            $requete = "select email,mdp,nom, type_tech from only technicien where email = '$uti';";
            $requete = $conn->prepare($requete);
            $requete->execute();
            $ligne = $requete->fetch();
            if ($uti == $ligne['email']) {
                $decrypted_string = openssl_decrypt($ligne['mdp'], "AES-128-ECB", '1234');
                if ($mdp == $decrypted_string) {
                    $_SESSION['nom'] = $ligne['nom'];
                    $_SESSION['email'] = $ligne['email'];
                    $_SESSION['type_tech'] = $ligne['type_tech'];
                    if ($ligne['type_tech'] == 2) {
                        $_SESSION['type'] = 'membre';
                        echo '<script> alert_info_redirect("Bienvenue M. ' . $ligne['nom'] . '","success","/hitechlab/profil/profilinfo.php?page=1");</script>';
                    } else {
                        $_SESSION['type'] = 'admin';
                        echo '<script> alert_info_redirect("Bienvenue M. ' . $ligne['nom'] . '","success","/hitechlab//tableauDeBord/tableauDeBord.php");</script>';
                    }
                } else {
                    echo '<script> alert_info("Mauvais login","error");</script>';
                }
            } else {
                echo '<script> alert_info("Mauvais login","error");</script>';
            }
        } catch (Exception $ex) {
            echo '<script> alert_info("bug","error");</script>';
        }
    }
}
?>


