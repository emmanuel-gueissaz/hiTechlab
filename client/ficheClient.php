
<?php
include '../BDD/connexionBdd.php';
?>
<!doctype html>


<html lang="fr">
    <head>
        <title>Accueil</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">	
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../include/alert.js" type="text/javascript"></script>

        <link href="ficheClient.css" rel="stylesheet" type="text/css"/>



    </head>
    <body>




        <div class="wrapper d-flex align-items-stretch">
            <?php include '../include/Sidebar.php'; ?>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <?php include '../include/MenuTop.php'; ?>

                <!-- debut de la page -->

                <input type="button" class="btn btn-outline-secondary" value="retour" onclick="history.back();"/>

                <div style="text-align: center;">
                    <div class="infoClient">
                        <div class="leClient">
                            <?php
                            $test = '"';
                            $requete = "select email,nom,prenom,tel, telentreprise,nomentreprise from only client where email = '" . trim($_GET['id']) . "';";
                            $requete = $conn->prepare($requete);
                            $requete->execute();
                            $ligne = $requete->fetch();
                            $email = $ligne['email'];
                            $nom = $ligne['nom'];
                            $prenom = $ligne['prenom'];
                            $tel = $ligne['tel'];
                            $telFix = $ligne['telfixe'];
                            $telPro = $ligne['telentreprise'];
                            $nomEnt = $ligne['nomentreprise'];


//                        echo "<div class='petitLabel'> Email: $email  </div>";

                            echo "<label class='labelInfoClient'>Nom: </label><div class='petitLabel'>  $nom  </div>";
                            echo "<label class='labelInfoClient'> Prenom: </label><div class='petitLabel'> $prenom  </div>";
                            echo "<label class='labelInfoClient'>Tel:</label><div class='petitLabel'> $tel  </div>";
                            echo "<label class='labelInfoClient'>Tel Fixe:  </label><div class='petitLabel'> $telFix  </div>";
                            if ($nomEnt != '') {
                                echo "<label class='labelInfoClient'>Tel Pro: </label><div class='petitLabel'>  $telPro  </div>";
                                echo "<label class='labelInfoClient'>Nom entreprise: </label><div class='petitLabel'>  $nomEnt  </div>";
                            }
                            ?>
                        </div>
                        <button class="btn btn-secondary edit" onclick="document.location.href = '/hitechlab/client/leClient.php?id=<?php echo $email ?>'" >
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="infoClient">
                        futur stat
                    </div>

                    <H4 class="titreDevis">Demande de devis</H4>
                    <div class="demandeDevis">
                        <?php
                        $requete = "select reparation.id,modele.lib_modeele, reparation.numserie, reparation.daterestitution, reparation.heure from reparation
                                    inner join a ON a.id = reparation.id
                                    inner join modele ON modele.id_modele = reparation.id_modele
                                    where a.id_statut = 1
                                    and reparation.email = '$email'";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        while ($ligne = $requete->fetch()) {
                            $modele = $ligne['lib_modeele'];
                            $numeserie = $ligne['numserie'];
                            $date = $ligne['daterestitution'];
                            $heure = $ligne['heure'];
                            $id = $ligne['id'];
                            echo "<div class='laDemande'>"
                            . "<div class='labelDsDevis'> $id </div>"
                            . "<div class='labelDsDevis'> $modele </div>"
                            . "<div class='labelDsDevis'> $numeserie </div>"
                            . "<div class='labelDsDevis'> $date </div>"
                            . "<div class='labelDsDevis'> $heure </div>"
                            . "<button class='btn btn-primary' onclick='document.location.href=$test /hitechlab/reparation/laReparation.php?id=$id $test'>  "
                            . "     <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
</svg>"
                            . "</button>"
                            . "</div>";
                        }
                        ?>
                    </div>


                </div>
            </div> 

            <!-- libscript js -->
            <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script src="../lib/js/main.js" type="text/javascript"></script>
            <script src="../lib/js/popper.js" type="text/javascript"></script>





            <!-- fin de la page -->




        </div>





        <?php
        include '../include/ProtectSession.php';
        ?>


    </body>
</html>






