<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="./public/css/styles.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/55a2989d96.js" crossorigin="anonymous"></script>

</head>

<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase " id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="...">Projet 3 - OC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  active" aria-current="page" href="...">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " aria-current="page" href="...">Blog</a>
                </li>
                <form class="nav-item">
                    <a class="btn btn-outline-light mr-auto" href="...">Inscription</a>
                </form>
                <form class="nav-item">
                    <a class="btn btn-outline-light mr-auto" href="...">Connexion</a>
                </form>
            </ul>
        </div>
</nav>
<?= $content ?>

<!-- Footer-->
<footer class="text-center bg-secondary">
    <a href="#" class="btn btn-lg btn-light">
        <i class="fa fa-download"></i> Télécharger CV
    </a> <br>
    <!-- Footer Social Icons-->
    <div >
        <i class="fab fa-facebook-f mini"></i>
        <i class="social-icon fab fa-instagram mini"></i>
        <i class="social-icon fab fa-twitter mini"></i>
    </div>
    <!-- Copyright Section-->
    <div class="text-dark">
        &copy; Raulet Olha 2021
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>