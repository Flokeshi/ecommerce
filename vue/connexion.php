<!-- windows + ; = raccourci clavier emojis -->
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Board Games index</title>
	<link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="../public/assets/css/all.css">
	<link rel="stylesheet" type="text/css" href="../public/assets/css/custom.css?var=444">
	<link type="text/css" rel="stylesheet" href="../public/assets/css/lightslider.css" />
	<link rel="icon" type="image/png" href="../public/assets/img/icone.png" />
</head>

<body>
	<?php
	session_start();
	include ("../vue/header.php");
	?>
	<section class="container">
		<article class="bg-white rounded shadow container text-center position-absolute top-50 start-50 translate-middle w-50 mt-5">
			<form method="post" action="../controller/traitement_connexion.php">
				<h3 class="py-3">Se connecter</h3>
				<div class="justify-content-center">
					<input class="py-1 my-2 fw-light black-border Connexion" type="email" name="email" placeholder="Votre e-mail" aria-label="e-mail" id="inputMail2" required required pattern='/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'><br>
					<input class="py-1 my-2 fw-light black-border" type="password" name="mdp" placeholder="Mot de passe" aria-label="mot de passe" id="inputPwd2" required>
					<div class="btn btn-secondary d-inline black lighten-2" onclick="accesPassword2();"><i class="far fa-eye" id="hidePwd2"></i></div>
				</div>
				<div class="text-start text-center py-3">
					<a class="black lighten-2 my-3" href=""><small>Mot de passe oublié ?</small></a>
				</div>
				<?php
				if (isset($_GET["erreurMessage"])) {
					if ($_GET["erreurMessage"] == "erreurs") {
						echo "<div class='alert alert-danger'>Vos identifiants sont incorrects</div>";
					}
				}
				if (isset($_GET["erreurTechnique"])) {
					if ($_GET["erreurTechnique"] == "erreurs") {
						echo "<div class='alert alert-danger'>Une erreur technique est survenue.</div>";
					}
				}
				?>
				<div>
					<button class="input-group-text d-inline black lighten-2 my-3"><h6>Connexion</h6></button>
				</div>
				<div>
					<small><p>Pas encore de compte ? <a class="black" href="../vue/inscription.php">Inscrivez-vous</a></p></small>
				</div>
			</form>
		</article>
	</section>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../public/assets/js/jquery-3.6.0.min.js"></script> 
	<script src="../public/assets/js/lightslider.js"></script>
	<script src="../public/assets/js/script.js?var=234" type="text/javascript" defer></script>
</body>