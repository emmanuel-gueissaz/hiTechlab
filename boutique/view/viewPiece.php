


<!doctype html>

<?php
include '../../BDD/connexionBdd.php';
?>
<html lang="fr">
    <head>
        <title>Accueil</title>  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">	
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="../../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../../lib/css/styleMenu.css" rel="stylesheet" type="text/css"/>

        <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../../include/alert.js" type="text/javascript"></script>

        <link href="view.css" rel="stylesheet" type="text/css"/>

        <script>


            function page(leBouton) {

                let searchParams = new URLSearchParams(window.location.search);
                searchParams.has('page');
                let nPage = searchParams.get('page');
                if (nPage == '') {
                    nPage = 1;
                }
                let temp = leBouton.value;
                if (temp == '-') {
                    nPage--;
                } else {
                    nPage++;
                }
                if (nPage <= 0) {
                    nPage = 1;
                }
                const url = new URL(window.location);
                url.searchParams.set('page', nPage);
                window.history.pushState({}, '', url);

                var modele = $('#lesModeles').val();
                var type = $('#typePiece').val();
                var recherche = $('#larecherche').val();
                var marque = $('#marque').val();
                var fourni = $('#fourni').val();
                var mat = $('#mat').val();
                load_piece(modele, type, recherche, marque, fourni, mat);



            }
        </script>
    </head>
    <body>

        <div class="wrapper d-flex align-items-stretch">
            <?php include '../../include/Sidebar.php'; ?>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <?php include '../../include/MenuTop.php'; ?>
                <input type="button" class="btn btn-outline-secondary" value="retour" onclick="document.location.href = '/hitechlab/boutique/lesAjouts.php'"/>
                <div style="text-align: center">



                    <div class="cadreView">
                        <div class="titreView">
                            <h5 class="lableTitreView">
                                Les Pièces :
                            </h5>
                            <button class="btn btn-primary iconElement" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterPiece.php'"  >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>

                        </div>

                        <div class="titreView">
                            <h4 class="labelRecherche">Type de matériel: </h4> 


                            <?php
                            try {
                                $requete = "select * from type_mat";
                                $requete = $conn->prepare($requete);
                                $requete->execute();
                                echo '<select name="mat" id="mat" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle">';
                                while ($ligne = $requete->fetch()) {
                                    $id = $ligne['id_mat'];
                                    $lib = $ligne['lib_mat'];
                                    echo "<option value='$id'>$lib</option>";
                                }
                                echo ' </select>';
                            } catch (Exception $ex) {
                                
                            }
                            ?>


                            <h4 class="labelRecherche">Marque: </h4> 



                            <?php
                            try {
                                $requete = "select * from marque";
                                $requete = $conn->prepare($requete);
                                $requete->execute();
                                echo '<select name="marque" id="marque" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle">';
                                while ($ligne = $requete->fetch()) {
                                    $id = $ligne['id_marque'];
                                    $lib = $ligne['nom'];
                                    echo "<option value='$id'>$lib</option>";
                                }
                                echo ' </select>';
                            } catch (Exception $ex) {
                                
                            }
                            ?>




                        </div>


                        <h4 class="labelRecherche" >Modèles: </h4> 
                        <select id="lesModeles"  class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle">


                        </select>


                        <h4 class="labelRecherche">Type de matériel: </h4> 
                        <?php
                        try {
                            $requete = "select * from type_piece";
                            $requete = $conn->prepare($requete);
                            $requete->execute();
                            echo '<select name="typePiece" id="typePiece" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle ">';
                            echo"<option value='!=0'>Tous</option>";
                            while ($ligne = $requete->fetch()) {
                                $id = $ligne['id_categ'];
                                $lib = $ligne['lib_categ'];
                                echo "<option value='=$id'>$lib</option>";
                            }

                            echo ' </select>';
                        } catch (Exception $ex) {
                            
                        }
                        ?>
                        <h4 class="labelRecherche">Fournisseur: </h4> 
                        <?php
                        try {
                            $requete = "select * from fournisseur";
                            $requete = $conn->prepare($requete);
                            $requete->execute();
                            echo '<select name="fourni" id="fourni" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle ">';
                            echo"<option value='!=0'>Tous</option>";
                            while ($ligne = $requete->fetch()) {
                                $id = $ligne['id_fournisseur'];
                                $lib = $ligne['lib_fournisseur'];
                                echo "<option value='=$id'>$lib</option>";
                            }

                            echo ' </select>';
                        } catch (Exception $ex) {
                            
                        }
                        ?>
                        <h4 class="labelRecherche">Recherche : </h4> 
                        <div class="selectRecheche">
                            <input type="text" id="larecherche" class="form-control"/>
                        </div>

                        <div >
                            <div class="titrePiece" style="margin-left: 10%;">Nom </div>
                            <div class="titrePiece">Prix unitaire</div>
                            <div class="titrePiece noResponsive">Stock </div>
                            <div class="titrePiece noResponsive">Total </div>

                        </div>
                        <div id="lesPieces">

                        </div>
                        <div>
                            <button value="-" id="moins" onclick="page(this)" class="btn btn-primary mb-3 mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
                                </svg>
                                Précédent
                            </button>
                            <button value="+" onclick="page(this)" class="btn btn-primary mb-3 mt-3">                                
                                Suivant
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </button>


                        </div>
                    </div>

                    <div  class="totalPiece" id="leTotal">
                        Total : 0 €
                    </div>
                </div>
            </div>
        </div>


        <!-- fin de la page -->

        <!-- mes script js-->



        <!-- libscript js -->

        <script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../../lib/js/main.js" type="text/javascript"></script>
        <script src="../../lib/js/popper.js" type="text/javascript"></script>

        <script>

                                function load_data(mat, marque)
                                {
                                    $.ajax({
                                        url: "../ajax/rechercheModele.php",
                                        method: "post",
                                        data: {query: mat, marque},
                                        success: function (data)
                                        {
                                            $('#lesModeles').html(data);
                                        }
                                    });
                                }


                                function load_piece(modele, type, recherche, marque, fourni, mat)
                                {
                                    let searchParams = new URLSearchParams(window.location.search);
                                    searchParams.has('page');
                                    let nPage = searchParams.get('page');
                                    var page = nPage * 30;
                                    $.ajax({
                                        url: "../ajax/viewRecherchePiece.php",
                                        method: "post",
                                        data: {query: modele, type, recherche, marque, fourni, page, mat},
                                        success: function (data)
                                        {
                                            $('#lesPieces').html(data);
                                        }
                                    });
                                    load_total(modele, type, recherche, marque, fourni, mat);
                                }
                                function load_total(modele, type, recherche, marque, fourni, mat)
                                {
                                    let searchParams = new URLSearchParams(window.location.search);
                                    searchParams.has('page');
                                    let nPage = searchParams.get('page');
                                    var page = nPage * 30;
                                    $.ajax({
                                        url: "../ajax/viewRechercheValeurTotal.php",
                                        method: "post",
                                        data: {query: modele, type, recherche, marque, fourni, page, mat},
                                        success: function (data)
                                        {
                                            $('#leTotal').html(data);
                                        }
                                    });
                                }


                                $('#lesModeles').click(function () {


                                    var modele = $('#lesModeles').val();
                                    var type = $('#typePiece').val();
                                    var recherche = $('#larecherche').val();
                                    var marque = $('#marque').val();
                                    var fourni = $('#fourni').val();
                                    var mat = $('#mat').val();
                                    load_piece(modele, type, recherche, marque, fourni, mat);

                                });

                                $('#typePiece').click(function () {


                                    var modele = $('#lesModeles').val();
                                    var type = $('#typePiece').val();
                                    var recherche = $('#larecherche').val();
                                    var marque = $('#marque').val();
                                    var fourni = $('#fourni').val();
                                    var mat = $('#mat').val();
                                    load_piece(modele, type, recherche, marque, fourni, mat);

                                });

                                $('#fourni').click(function () {


                                    var modele = $('#lesModeles').val();
                                    var type = $('#typePiece').val();
                                    var recherche = $('#larecherche').val();
                                    var marque = $('#marque').val();
                                    var fourni = $('#fourni').val();
                                    var mat = $('#mat').val();
                                    load_piece(modele, type, recherche, marque, fourni, mat);

                                });


                                $('#marque').click(function () {


                                    var mat = $('#mat').val();
                                    var marque = $('#marque').val();
                                    load_data(mat, marque);

                                    var modele = $('#lesModeles').val();
                                    var type = $('#typePiece').val();
                                    var recherche = $('#larecherche').val();
                                    var marque = $('#marque').val();
                                    var fourni = $('#fourni').val();
                                    load_piece(modele, type, recherche, marque, fourni, mat);
                                });

                                $('#mat').click(function () {


                                    var mat = $('#mat').val();
                                    var marque = $('#marque').val();
                                    load_data(mat, marque);


                                    var modele = $('#lesModeles').val();
                                    var type = $('#typePiece').val();
                                    var recherche = $('#larecherche').val();
                                    var marque = $('#marque').val();
                                    var fourni = $('#fourni').val();
                                    load_piece(modele, type, recherche, marque, fourni, mat);
                                });

                                $('#larecherche').keyup(function () {
                                    var modele = $('#lesModeles').val();
                                    var type = $('#typePiece').val();
                                    var recherche = $('#larecherche').val();
                                    var marque = $('#marque').val();
                                    var fourni = $('#fourni').val();
                                    var mat = $('#mat').val();
                                    load_piece(modele, type, recherche, marque, fourni, mat);
                                });



                                var mat = $('#mat').val();
                                var marque = $('#marque').val();
                                load_data(mat, marque);

                               setTimeout("$('#lesModeles').click()", 500); 


        </script>


        <?php
        if (isset($_POST['supp'])) {
            $id = $_POST['supp'];

            try {
                $requete = "delete from piece where id_piece = $id ;";
                $requete = $conn->prepare($requete);
                $requete->execute();
                echo '<script> alert_info("La pièce à été supprimé","success");</script>';
            } catch (Exception $ex) {
                echo '<script> alert_info("La pièce ne peut être supprimé","error");</script>';
            }
        }



        if (isset($_POST['modif'])) {
            $id = $_POST['modif'];
            echo "<script>"
            . "document.location.href='/hitechlab/boutique/update/updatePiece.php?id=$id'"
            . "</script>";
        }
        ?>



        <?php
        include '../../include/ProtectSession.php';
        ?>


    </body>
</html>







