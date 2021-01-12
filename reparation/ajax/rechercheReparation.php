<link href="../client/client.css" rel="stylesheet" type="text/css"/>
<?php

include '../../BDD/connexionBdd.php';




if (isset($_POST['query'])) {
    if ($_POST['query'] != '') {
        $data = '';
        $test = '"';
        $requete = "select * from only client where nom like '" . $_POST['query'] . "%' or prenom like '" . $_POST['query'] . "%' or tel like '" . $_POST['query'] . "%' ;";
        $requete = $conn->prepare($requete);
        $requete->execute();
        while ($ligne = $requete->fetch()) {
                $email = $ligne['email'];
            $nom = $ligne['nom'];
            $prenom = $ligne['prenom'];
            $tel = $ligne['tel'];
            $rue = $ligne['rue'];
            $Cpost = $ligne['cpost'];
            $ville = $ligne['ville'];
            $nomEnt = $ligne['nomentreprise'];
            
            $data .="<hr class='my-2' Style='border-top:1px solid black; ' />";
            
            if ($nomEnt != '') {
                $data .= "  <div class='leClient pro' onclick='document.location.href=$test /hitechlab/reparation/creerDevis.php?id=$email $test' >";
            } else {
                $data .= "  <div class='leClient' onclick='document.location.href=$test /hitechlab/reparation/creerDevis.php?id=$email $test'>";
            }

            $data .= "<div class='labelMoyen' >$nom</div>
                    <div class='labelMoyen'> $prenom</div>
                    <div class='labelMoyen noResponsive' >$tel</div>
                    <div class='labelLong noResponsive'>$email</div>
                    <div class='labelMoyen noResponsive'>$rue</div>
                    <div class='labelMoyen noResponsive'>$Cpost</div></div>
                "
                  
                    . "<hr class='my-2' Style='border-top:1px solid black; ' />";
            
        }

        echo($data);
    } else {
        echo 'saisire une lettre';
    }
}


