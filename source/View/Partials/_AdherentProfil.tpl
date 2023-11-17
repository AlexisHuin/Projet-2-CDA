{if $SessionInfo['RoleUser'] === "Adherent" }
    {* ? Modale résiliation *}

    <div class="adh" style="flex:1">

        <h1>Espace Adhérent</h1>
        <h2>Mes coordonnées</h2>
        <div>
            <p>Nom Prénom : {$Infos.NomPrenomAdherent}</p>
            <p>Tel : {$Infos.PhoneAdherent}</p>
            <p>Email : {$Infos.MailAdherent}</p>
            <p>Code Postal : {$Infos.CodePostalAdherent}</p>
            <p>GPS : {$Infos.CoordonneesGPSAdherent}</p>
            <p>Date d'inscription : {$Infos.DateDebutAdherent}</p>
            </div>
            {* ? affichage de la page de modification des coordonnées adhérents *}
            {if str_replace('/User/Profile', '', $URI) === '?edit'}
                <form method="POST">
                    <div>
                        <label>Nom Prénom : <input type="text" name='NomPrenomAdherent' value='{$Infos.NomPrenomAdherent}'> </label>
                        <label>Tel :<input type="tel" name='PhoneAdherent' value='{$Infos.PhoneAdherent}'> </label>
                    </div>
                    <div>
                        <label>Email :<input readonly type='email' value='{$Infos.MailAdherent}'> </label>
                        <label>Code Postal :<input type="text" name='CodePostalAdherent' value='{$Infos.CodePostalAdherent}'>
                        </label>
                    </div>
                    <label>GPS :<input type="text" name='CoordonneesGPSAdherent' value='{$Infos.CoordonneesGPSAdherent}'> </label>
                    <button style="margin: 0 0 1em 0;" type='submit' name='modification'>Confirmer</button>
                </form>


                {else if str_replace('/User/Profile', '', $URI) === '?Mdp'}
                <form method="POST">

                    <label for="CurrentMdp"> Mdp actuel
                        <input type="password" name="CurrentMdp">
                    </label>
                    <label for="NewMdp"> Nouveau mdp
                        <input type="password" name="NewMdp">
                    </label>
                    <label for="ConfirmNewMdp"> Confirmer nouveau mdp
                        <input type="password" name="ConfirmNewMdp">
                    </label>

                    <button style="margin: 0 0 1em 0;" type='submit' name='ModifMdp'>Confirmer</button>
                </form>
                {else}
                {if $SessionInfo['IdRole'] == $Reglement['IdAdherentInfosReglement']}
                    <div>
                        <h2> Coordonnées Bancaires</h2>
                        <p> Titulaire : {$Reglement['TitulaireInfosReglement']}</p>
                        <p> Date d'expiration : {$Reglement['ExpirationInfosReglement']}</p>
                        <p> Chiffre CB : *********** </p>
                        <p> CVV : *** </p>
                        <p> Depense en cours : {$Infos['DepenseAdherent']} € </p>
                    </div>
                    <button id="resiliationProfil">Resiliation</button>
                    {* ? Modale pour supprimé les données de CB *}
                    <div id="resiliationCoor">
                        <div id="formProfil">
                            <form method="POST">
                                <h1 style="text-align: center;">Voulez vous résilier ?</h1>
                                <div>
                                    <label for="Titulaire">Titulaire : {$Reglement['TitulaireInfosReglement']}</label>
                                    <label for="Expiration">Date d'expiration : {$Reglement['ExpirationInfosReglement']}</label>
                </div>
                <div style="display: flex;">
                    <button id='closeRes' style="flex:1;margin-right:7em;"  type="reset">Annuler</button>
                    <input type="hidden" name="Id" value="{$Reglement['IdInfosReglement']}">
                    <button style="flex:1;margin-left:7em;" type="submit" style="text-align:end"
                        name="Supprimer">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
    <div>
        <button style="margin: 0 0 1em 0;" type="button"><a
                style="text-decoration:none; width:100%; height:100%; color:white"
                href="/User/Profile?edit">Modifier</a></button>
        <button style="margin: 0 0 1em 0;" type="button"><a
                style="text-decoration:none; width:100%; height:100%; color:white" href="/User/Profile?Mdp">Modifier
                                Mdp</a></button>
                    </div>
                {/if}
            {/if}
        </div>
        </div>
    {/if}