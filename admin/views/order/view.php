<h2><?= $pageTitle ?></h2>
<?php $user = $order[0]; ?>
<h3>Information client</h3>
<table class="table-responsive">
    <tbody>
        <tr>
            <th scope="row">Nom  :</th>
            <td><?= $user['last_name'];?></td>
        </tr>
        <tr>
            <th scope="row">Prénom  :</th>
            <td><?= $user['first_name'];?></td>
        </tr>
        <tr>
            <th scope="row">Email  :</th>
            <td><?= $user['email'];?></td>
        </tr>
        <tr>
            <th scope="row">Téléphone  :</th>
            <td><?= $user['phone_number'];?></td>
        </tr>
    </tbody>
</table>
<br>
<h3>Détail de la commande</h3>
<div class="table-responsive container-fluid">
    <table class="table table-hover">
        <thead class="thead-light">
        <tr>
            <th class="" scope="col">Produit</th>
            <th class="" scope="col">Quantité</th>
            <th class="" scope="col">Prix unitaire</th>
            <th class="" scope="col">Total</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($order)) :?>
            <?php foreach ($order as $order_detail) :?>
                <tr>
                    <td class=""><?= $order_detail['product_name']?></td>
                    <td class=""><?= $order_detail['quantity']; ?></td>
                    <td class=""><?= $order_detail['price'] / 100; ?> €</td>
                    <td class=""><?= ($order_detail['price'] * $order_detail['quantity']) / 100; ?> €</td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<p>Somme total de la commande <span style="font-weight: bold; font-size: 18px"><?= $order[0]['order_amount'] / 100; ?> €</span></p>

<br>
<a class="btn btn-info btn-lg" href="index.php?controller=orders&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
