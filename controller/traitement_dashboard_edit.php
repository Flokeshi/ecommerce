<?php

/*Connexion à la BDD*/
require ('../modele/connexion_bdd.php');

try {
	$virgule=array(",");
	$point=array(".");
	$product_price=str_replace($virgule, $point, $_POST['productPrice']); // remplace les virgules par des points

	$sql="UPDATE product SET product_name=:product_name, product_description=:product_description, product_price=:product_price WHERE product_id=:product_id";
	$stmt=$bdd->prepare($sql);
	$stmt->execute([':product_name' => $_POST['productName'], ':product_description' => $_POST['productDescription'], ':product_price' => $product_price, ':product_id' => $_POST['productId']]);
	include('../vue/media.php');
}catch(PDOException $e){
	echo $e->getMessage();
	die();
}
?>