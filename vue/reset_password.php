<!-- Ctrl + Shift + p, taper Emoji: Insert Emoji  -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Board Games reset password</title>
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
    ?>

    <div class="clearfix"></div>
    <main>
        <section class="container">
            <article class="row rounded bg-white justify-content-center">
                <div class="container justify-content-center w-50 my-5">
                    <h4 class="evenboxinnerShop m-l-20 my-4">Réinitialisation du mot de passe</h4>
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if($_GET['key'] && $_GET['token']){
                                require ('../modele/connexion_bdd.php');
                                $email = $_GET['key'];
                                $token = $_GET['token'];
                                $curDate = date("Y-m-d H:i:s");

                                $query = $bdd->prepare("SELECT * FROM user WHERE user_email=:user_email");
                                $query -> execute([":user_email" => $email]);
                                $row=$query->fetch();

                                if (count($row) > 0) {
                                    if($row['exp_date'] >= $curDate){ ?>
                                        <form action="../controller/update_forget_password.php" method="POST">
                                            <input type="hidden" name="email" value="<?php echo $email;?>">
                                            <input type="hidden" name="reset_link_token" value="<?php echo $token;?>">
                                            <div class="form-group">
                                                <label for="password">New Password</label>
                                                <input type="password" name='password' class="form-control mb-4">
                                            </div>                
                                            <div class="form-group">
                                                <label for="cpassword">Confirm Password</label>
                                                <input type="password" name='cpassword' class="form-control mb-4">
                                            </div>
                                            <input type="submit" name="new_password" class="btn btn-primary" value="Submit">
                                        </form>
                                    <?php } 
                                } else{ ?>
                                <div class="text-center">
                                    <h2>Le lien du mot de passe a expiré.</h2>
                                    <h3>Pour retourner sur le site :</h3> 
                                    <h3><a href="../public/index.php"><img src="../public/assets/img/logo2.png" class="logo" style="width: 150px;">Boardgames.com</a></h3>
                                </div>
                                <?php }
                            }?>
                        </div>
                    </div>
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