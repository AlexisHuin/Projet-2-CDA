<div class="product">

    <a href="/DescriptifProduit/{$product['IdProduit']}">

        <img src="/assets/images/fruit.jpg" alt="<?= $product['name'] ?>">
    </a>
    <div class="product-description">
        <h3>{$product['DesignationProduit']}</h3>
        {if isset($product['DesignationCategorie'])}
            <h3>{$product['DesignationCategorie']}</h3>
        {/if}
        {if isset($product['PrixProduitProducteur']) && isset($product['DetailsProduitProducteur']) && isset($product['QuantiteProduitProducteur']) && isset($product['ImageProduitProducteur'])  }
            <input type="text" name="produit[{$product['IdProduit']}][DesignationProduitProducteur]" value="{$product['DesignationProduitProducteur']}"/>
            <p>Prix : <input type="text" name="produit[{$product['IdProduit']}][PrixProduitProducteur]" value="{$product['PrixProduitProducteur']}"/></p>
            <p>Description :<input type="text" name="produit[{$product['IdProduit']}][DetailsProduitProducteur]" value="{$product['DetailsProduitProducteur']}" /></p>
            <p>Quantité : <input type="number" name="produit[{$product['IdProduit']}][QuantiteProduitProducteur]" value="{$product['QuantiteProduitProducteur']}" /></p>
            <img src="/{$product['ImageProduitProducteur']}" alt="image produit">
            <p>Supprimer ? <input type="checkbox" name="deleteProduit[{$product['IdProduit']}]" value="1"/></p>
        {/if}
        <form method="POST" action="/Adherents/AddPanier">
        <label for="quantite_produit">Quantité :</label>
        <input type="number" id="quantite_produit" name="qte_produit" min="1" value="1">
        <button type="submit">Ajouter au Panier</button>
        </form>
    </div>
</div>