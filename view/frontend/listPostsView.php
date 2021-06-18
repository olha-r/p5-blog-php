<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
<!-- Header-->
<header class="bg-light">
    <div class="container-fluid py-5 text-center flex-column">
        <img class="rounded-circle" src="/monblog/public/img/rauletolha.jpg" alt="..." />
        <h1 class="fw-bold">Mon blog !</h1>
        <p>Je suis étudiante - développeur PHP chez OpenClassrooms</p>
    </div>
</header>

<p>Derniers billets du blog </p>


<?php
while ($data = $posts->fetch())
{
    ?>
    <!-- Blog posts -->
    <div class="news card">
        <div class="card-body">
            <h3 class="card-title">
                <?= htmlspecialchars($data['title']) ?>
                <em class="text-muted">Publié le <?= $data['creation_date_fr'] ?></em>

            </h3>

            <p class="card-text">
                <?= nl2br(htmlspecialchars($data['content'])) ?>
                <br />
                <em><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Commentaires</a></em>
            </p>
        </div>
    </div>
    <?php
}
$posts->closeCursor();
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
