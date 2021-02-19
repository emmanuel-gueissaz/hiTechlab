
<?php
include '../BDD/connexionBdd.php';
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

        <link href="../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../include/alert.js" type="text/javascript"></script>

        <link href="ficheClient.css" rel="stylesheet" type="text/css"/>
        <link href="reparation.css" rel="stylesheet" type="text/css"/>


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

                <input type="button" class="btn btn-outline-secondary" value="retour" onclick="document.location.href = '/hitechlab/reparation/leDevis.php?id=<?php echo $_GET['id']; ?>';"/>




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



                    <h4 class="labelReparation">Modèle: </h4> <select id="result" name="modele" class="listeAjout btn btn-outline-primary btn-sm dropdown-toggle" >

                    </select>


                    <h4 class="labelReparation">Numéro de série: </h4> <input class="inputReparation form-control" type="text" id="serie"  name="serie" />

                    <h4 class="labelReparation">Pannes : </h4>

                    <textarea class="zoneTextPanne form-control"  name="lapanne" id="lapanne" >
                       
                    </textarea>

                    <div class="form-check form-switch">
                        <h4 class="labelReparation">Rapport: </h4>
                        <input class="form-check-input checkVisibleRapport" type="checkbox" id="afficheRapport"  onclick="displayOn('afficheRapport', 'rapport');"   > 
                    </div>

                    <h3 class="titreRapport" style="width: 100%;">  Rapport client : </h3>  
                    <div style="text-align: center;">

                        <div class="rapport" id="rapport" >

                            <div style="display: inline-block; width: 46%; ">
                                <h3 class="labelCheckRange"> Affichage : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Tactile : </h3>  <input  class="checkRapport"type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange"> Bouton volume haut : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange"> Bouton volume bas : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Bouton power : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Lecteur d'empreinte : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Caméra avant : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Caméra arrière : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Son haut-parleurs : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Son écouteur : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>


                            </div>
                            <div style="display: inline-block; width: 46%;">
                                <h3 class="labelCheckRange">Connecteur de charge : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Autonomie : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Prise écouteur : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Réseaux : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Wifi : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Flash : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Bluetooth : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">GPS : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Capteur lumière  : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                                <h3 class="labelCheckRange">Capteur proximité  : </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>
                            </div>
                            <h4 class="labelCheckSpec">Dans quel état est l'écran :</h4>  <br>
                            <h3 class="labelCheck">Intact   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]"/>
                            <h3 class="labelCheck">Micro-rayures   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]"/>
                            <h3 class="labelCheck">Rayures   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]"/>
                            <h3 class="labelCheck">Cassé   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]"/>
                            <h4 class="labelCheckSpec">Quel est l'état de la coque :</h4>  <br>
                            <h3 class="labelCheck">Intact   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]"/>
                            <h3 class="labelCheck">Micro-rayures   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]"/>
                            <h3 class="labelCheck">Rayures   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]"/>
                            <h3 class="labelCheck">Cassé   : </h3> <input class="checkRapport" type="checkbox" name="rapport[]"/>

                            <h3 class="labelCheck">Le tiroir SIM est-il présent ? </h3>  <input class="checkRapport" type="checkbox" name="rapport[]"/>


                        </div>


                    </div>


                    <h4 class="labelReparation"> Etat: </h4> 
                    <?php
                    try {
                        $requete = "select * from etat";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        echo '<select name="etat" id="etat" class="inputReparation btn btn-outline-primary btn-sm dropdown-toggle">';
                        while ($ligne = $requete->fetch()) {
                            $id = $ligne['id_etat'];
                            $lib = $ligne['lib_etat'];
                            echo "<option value='$id'>$lib</option>";
                        }
                        echo ' </select>';
                    } catch (Exception $ex) {
                        
                    }
                    ?>
                    <h4 class="labelReparation"> Accessoire : </h4> <input class="inputReparation form-control" type="text" id="accessoire" name="accessoire" />
                    <h4 class="labelReparation">    Note client: </h4> <input class="inputReparation form-control" type="text" id="noteCli" name="noteCli" />
                    <h4 class="labelReparation"> Note visible: </h4> <textarea class="zoneTextPanne form-control" type="text" id="noteVisi" name="noteVisi" ></textarea>
                    <h4 class="labelReparation"> Note interne: </h4> <input class="inputReparation form-control" type="text" id="noteInterne" name="noteInterne" />
                    <h4 class="labelReparation"> Code vérrouillage : </h4> <input class="inputReparation form-control" type="text" id="codeVerro" name="codeVerro" />
                    <h4 class="labelReparation"> Date de restitution : </h4> <input class="inputReparation form-control" type="date" id="dateRest" name="dateRest" />
                    <h4 class="labelReparation"> Heure de restitution : </h4> <input class="inputReparation form-control" type="time" id="heureRest" name="heureRest" />

                    <div class="form-check form-switch  ">
                        <h4 class="labelReparation">Appareil a déjà été réparé ou a déjà fait l’objet d’un envoi en SAV: </h4>
                        <input class="form-check-input checkVisibleRapport" type="checkbox" id="afficheSAV"  onclick="displayOn('afficheSAV', 'sav');"   > 
                    </div>

                    <div class="lesav" id="sav" >
                        <h4 class="labelReparation"> Panne : </h4> <input class="inputReparation form-control" type="text" id="panne"  name="panne" />
                        <h4 class="labelReparation"> intervention réalisé : </h4> <input class="inputReparation form-control" type="text" id="intervention" name="intervention" />
                        <h4 class="labelReparation"> Pieces remplacé : </h4> <input class="inputReparation form-control" type="text" id="remplacement"  name="remplacement" />
                        <h4 class="labelReparation"> Défauts constatés après intervention sur pièces remplacés:  </h4> <input class="inputReparation form-control" type="text" id="defautsav" name="defautsav" />
                    </div>

                    <div class="form-check form-switch">
                        <h4 class="labelReparation"> L'apparail est-il reconditionné: </h4>
                        <input class="form-check-input checkVisibleRapport" type="checkbox" id="afficheRecondition"  onclick="displayOn('afficheRecondition', 'recondition');"   > 
                    </div>

                    <div id="recondition" class="recondition">

                        <h4 class="labelReparation"> Défauts constatés: </h4> <input class="inputReparation form-control" type="text" id="defautreco" name="defautreco"  />
                    </div>
                    <h4 class="labelReparation"> Technicien: </h4>
                    <?php
                    try {
                        $requete = "select email,nom, prenom from technicien";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        echo '<select name="technicien" id="technicien" class="inputReparation btn btn-outline-primary btn-sm dropdown-toggle">';
                        while ($ligne = $requete->fetch()) {
                            $id = $ligne['email'];
                            $nom = $ligne['nom'];
                            $prenom = $ligne['prenom'];

                            echo "<option value='$id'>$nom $prenom</option>";
                        }
                        echo ' </select>';
                    } catch (Exception $ex) {
                        
                    }
                    ?>


                    <!-- fin de la page -->


                </div>


            </div> 
        </div> 




        <!-- libscript js -->
        <script src="../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../lib/js/main.js" type="text/javascript"></script>
        <script src="../lib/js/popper.js" type="text/javascript"></script>


        <script>

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
        $requete = "select * from reparation inner join modele ON modele.id_modele = reparation.id_modele where id=" . $_GET['id'] . ";";
        $requete = $conn->prepare($requete);
        $requete->execute();
        $ligne = $requete->fetch();

        $typeMat = $ligne['id_mat'];
        $marque = $ligne['id_marque'];
        $modele = $ligne['id_modele'];
        $serie = $ligne['numserie'];
        $etat = $ligne['id_etat'];
        $accessoire = $ligne['accessoires'];
        $noteCli = $ligne['noteclient'];
        $noteVisi = $ligne['notevisiblebon'];
        $noteInterne = $ligne['noteinterne'];
        $code = $ligne['codeverrouillage'];
        $date = $ligne['daterestitution'];
        $heure = $ligne['heure'];
        $panne = $ligne['anciennepanne'];
        $inter = $ligne['ancienneintervention'];
        $remplacement = $ligne['pieceremplace'];
        $defautsav = $ligne['defautsav'];
        $defautreco = $ligne['defautreco'];
        $laPanne = $ligne['lapanne'];
        $technicien = $ligne['email_technicien'];


        $rapport = $ligne['rapportcli'];
        $rapportTech = $ligne['rapporttech'];


        echo "<script>"
        . "$('#mat').val($typeMat)"
        . "</script>";

        echo "<script>"
        . "$('#marque').val($marque)"
        . "</script>";

        echo "<script>"
        . "      var mat = $('#mat').val();
                     var marque = $('#marque').val();
                     load_data(mat, marque);"
        . "</script>";


        // problème sur le modèle 

        echo "<script>"
        . "$('#serie').val('$serie'),"
        . "$('#afficheRapport').click(),"
        . " setTimeout(function(){   $('#result').val('$modele'); }, 200);"
        . "$('#etat').val($etat),"
        . "$('#accessoire').val('$accessoire'),"
        . "$('#noteCli').val('$noteCli'),"
        . "$('#noteVisi').val('$noteVisi'),"
        . "$('#noteInterne').val('$noteInterne'),"
        . "$('#codeVerro').val('$code'),"
        . "$('#dateRest').val('$date'),"
        . "$('#heureRest').val('$heure'),"
        . "$('#panne').val('$panne'),"
        . "$('#intervention').val('$inter'),"
        . "$('#remplacement').val('$remplacement'),"
        . "$('#defautsav').val('$defautsav'),"
        . "$('#defautreco').val('$defautreco'),"
        . "$('#lapanne').val('$laPanne'),"
        . "$('#technicien').val('$technicien')"
        . "</script>";

        if ($panne != '') {
            echo "<script>"
            . "$('#afficheSAV').click()"
            . "</script>";
        }


        if ($defautreco != '') {
            echo "<script>"
            . "$('#afficheRecondition').click()"
            . "</script>";
        }



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
        ?>



        <!-- fin de la page -->




    </div>





    <?php
    include '../include/protectionSessionMembre.php';
    ?>
    <script>


    </script>

</body>
</html>







