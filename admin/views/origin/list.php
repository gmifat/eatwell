<?php ?>
    <h2><?= $pageTitle ?></h2>
    <a href="index.php?controller=origins&action=new"><img alt="Ajouter" class="add-element" src="assets/images/add.png" /> Ajouter origine produit</a>

    <div class="table-responsive container-fluid">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="" scope="col">Position</th>
                    <th class="width96" scope="col">Icône</th>
                    <th class="" scope="col">Nom</th>
                    <th class="" scope="col">Description</th>
                    <th class="width32" scope="col">Modifier</th>
                    <th class="width32">Supprimer</th>
                </tr>
            </thead>
            <tbody>
            <?php if (isset($origins)) :?>
                <?php foreach ($origins as $origin) :?>
                    <tr>
                        <td class=""><?= $origin['position']; ?></td>
                        <td class="width96"><img class="width32" src="<?= !empty($origin['image']) ? '../assets/images/origin/'.$origin['image'] :  '../assets/images/no_image.PNG' ?>"/></td>
                        <td class=""><a href="index.php?controller=origins&action=view&id=<?= $origin['id']; ?>"><?= $origin['name']; ?></a></td>
                        <td class=""><?= $origin['description']; ?></td>
                        <td class="width32"><a href="index.php?controller=origins&action=edit&id=<?= $origin['id']; ?>"><img class="action-img" alt="Modifier" src="assets/images/edit.png" /></a></td>
                        <td class="width32"><a href="index.php?controller=origins&action=delete&id=<?= $origin['id']; ?>"><img class="action-img" alt="Supprimer" src="assets/images/delete.png" /></a></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>