

<?php ob_start(); ?>

    <div class="row">
        <div class="col-lg-12">
            <p>
                <a href="index.php?action=dashboardAdmin" class="btn btn-secondary">
                    <i class="fa fa-long-arrow-left"></i>
                    Retour à la liste des billets
                </a>
            </p>
        </div>
    </div>

    <div class="row" id="post-view">
        <div class="col-lg-12">
            <h3>
                <?= htmlspecialchars($post['title']) ?>
            </h3>
            <hr>
            <p></p>
            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
            <p></p>
            <hr>
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
    </div>


<?php $content = ob_get_clean(); ?>

<?php require('backendTemplate.php'); ?>