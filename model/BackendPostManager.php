<?php

namespace OC\Blog_php\Model;

use Olha\Blog\Model\Manager;

require_once 'model/Manager.php';

class BackendPostManager extends Manager
{

    public function addNewPost($title, $fragment, $content, $id_user)
    {
        $db = $this->dbConnect();
        $new_post = $db->prepare('
                                INSERT INTO posts (title, fragment, content, author_post, creation_date) 
                                VALUES(?, ?, ?, ?, NOW())');
        $added_post = $new_post->execute(array($title, $fragment, $content, $id_user));
        return $added_post;
    }

    public function getAllPosts()
    {
        $db = $this->dbConnect();
        $allPosts = $db->query('
                    SELECT id, title,  DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr
                    FROM posts
                    ORDER BY creation_date
                    DESC
        ');
        return $allPosts;
    }

    public function deletePost($id)
    {
        $db = $this->dbConnect();
        $deleted_post = $db->prepare('
                    DELETE FROM posts
                    WHERE id=?
        ');
        $del_post = $deleted_post->execute(array($id));
        return $del_post;
    }

    public function editPost($title, $content, $id)
    {
        $db = $this->dbConnect();
        $edit_post = $db->prepare('
                    UPDATE posts SET title = ?, content = ?
                    WHERE id = ? 
        ');
        $edit_post->execute(array($title, $content, $id));
    }
}
