<?php

include '../../BDD/connexionBdd.php';


$data = '';
$t = '"';


if (isset($_POST['query'])) {
    $type_accessoire = $_POST['query'];
    $couleur = $_POST['couleur'];
    $fournisseur = $_POST['fournisseur'];
    $mat = $_POST['mat'];
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $limit = $_POST['page'];
    $offset = $limit - 30;
    $idcli = $_POST['idcli'];
    $codebarre = $_POST['codebarre'];


    $requete = "select accessoire.id,accessoire.nom, modele.lib_modeele,accessoire.prixvente,accessoire.stock,accessoire.matiere, marque.nom as marque , type_accessoire.lib_type , accessoire.id_type  from accessoire 
inner join modele ON modele.id_modele = accessoire.id_modele
inner join marque ON marque.id_marque = modele.id_marque
inner join type_accessoire ON type_accessoire.id_type = accessoire.id_type
where accessoire.id_modele $modele and accessoire.id_type $type_accessoire
and id_couleur $couleur and  id_fournisseur $fournisseur and modele.id_marque $marque and modele.id_mat $mat
    and accessoire.codebar like '%$codebarre%'
LIMIT $limit OFFSET $offset";

    $requete = $conn->prepare($requete);
    $requete->execute();
    while ($lignes = $requete->fetch()) {
        $id = $lignes['id'];
        $nom = $lignes['nom'];
        $lib_modele = $lignes['lib_modeele'];
        $prixvente = $lignes['prixvente'];
        $stock = $lignes['stock'];
        $matiere = $lignes['matiere'];
        $marque = $lignes['marque'];
        $lib_type = $lignes['lib_type'];
        $id_type = $lignes['id_type'];
        $ajout = '  <button type="submit"  name="ajoutAccessoirePanier" class="btn btn-primary iconElement" value="' . $id . '"  >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>';
        $data .= " <hr class='my-2' Style='border-top:1px solid black; ' />"
                . "<div class='unAccessoire'>"
                . "<div class='blockImg' onclick='document.location.href=$t /hitechlab/boutique/update/updateAccessoire.php?id=$id $t'>"
                . "<img class='imageAccessoire' src='../image/$id.png'/>"
                . "</div>"
                . "<div class='infoAccessoire'>"
                . "<label class='titreInfoAccessoire' style=' cursor: pointer;' onclick='document.location.href=$t /hitechlab/boutique/update/updateAccessoire.php?id=$id $t'>$nom</label>"
                . "<div class='BtnAccessoire'><button class='lebtnaccesoire btn btn-primary'  value='=$id_type' onclick='$($t #type_accessoire$t).val(this.value); load_accessoire();'>$lib_type</button></div>"
                . "<label class='labelInfoAccessoire'>Stock : <span class='badge badge-secondary'> $stock</span></label>"
                . "<label class='labelInfoAccessoire'>Marque : <span class='badge badge-secondary'> $marque</span></label>"
                . "<label class='labelInfoAccessoire'>Modèle : <span class='badge badge-secondary'> $lib_modele</span></label>"
                . "<label class='labelInfoAccessoire'>Matière : <span class='badge badge-secondary'> $matiere</span></label>"
                . "</div>"
                . "<div class='prixAccesoire'>"
                . "<label class='titreInfoAccessoire'>$prixvente €</label>";
        if ($idcli != '') {
            $data .= "<form class='titreInfoAccessoire' method='POST'>$ajout</form>";
        }
        $data .= "</div>"
                . "</div>";
    }
    echo $data;
}
?>


