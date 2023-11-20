<div class="bundle">
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
    <p>Supprimer ? <input type="checkbox" name="deleteProduit[]" value="{$AllBundles[$key]['IdBundle']}" /></p>
</div>