
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

        <link href="../boutique/ajout/ajout.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <!-- debut de la page -->



        <div style="text-align: center;" >
            <form method="POST" class="leMotDePasse" id="leMotDePasse">

                <h4 class="titreAjout" > Déjà Client ?  </h4> 
                <h4 class="labelAjout"> Email : </h4> 
                <input class=" inputMdp form-control" type="text"  name="email" required=""/><br>



                <input type="button" class="btn btn-primary btn-lg inputMdp" onclick="document.location.href = '/hitechlab/connexion/inscription.php?boutique=false'"  value="Inscription"/>
                <input type="submit" name="testerEmail" class="btn btn-outline-primary btn-lg inputMdp" value="Connexion" />

            </form>
        </div>

        <!-- libscript js -->
        <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../lib/js/main.js" type="text/javascript"></script>
        <script src="../lib/js/popper.js" type="text/javascript"></script>





        <!-- fin de la page -->






        <?php
        if (isset($_POST['testerEmail'])) {
            $email = $_POST['email'];
            try {
                $insert = "select email,prenom,nom from only client where email = '$email';";
                $requete = $conn->prepare($insert);
                $requete->execute();
                $ligne = $requete->fetch();
                if ($email == $ligne['email']) {
                    $prenom = $ligne['prenom'];
                    $nom = $ligne['nom'];
                    $emailCrypt = openssl_encrypt($email, "AES-128-ECB", 'LeMDP25123ab');
                    $html = '<html><head>'
                            . ' <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'
                            . '</head>'
                            . '<body style="font-family: Arial;">'
                            . '<div style="text-align:center;"> '
                            . '<H4 style="display:inline-block; margin-bottom: 2px;">Bienvenue chez </H4><br>'
                            . '<h2 style="display:inline-block;">HI-TECH LAB </H2><br> '
                            . '</div>'
                            . '<div style="text-align:center;">'
                            . 'Bonjour ' . $nom . ' ' . $prenom . ', votre demande a été prise en charge. <br> '
                            . 'Veuillez cliquer sur le lien suivant pour accéder au suivis en-ligne '
                            . '        <div style="text-align:center">  <a   href="http://localhost:8080/hitechlab/partieClient/mdp.php?id=' . $emailCrypt . '" style="               
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

                    try {
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

                        echo "<script> alert_info_redirect('Un email vous à été envoyé', 'info','/hitechlab/connexion/connexion.php');</script>";
                    } catch (Exception $ex) {
                        
                    }
                } else {
                    echo "<script> alert_info('Email introuvable', 'info');</script>";
                }
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur", "error");</script>';
            }
        }
        ?>

    </body>
</html>







