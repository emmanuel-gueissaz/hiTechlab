<?php
    include '../../BDD/connexionBdd.php';



if (isset($_POST['query'])) {
//   echo $_POST['query'];
    $modele = $_POST['query'];
    $type = $_POST['type'];
    $recherche = $_POST['recherche'];
    $marque = $_POST['marque'];
    $fourni = $_POST['fourni'];
    $mat = $_POST['mat'];
    
     $requete = "select sum(prixachat * stock) as total from piece
                inner join modele ON modele.id_modele = piece.id_modele
                where (piece.id_modele  $modele and id_mat = $mat
                and id_categ $type and modele.id_marque = $marque and id_fournisseur $fourni)and (ref like('%$recherche%') or prixachat::text  like '%$recherche%') or code_bar = '$recherche'";
    $requete = $conn->prepare($requete);
    $requete->execute();
    $ligne = $requete -> fetch();
    $total = $ligne['total'];
    $total = number_format($total,2);
    echo 'Total : ' . $total . ' €';

    
}