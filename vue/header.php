<?php require ('../modele/connexion_bdd.php'); ?>

<header>
	<nav class="navbar navbar-expand-lg py-3"> <!-- fixed-top -->
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<!-- menu burger -->
					<button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button> 	
					<div id="navbarSupportedContent" class="collapse navbar-collapse userAccount">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<!-- logo -->
								<a href="../public/index.php" class="navbar-brand text-uppercase font-weight-bold logo"><img src="../public/assets/img/logo2.png" id="logo"></a>
							</li>
						</ul>
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<!-- barre de recherche -->
								<div class="input-group searchnav">
									<div class="input-group md-form form-sm form-2">
										<input class="form-control my-0 py-2 fst-italic fw-light black-border" type="text" placeholder="Rechercher un jeu" aria-label="Search">
										<button class="input-group-text black lighten-2"><i class="fas fa-search text-grey" aria-hidden="true"></i></button>
										<!-- btn btn-outline-success pour la class bootstrap du bouton -->
									</div>
								</div>
							</li>
						</ul>
						<ul class="navbar-nav ml-auto">
							<li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold me-5">
								<i class="fas fa-heart"><br></i><p>Favoris</p></a>
							</li>
							<li class="nav-item connexionform">
								<a href="#" class="nav-link text-uppercase font-weight-bold me-5"><i class="fas fa-user"><br></i><p>Compte</p></a>

								<?php
								 if (!isset($_SESSION['idUser'])) { ?> <!-- s'il n'y a pas de session utilisateur, alors on a ce formulaire -->
									<div class="bg-white rounded shadow-lg border-secondary p-3 saisieConnexion" id="popbox">
										<form method="post" action="../controller/traitement_connexion.php">
											<p class="saisieConnexion"><strong>Se connecter</strong></p>
											<input class="input-group py-1 fw-light black-border saisieConnexion" type="email" name="email" placeholder="Votre e-mail" aria-label="e-mail" id="inputMail" required><br>
											<input class="py-1 fw-light black-border saisieConnexion" type="password" name="mdp" placeholder="Mot de passe" aria-label="mot de passe" id="inputPwd" required>
											<div class="btn btn-secondary d-inline black lighten-2 saisieConnexion" onclick="accesPassword();"><i class="far fa-eye" id="hidePwd"></i></div>
											<div class="text-start saisieConnexion">
												<a class="black lighten-2 my-3" href="../vue/password_forgot_page.php"><small>Mot de passe oublié ?</small></a>
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
									</div>
								<?php }else{ ?> <!-- si on a un utilisateur de connecté, alors on a ce formulaire -->
									<div class="bg-white rounded border-secondary shadow-lg p-3" id="account">
										<ul class="list-group">
											<li class="dropdown-item"><a href="../vue/account.php" class="text-dark text-start text-decoration-none">Mon profil</a></li>
											<li class="dropdown-item"><a href="../vue/orders.php" class="text-dark text-decoration-none">Mes commandes</a></li>
											<?php
											if ($_SESSION['roleUser']=="admin") { ?>
											 	<li class="dropdown-item"><a href="../vue/dashboard.php" class="text-dark text-decoration-none">Panel admin</a></li>
											<?php } ?>
											<li class="dropdown-item"><a href="../controller/traitement_deconnexion.php" class="text-dark text-decoration-none">Déconnexion</a></li>
										</ul>
									</div>
								<?php } ?>

							</li>
							<li class="nav-item cartform">
								<a href="../vue/cart_page.php" class="nav-link text-uppercase font-weight-bold me-5"><i class="fas fa-shopping-cart"><br></i><p>Panier</p></a>
								<!-- <div class="bg-white rounded border-secondary shadow-lg p-3" id="cart">
									<?php //include("../vue/cart_form.php"); ?> 
								</div> -->
							</li>
						</ul>
					</div>
				</div>
				<!-- Catégories -->
				<div id="navbarSupportedContent" class="collapse navbar-collapse categories mt-3">
					<!-- <ul class="navbar-nav ml-auto ">
						<li class="nav-item active"><a href="#" class="nav-link text-uppercase font-weight-bold"><u>Accueil</u><span class="sr-only">(current)</span></a></li>
					</ul> -->
					<ul class="navbar-nav ml-auto ">
						<li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">Jeux d'ambiance</a></li>
					</ul>
					<ul class="navbar-nav ml-auto ">
						<li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">Jeux de cartes</a></li>
					</ul>
					<ul class="navbar-nav ml-auto ">
						<li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">Jeux de plateau</a></li>
					</ul>
					<ul class="navbar-nav ml-auto ">
						<li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">Jeux de réflexion</a></li>
					</ul>
					<ul class="navbar-nav ml-auto ">
						<li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">Jeux de rôle</a></li>
					</ul>
				</div>
			</div>
		</div>	
	</nav>
</header>