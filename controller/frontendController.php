<?php

// Chargement des classes
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
            } else {
                header('Location:index.php');
            }
        } else {
            $page = 1;
        }
        $nb_posts_per_page = 5;
        $paginateManager = new OC\Blog_php\Model\PaginationManager();
        $nb_posts = $paginateManager->count_posts();
        $nb_pages = ceil($nb_posts / $nb_posts_per_page);
        $firstPostToDisplay = ($page - 1) * $nb_posts_per_page;

        $paginateManager = new OC\Blog_php\Model\PaginationManager();
        $posts = $paginateManager->getPosts($firstPostToDisplay, $nb_posts_per_page);

        require_once 'view/frontend/allPosts.php';
    }


    public function listPosts()
    {
        $postManager = new OC\Blog_php\Model\PostManager();
        $posts = $postManager->getPosts();
        require_once 'view/frontend/listPostsView.php';
    }

    public function post()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postManager = new OC\Blog_php\Model\PostManager();
            $commentManager = new OC\Blog_php\Model\CommentManager();

            $post = $postManager->getPost($_GET['id']);
            $comments = $commentManager->getComments($_GET['id']);

            require_once 'view/frontend/postView.php';
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }
    }

    //COMMENT FUNCTIONS

    public function addComment()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['comment'])) {
                $commentManager = new OC\Blog_php\Model\CommentManager();
                $comments = $commentManager->postComment($_GET['id'], $_SESSION['member']['id'], $_POST['comment']);
                if ($comments === false) {
                    $_SESSION['error'] = "Impossible d'ajouter le commentaire !";
                    header('Location: index.php?action=post&id=' . $_GET['id']);
                } else {
                    $_SESSION['success'] = "Votre commentaire est publié.";
                    header('Location: index.php?action=post&id=' . $_GET['id']);

                }
            } else {
                $_SESSION['error']['type'] = "Tous les champs ne sont pas remplis !";
                header('Location: index.php?action=post&id=' . $_GET['id']);
                /* throw new Exception('Tous les champs ne sont pas remplis !');*/
            }
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }

    }

    public function contactMail()
    {
        if (isset($_POST['submit']) && !empty($_POST['submit'])) {
            $to = "ole4ka.safonova@gmail.com";
            $from = $_POST['email'];
            $name = $_POST['name'];
            $subject = "Message de blog";
            $message = $name . " Message:" . "\r\n" . $_POST['message'];

            $name = htmlspecialchars($name);
            $from = htmlspecialchars($from);
            $message = htmlspecialchars($message);
            $name = urldecode($name);
            $from = urldecode($from);
            $message = urldecode($message);
            $name = trim($name);
            $from = trim($from);
            $message = trim($message);

            $headers = "De:" . $from;

            mail($to, $subject, $message, $headers);

            $_SESSION['success'] = "Merci pour ton message, il a bien été envoyé.";
            header('Location: index.php?action=contactUs');
            /* return require ('view/frontend/thanksMail.php');*/
        } else {
            require_once 'view/frontend/contactMailView.php';
        }

    }

    //USERS FUNCTIONS
    public function user_dashboard()
    {
        if (isset($_SESSION['member']['id']) && $_SESSION['member']['id'] > 0) {
            $userManager = new OC\Blog_php\Model\UsersManager();

            $user_info = $userManager->getUser($_SESSION['member']['id']);
            $frontendController = new OC\Blog_php\Model\CommentManager();
            $user_comments = $frontendController->getUserComments($_SESSION['member']['id']);

            require_once 'view/frontend/profileView.php';
        } else {
            $_SESSION['error'] = "Aucun user identifiant envoyé !";
            header('Location: index.php?dashboard');
        }
    }

    public function addNewUser()
    {
        if (isset($_POST['submit'])) {
            $newUser = new OC\Blog_php\Model\UsersManager();
            $user_data = $newUser->checkIfUserExist($_POST['new_user_name']);

            if (!empty($user_data)) {
                $_SESSION['error'] = "Désolé mais ce pseudo existe déja!";
                header('Location: index.php?action=signUp');
                /*throw new Exception('Désolé mais ce pseudo existe déja!');*/
            }
            if (strlen($_POST['new_user_name']) > 16) {
                $_SESSION['error'] = "Ce pseudo dépasse 16 caractères";
                header('Location: index.php?action=signUp');
                /*throw new Exception('Ce pseudo dépasse 16 caractères ');*/
            }
            if (!preg_match('#(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W])(?=.{8,16})(?!.*[\s])#', $_POST['new_password_1'])) {
                $_SESSION['error'] = "Le mot de passe doit contenir: entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.";
                header('Location: index.php?action=signUp');
                /*throw new Exception('Le mot de passe doit contenir: entre 8 et 16 caractères avec au moins une majuscule, une minuscule, un chiffre et un caractère spécial.');*/
            }
            if ($_POST['new_password_1'] != $_POST['new_password_2']) {
                $_SESSION['error'] = "Désolé mais les mots de passe saisis ne sont pas identiques.";
                header('Location: index.php?action=signUp');
                /*throw new Exception('Désolé mais les mots de passe saisis ne sont pas identiques. ');*/
            }

            if (!preg_match('#^[0-9a-z._-]+@[a-z0-9.-_]{2,}\.[a-z]{2,4}$#', $_POST['new_email'])) {
                $_SESSION['error'] = "Désolé mais l'adresse mail saisie n'est pas valide.";
                header('Location: index.php?action=signUp');
                /*throw new Exception("Désolé mais l'adresse mail saisie n'est pas valide.");*/
            }
            $new_password = password_hash($_POST['new_password_1'], PASSWORD_DEFAULT);
            $added_user = $newUser->insertNewUser($_POST['new_user_name'], $new_password, $_POST['new_email'], "member");

            if ($added_user === false) {
                $_SESSION['error'] = "Une erreur est survenue lors de l\'enregistrement";
                header('Location: index.php?action=signUp');
                /*throw new Exception('Une erreur est survenue lors de l\'enregistrement');*/
            } else {
                $_SESSION['member'] = array('id' => $added_user,
                    'user_name' => $_POST['new_user_name']);
                $_SESSION['success'] = 'Votre compte est créé, ' . $_POST['new_user_name'] . ' !';
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
            $loginManager = new OC\Blog_php\Model\UsersManager();
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
        if (isset($_POST['edit-user-info']) && !empty($_POST['edit-user-info'])) {
            $frontendController = new OC\Blog_php\Model\UsersManager();
            $edit_user_info = $frontendController->update_user($_POST['edit-username'], $_POST['edit-email'], $_GET['id']);
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
            $frontendController = new OC\Blog_php\Model\UsersManager();
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
                    $frontendController = new OC\Blog_php\Model\UsersManager();
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
            $commentManager = new OC\Blog_php\Model\CommentManager();
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
            $userManager = new OC\Blog_php\Model\UsersManager();
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
