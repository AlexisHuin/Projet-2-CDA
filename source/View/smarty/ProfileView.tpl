{include file="./headerView.tpl"}
<h1>wesh la street</h1>

{foreach from=$Infos item=info key=k}
    <p> {$k} - {$info}</p>
{/foreach}

{include file="./footerView.tpl"}