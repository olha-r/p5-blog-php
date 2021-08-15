<?php

namespace OC\Blog\Model;

use OC\Blog\Model\ManagerPDO;

require_once 'model/ManagerPDO.php';

class UsersManager extends ManagerPDO
{

    public function checkIfUserExist($pseudo)
    {
        $db_connect = $this->dbConnect();
        $users_data = $db_connect->prepare('
                            SELECT *
                            FROM users 
                            WHERE user_name = ? ');
        $users_data->execute(array($pseudo));
        return $users_data->fetch();
    }

    public function insertNewUser($new_user_name, $new_password, $new_email, $role)
    {
        $db_connect = $this->dbConnect();
        $insertNewUser = $db_connect->prepare('
                                INSERT INTO users (user_name, password, email, role, creation_date)
                                VALUES(?, ?, ?, ?,  NOW()) ');
        $insertNewUser->execute(
            array($new_user_name, $new_password, $new_email, $role)
        );
        return $db_connect->lastInsertId();

    }

    public function signIn()
    {
        $db_connect = $this->dbConnect();
        $req = $db_connect->prepare('
                            SELECT id, email, password, role
                            FROM users 
                            WHERE user_name = ?');
        $req->execute(array($_POST['user_name']));
        return $req->fetch();
    }

    public function getUser()
    {
        $db_connect = $this->dbConnect();
        $req = $db_connect->prepare('
                            SELECT user_name, email, password
                            FROM users 
                            WHERE id = ?');
        $req->execute(array($_SESSION['member']['id']));
        return $req->fetch();
    }

    public function updateUser($user_name, $email, $user_id)
    {
        $db_connect = $this->dbConnect();
        $edit_user_info = $db_connect->prepare('
                    UPDATE users SET user_name = ?, email = ?
                    WHERE id = ? 
        ');
        $edit_user_info->execute(array($user_name, $email, $user_id));
    }

    public function updatePassword($password, $user_id)
    {
        $db_connect = $this->dbConnect();
        $edit_password = $db_connect->prepare('
                    UPDATE users SET password = ?
                    WHERE id = ? 
        ');
        $edit_password->execute(array($password, $user_id));
    }

    public function deleteUser($user_id)
    {
        $db_connect = $this->dbConnect();
        $deleted_user = $db_connect->prepare('
                                            DELETE FROM users
                                            WHERE users.id=?
                                            ');
        return $deleted_user->execute(array($user_id));
    }
}
