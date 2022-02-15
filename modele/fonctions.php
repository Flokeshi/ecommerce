<?php

function verifUserExist($bdd, $email, $mot_de_passe) {
	try {
		$req = $bdd->prepare("SELECT * FROM user WHERE user_email = :mail"); // prepare envoit la requête au système
		$req->execute([":mail"=>$email]); // affectation des marqueurs ":mail" et ":pwd" aux variables
		$resUserExist = $req->fetch();

		if ($resUserExist) { // Si un résultat est trouvé, TRUE
			if (password_verify($mot_de_passe, $resUserExist['user_password'])==true) {
				$_SESSION['idUser'] = $resUserExist['user_id'];
				$_SESSION['roleUser'] = $resUserExist['user_role'];
				return TRUE;
			}else{
				return FALSE;
			}
		}else{ // Si aucun résultat n'est trouvé, FALSE
			return FALSE;
		}

	}catch(PDOException $e) {
		header("Location:../public/index.php?erreurMessage=erreurs");
		exit();
	}
}

// fetch permet de récupérer un résultat sous forme de tableau associatif et les noms des attributs récupérés dans le SELECT seront les clés de ce tableau; 
// EXEMPLE : ['id_user'=>1, 'nom_user'=>'le nom']
// Pour afficher le nom du user : echo $resUserExist['nom_user'];
// si aucun résultat n'est trouvé, fetch retourne FALSE;

// fetchAll permet de récupérer 0 ou plusieurs résultats sous forme de tableau associatif et les noms des attrivuts récupérés dans le SELECT seront les clés de ce tableau;
// EXEMPLE : [['id_user'=>1, 'nom_user'=>'le nom1'], ['id_user'=>6, 'nom_user'=>'le nom2']];
// Pour afficher le nom du premier résultat : echo $resUserExist[0]['nom_user'];
// si aucun résultat n'est trouvé, fetchAll retourne un tableau vide;

function verifEmailExist($bdd, $email) {
	try {
		$req = $bdd->prepare("SELECT * FROM user WHERE user_email = :mail"); // prepare envoit la requête au système
		$req->execute([":mail"=>$email]); // affectation du marqueur ":mail" à la variable $email
		$resEmailExist = $req->fetch();

		if ($resEmailExist) { // Si un résultat est trouvé, TRUE
			return TRUE;
		}else{ // Si aucun résultat n'est trouvé, FALSE
			return FALSE;
		}
	}catch(PDOException $e) {
		header("Location:../vue/inscription.php?erreurTechnique=erreurs");
		exit();
	}
}

function ajoutUser($bdd, $nom, $prenom, $email, $mot_de_passe, $date_de_naissance, $role) {
	try{ // ...on ajoute le user
		$regUser = $bdd->prepare("INSERT INTO user(user_lastname, user_firstname, user_email, user_password, user_birthday, user_role) VALUES(:nom_user, :prenom_user, :mail_user, :mdp_user, :date_naissance_user, :user_role)");
		$regUser->execute([':nom_user' => $nom, ':prenom_user' => $prenom, ':mail_user' => $email, ':mdp_user' => $mot_de_passe, ':date_naissance_user' => $date_de_naissance, ':user_role' => $role]);
		$iduser = $bdd->lastInsertId(); 
	}catch(PDOException $e) {
		header("Location:../vue/inscription.php?erreurTechnique=erreurs");
	exit();
	}
	return $iduser;
}

function ajoutAdresse($bdd, $adresse, $id_user, $ville) {
	try{ 
		$regUser = $bdd->prepare("INSERT INTO adresse(adresse, id_user, id_ville) VALUES(:adresse, :id_user, :id_ville)");
		$regUser->execute([':adresse' => $adresse, ':id_user' => $id_user, ':id_ville' => $ville]);
	}catch(PDOException $e) {
		header("Location:../vue/inscription.php?erreurTechnique=erreurs");
		exit();
	}
}

function listDpt ($bdd) { // sert à afficher les départements dans les options du Select (name=departement)
	try {
		$req = $bdd->prepare('SELECT * FROM departement ORDER BY departement');
		$req->execute();
		$departements = $req->fetchAll(); // on regroupe sous forme de tableau le contenu de la table departement dans la variable $departements
	}catch(PDOException $e) {
		header("Location:../vue/inscription.php?erreurTechnique=erreurs");
		exit();
	}
	return $departements;
}

function listVilles ($bdd) { // sert à afficher les villes dans les options du Select (name=ville)
	try {
		$req = $bdd->prepare('SELECT * FROM ville');
		$req->execute();
		$villes = $req->fetchAll(); // on regroupe sous forme de tableau le contenu de la table ville dans la variable $villes
	}catch(PDOException $e) {
		header("Location:../vue/inscription.php?erreurTechnique=erreurs");
		exit();
	}
	return $villes;
}

function listProducts($bdd, $premier, $parPage) {
	try {
		$list = $bdd->prepare("SELECT * FROM product LEFT JOIN cart_details ON product.product_id=cart_details.product_num AND cart_num=:cart_id LIMIT $premier, $parPage");
		$list->execute([':cart_id' => $_SESSION['idCart']]);
		$products = $list->fetchAll(); // on regroupe sous forme de tableau le contenu de la table product dans la variable $products
	}catch(PDOException $e) {
		header("Location:../public/index.php?erreurTechnique=erreurs");
		exit();
	}
	return $products;
}

function verifEmailExist2($bdd, $email, $id) {
	try {
		$req = $bdd->prepare("SELECT * FROM user WHERE user_email = :user_email"); // prepare envoit la requête au système
		$req->execute([":user_email"=>$email]); // affectation du marqueur ":mail" à la variable $email
		$resEmailExist = $req->fetch();

		if ($resEmailExist && $id!=$resEmailExist['user_id']) { // Si un résultat est trouvé, TRUE
			return TRUE;
		}else{ // Si aucun résultat n'est trouvé, FALSE
			return FALSE;
		}
	}catch(PDOException $e) {
		header("Location:../vue/account.php?erreurTechnique=erreurs");
		exit();
	}
}

// Fonction de vérification des 'string' saisies par le user lors des UPDATE ou des INSERT INTO
function checkValid($donnees) {
	$donnees = trim($donnees); // supprime les espaces en début et fin de chaîne
    $donnees = stripslashes($donnees); // supprime les antislashs d'une chaîne
    $donnees = htmlspecialchars($donnees); // convertit les caractères spéciaux en entités HTML
    $donnees = htmlentities($donnees); // convertit les caractères éligibles en entités HTML
    return $donnees;
}

function nbPagination($bdd) {
	$sql = 'SELECT COUNT(*) AS nb_articles FROM product';
	$query = $bdd->prepare($sql);
	$query->execute();
	$result = $query->fetch();
	return $result;
}

?>