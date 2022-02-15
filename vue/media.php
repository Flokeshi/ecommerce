<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Board Games media</title>
		<link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap-icons.css">
		<link rel="stylesheet" type="text/css" href="../public/assets/css/all.css">
		<link rel="stylesheet" type="text/css" href="../public/assets/css/custom.css">
		<link rel="stylesheet" type="text/css" href="../public/assets/css/dashboard.css">
		<link type="text/css" rel="stylesheet" href="../public/assets/css/lightslider.css" />
		<link rel="icon" type="image/png" href="../public/assets/img/icone.png" />
	</head>
	<body>
	<?php
	session_start();
	require '../modele/connexion_bdd.php'; // lie le fichier connexion_bdd à ce fichier
	require '../modele/fonctions.php'; // lie le fichier fonctions à ce fichier

	if (!isset($_SESSION['roleUser'])) {
		$_SESSION['roleUser']=NULL;
	}
	?>

	<main>
		<?php if (isset($_SESSION['idUser']) || $_SESSION['roleUser']=='admin') { ?>
		<div class='dashboard'>
			<div class="dashboard-nav">
				<header>
					<a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
					<a href="../public/index.php" class="brand-logo" style="width:50px; position: absolute; left:0px;"><img src="../public/assets/img/logo1.png" id="logo"></a>
				</header>
				<nav class="dashboard-nav-list">
					<a href="../public/index.php" class="dashboard-nav-item"><i class="fas fa-home"></i> Home </a>
					<a href="../vue/dashboard.php" class="dashboard-nav-item"><i class="fas fa-tachometer-alt"></i> Dashboard </a>
					<a href="../vue/upload.php" class="dashboard-nav-item"><i class="fas fa-file-upload"></i> Upload </a>
					<div class='dashboard-nav-dropdown'>
						<a href="#!" class="dashboard-nav-item active dashboard-nav-dropdown-toggle"><i class="fas fa-photo-video"></i> Media </a>
						<div class='dashboard-nav-dropdown-menu'><a href="../vue/media.php" class="dashboard-nav-dropdown-item">All</a><a href="#" class="dashboard-nav-dropdown-item">Recent</a><a href="#" class="dashboard-nav-dropdown-item">Images</a><a href="#" class="dashboard-nav-dropdown-item">Video</a></div>
					</div>
					<div class='dashboard-nav-dropdown'>
						<a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-users"></i> Users </a>
						<div class='dashboard-nav-dropdown-menu'><a href="../vue/users.php" class="dashboard-nav-dropdown-item">All</a><a href="#" class="dashboard-nav-dropdown-item">Subscribed</a><a href="#" class="dashboard-nav-dropdown-item">Non-subscribed</a><a href="#" class="dashboard-nav-dropdown-item">Banned</a><a href="#" class="dashboard-nav-dropdown-item">New</a></div>
					</div>
					<div class='dashboard-nav-dropdown'>
						<a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-money-check-alt"></i> Payments </a>
						<div class='dashboard-nav-dropdown-menu'><a href="#" class="dashboard-nav-dropdown-item">All</a><a href="#" class="dashboard-nav-dropdown-item">Recent</a><a href="#" class="dashboard-nav-dropdown-item"> Projections</a>
						</div>
					</div>
					<a href="#" class="dashboard-nav-item"><i class="fas fa-cogs"></i> Settings </a>
					<a href="#" class="dashboard-nav-item"><i class="fas fa-user"></i> Profile </a>
					<div class="nav-item-divider"></div>
					<a href="../controller/traitement_deconnexion.php" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i> Logout </a>
				</nav>
			</div>
			<div class='dashboard-app'>
				<header class='dashboard-toolbar'><a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a></header>
				<div class='dashboard-content'>
					<div class='container'>
						<div class='card'>
							<div class='card-header'>
								<h1 style="color:black;">Gestion des produits</h1>
							</div>
							<div class='card-body'>
								<div class="col-lg-12">
				                    <table id="datatable" class="table table-bordered table-hover">
				                        <thead>
				                            <tr>
				                                <th>Page</th>
				                                <th>Catégorie</th>
				                                <th>Image</th>
				                                <th>Nom</th>
				                                <th>Description</th>
				                                <th>Prix</th>
				                                <th>Actions</th>
				                            </tr>
				                        </thead>
				                        <tbody id="dashboard">

				                            <?php include("../vue/dashboard_data.php");?>

				                        </tbody>
				                        <tfoot>
				                            <tr>
				                                <th>Page</th>
				                                <th>Catégorie</th>
				                                <th>Image</th>
				                                <th>Nom</th>
				                                <th>Description</th>
				                                <th>Prix</th>
				                                <th>Actions</th>
				                            </tr>
				                        </tfoot>
				                    </table>
				                </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
	</main>
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script> -->
	<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../public/assets/js/jquery-3.6.0.min.js"></script> 
	<script src="../public/assets/js/lightslider.js"></script>
	<script src="../public/assets/js/dashboard.js"></script>
	<script src="../public/assets/js/ajax.js" type="text/javascript"></script>
	<script src="../public/assets/js/script.js?var=123" type="text/javascript" defer></script>
	</body>
</html>
