<?php

require_once 'model/BackendPostManager.php';
require_once 'model/PostManager.php';
require_once 'model/BackendCommentManager.php';

class BackendController
{
<<<<<<< HEAD

=======
>>>>>>> main
    function addPost()
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            if (isset($_POST['submit'])) {
                if (isset($_POST['title']) && isset($_POST['fragment']) && isset($_POST['content'])
                    && !empty($_POST['title']) && !empty($_POST['fragment']) && !empty($_POST['content'])) {
                    $backendPostManager = new OC\Blog_php\Model\BackendPostManager();
                    $added_post = $backendPostManager->addNewPost($_POST['title'], $_POST['fragment'], $_POST['content'], $_SESSION['admin']['id']);

                    if ($added_post === false) {
                        $_SESSION['error'] = "Une erreur est survenue. Impossible d'enregistrer l'article.!";
                        header('Location: index.php?action=createPost');
                    } else {
                        $_SESSION['success'] = "Votre article est ajouté.";
                        header('Location: index.php?action=dashboardAdmin');
                    }
                } else {
                    require_once './view/backend/createPostView.php';
                }
            } else {
                require_once './view/backend/createPostView.php';
            }
        } else {
            require_once './view/backend/createPostView.php';
        }

    }

    function displayAllPosts()
    {
        if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
            $backendPostManager = new OC\Blog_php\Model\BackendPostManager();
            $allPosts = $backendPostManager->getAllPosts();
<<<<<<< HEAD
            require_once 'view/backend/backendListPostView.php';
=======
            require_once 'view/backend/backendListPostsView.php';
>>>>>>> main
        } else {
            $_SESSION['error'] = "Vous n'avez pas le droit !";
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

        if (isset($_POST['edit']) && !empty($_POST['edit'])) {
            $backendPostManager = new OC\Blog_php\Model\BackendPostManager();
            $edit = $backendPostManager->editPost($_POST['edit-title'], $_POST['edit-content'], $_GET['id']);
            if ($edit === false) {
                $_SESSION['error'] = "Une erreur est survenue. Impossible de mofifier l'article !";
                header('Location: index.php?action=dashboardAdmin');
            } else {
                $_SESSION['success'] = "Votre article est modifié !";
                header('Location: index.php?action=dashboardAdmin');
            }

        } else {
            $_SESSION['error'] = "Aucun identifiant de billet envoyé !";
            header('Location: index.php?action=editPost');
        }
    }

    function deletePost()
    {
        if (isset($_POST['delete']) && !empty($_POST['delete'])) {
            $backendPostManager = new OC\Blog_php\Model\BackendPostManager();
            $delete = $backendPostManager->deletePost($_POST['id']);
            if ($delete === false) {
                $_SESSION['error'] = "Une erreur est survenue. Impossible de supprimer l'article!";
                header('Location: index.php?action=dashboardAdmin');
            } else {
                $_SESSION['success'] = "Votre article est supprimé.";
                header('Location: index.php?action=dashboardAdmin');
            }
        } else {
            require_once './view/backend/backendListPostsView.php';
        }
    }

    function displayAllComments()
    {
        $backendCommentManager = new OC\Blog_php\Model\BackendCommentManager();
        $all_comments = $backendCommentManager->getAllComments();

        require_once './view/backend/backendCommentsView.php';
    }

    function validateComment()
    {
        if (isset($_POST['validate']) && !empty($_POST['validate'])) {
            $backendCommentManager = new OC\Blog_php\Model\BackendCommentManager();
            $valid_comment = $backendCommentManager->approveComment($_POST['commentId']);
            if ($valid_comment === false) {
                $_SESSION['error'] = "Une erreur est survenue. Impossible de valider le commentaire!";
                header('Location: index.php?action=displayComments');
            } else {
                $_SESSION['success'] = "Le commentaire est validé et publié.";
                header('Location: index.php?action=displayComments');
            }
        } else {
            require_once './view/backend/backendCommentsView.php';
        }
<<<<<<< HEAD

    }

    function notValidateComment()
    {
        if (isset($_POST['not_validate']) && !empty($_POST['not_validate'])) {
            $backendCommentManager = new OC\Blog_php\Model\BackendCommentManager();
            $not_valid_comment = $backendCommentManager->notApproveComment($_POST['commentId']);

            if ($not_valid_comment === false) {
                $_SESSION['error'] = "Une erreur est survenue. Impossible de supprimer le commentaire!";
                header('Location: index.php?action=displayComments');
            } else {
                $_SESSION['success'] = "Le commentaire est supprimé.";
                header('Location: index.php?action=displayComments');
            }
        } else {
            require_once './view/backend/backendCommentsView.php';
        }
    }

}
=======

    }

    function notValidateComment()
    {
        if (isset($_POST['not_validate']) && !empty($_POST['not_validate'])) {
            $backendCommentManager = new OC\Blog_php\Model\BackendCommentManager();
            $not_valid_comment = $backendCommentManager->notApproveComment($_POST['commentId']);

            if ($not_valid_comment === false) {
                $_SESSION['error'] = "Une erreur est survenue. Impossible de supprimer le commentaire!";
                header('Location: index.php?action=displayComments');
            } else {
                $_SESSION['success'] = "Le commentaire est supprimé.";
                header('Location: index.php?action=displayComments');
            }
        } else {
            require_once './view/backend/backendCommentsView.php';
        }
    }

}
>>>>>>> main
