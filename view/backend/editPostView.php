
<?php ob_start(); ?>

<?php
if(isset($_SESSION['success']))
{
    ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['success']; ?>
    </div>
    <?php
}
unset($_SESSION['success']);
if(isset($_SESSION['error']))
{
    ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error']; ?>
    </div>
    <?php
}
unset($_SESSION['error']);
?>

    <div class="row" id="edit-view" style="background-color: #eeeeee">
        <div class="col-lg-12">
            <p>
                <a href="index.php?action=dashboardAdmin" class="btn btn-secondary">
                    <i class="fa fa-long-arrow-left"></i>
                    Retour à la liste des billets
                </a>
            </p>
        </div>


    <div class="row" id="edit-post-view">
        <form method="post" action="index.php?action=editPost&amp;id=<?= $post['postId'] ?>">
        <div class="col-lg-12">
            <input type="text" name="edit-title" placeholder="Titre" value="<?= htmlspecialchars($post['title']) ?>" class="form-control">

            <hr>
            <p></p>
            <textarea name="edit-content" placeholder="Contenu de l'article" class="form-control" rows="10"><?= htmlspecialchars($post['content']) ?></textarea>
            <p></p>
            <hr>
            <input type="submit" value="Modifier" name="edit" class="btn btn-outline-danger">
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

<?php require('backendTemplate.php'); ?>