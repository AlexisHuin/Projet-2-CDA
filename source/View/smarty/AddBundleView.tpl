{include file="../Partials/_HeaderView.tpl"}
{foreach from=$errors item=error key=key}
    <p>{$error}</p>
{/foreach}
<a href="/User/ProductList">Voir vos produits</a>
<div style="display: flex">
    <h1 style="flex:1; margin-left:0.5em;">Ajouter un bundle </h1>
    <h1 style="flex:1;">Liste des produits de votre futur bundle</h1>
</div>
<div class="interface">
    <div class="interface_left">
        <div class="interface_left_select">

            <label style="margin-left:1em; " for="IdProduitsBundle">Liste de vos produits disponibles</label>
            <input style="margin-left:1em; " type="text" name="IdProduitsBundle" id="searchInput_produitBundle"
                placeholder="Rechercher">
        </div>
        <div class="container_bundle">
            {foreach from=$AllProduits item=product key=key }
                {include file="../Partials/_BundleView.tpl"}
            {/foreach}
        </div>
    </div>
    <div class="interface_right">

        <form id="bundle_form" method="POST">
            <div style="display:flex; border:1px solid black; background-color:lightgrey;">
                <div style="flex:1;margin:2em 0 0 0; text-align: center;">
                    <label for="DesignationBundle">Nom de votre bundle</label>
                    <input type="text" name="DesignationBundle" required>
                </div>
                <div style="flex:1; margin:2em 0 0 0; text-align: center;">
                    <p class="addCount"></p>
                    <button style="margin: 1em;" id="button_form-bundle" type="submit"
                        name="addBundle">Validation</button>
                    <input name="IdProducteurBundle" type="hidden">
                </div>
            </div>
            <div class="container_bundle_right">
                {* * Les éléménts sont généré dynamiquement dans app.js *}

            </div>

        </form>
    </div>
</div>
{include file="../Partials/_FooterView.tpl"}