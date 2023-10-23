{include file="../Partials/_HeaderView.tpl"}

<main>
<form action="" method="post">
    <label for="type">Type :</label>
        <select id="type" name="IdCategorieProduit">
            <option value="">Tous les types</option>
            {foreach key=key item=categorie from=$categories}
                <option value="{$categorie.IdCategorie}">{$categorie.DesignationCategorie}</option>
            {/foreach}
        </select>
        
        <label for="saison">Saison :</label>
        <select id="saison" name="IdSaisonProduit">
            <option value="">Toutes les saisons</option>
            {foreach key=key item=Saison from=$saisons}
            <option value="{$Saison.IdSaison}">{$Saison.NomSaison}</option>
            {/foreach}
        </select>
        
        <input type="text" name="DesignationProduit" id="productName" placeholder="Nom du produit">
        <button type="submit">Filtrer</button>
</form> 
        
        <div class="image-with-text">
            <img src="/assets/images/fruit.jpg" alt="Votre Image">
            <div class="text-overlay">
                <p>Une AMAP, ou Association pour le Maintien de l'Agriculture Paysanne, est un partenariat entre des consommateurs et des agriculteurs locaux. Les membres de l'AMAP s'engagent à acheter régulièrement des produits frais directement auprès des agriculteurs, favorisant ainsi une agriculture durable et équitable.</p>
            </div>
        </div>
        
        
        <div class="products">
        {foreach key=key item=product from=$products}
            <div class="product">

                <a href="/DescriptifProduit/{$product['IdProduit']}">

                    <img src="/assets/images/fruit.jpg" alt="<?= $product['name'] ?>">
                </a>
                <div class="product-description">
                    <h3>{$product['DesignationProduit']}</h3>
                    <h4>{$product['DesignationCategorie']}</h4>
                    <p>{$product['NomSaison']}</p>
                </div>
            </div>
        {/foreach}
    </div>
</main>

{include file="../Partials/_FooterView.tpl"}