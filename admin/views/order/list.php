    <h2><?= $pageTitle ?></h2>

    <div class="table-responsive container-fluid">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="width96" scope="col">Id</th>
                    <th class="width32" scope="col">Client</th>
                    <th class="" scope="col">Montant</th>
                    <th class="" scope="col">Date</th>
                    <th class="width32" scope="col">Détails</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($orders)) :?>
                <?php foreach ($orders as $order) :?>
                    <tr>
                        <td class=""><a href="index.php?controller=orders&action=view&id=<?= $order['id']; ?>"><?= $order['id']; ?></a></td>
                        <td class=""><?= $order['first_name'].' '.$order['last_name']; ?></td>
                        <td class=""><?= $order['order_amount']; ?></td>
                        <td class=""><?= $order['order_date']; ?></td>
                        <td class="width32"><a href="index.php?controller=orders&action=view&id=<?= $order['id']; ?>"><i class="fas fa-window-restore"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
