<?php
/*Démarre la session utilisateur si elle est présente*/
session_start();

/*Connexion à la BDD*/
require ('../modele/connexion_bdd.php');

if (isset($_SESSION['idUser'])) {
	$user_id=$_SESSION['idUser'];
}
if (isset($_SESSION['idCart'])) {
	$cart_id=$_SESSION['idCart'];
}
$cart_quantity=$_POST['qte'];
$cart_date=date('Y-m-d G:i:s');

try {
	/*Requête SQL qui récupère les données 'cart_id' et 'product_num' de $.post de qte_cart_jquery.js*/
	$sql="SELECT * FROM cart_details WHERE cart_num=:cart_num AND product_num=:product_num"; // $_SESSION['user_id']
	$stmt=$bdd->prepare($sql);
	$stmt->execute([':cart_num' => $cart_id, ':product_num' => $_POST['product_id']]);

	/*Envoyer la requête SQL à la BDD*/
	$sql="DELETE FROM cart_details WHERE cart_num=:cart_num AND product_num=:product_num";
	$stmt=$bdd->prepare($sql);
	$stmt->execute([':cart_num' => $cart_id, ':product_num' => $_POST['product_id']]);

	include("../vue/cart_form.php");
}catch(PDOException $e){
	echo $e->getMessage();
	die();
}
?>