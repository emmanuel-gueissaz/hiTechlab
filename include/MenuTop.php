 <?php 
 
 if(isset($_POST['deco'])){
     session_unset();
     session_destroy();
    
 };
 ?>

<link href="../lib/css/styleMenu.css" rel="stylesheet" type="text/css"/>

<nav class="navbar navbar-expand-lg navbar-light bg-light"  style="    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; border-radius: 5px;" >
    <div class="container-fluid" >

                        <button type="button" id="sidebarCollapse" class="btn btn-primary">
                            <i class="fa fa-bars"></i>
                            <span class="sr-only">Toggle Menu</span>
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars"></i>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                
                                 <li class="nav-item active">
                                    <?php if($_SESSION['prenom']!= null){
                                                echo '<a class="nav-link" href="/hitechlab/profil/profilTech.php?page=1">' . $_SESSION['prenom'] . '</a>';
                                   
                                                echo '  </li>
                                <li class="nav-item">
                                <form method="POST"> 
                                <input class="nav-link boutonLien" type="submit" name="deco" value="Déconnexion">
                                </form>
                                </li>';
                                                
                                    } 
                                    else{
                                         echo '<a class="nav-link" href="/hitechlab/connexion/connexion.php">Connexion</a>';
                                    }
                                    ?>
                                    
                                </li>
                               
                            </ul>
                        </div>

                    </div>

                </nav>
     <script src="../lib/js/jquery.min.js" type="text/javascript"></script>
