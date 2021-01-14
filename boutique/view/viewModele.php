


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
                                Les modèles :
                            </h5>
                            <button class="btn btn-primary iconElement" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterModele.php'"  >
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
                        
                    
                        
                        <div id="lesModeles"  >
                            
                            
                        </div>
                       
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
                                        url: "../ajax/viewRechercheModele.php",
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
if (isset($_POST['supp'])) {
    $id = $_POST['supp'];

    try {
        $requete = "delete from modele where id_modele = $id ;";
        $requete = $conn->prepare($requete);
        $requete->execute();
        echo '<script> alert_info("Le modèle à été supprimé","success");</script>';
    } catch (Exception $ex) {
        echo '<script> alert_info("Le modèle ne peut être supprimé","error");</script>';
    }
}
?>



        <?php
        include '../../include/ProtectSession.php';
        ?>


    </body>
</html>







