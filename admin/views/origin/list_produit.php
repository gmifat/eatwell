<h2><?= $pageTitle ?></h2>
<table class="table table-hover">
    <thead class="thead-light">
    <tr>
        <th class="width32" scope="col">Vignette</th>
        <th class="" scope="col">Nom</th>
        <th class="" scope="col">Description</th>
    </tr>
    </thead>
    <tbody>
    <?php if (isset($products)) :?>
        <?php foreach ($products as $product) :?>
            <?php if ($product['product_id'] != null) :?>
                <tr>
                    <td class="width32"><img class="width32" src="../assets/images/product/thumbnail/<?= !empty($product['thumbnail']) ? $product['thumbnail'] :  'no_image.PNG' ?>"/></td>
                    <td class=""><a href="index.php?controller=categories&action=view&id=<?= $product['id']; ?>"><?= $product['name']; ?></a></td>
                    <td class=""><?= $product['short_description']; ?></td>
                </tr>
            <?php endif;?>
        <?php endforeach; ?>
    <?php endif; ?>
    </tbody>
</table>
<a class="btn btn-info btn-lg" href="index.php?controller=origins&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
