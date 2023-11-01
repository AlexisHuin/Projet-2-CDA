{include file="../Partials/_HeaderView.tpl"}

    <h3>{$Succes}</h3>
{if $SessionInfo['RoleUser'] === "Adherent" }
    <div class="adh">
        <h1>Espace Adhérent</h1>
        <h2>Mes coordonnées</h2>

        <p>Nom Prénom : {$Infos.NomPrenomAdherents}</p>
        <p>Tel : {$Infos.PhoneAdherents}</p>
        <p>Email : {$Infos.MailAdherents}</p>
        <p>Code Postal : {$Infos.CodePostalAdherents}</p>
        <p>GPS : {$Infos.CoordonneesGPSAdherents}</p>
    <p>Date d'inscription : {$Infos.DateDebutAdherents}</p>

    <div id="paiementCoor" style="position: fixed; top:0;left:0;height: 100vh;
    width: 100vw;
    display: none;
    align-items: center;
    justify-content: center;
    background-color: rgba(0,0,0,0.6); ">

        <form method="POST" style="background-color: antiquewhite; padding:3em; border-radius:2em">
            <h1 style="text-align: center;">Information de paiement</h1>
            <div>
            <label for="Titulaire">Titulaire</label>
            <input type="text" name="Titulaire">
            <label for="CB">Coordonées Bancaire</label>
            <input type="text" name="NumeroCB">
            </div>
            <div>
            <label for="DateExpiration">Date expiration</label>
            <input type="month" name="DateExpiration">
            <label for="CVV">CVV</label>
            <input type="text" name="CVV">
           
            </div>
            <div style="display: flex;">
                <button style="flex:1;margin-right:7em;" id="cancel" type="reset"
                    onclick="CloseButton()">Annuler</button>
                <button style="flex:1;margin-left:7em;" type="submit" style="text-allign:end" name="Confirmation">Confirmer</button>
            </div>
        </form>
    </div>
    <button class="paiementButton" onclick="Paiement()">Ajouter mode de paiement</button>


</div>
{else if $SessionInfo['RoleUser'] === "Producteur"}
    <div class="prod">
        <h1>Espace Producteur</h1>
        <h2>Mes coordonnées</h2>

        <p>Nom Prénom : {$Infos.NomPrenomProducteur}</p>
        <p>Tel : {$Infos.PhoneProducteur}</p>
        <p>Email : {$Infos.MailProducteur}</p>
        <p>Code Postal : {$Infos.CodePostalProducteur}</p>
        <p>GPS : {$Infos.CoordonneesGPSProducteur}</p>
        <p>Raison Sociale : {$Infos.RaisonSocialeProducteur}</p>

        <a href="/User/AddProduct">Consulter/Ajouter mes produits</a>

    </div>

{/if}


{include file="../Partials/_FooterView.tpl"}