<?php $title = "Administration du blog"; ?>
<?php $nav = "admin-posts"; ?>
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

    <div class="row justify-content-center" id="dashboard-admin">
    <div class="col-sm-11 col-lg-6">
        <h3 class="text-center text-uppercase ">
            Liste des billets
        </h3>
        <hr>
        <p></p>
    </div>


    <div class="row">
        <?php
        while ($data = $allPosts->fetch()) {
            ?>
            <div class="col-sm-6" id="posts-admin">
                <div class="card">
                    <div class="card-header"><small class="text-muted"><?= $data['creation_date_fr'] ?></small></div>
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= htmlspecialchars($data['title']) ?></h5>
                        <div class="row justify-content-md-center">
                            <div class="col-lg-4">
                                <a href="index.php?action=modifyPost&amp;id=<?= $data['id'] ?>" class="btn btn-primary"
                                   id="btn-admin-posts">Voir ou Modifier</a>
                            </div>
                            <div class="col-lg-4">
                                <form action="index.php?action=deletePost" method="POST">
                                    <input type="hidden" value="<?= $data['id']; ?>" name="id">
                                    <input type="submit" value="Supprimer" name="delete" class="btn btn-danger"
                                           id="btn-admin-del-post">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        $allPosts->closeCursor();
        ?>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require_once 'template.php'; ?>

<?php unset($_SESSION['error']); ?>
