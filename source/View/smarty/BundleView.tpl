{include file="../Partials/_HeaderView.tpl"}
<div style="display: flex;">
<h1 style="flex:1">Ajouter un bundle </h1>
<h1 style="flex:1">Liste des produits de votre futur bundle</h1>
</div>

<div class="interface">
    <div class="interface_left">
        <div class="interface_left_select">
            <label for="DesignationBundle">Nom de votre bundle</label>
            <input type="text" name="DesignationBundle" required>
            <label for="IdProduitsBundle">Liste de vos produits disponibles</label>
            <input type="text" name="IdProduitsBundle" id="searchInput_produitBundle" placeholder="Rechercher">
        </div>
        <div class="container_bundle">
            {foreach from=$AllProduits item=product key=key }
                <div class="cardBundle">
                    <label>Nom</label>
                    <p style="justify-content: center;">{$product['DesignationProduitProducteur']}</p>
                    <label style="padding:1em;">Quantité</label>
                    <p style="padding-bottom: 3em;">{$product['QuantiteProduitProducteur']}</p>
                    <img style="width: 50%;" src="{$product['ImageProduitProducteur']}" alt="">
                    <button name="{$product['IdProduitProducteur']}">Ajouter</button>
                </div>
            {{/foreach}}
        </div>
    </div>
    <div class="interface_right">
       
        <form id="bundle_form" method="POST">


        </form>
    </div>
</div>
{include file="../Partials/_FooterView.tpl"}