<?php

include '../../BDD/connexionBdd.php';
session_start();
$test = '"';

$t = "'";
if (isset($_POST['query'])) {
   
    $condition = $_POST['query'];
    $limit = $_POST['page'];
    $offset = $limit - 30;
    $email = $_SESSION['email'];
    
    $requete = "select r.id, modele.lib_modeele, r.numserie, r.daterestitution, client.nom, client.prenom, max(id_statut) as statut,
    (select array(select array[forfait.nom_forfait, piece.ref, piece.stock::varchar,piece.id_piece::varchar] 
    from prend pr inner join forfait ON forfait.id_forfait = pr.id_forfait left join piece ON piece.id_piece = forfait.id_piece where pr.id = r.id   
    )) from reparation r
    inner join a ON a.id = r.id
    inner join client ON client.email = r.email
    inner join modele ON modele.id_modele = r.id_modele
    where r.email_technicien = '$email' and r.daterestitution::date $condition current_date 
    group by r.id, modele.lib_modeele, r.numserie, r.daterestitution, client.nom, client.prenom
    having max(a.id_statut) between 4 and 5
    order by r.daterestitution 
    Limit $limit offset $offset";
  
    $requete = $conn->prepare($requete);
    $requete->execute();


    while ($ligne = $requete->fetch()) {
        $compteur ++;
        $id = $ligne['id'];
        $libModele = $ligne['lib_modeele'];
        $numeserie = $ligne['numserie'];
        $date = date('d-m-y', strtotime($ligne['daterestitution']));
        $nom = $ligne['nom'];
        $prenom = $ligne['prenom'];
        $id_statut = $ligne['statut'];
        $couleurDemande = 'laDemande';


        if (date('d-m-y', $date) < date('d-m-y')) {
            $couleurDemande = 'Refuse';
        }

        if ($id_statut == 5) {
            $couleurDemande = 'attAccepte';
        }

        $temp = $ligne['array'];
        $replace = array('{', '}', '"');
        $temp = str_replace($replace, '', $temp, $final);
        $temp = str_replace('NULL', '-', $temp, $final);

        $temp = explode(',', $temp);



        $data .= "  <hr class='my-2' Style='border-top:1px solid black; ' />"
        . "<div class='$couleurDemande'><div class='labelDsDevis'> $id </div>"
        . "<div class='labelDsDevis'> $libModele </div>"
        . "<div class='labelDsDevis'> $numeserie </div>"
        . "<div class='labelDsDevis'> $date </div>"
        . "<div class='labelDsDevis'> $nom  $prenom </div>"
        . "<button class='btn btn-primary' value='$id' onclick='document.location.href=$test /hitechlab/reparation/leDevis.php?id=$test + this.value'>  "
        . "     <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                    <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                    <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                    </svg>"
        . "</button><div class='lesStockLine'>";
        for ($index = 0; $index < count($temp); $index = $index + 4) {
            $data .= "<span class='badge bg-secondary compteurPiece' onclick='document.location.href=$test/hitechlab/boutique/update/updatePiece.php?id=" . $temp[$index + 3] . "$test'>" . $temp[$index + 2] . "</span>";
        }
        $data .= '</div>';
        $data .="</div>"
        . '<div class="laReparation slideBar" onclick="affichePiece(this);">'
        . '<button class="btn btn-light boutonPlus"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
  <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg></button>'
        . "<div class='infoPieceDevis' >";

        $data .= "<div class='labelPiece' style='color: gray'>Nom Forfait </div>";
        $data .= "<div class='labelPiece' style='color:gray'> Références </div>";
        $data .= "<div class='labelPiece' style='color:gray'> stock </div><br>";


        for ($index = 0; $index < count($temp); $index = $index + 4) {
            $data .= "  <hr class='my-2' Style='border-top:1px solid black; ' />";
            $data .= "<div class='labelPiece'>" . $temp[$index] . " </div>";
            $data .= "<div class='labelPiece'>" . $temp[$index + 1] . " </div>";
            $data .= "<div class='labelPiece'>" . $temp[$index + 2] . " </div><br>";
        }
        $data .= "</div></div>"
        ;
    }
    echo $data;
}
?>