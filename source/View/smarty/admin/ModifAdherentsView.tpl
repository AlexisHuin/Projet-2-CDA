<a href="/Admin/AdherentList">Retour à la liste des adherents</a>


<form style="width: 25vw; height: 25vh; background-color: rgb(200,200,200); margin: 0 auto 1.5rem" method="post">
    <input name="NPrenom" type="text" value="{$adherent.NomPrenomAdherent}">
    <input name="Tel" type="tel" value="{$adherent.PhoneAdherent}">
    <input name="Mail" type="email" value="{$adherent.MailAdherent}">
    <input name="CP" type="text" value="{$adherent.CodePostalAdherent}">
    <input name="GPS" type="text" value="{$adherent.CoordonneesGPSAdherent}">
    <p>Date d'inscription : {$adherent.DateDebutAdherent}</p>
    <input type="submit" name="Update" value="Update">
</form>