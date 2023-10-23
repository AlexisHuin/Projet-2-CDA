<a href="/Admin/ProductsList">Retour à la liste des produits</a>

<form style="width: 25vw; height: 25vh; background-color: rgb(200,200,200); margin: 0 auto 1.5rem" method="post">
    <input type="text" name="Produit" value="{$Product.DesignationProduit}">

    <select name="Saison">
        {foreach from=$Saisons item=Saison key=k}
            {if $Saison.IdSaison === $Product.IdSaisonProduit}
                <option selected value="{$Saison.IdSaison}">{ucfirst($Saison.NomSaison)}</option>
            {else}
                <option value="{$Saison.IdSaison}">{ucfirst($Saison.NomSaison)}</option>
            {/if}
        {/foreach}
    </select>
    <select name="Categorie">
        {foreach from=$Categories item=Categorie key=k}
            {if $Categorie.IdCategorie === $Product.IdCategorieProduit}
                <option selected value="{$Categorie.IdCategorie}">{$Categorie.DesignationCategorie}</option>
            {else}
                <option value="{$Categorie.IdCategorie}">{$Categorie.DesignationCategorie}</option>
            {/if}
        {/foreach}
    </select>
    <input type="submit" name="Update" value="Update">
</form>