 

<!doctype html>

<?php
include '../BDD/connexionBdd.php';
?>


<html lang="fr">
    <head>
        <title>Accueil</title>
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
    <body>

        <div class="wrapper d-flex align-items-stretch">
            <?php include '../include/Sidebar.php'; ?>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <?php include '../include/MenuTop.php'; ?>

                <!-- debut de la page -->
                <div style="text-align: center;">
                    <input type="button" class="btn btn-outline-primary btn-lg" value="Créer devis" onclick="document.getElementById('createDevis').style.display = 'inline-block';"/>
                    <div class="createDevis" id="createDevis">

                        <h4 class="titreReparation">recherche : </h4><input type="text" id="saisie" class="inputReparation form-control " />
                        <div id="result" ></div>

                    </div> 
                    
                    <div class="lesDevis">
                      
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


        </script>


    </body>

    <!--protection de session -->
    <?php
    include '../include/ProtectSession.php';
    ?>


</html>







