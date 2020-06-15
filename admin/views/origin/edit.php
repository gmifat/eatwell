    <?php ?>
    <h2><?= $pageTitle ?></h2>

    <form action="index.php?controller=origins&action=edit" method="post"  enctype="multipart/form-data">
        <input name="id" value="<?= $origin['id'] ?>" type="hidden">
        <div class="form-group row">
            <label class="col-sm-2" for="name">Nom</label>
            <input class="col-sm-10" type="input" class="form-control" id="name" name="name" value="<?= $origin['name'] ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="description">Description</label>
            <input class="col-sm-10" type="input" class="form-control" id="description" name="description" value="<?= $origin['description'] ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="position">Position</label>
            <input class="col-sm-10" type="input" class="form-control" id="position" name="position" value="<?= $origin['position'] ?>">
        </div>
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="image" id="image" value="<?= isset($_FILES['image']) ? $_FILES['image'] : '' ?>">
                <label class="custom-file-label" for="image" >Choisir une image...</label>
            </div>
        </div><br>
        <img src="<?= !empty($origin['image']) ? '../assets/images/origin/'.$origin['image'] :  '../assets/images/no_image.PNG' ?>"/><br>
        <button type="submit" class="btn btn-secondary btn-lg"><span class="fa fa-save"></span>
            Enregistrer
        </button>
        <a class="btn btn-info btn-lg" href="index.php?controller=origins&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
    </form>
