
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Administration du blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./public/css/styles.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/55a2989d96.js" crossorigin="anonymous"></script>

</head>
<body>
<!-- Header-->
<div id="backend-header">
    <div class="container-fluid">
        <h1 class="fw-bold">Administration du blog !</h1>

    </div>
</div>


<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light text-uppercase" id="backendNav">
    <div class="container">
        <a class="navbar-brand" href="index.php?action=dashboardAdmin">BLOG Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded " href="index.php?action=dashboardAdmin"><i class="fas fa-home"></i></a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded " href="index.php?action=displayComments"><i class="fas fa-comments"></i> Commentaires</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded " href="index.php?action=createPost"><i class="far fa-newspaper"></i> Créer un billet</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded " href="index.php">Site public</a></li>
                <ul class="navbar-right">
                    <?php if (!isset($_SESSION['admin'])) {
                        header('index.php?action=homePage');
                    }

                    else { ?>

                            <a class="btn btn-outline-primary" aria-current="page" href="index.php?action=logout">Se déconnecter</a>

                    <?php } ?>
                </ul>
            </ul>
        </div>
</nav>

<div class="frontend-container">
    <div class="container">

        <?= $content ?>
    </div>
</div>





<!-- Footer-->
<footer class="text-center bg-secondary copyright">

    <!-- Copyright Section-->
    <p class="copyright ">
        2021 Copyright &copy;
        <a href="index.php" class="link-light">Raulet Olha</a>
    </p>
    <p class="copyright " >Projet 3 - Formation Développeur d'application - PHP <a href="https://openclassrooms.com/fr/" class="link-light"> Openclassrooms </a></p>



</footer>


<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>






