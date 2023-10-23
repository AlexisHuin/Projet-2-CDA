{include file="../Partials/_HeaderView.tpl"}

{foreach from=$productProducteur item=item key=key}
    {{include file="../Partials/_CardView.tpl"}}
    {$item.DesignationProduitProducteur}
    
    
{/foreach}








{include file="../Partials/_FooterView.tpl"}