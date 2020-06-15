<?php ?>
<h2><?= $pageTitle ?></h2>

<form action="index.php?controller=sizes&action=delete" method="post"  enctype="multipart/form-data">
    <div class="form-group row">
        <input name="id" value="<?= $size['id'] ?>" type="hidden">
    </div>
    <table class="table-responsive">
        <tbody>
            <tr>
                <th scope="row">Nom  :</th>
                <td><?= $size['name'];?></td>
            </tr>
            <tr>
                <th scope="row">Description  :</th>
                <td><?= $size['description'];?></td>
            </tr>
            <tr>
                <th scope="row">Code  :</th>
                <td><?= $size['code'];?></td>
            </tr>
            <tr>
                <th scope="row">Diamètre  :</th>
                <td><?= $size['diameter'];?></td>
            </tr>
            <tr>
                <th scope="row">Taille  :</th>
                <td><?= $size['length'];?></td>
            </tr>
            <tr>
                <th scope="row">Poids moyen (g) :</th>
                <td><?= $size['average_weight'];?></td>
            </tr>
            <tr>
                <th scope="row">Nombre moyen /kg :</th>
                <td><?= $size['average_number_per_kg'];?></td>
            </tr>
            <tr>
                <th scope="row">Référencé dans :</th>
                <td><a href="index.php?controller=sizes&action=list_produit&id=<?= $size['id'] ?>"><?= $size['nb_products'] ?> produit(s)</a></td>
            </tr>
        </tbody>
    </table>
    <br>
    <button type="submit" class="btn btn-danger btn-lg"><span class="fa fa-trash-alt"></span>
        Supprimer
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=sizes&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
