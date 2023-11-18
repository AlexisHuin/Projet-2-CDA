{if isset($Id) && $URI === "/DescriptifProduit/{$Id}"}
    <img src="../{$product['ImageProduitProducteur']}" alt="image produit">
    <div style="display: flex; flex-direction:row">
        <p> {$product['DesignationProduitProducteur']} </p>
    </div>
    <div style="display: flex; flex-direction:row">
        <p>Prix : {$product['PrixProduitProducteur']}</p>
    </div>
    <div style="display: flex; flex-direction:row">
        <p> {$product['DetailsProduitProducteur']} </p>
    </div>
    <div style="display: flex; flex-direction:row">
        <p> Quantité totale :
            {if isset($panier)}
                {foreach from=$panier item=item key=key}
                    {if $item['Produit'] == $product['IdProduitProducteur']}
                        {if ({$product['QuantiteProduitProducteur']} - {$item['Quantite']}) < 5} <span style="color:red"> Attention, il
                                ne reste plus que {($product['QuantiteProduitProducteur'] - {$item['Quantite']})} unités disponibles pour ce
                                produit</span>
                            {/if}
                        {/if}
                    {/foreach}
                {/if}
                {$product['QuantiteProduitProducteur']}</p>
    </div>
    <div style="display: flex; flex-direction:row">
        <input type="text" name="Quantite" placeholder="Quantité à ajouter">
        <input type="hidden" name="Id" value="{$product['IdProduitProducteur']}">
        <input type="hidden" name="IdProd" value="{$product['IdProducteurProduitProducteur']}">
        <input type="submit" name="Add">
    </div>
{/if}