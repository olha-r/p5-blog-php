<?php

namespace OC\Blog\Model;

use OC\Blog\Model\ManagerPDO;

require_once 'model/ManagerPDO.php';

class BackendPostManager extends ManagerPDO
{

    public function addNewPost($title, $fragment, $content, $id_user)
    {
        $db_connect = $this->dbConnect();
        $new_post = $db_connect->prepare('
                                INSERT INTO posts (title, fragment, content, author_post, creation_date) 
                                VALUES(?, ?, ?, ?, NOW())');
        $added_post = $new_post->execute(array($title, $fragment, $content, $id_user));
        return $added_post;
    }

    public function getAllPosts()
    {
        $db_connect = $this->dbConnect();
        $allPosts = $db_connect->query('
                    SELECT id, title,  DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr
                    FROM posts
                    ORDER BY creation_date
                    DESC
        ');
        return $allPosts;
    }

    public function deletePost($id_post)
    {
        $db_connect = $this->dbConnect();
        $deleted_post = $db_connect->prepare('
                    DELETE FROM posts
                    WHERE id=?
        ');
        $del_post = $deleted_post->execute(array($id_post));
        return $del_post;
    }

    public function editPost($title, $content, $id_post)
    {
        $db_connect = $this->dbConnect();
        $edit_post = $db_connect->prepare('
                    UPDATE posts SET title = ?, content = ?
                    WHERE id = ? 
        ');
        $edit_post->execute(array($title, $content, $id_post));
    }
}
