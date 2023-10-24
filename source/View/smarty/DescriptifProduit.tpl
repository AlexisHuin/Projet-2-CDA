{include file="../Partials/_HeaderView.tpl"}

{include file="../Partials/_CardView.tpl"}   

<form method="POST" action="/Adherents/Panier">
<label for="quantite_produit">Quantité :</label>
<input type="number" id="quantite_produit" name="quantité_produit" min="0" >
<button type="submit">Ajouter au Panier</button>
</form>

{include file="../Partials/_FooterView.tpl"}