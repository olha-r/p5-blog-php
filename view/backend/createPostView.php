<?php ob_start(); ?>

        <div class="container mt-lg-5 mt-4">
            <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Créer mon article</h2>
            <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
                <div class="alert alert-success"><?= $_SESSION['error']; ?></div>
            <?php endif; ?>
            <!-- Add Post Section Form-->
            <div class="row">
                <div class="col-lg-10 mx-lg-auto mx-3 mb-0 p-3 bg-white shadow">
                    <form method="post" action="index.php?action=createPost" class="center mb-3">
                        <div class="form-group">
                            <h4>Titre de l'article</h4>
                            <input type="text" class="form-control" name="title" required rows="1" cols="30" value="<?php if(isset($title)){ echo $title; }?>">
                        </div>
                        <div class="form-group">
                            <h4>Contenu de l'article</h4>
                            <textarea id="editor" type="text" class="form-control" name="content" required rows="20" cols="30" placeholder="Décrivez votre article" ></textarea>
                        </div>
                        <div class="text-center">
                            <button class="btn  btn-dark" type="submit" >Enregistrer</button>
                        </div>
                    </form>
                    <div class="text-center pt-3 mb-5">
                        <p>
                            <a class="btn btn-l btn-danger" href="index.php?action=displayAllPosts">Annuler</a>
                        </p>
                    </div>

                    </form>

                </div>
            </div>
        </div>


<?php $content = ob_get_clean(); ?>

<?php require 'backendTemplate.php'; ?>