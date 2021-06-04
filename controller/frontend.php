<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

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

function addComment()
{
    $commentManager = new \Olha\Blog\Model\CommentManager();

    $affectedLines = $commentManager->postComment($_GET['id'],$_POST['author'],$_POST['comment']);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $_GET['id']);
    }
}
