<?php
include '../BDD/connexionBdd.php';

require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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
        <script src="../include/alert.js" type="text/javascript"></script>
        <link href="../client/client.css" rel="stylesheet" type="text/css"/>
        <script>
            function pro() {
                var temp = document.getElementById('pro').checked;
                if (temp == true) {
                    document.getElementById('professionnel').style.display = 'inline-block';
                    document.getElementById('proCache').value = true;

                } else {
                    document.getElementById('professionnel').style.display = 'none';
                    document.getElementById('proCache').value = false;
                }
            }
        </script>

    </head>
    <body>

        <!-- debut de la page -->


        <div style="text-align: center">
            <h3 >         inscription</h3>
            <div class="createClient slideBar" id="createClient" style="text-align: left;  width: 95%; ">

                <h4 class="labelClient"> professionnel : </h4> 
                <div class="form-check form-switch checkboxClient ">
                    <input class="form-check-input " type="checkbox" id="pro" name="pro" style="width: 50%; height: 80%; margin-left: 0%;"  onclick="pro();"  > 
                </div>
                <form method="POST">
                    <input type="hidden" value="false" name="pro" id="proCache"/>
                    <h4 class="labelClient">Nom : </h4> <input class="inputClient form-control" type="text" name="Nom" required=""/><br>
                    <h4 class="labelClient">Prenom : </h4> <input class="inputClient form-control" type="text" name="Prenom" required=""/><br>
                    <h4 class="labelClient">Tel : </h4> <input class="inputClient form-control" type="number" name="Tel" required="" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/><br>
                    <h4 class="labelClient">Email : </h4> <input class="inputClient form-control" type="text" name="Email" required=""/><br>
                    <h4 class="labelClient">Tel Fixe : </h4> <input class="inputClient form-control" type="number" name="Tel_fixe" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/><br>
                    <h4 class="labelClient">Rue : </h4> <input class="inputClient form-control" type="text" name="Rue" /><br>
                    <h4 class="labelClient">Code Postal : </h4> <input class="inputClient form-control" type="number" name="CPost" maxlength="5" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/><br>
                    <h4 class="labelClient">Ville : </h4> <input class="inputClient form-control" type="text" name="Ville"/><br>
                    <h4 class="labelClient">offres commercial: </h4> 
                    <div class="form-check form-switch checkboxClient ">
                        <input class="form-check-input " type="checkbox" id="flexSwitchCheckDefault" name="offre" style="width: 50%; height: 80%; margin-left: 0%;" > 
                    </div>

                    <!-- champ professionnel apparauit si on coche la case client pro (utilise la fonction pro(); -->

                    <div class="professionnel" id="professionnel">
                        <br> <h4 class="labelClient"> Siret :</h4> <input class="inputClient form-control" type="text" name="siret"/><br>
                        <h4 class="labelClient"> tel Pro :</h4> <input class="inputClient form-control" type="tel" name="telPro"/><br>
                        <h4 class="labelClient"> nom de l'entreprise:</h4> <input class="inputClient form-control" type="text" name="nomEnt"/><br>
                        <h4 class="labelClient"> statut :</h4> <select class="inputClient form-control"  name="civilite">
                            <option value="SAS"> SAS</option>
                            <option value="auto"> auto-entreprenneur </option>
                        </select>


                    </div>
                    <br>
                    <div style="text-align: center">
                        <input type="button" name="createCli" class="btn btn-outline-danger btn-lg" value="Annuler"  onclick="history.back();"/>
                        <input type="submit" name="createCli" class="btn btn-outline-primary btn-lg" value="S'inscrire"  />
                    </div>

                </form>

            </div>
        </div>

        <!-- libscript js -->
        <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../lib/js/main.js" type="text/javascript"></script>
        <script src="../lib/js/popper.js" type="text/javascript"></script>


        <script>
                            document.getElementById('createClient').style.height = '550px';

        </script>


        <!-- fin de la page -->


        <?php
        if (isset($_POST['createCli'])) {
            $nom = $_POST['Nom'];
            $prenom = $_POST['Prenom'];
            $tel = $_POST['Tel'];
            $email = $_POST['Email'];
            $telfix = $_POST['Tel_fixe'];
            $rue = $_POST['Rue'];
            $Cpost = $_POST['CPost'];
            $ville = $_POST['Ville'];
            $offre = $_POST['offre'];

            $siret = $_POST['siret'];
            $telPro = $_POST['telPro'];
            $nomEnt = $_POST['nomEnt'];
            $statut = $_POST['civilite'];



            if ($offre == 'on') {
                $offre = 'true';
            } else {
                $offre = 'false';
            }

            $emailMdp = openssl_encrypt($email, "AES-128-ECB", 'LeMDP25123ab');

            $pro = $_POST['pro'];
            $html = '<html><head>'
                    . ' <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'
                    . '</head>'
                    . '<body style="font-family: Arial;">'
                    . '<div style="text-align:center;"> '
                    . '<H4 style="display:inline-block; margin-bottom: 2px;">Bienvenue chez </H4><br>'
                    . '<h2 style="display:inline-block;">HI-TECH LAB </H2><br> '
                    . '</div>'
                    . '<div style="text-align:center;">'
                    . 'Bonjour, votre demande a été prise en charge. <br> '
                    . 'Veuillez cliquer sur le lien suivant pour accéder au suivis en-ligne '
                    . '        <div style="text-align:center">  <a   href="http://localhost:8080/hitechlab/partieClient/mdp.php?id=' . $emailMdp . '" style="               
                 display: inline-block;
  border-radius: 4px;
  background-color: #E84D0E;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 20px;
  padding: 13px;
  width: 250px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
  text-decoration:none;"
 
 >Créer mon espace client </a></div></div>'
                    . '</body></html>';

            if ($email != '') {

                if ($pro != 'true') {

                    try {
                        $insert = "insert into client (nom,prenom,tel,email,telfixe,rue,cpost,ville,receptionoffre) values ('$nom','$prenom','$tel','$email','$telfix','$rue','$Cpost','$ville',$offre);";
                        // $insert = "insert into client (email) values ('$email');";
                        $test = $conn->prepare($insert);
                        $test->execute();

                        $mail = new PHPmailer();
                        $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
                        $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
                        $mail->SMTPAuth = true; // Activer authentication SMTP
                        $mail->Username = 'loup.cascadeur@gmail.com'; // Votre adresse email d'envoi
                        $mail->Password = 'cjpst26130'; // Le mot de passe de cette adresse email
                        $mail->SMTPSecure = 'ssl'; // Accepter SSL
                        $mail->Port = 465;

                        $mail->setFrom('loup.cascadeur@gmail.com', 'Hi tech lab'); // Personnaliser l'envoyeur
                        $mail->addAddress($email, 'Client'); // Ajouter le destinataire
                        $mail->addReplyTo('loup.cascadeur@gmail.com', 'Information'); // L'adresse de réponse


                        $mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

                        $mail->Subject = 'Espace client';
                        $mail->Body = $html;

                        $mail->SMTPDebug = 0;
                        if (!$mail->send()) {
                            
                        }
                        if ($_GET['boutique'] == 'true') {
                            echo "<script> alert_info_redirect('Inscription réussi','success','/hitechlab/partieclient/enBoutique/creerDevisC.php?id=$email');</script>";
                        } else {
                            echo "<script> alert_info_redirect('Inscription réussi','success','/hitechlab/connexion/connexion.php');</script>";
                        }
                    } catch (Exception $ex) {
                        echo '<script> alert_info("erreur","error");</script>';
                    }
                } else {
                    try {
                        $insert = "insert into client (nom,prenom,tel,email,telfixe,rue,cpost,ville,receptionoffre,siret,telentreprise,nomentreprise,civilite) values ('$nom','$prenom','$tel','$email','$telfix','$rue','$Cpost','$ville',$offre,'$siret','$telPro','$nomEnt','$statut');";
                        // $insert = "insert into client (email) values ('$email');";
                        $test = $conn->prepare($insert);
                        $test->execute();
                        $mail = new PHPmailer();
                        $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
                        $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
                        $mail->SMTPAuth = true; // Activer authentication SMTP
                        $mail->Username = 'loup.cascadeur@gmail.com'; // Votre adresse email d'envoi
                        $mail->Password = 'cjpst26130'; // Le mot de passe de cette adresse email
                        $mail->SMTPSecure = 'ssl'; // Accepter SSL
                        $mail->Port = 465;

                        $mail->setFrom('loup.cascadeur@gmail.com', 'Hi tech lab'); // Personnaliser l'envoyeur
                        $mail->addAddress($email, 'Client'); // Ajouter le destinataire
                        $mail->addReplyTo('loup.cascadeur@gmail.com', 'Information'); // L'adresse de réponse


                        $mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

                        $mail->Subject = 'Demande de prise en charge';
                        $mail->Body = $html;

                        $mail->SMTPDebug = 0;
                        if (!$mail->send()) {
                            
                        }
                        if ($_GET['boutique'] == 'true') {
                            echo "<script> alert_info_redirect('Inscription réussi','success','/hitechlab/partieclient/enBoutique/creerDevisC.php?id=$email');</script>";
                        } else {
                            echo "<script> alert_info_redirect('Inscription réussi','success','/hitechlab/connexion/connexion.php');</script>";
                        }
                    } catch (Exception $ex) {
                        echo '<script> alert_info("erreur","error");</script>';
                    }
                }
            }
        }
        ?>


    </body>
</html>



