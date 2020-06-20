	<main>
		<section class="carousel">
			<div class="carousel-items">
				<div class="carousel-item">
					<p class="text carousel-indicator">+ - - -</p>
					<p class="text">1.LA SANTÉ EST<br>LE <span>TRÉSOR</span><br>DE LA VIE</p>
					<a href="#"><img class="image" src="assets/images/apricot-fruits-on-bowl.jpeg"></a>
				</div>
				<div class="carousel-item">
					<p class="text carousel-indicator">- + - -</p>
					<p class="text">2.LA SANTÉ EST<br>LE <span>TRÉSOR</span><br>DE LA VIE</p>
					<a href="#"><img class="image" src="assets/images/apricot-fruits-on-bowl.jpeg"></a>
				</div>
				<div class="carousel-item">
					<p class="text carousel-indicator">- - + -</p>
					<p class="text">3.LA SANTÉ EST<br>LE <span>TRÉSOR</span><br>DE LA VIE</p>
					<a href="#"><img class="image" src="assets/images/apricot-fruits-on-bowl.jpeg"></a>
				</div>
				<div class="carousel-item">
					<p class="text carousel-indicator">- - - +</p>
					<p class="text">4.LA SANTÉ EST<br>LE <span>TRÉSOR</span><br>DE LA VIE</p>
					<a href="#"><img class="image" src="assets/images/apricot-fruits-on-bowl.jpeg"></a>
				</div>
				<div class="carousel-item">
					<p class="text carousel-indicator">+ - - -</p>
					<p class="text">1.LA SANTÉ EST<br>LE <span>TRÉSOR</span><br>DE LA VIE</p>
					<a href="#"><img class="image" src="assets/images/apricot-fruits-on-bowl.jpeg"></a>
				</div>
			</div>
		</section>
		<section class="purpose">
			<h2>Pourquoi nos produits?</h2>
			<hr class="separator">
			<div class="row">
				<article class="gap purpose-item">
					<div class="purpose-item-title">
						<img src="assets/images/leaf.png">
						<h4>MONDE IDEAL</h4>
					</div>
					<p>L’alimentation bio fait l’unanimité auprès des producteurs, des consommateurs et des défenseurs de l’environnement.</p>
				</article>
				<article class="gap purpose-item">
					<div class="purpose-item-title">
						<img src="assets/images/leaf.png">
						<h4>LES BIENFAITS</h4>
					</div>
					<p>Manger bio permet de préserver sa santé. En effet, les aliments bio possèdent des teneurs en vitamines généralement plus élevées que les produits  conventionnelle.</p>
				</article>
				<article class="gap purpose-item">
					<div class="purpose-item-title">
						<img src="assets/images/leaf.png">
						<h4>LE RESPECT DE LA TERRE</h4>
					</div>
					<p>L’agriculture bio permet de préserver la qualité des eaux, et peut par exemple éviter des coûts de traitement de l’eau.</p>
				</article>
			</div>
		</section>
		<section class="new-products">
			<h2>Nouveautés</h2>
			<hr class="separator">
			<div class="row">
                <?php foreach ($newProducts as $product)
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
		<section class="bio-logo">
			<div class="row symbol">
				<div class="logo">
					<img src="assets/images/logos/logo8.jpg" alt="logo1">
				</div>
				<div class="logo">
					<img src="assets/images/logos/logo2.jpg" alt="logo2">
				</div>
				<div class="logo">
					<img src="assets/images/logos/logo7.jpg" alt="logo3">
				</div>
			</div>
		</section>
	</main>