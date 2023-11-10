{if isset($Id) && $URI === "/DescriptifProduit/{$Id}"}
    <img src="../{$product['ImageProduitProducteur']}" alt="image produit">
    <div style="display: flex; flex-direction:row">
        <label for="Designation">Designation du producteur : </label>
        <input type="text" name="Prix" value="{$product['PrixProduitProducteur']}" readonly>
    </div>
    <div style="display: flex; flex-direction:row">
        <label for="Prix">Prix : </label>
        <input type="text" name="Prix" value="{$product['PrixProduitProducteur']}" readonly>
    </div>
    <div style="display: flex; flex-direction:row">
        <label for="Description">Description : </label>
        <input type="text" name="Description" value="{$product['DetailsProduitProducteur']}" readonly>
    </div>
    <div style="display: flex; flex-direction:row">
        <label for="QuantiteTotal">Quantité totale :
            {if isset($smarty.session.panier)}
                {foreach from=$smarty.session.panier item=panier key=key}
                    {if $panier.Produit == $product['IdProduitProducteur']}
                        {if ({$product['QuantiteProduitProducteur']} - {$panier.Quantite}) < 5} <span style="color:red"> Attention, il
                                ne reste plus que {($product['QuantiteProduitProducteur'] - {$panier.Quantite})} unités de ce produit</span>
                            {/if}
                        {/if}
                    {/foreach}
                {/if}
        </label>
        <input type="text" name="QuantiteTotal" value="{$product['QuantiteProduitProducteur']}" readonly>
    </div>
    <div style="display: flex; flex-direction:row">
        <input type="text" name="Quantite" placeholder="Quantité à ajouter">
        <input type="hidden" name="Id" value="{$product['IdProduitProducteur']}">
        <input type="hidden" name="IdProd" value="{$product['IdProducteurProduitProducteur']}">
        <input type="submit" name="Add">
    </div>
{/if}