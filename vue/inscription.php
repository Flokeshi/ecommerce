<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Board Games inscription</title>
		<link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap-icons.css">
		<link rel="stylesheet" type="text/css" href="../public/assets/css/all.css">
		<link rel="stylesheet" type="text/css" href="../public/assets/css/custom.css">
		<link type="text/css" rel="stylesheet" href="../public/assets/css/lightslider.css" />
		<link rel="icon" type="image/png" href="../public/assets/img/icone.png" />
	</head>
	<body>
		<?php
		session_start();
		require '../modele/connexion_bdd.php'; // lie le fichier connexion_bdd à ce fichier
		require '../modele/fonctions.php'; // lie le fichier fonctions à ce fichier
		$departements=listDpt($bdd); // Appelle la fonction listeDpt dans la variable correspondante pour le Select departement
		$villes=listVilles($bdd); // Appelle la fonction listVilles dans la variable correspondante pour le Select ville
		?>
		<main>
			<section class="container">
				<article class="bg-white rounded shadow container text-center position-absolute top-50 start-50 translate-middle w-50">
					<form method="post" action="../controller/traitement_inscription.php" class="connexion mt-3">
						<h3 class="py-3 pt-4">Veuillez renseigner les champs suivants</h3>
						<div class="justify-content-center">
							<ul class="d-inline-block left"><br>
								<li class="nav-link"><label for="name">Votre nom</label></li>
								<li class="nav-link"><label for="prenom">Votre prénom</label></li>
								<li class="nav-link"><label for="email">Votre e-mail</label></li>
								<li class="nav-link"><label for="adresse">Votre adresse</label></li>
								<li class="nav-link"><label for="departement">Votre département</label></li>
                                <li class="nav-link"><label for="ville">Votre ville</label></li>
								<li class="nav-link"><label for="password">Votre mot de passe</label></li>
								<li class="nav-link"><label for="password2">Confirmation du mot de passe</label></li>
								<li class="nav-link"><label for="date">Votre date de naissance</label></li>
							</ul>
							<ul class="d-inline-block right">
								<li class="m-2"><input type="name" name="nom" id="name" placeholder="Nom" required></li>
								<li class="m-2"><input type="name" name="prenom" id="prenom" placeholder="Prénom" required></li>
								<li class="m-2"><input type="email" name="email" id="email" placeholder="Adresse e-mail" required pattern='/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/'></li>
								<li class="m-2"><input type="text" name="adresse" id="adresse" placeholder="Adresse postale" required></li>
								<li class="m-2">
									<select name="departement" id="departement" onchange="selectDpt(this.value)">
										<option value="">Sélectionner un département</option>
										<!-- récupérer dynamiquement les département de la base de données et les afficher ici dans les options -->
										<?php // select qui contient les departements
										foreach ($departements as $departement) {
											echo '<option value="'.$departement["id_departement"].'">'.$departement["departement"]." (".$departement["code"].') </option>';
										}
										?>
									</select>
                                </li>
                                <li class="m-2">
                                	<select name="ville" id="ville">
                                		<option value="">Sélectionner une ville</option>
                                		<?php // select qui contient les villes
                                		foreach ($villes as $ville) {
                                			echo '<option value="'.$ville["id_ville"].'">'.$ville["ville"]." (".$ville["cp"].') </option>';
                                		}
                                		?>
                                	</select>
                                </li>
								<li class="m-2"><input type="password" name="password" id="password" placeholder="Mot de passe" required></li>
								<li class="m-2"><input type="password" name="password2" id="password2" placeholder="Confirmation du mot de passe" required></li>
								<li class="mt-2"><input type="date" name="date" id="date" placeholder="Date de naissance"></li>
							</ul>
						</div><br>
						<?php
						if (isset($_GET["erreurMessage"])) {
							if ($_GET["erreurMessage"] == "erreurs") {
								echo "<div class='alert alert-danger'>Vos mots de passe ne sont pas identiques.</div>";
							}
						}
						if (isset($_GET["erreurEmail"])) {
							if ($_GET["erreurEmail"] == "erreurs") {
								echo "<div class='alert alert-danger'>L'adresse e-mail existe déjà.</div>";
							}
						}
						if (isset($_GET["erreurTechnique"])) {
							if ($_GET["erreurTechnique"] == "erreurs") {
								echo "<div class='alert alert-danger'>Une erreur technique est survenue. Veuillez réessayer.</div>";
							}
						}
						if (isset($_GET["validationInscription"])) {
							if ($_GET["validationInscription"] == "erreurs") {
								echo "<div class='alert alert-success'>Votre inscription a bien été enregistrée.</div>";
							}
						}
						if (isset($_GET["unvalidEmail"])) {
					        if ($_GET["unvalidEmail"] == "unvalid") {
					            echo "<div class='alert alert-warning'>Merci de renseigner une adresse email valide.</div>";
					        }
					    }
						?>
						<label for="inscription"></label>
						<input type="submit" value="Inscription" name="inscription" id="inscription" class="btn btn-secondary mb-4">
					</form>
					<div class="pb-4">
						<a href="../public/index.php" class="my-5">Retour à l'accueil</a>
					</div>
				</article>
			</section>
		</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../public/assets/js/jquery-3.6.0.min.js"></script> 
	<script src="../public/assets/js/lightslider.js"></script>
	<script src="../public/assets/js/script.js?var=123" type="text/javascript" defer></script>
	</body>
</html>
