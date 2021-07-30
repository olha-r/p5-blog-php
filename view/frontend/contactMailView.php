<?php $title = "Contact us"; ?>
<?php $nav = "contact"; ?>

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

    <!-- Contact Section-->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6" id="contact-form">
            <form action="index.php?action=contactUs" method="post">
                <div class="col-xs-8 col-xs-offset-4">
                    <h2>Formulaire de contact</h2>
                </div>
                <!-- Name input -->
                <div class="form-group">
                    <label class="control-label col-xs-4">Nom</label>
                    <div class="col-xs-8">
                        <input type="text" name="name" class="form-control" required>
                    </div>
                </div>
                <!-- Email input -->
                <div class="form-group">
                    <label class="control-label col-xs-4">Email</label>
                    <div class="col-xs-8">
                        <input type="email" name="email" class="form-control" required>
                    </div>
                </div>
                <!-- Message input -->
                <div class="form-group">
                    <label class="control-label col-xs-4">Message</label>
                    <div class="col-xs-8">
                        <textarea class="form-control" name="message" rows="4" required></textarea>
                    </div>
                </div>
                <!-- Submit button -->
                <input type="submit" value="Envoyer" name="submit" class="btn btn-lg btn-outline-danger"
                       id="btn-contact">
            </form>
        </div>
    </div>
<<<<<<< HEAD

<?php $content = ob_get_clean(); ?>

<?php require_once './template.php'; ?>

<?php unset($_SESSION['error']); ?>
=======


<?php $content = ob_get_clean(); ?>

<?php require_once './template.php'; ?>
>>>>>>> main
