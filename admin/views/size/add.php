    <?php ?>
    <h2><?= $pageTitle ?></h2>
    <form action="index.php?controller=sizes&action=add" method="post"  enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-2" for="name">Nom</label>
            <input class="col-sm-10" type="input" class="form-control" id="name" name="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="description">Description</label>
            <input class="col-sm-10" type="input" class="form-control" id="description" name="description" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['description'] : '' ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="code">Code</label>
            <input class="col-sm-10" type="input" class="form-control" id="code" name="code" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['code'] : '' ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="diameter">Diamètre</label>
            <input class="col-sm-10" type="input" class="form-control" id="diameter" name="diameter" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['diameter'] : '' ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="length">Taille</label>
            <input class="col-sm-10" type="input" class="form-control" id="length" name="length" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['length'] : '' ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="average_weight">Poids moyen (g)</label>
            <input class="col-sm-10" type="input" class="form-control" id="average_weight" name="average_weight" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['average_weight'] : '' ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="average_number_per_kg">Nombre moyen /kg</label>
            <input class="col-sm-10" type="input" class="form-control" id="average_number_per_kg" name="average_number_per_kg" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['average_number_per_kg'] : '' ?>">
        </div>
        <button type="submit" class="btn btn-primary btn-lg"><span class="fa fa-save"></span>
            Ajouter
        </button>
        <a class="btn btn-info btn-lg" href="index.php?controller=sizes&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
    </form>
