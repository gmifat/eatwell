<?php ?>
<h2><?= $pageTitle ?></h2>

<form action="index.php?controller=origins&action=delete" method="post"  enctype="multipart/form-data">
    <div class="form-group row">
        <input name="id" value="<?= $origin['id'] ?>" type="hidden">
    </div>
    <table class="table-responsive">
        <tbody>
        <tr>
            <th scope="row">Image  :</th>
            <td><img class="width96" src="../assets/images/origin/<?= !empty($origin['image']) ? $origin['image'] :  'no_image.PNG' ?>"/></td>
        </tr>
        <tr>
            <th scope="row">Nom  :</th>
            <td><?= $origin['name'];?></td>
        </tr>
        <tr>
            <th scope="row">Description  :</th>
            <td><?= $origin['description'];?></td>
        </tr>
        <tr>
            <th scope="row">Position  :</th>
            <td><?= $origin['position'];?></td>
        </tr>
        <tr>
            <th scope="row">Référencé dans :</th>
            <td><a href="index.php?controller=origins&action=list_produit&id=<?= $origin['id'] ?>"><?= $origin['nb_products'] ?> produit(s)</a></td>
        </tr>
        </tbody>
    </table>
    <br>
    <button type="submit" class="btn btn-danger btn-lg"><span class="fa fa-trash-alt"></span>
        Supprimer
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=origins&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
