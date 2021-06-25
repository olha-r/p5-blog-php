
<?php ob_start(); ?>


<div class="row">
    <div class="col-lg-12">
        <h3> Liste des billets </h3>
    </div>
</div>

    <div class="row" >
        <div class="col-lg-3">
            <h6> Date de publication</h6>
        </div>
        <div class="col-lg-3">
            <h6> Titre</h6>
        </div>
        <div class="col-lg-6">
            <h6> Action</h6>
        </div>
    </div>
<?php
while ($data = $allPosts->fetch())
{
?>
    <div class="row" >
        <div class="col-lg-3">
            <p><?= $data['creation_date_fr'] ?></p>
        </div>
        <div class="col-lg-3">
            <p><?= htmlspecialchars($data['title']) ?></p>
        </div>


        <div class="col-lg-3">
            <a href="index.php?action=modifyPost" class="btn btn-primary">Voir ou Modifier</a>
        </div>
        <div class="col-lg-3">
            <a href="index.php?action=deletePost" class="btn btn-warning">Supprimer</a>
        </div>
    </div>
    <?php
}
$allPosts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require 'backendTemplate.php'; ?>