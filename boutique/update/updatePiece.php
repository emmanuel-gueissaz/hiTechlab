<?php
include '../../BDD/connexionBdd.php';
require '../../vendor/autoload.php';
?>

<head>
    <link href="../../lib/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="../../include/alert.js" type="text/javascript"></script>
    <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
    <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>

    <link href="../ajout/ajout.css" rel="stylesheet" type="text/css"/>

    <script>
        function imprimer() {
            var imprimer = document.getElementById('lecodebar');
            var code = document.getElementById('codebar').value;
            var nom = document.getElementById('nom').value;
            var ref = document.getElementById('ref').value;
            var prix = document.getElementById('prix').value;
            var date = new Date().toLocaleDateString();
            var popupcontenu = window.open('');
            popupcontenu.document.open();
            popupcontenu.document.write('<style type="text/css">@media print { body { -webkit-print-color-adjust: exact; } }</style><link rel="stylesheet" type="text/css" href="barcode.css" media="all" />' +
                    '<div style="text-align:center;border:1px solid;width:100%;">' +
                    '<div style="display:inline-block;"> <b>Référence :</b> ' + ref + '</div><br>' +
                    '<div style="display:inline-block;"> <b>Libellé :</b> ' + nom + '</div><br>' +
                    '<div style="display:inline-block;"> <b>Date :</b> ' + date + '</div><br>' +
                    '<div style="display:inline-block;"> ' + imprimer.innerHTML + '</div><br><div style="display:inline-block;">' + code + '</div></div>'

                    );
            popupcontenu.print();
            popupcontenu.document.close();

        }
        
        

        function ajouterCodeBarre() {
            let searchParams = new URLSearchParams(window.location.search);
            searchParams.has('id');
            let code = searchParams.get('id');
            document.getElementById('codebar').value = code;
        }
  
    </script>
</head>


<div style="text-align: center;">
    <form method="POST" class="leMotDePasse" id="leMotDePasse" style="margin-top: 8%;">


        <h4 class="titreAjout" > Modifier pièce </h4> 
        <h4 class="labelAjout">Fournisseur: </h4> 
        <?php
        try {
            $requete = "select * from fournisseur";
            $requete = $conn->prepare($requete);
            $requete->execute();
            echo '<select name="fourni" id="fourni" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle ">';
            while ($ligne = $requete->fetch()) {
                $id = $ligne['id_fournisseur'];
                $lib = $ligne['lib_fournisseur'];
                echo "<option value='$id'>$lib</option>";
            }
            echo ' </select>';
        } catch (Exception $ex) {
            
        }
        ?>
        <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterFournisseur.php'"/>
        <h4 class="labelAjout" > Nom: </h4> 
        <input class=" inputMdp form-control" type="text"  name="nom" id="nom" required=""/>
        <h4 class="labelAjout" > Référence: </h4> 
        <input class=" inputMdp form-control" type="text"  name="ref" id="ref" required=""/>
        <h4 class="labelAjout" > Prix: </h4> 
        <input class=" inputMdp form-control" type="text"  name="prix" id="prix" required=""/>
        <h4 class="labelAjout" > Stock: </h4> 
        <input class=" inputMdp form-control" type="text"  name="stock" id="stock" required=""/>
        <h4 class="labelAjout" > Code barre : </h4> 
        <input class=" listeAjout form-control" type="text"  name="codebar" id="codebar" />
        <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="ajouterCodeBarre()"/>
        <br>
            <div style="display: inline-block;margin-left: 20%; margin-top: 1%;">
                <button class="btn btn-outline-secondary"  onclick="imprimer()" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
                    </svg>
                </button>
            </div>
            <div style="display: inline-block;width: 60%; margin-left: 10%; vertical-align: middle; " id="lecodebar">

                <?php
                $id = $_GET['id'];
                $requete = "select * from piece where id_piece=$id";
                $requete = $conn->prepare($requete);
                $requete->execute();
                $ligne = $requete->fetch();
                $nom = $ligne['nom_piece'];
                $ref = $ligne['ref'];
                $prix = $ligne['prixachat'];
                $stock = $ligne['stock'];
                $codebar = $ligne['code_bar'];
                $fourni = $ligne['id_fournisseur'];
                if ($codebar != '') {
                    $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                    $lecode = $generator->getBarcode($codebar, $generator::TYPE_CODE_128);
                    echo "$lecode";
                }
                ?>
            </div>


            <input type="button"  class="btn btn-outline-danger btn-lg inputMdp" value="Retour" onclick="history.back()"/>
            <input type="submit" name="modifierPiece" class="btn btn-outline-primary btn-lg inputMdp" value="Modifié" />

    </form>

</div>
<script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../lib/js/main.js" type="text/javascript"></script>
<script src="../../lib/js/popper.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>




<?php
echo "<script>"
 . "$('#nom').val('$nom'),"
 . "$('#ref').val('$ref'),"
 . "$('#prix').val('$prix'),"
 . "$('#stock').val('$stock'),"
 . "$('#codebar').val('$codebar'),"
 . "$('#fourni').val('$fourni');"
 . "</script>";



if (isset($_POST['modifierPiece'])) {
    $id = $_GET['id'];
    $nom = $_POST['nom'];
    $ref = $_POST['ref'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];
    $codebar = $_POST['codebar'];
    $fourni = $_POST['fourni'];

    try {
        $update = "update piece set (nom_piece,ref,prixachat,stock, code_bar, id_fournisseur) = ('$nom','$ref',$prix,$stock, '$codebar', $fourni) where id_piece = $id";
        $requete = $conn->prepare($update);
        $requete->execute();
        echo '<script> alert_info("Pièce modifié","success");    setTimeout(function(){ history.go(-2); }, 1500); </script>';
    } catch (Exception $ex) {
        echo '<script> alert_info("erreur","error");</script>';
    }
}
?>

<!--protection de session -->
<?php
include '../../include/ProtectSession.php';
?>



