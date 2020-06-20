    <?php if ($pageTitle != 'Admin') : ?>
        <div class="menu">
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?controller=products&action=list">Produits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=categories&action=list">Catégories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=newsletters&action=list">Newsletters</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=origins&action=list">Origine produit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=recipes&action=list">Recettes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=sizes&action=list">Calibres et catégories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=units&action=list">Unités</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=users&action=list">Utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=orders&action=list">Commandes</a>
                </li>
            </ul>
        </div>
    <?php endif; ?>