<?php

include '../../BDD/connexionBdd.php';


$data = '';

if (isset($_POST['query'])) {
    $type_accessoire = $_POST['query'];
    $couleur = $_POST['couleur'];
    $fournisseur = $_POST['fournisseur'];
    $mat = $_POST['mat'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];



    $requete = "select  COALESCE(SUM(accessoire.prixachat*stock),0)as total  from accessoire  
inner join modele ON modele.id_modele = accessoire.id_modele
inner join marque ON marque.id_marque = modele.id_marque
inner join type_accessoire ON type_accessoire.id_type = accessoire.id_type
where accessoire.id_modele $modele and accessoire.id_type $type_accessoire
and id_couleur $couleur and  id_fournisseur $fournisseur and modele.id_marque $marque and modele.id_mat $mat";

    $requete = $conn->prepare($requete);
    $requete->execute();
    $ligne = $requete->fetch();
    $total = $ligne['total'];
    $total = number_format($total, 2);
    echo 'Total : ' . $total . ' €';
}
?>


