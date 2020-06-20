<main class="user-account">
    <h2>Information générale</h2>
    <br>
    <table border class="cart-display-table">
        <tbody>
        <tr>
            <th scope="row">Nom  :</th>
            <td><?= $_SESSION['user']['last_name'];?></td>
        </tr>
        <tr>
            <th scope="row">Prénom  :</th>
            <td><?= $_SESSION['user']['first_name'];?></td>
        </tr>
        <tr>
            <th scope="row">Email  :</th>
            <td><?= $_SESSION['user']['email'];?></td>
        </tr>
        </tbody>
    </table>
    <a href="index.php?p=useraccount&action=edit"><i class="fas fa-edit"></i> Modifier mes données</a>

    <br>
    <h2>Liste des commandes</h2>
    <br>
    <div class="cart-display-table">
        <table class="table cart-display-table">
            <thead>
            <tr>
                <th class="width96" scope="col">Id</th>
                <th class="" scope="col">Montant</th>
                <th class="" scope="col">Date</th>
                <th class="width32" scope="col">Détails</th>
            </tr>
            </thead>
            <tbody>
            <?php if (isset($orders)) :?>
                <?php foreach ($orders as $order) :?>
                    <tr>
                        <td data-label="Id" class=""><a href="index.php?p=useraccount&action=view_order&id=<?= $order['id']; ?>"><?= $order['id']; ?></a></td>
                        <td data-label="Montant" class=""><?= $order['order_amount']; ?></td>
                        <td data-label="Date" class=""><?= $order['order_date']; ?></td>
                        <td data-label="Détails" class="width32"><a href="index.php?p=useraccount&action=view_order&id=<?= $order['id']; ?>"><i class="fas fa-window-restore"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>