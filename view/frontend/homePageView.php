<?php $title = "Page d'accueil"; ?>
<?php $nav = "home_page"; ?>

<?php ob_start(); ?>

<?php
if (isset($_SESSION['success'])) {
    ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success']; ?>
    </div>
    <?php
}
unset($_SESSION['success']);

if (isset($_SESSION['error'])) {
    ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error']; ?>
    </div>
    <?php
}
unset($_SESSION['error']);
?>

<div class="jumbotron">
    <div class="row">
        <div class="col-lg-6 col-md-10" id="about-me">
            <h2>Raulet Olha</h2>
            <p>Je suis étudiante - développeur PHP chez OpenClassrooms</p>
        </div>
        <div class="col-lg-6 col-md-10">
            <img class="img-responsive" src="/monblog/public/img/programmer.png" alt="programmer-img"/>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require_once './template.php'; ?>

<?php unset($_SESSION['error']); ?>

<?php unset($_SESSION['success']); ?>

