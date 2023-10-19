<a href="/Admin/Dashboard">Retour au dashboard</a>

{foreach from=$Liste item=producteur key=k }
    <div style="width: 20vw; height: 20vh; background-color: rgb(200,200,200); margin: 1.5rem auto">
        <p>Nom Prénom : {$producteur.NomPrenomProducteur}</p>
        <p>Tel : {$producteur.PhoneProducteur}</p>
        <p>Email : {$producteur.MailProducteur}</p>
        <p>Code Postal : {$producteur.CodePostalProducteur}</p>
        <p>GPS : {$producteur.CoordonneesGPSProducteur}</p>
        <p>Raison Sociale : {$producteur.RaisonSocialeProducteur}</p>
    </div>
{/foreach}