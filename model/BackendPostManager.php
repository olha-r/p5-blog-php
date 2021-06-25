<?php

namespace Olha\Blog\Model;

require_once("model/Manager.php");

class BackendPostManager extends Manager
{
    public function addNewPost($title, $content, $id_user)
    {
        $db = $this->dbConnect();
        $new_post = $db->prepare('
                                INSERT INTO posts (title, content, author_post, creation_date) 
                                VALUES(?, ?, ?, NOW())');
        $added_post = $new_post->execute(array($title, $content, $id_user));
        return $added_post;
    }

    public function getAllPosts()
    {
        $db = $this->dbConnect();
        $allPosts = $db->query('
                    SELECT title, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr
                    FROM posts
                    ORDER BY creation_date                   
        ');
        return $allPosts;
    }




}