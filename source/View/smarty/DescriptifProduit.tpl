{include file="../Partials/_HeaderView.tpl"}

<h2>{$product['IdProduit']}</h2>
<h2>{$product['DesignationProduit']}</h2>
<p>Elevé en serre </p>
<img src="" alt="" >

<form action="/User/AddPanier" method="POST">
    <input  type="hidden" name="IdProduit" value="{$product['IdProduit']}" >
    <input  type="number" name="QuantiteProduit" placeholder="Quantité a ajouter" >
    <button type="submit" name="Panier">Add panier</button>
</form>





{include file="../Partials/_FooterView.tpl"}