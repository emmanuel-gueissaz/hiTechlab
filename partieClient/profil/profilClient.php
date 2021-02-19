
<?php
include '../../BDD/connexionBdd.php';
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

        <link href="../../lib/css/styleMenu.css" rel="stylesheet" type="text/css"/>


        <link href="../../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../../include/alert.js" type="text/javascript"></script>
        <link href="../../lib/css/couleur.css" rel="stylesheet" type="text/css"/>

        <link href="../../client/ficheClient.css" rel="stylesheet" type="text/css"/>
        <link href="profilClient.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>





        <?php include '../../include/MenuTopClient.php'; ?>

        <!-- debut de la page -->

        <div style="text-align: center; " >
            <div class="headerClient">
                <div style="width: 95%; display: inline-block; ">
                    <input type="button" class="btn btn-outline-secondary"   value="Faire ma Demande" onclick="document.location.href = '/hitechlab/partieClient/profil/creerDevis.php'"/>
                </div>
            </div>
            <div class="headerClient" style="vertical-align: middle;">
                <?php
                $email = $_SESSION['email'];
                $progress = array('10%', '30%', '50%', '65%', '92%',); // correspond a la longueur de la barre
                $requete = "select ((select count(*) from reparation where email = '$email') 
		+ (select count(*) from achat where email = '$email')) 
                -5 *(select COALESCE(utilisefidelite,0) from client where email = '$email') as NB;";
                $requete = $conn->prepare($requete);
                $requete->execute();
                $ligne = $requete->fetch();
                $nbAll = $ligne['nb'];
//                $nbAll = 5;
                ?>


                <div style="text-align: center;">
                    <div class="cadreFidelite">
                        <label class="titreFidelite">Ma fidélité : </label>
                        <hr class='my-2' Style='border-top:1px solid black;'  />
                        <div class="lesCarre">

                            <div class="petitCarre btn btn-success" name="carre"></div>
                            <div class="petitCarre btn btn-success" name="carre"></div>
                            <div class="petitCarre btn btn-success" name="carre"></div>
                            <div class="petitCarre btn btn-success" name="carre"></div>
                            <div class="GrosCarre btn btn-success" name="carre"></div>

