 

<!doctype html>

<?php
include '../../BDD/connexionBdd.php';
?>
<html lang="fr">
    <head>
        <title>Accueil</title>  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">	
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <link href="../../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../../client/client.css" rel="stylesheet" type="text/css"/>
        <link href="../../lib/css/styleMenu.css" rel="stylesheet" type="text/css"/>

        <link href="gestionStock.css" rel="stylesheet" type="text/css"/>
        <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../../include/alert.js" type="text/javascript"></script>


    </head>
    <body>

        <div class="wrapper d-flex align-items-stretch">
            <?php include '../../include/Sidebar.php'; ?>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <?php include '../../include/MenuTop.php'; ?>

                <!-- debut de la page -->

                <?php
                $iconEdit = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save" viewBox="0 0 16 16">
  <path d="M2 1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9.5a1 1 0 0 0-1 1v7.293l2.646-2.647a.5.5 0 0 1 .708.708l-3.5 3.5a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L7.5 9.293V2a2 2 0 0 1 2-2H14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h2.5a.5.5 0 0 1 0 1H2z"/>
</svg>';
                ?>


                <div style="text-align: center">
                    <form method="POST">
                        <h4 class="petitLabelPiece" style="font-size: 1.5em;text-align: right; margin-bottom: 1%;">Code barre : </h4> <input name="ajoutQteCB" class=" petitLabelPiece form-control"type="text"/>
                        
                    </form>
                    <?php
                    $requete = "select piece.id_piece,modele.lib_modeele,piece.ref,piece.nom_piece,piece.prixachat,piece.stock,piece.code_bar from piece 
inner join modele on modele.id_modele = piece.id_modele
where stock <= 1
order by piece.stock";
                    $requete = $conn->prepare($requete);
                    $requete->execute();
                    while ($lignes = $requete->fetch()) {
                        $id_piece = $lignes['id_piece'];
                        $modele = $lignes['lib_modeele'];
                        $ref = $lignes['ref'];
                        $nomPiece = $lignes['nom_piece'];
                        $prixachat = $lignes['prixachat'];
                        $stock = $lignes['stock'];
                        $codeBar = $lignes['code_bar'];
                        echo "<div class='lapiece' >"
                        . "<label class='petittitrePiece'>Modèle :</label>"
                        . "<label class='petitLabelPiece'>$modele </label>"
                        . "<label class='petittitrePiece'>Nom pièce: </label>"
                        . "<label class='petitLabelPiece'>$nomPiece</label>"
                        . "<label class='petittitrePiece'>référence :</label>"
                        . "<label class='libPiece'> $ref</label>"
                        . "<label class='petittitrePiece'>Code barre : </label>"
                        . "<label class='petitLabelPiece'>$codeBar</label>"
                        . "<label class='petittitrePiece'>Prix d'achat :</label>"
                        . "<label class='petitLabelPiece'>$prixachat €</label>"
                        . "<label class='petittitrePiece'>Stock :</label>"
                        . "<form method='POST' class='libPiece'>"
                        . "<div class='petittitrePiece'>"
                        . "<input type='text' class='form-control' name='stock' value='$stock'/>"
                        . "</div>"
                        . "<button type='submit' class='btn btn-primary' name='changeQTE'  value='$id_piece' >"
                        . "$iconEdit"
                        . "</button>"
                        . "</form>"
                        . "</div>";
                    }
                    ?>


                </div>
            </div>
        </div>

        <!-- fin de la page -->


        <?php
        if (isset($_POST['changeQTE'])) {
            $id = $_POST['changeQTE'];
            $qte = $_POST['stock'];
            try {
                $requete = "update piece set stock = $qte where id_piece = $id;";
                $requete = $conn->prepare($requete);
                $requete->execute();
                echo '<script> alert_info_redirect("Quantité modifiée","success","/hitechlab/boutique/gestionStock/GestionStock.php");</script>';
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur","error");</script>';
            }
        }

        if (isset($_POST['ajoutQteCB'])) {
            $codeBarre = $_POST['ajoutQteCB'];
       
            try {
                $update = "select * from ajoutpieceStock('$codeBarre')";
                $update = $conn->prepare($update);
                $update->execute();
                  echo '<script> alert_info_redirect("Pièce ajoutée au stock","success","/hitechlab/boutique/gestionStock/GestionStock.php");</script>';
            } catch (Exception $ex) {
                   echo '<script> alert_info("Pièce introuvable","error");</script>';
            }
        }
        ?>
        <!-- mes script js-->



        <!-- libscript js -->

        <script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../../lib/js/main.js" type="text/javascript"></script>
        <script src="../../lib/js/popper.js" type="text/javascript"></script>

<?php
include '../../include/ProtectSession.php';
?>
    </body>
</html>







