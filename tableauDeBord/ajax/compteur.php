
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php

include '../../BDD/connexionBdd.php';

$requete = "select * from nombredevstatut()";
$requete = $conn->prepare($requete);
$requete->execute();
$ligne = $requete->fetch();
$demande = $ligne['demande'];
$attent = $ligne['attent'];
$accepte = $ligne['accepte'];
$attentp = $ligne['attentp'];
$repare = $ligne['repare'];
$facturer = $ligne['facturer'];

echo $demande . ','  .$attent. ','  .$accepte. ','  .$attentp . ','.$repare  ;

?>

