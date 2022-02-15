<?php
require ('../modele/connexion_bdd.php');
 
if (isset($_SESSION['idUser'])) {
    $user_id=$_SESSION['idUser'];
}else{
    $user_id="";
}
if (isset($_SESSION['idCart'])) {
    $cart_id=$_SESSION['idCart'];
}else{
    $cart_id="";
}

// S'il y a une session utilisateur, on filtre le panier sur son id et sur l'id_cart s'il existe en session... 
if(isset($_SESSION['idUser'])) {
    $sql="SELECT * FROM cart_details INNER JOIN product ON product.product_id=cart_details.product_num LEFT JOIN cart ON cart.cart_id=cart_details.cart_num WHERE cart_user_id=:user_id AND cart_num=:cart_id ORDER BY product_name ASC"; // Inner join permet de prendre en jointure tout le contenu des 2 tables qui ont une correspondance et qui n'ont pas une valeur nulle
    $stmt=$bdd->prepare($sql);
    $stmt->execute([':user_id' => $user_id, ':cart_id' => $cart_id]);

// Sinon, s'il n'y a pas de session utilisateur, on filtre le panier uniquement sur la session de l'id_cart
}else{
    $sql="SELECT * FROM cart_details INNER JOIN product ON product.product_id=cart_details.product_num LEFT JOIN cart ON cart.cart_id=cart_details.cart_num WHERE cart_num=:cart_id ORDER BY product_name ASC"; 
    $stmt=$bdd->prepare($sql);
    $stmt->execute([':cart_id' => $cart_id]);
}

// Si on a du contenu dans le tableau, alors on a le contenu suivant :
if ($recordset=$stmt->fetchAll()) { 
	$total=0;
	?>

	<section class="p-t-0 p-b-0">
		<h2 class="title m-5">Panier</h2>
		<table class="table">
			<thead>
				<th>Produit</th>
				<th>Nom</th>
				<th>Quantité</th>
				<th>Prix unitaire</th>
				<th></th>
			</thead>
			<tbody>
				<?php foreach ($recordset as $row) {?>
				<tr>
					<td class="align-middle">
						<img src="<?php echo $row['picture_url']; ?>" style="width: 150px;">
					</td>
					<td class="align-middle">
						<?php echo $row['product_name']; ?>
					</td>
					<td class="align-middle">
						<select style="width: 50px;" onchange="changeQte(this.value, <?php echo $row['cart_quantity']; ?>, <?php echo $row['product_id']; ?>, <?php echo $row['cart_num']; ?>)">
							<?php 
							$i=1;
							while ($i <= $row['product_stock']) { ?>
								<option value="<?php echo $i; ?>" class="stockFilter" 
									<?php if ($i == $row['cart_quantity']) { ?> selected <?php } ?> >
									<?php echo $i; ?>
								</option>
								<?php 
								$i++;
							} ?>
						</select>
					</td>
					<td class="align-middle">
						<?php echo $row['product_price']; ?> €
					</td>
					<td class="align-middle">
						<div class="cart-product-remove">
						<button class="btn btn-danger cartDelete" value="<?= ($row['cart_quantity']?$row['cart_quantity']:0)?>" id="delete-<?= $row['product_id']?>"><i class="fa fa-times"></i></button>
						</div>
					</td>
					<?php $total=$total+($row['cart_quantity']*$row['product_price']); ?>
				</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2"></td>
					<td><strong>TOTAL</strong></td>
					<td><strong><?php echo $total; ?> €</strong></td>
					<td></td>
				</tr>
			</tfoot>
		</table>

		<form method="POST" action="../controller/traitement_checkout_completed.php">
			<div class="md-form form-sm form-2 pl-0">
				<div class="button text-center">
					<input type="hidden" name="amount" value="<?php echo $total; ?>">
					<button class="input-group-text d-inline black lighten-2 m-5" type="submit"><h6>Passer votre commande</h6></button>
				</div>
			</div>
		</form>
	</section>


<!-- Sinon, s'il n'y a pas de contenu : -->
<?php }else{ ?>
	<h2 class="title m-5">Panier</h2>
	<ul class="list-group my-5">
		<li><i class="fas fa-shopping-cart pb-4" style="font-size:80px;"></i></li>
		<li>Votre panier est vide...</li>
		<li><em>Retour au <a href="../public/index.php">magasin</a></em></li>
	</ul>
	
<?php } ?>