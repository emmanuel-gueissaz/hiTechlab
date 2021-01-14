<?php
include '../../BDD/connexionBdd.php';
?>

<head>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="../../lib/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src="../../include/alert.js" type="text/javascript"></script>
    <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
    <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>

    <link href="../ajout/ajout.css" rel="stylesheet" type="text/css"/>



    <script>


        function displayOn(bouton, aAfficher) {
            var temp = document.getElementById(bouton).checked;
            if (temp == true) {
                document.getElementById(aAfficher).style.display = 'inline-block';


            } else {
                document.getElementById(aAfficher).style.display = 'none';

            }
        }


    </script>
</head>


<div style="text-align: center;">
    <form method="POST" class="leMotDePasse" id="leMotDePasse" style="margin-top: 8%;">
        <h4 class="titreAjout" > Modifier Forfait </h4> 

        <h4 class="labelAjout" > Nom: </h4> 
        <input class=" inputMdp form-control" type="text"  name="nom" id="nom" required=""/>
        <h4 class="labelAjout" > description: </h4> 
        <input class=" inputMdp form-control" type="text"  name="desc" id="desc" required=""/>
        <h4 class="labelAjout" > tarif : </h4> 
        <input class=" inputMdp form-control" type="number"  name="tarif" id="tarif" required=""/>
  <h4 class="labelAjout">Piece : </h4>
        <div class="form-check form-switch inputMdp ">
          
            <input class="form-check-input" type="checkbox" id="affichePiece" name="affichePiece" onclick="displayOn('affichePiece', 'recherchePiece');"   > 
        </div>

        <div class="recherchePiece" id="recherchePiece">
            <h4 class="labelAjout">Type de matériel: </h4> 
            <?php
            try {
                $requete = "select * from type_mat";
                $requete = $conn->prepare($requete);
                $requete->execute();
                echo '<select name="mat" id="mat" class=" listeAjout btn btn-outline-primary btn-sm dropdown-toggle   ">';
                while ($ligne = $requete->fetch()) {
                    $id = $ligne['id_mat'];
                    $lib = $ligne['lib_mat'];
                    echo "<option value='$id'>$lib</option>";
                }
                echo ' </select>';
            } catch (Exception $ex) {
                
            }
            ?>

            <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterTypeMat.php'"/>
            <h4 class="labelAjout">Marque: </h4> 



            <?php
            try {
                $requete = "select * from marque";
                $requete = $conn->prepare($requete);
                $requete->execute();
                echo '<select name="marque" id="marque" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle ">';
                while ($ligne = $requete->fetch()) {
                    $id = $ligne['id_marque'];
                    $lib = $ligne['nom'];
                    echo "<option value='$id'>$lib</option>";
                }
                echo ' </select>';
            } catch (Exception $ex) {
                
            }
            ?>

            <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterMarque.php'"/>




            <h4 class="labelAjout">Modèle: </h4> <select id="result" name="modele" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle" >

            </select>
            <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterModele.php'"/>
            <h4 class="labelAjout">Type pièce : </h4>

            <?php
            try {
                $requete = "select * from type_piece";
                $requete = $conn->prepare($requete);
                $requete->execute();
                echo '<select name="typePiece" id="typePiece" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle ">';
                while ($ligne = $requete->fetch()) {
                    $id = $ligne['id_categ'];
                    $lib = $ligne['lib_categ'];
                    echo "<option value='$id'>$lib</option>";
                }
                echo ' </select>';
            } catch (Exception $ex) {
                
            }
            ?>

            <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterTypePiece.php'"/>
            <h4 class="labelAjout">Pièce: </h4> <select id="lapiece" name="lapiece" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle" >

            </select>
            <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterPiece.php'"/>
        </div>

        <input type="button"  class="btn btn-outline-danger btn-lg inputMdp" value="Retour" onclick="history.back()"/>
        <input type="submit" name="modifierForfait" class="btn btn-outline-primary btn-lg inputMdp" value="Modifié" />

    </form>
