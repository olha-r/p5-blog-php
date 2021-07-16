<?php

namespace OC\Blog_php\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('
                    SELECT *, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr
                    FROM posts
                    ORDER BY creation_date
                    DESC LIMIT 0, 5
                    
        ');
        return $req;


    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('
                    SELECT *, posts.id AS postId, DATE_FORMAT(posts.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr
                    FROM posts
                    LEFT JOIN users on users.id = posts.author_post
                    WHERE posts.id = ?
        ');

        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    public function count ()
    {
        $db = $this->dbConnect();
        $total_nb_posts  = $db->query('SELECT COUNT(*) AS nb_posts FROM posts');
        $total_posts = $total_nb_posts->fetch();
        $nb_posts = $total_posts['nb_posts'];
    }

}