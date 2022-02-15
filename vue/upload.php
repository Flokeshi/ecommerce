<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Board Games upload</title>
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
	
	if (isset($_SESSION['idUser'])) {
		$req = $bdd->prepare("SELECT * FROM user WHERE user_id = :user_id"); // prepare envoit la requête au système
		$req->execute([":user_id"=>$_SESSION['idUser']]); // affectation du marqueur ":mail" à la variable $email
		$userName = $req->fetch();
	}

	/*requête préparée pour intégrer les catégories au formulaire d'upload*/
    $cat=$bdd->prepare("SELECT * FROM category ORDER BY category_name ASC");
    $cat->execute();
    $categories = $cat->fetchAll();        
    /*Utiliser foreach ensuite avec: foreach ($categories as $category)*/

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
					<a href="../vue/upload.php" class="dashboard-nav-item active"><i class="fas fa-file-upload"></i> Upload </a>
					<div class='dashboard-nav-dropdown'>
						<a href="#!" class="dashboard-nav-item dashboard-nav-dropdown-toggle"><i class="fas fa-photo-video"></i> Media </a>
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
								<h1 style="color:black;">Télécharger un produit</h1>
							</div>
							<div class='card-body'>

								<!-- Télécharger un produit -->
                                <form method="POST" action="../controller/traitement_upload.php" enctype="multipart/form-data">
                                    <table class="table table-bordered text-dark text-center dataTable">
                                        <thead>
                                            <th>Insérez votre illustration</th>
                                            <th>Nom du produit</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="file" name="pictureFile" id="pictureFile">
                                                    <label for="pictureFile">(format jpeg, jpg, png ou gif)</label>
                                                </td>
                                                <td>
                                                    <input type="text" name="productName" placeholder="Nom du produit">
                                                </td>
                                            </tr>
                                            <thead>
                                                <th>Description</th>
                                                <th>Prix</th>
                                            </thead>
                                            <tr>
                                                <td rowspan="5">
                                                    <textarea name="description" placeholder="Description..." style="width:700px;height: 250px;"></textarea>
                                                </td>
                                                <td>
                                                    <input type="number" step="any" name="price" placeholder="Prix du produit">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="thPrice">Catégorie</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select name="category">
                                                        <option value="">Choisissez une catégorie</option>
                                                        <?php foreach ($categories as $category) { ?>
                                                            <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="thStock">Stock disponible</th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="number" step="any" name="stock" placeholder="Stock du produit">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </form>
                                <div>
				                    <?php
				                        if (isset($_GET["uploadSuccess"])) {
				                            if ($_GET["uploadSuccess"] == "upload") {
				                                echo "<div class='alert alert-success'>Upload effectué avec succès !</div>";
				                            }
				                        }
				                        if (isset($_GET["uploadFail"])) {
				                            if ($_GET["uploadFail"] == "upload") {
				                                echo "<div class='alert alert-danger'>Echec de l'upload.</div>";
				                            }
				                        }
				                        if (isset($_GET["uploadError"])) {
				                            if ($_GET["uploadError"] == "upload") {
				                                echo "<div class='alert alert-warning'>Vous devez uploader un fichier de type png, gif, jpg, ou jpeg.</div>";
				                            }
				                        }
				                        if (isset($_GET["deleteSuccess"])) {
				                            if ($_GET["deleteSuccess"] == "delete") {
				                                echo "<div class='alert alert-success'>Le fichier a bien été effacé !</div>";
				                            }
				                        }
				                    ?>
				                </div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
	</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../public/assets/js/jquery-3.6.0.min.js"></script> 
	<script src="../public/assets/js/lightslider.js"></script>
	<script src="../public/assets/js/dashboard.js"></script>
	<script src="../public/assets/js/script.js?var=123" type="text/javascript" defer></script>
	</body>
</html>