<!--                            <div class="containtProgressBar">
                                <div class="progressBar" id="labarre"></div>
                            </div>-->
                        </div>

                    </div>

                </div>
            </div>

            <div style="width: 95%;display: inline-block;">
                <H4 class="titreDevis">Mes réparations</H4>
                <div class="demandeDevis">

                    <?php
                    $test = '"';
                    $t = "'";
                    $email = $_SESSION['email'];
                    $a = 0;
                    $requete = "select reparation.id,max(a.id_statut) as id_statut, modele.lib_modeele, reparation.numserie, reparation.daterestitution, reparation.heure from reparation
                                    inner join a ON a.id = reparation.id
                                    inner join modele ON modele.id_modele = reparation.id_modele
									where reparation.email = '$email'
									group by  reparation.id, modele.lib_modeele, reparation.numserie, reparation.daterestitution, reparation.heure
                                 order by reparation.id desc";
                    $requete = $conn->prepare($requete);
                    $requete->execute();
                    while ($ligne = $requete->fetch()) {
                        $modele = $ligne['lib_modeele'];
                        $numeserie = $ligne['numserie'];
                        $date = $ligne['daterestitution'];
                        $heure = $ligne['heure'];
                        $id = $ligne['id'];
                        $id_statut = $ligne['id_statut'];
                        $idCry = openssl_encrypt($id, "AES-128-ECB", 'lEdEvis26300aBz');
                        $disabled = '';
                        $iconDoc = '';
                        if ($id_statut >= 7) {
                            $fact_devi = 'viewFacture';
                        } else {
                            $fact_devi = 'viewdevis';
                        }
                        if ($id_statut == 1) {
                            $disabled = 'disabled=""';
                            $iconDoc = '<button class="btn btn-outline-primary" onclick="document.location.href = ' . $t . '/hitechlab/pdf/boitePdf.php?id=' . $idCry . ' ' . $t . '" style="margin-left:1%; margin-right:-4.5%;">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
  <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
  <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
</svg></button>';
                        }

                        $couleurDemande = 'laDemande';
                        if ($a != 0)
                            echo "<hr class='my-2' Style='border-top:1px solid black; ' />";

                        echo "<div class='$couleurDemande'>"
                        . "<div class='labelDsDevis noResponsive'> $id </div>"
                        . "<div class='labelDsDevis'> $modele </div>"
                        . "<div class='labelDsDevis noResponsive'> $numeserie </div>"
                        . "<div class='labelDsDevis'> $date </div>"
                        . "<div class='labelDsDevis noResponsive'> $heure </div>"
                        . "<button class='btn btn-primary' onclick='document.location.href=$test /hitechlab/partieclient/acceptationdevis/$fact_devi.php?id=$idCry $test' $disabled>  "
                        . "     <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
</svg>"
                        . "</button>"
                        . "<button class='btn btn-outline-primary' style='margin-left:1%;' onclick='document.location.href=$test /hitechlab/partieclient/suivi/suivi.php?id=$idCry $test'>"
                        . '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
  <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z"/>
  <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z"/>
</svg>' . "</button>"
                        . "$iconDoc"
                        . "</div>";
                        $a++;
                    }
                    ?>
                </div>
                <H4 class="titreDevis">Mes achats</H4>
                <div class="demandeDevis" style="margin-bottom: 1%;">
                    <!--                    <div class='titreInfoDevis'>
                                            <div class='labelDsAchat'> n° </div>
                                            <div class='labelDsAchat'> Date </div>
                                        </div>-->
                    <?php
                    $a = 0;
                    $email = $_SESSION['email'];
                    $requete = "select * from achat where email = '$email'";
                    $requete = $conn->prepare($requete);
                    $requete->execute();
                    while ($ligne = $requete->fetch()) {
                        $date = $ligne['datee'];
                        $id = $ligne['id_achat'];
                        $id_statut = $ligne['id_statut'];
                        $idCry = openssl_encrypt($id, "AES-128-ECB", 'lEdEvis26300aBz');

                        $couleurDemande = 'laDemande';
                        if ($a != 0)
                            echo "<hr class='my-2' Style='border-top:1px solid black; ' />";

                        echo "<div class='$couleurDemande'>"
                        . "<div class='labelDsAchat'> $id  </div>"
                        . "<div class='labelDsAchat'> $date </div>"
                        . "<button class='btn btn-primary' onclick='document.location.href=$test /hitechlab/partieClient/achat/achat.php?id=$idCry $test'>  "
                        . "     <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-eye-fill' viewBox='0 0 16 16'>
  <path d='M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z'/>
  <path d='M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z'/>
</svg>"
                        . "</button>"
                        . "</div>";
                        $a++;
                    }
                    ?>



                </div>

            </div>
        </div>


        <!-- libscript js -->
        <script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../../lib/js/main.js" type="text/javascript"></script>
        <script src="../../lib/js/popper.js" type="text/javascript"></script>




        <!-- fin de la page -->
        <script>
                document.getElementsByName('carre').length;
//                document.getElementById('labarre').style.width = '<?php echo $progress[$nbAll - 1] ?>';

                for (var i = 0, max = <?php echo $nbAll ?>; i < max; i++) {
                    document.getElementsByName('carre')[i].innerHTML = "<svg xmlns='http://www.w3.org/2000/svg' class='iconDsCarre bi bi-bag-check' fill='currentColor' viewBox='0 0 16 16'>" +
                            "<path fill-rule='evenodd' d='M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z'/>" +
                            "<path d='M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z'/></svg>";
                    document.getElementsByName('carre')[i].style.backgroundColor = 'green';
                    document.getElementsByName('carre')[i].style.transform = 'rotate(0deg)';

                }


        </script>




        <?php
        include '../../include/protectionSessionMembre.php';
        ?>


    </body>
</html>







