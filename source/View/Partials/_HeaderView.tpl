<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/styling.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="/assets/js/App.js"></script>
    <title>{$title}</title>


</head>

<body>

<header>
    <nav class="navbar">
        <div class="logo-div">
            <a href="/"><img class="logo_coop" src="/assets/images/logo-coop.png" alt="Logo-Cooperative"></a>
        </div>

        <ul class="menu-list">
            <li><a href="/">Accueil</a></li>
            <li><a href="#">Contact</a></li>

            {if isset($smarty.session.user)}
                {if $smarty.session.user.RoleUser eq "Adherent" or $smarty.session.user.RoleUser eq "Producteur"}
                    <li><a href="/Adherents/Panier"><img class="header_img" src="/assets/images/cart.svg" alt="Cart"></a></li>
                    <li><a href="/User/Profile"><img class="header_img" src="/assets/images/profile.svg" alt="Profile"></a></li>
                    <li><a href="/User/Deconnexion"><img class="header_img" src="/assets/images/logout.svg" alt="Logout"></a></li>
                {else}
                    <li><a href="/User"><img class="header_img" src="/assets/images/cart.svg" alt="Cart"></a></li>
                    <li><a href="/User"><img class="header_img" src="/assets/images/login.svg" alt="Login"></a></li>
                {/if}
            {else}
                <li><a href="/User"><img class="header_img" src="/assets/images/cart.svg" alt="Cart"></a></li>
                <li><a href="/User"><img class="header_img" src="/assets/images/login.svg" alt="Login"></a></li>
            {/if}
           
            <li class="deroulant">
                <input type="checkbox" id="toggleNotification" class="toggle-checkbox">
                <label for="toggleNotification" class="toggle-label">
                    <img class="header_img" src="/assets/images/notif.svg" alt="Notification Icon">
                </label>
                <ul class="sous">
                    <li><a href="#">Notification 1</a></li>
                    <li><a href="#">Notification 2</a></li>
                    <li><a href="#">Notification 3</a></li>
                </ul>
            </li>

            <li class="search-bar">
                <input type="text" placeholder="Rechercher...">
                <button type="button">Rechercher</button>
            </li>

        </ul>
    </nav>
</header>


    {* <iframe id="lubulule" width="1694" height="820" src="https://www.youtube.com/embed/hziZJQSyotQ"
        title="8 morts 6 blessés, je pète ma bière, MA LUBULULE !" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
allowfullscreen></iframe> *}
