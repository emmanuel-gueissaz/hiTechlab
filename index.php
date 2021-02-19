
<?php
include 'BDD/connexionBdd.php';
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

        <link href="lib/css/styleMenu.css" rel="stylesheet" type="text/css"/>


        <link href="lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="lib/alert/sweetalert2.js" type="text/javascript"></script>
        <link href="client/modifierMdp.css" rel="stylesheet" type="text/css"/>



    </head>
    <body >





        <?php include '../include/MenuTopClient.php'; ?>

        <!-- debut de la page -->

        <div style="text-align: center;">
            <form method="POST" class="leMotDePasse" id="leMotDePasse">
                <h4 class="labelMdp" >mot de passe : </h4> <input class="inputMdp form-control" type="password"  name="mdp" required=""/><br>
                <h4 class="labelMdp" >répéter mot de passe : </h4> <input class=" inputMdp form-control" type="password"  name="mdpVerif" required=""/><br>

                <input type="button" name="modifMdp" class="btn btn-outline-danger btn-lg inputMdp" value="annuler" onclick="history.back()"/>
                <input type="submit" name="creerMdp" class="btn btn-outline-primary btn-lg inputMdp" value="modifier"/>

            </form>
        </div>





        <!-- libscript js -->
        <script src="lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="lib/js/main.js" type="text/javascript"></script>
        <script src="lib/js/popper.js" type="text/javascript"></script>





        <!-- fin de la page -->

        <?php
        $emailMdp = trim($_GET['id']);
        echo $emailMdp;
        $emailMdp = openssl_decrypt($emailMdp, "AES-128-ECB", 'LeMDP25123ab');
        $decrypted_string = openssl_decrypt($ligne['mdp'], "AES-128-ECB", 'LeMDP25123ab');
        echo $emailMdp;
        if ($emailMdp == 'lecyrano.chocolaterie@gmail.com') {
            echo 'aaaaaaaa';
        }
       
 
        ?>



        <?php
//include '../../include/protectionSessionMembre.php';
        ?>


    </body>
</html>







