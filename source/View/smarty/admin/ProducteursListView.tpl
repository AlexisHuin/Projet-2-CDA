<a href="/Admin/Dashboard">Retour au dashboard</a>

{foreach from=$Liste item=producteur key=k }
    <form style="width: 25vw; height: 25vh; min-height: 250px; background-color: rgb(200,200,200); margin: 0 auto 1.5rem" method="post">
        <p>Nom Prénom : {$producteur.NomPrenomProducteur}</p>
        <p>Tel : {$producteur.PhoneProducteur}</p>
        <p>Email : {$producteur.MailProducteur}</p>
        <p>Code Postal : {$producteur.CodePostalProducteur}</p>
        <p>GPS : {$producteur.CoordonneesGPSProducteur}</p>
        <p>Raison Sociale : {$producteur.RaisonSocialeProducteur}</p>
        <input type="hidden" value="Producteur" name="Role">
        <input type="hidden" value="{$producteur.IdProducteur}" name="Id">
        <input type="submit" value="Delete" name="Delete">
        <a href="/Admin/ModifProducteurs/{$producteur.IdProducteur}">Modifier infos</a>
        <a href="/Admin/ProduitsProducteursList/{$producteur.IdProducteur}">Voir produits du producteur</a>
    </form>
{/foreach}