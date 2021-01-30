
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

        <link href="../lib/css/couleur.css" rel="stylesheet" type="text/css"/>
        <link href="profil.css" rel="stylesheet" type="text/css"/>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../include/alert.js" type="text/javascript"></script>
        <script>
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
                document.location.href = '?page=' + nPage;


            }
        </script>


    </head>
    <body>




        <?php include '../include/MenuTopClient.php'; ?>

        <!-- debut de la page -->

        <div style="text-align: center;">
            <div style="width: 95%; display: inline-block;">
                <div class="lesStat">


                    <?php
                    $test = '"';
                    $email = $_SESSION['email'];

                    $requete = "select  ROW_NUMBER() OVER()  from reparation inner join a ON a.id = reparation.id
where email_technicien ='$email' group by reparation.id having max(a.id_statut)=7 order by row_number desc limit 1";
                    $requete = $conn->prepare($requete);
                    $requete->execute();
                    $ligne = $requete->fetch();
                    $nbIntFini = $ligne['row_number'];
                    $total = $nbIntFini * 30;
                    echo "<div class='laStat'><div class='titreStat'>Nombre de réparation </div> <div class='donneStat'> $nbIntFini</div></div>";
                    echo "<div class='laStat'><div class='titreStat'>Total </div> <div class='donneStat'> $total €</div></div>";
                    ?>
                </div>
                <div >

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

                <div class="connexion" >
                    <nav>
                        <div class="nav nav-pills " id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active menuConnexion" id="nav-home-tab" data-toggle="tab" href="#nav-rep" role="tab" aria-controls="nav-rep" aria-selected="true"  onclick="load_reparation(4, 'nav-rep')">A réparer</a>

                            <a class="nav-item nav-link menuConnexion" id="nav-contact-tab" data-toggle="tab" href="#nav-piece" role="tab" aria-controls="nav-piece" aria-selected="false" onclick="load_reparation(5, 'nav-piece')">Attente de pièce</a>

                            <a class="nav-item nav-link menuConnexion" id="nav-contact-tab" data-toggle="tab" href="#nav-fini" role="tab" aria-controls="nav-fini" aria-selected="false" onclick="load_reparation(7, 'nav-fini')">Fini</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">

                        <div class="tab-pane fade show active" id="nav-rep" role="tabpanel" aria-labelledby="nav-home-tab">



                        </div>

                        <div class="tab-pane fade" id="nav-piece" role="tabpanel" aria-labelledby="nav-contact-tab">


                        </div>
                        <div class="tab-pane fade" id="nav-fini" role="tabpanel" aria-labelledby="nav-contact-tab">


                        </div>
                    </div>
                </div>


            </div> 
        </div> 

        <!-- libscript js -->
        <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../lib/js/main.js" type="text/javascript"></script>
        <script src="../lib/js/popper.js" type="text/javascript"></script>


        <script>

                                function load_reparation(statut, receptacle)
                                {

                                    $.ajax({
                                        url: 'ajax/afficheDevisInformaticien.php',
                                        method: 'post',
                                        data: {query: statut},
                                        success: function (data) {
                                            $('#' + receptacle).html(data);
                                        }
                                    });
                                }
        </script>






        <?php
        include '../include/protectionSessionMembre.php';
        ?>



    </body>
</html>







