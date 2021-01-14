<?php
include '../../BDD/connexionBdd.php';
?>

<head>

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">	
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <script src="../../include/alert.js" type="text/javascript"></script>
    <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
    <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>

    <link href="../../lib/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <link href="ajout.css" rel="stylesheet" type="text/css"/>




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
<div style="text-align: center">

    <form method="POST" class="leMotDePasse" id="leMotDePasse" style="margin-top: 2%;">
        <h4 class="titreAjout" > Nouveau forfait </h4> 
        <h4 class="labelAjout">catégorie: </h4> 
        <?php
        try {
            $requete = "select * from categorie";
            $requete = $conn->prepare($requete);
            $requete->execute();
            echo '<select name="categ" id="categ" class=" listeAjout btn btn-outline-primary btn-sm dropdown-toggle   ">';
            while ($ligne = $requete->fetch()) {
                $id = $ligne['id_categ'];
                $lib = $ligne['id_categ'];
                echo "<option value='$id'>$lib</option>";
            }
            echo ' </select>';
        } catch (Exception $ex) {
            
        }
        ?>

        <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterCategorie.php'"/>
        <h4 class="labelAjout">Piece : </h4> 
        <div class="form-check form-switch inputMdp">

            <input class="form-check-input plus" type="checkbox" name="afficheRecherchePiece" id="afficheRecherchePiece"  onclick="displayOn('afficheRecherchePiece', 'recherchePiece');"   /> 
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
            <h4 class="labelAjout">Pièce: </h4> <select id="lapiece" name="idpiece" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle" >

            </select>
            <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterPiece.php'"/>
        </div>

        <h4 class="labelAjout" > nom: </h4> 
        <input class=" inputMdp form-control" type="text"  name="nom" required=""/>
        <h4 class="labelAjout" > description : </h4> 
        <input class=" inputMdp form-control" type="text"  name="desc" />
        <h4 class="labelAjout" > tarif : </h4> 
        <input class=" inputMdp form-control" type="text"  name="tarif" required=""/>

        <input type="button"  class="btn btn-outline-danger btn-lg inputMdp" value="annuler" onclick="history.back()"/>
        <input type="submit" name="ajouterPiece" class="btn btn-outline-primary btn-lg inputMdp" value="ajouter" />

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


//modèle
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
if (isset($_POST['ajouterPiece'])) {
    $categorie = $_POST['categ'];
    $nom = $_POST['nom'];
    $desc = $_POST['desc'];
    $tarif = $_POST['tarif'];


    $piece = $_POST['afficheRecherchePiece'];
    if ($piece == 'on') {
        $idPiece = $_POST['idpiece'];
        try {
            $insert = "insert into forfait (id_piece,id_categ,nom_forfait,description_forfait,tarif) values($idPiece,'$categorie','$nom','$desc',$tarif);";
            $requete = $conn->prepare($insert);
            $requete->execute();
            echo '<script> alert_info("nouveau forfait ajouté","success");    setTimeout(function(){ history.go(-2); }, 1500); </script>';
        } catch (Exception $ex) {
            echo '<script> alert_info("erreur","error");</script>';
        }
    } else {

        try {
            $insert = "insert into forfait (id_categ,nom_forfait,description_forfait,tarif) values('$categorie','$nom','$desc',$tarif)";
            $requete = $conn->prepare($insert);
            $requete->execute();
            echo '<script> alert_info("nouveau forfait ajouté","success");    setTimeout(function(){ history.go(-2); }, 1500); </script>';
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



