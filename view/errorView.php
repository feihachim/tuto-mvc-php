<?php $title = "Mon blog"; ?>

<?php ob_start(); ?>

<h1><?= "Erreur " . $errorCode; ?></h1>
<p><?= $errorMessage; ?></p>
<?php $content = ob_get_clean(); ?>
<?php require('view/frontend/template.php'); ?>