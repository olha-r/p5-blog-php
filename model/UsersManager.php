<?php

namespace OC\Blog_php\Model;

use Olha\Blog\Model\Manager;

require_once 'model/Manager.php';

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
            array($new_user_name, $new_password, $new_email, $role)
        );

    }

    public function signIn()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
                            SELECT id, email, password, role
                            FROM users 
                            WHERE user_name = ?');
        $req->execute(array($_POST['user_name']));
        return $resultat = $req->fetch();
    }

    public function getUser()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
                            SELECT user_name, email, password
                            FROM users 
                            WHERE id = ?');
        $req->execute(array($_SESSION['member']['id']));
        $resultat = $req->fetch();
        return $resultat;
    }

    public function update_user($user_name, $email, $id)
    {
        $db = $this->dbConnect();
        $edit_user_info = $db->prepare('
                    UPDATE users SET user_name = ?, email = ?
                    WHERE id = ? 
        ');
        $edit_user_info->execute(array($user_name, $email, $id));
    }

    public function update_password($password, $id)
    {
        $db = $this->dbConnect();
        $edit_password = $db->prepare('
                    UPDATE users SET password = ?
                    WHERE id = ? 
        ');
        $edit_password->execute(array($password, $id));
    }

    public function delete_user($user_id)
    {
        $db = $this->dbConnect();
        $deleted_user = $db->prepare('
                                            DELETE FROM users
                                            WHERE users.id=?
                                            ');
        $deleted_user = $deleted_user->execute(array($user_id));
        return $deleted_user;
    }
}