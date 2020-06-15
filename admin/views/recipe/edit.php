    <?php ?>
    <h2><?= $pageTitle ?></h2>

    <form action="index.php?controller=recipes&action=edit" method="post"  enctype="multipart/form-data">
        <input name="id" value="<?= $recipe['id'] ?>" type="hidden">
        <div class="form-group row">
            <label class="col-sm-2" for="name">Nom</label>
            <input class="col-sm-10" type="input" class="form-control" id="name" name="name" value="<?= $recipe['name'] ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="description">Description</label>
            <input class="col-sm-10" type="input" class="form-control" id="description" name="description" value="<?= $recipe['description'] ?>">
        </div>
        <button type="submit" class="btn btn-secondary btn-lg"><span class="fa fa-save"></span>
            Enregistrer
        </button>
        <a class="btn btn-info btn-lg" href="index.php?controller=recipes&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
    </form>
