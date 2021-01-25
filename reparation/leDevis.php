
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

        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../include/alert.js" type="text/javascript"></script>
        <link href="reparation.css" rel="stylesheet" type="text/css"/>
        <link href="../boutique/view/view.css" rel="stylesheet" type="text/css"/>


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
                <input type="button" class="btn btn-outline-secondary" value="PDF" onclick="window.open('/hitechlab/pdf/laFacture.php?id=<?php echo $id; ?>');return false;"/>

                <form method="POST" style="display: inline-block;">
                    <input type="submit" class="btn btn-outline-secondary" name="envoiMail" value="Envoyer le devis"/>
                </form>


                <div style="text-align: center">

                    <div class="infoDevis">
                        <div style="display: inline-block; width: 92%;">
                            <?php
                            $test = '"';
                            $id = $_GET['id'];
                            $requete = "select * from reparation inner join modele ON modele.id_modele = reparation.id_modele where id=" . $_GET['id'] . ";";
                            $requete = $conn->prepare($requete);
                            $requete->execute();
                            $ligne = $requete->fetch();
                            $modele = $ligne['lib_modeele'];
                            $date = $ligne['daterestitution'];
                            $heure = $ligne['heure'];
                            echo "<label class='labelinfoDevis'> Modèle :  </label>";
                            echo "<label class='donneInfoDevis'> $modele  </label>";
                            echo "<label class='labelinfoDevis'> Date de restitution :  </label>";
                            echo "<label class='donneInfoDevis'> $date  </label>";
                            echo "<label class='labelinfoDevis noResponsive'> heure de restitution :  </label>";
                            echo "<label class='donneInfoDevis noResponsive'> $heure  </label>";

                            echo "<button class='btn btn-primary' onclick='document.location.href=$test /hitechlab/reparation/laReparation.php?id=$id $test'>  "
                            . "     <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
