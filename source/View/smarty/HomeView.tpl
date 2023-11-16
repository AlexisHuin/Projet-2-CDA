{* {assign var=notifications value=$notifications scope="parent"} *}
{include file="../Partials/_HeaderView.tpl"}

<main>
    <div class="image-with-text">
     
    </div>
    <div class="text-overlay">
        <p>Profitez de nos exclusivités réservée aux adhérents avec notre formule spéciale !
         Inscrivez-vous dès maintenant pour bénéficier de 20% de réduction sur nos bundles irrésistibles.</p>
    </div>
    
    <label style="margin-left: 1em;" for="type">Type :</label>
    <select id="type" name="IdCategorieProduit">
        <option value="all">Tous</option>
        {foreach key=key item=categorie from=$categories}
            <option value="{$categorie.IdCategorie}">{$categorie.DesignationCategorie}</option>
        {/foreach}
    </select>
    <input type="text" name="DesignationProduit" id="productName" placeholder="Nom du produit">

    <div class="products">
        {foreach key=key item=product from=$products}

            {include file="../Partials/_CardView.tpl"}

        {/foreach}
    </div>
</main>

{include file="../Partials/_FooterView.tpl"}