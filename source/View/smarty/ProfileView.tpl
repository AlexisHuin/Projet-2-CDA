{include file="../Partials/_HeaderView.tpl"}

{include file="../Partials/_AdherentProfil.tpl"}

{include file="../Partials/_ProducteurProfil.tpl"}

<form method="post">
    <input type="submit" name="DeleteAcc" value="Supprimer le compte">
</form>

{foreach from=$errors item=error key=key}
    <p style="color: red">{$error}</p>
{/foreach}

{include file="../Partials/_FooterView.tpl"}