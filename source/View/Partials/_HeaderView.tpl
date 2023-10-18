
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="/assets/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/assets/js/App.js"></script>

    <title>{$title}</title>
   
    
</head>

<body>

<header>
<nav>
    <div class="logo-div">
        <a href="/"><img class="logo_coop" src="/assets/images/logo-coop.png" alt="Logo-Cooperative"></a>
    </div>

    <ul class="menu-list">
    
        <li class="link"><a href="/">Accueil</a></li>
        <li class="link"><a href="#">Contact</a></li> 
    

        {if isset($smarty.session.user)}

            {if $smarty.session.user.RoleUser eq "Adherent"}
                <li>
                    <a href="#">
                    <img class="header_img" src="/assets/images/cart.svg" alt="Cart"></a>
                </li>

                <li>
                    <a href="/User/Profile"><img class="header_img" src="/assets/images/profile.svg" alt="Profile"></a>
                </li>

                <li>
                    <a href="/User/Deconnexion"><img class="header_img" src="/assets/images/logout.svg" alt="Logout"></a>
                </li>

            {elseif $smarty.session.user.RoleUser eq "Producteur"}
                <li>
                     <a href="/User/Profile"><img class="header_img" src="/assets/images/profile.svg" alt="Profile"></a>
                </li>
                
                <li>
                    <a href="/User/Deconnexion"><img class="header_img" src="/assets/images/logout.svg" alt="Logout"></a>
                </li>
            {else}
                <li><a href="/User"><img class="header_img" src="/assets/images/cart.svg" alt="Cart"></a></li>
                <li><a href="/User"><img class="header_img" src="/assets/images/login.svg" alt="Login"></a></li>
            {/if}

        {else}
            <li><a href="/User"><img class="header_img" src="/assets/images/cart.svg" alt="Cart"></a></li>
            <li><a href="/User"><img class="header_img" src="/assets/images/login.svg" alt="Login"></a></li>
        {/if}

       
    </ul>
</nav>
</header>