{if $URI === "/User/ProductList"}

        <p>{$product['DesignationProduitProducteur']}</p>
        <div style="display: flex; align-items: center;">
                <p style="flex: 1; padding-top:1em;">Prix : 
                <input style="width:5em;" type="text" name="produit[{$product['IdProduitProducteur']}][PrixProduitProducteur]"
                value="{$product['PrixProduitProducteur']}" /></p>
                <p style="flex: 1;">MAJ Prix<input type="checkbox" name="/" value="1" /> </p>
        </div>
        <p style="margin:1em;">Description : {$product['DetailsProduitProducteur']}</p>
        <p>Quantité :
                {$product['QuantiteProduitProducteur']}</p>
        <img style="padding: 1em;" src="../{$product['ImageProduitProducteur']}" alt="image produit">
        <p>Supprimer ? <input type="checkbox" name="deleteProduit[]" value="{$product['IdProduitProducteur']}" /></p>
{/if}