{include file="../Partials/_HeaderView.tpl"}


{if $SessionInfo['RoleUser'] === "Adherent" }
    <div class="adh" style="flex:1">
        <form method="POST">
            <h1>Espace Adhérent</h1>
            <h2>Mes coordonnées</h2>
            {if str_replace('/User/Profile', '', $URI) === '?edit'}

                <div>
                    <label>Nom Prénom : <input name='NomPrenomAdherent' value='{$Infos.NomPrenomAdherent}'> </label>
                    <label>Tel :<input name='PhoneAdherent' value='{$Infos.PhoneAdherent}'> </label>
                </div>
                <div>
                    <label>Email :<input readonly name='MailAdherent' value='{$Infos.MailAdherent}'> </label>
                    <label>Code Postal :<input name='CodePostalAdherent' value='{$Infos.CodePostalAdherent}'> </label>
                </div>
                <label>GPS :<input name='CoordonneesGPSAdherent' value='{$Infos.CoordonneesGPSAdherent}'> </label>
                <button style="margin: 0 0 1em 0;" type='submit' name='modification'>Confirmer</button>
            {else}
                {if empty($Reglement)}
                    <h2>Vous n'avez pas encore renseigné vos informations de paiement.</h2>
                 
        <div id="paiementCoor" style="position: fixed; top:0;left:0;height: 100vh;
            width: 100vw;
            display: none;
            align-items: center;
            justify-content: center;
            background-color: rgba(0,0,0,0.6); ">
            <div id="formProfil">

                <form method="POST">
                    <h1 style="text-align: center;">Information de paiement</h1>
                    <div>
                        <label for="Titulaire">Titulaire</label>
                        <input type="text" name="Titulaire">
                        <label for="CB">Coordonées Bancaire</label>
                        <input type="text" name="NumeroCB">
                    </div>
                    <div>
                        <label for="DateExpiration">Date expiration</label>
                        <input type="date" name="DateExpiration">
                        <label for="CVV">CVV</label>
                        <input type="text" name="CVV">

                    </div>
                    <div style="display: flex;">
                        <button style="flex:1;margin-right:7em;" id="cancel" type="reset"
                            onclick="CloseButton()">Annuler</button>
                        <button style="flex:1;margin-left:7em;" type="submit" style="text-allign:end"
                            name="Confirmation">Confirmer</button>
                    </div>
                </form>
            </div>
        </div>
           {else}    
        {if $SessionInfo['IdRole'] == $Reglement['IdAdherentInfosReglement']}
     
            <div>
            <h2> Coordonnées Bancaires</h2>
            <p> Titulaire : {$Reglement['TitulaireInfosReglement']}</p>
            <p> Date d'expiration : {$Reglement['ExpirationInfosReglement']}</p>
            <p> Chiffre CB : *********** </p>
            <p> CVV : ************ </p>
            </div>
           
        {/if}
    {/if}
        <div>
        <p>Nom Prénom : {$Infos.NomPrenomAdherent}</p>
        <p>Tel : {$Infos.PhoneAdherent}</p>
        <p>Email : {$Infos.MailAdherent}</p>
        <p>Code Postal : {$Infos.CodePostalAdherent}</p>
        <p>GPS : {$Infos.CoordonneesGPSAdherent}</p>
        <p>Date d'inscription : {$Infos.DateDebutAdherent}</p>
        </div>
        <div>
<button style="margin: 0 0 1em 0;" type="button"><a style="text-decoration:none; width:100%; height:100%; color:white"
        href="/User/Profile?edit">Modifier</a></button>
<button class="paiementButton" onclick="Paiement()">Ajouter mode de paiement</button>
</div>

            {/if}
</form>

{else if $SessionInfo['RoleUser'] === "Producteur"}
<div class="adh">
    <form method="POST">

        <h1>Espace Producteur</h1>
        <h2>Mes coordonnées</h2>
        {if str_replace('/User/Profile', '', $URI) === '?edit'}
        <div>
            <label>Nom Prénom : <input name='NomPrenomProducteur' type="text"
                    value='{$Infos.NomPrenomProducteur}'></label>
            <label>Tel : <input name='PhoneProducteur' type="text" value='{$Infos.PhoneProducteur}'></label>
        </div>
        <div>
            <label>Email : <input readonly type="text" value='{$Infos.MailProducteur}'></label>
            <label>Code Postal : <input name='CodePostalProducteur' type="text"
                    value='{$Infos.CodePostalProducteur}'></label><br>
            <label>GPS : <input name='CoordonneesGPSProducteur' type="text"
                    value='{$Infos.CoordonneesGPSProducteur}'></label>
            <label>Raison Sociale : <input name='RaisonSocialeProducteur' type="text"
                    value='{$Infos.RaisonSocialeProducteur}'></label>
        </div>

        <button style="margin: 0 0 1em 0;" type='submit' name='modification'>Confirmer</button>
        </div>

    {else}
        <p>Nom Prénom : {$Infos.NomPrenomProducteur}</p>
        <p>Tel : {$Infos.PhoneProducteur}</p>
        <p>Email : {$Infos.MailProducteur}</p>
        <p>Code Postal : {$Infos.CodePostalProducteur}</p>
        <p>GPS : {$Infos.CoordonneesGPSProducteur}</p>
        <p>Raison Sociale : {$Infos.RaisonSocialeProducteur}</p>
        <button style="margin: 0 0 1em 0;" type="button"><a style="text-decoration:none; width:100%; height:100%; color:white"
                href="/User/AddProduct">Consulter/Ajouter mes produits</a></button>
        <button style="margin: 0 0 1em 0;" type="button"><a style="text-decoration:none; width:100%; height:100%; color:white"
                href="/User/Profile?edit">Modifier</a></button>
        </div>

    {/if}
    </form>
{/if}


</div>

{include file="../Partials/_FooterView.tpl"}