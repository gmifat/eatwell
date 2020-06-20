<?php ?>
<h2><?= $pageTitle ?></h2>
<form action="index.php?controller=categories&action=delete" method="post"  enctype="multipart/form-data">
    <div class="form-group row">
        <input name="id" value="<?= $category['id'] ?>" type="hidden">
    </div>
    <table class="table-responsive">
        <tbody>
        <tr>
            <th scope="row">Nom  :</th>
            <td><?= $category['name'];?></td>
        </tr>
        <tr>
            <th scope="row">Description  :</th>
            <td><?= $category['description'];?></td>
        </tr>
        <tr>
            <th scope="row">Couleur  :</th>
            <td style="background-color: <?= $category['color'];?>;"><?= $category['color'];?></td>
        </tr>
        <tr>
            <th scope="row">Icône ? :</th>
            <td><img class="width64" src="../assets/images/<?= isset($category['icon']) ? 'category/icon/'.$category['icon'] :  'no_image.PNG' ?>"/></td>
        </tr>
        <tr>
            <th scope="row">Vignette ? :</th>
            <td><img class="width64" src="../assets/images/<?= isset($category['thumbnail']) ? 'category/thumbnail/'.$category['thumbnail'] :  'no_image.PNG' ?>"/></td>
        </tr>
        <tr>
            <th scope="row">Sous catégorie :</th>
            <td>
                <?php if (sizeof($category['sub_categories']) > 0) :?>
                <ul>
                    <?php foreach($category['sub_categories'] as $children): ?>
                        <li><a target="_blank" href="index.php?controller=categories&action=view&id=<?= $children['id']; ?>"> <?= $children['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                    <span>Aucune sous catégorie</span>
                <?php endif;?>
            </td>
        </tr>
        <tr>
            <th scope="row">Produits  :</th>
            <td>
                <?php
                    $nb = sizeof($category['products']);
                    if ($nb == 0)
                    {
                        echo 'Aucun produit';
                    }
                    else if ($nb == 1)
                    {
                        echo '<a target="_blank" href="../index.php?p=shop&category_id='.$category['id'].'">Un produit</a>';
                    }
                    else
                    {
                        echo '<a target="_blank" href="../index.php?p=shop&category_id='.$category['id'].'">'.$nb.' produits</a>';
                    }
                ?>
            </td>
        </tr>

        </tbody>
    </table>
    <button type="submit" class="btn btn-danger btn-lg"><span class="fa fa-trash-alt"></span>
        Supprimer
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=categories&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
