<a href="/Admin/AdherentList">Retour à la liste des adherents</a>


<form style="display:flex; flex-direction:column; width: 25vw; height: 25vh; background-color: rgb(200,200,200); margin: 0 auto 1.5rem" method="post">
    <label for="">Nom Prenom : <input name="NPrenom" type="text" value="{$adherent.NomPrenomAdherent}"></label>
    <label for="">Tel : <input name="Tel" type="tel" value="{$adherent.PhoneAdherent}"></label>
    <label for="">Mail : <input name="Mail" type="email" value="{$adherent.MailAdherent}"></label>
    <label for="">CP : <input name="CP" type="text" value="{$adherent.CodePostalAdherent}"></label>
    <label for="">GPS : <input name="GPS" type="text" value="{$adherent.CoordonneesGPSAdherent}"></label>
    <p>Date d'inscription : {$adherent.DateDebutAdherent}</p>
    <input type="submit" name="Update" value="Update">
</form>