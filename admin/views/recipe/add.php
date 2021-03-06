    <?php ?>
    <h2><?= $pageTitle ?></h2>
    <form action="index.php?controller=recipes&action=add" method="post"  enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-2" for="name">Nom</label>
            <input class="col-sm-10" type="input" class="form-control" id="name" name="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="description">Description</label>
            <input class="col-sm-10" type="input" class="form-control" id="description" name="description" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['description'] : '' ?>">
        </div>

        <button type="submit" class="btn btn-primary btn-lg"><span class="fa fa-save"></span>
            Ajouter
        </button>
        <a class="btn btn-info btn-lg" href="index.php?controller=recipes&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
    </form>
