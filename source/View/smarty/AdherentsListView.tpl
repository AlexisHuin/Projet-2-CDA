<a href="/Admin/Dashboard">Retour au dashboard</a>
{foreach from=$Liste key=k item=adherent}
    <form style="width: 25vw; height: 25vh; min-height: 250px; background-color: rgb(200,200,200); margin: 0 auto 1.5rem" method="post">
        <p>Nom Prénom : {$adherent.NomPrenomAdherents}</p>
        <p>Tel : {$adherent.PhoneAdherents}</p>
        <p>Email : {$adherent.MailAdherents}</p>
        <p>Code Postal : {$adherent.CodePostalAdherents}</p>
        <p>GPS : {$adherent.CoordonneesGPSAdherents}</p>
        <p>Date d'inscription : {$adherent.DateDebutAdherents}</p>
        <input type="hidden" value="{$adherent.IdAdherents}" name="Id">
        <input type="submit" value="Delete" name="Delete">
        <a href="/Admin/ModifAdherents{$adherent.IdAdherents}">Modifier infos</a>
    </form>
{/foreach}