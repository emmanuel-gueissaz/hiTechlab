<?php

include '../../BDD/connexionBdd.php';
$test = '"';
if (isset($_POST['query'])) {
    $data = '';
    $statut = $_POST['query'];
    
    
      $requete = "select reparation.id, modele.lib_modeele, reparation.numserie, reparation.daterestitution, reparation.heure, client.nom, client.prenom, max(a.id_statut) as statut, nbref(reparation.id_modele)   from reparation
                                            left join a ON a.id = reparation.id
                                            inner join client ON client.email = reparation.email
                                            left join modele ON modele.id_modele = reparation.id_modele
                                            group by reparation.id, modele.lib_modeele, reparation.numserie, reparation.daterestitution, reparation.heure, client.nom, client.prenom
                                            having max(a.id_statut) = $statut 
                                            order by reparation.id desc 
                                            limit 30;";

    $requete = $conn->prepare($requete);
    $requete->execute();
    while ($ligne = $requete->fetch()) {
        $id = $ligne['id'];
        $libModele = $ligne['lib_modeele'];
        $numeserie = $ligne['numserie'];
        $date = $ligne['daterestitution'];
        $nom = $ligne['nom'];
        $prenom = $ligne['prenom'];
        $id_statut = $ligne['statut'];
        $nbref = $ligne['nbref'];
        $couleurDemande = 'laDemande';
        if ($date < date('Y-m-d')) {
            $couleurDemande = 'Refuse';
        }



        $data .= "  <hr class='my-2' Style='border-top:1px solid black; ' />"
        . "<div class='$couleurDemande'><div class='labelDsDevis'> $id </div>"
        . "<div class='labelDsDevis'> $libModele  <span class='badge badge-primary'>$nbref</span></div>"
        . "<div class='labelDsDevis'> $numeserie </div>"
        . "<div class='labelDsDevis'> $date </div>"
        . "<div class='labelDsDevis'> $nom  $prenom </div>"
        . "<button class='btn btn-primary' value='$id' onclick='document.location.href=$test /hitechlab/reparation/leDevis.php?id=$test + this.value + $test&page=1 $test'>  "
        . "     <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
                                    <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
                                    <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
                                    </svg>"
        . "</button>"
        . "</div>";
    }
 echo $data;
}
?>

