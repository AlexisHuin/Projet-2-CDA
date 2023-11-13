
{* ! ORIGINAL *}

{include file="../Partials/_HeaderView.tpl"}
<div class="global-connexion">
    <div class="panel-right">
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
                
                <input type="password" name="Pass" id="pass" placeholder="Mot de Passe">
                <input type="password" name="ConfirmPass" id="pass" placeholder="Confirme MDP">
            </div>
            <div>
                <div>
                    <input type="radio" name="RoleUser" value="Adherent">Adherent</input>
                    <input type="radio" name="RoleUser" value="Producteur">Producteur</input>
                    <br>
                </div>
                <div>
                    <input type="text" name="GPS" placeholder="Coordonneés GPS"></input>
                </div>
                <div><input type="text" name="CodePostal" placeholder="Votre Code Postal"></div>
                <div><input type="tel" name="Tel" placeholder="Votre N° Telephone"></div>
            </div>

            <div class="valid-cgu">
                <button type="submit" name="Inscription" class="danger">Valider l'inscription</button>
            </div>
        </form>
    </div>
</div>

<div class="panel-left">
        <h1>Connexion</h1>
        <form method="POST">
            <input type="text" name="Email"  placeholder="Email">
            <input type="password" name="Pass"  placeholder="Mot de passe">
            <button type="submit" name="Connexion" class="danger">Se Connecter</button>
        </form>
</div>
    
{include file="../Partials/_FooterView.tpl"}



{* ! WORK IN PROGRESS *}


{include file="../Partials/_HeaderView.tpl"}


<div class="panel_login">



<div class="panel-left">
    <h1>Connexion</h1>
    <form method="POST">
        <input type="text" name="Email" placeholder="Email">
        <input type="password" name="Pass" placeholder="Mot de passe">
        <button type="submit" name="Connexion">Se Connecter</button>
    </form>
</div>

<div class="new-panel_right">
<h1>Inscription</h1>

    <div class="panel-right_card">
        <p>Vous êtes un adhérent ?</p>
        <button class="paiementButton">Ajouter mode de paiement</button>
        <form method="POST"> 
        <input type="radio" name="RoleUser" value="Adherent"></input>
                   
    </div>
    <div class="panel-right_card">

        <p>Vous êtes un producteur ?</p>
        <input type="radio" name="RoleUser" value="Producteur"></input>
    </div>
    </div>

<div class="panel-right_adherent">
<div>
<input type="text" name="Nom" id="nom" placeholder="Nom">
<input type="text" name="Prenom" id="prenom" placeholder="Prenom">
</div>
<div>
<input type="email" name="Email" id="email" placeholder="E-mail">
<input type="tel" name="Tel" placeholder="Votre N° Telephone">
</div>
<div>
<input type="password" name="Pass" id="pass" placeholder="Mot de Passe">
<input type="password" name="ConfirmPass" id="ConfirmPass" placeholder="Confirme MDP">
</div>
<input type="text" name="GPS" placeholder="Coordonneés GPS">
<input type="text" name="CodePostal" placeholder="Votre Code Postal">
<div class="button-container" >
<button type="submit" name="Inscription">Valider</button>
</div>
</form>


{* * Modale pour le paiement *}
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
            <button id='closeButton' style="flex:1;margin-right:7em;" id="cancel" type="reset">Annuler</button>
            <button style="flex:1;margin-left:7em;" type="submit" style="text-allign:end"
                name="Confirmation">Confirmer</button>
        </div>
    </form>
</div>
</div>
{* * Fin Modale pour le paiement *}

</div>


{* <div class="panel-right_producteur">
<div>
<input type="text" name="Nom" id="nom" placeholder="Nom">
<input type="text" name="Prenom" id="prenom" placeholder="Prenom">
</div>
<div>
<input type="email" name="Email" id="email" placeholder="E-mail">
<input type="tel" name="Tel" placeholder="Votre N° Telephone">
</div>
<div>
<input type="password" name="Pass" id="pass" placeholder="Mot de Passe">
<input type="password" name="ConfirmPass" id="pass" placeholder="Confirme MDP">
</div>
<input type="text" name='RaisonSocialeProducteur' placeholder="Raison Sociale">
<input type="text" name="GPS" placeholder="Coordonneés GPS">
<input type="text" name="CodePostal" placeholder="Votre Code Postal">
<button type="submit" name="Inscription">Valider</button>
</form>
</div> *}
</div>
</div>




{* <div class="global-connexion">
    <div class="panel-right">
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

                <input type="password" name="Pass" id="pass" placeholder="Mot de Passe">
                <input type="password" name="ConfirmPass" id="pass" placeholder="Confirme MDP">
            </div>
            <div>
                <div>
                    <input type="radio" name="RoleUser" value="Adherent">Adherent</input>
                    <input type="radio" name="RoleUser" value="Producteur">Producteur</input>
                    <br>
                </div>
                <div>
                    <input type="text" name="GPS" placeholder="Coordonneés GPS"></input>
                </div>
                <div><input type="text" name="CodePostal" placeholder="Votre Code Postal"></div>
                <div><input type="tel" name="Tel" placeholder="Votre N° Telephone"></div>
            </div>

            <div class="valid-cgu">
                <button type="submit" name="Inscription">Valider l'inscription</button>
            </div>
        </form>
    </div>
</div>
*}
{include file="../Partials/_FooterView.tpl"}