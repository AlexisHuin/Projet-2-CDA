{include file="../Partials/_HeaderView.tpl"}




{foreach from=$produit item=product key=key }
    {include file="../Partials/_CardView.tpl"}  
    
{/foreach}

<form method="POST" action="/panier/ajouter">
<label for="Quantite">Quantité :</label>
<input type="number" id="Quantite" name="Quantite" min="0" >
<input type="hidden" id="IdProduit" name="IdProduit" value="{$product['IdProduit']}" >
<button type="submit">Ajouter au Panier</button>
</form>



{include file="../Partials/_FooterView.tpl"}