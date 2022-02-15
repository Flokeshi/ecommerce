<!-- Ctrl + Shift + p, taper Emoji: Insert Emoji  -->
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

<body>

    <?php
    session_start();
    //require '../modele/connexion_bdd.php'; // lie le fichier connexion_bdd à ce fichier
    require '../modele/fonctions.php'; // lie le fichier fonctions à ce fichier
    include ("../vue/header.php");
    
    ?>

    <div class="clearfix"></div>
    <main>
        <section class="container">
            <article class="row">
                <div class="col-lg-12 text-center bg-white rounded p-5">
                    <h1 class="p-2 mb-5" style="color:black;">😀 Votre paiement a bien été validé ! 🎉</h1>
                    <h3>Vous pouvez voir vos factures <a href="../vue/orders.php">ici</a></h3>
                    <p><em>Retour à <a href="../public/index.php">l'accueil</a></em></p>
                </div>
            </article>
        </section>      

        <?php include ("../vue/footer.php"); ?>
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