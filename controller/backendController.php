<?php

namespace OC\Blog\Controller;

use OC\Blog\Core\SuperGlobals;
use OC\Blog\Model\BackendCommentManager;
use OC\Blog\Model\BackendPostManager;
use OC\Blog\Model\PostManager;

require_once 'core/SuperGlobal.php';
require_once 'model/BackendPostManager.php';
require_once 'model/PostManager.php';
require_once 'model/BackendCommentManager.php';

class BackendController
{
    function addPost()
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $post = new SuperGlobals();
            $get_post = $post->get_POST();
            if (isset($get_post['submit'])) {
                if (isset($get_post['title']) && isset($get_post['fragment']) && isset($get_post['content'])
                    && !empty($get_post['title']) && !empty($get_post['fragment']) && !empty($get_post['content'])) {
                    $backendPostManager = new BackendPostManager();
                    $added_post = $backendPostManager->addNewPost($get_post['title'], $get_post['fragment'], $get_post['content'], $_SESSION['admin']['id']);

                    if ($added_post === false) {
                        header('Location: index.php?action=createPost');
                        $_SESSION['error'] = "Une erreur est survenue. Impossible d'enregistrer l'article.!";
                    } else {
                        header('Location: index.php?action=dashboardAdmin');
                        $_SESSION['success'] = "Votre article est ajouté.";
                    }
                }
            }
            require_once './view/backend/createPostView.php';
        } else {
            $_SESSION['error'] = "Vous n'avez pas le droit !";
            header('Location: index.php?action=homePage');
        }
    }

    function displayAllPosts()
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $backendPostManager = new BackendPostManager();
            $allPosts = $backendPostManager->getAllPosts();
            require_once 'view/backend/backendListPostsView.php';
        } else {
            $_SESSION['error'] = "Vous n'avez pas le droit !";
            header('Location: index.php?action=homePage');
        }
    }

    function modifyPost()
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $get = new SuperGlobals();
            $get_get = $get->get_GET();

            if (isset($get_get['id']) && !empty($get_get['id']) && $get_get['id'] > 0) {
                $postManager = new PostManager();
                $post = $postManager->getPost($get_get['id']);
                require_once 'view/backend/editPostView.php';
            } else {
                header('Location: index.php?action=dashboardAdmin');
                $_SESSION['error'] = "Aucun identifiant de billet envoyé !";
            }
        } else {
            $_SESSION['error'] = "Vous n'avez pas le droit !";
            header('Location: index.php?action=homePage');
        }
    }

    function editPost()
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $post = new SuperGlobals();
            $get_post = $post->get_POST();

            $get = new SuperGlobals();
            $get_get = $get->get_GET();

            if (isset($get_post['edit']) && !empty($get_post['edit'])) {
                $backendPostManager = new BackendPostManager();
                $edit = $backendPostManager->editPost(
                    $get_post['edit-title'],
                    $get_post['edit-content'],
                    $get_get['id']);
                if ($edit === false) {
                    header('Location: index.php?action=dashboardAdmin');
                    $_SESSION['error'] = "Une erreur est survenue. Impossible de mofifier l'article !";
                } else {
                    header('Location: index.php?action=dashboardAdmin');
                    $_SESSION['success'] = "Votre article est modifié !";
                }
            } else {
                $_SESSION['error'] = "Aucun identifiant de billet envoyé !";
                header('Location: index.php?action=editPost');
            }

        } else {
            $_SESSION['error'] = "Vous n'avez pas le droit !";
            header('Location: index.php?action=homePage');
        }
    }

    function deletePost()
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $post = new SuperGlobals();
            $get_post = $post->get_POST();

            if (isset($get_post['delete']) && !empty($get_post['delete'])) {
                $backendPostManager = new BackendPostManager();
                $delete = $backendPostManager->deletePost($get_post['id']);
                if ($delete === false) {
                    $_SESSION['error'] = "Une erreur est survenue. Impossible de supprimer l'article!";
                    header('Location: index.php?action=dashboardAdmin');
                } else {
                    $_SESSION['success'] = "Votre article est supprimé.";
                    header('Location: index.php?action=dashboardAdmin');
                }
            }
            require_once './view/backend/backendListPostsView.php';
        } else {
            $_SESSION['error'] = "Vous n'avez pas le droit !";
            header('Location: index.php?action=homePage');
        }
    }

    function displayAllComments()
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $commentManager = new BackendCommentManager();
            $all_comments = $commentManager->getAllComments();
            require_once './view/backend/backendCommentsView.php';
        } else {
            $_SESSION['error'] = "Vous n'avez pas le droit !";
            header('Location: index.php?action=homePage');
        }
    }

    function validateComment()
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $post = new SuperGlobals();
            $get_post = $post->get_POST();

            if (isset($get_post['validate']) && !empty($get_post['validate'])) {
                $commentManager = new BackendCommentManager();
                $valid_comment = $commentManager->approveComment($get_post['commentId']);
                if ($valid_comment === false) {
                    $_SESSION['error'] = "Une erreur est survenue. Impossible de valider le commentaire!";
                    header('Location: index.php?action=displayComments');
                } else {
                    $_SESSION['success'] = "Le commentaire est validé et publié.";
                    header('Location: index.php?action=displayComments');
                }
            }
            require_once './view/backend/backendCommentsView.php';

        } else {
            $_SESSION['error'] = "Vous n'avez pas le droit !";
            header('Location: index.php?action=homePage');
        }
    }

    function notValidateComment()
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $post = new SuperGlobals();
            $get_post = $post->get_POST();

            if (isset($get_post['not_validate']) && !empty($get_post['not_validate'])) {
                $commentManager = new BackendCommentManager();
                $not_valid_comment = $commentManager->notApproveComment($get_post['commentId']);

                if ($not_valid_comment === false) {
                    $_SESSION['error'] = "Une erreur est survenue. Impossible de supprimer le commentaire!";
                    header('Location: index.php?action=displayComments');
                }
                $_SESSION['success'] = "Le commentaire est supprimé.";
                header('Location: index.php?action=displayComments');
            }
            require_once './view/backend/backendCommentsView.php';
        } else {
            $_SESSION['error'] = "Vous n'avez pas le droit !";
            header('Location: index.php?action=homePage');
        }
    }

}

