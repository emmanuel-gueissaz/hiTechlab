
<?php
include '../../BDD/connexionBdd.php';
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

        <link href="../../lib/css/styleMenu.css" rel="stylesheet" type="text/css"/>


        <link href="../../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../../include/alert.js" type="text/javascript"></script>

        <link href="../../boutique/ajout/ajout.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <!-- debut de la page -->



        <div style="text-align: center;" >
            <form method="POST" class="leMotDePasse" id="leMotDePasse">

                <h4 class="titreAjout" > Déjà Client ?  </h4> 
                <h4 class="labelAjout"> Email : </h4> 
                <input class=" inputMdp form-control" type="text"  name="email" required=""/><br>



                <input type="button" class="btn btn-primary btn-lg inputMdp" onclick="document.location.href = '/hitechlab/connexion/inscription.php?boutique=true'"  value="Inscription"/>
                <input type="submit" name="testerEmail" class="btn btn-outline-primary btn-lg inputMdp" value="Connexion" />

            </form>
        </div>

        <!-- libscript js -->
        <script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../../lib/js/main.js" type="text/javascript"></script>
        <script src="../../lib/js/popper.js" type="text/javascript"></script>





        <!-- fin de la page -->






        <?php
        if (isset($_POST['testerEmail'])) {
            $email = $_POST['email'];
            try {
                $insert = "select email,prenom from only client where email = '$email';";
                $requete = $conn->prepare($insert);
                $requete->execute();
                $ligne = $requete->fetch();
                if ($email == $ligne['email']) {
                    $prenom = $ligne['prenom'];
                     echo "<script> alert_info_redirect('Bienvenue $prenom','success','/hitechlab/partieclient/enBoutique/creerDevisC.php?id=$email');</script>";
                } else {
                    echo "<script> alert_info('Email introuvable','info');</script>";
                }
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur","error");</script>';
            }
        }
        ?>


    </body>
</html>







