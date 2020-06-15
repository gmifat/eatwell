<?php ?>
<h2><?= $pageTitle ?></h2>
<form action="index.php?controller=categories&action=add" method="post"  enctype="multipart/form-data">
    <button type="submit" class="btn btn-primary btn-lg"><span class="fa fa-save"></span>
        Ajouter
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=categories&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
