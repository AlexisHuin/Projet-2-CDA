{include file="../Partials/_HeaderView.tpl"}
{foreach from=$errors item=error key=key}
    <p style="color:red;">{$error}</p>
{/foreach}

<h1>Vos bundles en vente</h1>
<form method="post" action="">
    <div class="bundles">
    {foreach from=$ProduitsBundle item=produits key=key}
            {if $AllBundles.$key.IsValidateBundle == 1}
                {include file="../Partials/_FinalBundleView.tpl"}
            {/if}
        {/foreach}
    </div>
    <input type="hidden" name="Bundle">
    <button type="submit" name="delete">Supprimer</button>
</form>



<h1>Vos bundles en attentes</h1>
<form method="post" action="">
    <div class="bundles">
    {foreach from=$ProduitsBundle item=Produits key=key}
            {if $AllBundles.$key.IsValidateBundle == 0}
                {include file="../Partials/_FinalBundleView.tpl"}
            {/if}
        {/foreach}
    </div>
    <input type="hidden" name="Bundle">
    <button type="submit" name="delete">Supprimer</button>
   
</form>
<h1>Vos produits en vente</h1>
<form method="post" action="">
    <div class="products">
        {foreach key=key item=product from=$AllProduits}
            {if $product.IsValidateProduitProducteur == 1}
                {include file="../Partials/_CardView.tpl"}
            {/if}
        {/foreach}
    </div>
    <input type="hidden" name="Produit">
    <button type="submit" name="update">Modifier</Button>
    <button type="submit" name="delete">Supprimer</button>
</form>


<h1>Vos produits en attente de validation</h1>
<form method="post" action="">
    <div class="products">
        {foreach key=key item=product from=$AllProduits}
            {if $product.IsValidateProduitProducteur == False}
                {include file="../Partials/_CardView.tpl"}
            {/if}
        {/foreach}
    </div>
    <input type="hidden" name="Produit">
    <button type="submit" name="delete">Supprimer</button>
</form>


{include file="../Partials/_FooterView.tpl"}