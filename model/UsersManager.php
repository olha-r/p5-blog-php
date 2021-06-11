<?php

namespace Olha\Blog\Model;

require_once("model/Manager.php");

class UsersManager extends Manager
{
    public function checkIfUserExist($pseudo)
    {
        $db = $this->dbConnect();
        $users_data = $db->prepare('
                            SELECT *
                            FROM users 
                            WHERE login_name = ? ');
        $users_data->execute(array($pseudo));
        return $users_data->fetch();
    }


    public function insertNewUser($new_login_name, $new_password, $new_email)
    {
        $db = $this->dbConnect();
        $insertNewUser = $db->prepare('
                                INSERT INTO users (login_name, password, email, creation_date)
                                VALUES(?, ?, ?, NOW())');
        return $insertNewUser->execute(
            array($new_login_name,$new_password, $new_email)
        );

    }
}
