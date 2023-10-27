{include file="../Partials/_HeaderView.tpl"}




{foreach from=$product item=Produit key=key}
    {include file="../Partials/_CardView.tpl"}   

{/foreach}

<form method="POST" action="/panier/ajouter">
<label for="quantite_produit">Quantité :</label>
<input type="number" id="quantite" name="quantite" min="0" >
<input type="hidden" id="IdProduit" name="IdProduit" value="{$product['IdProduit']}" >
<button type="submit">Ajouter au Panier</button>
</form>



{include file="../Partials/_FooterView.tpl"}