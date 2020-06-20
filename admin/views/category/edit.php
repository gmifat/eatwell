<?php ?>
    <h2><?= $pageTitle ?></h2>
    <form action="index.php?controller=categories&action=edit" method="post"  enctype="multipart/form-data">
        <input name="id" value="<?= $category['id'] ?>" type="hidden">
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="name">Nom de la catégorie</label>
            <input class="col-sm-8" type="input" class="form-control" id="name" name="name" value="<?= $category['name'] ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="description">Description</label>
            <input class="col-sm-8" type="input" class="form-control" id="description" name="description" value="<?= $category['description'] ?>">
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label"  for="thumbnail">Choisir la vignette de la catégorie...</label>
            <input class="col-sm-6"  type="file" class="form-control-file" id="thumbnail" name="thumbnail">
            <img class="width64" src="../assets/images/<?= isset($category['thumbnail']) ? 'category/thumbnail/'.$category['thumbnail'] :  'no_image.PNG' ?>"/>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label"  for="icon">Choisir l'icone de la catégorie...</label>
            <input class="col-sm-6"  type="file" class="form-control-file" id="icon" name="icon">
            <img class="width64" src="../assets/images/<?= isset($category['icon']) ? 'category/icon/'.$category['icon'] :  'no_image.PNG' ?>"/>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label"  for="color">Choisir la couleur de la catégorie...</label>
            <input class="col-sm-1"  type="color" class="form-control-file" id="color" name="color" value="<?= $category['color'] ?>">
        </div>

        <div class="form-group row">
            <label class="col-sm-4 col-form-label"  for="category_id">Catégorie parente :</label>
            <?php if ($child == false || sizeof($child) == 0): ?>
            <select class="col-sm-8 custom-select" name="parent_id" id="parent_id">
                <option value="">Choisir une catégorie</option>
                <?php foreach($categories as $parent): ?>
                    <option <?=  $parent['id'] ==$category['parent_id'] ? 'selected' : '' ?> value="<?= $parent['id']; ?>"><?= $parent['name']; ?></option>
                <?php endforeach; ?>
            </select><br>
            <?php else : ?>
            <span>Un seul niveau de catégorie est autorisé : </span>
                <?php foreach($child as $children): ?>
                    <span> <?= $children['name']; ?> | </span>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-secondary btn-lg"><span class="fa fa-save"></span>
            Enregistrer
        </button>
        <a class="btn btn-info btn-lg" href="index.php?controller=categories&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
    </form>
