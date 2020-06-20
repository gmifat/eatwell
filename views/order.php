
<main class="order-cart">
    <form method="post" action="index.php?p=order&step=<?= $next_step; ?>">
        <div class="order-header">
            <hr>
            <?php foreach ($steps as $step) : ?>
                <div class="order-step-container">
                    <div class="half-circle-left <?= $step[1]; ?>"></div>
                    <div class="order-step  <?= $step[1]; ?>"><?= $step[0]; ?></div>
                    <div class="half-circle-right <?= $step[1]; ?>"></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="order-container">
            <?php include ($sub_view); ?>
        </div>
        <div class="order-action">
            <?php if(!empty($previous_step)) : ?>
                <a class="cart-product-add" href="index.php?p=order&step=<?= $previous_step; ?>">Précédent</a>
            <?php endif; ?>
            <?php if(!empty($next_step)) : ?>
                <button type="submit" class="cart-product-add" href="index.php?p=order&step=<?= $next_step; ?>">Suivant</button>
            <?php endif; ?>
            <?php if($can_cancel === true) : ?>
                <a class="cart-product-remove" href="index.php?p=cart">Annuler</a>
            <?php endif; ?>
        </div>
    </form>
</main>