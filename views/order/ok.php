<div class="order-ok">
    <h2>
        Nous avons bien reçu votre commande !
    </h2>
    <h4>
        Votre commande a été acceptée. il ne reste plus qu'attendre votre colis.
    </h4>
    <img src="assets/images/order-thank.jpg">
</div>

<script type="text/javascript">
    let cart = document.querySelector('[data-cart]');
    cart.dataset.cart = 0;

    let carContent = document.querySelector('.cart-content');
    carContent.innerHTML = '';
</script>