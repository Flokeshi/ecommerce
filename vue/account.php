<!-- Ctrl + Shift + p, taper Emoji: Insert Emoji  -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Board Games Account</title>
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
    require '../modele/fonctions.php';
    include ("../vue/header.php");
    
    if (isset($_SESSION['idUser'])) {
        $userInformation=$bdd->prepare("SELECT * FROM user WHERE user_id=:user_id");
        $userInformation->execute(['user_id' => $_SESSION['idUser']]);
        $userTable = $userInformation->fetch();
    }
    ?>

    <div class="clearfix"></div>
    <main>
        <?php if (isset($_SESSION['idUser'])) { ?>
        <section class="container">
            <article class="row rounded bg-white">
                <div class="col-lg-6 p-5">
                    <h3 class="py-4">Mes informations</h3>
                    <form method="POST" action="../controller/traitement_account.php">
                        <label for="lastname" class="fw-bold pt-2">Nom de famille</label>
                        <input type="text" value="<?php echo $userTable['user_lastname']; ?>" name="lastname" id="lastname" class="form-control my-2">
                        <label for="firstname" class="fw-bold pt-2">Prénom</label>
                        <input type="text" value="<?php echo $userTable['user_firstname']; ?>" name="firstname" id="firstname" class="form-control my-2">
                        <label for="email" class="fw-bold pt-2">e-mail</label>
                        <input type="email" value="<?php echo $userTable['user_email']; ?>" name="email" id="email" class="form-control my-2">
                        <label for="birth" class="fw-bold pt-2">Date de naissance</label>
                        <input type="date" value="<?php echo $userTable['user_birthday']; ?>" name="birth" id="birth" class="form-control my-2" required>
                        <input type="hidden" name="idUser" value="<?php echo $_SESSION['idUser']; ?>">
                        <button type="submit" class="btn btn-primary btn-block my-2 text-center">Editer</button>
                    </form>
                </div>
  
                <div class="col-lg-6 p-5">
                    <h3 class="py-4">Modifier mon mot de passe</h3>
                    <div class="col-lg-4">
                        <p style="display: block;"><a class="btn btn-primary text-center" data-bs-toggle="collapse" data-bs-target="#passwordEdit" href="#passwordEdit" role="button" aria-expanded="false" aria-controls="passwordEdit">Ouvrir le formulaire</a></p>
                    </div>
                    <div class="collapse" id="passwordEdit">
                        <form method="POST" action="../controller/traitement_password.php">
                            <label for="oldPassword" class="fw-bold pt-2">Ancien mot de passe</label>
                            <input type="password" placeholder="Ancien mot de passe" name="oldPassword" id="oldPassword" class="form-control my-2">
                            <label for="password1" class="fw-bold pt-2">Nouveau mot de passe</label>
                            <input type="password" placeholder="Nouveau mot de passe" name="password1" id="password1" class="form-control my-2">
                            <label for="password2" class="fw-bold pt-2">Confirmation du nouveau mot de passe</label>
                            <input type="password" placeholder="Confirmation du nouveau mot de passe" name="password2" id="password2" class="form-control my-2">
                            <input type="hidden" name="idUser" value="<?php echo $_SESSION['idUser']; ?>">
                            <button type="submit" class="btn btn-primary btn-block my-2 text-center">Editer</button>
                        </form>
                    </div>
                </div>
                <div class="w-50">
                    <?php
                    if (isset($_GET["erreurEmail"])) {
                        if ($_GET["erreurEmail"] == "erreurs") {
                            echo "<div class='alert alert-danger'>Cette adresse e-mail est déjà enregistrée.</div>";
                        }
                    }
                    if (isset($_GET["erreurTechnique"])) {
                        if ($_GET["erreurTechnique"] == "erreurs") {
                            echo "<div class='alert alert-danger'>Une erreur technique est survenue. Veuillez réessayer.</div>";
                        }
                    }
                    if (isset($_GET["validationModification"])) {
                        if ($_GET["validationModification"] == "ok") {
                            echo "<div class='alert alert-success'>Vos modifications ont bien été prises en compte.</div>";
                        }
                    }
                    if (isset($_GET["erreurPwd"])) {
                        if ($_GET["erreurPwd"] == "erreurs") {
                            echo "<div class='alert alert-danger'>Vos nouveaux mots de passe ne sont pas identiques.</div>";
                        }
                    }
                    if (isset($_GET["oldPwd"])) {
                        if ($_GET["oldPwd"] == "erreurs") {
                            echo "<div class='alert alert-danger'>Votre ancien mot de passe est incorrect.</div>";
                        }
                    }
                    ?>
                </div>
                
            </article>
        </section>      

        <?php 
        }
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