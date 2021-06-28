
<?php $title = "Se connecter"; ?>

<?php ob_start(); ?>

<div class="row justify-content-center">
    <div class="col-md-8  col-lg-6" id="signin-form">
        <form action="index.php?action=signIn" method="post" class="form-horizontal">
            <div class="col-xs-8 col-xs-offset-4">
                <h2>Connectez-vous</h2>
            </div>
            <div class="form-group" >
                <label class="control-label col-xs-4">Pseudo</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" name="user_name" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-4">Mot de passe</label>
                <div class="col-xs-8">
                    <input type="password" class="form-control" name="password" required="required">
                </div>
            </div>

            <input type="submit" value="Se connecter" class="btn btn-lg btn-outline-danger"/>
            <br/>
            <div class="text-center">Vous n'avez pas encore de compte ? <a href="index.php?action=signUp">Inscrivez-vous</a></div>

    </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<?php unset($_SESSION['error']); ?>

