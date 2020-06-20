<h2>
    ADRESSE DE FACTURATION
</h2>
<hr>
<div class="order-form-input">
    <label for="first_name">Prénom *</label>
    <input required name="first_name" type="text" id="first_name" value="<?= $_SESSION['order_inputs']['invoice']['first_name'] ?>">
</div>
<div class="order-form-input">
    <label for="last_name">Nom *</label>
    <input required name="last_name" type="text" id="last_name" value="<?= $_SESSION['order_inputs']['invoice']['last_name'] ?>">
</div>
<div class="order-form-input">
    <label for="street_name">Adresse *</label>
    <input required name="street_name" type="text" id="street_name" value="<?= $_SESSION['order_inputs']['invoice']['street_name'] ?>">
</div>
<div class="order-form-input">
    <label for="complementary_address_1">Complément d'adresse</label>
    <input placeholder="complément d'adresse" name="complementary_address_1" type="text" id="complementary_address_1" value="<?= $_SESSION['order_inputs']['invoice']['complementary_address_1'] ?>">
</div>
<div class="order-form-input">
    <label for="complementary_address_2"></label>
    <input placeholder="complément d'adresse 2" name="complementary_address_2" type="text" id="complementary_address_2" value="<?= $_SESSION['order_inputs']['invoice']['complementary_address_2'] ?>">
</div>
<div class="order-form-input">
    <label for="city">Ville *</label>
    <input required name="city" type="text" id="city" value="<?= $_SESSION['order_inputs']['invoice']['city'] ?>">
</div>
<div class="order-form-input">
    <label for="postal_code">Code postale *</label>
    <input required name="postal_code" minlength="5" maxlength="5"  type="text" id="postal_code" value="<?= $_SESSION['order_inputs']['invoice']['postal_code'] ?>">
</div>