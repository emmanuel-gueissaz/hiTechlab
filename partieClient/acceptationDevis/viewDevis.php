
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
        <link href="devis.css" rel="stylesheet" type="text/css"/>
        <link href="../../pdf/facture.css" rel="stylesheet" type="text/css"/>
        <link href="../../reparation/reparation.css" rel="stylesheet" type="text/css"/>
        <link href="../../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../../include/alert.js" type="text/javascript"></script>



        <script>
            function test(id) {
                var affiche = document.getElementById(id);
                var hauteur = affiche.offsetHeight;
                if (hauteur == 0) {
                    document.getElementById('cadreView').style.height = '600px';
                } else {
                    document.getElementById('cadreView').style.height = '0px';
                }

            }


        </script>
    </head>
    <body>





        <?php include '../../include/MenuTopClient.php'; ?>

        <!-- debut de la page -->

        <?php
        $num = openssl_decrypt($_GET['id'], "AES-128-ECB", 'lEdEvis26300aBz');
        ?>

        <div style="text-align: center;" >
            <h5 class="lableTitreView" >
                Devis n° <?php echo $num; ?> 
            </h5>
            <div class="boutonHautDevis">
                <input type="button" class="btn btn-outline-secondary" onclick="test('cadreView')" value="Voir les rapports"/>
                <input type="button" class="btn btn-outline-secondary" onclick="window.open('/hitechlab/pdf/leDevisPdf.php?id=<?php echo $_GET['id'] ?>')" value="PDF"/>


                <button onclick="document.location.href = 'tel:+33780558823';" class="btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                    </svg>
                </button>


            </div>
            <div class="cadreView" id="cadreView">
                <h3 class="titreRapport">  Rapport client : </h3>  
                <h3 class="titreRapport noResponsive"> Rapport technicien : </h3>  

                <div class="rapporttech" id="rapport">
                    <div style="display: inline-block; width: 46%;">
                        <h3 class="labelCheckRange"> Affichage : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Tactile : </h3>  <input  class="checkRapport"type="checkbox" name="rapport[]"  disabled="" />
                        <h3 class="labelCheckRange"> Bouton volume haut : </h3>                     <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange"> Bouton volume bas : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]" disabled=""/>
                        <h3 class="labelCheckRange">Bouton power : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Lecteur d'empreinte : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Caméra avant : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Caméra arrière : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Son haut-parleurs : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Son écouteur : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>

                    </div>
                    <div style="display: inline-block; width: 46%;">
                        <h3 class="labelCheckRange">Connecteur de charge : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]" disabled=""/>
                        <h3 class="labelCheckRange">Autonomie : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Prise écouteur : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Réseaux : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Wifi : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Flash : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Bluetooth : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">GPS : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Capteur lumière  : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                        <h3 class="labelCheckRange">Capteur proximité  : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                    </div>
                    <h4 class="labelCheckSpec">Dans quel état est l'écran :</h4>  <br>
                    <h3 class="labelCheck">Intact   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                    <h3 class="labelCheck">Micro-rayures   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                    <h3 class="labelCheck">Rayures   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]"  disabled=""/>
                    <h3 class="labelCheck">Cassé   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]" disabled=""/>
                    <h4 class="labelCheckSpec">Quel est l'état de la coque :</h4>  <br>
                    <h3 class="labelCheck">Intact   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]" disabled=""/>
                    <h3 class="labelCheck">Micro-rayures   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]" disabled=""/>
                    <h3 class="labelCheck">Rayures   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]" disabled=""/>
                    <h3 class="labelCheck">Cassé   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]" disabled=""/>

                    <h3 class="labelCheck">Le tiroir SIM est-il présent ? </h3>  <input class="checkRapport" type="checkbox" name="rapport[]" disabled=""/>





                </div>
                <h3 class=" responsive"> Rapport technicien : </h3>  
                <div class="rapporttech"  >
                    <div style="display: inline-block; width: 46%;">
                        <h3 class="labelCheckRange"> Affichage : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled="" />
                        <h3 class="labelCheckRange">Tactile : </h3>  <input  class="checkRapport"type="checkbox" name="rapportTech[]"  disabled="" />
                        <h3 class="labelCheckRange"> Bouton volume haut : </h3>   <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                        <h3 class="labelCheckRange"> Bouton volume bas : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled="" />
                        <h3 class="labelCheckRange">Bouton power : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]"  disabled=""  />
                        <h3 class="labelCheckRange">Lecteur d'empreinte : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]"  disabled=""  />
                        <h3 class="labelCheckRange">Caméra avant : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                        <h3 class="labelCheckRange">Caméra arrière : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                        <h3 class="labelCheckRange">Son haut-parleurs : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                        <h3 class="labelCheckRange">Son écouteur : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />

                    </div>
                    <div style="display: inline-block; width: 46%;">
                        <h3 class="labelCheckRange">Connecteur de charge : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled="" />
                        <h3 class="labelCheckRange">Autonomie : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                        <h3 class="labelCheckRange">Prise écouteur : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""   />
                        <h3 class="labelCheckRange">Réseaux : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                        <h3 class="labelCheckRange">Wifi : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                        <h3 class="labelCheckRange">Flash : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]"  disabled="" />
                        <h3 class="labelCheckRange">Bluetooth : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                        <h3 class="labelCheckRange">GPS : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                        <h3 class="labelCheckRange">Capteur lumière  : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                        <h3 class="labelCheckRange">Capteur proximité  : </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                    </div>
                    <h4 class="labelCheckSpec">Dans quel état est l'écran :</h4>  <br>
                    <h3 class="labelCheck">Intact   : </h3> <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                    <h3 class="labelCheck">Micro-rayures   : </h3> <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                    <h3 class="labelCheck">Rayures   : </h3> <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />
                    <h3 class="labelCheck">Cassé   : </h3> <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled="" />
                    <h4 class="labelCheckSpec">Quel est l'état de la coque :</h4>  <br>
                    <h3 class="labelCheck">Intact   : </h3> <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled="" />
                    <h3 class="labelCheck">Micro-rayures   : </h3> <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled="" />
                    <h3 class="labelCheck">Rayures   : </h3> <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled="" />
                    <h3 class="labelCheck">Cassé   : </h3> <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled=""  />

                    <h3 class="labelCheck">Le tiroir SIM est-il présent ? </h3>  <input class="checkRapport" type="checkbox" name="rapportTech[]" disabled="" />

                </div>

            </div>


            <div class="leDevis">


                <?php
                $nDevis = $num;

                $requete = "select * from reparation inner join modele on modele.id_modele = reparation.id_modele
         inner join a ON a.id = reparation.id
         inner join marque ON marque.id_marque = modele.id_marque
         where reparation.id = $nDevis
               and a.id_statut <=2
         order by a.id_statut desc
         limit 1";
                $requete = $conn->prepare($requete);
                $requete->execute();
                $ligne = $requete->fetch();
                $email = $ligne['email'];
                $modele = $ligne['lib_modeele'];
                $heure = $ligne['heure'];
                $date = date('d-m-Y', strtotime($ligne['datee']));
                $dateValiditeDevis = date('d-m-Y', strtotime($date . ' + 14 days'));
                $nomMarque = $ligne['nom'];
                $numeserie = $ligne['numserie'];
                $notevisiblebon = $ligne['notevisiblebon'];



                $requete = "select * from client where email = '$email'";
                $requete = $conn->prepare($requete);
                $requete->execute();
                $ligne = $requete->fetch();
                $nom = $ligne['nom'];
                $prenom = $ligne['prenom'];
                $tel = $ligne['tel'];
                $rue = $ligne['rue'];
                $cpost = $ligne['cpost'];
                $ville = $ligne['ville'];


                $requete = "select * from boutique";
                $requete = $conn->prepare($requete);
                $requete->execute();
                $ligne = $requete->fetch();
                $nomBoutique = $ligne['nom'];
                $telBoutique = $ligne['tel'];
                $emailBoutique = $ligne['email'];
                $rueBoutique = $ligne['rue'];
                $cpostBoutique = $ligne['cpost'];
                $villeBoutique = $ligne['ville'];
                ?>


                <div class="info">

                    <label class="titreInfo">Entreprise :</label>
                    <label class="labelInfo"><?php echo $nomBoutique ?></label>
                    <label class="labelInfo"><?php echo $rueBoutique ?></label>
                    <label class="labelInfo"><?php echo $cpostBoutique . ' ' . $villeBoutique ?></label>
                    <label class="labelInfo"><?php echo $emailBoutique ?></label>
                    <label class="labelInfo"><?php echo $telBoutique ?></label>


                </div>

                <div class="info">
                    <label class="titreInfo">Client :</label>
                    <label class="labelInfo"><?php echo $nom . ' ' . $prenom ?></label>
                    <label class="labelInfo"><?php echo $rue ?></label>
                    <label class="labelInfo"><?php echo $cpost . ' ' . $ville ?></label>
                    <label class="labelInfo"><?php echo $email ?></label>
                    <label class="labelInfo"><?php echo $tel ?></label>

                </div>

                <div style="width: 70%; ">
                    <table style="width: 100%; text-align: center; margin-left: 5%; margin-top: 2%; ">
                        <tr >
                            <td class="titrecolonneWeb" style="width:  20%;">Marque </td>
                            <td class="titrecolonneWeb" style="width:  15%;">Modèle </td>
                            <td class="titrecolonneWeb" style="width:  25%;">IMEI / N°serie </td>
                            <td class="titrecolonneWeb" style="width:  20%;">Date</td>

                        </tr>
                        <tr >
                            <td class="infoColonneWeb"> <?php echo $nomMarque; ?> </td>
                            <td class="infoColonneWeb" ><?php echo $modele; ?></td>
                            <td class="infoColonneWeb" ><?php echo $numeserie; ?></td>
                            <td class="infoColonneWeb" ><?php echo $date . ' ' . $heure ?></td>

                        </tr>
                    </table>

                </div>


                <br>

                <div style="width: 92%; ">
                    <table  style="width: 100%; text-align: center; margin-left: 4%; margin-top: 2%;" >


                        <tr >
                            <td class="titrecolonneWeb" style="width:  40%;">Interventions </td>
                            <td class="titrecolonneWeb" style="width:  10%;">PU HT</td>
                            <td class="titrecolonneWeb" style="width:  12%;">Qte</td>
                            <td class="titrecolonneWeb" style="width:  13%;">TVA</td>
                            <td class="titrecolonneWeb" style="width:  15%;">Total HT</td>
                        </tr>

                        <?php
                        $requete = "select * from forfait 
