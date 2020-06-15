<?php ?>
    <h2><?= $pageTitle ?></h2>
    <ul class="list-group list-group-horizontal-sm product-action">
        <li class="list-group-item"><a href="index.php?controller=products&action=new"><img alt="Ajouter" class="width32" src="assets/images/add.png" /> Ajouter un produit</a></li>
        <li class="list-group-item"><a href="index.php?controller=products&action=list&filter=all"><img alt="Tous les produits" class="width32" src="../assets/images/all.png" /> Tous les produits</a></li>
        <li class="list-group-item"><a href="index.php?controller=products&action=list&filter=active"><img alt="Les produits actifs" class="width32" src="../assets/images/1.png" /> Les produits actifs</a></li>
        <li class="list-group-item"><a href="index.php?controller=products&action=list&filter=deleted"><img alt="Les produits supprimés" class="width32" src="../assets/images/0.png" /> Les produits supprimés</a></li>
    </ul>

    <div class="table-responsive container-fluid">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="width64" scope="col">Image</th>
                    <th class="" scope="col">Référence</th>
                    <th class="" scope="col">Nom</th>
                    <!--<th class="" scope="col">Description</th>-->
                    <th class="" scope="col">Catégorie</th>
                    <th class="" scope="col">Prix</th>
                    <th class="" scope="col">Prix unitaire</th>
                    <th class="" scope="col">Nouveau ?</th>
                    <th class="" scope="col">Accueil ? </th>
                    <th class="" scope="col">Disponible ?</th>
                    <th class="" scope="col">Remise</th>
                    <th class="" scope="col">Type de remise</th>
                    <th class="width32" scope="col">Modifier</th>
                    <th class="width32">Supprimer / Activer</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($products)) :?>
                <?php foreach ($products as $product) :?>
                    <tr class="<?= $product['is_deleted'] ? 'table-secondary' : ''; ?>">
                        <td class="width64"><img class="width64" src="../assets/images/<?= !empty($product['thumbnail']) ? 'product/thumbnail/'.$product['thumbnail'] :  'no_image.PNG' ?>"/></td>
                        <td class=""><a href="index.php?controller=products&action=view&id=<?= $product['id']; ?>"><?= $product['reference']; ?></a></td>
                        <td class=""><a href="index.php?controller=products&action=view&id=<?= $product['id']; ?>"><?= $product['name']; ?></a></td>
<!--                        <td class=""><?= $product['short_description']; ?></td>-->
                        <td class=""><?= $product['category_name']; ?></td>
                        <td class=""><?= ($product['price'] / 100). ' €'; ?></td>
                        <td class=""><?= ($product['unit_price'] / 100) . ' €'; ?></td>
                        <td class=""><img src="../assets/images/<?= $product['is_new']; ?>.png"></td>
                        <td class=""><img src="../assets/images/<?= $product['is_home_page']; ?>.png"></td>
                        <td class=""><img src="../assets/images/<?= $product['is_available']; ?>.png"></td>
                        <td class="">
                            <?php
                            if($product['discount_type_code'] != null) {
                                switch ($product['discount_type_code']) {
                                    case 'percent':
                                        echo $product['discount'], ' %';
                                        break;

                                    case 'fix':
                                        echo $product['discount'] / 100, ' €';
                                        break;
                                    default:
                                        echo $product['discount'];
                                        exit;
                                }
                            }
                            else
                                {
                                    echo '--';
                                }?>
                        </td>
                        <td class=""><?= $product['discount_type_name'] != null ? $product['discount_type_name'] : '--'; ?></td>
                        <td class="width32"><a href="index.php?controller=products&action=edit&id=<?= $product['id']; ?>"><img class="action-img" alt="Modifier" src="assets/images/edit.png" /></a></td>
                        <?php if($product['is_deleted'] == 0 ) : ?>
                            <td class="width32"><a href="index.php?controller=products&action=delete&id=<?= $product['id']; ?>"><img class="action-img" alt="Supprimer" src="assets/images/delete.png" /></a></td>
                        <?php else : ?>
                            <td class="width64"><a href="index.php?controller=products&action=activate&id=<?= $product['id']; ?>"><img alt="Activer" src="assets/images/activate.png" /></a></td>
                        <?php endif;?>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>