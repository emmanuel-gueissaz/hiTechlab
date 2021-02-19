
<?php
include '../BDD/connexionBdd.php';
?>
<!doctype html>


<html lang="fr">
    <head>
        <title>HI-TECH LAB</title>
        <meta charset="utf-8">



        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">	
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


        <link href="tableauDeBord.css" rel="stylesheet" type="text/css"/>
        <link href="../lib/css/couleur.css" rel="stylesheet" type="text/css"/>
        <link href="../reparation/reparation.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
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





                <div style="text-align: center">

                    <div class="chiffre">
                        <div class="totalCol">
                            <label class="titreColTotal">Semaine  <?php echo date('W') ?></label>
                            <?php
                            $requete = "select * from calculca();";
                            $requete = $conn->prepare($requete);
                            $requete->execute();
                            $ligne = $requete->fetch();
                            $CA = $ligne['leca'];
                            $reg = $ligne['lesreg'];
                            $benef = $ligne['benefice'];
                            echo "<div class='donnechiffre'><div class='titredonnechiffre'>Chiffre d'affaire </div><div class='valuedonnechiffre'> $CA €</div></div>";
                            echo " <hr class='my-1 donnechiffre' />";
                            echo "<div class='donnechiffre'><div class='titredonnechiffre'>Encaissé </div><div class='valuedonnechiffre'> $reg €</div></div>";
                            echo " <hr class='my-1 donnechiffre' />";
                            echo "<div class='donnechiffre'><div class='titredonnechiffre'>Bénéfice </div><div class='valuedonnechiffre'> $benef €</div></div>";
                            ?>
                        </div>
                        <div class="totalCol">
                            <label class="titreColTotal"> Aujourd'hui</label>
                            <?php
                            $requete = "select * from calculcadujour();";
                            $requete = $conn->prepare($requete);
                            $requete->execute();
                            $ligne = $requete->fetch();
                            $CA = $ligne['leca'];
                            $reg = $ligne['lesreg'];
                            $benef = $ligne['benefice'];
                            echo "<div class='donnechiffre'><div class='titredonnechiffre'>Chiffre d'affaire </div><div class='valuedonnechiffre'> $CA €</div></div>";
                            echo " <hr class='my-1 donnechiffre' />";
                            echo "<div class='donnechiffre'><div class='titredonnechiffre'>Encaissé </div><div class='valuedonnechiffre'> $reg €</div></div>";
                            echo " <hr class='my-1 donnechiffre' />";
                            echo "<div class='donnechiffre'><div class='titredonnechiffre'>Bénéfice </div><div class='valuedonnechiffre'> $benef €</div></div>";
                            ?>
                        </div>

                    </div>


                    <div class="lesReparationtb">
                        <nav>
                            <div class="nav nav-pills " id="nav-tab" role="tablist" >

                                <a class=" nav-item nav-link menuTabRep active " id="nav-contact-tab" data-toggle="tab" href="#nav-demande" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="load_reparation(1, 'nav-demande')">
                                    Demande de Devis 
                                    <span class="badge bouttonChiffre"  id="demande"></span>
                                </a>
                                <a class=" nav-item nav-link menuTabRep  " id="nav-contact-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="load_reparation(2, 'nav-home')">
                                    Devis en attente 
                                    <span class="badge bouttonChiffre"  id="attent"></span>
                                </a>

                                <a class="nav-item nav-link menuTabRep" id="nav-home-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-home" aria-selected="true"  onclick="load_reparation(4, 'nav-contact')">
                                    Devis accepté
                                    <span class="badge bouttonChiffre " id="accepte"></span>
                                </a>

                                <a class="nav-item nav-link menuTabRep" id="nav-contact-tab" data-toggle="tab" href="#nav-attente-piece" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="load_reparation(5, 'nav-attente-piece')">
                                    Attente de pièce
                                    <span class="badge bouttonChiffre" id="attentp"></span>
                                </a>

                                <a class="nav-item nav-link menuTabRep" id="nav-contact-tab" data-toggle="tab" href="#nav-reg" role="tab" aria-controls="nav-contact" aria-selected="false" onclick="load_reparation(6, 'nav-reg')">
                                    Attente de règlement
                                    <span class="badge bouttonChiffre" id="repare"></span>
                                </a>

                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">

                            <div class="tab-pane fade show active" id="nav-demande" role="tabpanel" aria-labelledby="nav-home-tab" > 

                            </div>
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                            </div>

                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">


                            </div>

                            <div class="tab-pane fade" id="nav-attente-piece" role="tabpanel" aria-labelledby="nav-contact-tab">

                            </div>

                            <div class="tab-pane fade" id="nav-reg" role="tabpanel" aria-labelledby="nav-contact-tab">

                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
        
   



        <!-- fin de la page -->

        <!-- mes script js-->



        <!-- libscript js -->

        <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../lib/js/main.js" type="text/javascript"></script>
        <script src="../lib/js/popper.js" type="text/javascript"></script>



        <script>

                                    function load_reparation(statut, receptacle)
                                    {

                                        $.ajax({
                                            url: 'ajax/afficheReparation.php',
                                            method: 'post',
                                            data: {query: statut},
                                            success: function (data) {
                                                $('#' + receptacle).html(data);
                                            }
                                        });
                                    }
                                    function load_compteur(mat, marque)
                                    {

                                        $.ajax({
                                            url: "ajax/compteur.php",
                                            method: "post",
                                            data: {query: mat, marque},
                                            success: function (data)
                                            {
                                                var tab = data;

                                                tab = tab.split(',');
                                                $('#demande').html(tab[0]);
                                                $('#attent').html(tab[1]);
                                                $('#accepte').html(tab[2]);
                                                $('#attentp').html(tab[3]);
                                                $('#repare').html(tab[4]);

                                            }
                                        });
                                    }
                                    load_compteur();
                                    setInterval('load_compteur()', 30000);
                                    load_reparation(1, 'nav-demande')




        </script>
        <?php include '../include/ProtectSession.php'; ?>

    </body>


</html>







