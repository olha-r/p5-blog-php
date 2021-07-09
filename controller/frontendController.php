<?php

        // Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UsersManager.php');

        //POST FUNCTIONS

function listPosts()
{
    $postManager = new \Olha\Blog\Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new \Olha\Blog\Model\PostManager();
    $commentManager = new \Olha\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    /* var_dump($post);
      die();*/
    require('view/frontend/postView.php');
}

        //COMMENT FUNCTIONS

function addComment()
{
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        if (!empty($_POST['comment'])) {
            $commentManager = new \Olha\Blog\Model\CommentManager();
            $comments = $commentManager->postComment($_GET['id'],$_SESSION['member']['id'],$_POST['comment']);
            if ($comments === false) {
                $_SESSION['error']= "Impossible d'ajouter le commentaire !";
                header('Location: index.php?action=post&id=' . $_GET['id']);
            }
            else {
                $_SESSION['success']= "Votre commentaire est publié.";
                header('Location: index.php?action=post&id=' . $_GET['id']);

            }
        }
        else {
            $_SESSION['error']['type']= "Tous les champs ne sont pas remplis !";
            header('Location: index.php?action=post&id=' . $_GET['id']);
            /* throw new Exception('Tous les champs ne sont pas remplis !');*/
        }
    }
    else {
        throw new Exception('Aucun identifiant de billet envoyé');
    }

}

function contactMail()
{
    if (isset($_POST['submit']) && !empty($_POST['submit'])) {
        $to = "ole4ka.safonova@gmail.com";
        $from = $_POST['email'];
        $name = $_POST['name'];
        $subject = "Message de blog";
        $message = $name . " Message:" . "\r\n" . $_POST['message'];

        $name = htmlspecialchars($name);
        $from = htmlspecialchars($from);
        $message = htmlspecialchars($message);
        $name = urldecode($name);
        $from = urldecode($from);
        $message = urldecode($message);
        $name = trim($name);
        $from = trim($from);
        $message = trim($message);

        $headers = "De:" . $from;

        mail($to, $subject, $message, $headers);

        $_SESSION['success']= "Merci pour ton message, il a bien été envoyé.";
        header('Location: index.php?action=contactUs');
      /* return require ('view/frontend/thanksMail.php');*/
    }
    else
    {

        require_once ('view/frontend/contactMailView.php');



    }

}

        //USERS FUNCTIONS

function addNewUser()
{
    if (isset($_POST['submit'])) {
    $newUser = new \Olha\Blog\Model\UsersManager();
    $user_data = $newUser->checkIfUserExist($_POST['new_user_name']);

    if (!empty($user_data)) {
        $_SESSION['error']= "Désolé mais ce pseudo existe déja!";
        header('Location: index.php?action=signUp');
        /*throw new Exception('Désolé mais ce pseudo existe déja!');*/
    }
    if (strlen($_POST['new_user_name']) >16) {
        $_SESSION['error']= "Ce pseudo dépasse 16 caractères";
        header('Location: index.php?action=signUp');
        /*throw new Exception('Ce pseudo dépasse 16 caractères ');*/
    }
    if (!preg_match('#(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W])(?=.{8,16})(?!.*[\s])#', $_POST['new_password_1'])){
        $_SESSION['error']= "Le mot de passe doit contenir: entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.";
        header('Location: index.php?action=signUp');
        /*throw new Exception('Le mot de passe doit contenir: entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.');*/
    }
    if ($_POST['new_password_1'] != $_POST['new_password_2']) {
        $_SESSION['error']= "Désolé mais les mots de passe saisis ne sont pas identiques.";
        header('Location: index.php?action=signUp');
        /*throw new Exception('Désolé mais les mots de passe saisis ne sont pas identiques. ');*/
    }

    if (!preg_match('#^[0-9a-z._-]+@[a-z0-9.-_]{2,}\.[a-z]{2,4}$#', $_POST['new_email'])) {
        $_SESSION['error']= "Désolé mais l'adresse mail saisie n'est pas valide.";
        header('Location: index.php?action=signUp');
        /*throw new Exception("Désolé mais l'adresse mail saisie n'est pas valide.");*/
    }
    $new_password = password_hash($_POST['new_password_1'], PASSWORD_DEFAULT);
    $added_user = $newUser->insertNewUser($_POST['new_user_name'], $new_password, $_POST['new_email'], "member");

    if ($added_user === false) {
        $_SESSION['error']= "Une erreur est survenue lors de l\'enregistrement";
        header('Location: index.php?action=signUp');
        /*throw new Exception('Une erreur est survenue lors de l\'enregistrement');*/

    }

    }
    else {

    require ('view/frontend/signUpView.php');
    }
}

function login_user()
{
    $loginManager = new \Olha\Blog\Model\UsersManager();
    $resultat=$loginManager->signIn();

    if (!$resultat) {
        $_SESSION['error']='Mauvais identifiant ou mot de passe !';
        header('Location: index.php?action=signIn');
    }
    else {
        $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);
        if ($isPasswordCorrect) {
            if ($resultat['role'] == 'member') {

               // $_SESSION['id'] = $resultat['id'];
               // $_SESSION['member'] = $_POST['user_name'];
                $_SESSION['member'] = array('id' => $resultat['id'],
                                            'user_name' => $_POST['user_name']);

                $_SESSION['success']=  'Vous êtes connecté , '.$_POST['user_name'] .' !';

                header('Location: index.php?action=dashboard');
                exit();
            }
            else {
                // $_SESSION['id'] = $resultat['id'];
               // $_SESSION['admin'] = $_POST['user_name'];
                $_SESSION['admin'] = array('id' => $resultat['id'],
                                            'user_name' => $_POST['user_name']);
                $_SESSION['success']='Bienvenue, '.$_POST['user_name'].'!';

                header('Location: index.php?action=dashboardAdmin');
                exit();
            }
        } else {
            $_SESSION['error']='Mauvais identifiant ou mot de passe !';
            header('Location: index.php?action=signIn');
        }
    }
}

function logout()
{
    $_SESSION = array();
    session_destroy();

    header('Location: index.php?action=homePage');
}
