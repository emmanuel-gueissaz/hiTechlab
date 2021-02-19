<?php
include '../../BDD/connexionBdd.php';
?>

<head>
    <link href="../../lib/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="../../include/alert.js" type="text/javascript"></script>
    <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
    <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>


    <link href="ajout.css" rel="stylesheet" type="text/css"/>
</head>


<div style="text-align: center; ">
    <form method="POST" class="leMotDePasse" id="leMotDePasse" style="margin-top: 1%;" enctype="multipart/form-data">

        <h4 class="titreAjout" > Nouveau accessoire </h4> 

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
        <input class=" inputMdp form-control" type="text"  name="nom" /><br>
        <h4 class="labelAjout" > Prix achat : </h4> 
        <input class=" inputMdp form-control" type="text"  name="prixAchat" /><br>
        <h4 class="labelAjout" > Prix Vente : </h4> 
        <input class=" inputMdp form-control" type="text"  name="prixVente" /><br>
        <h4 class="labelAjout" > Quantité : </h4> 
        <input class=" inputMdp form-control" type="text"  name="qte" /><br>
        <h4 class="labelAjout" > Références : </h4> 
        <input class=" inputMdp form-control" type="text"  name="ref"/><br>
        <h4 class="labelAjout" > Matière  : </h4> 
        <input class=" inputMdp form-control" type="text"  name="mat" /><br>
        <h4 class="labelAjout" > Image : </h4> 
        <input class=" inputMdp"  type="file"  name="file" /><br>
        <h4 class="labelAjout" > Code barre : </h4> 
        <input class=" inputMdp form-control" type="text"  name="cbarre" /><br>



        <input type="button"  class="btn btn-outline-danger btn-lg inputMdp" value="annuler" onclick="history.back()"/>
        <input type="submit" name="ajoutAccesoire" class="btn btn-outline-primary btn-lg inputMdp" value="ajouter" />

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
if (isset($_POST['ajoutAccesoire'])) {
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

    $source_file = $_FILES['file']['tmp_name'];
    $serveur_ftp = 'localhost';
    $login_ftp = 'admin';
    $mp_ftp = 'admin';
    $ftp = ftp_connect($serveur_ftp, 21);
    ftp_login($ftp, $login_ftp, $mp_ftp);

    try {
        $requete = "select * from insertaccessoire($type_accessoire, $couleur, $fournisseur, $modele, '$nom', $prixAchat, $prixVente, $qte, '$ref', '$mat', '$cbarre')";
        $requete = $conn->prepare($requete);
        $requete->execute();
        $ligne = $requete->fetch();
        $id_img = $ligne['insertaccessoire'];

        $envoie = ftp_put($ftp, "$id_img.png", $source_file, FTP_BINARY);
        if (!$envoie) {
            echo '<script> alert_info("Erreur image","error");    </script>';
        } else {
            echo '<script> alert_info("Accessoire ajouté","success");    setTimeout(function(){ history.go(-2); }, 1500); </script>';
        }
    } catch (Exception $ex) {
        echo '<script> alert_info("Erreur Accessoire","error");    </script>';
    }
}
?>
<!--protection de session -->
<?php
include '../../include/ProtectSession.php';
?>


