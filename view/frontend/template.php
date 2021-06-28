
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

<!-- Header-->
<header id="frontend-header">
    <div class="container-fluid">
        <h1 class="fw-bold">Mon blog !</h1>
    </div>
</header>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light text-uppercase" id="mainNav">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?action=homePage">Projet 3 - OC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link  active" aria-current="page" href="index.php?action=homePage">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " aria-current="page" href="index.php?action=listPosts">Tous les billets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  " aria-current="page" href="index.php?action=contactUs">Contact</a>
                </li>
            </ul>
            <ul class="navbar-right">
                <?php if (!isset($_SESSION['id']) and !isset($_SESSION['user_name'])) : ?>
                    <a class="btn btn-outline-dark navbar-right" href="index.php?action=signUp">Inscription</a>
                    <a class="btn btn-outline-dark navbar-right" href="index.php?action=signIn">Connexion</a>

                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php?action=logout">Se déconnecter</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
</nav>

<div class="frontend-container">
    <div class="container">

    <?= $content ?>
    </div>
</div>




<!-- Footer-->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 col-md-10 mx-auto" id="footer">
            <footer>
                <ul class="list-inline text-center">
                   <li class="list-inline-item">
                       <a href="index.php?action=dashboardAdmin"> Administration
                            <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fas fa-user fa-stack-1x fa-inverse"></i>

                            </span>
                       </a>
                   </li>
                </ul>
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="index.php"> Télécharger CV
                            <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-download fa-stack-1x fa-inverse"></i>
                            </span>
                    </a>
                    </li>
                </ul>
                <!-- Footer Social Icons-->
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                </ul>
                <!-- Copyright Section-->
                <p class="copyright text-muted">
                    2021 Copyright &copy;
                    <a href="index.php">Raulet Olha</a>
                </p>
                <p class="copyright text-muted">Projet 3 - Formation Développeur d'application - PHP <a href="https://openclassrooms.com/fr/"> Openclassrooms </a></p>



            </footer>
        </div>
    </div>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>