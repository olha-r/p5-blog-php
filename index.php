<?php
session_start();
require('controller/frontendController.php');
require('controller/backendController.php');
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'homePage') {
            require_once ('view/frontend/homePageView.php');
        }

        elseif ($_GET['action'] === 'listPosts') {
            listPosts();
        }

        elseif ($_GET['action'] === 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }

        elseif ($_GET['action'] === 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
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
        elseif ($_GET['action'] === 'contactUs') {
            contactMail();
        }
        elseif ($_GET['action'] === 'signUp') {
            addNewUser();
        }
        elseif ($_GET['action'] === 'signIn') {
            if (isset($_POST['user_name']) && isset($_POST['password'])
                && !empty($_POST['user_name']) && !empty($_POST['password'])
            ) {
                login_user(
                    strip_tags($_POST['user_name']),
                    strip_tags($_POST['password'])
                );
            } else {
                $_SESSION['error']= "Tous les champs ne sont pas remplis !";
                require ('view/frontend/loginView.php');
            }

        }
        elseif ($_GET['action'] === 'dashboard') {
            require_once('view/frontend/profileView.php');
        }
        elseif ($_GET['action'] === 'logout') {
            logout();
        }
        elseif ($_GET['action'] === 'dashboardAdmin') {
            displayAllPosts();
        }
        elseif ($_GET['action'] === 'createPost') {
            addPost();
        }
        elseif ($_GET['action'] === 'displayComments') {
            displayAllComments();
        }
        elseif ($_GET['action'] === 'deletePost') {
            deletePost();
        }
        elseif ($_GET['action'] === 'modifyPost') {
            modifyPost();
        }
        elseif ($_GET['action'] === 'editPost') {
            editPost();
        }

    }
    else {
        require_once ('view/frontend/homePageView.php');
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
