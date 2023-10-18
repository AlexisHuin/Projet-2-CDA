{include file="../Partials/_HeaderView.tpl"}




{if $Infos.NomPrenomAdherents}

    <h1>Espace Adhérent</h1>
    <h2>Mes coordonnées</h2>

    <p>Nom Prénom : {$Infos.NomPrenomAdherents}</p>
    <p>Tel : {$Infos.PhoneAdherents}</p>
    <p>Email : {$Infos.MailAdherents}</p>
    <p>Code Postal : {$Infos.CodePostalAdherents}</p>
    <p>GPS : {$Infos.CoordonneesGPSAdherents}</p>
    <p>Date d'inscription : {$Infos.DateDebutAdherents}</p>

{else}

    <h1>Espace Producteur</h1>
    <h2>Mes coordonnées</h2>

    <p>Nom Prénom : {$Infos.NomPrenomProducteur}</p>
    <p>Tel : {$Infos.PhoneProducteur}</p>
    <p>Email : {$Infos.MailProducteur}</p>
    <p>Code Postal : {$Infos.CodePostalProducteur}</p>
    <p>GPS : {$Infos.CoordonneesGPSProducteur}</p>
    <p>Raison Sociale : {$Infos.RaisonSocialeProducteur}</p>

{/if}


{include file="../Partials/_FooterView.tpl"}