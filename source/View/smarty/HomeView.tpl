{include file="../Partials/_HeaderView.tpl"}

<main>
<<<<<<< HEAD
 
<div class="image-with-text">
<img src="/assets/images/fruit.jpg" alt="Votre Image">
<div class="text-overlay">
    <p>Une AMAP, ou Association pour le Maintien de l'Agriculture Paysanne, est un partenariat entre des consommateurs et des agriculteurs locaux. Les membres de l'AMAP s'engagent à acheter régulièrement des produits frais directement auprès des agriculteurs, favorisant ainsi une agriculture durable et équitable.</p>
</div>
</div>

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
       
        
        
        <div class="products">
=======
    <div class="image-with-text">
        <img src="/assets/images/fruit.jpg" alt="Votre Image">
        <div class="text-overlay">
            <p>Une AMAP, ou Association pour le Maintien de l'Agriculture Paysanne, est un partenariat entre des
                consommateurs et des agriculteurs locaux. Les membres de l'AMAP s'engagent à acheter régulièrement des
                produits frais directement auprès des agriculteurs, favorisant ainsi une agriculture durable et
                équitable.</p>
        </div>
    </div>

    <label for="type">Type :</label>
    <select id="type" name="IdCategorieProduit">
        <option value="all">Tous</option>
        {foreach key=key item=categorie from=$categories}
            <option value="{$categorie.IdCategorie}">{$categorie.DesignationCategorie}</option>
        {/foreach}
    </select>
    <input type="text" name="DesignationProduit" id="productName" placeholder="Nom du produit">

    <div class="products">
>>>>>>> af8fa7007775f971a6a4a77109a22d196279016c
        {foreach key=key item=product from=$products}

            {include file="../Partials/_CardView.tpl"}

        {/foreach}
    </div>
</main>

{include file="../Partials/_FooterView.tpl"}