<?php

function dbConnect()
{
    $dbHost = "localhost";
    $dbName = "test";
    $dbUser = "root";
    $dbPassword = "";
    $dbCharset = 'utf8';
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=$dbCharset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $pdo = new PDO($dsn, $dbUser, $dbPassword, $options);
        return $pdo;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

function getPosts()
{

    $pdo = dbConnect();
    $req = $pdo->prepare("SELECT id,title,content,DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0,5");
    $req->execute();
    $datas = $req->fetchAll();

    return $datas;
}

function getPost($postId)
{
    $pdo = dbConnect();
    $req = $pdo->prepare("SELECT id,title,content,DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS creation_date_fr FROM posts WHERE id=:id");
    $req->bindParam(':id', $postId, PDO::PARAM_INT);
    $req->execute();
    $post = $req->fetch();

    return $post;
}

function getComments($postId)
{
    $pdo = dbConnect();
    $req = $pdo->prepare("SELECT id,author,comment,DATE_FORMAT(comment_date,'%d/%m/%Y à %Hh%imin%ss') AS comment_date_fr FROM comments WHERE post_id=:id ORDER BY comment_date DESC");
    $req->bindParam(':id', $postId, PDO::PARAM_INT);
    $req->execute();
    $comments = $req->fetchAll();

    return $comments;
}
