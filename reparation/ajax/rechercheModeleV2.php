<link href="../client/client.css" rel="stylesheet" type="text/css"/>
<?php
include '../../BDD/connexionBdd.php';


$data == '';

if (isset($_POST['query'])) {
//   echo $_POST['query'];
    $mat = $_POST['query'];
    $marque = $_POST['marque'];
    $requete = "select id_modele,lib_modeele from modele
                where id_marque = $marque
                and id_mat = $mat ";
    $requete = $conn->prepare($requete);
    $requete->execute();

    while($ligne = $requete->fetch()){
        $id = $ligne['lib_modeele'];
        $lib = $ligne['lib_modeele'];
        
    $data .= "<option value='$id'>"
            . "$lib"
            . "</option>";
    }
      $data .= "<option value=''>"
            . "Tous"
            . "</option>";
    



}
echo $data;



