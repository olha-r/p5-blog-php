<?php ob_start(); ?>

    <h2 class="text-secondary text-center text-uppercase mb-3">
        Message important</h2>
    <p>
        Merci pour ton message, il a bien été envoyé.
    </p>
    <p>
        J'essaie de répondre le plus rapidement possible.
    </p>

    </div>
    <div class="text-center mt-4">
        <a class="btn btn-l btn-info shadow" href="../../index.php">
            Retour à l'accueil</a>
    </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>