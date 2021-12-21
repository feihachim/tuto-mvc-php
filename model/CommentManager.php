<?php

namespace OpenClassrooms\Blog\Model;

require_once('model/Manager.php');

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $pdo = $this->dbConnect();
        $req = $pdo->prepare("SELECT id,author,comment,DATE_FORMAT(comment_date,'%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr FROM comments WHERE post_id=:id ORDER BY comment_date DESC");
        $req->bindParam(':id', $postId, \PDO::PARAM_INT);
        $req->execute();
        $comments = $req->fetchAll();

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare("INSERT INTO comments (post_id,author,comment,comment_date) VALUES(?,?,?,NOW())");
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    public function getComment($commentId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT id,post_id,author,comment,DATE_FORMAT(comment_date,'%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr FROM comments WHERE id=?");
        $req->bindValue(1, $commentId, \PDO::PARAM_INT);
        $req->execute();
        $comment = $req->fetch();

        return $comment;
    }

    public function putComment($commentId, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare("UPDATE comments SET comment=?,comment_date=NOW() WHERE id=?");
        $affectedLines = $comments->execute(array($comment,  $commentId));

        return $affectedLines;
    }
}