</svg>"
                            . "</button>"
                            ?>
                        </div>

                    </div>


                    <div class="cadreViewSansHeight" >
                        <div class="titreView">
                            <h5 class="lableTitreView">
                                Ajouter une intervention :
                            </h5>
                            <button class="btn btn-primary iconElement" onclick="document.getElementById('AffichePlus').style.display = 'inline-block';"  >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>

                        </div>
                        <div class="AffichePlus" id="AffichePlus">
                            <div class="titreView" id="AffichePlus">
                                <h4 class="labelRecherche">Catégorie: </h4> 


                                <?php
                                try {
                                    $requete = "select * from categorie";
                                    $requete = $conn->prepare($requete);
                                    $requete->execute();
                                    echo '<select name="categ" id="categ" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle">';
                                    while ($ligne = $requete->fetch()) {
                                        $id = $ligne['id_categ'];
                                        $lib = $ligne['id_categ'];
                                        echo "<option value='$id'>$lib</option>";
                                    }
                                    echo ' </select>';
                                } catch (Exception $ex) {
                                    
                                }
                                ?>


                                <h4 class="labelRecherche">Recherche: </h4> 
                                <input class=" selectRecheche form-control" type="text"  name="recherche" id="recherche" />

                            </div>






                            <div >
                                <div class="titrePiece" style="margin-left: 10%;">Nom </div>
                                <div class="titrePiece">Tarif </div>
                                <div class="titrePiece noResponsive">Piece </div>

                            </div>
                            <div id="lesForfaits">

                            </div>
                        </div>


                    </div>


                    <div class="cadreViewSansHeight" >
                        <div class="titreView">
                            <h5 class="lableTitreView">
                                Ajouter une Remise :
                            </h5>
                            <button class="btn btn-primary iconElement" onclick="document.getElementById('AfficheRemise').style.display = 'inline-block';"  >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>

                        </div>
                        <div class="AffichePlus" id="AfficheRemise">
                            <div class="titreView" id="AfficheRemise">
                                <h4 class="labelRecherche">Type de remise : </h4> 


                                <form method="POST" style="display: inline-block;">
                                    <?php
                                    try {
                                        $requete = "select * from remise";
                                        $requete = $conn->prepare($requete);
                                        $requete->execute();
                                        echo '<select name="remise" id="remise" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle">';
                                        while ($ligne = $requete->fetch()) {
                                            $id = $ligne['id_remise'];
                                            $lib = $ligne['lib_remise'];
                                            echo "<option value='$id'>$lib</option>";
                                        }
                                        echo ' </select>';
                                    } catch (Exception $ex) {
                                        
                                    }
                                    ?>
                                    <input type="button" value="+" class="btn btn-primary" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterTypeRemise.php'"/> 
                                    <h4 class="labelRecherche">Montant : </h4> 

                                    <input type="text" name="montantRemise" class="inputQte form-control"/>
                                    <input type="submit" name="ajouterRemise" class=" btn btn-primary" value="Ajouter"/>
                                </form>




                            </div>


                        </div>
                    </div>
                    <div class="cadreViewSansHeight">
                        <div class="titreView">
                            <h5 class="lableTitreView" style="width: 85%;">
                                Les interventions :
                            </h5>
                        </div>
                        <?php
                        $id = $_GET['id'];
                        $total = 0;
                        $requete = "select * from forfait  inner join prend ON prend.id_forfait = forfait.id_forfait where prend.id = $id";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        while ($ligne = $requete->fetch()) {
                            $id_forfait = $ligne['id_forfait'];
                            $nomForfait = $ligne['nom_forfait'];
                            $tarif = $ligne['tarif'];
                            $qte = $ligne['qte'];

                            $total += $tarif * $qte;

                            echo "<label class='donneIntervention'> $nomForfait  </label>";
                            echo "<label class='donneIntervention'> $tarif  €</label>";
                            echo "<div class='donneIntervention'><form method='POST' class='iconElement'>"
                            . "<input type='number' class='inputQte form-control' value='$qte' name='qte' />"
                            . "<button type='submit' class='btn btn-secondary iconElement' value='$id_forfait' name='edit' > "
                            . "$iconEdit"
                            . "</button>"
                            . "</form></div>";
                            echo "<form method='POST' class='iconElement'>"
                            . "<button type='submit' class='btn btn-danger iconElement' value='$id_forfait' name='supp' > "
                            . "$iconSupp"
                            . "</button>"
                            . "</form>";
                        }
                        $requete = "select * from remise inner join compter ON compter.id_remise = remise.id_remise where compter.id_reparation = $id";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        while ($ligne = $requete->fetch()) {
                            $id_remise = $ligne['id_remise'];
                            $lib_remise = $ligne['lib_remise'];
                            $tarif = $ligne['montant'];


                            $total -= $tarif;

                            echo "<label class='donneIntervention'> $lib_remise  </label>";
                            echo "<label class='donneIntervention'> -$tarif  €</label>";
                            echo "<div class='donneIntervention'><form method='POST' class='iconElement'>"
                            . "<input type='text' class='inputQte form-control' value='$tarif' name='tarif' />"
                            . "<button type='submit' class='btn btn-secondary iconElement' value='$id_remise' name='editRemise' > "
                            . "$iconEdit"
                            . "</button>"
                            . "</form></div>";
                            echo "<form method='POST' class='iconElement'>"
                            . "<button type='submit' class='btn btn-danger iconElement' value='$id_remise' name='suppRemise' > "
                            . "$iconSupp"
                            . "</button>"
                            . "</form>";
                        }
                        ?>

                    </div>
                    <div class="cadreViewSansHeight" >

                        <h5 class="lableTitreView" >Total : </h5>



                        <?php echo $total . '€';     ?>


                    </div>
                    <div style="text-align: right; margin-top: 2%;">
                        <input type="button" value="Réparation terminé" class="btn btn-outline-secondary" />
                        <input type="button" value="Facturé" class="btn btn-outline-secondary" onclick="document.location.href = '/hitechlab/reglement/leReglement.php?id=<?php echo $_GET['id']; ?>'" />
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

        <script>

                            function load_data(categ, nom)
                            {
                                $.ajax({
                                    url: "ajax/viewRechercheForfaitDevis.php",
                                    method: "post",
                                    data: {query: categ, nom},
                                    success: function (data)
                                    {
                                        $('#lesForfaits').html(data);
                                    }
                                });
                            }





                            $('#recherche').keyup(function () {


                                var categ = $('#categ').val();
                                var nom = $('#recherche').val();
                                load_data(categ, nom);


                            });

                            $('#categ').click(function () {


                                var categ = $('#categ').val();
                                var nom = $('#recherche').val();
                                load_data(categ, nom);


                            });


                            var categ = $('#categ').val();
                            var nom = $('#recherche').val();
                            load_data(categ, nom);


        </script>


        <?php
        if (isset($_POST['Add'])) {
            $idForfait = $_POST['Add'];
            $idReparation = $_GET['id'];


            try {
                $insert = "insert into prend (id_forfait,id,qte) values($idForfait,$idReparation,1);";
                $requete = $conn->prepare($insert);
                $requete->execute();
                echo "<script> alert_info_redirect('Intervention ajoutée', 'success','/hitechlab/reparation/leDevis.php?id=$idReparation')</script>";
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur","error");</script>';
            }
        }


        if (isset($_POST['supp'])) {
            $id_forfait = trim($_POST['supp']);
            $id_rep = trim($_GET['id']);
            try {
                $delele = "delete from prend where id_forfait = '$id_forfait' and prend.id = '$id_rep'";
                $requete = $conn->prepare($delele);
                $requete->execute();
                echo "<script> alert_info_redirect('Intervention supprimée', 'success','/hitechlab/reparation/leDevis.php?id=$id_rep')</script>";
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur","error");</script>';
            }
        }
        if (isset($_POST['edit'])) {
            $id_forfait = trim($_POST['edit']);
            $id_rep = trim($_GET['id']);
            $qte = $_POST['qte'];
            try {
                $delele = "update prend set qte = $qte where id_forfait = '$id_forfait' and id = '$id_rep' ";
                $requete = $conn->prepare($delele);
                $requete->execute();
                echo "<script> alert_info_redirect('quantité modifiée', 'success','/hitechlab/reparation/leDevis.php?id=$id_rep')</script>";
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur","error");</script>';
            }
        }

        // les remises
        if (isset($_POST['suppRemise'])) {
            $id_remise = trim($_POST['suppRemise']);
            $id_rep = trim($_GET['id']);
            try {
                $delele = "delete from compter where id_remise = '$id_remise' and compter.id_reparation = '$id_rep'";
                $requete = $conn->prepare($delele);
                $requete->execute();
                echo "<script> alert_info_redirect('Remise supprimée', 'success','/hitechlab/reparation/leDevis.php?id=$id_rep')</script>";
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur","error");</script>';
            }
        }
        if (isset($_POST['editRemise'])) {
            $id_remise = trim($_POST['editRemise']);
            $id_rep = trim($_GET['id']);
            $tarif = $_POST['tarif'];
            try {
                $delele = "update compter set montant = $tarif where id_remise = '$id_remise' and id_reparation = '$id_rep' ";
                $requete = $conn->prepare($delele);
                $requete->execute();
                echo "<script> alert_info_redirect('Remise modifiée', 'success','/hitechlab/reparation/leDevis.php?id=$id_rep')</script>";
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur","error");</script>';
            }
        }


        if (isset($_POST['modif'])) {
            $id = $_POST['modif'];
            echo "<script>"
            . "document.location.href='/hitechlab/boutique/update/updateForfait.php?id=$id'"
            . "</script>";
        }

        if (isset($_POST['ajouterRemise'])) {
            $id = $_GET['id'];
            $id_remise = $_POST['remise'];
            $montant_remise = $_POST['montantRemise'];
            try {
                $insert = "insert into compter (id_remise,id_reparation,montant) values ($id_remise,$id,$montant_remise)";
                $requete = $conn->prepare($insert);
                $requete->execute();
                echo "<script> alert_info_redirect('Remise ajouté', 'success','/hitechlab/reparation/leDevis.php?id=$id')</script>";
            } catch (Exception $ex) {
//                   echo '<script> alert_info("erreur","error");</script>';
                echo $ex;
            }
        }


        if (isset($_POST['envoiMail'])) {
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
                    . 'Veuillez cliquer sur le lien suivant pour accéder au devis et sa validation en-ligne '
                    . '     <div style="text-align:center">  <a   href="http://localhost:8080/hitechlab/partieclient/acceptationdevis/viewdevis.php?id=' . $id . '" style="               
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
 
 >Voir le devis</a></div></div>'
                    . '     <div style="text-align:center">  <a   href="http://localhost:8080/hitechlab/partieclient/acceptationdevis/viewdevis.php?id=' . $id . '" style="               
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
 
 >Suivre votre réparation</a></div></div>'
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

            $mail->SMTPDebug = 0;
            if (!$mail->send()) {
                echo "<script>alert_info('erreur','error');</script>";
            } else {

                $insert = "insert into a (id, id_statut,datee,heure)values ($id,2, current_date, LOCALTIME(0));";
                if (!$requete = $conn->prepare($insert)) {
                    echo "<script>alert_info('Email renvoyé','success');</script>";
                }
                $requete->execute();
                echo "<script>alert_info('Email envoyé','success');</script>";
            }
        }
        ?>
    </body>


</html>







