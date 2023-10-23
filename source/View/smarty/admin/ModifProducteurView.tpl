<a href="/Admin/ProducteursList">Retour à la liste des producteurs</a>


<form style="width: 25vw; height: 25vh; background-color: rgb(200,200,200); margin: 0 auto 1.5rem" method="post">
    <input name="NPrenom" type="text" value="{$Producteur.NomPrenomProducteur}">
    <input name="Tel" type="tel" value="{$Producteur.PhoneProducteur}">
    <input name="Mail" type="email" value="{$Producteur.MailProducteur}">
    <input name="CP" type="text" value="{$Producteur.CodePostalProducteur}">
    <input name="GPS" type="text" value="{$Producteur.CoordonneesGPSProducteur}">
    <input name="RS" type="text" value="{$Producteur.RaisonSocialeProducteur}">
    <input type="submit" name="Update" value="Update">
</form>