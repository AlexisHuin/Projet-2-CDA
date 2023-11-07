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
                        <li><a href="/Adherents/Panier"><img class="header_img" src="/assets/images/cart.svg" alt="Cart"></a>
                        </li>
                        <li><a href="/User/Profile"><img class="header_img" src="/assets/images/profile.svg" alt="Profile"></a>
                        </li>
                        <li><a href="/User/Deconnexion"><img class="header_img" src="/assets/images/logout.svg"
                                    alt="Logout"></a></li>
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
                    <label style="position: relative;" for="toggleNotification" class="toggle-label">
                        <img class="header_img" src="/assets/images/notif.svg" alt="Notification Icon">
                        {if ($notifications|@count) > 0}
                            <sup>{$notifications|@count}</sup>
                        {/if}
                        <ul class="sous">
                            {if ($notifications|@count) > 0}
                                {foreach from=$notifications item=notif key=k}
                                    <form class="notification" style="display:grid;" method="post">
                                        <li>{$notif.MotifNotification}</li>
                                        <p style="text-align: center; font-size:.75rem; color:black; padding: .5rem 0 0">
                                            {$notif.DateEnvoiNotification}</p>
                                        <input type="hidden" name="Id" value="{$notif.IdNotification}">
                                        <input type="submit" name="Read" value="X">
                                    </form>
                                    <hr>
                                {/foreach}
                            {else}
                                <h2 style="text-align: center; font-size:.75rem; color:black; padding: .5rem 0 0">Vous
                                    n'avez aucune notification</h2>
                            {/if}
                        </ul>
                    </label>
                </li>

                <li class="search-bar">
                    <input type="text" placeholder="Rechercher...">
                    <button type="button">Rechercher</button>
                </li>

            </ul>
        </nav>
</header
