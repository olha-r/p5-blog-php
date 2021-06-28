
<?php $title = "Se connecter"; ?>

<?php ob_start(); ?>


<h1>Mon account</h1>

<?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
    <div class="alert alert-success"><?= $_SESSION['error']; ?></div>
<?php endif; ?>

<?php

if (isset($_SESSION['id']) and isset($_SESSION['login_name'])) {
    echo 'Bonjour ' . $_SESSION['login_name'];

}
?>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

