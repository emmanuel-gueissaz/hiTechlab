
<?php
include '../BDD/connexionBdd.php';
?>
<!doctype html>


<html lang="fr">
    <head>
        <title>HI-TECH LAB</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">	
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <link href="../client/client.css" rel="stylesheet" type="text/css"/>
        <script src="../include/alert.js" type="text/javascript"></script>



    </head>
    <body>




        <div class="wrapper d-flex align-items-stretch">
            <?php include '../include/Sidebar.php'; ?>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <?php include '../include/MenuTop.php'; ?>

                <!-- debut de la page -->

                <input type="button" class="btn btn-outline-secondary" value="retour" onclick="history.back();"/>
                <div>

                    <form method="POST">
                        <h4 class="labelClient">Nom : </h4> <input class="inputClient form-control" type="text" id="Nom" name="Nom" required=""/><br>
                        <h4 class="labelClient">Prenom : </h4> <input class="inputClient form-control" type="text" id="Prenom" name="Prenom" required=""/><br>
                        <h4 class="labelClient">Tel : </h4> <input class="inputClient form-control" type="number" id="Tel" name="Tel" required=""/><br>
                        <h4 class="labelClient">Email : </h4> <input class="inputClient form-control" type="text" id="Email" name="Email" required=""/><br>
                        <h4 class="labelClient"> mot de passe :</h4>  <input type="button" class="inputClient btn btn-outline-primary" value="modifier" onclick="document.location.href = '/hitechlab/boutique/modifierMdpTech.php?id=<?php echo $_GET['id'] ?>'" />

                        <h4 class="labelClient">Tel Fixe : </h4> <input class="inputClient form-control" type="number" id="Tel_fixe" name="Tel_fixe"/><br>
                        <h4 class="labelClient">Rue : </h4> <input class="inputClient form-control" type="text" id="Rue" name="Rue" /><br>
                        <h4 class="labelClient">Code Postal : </h4> <input class="inputClient form-control" type="number" id="CPost" name="CPost"/><br>
                        <h4 class="labelClient">Ville : </h4> <input class="inputClient form-control" type="text" id="Ville" name="Ville"/><br>
                       
                        <h4 class="labelClient">offres commercial: </h4> 
                       
                        <div class="form-check form-switch checkboxClient ">
                            <input class="form-check-input" type="checkbox"  id="Offre" name="offre" style="width: 20%; height: 80%; margin-left: 0%;" > 
                        </div>
                        
                        <h4 class="labelClient">Type: </h4> 
                        <select class="inputClient btn-outline-primary" name="type_tech" id="type_tech">
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








                        <br>
                        <div style="text-align: center">
                            <input type="submit"  class="btn btn-outline-danger btn-lg" name="supprimer" value="supprimer"  onclick="document.getElementById('createClient').style.display = 'none';document.getElementById('btnCreate').style.display = 'inline-block';" />
                            <input type="submit"  class="btn btn-outline-primary btn-lg" name="modifier" value="Modifier" />
                        </div>

                    </form>



                </div> 

                <!-- libscript js -->
                <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                <script src="../lib/js/main.js" type="text/javascript"></script>
                <script src="../lib/js/popper.js" type="text/javascript"></script>


                <?php
                $requete = "(select email,nom,prenom,tel,telfixe,rue,cpost,ville,receptionoffre,mdp,type_tech from only technicien where email = '" . $_GET['id'] . "')";
                $requete = $conn->prepare($requete);
                $requete->execute();
                $ligne = $requete->fetch();

                $email = $ligne['email'];
                $nom = $ligne['nom'];
                $prenom = $ligne['prenom'];
                $tel = $ligne['tel'];
                $telFix = $ligne['telfixe'];
                $rue = $ligne['rue'];
                $cPost = $ligne['cpost'];
                $ville = $ligne['ville'];
                $offre = $ligne['receptionoffre'];
                $type_tech = $ligne['type_tech'];
                






                echo "<script> "
                . "$('#Nom').val('" . $nom . "'),"
                . "$('#Prenom').val('" . $prenom . "'),"
                . "$('#Tel').val('" . $tel . "'),"
                . "$('#Email').val('" . $email . "'),"
                . "$('#Tel_fixe').val(" . $telFix . "),"
                . "$('#Rue').val('" . $rue . "'),"
                . "$('#CPost').val('" . $cPost . "'),"
                . "$('#Ville').val('" . $ville . "'),"
                . "$('#Offre').prop('checked', $offre), "
                . "$('#type_tech').val('$type_tech') "
                . "</script>";
                ?>


                <!-- fin de la page -->


            </div>

        </div>

<?php
//Permet de modifier le client
$Tmail = $_GET['id'];
if (isset($_POST['modifier'])) {
    $nom = $_POST['Nom'];
    $prenom = $_POST['Prenom'];
    $tel = $_POST['Tel'];
    $email = $_POST['Email'];
    $telFix = $_POST['Tel_fixe'];
    $rue = $_POST['Rue'];
    $Cpost = $_POST['CPost'];
    $ville = $_POST['Ville'];
    $offre = $_POST['offre'];
    $type_tech = $_POST['type_tech'];


    $mdp = $_POST['mdp'];
    $mdp = openssl_encrypt($mdp, "AES-128-ECB", '1234');

    if ($offre == 'on') {
        $offre = 'true';
    } else {
        $offre = 'false';
    }

    try {

        $update = "update  technicien
                           set (nom,prenom,tel,email,telfixe,rue,cpost,ville,receptionoffre,type_tech) = ('$nom','$prenom','$tel','$email','$telFix','$rue','$Cpost','$ville','$offre',$type_tech)
                           where email = '$Tmail';";
        $requete = $conn->prepare($update);
        $requete->execute();
        echo '<script> alert_info_redirect("Technicien modifié","success","/hitechlab/boutique/untechnicien.php?id=' . trim($_GET['id']) . '");</script>';
    } catch (Exception $ex) {
        
    }
}


//Permet de supprimer un client 
if (isset($_POST['supprimer'])) {
    $email = $_GET['id'];

    try {

        $delete = "delete from only technicien where email = '$email'";
        $requete = $conn->prepare($delete);
        $requete->execute();
        echo '<script> alert_info("client supprimer","success");</script>';
    } catch (Exception $ex) {
        echo '<script> alert_info("problème lors de la supression","error");</script>';
    }
}
?>


        <?php
        include '../include/ProtectSession.php';
        ?>


    </body>
</html>







