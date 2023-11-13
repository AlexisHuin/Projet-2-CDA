

<div class="bundle">
{assign var="quantite" value=explode(',',$bundle['QuantiteProduitsBundle'])}

<h1>{$bundle['DesignationBundle']}</h1>
<p>Proposer par {$bundle['RaisonSocialeProducteur']} </p>
<p>Contenu du bundle :</p>
<div style='border: 1px solid black'>
{foreach from=$ProduitsBundle item=produit key=key}
    <p> {$produit.DesignationProduitProducteur} - {$quantite[$key]} /u<p>
{/foreach}
</div>
<p>Prix : {$bundle['PrixBundle']} €</p>
</div>




