<?php
include '../../BDD/connexionBdd.php';


$data = '';


                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                 <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                 </svg>';
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
        $id = $ligne['id_modele'];
        $lib = $ligne['lib_modeele'];
        
    $data .= "  <hr class='my-2' Style='border-top:1px solid black; ' />"
                            . "<form method='POST'>"
                            . "<div class='element'> "
                            . "<div class='labelElement'> $lib </div>"
                            . "<button type='submit' class='btn btn-danger iconElement' value='$id' name='supp'> "
                            . "$icon"
                            . "</button>"
                            . "</div>"
                            . "</form>";
    }



}
echo $data;

?>




