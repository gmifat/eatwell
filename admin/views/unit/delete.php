<?php ?>
<h2><?= $pageTitle ?></h2>

<form action="index.php?controller=units&action=delete" method="post"  enctype="multipart/form-data">
    <div class="form-group row">
        <input name="id" value="<?= $unit['id'] ?>" type="hidden">
    </div>
    <table class="table-responsive">
        <tbody>
        <tr>
            <th scope="row">Nom  :</th>
            <td><?= $unit['name'];?></td>
        </tr>
        <tr>
            <th scope="row">Symbole  :</th>
            <td><?= $unit['symbol'];?></td>
        </tr>
        <tr>
            <th scope="row">Référencé dans :</th>
            <td><a href="index.php?controller=units&action=list_produit&id=<?= $unit['id'] ?>"><?= $unit['nb_products'] ?> produit(s)</a></td>
        </tr>
        </tbody>
    </table>
    <br>
    <button type="submit" class="btn btn-danger btn-lg"><span class="fa fa-trash-alt"></span>
        Supprimer
    </button>
    <a class="btn btn-info btn-lg" href="index.php?controller=units&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>
</form>
