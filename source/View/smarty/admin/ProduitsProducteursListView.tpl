<head>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/styling.css">
</head>

<a href="/Admin/ProducteursList">Retour à la liste des</a>


<h1>Produits mis en vente par le producteur</h1>
<form method="post" action="">
    <div class="products">
        {foreach key=key item=product from=$Liste}
            {if $product.IsValidateProduitProducteur == True}
                <div class="product">
                    <form method="post" class="product-description">
                        <h3>{$product['DesignationProduit']}</h3>
                        <h4>{$product['DesignationProduitProducteur']}</h4>
                        <p style="padding: .5rem 0 ; width: 100%; display: flex; justify-content: space-between"> Prix : <span
                                style="width:50%; text-align: left;"> {$product['PrixProduitProducteur']} </span> </p>
                        <p style="padding: .5rem 0 ; width: 100%; display: flex; justify-content: space-between"> Description :
                            <span style="width:50%; text-align: left;"> {$product['DetailsProduitProducteur']} </span>
                        </p>
                        <p style="padding: .5rem 0 ; width: 100%; display: flex; justify-content: space-between"> Quantité : <span
                                style="width:50%; text-align: left;"> {$product['QuantiteProduitProducteur']} </span> </p>
                        <img style="margin-bottom: 1rem;" src="../../{$product['ImageProduitProducteur']}" alt="image produit">
                        <button type="submit" name="Delete">Supprimer</button>
                    </form>
                </div>
            {/if}
        {/foreach}
    </div>
</form>


<h1>Produits en attente de validation</h1>
<form method="post" action="">
    <div class="products">
        {foreach key=key item=product from=$Liste}
            {if $product.IsValidateProduitProducteur == False}
                <div class="product">
                    <form method="post" class="product-description">
                        <h3>{$product['DesignationProduit']}</h3>
                        <h4>{$product['DesignationProduitProducteur']}</h4>
                        <p style="padding: .5rem 0 ; width: 100%; display: flex; justify-content: space-between"> Prix : <span
                                style="width:50%; text-align: left;"> {$product['PrixProduitProducteur']} </span> </p>
                        <p style="padding: .5rem 0 ; width: 100%; display: flex; justify-content: space-between"> Description :
                            <span style="width:50%; text-align: left;"> {$product['DetailsProduitProducteur']} </span>
                        </p>
                        <p style="padding: .5rem 0 ; width: 100%; display: flex; justify-content: space-between"> Quantité : <span
                                style="width:50%; text-align: left;"> {$product['QuantiteProduitProducteur']} </span> </p>
                        <img style="margin-bottom: 1rem;" src="../../{$product['ImageProduitProducteur']}" alt="image produit">
                        <button type="submit" name="Delete">Supprimer</button>
                    </form>
                </div>
            {/if}
        {/foreach}
    </div>
    <Button type="submit" name="update">Modifier</Button>
    <button type="submit" name="delete">Supprimer</button>
</form>