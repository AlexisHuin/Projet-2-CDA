<div class="product">

    <a href="/DescriptifProduit/{$product['IdProduit']}">

        <img src="/assets/images/fruit.jpg" alt="<?= $product['name'] ?>">
    </a>
    <div class="product-description">
        <h3>{$product['DesignationProduit']}</h3>
        {if isset($product['DesignationCategorie'])}
            <h3>{$product['DesignationCategorie']}</h3>
        {/if}
        {if isset($product['PrixProduitProducteur']) && isset($product['DetailsProduitProducteur']) && isset($product['QuantiteProduitProducteur'])  }
            <input type="text" name="produit[{$product['IdProduit']}][DesignationProduitProducteur]" value="{$product['DesignationProduitProducteur']}"/>
            <p>Prix : <input type="text" name="produit[{$product['IdProduit']}][PrixProduitProducteur]" value="{$product['PrixProduitProducteur']}"/></p>
            <p>Description :<input type="text" name="produit[{$product['IdProduit']}][DetailsProduitProducteur]" value="{$product['DetailsProduitProducteur']}" /></p>
            <p>Quantité : <input type="number" name="produit[{$product['IdProduit']}][QuantiteProduitProducteur]" value="{$product['QuantiteProduitProducteur']}" /></p>
            <p>Supprimer ? <input type="checkbox" name="deleteProduit[{$product['IdProduit']}]" value="1"/></p>
        {/if}
        <button type="submit" name="Panier">Add panier</button>
    </div>
</div>