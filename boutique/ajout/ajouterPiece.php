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


<div style="text-align: center;">
    <form method="POST" class="leMotDePasse" id="leMotDePasse" style="margin-top: 1%;">
        <h4 class="titreAjout" > Nouvelle pièce </h4> 
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

           <h4 class="labelAjout">type de pièce: </h4>
               <?php
        try {
            $requete = "select * from type_piece";
            $requete = $conn->prepare($requete);
            $requete->execute();
            echo '<select name="typepiece" id="piece" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle ">';
            while ($ligne = $requete->fetch()) {
                $id = $ligne['id_categ'];
                $lib = $ligne['lib_categ'];
                echo "<option value='$id'>$lib</option>";
            }
            echo ' </select>';
        } catch (Exception $ex) {
            
        }
        ?>
            <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterTypePiece.php'"/> 
           
        <h4 class="labelAjout" > Nom: </h4> 
        <input class=" inputMdp form-control" type="text"  name="nom" required=""/>
        <h4 class="labelAjout" > Référence: </h4> 
        <input class=" inputMdp form-control" type="text"  name="ref" required=""/>
        <h4 class="labelAjout" > Prix: </h4> 
        <input class=" inputMdp form-control" type="text"  name="prix" required=""/>
        <h4 class="labelAjout" > Stock: </h4> 
        <input class=" inputMdp form-control" type="text"  name="stock" required=""/>

        <input type="button"  class="btn btn-outline-danger btn-lg inputMdp" value="annuler" onclick="history.back()"/>
        <input type="submit" name="ajouterPiece" class="btn btn-outline-primary btn-lg inputMdp" value="ajouter" />

    </form>
</div>
<script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../lib/js/main.js" type="text/javascript"></script>
<script src="../lib/js/popper.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>

//transforme le rapport en une array boulean pour postgretSql



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
if (isset($_POST['ajouterPiece'])) {
    $modele = $_POST['modele'];
    $typePiece = $_POST['typepiece'];
    $nom = $_POST['nom'];
    $ref = $_POST['ref'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    try {
       $insert = "insert into piece (id_categ, id_modele, nom_piece, ref, prixachat, stock) values ($typePiece,$modele,'$nom','$ref',$prix,$stock);";
        $requete = $conn->prepare($insert);
        $requete->execute();
        echo '<script> alert_info("Pièce ajouté","success");    setTimeout(function(){ history.go(-2); }, 1500); </script>';
    } catch (Exception $ex) {
        echo '<script> alert_info("erreur","error");</script>';
    }
}
?>

<!--protection de session -->
<?php
include '../../include/ProtectSession.php';
?>



