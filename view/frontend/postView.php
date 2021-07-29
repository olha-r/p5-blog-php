<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>

<div class="row">
    <div class="col-lg-12">
            <a href="index.php?action=listPosts" class="btn btn-secondary">
                <i class="fa fa-long-arrow-left"></i>
                Retour à la liste des billets
            </a>
    </div>
</div>

<div class="row" id="post-view">
    <div class="col-lg-12">
        <h3>
            <?= htmlspecialchars($post['title']) ?>
        </h3>
        <hr>
        <p></p>
        <p>
            <?= nl2br(htmlspecialchars($post['fragment'])) ?>
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </p>
        <p></p>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                  <span>
                      Auteur:
                      <strong><?= $post['user_name'] ?></strong>
                  </span>
                <span>
                    le
                    <em><?= $post['creation_date_fr'] ?></em>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="row" id="comment-form">
    <div class="col-sm-12">
        <h3>
            <i class="fa fa-comments"></i>
            Commentaires
        </h3>
        <hr>
        <?php
        while ($comment = $comments->fetch()) {
            ?>
            <p><strong><?= htmlspecialchars($comment['user_name']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            <hr>
            <?php
        }
        ?>
    </div>
</div>


<div class="row" id="add-comment-form">
    <div class="col-lg-6">
    </div>
    <div class="col-lg-6">
        <h3>Ajouter un commentaires</h3>
        <?php if (!isset($_SESSION['member']) && !isset($_SESSION['admin'])) : ?>
            <div class="alert alert-primary">
                <p>Vous devez être connecté pour commenter.</p>
            </div>
        <?php else : ?>
        <form action="index.php?action=addComment&amp;id=<?= $post['postId'] ?>" method="post">
            <div class="form-group">
                <textarea id="comment" name="comment" class="form-control" rows="4" placeholder="Saisir commentaire"
                          required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-outline-danger" id="btn-comment">Envoyer</button>
            </div>
            <?php endif; ?>
        </form>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require_once 'template.php'; ?>
