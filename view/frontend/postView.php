<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
    <h1>Mon blog !</h1>
    <p><a href="index.php?action=listPosts">Retour à la liste des billets</a></p>

    <div class="news card">
        <div class="card-body">
            <h3 class="card-title">
                <?= htmlspecialchars($post['title']) ?>
                <em class="text-muted">le <?= $post['creation_date_fr'] ?></em>
                <em class="text-muted">Auteur: <?= $post['pseudo'] ?></em>
            </h3>

            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </div>
    </div>

    <h2>Commentaires</h2>

    <div id="add-comments">
        <h3>Ajouter un commentaire</h3>
        <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
            <div class="form-outline mb-4">
                <label for="author">Auteur</label><br />
                <input type="text" id="author" name="author" />
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="comment">Commentaire</label><br />
                <textarea id="comment" name="comment" class="form-control" rows="4" placeholder="Saisir commentaire" required></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-dark btn-block mb-4">Envoyer</button>
        </form>
    </div>

<?php
while ($comment = $comments->fetch())
{
    ?>
    <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
    <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    <?php
}
?>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>