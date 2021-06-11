<?php $title = "Page d'accueil"; ?>

<?php ob_start(); ?>

<!-- Header-->
<header class="bg-light">
    <div class="container-fluid py-5 text-center flex-column">
        <img class="rounded-circle" src="/monblog/public/img/rauletolha.jpg" alt="..." />
        <h1 class="fw-bold">Salut ! C'est Olha ! </h1>
        <p>Je suis étudiante - développeur PHP chez OpenClassrooms</p>
    </div>
</header>


<!-- Contact Section-->
<div id="form_contact">
    <h2>Me contacter</h2>

    <form action="index.php?action=contactUs" method="post">

        <!-- Name input -->
        <div class="form-outline mb-4">
            <label class="form-label" >Nom</label>
            <input type="text" name="name"  class="form-control" required>
        </div>

        <!-- Email input -->
        <div class="form-outline mb-4">
            <label class="form-label" >Email</label>
            <input type="email" name="email"  class="form-control" required>
        </div>

        <!-- Message input -->
        <div class="form-outline mb-4">
            <label class="form-label" >Message</label>
            <textarea class="form-control" name="message" rows="4" required></textarea>
        </div>
        <!-- Submit button -->
        <button type="submit" value="submit" name="submit" class="btn btn-dark btn-block mb-4">Envoyer</button>
    </form>

</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>