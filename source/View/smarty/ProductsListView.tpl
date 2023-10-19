<a href="/Admin/Dashboard">Retour au dashboard</a>

{foreach from=$Liste key=k item=product}
    <div style="width: 20vw; height: 20vh; background-color: rgb(200,200,200); margin: 1.5rem auto">
        <p>{$product.DesignationProduit}</p>
        <p>{$product.NomSaison}</p>
        <p>{$product.DesignationCategorie}</p>
    </div>
{/foreach}