<?php
include '../../BDD/connexionBdd.php';
?>

<head>
    <link href="../../lib/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="../../include/alert.js" type="text/javascript"></script>
    <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
    <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>
    
  
    <link href="ajout.css" rel="stylesheet" type="text/css"/>
</head>


<div style="text-align: center;">
    <form method="POST" class="leMotDePasse" id="leMotDePasse">
        
        <h4 class="titreAjout" > Nouvelle marque </h4> 
        <h4 class="labelAjout" > Nom: </h4> 
        <input class=" inputMdp form-control" type="password"  name="lamarque" required=""/><br>
       
        <input type="button"  class="btn btn-outline-danger btn-lg inputMdp" value="annuler" onclick="history.back()"/>
        <input type="submit" name="ajouterMarque" class="btn btn-outline-primary btn-lg inputMdp" value="ajouter" />

    </form>
</div>


<?php 

if(isset($_POST['ajouterMarque'])){
    $nom = $_POST['lamarque'];
    
    try {
    $insert = "insert into marque (nom) values ('$nom')";
    $requete = $conn -> prepare($insert);
    $requete -> execute();
     echo '<script> alert_info("Marque ajouté","success");    setTimeout(function(){ history.go(-2); }, 1500); </script>';
    } catch (Exception $ex) {
        echo '<script> alert_info("erreur","error");</script>';
    }
   
}



?>
     <!--protection de session -->
            <?php 
            include '../../include/ProtectSession.php';
?>


