<?php
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

use OC\Blog\Controller\BackendController;
use OC\Blog\Controller\FrontendController;

require_once 'controller/frontendController.php';
require_once 'controller/backendController.php';
$frontendController = new FrontendController();
if (isset($_GET['p'])) {
    $page = $_GET['p'];
}
try {
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        $page = $_GET['action'];
        if ($page === 'homePage') {
            $frontendController->home_page();
        }   elseif ($page === 'listPosts') {
            $frontendController->listPosts();
        } elseif ($page === 'post') {
            $frontendController->post();
        } elseif ($page === 'addComment') {
            $frontendController->addComment();
        } elseif ($page === 'contactUs') {
            $frontendController->contactMail();
        } elseif ($page === 'signUp') {
            $frontendController->addNewUser();
        } elseif ($page === 'signIn') {
            $frontendController->login_user();
        } elseif ($page === 'dashboard') {
            $frontendController->user_dashboard();
        } elseif ($page === 'logout') {
            $frontendController->logout();
        } elseif ($page === 'editUser') {
            $frontendController->updateUserInfo();
        } elseif ($page === 'editPassword') {
            $frontendController->updateUserPassword();
        } elseif ($page === 'deleteUserComment') {
            $frontendController->deleteUserComment();
        } elseif ($page === 'deleteUser') {
            $frontendController->deleteUser();
        } elseif ($page === 'dashboardAdmin') {
            (new BackendController())->displayAllPosts();
        } elseif ($page === 'createPost') {
            (new BackendController())->addPost();
        } elseif ($page === 'displayComments') {
            (new BackendController())->displayAllComments();
        } elseif ($page === 'deletePost') {
            (new BackendController())->deletePost();
        } elseif ($page === 'modifyPost') {
            (new BackendController())->modifyPost();
        } elseif ($page === 'editPost') {
            (new BackendController())->editPost();
        } elseif ($page === 'validateComment') {
            (new BackendController())->validateComment();
        } elseif ($page === 'notValidateComment') {
            (new BackendController())->notValidateComment();
        } else {
            echo '404';
        }
    } else {
        $frontendController->home_page();
    }
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
