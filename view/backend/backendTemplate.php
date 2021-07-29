<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Administration du blog</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./public/css/styles.css" rel="stylesheet"/>
    <link href="./public/css/styles.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,700&family=Roboto&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/55a2989d96.js" crossorigin="anonymous"></script>


</head>

<body>

<!-- Header-->
<div id="frontend-header">
    <div class="container-fluid">
        <h1 class="fw-bold">Administration du blog !</h1>
    </div>
</div>

<!-- Navigation-->


<nav class="navbar navbar-expand-lg navbar-light bg-light text-uppercase" id="backendNav">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php?action=dashboardAdmin"><i class="fas fa-home"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar2"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar2">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                <li class="nav-item">
                    <a class="nav-link  <?php if ($nav === "admin-posts") : ?> active <?php endif; ?>" aria-current="page"
                       href="index.php?action=dashboardAdmin"><i class="fas fa-th-list"></i> Liste des billets</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php if ($nav === "admin-comment") : ?> active <?php endif; ?>" aria-current="page"
                       href="index.php?action=displayComments"><i class="fas fa-comments"></i> Commentaires</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link <?php if ($nav === "admin-create-post") : ?> active <?php endif; ?>" aria-current="page"
                       href="index.php?action=createPost"><i class="fas fa-newspaper"></i> Créer un billet</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page"
                       href="index.php"><i class="fas fa-globe"></i> Site public</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                    <?php if (!isset($_SESSION['admin'])) {
                        header('index.php?action=homePage');
                    } else { ?>
                        <a href="index.php?action=dashboard">
                        <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fas fa-user fa-stack-1x fa-inverse"></i>

                            </span>
                        </a>
                        <a href="index.php?action=logout">
                        <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fas fa-sign-out-alt fa-stack-1x fa-inverse"></i>

                            </span>
                        </a>

                    <?php } ?>
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
                        <a href="index.php"> Site Public
                            <span class="fa-stack">
                                <i class="fa fa-circle fa-stack-2x"></i>
                                <i class="fas fa-globe fa-stack-1x fa-inverse"></i>

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