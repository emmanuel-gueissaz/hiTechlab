<?php
if (isset($_POST['deco'])) {
    session_unset();
    session_destroy();
};
?>

<link href="../lib/css/styleMenu.css" rel="stylesheet" type="text/css"/>

<nav class="navbar navbar-expand-lg navbar-light bg-light"  style="    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; border-radius: 5px;" >
    <div class="container-fluid" >

        <!--                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                                    <i class="fa fa-bars"></i>
                                    <span class="sr-only">Toggle Menu</span>
                                </button>-->
        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">

                <li class="nav-item active">
                    <?php
                    if ($_SESSION['prenom'] != null) {
                        echo '<a class="nav-link" href="/hitechlab/partieClient/profil/leClient.php">' . $_SESSION['prenom'] . '</a>';

                        echo '  </li>
                                <li class="nav-item">
                                <form method="POST"> 
                                <input class="nav-link boutonLien" type="submit" name="deco" value="Déconnexion">
                                </form>
                                </li>';
                    } else {
                        echo '<a class="nav-link" href="/hitechlab/connexion/connexion.php">Connexion</a>';
                    }
                    ?>

                </li>

                <li style="display: inline-block; cursor: pointer;" class="nav-item"  onclick="window.open('https://www.google.com/search?safe=strict&rlz=1C1GCEA_enFR864FR864&sxsrf=ALeKk01qnUcdTTz68rtdQ3g-s1RNzpa7ig:1613567600715&q=hi+tech+lab+avis&spell=1&sa=X&ved=2ahUKEwiamqXd__DuAhULzIUKHTwEBwoQBSgAegQIChA1&biw=1280&bih=619&dpr=1.5#lrd=0x12b50b7d3cde5bc3:0x9ff585cd4c5049a1,3,,,')">

                    <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align: -10;" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align: bottom;" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align: bottom;" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align: bottom;" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.283.95l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" style="vertical-align: bottom;" width="16" height="16" fill="currentColor" class="bi bi-star-half" viewBox="0 0 16 16">
                        <path d="M5.354 5.119L7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.519.519 0 0 1-.146.05c-.341.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.171-.403.59.59 0 0 1 .084-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027c.08 0 .16.018.232.056l3.686 1.894-.694-3.957a.564.564 0 0 1 .163-.505l2.906-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.002 2.223 8 2.226v9.8z"/>
                    </svg>
                </li>

            </ul>
        </div>

    </div>

</nav>
<script src="../../lib/js/jquery.min.js" type="text/javascript"></script>
