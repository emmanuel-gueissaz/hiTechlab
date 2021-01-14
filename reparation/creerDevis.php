


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
        <link href="reparation.css" rel="stylesheet" type="text/css"/>

        <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script>


            function displayOn(bouton, aAfficher) {
                var temp = document.getElementById(bouton).checked;
                if (temp == true) {
                    document.getElementById(aAfficher).style.display = 'inline-block';


                } else {
                    document.getElementById(aAfficher).style.display = 'none';

                }
            }


        </script>
    </head>
    <body>

        <div class="wrapper d-flex align-items-stretch">
            <?php include '../include/Sidebar.php'; ?>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <?php include '../include/MenuTop.php'; ?>

                <!-- debut de la page -->
                <form method="POST">
                    <div  >

                        <h4 class="labelReparation">Type de matériel: </h4> 


                        <?php
                        try {
                            $requete = "select * from type_mat";
                            $requete = $conn->prepare($requete);
                            $requete->execute();
                            echo '<select name="mat" id="mat" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle">';
                            while ($ligne = $requete->fetch()) {
                                $id = $ligne['id_mat'];
                                $lib = $ligne['lib_mat'];
                                echo "<option value='$id'>$lib</option>";
                            }
                            echo ' </select>';
                        } catch (Exception $ex) {
                            
                        }
                        ?>

                        <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterTypeMat.php'"/>
                        <h4 class="labelReparation">Marque: </h4> 



                        <?php
                        try {
                            $requete = "select * from marque";
                            $requete = $conn->prepare($requete);
                            $requete->execute();
                            echo '<select name="marque" id="marque" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle">';
                            while ($ligne = $requete->fetch()) {
                                $id = $ligne['id_marque'];
                                $lib = $ligne['nom'];
                                echo "<option value='$id'>$lib</option>";
                            }
                            echo ' </select>';
                        } catch (Exception $ex) {
                            
                        }
                        ?>
                        <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterMarque.php'"/>


                        <h4 class="labelReparation">Modèle: </h4> <select id="result" name="modele" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle" >

                        </select>

                        <input type="button" value="+" class="plus btn btn-primary btn-sm" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterModele.php'"/>
                        <h4 class="labelReparation">Numéro de série: </h4> <input class="inputReparation form-control" type="text"  name="serie" />

                        <div class="form-check form-switch">
                            <h4 class="labelReparation">Rapport: </h4>
                            <input class="form-check-input checkVisibleRapport" type="checkbox" id="afficheRapport"  onclick="displayOn('afficheRapport', 'rapport');"   > 
                        </div>
                        <div style="text-align: center;">
                            <div class="rapport" id="rapport">
                                <h3 class="labelCheck"> Affichage : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck"> Bouton volume haut : </h3>  
                                <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck"> Bouton volume bas : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Bouton power : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Lecteur d'empreinte : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Caméra avant : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Caméra arrière : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Son haut-parleurs : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Son écouteur : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Tactile : </h3>  <input  class="checkRapport"type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Connecteur de charge : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Autonomie : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Prise écouteur : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Réseaux : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Wifi : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Flash : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Bluetooth : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">GPS : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Capteur lumière  : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Capteur proximmité  : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Ecran abimé </h3>    <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheck">Arrière abimé : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>


                                <h3 class="labelCheck" style="width: 85.5%;">A été en contact avec l'humidité  : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>




                            </div>
                        </div>
                        <input type="hidden" name="leRapportCacher" id="leRapportCacher"/>

                        <h4 class="labelReparation"> Etat: </h4> 
                        <?php
                        try {
                            $requete = "select * from etat";
                            $requete = $conn->prepare($requete);
                            $requete->execute();
                            echo '<select name="etat" class="inputReparation btn btn-outline-primary btn-sm dropdown-toggle">';
                            while ($ligne = $requete->fetch()) {
                                $id = $ligne['id_etat'];
                                $lib = $ligne['lib_etat'];
                                echo "<option value='$id'>$lib</option>";
                            }
                            echo ' </select>';
                        } catch (Exception $ex) {
                            
                        }
                        ?>
                        <h4 class="labelReparation"> Accessoire : </h4> <input class="inputReparation form-control" type="text" id="Nom" name="accessoire" />
                        <h4 class="labelReparation">    Note client: </h4> <input class="inputReparation form-control" type="text" id="Nom" name="noteCli" />
                        <h4 class="labelReparation"> Note visible: </h4> <input class="inputReparation form-control" type="text" id="Nom" name="noteVisi" />
                        <h4 class="labelReparation"> Note interne: </h4> <input class="inputReparation form-control" type="text" id="Nom" name="noteInterne" />
                        <h4 class="labelReparation"> Code vérrouillage : </h4> <input class="inputReparation form-control" type="text" id="Nom" name="codeVerro" />
                        <h4 class="labelReparation"> Date de restitution : </h4> <input class="inputReparation form-control" type="date" id="Nom" name="dateRest" />
                        <h4 class="labelReparation"> Heure de restitution : </h4> <input class="inputReparation form-control" type="time" id="Nom" name="heureRest" />

                        <div class="form-check form-switch  ">
                            <h4 class="labelReparation">Appareil a déjà été réparé ou a déjà fait l’objet d’un envoi en SAV: </h4>
                            <input class="form-check-input checkVisibleRapport" type="checkbox" id="afficheSAV"  onclick="displayOn('afficheSAV', 'sav');"   > 
                        </div>

                        <div class="lesav" id="sav" >
                            <h4 class="labelReparation"> Panne : </h4> <input class="inputReparation form-control" type="text"  name="panne" />
                            <h4 class="labelReparation"> intervention réalisé : </h4> <input class="inputReparation form-control" type="text"  name="intervention" />
                            <h4 class="labelReparation"> Pieces remplacé : </h4> <input class="inputReparation form-control" type="text"  name="remplacement" />
                            <h4 class="labelReparation"> Défauts constatés après intervention sur pièces remplacés:  </h4> <input class="inputReparation form-control" type="text" name="defautsav" />
                        </div>

                        <div class="form-check form-switch">
                            <h4 class="labelReparation"> L'apparail est-il reconditionné: </h4>
                            <input class="form-check-input checkVisibleRapport" type="checkbox" id="afficheRecondition"  onclick="displayOn('afficheRecondition', 'recondition');"   > 
                        </div>

                        <div id="recondition" class="recondition">

                            <h4 class="labelReparation"> Défauts constatés: </h4> <input class="inputReparation form-control" type="text" name="defautreco"  />
                        </div>
                        <input class="checkRapport" type="checkbox" name="garantie" required=""/>
                        <h3 class="miniLabel"> J’autorise Hi-Tech LAB  à réaliser des interventions sur mon appareil électronique 
                            et accepte l’annulation de toutes garanties dont mon appareil électronique pourrait faire l’objet.</h3> 


                        <!-- fin de la page -->


                    </div>
                    <div style="text-align: center;">
                    <input type="button"  class="btn btn-outline-danger btn-lg" value="annuler" onclick="history.back()"/>
                    <input type="submit" class="btn btn-outline-primary btn-lg" name="creerDevis" id="valideTest" value="creer"/>
                   
                    </div>
                </form>
            </div>
            
            
   

        </div>
        <!-- mes script js-->



        <!-- libscript js -->

        <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../lib/js/main.js" type="text/javascript"></script>
        <script src="../lib/js/popper.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        <script>

