<?php

namespace OC\Blog\Model;

class ManagerPDO
{

    protected function dbConnect()
    {
        $db_connect = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
        $db_connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $db_connect;
    }
}
