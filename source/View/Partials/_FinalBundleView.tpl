

<div class="bundle">
{assign var="quantite" value=explode(',',$AllBundles[$key]['QuantiteProduitsBundle'])}

<h1>{$AllBundles[$key]['DesignationBundle']}</h1>
<p>Proposer par {$AllBundles[$key]['RaisonSocialeProducteur']} </p>
<p>Contenu du bundle :</p>
<div style='border: 1px solid black'>
    {foreach from=$Produits item=produit key=k}
        <p> {$produit.DesignationProduitProducteur} * {$quantite[$k]}<p>
    {/foreach}
    </div>
    <p>Prix : {$AllBundles[$key]['PrixBundle']} €</p>
    </div>




