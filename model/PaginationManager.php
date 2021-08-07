<?php

namespace OC\Blog\Model;

use OC\Blog\Model\ManagerPDO;

require_once 'model/ManagerPDO.php';

class PaginationManager extends ManagerPDO
{

    public  function count_posts()
    {
        $db = $this->dbConnect();
        $total_nb_posts = $db->query('SELECT COUNT(*) AS nb_posts FROM posts');
        $total_posts = $total_nb_posts->fetch();
        return $nb_posts = $total_posts['nb_posts'];
    }

    public function getPosts($firstPostToDisplay, $nb_posts_per_page)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("
                        SELECT id, title, fragment, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr 
                        FROM posts
                        ORDER BY creation_date 
                        DESC
                        LIMIT ?, ?
                        ");
        $req->execute(array((int)$firstPostToDisplay,(int)$nb_posts_per_page));
        return $req;
    }
}