<link href="../client/client.css" rel="stylesheet" type="text/css"/>
<?php
include '../../BDD/connexionBdd.php';


$data = '';

if (isset($_POST['query'])) {
//   echo $_POST['query'];
    $mat = $_POST['query'];
    $marque = $_POST['marque'];
    $requete = "select id_modele,lib_modeele from modele
                where id_marque = $marque
                and id_mat = $mat ";
    $requete = $conn->prepare($requete);
    $requete->execute();
    $data .= '<option value="!=0">Tous</option>';
    while($ligne = $requete->fetch()){
        $id = $ligne['id_modele'];
        $lib = $ligne['lib_modeele'];
        
    $data .= "<option value='=$id'>"
            . "$lib"
            . "</option>";
    }
    




}
echo $data;



