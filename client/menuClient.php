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




        <!-- JavaScript Bundle with Popper -->

        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="client.css" rel="stylesheet" type="text/css"/>
        <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>


        <link href="../boutique/boutique.css" rel="stylesheet" type="text/css"/>
        <script src="../include/alert.js" type="text/javascript"></script>
        <script>




            function pro() {
                var temp = document.getElementById('pro').checked;
                if (temp == true) {
                    document.getElementById('professionnel').style.display = 'inline-block';
                    document.getElementById('proCache').value = true;

                } else {
                    document.getElementById('professionnel').style.display = 'none';
                    document.getElementById('proCache').value = false;
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

                var search = document.getElementById('saisie').value;
//
                load_data(search);


            }
        </script>




    </head>

    <body>

        <div class="wrapper d-flex align-items-stretch">


            <!-- sidebar de (gauche) -->
            <?php include '../include/Sidebar.php'; ?>


            <div id="content" class="p-4 p-md-5">
                <!-- menu du haut  -->
                <?php include '../include/MenuTop.php'; ?>

                <!-- debut de la page -->

                <div style="text-align: center">




                    <div class="createClient slideBar" id="createClient" style="text-align: left">

                        <h4 class="labelClient"> professionnel : </h4> 
                        <div class="form-check form-switch checkboxClient ">
                            <input class="form-check-input " type="checkbox" id="pro" name="pro" style="width: 50%; height: 80%; margin-left: 0%;"  onclick="pro();"  > 
                        </div>
                        <form method="POST">
                            <input type="hidden" value="false" name="pro" id="proCache"/>
                            <h4 class="labelClient">Nom : </h4> <input class="inputClient form-control" type="text" name="Nom" required=""/><br>
                            <h4 class="labelClient">Prenom : </h4> <input class="inputClient form-control" type="text" name="Prenom" required=""/><br>
                            <h4 class="labelClient">Tel : </h4> <input class="inputClient form-control" type="number" name="Tel" required=""/><br>
                            <h4 class="labelClient">Email : </h4> <input class="inputClient form-control" type="text" name="Email" required=""/><br>
                            <h4 class="labelClient">Mot de passe : </h4> <input class="inputClient form-control" type="password" name="mdp" /><br>
                            <h4 class="labelClient">Tel Fixe : </h4> <input class="inputClient form-control" type="number" name="Tel_fixe"/><br>
                            <h4 class="labelClient">Rue : </h4> <input class="inputClient form-control" type="text" name="Rue" /><br>
                            <h4 class="labelClient">Code Postal : </h4> <input class="inputClient form-control" type="number" name="CPost"/><br>
                            <h4 class="labelClient">Ville : </h4> <input class="inputClient form-control" type="text" name="Ville"/><br>
                            <h4 class="labelClient">offres commercial: </h4> 
                            <div class="form-check form-switch checkboxClient ">
                                <input class="form-check-input " type="checkbox" id="flexSwitchCheckDefault" name="offre" style="width: 50%; height: 80%; margin-left: 0%;" > 
                            </div>

                            <!-- champ professionnel apparauit si on coche la case client pro (utilise la fonction pro(); -->

                            <div class="professionnel" id="professionnel">
                                <br> <h4 class="labelClient"> Siret :</h4> <input class="inputClient form-control" type="text" name="siret"/><br>
                                <h4 class="labelClient"> tel Pro :</h4> <input class="inputClient form-control" type="tel" name="telPro"/><br>
                                <h4 class="labelClient"> nom de l'entreprise:</h4> <input class="inputClient form-control" type="text" name="nomEnt"/><br>
                                <h4 class="labelClient"> statut :</h4> <select class="inputClient form-control"  name="civilite">
                                    <option value="SAS"> SAS</option>
                                    <option value="auto"> auto-entreprenneur </option>
                                </select>


                            </div>
                            <br>
                            <div style="text-align: center">
                                <input type="button" name="createCli" class="btn btn-outline-danger btn-lg" value="Annuler" onclick="document.getElementById('createClient').style.height = '0px';" />
                                <input type="submit" name="createCli" class="btn btn-outline-primary btn-lg" value="Creer"  />
                            </div>

                        </form>

                    </div>








                    <div class="rechercheCliFiche " id="rechercheCliFiche"> 
                        <div class="titreDeTech">
                            <h5 class="lableTitreTech">
                                Les clients :
                            </h5>
                            <button class="btn btn-primary iconElement" onclick="document.getElementById('createClient').style.height = '605px';"  >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>

                        </div>
                        <div class="slideBar" style="    overflow-y: scroll;overflow-x: hidden;">
                            <div style="text-align: left;">
                                <h2 class="larecherche">Recherche : </h2>
                                <input type="text" id="saisie" class="form-control inputClient"/>
                            </div>
                            <br>

                            <div class="labelMoyen">nom</div>
                            <div class="labelMoyen"> prenom</div>
                            <div class="labelMoyen noResponsive">tel</div>
                            <div class="labelLong noResponsive">mail</div>
                            <div class="labelMoyen noResponsive">rue</div>
                            <div class="labelMoyen noResponsive">code postal</div>


                            <div id="result" class="lesClients"></div>
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

                    </div>
                    <input type="button" class="btn btn-outline-primary btn-lg boutonClient" onclick="document.location.href = '/client/creerClient.php'" value="rechercher par vente"/><br>




                </div>


            </div>
        </div>



        <?php
        if (isset($_POST['createCli'])) {
            $nom = $_POST['Nom'];
            $prenom = $_POST['Prenom'];
            $tel = $_POST['Tel'];
            $email = $_POST['Email'];
            $telfix = $_POST['Tel_fixe'];
            $rue = $_POST['Rue'];
            $Cpost = $_POST['CPost'];
            $ville = $_POST['Ville'];
            $offre = $_POST['offre'];

            $siret = $_POST['siret'];
            $telPro = $_POST['telPro'];
            $nomEnt = $_POST['nomEnt'];
            $statut = $_POST['civilite'];
            $mdp = $_POST['mdp'];
            $mdp = openssl_encrypt($mdp, "AES-128-ECB", '1234');


            if ($offre == 'on') {
                $offre = 'true';
            } else {
                $offre = 'false';
            }


            $pro = $_POST['pro'];


            if ($email != '') {
                if ($pro != 'true') {

                    try {
                        $insert = "insert into client (nom,prenom,tel,email,mdp,telfixe,rue,cpost,ville,receptionoffre) values ('$nom','$prenom','$tel','$email','$mdp','$telfix','$rue','$Cpost','$ville',$offre);";
                        // $insert = "insert into client (email) values ('$email');";
                        $test = $conn->prepare($insert);
                        $test->execute();

                        echo '<script> alert_info("client créer","success");</script>';
                    } catch (Exception $ex) {
                        echo '<script> alert_info("déja client","error");</script>';
                    }
                } else {
                    try {
                        $insert = "insert into client (nom,prenom,tel,email,mdp,telfixe,rue,cpost,ville,receptionoffre,siret,telentreprise,nomentreprise,civilite) values ('$nom','$prenom','$tel','$email','$mdp','$telfix','$rue','$Cpost','$ville',$offre,'$siret','$telPro','$nomEnt','$statut');";
                        // $insert = "insert into client (email) values ('$email');";
                        $test = $conn->prepare($insert);
                        $test->execute();

                        echo '<script> alert_info("client créer","success");</script>';
                    } catch (Exception $ex) {
                        echo '<script> alert_info("déja client","error");</script>';
                    }
                }
            }
        }
        ?>

        <!-- fin de la page -->

        <!-- script js -->

        <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../lib/js/main.js" type="text/javascript"></script>
        <script src="../lib/js/popper.js" type="text/javascript"></script>


        <!--script ajax -->
        <script>



                        function load_data(pomme)
                        {

                            let searchParams = new URLSearchParams(window.location.search);
                            searchParams.has('page');
                            let nPage = searchParams.get('page');
                            var page = nPage * 30;
                            $.ajax({
                                url: "recherche.php",
                                method: "post",
                                data: {query: pomme, page},
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


        <!--protection de session -->
        <?php
        include '../include/ProtectSession.php';
        ?>
    </body>
</html>