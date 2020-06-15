<h2><?= $pageTitle ?></h2>

<br>
<table class="table-responsive">
    <tbody>
        <tr>
            <th scope="row">Image  :</th>
            <td><img class="width32" src="<?= !empty($origin['image']) ? '../assets/images/origin/'.$origin['image'] :  '../assets/images/no_image.PNG' ?>"/></td>
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
<a class="btn btn-info btn-lg" href="index.php?controller=origins&action=list" role="button"><span class="fa fa-window-close"></span> Retour à la liste</a>