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

                <input type="password" name="Pass" placeholder="Mot de Passe">
                <input type="password" name="ConfirmPass" placeholder="Confirme MDP">
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
               
            </div> 

           
    



{* ? Bloc Producteur *}

 <div id="champProducteur">
   
</div> 


<div class="valid-cgu">
    <button type="submit" name="Inscription" class="danger">Valider l'inscription</button>
</div>
</form>
{* * Modale pour le paiement *}

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