INNER join prend ON prend.id_forfait = forfait.id_forfait
inner join reparation ON reparation.id = prend.id
where reparation.id = $nDevis";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        while ($ligne = $requete->fetch()) {
                            $nom_forfait = $ligne['nom_forfait'];
                            $tarif = $ligne['tarif'];
                            $qte = $ligne['qte'];
                            $total = $tarif * $qte;
                            $montantTotal += $total;

                            echo "
         <tr style='text-align: center;'>
            <td class='infoColonneWeb' style='width:  40%;'>$nom_forfait </td>
            <td class='infoColonneWeb' style='width:  12%;'>$tarif €</td>
            <td class='infoColonneWeb' style='width:  10%;'>$qte</td>
            <td class='infoColonneWeb' style='width:  13%;'>TVA non applicable</td>
            <td class='infoColonneWeb' style='width:  15%;'> $total € </td>
                
        </tr>";
                        }

                        $requete = "select * from remise inner join compter ON compter.id_remise = remise.id_remise where compter.id_reparation = $nDevis";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        while ($ligne = $requete->fetch()) {
                            $lib_remise = $ligne['lib_remise'];
                            $tarif = $ligne['montant'];


                            $montantTotal -= $tarif;

                            echo "
         <tr style='text-align: center;'>
            <td class='infoColonneWeb' style='width:  40%;'>$lib_remise </td>
            <td class='infoColonneWeb' style='width:  12%;'>-$tarif €</td>
            <td class='infoColonneWeb' style='width:  10%;'>1</td>
            <td class='infoColonneWeb' style='width:  13%;'>TVA non applicable</td>
            <td class='infoColonneWeb' style='width:  15%;'>-$tarif € </td>
                
        </tr>";
                        }
                        ?>

                    </table>

                    <table style="width: 100%; text-align: center; margin-left: 5%; margin-top: 2%; ">


                        <tr >
                            <td class="titrecolonneWeb" style="width:  40%;">Accessoires </td>
                            <td class="titrecolonneWeb" style="width:  10%;">PU HT</td>
                            <td class="titrecolonneWeb" style="width:  12%;">Qte</td>
                            <td class="titrecolonneWeb" style="width:  13%;">TVA</td>
                            <td class="titrecolonneWeb" style="width:  15%;">Total HT</td>
                        </tr>
                        <?php
                        $requete = "select  accessoire.id,nom, qte, accessoire.prixvente  from accessoire 
                            inner join ajout ON ajout.id_accessoire = accessoire.id
                            where ajout.id_rep = $nDevis";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        while ($ligne = $requete->fetch()) {
                            $id = $ligne['id'];
                            $lib_remise = $ligne['nom'];
                            $tarif = $ligne['prixvente'];
                            $qte = $ligne['qte'];
                            $total = $tarif * $qte;
                            $montantTotal += $total;

                            echo "
         <tr style='text-align: center;'>
            <td class='infoColonneWeb' style='width:  40%;'>$lib_remise  </td>
            <td class='infoColonneWeb' style='width:  12%;'>$tarif €</td>
            <td class='infoColonneWeb' style='width:  10%;'>$qte</td>
            <td class='infoColonneWeb' style='width:  13%;'>TVA non applicable</td>
            <td class='infoColonneWeb' style='width:  15%;'>$total € </td>
                
        </tr>";
                        }
                        ?>
                    </table>

                    <table style="width: 100%; text-align: center; margin-left: 5%; margin-top: 2%; ">
                        <tr>
                            <td  style="width:  60%;"> </td>
                            <td style="width:  34%;">TVA non applicable, art. 293B du CGI
                            </td>
                        </tr>
                    </table>

                    <table style="width: 100%; text-align: center; margin-left: 4%; margin-top: 2%; ">
                        <tr>
                            <td  style="width:  64%;"> </td>
                            <td class="titrecolonne" style="width:  28%;">Total HT</td>
                        </tr>
                        <tr>
                            <td  style="width:  64%;"> </td>
                            <td class="infoColonne" style="width:  28%;"><?php echo $montantTotal ?> €</td>
                        </tr>
                    </table>

                    <div class="basPageDevis">
                        Devis valide jusqu'au : <?php echo $dateValiditeDevis; ?><br>
                        Pour tout diagnostic informatique et ou téléphonie, nécessitant une prise en charge avec tests de composants et
                        ouverture de tout appareil électronique, un minimum de 40€ de "diagnostic avancé" sera dû qu'il y ai ou non résolution
                        de la panne ou refus d'un devis ayant nécessité des tests avant intervention.

                        <br>
                        <b>Conditions ou informations spécifiques à la vente / prestation: </b> 


                        <div > <?php echo $notevisiblebon; ?> </div>

                    </div>



                </div>

                <form method="POST" class="ValidationDevis">
                    <input type="submit" class="btn btn-outline-secondary btn-lg " value="Refuser" name="refuser" style="width: 100%;" id="refuser"/>
                </form>
                <form method="POST" class="ValidationDevis" >
                    <input type="submit" class="btn btn-outline-success btn-lg " value="Accepter" name="accepter" style="width: 100%;"  id="accepter"/> 
                </form>




            </div>
        </div>

        <!-- libscript js -->
        <script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../../lib/js/main.js" type="text/javascript"></script>
        <script src="../../lib/js/popper.js" type="text/javascript"></script>

        <?php
        $requete = "select id_statut from a where id = $num order by id_statut desc limit 1";
        $requete = $conn->prepare($requete);
        $requete->execute();
        $ligne = $requete->fetch();
        $statut = $ligne['id_statut'];
        if ($statut >= 4) {
            echo " <script>
        
        document.getElementById('refuser').disabled = true;       
            </script>";
        }
        ?>



        <!-- fin de la page -->

        <?php
        $requete = "select * from reparation inner join modele ON modele.id_modele = reparation.id_modele where id=$num;";
        $requete = $conn->prepare($requete);
        $requete->execute();
        $ligne = $requete->fetch();
        $marque = $ligne['id_marque'];
        $modele = $ligne['id_modele'];
        $serie = $ligne['numserie'];

        $rapport = $ligne['rapportcli'];
        $rapportTech = $ligne['rapporttech'];

