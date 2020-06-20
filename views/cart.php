
<main class="cart-display">
<?php if ($cart_products['count'] > 0) : ?>
    <table class="table cart-display-table" >
        <thead>
        <tr>
            <th class="cart-display-product" colspan="2">Produit</th>
            <th class="cart-display-price" >Prix unitaire</th>
            <th class="cart-display-quantity" >Quantité</th>
            <th class="cart-display-total" >Total</th>
            <th class="cart-display-delete" >Supprimer</th>
        </tr>
        </thead>
        <tbody>
    <?php $total = 0;
    foreach ($cart_products as $key => $value) : ?>
        <?php if ($key !== 'count') :
            $cart_product = $value['product'];
            $price = $value['quantity'] * getPrice($cart_product);
            $total+= $price;
            ?>
            <tr class="cart-display-item <?= $cart_product['is_deleted'] == 1 ? 'deleted-product' : '' ;?>">
                <td data-label="Produit" class="cart-display-product" rowspan="2">
                    <a href="index.php?p=product&id=<?= $cart_product['id'] ;?>"><img style="width: 96px;" src="assets/images/<?= !empty($cart_product['thumbnail']) ? 'product/thumbnail/'.$cart_product['thumbnail'] :  'no_image.PNG' ?>"/></a>
                </td>
                <td style="border-bottom: 1px solid white;"><a href="index.php?p=product&id=<?= $cart_product['id'] ;?>"><?= $cart_product['name']; ?></a></td>
                <td style="border-bottom: 1px solid white;" data-label="Prix unitaire" class="cart-display-price" ><?= getPrice($cart_product) ?> €</td>
                <td data-label="Quantité" class="cart-display-quantity" rowspan="2">
                    <form class="form-inline" method="get" action="index.php">
                        <input name="p" value="cart" style="display: none">
                        <input name="action" value="add" style="display: none">
                        <input name="refresh" value="refresh" style="display: none">
                        <input name="product_id" value="<?= $cart_product['id'] ;?>" style="display: none">
                        <div class="product-item-add">
                    <?php if ($cart_product['is_in_bulk'] == 0): ?>
                        <input name="quantity" type="number" value="<?= $value['quantity'] ?>" max="<?= $cart_product['quantity'] ;?>" step="1" min="1">
                    <?php else : ?>
                        <input name="quantity" type="number" value="<?= $value['quantity'] ?>" max="<?= $cart_product['quantity'] ;?>" step="0.1" min="<?= min(1, $cart_product['quantity']) ;?>)">
                    <?php endif; ?>
                            <button type="submit" class="cart-product-edit" data-action="add" title="Modifier la quantité"><i class="fas fa-cart-arrow-down"></i>Modifier la quantité</button>
                        </div>
                    </form>
                </td>
                <td data-label="Total" class="cart-display-total" rowspan="2"><?= $price ?> €</td>
                <td data-label="Supprimer" class="cart-display-delete" rowspan="2"><a class="cart-product-remove" href="index.php?p=cart&action=remove&product_id=<?= $cart_product['id']; ?>&refresh"><i class="fas fa-trash-alt"></i></a></td>
            </tr>
            <tr class="cart-display-item cart-more-details <?= $cart_product['is_deleted'] == 1 ? 'deleted-product' : '' ;?>">
                <td data-label="Produit" class="cart-display-product" >
                    <div class="product-item-promo">
                        <span><?= $cart_product['short_description']; ?></span>
                        <?php if(!empty($cart_product['discount'])) : ?>
                            <!--<div>Remise : <?= getDiscount($cart_product).' '. $cart_product['symbol'] ;?></div>
                            <div>Prix initial : <?= ($cart_product['price'] / 100).' €' ;?></div>-->
                        <?php endif; ?>
                    </div>
                </td>
                <td data-label="Produit" class="cart-display-product">
                    <div class="product-item-promo">
                        <?php if(!empty($cart_product['discount'])) : ?>
                            <div>Remise : <?= getDiscount($cart_product).' '. $cart_product['symbol'] ;?></div>
                            <!--<div>Prix initial : <?= ($cart_product['price'] / 100).' €' ;?></div>-->
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endif;?>
    <?php endforeach; ?>
        </tbody>
    </table>
    <hr>
    <div class="cart-display-resume">
        <table>
            <tr>
                <td>Total Panier :</td>
                <td class="cart-display-resume-value"><?= $total ?> €</td>
            </tr>
            <tr>
                <td>Frais de livraison :</td>
                <td class="cart-display-resume-value">10 €</td>
            </tr>
            <tr>
                <td>Réduction :</td>
                <td class="cart-display-resume-value">0 €</td>
            </tr>
            <tr>
                <td>Total TTC : </td>
                <td class="cart-display-resume-value"><?= $total + 10 ?> €</td>
            </tr>
            <tr >
                <td colspan="2"><a class="cart-product-add" href="index.php?p=order"><i class="fas fa-credit-card" style="margin-right: 10px;"></i> Commander</a><br></td>
            </tr>
        </table>
    </div>
<?php else : ?>

    <span>Pas de produits dans le panier</span>

<?php endif; ?>

</main>