

<div class="bundle">
{assign var="quantite" value=explode(',',$AllBundles[$key]['QuantiteProduitsBundle'])}

<h1>{$AllBundles[$key]['DesignationBundle']}</h1>
<p>Proposer par {$AllBundles[$key]['RaisonSocialeProducteur']} </p>
<p>Contenu du bundle :</p>
<div>
    {foreach from=$Produits item=produit key=k}
        <p> {$produit.DesignationProduitProducteur} * {$quantite[$k]}<p>
    {/foreach}
    </div>
    <div>
    <p>Prix :<input type="text" style="width: 5em;" value="{$AllBundles[$key]['PrixBundle']}">€ </p>
    <p >MAJ Prix<input type="checkbox" name="/" value="1" /></p>
    </div>
    <p>Supprimer ? <input type="checkbox" name="/" value="1" /></p>
    </div>




