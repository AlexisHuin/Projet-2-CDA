{include file="../Partials/_HeaderView.tpl"}
{assign var="total" value=0}
<div class="panier">
    {if !empty($panier)}
        {foreach from=$panier item=item key=k}
            <form method="post">
                <p>Id :{$item.IdLigne}</p>
                <p>Produit : {$item.Produit}</p>
                <p>Quantite : {$item.Quantite}</p>
                <p>Prix : {$item.Prix}€</p>
                <input type="hidden" name="Id" value="{$k}">
                <input type="hidden" name="IdPanier" value="{$item.IdLigne}">
                <input type="submit" name="delete" value="Supprimer">
            </form>
            <hr>
            {assign var="total" value=($total + $item.Prix)}
        {/foreach}
        <form method="post">
            <input type="submit" value="Vider le panier" name="deleteAll">
        </form>
        <p> Prix total commande : {$total}</p>
        <form method="post">
            <input type="submit" value="Achat" name="Validate">
        </form>
    {else}
        <p>Le panier est vide!</p>
    {/if}
</div>
{include file="../Partials/_FooterView.tpl"}