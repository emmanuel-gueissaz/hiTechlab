
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
        <link href="suivi.css" rel="stylesheet" type="text/css"/>

        <link href="../acceptationDevis/devis.css" rel="stylesheet" type="text/css"/>

    </head>
    <body id="body">

        <?php
        $idCrypt = openssl_decrypt($_GET['id'], "AES-128-ECB", 'lEdEvis26300aBz');
        $id = $idCrypt;

        try {
            $requete = "select id_statut, statut.lib_etat, datee,heure from a 
inner join statut ON statut.id = a.id_statut
where a.id = $id order by id_statut";
            $requete = $conn->prepare($requete);
            $requete->execute();
            $leStatut = 1;
            $lesDate = array();
            $id_statut = array();
            $lib_statut = array();
            while ($lignes = $requete->fetch()) {

                array_push($lesDate, date('d-m-Y', strtotime($lignes['datee'])));
                array_push($lib_statut, ($lignes['lib_etat']));
                array_push($id_statut, ($lignes['id_statut'] - 1));
                $leStatut = $lignes['id_statut'];
            }
        } catch (Exception $ex) {
            echo $ex;
        }
        ?>



        <?php include '../../include/MenuTopClient.php'; ?>

        <!-- debut de la page -->


        <div style="text-align: center;">
            <div style="display: inline-block;width: 90%; text-align: left;margin-bottom: 2%;">
                <h5 class="lableTitreView" >
                    Réparation n° <?php echo $idCrypt; ?> 
                </h5>
            </div>
            <div class="leSuivi">



                <div class="lesTiges">


                    <div class="tige"></div>
                    <div class="tige"></div>
                    <div class="tige"></div>
                    <div class="tige"></div>
                    <div class="tige"></div>
                    <div class="tige"></div>
                    <div class="tige"></div>


                    <!--<div style="display: inline-block; width: 8%; background-color: red;"></div>-->

                </div>

                <div style="text-align: center; " >

                    <div class="progress labarre">
                        <div class="progress-bar labarreProgress" id="labarreProgress" ></div>

                    </div>
                    <div class="lesDateTiges">
                        <?php
                        $a = 0;

                    
                        for ($index = 0; $index < 7; $index++) {

                            if ($id_statut[$a] == $index) {

                                if ($id_statut[$a] == $id_statut[count($id_statut) - 1]) {
                                    echo "<div class='dateTiges'>$lib_statut[$a]<br> $lesDate[$a]</div>";
                                } else {
                                    echo "<div class='dateTiges noResponsive'>$lib_statut[$a]<br> $lesDate[$a]</div>";
                                }

                                $a++;
                            } else {

                                echo "<div class='dateTiges noResponsive'></div>";
                                echo "<script>"
                                . "document.getElementsByClassName('tige')[$index].style.opacity= 0;"
                                . "</script>";
                            }
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>





        <!-- libscript js -->
        <script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../../lib/js/main.js" type="text/javascript"></script>
        <script src="../../lib/js/popper.js" type="text/javascript"></script>

        <?php
        $progress = array('7%', '21%', '35%', '50%', '64%', '78%', '100%'); // correspond a la longueur de la barre
        $couleur = array('orange', 'orange', 'red', 'green', 'orange', 'green', '#3e64ff'); // correspond a la couleur de la barre

        $nbRond = $leStatut;
        $leStatut--;




        echo "<script>
            document.getElementById('labarreProgress').style.width = '" . $progress[$leStatut] . "';
            document.getElementById('labarreProgress').style.backgroundColor = '" . $couleur[$leStatut] . "'
             var a = document.getElementsByClassName('tige').length;
               if(screen.width >768) {
               for (var i = 0, max = $nbRond; i < max; i++) {   
           document.getElementsByClassName('tige')[i].style.borderColor = '" . $couleur[$leStatut] . "';
                document.getElementsByClassName('tige')[i].style.height = '25px';
                document.getElementsByClassName('tige')[i].style.width = '25px';
                document.getElementsByClassName('tige')[i].style.marginLeft = '5.7%';
                document.getElementsByClassName('tige')[i].style.marginRight = '5.7%';

           
            }
          }
          else{
               for (var i = 0, max = $nbRond; i < max; i++) {   
           document.getElementsByClassName('tige')[i].style.borderColor = '" . $couleur[$leStatut] . "';
                document.getElementsByClassName('tige')[i].style.height = '20px';
                document.getElementsByClassName('tige')[i].style.width = '20px';
                document.getElementsByClassName('tige')[i].style.marginLeft = '3.5%';
                document.getElementsByClassName('tige')[i].style.marginRight = '3.5%';

           
            }   

}
           
            </script>";
        ?>




        <!-- fin de la page -->



        <div class="test"></div>

        <?php
//include '../../include/protectionSessionMembre.php';
        ?>


    </body>
</html>







