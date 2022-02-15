<?php
session_start();
require '../modele/connexion_bdd.php'; // lie le fichier connexion_bdd à ce fichier
require '../modele/fonctions.php'; // lie le fichier fonctions à ce fichier

$email = checkValid($_POST["email"]); // prendre l'input "email" situé dans le name de l'input dans index.php
$mot_de_passe = $_POST["mdp"];

if (verifUserExist($bdd, $email, $mot_de_passe)) { // Si un résultat est trouvé, redirection vers accueil.php

	if (isset($_SESSION['idCart'])){
			$sql="UPDATE cart SET cart_user_id=:user_id WHERE cart_id =:cart_id";
			$req= $bdd->prepare($sql);
			$req->execute([":user_id"=>$_SESSION['idUser'], ":cart_id"=>$_SESSION['idCart']]);
		};
	header("Location:../public/index.php");
}else{ // Si aucun résultat n'est trouvé, redirection vers index.php
	header("Location:../public/index.php?erreurMessage=erreurs");
}

?>