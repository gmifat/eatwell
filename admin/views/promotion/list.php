<?php ?>
    <h2><?= $pageTitle ?></h2>
    <a href="index.php?controller=promotions&action=new"><img alt="Ajouter" class="add-element" src="assets/images/add.png" /> Ajouter une promotion</a>

    <div class="table-responsive container-fluid">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="" scope="col">Code Promotion</th>
                    <th class="" scope="col">Type (%,fixe)</th>
                    <th class="" scope="col">Remise sur la commande</th>
                    <th class="" scope="col">Remise sur la livraison</th>
                    <th class="" scope="col">Min commande</th>
                    <th class="" scope="col">Date de début</th>
                    <th class="" scope="col">Date de fin</th>
                    <th class="" scope="col">Description</th>
                    <th class="" scope="col">Image</th>
                    <th class="width32" scope="col">Modifier</th>
                    <th class="width32">Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($promotions)) :?>
                    <?php foreach ($promotions as $promotion) :?>
                        <tr>
                            <td class=""><?= $promotion['code']; ?></td>
                            <td class=""><?= $promotion['discount_type_name']; ?></td>
                            <td class="">
                                <?php
                                switch ($promotion['discount_type_code'])
                                {
                                    case 'percent':
                                        echo $promotion['discount_order'], ' %';
                                        break;

                                    case 'fix':
                                        echo $promotion['discount_order'] / 100, ' €';
                                        break;
                                    default:
                                        echo $promotion['discount_order'];
                                        exit;
                                }?>
                            </td>
                            <td class="">
                                <?php
                                switch ($promotion['discount_type_code'])
                                {
                                    case 'percent':
                                        echo $promotion['discount_delivery'], ' %';
                                        break;

                                    case 'fix':
                                        echo $promotion['discount_delivery'] / 100, ' €';
                                        break;
                                    default:
                                        echo $promotion['discount_delivery'];
                                        exit;
                                }
                                ?>
                            </td>
                            <td class=""><?= ($promotion['min_price'] / 100).' €'; ?></td>
                            <td class=""><?= date_format(date_create($promotion['start_date']), "d/m/Y"); ?></td>
                            <td class=""><?= date_format(date_create($promotion['end_date']), "d/m/Y"); ?></td>
                            <td class=""><?= $promotion['description']; ?></td>
                            <td class=""><img class="width32" src="<?= !empty($promotion['src_image']) ? '../assets/images/promotion/'.$promotion['src_image'] :  '../assets/images/no_image.PNG' ?>"/></td>
                            <td class="width32"><a href="index.php?controller=promotions&action=edit&id=<?= $promotion['id']; ?>"><img class="action-img" alt="Modifier" src="assets/images/edit.png" /></a></td>
                            <td class="width32"><a href="index.php?controller=promotions&action=delete&id=<?= $promotion['id']; ?>"><img class="action-img" alt="Supprimer" src="assets/images/delete.png" /></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
