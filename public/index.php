<!-- windows + ; = raccourci clavier emojis -->
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Board Games index</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/css/all.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css?var=444">
	<link type="text/css" rel="stylesheet" href="assets/css/lightslider.css" />
	<link rel="icon" type="image/png" href="assets/img/icone.png" />
</head>

<body>

	<?php
	session_start();

	// require '../modele/connexion_bdd.php'; // lie le fichier connexion_bdd à ce fichier
	require '../modele/fonctions.php'; // lie le fichier fonctions à ce fichier
	include ("../vue/header.php");

	if(!isset($_SESSION['idCart'])){
		$_SESSION['idCart'] = NULL;
	}

	// On détermine sur quelle page on se trouve
	if(isset($_GET['page']) && !empty($_GET['page'])){
		$currentPage = (int) strip_tags($_GET['page']);
	}else{
		$currentPage = 1;
	}

	// On détermine le nombre total d'articles dans la bdd
	$result = nbPagination($bdd);

	// On récupère le nombre d'articles
	$nbArticles = (int) $result['nb_articles'];

	// On détermine le nombre d'articles par page
	$parPage = 8;

	// On calcule le nombre de pages total
	$pages = ceil($nbArticles / $parPage);

	// Calcul du 1er article de la page
	$premier = ($currentPage * $parPage) - $parPage;

	// On appelle la fonction affichant dynamiquement les produits
	$products=listProducts($bdd, $premier, $parPage);
	?>

	<div class="clearfix"></div>
	<main class="pt-5">
		<section class="container">
			<!-- <h1>Titre où je sais pas quoi mettre</h1>
			<br> -->
			<article class="row">
				<div class="div-carousel col-12">
					<div id="carouselExampleIndicators" class="carousel slide py-5" data-bs-ride="carousel">
						<div class="carousel-indicators">
							<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
							<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
							<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
							<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
						</div>
						<!-- Carousel -->
						<div class="carousel-inner rounded"> <!-- rounded est une classe bootstrap permettantd'arrondir les angles (remplace border-radius) -->
							<div class="carousel-item active">
								<img src="assets/img/image0.jpg" class="d-block w-100" alt="...">
							</div>
							<div class="carousel-item">
								<img src="assets/img/image1.jpg" class="d-block w-100" alt="...">
							</div>
							<div class="carousel-item">
								<img src="assets/img/image2.jpg" class="d-block w-100" alt="...">
							</div>
							<div class="carousel-item">
								<img src="assets/img/image3.jpg" class="d-block w-100" alt="...">
							</div>
						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
					</div>
				</div>
			</article>
			<article class="py-5 text-white">
				<p class="lead">Lorem ipsum dolor sit amet, <strong class="font-weight-bold">consectetur adipisicing </strong>elit. Explicabo consectetur odio voluptatum facere animi temporibus, distinctio tempore enim corporis quam <strong class="font-weight-bold">recusandae </strong>placeat! Voluptatum voluptate, ex modi illum quas nam distinctio.</p>
				<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			</article>
		</section>
		<div class="clearfix pt-5"></div>
		<section class="container bg-white rounded py-3">
			<article class="row">
				<!-- lightSlider JQuery -->
				<div class="col-12 col-lg-6">
					<div class="m-2">
						<h3 class="bg-info rounded p-1">Nouveautés !</h3>
						<ul id="content-slider2" class="content-slider">
							<li>
								<img src="assets/img/pictures/slider1.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Micro Macro - Crime City - Full House</h5>
								<p>22,50 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider2.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>TerraForming Mars</h5>
								<p>50,00 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider3.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>BrainBox : Harry Potter</h5>
								<p>15,30 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider4.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Pandemic Zone Rouge</h5>
								<p>18,00 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider5.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Charpentiers de la Mer du Nord</h5>
								<p>40,50 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider6.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Complots Faciles</h5>
								<p>29,90 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider7.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Trou Story</h5>
								<p>14,90 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider8.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Frutopia</h5>
								<p>25,00 €</p>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-12 col-lg-6">
					<div class="m-2">
						<h3 class="bg-warning rounded p-1">En promos</h3>
						<ul id="content-slider" class="content-slider">
							<li>
								<img src="assets/img/pictures/slider9.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Cascadia</h5>
								<p>31,50 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider10.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Tabannusi</h5>
								<p>49,50 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider11.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Museum : Pictura</h5>
								<p>44,90 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider12.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Le seigneur des anneaux</h5>
								<p>53,90 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider13.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Dungeon Fighter</h5>
								<p>37,90 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider14.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Get on Board</h5>
								<p>24,90 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider15.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Origins : First Builders</h5>
								<p>42,08 €</p>
							</li>
							<li>
								<img src="assets/img/pictures/slider16.jpg" class="d-block w-100 m-auto" alt="...">
								<h5>Nile Artefacts</h5>
								<p>14,40 €</p>
							</li>
						</ul>
					</div>
				</div>
			</article>
		</section>
		<section class="container">
			<article class="pt-5 text-white">
				<div class="py-5">
					<p class="lead">Lorem ipsum dolor sit amet, <strong class="font-weight-bold">consectetur adipisicing </strong>elit. Explicabo consectetur odio voluptatum facere animi temporibus, distinctio tempore enim corporis quam <strong class="font-weight-bold">recusandae </strong>placeat! Voluptatum voluptate, ex modi illum quas nam distinctio.</p>
					<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				</div>
			</article>
		</section>
		<section class="container">
			<article class="row">

				<!-- Filtre produits -->
				<div>
					<h1>Produits</h1>
					<select class="shopFilter">
						<option value="NULL" selected>Trier les produits par...</option>
						<option value="alphabetical">Ordre alphabétique</option>
						<option value="ascendingPrice">Prix croissant</option>
						<option value="descendingPrice">Prix décroissant</option>
					</select>
				</div>

				<!-- Affichage dynamique des produits -->
				<div id="shop" class="row">
					<?php include('../vue/shop_form.php'); ?>
				</div>

				<!-- Pagination -->
				<nav>
	          <ul class="pagination">
	              <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
	              <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
	                  <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
	              </li>
	              <?php for($page = 1; $page <= $pages; $page++): ?>
	                <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
	                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
	                      <a href="./?page=<?= $page ?>" class="page-link"><?= $page ?></a>
	                  </li>
	              <?php endfor ?>
	                <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
	                <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
	                  <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
	              </li>
	          </ul>
	      </nav>
			</article>
		</section>
		<section class="container bg-white rounded shadow-sm py-3 mt-5 text-center">
			<div>
				<h2 class="py-4">Newsletter</h2>
				<p>Inscrivez-vous à notre newsletter !</p>
				<div class="input-group searchnav newsletter">
					<div class="input-group md-form form-sm form-2 pl-0 my-5 ">
						<input class="form-control my-0 py-2 fst-italic fw-light black-border" type="text" placeholder="Inscription à la newsletter" aria-label="Search">
						<button class="input-group-text black lighten-2 "><i class="far fa-envelope-open"></i></button>
						<!-- btn btn-outline-success pour la class bootstrap du bouton -->
					</div>
				</div>
			</div>
		</section>
		<section class="container">
			<article class="pt-5 text-white">
				<div class="py-5">
					<h3>Avis de nos partenaires</h3>
					<p class="lead">Lorem ipsum dolor sit amet, <strong class="font-weight-bold">consectetur adipisicing </strong>elit. Explicabo consectetur odio voluptatum facere animi temporibus, distinctio tempore enim corporis quam <strong class="font-weight-bold">recusandae </strong>placeat! Voluptatum voluptate, ex modi illum quas nam distinctio.</p>
				</div>
			</article>
		</section>
		<?php
		include ("../vue/footer.php");
		?>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../public/assets/js/jquery-3.6.0.min.js"></script> 
	<script src="../public/assets/js/lightslider.js"></script>
	<script type="text/javascript" src="../public/assets/js/script.js?var=234" defer></script>
	<script type="text/javascript" src="../public/assets/js/ajax.js"></script> 
</body>
</html>


