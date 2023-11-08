{if $URI === "/User/ProductList"}
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