 

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
                    <h2 class="titre">Création technicien</h2>
                    <input type="button" class="btn btn-outline-primary btn-lg" onclick="document.getElementById('createClient').style.display = 'inline-block';  this.style.display = 'none';"  id="btnCreate" value="créer un technicien"/>

                    <div class="createClient" id="createClient" style="text-align: left">

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
                            <h4 class="labelClient">Salaire : </h4> <input class="inputClient form-control" type="number" name="salaire"/><br>
                            <div style="text-align: center">
                                <input type="button"  class="btn btn-outline-danger btn-lg" value="Annuler"  onclick="document.getElementById('createClient').style.display = 'none';document.getElementById('btnCreate').style.display = 'inline-block';" />
                                <input type="submit" name="createTec" class="btn btn-outline-primary btn-lg" value="Créer"  />
                            </div>

                        </form>

                    </div>

                    <div class="lesTechniciens">
                        
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

                    
                    
                    <input type="button" class="btn btn-outline-primary btn-lg" onclick="document.location.href= '/hitechlab/boutique/lesAjouts.php'" value="ajout"/>

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

    $mdp = openssl_encrypt($mdp, "AES-128-ECB", '1234');
    $salaire = $_POST['salaire'];

    if ($offre == 'on') {
        $offre = 'true';
    } else {
        $offre = 'false';
    }


    try {
        $insert = "insert into technicien (nom,prenom,tel,email,telfixe,rue,cpost,ville,receptionoffre,mdp,salaire) values ('$nom','$prenom','$tel','$email','$telfix','$rue','$Cpost','$ville','$offre','$mdp',$salaire);";
        // $insert = "insert into client (email) values ('$email');";
        $test = $conn->prepare($insert);
        $test->execute();

        echo '<script> alert_info("client créer","success");</script>';
    } catch (Exception $ex) {
        echo '<script> alert_info("déja client","error");</script>';
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







