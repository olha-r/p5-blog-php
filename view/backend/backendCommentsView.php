
<?php ob_start(); ?>

<section class="page-section" style="background-color: #eeeeee">
    <div class="container-fluid">
        <table class="table">
            <h3> Liste des commentaires </h3>
            <thead>
            <tr>
                <th scope="col">Date de commentaire</th>
                <th scope="col">Author de commentaire</th>
                <th scope="col">Commentaires</th>
            </tr>
            <?php
            while ($data = $all_comments->fetch())
            {
            ?>
            <tr>
                <td><?= $data['comment_date'] ?></td>
                <td><?= htmlspecialchars($data['user_name']) ?></td>
                <td><?= htmlspecialchars($data['comment']) ?></td>
            </tr>
                <?php
            }
            $all_comments->closeCursor();
            ?>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require 'backendTemplate.php'; ?>