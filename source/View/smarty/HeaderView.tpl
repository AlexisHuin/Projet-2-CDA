<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="./assets/css/index.css?<?= time(); ?>">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=`device-width`, initial-scale=1.0">
    <title> <?= $titre ?> </title>
</head>

<body>
    
    <header>
        <nav>
            <ul>
                <div class="logo-div">
                    <a href="index.php"><img class="logo_coop" src="./assets/images/logo-coop.png" alt="Logo-Cooperative"> </a> 
                </div>

                  
                <div class="authentification-div">
                if (isset($_SESSION['user']) && $_SESSION['user']['role'] === "Adherent") : ?>
                        <a href="Panier.php"><img class="header_img" src="./assets/images/cart.svg" alt="Cart"></a>
                        <a href="Profile.php"><img class="header_img" src="./assets/images/profile.svg" alt="Profile"></a>
                        <a href="Deconnexion.php"><img class="header_img" src="./assets/images/logout.svg" alt="Logout"></a>
                 elseif (isset($_SESSION['user']) && $_SESSION['user']['role'] === "Producteur") : ?>
                    
                  <a href="Profile.php"><img class="header_img" src="./assets/images/profile.svg" alt="Profile"></a>
                        <a href="Deconnexion.php"><img class="header_img" src="./assets/images/logout.svg" alt="Logout"></a>
                     else : 
                        <a href="Login.php"><img class="header_img" src="./assets/images/cart.svg" alt="Cart"></a>
                        <a href="Login.php"><img class="header_img" src="./assets/images/login.svg" alt="Login"></a>
                     endif;
                </div>
            </ul>
        </nav>
    </header>
    