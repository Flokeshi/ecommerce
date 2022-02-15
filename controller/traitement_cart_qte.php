<?php
/*Démarre la session utilisateur si elle est présente*/
session_start();

/*Connexion à la BDD*/
require ('../modele/connexion_bdd.php');

if (isset($_SESSION['idUser'])) {
	$user_id=$_SESSION['idUser'];
}
$product_id=$_POST['product_id'];
$old_cart_quantity=$_POST['oldQte'];
$new_cart_quantity=$_POST['newQte'];

$cart_id=$_POST['cart_num'];


try {

	//echo "UPDATE cart_details SET cart_quantity= $new_cart_quantity WHERE cart_num= $cart_id AND product_num=$product_id";;
	//die();

	$sql="UPDATE cart_details SET cart_quantity= :cart_quantity WHERE cart_num=:cart_num AND product_num=:product_num";
	$stmt=$bdd->prepare($sql);
	$stmt->execute([':cart_quantity' => $new_cart_quantity, ':cart_num' => $cart_id, ':product_num' => $product_id]);

}catch(PDOException $e){
	echo $e->getMessage();
	die();
}
include("../vue/cart_form.php");
?>