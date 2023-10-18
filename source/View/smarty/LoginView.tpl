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
</div>
{include file="../Partials/_FooterView.tpl"}