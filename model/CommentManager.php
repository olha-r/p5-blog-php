<?php

namespace OC\Blog_php\Model;

use Olha\Blog\Model\Manager;

require_once 'model/Manager.php';

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('
                            SELECT *, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr
                            FROM comments
                            LEFT JOIN users on users.id = comments.author_comment
                            WHERE post_id = ? AND is_approved = 1
                            ORDER BY comment_date 
                            DESC');
        $comments->execute(array($postId));
        return $comments;
    }

    public function postComment($postId, $id_user, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('
                                INSERT INTO comments(post_id, author_comment, comment, comment_date, is_approved ) 
                                VALUES(?, ?, ?, NOW(), 0)');
        $comments->execute(array($postId, $id_user, $comment));

    }

    public function getUserComments($idUser)
    {
        $db = $this->dbConnect();
        $user_comments = $db->prepare('
                            SELECT *, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr
                            FROM comments
                            LEFT JOIN users on users.id = comments.author_comment
                            WHERE users.id = ?
                            ORDER BY comment_date 
                            DESC');
        $user_comments->execute(array($idUser));
        return $user_comments;

    }

    public function deleteUserComment($commentUserId)
    {
        $db = $this->dbConnect();
        $deleted_comment = $db->prepare('
                                            DELETE FROM comments
                                            WHERE id_comment=?
                                            ');
        $deleted_comment = $deleted_comment->execute(array($commentUserId));
        return $deleted_comment;
    }
}