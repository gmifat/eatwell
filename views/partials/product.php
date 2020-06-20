<div class="product-item">
    <div class="product-item-container">
        <div class="product-thumbnail-container">
            <a href="index.php?p=favorites&id=<?= $product['id'] ;?>" class="favorite"><img src="assets/images/heart.png"></a>
            <a href="index.php?p=product&id=<?= $product['id'] ;?>"><img class="product-thumbnail" src="assets/images/product/thumbnail/<?= $product['thumbnail'] ;?>" alt="detox"></a>
        </div>
        <div class="product-item-info">
            <a class="product-item-name" href="index.php?p=product&id=<?= $product['id'] ;?>"><?= $product['short_description'] ;?></a>
            <div class="product-item-details">
                <div class="product-item-category"><a style="color:<?= $product['color'] ;?>" href="index.php?p=shop&category_id=<?= $product['category_id'] ;?>"><?= $product['category_name'] ;?></a></div>
                <div class="product-item-price"><?= getPrice($product).' €' ;?></div>
                <div class="product-item-promo">
                    <div><?= getDiscount($product).' '. $product['symbol'] ;?></div>
                    <?php if(!empty($product['discount'])) : ?>
                        <div><?= ($product['price'] / 100).' €' ;?></div>
                    <?php endif; ?>
                </div>
                <div class="product-item-reviews">
                    <div class="product-item-reviews-mark">
                    </div>
                </div>   <!---->
                <?php if ($product['quantity'] > 0): ?>
                    <form class="form-inline" method="post" action="index.php?p=cart&product_id=<?= $product['id'] ;?>">
                        <div class="product-item-add">
                            <?php if ($product['is_in_bulk'] == 0): ?>
                                <input name="quantity" type="number" min="1" max="<?= $product['quantity'] ;?>" step="1" value="<?= array_key_exists($product['id'], $_SESSION['cart']) ? $_SESSION['cart'][$product['id']]['quantity'] : 1 ?>">
                            <?php else : ?>
                                <input name="quantity" type="number" min="min(1,<?= $product['quantity'] ;?>)" max="<?= $product['quantity'] ;?>" step="0.1" value="<?= array_key_exists($product['id'], $_SESSION['cart']) ? $_SESSION['cart'][$product['id']]['quantity'] : 1 ?>">
                            <?php endif; ?>

                            <button type="submit" style="display:<?= array_key_exists($product['id'], $_SESSION['cart']) ? 'none' : 'flex'; ?>" class="cart-product-add" data-action="add" name="add" title="Ajouter le produit au panier"><i class="fas fa-cart-plus"></i>Ajouter au panier</button>
                            <button type="submit" style="display:<?= array_key_exists($product['id'], $_SESSION['cart']) ? 'block' : 'none'; ?>" class="cart-product-edit" data-action="add" name="edit" title="Modifier la quantité"><i class="fas fa-cart-arrow-down"></i></button>
                            <button type="submit" style="display:<?= array_key_exists($product['id'], $_SESSION['cart']) ? 'block' : 'none'; ?>" class="cart-product-remove" data-action="remove" name="remove" title="Supprimer le produit du panier"><i class="fas fa-trash-alt"></i></button>

                        </div>
                    </form>
                <?php else : ?>
                    <div class="product-item-unavailable">
                        <button class="cart-product-unavailable" disabled><i class="fas fa-minus-circle"></i>Bientôt disponible</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="user-message-content" id="user-message-content-<?= $product['id'] ;?>">

        </div>
    </div>
</div>