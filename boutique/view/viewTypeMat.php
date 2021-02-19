


<!doctype html>

<?php
include '../../BDD/connexionBdd.php';
?>
<html lang="fr">
    <head>
        <title>HI-TECH LAB</title>  
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">	
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="../../lib/css/style.css" rel="stylesheet" type="text/css"/>
        <link href="../../lib/css/styleMenu.css" rel="stylesheet" type="text/css"/>

        <link href="../../lib/alert/sweetalert2.css" rel="stylesheet" type="text/css"/>
        <script src="../../lib/alert/sweetalert2.js" type="text/javascript"></script>
        <script src="../../include/alert.js" type="text/javascript"></script>

        <link href="view.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>

        <div class="wrapper d-flex align-items-stretch">
            <?php include '../../include/Sidebar.php'; ?>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <?php include '../../include/MenuTop.php'; ?>
                       <input type="button" class="btn btn-outline-secondary" value="retour" onclick="document.location.href = '/hitechlab/boutique/lesAjouts.php'"/>
                <div style="text-align: center">
                    


                    <div class="cadreView">
                        <div class="titreView">
                            <h5 class="lableTitreView">
                                Les types de matériels :
                            </h5>
                            <button class="btn btn-primary iconElement" onclick="document.location.href = '/hitechlab/boutique/ajout/ajouterTypeMat.php'"  >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </button>
          
                        </div>
                        <?php
                        $icon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                 <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                 </svg>';
                        $requete = "select * from type_mat";
                        $requete = $conn->prepare($requete);
                        $requete->execute();
                        while ($lignes = $requete->fetch()) {
                            $id = $lignes['id_mat'];
                            $lib = $lignes['lib_mat'];

                            echo "  <hr class='my-2' Style='border-top:1px solid black; ' />"
                                         . "<form method='POST'>"
                            . "<div class='element'> "
                            . "<div class='labelElement'> $lib </div>"
                       
                            . "<button type='submit' class='btn btn-danger iconElement' value='$id' name='supp'> "
                            . "$icon"
                            . "</button>"
                                    
                            . "</div>"
                            . "</form>";
                        }
                        ?>
                    </div>


                </div>
            </div>
        </div>
      

        <!-- fin de la page -->

        <!-- mes script js-->


       
        <!-- libscript js -->

        <script src="../../lib/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="../../lib/js/main.js" type="text/javascript"></script>
        <script src="../../lib/js/popper.js" type="text/javascript"></script>

        <?php 
        if(isset($_POST['supp'])){
            $id = $_POST['supp'];
            
            try {
                   $requete = "delete from type_mat where id_mat = $id ;";
            $requete = $conn -> prepare($requete);
            $requete -> execute();
             echo '<script> alert_info_redirect("Le type de matériel est supprimée","success","/hitechlab/boutique/view/viewTypeMat.php");</script>';
            } catch (Exception $ex) {
                  echo '<script> alert_info("Le type de matériel ne peut être supprimée","error");</script>';
            }
         
            
        }
        
        ?>
        
        
        
        
        <?php
        include '../../include/ProtectSession.php';
        ?>
        
        
    </body>
</html>







