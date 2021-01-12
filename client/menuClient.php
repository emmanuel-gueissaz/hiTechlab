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
                    <h2 class="titre">Création client</h2>

                    <input type="button" class="btn btn-outline-primary btn-lg" onclick="document.getElementById('createClient').style.display = 'inline-block';  this.style.display = 'none';"  id="btnCreate" value="créer un client"/>

                    <div class="createClient" id="createClient" style="text-align: left">

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
                                <input type="button" name="createCli" class="btn btn-outline-danger btn-lg" value="Annuler" onclick="document.getElementById('createClient').style.display = 'none';document.getElementById('btnCreate').style.display = 'inline-block';" />
                                <input type="submit" name="createCli" class="btn btn-outline-primary btn-lg" value="Creer"  />
                            </div>

                        </form>

                    </div>




                    <h2 class="titre">recherche client</h2>

                    <input type="button" class="btn btn-outline-primary btn-lg boutonClient" id="rechercheFiche" onclick="document.getElementById('rechercheCliFiche').style.display = 'block';  this.style.display = 'none';" value="rechercher client par fiche" /><br>

                    <div class="rechercheCliFiche" id="rechercheCliFiche"> 

                        <input type="text" id="saisie" class="form-control inputClient"/>

                        <br>
                 
                        <div class="labelMoyen">nom</div>
                        <div class="labelMoyen"> prenom</div>
                        <div class="labelMoyen noResponsive">tel</div>
                        <div class="labelLong noResponsive">mail</div>
                        <div class="labelMoyen noResponsive">rue</div>
                        <div class="labelMoyen noResponsive">code postal</div>
                      

                        <div id="result" class="lesClients"></div>
                        <input type="button" name="createCli" class="btn btn-outline-danger btn-lg" value="Annuler"  onclick="document.getElementById('rechercheCliFiche').style.display = 'none';document.getElementById('rechercheFiche').style.display = 'inline-block';" />

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
                            $.ajax({
                                url: "recherche.php",
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


        <!--protection de session -->
     <?php 
   include '../include/ProtectSession.php';
?>
    </body>
</html>