</div>
<script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../lib/js/main.js" type="text/javascript"></script>
<script src="../../lib/js/popper.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<script>


            function load_data(mat, marque)
            {
                $.ajax({
                    url: "../../reparation/ajax/rechercheModele.php",
                    method: "post",
                    data: {query: mat, marque},
                    success: function (data)
                    {
                        $('#result').html(data);
                    }
                });
            }

            function load_piece(modele, type)
            {
                $.ajax({
                    url: "../ajax/recherchePiece.php",
                    method: "post",
                    data: {query: modele, type},
                    success: function (data)
                    {
                        $('#lapiece').html(data);
                    }
                });
            }

//piece
            $('#result').click(function () {


                var modele = $('#result').val();
                var type = $('#typePiece').val();
                load_piece(modele, type);
                ;
            });

            $('#typePiece').click(function () {


                var modele = $('#result').val();
                var type = $('#typePiece').val();
                load_piece(modele, type);

            });


            $('#marque').click(function () {


                var mat = $('#mat').val();
                var marque = $('#marque').val();
                load_data(mat, marque);
                ;
            });

            $('#mat').click(function () {


                var mat = $('#mat').val();
                var marque = $('#marque').val();
                load_data(mat, marque);
            });


            var mat = $('#mat').val();
            var marque = $('#marque').val();
            load_data(mat, marque);



</script>




<?php
$id = $_GET['id'];
$requete = "select * from forfait
left join piece ON piece.id_piece = forfait.id_piece
left join modele ON modele.id_modele = piece.id_modele
left join marque ON marque.id_marque = modele.id_marque
left join type_mat ON type_mat.id_mat = modele.id_mat
left join type_piece ON type_piece.id_categ = piece.id_categ
    where  id_forfait=$id";
$requete = $conn->prepare($requete);
$requete->execute();
$ligne = $requete->fetch();
$nom = $ligne['nom_forfait'];
$desc = $ligne['description_forfait'];
$tarif = $ligne['tarif'];
$piece = $ligne['id_piece'];
$typeMat = $ligne['id_mat'];
$marque = $ligne['id_marque'];
$modele = $ligne['id_modele'];
$typePiece = $ligne['id_categ'];




echo "<script>"
 . "$('#nom').val('$nom'),"
 . "$('#desc').val('$desc'),"
 . "$('#tarif').val('$tarif');"
 . "</script>";

echo $piece;
if ($piece != '') {
    echo "<script>"
    . "$('#affichePiece').click(),"
    . "$('#mat').val($typeMat),"
    . "$('#marque').val($marque);"
    . "      var mat = $('#mat').val();
                     var marque = $('#marque').val();
                     load_data(mat, marque);"
    . " setTimeout(function(){   $('#result').val('$modele'); }, 300);"
    . "$('#typePiece').val($typePiece);"
    . " setTimeout(function(){   $('#typePiece').click(); }, 300),"
    . "$('#lapiece').val($piece);"
    . "</script>";
}

if (isset($_POST['modifierForfait'])) {
    $id = $_GET['id'];
    $nom = $_POST['nom'];
    $desc = $_POST['desc'];
    $tarif = $_POST['tarif'];
    $piece = $_POST['affichePiece'];
    if ($piece == 'on') {
       $laPiece = $_POST['lapiece'];
         try {
            $update  = "UPDATE forfait set (nom_forfait, description_forfait, tarif, id_piece) = ('$nom','$desc',$tarif, $laPiece) where id_forfait = $id ";
            $requete = $conn->prepare($update);
            $requete->execute();
            echo '<script> alert_info("Forfait modifié","success");    setTimeout(function(){ history.go(-2); }, 1500); </script>';
        } catch (Exception $ex) {
            echo '<script> alert_info("erreur","error");</script>';
        }
        
    } else {
        try {
            $update  = "UPDATE forfait set (nom_forfait, description_forfait, tarif) = ('$nom','$desc',$tarif) where id_forfait = $id ";
            $requete = $conn->prepare($update);
            $requete->execute();
            echo '<script> alert_info("Forfait modifié","success");    setTimeout(function(){ history.go(-2); }, 1500); </script>';
        } catch (Exception $ex) {
            echo '<script> alert_info("erreur","error");</script>';
        }
    }
}
?>

<!--protection de session -->
<?php
include '../../include/ProtectSession.php';
?>



