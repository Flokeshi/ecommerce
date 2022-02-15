<?php
require ('../modele/connexion_bdd.php');

/*requête préparée pour intégrer les produits au dashboard*/
$products=$bdd->prepare("SELECT * FROM product INNER JOIN category ON product.product_category_id=category.category_id ORDER BY product_name ASC"); // Inner join permet de prendre en jointure tout le contenu des 2 tables qui ont une correspondance et qui n'ont pas une valeur nulle
$products->execute();
$productsTable = $products->fetchAll();
/*Utiliser foreach ensuite avec: foreach ($productsTable as $productRow)*/
?>

<?php foreach ($productsTable as $productRow) { ?>
    <tr class="dashboardProductRow">
        <form method="POST" action="../controller/traitement_dashboard_edit.php">
            <td>Shop</td>
            <td><?php echo $productRow["category_name"]; ?></td>
            <td><a href="<?php echo $productRow["picture_url"]; ?>"><img src="<?php echo $productRow["picture_url"]; ?>" style="width: 100px;"></a></td>
            <td><input type="text" name="productName" value="<?php echo $productRow["product_name"]; ?>" class="form-control text-center"><input type="hidden" name="productId" value="<?php echo $productRow["product_id"]; ?>"></td>
            <td><textarea name="productDescription" class="form-control text-center" style="height:100px; min-width: 200px;"><?php echo $productRow["product_description"]; ?></textarea></td>
            <td><input type="text" name="productPrice" value="<?php echo $productRow["product_price"]; ?>" class="form-control text-center" style="width: 80px;"> €</td>
            <td class="text-center"> 
                <button class="btn btn-info dashboardEdit" id="edit-<?= $productRow['product_id']?>-<?= $productRow['product_name']?>-<?= $productRow['product_description']?>-<?= $productRow['product_price']?>"><i class="fas fa-save"></i></button>
                <button class="btn btn-danger dashboardDelete" id="delete-<?= $productRow['product_id']?>-<?= $productRow['picture_url']?>"><i class="bi bi-trash-fill" style="color:black;"></i></button>
            </td>
        </form>
    </tr>
<?php } ?>