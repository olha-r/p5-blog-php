<?php

require_once('model/BackendPostManager.php');
require_once('model/PostManager.php');


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
                /*header('monblog/backendIndex.php?action=displayAllPosts');*/
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
    $backendPostManager = new \Olha\Blog\Model\BackendPostManager();
    $allPosts=$backendPostManager->getAllPosts();
    require_once ('view/backend/dashboardAdminView.php');
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
/*
function deletePost ()
{
    if (isset($_POST['submit'])) {
        $backendPostManager = new \Olha\Blog\Model\BackendPostManager();
        $del_post = $backendPostManager->deletePost();
}
}
*/
/*
function displayAllComment ()
{}*/