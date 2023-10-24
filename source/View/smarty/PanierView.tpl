{include file="../Partials/_HeaderView.tpl"}

<body>
    <div>
        {foreach from=$produits item=item key=key}
            <h3>{$produit['nom']}</h3>
            <p>Prix : {$produit['prix']}</p>
            <p>Quantité : {$produit['Quantite']}</p>
        {/foreach}
        {var_dump($panier)}


    </div>
</body>


{include file="../Partials/_FooterView.tpl"}