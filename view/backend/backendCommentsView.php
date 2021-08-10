<?php $title = "Administration du blog"; ?>
<?php $nav = "admin-comment"; ?>
<?php ob_start(); ?>

<?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) : ?>
    <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
<?php endif; ?>
<?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
    <div class="alert alert-danger"><?= $_SESSION['error']; ?></div>
<?php endif; ?>

    <div class="row justify-content-center" id="comment-admin">
    <div class="col-sm-11 col-lg-6">
        <h3 class="text-center text-uppercase ">
            Liste des commentaires
        </h3>
        <hr>
        <p></p>
    </div>


    <div class="row">
        <?php while ($comments = $all_comments->fetch()) : ?>
            <div class="col-sm-6" id="posts-admin">
                <div class="card">
                    <div class="card-header"><small class="text-muted"><?= $comments['comment_date'] ?></small></div>
                    <div class="card-body text-center">
                        <p class="card-text"><span
                                    class="text-muted">Auteur de commentaire:</span> <?= htmlspecialchars($comments['user_name']) ?>
                        </p>
                        <p><?= htmlspecialchars($comments['comment']) ?></p>
                        <div class="row justify-content-md-center">
                            <div class="col-lg-4">
                                <form action="index.php?action=validateComment" method="POST">
                                    <input type="hidden" value="<?= $comments['id_comment']; ?>" name="commentId">
                                    <input type="submit" value="Valider" name="validate" class="btn btn-primary"
                                           id="btn-validate-comment">
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <form action="index.php?action=notValidateComment" method="POST">
                                    <input type="hidden" value="<?= $comments['id_comment']; ?>" name="commentId">
                                    <input type="submit" value="Supprimer" name="not_validate" class="btn btn-danger"
                                           id="btn-admin-del-comment">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <?php $all_comments->closeCursor(); ?>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require_once 'template.php'; ?>

<?php unset($_SESSION['error']); ?>