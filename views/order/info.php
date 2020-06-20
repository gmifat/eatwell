    <h2>
        INFORMATION PERSONNELLE
    </h2>
    <hr>
    <div class="order-form-input">
        <label for="first_name">Prénom *</label>
        <input required name="first_name" type="text" id="first_name" value="<?= $_SESSION['order_inputs']['info']['first_name'] ?>">
    </div>
    <div class="order-form-input">
        <label for="last_name">Nom *</label>
        <input required name="last_name" type="text" id="last_name" value="<?= $_SESSION['order_inputs']['info']['last_name'] ?>">
    </div>
    <div class="order-form-input">
        <label for="email">Adresse Email *</label>
        <input required name="email" type="email" id="email" value="<?= $_SESSION['order_inputs']['info']['email'] ?>">
    </div>
    <div class="order-form-input">
        <label for="phonenumber">Téléphone *</label>
        <input required name="phonenumber" type="tel" id="phonenumber" value="<?= $_SESSION['order_inputs']['info']['phonenumber']?>">
    </div>