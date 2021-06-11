<?php $title = "Inscription"; ?>

<?php ob_start(); ?>

    <div class="signin-form">
        <form action="index.php?action=signUp" method="post" class="form-horizontal">
            <div class="col-xs-8 col-xs-offset-4">
                <h2>Créez votre compte</h2>
            </div>
            <div class="form-group" >
                <label class="control-label col-xs-4">Pseudo</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="new_login_name" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-4">Email</label>
                <div class="col-xs-8">
                    <input type="email" class="form-control" name="new_email" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-4">Mot de passe</label>
                <div class="col-xs-8">
                    <input type="password" class="form-control" name="new_password_1" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-4">Confirmez votre mot de passe</label>
                <div class="col-xs-8">
                    <input type="password" class="form-control" name="new_password_2" required="required">
                </div>
            </div>
            <input type="submit" name="submit" class="btn btn-danger btn-lg" value="S'inscrire">
            <div class="text-center">Vous avez déjà un compte ? <a href="index.php?action=signIn">Connectez-vous</a></div>
        </form>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
