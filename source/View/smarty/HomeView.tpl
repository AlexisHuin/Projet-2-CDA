{include file="../Partials/_HeaderView.tpl"}
    <label for="type">Type :</label>
    <select id="type">
        <option value="all">Tous les types</option>
        {foreach key=key item=categorie from=$categories}
            <option value="{$categorie.DesignationCategorie}">{$categorie.DesignationCategorie}</option>
        {/foreach}
    </select>
    
    <label for="saison">Saison :</label>
    <select id="saison">
        <option value="all">Toutes les saisons</option>
        {foreach key=key item=Saison from=$saisons}
        <option value="{$Saison.NomSaison}">{$Saison.NomSaison}</option>
        {/foreach}
    </select>
    
    <input type="text" id="productName" placeholder="Nom du produit">
    <button onclick="filterProducts()">Filtrer</button>
    
    
    <div class="image-with-text">
        <img src="./assets/images/fruit.jpg" alt="Votre Image">
        <div class="text-overlay">
            <p>Une AMAP, ou Association pour le Maintien de l'Agriculture Paysanne, est un partenariat entre des consommateurs et des agriculteurs locaux. Les membres de l'AMAP s'engagent à acheter régulièrement des produits frais directement auprès des agriculteurs, favorisant ainsi une agriculture durable et équitable.</p>
        </div>
    </div>
    
    
    <div class="products">
    {foreach key=key item=product from=$products}
        <div class="product">
                <img src="./assets/images/fruit.jpg" alt="<?= $product['name'] ?>">
                <div class="product-description">
                    <h3>{$product['DesignationProduit']} </h3>
                    <h4>{$product['DesignationCategorie']}</h4>
                    <p>{$product['NomSaison']}</p>
                </div>
       </div>
    {/foreach}
    </div>
    
