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
	// Si le panier existe...
	if(isset($_SESSION['idCart'])){
		/* On interroge la BDD pour récupérer les données 'product_id' et 'cart_quantity' de $.post de qte_cart_jquery.js*/
		$sql="SELECT * FROM cart_details WHERE cart_num=:cart_num AND product_num=:product_num";
		$stmt=$bdd->prepare($sql);
		$stmt->execute([':cart_num' => $cart_id, ':product_num' => $_POST['product_id']]);


		// Si le produit est déjà dans le panier
		if ($row=$stmt->fetch()) {
			if ($cart_quantity>0) {
			$sql="UPDATE cart_details SET cart_quantity= cart_quantity + :cart_quantity WHERE cart_num=:cart_num AND product_num=:product_num";
			$stmt=$bdd->prepare($sql);
			$stmt->execute([':cart_quantity' => $cart_quantity, ':cart_num' => $cart_id, ':product_num' => $_POST['product_id']]);
			}else{
				$sql="DELETE FROM cart_details WHERE cart_num=:cart_num AND product_num=:product_num";
				$stmt=$bdd->prepare($sql);
				$stmt->execute([':cart_num' => $cart_id, ':product_num' => $_POST['product_id']]);
			}

		// Sinon, si le produit n'est pas encore dans le panier	
		}else{
			$sql="INSERT INTO cart_details (cart_quantity, cart_num, product_num) VALUES (:cart_quantity, :cart_num, :product_num)";
			$stmt=$bdd->prepare($sql);
			$stmt->execute([':cart_quantity' => $cart_quantity, ':cart_num' => $_SESSION['idCart'], ':product_num' => $_POST['product_id']]);
		}
		// Mettre à jour (UPDATE) le montant (amount) du panier


	// Sinon, si le panier n'existe pas...
	}else{

		// Si l'utilisateur est identifié
		if (isset($_SESSION['idUser'])) {

			// Créer le panier dans la table panier avec le user_id
			$sql="INSERT INTO cart (cart_date, cart_user_id) VALUES (:cart_date, :cart_user_id)";
			$stmt=$bdd->prepare($sql);
			$stmt->execute([':cart_date' => $cart_date, ':cart_user_id' => $user_id]);

		// Sinon, si l'utilisateur n'est pas identifié
		}else{
			// Créer le panier dans la table panier sans le user_id
			$sql="INSERT INTO cart (cart_date) VALUES (:cart_date)";
			$stmt=$bdd->prepare($sql);
			$stmt->execute([':cart_date' => $cart_date]);
		}

		// On récupère le dernier cart_id inséré dans la BDD pour le mettre dans une variable de session
		$_SESSION['idCart'] = $bdd->lastInsertId();

		// Puis on insère le produit ajouté au panier dans la table cart_details
		$sql="INSERT INTO cart_details (cart_quantity, cart_num, product_num) VALUES (:cart_quantity, :cart_num, :product_num)";
		$stmt=$bdd->prepare($sql);
		$stmt->execute([':cart_quantity' => $cart_quantity, ':cart_num' => $_SESSION['idCart'], ':product_num' => $_POST['product_id']]);
	}
}catch(PDOException $e){
	echo $e->getMessage();
	die();
}
include("../vue/cart_form.php");
?>