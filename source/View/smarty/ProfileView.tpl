{include file="../Partials/_HeaderView.tpl"}
<h1>wesh la street</h1>

{foreach from=$Infos item=info key=k}
    <p> {$k} - {$info}</p>
{/foreach}

{include file="../Partials/_FooterView.tpl"}