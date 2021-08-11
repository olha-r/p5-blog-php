<?php

namespace OC\Blog\Controller;
// Chargement des classes
use OC\Blog\Core\SuperGlobals;
use OC\Blog\Model\PostManager;
use OC\Blog\Model\CommentManager;
use OC\Blog\Model\UsersManager;
use OC\Blog\Model\PaginationManager;

require_once 'core/SuperGlobal.php';
require_once 'model/PostManager.php';
require_once 'model/CommentManager.php';
require_once 'model/UsersManager.php';

class FrontendController
{
    //POST FUNCTIONS

    public function listPosts()
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        require_once 'view/frontend/listPostsView.php';
    }

    public function post()
    {
        $get = new SuperGlobals();
        $get_get = $get->get_GET();

        if (isset($get_get['id']) && !empty($get_get['id']) && $get_get['id'] > 0) {
            $postManager = new PostManager();
            $commentManager = new CommentManager();

            $post = $postManager->getPost($get_get['id']);
            $comments = $commentManager->getComments($get_get['id']);
//существует или нет пост

            require_once 'view/frontend/postView.php';
        } else {
            header('Location: index.php?action=homePage');
            $_SESSION['error'] = "Aucun identifiant de billet envoyé !";
        }
    }

    //COMMENT FUNCTIONS

    public function addComment()
    {
        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        $get = new SuperGlobals();
        $get_get = $get->get_GET();

        if (isset($get_get['id']) && !empty($get_get['id']) && $get_get['id'] > 0) {
            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

            if (!$token || $token !== $_SESSION['token']) {
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            } else {
                if (!empty($get_post['comment'])) {
                    $commentManager = new CommentManager();
                    $comments = $commentManager->postComment($get_get['id'], $_SESSION['member']['id'], $get_post['comment']);
                    if ($comments === false) {
                        $_SESSION['error'] = "Impossible d'ajouter le commentaire !";
                        header('Location: index.php?action=post&id=' . $get_get['id']);
                    } else {
                        header('Location: index.php?action=post&id=' . $get_get['id']);
                        $_SESSION['success'] = "Votre commentaire sera publié après la vadidation.";
                    }
                } else {
                    header('Location: index.php?action=post&id=' . $get_get['id']);
                    $_SESSION['error'] = "Tous les champs ne sont pas remplis !";
                }
            }
        } else {
            header('Location: index.php?action=post&id=' . $get_get['id']);
            $_SESSION['error'] = "Aucun identifiant de billet envoyé";
        }
    }

    public function contactMail()
    {
        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        if (isset($get_post['submit']) && !empty($get_post['submit'])) {
            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

            if (!$token || $token !== $_SESSION['token']) {
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            } else {
                $send_to = "ole4ka.safonova@gmail.com";
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

                mail($send_to, $subject, $message, $headers);

                $_SESSION['success'] = "Merci pour ton message, il a bien été envoyé.";
                header('Location: index.php?action=contactUs');
            }
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

            $user_info = $userManager->getUser();
            $frontendController = new CommentManager();
            $user_comments = $frontendController->getUserComments($get_session['member']['id']);

            require_once 'view/frontend/profileView.php';
        } else {
            header('Location: index.php?dashboard');
            $_SESSION['error'] = "Aucun user identifiant envoyé !";
        }
    }

    public function addNewUser()
    {

        $post = new SuperGlobals();
        $get_post = $post->get_POST();


        if (isset($get_post['submit'])) {
            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

            if (!$token || $token !== $_SESSION['token']) {
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            } else {
                $newUser = new UsersManager();
                $user_data = $newUser->checkIfUserExist($get_post['new_user_name']);

                if (!empty($user_data)) {
                    $_SESSION['error'] = "Désolé mais ce pseudo existe déja!";
                    header('Location: index.php?action=signUp');
                    /*throw new Exception('Désolé mais ce pseudo existe déja!');*/
                }
                if (strlen($get_post['new_user_name']) > 16) {
                    $_SESSION['error'] = "Ce pseudo dépasse 16 caractères";
                    header('Location: index.php?action=signUp');
                    /*throw new Exception('Ce pseudo dépasse 16 caractères ');*/
                }
                if (!preg_match('#(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W])(?=.{8,16})(?!.*[\s])#', $get_post['new_password_1'])) {
                    $_SESSION['error'] = "Le mot de passe doit contenir: entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.";
                    header('Location: index.php?action=signUp');
                    /*throw new Exception('Le mot de passe doit contenir: entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.');*/
                }
                if ($get_post['new_password_1'] != $get_post['new_password_2']) {
                    $_SESSION['error'] = "Désolé mais les mots de passe saisis ne sont pas identiques.";
                    header('Location: index.php?action=signUp');
                    /*throw new Exception('Désolé mais les mots de passe saisis ne sont pas identiques. ');*/
                }

                if (!preg_match('#^[0-9a-z._-]+@[a-z0-9.-_]{2,}\.[a-z]{2,4}$#', $get_post['new_email'])) {
                    $_SESSION['error'] = "Désolé mais l'adresse mail saisie n'est pas valide.";
                    header('Location: index.php?action=signUp');
                    /*throw new Exception("Désolé mais l'adresse mail saisie n'est pas valide.");*/
                }
                $new_password = password_hash($get_post['new_password_1'], PASSWORD_DEFAULT);
                $added_user = $newUser->insertNewUser($get_post['new_user_name'], $new_password, $get_post['new_email'], "member");

                if ($added_user === false) {
                    header('Location: index.php?action=signUp');
                    $_SESSION['error'] = "Une erreur est survenue lors de l\'enregistrement";
                    /*throw new Exception('Une erreur est survenue lors de l\'enregistrement');*/
                } else {
                    $_SESSION['member'] = array('id' => $added_user,
                        'user_name' => $get_post['new_user_name']);
                    header('Location: index.php?action=dashboard');
                    $_SESSION['success'] = 'Votre compte est créé, ' . $get_post['new_user_name'] . ' !';
                }
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
            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

            if (!$token || $token !== $_SESSION['token']) {
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            } else {
                $loginManager = new UsersManager();
                $resultat = $loginManager->signIn();

                if (!$resultat) {
                    $_SESSION['error'] = 'Mauvais identifiant ou mot de passe !';
                    header('Location: index.php?action=signIn');
                } else {
                    $isPasswordCorrect = password_verify($_POST['password'], $resultat['password']);
                    if ($isPasswordCorrect) {
                        if ($resultat['role'] == 'admin') {
                            $_SESSION['admin'] = array('id' => $resultat['id'], 'email' => $resultat['email'],
                                'user_name' => $_POST['user_name']);
                            $_SESSION['success'] = 'Bienvenue, ' . $_POST['user_name'] . '!';

                            header('Location: index.php?action=dashboardAdmin');
                        } else {
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
            }

        } else {
            require_once 'view/frontend/loginView.php';
        }
    }

    public function logout()
    {
        $_SESSION = array();
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
        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        if (isset($get_post['edit-user-info']) && !empty($get_post['edit-user-info'])) {
            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

            if (!$token || $token !== $_SESSION['token']) {
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            } else {
                $frontendController = new UsersManager();
                $edit_user_info = $frontendController->update_user($get_post['edit-username'], $get_post['edit-email'], $_GET['id']);
                if ($edit_user_info === false) {
                    $_SESSION['error'] = "Une erreur est survenue. Impossible de mofifier user informations !";
                    header('Location: index.php?action=dashboard');
                } else {
                    $_SESSION['success'] = "Vos information été modifiés !";
                    header('Location: index.php?action=dashboard');
                }
            }
        } else {
            $_SESSION['error'] = "Aucun user identifiant envoyé !";
            header('Location: index.php?action=dashboard');
        }
    }

    public function updateUserPassword()
    {
        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        if (isset($get_post['update-password']) && !empty($get_post['update-password'])) {
            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

            if (!$token || $token !== $_SESSION['token']) {
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            } else {
                if ($get_post['edit-password-first'] !== $get_post['edit-password-second']) {
                    $_SESSION['error'] = 'Les mots de passe ne sont pas identiques !';
                    header('Location: index.php?action=dashboard');
                } else {
                    $frontendController = new UsersManager();
                    $edited_password = password_hash($get_post['edit-password-first'], PASSWORD_DEFAULT);
                    $edit_password = $frontendController->update_password($edited_password, $_GET['id']);
                    if ($edit_password === false) {
                        $_SESSION['error'] = "Une erreur est survenue. Impossible de mofifier mot de passe !";
                        header('Location: index.php?action=dashboard');
                    } else {
                        $_SESSION['success'] = "Votre mot de passe a été modifiés !";
                        header('Location: index.php?action=dashboard');
                    }
                }
            }
        } else {
            header('Location: index.php?action=dashboard');
            $_SESSION['error'] = "Aucun mot de passe envoyé !";
        }
    }

    function deleteUserComment()
    {
        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        if (isset($get_post['delete_user_comment']) && !empty($get_post['delete_user_comment'])) {
            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

            if (!$token || $token !== $_SESSION['token']) {
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            } else {
                $commentManager = new CommentManager();
                $deleted_comment = $commentManager->deleteUserComment($get_post['commentUserId']);

                if ($deleted_comment === false) {
                    $_SESSION['error'] = "Une erreur est survenue. Impossible de supprimer le commentaire!";
                    header('Location: index.php?action=dashboard');
                } else {
                    $_SESSION['success'] = "Le commentaire est supprimé.";
                    header('Location: index.php?action=dashboard');
                }
            }
        } else {
            require_once './view/frontend/profileView.php';
        }
    }

    function deleteUser()
    {
        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        if (isset($get_post['delete_user']) && !empty($get_post['delete_user'])) {
            $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);

            if (!$token || $token !== $_SESSION['token']) {
                // return 405 http status code
                header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
                exit;
            } else {
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
            }
        } else {
            require_once './view/frontend/profileView.php';
        }
    }
}
