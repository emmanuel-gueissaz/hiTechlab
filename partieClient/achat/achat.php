
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
        <link href="../acceptationDevis/devis.css" rel="stylesheet" type="text/css"/>
        <link href="../../achat/achat.css" rel="stylesheet" type="text/css"/>

        <link href="../../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../../include/alert.js" type="text/javascript"></script>
        <link href="../../reglement/reglement.css" rel="stylesheet" type="text/css"/>

        <script>
            function afficheReg(id) {
                var affiche = document.getElementById(id);
                var hauteur = affiche.offsetHeight;
                if (hauteur == 0) {
                    document.getElementById('cadreView').style.height = '400px';
                } else {
                    document.getElementById('cadreView').style.height = '0px';
                }

            }


        </script>
    </head>
    <body>





        <?php include '../../include/MenuTopClient.php'; ?>

        <!-- debut de la page -->



        <div style="text-align: center;" >
            <div style="display: inline-block; width: 95%;">
                <h5 class="lableTitreView" >
                    <?php $idDecrypt = openssl_decrypt($_GET['id'], "AES-128-ECB", 'lEdEvis26300aBz'); ?> 
                    Achat n° <?php echo $idDecrypt; ?> 
                </h5>
                <div class="boutonHautDevis">
                    <input type="button" class="btn btn-outline-secondary" onclick="afficheReg('cadreView')" value="Voir les règlements"/>
                    <button onclick="document.location.href = 'tel:+33780558823';" class="btn btn-outline-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                        <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                        </svg>
                    </button>


                </div>
                <div class="cadreView" id="cadreView">
                    <div class='unReglement'>
                        <label class="titreReglement">Les règlements:</label>
                        <div class='infoReglementLong noResponsive'>libellé </div>
                        <div class='infoReglement '>Date</div>
                        <div class='infoReglement noResponsive'>Heure</div>
                        <div class='infoReglement'>Type de règlement</div>
                        <div class='infoReglement'> Montant </div>
                    </div>
                    <?php
                    $requete = "select  id_reglement,notereglement, datereg,heurereg, lib_reg, prix from reglement 
                                    inner join type_reglement ON type_reglement.id_reg = reglement.id_type_reg
                                    where id_achat = $idDecrypt";
                    $requete = $conn->prepare($requete);
                    $requete->execute();

                    while ($ligne = $requete->fetch()) {
                        $id_reglement = $ligne['id_reglement'];
                        $notereglement = $ligne['notereglement'];
                        $datereg = $ligne['datereg'];
                        $heurereg = $ligne['heurereg'];
                        $lib_reg = $ligne['lib_reg'];
                        $prix = $ligne['prix'];
                        echo "<hr class='my-2' Style='border-top:1px solid black; ' />";
                        echo"<div class='unReglement'>";
                        echo "<div class='infoReglementLong noResponsive'>" . $notereglement . "</div>";
                        echo "<div class='infoReglement'>" . $datereg . "</div>";
                        echo "<div class='infoReglement noResponsive'>" . $heurereg . "</div>";
                        echo "<div class='infoReglement'>" . $lib_reg . "</div>";
                        echo "<div class='infoReglement'>" . $prix . " €</div>";
                        echo "</div>";
                    }
                    ?>
                    <?php
                    $requete = "select datee,montant from utiliser_achat                   
                                    where id_achat = $idDecrypt";
                    $requete = $conn->prepare($requete);
                    $requete->execute();
                    while ($ligne = $requete->fetch()) {
                        $datee = $ligne['datee'];
                        $montant = $ligne['montant'];
                        $prix = $ligne['montant'];

                        echo "<hr class='my-2' Style='border-top:1px solid black; ' />";
                        echo"<div class='unReglement'>";
                        echo "<hr class='my-2' Style='border-top:1px solid black; ' />";
                        echo "<div class='infoReglementLong noResponsive'>Avoir</div>";
                        echo "<div class='infoReglement'>" . $datee . "</div>";
                        echo "<div class='infoReglement noResponsive'></div>";
                        echo "<div class='infoReglement noResponsive'></div>";
                        echo "<div class='infoReglement'><div class='inputMontantLg'> $montant €</div></div>";




                        echo "</div>";
                    }
                    ?>

                </div>

                <div class="cadreAccessoire" >


                    <?php
                    $t = '"';
                    $total = 0;
                    $a = 0;
                    $requete = "select  accessoire.id,nom, modele.lib_modeele, qte, accessoire.prixvente,accessoire.matiere  from accessoire 
                            inner join inclut ON inclut.id_accessoire = accessoire.id
                            inner join modele ON modele.id_modele = accessoire.id_modele
                            where inclut.id_achat = $idDecrypt";
                    $requete = $conn->prepare($requete);
                    $requete->execute();
                    while ($lignes = $requete->fetch()) {
                        $id = $lignes['id'];
                        $nom = $lignes['nom'];
                        $lib_modeele = $lignes['lib_modeele'];
                        $qte = $lignes['qte'];
                        $prixvente = $lignes['prixvente'];
                        $matiere = $lignes['matiere'];
                        $total += $prixvente * $qte;
                        if ($a != 0) {
                            echo "<hr class='my-2' Style='border-top:1px solid black; ' />";
                        }

                        echo "<div class='unAccessoire'>"
                        . "<div class='blockImg' >"
                        . "<img class='imageAccessoire' src='../../boutique/image/$id.png'/>"
                        . "</div>"
                        . "<div class='infoAccessoire'>"
                        . "<label class='titreInfoAccessoire' style=' cursor: pointer;' >$nom</label>"
                        . "<label class='labelInfoAccessoire'>Modèle : <span class='badge badge-secondary'> $lib_modeele</span></label>"
                        . "<label class='labelInfoAccessoire'>Matière : <span class='badge badge-secondary'> $matiere</span></label>"
                        . "<label class='labelInfoAccessoire'>Quantité : <span class='badge badge-secondary'> $qte</span></label>"
                        . "</div>"
                        . "<div class='prixAccesoire'>"
                        . "<label class='titreInfoAccessoire' style=' cursor: pointer;'>$prixvente €</label>"
                        . "</div></div>";
                        $a++;
                    }
                    ?>
                </div>

                <div class="cadreAccessoire">
                    <?php
                    $requete = "select * from remise inner join peut ON peut.id_remise = remise.id_remise where peut.id_achat = $idDecrypt";
                    $requete = $conn->prepare($requete);
                    $requete->execute();

                    while ($ligne = $requete->fetch()) {

                        $id_remise = $ligne['id_remise'];
                        $lib_remise = $ligne['lib_remise'];
                        $tarif = $ligne['montant'];



                        $total -= $tarif;

                        echo "<div class='blockImg' ></div>";
                        echo "<div class='infoAccessoire'><label class='titreInfoAccessoire'> $lib_remise  </label></div>";
                        echo "<div class='prixAccesoire'><label class='titreInfoAccessoire' > -$tarif  €</label></div>";
                    }
                    ?>
                </div>
                <div  class="totalPiece" >
                    Total : <?php echo $total ?> €
                </div>


            </div>
        </div>

        <!-- libscript js -->
        <script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../../lib/js/main.js" type="text/javascript"></script>
        <script src="../../lib/js/popper.js" type="text/javascript"></script>





        <!-- fin de la page -->






        <?php
//include '../../include/protectionSessionMembre.php';
        ?>


    </body>
</html>







