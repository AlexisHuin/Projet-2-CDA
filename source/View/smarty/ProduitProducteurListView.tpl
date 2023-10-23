{include file="../Partials/_HeaderView.tpl"}



<div class="products">
    {foreach key=key item=product from=$AllProduits}
        {include file="../Partials/_CardView.tpl"}
    {/foreach}
</div>



{include file="../Partials/_FooterView.tpl"}