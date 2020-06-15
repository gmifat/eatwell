<?php ?>
    <h2><?= $pageTitle ?></h2>
    <a href="index.php?controller=sizes&action=new"><img alt="Ajouter" class="add-element" src="assets/images/add.png" /> Ajouter un calibre</a>

    <div class="table-responsive container-fluid">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="" scope="col">Nom</th>
                    <th class="" scope="col">Description</th>
                    <th class="" scope="col">Code</th>
                    <th class="" scope="col">Diamètre</th>
                    <th class="" scope="col">Taille (mm)</th>
                    <th class="" scope="col">Poids moyen (g)</th>
                    <th class="" scope="col">Nombre moyen /kg</th>
                    <th class="width32" scope="col">Modifier</th>
                    <th class="width32">Supprimer</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($sizes)) :?>
                <?php foreach ($sizes as $size) :?>
                    <tr>
                        <td class=""><a href="index.php?controller=sizes&action=view&id=<?= $size['id']; ?>"><?= $size['name']; ?></a></td>
                        <td class=""><?= $size['description']; ?></td>
                        <td class=""><?= $size['code']; ?></td>
                        <td class=""><?= $size['diameter']; ?></td>
                        <td class=""><?= $size['length']; ?></td>
                        <td class=""><?= $size['average_weight']; ?></td>
                        <td class=""><?= $size['average_number_per_kg']; ?></td>
                        <td class="width32"><a href="index.php?controller=sizes&action=edit&id=<?= $size['id']; ?>"><img class="action-img" alt="Modifier" src="assets/images/edit.png" /></a></td>
                        <td class="width32"><a href="index.php?controller=sizes&action=delete&id=<?= $size['id']; ?>"><img class="action-img" alt="Supprimer" src="assets/images/delete.png" /></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>