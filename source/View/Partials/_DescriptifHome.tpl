{if $URI === "/"}
    <a style="text-decoration: none;" href="/DescriptifProduit/{$product['IdProduit']}">

        <img  src="../{$product['PhotoProduit']}" alt="{$product['DesignationProduit']}" />
   
    <div class="product-description">
        <h3 class="produit">{$product['DesignationProduit']}</h3>
        <label data-id="{$product['IdCategorie']}" class="categorie" hidden>{$product['DesignationCategorie']}</label>
        </a>
    </div>
    
{/if}