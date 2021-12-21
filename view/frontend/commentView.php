<?php $title = "Mon blog";

ob_start(); ?>

<h2>Commentaire</h2>

<form action="index.php?action=updateComment&id=<?= $comment['id']; ?>" method="POST">
    <div>
        <label><strong><?= $comment['author']; ?></strong> le <?= $comment['comment_date_fr'] ?></label>
        <input type="hidden" name="post_id" value="<?= $comment['post_id']; ?>">
    </div>
    <div>
        <label for="comment">Commentaire</label>
        <textarea name="comment" id="comment" cols="30" rows="10"><?= $comment['comment']; ?></textarea>
    </div>
    <div>
        <input type="submit" value="Editer">
    </div>
</form>
<a href="index.php?action=post&id=<?= $comment['post_id']; ?>">Retour</a>

<?php $content = ob_get_clean();

require('template.php'); ?>