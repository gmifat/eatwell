<!--$products = getAllProducts();
$categories = getAllCategories();
$sizes = getAllSizes();
$origin = getAllOrigins();
$recipes = getAllRecipes();-->
<main>
    <section class="shop-header">
        <div>
            <span>1 - 12 de 30 Résultats</span>
        </div>
        <div>
            <span class="shop-header-label">Trier par</span>
            <select id="sort_by" name="sort_by">
                <option value="name">Nom</option>
                <option value="price">Prix</option>
                <option value="new">Nouveautés</option>
                <option value="mark">Meilleurs notes</option>
            </select>
            <span class="shop-header-label">Afficher par</span>
            <select id="nb_element" name="nb_element">
                <option value="12">12</option>
                <option value="24">24</option>
                <option value="48">48</option>
                <option value="all">Tous</option>
            </select>
        </div>
    </section>
    <section class="shop-container">
        <form method="post" action="index.php?p=shop&action=filter">
            <aside class="shop-filter">
                <div>
                    <h4>Catégorie</h4>
                    <ul class="shop-filter-category select">
                        <?php foreach ($categories as $category) : ?>
                            <li>
                                <a href="index.php?p=shop&category_id=<?=$category['id']?>">
                                    <div <?= $category['parent_id'] != null ? 'style="padding-left : 30px"' : '' ?>><?=$category['name']?></div>
                                    <div>(<?=$category['nb_products']?>)</div>
                                </a>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div>
                    <h4>Prix</h4>
                    <span>Min</span>
                    <input type="number" step="0.01" min="0" value="0"><br>
                    <span>Max</span>
                    <input type="number" step="0.01" min="0" value="10">
                </div>
                <div>
                    <h4>Origine</h4>
                    <ul class="shop-filter-category">
                        <?php foreach ($origins as $origin) : ?>
                            <li>
                                <input type="checkbox" name="origin[]" value="<?=$origin['id']?>">
                                <img style="width:32px" src="assets/images/origin/<?=$origin['image']?>">

                                <label for="origin[]"><?=$origin['name']?></label>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div>
                    <h4>Calibre / Qualité</h4>
                    <ul class="shop-filter-category">
                        <?php foreach ($sizes as $size) : ?>
                            <li>
                                <input type="checkbox" name="sizes[]" value="<?=$size['id']?>">
                                <label for="sizes[]"><?=$size['name']?></label>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div>
                    <button class="shop-filter-button" type="submit" ><i class="fas fa-filter"></i>APPLIQUER FILTRE</button>
                </div>
            </aside>
        </form>
        <div class="shop-products">
            <?php foreach ($products as $product)
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
            <div class="user-message-content" id="user-message-content-0">

            </div>
        </div>
    </section>
</main>