<?php
/*Connexion à la BDD*/
require ('../modele/connexion_bdd.php');
require ('../modele/fonctions.php'); 

$oldpwd=$_POST['oldPassword'];
$pwd=password_hash($_POST['password1'], PASSWORD_DEFAULT);
$pwd2=$_POST['password2'];
$user_id=$_POST['idUser'];


if ($_POST['password1'] == $_POST['password2']) {

    // Requête sql pour vérifier si l'ancien password est bien identique
    $sql="SELECT * FROM user WHERE user_id=:user_id";
    $stmt=$bdd->prepare($sql);
    $stmt->execute([':user_id' => $user_id]); 
    $row = $stmt->fetch();


    if (password_verify($oldpwd, $row['user_password'])==false) {
        
        // Si l'ancien password n'est pas identique à celui enregistré...
        header("Location:../vue/account.php?oldPwd=erreurs");

    // Sinon,
    }else{
        $sql="UPDATE user SET user_password=:user_password WHERE user_id=:user_id";
        $stmt=$bdd->prepare($sql);
        $stmt->execute([':user_password' => $pwd, ':user_id' => $user_id]);     

        // redirection vers la page utilisateur avec affichage d'un message informant du succès de la modification
        header("Location:../vue/account.php?validationModification=ok");
    }
              
// Sinon (càd si mots de passe pas identiques) redirection vers la page utilisateur et affichage d'un message d'erreur
}else{
    header("Location:../vue/account.php?erreurPwd=erreurs");
}
?>