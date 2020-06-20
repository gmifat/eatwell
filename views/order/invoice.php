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
    <label for="address">Adresse *</label>
    <input required name="address" type="text" id="address" value="<?= $_SESSION['order_inputs']['invoice']['address'] ?>">
</div>
<div class="order-form-input">
    <label for="additional-address">Complément d'adresse</label>
    <input placeholder="complément d'adresse" name="additional-address" type="text" id="additional-address" value="<?= $_SESSION['order_inputs']['invoice']['additional-address'] ?>">
</div>
<div class="order-form-input">
    <label for="additional-address2"></label>
    <input placeholder="complément d'adresse 2" name="additional-address2" type="text" id="additional-address2" value="<?= $_SESSION['order_inputs']['invoice']['additional-address2'] ?>">
</div>
<div class="order-form-input">
    <label for="city">Ville *</label>
    <input required name="city" type="text" id="city" value="<?= $_SESSION['order_inputs']['invoice']['city'] ?>">
</div>
<div class="order-form-input">
    <label for="postal-code">Code postale *</label>
    <input required name="postal-code" type="tel" id="postal-code" value="<?= $_SESSION['order_inputs']['invoice']['postal-code'] ?>">
</div>