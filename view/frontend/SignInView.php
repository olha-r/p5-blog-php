<?php $title = "Se connecter"; ?>

<?php ob_start(); ?>

    <div class="signIn-form">
        <form action="index.php?action=signIn" method="post" class="form-horizontal">
            <div class="col-xs-8 col-xs-offset-4">
                <h2>Connectez-vous</h2>
            </div>
            <div class="form-group" >
                <label class="control-label col-xs-4">Pseudo</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="login_name" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-4">Mot de passe</label>
                <div class="col-xs-8">
                    <input type="password" class="form-control" name="password" required="required">
                </div>
            </div>

            <button type="submit" name="connexion" class="btn btn-danger btn-lg">Se connecter</button>
            <div class="text-center">Vous n'avez pas encore de compte ? <a href="index.php?action=signUp">Inscrivez-vous</a></div>

        </form>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>