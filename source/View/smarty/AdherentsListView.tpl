<a href="/Admin/Dashboard">Retour au dashboard</a>

{foreach from=$Liste key=k item=adherent}
    <div style="width: 20vw; height: 20vh; background-color: rgb(200,200,200); margin: 1.5rem auto">
        <p>Nom Prénom : {$adherent.NomPrenomAdherents}</p>
        <p>Tel : {$adherent.PhoneAdherents}</p>
        <p>Email : {$adherent.MailAdherents}</p>
        <p>Code Postal : {$adherent.CodePostalAdherents}</p>
        <p>GPS : {$adherent.CoordonneesGPSAdherents}</p>
        <p>Date d'inscription : {$adherent.DateDebutAdherents}</p>
    </div>
{/foreach}