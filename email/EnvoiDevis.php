<script src="../include/alert.js" type="text/javascript"></script>
<link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
<script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php
$id = $_GET['id'];
include '../BDD/connexionBdd.php';
$requete = "select client.email, nom, prenom from reparation
inner join client ON client.email = reparation.email
where reparation.id = $id";
$requete = $conn -> prepare($requete);
$requete -> execute();
$ligne = $requete->fetch();
$email = $ligne['email'];
$nom = $ligne['nom'];
$prenom = $ligne['prenom'];


require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$html = '<html><head>'
        . ' <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'
        . '</head>'
        . '<body>'
        . ' Bonjour '. $nom .' '. $prenom.' <br> '
        . 'Devis n°' . $id
        . '     <div style="text-align:center">  <input type="button" value="Voir le devis" style="               
                 display: inline-block;
  border-radius: 4px;
  background-color: #E84D0E;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;"
 
  /></div>'
        . '</body></html>';


$mail = new PHPmailer();
$mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
$mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
$mail->SMTPAuth = true; // Activer authentication SMTP
$mail->Username = 'loup.cascadeur@gmail.com'; // Votre adresse email d'envoi
$mail->Password = 'cjpst26130'; // Le mot de passe de cette adresse email
$mail->SMTPSecure = 'ssl'; // Accepter SSL
$mail->Port = 465;

$mail->setFrom('loup.cascadeur@gmail.com', 'Hi tech lab'); // Personnaliser l'envoyeur
$mail->addAddress('loup.cascadeur@gmail.com', 'Client'); // Ajouter le destinataire
$mail->addReplyTo('loup.cascadeur@gmail.com', 'Information'); // L'adresse de réponse


$mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

$mail->Subject = 'Devis Hi Tech lab';
$mail->Body = $html;

$mail->SMTPDebug = 1;
if (!$mail->send()) {
    echo "<script>alert_info_redirect('erreur','error','/hitechlab/reparation/leDevis.php?id=$id');</script>";
} else {

    $insert = "insert into a (id, id_statut,datee,heure)values ($id,2, current_date, LOCALTIME(0));";
    if (!$requete = $conn->prepare($insert)) {
        echo "<script>alert_info_redirect('est','success','/hitechlab/reparation/leDevis.php?id=$id');</script>";
    }
    $requete->execute();
    echo "<script>alert_info_redirect('Email envoyé','success','/hitechlab/reparation/leDevis.php?id=$id');</script>";
}
?>

