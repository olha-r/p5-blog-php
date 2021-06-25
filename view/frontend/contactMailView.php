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

<!-- Contact Section-->
<div class="row" id="contact-form">
    <div class="col-lg-12">
        <h2>Formulaire de contact</h2>
        <?php  ?>
        <form action="index.php?action=contactUs" method="post">
            <!-- Name input -->
            <div class="form-outline mb-4">
                <label class="form-label" >Nom</label>
                <input type="text" name="name"  class="form-control" required>
            </div>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" >Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <!-- Message input -->
            <div class="form-outline mb-4">
                <label class="form-label" >Message</label>
                <textarea class="form-control" name="message" rows="4" required></textarea>
            </div>
            <!-- Submit button -->
            <button type="submit" value="submit" name="submit"  class="btn btn-lg btn-outline-danger"">Envoyer</button>
        </form>
    </div>


</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>'