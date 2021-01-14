<?php
include '../../BDD/connexionBdd.php';
?>

<head>
    <link href="../../lib/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="../../include/alert.js" type="text/javascript"></script>
    <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
    <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>

    <link href="../ajout/ajout.css" rel="stylesheet" type="text/css"/>
</head>


<div style="text-align: center;">
    <form method="POST" class="leMotDePasse" id="leMotDePasse" style="margin-top: 8%;">
        <h4 class="titreAjout" > Modifier pièce </h4> 
    
        <h4 class="labelAjout" > Nom: </h4> 
        <input class=" inputMdp form-control" type="text"  name="nom" id="nom" required=""/>
        <h4 class="labelAjout" > Référence: </h4> 
        <input class=" inputMdp form-control" type="text"  name="ref" id="ref" required=""/>
        <h4 class="labelAjout" > Prix: </h4> 
        <input class=" inputMdp form-control" type="text"  name="prix" id="prix" required=""/>
        <h4 class="labelAjout" > Stock: </h4> 
        <input class=" inputMdp form-control" type="text"  name="stock" id="stock" required=""/>

        <input type="button"  class="btn btn-outline-danger btn-lg inputMdp" value="Retour" onclick="history.back()"/>
        <input type="submit" name="modifierPiece" class="btn btn-outline-primary btn-lg inputMdp" value="Modifié" />

    </form>
</div>
<script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../lib/js/main.js" type="text/javascript"></script>
<script src="../lib/js/popper.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>




<?php
$id = $_GET['id'];
$requete = "select * from piece where id_piece=$id";
$requete = $conn -> prepare($requete);
$requete -> execute();
$ligne = $requete -> fetch();
$nom = $ligne['nom_piece'];
$ref = $ligne['ref'];
$prix = $ligne['prixachat'];
$stock = $ligne['stock'];

echo "<script>"
. "$('#nom').val('$nom'),"
. "$('#ref').val('$ref'),"
. "$('#prix').val('$prix'),"
. "$('#stock').val('$stock');"
        . "</script>";



if (isset($_POST['modifierPiece'])) {
    $id = $_GET['id'];
    $nom = $_POST['nom'];
    $ref = $_POST['ref'];
    $prix = $_POST['prix'];
    $stock = $_POST['stock'];

    try {
       $update  = "update piece set (nom_piece,ref,prixachat,stock) = ('$nom','$ref',$prix,$stock) where id_piece = $id";
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



