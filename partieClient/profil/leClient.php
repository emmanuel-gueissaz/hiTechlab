
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

        <link href="../../client/client.css" rel="stylesheet" type="text/css"/>
        <script src="../../include/alert.js" type="text/javascript"></script>
    </head>
    <body>





        <?php include '../../include/MenuTopClient.php'; ?>

        <!-- debut de la page -->
        <?php
        $emailCrypt = openssl_encrypt($_SESSION['email'], "AES-128-ECB", 'LeMDP25123ab');
        ?>


        <input type="button" class="btn btn-outline-secondary" value="Accueil" onclick="document.location.href = '/hitechlab/partieClient/profil/profilClient.php'" style="margin-left: 2%;"/>

        <form method="POST">
            <h4 class="labelClient">Nom : </h4> <input class="inputClient form-control" type="text" id="Nom" name="Nom" required=""/><br>
            <h4 class="labelClient">Prenom : </h4> <input class="inputClient form-control" type="text" id="Prenom" name="Prenom" required=""/><br>
            <h4 class="labelClient">Tel : </h4> <input class="inputClient form-control" type="number" id="Tel" name="Tel" required="" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/><br>
            <h4 class="labelClient"> mot de passe :</h4>  <input type="button" class="inputClient btn btn-outline-primary" value="modifier" onclick="document.location.href = '/hitechlab/partieClient/mdp.php?id=<?php echo $emailCrypt ?>'" />

            <h4 class="labelClient">Tel Fixe : </h4> <input class="inputClient form-control" type="number" id="Tel_fixe" name="Tel_fixe" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/><br>
            <h4 class="labelClient">Rue : </h4> <input class="inputClient form-control" type="text" id="Rue" name="Rue" /><br>
            <h4 class="labelClient">Code Postal : </h4> <input class="inputClient form-control" type="number" id="CPost" name="CPost" maxlength="5" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/><br>
            <h4 class="labelClient">Ville : </h4> <input class="inputClient form-control" type="text" id="Ville" name="Ville"/><br>
            <h4 class="labelClient">offres commercial: </h4> 
            <div class="form-check form-switch checkboxClient ">
                <input class="form-check-input" type="checkbox"  id="Offre" name="offre" style="width: 20%; height: 80%; margin-left: 0%;" > 
            </div>

            <div class="professionnel" id="professionnel">
                <h4 class="labelClient"> Siret :</h4> <input class="inputClient form-control" type="text" name="siret" id="siret"/><br>
                <h4 class="labelClient"> tel Pro :</h4> <input class="inputClient form-control" type="tel" name="telPro" id="telPro"/><br>
                <h4 class="labelClient"> nom de l'entreprise:</h4> <input class="inputClient form-control" type="text" name="nomEnt" id="nomEnt"/><br>
                <h4 class="labelClient"> statut :</h4> <select class="inputClient form-control"  name="civilite" id="civilite">
                    <option value="SAS"> SAS</option>
                    <option value="auto"> auto-entreprenneur </option>
                </select>


            </div>






            <br>
            <div style="text-align: center">
                <input type="submit"  class="btn btn-outline-primary btn-lg" name="modifier" value="Modifier" />
            </div>

        </form>




        <!-- libscript js -->
        <script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../../lib/js/main.js" type="text/javascript"></script>
        <script src="../../lib/js/popper.js" type="text/javascript"></script>





        <!-- fin de la page -->


        <?php
        $email = $_SESSION['email'];
        $requete = "(select nom,prenom,tel,telfixe,rue,cpost,ville,receptionoffre,mdp,siret,telentreprise,nomentreprise,civilite from only client where email = '$email')";
        $requete = $conn->prepare($requete);
        $requete->execute();
        $ligne = $requete->fetch();


        $nom = $ligne['nom'];
        $prenom = $ligne['prenom'];
        $tel = $ligne['tel'];
        $telFix = $ligne['telfixe'];
        $rue = $ligne['rue'];
        $cPost = $ligne['cpost'];
        $ville = $ligne['ville'];
        $offre = $ligne['receptionoffre'];



        $siret = $ligne['siret'];
        $telPro = $ligne['telentreprise'];
        $nomEnt = $ligne['nomentreprise'];
        $statut = $ligne['civilite'];

        if ($nomEnt != '') {
            echo "<script>   document.getElementById('professionnel').style.display = 'inline-block'; </script>";
            echo "<script> "
            . "$('#siret').val('" . $siret . "'),"
            . "$('#telPro').val('" . $telPro . "'),"
            . "$('#nomEnt').val('" . $nomEnt . "'),"
            . "$('#civilite').val('" . $statut . "')"
            . "</script>";
        }


        echo "<script> "
        . "$('#Nom').val('" . $nom . "'),"
        . "$('#Prenom').val('" . $prenom . "'),"
        . "$('#Tel').val('" . $tel . "'),"
        . "$('#Tel_fixe').val(" . $telFix . "),"
        . "$('#Rue').val('" . $rue . "'),"
        . "$('#CPost').val('" . $cPost . "'),"
        . "$('#Ville').val('" . $ville . "'),"
        . "$('#Offre').prop('checked', $offre) "
        . "</script>";



        if (isset($_POST['modifier'])) {
            $nom = $_POST['Nom'];
            $prenom = $_POST['Prenom'];
            $tel = $_POST['Tel'];

            $telFix = $_POST['Tel_fixe'];
            $rue = $_POST['Rue'];
            $Cpost = $_POST['CPost'];
            $ville = $_POST['Ville'];
            $offre = $_POST['offre'];

            $siret = $_POST['siret'];
            $telPro = $_POST['telPro'];
            $nomEnt = $_POST['nomEnt'];
            $statut = $_POST['civilite'];
            $mdp = $_POST['mdp'];
            $mdp = openssl_encrypt($mdp, "AES-128-ECB", '1234');

            $Tmail = $_SESSION['email'];
            if ($offre == 'on') {
                $offre = 'true';
            } else {
                $offre = 'false';
            }

            try {

                $update = "update only  client
                           set (nom,prenom,tel,telfixe,rue,cpost,ville,receptionoffre) = ('$nom','$prenom','$tel','$telFix','$rue','$Cpost','$ville','$offre')
                           where email = '$Tmail';";
                $requete = $conn->prepare($update);
                $requete->execute();
                $_SESSION['prenom'] = $prenom;
                echo '<script> alert_info_redirect("Profil modifié","success","/hitechlab/partieClient/profil/leClient.php");</script>';
            } catch (Exception $ex) {
                
            }
        }
        ?>


        <?php
        include '../../include/protectionSessionMembre.php';
        ?>


    </body>
</html>







