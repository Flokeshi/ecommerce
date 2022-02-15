<?php
require ('../modele/connexion_bdd.php');

$pictureFolder = "../public/assets/img/pictures/";
$picture = basename($_FILES['pictureFile']['name']);
//On fait un tableau contenant les extensions autorisées.
//Comme il s'agit d'une fiche pédagogique pour l'exemple, on ne prend que des extensions d'images et pdf.
$extensionsPictures = array('.png', '.gif', '.jpg', '.jpeg');
//On récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
$extensionPicture = strrchr($_FILES['pictureFile']['name'], '.');

if(!in_array($extensionPicture, $extensionsPictures)) { //Si l'extension n'est pas dans le tableau
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, ou jpeg.';
}

if (!isset($erreur)) {
	//On formate le nom du fichier ici avec les caractères spéciaux...
	$picture = strtr($picture, 
		'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
		'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
	$picture = preg_replace('/([^.a-z0-9]+)/i', '-', $picture);

	if (move_uploaded_file($_FILES['pictureFile']['tmp_name'], $pictureFolder.$picture)) {

		$urlPicture = $pictureFolder.$picture;

		$sql="INSERT INTO product (product_name, product_description, product_price, product_stock, picture_url, product_category_id, added_date) VALUES (:product_name, :description, :price, :stock, :picture, :category, NOW() )";
		$stmt=$bdd->prepare($sql);
		$stmt->execute([':product_name' => $_POST['productName'], ':description' => $_POST['description'], ':price' => $_POST['price'], ':stock' => $_POST['stock'], ':picture' => $urlPicture, ':category' => $_POST['category']]);

		header("Location:../vue/upload.php?uploadSuccess=upload");
	}else{
		header("Location:../vue/upload.php?uploadFail=upload");
	}
}else{
 	/*echo "<div class='alert alert-warning'>".$erreur."</div>";*/
 	header("Location:../vue/upload.php?uploadError=upload");
 }

?>