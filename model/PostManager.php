<?php

namespace OpenClassrooms\Blog\Model;

require_once('model/Manager.php');

class PostManager extends Manager
{

    public function getPosts()
    {

        $pdo = $this->dbConnect();
        $req = $pdo->prepare("SELECT id,title,content,DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0,5");
        $req->execute();
        $posts = $req->fetchAll();

        return $posts;
    }

    public function getPost($postId)
    {
        $pdo = $this->dbConnect();
        $req = $pdo->prepare("SELECT id,title,content,DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr FROM posts WHERE id=:id");
        $req->bindParam(':id', $postId, \PDO::PARAM_INT);
        $req->execute();
        $post = $req->fetch();

        return $post;
    }
}
