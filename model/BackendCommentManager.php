<?php

namespace Olha\Blog\Model;

require_once("model/Manager.php");

class BackendCommentManager extends Manager
{
    public function getAllComments()
    {
        $db = $this->dbConnect();
        $all_comments = $db->query('
                            SELECT *, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr
                            FROM comments
                            ORDER BY comment_date 
                            DESC');

        return $all_comments;
    }

}