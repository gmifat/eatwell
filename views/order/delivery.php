    <h2>
        ADRESSE DE LIVRAISON
    </h2>
    <hr>
    <div class="order-form-input">
        <label for="firstname">Prénom *</label>
        <input required name="firstname" type="text" id="firstname" value="<?= $_SESSION['order_inputs']['delivery']['firstname'] ?>">
    </div>
    <div class="order-form-input">
        <label for="lastname">Nom *</label>
        <input required name="lastname" type="text" id="lastname" value="<?= $_SESSION['order_inputs']['delivery']['lastname'] ?>">
    </div>
    <div class="order-form-input">
        <label for="address">Adresse *</label>
        <input required name="address" type="text" id="address" value="<?= $_SESSION['order_inputs']['delivery']['address'] ?>">
    </div>
    <div class="order-form-input">
        <label for="additional-address">Complément d'adresse</label>
        <input placeholder="complément d'adresse" name="additional-address" type="text" id="additional-address" value="<?= $_SESSION['order_inputs']['delivery']['additional-address'] ?>">
    </div>
    <div class="order-form-input">
        <label for="additional-address2"></label>
        <input placeholder="complément d'adresse 2" name="additional-address2" type="text" id="additional-address2" value="<?= $_SESSION['order_inputs']['delivery']['additional-address2']?>">
    </div>
    <div class="order-form-input">
        <label for="city">Ville *</label>
        <input required name="city" type="text" id="city" value="<?= $_SESSION['order_inputs']['delivery']['city']?>">
    </div>
    <div class="order-form-input">
        <label for="postal-code">Code postale *</label>
        <input required name="postal-code" type="tel" id="postal-code" value="<?= $_SESSION['order_inputs']['delivery']['postal-code'] ?>">
    </div>
    <div class="order-form-input-check">
        <input name="address-invoice" type="checkbox" id="address-invoice" <?= $_SESSION['order_inputs']['delivery']['address-invoice'] == 1  ? 'checked' : '' ?>>
        <label for="address-invoice">Utiliser la même adresse de livraison pour la facturation</label>
    </div>