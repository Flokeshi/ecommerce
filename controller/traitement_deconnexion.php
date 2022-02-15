<?php
session_start();
session_destroy(); 
// Ne pas oublier d'appliquer le code suivant sur toutes les pages qui nécessitent une connexion :
// if (!isset($_SESSION['idUser'])) { //vérification de la session existante, sinon déconnexion
			//header('Location: ../public/index.php');}
header("Location:../public/index.php");
?>