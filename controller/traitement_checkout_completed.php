<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Board Games checkout completed</title>
    <link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/all.css">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/custom.css?var=444">
    <link type="text/css" rel="stylesheet" href="../public/assets/css/lightslider.css" />
    <link rel="icon" type="image/png" href="../public/assets/img/icone.png" />
</head>


<?php
session_start();
require ('../modele/connexion_bdd.php');

$amount=$_POST['amount'];
$invoice_date=date('Y-m-d G:i:s');

// On vérifie la quantité des produits par rapport au stock disponible :
$sql="SELECT * FROM cart_details INNER JOIN product ON cart_details.product_num=product.product_id WHERE cart_num=:cart_num";
$stmt=$bdd->prepare($sql);
$stmt->execute([':cart_num' => $_SESSION['idCart']]);
$recordset=$stmt->fetchAll();

foreach ($recordset as $product) {

    // Si le stock est suffisant, alors on modifie la quantité...
    if ($product['cart_quantity'] <= $product['product_stock']) {
        $newStock=$product['product_stock']-$product['cart_quantity'];
        $sql="UPDATE product SET product_stock=:product_stock WHERE product_id=:product_id";
        $stmt=$bdd->prepare($sql);
        $stmt->execute([':product_stock' => $newStock, ':product_id' => $product['product_id']]);

    // Sinon, redirection pour signaler que le stock est insuffisant
    }else{
        header("location:../public/index.php");
    }
}

// Requête de validation du panier et création de la ligne INVOICE
$sql="INSERT INTO invoice(invoice_user_id, invoice_cart_id) SELECT cart_user_id, cart_id FROM cart WHERE cart_user_id=:user_id AND cart_id=:cart_id"; // Inner join permet de prendre en jointure tout le contenu des 2 tables qui ont une correspondance et qui n'ont pas une valeur nulle
$stmt=$bdd->prepare($sql);
$stmt->execute([':user_id' => $_SESSION['idUser'], ':cart_id' => $_SESSION['idCart']]);


// On récupère la clé primaire de la dernière requête pour la mettre en session
$_SESSION['idInvoice']=$bdd->lastInsertId();

// On update les valeurs NULL
$sql="UPDATE invoice SET invoice_amount=:invoice_amount, invoice_date=:invoice_date WHERE invoice_user_id=:user_id AND invoice_cart_id=:cart_id";
$stmt=$bdd->prepare($sql);
$stmt->execute([':invoice_amount' => $amount, ':invoice_date' => $invoice_date, ':user_id' => $_SESSION['idUser'], ':cart_id' => $_SESSION['idCart']]);

// On traite ensuite la création de la facture en PDF
header("location:../controller/traitement_order.php");
?>