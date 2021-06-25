<?php

require_once('model/BackendPostManager.php');


function addPost()
{
    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
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
      header('Location: index.php?action=contactUs');
    }

    }


function displayAllPosts()
{
    $backendPostManager = new \Olha\Blog\Model\BackendPostManager();
    $allPosts=$backendPostManager->getAllPosts();
    require_once ('view/backend/dashboardAdminView.php');
}
/*
function deletePost ()
{}

function modifyPost ()
{}

function displayAllComment ()
{}*/