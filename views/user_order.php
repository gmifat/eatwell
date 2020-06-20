<h2>
    Commande passé le <?= $order_detail[0]['order_date'] ?>
</h2>
<br>
<table border class="cart-display-table" >
        <thead>
        <tr>
            <th class="cart-display-product">Produit</th>
            <th class="cart-display-price" >Prix unitaire</th>
            <th class="cart-display-quantity" >Quantité</th>
            <th class="cart-display-total" >Total</th>
        </tr>
        </thead>
        <tbody>
    <?php foreach ($order_detail as $value) :?>
            <tr class="cart-display-item">
                <td data-label="Produit" class="cart-display-product" ><?= $value['product_name'] ?></td>
                <td data-label="Prix unitaire" class="cart-display-price" ><?= $value['price'] / 100 ?> €</td>
                <td data-label="Quantité" class="cart-display-quantity"><?= $value['quantity'] ?></td>
                <td data-label="Total" class="cart-display-total" ><?= $value['quantity'] * $value['price'] / 100 ?> €</td>
            </tr>
    <?php endforeach; ?>
        </tbody>
    </table>

<br>
<div class="cart-display-resume">
    <table>
        <tr>
            <td>Total Commande :</td>
            <td class="cart-display-resume-value"><?= $order_detail[0]['order_amount'] / 100 ?> €</td>
        </tr>
        <tr>
            <td>Frais de livraison :</td>
            <td class="cart-display-resume-value"><?= $order_detail[0]['delivery_amount'] / 100 ?> €</td>
        </tr>
        <tr>
            <td>Réduction :</td>
            <td class="cart-display-resume-value">0 €</td>
        </tr>
        <tr>
            <td>Total TTC : </td>
            <td class="cart-display-resume-value"><?= ($order_detail[0]['order_amount'] + $order_detail[0]['delivery_amount']) / 100 ?> €</td>
        </tr>
    </table>
</div>