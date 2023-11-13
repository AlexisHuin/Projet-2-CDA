{include file="../Partials/_HeaderView.tpl"}


<div class="addproduct">

<h1>Ajout nouveau produit</h1>
{$info}

<form method="POST" enctype="multipart/form-data" class="addproduct">
    <select name="IdProduitProduitProducteur">
       {foreach from=$AllProducts key=k item=produit}
            <option value="{$produit.IdProduit}"> {$produit.DesignationProduit} </option>
       {/foreach}
    </select>
    <label for="DesignationProduitProducteur">Designation produit Producteur</label>
    <input type="text" name="DesignationProduitProducteur" required>
    <label for="PrixProduitProducteur">Prix Produit Producteur</label>
    <input type="text" name="PrixProduitProducteur" required>
    <label for="DetailsProduitProducteur">Details produit</label>
    <input type="text" name="DetailsProduitProducteur" required>
    <label for="QuantiteProduitProducteur">Quantité produit</label>
    <input type="number" name="QuantiteProduitProducteur" required>
    <label for="ImageProduitProducteur">Image</label>
    <input type="file" name="ImageProduitProducteur" accept="image/jpeg, image/png, image/webp">
    <input  type="submit" name="Ajouter" value="Envoyer">
</form>

</div>



    


{include file="../Partials/_FooterView.tpl"}