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
    <form method="POST" class="leMotDePasse" id="leMotDePasse">
        <h4 class="titreAjout" > Nouveau modèle </h4> 
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
        <h4 class="labelAjout">marque: </h4> 



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


        <h4 class="labelAjout" > nom: </h4> 
        <input class="inputMdp form-control" type="text"  name="leMod" required=""/><br>

        <input type="button"  class="btn btn-outline-danger btn-lg inputMdp" value="annuler" onclick="history.back()"/>
        <input type="submit" name="ajouterMod" class="btn btn-outline-primary btn-lg inputMdp" value="ajouter" />

    </form>
</div>


<?php
if (isset($_POST['ajouterMod'])) {
    $typeMat = $_POST['mat'];
    $marque = $_POST['marque'];
    $nom = $_POST['leMod'];

    try {
        $insert = "insert into modele (lib_modeele,id_marque,id_mat) values ('$nom',$marque,$typeMat)";
        $requete = $conn->prepare($insert);
        $requete->execute();
        echo '<script> alert_info("type matériel ajouté","success");    setTimeout(function(){ history.go(-2); }, 1500); </script>';
    } catch (Exception $ex) {
        echo '<script> alert_info("erreur","error");</script>';
    }
}
?>

     <!--protection de session -->
            <?php 
            include '../../include/ProtectSession.php';
?>



