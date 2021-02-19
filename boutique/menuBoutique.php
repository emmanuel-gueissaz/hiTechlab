 

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
        <link href="../client/client.css" rel="stylesheet" type="text/css"/>
        <link href="boutique.css" rel="stylesheet" type="text/css"/>

        <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../include/alert.js" type="text/javascript"></script>


    </head>
    <body>

        <div class="wrapper d-flex align-items-stretch">
            <?php include '../include/Sidebar.php'; ?>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <?php include '../include/MenuTop.php'; ?>

                <!-- debut de la page -->



                <div style="text-align: center">
                    <div  style="text-align: right;">
                        <button class="btn btn-outline-primary" onclick="document.location.href = '/hitechlab/boutique/lesAjouts.php'">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
                            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
                            </svg>
                        </button>
                        <?php
                        $requete = "select count(*) as nbalert from accessoire where stock <= 1";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        $ligne = $requete->fetch();
                        $nbalertAccessoire = $ligne['nbalert'];

                        $requete = "select count(*) as nbalert from piece where stock <= 1";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        $ligne = $requete->fetch();
                        $nbalertPiece = $ligne['nbalert'];
                        ?>
                        <button type="button" class="btn btn-primary" onclick="document.location.href = '/hitechlab/boutique/gestionStock/GestionStockAccessoire.php?page=1'">
                            Accessoires <span class="badge badge-light"><?php echo $nbalertAccessoire; ?></span>
                        </button>
                        <button type="button" class="btn btn-primary" onclick="document.location.href = '/hitechlab/boutique/gestionStock/GestionStock.php?page=1'">
                            Pièces <span class="badge badge-light"><?php echo $nbalertPiece; ?></span>
                        </button>

                    </div>
                    <div class="createClient slideBar" id="createClient" style="text-align: left">

                        <form method="POST">
                            <h4 class="labelClient">Nom : </h4> <input class="inputClient form-control" type="text" name="Nom" required=""/><br>
                            <h4 class="labelClient">Prenom : </h4> <input class="inputClient form-control" type="text" name="Prenom" required=""/><br>
                            <h4 class="labelClient">Tel : </h4> <input class="inputClient form-control" type="number" name="Tel" required=""/><br>
                            <h4 class="labelClient">Email : </h4> <input class="inputClient form-control" type="text" name="Email" required=""/><br>

                            <h4 class="labelClient">Tel Fixe : </h4> <input class="inputClient form-control" type="number" name="Tel_fixe"/><br>
                            <h4 class="labelClient">Rue : </h4> <input class="inputClient form-control" type="text" name="Rue" /><br>
                            <h4 class="labelClient">Code Postal : </h4> <input class="inputClient form-control" type="number" name="CPost"/><br>
                            <h4 class="labelClient">Ville : </h4> <input class="inputClient form-control" type="text" name="Ville"/><br>
                            <h4 class="labelClient">Offres commercial: </h4> 
                            <div class="form-check form-switch checkboxClient ">
                                <input class="form-check-input " type="checkbox" id="flexSwitchCheckDefault" name="offre" style="width: 50%; height: 80%; margin-left: 0%;" > 
                            </div>
                            <br>
                            <h4 class="labelClient">Mot de passe : </h4> <input class="inputClient form-control" type="password" name="mdp"/><br>
                            <h4 class="labelClient">Type : </h4>
                            <select class="inputClient btn-outline-primary" name="type_tech">
                                <?php
                                $requete = 'select * from type_tech';
                                $requete = $conn->prepare($requete);
                                $requete->execute();
                                while ($ligne = $requete->fetch()) {
                                    $id = $ligne['id_type_tech'];
                                    $lib = $ligne['lib_type_tech'];
                                    echo "<option value='$id'>$lib</script>";
                                }
                                ?>
                            </select>
                            <div style="text-align: center">
                                <input type="button"  class="btn btn-outline-danger btn-lg" value="Annuler"  onclick="document.getElementById('createClient').style.height = '0px';" />
                                <input type="submit" name="createTec" class="btn btn-outline-primary btn-lg" value="Créer"  />
                            </div>

                        </form>

                    </div>

                    <div class="lesTechniciens">
                        <div class="titreDeTech">
                            <h5 class="lableTitreTech">
                                Les techniciens :
                            </h5>
                            <button class="btn btn-primary iconElement" onclick="document.getElementById('createClient').style.height = '600px';"  >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>

                        </div>



                        <div class='titreTech noResponsive' >email  </div>
                        <div class='titreTech'>nom  </div>
                        <div class='titreTech'>prenom  </div>
                        <div class='titreTech noResponsive'>tel  </div>



                        <?php
                        $test = '"';
                        $requete = "select email, nom, prenom, tel from technicien";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        while ($lignes = $requete->fetch()) {
                            $email = $lignes['email'];
                            $nom = $lignes['nom'];
                            $prenom = $lignes['prenom'];
                            $tel = $lignes['tel'];
                            echo "<div class='leTech'>"
                            . "<hr class='my-2' Style='border-top:1px solid black; ' />"
                            . "<div class='labelTech noResponsive'>$email  </div>"
                            . "<div class='labelTech'>$nom  </div>"
                            . "<div class='labelTech'>$prenom  </div>"
                            . "<div class='labelTech noResponsive'>$tel  </div>"
                            . "<button class='btn btn-primary view' onclick='document.location.href = $test /hitechlab/boutique/unTechnicien.php?id=$email $test'>
                                       <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
</svg>
</button>"
                            . "</div>";
                        }
                        ?>

                    </div>

                </div>
            </div>
        </div>

        <!-- fin de la page -->
        <?php
        if (isset($_POST['createTec'])) {
            $nom = $_POST['Nom'];
            $prenom = $_POST['Prenom'];
            $tel = $_POST['Tel'];
            $email = $_POST['Email'];
            $telfix = $_POST['Tel_fixe'];
            $rue = $_POST['Rue'];
            $Cpost = $_POST['CPost'];
            $ville = $_POST['Ville'];
            $offre = $_POST['offre'];
            $mdp = $_POST['mdp'];
            $type_tech = $_POST['type_tech'];

            $mdp = openssl_encrypt($mdp, "AES-128-ECB", '1234');


            if ($offre == 'on') {
                $offre = 'true';
            } else {
                $offre = 'false';
            }


            try {
                $insert = "insert into technicien (nom,prenom,tel,email,telfixe,rue,cpost,ville,receptionoffre,mdp,type_tech) values ('$nom','$prenom','$tel','$email','$telfix','$rue','$Cpost','$ville','$offre','$mdp',$type_tech);";
                // $insert = "insert into client (email) values ('$email');";
                $test = $conn->prepare($insert);
                $test->execute();

                echo '<script> alert_info_redirect("Technicien crée","success","/hitechlab/boutique/menuBoutique.php");</script>';
            } catch (Exception $ex) {
//                echo '<script> alert_info("déjà technicien","error");</script>';
                echo $ex;
            }
        }
        ?>
        <!-- mes script js-->



        <!-- libscript js -->

        <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../lib/js/main.js" type="text/javascript"></script>
        <script src="../lib/js/popper.js" type="text/javascript"></script>

        <?php
        include '../include/ProtectSession.php';
        ?>
    </body>
</html>







