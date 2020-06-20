<table class="table-responsive">
    <tbody>
    <tr>
        <th scope="row">Image  :</th>
        <td><img class="width96" src="../assets/images/<?= !empty($product['thumbnail']) ? 'product/thumbnail/'.$product['thumbnail'] :  'no_image.PNG' ?>"/></td>
    </tr>
    <tr>
        <th scope="row">reference  :</th>
        <td><?= $product['reference'];?></td>
    </tr>
    <tr>
        <th scope="row">name  :</th>
        <td><?= $product['name'];?></td>
    </tr>
    <tr>
        <th scope="row">Catégorie :</th>
        <td><?= $product['category_name'];?></td>
    </tr>
    <tr>
        <th scope="row">Origine :</th>
        <td><?= $product['origin_name'];?></td>
    </tr>
    <tr>
        <th scope="row">Calibre :</th>
        <td><?= $product['size_name'];?></td>
    </tr>
    <tr>
        <th scope="row">Description courte :</th>
        <td><?= $product['short_description'];?></td>
    </tr>
    <tr>
        <th scope="row">Description longue :</th>
        <td><?= $product['long_description'];?></td>
    </tr>
    <tr>
        <th scope="row">Quantité :</th>
        <td><?= $product['quantity'];?></td>
    </tr>
    <tr>
        <th scope="row">Prix  :</th>
        <td><?= ($product['price'] / 100). ' €';?></td>
    </tr>
    <tr>
        <th scope="row">Prix unitaire :</th>
        <td><?= ($product['unit_price'] / 100). ' € / '. $product['unit_name'];?></td>
    </tr>
    <tr>
        <th scope="row">Nouveau ?</th>
        <td><img src="../assets/images/<?= $product['is_new']; ?>.png"></td>
    </tr>
    <tr>
        <th scope="row">Accueil ?</th>
        <td><img src="../assets/images/<?= $product['is_home_page']; ?>.png"></td>
    </tr>
    <tr>
        <th scope="row">En vrac ?</th>
        <td><img src="../assets/images/<?= $product['is_in_bulk']; ?>.png"></td>
    </tr>
    <tr>
        <th scope="row">Remise ?</th>
        <td><?php
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
    </tr>
    <tr>
        <th scope="row">Type de remise ?</th>
        <td><?= $product['discount_type_name'] != null ? $product['discount_type_name'] : '--'; ?></td>
    </tr>

    <tr>
        <th scope="row">Image 1 :</th>
        <td><img class="width96" src="../assets/images/<?= isset($product['image1']) ? 'product/image/'.$product['image1'] :  'no_image.PNG' ?>"/></td>
    </tr>
    <tr>
        <th scope="row">Image 2 :</th>
        <td><img class="width96" src="../assets/images/<?= isset($product['image2']) ? 'product/image/'.$product['image2'] :  'no_image.PNG' ?>"/></td>
    </tr>
    <tr>
        <th scope="row">Image 3 :</th>
        <td><img class="width96" src="../assets/images/<?= isset($product['image3']) ? 'product/image/'.$product['image3'] :  'no_image.PNG' ?>"/></td>
    </tr>
    <tr>
        <th scope="row">Image 4 :</th>
        <td><img class="width96" src="../assets/images/<?= isset($product['image4']) ? 'product/image/'.$product['image4'] :  'no_image.PNG' ?>"/></td>
    </tr>
    <tr>
        <th scope="row">Image 5 :</th>
        <td><img class="width96" src="../assets/images/<?= isset($product['image5']) ? 'product/image/'.$product['image5'] :  'no_image.PNG' ?>"/></td>
    </tr>
    </tbody>
</table>
