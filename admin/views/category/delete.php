<?php ?>
<h2><?= $pageTitle ?></h2>
<?php var_dump($category);?>
<form action="index.php?controller=categories&action=delete" method="post"  enctype="multipart/form-data">
    <div class="form-group row">
        <input name="id" value="<?= $category['id'] ?>" type="hidden">
    </div>
    <button type="submit" class="btn btn-danger btn-lg"><span class="fa fa-trash-alt"></span>
        Supprimer
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=categories&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
