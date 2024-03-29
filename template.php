<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?= $title ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./public/css/styles.css" rel="stylesheet"/>
    <link href="./public/css/styles.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,700&family=Roboto&display=swap"
          rel="stylesheet">
    <script src="https://kit.fontawesome.com/55a2989d96.js" crossorigin="anonymous"></script>

</head>

<body>
<!-- Header-->
<div id="frontend-header" class="container-fluid">
    <?php if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) : ?>
        <h1 class="fw-bold">Administration du blog !</h1>
    <?php else : ?>
        <h1 class="fw-bold">Mon blog !</h1>
    <?php endif; ?>
</div>


<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light text-uppercase" id="mainNav">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?action=homePage"><i class="fas fa-home"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link  <?php if (isset($nav) && !empty($nav) && ($nav === "home_page")) : ?> active <?php endif; ?>" aria-current="page"
                       href="index.php?action=homePage">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (isset($nav) && !empty($nav) && ($nav === "list_post")) : ?> active <?php endif; ?>" aria-current="page"
                       href="index.php?action=listPosts"><i class="fas fa-th-list"></i> Tous les billets</a>
                </li>

                <?php if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link  <?php if (isset($nav) && !empty($nav) && ($nav === "admin-posts")) : ?> active <?php endif; ?>"
                           aria-current="page"
                           href="index.php?action=dashboardAdmin"><i class="fas fa-list-ol"></i> Liste des billets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($nav) && !empty($nav) && ($nav === "admin-comment")) : ?> active <?php endif; ?>"
                           aria-current="page"
                           href="index.php?action=displayComments"><i class="fas fa-comments"></i> Commentaires</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($nav) && !empty($nav) && ($nav === "admin-create-post")) : ?> active <?php endif; ?>"
                           aria-current="page"
                           href="index.php?action=createPost"><i class="fas fa-newspaper"></i> Créer un billet</a>
                    </li>

                <?php else : ?>

                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($nav) && !empty($nav) && ($nav === "contact")) : ?> active <?php endif; ?>"
                           aria-current="page"
                           href="index.php?action=contactUs"><i class="fas fa-envelope-open-text"></i> Contact</a>
                    </li>
                <?php endif; ?>
            </ul>
            <ul class="navbar-nav">
                <?php if (!isset($_SESSION['member']) && !isset($_SESSION['admin'])) : ?>
                    <a class="btn btn-outline-dark navbar-right <?php if (isset($nav) && !empty($nav) && ($nav === "signup")) : ?> active <?php endif; ?>"
                       href="index.php?action=signUp">Inscription</a>
                    <a class="btn btn-outline-dark navbar-right <?php if (isset($nav) && !empty($nav) && ($nav === "login")) : ?> active <?php endif; ?>"
                       href="index.php?action=signIn">Connexion</a>
                <?php else : ?>
                    <?php if (isset($_SESSION['member']) && !empty($_SESSION['member'])) : ?>
                        <a href="index.php?action=dashboard">
                        <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fas fa-user fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    <?php endif; ?>
                    <a href="index.php?action=logout">
                        <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fas fa-sign-out-alt fa-stack-1x fa-inverse"></i>
                            </span>
                    </a>
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
                                <i class="fas fa-user-shield fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                </ul>
                <ul class="list-inline text-center">
                    <li class="list-inline-item">
                        <a href="index.php?action=downloadCV"> Télécharger CV
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
                        <a href="https://www.linkedin.com/in/olha-raulet-9037a5203/">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="https://github.com/olha-r">
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
                <p class="copyright text-muted">Projet 3 - Formation Développeur d'application - PHP <a
                            href="https://openclassrooms.com/fr/"> Openclassrooms </a></p>
            </footer>
        </div>
    </div>
</div>


<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>
