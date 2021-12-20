<?php

require('./controller/controller.php');

$action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);

switch ($action) {
    case 'listPosts':
        listPosts();
        break;
    case 'post':
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post();
        } else {
            echo 'Erreur : aucun indetifiant de billet envoyé';
        }
        break;
    default:
        listPosts();
}
