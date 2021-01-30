
<?php

include '../../BDD/connexionBdd.php';


$data = '';

$iconSupp = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                 <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                 </svg>';

$iconEdit = ' <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>';

if (isset($_POST['query'])) {
//   echo $_POST['query'];
    $modele = $_POST['query'];
    $type = $_POST['type'];
    $recherche = $_POST['recherche'];
    $marque = $_POST['marque'];
    $fourni = $_POST['fourni'];
    $mat = $_POST['mat'];
    $limit = $_POST['page'];
    $offest = $limit - 30;


    $requete = "select * from piece
                inner join modele ON modele.id_modele = piece.id_modele
                where (piece.id_modele  $modele and id_mat = $mat
                and id_categ $type and modele.id_marque = $marque and id_fournisseur $fourni)and (ref like('%$recherche%') or prixachat::text  like '%$recherche%') or code_bar = '$recherche' limit $limit offset $offest;";
    $requete = $conn->prepare($requete);
    $requete->execute();

    while ($ligne = $requete->fetch()) {
        $id = $ligne['id_piece'];
        $lib = $ligne['nom_piece'];
        $prix = $ligne['prixachat'];
        $stock = $ligne['stock'];
        $total = $prix * $stock;

        $data .= "  <hr class='my-2' Style='border-top:1px solid black; ' />"
                . "<div class='element'> "
                . "<div class='labelPiece'> $lib </div>"
                . "<div class='labelPiece'> $prix €</div>"
                . "<div class='labelPiece noResponsive'> $stock </div>"
                . "<div class='labelPiece noResponsive'> $total €</div>"
                . "<form method='POST' class='iconElement'>"
                . "<button type='submit' class='btn btn-primary iconElement' value='$id' name='modif'> "
                . "$iconEdit"
                . "</button>"
                . "</form>"
                . "<form method='POST' class='iconElement'>"
                . "<button type='submit' class='btn btn-danger iconElement' value='$id' name='supp' > "
                . "$iconSupp"
                . "</button>"
                . "</div>"
                . "</form>";
    }
}
echo $data;



