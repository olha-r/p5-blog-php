<?php
require('controller/frontend.php');

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] === 'listPosts') {
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
                    throw new Exception('Tous les champs ne sont pas remplis !');
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


    }
    else {
        contactMail();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}



/*
        elseif ($_GET['action'] === 'signUp') {
            if (isset($_POST['new_login_name']) && !empty($_POST['new_login_name'])
                && isset($_POST['new_password_1']) && !empty($_POST['new_password_1'])
                && isset($_POST['new_password_2']) && !empty($_POST['new_password_2'])
                && isset($_POST['new_email']) && !empty($_POST['new_email'])
            ) {
                addNewUser(
                    strip_tags($_POST['new_login_name']),
                    strip_tags($_POST['new_password_1']),
                    strip_tags($_POST['new_password_2']),
                    strip_tags($_POST['new_email'])
                );
            } else {
                throw new Exception("Il manque des données nécessaires pour la création d'un compte.");
            }
        }
*/

        /*
        elseif ($_GET['action'] === 'signIn') {
                if (isset($_POST['login_name']) && isset($_POST['password'])
                    && !empty($_POST['login_name']) && !empty($_POST['password'])
                ) {
                    login(
                        strip_tags($_POST['login_name']),
                        strip_tags($_POST['password'])
                    );
                } else {
                    throw new Exception('Il manque des données nécessaires à la connexion.');
                }
        }*/
