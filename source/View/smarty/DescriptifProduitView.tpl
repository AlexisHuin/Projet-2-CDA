{include file="../Partials/_HeaderView.tpl"}

<h2>{$produit.DesignationProduit}</h2>

{foreach from=$errors item=error key=key}
    <p style="color:red;">{$error}</p>
{/foreach}

{foreach from=$produitProducteur item=product key=key }
    <form method="post">
        {include file="../Partials/_CardView.tpl"}
    </form>
{/foreach}


{include file="../Partials/_FooterView.tpl"}