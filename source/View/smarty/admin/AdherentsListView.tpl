<a href="/Admin/Dashboard">Retour au dashboard</a>
{foreach from=$Liste key=k item=adherent}
    <form style="width: 25vw; height: 25vh; min-height: 250px; background-color: rgb(200,200,200); margin: 0 auto 1.5rem" method="post">
        <p>Nom Prénom : {$adherent.NomPrenomAdherent}</p>
        <p>Tel : {$adherent.PhoneAdherent}</p>
        <p>Email : {$adherent.MailAdherent}</p>
        <p>Code Postal : {$adherent.CodePostalAdherent}</p>
        <p>GPS : {$adherent.CoordonneesGPSAdherent}</p>
        <p>Date d'inscription : {$adherent.DateDebutAdherent}</p>
        <input type="hidden" value="Adherent" name="Role">
        <input type="hidden" value="{$adherent.IdAdherent}" name="Id">
        <input type="submit" value="Delete" name="Delete">
        <a href="/Admin/ModifAdherent/{$adherent.IdAdherent}">Modifier infos</a>
    </form>
{/foreach}