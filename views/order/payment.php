<h2>
    PAIEMENT
</h2>
<div class="payment-container">
    <div class="payment-card">
        <img src="assets/images/credit-cards.png">
        <div>
            <p>Le montant à payer est : <span><?= $total ?> € </span></p>
        </div>
        <div class="payment-form-input">
            <label for="name-on-card">Nom sur la carte</label>
            <input name="name-on-card" type="text" id="name-on-card" value="<?= $_SESSION['order_inputs']['info']['first_name'].' '.$_SESSION['order_inputs']['info']['last_name'] ?>">
        </div>
        <div class="payment-form-input">
            <label for="card-number">Numéro de la carte</label>
            <input name="card-number" type="text" id="card-number">
        </div>
        <div class="payment-form-input-row">
            <div>
                <label for="expiry-date">Expire le</label>
                <input name="expiry-date" type="text" id="expiry-date" placeholder="MM/YY">
            </div>
            <div>
                <label for="security-code">CVV2</label>
                <input name="security-code" minlength="3" maxlength="3" type="text" id="security-code">
            </div>
        </div>
    </div>
    <div class="cart-resume">

    </div>
</div>