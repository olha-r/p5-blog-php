<?php

namespace OC\Blog\Model;

use OC\Blog\Model\ManagerPDO;

require_once 'model/ManagerPDO.php';

class CommentManager extends ManagerPDO
{

    public function getComments($postId)
    {
        $db_connect = $this->dbConnect();
        $comments = $db_connect->prepare('
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
        $db_connect = $this->dbConnect();
        $comments = $db_connect->prepare('
                                INSERT INTO comments(post_id, author_comment, comment, comment_date, is_approved ) 
                                VALUES(?, ?, ?, NOW(), 0)');
        $comments->execute(array($postId, $id_user, $comment));

    }

    public function getUserComments($idUser)
    {
        $db_connect = $this->dbConnect();
        $user_comments = $db_connect->prepare('
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
        $db_connect = $this->dbConnect();
        $deleted_comment = $db_connect->prepare('
                                            DELETE FROM comments
                                            WHERE id_comment=?
                                            ');
        $deleted_comment = $deleted_comment->execute(array($commentUserId));
        return $deleted_comment;
    }
}
