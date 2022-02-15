<?php
/*Démarre la session utilisateur si elle est présente*/
session_start();

/*Connexion à la BDD*/
require ('../modele/connexion_bdd.php');
require '../modele/fonctions.php';

// On détermine sur quelle page on se trouve
	if(isset($_GET['page']) && !empty($_GET['page'])){
		$currentPage = (int) strip_tags($_GET['page']);
	}else{
		$currentPage = 1;
	}

	// On détermine le nombre total d'articles dans la bdd
	$sql = 'SELECT COUNT(*) AS nb_articles FROM product';
	$query = $bdd->prepare($sql);
	$query->execute();
	$result = $query->fetch();

	// On récupère le nombre d'articles
	$nbArticles = (int) $result['nb_articles'];

	// On détermine le nombre d'articles par page
	$parPage = 8;

	// On calcule le nombre de pages total
	$pages = ceil($nbArticles / $parPage);

	// Calcul du 1er article de la page
	$premier = ($currentPage * $parPage) - $parPage;

$value=$_POST['value'];

// Filtre par ordre alphabétique
if ($value=='alphabetical') {
	try {
		if (!isset($_SESSION['idCart'])) {
			$_SESSION['idCart'] = NULL;
		}
		$list = $bdd->prepare("SELECT * FROM product LEFT JOIN cart_details ON product.product_id=cart_details.product_num AND cart_num=:cart_id ORDER BY product_name ASC LIMIT $premier, $parPage");
		$list->execute([':cart_id' => $_SESSION['idCart']]);
		$products = $list->fetchAll(); // on regroupe sous forme de tableau le contenu de la table product dans la variable $products
	}catch(PDOException $e) {
		header("Location:../public/index.php?erreurTechnique=erreurs");
		exit();
	}

// Filtre par prix croissant
}elseif ($value=='ascendingPrice') {
	try {
		if (!isset($_SESSION['idCart'])) {
			$_SESSION['idCart'] = NULL;
		}
		$list = $bdd->prepare("SELECT * FROM product LEFT JOIN cart_details ON product.product_id=cart_details.product_num AND cart_num=:cart_id ORDER BY product_price ASC  LIMIT $premier, $parPage");
		$list->execute([':cart_id' => $_SESSION['idCart']]);
		$products = $list->fetchAll(); // on regroupe sous forme de tableau le contenu de la table product dans la variable $products
	}catch(PDOException $e) {
		header("Location:../public/index.php?erreurTechnique=erreurs");
		exit();
	}

// Filtre par prix décroissant
}elseif ($value=='descendingPrice') {
	try {
		if (!isset($_SESSION['idCart'])) {
			$_SESSION['idCart'] = NULL;
		}
		$list = $bdd->prepare("SELECT * FROM product LEFT JOIN cart_details ON product.product_id=cart_details.product_num AND cart_num=:cart_id ORDER BY product_price DESC  LIMIT $premier, $parPage");
		$list->execute([':cart_id' => $_SESSION['idCart']]);
		$products = $list->fetchAll(); // on regroupe sous forme de tableau le contenu de la table product dans la variable $products
	}catch(PDOException $e) {
		header("Location:../public/index.php?erreurTechnique=erreurs");
		exit();
	}

// Si pas de filtre
}elseif ($value=='NULL') {
	try {
		if (!isset($_SESSION['idCart'])) {
			$_SESSION['idCart'] = NULL;
		}
		$list = $bdd->prepare("SELECT * FROM product LEFT JOIN cart_details ON product.product_id=cart_details.product_num AND cart_num=:cart_id  LIMIT $premier, $parPage");
		$list->execute([':cart_id' => $_SESSION['idCart']]);
		$products = $list->fetchAll(); // on regroupe sous forme de tableau le contenu de la table product dans la variable $products
	}catch(PDOException $e) {
		header("Location:../public/index.php?erreurTechnique=erreurs");
		exit();
	}
}

include("../vue/shop_form.php");
?>