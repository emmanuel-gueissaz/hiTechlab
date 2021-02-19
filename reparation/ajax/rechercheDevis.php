
<?php

include '../../BDD/connexionBdd.php';


$data == '';
$test = '"';
if (isset($_POST['query'])) {
//   echo $_POST['query'];
    $statut = $_POST['query'];
    $categ = $_POST['categorie'];
    $modele = $_POST['modele'];
    $laRecherche = $_POST['laRecherche'];
    $marque = $_POST['marque'];
    $mat = $_POST['mat'];
    $limit = $_POST['page'];
    $offest = $limit - 30;
    $requete = "select reparation.id, modele.lib_modeele, reparation.numserie, reparation.daterestitution, reparation.heure, client.nom, client.prenom, max(a.id_statut) as statut  from reparation
left join a ON a.id = reparation.id
inner join client ON client.email = reparation.email
left join prend ON prend.id = reparation.id
left join forfait ON forfait.id_forfait = prend.id_forfait
left join modele ON modele.id_modele = reparation.id_modele
where (forfait.id_categ like '%$categ%' or forfait.id_categ is null)
and ((forfait.nom_forfait like '%$laRecherche%' or reparation.numserie like '%$laRecherche%')
and modele.id_marque $marque and id_mat $mat and modele.lib_modeele like '%$modele%')
group by reparation.id, modele.lib_modeele, reparation.numserie, reparation.daterestitution, reparation.heure, client.nom, client.prenom
having max(a.id_statut) $statut
    order by reparation.id desc
limit $limit OFFSET $offest;
";
    $requete = $conn->prepare($requete);
    $requete->execute();
    $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                 <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                 </svg>';
    while ($ligne = $requete->fetch()) {
        $id = $ligne['id'];
        $libModele = $ligne['lib_modeele'];
        $numeserie = $ligne['numserie'];
        $date = $ligne['daterestitution'];
        $nom = $ligne['nom'];
        $prenom = $ligne['prenom'];
        $id_statut = $ligne['statut'];
        $couleurDemande = 'laDemande';
        if ($id_statut == '2') {
            $couleurDemande = 'attAccepte';
        }
        if ($id_statut == '3') {
            $couleurDemande = 'Refuse';
        }
        if ($id_statut == '4') {
            $couleurDemande = 'accepte';
        }
        if ($id_statut == '5') {
            $couleurDemande = 'attPiece';
        }
        if ($id_statut == '6') {
            $couleurDemande = 'reparer';
        }
        if ($id_statut == '7') {
            $couleurDemande = 'facture';
        }

        $data .= "  <hr class='my-2' Style='border-top:1px solid black; ' />"
                . "<div class='$couleurDemande'><div class='labelDsDevis'> $id </div>"
                . "<div class='labelDsDevis'> $libModele </div>"
                . "<div class='labelDsDevis'> $numeserie </div>"
                . "<div class='labelDsDevis'> $date </div>"
                . "<div class='labelDsDevis'> $nom  $prenom </div>"
                . "<button class='btn btn-primary' onclick='document.location.href=$test /hitechlab/reparation/leDevis.php?id=$id&page=1 $test'>  "
                . "     <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
</svg>"
                . "</button>"
                . "<form method='POST' style='display:inline-block; margin-left:1%;'>"
                . "<button type='submit' name='suppDevis' value='$id' class='btn btn-danger'>"
                . "$icon"
                . "</button>"
                . "</form>"
                . "</div>";
    }
}
echo $data;



