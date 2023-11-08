<div class="product">

    <a href="/DescriptifProduit/{$product['IdProduit']}">

        <img src="../{$product['PhotoProduit']}" alt="{$product['DesignationProduit']}" />
    </a>
    <div class="product-description">
        <h3 class="produit">{$product['DesignationProduit']}</h3>
        {if isset($product['DesignationCategorie'])}
            <h3 data-id="{$product['IdCategorie']}" class="categorie">{$product['DesignationCategorie']}</h3>
        {/if}
        {if isset($product['PrixProduitProducteur']) && isset($product['DetailsProduitProducteur']) && isset($product['QuantiteProduitProducteur']) && isset($product['ImageProduitProducteur'])}
            <input type="text" name="produit[{$product['IdProduitProducteur']}][DesignationProduitProducteur]"
                value="{$product['DesignationProduitProducteur']}" readonly />
            <p>Prix : <input type="text" name="produit[{$product['IdProduitProducteur']}][PrixProduitProducteur]"
                    value="{$product['PrixProduitProducteur']}" /></p>
            <p>Description :<input type="text" name="produit[{$product['IdProduitProducteur']}][DetailsProduitProducteur]"
                    value="{$product['DetailsProduitProducteur']}" readonly /></p>
            <p>Quantité : <input type="number" name="produit[{$product['IdProduitProducteur']}][QuantiteProduitProducteur]"
                    value="{$product['QuantiteProduitProducteur']}" readonly /></p>
            <img src="../{$product['ImageProduitProducteur']}" alt="image produit">
            <p>Supprimer ? <input type="checkbox" name="deleteProduit[{$product['IdProduitProducteur']}]" value="1" /></p>
        {/if}
        {if isset($product['DesignationCategorie'])}
            
        {/if}
    </div>
</div>