<link rel="stylesheet" href="assets/css/product-details.css">
<main class="product-details">
    <section class="product-details-info">
        
    </section>
    <section class="product-details-info-supp">

    </section>
    <section class="similar-products">
        <h2>Produits similaires</h2>
        <hr class="separator">
        <div class="row">
            <?php foreach ($similarProducts as $product)
            {
                include './views/partials/product.php';
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
<?php
var_dump($product);