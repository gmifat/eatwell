
<main class="product-details">
    <section class="product-details-info">
        <div class="product-images">
            <img class="product-image" src="assets/images/product/image/<?= $product['image1'] ?>" alt="image produit">
            <ul>
                <?php
                for($i = 1; $i <= 5; $i++)
                {
                    if(isset($product['image'.$i]) && !empty($product['image'.$i]))
                    {
                        echo '<li><a href="#"><img src="assets/images/product/image/'.$product['image'.$i].'"></a></li>';
                    }
                }
                ?>
            </ul>
            <div class="user-message-content" id="user-message-content-<?= $product['id'] ?>">

            </div>
        </div>

        <div class="product-details-data">
            <h2><?= $product['name'] ?></h2>
            <p><span><?= $product['price'] / 100 ?> €</span> / <span><?= $product['unit_name']?></span></p>
            <p><span><?= $product['unit_price'] / 100 ?> €</span> / <span><?= $product['unit_name'] == 'Barquette' ? 'Kg' : $product['unit_name'] ?></span></p>
            <div class="product-item-reviews">
                <div class="product-item-reviews-mark">
                </div>
            </div>
            <p>
                <?= $product['long_description']?>
            </p>
            <div>
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
            <!--<a href="index.php?p=favorites&id=<?= $product['id'] ;?>" ><img src="assets/images/heart.png"></a>-->
            </div>
        </div>
    </section>
    <section class="product-details-info-supp">

    </section>
    <section class="similar-products">
        <h2>Produits similaires</h2>
        <hr class="separator">
        <div class="row">

            <?php
            if (sizeof($similarProducts) == 0)
            {
                echo '<h3>Ce produit est unique !</h3>';
            }
            else
            {
                foreach ($similarProducts as $product) {
                    include './views/partials/product.php';
                }
            }
            ?>
            <script src="./assets/js/cart.js"></script>
            <script type="text/javascript">

                // Accédez à l'élément form …
                let forms = document.getElementsByClassName("form-inline");
                Array.prototype.forEach.call(forms, function(form) {
                    form.addEventListener("submit", function (event) {
                        event.preventDefault();
                        setCartProduct(event);
                    })
                });
            </script>
        </div>
    </section>
</main>