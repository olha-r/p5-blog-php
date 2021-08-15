<?php

namespace OC\Blog\Model;

use OC\Blog\Model\ManagerPDO;

require_once 'model/ManagerPDO.php';

class PostManager extends ManagerPDO
{

    public function getPosts()
    {
        $db_connect = $this->dbConnect();

        $req = $db_connect->query('
                    SELECT *, 
                           DATE_FORMAT(modify_date, \'%d/%m/%Y à %Hh%imin%ss\') AS modify_date_fr
                    FROM posts
                    ORDER BY creation_date
                    DESC LIMIT 0, 5
                    
        ');
        return $req;

    }


    public function getPost($postId)
    {
        $db_connect = $this->dbConnect();
        $req = $db_connect->prepare('
                    SELECT *, 
                           posts.id AS postId,  
                           DATE_FORMAT(posts.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr,
                           DATE_FORMAT(modify_date, \'%d/%m/%Y à %Hh%imin%ss\') AS modify_date_fr
                    FROM posts
                    LEFT JOIN users on users.id = posts.author_post
                    WHERE posts.id = ?
        ');

        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
}
