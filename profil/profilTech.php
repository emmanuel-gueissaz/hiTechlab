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




        <!-- JavaScript Bundle with Popper -->
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
                const url = new URL(window.location);
                url.searchParams.set('page', nPage);
                window.history.pushState({}, '', url);
                var lesMenu = document.getElementsByClassName('menuInfo');

                for (var i = 0, max = lesMenu.length; i < max; i++) {
                    if (lesMenu[i].getAttribute('aria-selected') == 'true') {
                        lesMenu[i].click();

                    }


                }
            }


        </script>

        <script>
            function affichePiece(btn) {
                var h = btn.style.height;
                var plus = document.getElementsByClassName('boutonPlus');
                if (h != '200px') {
                    btn.style.height = '200px';
                    btn.style.overflowY = 'scroll';

                } else {
                    btn.style.height = '40px';
                    btn.style.overflowY = 'hidden'

                }
            }

            function notif() {
                var lesRep = document.getElementById('AfficheLesRep');
                var notif = document.getElementById('lesNotif');
                if (lesRep.style.width == '60%') {
                    lesRep.style.width = '90%';
                    notif.style.width = '9%';

                } else {
                    lesRep.style.width = '60%';
                    notif.style.width = '39%';
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


                    <div class="lesReparation" >
                        <nav  >
                            <div class="nav nav-pills  " id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active menuInfo" id="nav-home-tab" data-toggle="tab" href="#nav-rep" role="tab" aria-controls="nav-rep" aria-selected="true"  onclick="load_reparation('<', 'nav-rep')">Retard </a>

                                <a class="nav-item nav-link menuInfo" id="nav-contact-tab" data-toggle="tab" href="#nav-piece" role="tab" aria-controls="nav-piece" aria-selected="false" onclick="load_reparation('=', 'nav-piece')">Réparation du jour</a>

                                <a class="nav-item nav-link menuInfo" id="nav-contact-tab" data-toggle="tab" href="#nav-fini" role="tab" aria-controls="nav-fini" aria-selected="false" onclick="load_reparation('>', 'nav-fini')">A venir</a>
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

            </div>

        </div>






        <!-- fin de la page -->

        <!-- script js -->

        <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../lib/js/main.js" type="text/javascript"></script>
        <script src="../lib/js/popper.js" type="text/javascript"></script>

        <script>

                                function load_reparation(condition, receptacle)
                                {

                                    let searchParams = new URLSearchParams(window.location.search);
                                    searchParams.has('page');
                                    let nPage = searchParams.get('page');
                                    var page = nPage * 30;
                                    $.ajax({
                                        url: 'ajax/afficheDevisTechnicien.php',
                                        method: 'post',
                                        data: {query: condition, page},
                                        success: function (data) {
                                            $('#' + receptacle).html(data);
                                        }
                                    });
                                }


                                load_reparation('<', 'nav-rep');
        </script>




        <!--protection de session -->
        <?php
        include '../include/ProtectSession.php';
        ?>
    </body>
</html>