//transforme le rapport en une array boulean pour postgretSql

                                $('#valideTest').click(function () {
                                    var test = document.getElementsByName('rapport[]');
                                    var temp = '';
                                    temp += '{';
                                    for (var i = 0; i < test.length; i++) {
                                        temp += test[i].checked;
                                        if (i < test.length - 1) {
                                            temp += ',';
                                        }

                                    }
                                    temp += '}';

                                    document.getElementById('leRapportCacher').value = temp;
                                    console.log(temp);
                                }
                                );



                                function load_data(mat, marque)
                                {
                                    $.ajax({
                                        url: "./ajax/rechercheModele.php",
                                        method: "post",
                                        data: {query: mat, marque},
                                        success: function (data)
                                        {
                                            $('#result').html(data);
                                        }
                                    });
                                }




                                $('#marque').click(function () {


                                    var mat = $('#mat').val();
                                    var marque = $('#marque').val();
                                    load_data(mat, marque);
                                    ;
                                });

                                $('#mat').click(function () {


                                    var mat = $('#mat').val();
                                    var marque = $('#marque').val();
                                    load_data(mat, marque);
                                });


                                var mat = $('#mat').val();
                                var marque = $('#marque').val();
                                load_data(mat, marque);



        </script>


        <?php
        if (isset($_POST['creerDevis'])) {
            $email = $_GET['id'];
            $typeMat = $_POST['mat'];
            $typeMarque = $_POST['marque'];
            $modele = $_POST['modele'];
            $serie = $_POST['serie'];
            $etat = $_POST['etat'];
            $accessoire = $_POST['accessoire'];
            $noteCli = $_POST['noteCli'];
            $noteVisi = $_POST['noteVisi'];
            $noteInterne = $_POST['noteInterne'];
            $code = $_POST['codeVerro'];
            $date = $_POST['dateRest'];
            $heure = $_POST['heureRest'];
            $panne = $_POST['panne'];
            $inter = $_POST['intervention'];
            $remplacement = $_POST['remplacement'];
            $defautsav = $_POST['defautsav'];
            $defautreco = $_POST['defautreco'];


            $rapport = $_POST['leRapportCacher'];

            try {
                $insert = "select * from creerdevis($modele,'$email',$etat,'$serie','$noteCli','$code','$accessoire','$date','$heure','$noteVisi','$noteInterne','$rapport','$panne', '$inter', '$remplacement', '$defautsav', '$defautreco');";
                $requete = $conn->prepare($insert);
                $requete->execute();


                echo '<script> alert_info_redirect("devis créer","success","/client/menuClient.php");</script>';
            } catch (Exception $ex) {
                echo '<script> alert_info("erreur","error");</script>';
            }
        }




        if (isset($_POST['ajouterMarque'])) {
            $nom = $_POST['laMarque'];
            $insert = "insert into marque (nom) values ('$nom');";
            $requete = $conn->prepare($insert);
            $remplacement->execute();
        }
        ?>

        <!--protection de session -->
        <?php
        include '../include/ProtectSession.php';
        ?>
    </body>


</html>







