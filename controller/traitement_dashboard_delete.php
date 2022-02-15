<?php
/*Démarre la session utilisateur si elle est présente*/
session_start();

/*Connexion à la BDD*/
require ('../modele/connexion_bdd.php');

try {
	unlink($_POST['picture']); //Supprime l'image à l'adresse indiquée...

	/*Envoyer la requête SQL à la BDD*/
	$sql="DELETE FROM cart_details WHERE product_num=:product_id";
	$stmt=$bdd->prepare($sql);
	$stmt->execute([':product_id' => $_POST['id']]);

	$sql="DELETE FROM product WHERE product_id=:product_id";
	$stmt=$bdd->prepare($sql);
	$stmt->execute([':product_id' => $_POST['id']]);

	include("../vue/dashboard_data.php");	
}catch(PDOException $e){
	echo $e->getMessage();
	die();
}
?>