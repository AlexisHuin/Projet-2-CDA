{include file="../Partials/_HeaderView.tpl"}
<div class="panier">
    <h1>Votre panier</h1>
    {if !empty($panier)}
        <form method="post">
            {foreach from=$panier item=item key=k}
                <fieldset id="DeleteOne">
                    <label>Id :</label> <input type="text" name="Id[]" readonly value="{$item.IdLigne}">
                    <label>Produit : </label> <input type="text" name="Produit[]" readonly value="{$item.Produit}">
                    <label>Quantite : </label> <input type="text" name="Quantite[]" readonly value="{$item.Quantite}">
                    <label>Prix : </label> <input type="text" name="Prix[]" readonly value="{$item.Prix}">
                    <input type="hidden" name="Index[]" value="{$k}">
                    <input type="hidden" name="IdPanier[]" value="{$item.IdLigne}">
                    <input type="hidden" name="IdProd[]" value="{$item.Producteur}">
                    <input type="submit" name="delete_{$item.IdLigne}" value="Supprimer">
                </fieldset>
                <hr>
            {/foreach}
            <fieldset id="DeleteAll">
                <input type="submit" value="Vider le panier" name="deleteAll">
            </fieldset>
            <fieldset id="Validate">
                <label> Prix total commande :
                    <input type="text" name="Total" value="{$total}" readonly>€
                </label>
                <input type="submit" value="Validate" name="Validate">
            </fieldset>
        </form>
    {else}
        <p>Le panier est vide!</p>
    {/if}

    <p>{$noticeQt}</p>
    <p>{$noticePrix}</p>
    {foreach from=$errors item=$error key=key}
        {$error}
    {/foreach}

</div>


{include file="../Partials/_FooterView.tpl"}