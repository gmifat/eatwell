    <?php ?>
    <h2><?= $pageTitle ?></h2>
    <form action="index.php?controller=units&action=add" method="post"  enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-2" for="name">Nom de l'unité</label>
            <input class="col-sm-10" type="input" class="form-control" id="name" name="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="symbol">Symbole</label>
            <input class="col-sm-10" type="input" class="form-control" id="symbol" name="symbol" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['symbol'] : '' ?>">
        </div>
        <button type="submit" class="btn btn-primary btn-lg"><span class="fa fa-save"></span>
            Ajouter
        </button>
        <a class="btn btn-info btn-lg" href="index.php?controller=units&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
    </form>
