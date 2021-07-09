<?php

require_once('model/BackendPostManager.php');
require_once('model/PostManager.php');
require_once('model/BackendCommentManager.php');

function addPost()
{
    if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
        if (isset($_POST['title']) && isset($_POST['content'])) {
            $backendPostManager = new \Olha\Blog\Model\BackendPostManager();

            $added_post = $backendPostManager->addNewPost($_POST['title'],$_POST['content'], $_SESSION['admin']['id']);

            if ($added_post === false) {
                $_SESSION['error']= "Une erreur est survenue. Impossible d'enregistrer l'article.!";
                header('Location: index.php?action=createPost');
            }
            else {
                $_SESSION['success']= "Votre post est ajouté.";
                header('Location: index.php?action=dashboardAdmin');
            }
        }
        else {
            require ('./view/backend/createPostView.php');
        }
    }
    else
    {
        require ('./view/backend/createPostView.php');
        /*header('./view/backend/createPostView.php'); ??????? */
    }

    }

function displayAllPosts()
{
    if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
        $backendPostManager = new \Olha\Blog\Model\BackendPostManager();
        $allPosts=$backendPostManager->getAllPosts();
        require_once ('view/backend/dashboardAdminView.php');
    }
   else {
       $_SESSION['error']= "Vous n'avez pas le droit !";
       header('Location: index.php?action=homePage');
   }
}

function modifyPost ()
{
    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $postManager = new \Olha\Blog\Model\PostManager();
        $post = $postManager->getPost($_GET['id']);
        require_once ('view/backend/editPostView.php');
    }
    else {
        $_SESSION['error']= "Aucun identifiant de billet envoyé !";
        header('Location: index.php?action=modifyPost');
    }
}

function editPost ()
{

    if (isset($_POST['edit']) && !empty(['edit'])) {
        $backendPostManager = new \Olha\Blog\Model\BackendPostManager();
        $edit = $backendPostManager->editPost($_POST['edit-title'], $_POST['edit-content'],  $_GET['id']);
if ($edit === false) {
    $_SESSION['error']= "Une erreur est survenue. Impossible de mofifier l'article !";
    header('Location: index.php?action=dashboardAdmin');
}
else {
    $_SESSION['success']= "Votre article est modifié !";
    header('Location: index.php?action=dashboardAdmin');
}

    }
    else {
        $_SESSION['error']= "Aucun identifiant de billet envoyé !";
        header('Location: index.php?action=editPost');
    }
}

function deletePost ()
{
if (isset($_POST['delete']) && !empty($_POST['delete'])) {
    $backendPostManager = new \Olha\Blog\Model\BackendPostManager();
    $delete = $backendPostManager->deletePost($_POST['id']);
   if ($delete === false) {
       $_SESSION['error']= "Une erreur est survenue. Impossible de supprimer l'article!";
       header('Location: index.php?action=dashboardAdmin');
    }
    else {
        $_SESSION['success']= "Votre article est supprimé.";
        header('Location: index.php?action=dashboardAdmin');
    }
}
else {
    require_once ('./view/backend/dashboardAdminView.php');
}
}

function displayAllComments ()
{
    $backendCommentManager = new \Olha\Blog\Model\BackendCommentManager();
    $all_comments = $backendCommentManager->getAllComments();

    require_once ('./view/backend/backendCommentsView.php');
}