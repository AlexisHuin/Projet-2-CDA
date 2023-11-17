{include file="../Partials/_HeaderView.tpl"}
<div class="global-connexion">
    <div class="panel-left">
        <h1>Créer un compte</h1>


        <form method="POST">
            <div>
                <input type="text" name="Nom" id="nom" placeholder="Nom">
                <input type="text" name="Prenom" id="prenom" placeholder="Prenom">
            </div>
            <div>

                <input type="email" name="Email" id="email" placeholder="E-mail">
            </div>
            <div>
           
                <input type="password" name="Pass"  placeholder="Mot de Passe">
                <input type="password" name="ConfirmPass"  placeholder="Confirme MDP">
            </div>

            <div>
                <label>
                    <input type="radio" name="RoleUser" value="Adherent" id="Adherent">Adherent</input>
                </label>
                <label>
                    <input type="radio" name="RoleUser" value="Producteur" id="Producteur">Producteur</input>
                </label>
              
            </div>

            {* ? Bloc adherent *}
            <div id="champAdherent">
                <input type="text" name="GPS" placeholder="Coordonneés GPS">
                <input type="text" name="CodePostal" placeholder="Votre Code Postal">
                <input type="tel" name="Tel" placeholder="Votre N° Telephone">
                <button class="paiementButton">Ajouter mode de paiement</button>
            </div>
        
            {* ? Bloc Producteur *}

            <div id="champProducteur">
                <input type="text" name="RaisonSociale" placeholder="Raison Sociale">
                <input type="text" name="GPS" placeholder="Coordonneés GPS">
                <input type="text" name="CodePostal" placeholder="Votre Code Postal">
                <input type="tel" name="Tel" placeholder="Votre N° Telephone">
            </div>


            <div class="valid-cgu">
                <button type="submit" name="Inscription" class="danger">Valider l'inscription</button>
            </div>
        </form>
            {* * Modale pour le paiement *}
            <div id="paiementCoor">
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
                            <button id='closeButton' style="flex:1;margin-right:7em;" id="cancel"
                                type="reset">Annuler</button>
                            <button style="flex:1;margin-left:7em;" type="submit" style="text-allign:end"
                                name="Confirmation">Confirmer</button>
                        </div>
                    </form>
                </div>
            </div>
            {* * Fin Modale pour le paiement *}
    </div>



    <div class="panel-right">
        <h1>Connexion</h1>
        <form method="POST">
            <input type="text" name="Email" placeholder="Email">
            <input type="password" name="Pass" placeholder="Mot de passe">
            <button type="submit" name="Connexion" class="danger">Se Connecter</button>
        </form>
    </div>
</div>
{include file="../Partials/_FooterView.tpl"}