<?php

namespace Olha\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('
                            SELECT *, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr
                            FROM comments
                            LEFT JOIN users on users.id = comments.author_comment
                            WHERE post_id = ? 
                            ORDER BY comment_date 
                            DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $id_user, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('
                                INSERT INTO comments(post_id, author_comment, comment, comment_date, approval ) 
                                VALUES(?, ?, ?, NOW(), 0)');
        $comments->execute(array($postId, $id_user, $comment));

    }
}
