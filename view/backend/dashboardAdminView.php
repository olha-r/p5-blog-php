<?php ob_start(); ?>

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
