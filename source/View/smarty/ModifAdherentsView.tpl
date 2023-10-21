<a href="/Admin/AdherentsList">Retour à la liste des adherents</a>


<form style="width: 25vw; height: 25vh; background-color: rgb(200,200,200); margin: 0 auto 1.5rem" method="post">
    <input name="NPrenom" type="text" value="{$adherent.NomPrenomAdherents}">
    <input name="Tel" type="tel" value="{$adherent.PhoneAdherents}">
    <input name="Mail" type="email" value="{$adherent.MailAdherents}">
    <input name="CP" type="text" value="{$adherent.CodePostalAdherents}">
    <input name="GPS" type="text" value="{$adherent.CoordonneesGPSAdherents}">
    <p>Date d'inscription : {$adherent.DateDebutAdherents}</p>
    <input type="submit" name="Update" value="Update">
</form>