<?php

namespace OC\Blog\Controller;
// Chargement des classes
use OC\Blog\SuperGlobal\SuperGlobals;
use OC\Blog\Model\PostManager;
use OC\Blog\Model\CommentManager;
use OC\Blog\Model\UsersManager;
use OC\Blog\Model\PaginationManager;

require_once 'SuperGlobal/SuperGlobal.php';
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
require_once 'model/UsersManager.php';
require_once 'model/PaginationManager.php';

class FrontendController
{
    //POST FUNCTIONS

    public function paginate()
    {
        if (isset($_GET['page'])) {
            if ($_GET['page'] < 100) {
                $page = (int)$_GET['page'];
            }
                header('Location:index.php');
        } else {
            $page = 1;
        }
        $nb_posts_per_page = 5;
        $paginateManager = new PaginationManager();
        $nb_posts = $paginateManager->count_posts();
        $nb_pages = ceil($nb_posts / $nb_posts_per_page);
        $firstPostToDisplay = ($page - 1) * $nb_posts_per_page;

        $paginateManager = new PaginationManager();
        $posts = $paginateManager->getPosts($firstPostToDisplay, $nb_posts_per_page);

        require_once 'view/frontend/allPosts.php';
    }


    public function listPosts()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        require_once 'view/frontend/listPostsView.php';
    }

    public function post()
    {
        $key = new SuperGlobals();
        $get_session = $key->get_SESSION();

        $get = new SuperGlobals();
        $get_get = $get->get_GET();

        if (isset($get_get['id']) && $get_get['id'] > 0) {
            $postManager = new PostManager();
            $commentManager = new CommentManager();

            $post = $postManager->getPost($get_get['id']);
            $comments = $commentManager->getComments($get_get['id']);

            require_once 'view/frontend/postView.php';
        } else {
            $get_session['error'] = "Aucun identifiant de billet envoyé !";
        }
    }

    //COMMENT FUNCTIONS

    public function addComment()
    {
        $key = new SuperGlobals();
        $get_session = $key->get_SESSION();

        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        $get = new SuperGlobals();
        $get_get = $get->get_GET();

        if (isset($get_get['id']) && $get_get['id'] > 0) {
            if (!empty($get_post['comment'])) {
                $commentManager = new CommentManager();
                $comments = $commentManager->postComment($get_get['id'], $_SESSION['member']['id'], $get_post['comment']);
                if ($comments === false) {
                    $get_session['error'] = "Impossible d'ajouter le commentaire !";
                    header('Location: index.php?action=post&id=' . $get_get['id']);
                } else {
                   $get_session['success'] = "Votre commentaire est publié.";
                    header('Location: index.php?action=post&id=' . $get_get['id']);

                }
            } else {
                $get_session['error'] = "Tous les champs ne sont pas remplis !";
                header('Location: index.php?action=post&id=' . $get_get['id']);
            }
        } else {
            $get_session['error'] = "Aucun identifiant de billet envoyé";
        }
    }

    public function contactMail()
    {
        $key = new SuperGlobals();
        $get_session = $key->get_SESSION();

        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        if (isset($get_post['submit']) && !empty($get_post['submit'])) {
            $to = "ole4ka.safonova@gmail.com";
            $from = $get_post['email'];
            $name = $get_post['name'];
            $subject = "Message de blog";
            $name = htmlspecialchars($name);
            $name = trim($name);
            $name = urldecode($name);

            $message = $name . " Message:" . "\r\n" . $get_post['message'];


            $from = htmlspecialchars($from);
            $message = htmlspecialchars($message);
            $from = urldecode($from);
            $message = urldecode($message);
            $from = trim($from);
            $message = trim($message);

            $headers = "De:" . $from;

            mail($to, $subject, $message, $headers);

            $get_session['success'] = "Merci pour ton message, il a bien été envoyé.";
            header('Location: index.php?action=contactUs');
        } else {
            require_once 'view/frontend/contactMailView.php';
        }

    }

    //USERS FUNCTIONS
    public function user_dashboard()
    {
        $key = new SuperGlobals();
        $get_session = $key->get_SESSION();

        if (isset($get_session['member']['id']) && $get_session['member']['id'] > 0) {
            $userManager = new UsersManager();

            $user_info = $userManager->getUser($get_session['member']['id']);
            $frontendController = new CommentManager();
            $user_comments = $frontendController->getUserComments($get_session['member']['id']);

            require_once 'view/frontend/profileView.php';
        } else {
            $get_session['error'] = "Aucun user identifiant envoyé !";
            header('Location: index.php?dashboard');
        }
    }

    public function addNewUser()
    {

        $key = new SuperGlobals();
        $get_session = $key->get_SESSION();

        $post = new SuperGlobals();
        $get_post = $post->get_POST();


        if (isset($get_post['submit'])) {
            $newUser = new UsersManager();
            $user_data = $newUser->checkIfUserExist($get_post['new_user_name']);

            if (!empty($user_data)) {
                $get_session['error'] = "Désolé mais ce pseudo existe déja!";
                header('Location: index.php?action=signUp');
                /*throw new Exception('Désolé mais ce pseudo existe déja!');*/
            }
            if (strlen($get_post['new_user_name']) > 16) {
                $get_session['error'] = "Ce pseudo dépasse 16 caractères";
                header('Location: index.php?action=signUp');
                /*throw new Exception('Ce pseudo dépasse 16 caractères ');*/
            }
            if (!preg_match('#(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W])(?=.{8,16})(?!.*[\s])#', $get_post['new_password_1'])) {
                $get_session['error'] = "Le mot de passe doit contenir: entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.";
                header('Location: index.php?action=signUp');
                /*throw new Exception('Le mot de passe doit contenir: entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.');*/
            }
            if ($get_post['new_password_1'] != $get_post['new_password_2']) {
                $get_session['error'] = "Désolé mais les mots de passe saisis ne sont pas identiques.";
                header('Location: index.php?action=signUp');
                /*throw new Exception('Désolé mais les mots de passe saisis ne sont pas identiques. ');*/
            }

            if (!preg_match('#^[0-9a-z._-]+@[a-z0-9.-_]{2,}\.[a-z]{2,4}$#', $get_post['new_email'])) {
                $get_session['error'] = "Désolé mais l'adresse mail saisie n'est pas valide.";
                header('Location: index.php?action=signUp');
                /*throw new Exception("Désolé mais l'adresse mail saisie n'est pas valide.");*/
            }
            $new_password = password_hash($get_post['new_password_1'], PASSWORD_DEFAULT);
            $added_user = $newUser->insertNewUser($get_post['new_user_name'], $new_password, $get_post['new_email'], "member");

            if ($added_user === false) {
                $get_session['error'] = "Une erreur est survenue lors de l\'enregistrement";
                header('Location: index.php?action=signUp');
                /*throw new Exception('Une erreur est survenue lors de l\'enregistrement');*/
            } else {
                $get_session['member'] = array('id' => $added_user,
                    'user_name' => $get_post['new_user_name']);
                $get_session['success'] = 'Votre compte est créé, ' . $get_post['new_user_name'] . ' !';
                header('Location: index.php?action=dashboard');
            }
        } else {
            require_once 'view/frontend/signUpView.php';
        }
    }

    public function login_user()
    {

        if (isset($_POST['user_name']) && isset($_POST['password'])
            && !empty($_POST['user_name']) && !empty($_POST['password'])
        ) {
            /* strip_tags($_POST['user_name']),
                 strip_tags($_POST['password'])*/
            $loginManager = new UsersManager();
            $resultat = $loginManager->signIn();

            if (!$resultat) {
                $_SESSION['error'] = 'Mauvais identifiant ou mot de passe !';
                header('Location: index.php?action=signIn');
            } else {
                $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);
                if ($isPasswordCorrect) {
                    if ($resultat['role'] == 'admin') {
                        // $_SESSION['id'] = $resultat['id'];
                        // $_SESSION['admin'] = $_POST['user_name'];
                        $_SESSION['admin'] = array('id' => $resultat['id'], 'email' => $resultat['email'],
                            'user_name' => $_POST['user_name']);
                        $_SESSION['success'] = 'Bienvenue, ' . $_POST['user_name'] . '!';

                        header('Location: index.php?action=dashboardAdmin');
                    } else {
                        // $_SESSION['id'] = $resultat['id'];
                        // $_SESSION['member'] = $_POST['user_name'];
                        $_SESSION['member'] = array('id' => $resultat['id'], 'email' => $resultat['email'],
                            'user_name' => $_POST['user_name']);
                        $_SESSION['success'] = 'Vous êtes connecté ! ';
                        header('Location: index.php?action=dashboard');
                    }
                } else {
                    $_SESSION['error'] = 'Mauvais identifiant ou mot de passe !';
                    header('Location: index.php?action=signIn');
                }
            }
        } else {
            //$_SESSION['error'] = "Tous les champs ne sont pas remplis !";
            require_once 'view/frontend/loginView.php';
        }
    }

    public function logout()
    {

        $key = new SuperGlobals();
        $get_session = $key->get_SESSION();

        $get_session = array();
        session_destroy();
        header('Location: index.php?action=homePage');
    }

    //HOME PAGE
    public function home_page()
    {
        require_once 'view/frontend/homePageView.php';
    }

    public function updateUserInfo()
    {

        $key = new SuperGlobals();
        $get_session = $key->get_SESSION();

        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        $get = new SuperGlobals();
        $get_get = $get->get_GET();

        if (isset($get_post['edit-user-info']) && !empty($get_post['edit-user-info'])) {
            $frontendController = new UsersManager();
            $edit_user_info = $frontendController->update_user($get_post['edit-username'], $get_post['edit-email'], $_GET['id']);
            if ($edit_user_info === false) {
                $_SESSION['error'] = "Une erreur est survenue. Impossible de mofifier user informations !";
                header('Location: index.php?action=dashboard');
            } else {
                $_SESSION['success'] = "Vos information été modifiés !";
                header('Location: index.php?action=dashboard');
            }

        } else {
            $_SESSION['error'] = "Aucun user identifiant envoyé !";
            header('Location: index.php?action=dashboard');
        }
    }

    public function updateUserPassword()
    {
        if (isset($_POST['update-password']) && !empty($_POST['update-password'])) {
            $frontendController = new UsersManager();
            $resultat = $frontendController->getUser($_GET['id']);

            if (!$resultat) {
                $_SESSION['error'] = 'Mauvais mot de passe !';
                header('Location: index.php?action=dashboard');
            } else {
                $isPasswordIdentic = password_verify($_POST['edit-password-first'], $resultat['password']);
                if (!$isPasswordIdentic) {
                    $_SESSION['error'] = 'Les mots de passe ne sont pas identiques !';
                    header('Location: index.php?action=dashboard');
                } else {
                    $frontendController = new UsersManager();
                    $edited_password = password_hash($_POST['edit-password-first'], PASSWORD_DEFAULT);
                    $edit_password = $frontendController->update_password($edited_password, $_GET['id']);
                    if ($edit_password === false) {
                        $_SESSION['error'] = "Une erreur est survenue. Impossible de mofifier mot de passe !";
                        header('Location: index.php?action=dashboard');
                    } else {
                        $_SESSION['success'] = "Vos mot de passe été modifiés !";
                        header('Location: index.php?action=dashboard');
                    }
                }
            }
        } else {
            $_SESSION['error'] = "Aucun mot de passe envoyé !";
            header('Location: index.php?action=dashboard');
        }
    }

    function deleteUserComment()
    {
        if (isset($_POST['delete_user_comment']) && !empty($_POST['delete_user_comment'])) {
            $commentManager = new CommentManager();
            $deleted_comment = $commentManager->deleteUserComment($_POST['commentUserId']);

            if ($deleted_comment === false) {
                $_SESSION['error'] = "Une erreur est survenue. Impossible de supprimer le commentaire!";
                header('Location: index.php?action=dashboard');
            } else {
                $_SESSION['success'] = "Le commentaire est supprimé.";
                header('Location: index.php?action=dashboard');
            }
        } else {
            require_once './view/frontend/profileView.php';
        }
    }

    function deleteUser()
    {
        if (isset($_POST['delete_user']) && !empty($_POST['delete_user'])) {
            $userManager = new UsersManager();
            $deleted_user = $userManager->delete_user($_SESSION['member']['id']);

            if ($deleted_user === false) {
                $_SESSION['error'] = "Une erreur est survenue. Impossible de supprimer le compte!";
                header('Location: index.php?action=dashboard');
            } else {
                unset($_SESSION['member']);
                $_SESSION['success'] = "Le compte est supprimé.";
                header('Location: index.php');
            }
        } else {
            require_once './view/frontend/profileView.php';
        }
    }

}
