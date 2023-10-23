<h1>Bienvenue {$Username} </h1>

<a href="/User/Deconnexion">Deconnexion</a>

<button><a href="/Admin/AdherentsList">Liste des adherents</a></button>
<button><a href="/Admin/ProducteursList">Liste des producteurs</a></button>
<button><a href="/Admin/ProductsList">Liste des produits</a></button>

<h2>Demandes en cours :</h2>
{if $Demandes}
    {foreach from=$Demandes item=demande key=key}

    {/foreach}

{else}
    <h3>vous n'avez aucune demande en attente.</h3>
{/if}