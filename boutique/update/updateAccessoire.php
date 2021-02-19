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
            var code = document.getElementById('cbarre').value;
            var nom = document.getElementById('nom').value;
            var ref = document.getElementById('ref').value;
            var prix = document.getElementById('prixVente').value;
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
    </script>
</head>


<div style="text-align: center; ">
    <form method="POST" class="leMotDePasse" id="leMotDePasse" style="margin-top: 1%;" enctype="multipart/form-data">

        <h4 class="titreAjout" > Update accessoire </h4> 

        <h4 class="labelAjout" > Type accessoire : </h4> 
        <?php
        try {
            $requete = "select * from type_accessoire";
            $requete = $conn->prepare($requete);
            $requete->execute();
            echo '<select name="type_accessoire" id="type_accessoire" class=" listeAjout btn btn-outline-primary btn-sm dropdown-toggle   ">';
            while ($ligne = $requete->fetch()) {
                $id = $ligne['id_type'];
                $lib = $ligne['lib_type'];
                echo "<option value='$id'>$lib</option>";
            }
            echo ' </select>';
        } catch (Exception $ex) {
            
        }
        ?>
        <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajoutTypeAccessoire.php'"/>

        <h4 class="labelAjout" > Couleur : </h4> 
        <?php
        try {
            $requete = "select * from couleur";
            $requete = $conn->prepare($requete);
            $requete->execute();
            echo '<select name="couleur" id="couleur" class=" listeAjout btn btn-outline-primary btn-sm dropdown-toggle   ">';
            while ($ligne = $requete->fetch()) {
                $id = $ligne['id_couleur'];
                $lib = $ligne['lib_couleur'];
                echo "<option value='$id'>$lib</option>";
            }
            echo ' </select>';
        } catch (Exception $ex) {
            
        }
        ?>
        <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajoutCouleur.php'"/>

        <h4 class="labelAjout" > Fournisseur : </h4> 
        <?php
        try {
            $requete = "select * from fournisseur";
            $requete = $conn->prepare($requete);
            $requete->execute();
            echo '<select name="fournisseur" id="fournisseur" class=" listeAjout btn btn-outline-primary btn-sm dropdown-toggle   ">';
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
        <h4 class="labelAjout">Type de matériel: </h4> 
        <?php
        try {
            $requete = "select * from type_mat";
            $requete = $conn->prepare($requete);
            $requete->execute();
            echo '<select name="mat" id="mat" class=" listeAjout btn btn-outline-primary btn-sm dropdown-toggle   ">';
            while ($ligne = $requete->fetch()) {
                $id = $ligne['id_mat'];
                $lib = $ligne['lib_mat'];
                echo "<option value='$id'>$lib</option>";
            }
            echo ' </select>';
        } catch (Exception $ex) {
            
        }
        ?>
        <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterTypeMat.php'"/>

        <h4 class="labelAjout">Marque: </h4> 



        <?php
        try {
            $requete = "select * from marque";
            $requete = $conn->prepare($requete);
            $requete->execute();
            echo '<select name="marque" id="marque" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle ">';
            while ($ligne = $requete->fetch()) {
                $id = $ligne['id_marque'];
                $lib = $ligne['nom'];
                echo "<option value='$id'>$lib</option>";
            }
            echo ' </select>';
        } catch (Exception $ex) {
            
        }
        ?>

        <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterMarque.php'"/>


        <h4 class="labelAjout">Modèle: </h4> <select id="result" name="modele" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle" >

        </select>
        <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterModele.php'"/>

        <h4 class="labelAjout" > Nom: </h4> 
        <input class=" inputMdp form-control" type="text"  name="nom" id="nom" /><br>
        <h4 class="labelAjout" > Prix achat : </h4> 
        <input class=" inputMdp form-control" type="text"  name="prixAchat"  id="prixAchat"/><br>
        <h4 class="labelAjout" > Prix Vente : </h4> 
        <input class=" inputMdp form-control" type="text"  name="prixVente" id="prixVente" /><br>
        <h4 class="labelAjout" > Quantité : </h4> 
        <input class=" inputMdp form-control" type="text"  name="qte" id="qte" /><br>
        <h4 class="labelAjout" > Références : </h4> 
        <input class=" inputMdp form-control" type="text"  name="ref" id="ref"/><br>
        <h4 class="labelAjout" > Matière  : </h4> 
        <input class=" inputMdp form-control" type="text"  name="mat"  id="matiere"/><br>
        <h4 class="labelAjout" > Image : </h4> 
        <input class=" inputMdp"  type="file"  name="file" id="file" />
        <br>
        <h4 class="labelAjout" ></h4> 
        <img src="../image/<?php echo $_GET['id']; ?>.png"  class="inputMdp"  />
        <br>
        <h4 class="labelAjout" > Code barre : </h4> 
        <input class="inputMdp form-control" type="text"  name="cbarre" id="cbarre" /><br>
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
            $requete = "select  id_type, accessoire.nom, modele.id_modele,accessoire.id_couleur, accessoire.id_fournisseur,
                    modele.id_mat, modele.id_marque, accessoire.id_modele,accessoire.prixachat,accessoire.prixvente,accessoire.stock,
                    accessoire.matiere, accessoire.codebar,accessoire.ref    from accessoire 
                    inner join modele ON modele.id_modele = accessoire.id_modele where id = $id";
            $requete = $conn->prepare($requete);
            $requete->execute();
            $ligne = $requete->fetch();
            $nom = $ligne['nom'];
            $id_type = $ligne['id_type'];
            $id_modele = $ligne['id_modele'];
            $id_couleur = $ligne['id_couleur'];
            $id_fournisseur = $ligne['id_fournisseur'];
            $id_mat = $ligne['id_mat'];
            $id_marque = $ligne['id_marque'];
            $id_modele = $ligne['id_modele'];
            $prixachat = $ligne['prixachat'];
            $prixvente = $ligne['prixvente'];
            $stock = $ligne['stock'];
            $matiere = $ligne['matiere'];
            $codebar = $ligne['codebar'];
            $ref = $ligne['ref'];
            if ($codebar != '') {
                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                $lecode = $generator->getBarcode($codebar, $generator::TYPE_CODE_128);
                echo "$lecode";
            }
            ?>

        </div>


        <input type="button"  class="btn btn-outline-danger btn-lg inputMdp" value="annuler" onclick="document.location.href ='/hitechlab/boutique/view/viewAccessoire.php?page=1'"/>
        <input type="submit" name="modifierAccesoire" class="btn btn-outline-primary btn-lg inputMdp" value="Modifier" />

    </form>
</div>
<script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../lib/js/main.js" type="text/javascript"></script>
<script src="../lib/js/popper.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
            function load_data(mat, marque)
            {
                $.ajax({
                    url: "../../reparation/ajax/rechercheModele.php",
                    method: "post",
                    data: {query: mat, marque},
                    success: function (data)
                    {
                        $('#result').html(data);
                    }
                });
            }

            $('#marque').click(function () {


                var mat = $('#mat').val();
                var marque = $('#marque').val();
                load_data(mat, marque);
                ;
            });

            $('#mat').click(function () {


                var mat = $('#mat').val();
                var marque = $('#marque').val();
                load_data(mat, marque);
            });


            var mat = $('#mat').val();
            var marque = $('#marque').val();
            load_data(mat, marque);
</script>



<?php
echo"<script>"
 . "$('#type_accessoire').val($id_type);"
 . "$('#couleur').val($id_couleur);"
 . "$('#fournisseur').val($id_fournisseur);"
 . "$('#mat').val($id_mat);"
 . "$('#marque').val($id_marque);"
 . "$('#marque').click();"
 . " setTimeout(function(){   $('#result').val('$id_modele'); }, 400);"
 . "$('#nom').val('$nom');"
 . "$('#prixAchat').val('$prixachat');"
 . "$('#prixVente').val('$prixvente');"
 . "$('#qte').val('$stock');"
 . "$('#ref').val('$ref');"
 . "$('#matiere').val('$matiere');"
// . "$('#file').val();"
 . "$('#cbarre').val('$codebar');"
 . "</script>";


if (isset($_POST['modifierAccesoire'])) {
    $id = $_GET['id'];
    $type_accessoire = $_POST['type_accessoire'];
    $couleur = $_POST['couleur'];
    $fournisseur = $_POST['fournisseur'];
    $modele = $_POST['modele'];
    $nom = $_POST['nom'];
    $prixAchat = $_POST['prixAchat'];
    $prixVente = $_POST['prixVente'];
    $qte = $_POST['qte'];
    $ref = $_POST['ref'];
    $mat = $_POST['mat'];
    $cbarre = $_POST['cbarre'];

    if ($_FILES['file']['name'] != '') {
        print_r($_FILES);
        $source_file = $_FILES['file']['tmp_name'];
        $serveur_ftp = 'localhost';
        $login_ftp = 'admin';
        $mp_ftp = 'admin';
        $ftp = ftp_connect($serveur_ftp, 21);
        ftp_login($ftp, $login_ftp, $mp_ftp);
        $envoie = ftp_put($ftp, "$id.png", $source_file, FTP_BINARY);
        if (!$envoie) {
            echo '<script> alert_info("Erreur image","error");    </script>';
        }
    }
    try {
        $update = "update accessoire set (id_type,id_couleur,id_fournisseur,id_modele,nom,prixachat,prixvente, stock,ref,matiere,codebar)
                   = ($type_accessoire,$couleur,$fournisseur,$modele,'$nom','$prixAchat','$prixVente',$qte,'$ref','$mat','$cbarre')
                   where ACCESSoire.id = $id;";
        $update = $conn->prepare($update);
        $update->execute();
        echo "<script> alert_info_redirect('Accessoire modifié','success','/hitechlab/boutique/update/updateAccessoire.php?id=$id'); </script>";
    } catch (Exception $ex) {
        echo '<script> alert_info("Erreur","error");    </script>';
    }
}
?>
<?php
include '../../include/ProtectSession.php';
?>