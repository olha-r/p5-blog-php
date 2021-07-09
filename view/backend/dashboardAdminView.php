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
    <div class="row" id="dashboard-admin" style="background-color: #eeeeee">
        <div class="col-lg-12">
            <h3>
                Liste des billets
            </h3>
        </div>


        <div class="col-lg-12">
            <table class="table table-hover">
                <thead class="col-lg-12">
                <tr>
                    <th>Date de publication</th>
                    <th>Titre</th>
                    <th colspan="2">Action</th>

                </tr>
                </thead>
                <tbody>

                <?php
                while ($data = $allPosts->fetch())
                {
                    ?>
                    <tr>
                        <td><?= $data['creation_date_fr'] ?></td>
                        <td><?= htmlspecialchars($data['title']) ?></td>
                        <td><a href="index.php?action=modifyPost&amp;id=<?= $data['id'] ?>" class="btn btn-primary">Voir ou Modifier</a> </td>
                        <td> <form action="index.php?action=deletePost" method="POST">
                                <input type="hidden" value="<?= $data['id']; ?>" name="id" >
                                <input type="submit" value="Supprimer" name="delete"  class="btn btn-warning">
                                <!--<a href="index.php?action=deletePost" class="btn btn-warning">Supprimer</a> -->
                            </form>
                        </td>
                    </tr>
                    <?php
                }
                $allPosts->closeCursor();
                ?>
                </tbody>
            </table>
        </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>
