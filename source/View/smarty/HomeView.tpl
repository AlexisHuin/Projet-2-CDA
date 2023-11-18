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

    {*TODO Searchbar en JS pour bundle*}
    <div class="bundles">
        {foreach from=$ProduitsBundle item=produits key=key}
            <form method="post" class="bundle">
                {assign var="quantite" value=explode(',',$AllBundles[$key]['QuantiteProduitsBundle'])}

                <h1>{$AllBundles[$key]['DesignationBundle']}</h1>
                <p>Proposer par {$AllBundles[$key]['RaisonSocialeProducteur']} </p>
                <p>Contenu du bundle :</p>
                <div>
                    {foreach from=$produits item=produit key=k}
                        <p> {$produit.DesignationProduitProducteur} * {$quantite[$k]}
                        </p>
                    {/foreach}
                </div>
                <div>
                    <p>Prix : {$AllBundles[$key]['PrixBundle']}€ </p>
                </div>

                {if isset($smarty.session.user) && $smarty.session.user.RoleUser eq "Adherent"}
                    <input type="submit" value="Acheter" name="Acheter">
                    <input type="hidden" name="Id" value="{$AllBundles[$key]['IdBundle']}">
                {/if}
            </form>
        {/foreach}
    </div>

    <div class="products">
        {foreach key=key item=product from=$products}

            {include file="../Partials/_CardView.tpl"}

        {/foreach}
    </div>
</main>

{include file="../Partials/_FooterView.tpl"}