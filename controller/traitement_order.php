0<?php
/*Démarre la session utilisateur si elle est présente*/
session_start();

/*Connexion à la BDD*/
require ('../modele/connexion_bdd.php');
require '../vendor/autoload.php';


$invoice_id=$_SESSION['idInvoice'];
$sql="SELECT * FROM invoice INNER JOIN cart ON invoice.invoice_cart_id=cart.cart_id INNER JOIN cart_details ON cart.cart_id=cart_details.cart_num INNER JOIN product ON cart_details.product_num=product.product_id INNER JOIN user ON invoice.invoice_user_id=user.user_id WHERE invoice_id=:invoice_id";
$stmt=$bdd->prepare($sql);
$stmt->execute([':invoice_id' => $invoice_id]);
$recordset=$stmt->fetchAll();
$total=0;


ob_start();
?>
<style>
    .customerAddress {
    	font-family:"Helvetica";
    	font-size:10rem;
    	padding-left:30px;
    }
    .websiteAddress {
    	font-family: "Helvetica";
    	font-size:10rem;
    	padding-left:450px;
    }
    .border th {
        border: 1px solid #000;  
        color: white; 
        background: #000; 
        padding: 5px; 
        font-weight: normal; 
        font-size: 14px; 
        text-align: center;
    }
    .border td {
        border: 1px solid #CFD1D2; 
        padding: 5px 10px; 
        text-align: center;
    }
    .no-border { 
        border-right: 1px solid #CFD1D2; 
        border-left: none; 
        border-top: none; 
        border-bottom: none;
    }
    .space { padding-top: 250px; }
 
    .10p { width: 10%; } .15p { width: 15%; } 
    .25p { width: 25%; } .50p { width: 50%; } 
    .60p { width: 60%; } .75p { width: 75%; }

</style>

<page backtop='10mm' backleft='20mm' backright='10mm' backbottom='10mm' footer='page;'>
    <page_header>
        <table class='customerAddress'>
            <tr>
                <td><?=$recordset[0]['user_firstname'].' '.$recordset[0]['user_lastname']?></td>
            </tr>
            <tr>
                <td>Tél. : <?=$recordset[0]['user_phone']?></td>
            </tr>
            <tr>
                <td>Mail : <?=$recordset[0]['user_email']?></td>
            </tr>
        </table>
        <table class='websiteAddress'>
            <tr>
                <td>Boardgames</td>
            </tr>
            <tr>
                <td>01 Rue des Jeux de Société</td>
            </tr>
            <tr>
                <td>75001 Paris Cedex</td>
            </tr>
            <tr>
                <td>CEDEX 75035</td>
            </tr>
        </table>
        <table style="padding-left:30px;padding-top:30px;padding-bottom:15px;">
            <tr>
                <td>Facture n°<?=$invoice_id?></td>
            </tr>
            <tr>
                <td>Date de la commande : <?=($recordset[0]['invoice_date'])?></td>
            </tr>
        </table>
        <table class="border" style="width: 100%;padding-left:10px;padding-top:15px;padding-bottom:15px;">
            <thead>
                <tr style="background-color:black;color:white">
                    <td style="width:15%;border-left:.2px solid grey;">Nom</td>
                    <td style="width:15%;">Prix unitaire</td>
                    <td style="width:30%;">Quantité</td>
                    <td style="width:15%;border-right:.2px solid grey;">  Montant TTC</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recordset as $row) { ?>
                <tr style="background-color:grey;color:white;">
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['product_price']; ?> €</td>
                    <td><?php echo $row['cart_quantity']; ?></td>
                    <td><?php echo $row['cart_quantity']*$row['product_price']; ?> €</td>
                </tr>
                <?php
                $total=$total+$row['cart_quantity']*$row['product_price'];
                 }?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" style="width:70%;" class="no-border"></td>
                    <td style="width:15%">TOTAL : </td>
                    <td style="width:15%;border:.2px solid grey;height:25px;text-align:center;"><?=$total;?> €</td>
                </tr>
            </tfoot>
        </table>
    </page_header>
    <page_footer style="border:1px solid black;">
        <table style="height:250px;padding-left:350px;padding-top:50px;">
            <tr>
                <td style="height:250px;"><img src="../public/assets/img/logo.png" style="width:200px;"></td>
            </tr>
        </table>
        <hr />
        <p style="font-size:8px;">Fait à Paris </p>
        <p style="font-size:8px;">Boardgames</p>
        <p style="font-size:8px;">01 Rue des Jeux de Société</p>
        <p style="font-size:8px;">CEDEX 75035</p>
    </page_footer>
</page>



<?php
// Récupère tout le contenu entre ob_start et ob_get_clean
$content=ob_get_contents();

ob_end_clean();

use Spipu\Html2Pdf\Html2Pdf;

$path = 'C:/wamp64/www/ecommerce/public/assets/invoice/';
$file = 'facture_n_'.$invoice_id.'.pdf';

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
$html2pdf->output($path.$file,'F'); // F permet l'upload 

// requête SQL pour insérer l'url de la facture dans la table invoice
$sql="UPDATE invoice SET invoice_url=:invoice_url WHERE invoice_user_id=:user_id AND invoice_cart_id=:cart_id";
$stmt=$bdd->prepare($sql);
$stmt->execute([':invoice_url' => $path.$file, ':user_id' => $_SESSION['idUser'], ':cart_id' => $_SESSION['idCart']]);

// On vide le panier
unset($_SESSION['idCart']);

header("location:../vue/checkout_completed.php");
?>