{include file="../Partials/_HeaderView.tpl"}


<body>
    <h1>Pré-paiement</h1>

    <!-- Affichage des produits du panier -->
    <div>
        <?php foreach ($produits as $produit) : ?>
            <div>
                <h3><?php echo $produit['nom']; ?></h3>
                <p>Prix : <?php echo $produit['prix']; ?></p>
                <p>Quantité : <?php echo $produit['Quantite']; ?></p>
            </div>
            <hr>
        <?php endforeach; ?>
    </div>

{include file="../Partials/_FooterView.tpl"}