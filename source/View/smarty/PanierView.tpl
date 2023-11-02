{include file="../Partials/_HeaderView.tpl"}

<body>
    <div>
        {foreach from=$produit item=produit key=k}
            {include file="../Partials/_CardView.tpl"}
        {/foreach}
        
    </div>
</body>


{include file="../Partials/_FooterView.tpl"}