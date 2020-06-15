<?php ?>
    <h2><?= $pageTitle ?></h2>
    <?php var_dump($category);?>
    <form action="index.php?controller=categories&action=edit" method="post"  enctype="multipart/form-data">
        <input name="id" value="<?= $category['id'] ?>" type="hidden">
        <button type="submit" class="btn btn-secondary btn-lg"><span class="fa fa-save"></span>
            Enregistrer
        </button>
        <a class="btn btn-info btn-lg" href="index.php?controller=categories&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
    </form>
