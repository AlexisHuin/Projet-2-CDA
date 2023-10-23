<div class="product">

    <a href="/DescriptifProduit/{$product['IdProduit']}">

        <img src="/assets/images/fruit.jpg" alt="<?= $product['name'] ?>">
    </a>
    <div class="product-description">
        <h3>{$product['DesignationProduit']}</h3>
        {if isset($product['DesignationCategorie'])}

            <h4>{$product['DesignationCategorie']}</h4>
        {else if isset($product['DesignationProduitProducteur'])}
            <h4>{$product['DesignationProduitProducteur']}</h4>
        {/if}
        <button type="submit" name="Panier">Add panier</button>
    </div>
</div>
