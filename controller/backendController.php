<?php

require_once('model/BackendPostManager.php');
require_once('model/PostManager.php');
require_once('model/BackendCommentManager.php');

function addPost()
{
    if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
        if (isset($_POST['title']) && isset($_POST['content'])) {
            $backendPostManager = new \Olha\Blog\Model\BackendPostManager();
            $added_post = $backendPostManager->addNewPost($_POST['title'],$_POST['content'], $_SESSION['id']);
            if ($added_post === false) {
                $_SESSION['error']= "Une erreur est survenue. Impossible d'enregistrer l'article.!";
            }
            else {
                $_SESSION['error']= "Votre post est ajouté.";
                header('monblog/backendIndex.php?action=displayAllPosts');
                echo 'Votre post est ajouté.';
            }
        }
        else {
            require ('./view/backend/createPostView.php');
        }
    }
    else
    {
        header('./view/backend/createPostView.php');
     /* header('Location: index.php?action=contactUs');*/
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
        throw new Exception('Aucun identifiant de billet envoyé');
    }
}

function editPost ()
{

    if (isset($_POST['edit']) && !empty(['edit'])) {
        $backendPostManager = new \Olha\Blog\Model\BackendPostManager();
        $edit = $backendPostManager->editPost($_POST['edit-title'], $_POST['edit-content'],  $_GET['id']);
if ($edit === false) {
    echo "Une erreur est survenue. Impossible de mofifier l'article.!";
    $_SESSION['error']= "Une erreur est survenue. Impossible de mofifier l'article.!";
}
else {
    $_SESSION['error']= "Votre article est modifié.";
    header('Location: index.php?action=dashboardAdmin');
}

    }
    else {
        throw new Exception('Aucun identifiant de billet envoyé');
    }
}

function deletePost ()
{
if (isset($_POST['delete']) && !empty($_POST['delete'])) {
    $backendPostManager = new \Olha\Blog\Model\BackendPostManager();
    $delete = $backendPostManager->deletePost($_POST['id']);
   if ($delete === false) {
        $_SESSION['error']= "Une erreur est survenue. Impossible de supprimer l'article.!";
    }
    else {
        $_SESSION['error']= "Votre article est supprimé.";
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