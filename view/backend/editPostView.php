<?php $title = "Administration du blog"; ?>
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
    <div class="row">
        <div class="col-lg-12">
            <a href="index.php?action=dashboardAdmin" class="btn btn-secondary">
                <i class="fa fa-long-arrow-left"></i>
                Retour à la liste des billets
            </a>
        </div>
    </div>

    <div class="row justify-content-center" id="edit-post-view">

        <div class="col-sm-11 col-lg-6">
            <h3 class="text-center text-uppercase ">
                Modifier l'article
            </h3>
            <hr>
            <p></p>
        </div>


        <div class="row">
            <form method="post" action="index.php?action=editPost&amp;id=<?= $post['postId'] ?>">
                <div class="col-lg-12">
                    <h4>Titre de l'article</h4>
                    <input type="text" name="edit-title" placeholder="Titre"
                           value="<?= htmlspecialchars($post['title']) ?>"
                           class="form-control">
                    <hr>
                    <p></p>
                    <h4>Extrait de l'article</h4>
                    <textarea name="edit-fragment" placeholder="Extrait de l'extrait" class="form-control"
                              rows="10"><?= htmlspecialchars($post['fragment']) ?></textarea>
                    <p></p>
                    <hr>
                    <h4>Contenu de l'article</h4>
                    <textarea name="edit-content" placeholder="Contenu de l'article" class="form-control"
                              rows="10"><?= htmlspecialchars($post['content']) ?></textarea>
                    <p></p>
                    <hr>
                    <div class="row justify-content-md-center">
                        <input type="submit" value="Modifier" name="edit" class="btn btn-outline-danger"
                               id="btn-edit-post">

                    </div>
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
            </form>
        </div>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require_once 'template.php'; ?>