// script pour découper le tableau boolean et permet d'afficher le rapport

        echo "<script>var temp = '$rapport';
                        temp = temp.replace('{','');
                        temp = temp.replace('}','');
                        temp = temp.split(',');
                          lerapport = document.getElementsByName('rapport[]');
                           for (var i = 0; i < temp.length; i++) {
                           if(temp[i]=='t'){
                             lerapport[i].checked = true;
                            }

                            }
                            

                  </script>";

        echo "<script>var temp = '$rapportTech';
                        temp = temp.replace('{','');
                        temp = temp.replace('}','');
                        temp = temp.split(',');
                        
                        var rapportCli = '$rapport';
                        rapportCli = rapportCli.replace('{','');
                        rapportCli = rapportCli.replace('}','');
                        rapportCli = rapportCli.split(',');
                         

                          lerapport = document.getElementsByName('rapportTech[]');
                           for (var i = 0; i < temp.length; i++) {
                           if(temp[i]=='t'){
                            lerapport[i].checked = true;
                            if(rapportCli[i]!='t'){
                             lerapport[i].className = 'checkTest' ;
                            }
                            
                            }

                            }
                            

                  </script>";




        if (isset($_POST['refuser'])) {
            $id = $num;
            $t = "'";

            try {
                $insert = "insert into a (id, id_statut,datee,heure)values ($id,3, current_date, LOCALTIME(0));";
                $requete = $conn->prepare($insert);
                $requete->execute();
                echo '<script> alert_info_confirms("Vous avez refusé le devis." , "question", "/hitechlab/partieclient/acceptationdevis/viewdevis.php")</script>';
            } catch (Exception $ex) {
                echo '<script> alert_info_confirms("Vous avez refusé le devis." , "question", "/hitechlab/partieclient/acceptationdevis/viewdevis.php")</script>';
            }
        }
        if (isset($_POST['accepter'])) {
            $id = $num;
            $idCry = $_GET['id'];
            try {
                $insert = "insert into a (id, id_statut,datee,heure)values ($id,4, current_date, LOCALTIME(0));";
                $requete = $conn->prepare($insert);
                $requete->execute();
                echo "<script> alert_info_redirect('Devis accepté', 'success','/hitechlab/partieclient/acceptationdevis/viewdevis.php?id=$idCry')</script>";
            } catch (Exception $ex) {
                $requete = "update a  set (datee,heure) = (current_date, LOCALTIME(0)) where id = $id and id_statut = 4;";
                $requete = $conn->prepare($requete);
                $requete->execute();
                echo "<script> alert_info_redirect('Devis Re-accepté', 'success','/hitechlab/partieclient/acceptationdevis/viewdevis.php?id=$idCry')</script>";
            }
        }
        ?>






        <?php
//include '../../include/protectionSessionMembre.php';
        ?>


    </body>
</html>







