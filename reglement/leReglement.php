
<?php
include '../BDD/connexionBdd.php';

require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>
<!doctype html>


<html lang="fr">
    <head>
        <title>Accueil</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">	
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="reglement.css" rel="stylesheet" type="text/css"/>


        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../include/alert.js" type="text/javascript"></script>




    </head>
    <body>

        <?php
        $iconSupp = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                 <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                 </svg>';


        $iconEdit = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
</svg>';
        ?>


        <div class="wrapper d-flex align-items-stretch">
            <?php include '../include/Sidebar.php'; ?>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <?php include '../include/MenuTop.php'; ?>

                <!-- debut de la page -->

                <?php $id = $_GET['id']; ?>

                <input type="button" class="btn btn-outline-secondary" value="retour" onclick="history.back();"/>
                <input type="button" class="btn btn-outline-secondary" value="Devis" onclick="window.open('/hitechlab/pdf/leDevisPdf.php?id=<?php echo $id; ?>');return false;"/>
                <input type="button" class="btn btn-outline-secondary" value="Facture" onclick="window.open('/hitechlab/pdf/laFacturePdf.php?id=<?php echo $id; ?>');return false;"/>




                <div style="text-align: center">
                    <div class="lesReglements">
                        <div class='unReglement'>
                            <label class="titreReglement">Les règlements:</label>
                            <div class='infoReglementLong noResponsive'>libellé </div>
                            <div class='infoReglement '>Date</div>
                            <div class='infoReglement noResponsive'>Heure</div>
                            <div class='infoReglement'>Type de règlement</div>
                            <div class='infoReglement'> Montant </div>
                        </div>

                        <?php
                        $requete = "select  id_reglement,notereglement, datereg,heurereg, lib_reg, prix from reglement 
                                    inner join type_reglement ON type_reglement.id_reg = reglement.id_type_reg
                                    where id_reparation = $id";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        while ($ligne = $requete->fetch()) {
                            $id_reglement = $ligne['id_reglement'];
                            $notereglement = $ligne['notereglement'];
                            $datereg = $ligne['datereg'];
                            $heurereg = $ligne['heurereg'];
                            $lib_reg = $ligne['lib_reg'];
                            $prix = $ligne['prix'];
                            echo"<div class='unReglement'>";
                            echo "<hr class='my-2' Style='border-top:1px solid black; ' />";
                            echo "<div class='infoReglementLong noResponsive'>" . $notereglement . "</div>";
                            echo "<div class='infoReglement'>" . $datereg . "</div>";
                            echo "<div class='infoReglement noResponsive'>" . $heurereg . "</div>";
                            echo "<div class='infoReglement'>" . $lib_reg . "</div>";
                            echo "<form method='POST' class='infoReglement'>";
                            echo'      <div class="inputMontantLg">';
                            echo "<input type='text' class='form-control'  value='$prix' name='montant'/></div>"
                            . "<button type='submit' name='modfierMontant' class='btn btn-secondary' style='margin-left:2%;' value='$id_reglement'> $iconEdit </button>"
                            . "</form>";

                            echo "</div>";
                        }
                        ?>
                    </div>
                    <div class="nouveauReglement" >
                        <label class="titreReglement">Ajouter un règlement :</label>
                        <button class="btn btn-primary" onclick="document.getElementById('AjoutReglement').style.height = '100px';" id="ajtReg" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </button>
                        <form method="POST" class="AjoutReglement slideBar" id="AjoutReglement" >

                            <?php
                            try {
                                $requete = "select * from type_reglement";
                                $requete = $conn->prepare($requete);
                                $requete->execute();
                                echo '<select name="reg" id="reg" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle">';
                                while ($ligne = $requete->fetch()) {
                                    $id = $ligne['id_reg'];
                                    $lib = $ligne['lib_reg'];
                                    echo "<option value='$id'>$lib</option>";
                                }
                                echo ' </select>';
                            } catch (Exception $ex) {
                                
                            }
                            ?>
                            <label class='infoReglement'>Libellé: </label>
                            <div class="inputMontantLg">
                                <input type='text' class=' form-control'  name='libelle'/>
                            </div>
                            <label class='infoReglement'>Montant : </label>
                            <div class="inputMontant">
                                <input type='text' class='form-control' name='montant'/>
                            </div>
                            <input type="submit" class="btn btn-primary" name="valideAjoutReg" value="Ajouter"/>
                        </form>

                    </div>
                    <div style="text-align: right;">
                        <div  class="reste">

                            Reste à payer:
                            <?php
                            $id = $_GET['id'];
                            $requete = "select * from calculReste ($id);";
                            $requete = $conn->prepare($requete);
                            $requete->execute();
                            $ligne = $requete->fetch();
                            $reste = $ligne['calculreste'];
                            echo $reste . ' €';

                            if ($reste <= 0) {
                                echo "<script>  document.getElementById('ajtReg').disabled = true; </script>";
                            }
                            ?>

                        </div>
                    </div>


                </div>
            </div>



            <!-- fin de la page -->

            <!-- mes script js-->



            <!-- libscript js -->

            <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script src="../lib/js/main.js" type="text/javascript"></script>
            <script src="../lib/js/popper.js" type="text/javascript"></script>


            <?php
            $id = $_GET['id'];
            $t = "'";
            $requete = "select client.email, nom, prenom from reparation
