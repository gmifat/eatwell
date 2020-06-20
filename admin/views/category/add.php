<?php ?>
<h2><?= $pageTitle ?></h2>
<form action="index.php?controller=categories&action=add" method="post"  enctype="multipart/form-data">
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" for="name">Nom de la catégorie</label>
        <input class="col-sm-8" type="input" class="form-control" id="name" name="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label" for="description">Description</label>
        <input class="col-sm-8" type="input" class="form-control" id="description" name="description" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['description'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label"  for="thumbnail">Choisir la vignette de la catégorie...</label>
        <input class="col-sm-8"  type="file" class="form-control-file" id="thumbnail" name="thumbnail">
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label"  for="icon">Choisir l'icone de la catégorie...</label>
        <input class="col-sm-8"  type="file" class="form-control-file" id="icon" name="icon">
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label"  for="color">Choisir la couleur de la catégorie...</label>
        <input class="col-sm-1"  type="color" class="form-control-file" id="color" name="color" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['color'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-4 col-form-label"  for="category_id">Catégorie parente :</label>
        <select class="col-sm-8 custom-select" name="parent_id" id="parent_id">
            <option value="">Choisir une catégorie</option>
            <?php foreach($categories as $category): ?>
                <option <?=  isset($_SESSION['old_inputs']) && $category['id'] == $_SESSION['old_inputs']['parent_id'] ? 'selected' : '' ?> value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
            <?php endforeach; ?>
        </select><br>
    </div>
    <button type="submit" class="btn btn-primary btn-lg"><span class="fa fa-save"></span>
        Ajouter
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=categories&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
