<?php
/*Connexion à la BDD*/
require ('../modele/connexion_bdd.php');
require ('../modele/fonctions.php'); 

$user_lastname=checkValid($_POST['lastname']);
$user_firstname=checkValid($_POST['firstname']);
$user_birthday=$_POST['birth'];
$user_email=checkValid($_POST['email']);
$user_id=$_POST['idUser'];

// Requête sql pour vérifier si l'adresse email saisie existe déjà.
if (verifEmailExist2($bdd, $user_email, $user_id)) {

    // Si oui rediriger vers le formulaire d'informations et afficher un message informant l'utilisateur que l'email existe déjà
    header("Location:../vue/account.php?erreurEmail=erreurs");

// Si non,
}else{
	$sql="UPDATE user SET user_lastname=:user_lastname, user_firstname=:user_firstname, user_email=:user_email, user_birthday=:user_birthday WHERE user_id=:user_id";
	$stmt=$bdd->prepare($sql);
	$stmt->execute([':user_lastname' => $user_lastname, ':user_firstname' => $user_firstname, ':user_email' => $user_email, ':user_birthday' => $user_birthday, ':user_id' => $user_id]);    

    // redirection vers le formulaire de connexion avec affichage d'un message informant du succès de l'inscription
    header("Location:../vue/account.php?validationModification=ok");
}
?>