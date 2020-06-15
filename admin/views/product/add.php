<?php ?>
<h2><?= $pageTitle ?></h2>
<form action="index.php?controller=products&action=add" method="post"  enctype="multipart/form-data">
    <div class="form-group row">
        <label class="col-sm-2" for="name">Nom</label>
        <input class="col-sm-10" type="input" class="form-control" id="name" name="name" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['name'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-2" for="reference">Référence</label>
        <input class="col-sm-10" type="input" class="form-control" id="reference" name="reference" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['reference'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-2" for="short_description">Description courte</label>
        <input class="col-sm-10" type="input" class="form-control" id="short_description" name="short_description" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['short_description'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-2" for="long_description">Description détaillée</label>
        <input class="col-sm-10" type="input" class="form-control" id="long_description" name="long_description" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['long_description'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-2"  for="product_thumbnail">Choisir la vignette du produit...</label>
        <input class="col-sm-8"  type="file" class="form-control-file" id="product_thumbnail" name="product_thumbnail" value="<?= isset($_FILES['product_thumbnail']) ? $_FILES['product_thumbnail'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg"  for="category_id">Catégorie :</label>
        <select class="col-sm-10 custom-select" name="category_id" id="category_id">
            <option value="">Choisir une catégorie</option>
            <?php foreach($categories as $category): ?>
                <option <?=  isset($_SESSION['old_inputs']) && $category['id'] == $_SESSION['old_inputs']['category_id'] ? 'selected' : '' ?> value="<?= $category['id']; ?>"><?= $category['name']; ?></option>
            <?php endforeach; ?>
        </select><br>
    </div>
    <div class="form-group row">
        <label class="col-sm-2" for="price">Prix</label>
        <input class="col-sm-10" type="input" class="form-control" id="price" name="price" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['price'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-2" for="unit_price">Prix unitaire</label>
        <input class="col-sm-10" type="input" class="form-control" id="unit_price" name="unit_price" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['unit_price'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg"  for="unit_id">Type d'unité :</label>
        <select class="col-sm-10 custom-select" name="unit_id" id="unit_id">
            <option value="">Choisir une unité</option>
            <?php foreach($units as $unit): ?>
                <option <?=  isset($_SESSION['old_inputs']) && $unit['id'] == $_SESSION['old_inputs']['unit_id'] ? 'selected' : '' ?> value="<?= $unit['id']; ?>"><?= $unit['name']; ?> ( /<?= $unit['symbol']; ?> )</option>
            <?php endforeach; ?>
        </select><br>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg"  for="origin_id">Origine du produit :</label>
        <select class="col-sm-10 custom-select" name="origin_id" id="origin_id">
            <option value="">Choisir l'origine du produit</option>
            <?php foreach($origins as $origin): ?>
                <option <?=  isset($_SESSION['old_inputs']) && $origin['id'] == $_SESSION['old_inputs']['origin_id'] ? 'selected' : '' ?> value="<?= $origin['id']; ?>">
                    <?= $origin['name']; ?> ( <?= $origin['description']; ?>)
                </option>
            <?php endforeach; ?>
        </select><br>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg"  for="size_id">Calibre :</label>
        <select class="col-sm-10 custom-select" name="size_id" id="size_id">
            <option value="">Choisir le calibre du produit</option>
            <?php foreach($sizes as $size): ?>
                <option <?=  isset($_SESSION['old_inputs']) && $size['id'] == $_SESSION['old_inputs']['size_id'] ? 'selected' : '' ?> value="<?= $size['id']; ?>"><?= $size['name']; ?> (<?= $size['description']; ?>)</option>
            <?php endforeach; ?>
        </select><br>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label col-form-label-lg"  for="recipe_ids">Type de recette :</label>
        <select multiple class="col-sm-10 custom-select" name="recipe_ids[]" id="recipe_ids[]">
            <?php foreach($recipes as $recipe):
            {
                $selected = '';
                if (isset($_SESSION['old_inputs']) && isset($_SESSION['old_inputs']['recipe_ids']))
                {
                    foreach ($_SESSION['old_inputs']['recipe_ids'] as $selectedRecipe)
                    {
                        if ($recipe['id'] == $selectedRecipe) {
                            $selected = 'selected';
                        }
                    }
                }
            }
            ?>
            <option <?= $selected ?> value="<?= $recipe['id'] ?>"><?= $recipe['name']?></option>;
            <?php endforeach; ?>
        </select><br>
    </div>
    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Options</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_new" name="is_new" value="is_new" <?= isset($_SESSION['old_inputs']['is_new']) && $_SESSION['old_inputs']['is_new'] == 'is_new' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_new">Est nouveau ?</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_home_page" name="is_home_page" value="is_home_page" <?= isset($_SESSION['old_inputs']['is_home_page']) && $_SESSION['old_inputs']['is_home_page'] == 'is_home_page' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_home_page">Est visible sur la page d'acceuil ?</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="is_available" name="is_available" value="is_available" <?= isset($_SESSION['old_inputs']['is_available']) && $_SESSION['old_inputs']['is_available'] == 'is_available' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="is_available">Est disponible ?</label>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="form-group row">
        <label class="col-sm-2" for="discount_type">Type de remise</label>
        <select class="col-sm-10"  id="discount_type_id" name="discount_type_id" class="form-control">
            <option value="">Choisir type du promotion</option>
            <?php foreach($discount_types as $discount_type): ?>
                <option <?=  isset($_SESSION['old_inputs']) && $discount_type['id'] == $_SESSION['old_inputs']['discount_type_id'] ? 'selected' : '' ?> value="<?= $discount_type['id']; ?>">
                    <?= $discount_type['name']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group row">
        <label class="col-sm-2" for="discount">Remise</label>
        <input class="col-sm-10" type="input" class="form-control" id="discount" name="discount" value="<?= isset($_SESSION['old_inputs']) ? $_SESSION['old_inputs']['discount'] : '' ?>">
    </div>
    <!-- images du produit-->
    <div class="form-group row">
        <label class="col-sm-2"  for="product_image1">Choisir la 1ère image</label>
        <input class="col-sm-10"  type="file" class="form-control-file" id="product_image1" name="product_image1" value="<?= isset($_FILES['product_image1']) ? $_FILES['product_image1'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-2"  for="product_image2">Choisir la 2e image</label>
        <input class="col-sm-10"  type="file" class="form-control-file" id="product_image2" name="product_image2" value="<?= isset($_FILES['product_image2']) ? $_FILES['product_image2'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-2"  for="product_image3">Choisir la 3e image</label>
        <input class="col-sm-10"  type="file" class="form-control-file" id="product_image3" name="product_image3" value="<?= isset($_FILES['product_image3']) ? $_FILES['product_image3'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-2"  for="product_image4">Choisir la 4e image</label>
        <input class="col-sm-10"  type="file" class="form-control-file" id="product_image4" name="product_image4" value="<?= isset($_FILES['product_image4']) ? $_FILES['product_image4'] : '' ?>">
    </div>
    <div class="form-group row">
        <label class="col-sm-2"  for="product_image5">Choisir la 5e image</label>
        <input class="col-sm-10"  type="file" class="form-control-file" id="product_image5" name="product_image5" value="<?= isset($_FILES['product_image5']) ? $_FILES['product_image5'] : '' ?>">
    </div>
    <button type="submit" class="btn btn-primary btn-lg"><span class="fa fa-save"></span>
        Ajouter
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=products&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
