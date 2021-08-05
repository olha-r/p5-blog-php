<?php

use OC\Blog\SuperGlobal\SuperGlobals;

require_once 'SuperGlobal/SuperGlobal.php';
require_once 'model/BackendPostManager.php';
require_once 'model/PostManager.php';
require_once 'model/BackendCommentManager.php';

class BackendController
{
    function addPost()
    {
        $key = new SuperGlobals();
        $get_session = $key->get_SESSION();

        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        if (isset($get_session['admin']) && !empty($get_session['admin'])) {
            if (isset($get_post['submit'])) {
                if (isset($get_post['title']) && isset($get_post['fragment']) && isset($get_post['content'])
                    && !empty($get_post['title']) && !empty($get_post['fragment']) && !empty($get_post['content'])) {
                    $backendPostManager = new OC\Blog_php\Model\BackendPostManager();
                    $added_post = $backendPostManager->addNewPost($get_post['title'], $get_post['fragment'], $get_post['content'], $get_session['admin']['id']);

                    if ($added_post == false) {
                        $get_session['error'] = "Une erreur est survenue. Impossible d'enregistrer l'article.!";
                        header('Location: index.php?action=createPost');
                    }
                    $get_session['success'] = "Votre article est ajouté.";
                    header('Location: index.php?action=dashboardAdmin');
                }
            }
        }
        require_once './view/backend/createPostView.php';
    }

    function displayAllPosts()
    {
        $key = new SuperGlobals();
        $get_session = $key->get_SESSION();

        if (isset($get_session['admin']) && !empty($get_session['admin'])) {
            $backendPostManager = new OC\Blog_php\Model\BackendPostManager();
            $allPosts = $backendPostManager->getAllPosts();
            require_once 'view/backend/backendListPostsView.php';
        } else {
            $get_session['error'] = "Vous n'avez pas le droit !";
            header('Location: index.php?action=homePage');
        }
    }

    function modifyPost()
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $postManager = new OC\Blog_php\Model\PostManager();
            $post = $postManager->getPost($_GET['id']);
            require_once 'view/backend/editPostView.php';
        } else {
            $_SESSION['error'] = "Aucun identifiant de billet envoyé !";
            header('Location: index.php?action=modifyPost');
        }
    }

    function editPost()
    {
        $key = new SuperGlobals();
        $get_session = $key->get_SESSION();

        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        $get = new SuperGlobals();
        $get_get = $get->get_GET();

        if (isset($get_post['edit']) && !empty($get_post['edit'])) {
            $backendPostManager = new OC\Blog_php\Model\BackendPostManager();
            $edit = $backendPostManager->editPost(
                                                    $get_post['edit-title'],
                                                    $get_post['edit-content'],
                                                    $get_get['id']);
            if ($edit == false) {
                $get_session['error'] = "Une erreur est survenue. Impossible de mofifier l'article !";
                header('Location: index.php?action=dashboardAdmin');
            } else {
                $get_session['success'] = "Votre article est modifié !";
                header('Location: index.php?action=dashboardAdmin');
            }
        } else {
            $get_session['error'] = "Aucun identifiant de billet envoyé !";
            header('Location: index.php?action=editPost');
        }
    }

    function deletePost()
    {
        $key = new SuperGlobals();
        $get_session = $key->get_SESSION();

        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        if (isset($get_post['delete']) && !empty($get_post['delete'])) {
            $backendPostManager = new OC\Blog_php\Model\BackendPostManager();
            $delete = $backendPostManager->deletePost($get_post['id']);
            if ($delete === false) {
                $get_session['error'] = "Une erreur est survenue. Impossible de supprimer l'article!";
                header('Location: index.php?action=dashboardAdmin');
            } else {
                $get_session['success'] = "Votre article est supprimé.";
                header('Location: index.php?action=dashboardAdmin');
            }
        }
            require_once './view/backend/backendListPostsView.php';
    }

    function displayAllComments()
    {
        $backendCommentManager = new OC\Blog_php\Model\BackendCommentManager();
        $all_comments = $backendCommentManager->getAllComments();
        require_once './view/backend/backendCommentsView.php';
    }

    function validateComment()
    {
            $key = new SuperGlobals();
            $get_session = $key->get_SESSION();

            $post = new SuperGlobals();
            $get_post = $post->get_POST();

            if (isset($get_post['validate']) && !empty($get_post['validate'])) {
            $backendCommentManager = new OC\Blog_php\Model\BackendCommentManager();
            $valid_comment = $backendCommentManager->approveComment($get_post['commentId']);
            if ($valid_comment === false) {
                $get_session['error'] = "Une erreur est survenue. Impossible de valider le commentaire!";
                header('Location: index.php?action=displayComments');
            } else {
                $get_session['success'] = "Le commentaire est validé et publié.";
                header('Location: index.php?action=displayComments');
            }
        }
            require_once './view/backend/backendCommentsView.php';

    }

    function notValidateComment()
    {
        $key = new SuperGlobals();
        $get_session = $key->get_SESSION();

        $post = new SuperGlobals();
        $get_post = $post->get_POST();

        if (isset($get_post['not_validate']) && !empty($get_post['not_validate'])) {
            $backendCommentManager = new OC\Blog_php\Model\BackendCommentManager();
            $not_valid_comment = $backendCommentManager->notApproveComment($get_post['commentId']);

            if ($not_valid_comment === false) {
                $get_session['error'] = "Une erreur est survenue. Impossible de supprimer le commentaire!";
                header('Location: index.php?action=displayComments');
            } else {
                $get_session['success'] = "Le commentaire est supprimé.";
                header('Location: index.php?action=displayComments');
            }
        }
            require_once './view/backend/backendCommentsView.php';
    }

}

