


<!doctype html>

<?php
include '../../BDD/connexionBdd.php';
?>
<html lang="fr">
    <head>
        <title>HI-TECH LAB</title>  
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

                load_accessoire();

            }
        </script>
    </head>
    <body>

        <div class="wrapper d-flex align-items-stretch">
            <?php include '../../include/Sidebar.php'; ?>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <?php include '../../include/MenuTop.php'; ?>

                <?php
                $t = '"';
                $retour = $_GET['type'];
                $id = $_GET['id'];
                if ($retour == 'achat') {
                    echo " <input type='button' class='btn btn-outline-secondary' value='retour' onclick='document.location.href = $t/hitechlab/achat/achat.php?id=$id $t'/>";
                }
                if ($retour == 'reparation') {
                    echo " <input type='button' class='btn btn-outline-secondary' value='retour' onclick='document.location.href = $t/hitechlab/reparation/ledevis.php?id=$id $t'/>";
                }
                if ($retour == '') {
                    echo " <input type='button' class='btn btn-outline-secondary' value='retour' onclick='document.location.href = $t/hitechlab/boutique/lesAjouts.php$t'/>";
                }
                ?>

                <div style="text-align: center">

                    <div class="cadreAccessoire">
                        <div class="titreView">
                            <h5 class="lableTitreView">
                                Les Accessoires :
                            </h5>
                            <button class="btn btn-primary iconElement" onclick="document.location.href = '/hitechlab/boutique/ajout/ajoutAccessoire.php'"  >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>
                        </div>



                        <div class="titreView">
                            <h4 class="labelRecherche" > Type d'accessoire : </h4> 
                            <?php
                            try {
                                $requete = "select * from type_accessoire";
                                $requete = $conn->prepare($requete);
                                $requete->execute();
                                echo '<select name="type_accessoire" id="type_accessoire" class=" selectRecheche btn btn-outline-primary btn-sm dropdown-toggle   ">';
                                echo "<option value='!=0'>Tous</option>";
                                while ($ligne = $requete->fetch()) {
                                    $id = $ligne['id_type'];
                                    $lib = $ligne['lib_type'];
                                    echo "<option value='=$id'>$lib</option>";
                                }
                                echo ' </select>';
                            } catch (Exception $ex) {
                                
                            }
                            ?>

                            <h4 class="labelRecherche" > Couleur : </h4> 
                            <?php
                            try {
                                $requete = "select * from couleur";
                                $requete = $conn->prepare($requete);
                                $requete->execute();
                                echo '<select name="couleur" id="couleur" class=" selectRecheche btn btn-outline-primary btn-sm dropdown-toggle   ">';
                                echo "<option value='!=0'>Tous</option>";
                                while ($ligne = $requete->fetch()) {
                                    $id = $ligne['id_couleur'];
                                    $lib = $ligne['lib_couleur'];
                                    echo "<option value='=$id'>$lib</option>";
                                }
                                echo ' </select>';
                            } catch (Exception $ex) {
                                
                            }
                            ?>


                            <h4 class="labelRecherche" > Fournisseur : </h4> 
                            <?php
                            try {
                                $requete = "select * from fournisseur";
                                $requete = $conn->prepare($requete);
                                $requete->execute();
                                echo '<select name="fournisseur" id="fournisseur" class=" selectRecheche btn btn-outline-primary btn-sm dropdown-toggle   ">';
                                echo "<option value='!=0'>Tous</option>";
                                while ($ligne = $requete->fetch()) {
                                    $id = $ligne['id_fournisseur'];
                                    $lib = $ligne['lib_fournisseur'];
                                    echo "<option value='=$id'>$lib</option>";
                                }
                                echo ' </select>';
                            } catch (Exception $ex) {
                                
                            }
                            ?>

                            <h4 class="labelRecherche">Type de matériel: </h4> 
                            <?php
                            try {
                                $requete = "select * from type_mat";
                                $requete = $conn->prepare($requete);
                                $requete->execute();
                                echo '<select name="mat" id="mat" class=" selectRecheche btn btn-outline-primary btn-sm dropdown-toggle   ">';
                                echo "<option value='!=0'>Tous</option>";
                                while ($ligne = $requete->fetch()) {
                                    $id = $ligne['id_mat'];
                                    $lib = $ligne['lib_mat'];
                                    echo "<option value='=$id'>$lib</option>";
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
                                echo '<select name="marque" id="marque" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle ">';
                                echo "<option value='!=0'>Tous</option>";
                                while ($ligne = $requete->fetch()) {
                                    $id = $ligne['id_marque'];
                                    $lib = $ligne['nom'];
                                    echo "<option value='=$id'>$lib</option>";
                                }
                                echo ' </select>';
                            } catch (Exception $ex) {
                                
                            }
                            ?>




                            <h4 class="labelRecherche">Modèle: </h4> <select id="lesModeles" name="modele" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle" >
                                <option value='!=0'>Tous</option>
                            </select>
                            <div style="text-align: right;width: 92%;" >
                                <h4 class="labelRecherche">Code barre: </h4> 
                                <input class=" selectRecheche form-control" type="text"  name="lecodebarre" id="lecodebarre" />
                            </div>
                        </div>
                        <div id="lesAccessoires">

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





        <!-- libscript js -->

        <script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../../lib/js/main.js" type="text/javascript"></script>
        <script src="../../lib/js/popper.js" type="text/javascript"></script>

        <!-- mes script js-->
        <script>

                                function load_data(mat, marque)
                                {

                                    $.ajax({
                                        url: "../ajax/rechercheModeleV2.php",
                                        method: "post",
                                        data: {query: mat, marque},
                                        success: function (data)
                                        {
                                            $('#lesModeles').html(data);
                                        }
                                    });
                                }


                                function load_accessoire()
                                {
                                    let searchParams = new URLSearchParams(window.location.search);
                                    searchParams.has('page');
                                    let nPage = searchParams.get('page');
                                    let idcli = searchParams.get('id');
                                    var page = nPage * 30;
                                    var typeaccesoire = $('#type_accessoire').val();
                                    var couleur = $('#couleur').val();
                                    var fournisseur = $('#fournisseur').val();
                                    var mat = $('#mat').val();
                                    var marque = $('#marque').val();
                                    var modele = $('#lesModeles').val();
                                    var codebarre = $('#lecodebarre').val();

                                    load_Valeur();
                                    $.ajax({
                                        url: "../ajax/viewRechercheAccessoire.php",
                                        method: "post",
                                        data: {query: typeaccesoire, couleur, fournisseur, mat, marque, modele, page, idcli, codebarre},
                                        success: function (data)
                                        {
                                            $('#lesAccessoires').html(data);
                                        }
                                    });
                                }

                                function load_Valeur()
                                {
                                    var typeaccesoire = $('#type_accessoire').val();
                                    var couleur = $('#couleur').val();
                                    var fournisseur = $('#fournisseur').val();
                                    var mat = $('#mat').val();
                                    var marque = $('#marque').val();
                                    var modele = $('#lesModeles').val();


                                    $.ajax({
                                        url: "../ajax/viewRechercheValeurTotalAccessoire.php",
                                        method: "post",
                                        data: {query: typeaccesoire, couleur, fournisseur, mat, marque, modele},
                                        success: function (data)
                                        {
                                            $('#leTotal').html(data);
                                        }
                                    });
                                }


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

                                load_accessoire();

                                $('#type_accessoire').click(function () {

                                    load_accessoire();
                                });
                                $('#couleur').click(function () {

                                    load_accessoire();
                                });
                                $('#fournisseur').click(function () {

                                    load_accessoire();
                                });
                                $('#mat').click(function () {

                                    load_accessoire();
                                });
                                $('#marque').click(function () {

                                    load_accessoire();
                                });
                                $('#lesModeles').click(function () {

                                    load_accessoire();
                                });
                                $('#lecodebarre').keyup(function () {

                                    load_accessoire();
                                });

        </script>

        <?php
        if (isset($_POST['ajoutAccessoirePanier'])) {
            $id = $_GET['id'];
            $type = $_GET['type'];
            $id_produit = $_POST['ajoutAccessoirePanier'];
            if ($type == 'achat') {
                try {
                    $insert = "insert into inclut(id_achat,id_accessoire,qte) values ($id,$id_produit,1);";
                    $insert = $conn->prepare($insert);
                    $insert->execute();
                    echo "<script> alert_info('Produit ajouté','success'); </script>";
                } catch (Exception $ex) {
                    echo "<script> alert_info('Erreur','error'); </script>";
                }
            }
            if ($type == 'reparation') {
                try {
                    $insert = "insert into ajout(id_rep,id_accessoire,qte) values ($id,$id_produit,1);";
                    $insert = $conn->prepare($insert);
                    $insert->execute();
                    echo "<script> alert_info('Produit ajouté','success'); </script>";
                } catch (Exception $ex) {
                    echo "<script> alert_info('Erreur','error'); </script>";
                }
            }
        }
        ?>




        <?php
        include '../../include/ProtectSession.php';
        ?>


    </body>
</html>







