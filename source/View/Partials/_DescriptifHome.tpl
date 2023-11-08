{if $URI === "/"}
    <a href="/DescriptifProduit/{$product['IdProduit']}">

        <img src="../{$product['PhotoProduit']}" alt="{$product['DesignationProduit']}" />
    </a>
    <div class="product-description">
        <h3 class="produit">{$product['DesignationProduit']}</h3>
        <h3 data-id="{$product['IdCategorie']}" class="categorie">{$product['DesignationCategorie']}</h3>
    </div>
{/if}