
<?php
include '../../BDD/connexionBdd.php';


$data == '';

if (isset($_POST['query'])) {
//   echo $_POST['query'];
    $modele = $_POST['query'];
    $type = $_POST['type'];
  
   
    $requete = "select * from piece
                where id_modele=$modele 
                and id_categ=$type";
    $requete = $conn->prepare($requete);
    $requete->execute();

    while($ligne = $requete->fetch()){
        $id = $ligne['id_piece'];
        $lib = $ligne['nom_piece'];

        
    $data .= "<option value='$id'>"
            . "$lib"
            . "</option>";
    }



}
echo $data;



