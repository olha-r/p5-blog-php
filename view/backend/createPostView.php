<?php ob_start(); ?>
<?php $nav = "admin-create-post"; ?>

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


        <!-- Add Post Section Form-->
    <div class="row justify-content-center" id="post-create">
        <div class="col-lg-11">
            <h3 class="text-center text-uppercase ">
                Créer mon article
            </h3>
            <hr>
            <p></p>
            <form method="post" action="index.php?action=createPost" class="center mb-3">
                <div class="form-group">
                    <h4>Titre de l'article</h4>
                    <input type="text" class="form-control" name="title" required rows="1" cols="30"
                           value="<?php if (isset($_POST['title'])) { echo $_POST['title'];
                           } ?> " >
                </div>
                <div class="form-group">
                    <h4>Extrait de l'article</h4>
                    <textarea type="text" class="form-control" name="fragment" required rows="5"
                              cols="30" placeholder="Décrivez votre extrait"></textarea>
                </div>
                <div class="form-group">
                    <h4>Contenu de l'article</h4>
                    <textarea id="editor" type="text" class="form-control" name="content" required rows="20"
                              cols="30" placeholder="Décrivez votre article"></textarea>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-2 md-1">
                        <button class="btn btn-dark" type="submit">Enregistrer</button>
                        <p>
                            <a class="btn btn-l btn-danger" href="index.php?action=displayAllPosts">Annuler</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>


<?php $content = ob_get_clean(); ?>

<?php require 'backendTemplate.php'; ?>