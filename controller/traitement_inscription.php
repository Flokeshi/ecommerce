<?php
session_start();
require '../modele/connexion_bdd.php'; // lie le fichier connexion_bdd à ce fichier
require '../modele/fonctions.php'; // lie le fichier fonctions à ce fichier

// Récupérer les données saisies dans le formulaire
$nom = checkValid($_POST["nom"]);
$prenom = checkValid($_POST["prenom"]);
$departement = $_POST["departement"];
$ville = $_POST["ville"];
$email = checkValid($_POST["email"]); // prendre l'input "email" situé dans le name de l'input dans inscription.php
$adresse = $_POST["adresse"];
$mot_de_passe = password_hash($_POST['password'], PASSWORD_DEFAULT);
$mot_de_passe2 = $_POST["password2"];
$date_de_naissance = $_POST["date"];
$role="customer";


// On vérifie l'adresse email...
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Si les mots de passe sont identiques :
    if ($_POST['password'] == $mot_de_passe2) {

        // Requête sql pour vérifier si l'adresse email saisie existe déjà.
        if (verifEmailExist($bdd, $email)) {

            // Si oui rediriger vers le formulaire d'inscription et afficher un message informant l'utilisateur que l'email existe déjà
            header("Location:../vue/inscription.php?erreurEmail=erreurs");

        // Si non,
        }else{

            // Requêtes INSERT pour insérer un nouveau user puis son adresse
            $id_user = ajoutUser($bdd, $nom, $prenom, $email, $mot_de_passe, $date_de_naissance, $role);
            ajoutAdresse($bdd, $adresse, $id_user, $ville);

            // redirection vers le formulaire de connexion avec affichage d'un message informant du succès de l'inscription
            header("Location:../vue/inscription.php?validationInscription=erreurs");
        }
                  
    // Sinon (càd si mots de passe pas identiques) redirection vers le formulaire d'inscription et affichage d'un message d'erreur
    }else{
        header("Location:../vue/inscription.php?erreurMessage=erreurs");
    }
}else{
    header("Location:../vue/inscription.php?unvalidEmail=unvalid");
}


    

// Remarque :  1- le département et la ville ne doivent pas être insérés dans les tables departement et ville. Ces dernières
//                doivent être remplies avec les requêtes que je vous ai envoyées par email.
//             2- L'id de la ville sélectionné doit être inséré dans la clé étrangère id_ville de la table adresse
?>