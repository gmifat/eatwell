    <h2><?= $pageTitle ?></h2>
    <form action="index.php?controller=promotions&action=add" method="post"  enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-2" for="name">Code</label>
            <input class="col-sm-10" type="input" class="form-control" id="name" name="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="description">Description</label>
            <input class="col-sm-10" type="input" class="form-control" id="description" name="description" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['description'] : '' ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-2" for="position">Type</label>
            <select class="col-sm-10"  id="discount_type_id" name="discount_type_id" class="form-control">
                <?php foreach($discount_types as $discount_type): ?>
                    <option <?=  isset($_SESSION['old_inputs']) && $discount_type['id'] == $_SESSION['old_inputs']['discount_type_id'] ? 'selected' : '' ?> value="<?= $discount_type['id']; ?>">
                        <?= $discount_type['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input class="col-sm-10" type="input" class="form-control" id="position" name="position" >
        </div>
        <div class="input-group mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="image" name="image" value="<?= isset($_FILES['image']) ? $_FILES['image'] : '' ?>">
                <label class="custom-file-label" for="image">Choisir une image...</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-lg"><span class="fa fa-save"></span>
            Ajouter
        </button>
        <a class="btn btn-info btn-lg" href="index.php?controller=promotions&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
    </form>
