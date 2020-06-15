<?php ?>
<h2><?= $pageTitle ?></h2>
<?php var_dump($product);?>
<form action="index.php?controller=products&action=activate" method="post"  enctype="multipart/form-data">
    <div class="form-group row">
        <input name="id" value="<?= $product['id'] ?>" type="hidden">
    </div>
    <?php include 'details.php'; ?>
    <button type="submit" class="btn btn-danger btn-lg"><span class="fa fa-trash-alt"></span>
        Activer le produit
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=products&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
