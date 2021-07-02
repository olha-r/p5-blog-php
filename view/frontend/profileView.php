
<?php $title = "Mon compte"; ?>

<?php ob_start(); ?>


<div>
    <h1>Mon account</h1>
</div>


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

