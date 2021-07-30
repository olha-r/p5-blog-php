<?php
session_start();
require_once 'controller/frontendController.php';
require_once 'controller/backendController.php';
$frontendController = new FrontendController();
<<<<<<< HEAD
=======
$backendConroller = new BackendController();
>>>>>>> main
try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'homePage') {
            $frontendController->home_page();
        }   elseif ($_GET['action'] === 'listPosts') {
            $frontendController->listPosts();
<<<<<<< HEAD
        } elseif ($_GET['action'] === 'post') {
=======
        }


        elseif ($_GET['action'] === 'post') {
>>>>>>> main
            $frontendController->post();
        } elseif ($_GET['action'] === 'addComment') {
            $frontendController->addComment();
        } elseif ($_GET['action'] === 'contactUs') {
            $frontendController->contactMail();
        } elseif ($_GET['action'] === 'signUp') {
            $frontendController->addNewUser();
        } elseif ($_GET['action'] === 'signIn') {
            $frontendController->login_user();
        } elseif ($_GET['action'] === 'dashboard') {
            $frontendController->user_dashboard();
        } elseif ($_GET['action'] === 'logout') {
            $frontendController->logout();
        } elseif ($_GET['action'] === 'editUser') {
            $frontendController->updateUserInfo();
        } elseif ($_GET['action'] === 'editPassword') {
            $frontendController->updateUserPassword();
        } elseif ($_GET['action'] === 'deleteUserComment') {
            $frontendController->deleteUserComment();
        } elseif ($_GET['action'] === 'deleteUser') {
            $frontendController->deleteUser();
        } elseif ($_GET['action'] === 'dashboardAdmin') {
<<<<<<< HEAD
            (new BackendController())->displayAllPosts();
        } elseif ($_GET['action'] === 'createPost') {
            (new BackendController())->addPost();
        } elseif ($_GET['action'] === 'displayComments') {
            (new BackendController())->displayAllComments();
        } elseif ($_GET['action'] === 'deletePost') {
            (new BackendController())->deletePost();
        } elseif ($_GET['action'] === 'modifyPost') {
            (new BackendController())->modifyPost();
        } elseif ($_GET['action'] === 'editPost') {
            (new BackendController())->editPost();
        } elseif ($_GET['action'] === 'validateComment') {
            (new BackendController())->validateComment();
        } elseif ($_GET['action'] === 'notValidateComment') {
            (new BackendController())->notValidateComment();
        }
=======
            $backendConroller->displayAllPosts();
        } elseif ($_GET['action'] === 'createPost') {
            $backendConroller->addPost();
        } elseif ($_GET['action'] === 'displayComments') {
            $backendConroller->displayAllComments();
        } elseif ($_GET['action'] === 'deletePost') {
            $backendConroller->deletePost();
        } elseif ($_GET['action'] === 'modifyPost') {
            $backendConroller->modifyPost();
        } elseif ($_GET['action'] === 'editPost') {
            $backendConroller->editPost();
        } elseif ($_GET['action'] === 'validateComment') {
            $backendConroller->validateComment();
        } elseif ($_GET['action'] === 'notValidateComment') {
            $backendConroller->notValidateComment();
        }

>>>>>>> main
    } else {
        $frontendController->home_page();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}