inner join client ON client.email = reparation.email
where reparation.id = $id";
            $requete = $conn->prepare($requete);
            $requete->execute();
            $ligne = $requete->fetch();
            $email = $ligne['email'];
            $nom = $ligne['nom'];
            $prenom = $ligne['prenom'];



            $html = '<html><head>'
                    . ' <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'
                    . '</head>'
                    . '<body style="font-family: Arial;">'
                    . '<div style="text-align:center;"> '
                    . '<H4 style="display:inline-block; margin-bottom: 2px;">Bienvenue chez </H4><br>'
                    . '<h2 style="display:inline-block;">HI-TECH LAB </H2><br> '
                    . '</div>'
                    . '<div style="text-align:center;">'
                    . 'Bonjour ' . $nom . ' ' . $prenom . ', <br> '
                    . 'Vous venez de faire un règlement, vous pouvez consulter vos règlements ainsi que votre facture. '
                    . '     <div style="text-align:center">  <a   href="http://localhost:8080/hitechlab/partieclient/acceptationdevis/viewFacture.php?id=' . $id . '" style="               
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
 
 >Facture / Règlements</a></div></div>'
                 
                    . '</body></html>';
            ?>

            <?php
            if (isset($_POST['modfierMontant'])) {
                $id = $_GET['id'];
                $id_reg = $_POST['modfierMontant'];
                $montant = $_POST['montant'];
                try {
                    $update = "update reglement set prix = $montant where id_reglement = $id_reg";
                    $update = $conn->prepare($update);
                    $update->execute();
                    echo "<script> alert_info_redirect('Règlement modifié', 'success','/hitechlab/reglement/leReglement.php?id=$id')</script>";
                } catch (Exception $ex) {
                    echo "<script> alert_info('erreur', 'error')</script>";
                }
            }


            if (isset($_POST['valideAjoutReg'])) {
                $id_rep = $_GET['id'];
                $reg = $_POST['reg'];
                $libelle = $_POST['libelle'];
                $montant = $_POST['montant'];
                try {
                    $insert = "select * from lereglement($reg, '$libelle', $montant, $id_rep);";
                    $insert = $conn->prepare($insert);
                    $insert->execute();


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

                    $mail->Subject = 'Facture Hi Tech lab';
                    $mail->Body = $html;

                    $mail->SMTPDebug = 0;
                    if (!$mail->send()) {
                        echo "<script>alert_info('erreur email','error');</script>";
                    }
                    echo "<script> alert_info_redirect('Règlement ajouté', 'success','/hitechlab/reglement/leReglement.php?id=$id')</script>";
                } catch (Exception $ex) {
                    echo "<script> alert_info('erreur', 'error')</script>";
                }
            }
            ?>

            
            <?php            include '../include/ProtectSession.php';?>
    </body>


</html>







