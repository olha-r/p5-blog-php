<?php

namespace OC\Blog_php\Model;

require_once("model/Manager.php");

class UsersManager extends Manager
{
    public function checkIfUserExist($pseudo)
    {
        $db = $this->dbConnect();
        $users_data = $db->prepare('
                            SELECT *
                            FROM users 
                            WHERE user_name = ? ');
        $users_data->execute(array($pseudo));
        return $users_data->fetch();
    }


    public function insertNewUser($new_user_name, $new_password, $new_email, $role)
    {
        $db = $this->dbConnect();
        $insertNewUser = $db->prepare('
                                INSERT INTO users (user_name, password, email, role, creation_date)
                                VALUES(?, ?, ?, ?,  NOW()) ');
        return $insertNewUser->execute(
            array($new_user_name,$new_password, $new_email, $role)
        );

    }


public function signIn()
{
    $db = $this->dbConnect();

//  Récupération de l'utilisateur et de son password hashé
    $req = $db->prepare('
                            SELECT id, password, role
                            FROM users 
                            WHERE user_name = ?');
    $req->execute(array($_POST['user_name']));
    return $resultat = $req->fetch();
}

}