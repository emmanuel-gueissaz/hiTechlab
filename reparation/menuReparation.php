 

<!doctype html>

<?php
include '../BDD/connexionBdd.php';
?>


<html lang="fr">
    <head>
        <title>HI-TECH LAB</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">	
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="reparation.css" rel="stylesheet" type="text/css"/>

        <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>

        <script src="../include/alert.js" type="text/javascript"></script>
        <link href="../lib/css/couleur.css" rel="stylesheet" type="text/css"/>
        <script>


            function displayOn(bouton, aAfficher) {
                var temp = document.getElementById(bouton).checked;
                if (temp == true) {
                    document.getElementById(aAfficher).style.display = 'inline-block';


                } else {
                    document.getElementById(aAfficher).style.display = 'none';

                }
            }


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

                var statut = $('#statut').val();
                var categorie = $('#categ').val();
                var modele = $('#lesModeles').val();
                var laRecherche = $('#recherche').val();
                var marque = $('#marque').val();
                var mat = $('#mat').val();

                rechercheDevis(statut, categorie, modele, laRecherche, marque, mat);


            }





        </script>
    </head>
    <body>

        <div class="wrapper d-flex align-items-stretch">
            <?php include '../include/Sidebar.php'; ?>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <?php include '../include/MenuTop.php'; ?>

                <!-- debut de la page -->
                <div style="text-align: center;">
                    <form method="POST" style="margin-bottom: 1%;">
                        <h4 class="selectRecheche" style="margin-right: 2%;">Code barre :</h4>
                        <input type="text" name="openRepBar" class="form-control selectRecheche" />
                    </form> 

                    <div class="viewDevis">
                        <div class="barRechercheDevis">
                            <h4 class="selectRecheche">Statut :</h4>
                            <select name="statut" id="statut" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle">
                                <option value="!=0">Tous</option>
                                <?php
                                try {
                                    $requete = "select * from statut";
                                    $requete = $conn->prepare($requete);
                                    $requete->execute();
                                    while ($ligne = $requete->fetch()) {
                                        $id = $ligne['id'];
                                        $lib = $ligne['lib_etat'];
                                        echo "<option value='=$id'>$lib</option>";
                                    }
                                } catch (Exception $ex) {
                                    
                                }
                                ?>

                            </select>
                            <h4 class="selectRecheche">Catégorie :</h4>
                            <select name="categ" id="categ" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle">
                                <option value="">Tous</option>
                                <?php
                                try {
                                    $requete = "select * from categorie";
                                    $requete = $conn->prepare($requete);
                                    $requete->execute();
                                    while ($ligne = $requete->fetch()) {
                                        $id = $ligne['id_categ'];
                                        $lib = $ligne['id_categ'];
                                        echo "<option value='$id'>$lib</option>";
                                    }
                                } catch (Exception $ex) {
                                    
                                }
                                ?>


                            </select>
                            <h4 class="selectRecheche">Type de matériels :</h4>
                            <select name="mat" id="mat" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle">
                                <option value="!=0">Tous</option>
                                <?php
                                try {
                                    $requete = "select * from type_mat";
                                    $requete = $conn->prepare($requete);
                                    $requete->execute();

                                    while ($ligne = $requete->fetch()) {
                                        $id = $ligne['id_mat'];
                                        $lib = $ligne['lib_mat'];
                                        echo "<option value='=$id'>$lib</option>";
                                    }
                                } catch (Exception $ex) {
                                    
                                }
                                ?>

                            </select>
                            <h4 class="selectRecheche">Marques :</h4>
                            <select name="marque" id="marque" class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle">
                                <option value="!=0">Tous</option>
                                <?php
                                try {
                                    $requete = "select * from marque";
                                    $requete = $conn->prepare($requete);
                                    $requete->execute();

                                    while ($ligne = $requete->fetch()) {
                                        $id = $ligne['id_marque'];
                                        $lib = $ligne['nom'];
                                        echo "<option value='=$id'>$lib</option>";
                                    }
                                } catch (Exception $ex) {
                                    
                                }
                                ?>


                            </select>
                            <h4 class="selectRecheche">Modèles :</h4>
                            <select id="lesModeles"  class="selectRecheche btn btn-outline-primary btn-sm dropdown-toggle">


                            </select>
                            <h4 class="selectRecheche">Rechercher :</h4>
                            <input type="text" id="recherche" class="form-control selectRecheche"/>

                            <p style="text-align: right; margin-right: 6%;">Nom forfait / num serie </p>



                        </div>
                        <div class="affichageDesDevis" id="lesDevis">

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


                    <!-- fin de la page -->


                </div>
            </div>
        </div>
        <!-- mes script js-->


        <!-- libscript js -->

        <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../lib/js/main.js" type="text/javascript"></script>
        <script src="../lib/js/popper.js" type="text/javascript"></script>



        <script>



                                function load_data(pomme)
                                {
                                    $.ajax({
                                        url: "./ajax/rechercheReparation.php",
                                        method: "post",
                                        data: {query: pomme},
                                        success: function (data)
                                        {
                                            $('#result').html(data);
                                        }
                                    });
                                }

                                $('#saisie').keyup(function () {
                                    var search = $(this).val();
                                    if (search != '')
                                    {
                                        load_data(search);
                                    } else
                                    {
                                        load_data('');

                                    }
                                });

                                function load_modele(mat, marque)
                                {
                                    $.ajax({
                                        url: "ajax/rechercheModeleV2.php",
                                        method: "post",
                                        data: {query: mat, marque},
                                        success: function (data)
                                        {
                                            $('#lesModeles').html(data);
                                        }
                                    });
                                }

                                $('#marque').click(function () {

                                    var mat = $('#mat').val();
                                    var marque = $('#marque').val();
                                    load_modele(mat, marque);

                                });

                                $('#mat').click(function () {


                                    var mat = $('#mat').val();
                                    var marque = $('#marque').val();
                                    load_modele(mat, marque);

                                });
                                var mat = $('#mat').val();
                                var marque = $('#marque').val();
                                load_modele(mat, marque);

                                function rechercheDevis(statut, categorie, modele, laRecherche, marque, mat) {
                                    let searchParams = new URLSearchParams(window.location.search);
                                    searchParams.has('page');
                                    let nPage = searchParams.get('page');
                                    var page = nPage * 30;
                                    $.ajax({
                                        url: "ajax/rechercheDevis.php",
                                        method: "post",
                                        data: {query: statut, categorie, modele, laRecherche, marque, mat, page},
                                        success: function (data)
                                        {
                                            $('#lesDevis').html(data);
                                        }
                                    });
                                }


                                $('#statut').click(function () {
                                    var statut = $('#statut').val();
                                    var categorie = $('#categ').val();
                                    var modele = $('#lesModeles').val();
                                    var laRecherche = $('#recherche').val();
                                    var marque = $('#marque').val();
                                    var mat = $('#mat').val();

                                    rechercheDevis(statut, categorie, modele, laRecherche, marque, mat);

                                });
                                $('#categ').click(function () {
                                    var statut = $('#statut').val();
                                    var categorie = $('#categ').val();
                                    var modele = $('#lesModeles').val();
                                    var laRecherche = $('#recherche').val();
                                    var marque = $('#marque').val();
                                    var mat = $('#mat').val();

                                    rechercheDevis(statut, categorie, modele, laRecherche, marque, mat);

                                });
                                $('#lesModeles').click(function () {
                                    var statut = $('#statut').val();
                                    var categorie = $('#categ').val();
                                    var modele = $('#lesModeles').val();
                                    var laRecherche = $('#recherche').val();
                                    var marque = $('#marque').val();
                                    var mat = $('#mat').val();

                                    rechercheDevis(statut, categorie, modele, laRecherche, marque, mat);

                                });
                                $('#recherche').keyup(function () {
                                    var statut = $('#statut').val();
                                    var categorie = $('#categ').val();
                                    var modele = $('#lesModeles').val();
                                    var laRecherche = $('#recherche').val();

                                    var marque = $('#marque').val();
                                    var mat = $('#mat').val();

                                    rechercheDevis(statut, categorie, modele, laRecherche, marque, mat);

                                });
                                $('#marque').click(function () {
                                    var statut = $('#statut').val();
                                    var categorie = $('#categ').val();
                                    var modele = $('#lesModeles').val();
                                    var laRecherche = $('#recherche').val();

                                    var marque = $('#marque').val();
                                    var mat = $('#mat').val();

                                    rechercheDevis(statut, categorie, modele, laRecherche, marque, mat);

                                });
                                $('#mat').click(function () {
                                    var statut = $('#statut').val();
                                    var categorie = $('#categ').val();
                                    var modele = $('#lesModeles').val();
                                    var laRecherche = $('#recherche').val();

                                    var marque = $('#marque').val();
                                    var mat = $('#mat').val();

                                    rechercheDevis(statut, categorie, modele, laRecherche, marque, mat);

                                });
                                $('#mat').click();



        </script>


    </body>

    <?php
    if (isset($_POST['suppDevis'])) {
        $id = $_POST['suppDevis'];
    
        try {
            $requete = "select * from supprepdemande($id);";
            $requete = $conn->prepare($requete);
            $requete->execute();
            echo '<script> alert_info("Réparation supprimée","success");</script>';
        } catch (Exception $ex) {
            echo '<script> alert_info("Cette réparation ne peut être supprimée","error");</script>';
        }
    }
    
    
    
    if(isset($_POST['openRepBar'])){
        $id = $_POST['openRepBar'];
        echo "<script>document.location.href = '/hitechlab/reparation/laReparation.php?id=$id'</script>";
    }
    ?>
    <!--protection de session -->
    <?php
    include '../include/ProtectSession.php';
    ?>


</html>







