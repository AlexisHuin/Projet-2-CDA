<a href="/Admin/Dashboard">Retour au dashboard</a>

<a href="/Admin/AddProduct">Ajouter un produit</a>

{foreach from=$Liste key=k item=product}
    <form style="width: 25vw; height: 25vh; min-height: 250px; background-color: rgb(200,200,200); margin: 0 auto 1.5rem" method="post">
        <p>Id : {$product.IdProduit}</p>
        <p>Produit : {$product.DesignationProduit}</p>
        <p>Saison : {$product.NomSaison}</p>
        <p>Catégorie : {$product.DesignationCategorie}</p>
        <input type="hidden" value="{$product.IdProduit}" name="Id">
        <input type="submit" value="Delete" name="Delete">
        <a href="/Admin/ModifProducts/{$product.IdProduit}">Modifier infos</a>
    </form>
{/foreach}