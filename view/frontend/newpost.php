<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>


    <div class="row" id="comment-form">
        <div class="col-sm-12">
            <h3>
                <!--<small class="pull-right"></small>-->
                <i class="fa fa-comments"></i>
                Commentaires
            </h3>
            <hr>
            <?php
            while ($comment = $comments->fetch()) {
                ?>
                <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le
                    <em><?= $comment['comment_date_fr'] ?></em></p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                <hr>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="row" id="add-comment-form">
        <div class="col-lg-6"></div>
        <div class="col-lg-6">
            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
                <h3>Ajouter un commentaire</h3>
                <div class="form-group">
                    <label for="author">Auteur</label><br/>
                    <input type="text" id="author" name="author"/>
                </div>
                <div class="form-group">
                    <label class="form-label" for="comment">Commentaire</label><br/>
                    <textarea id="comment" name="comment" class="form-control" rows="4" placeholder="Saisir commentaire"
                              required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-outline-danger">Envoyer</button>
                </div>
            </form>
        </div>
    </div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>