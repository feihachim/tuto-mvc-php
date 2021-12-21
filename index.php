<?php

require('./controller/frontend.php');

$action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
try {
    switch ($action) {
        case 'listPosts':
            listPosts();
            break;
        case 'post':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post();
            } else {
                throw new Exception('Erreur : aucun indetifiant de billet envoyé');
            }
            break;
        case 'addComment':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception("Erreur : tous les champs ne sont pas remplis !");
                }
            } else {
                throw new Exception("Erreur : aucun identifiant de billet envoyé");
            }
            break;
        case 'comment':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                comment();
            } else {
                throw new Exception("Erreur : aucun identifiant de commentaire envoyé");
            }
            break;
        case 'updateComment':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['comment'])) {
                    updateComment($_GET['id'], $_POST['post_id'], $_POST['comment']);
                } else {
                    throw new Exception("Erreur : tous les champs ne sont pas remplis !");
                }
            } else {
                throw new Exception("Erreur : aucun identifiant de commentire envoyé");
            }
            break;
        default:
            listPosts();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    $errorCode = $e->getCode();
    require('view/errorView.php');
}
