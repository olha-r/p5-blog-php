<?php

namespace Olha\Blog\Model;

require_once("model/Manager.php");

class LoginManager extends Manager
{
    public function signIn()
    {
        $db = $this->dbConnect();

//  Récupération de l'utilisateur et de son password hashé
        $req = $db->prepare('
                            SELECT id, password
                            FROM users 
                            WHERE user_name = ?');
        $req->execute(array($_POST['user_name']));
        return $resultat = $req->fetch();
}
}