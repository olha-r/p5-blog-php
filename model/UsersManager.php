<?php

namespace Olha\Blog\Model;

require_once("model/Manager.php");

class UsersManager extends Manager
{
    public function insertNewUser()
    {
        $db = $this->dbConnect();
        $newUser = $db->prepare('
                                INSERT INTO users (pseudo, password, email, creation_date)
                                VALUES(?, ?, ?, NOW())');
        $newUser->execute(array($_POST['pseudo'],
            $_POST['password'],
            $_POST['email']));

    }


    }
}

