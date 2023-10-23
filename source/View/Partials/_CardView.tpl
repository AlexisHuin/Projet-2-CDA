<div class="product">

    <a href="/DescriptifProduit/{$product['IdProduit']}">

        <img src="/assets/images/fruit.jpg" alt="<?= $product['name'] ?>">
    </a>
    <div class="product-description">
        <h3>{$product['DesignationProduit']}</h3>
        {if isset($product['DesignationCategorie'])}
            <h3>{$product['DesignationCategorie']}</h3>
        {else if isset($product['DesignationProduitProducteur'])}
            <h4>{$product['DesignationProduitProducteur']}</h4>
        {/if}
        {if isset($product['PrixProduitProducteur']) && isset($product['DetailsProduitProducteur']) && isset($product['QuantiteProduitProducteur'])  }
            <p>Prix : {$product['PrixProduitProducteur']}</p>
            <p>Description : {$product['DetailsProduitProducteur']}</p>
            <p>Quantité : {$product['QuantiteProduitProducteur']}</p>
            <a href=""><Button>Modifier</Button></a> 
            <a href=""><button>Supprimer</button></a>
        {/if}
    </div>
</div>