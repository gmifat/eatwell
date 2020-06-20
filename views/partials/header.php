<?php include_once ('models/product.php')?>
	<header>
        <input type="checkbox" class="trigger">
		<nav>
			<div class="row">
				<div class="gap"><i class="fas fa-phone-alt"></i><span>+33 (0) 123 25 26 27</span></div>
                <a href="#" class="close"><img src="assets/images/picto-croix.png" alt="Une croix"></a>
                <a href="#" class="burger-menu"><img src="assets/images/picto-burger.svg" alt="Menu burger"></a>
				<ul class="header-menu">
					<!--<li><a href="index.php?p=favorites"><i class="far fa-heart"></i> Mes favoris</a></li>-->
					<li>
                        <?php if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) : ?>
                            <a href="index.php?p=useraccount&action=login"><i class="far fa-user-circle"> Se connecter</i></a>
                        <?php else : ?>
                            <a href="index.php?p=useraccount&action=view"><i class="far fa-user-circle"></i> Bienvenue <?= $_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name'] ?></a>
                        <?php endif; ?>
                    </li>
                    <?php if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) : ?>
                        <li>
                            <a href="index.php?p=useraccount&action=disconnect"><i class="fas fa-sign-out-alt"></i> Se déconnecter</a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['is_admin'] == 1) : ?>
                        <li>
                            <a href="./admin/index.php" target="_blank"><i class="fas fa-tools"></i> Accès à l'admin</a>
                        </li>
                    <?php endif; ?>
					<li>
                        <a style="position: relative;" href="index.php?p=cart" data-cart="<?= $_SESSION['cart']['count'] ?>"><i class="fas fa-shopping-basket"></i><span id="cart-link-text"><i class="fas fa-shopping-basket"></i> Voir mon panier</span></a>
                        <div class="cart-content">
                            <?php if ($_SESSION['cart']['count'] > 0) : ?>

                                <?php $total = 0;
                                foreach ($_SESSION['cart'] as $key => $value) : ?>
                                    <?php if ($key !== 'count') :
                                        $cart_product = $value['product'];
                                        $price = $value['quantity'] * getPrice($cart_product);
                                        $total+= $price;
                                        ?>

                                    <div>
                                        <img style="width: 32px;" src="assets/images/<?= !empty($cart_product['thumbnail']) ? 'product/thumbnail/'.$cart_product['thumbnail'] :  'no_image.PNG' ?>"/>
                                        <span><?= $value['quantity']; ?></span>
                                        <span><?= $cart_product['name']; ?></span>
                                        <span><?= getPrice($cart_product) ?></span>
                                        <span><?= $price ?></span>
                                        <span><i class="fas fa-trash-alt"></i></span>
                                        <?php /*var_dump($cart_product);*/ ?>
                                    </div>
                                    <?php endif;?>
                                <?php endforeach; ?>
                                <hr>
                            <span>Total Panier : <?= $total ?></span>
                            <a href="index.php?p=cart">Voir panier</a>
                            <a href="index.php?p=order">Commander</a>
                            <?php else : ?>
                                <span>Aucun article dans votre panier.</span>
                            <?php endif;?>
                        </div>
                    </li>
				</ul>
			</div>
			<hr>
			<div class="row">
				<ul class="gap menu">
					<li><a href="index.php"><img src="assets/images/logo.png" alt="logo"></a></li>
					<li><a href="index.php" class="">Accueil</a></li>
					<li><a href="index.php?p=shop">Produits</a></li>
					<li><a href="index.php?p=contact">Contact</a></li>
					<li><a href="index.php?p=about">A propos</a></li>
				</ul>
				<div class="form">
					<form action="index.php?p=search" class="find-form">
						<input name="find" type="text" placeholder="Rechercher" id="find">
						<input class="bottom" type="submit" value="Search">
					</form>
				</div>
			</div>

            <?php if (isset($breadcrumb) && !empty($breadcrumb)) : ?>
                <hr>
                <span class="breadcrumb-title">Accès rapide</span>
                <div class="breadcrumb select">

                    <ul>
                        <?php foreach ($breadcrumb as $item) : ?>
                            <li><?=$item?></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <hr>
            <?php endif;?>
		</nav>
        <?php if (isset ($_SESSION['messages_ok'])) : ?>
            <div class="alert alert-success">
                <?php foreach ($_SESSION['messages_ok'] as $message) : ?>
                    <?= $message ; ?><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (isset ($_SESSION['messages_ko'])) : ?>
            <div class="alert alert-danger">
                <?php foreach ($_SESSION['messages_ko'] as $message) : ?>
                    <?= $message ; ?><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
	</header>
        

