<?php $title = "Page d'accueil";

$error_msg = null;
?>

<?php ob_start(); ?>

<div class="jumbotron">
    <div class="row">
        <div class="col-lg-6" id="about-me">
            <h2>Raulet Olha</h2>
            <p>Je suis étudiante - développeur PHP chez OpenClassrooms</p>
        </div>
        <div class="col-lg-6">
            <img class="img-responsive" src="/monblog/public/img/programmer.png" alt="..." />
        </div>

    </div>
</div>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>'