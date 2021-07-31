<?php $title = "Mon compte"; ?>

<?php ob_start(); ?>


<?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) : ?>
    <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
<?php endif; ?>

<?php
if (isset($_SESSION['member'])) : ?>
    <h1 class="display-2 text-white"> Bonjour, <?= htmlspecialchars($_SESSION['member']['user_name']) ?></h1>
<?php elseif (isset($_SESSION['admin'])) : ?>
    <h1 class="display-2 text-white"> Bonjour, <?= htmlspecialchars($_SESSION['admin']['user_name']) ?></h1>
<?php endif; ?>

<div class="container-fluid">
    <div class="row justify-content-center">

        <div class="col-lg-8 col-md-10" id="user-profile">
            <div class="row">
                <div class="col-lg-6 col-md-10">
                    <h3><i class="fas fa-user-circle"></i> Mon compte</h3>
                </div>
                <div class="col-lg-6 col-md-10">
                    <form action="index.php?action=deleteUser" method="POST">
                        <input type="hidden" value="<?= $_SESSION['member']['id'] ?>" name="user_id">
                        <input type="submit" value="Supprimer mon compte" name="delete_user" class="btn btn-danger"
                               id="del-user">
                    </form>
                </div>
            </div>
            <hr>

            <div class="row">
                <form method="post" action="index.php?action=editUser&amp;id=<?= $_SESSION['member']['id'] ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <label class="control-label col-xs-4">Username</label>
                            <input type="text" name="edit-username" placeholder="Username"
                                   value="<?= htmlspecialchars($user_info['user_name']) ?>"
                                   class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label class="control-label col-xs-4">Email</label>
                            <input type="text" name="edit-email" placeholder="Email"
                                   value="<?= htmlspecialchars($user_info['email']) ?>"
                                   class="form-control">

                            <input type="submit" value="Modifier mon pfrofile" name="edit-user-info"
                                   class="btn btn-outline-danger" id="edit-user-info">
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <form method="post" action="index.php?action=editPassword&amp;id=<?= $_SESSION['member']['id'] ?>">
                    <div class="row">
                        <label class="control-label col-xs-4">Mot de passe</label>
                        <div class="col-lg-6">
                            <input type="password" name="edit-password-first" placeholder="Nouveau mot de passe"
                                   class="form-control" required>
                        </div>
                        <div class="col-lg-6">
                            <input type="password" name="edit-password-second"
                                   placeholder="Confirmer le mot de passe"
                                   class="form-control" required>
                            <input type="submit" value="Modifier mot de passe" name="update-password"
                                   class="btn btn-outline-danger" id="edit-password">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
    </div>
</div>


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10" id="comment-user">
            <h3>
                <i class="fa fa-comments"></i>
                Mes commentaires
            </h3>
            <hr>
            <?php
            while ($comment = $user_comments->fetch()) {
                ?>
                <p><strong><?= htmlspecialchars($comment['user_name']) ?></strong>
                    le <?= $comment['comment_date_fr'] ?>
                </p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                <form action="index.php?action=deleteUserComment" method="POST">
                    <input type="hidden" value="<?= $comment['id_comment']; ?>" name="commentUserId">
                    <input type="submit" value="Supprimer commentaire" name="delete_user_comment"
                           class="btn btn-danger" id="del-user-comment">
                </form>
                <hr>
                <?php
            }
            ?>
        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require_once 'template.php'; ?>

<?php unset($_SESSION['error']); ?>

<?php unset($_SESSION['success']); ?>

