<a href="/Admin/ProducteursList">Retour à la liste des producteurs</a>


<form style="width: 25vw; height: 25vh; background-color: rgb(200,200,200); margin: 0 auto 1.5rem" method="post">
    <input type="text" value="{$Producteur.NomPrenomProducteur}">
    <input type="tel" value="{$Producteur.PhoneProducteur}">
    <input type="email" value="{$Producteur.MailProducteur}">
    <input type="text" value="{$Producteur.CodePostalProducteur}">
    <input type="text" value="{$Producteur.CoordonneesGPSProducteur}">
    <input type="text" value="{$Producteur.RaisonSocialeProducteur}">
    <input type="submit" value="Update">
</form>