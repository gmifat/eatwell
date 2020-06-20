    <h2>
        ADRESSE DE LIVRAISON
    </h2>
    <hr>
    <div class="order-form-input">
        <label for="first_name">Prénom *</label>
        <input required name="first_name" type="text" id="first_name" value="<?= empty($_SESSION['order_inputs']['delivery']['first_name']) ? $_SESSION['order_inputs']['info']['first_name'] : $_SESSION['order_inputs']['delivery']['first_name'] ?>">
    </div>
    <div class="order-form-input">
        <label for="last_name">Nom *</label>
        <input required name="last_name" type="text" id="last_name" value="<?= empty($_SESSION['order_inputs']['delivery']['last_name']) ? $_SESSION['order_inputs']['info']['last_name'] : $_SESSION['order_inputs']['delivery']['last_name'] ?>">
    </div>
    <div class="order-form-input">
        <label for="street_name">Adresse *</label>
        <input required name="street_name" type="text" id="street_name" value="<?= $_SESSION['order_inputs']['delivery']['street_name'] ?>">
    </div>
    <div class="order-form-input">
        <label for="complementary_address_1">Complément d'adresse</label>
        <input placeholder="complément d'adresse" name="complementary_address_1" type="text" id="complementary_address_1" value="<?= $_SESSION['order_inputs']['delivery']['complementary_address_1'] ?>">
    </div>
    <div class="order-form-input">
        <label for="complementary_address_2"></label>
        <input placeholder="complément d'adresse 2" name="complementary_address_2" type="text" id="complementary_address_2" value="<?= $_SESSION['order_inputs']['delivery']['complementary_address_2']?>">
    </div>
    <div class="order-form-input">
        <label for="city">Ville *</label>
        <input required name="city" type="text" id="city" value="<?= $_SESSION['order_inputs']['delivery']['city']?>">
    </div>
    <div class="order-form-input">
        <label for="postal_code">Code postale *</label>
        <input required name="postal_code" type="text" minlength="5" maxlength="5" id="postal_code" value="<?= $_SESSION['order_inputs']['delivery']['postal_code'] ?>">
    </div>
    <div class="order-form-input-check">
        <input name="address-invoice" type="checkbox" id="address-invoice" <?= $_SESSION['order_inputs']['delivery']['address-invoice'] == 1  ? 'checked' : '' ?>>
        <label for="address-invoice">Utiliser la même adresse de livraison pour la facturation</label>
    </div>