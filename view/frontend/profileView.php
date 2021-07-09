
<?php $title = "Mon compte"; ?>

<?php ob_start(); ?>


<div>
    <h1>Mon account</h1>
</div>


<?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) : ?>
    <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
<?php endif; ?>

<?php

if (isset($_SESSION['member'])) {
    echo 'Bonjour ' . $_SESSION['login_name'];

}
?>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

