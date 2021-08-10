<?php

namespace OC\Blog\Model;

use OC\Blog\Model\ManagerPDO;

require_once 'model/ManagerPDO.php';

class BackendCommentManager extends ManagerPDO
{

    public function getAllComments()
    {
        $db_connect = $this->dbConnect();
        $all_comments = $db_connect->query('
                            SELECT *, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr
                            FROM comments
                            LEFT JOIN users on users.id = comments.author_comment
                            WHERE is_approved=0
                            ORDER BY comment_date 
                            DESC
                            ');
        return $all_comments;
    }

    public function notApproveComment($commentId)
    {
        $db_connect = $this->dbConnect();
        $not_approved_comment = $db_connect->prepare('
                                            DELETE FROM comments
                                            WHERE id_comment=?
                                            ');
        $not_approved_comment = $not_approved_comment->execute(array($commentId));
        return $not_approved_comment;
    }

    public function approveComment($commentId)
    {
        $db_connect = $this->dbConnect();
        $approved_comment = $db_connect->prepare('
                                        UPDATE comments SET is_approved=1
                                        WHERE id_comment=?
                                        ');
        $approved_comment = $approved_comment->execute(array($commentId));
        return $approved_comment;
    }
}
