
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

        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../include/alert.js" type="text/javascript"></script>
        <link href="../reparation/reparation.css" rel="stylesheet" type="text/css"/>
        <link href="achat.css" rel="stylesheet" type="text/css"/>

        <script>
            function imprimer() {
                var acces = document.getElementsByName('lemodele');
                var lesPrix = document.getElementsByName('prix');
                var reduc = document.getElementsByName('ticketTarif');
                var leTotalTicket = document.getElementById('leTotalTicket');
                var date = new Date().toLocaleDateString();
                var popupcontenu = window.open();
                popupcontenu.document.open();
                popupcontenu.document.write('<style type="text/css">@media print { body { -webkit-print-color-adjust: exact; } }</style><link rel="stylesheet" type="text/css" href="barcode.css" media="all" />');
                popupcontenu.document.write('<div style="border:1px solid; width:100%;text-align:center;">');
                popupcontenu.document.write('<div style="display:inline-block; margin-top:3%; width:100%; font-size:1.5em;">HI-TECH LAB</div>');
                popupcontenu.document.write("<hr class='my-2' Style='border-top:1px solid black; ' />");

                popupcontenu.document.write(
                        '<div style="display:inline-block; margin-top:3%; width:100%;">' +
                        '<div style="display:inline-block; width:40%;text-align:right; margin-right:4%;">Date : </div>' +
                        '<div style="display:inline-block;width:40%;text-align:left;margin-left:4%;"><b>' + date + '</b></div>' +
                        '</div>'

                        );
//                popupcontenu.document.write("<hr class='my-2' Style='border-top:1px solid black; ' />");

                popupcontenu.document.write('<div style="display:inline-block; margin-top:3%; margin-bottom:4%;width:90%; font-size:1.2em; text-align:left; border-bottom:1px solid;">Mes achats :</div><br>');

                for (var i = 0, max = acces.length; i < max; i++) {
                    popupcontenu.document.write(
                            '<div style="display:inline-block; margin-top:3%; width:100%;">' +
                            '<div style="display:inline-block; width:40%;text-align:right; margin-right:4%;">' + acces[i].innerHTML + ' : </div>' +
                            '<div style="display:inline-block;width:40%;text-align:left;margin-left:4%;"><b>' + lesPrix[i].innerHTML + '</b></div>' +
                            '</div>'

                            );
                }
                if (reduc.length > 0) {
//                    popupcontenu.document.write("<hr class='my-2' Style='border-top:1px solid black; ' />");
                    popupcontenu.document.write('<div style="display:inline-block; margin-top:3%; margin-bottom:4%;width:90%; font-size:1.2em; text-align:left; border-bottom:1px solid;">Remise :</div>');
                }
                for (var i = 0, max = reduc.length; i < max; i++) {
                    popupcontenu.document.write(
                            '<div style="display:inline-block; margin-top:3%; width:100%;">' +
                            '<div style="display:inline-block; width:40%;text-align:right; margin-right:4%;">Réduction</div>' +
                            '<div style="display:inline-block;width:40%;text-align:left;margin-left:4%;"><b>' + reduc[i].innerHTML + '</b></div>' +
                            '</div>'

                            );
                }
                popupcontenu.document.write("<hr class='my-2' Style='border-top:1px solid black; ' />");
                popupcontenu.document.write('<div style="display:inline-block;  width:80%; font-size:1.4em;margin-top:3%;margin-bottom:4%;"><b>' + leTotalTicket.innerHTML + '</b></div>')
                popupcontenu.document.write('</div >')
                popupcontenu.print();
                popupcontenu.document.close();

            }
        </script>
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

                <input type="button" class="btn btn-outline-secondary" value="Retour" onclick="history.back();"/>
                <input type="button" class="btn btn-outline-secondary" value="Ticket" onclick="imprimer();"/>

                <div style="text-align: center">
                    <div class="cadreAccessoire" >
                        <div class="titreView">
                            <h5 class="lableTitreRep">
                                Ajouter un équipement :
                            </h5>
                            <button class="btn btn-primary iconElement" onclick="document.location.href = 'http://localhost:8080/hitechlab/boutique/view/viewAccessoire.php?page=1&type=achat&id=<?php echo $id ?>'"  >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>

                        </div>

                        <?php
                        $t = '"';
                        $total = 0;
                        $id = $_GET['id'];
                        $requete = "select  accessoire.id,nom, modele.lib_modeele, qte, accessoire.prixvente,accessoire.matiere  from accessoire 
                            inner join inclut ON inclut.id_accessoire = accessoire.id
                            inner join modele ON modele.id_modele = accessoire.id_modele
                            where inclut.id_achat = $id";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        while ($lignes = $requete->fetch()) {
                            $id = $lignes['id'];
                            $nom = $lignes['nom'];
                            $lib_modeele = $lignes['lib_modeele'];
                            $qte = $lignes['qte'];
                            $prixvente = $lignes['prixvente'];
                            $matiere = $lignes['matiere'];
                            $total += $prixvente * $qte;
                            echo " <hr class='my-2' Style='border-top:1px solid black; ' />"
                            . "<div class='unAccessoire'>"
                            . "<div class='blockImg' onclick='document.location.href=$t /hitechlab/boutique/update/updateAccessoire.php?id=$id $t'>"
                            . "<img class='imageAccessoire' src='../boutique/image/$id.png'/>"
                            . "</div>"
                            . "<div class='infoAccessoire'>"
                            . "<label class='titreInfoAccessoire' style=' cursor: pointer;' onclick='document.location.href=$t /hitechlab/boutique/update/updateAccessoire.php?id=$id $t'>$nom</label>"
                            . "<label class='labelInfoAccessoire'>Modèle : <span class='badge badge-secondary' name='lemodele'> $lib_modeele</span></label>"
                            . "<label class='labelInfoAccessoire'>Matière : <span class='badge badge-secondary'> $matiere</span></label>"
                            . "<label class='labelInfoAccessoire'>Quantité :  <form method='POST' class='inputQte'><input type='number' name='qte' class='form-control' value='$qte' style='display:inline-block;width:60%;'/>"
                            . "<button type='submit' name='modifQte' class='btn btn-secondary' style='display:inline-block;margin-left:1%;' value='$id'>$iconEdit</button></form> </label>"
                            . "</div>"
                            . "<div class='prixAccesoire'>"
                            . "<label class='titreInfoAccessoire' name='prix' style=' cursor: pointer;' onclick='document.location.href=$t /hitechlab/boutique/update/updateAccessoire.php?id=$id $t'>$prixvente €</label>"
                            . "<form method='POST' class='titreInfoAccessoire' ><button type='submit' name='suppAcces' class='btn btn-danger' style='display:inline-block;' value='$id'>$iconSupp</button></form> "
                            . "</div></div>";
                        }
                        ?>
                    </div>

                    <div class="cadreAccessoire" >
                        <div class="titreView">
                            <h5 class="lableTitreRep">
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







                        <?php
                        $id = $_GET['id'];
                        $requete = "select * from remise inner join peut ON peut.id_remise = remise.id_remise where peut.id_achat = $id";
                        $requete = $conn->prepare($requete);
                        $requete->execute();

                        while ($ligne = $requete->fetch()) {

                            $id_remise = $ligne['id_remise'];
                            $lib_remise = $ligne['lib_remise'];
                            $tarif = $ligne['montant'];



                            $total -= $tarif;

                            echo "<label class='donneIntervention'> $lib_remise  </label>";
                            echo "<label class='donneIntervention' style='text-align:right; padding-right:5%;' name='ticketTarif'> -$tarif  €</label>";
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
                    <div  class="totalPiece"  id="leTotalTicket">
                        Total : <?php echo $total ?> €
                    </div>
                    <div style="text-align: right; margin-top: 2%;">
                        <input type="button" value="Facturé" class="btn btn-outline-secondary" onclick="document.location.href = '/hitechlab/reglement/ReglementAchat.php?id=<?php echo $_GET['id']; ?>'" />
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

        </script>


        <?php
        if (isset($_POST['modifQte'])) {
            $id_achat = $_GET['id'];
            $id_produit = $_POST['modifQte'];
            $qte = $_POST['qte'];
            try {
                $update = "update inclut set qte = $qte where id_accessoire = $id_produit and id_achat = $id_achat;";
                $update = $conn->prepare($update);
                $update->execute();
                echo "<script> alert_info_redirect('Quantité modifiée','success','/hitechlab/achat/achat.php?id=$id_achat'); </script>";
            } catch (Exception $ex) {
                echo "<script> alert_info('Erreur','error'); </script>";
            }
        }

        if (isset($_POST['suppAcces'])) {
            $id_accesoire = trim($_POST['suppAcces']);
            $id_ach = trim($_GET['id']);
            try {
                $delele = "delete from inclut where id_accessoire = $id_accesoire and inclut.id_achat = '$id_ach'";
                $requete = $conn->prepare($delele);
                $requete->execute();
                echo "<script> alert_info_redirect('Accessoire supprimée', 'success','/hitechlab/achat/achat.php?id=$id_ach')</script>";
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur","error");</script>';
            }
        }


        if (isset($_POST['ajouterRemise'])) {
            $id = $_GET['id'];
            $id_remise = $_POST['remise'];
            $montant_remise = $_POST['montantRemise'];
            try {
                $insert = "insert into peut (id_remise,id_achat,montant) values ($id_remise,$id,$montant_remise)";
                $requete = $conn->prepare($insert);
                $requete->execute();
                echo "<script> alert_info_redirect('Remise ajouté', 'success','/hitechlab/achat/achat.php?id=$id')</script>";
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur","error");</script>';
                echo $ex;
            }
        }


        if (isset($_POST['suppRemise'])) {
            $id_remise = trim($_POST['suppRemise']);
            $id_ach = trim($_GET['id']);
            try {
                $delele = "delete from peut where id_remise = '$id_remise' and peut.id_achat = '$id_ach'";
                $requete = $conn->prepare($delele);
                $requete->execute();
                echo "<script> alert_info_redirect('Remise supprimée', 'success','/hitechlab/achat/achat.php?id=$id_ach')</script>";
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur","error");</script>';
            }
        }

        if (isset($_POST['editRemise'])) {
            $id_remise = trim($_POST['editRemise']);
            $id_ach = trim($_GET['id']);
            $tarif = $_POST['tarif'];
            try {
                $delele = "update peut set montant = $tarif where id_remise = '$id_remise' and id_achat = '$id_ach' ";
                $requete = $conn->prepare($delele);
                $requete->execute();
                echo "<script> alert_info_redirect('Remise modifiée', 'success','/hitechlab/achat/achat.php?id=$id_ach')</script>";
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur","error");</script>';
            }
        }
        ?>

    </body>


</html>








