
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

        <link href="fidelite.css" rel="stylesheet" type="text/css"/>
        <script src="../../include/alert.js" type="text/javascript"></script>
    </head>
    <body>





        <?php include '../../include/MenuTopClient.php'; ?>

        <!-- debut de la page -->
        <?php
        $email = $_SESSION['email'];
        $progress = array('15%', '32%', '50%', '65%', '85%',); // correspond a la longueur de la barre
        $requete = "select ((select count(*) from reparation where email = '$email') 
		+ (select count(*) from achat where email = '$email')) 
                -5 *(select COALESCE(utilisefidelite,0) from client where email = '$email') as NB;";
        $requete = $conn->prepare($requete);
        $requete->execute();
        $ligne = $requete->fetch();
        $nbAll = $ligne['nb'];
//        $nbAll = 5;
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

                    <div class="GrosCarre btn btn-success" name="carre">

                    </div>

                    <div class="containtProgressBar">
                        <div class="progressBar" id="labarre"></div>
                    </div>
                </div>

            </div>

        </div>
        <!-- libscript js -->
        <script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../../lib/js/main.js" type="text/javascript"></script>
        <script src="../../lib/js/popper.js" type="text/javascript"></script>



        <script>
            document.getElementsByName('carre').length;
            document.getElementById('labarre').style.width = '<?php echo $progress[$nbAll - 1] ?>';

            for (var i = 0, max = <?php echo $nbAll ?>; i < max; i++) {
                document.getElementsByName('carre')[i].innerHTML = "<svg xmlns='http://www.w3.org/2000/svg' class='iconDsCarre' fill='currentColor' class='bi bi-bag-check' viewBox='0 0 16 16'>" +
                        "<path fill-rule='evenodd' d='M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z'/>" +
                        "<path d='M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z'/></svg>";
                document.getElementsByName('carre')[i].style.backgroundColor = 'green';
                document.getElementsByName('carre')[i].style.transform = 'rotate(360deg)';
                     
            }


        </script>



        <!-- fin de la page -->


        <?php
        include '../../include/protectionSessionMembre.php';
        ?>


    </body>
</html>






